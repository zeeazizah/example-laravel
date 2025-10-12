<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Post')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="{{ asset('bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('posts.public') }}">
                My Post
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    @guest
                        {{-- Jika belum login --}}
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-light text-primary fw-semibold ms-2">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                        </li>
                    @else
                        {{-- Jika sudah login, tombol Dashboard putih --}}
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="btn btn-light text-primary fw-semibold ms-2 d-flex align-items-center">
                                <i class="me-1"></i> Dashboard
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-5">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
