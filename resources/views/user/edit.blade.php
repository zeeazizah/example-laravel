@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Edit User')
@section('header-title', 'Edit User')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Form Edit User</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}"
                                placeholder="Masukkan nama"
                                required>
                        </div>

                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username', $user->username) }}"
                                placeholder="Masukkan username"
                                required>
                            @error('username')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}"
                                placeholder="Masukkan email"
                                required>
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Masukkan password">
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
							<small class="text-danger">Kosongkan jika tidak ingin diubah</small>
                        </div>

                        <!-- Image -->
                        <div class="mb-3">
                            <label for="photo" class="form-label">Gambar</label>
                            <input
                                type="file"
                                id="photo"
                                name="photo"
                                class="form-control @error('photo') is-invalid @enderror"
                                accept="image/*">
                            @error('photo')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                            @if($user->photo)
                                <div class="mt-2">
                                    <img src="{{ asset('photos/' . $user->photo) }}" alt="Preview Gambar" width="100">
                                </div>
                            @endif
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
