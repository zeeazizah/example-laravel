@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Edit Post')
@section('header-title', 'Edit Post')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Post</h4>
                </div>

                <div class="card-body p-4 bg-light">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Judul -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Judul</label>
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $post->title) }}"
                                   placeholder="Masukkan judul"
                                   required>
                            @error('title')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Publish -->
                        <div class="mb-3">
                            <label for="publish_date" class="form-label fw-semibold">Tanggal Publish</label>
                            <input type="date"
                                   class="form-control @error('publish_date') is-invalid @enderror"
                                   id="publish_date"
                                   name="publish_date"
                                   value="{{ old('publish_date', $post->publish_date ? \Carbon\Carbon::parse($post->publish_date)->format('Y-m-d') : now()->format('Y-m-d')) }}"
                                   required>
                            @error('publish_date')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konten -->
                        <div class="mb-3">
                            <label for="content" class="form-label fw-semibold">Konten</label>
                            <textarea class="form-control @error('content') is-invalid @enderror"
                                      id="content"
                                      name="content"
                                      rows="6"
                                      placeholder="Tulis konten di sini..."
                                      required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">Gambar</label>
                            @if ($post->image)
                                <div class="mb-3 text-center">
                                    <img src="{{ asset('images/' . $post->image) }}"
                                         alt="{{ $post->title }}"
                                         class="img-fluid rounded shadow-sm border"
                                         style="max-height: 250px; object-fit: cover;">
                                </div>
                            @endif
                            <input type="file"
                                   class="form-control @error('image') is-invalid @enderror"
                                   id="image"
                                   name="image"
                                   accept="image/*">
                            @error('image')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" name="action" value="draft" class="btn btn-warning text-white px-4">
                                <i class="bi bi-save me-1"></i> Simpan Draf
                            </button>
                            <button type="submit" name="action" value="publish" class="btn btn-primary px-4">
                                <i class="bi bi-upload me-1"></i> Terbitkan
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
