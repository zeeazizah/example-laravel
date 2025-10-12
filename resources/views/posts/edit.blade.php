@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Edit Post')
@section('header-title', 'Edit Post')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Form Edit Post</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Judul -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $post->title) }}"
                                placeholder="Masukkan judul"
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
                                value="{{ old('publish_date', $post->publish_date ? \Carbon\Carbon::parse($post->publish_date)->format('Y-m-d') : now()->format('Y-m-d')) }}"
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
                                required>{{ old('content', $post->content) }}</textarea>
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

                            @if($post->image)
                                <div class="mt-2">
                                    <img src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}" width="150" class="img-thumbnail">
                                </div>
                            @endif
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
                                Simpan & Terbitkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
