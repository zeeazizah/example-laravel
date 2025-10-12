@extends('layouts.app')

@section('title', 'Halaman User')
@section('header-title', 'Daftar User')

@section('content')

	{{-- Notifikasi sukses / error --}}
	@if (session('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			{{ session('success') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	@endif

	<div class="container my-3">

		<!-- Form Search -->
		<form action="{{ route('users.index') }}" method="GET" class="mb-4 d-flex gap-2">
			<div class="input-group">
				<input type="text" name="search" class="form-control" placeholder="Cari..."
					value="{{ request('search') }}">
				<button class="btn btn-outline-primary bi bi-search" type="submit"></button>
			</div>
		</form>

		<!-- Hasil Search -->
		@if (request('search'))
			<div class="alert alert-info">
				Hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
			</div>
		@endif
	</div>


	<div class="mb-3 d-flex justify-content-between align-items-center">

		<!-- Jumlah Entri -->
		<form action="{{ route('users.index') }}" method="GET" class="d-flex align-items-center ms-3">
			<!-- Tetap Membawa Paarameter Pencarian -->
			<input type="hidden" name="search" value="{{ request('search') }}">

			<label for="entries" class="me-2 text-nowrap">Tampilkan</label>
			<select name="entries" id="entries" class="form-select w-auto" onchange="this.form.submit()">
				@foreach ([5, 10, 25, 50] as $size)
					<option value="{{ $size }}" {{ request('entries', 5) == $size ? 'selected' : '' }}>
						{{ $size }}
					</option>
				@endforeach
			</select>
			<span class="ms-2 text-nowrap">entri</span>
		</form>

		<a href="{{ route('users.create') }}" class="btn btn-primary bi bi-plus">Tambah User Baru</a>
	</div>

	<!-- Tabel Data -->
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover align-middle">
			<thead>
				<tr>
					<th>No</th>
					<th>Role</th>
					<th>Username</th>
					<th>Nama</th>
					<th>Email</th>
					<th>Gambar</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($users as $user)
					<tr>
						<td>{{ $loop->iteration + $users->firstItem() - 1 }}</td>
						<td>
							@if ($user->role == 1)
								<span class="badge bg-danger">Admin</span>
							@elseif ($user->role == 2)
								<span class="badge bg-secondary">User</span>
							@else
								<span class="badge bg-dark">Unknown</span>
							@endif
						</td>
						<td>{{ $user->username }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>
							@if ($user->photo)
								<img src="{{ asset('photos/' . $user->photo) }}" alt="{{ $user->name }}"
									width="100" class="img-thumbnail">
							@else
								<small class="text-muted">Tidak ada gambar</small>
							@endif
						</td>
						<td class="text-start">
							<a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm me-1 bi bi-eye"></a>
							<a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm me-1 bi bi-pencil-square"></a>
							<form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
								@csrf
								@method('DELETE')
								<button type="submit" onclick="return confirm('Yakin ingin hapus?')"
									class="btn btn-danger btn-sm bi bi-trash"></button>
							</form>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="7" class="text-center text-muted">Tidak ada data user</td>
					</tr>
				@endforelse
			</tbody>
		</table>

		<!-- Pagination dan Keterangan Show Entries -->
		<div class="d-flex justify-content-end align-items-center mt-3 flex-wrap gap-2">
			<div>
				{{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
			</div>
		</div>
	</div>

@endsection
