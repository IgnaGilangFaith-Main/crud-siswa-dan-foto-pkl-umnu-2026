@extends('layouts.back')

@section('title', 'Hapus Siswa')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/siswa') }}">Daftar Siswa</a></li>
    <li class="breadcrumb-item active">Hapus</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card stat-card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus Data
                    </h5>
                </div>
                <div class="card-body">
                    {{-- Preview Data --}}
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <div>
                            Apakah Anda yakin ingin menghapus data siswa ini? Data yang sudah dihapus tidak dapat
                            dikembalikan.
                        </div>
                    </div>

                    <div class="my-4">
                        <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td> : </td>
                                <td>{{ $data->nama }}</td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td> : </td>
                                <td>{{ $data->kelas }}</td>
                            </tr>
                            <tr>
                                <td>Jurusan</td>
                                <td> : </td>
                                <td>{{ $data->jurusan }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td> : </td>
                                <td>{{ $data->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <td>Tempat Lahir</td>
                                <td> : </td>
                                <td>{{ $data->tempat_lahir }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td> : </td>
                                <td>{{ $data->tanggal_lahir->isoFormat('D MMMM Y') }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td> : </td>
                                <td>{{ $data->alamat }}</td>
                            </tr>
                            <tr>
                                <td>Foto</td>
                                <td> : </td>
                                <td>
                                    <img src="{{ asset('foto_siswa/' . $data->foto) }}" alt="Foto {{ $data->nama }}"
                                        style="max-width: 100px;">
                                </td>
                            </tr>
                        </table>
                    </div>
                    {{-- Action Buttons --}}
                    <div class="d-flex gap-2 justify-content-center mb-4">
                        <a href="{{ url('/siswa') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <form action="{{ url('/siswa/destroy/' . $data->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i> Ya, Hapus Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
