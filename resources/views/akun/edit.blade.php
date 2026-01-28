@extends('layouts.back')

@section('title', 'Edit Akun')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/akun') }}">Pengaturan Akun</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card stat-card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>Edit Akun
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('/akun/update/' . $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $data->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Contoh: john.doe@example.com"
                                value="{{ old('email', $data->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <header>
                            <h4>Edit Password</h4>
                            <p>
                                Silakan isikan password baru, jika hendak melakukan perubahan password. Biarkan tetap
                                kosong jika tidak ingin melakukan perubahan password.
                            </p>
                        </header>
                        <div class="mb-3 position-relative">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                    value="{{ old('new_password') }}" name="new_password" id="new_password">
                                <button class="btn btn-outline-secondary toggle-password" type="button"
                                    data-target="#new_password">
                                    <i class="bi bi-eye"></i>
                                </button>
                                @error('new_password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                    value="{{ old('new_password_confirmation') }}">
                                <button class="btn btn-outline-secondary toggle-password" type="button"
                                    data-target="#new_password_confirmation">
                                    <i class="bi bi-eye"></i>
                                </button>
                                @error('new_password_confirmation')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                            <a href="{{ url('/akun') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Info Card --}}
        <div class="col-lg-4 my-3 my-lg-0">
            <div class="card stat-card">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0">
                        <i class="bi bi-info-circle me-2"></i>Informasi
                    </h6>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> Field bertanda <span class="text-danger">*</span> wajib diisi.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.toggle-password').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const target = document.querySelector(this.getAttribute('data-target'));
                if (target.type === 'password') {
                    target.type = 'text';
                    this.querySelector('i').classList.remove('bi-eye');
                    this.querySelector('i').classList.add('bi-eye-slash');
                } else {
                    target.type = 'password';
                    this.querySelector('i').classList.remove('bi-eye-slash');
                    this.querySelector('i').classList.add('bi-eye');
                }
            });
        });
    </script>
@endpush
