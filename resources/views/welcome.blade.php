@extends('layouts.auth')

@section('content')

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <form id="patientForm" class="w-100" action="{{ route('registration.store') }}" method="POST">
        @csrf

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- FORM PASIEN --}}
        <div class="row justify-content-center" id="step1">
            <div class="col-md-7 col-lg-6">
                <div class="card shadow rounded">
                    <div class="card-body p-4">
                        <h4 class="text-center font-weight-bold mb-3">FORM PASIEN</h4>

                        {{-- NAMA --}}
                        <div class="form-group mb-2">
                            <label class="mb-1">NAMA</label>

                            <input type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}">

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- NIK --}}
                        <div class="form-group mb-2">
                            <label class="mb-1">NIK</label>

                            <input type="text"
                                name="nik"
                                id="nik"
                                class="form-control @error('nik') is-invalid @enderror"
                                value="{{ old('nik') }}">

                            @error('nik')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- TANGGAL LAHIR --}}
                        <div class="form-group row align-items-center mb-2">
                            <label class="col-5 mb-0">TANGGAL LAHIR</label>

                            <div class="col-7">
                                <input type="date"
                                    name="tanggal_lahir"
                                    id="tanggal_lahir"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    value="{{ old('tanggal_lahir') }}">

                                @error('tanggal_lahir')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- JENIS KELAMIN --}}
                        <div class="form-group row align-items-center mb-2">
                            <label class="col-5 mb-0">JENIS KELAMIN</label>

                            <div class="col-7">
                                <select name="jenis_kelamin"
                                        id="jenis_kelamin"
                                        class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="">PILIH JENIS KELAMIN</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                        LAKI-LAKI
                                    </option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                        PEREMPUAN
                                    </option>
                                </select>

                                @error('jenis_kelamin')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- NO HP --}}
                        <div class="form-group row align-items-center mb-2">
                            <label class="col-5 mb-0">NO HP</label>

                            <div class="col-7">
                                <input type="text"
                                    name="no_hp"
                                    id="no_hp"
                                    class="form-control @error('no_hp') is-invalid @enderror"
                                    value="{{ old('no_hp') }}">

                                @error('no_hp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- ALAMAT --}}
                        <div class="form-group mb-2">
                            <label class="mb-1">ALAMAT</label>

                            <textarea name="alamat"
                                    id="alamat"
                                    class="form-control @error('alamat') is-invalid @enderror"
                                    rows="2">{{ old('alamat') }}</textarea>

                            @error('alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- LANJUT --}}
                        <div class="text-right">
                            <button type="button" class="btn btn-primary px-5" onclick="showStep2()">LANJUT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- PENDAFTARAN --}}
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
                            <select name="doctor_id" id="doctor_id" class="form-control" disabled>
                                <option value="">PILIH DOKTER</option>
                            </select>
                        </div>

                        {{-- JADWAL --}}
                        <div class="form-group mb-2">
                            <label class="mb-1">JADWAL</label>

                            <select name="schedule_id"
                                    id="schedule_id"
                                    class="form-control @error('schedule_id') is-invalid @enderror">
                                <option value="">PILIH JADWAL</option>
                            </select>

                            @error('schedule_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- KELUHAN --}}
                        <div class="form-group mb-3">
                            <label class="mb-1">KELUHAN</label>

                            <textarea name="keluhan"
                                    id="keluhan"
                                    class="form-control @error('keluhan') is-invalid @enderror"
                                    rows="3">{{ old('keluhan') }}</textarea>

                            @error('keluhan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">DAFTAR</button>

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

    // DOKTER BERDASARKAN SPESIALIS
document.getElementById('specialist_id').addEventListener('change', function () {

    // Ambil ID spesialis yang dipilih
    let specialistId = this.value;

    // Ambil dropdown dokter
    let doctorSelect = document.getElementById('doctor_id');

    // Nonaktifkan dropdown dokter saat memuat data
    doctorSelect.disabled = true;

    // Tampilkan keterangan sedang memuat
    doctorSelect.innerHTML =
        '<option value="">MEMUAT DOKTER...</option>';

    // Jika spesialis dipilih
    if (specialistId) {

        // Ambil data dokter berdasarkan ID spesialis
        fetch('/get-doctors/' + specialistId)
            .then(response => response.json())
            .then(doctors => {

                // Kembalikan pilihan awal
                doctorSelect.innerHTML =
                    '<option value="">PILIH DOKTER</option>';

                // Tampilkan semua dokter
                doctors.forEach(function (doctor) {

                    // Buat pilihan dokter
                    let option = document.createElement('option');

                    // ID dokter menjadi value
                    option.value = doctor.id;

                    // Tampilkan nama dokter
                    option.textContent = doctor.name;

                    // Masukkan dokter ke dropdown
                    doctorSelect.appendChild(option);
                });

                // Aktifkan kembali dropdown dokter
                doctorSelect.disabled = false;
            })
            .catch(error => {

                // Tampilkan error di console
                console.error(error);

                // Tampilkan pesan gagal
                doctorSelect.innerHTML =
                    '<option value="">GAGAL MEMUAT DOKTER</option>';
            });

    } else {

        // Jika spesialis belum dipilih
        doctorSelect.disabled = true;

        // Kembalikan dropdown ke kondisi awal
        doctorSelect.innerHTML =
            '<option value="">PILIH DOKTER</option>';
    }
});
    // JADWAL BERDASARKAN DOKTER
document.getElementById('doctor_id').addEventListener('change', function () {

    // Ambil ID dokter yang dipilih
    let doctorId = this.value;

    // Ambil dropdown jadwal
    let scheduleSelect = document.getElementById('schedule_id');

    // Nonaktifkan dropdown saat memuat data
    scheduleSelect.disabled = true;

    // Tampilkan keterangan sedang memuat
    scheduleSelect.innerHTML =
        '<option value="">MEMUAT JADWAL...</option>';

    // Jika dokter dipilih
    if (doctorId) {

        // Ambil data jadwal berdasarkan ID dokter
        fetch('/get-schedules/' + doctorId)
            .then(response => response.json())
            .then(schedules => {

                // Kembalikan pilihan awal
                scheduleSelect.innerHTML =
                    '<option value="">PILIH JADWAL</option>';

                // Tampilkan semua jadwal
                schedules.forEach(function (schedule) {

                    // Buat pilihan jadwal
                    let option = document.createElement('option');

                    // ID jadwal menjadi value
                    option.value = schedule.id;

                    // Tampilkan tanggal, jam, dan kuota
                    option.textContent =
                        schedule.tanggal + ' | ' +
                        schedule.jam_mulai + ' - ' +
                        schedule.jam_selesai +
                        ' | Kuota: ' + schedule.kuota;

                    // Masukkan jadwal ke dropdown
                    scheduleSelect.appendChild(option);
                });

                // Aktifkan kembali dropdown jadwal
                scheduleSelect.disabled = false;
            })
            .catch(error => {

                // Tampilkan error di console
                console.error(error);

                // Tampilkan pesan gagal
                scheduleSelect.innerHTML =
                    '<option value="">GAGAL MEMUAT JADWAL</option>';
            });

    } else {

        // Jika dokter belum dipilih
        scheduleSelect.disabled = true;

        // Kembalikan dropdown ke kondisi awal
        scheduleSelect.innerHTML =
            '<option value="">PILIH JADWAL</option>';
    }
});
</script>

@endsection