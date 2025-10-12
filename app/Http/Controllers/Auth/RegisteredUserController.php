<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
   public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'username' => 'required|string|unique:users,username',
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            'unique:users,email',
            'regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/', // <-- pastikan ada . setelah @
        ],
        'password' => 'required|min:4|confirmed',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ], [
        // custom message username
        'username.required' => 'Username harus diisi.',
        'username.unique' => 'Username sudah terdaftar.',

        // custom message name
        'name.required' => 'Nama harus diisi.',
        'name.string' => 'Nama harus berupa kata.',
        'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

        // custom message email
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Email harus berupa alamat email yang valid.',
        'email.unique' => 'Email sudah terdaftar.',
        'email.regex' => 'Email harus memiliki domain valid (contoh: user@mail.com).',

        // custom message password
        'password.required' => 'Password harus diisi.',
        'password.min' => 'Password minimal 4 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',

        // custom message photo
        'photo.image' => 'File harus berupa gambar.',
        'photo.mimes' => 'Tipe gambar yang diizinkan: jpeg, png, jpg, gif.',
        'photo.max' => 'Ukuran gambar maksimal 2 MB.',
    ]);

    // Upload foto (jika ada)
    $photoName = null;
    if ($request->hasFile('photo')) {
        $photoName = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('photos'), $photoName);
    }

    // Simpan user ke database
    User::create([
        'username' => $validated['username'],
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'photo' => $photoName,
        'role' => 2,
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
	}

}
