@extends('layouts.app')

@section('title', 'Doctor Detail!')

@section('content')
    <div class="container py-4">
        <h1 class="page-title mb-3">Doctor Detail!</h1>
        
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
                <th width="200px">Specialist</th>
                <td>{{ $doctor->specialist->name ?? '-' }}</td>
            </tr>
            <tr>
                <th width="200px">Status</th>
                <td>
                    @if($doctor->status == 'Aktif')
                        <span class="badge badge-success">Aktif</span>
                    @else
                        <span class="badge badge-danger">Tidak Aktif</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th width="200px">No HP</th>
                <td>{{ $doctor->no_hp }}</td>
            </tr>
            <tr>
                <th width="200px">Terdaftar Pada</th>
                <td>{{ \Carbon\Carbon::parse($doctor->created_at)->isoFormat('DD MMM Y HH:mm:ss') }}</td>
            </tr>
            <tr>
                <th width="200px">Diperbarui Pada</th>
                <td>{{ \Carbon\Carbon::parse($doctor->updated_at)->isoFormat('DD MMM Y HH:mm:ss') }}</td>
            </tr>
        </table>
        
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.doctor.index') }}" class="btn btn-primary">Kembali</a>
            <a href="{{ route('admin.doctor.edit', encrypt($doctor->id)) }}" class="btn btn-warning">
                <span class="fa fa-edit"></span> Edit
            </a>
            <a href="javascript:void(0)" onclick="handleDestroy('{{ route('admin.doctor.destroy', encrypt($doctor->id)) }}')" class="btn btn-danger">
                <span class="fa fa-trash"></span> Hapus
            </a>
        </div>
    </div>
    
    <form action="" id="form-destroy" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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