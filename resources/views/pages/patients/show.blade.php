@extends('layouts.app')

@section('title', 'Patient detail')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">PATIENT DETAIL</h1>
        <a href="{{ route('pages.patient.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Informasi Lengkap Pasien</h6>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <tr>
                    <th width="30%">Nama </th>
                    <td>{{ $patient->nama }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $patient->nik }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $patient->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th>Jenis kelamin</th>
                    <td>{{ $patient->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>No HP</th>
                    <td>{{ $patient->no_hp }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $patient->alamat }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
