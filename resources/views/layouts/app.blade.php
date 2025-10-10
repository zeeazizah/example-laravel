<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Admin Panel')</title>

	<!-- Bootstrap core CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Bootstrap Icons -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

	@stack('styles')
</head>
<body class="bg-light">

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
		<div class="container-fluid">
			<a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
				Admin Panel
			</a>

			<!-- Sidebar Toggle (mobile) -->
			<button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="d-flex align-items-center">
				@auth
					<!-- Dropdown Profile -->
					<div class="dropdown">
						<a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
							id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
								@if(Auth::user()->photo)
									<img src="{{ asset('photos/' . Auth::user()->photo) }}"
										alt="profile" width="32" height="32"
										class="rounded-circle me-2">
								@else
									<img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
										alt="profile" width="32" height="32"
										class="rounded-circle me-2">
								@endif
						</a>
						<ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser">
							<li class="dropdown-header">
								<strong>{{ Auth::user()->name }}</strong><br>
								<small class="text-muted">
									{{ Auth::user()->role == 1 ? 'Admin' : 'User' }}
								</small>
							</li>
							<li><hr class="dropdown-divider"></li>
							<li>
								<form method="POST" action="{{ route('logout') }}" id="logoutForm">
									@csrf
									<button type="button" class="dropdown-item text-danger" onclick="confirmLogout()">
										<i class="bi bi-box-arrow-right me-2"></i> Sign Out
									</button>
								</form>
							</li>
						</ul>
					</div>

<script>
    function confirmLogout() {
        if (confirm("Apakah Anda yakin ingin logout?")) {
            document.getElementById('logoutForm').submit();
        }
    }
</script>

				@endauth
			</div>
		</div>
	</nav>


	<div class="container-fluid">
		<div class="row">
			<!-- Sidebar -->
			<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white border-end vh-100 sidebar collapse">
				<div class="pt-4">
					<ul class="nav flex-column">
						<li class="nav-item mb-1">
							<a class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active fw-semibold text-primary' : 'text-dark' }}"
							   href="{{ route('dashboard') }}">
								<i class="bi bi-house me-2"></i> Dashboard
							</a>
						</li>

						@if (Auth::user() && Auth::user()->role == 1)
							<li class="nav-item mb-1">
								<a class="nav-link d-flex align-items-center {{ request()->routeIs('users.*') ? 'active fw-semibold text-primary' : 'text-dark' }}"
									href="{{ route('users.index') }}">
										<i class="bi bi-people me-2"></i> Data User
								</a>
							</li>
						@endif

						<li class="nav-item mb-1">
							@auth
								<a class="nav-link d-flex align-items-center {{ request()->routeIs('posts.*') ? 'active fw-semibold text-primary' : 'text-dark' }}"
								href="{{ route('posts.index') }}">
									<i class="bi bi-stickies me-2"></i> Post
								</a>
							@endauth
						</li>

						<li class="nav-item mb-1">
							@auth
								<a class="nav-link d-flex align-items-center {{ request()->routeIs('profile.*') ? 'active fw-semibold text-primary' : 'text-dark' }}"
								href="{{ route('profile.edit') }}">
									<i class="bi bi-person me-2"></i> Profile
								</a>
							@endauth
						</li>

					</ul>
				</div>
			</nav>

			<!-- Main Content -->
			<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
				<div class="d-flex justify-content-between align-items-center border-bottom mb-4">
					<h1 class="h3">@yield('header-title', 'Dashboard')</h1>
				</div>

				@yield('content')
			</main>
		</div>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	@stack('scripts')
</body>
</html>
