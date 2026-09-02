@extends('layouts.auth')

@section('content')

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <form id="patientForm" class="w-100">
        @csrf

        {{-- STEP 1 : FORM PASIEN --}}
        <div class="row justify-content-center" id="step1">
            <div class="col-md-7 col-lg-6">
                <div class="card shadow rounded">
                    <div class="card-body p-4">
                        <h4 class="text-center font-weight-bold mb-3">FORM PASIEN</h4>

                        {{-- NAMA --}}
                        <div class="form-group mb-2">
                            <label class="mb-1">NAMA</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        </div>

                        {{-- NIK --}}
                        <div class="form-group mb-2">
                            <label class="mb-1">NIK</label>
                            <input type="text" name="nik" id="nik" class="form-control" value="{{ old('nik') }}">
                        </div>

                        {{-- TANGGAL LAHIR --}}
                        <div class="form-group row align-items-center mb-2">
                            <label class="col-5 mb-0">TANGGAL LAHIR</label>
                            <div class="col-7">
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
                            </div>
                        </div>

                        {{-- JENIS KELAMIN --}}
                        <div class="form-group row align-items-center mb-2">
                            <label class="col-5 mb-0">JENIS KELAMIN</label>
                            <div class="col-7">
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                    <option value="">PILIH JENIS KELAMIN</option>
                                    <option value="Laki-laki">LAKI-LAKI</option>
                                    <option value="Perempuan">PEREMPUAN</option>
                                </select>
                            </div>
                        </div>

                        {{-- NO HP --}}
                        <div class="form-group row align-items-center mb-2">
                            <label class="col-5 mb-0">NO HP</label>
                            <div class="col-7">
                                <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp') }}">
                            </div>
                        </div>

                        {{-- ALAMAT --}}
                        <div class="form-group mb-2">
                            <label class="mb-1">ALAMAT</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="2">{{ old('alamat') }}</textarea>
                        </div>

                        {{-- LANJUT --}}
                        <div class="text-right">
                            <button type="button" class="btn btn-primary px-5" onclick="showStep2()">LANJUT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STEP 2 : PENDAFTARAN --}}
        <div class="row justify-content-center d-none" id="step2">
            <div class="col-md-7 col-lg-6">
                <div class="card shadow rounded">
                    <div class="card-body p-4">

                        <div class="position-relative">
                            {{-- TOMBOL KEMBALI --}}
                            <button type="button" class="btn btn-link text-dark p-0 position-absolute" onclick="showStep1()">
                                <i class="fas fa-chevron-left"></i>
                            </button>

                            <h4 class="text-center font-weight-bold mb-4">FORM PASIEN</h4>
                        </div>

                        {{-- SPESIALIS --}}
                        <div class="form-group mb-2">
                            <label class="mb-1">SPESIALIS</label>
                            <select name="specialist_id" id="specialist_id" class="form-control">
                                <option value="">PILIH SPESIALIS</option>

                                @foreach($specialists as $specialist)
                                    <option value="{{ $specialist->id }}">
                                        {{ $specialist->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- DOKTER --}}
                        <div class="form-group mb-2">
                            <label class="mb-1">DOKTER</label>
                            <select name="doctor_id" id="doctor_id" class="form-control">
                                <option value="">PILIH DOKTER</option>
                            </select>
                        </div>

                        {{-- JADWAL --}}
                        <div class="form-group mb-2">
                            <label class="mb-1">JADWAL</label>
                            <select name="schedule_id" id="schedule_id" class="form-control">
                                <option value="">PILIH JADWAL</option>
                            </select>
                        </div>

                        {{-- KELUHAN --}}
                        <div class="form-group mb-3">
                            <label class="mb-1">KELUHAN</label>
                            <textarea name="keluhan" id="keluhan" class="form-control" rows="3"></textarea>
                        </div>

                        {{-- DAFTAR --}}
                        <button type="button" class="btn btn-primary btn-block">DAFTAR</button>

                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<script>
    function showStep2() {
        document.getElementById('step1').classList.add('d-none');
        document.getElementById('step2').classList.remove('d-none');
    }

    function showStep1() {
        document.getElementById('step2').classList.add('d-none');
        document.getElementById('step1').classList.remove('d-none');
    }
</script>

@endsection