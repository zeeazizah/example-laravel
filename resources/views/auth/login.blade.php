<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="card shadow-sm w-100" style="max-width: 400px;">
        <div class="card-body p-4">
            <h4 class="text-center text-primary fw-bold mb-3">Login</h4>
            <p class="text-center text-muted mb-4">Masuk ke akun Anda</p>

			@if(session('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					{{ session('success') }}
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			@endif

            <form method="POST" action="{{ route('login') }}">
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
                        <div class="invalid-feedback">{{ $message }}</div>
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

                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>

                <!-- CTA ke Register -->
                <div class="text-center">
                    <small class="text-muted">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-primary text-decoration-none">Daftar Sekarang</a>
                    </small>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
