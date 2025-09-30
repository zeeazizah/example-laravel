@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Halaman User')

@section('header-title', 'Halaman User')

@section('content')

	@if (session('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			{{ session('success') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	@endif

	@if (session('error'))
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			{{ session('error') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>

	@endif

    <div class="mb-3">
        <h4 class="mb-2">Daftar User</h4>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            Tambah User
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
					<th scope="col">Gambar</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
						<td>
							@if ($user->photo)
								<img src="{{ asset('photos/' . $user->photo) }}" alt="{{ $user->name }}" width="100">
							@else
								Tidak ada gambar
							@endif
						</td>


                        <td class="text-start">
                            <!-- Tombol Edit -->
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm me-1">
                                Edit
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Yakin ingin hapus?')"
                                    class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Tidak ada data user
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
		<div class="d-flex justify-content-start mt-3">
			{{ $users->links('pagination::bootstrap-5') }}
		</div>
    </div>

@endsection

@push('scripts')
@endpush
