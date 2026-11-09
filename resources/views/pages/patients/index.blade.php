
@extends('layouts.app')

@section('title', 'Patient page')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Patient page</h1>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">Data Patient</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover datatable" style="min-width: 900px;">
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
                        @foreach ($patients as $patient)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
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
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">

    <style>
        @media (max-width: 767px) {
            .dataTables_wrapper .row:first-child {
                display: flex;
                align-items: center;
                flex-wrap: nowrap;
            }

            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                width: 50%;
                text-align: left;
                padding: 0 5px;
            }

            .dataTables_wrapper .dataTables_filter input {
                width: 90px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
@endpush
