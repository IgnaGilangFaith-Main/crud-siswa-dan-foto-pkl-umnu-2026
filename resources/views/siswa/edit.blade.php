@extends('layouts.back')

@section('title', 'Edit Siswa')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/siswa') }}">Daftar Siswa</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card stat-card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>Edit Data Siswa
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('/siswa/update/' . $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama', $data->nama) }}" placeholder="Contoh: John Doe">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kelas --}}
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas"
                                name="kelas" rows="5" placeholder="Contoh: TI10F"
                                value="{{ old('kelas', $data->kelas) }}">
                            @error('kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jurusan --}}
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan"
                                name="jurusan" value="{{ old('jurusan', $data->jurusan) }}"
                                placeholder="Contoh: Teknik Informatika">
                            @error('jurusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span
                                    class="text-danger">*</span></label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                data-placeholder="Pilih Jenis Kelamin">
                                <option value="Laki-laki" {{ $data->jenis_kelamin == 'Laki-laki' ? 'selected' : null }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ $data->jenis_kelamin == 'Perempuan' ? 'selected' : null }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tempat Lahir --}}
                        <div class="mb-4">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                id="tempat_lahir" name="tempat_lahir"
                                value="{{ old('tempat_lahir', $data->tempat_lahir) }}" placeholder="Contoh: Indonesia">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="mb-4">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                id="tanggal_lahir" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $data->tanggal_lahir->format('Y-m-d')) }}">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-4">
                            <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                name="alamat" value="{{ old('alamat', $data->alamat) }}" placeholder="Contoh: Indonesia">
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Foto --}}
                        @isset($data->foto)
                            <img src="{{ asset('foto_siswa' . '/' . $data->foto) }}" alt="foto {{ $data->nama }}"
                                class="img-thumbnail" style="width: 20%;">
                        @endisset
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Siswa</label>
                            <input type="file" name="foto" id="foto"
                                class="form-control @error('foto') is-invalid @enderror" value="{{ old('foto') }}">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                            <a href="{{ url('/siswa') }}" class="btn btn-secondary">
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
