@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Halaman Post')

@section('header-title', 'Halaman Post')

@section('content')

    {{-- Notifikasi sukses / error --}}
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

    {{-- Form Pencarian --}}
    <div class="container my-3">
        <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari judul atau penulis..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">Cari</button>
            </div>
        </form>
    </div>

	<div class="mb-3 d-flex justify-content-between align-items-center">
		<h4 class="mb-0">Daftar Post</h4>
		@auth
			<a href="{{ route('posts.create') }}" class="btn btn-primary">
				Tambah Post
			</a>
		@endauth
	</div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col" style="width: 50px;">No</th>
                    <th scope="col" style="max-width: 250px;">Judul</th>
                    <th scope="col" style="width: 150px;">Penulis</th>
                    <th scope="col" style="width: 160px;">Tanggal Publish</th>
                    <th scope="col" style="width: 100px;">Status</th>
                    <th scope="col" style="width: 120px;">Gambar</th>
                    <th scope="col" style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration + ($posts->currentPage() - 1) * $posts->perPage() }}</td>
                        <td class="text-truncate" style="max-width: 250px;" title="{{ $post->title }}">
                            {{ $post->title }}
                        </td>
                        <td>{{ $post->user?->name ?? '-' }}</td>
                        <td>{{ $post->publish_date ?? '-' }}</td>
                        <td>
                            @if ($post->is_publish)
                                <span class="badge bg-success">Publish</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>
                            @if ($post->image)
                                <img src="{{ asset('images/' . $post->image) }}"
                                     alt="{{ $post->title }}" width="100" class="img-thumbnail">
                            @else
                                <small class="text-muted">Tidak ada gambar</small>
                            @endif
                        </td>
                        <td class="text-start" style="white-space: nowrap;">
                            {{-- Tombol Detail --}}
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm me-1">
                                Detail
                            </a>

                            {{-- Tombol Edit --}}
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm me-1">
                                Edit
                            </a>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Yakin ingin hapus post ini?')"
                                    class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Tidak ada data post
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-start mt-3">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection

@push('scripts')
@endpush
