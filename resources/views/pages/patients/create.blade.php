@extends('layouts.app')

@section('title', 'Form Pendaftaran Pasien')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Form Pendaftaran Pasien </h1>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form action="{{ route('patients.store') }}" method="POST">
                @csrf

                <div class="card-header py-3">
                    <h5 class="card-title m-0 font-weight-bold text-primary">Isi Data Pasien</h5>
                </div>

                <div class="card-body">

                    <div class="form-group mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama lengkap" required>
                        @error('nama')
                            <div class="invalid-feedback d-block">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                        <input type="text" name="nik" id="nik" value="{{ old('nik') }}" class="form-control @error('nik') is-invalid @enderror" placeholder="Masukkan NIK" required>
                        @error('nik')
                            <div class="invalid-feedback d-block">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control @error('tanggal_lahir') is-invalid @enderror" required>
                        @error('tanggal_lahir')
                            <div class="invalid-feedback d-block">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback d-block">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="no_hp" class="form-label">No. HP <span class="text-danger">*</span></label>
                        <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Contoh: 08123456789" required>
                        @error('no_hp')
                            <div class="invalid-feedback d-block">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback d-block">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="card-footer d-flex align-items-center gap-2">
                    <button type="submit" class="btn btn-primary mr-2">
                        <span class="fa fa-save mr-1"></span> Lanjut
                    </button>

                    <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                        <span class="fa fa-arrow-left mr-1"></span> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
