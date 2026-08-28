@extends('layouts.app')

@section('title', 'Update Doctor')

@section('content')
    <div class="container py-4">
        <h1 class="page-title mb-3">Update Doctor!</h1>
        
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.doctor.update', $doctor->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                     
                    <div class="form-group mb-2">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('name') ?? $doctor->name }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="specialist_id" class="form-label">Specialist <span class="text-danger">*</span></label>
                        <select name="specialist_id" id="specialist_id" class="form-control @error('specialist_id') is-invalid @enderror">
                            <option value="">Pilih Specialist</option>
                            @foreach($specialists as $specialist)
                                <option value="{{ $specialist->id }}" {{ old('specialist_id', $specialist->id ?? '') == $specialist->id ? 'selected' : '' }}>
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
                            <option value="Aktif" {{ old('status', $doctor->status ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Tidak Aktif" {{ old('status', $doctor->status ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback d-block" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-2">
                        <label for="no_hp" class="form-label">No Hp <span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('no_hp') ?? $doctor->no_hp }}" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp">
                        @error('no_hp')
                            <span class="invalid-feedback d-block" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div><br>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.doctor.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection