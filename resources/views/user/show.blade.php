@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Detail User')

@section('header-title', 'Detail User')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card shadow-sm border-0">
					<div class="card-header bg-primary text-white">
						<h5 class="mb-0">Detail User</h5>
					</div>
					<div class="card-body">
						<p><strong>ID:</strong> {{ $user->id }}</p>
						<p><strong>Username:</strong> {{ $user->username }}</p>
						<p><strong>Nama:</strong> {{ $user->name }}</p>
						<p><strong>Email:</strong> {{ $user->email }}</p>
						<p><strong>Gambar:</strong></p>
						@if ($user->photo)
							<img src="{{ asset('photos/' . $user->photo) }}" alt="{{ $user->name }}" width="100">
						@else
							Tidak ada gambar
						@endif
					</div>
					<div class="card-footer text-end">
						<a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
@endpush
