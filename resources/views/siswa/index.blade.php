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
            @if ($data->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-person-vcard text-muted" style="font-size: 4rem;"></i>
                    <h5 class="mt-3 text-muted">Belum ada siswa</h5>
                    <p class="text-muted">Silakan tambahkan siswa yang ingin Anda daftarkan.</p>
                    <a href="{{ url('/siswa/tambah') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Siswa
                    </a>
                </div>
            @else
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
                        </tbody>
                    </table>
                    {{ $data->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
