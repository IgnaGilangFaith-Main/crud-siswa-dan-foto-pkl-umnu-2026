@extends('layouts.front')
@section('title', 'Homepage')
@section('content')
    <h1 class="text-center">Selamat Datang di Sistem Pendaftaran Kursus Siswa Baru</h1>
    <div class="row mt-4">
        <div class="col-12 col-lg-12 mb-3" data-aos="flip-left">
            <div class="card shadow">
                <center>
                    <img src="{{ asset('img/pkl-umnu-2026.png') }}" alt="gambar pkl umnu 2026"
                        class="card-img-top img-post mt-3" style="width: 50%">
                </center>
                <div class="card-body">
                    <div class="card-text">
                        <center>
                            <h2>Daftar Kursus</h2>
                            <table>
                                <tr>
                                    <td>
                                        <h4>1. PKL Pemrograman</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4>2. PKL Komputer</h4>
                                    </td>
                                </tr>
                            </table>
                            <a href="{{ url('/pendaftaran') }}" class="btn btn-primary mt-2">Daftar Sekarang!</a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
