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
                            <label for="title" class="form-label">Judul</label>
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $post->title) }}"
                                   placeholder="Masukkan judul"
                                   required>
                            @error('title')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Publish -->
                        <div class="mb-3">
                            <label for="publish_date" class="form-label">Tanggal Publish</label>
                            <input type="date"
                                   class="form-control @error('publish_date') is-invalid @enderror"
                                   id="publish_date"
                                   name="publish_date"
                                   value="{{ old('publish_date', $post->publish_date ? \Carbon\Carbon::parse($post->publish_date)->format('Y-m-d') : '') }}"
                                   required>
                            @error('publish_date')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konten -->
                        <div class="mb-3">
                            <label for="content" class="form-label">Konten</label>
                            <textarea class="form-control @error('content') is-invalid @enderror"
                                      id="content"
                                      name="content"
                                      rows="5"
                                      placeholder="Tulis konten di sini..."
                                      required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            @if ($post->image)
                                <div class="mb-2">
                                    <img src="{{ asset('images/' . $post->image) }}"
                                         alt="{{ $post->title }}"
                                         class="img-thumbnail shadow-sm"
                                         width="200">
                                </div>
                            @endif
                            <input type="file"
                                   class="form-control @error('image') is-invalid @enderror"
                                   id="image"
                                   name="image"
                                   accept="image/*">
                            @error('image')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol -->
						<div class="d-flex justify-content-end gap-2">
							<a href="{{ route('posts.index') }}" class="btn btn-danger">Batal</a>
							<button type="submit" name="action" value="draft" class="btn btn-secondary text-white">
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

@push('scripts')
@endpush
