@extends('layouts.app')

@section('title', 'Create New - Specialist page')

@section('content')
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create New - Specialist page</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('admin.specialist.store') }}" method="POST">
                    @csrf

                    <div class="card-header">
                        <h5 class="card-title">Create New Specialist</h5>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name Specialist</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">

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
                                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback d-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <span class="fa fa-save"></span>
                            Save
                        </button>

                        <a href="{{ route('admin.specialist.index') }}" class="btn btn-secondary">
                            <span class="fa fa-times-circle"></span> Cancel 
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection