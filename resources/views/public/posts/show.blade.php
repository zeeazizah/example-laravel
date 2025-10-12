@extends('layouts.public')

@section('title', $post->title)

@section('content')
<div class="container my-5">
    {{-- Tombol kembali --}}
    <a href="{{ route('posts.public') }}" class="btn btn-secondary mb-4">
        <i class=""></i> Kembali ke Blog
    </a>

    {{-- Artikel --}}
    <article class="card shadow-sm border-0">
        @if($post->image)
            <img src="{{ asset('images/' . $post->image) }}"
                 class="card-img-top"
                 style="max-height:450px; object-fit:cover;"
                 alt="{{ $post->title }}">
        @endif

        <div class="card-body px-4 py-4">
            {{-- Judul --}}
            <h1 class="card-title fw-bold mb-3 text-dark">{{ $post->title }}</h1>

            {{-- Info penulis dan tanggal --}}
            <p class="text-muted small mb-4">
                <i class="bi bi-person-circle"></i>
                {{ $post->user?->name ?? 'Anonim' }}
                &nbsp;|&nbsp;
                <i class="bi bi-calendar-event"></i>
                {{ \Carbon\Carbon::parse($post->publish_date)->translatedFormat('d F Y') }}
            </p>

            {{-- Isi konten --}}
            <div class="fs-6 lh-lg text-secondary">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>
    </article>
</div>
@endsection
