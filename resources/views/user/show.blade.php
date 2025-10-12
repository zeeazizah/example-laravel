@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Detail User')

@section('header-title', 'Detail User')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body text-center bg-white pt-5 pb-4">

                    {{-- Foto Profil --}}
                    @if ($user->photo)
                        <div class="d-flex justify-content-center mb-3">
                            <img src="{{ asset('photos/' . $user->photo) }}"
                                 alt="{{ $user->name }}"
                                 class="rounded-circle border border-3 border-white shadow"
                                 style="width: 150px; height: 150px; object-fit: cover; object-position: center;">
                        </div>
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light border rounded-circle mx-auto mb-3 shadow-sm"
                             style="width: 150px; height: 150px;">
                            <i class="bi bi-person fs-1 text-secondary"></i>
                        </div>
                    @endif

                    <!-- Nama -->
                    <h4 class="fw-bold mb-0">
                        {{ $user->name }}
                        @if ($user->role == 1)
                            <i class="bi bi-patch-check-fill text-primary ms-1" title="Verified"></i>
                        @endif
                    </h4>


                    <hr class="my-4">

                    <!-- Data lengkap -->
                    <div class="text-start">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <tbody>
                                    <tr>
                                        <th class="text-muted" width="30%">ID</th>
                                        <td>{{ $user->id }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Username</th>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Role</th>
                                        <td>
                                            @if ($user->role == 1)
                                                <span class="badge bg-danger">Admin</span>
                                            @else
                                                <span class="badge bg-secondary">User</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Nama</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Email</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Dibuat Pada</th>
                                        <td>{{ $user->created_at->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Terakhir Diperbarui</th>
                                        <td>{{ $user->updated_at->format('d M Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="text-end mt-4">
						<a href="{{ route('users.index') }}" class="btn btn-secondary">
                            <i class="left me-1"></i> Kembali
                        </a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary me-2">
                            <i class=" me-1"></i> Edit
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
