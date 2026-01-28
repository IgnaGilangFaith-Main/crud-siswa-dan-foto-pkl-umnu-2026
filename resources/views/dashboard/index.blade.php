@extends('layouts.back')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-sm-6 col-xl-6">
            <a href="{{ url('/siswa') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-opacity-10">
                                <i class="bi bi-person-vcard"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0">Daftar Siswa</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-xl-6">
            <a href="{{ url('/akun') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-opacity-10">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0">Data Akun</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
