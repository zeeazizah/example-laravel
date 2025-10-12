@extends('layouts.public')

@section('title', 'Pratinjau: ' . $post->title)

@section('content')
<div class="container-fluid my-5 px-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            <!-- Tombol Kembali & Edit -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                @auth
                    @if (Auth::id() == $post->user_id || Auth::user()->role == 1)
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary text-white">
                            Edit
                        </a>
                    @endif
                @endauth
            </div>

            <article class="card border-0 shadow-sm w-100">
                <!-- Gambar Utama -->
                @if ($post->image)
                    <img src="{{ asset('images/' . $post->image) }}"
                         alt="{{ $post->title }}"
                         class="w-100 rounded-top"
                         style="max-height: 450px; object-fit: cover;">
                @endif

                <div class="card-body p-4 p-md-5">
                    <!-- Judul -->
                    <h1 class="card-title fw-bold mb-3 fs-3">
                        {{ $post->title }}
                    </h1>

                    <!-- Metadata -->
                    <div class="mb-4 text-muted small d-flex flex-wrap gap-3">
                        <span>
                            <i class="bi bi-person-circle me-1"></i>
                            {{ $post->user?->name ?? 'Anonim' }}
                        </span>
                        <span>
                            <i class="bi bi-calendar-event me-1"></i>
                            {{ $post->publish_date ? \Carbon\Carbon::parse($post->publish_date)->translatedFormat('d F Y') : '-' }}
                        </span>
                        <span>
                            <i class="bi bi-tag me-1"></i>
                            <span class="badge {{ $post->is_publish ? 'bg-success' : 'bg-secondary' }}">
                                {{ $post->is_publish ? 'Publish' : 'Draft' }}
                            </span>
                        </span>
                    </div>

                    <!-- Isi konten -->
                    <div class="article-content lh-lg fs-6">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@endsection
