@extends('layouts.app')

@section('title', 'Specialist Page')

@section('content')
    <div class="d-sm-felx align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Specialist Page</h1>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">Data Specialist</h5>
            <a href="{{ route('admin.specialist.create') }}" class="btn btn-primary">
                <span class="fa fa-plus-circle mr-2"></span>
                <span>Create New</span>
            </a>
        </div>

        <div class="card-body">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>Name Specialist</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($specialists as $specialist)
                    <tr>
                        <td>{{ $specialist->name }}</td>
                        <td>
                            @if($specialist->status == 'Aktif')
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.specialist.show', encrypt($specialist->id)) }}" class="btn btn-link text-secondary p-0 mx-2">
                                <span class="fa fa-search"></span>
                            </a>
                            <a href="{{ route('admin.specialist.edit', encrypt($specialist->id)) }}" class="btn btn-link p-0 mx-2">
                                <span class="fa fa-edit"></span>
                            </a>
                            <a href="javascript:void(0)" onclick="handleDestroy('{{ route('admin.specialist.destroy', encrypt($specialist->id)) }}')" class="btn btn-link text-danger p-0 mx-2">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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