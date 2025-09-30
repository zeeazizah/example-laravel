@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Tambah User')

@section('header-title', 'Tambah User')

@section('content')

	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card shadow-sm border-0">
					<div class="card-header bg-primary text-white">
						<h5 class="mb-0">Form Tambah User</h5>
					</div>
					<div class="card-body">
						<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
							@csrf

							<!-- Field Judul -->
							<div class="mb-3">
								<label for="user" class="form-label">Name</label>
								<input
									type="text"
									id="name"
									name="name"
									class="form-control"
									placeholder="Masukkan nama"
									required>
							</div>

							<div class="mb-3">
								<label for="username" class="form-label">Username</label>
								<input
									type="text"
									id="username"
									name="username"
									class="form-control @error('username') is-invalid @enderror"
									value="{{ old('username') }}"
									placeholder="Masukkan Nama"
									required>
								@error('username')
									<div class="text-danger mt-1">
										{{ 'Username telah digunakan sebelumnya' }}
									</div>
								@enderror
							</div>

							<div class="mb-3">
								<label for="email" class="form-label">Email</label>
								<input
									type="email"
									id="email"
									name="email"
									class="form-control"
									placeholder="Masukkan Email"
									required>
								@error('username')
									<div class="text-danger mt-1">
										{{ 'Email tidak valid' }}
									</div>
								@enderror
							</div>

							<div class="mb-3">
								<label for="password" class="form-label">Password</label>
								<input
									type="password"
									id="password"
									name="password"
									class="form-control @error('password') is-invalid @enderror"
									placeholder="Masukkan password"
									required>
								@error('password')
									<div class="text-danger mt-1">
										{{ 'Password minimal 4 karakter' }}
									</div>
								@enderror
							</div>

							<div class="mb-3">
								<label for="photo" class="form-label">Gambar</label>
								<input
									type="file"
									id="photo"
									name="photo"
									class="form-control @error('photo') is-invalid @enderror">
								@error('photo')
									<div class="text-danger mt-1">
										{{ $message }}
									</div>
								@enderror
							</div>

							<!-- Tombol -->
							<div class="d-flex justify-content-end gap-2">
								<a href="{{ route('users.index') }}" class="btn btn-secondary">
									Batal
								</a>
								<button type="submit" class="btn btn-primary">
									Simpan
								</button>
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
