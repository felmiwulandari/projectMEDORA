@extends('layouts.app')

@section('title', 'Registration Detail!')

@section('content')
    <div class="container py-4">
        <h1 class="page-title mb-3">Registration Detail!</h1>
        
                <table class="table table-striped">
            <tr>
                <th width="200px">ID</th>
                <td>{{ $registration->id }}</td>
            </tr>
            <tr>
                <th width="200px">Nama Pasien</th>
                <td>{{ $registration->patient->name ?? 'Tidak ditemukan' }}</td>
            </tr>
            <tr>
                <th width="200px">Nama Dokter</th>
                <td>{{ $registration->schedule->doctor->name ?? 'Tidak ditemukan' }}</td>
            </tr>
            <tr>
                <th width="200px">Spesialis</th>
                <td>{{ $registration->schedule->specialist->name ?? '-' }}</td>
            </tr>
            <tr>
                <th width="200px">Tanggal Daftar</th>
                <td>{{ \Carbon\Carbon::parse($registration->tanggal_daftar)->isoFormat('DD MM Y') }}</td>
            </tr>
            <tr>
                <th width="200px">Jam Mulai</th>
                <td>{{ $registration->schedule->jam_mulai ?? '-' }}</td>
            </tr>
            <tr>
                <th width="200px">Jam Selesai</th>
                <td>{{ $registration->schedule->jam_selesai ?? '-' }}</td>
            </tr>
            <tr>
                <th width="200px">Keluhan</th>
                <td>{{ $registration->keluhan }}</td>
            </tr>
            <tr>
                <th width="200px">Status</th>
                <td>
                    @if($registration->status == 'menunggu')
                        <span class="badge badge-warning">🟡 Menunggu</span>
                    @elseif($registration->status == 'Di konfirmasi')
                        <span class="badge badge-success">🟢 Di konfirmasi</span>
                    @elseif($registration->status == 'Di tolak')
                        <span class="badge badge-danger">🔴 Di tolak</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th width="200px">Terdaftar Pada</th>
                <td>{{ \Carbon\Carbon::parse($registration->created_at)->isoFormat('DD MM Y HH:mm:ss') }}</td>
            </tr>
            <tr>
                <th width="200px">Diperbarui Pada</th>
                <td>{{ \Carbon\Carbon::parse($registration->updated_at)->isoFormat('DD MM Y HH:mm:ss') }}</td>
            </tr>
        </table>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.registration.index') }}" class="btn btn-primary">Kembali</a>

        </div>
    </div>

    {{-- <form action="" id="form-destroy" method="POST">
        @csrf
        @method('DELETE')
    </form> --}}
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@push('scripts') 
<script type="text/javascript" src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script type="text/javascript">
    $('.datatable').dataTable();
    
// function handleDestroy(url) {
//     Swal.fire({
//         title: "Apakah Anda yakin?",
//         text: "Kamu tidak bisa mengembalikan data yang telah di hapus!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonText: "Ya Hapus",
//         cancelButtonText: "Batal",
//     }).then((result) => {
//         if (result.isConfirmed) {
//             $('#form-destroy').attr('action', url);
//             $('#form-destroy').submit(); 
//         }
//     });
</script>

@if (Session::has('success'))
<script>
    Swal.fire({
        title: "Berhasil!",
        text: "{{ Session::get('success') }}",
        icon: "success",
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif
@endpush