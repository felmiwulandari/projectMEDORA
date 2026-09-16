@extends('layouts.app')

@section('title', 'Admin page')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Patient page</h1>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">Data Patient</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>NIK</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>No Hp</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($patients as $patient )
                        <tr>
                            <td>{{ $patient->id }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->nik }}</td>
                            <td>{{ $patient->tanggal_lahir }}</td>
                            <td>{{ $patient->jenis_kelamin }}</td>
                            <td>{{ $patient->no_hp }}</td>
                            <td>{{ $patient->alamat }}</td>
                            <td>
                                <a href="{{ route('admin.patient.show', encrypt($patient->id)) }}"
                                     class="btn btn-link text-secondary p-0 mx-2">
                                     <span class="fa fa-search"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection