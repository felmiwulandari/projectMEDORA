@extends('layouts.app')

@section('title', 'Update Schedule')

@section('content')
    <div class="container py-4">
        <h1 class="page-title mb-3">Update Schedule!</h1>
        
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.schedule.update', encrypt($schedule->id)) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- DOCTOR ID --}}
                    <div class="form-group mb-3">
                        <label for="doctor_id" class="form-label">Dokter <span class="text-danger">*</span></label>
                        <select name="doctor_id" id="doctor_id" class="form-control @error('doctor_id') is-invalid @enderror" required>
                            <option value="">Pilih Dokter</option>

                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ old('doctor_id', $schedule->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('doctor_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                     
                    <div class="form-group mb-2">
                        <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" value="{{ old('tanggal') ?? $schedule->tanggal }}" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal">

                        @error('tanggal')
                            <span class="invalid-feedback d-block" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="jam_mulai" class="form-label">Jam Mulai <span class="text-danger">*</span></label>
                        <input type="time" value="{{ old('jam_mulai') ?? $schedule->jam_mulai }}" class="form-control @error('jam_mulai') is-invalid @enderror" name="jam_mulai" id="jam_mulai">

                        @error('jam_mulai')
                            <span class="invalid-feedback d-block" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="jam_selesai" class="form-label">Jam Selesai <span class="text-danger">*</span></label>
                        <input type="time" value="{{ old('jam_selesai') ?? $schedule->jam_selesai }}" class="form-control @error('jam_selesai') is-invalid @enderror" name="jam_selesai" id="jam_selesai">

                        @error('jam_selesai')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="kuota" class="form-label">Kuota <span class="text-danger">*</span></label>
                        <input type="number" value="{{ old('kuota') ?? $schedule->kuota }}" class="form-control @error('kuota') is-invalid @enderror" name="kuota" id="kuota">

                        @error('kuota')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="aktif" {{ old('status', $schedule->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak aktif" {{ old('status', $schedule->status) == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            
                            @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    
                    <br>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.schedule.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection