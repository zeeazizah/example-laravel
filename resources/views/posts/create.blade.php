@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            {{-- Update Profile --}}
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    Update Profile
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" value="{{ old('username', $user->username) }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Upload Foto --}}
                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                id="photo" name="photo">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if($user->photo)
                                <div class="mt-2">
                                    <img src="{{ asset('photos/'.$user->photo) }}"
                                        alt="Profile Photo" width="80" class="rounded-circle border">
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>

            {{-- Update Password --}}
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-warning text-dark fw-bold">
                    Update Password
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                id="current_password" name="current_password">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control"
                                id="password_confirmation" name="password_confirmation">
                        </div>

                        <button type="submit" class="btn btn-warning text-dark">Update Password</button>
                    </form>
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-danger text-white fw-bold">
                    Hapus Akun
                </div>
                <div class="card-body">
                    <p class="text-muted">Akun yang dihapus tidak bisa dikembalikan. Harap konfirmasi password Anda sebelum melanjutkan.</p>
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')

                        <div class="mb-3">
                            <label for="password_delete" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password_delete" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                            Hapus Akun
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
