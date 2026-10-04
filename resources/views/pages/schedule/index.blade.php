@extends('layouts.app')

@section('title','Schedule page')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4 px-3 pt-3">
    <h1 class="h3 mb-0 text-gray-800">Schedule page</h1>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title mb-0">Data Schedule</h5>
        <a href="{{ route('admin.schedule.create') }}" class="btn btn-primary">
            <span class="fa fa-plus-circle mr-2"></span>
            <span>Create New</span>
        </a>
    </div>

    <div class="card-body">
        <table class="table table-striped table-hover datatable">
            <thead>
                <tr>
                    <th>Dokter</th>
                    <th>Minggu</th>
                    <th>Hari Praktik</th>
                    <th>Jam Praktik</th>
                    <th>Kuota</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $groupedSchedules = $schedules->groupBy(function ($schedule) {
                        return $schedule->doctor_id . '-' .
                            \Carbon\Carbon::parse($schedule->tanggal)
                                ->startOfWeek(\Carbon\Carbon::MONDAY)
                                ->format('Y-m-d');
                    });
                @endphp

                @foreach ($groupedSchedules as $group)
                    @php
                        $first = $group->first();

                        $startWeek = \Carbon\Carbon::parse($first->tanggal)
                            ->startOfWeek(\Carbon\Carbon::MONDAY);

                        $endWeek = $startWeek->copy()->addDays(6);
                    @endphp

                    <tr>
                        {{-- DOKTER --}}
                        <td>
                            {{ $first->doctor->name ?? 'Tidak ada' }}
                        </td>

                        {{-- MINGGU --}}
                        <td>
                            {{ $startWeek->format('d-m-Y') }}
                            <br>
                            -
                            <br>
                            {{ $endWeek->format('d-m-Y') }}
                        </td>

                        {{-- HARI PRAKTIK --}}
                        <td>
                            @foreach ($group->sortBy('tanggal') as $schedule)
                                {{ \Carbon\Carbon::parse($schedule->tanggal)->locale('id')->translatedFormat('l') }}
                                <br>
                            @endforeach
                        </td>

                        {{-- JAM PRAKTIK --}}
                        <td>
                            @foreach ($group->sortBy('tanggal') as $schedule)
                                {{ \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($schedule->jam_selesai)->format('H:i') }}
                                <br>
                            @endforeach
                        </td>

                        {{-- KUOTA --}}
                        <td>
                            @foreach ($group->sortBy('tanggal') as $schedule)
                                {{ $schedule->kuota }}
                                <br>
                            @endforeach
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @if($first->status == 'aktif')
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Tidak Aktif</span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td>
                            <a href="{{ route('admin.schedule.show', encrypt($first->id)) }}"
                            class="btn btn-link text-secondary p-0 mx-2">
                                <span class="fa fa-search"></span>
                            </a>

                            <a href="{{ route('admin.schedule.edit', encrypt($first->id)) }}"
                            class="btn btn-link p-0 mx-2">
                                <span class="fa fa-edit"></span>
                            </a>

                            <a href="javascript:void(0)"
                            onclick="handleDestroy('{{ route('admin.schedule.destroy', encrypt($first->id)) }}')"
                            class="btn btn-link text-danger p-0 mx-2">
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

@if (Session::has('error'))
<script>
Swal.fire({
    title: "Tidak dapat dihapus!",
    text: "{{ Session::get('error') }}",
    icon: "error",
    showConfirmButton: true,
});
</script>
@endif

@endpush