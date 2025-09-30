@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Halaman Home')

@section('header-title', 'Home')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body text-center p-5">
                    <h1 class="display-4 fw-bold text-primary mb-4">Selamat Datang 👋</h1>
                    <p class="lead text-muted mb-4">
                        Belajar <span class="fw-semibold text-dark">Blade Template Engine</span> di Laravel dengan gaya modern.
                    </p>
                    <a href="{{ route('users.index') }}" class="btn btn-lg btn-primary px-4">
                        Lihat Data User
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-lg btn-outline-secondary px-4 ms-2">
                        Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
