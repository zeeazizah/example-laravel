<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Post')</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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
                        {{-- Jika sudah login --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(Auth::user()->photo)
                                    <img src="{{ asset('photos/' . Auth::user()->photo) }}"
                                         alt="Profile Photo" class="rounded-circle me-2" width="30" height="30">
                                @else
                                    <i class="bi bi-person-circle me-2 fs-5"></i>
                                @endif
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-gear me-2"></i> Edit Profile
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
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
