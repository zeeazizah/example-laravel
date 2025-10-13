@extends('layouts.app')

@section('title', 'Edit Profile')

@section('header-title', 'Edit Profile')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <!-- Flash Message -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Update Profile -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    Update Profile
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" value="{{ old('username', $user->username) }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Baru (opsional) -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Isi jika ingin mengganti password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password Baru -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control"
                                id="password_confirmation" name="password_confirmation"
                                placeholder="Ulangi password baru">
                        </div>

                        <!-- Upload Foto -->
						<div class="mb-3">
							<label for="photo" class="form-label">Foto Profil</label>
							<input type="file" class="form-control @error('photo') is-invalid @enderror"
								id="photo" name="photo">
							@error('photo')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror

							@if($user->photo)
								<div class="mt-2 d-flex align-items-center">
									<img src="{{ asset('photos/'.$user->photo) }}" alt="Profile Photo" width="80"
										class="rounded-circle border me-3">
								</div>
							@endif
						</div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
					@if($user->photo)
						<form action="{{ route('profile.photo.destroy') }}" method="POST" class="mt-3">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-danger btn-sm">Hapus Foto</button>
						</form>
					@endif
                </div>
            </div>

            <!-- Hapus Akun -->
            <div class="card mb-4 shadow-sm border-0">
				<div class="card-header bg-danger text-white fw-bold">
					Hapus Akun
				</div>
				<div class="card-body">
					<p class="text-muted">
						Akun yang dihapus tidak bisa dikembalikan. Harap konfirmasi password Anda sebelum melanjutkan.
					</p>

					<form method="POST" action="{{ route('profile.destroy') }}">
						@csrf
						@method('DELETE')
						<div class="mb-3">
							<label for="password_delete" class="form-label">Password</label>
							<input
								type="password"
								class="form-control @error('delete_password') is-invalid @enderror"
								id="password_delete"
								name="delete_password"
								placeholder="Masukkan password Anda"
								required
							>
							@error('delete_password')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="d-flex justify-content-end">
							<button type="submit" class="btn btn-danger"
								onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
								Hapus Akun
							</button>
						</div>
					</form>
				</div>
			</div>


        </div>
    </div>
</div>
@endsection
