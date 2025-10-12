@extends('layouts.app')

@section('title', 'Buat Post Baru')
@section('header-title', 'Buat Post Baru')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Form Buat Post Baru</h5>
                </div>
                <div class="card-body">
                    <!-- Flash Message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Form Input -->
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Judul -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}"
                                placeholder="Masukkan judul postingan..."
                                required>
                            @error('title')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Publish -->
                        <div class="mb-3">
                            <label for="publish_date" class="form-label">Tanggal Publish <span class="text-danger">*</span></label>
                            <input
                                type="date"
                                id="publish_date"
                                name="publish_date"
                                class="form-control @error('publish_date') is-invalid @enderror"
                                value="{{ old('publish_date', now()->format('Y-m-d')) }}"
                                required>
                            @error('publish_date')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konten -->
                        <div class="mb-3">
                            <label for="content" class="form-label">Konten <span class="text-danger">*</span></label>
                            <textarea
                                id="content"
                                name="content"
                                rows="6"
                                class="form-control @error('content') is-invalid @enderror"
                                placeholder="Tulis konten di sini..."
                                required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar <span class="text-danger">*</span></label>
                            <input
                                type="file"
                                id="image"
                                name="image"
                                class="form-control @error('image') is-invalid @enderror"
                                accept="image/*">
                            @error('image')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                                Batal
                            </a>
                            <button type="submit" name="action" value="draft" class="btn btn-warning text-black">
                                Simpan Draf
                            </button>
                            <button type="submit" name="action" value="publish" class="btn btn-primary">
                                Terbitkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
