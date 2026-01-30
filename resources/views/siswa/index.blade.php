@extends('layouts.back')

@section('title', 'Siswa')

@section('breadcrumb')
    <li class="breadcrumb-item active">Siswa</li>
@endsection

@section('content')
    <div class="card stat-card">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-person-vcard me-2"></i>Daftar Siswa
                </h5>
                <a href="{{ url('/siswa/tambah') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Siswa
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="col-12 col-sm-8 col-md-4 mb-3">
                <label for="" class="mb-2">Cari Data</label>
                <form action="{{ url('/siswa') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control ml-2" name="cari"
                            placeholder="Nama siswa, kelas, dan jurusan." required>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Cari</button>
                        <a href="{{ url('/siswa') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() > 0)
                            @foreach ($data as $datum)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}
                                    </td>
                                    <td>{{ $datum->nama }}</td>
                                    <td>{{ $datum->kelas }}</td>
                                    <td>{{ $datum->jurusan }}</td>
                                    <td>{{ $datum->jenis_kelamin }}</td>
                                    <td>{{ $datum->tempat_lahir }}</td>
                                    <td>{{ $datum->tanggal_lahir->isoFormat('D MMMM Y') }}</td>
                                    <td>{{ $datum->alamat }}</td>
                                    <td>
                                        <center>
                                            <img src="{{ asset('foto_siswa/' . $datum->foto) }}"
                                                alt="foto  {{ $datum->nama }}" class="img-thumbnail" style="width: 20%;">
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ url('/siswa/edit/' . $datum->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <a href="{{ url('/siswa/hapus/' . $datum->id) }}"
                                                class="btn btn-danger my-2">Hapus</a>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $data->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
