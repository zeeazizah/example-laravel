<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil nilai search dan entries (default 5)
        $search = $request->input('search');
        $entries = $request->input('entries', 5);

        $users = User::query()
            ->when($request->filled('search'), function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($entries)
            ->appends($request->query()); // agar pagination membawa query string

        return view('user.index', [
			'users' => $users,
			'search' => $search,
			'entries' => $entries,
		]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|string|in:1,2',
            'username' => 'required|string|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/',
            ],
            'password' => 'nullable|min:4',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

		],[

			// Role
			'role.required' => 'Role wajib dipilih.',
			'role.in' => 'Role tidak valid. Pilih antara Admin atau User.',

			// Username
			'username.required' => 'Username wajib diisi.',
			'username.unique' => 'Username sudah digunakan.',

			// Name
			'name.required' => 'Nama wajib diisi.',

			// Email
			'email.required' => 'Email wajib diisi.',
			'email.email' => 'Format email tidak valid.',
			'email.unique' => 'Email sudah terdaftar.',
			'email.regex' => 'Email harus memiliki domain valid (contoh: user@mail.com).',

			// Password
			'password.min' => 'Password minimal 4 karakter.',

			// Image
			'photo.image' => 'File harus berupa gambar.',
			'photo.mimes' => 'Gambar hanya boleh berekstensi: jpeg, png, jpg',
			'photo.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Upload foto jika ada
        $photoName = null;
        if ($request->hasFile('photo')) {
            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('photos'), $photoName);
        }

        // Simpan data user
        User::create([
            'role' => $validated['role'],
            'username' => $validated['username'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'photo' => $photoName,
        ]);

        return redirect()->route('users.index')->with('success', 'Data user berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
       return view('user.show', [
		'user' => $user
		]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', [
			'user' => $user
		]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|string|in:1,2',
            'username' => 'required|string|unique:users,username,' . $user->id,
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $user->id,
                'regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/',
            ],
            'password' => 'nullable|min:4',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
		],[

			// Role
			'role.required' => 'Role wajib dipilih.',
			'role.in' => 'Role tidak valid. Pilih antara Admin atau User.',

			// Username
			'username.required' => 'Username wajib diisi.',
			'username.unique' => 'Username sudah digunakan.',

			// Name
			'name.required' => 'Nama wajib diisi.',

			// Email
			'email.required' => 'Email wajib diisi.',
			'email.email' => 'Format email tidak valid.',
			'email.unique' => 'Email sudah terdaftar.',
			'email.regex' => 'Email harus memiliki domain valid (contoh: user@mail.com).',

			// Password
			'password.min' => 'Password minimal 4 karakter.',

			// Image
			'photo.image' => 'File harus berupa gambar.',
			'photo.mimes' => 'Gambar hanya boleh berekstensi: jpeg, png, jpg',
			'photo.max' => 'Ukuran gambar maksimal 2MB.',

        ]);

        // Update foto jika ada file baru
        if ($request->hasFile('photo')) {
            if (!empty($user->photo)) {
                $oldImage = public_path('photos/' . $user->photo);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('photos'), $photoName);
            $user->photo = $photoName;
        }

        // Update data lain
        $user->role = $validated['role'];
        $user->username = $validated['username'];
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Data user berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->photo && file_exists(public_path('photos/' . $user->photo))) {
            unlink(public_path('photos/' . $user->photo));
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Data user berhasil dihapus');
    }
}
