@extends('layouts.public')

@section('title', $post->title)

@section('content')
<div class="container my-5">
    <a href="{{ route('posts.public') }}" class="btn btn-secondary mb-3">← Kembali ke Blog</a>

    <article class="card shadow-sm border-0">
        @if($post->image)
            <img src="{{ asset('images/' . $post->image) }}" class="card-img-top" style="max-height:450px; object-fit:cover;" alt="{{ $post->title }}">
        @endif
        <div class="card-body">
            <h1 class="card-title fw-bold mb-3">{{ $post->title }}</h1>
            <p class="text-muted small">
                <i class="bi bi-person-circle"></i> {{ $post->user?->name ?? 'Anonim' }} &nbsp;|&nbsp;
                <i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($post->publish_date)->translatedFormat('d F Y') }}
            </p>
            <div class="fs-6 lh-lg">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>
    </article>
</div>
@endsection
