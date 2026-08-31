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
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

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
               @foreach ($resgistrations as $registration)
                <tr>
                    <td>{{ $registration->patient->name ?? 'Tidak ditemukan' }}</td>
                    <td>{{ $registration->schedule->specialist->name ?? '-' }}</td>  {{-- LEWAT SCHEDULE --}}
                    <td>{{ $registration->schedule->doctor->name ?? '-' }}</td>       {{-- LEWAT SCHEDULE --}}
                    <td>{{ $registration->jam_mulai }}</td>
                    <td>{{ $registration->jam_selesai }}</td>
                    <td>{{ \Carbon\Carbon::parse($registration->tanggal_daftar)->format('d-m-Y') }}</td>
                    <td>
                            @if($registration->status == 'menunggu')
                                <span class="badge badge-warning">🟡 Menunggu</span>
                            @elseif($registration->status == 'diterima')
                                <span class="badge badge-success">🟢 Diterima</span>
                            @else
                                <span class="badge badge-danger">🔴 Ditolak</span>
                            @endif
                        </td>
                    <td>{{ Str::limit($registration->keluhan, 20) }}</td>
                    <td>
                        {{-- DETAIL --}}
                        <a href="{{ route('admin.registration.show', encrypt($registration->id)) }}" class="btn btn-link text-secondary p-0 mx-2">
                            <span class="fa fa-search"></span>
                        </a>

                        {{-- TOMBOL TERIMA (Centang) - Hanya tampil jika status menunggu --}}
                        @if($registration->status == 'menunggu')
                        <form action="{{ route('admin.registration.approve', encrypt($registration->id)) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link text-success p-0 mx-2" onclick="return confirm('Terima pendaftaran ini?')">
                                <span class="fa fa-check-circle"></span>
                            </button>
                        </form>
                        @endif

                        {{-- TOMBOL TOLAK (Silang) - Hanya tampil jika status menunggu --}}
                        @if($registration->status == 'menunggu')
                        <form action="{{ route('admin.registration.reject', encrypt($registration->id)) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link text-danger p-0 mx-2" onclick="return confirm('Tolak pendaftaran ini?')">
                                <span class="fa fa-times-circle"></span>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $registrations->links() }}
    </div>
</div>

<form action="" id="form-destroy" method="POST">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script>
$(document).ready(function () {
    $(".datatable").DataTable();
});

function handleDestroy(url) {
    Swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Kamu tidak bisa mengembalikan data yang telah dihapus!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya Hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            $('#form-destroy').attr('action', url);
            $('#form-destroy').submit();
        }
    });
}
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
@endpush