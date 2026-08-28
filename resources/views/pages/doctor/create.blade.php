@extends('layouts.app')

@section('title', 'Create New - Doctor Page')

@section('content')
    <div class="d-sm-felx align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create New - Doctor Page</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('admin.doctor.store') }}" method="POST">
                    @csrf

                    <div class="card-header">
                        <h5 class="card-title">Create New Doctor</h5>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="specialist_id" class="form-label">Specialist <span class="text-danger">*</span></label>
                            <select name="specialist_id" id="specialist_id" class="form-control @error('specialist_id') is-invalid @enderror">
                                <option value="">Pilih Specialist</option>
                                @foreach($specialists as $specialist)
                                    <option value="{{ $specialist->id }}" {{ old('specialist_id') == $specialist->id ? 'selected' : '' }}>
                                        {{ $specialist->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('specialist_id')
                                <span class="invalid-feedback d-block" role="alert">
                                    {{ $message }}
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
                        
                        <div class="form-group mb-2">
                            <label for="no_hp" class="form-label">No HP <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('no_hp') }}" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp">
                            @error('no_hp')
                                <span class="invalid-feedback d-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <span class="fa fa-save"></span> Save
                        </button>

                        <a href="{{ route('admin.doctor.index') }}" class="btn btn-secondary">
                            <span class="fa fa-times-circle"></span> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection