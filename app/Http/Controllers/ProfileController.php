<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|unique:users,username,' . $user->id,
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:4|confirmed',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'username.required' => 'Username harus diisi.',
            'username.unique'   => 'Username sudah terdaftar.',
            'name.required'     => 'Nama harus diisi.',
            'email.required'    => 'Email harus diisi.',
            'email.email'       => 'Email harus valid.',
            'email.unique'      => 'Email sudah terdaftar.',
            'password.min'      => 'Password minimal 4 karakter.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
            'photo.image'       => 'Foto harus berupa gambar.',
            'photo.mimes'       => 'Format foto hanya jpeg, png, jpg, gif.',
            'photo.max'         => 'Ukuran foto maksimal 2 MB.',
        ]);

        // Upload foto baru (jika ada)
        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if (!empty($user->photo)) {
                $oldImage = public_path('photos/' . $user->photo);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            // Simpan foto baru
            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('photos'), $photoName);

            $user->photo = $photoName;
        }

        // Update data user
        $user->username = $validated['username'];
        $user->name     = $validated['name'];
        $user->email    = $validated['email'];

        // Update password jika ada input baru
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Profil berhasil diperbarui');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
	{
		// Validasi khusus untuk form hapus akun
		$request->validate([
			'delete_password' => ['required', 'current_password'],
		], [

			'delete_password.required' => 'Password Wajib diisi',
			'delete_password.current_password' => 'Password yang kamu masukkan salah.',
		]);

		$user = $request->user();

		// Hapus foto profil jika ada
		if ($user->photo) {
			$oldImage = public_path('photos/' . $user->photo);
			if (file_exists($oldImage)) {
				unlink($oldImage);
			}
		}

		// Logout sebelum menghapus akun
		Auth::logout();

		// Hapus akun user
		$user->delete();

		// Hapus sesi dan token
		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return Redirect::to('/login')->with('success', 'Akun kamu berhasil dihapus.');
	}

	public function destroyPhoto(Request $request)
	{
		$user = $request->user();
		$photoPath = public_path('photos/' . $user->photo);

		if ($user->photo && file_exists($photoPath)) {
			unlink($photoPath);
			$user->photo = null;
			$user->save();
		}

		return back()->with('success', 'Foto profil berhasil dihapus.');
	}
}
