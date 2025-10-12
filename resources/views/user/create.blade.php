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

							<!-- Field Role -->
							<div class="mb-3">
								<label for="role" class="form-label">Role <span class="text-danger">*</span></label>
								<select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
									<option value="" disabled selected>Pilih Role</option>
									<option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Admin</option>
									<option value="2" {{ old('role') == 2 ? 'selected' : '' }}>User</option>
								</select>
								@error('role')
									<div class="text-danger mt-1">{{ $message }}</div>
								@enderror
							</div>

							<!-- Field Name -->
							<div class="mb-3">
								<label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
								<input
									type="text"
									id="name"
									name="name"
									class="form-control @error('name') is-invalid @enderror"
									value="{{ old('name') }}"
									placeholder="Masukkan nama lengkap"
									required>
								@error('name')
									<div class="text-danger mt-1">{{ $message }}</div>
								@enderror
							</div>

							<!-- Field Username -->
							<div class="mb-3">
								<label for="username" class="form-label">Username <span class="text-danger">*</span></label>
								<input
									type="text"
									id="username"
									name="username"
									class="form-control @error('username') is-invalid @enderror"
									value="{{ old('username') }}"
									placeholder="Masukkan username"
									required>
								@error('username')
									<div class="text-danger mt-1">{{ $message }}</div>
								@enderror
							</div>

							<!-- Field Email -->
							<div class="mb-3">
								<label for="email" class="form-label">Email <span class="text-danger">*</span></label>
								<input
									type="email"
									id="email"
									name="email"
									class="form-control @error('email') is-invalid @enderror"
									value="{{ old('email') }}"
									placeholder="Masukkan email aktif"
									required>
								@error('email')
									<div class="text-danger mt-1">{{ $message }}</div>
								@enderror
							</div>

							<!-- Field Password -->
							<div class="mb-3">
								<label for="password" class="form-label">Password <span class="text-danger">*</span></label>
								<input
									type="password"
									id="password"
									name="password"
									class="form-control @error('password') is-invalid @enderror"
									placeholder="Masukkan password minimal 4 karakter"
									required>
								@error('password')
									<div class="text-danger mt-1">{{ $message }}</div>
								@enderror
							</div>

							<!-- Field Photo -->
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
