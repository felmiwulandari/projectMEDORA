@extends('layouts.app')

@section('title', 'Dashboard Page')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Halaman Dashboard</h1>
    </div>

    <div class="mb-4">
        <h4 class="text-gray-800">Selamat datang, <span class="text-primary">Admin!</span></h4>
        <p class="text-gray-600">
            Kelola data dan pasien dengan mudah melalui Dashboard MEDORA.
        </p>
    </div>

    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pendaftaran Menunggu
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                0
                            </div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pendaftaran Dikonfirmasi
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                0
                            </div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pasien
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                0
                            </div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> 
@endsection