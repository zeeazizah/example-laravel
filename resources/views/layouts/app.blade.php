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
			<a class="navbar-brand fw-bold" href="{{ route('home') }}">
				Admin Panel
			</a>

			<!-- Sidebar Toggle (mobile) -->
			<button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="d-flex">
				<a class="btn btn-outline-light btn-sm ms-2" href="#">Sign out</a>
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
							<a class="nav-link d-flex align-items-center {{ request()->routeIs('home') ? 'active fw-semibold text-primary' : 'text-dark' }}"
							   href="{{ route('home') }}">
								<i class="bi bi-house me-2"></i> Dashboard
							</a>
						</li>
						<li class="nav-item mb-1">
							<a class="nav-link d-flex align-items-center {{ request()->routeIs('users.*') ? 'active fw-semibold text-primary' : 'text-dark' }}"
							   href="{{ route('users.index') }}">
								<i class="bi bi-people me-2"></i> Data User
							</a>
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
