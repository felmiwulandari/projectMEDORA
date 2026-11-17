@extends('layouts.app')

@section('title', 'Registration Page')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4 px-3 pt-3">
        <h1 class="h3 mb-0 text-gray-800">Registration Page</h1>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">Data Registration</h5>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Pasien</th>
                            <th>Spesialis</th>
                            <th>Nama Dokter</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Keluhan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($registrations as $registration)
                            <tr>
                                <td>{{ $loop->iteration }}</td> <!-- Nomor urut -->
                                <td>{{ $registration->patient->name ?? 'Tidak ditemukan' }}</td>
                                <td>{{ $registration->schedule->doctor->specialist->name ?? '-' }}</td>
                                <td>{{ $registration->schedule->doctor->name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($registration->schedule->jam_mulai)->format('H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($registration->schedule->jam_selesai)->format('H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($registration->tanggal_daftar)->format('d-m-Y') }}</td>
                                <td>
                                    @if ($registration->status == 'menunggu')
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($registration->status == 'dikonfirmasi')
                                        <span class="badge badge-success">Di Konfirmasi</span>
                                    @elseif($registration->status == 'ditolak')
                                        <span class="badge badge-danger">Di Tolak</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($registration->keluhan, 20) }}</td>
                                <td>
                                    {{-- DETAIL --}}
                                    <a href="{{ route('admin.registration.show', encrypt($registration->id)) }}"
                                        class="btn btn-link text-secondary p-0 mx-2">
                                        <span class="fa fa-search"></span>
                                    </a>

                                    {{-- TOMBOL TERIMA --}}
                                    @if ($registration->status == 'menunggu')
                                        <form
                                            action="{{ route('admin.registration.approve', encrypt($registration->id)) }}"
                                            method="POST" class="d-inline form-approve">
                                            @csrf
                                            <button type="button" class="btn btn-link text-success p-0 mx-2 btn-approve">
                                                <span class="fa fa-check-circle"></span>
                                            </button>
                                        </form>
                                    @endif
                                    {{-- TOMBOL TOLAK --}}
                                    @if ($registration->status == 'menunggu')
                                        <form action="{{ route('admin.registration.reject', encrypt($registration->id)) }}"
                                            method="POST" class="d-inline form-reject">
                                            @csrf
                                            <button type="button" class="btn btn-link text-danger p-0 mx-2 btn-reject">
                                                <span class="fa fa-times-circle"></span>
                                            </button>
                                        </form>
                                    @endif
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
            // DataTable 
            $(".datatable").DataTable();

            // SweetAlert KONFIRMASI 
           $(document).on('click', '.btn-approve', function () {
                let form = $(this).closest('form');

                Swal.fire({
                    title: 'Konfirmasi Pendaftaran?',
                    text: 'Apakah kamu yakin ingin mengkonfirmasi pendaftaran ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Konfirmasi',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form[0].submit();
                    }
                });
            });

            // SweetAlert TOLAK 
            $(document).on('click', '.btn-reject', function () {
                let form = $(this).closest('form');

                Swal.fire({
                    title: 'Tolak Pendaftaran?',
                    text: 'Apakah kamu yakin ingin menolak pendaftaran ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Tolak',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form[0].submit();
                    }
                });
            });
        });
    </script>
    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ Session::get('success') }}",
                icon: "success",
                timer: 2000,
                showConfirmButton: false,
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            Swal.fire({
                title: "Gagal!",
                text: "{{ Session::get('error') }}",
                icon: "error",
                timer: 3000,
                showConfirmButton: true,
            });
        </script>
    @endif
    <script>
        setInterval(function() {

            // Jangan refresh ketika SweetAlert sedang terbuka
            if (Swal.isVisible()) {
                return;
            }

            fetch(window.location.href)
                .then(response => response.text())
                .then(html => {

                    // Periksa lagi sebelum mengganti isi tabel
                    if (Swal.isVisible()) {
                        return;
                    }

                    let parser = new DOMParser();
                    let doc = parser.parseFromString(html, 'text/html');

                    let newTbody = doc.querySelector('.datatable tbody');

                    if (newTbody) {
                        let table = $('.datatable').DataTable();

                        table.clear();
                        table.rows.add($(newTbody).find('tr'));
                        table.draw(false);
                    }

                })
                .catch(error => {
                    console.error('Gagal memperbarui data:', error);
                });

        }, 3000);
    </script>
@endpush
