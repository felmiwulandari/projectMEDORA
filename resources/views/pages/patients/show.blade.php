@extends('layouts.app')

@section('title', 'Patient page')

@section('content')
    <div class="container py-4">
        <h1 class="page-title mb-3">Patient Details!</h1>
            <table class="table table-striped">
                <tr>
                    <th width="200px">ID</th>
                    <td>{{ $patient->id }}</td>
                </tr>

                <tr>
                    <th width="200px">Name</th>
                    <td>{{ $patient->name }}</td>
                </tr>

                <tr>
                    <th width="200px">NIK</th>
                    <td>{{ $patient->nik }}</td>
                </tr>

                <tr>
                    <th width="200px">Tanggal Lahir</th>
                    <td>{{ $patient->tanggal_lahir }}</td>
                </tr>

                <tr>
                    <th width="200px">Jenis Kelamin</th>
                    <td>{{ $patient->jenis_kelamin }}</td>
                </tr>

                <tr>
                    <th width="200px">No Hp</th>
                    <td>{{ $patient->no_hp }}</td>
                </tr>

                <tr>
                    <th width="200px">Alamat</th>
                    <td>{{ $patient->alamat }}</td>
                </tr>

                <tr>
                    <th width="200px">Terdaftar pada</th>
                    <td>{{ \Carbon\Carbon::parse($patient->created_at)->isoFormat('DD MMMM Y HH:mm:ss') }}</td>
                </tr>
                <tr>
                    <th width="200px">Diperbarui pada</th>
                    <td>{{ \Carbon\Carbon::parse($patient->updated_at)->isoFormat('DD MMMM Y HH:mm:ss')  }}</td>
                </tr>
            </table>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.patient.index') }}" class="btn btn-primary mr-2">
                    Kembali
                </a>
            </div>
    </div>
    
@endsection