@extends('layouts.app')

@section('title', 'Buat Post Baru')
@section('header-title', 'Buat Post Baru')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Buat Post Baru</h5>
                    <a href="{{ route('posts.index') }}" class="btn btn-light btn-sm text-primary">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    {{-- Flash Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title"
                                   value="{{ old('title') }}"
                                   placeholder="Masukkan judul postingan..."
                                   required>
                            @error('title')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tanggal Publish --}}
                        <div class="mb-3">
                            <label for="publish_date" class="form-label">Tanggal Publish</label>
                            <input type="date"
                                   class="form-control @error('publish_date') is-invalid @enderror"
                                   id="publish_date"
                                   name="publish_date"
                                   value="{{ old('publish_date', now()->format('Y-m-d')) }}"
                                   required>
                            @error('publish_date')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Konten --}}
                        <div class="mb-3">
                            <label for="content" class="form-label">Konten</label>
                            <textarea class="form-control @error('content') is-invalid @enderror"
                                      id="content"
                                      name="content"
                                      rows="7"
                                      placeholder="Tulis konten di sini..."
                                      required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Gambar --}}
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar (Opsional)</label>
                            <input type="file"
                                   class="form-control @error('image') is-invalid @enderror"
                                   id="image"
                                   name="image"
                                   accept="image/*">
                            @error('image')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                                Batal
                            </a>
                            <button type="submit" name="action" value="draft" class="btn btn-outline-primary">
                                Simpan Draft
                            </button>
                            <button type="submit" name="action" value="publish" class="btn btn-primary">
                                Publish Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
