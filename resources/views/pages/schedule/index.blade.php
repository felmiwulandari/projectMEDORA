@extends('layouts.app')

@section('title','Schedule page')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 px-3 pt-3">
    <h1 class="h3 mb-0 text-gray-800">Schedule page</h1>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title mb-0">Data Schedule</h5>
        <a href="{{ route('pages.Schedule.create') }}" class="btn btn-primary">
            <span class="fa fa-plus-circle mr-2"></span>
            <span>Create New</span>
        </a>
    </div>

    <div class="card-body">
        <table class="table table-striped table-hover datatable">
            <thead>
                <tr>
                    <th>Dokter</th>
                    <th>Tanggal</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Kuota</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->doctor->name ?? 'Tidak ada' }}</td>
                    <td>{{ $schedule->tanggal }}</td>
                    <td>{{ $schedule->jam_mulai }}</td>
                    <td>{{ $schedule->jam_selesai }}</td>
                    <td>{{ $schedule->kuota }}</td>
                    <td>{{ $schedule->status }}</td>
                    <td>{{ $schedule->aksi }}</td>

                    <td>
                        <a href="{{ route('pages.Schedule.show', encrypt($schedule->id)) }}" class="btn btn-link text-secondary p-0 mx-2">
                            <span class="fa fa-search"></span>
                        </a>

                        <a href="{{ route('pages.Schedule.edit', encrypt($schedule->id)) }}" class="btn btn-link p-0 mx-2">
                            <span class="fa fa-edit"></span>
                        </a>

                        <a href="javascript:void(0)" onclick="handleDestroy('{{ route('pages.Schedule.destroy', encrypt($schedule->id)) }}')" class="btn btn-link text-danger p-0 mx-2">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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

@endpush