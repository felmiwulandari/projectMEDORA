@extends('layouts.app')

@section('title', 'Doctor detail!')

@section('content')
    <div class="container py-4">
        <h1 class="page-title mb-3">Doctor detail!</h1>
        

        <table class="table table-striped">
            <tr>
                <th width="200px">ID</th>
                <td>{{ $doctor->id }}</td>
            </tr>
            <tr>
                <th width="200px">Name</th>
                <td>{{ $doctor->name }}</td>
            </tr>
            <tr>
                <th width="200px">Email</th>
                <td>{{ $doctor->specialist_id }}</td>
            </tr>
            <tr>
                <th width="200px">Email</th>
                <td>{{ $doctor->status }}</td>
            </tr>
            <tr>
                <th width="200px">Email</th>
                <td>{{ $doctor->no_hp }}</td>
            </tr>
            <tr>
                <th width="200px">Terdaftar Pada</th>
                <td>{{ \Carbon\Carbon::parse ($user->created_at)->isoFormat('DD MM Y HH:mm:ss') }}</td>
            </tr>
            <tr>
                <th width="200px">Diperbarui Pada</th>
                <td>{{ \Carbon\Carbon::parse ($user->updated_at)->isoFormat('DD MM Y HH:mm:ss') }}</td>
            </tr>
        </table>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.doctor.index') }}" class="btn btn-primary">Kembali</a>
            <a href="{{ route('admin.doctor.edit', encrypt($user->id)) }}" class="btn btn-link p-0 mx-2">
                <span class="fa fa-edit"></span>
            </a>
            <a href="javascript:void()" onclick="handleDestroy('{{ route('admin.doctor.destroy', encrypt($user->id)) }}')" class="btn btn-link text-danger p-0 mx-2">
                <span class="fa fa-trash"></span>
            </a>
        </div>
    </div>
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
        title: "Apakah Anda yakin?",
        text: "Kamu tidak bisa mengembalikan data yang telah di hapus!",
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
                        timer: "2000",
                        showConfirmButton: false
                    });
         </script>
     @endif
@endpush