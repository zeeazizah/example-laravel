@extends('layouts.public') {{-- layout publik tanpa sidebar --}}

@section('title', 'Post')


@section('content')
<div class="container my-5">

	<h2>Post</h2>

    {{-- Form Pencarian --}}
    <form method="GET" action="{{ route('posts.public') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control"
                   placeholder="Cari.."
                   value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
    </form>

    <div class="row g-4">
			@forelse($posts as $post)
				<div class="col-md-4 mb-4">
					<div class="card h-100 shadow-sm d-flex flex-column">
						@if($post->image)
							<img src="{{ asset('images/' . $post->image) }}"
								class="card-img-top"
								style="height:200px; object-fit:cover;"
								alt="{{ $post->title }}">
						@endif

						<div class="card-body d-flex flex-column">
							<h5 class="card-title mb-2">{{ $post->title }}</h5>
							<p class="card-text text-muted small mb-3">
								{{ $post->user?->name ?? 'Penulis Anonim' }} <br>
								<span class="text-secondary">
									{{ \Carbon\Carbon::parse($post->publish_date)->format('d M Y') }}
								</span>
							</p>

							{{-- Spacer agar tombol selalu di bawah --}}
							<div class="mt-auto">
								<a href="{{ route('posts.public.show', $post->id) }}" class="btn btn-primary btn-sm w-100">
									Baca Selengkapnya
								</a>
							</div>
						</div>
					</div>
				</div>
			@empty

            <div class="col-12">
                <p class="text-center">
                    @if(request('search'))
                        Tidak ada artikel ditemukan untuk kata kunci:
                        <strong>"{{ request('search') }}"</strong>.
                    @else
                        Belum ada post yang diterbitkan.
                    @endif
                </p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
