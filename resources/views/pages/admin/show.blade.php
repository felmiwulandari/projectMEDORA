@extends('layouts.app')

@section('title', 'Admin page')

@section('content')
    <div class="container py-4">
        <h1 class="page-title mb-3">Admin details!</h1>
            <table class="table table-striped">
                <tr>
                    <th width="200px">ID</th>
                    <td>{{ $user->id }}</td>
                </tr>

                <tr>
                    <th width="200px">Name</th>
                    <td>{{ $user->name }}</td>
                </tr>

                <tr>
                    <th width="200px">Email</th>
                    <td>{{ $user->email }}</td>
                </tr>

                <tr>
                    <th width="200px">Terdaftar pada</th>
                    <td>{{ \Carbon\Carbon::parse($user->created_at)->isoFormat('DD MMMM Y HH:mm:ss') }}</td>
                </tr>
                <tr>
                    <th width="200px">Diperbarui pada</th>
                    <td>{{ \Carbon\Carbon::parse($user->updated_at)->isoFormat('DD MMMM Y HH:mm:ss')  }}</td>
                </tr>
            </table>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.admin.index') }}" class="btn btn-primary mr-2">
                    Kembali
                </a>
                <a href="{{ route('admin.admin.edit', $user->id) }}" class="btn btn-secondary mr-2">Edit</a>
                <a href="javascript:void()" onclick="handleDestroy('{{ route('admin.admin.destroy', encrypt($user->id)) }}')"
                    class="btn btn-danger mr-2">Hapus
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