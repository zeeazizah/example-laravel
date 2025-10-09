<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="container px-3">
        <div class="card shadow-sm w-100 my-5 mx-auto" style="max-width: 450px;">
            <div class="card-body p-4">
                <h4 class="text-center text-primary fw-bold mb-3">Register</h4>
                <p class="text-center text-muted mb-4">Buat akun baru untuk masuk ke Halaman Anda</p>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- Username -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input id="username"
                           type="text"
                           name="username"
                           class="form-control @error('username') is-invalid @enderror"
                           value="{{ old('username') }}"
                           required autofocus>
                    @error('username')
                        <div class="inv	alid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input id="name"
                           type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email"
                           type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Foto Profil -->
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

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password"
                           type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input id="password_confirmation"
                           type="password"
                           name="password_confirmation"
                           class="form-control"
                           required>
                </div>

                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>

                <div class="text-center">
                    <small class="text-muted">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-primary text-decoration-none">Login</a>
                    </small>
                </div>
			</form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
