@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-5">

    {{-- Header --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary mb-2">Selamat Datang 👋</h1>
        <p class="text-muted fs-5">
            Kelola <span class="fw-semibold text-dark">Postingan</span> dan, jika Anda Admin, <span class="fw-semibold text-dark">Pengguna</span> di sini.
        </p>
    </div>

    {{-- Main Dashboard --}}
    <div class="row justify-content-center g-4">

        {{-- Card: Post --}}
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-4 h-100 hover-shadow">
                <div class="card-body text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-journal-text display-4 text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-2">Kelola Post</h4>
                    <p class="text-muted mb-4">
                        Buat, ubah, dan kelola semua postingan blog kamu dengan mudah.
                    </p>
                    <a href="{{ route('posts.index') }}" class="btn btn-primary px-4 rounded-pill">
                        <i class="bi bi-arrow-right-circle me-1"></i> Lihat Post
                    </a>
                </div>
            </div>
        </div>

        {{-- Card: User (Hanya untuk Admin) --}}
        @if (Auth::user() && Auth::user()->role == 1)
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-4 h-100 hover-shadow">
                <div class="card-body text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-people display-4 text-success"></i>
                    </div>
                    <h4 class="fw-bold mb-2">Kelola User</h4>
                    <p class="text-muted mb-4">
                        Lihat dan atur data pengguna yang terdaftar di sistem kamu.
                    </p>
                    <a href="{{ route('users.index') }}" class="btn btn-success px-4 rounded-pill">
                        <i class="bi bi-arrow-right-circle me-1"></i> Lihat User
                    </a>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection

@push('styles')
<style>
.hover-shadow:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
    box-shadow: 0 0.75rem 1.25rem rgba(0,0,0,0.15) !important;
}
</style>
@endpush
