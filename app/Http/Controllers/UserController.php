<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$users = User::latest()->paginate(5);

        return view('user.index',[
			'users' => $users
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

		//validasi
		$validated = $request->validate([
			'username' => 'required|string|unique:users,username',
			'name' => 'required|string |max:255',
			'email' => 'required|email|unique:users,email',
			'password' => 'nullable|min:4|',
			'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
		],[
			// custom message username
			'username.required' => 'Username harus diisi.',
			'username.string' => 'Username harus berupa kata.',
			'username.unique' => 'Username sudah terdaftar.',

			// custom message name
			'name.required' => 'Nama harus diisi.',
			'name.string' => 'Nama harus berupa kata.',
			'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

			// custom message email
			'email.required' => 'Email harus diisi.',
			'email.email' => 'Email harus berupa alamat email yang valid.',
			'email.unique' => 'Email sudah terdaftar.',

			// custom message password
			'password.min' => 'Password minimal 4 karakter.',

			// custom message photo
			'photo.image' => 'Dokumen seharusnya berupa gambar.',
			'photo.mimes' => 'tipe dokumen yang dapat diinput: jpeg, png, jpg.',
			'photo.max' => 'ukuran gambar maksimal 2 MB.',
		]);
		$photoName = null;
		if ($request->hasFile('photo')) {
			$photoName = time().'.'.$request->photo->extension();
			$request->photo->move(public_path('photos'), $photoName);
		}
		//store
		$users = User::create([
			'username' => $validated['username'],
			'name' => $validated['name'],
			'email' => $validated['email'],
			'password' => bcrypt($validated['password']),
			'photo' => $photoName,

		]);
		return redirect()->route('users.index')->with('success','Data user berhasil ditambahkan');


    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
		return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
	//route menggunakan model binding
    {
        return view('user.edit', [
			'user' => $user
		]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
		//route menggunakan model binding
	{

		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email|unique:users,email,' . $user->id,
			'password' => 'nullable|min:4',
			'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
		],[

		// custom message name
		'name.required' => 'Nama harus diisi.',
		'name.string' => 'Nama harus berupa kata.',
		'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

		// custom message email
		'email.required' => 'Email harus diisi.',
		'email.email' => 'Email harus berupa alamat email yang valid.',
		'email.unique' => 'Email sudah terdaftar.',

		// custom message password
		'password.min' => 'Password minimal 4 karakter.',

		// custom message photo
		'photo.image' => 'Dokumen seharusnya berupa gambar.',
		'photo.mimes' => 'tipe dokumen yang dapat diinput: jpeg, png, jpg',
		'photo.max' => 'ukuran gambar maksimal 2 MB.',
		]);

		if ($request->hasFile('photo')) {
			$oldImage = public_path('photos/' . $user->photo);
			if(file_exists($oldImage)) {
				unlink($oldImage);
			}
			$photoName = time() . '.' . $request->photo->extension();
			$request->photo->move(public_path('photos'), $photoName);
			$user->photo = $photoName;
		}

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
		$oldImage = public_path('photos/' . $user->photo);
		if($user->photo && file_exists($oldImage)) {
			unlink($oldImage);
		}

		$user->delete();
		return redirect()->route('users.index')->with('success','Data user berhasil dihapus');
    }
}
