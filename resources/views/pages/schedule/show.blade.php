@extends('layouts.app')

@section('title', 'Schedule detail!')

@section('content')
    <div class="container py-4">
        <h1 class="page-title mb-3">Schedule detail!</h1>

        <table class="table table-striped">

            <tr>
                <th width="200px">Dokter</th>
                <td>{{ $schedule->doctor->name ?? 'Tidak ditemukan' }}</td>
            </tr>

            <tr>
                <th width="200px">Jadwal Praktik</th>
                <td>
                    @foreach($weeklySchedules as $item)
                        <div class="mb-2">
                            <strong>
                                {{ \Carbon\Carbon::parse($item->tanggal)
                                    ->locale('id')
                                    ->translatedFormat('l') }}
                            </strong>
                            &nbsp;|&nbsp;
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                            &nbsp;|&nbsp;
                            {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                            &nbsp;|&nbsp;
                            Kuota: {{ $item->kuota }}
                            &nbsp;|&nbsp;
                            @if ($item->status == 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                @endif
                        </div>
                    @endforeach
                </td>
            </tr>

            <tr>
                <th width="200px">Terdaftar Pada</th>
                <td>
                    {{ \Carbon\Carbon::parse($schedule->created_at)->isoFormat('DD MM Y HH:mm:ss') }}
                </td>
            </tr>

            <tr>
                <th width="200px">Diperbarui Pada</th>
                <td>
                    {{ \Carbon\Carbon::parse($schedule->updated_at)->isoFormat('DD MM Y HH:mm:ss') }}
                </td>
            </tr>

        </table>

        <div class="d-flex align-items-center gap-2">
             <a href="{{ route('admin.schedule.index') }}" class="btn btn-primary mr-2">
                    Kembali
            </a>
            <a href="{{ route('admin.schedule.edit', encrypt($schedule->id)) }}" class="btn btn-secondary mr-2">Edit</a>
            <a href="javascript:void()" onclick="handleDestroy('{{ route('admin.schedule.destroy', encrypt($schedule->id)) }}')"
                class="btn btn-danger mr-2">Hapus
            </a>
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
    <script type="text/javascript" src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
     <script type="text/javascript">

        $('.datatable').dataTable();

        function handleDestroy(url) {
            Swal.fire({
            title: "Apakah kamu akan menghapus?",
            text: "Kamu tidak bisa mengembalikan data yang sudah dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya,Hapus!",
            cancelButtonText: "Batal"
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
                        timer: "2000",
                        showConfirmButton: false
                    });
         </script>
     @endif
@endpush