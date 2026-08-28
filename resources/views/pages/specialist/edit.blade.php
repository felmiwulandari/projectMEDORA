@extends('layouts.app')

@section('title', 'Update Specialist')

@section('content')
    <div class="container py-4">
       <h1 class="page-title mb-3">Update Specialist!</h1>

       <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.specialist.update', $specialists->id) }}" method="post">
                    @csrf
                    @method('PUT')
                   

                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name Specialist</label>
                            <input type="text" name="name" id="name" value="{{ old('name') ?? $specialists->name }}" class="form-control @error('name') is-invalid @enderror">

                             @error('name')
                                <span class="invalid-feedback d-block" role="alert">
                                    {{$message}}
                                </span>   
                            @enderror
                        </div>


                    <div class="form-group mb-2">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="">Pilih Status</option>
                            <option value="Aktif" {{ old('status', $specialist->status ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Tidak Aktif" {{ old('status', $specialist->status ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback d-block" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    
<br>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.specialist.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
       </div>

       
    </div>
@endsection