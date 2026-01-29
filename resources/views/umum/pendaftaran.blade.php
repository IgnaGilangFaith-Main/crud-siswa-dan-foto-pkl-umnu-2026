@extends('layouts.front')
@section('title', 'Pendaftaran Siswa Baru')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Form Pendaftaran Siswa Baru</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('/pendaftaran/simpan') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- Nama --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        name="nama" value="{{ old('nama') }}" placeholder="Contoh: John Doe">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kelas --}}
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas"
                        name="kelas" rows="5" placeholder="Contoh: TI10F" value="{{ old('kelas') }}">
                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jurusan --}}
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan"
                        name="jurusan" value="{{ old('jurusan') }}" placeholder="Contoh: Teknik Informatika">
                    @error('jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jenis Kelamin --}}
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" id="jenis_kelamin"
                        class="form-select @error('jenis_kelamin') is-invalid @enderror">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tempat Lahir --}}
                <div class="mb-4">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir"
                        name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Contoh: Indonesia">
                    @error('tempat_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tanggal Lahir --}}
                <div class="mb-4">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                        id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-4">
                    <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                        name="alamat" value="{{ old('alamat') }}" placeholder="Contoh: Indonesia">
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Foto --}}
                <div class="mb-4">
                    <label for="foto" class="form-label">Foto <span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                        name="foto">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="my-2">
                    <center>
                        <a href="{{ url('/') }}" class="btn btn-secondary mx-2">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success mx-2">
                            <i class="bi bi-save me-1"></i> Daftar
                        </button>
                    </center>
                </div>
            </form>
        </div>
    </div>

@endsection
