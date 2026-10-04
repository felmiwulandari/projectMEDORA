@extends('layouts.app')


@section('title', 'Create New - Schedule Page')

@section('content')
    <div class="d-sm-felx align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create New - Schedule Page</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('admin.schedule.store') }}" method="POST">
                    @csrf

                    <div class="card-header">
                        <h5 class="card-title">Create New Schedule</h5>
                    </div>

                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- DOCTOR ID --}}
                        <div class="form-group mb-3">
                            <label for="doctor_id" class="form-label">Dokter <span class="text-danger">*</span></label>
                            <select name="doctor_id" id="doctor_id" required class="form-control @error('doctor_id') is-invalid @enderror" required>
                                <option value="">Pilih Dokter</option>
                                
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('doctor_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal" class="form-label">Tanggal Mulai Minggu <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" class="form-control @error('tanggal') is-invalid @enderror" required>

                            <small class="text-muted">
                                Pilih tanggal hari Senin sebagai awal minggu.
                            </small>

                            @error('tanggal')
                                <div class="invalid-feedback d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>


                        {{-- HARI PRAKTIK --}}
                        <div class="form-group mb-3">
                            <label class="form-label">
                                Hari Praktik <span class="text-danger">*</span>
                            </label>

                            @error('hari')
                                <div class="text-danger mb-2">
                                    {{ $message }}
                                </div>
                            @enderror

                            @php
                                $days = [
                                    'senin' => 'Senin',
                                    'selasa' => 'Selasa',
                                    'rabu' => 'Rabu',
                                    'kamis' => 'Kamis',
                                    'jumat' => 'Jumat',
                                    'sabtu' => 'Sabtu',
                                    'minggu' => 'Minggu',
                                ];
                            @endphp

                            @foreach($days as $key => $day)

                        <div class="border rounded p-2 mb-2">

                            <div class="form-check">
                                <input type="checkbox"
                                    class="form-check-input day-checkbox"
                                    name="hari[]"
                                    value="{{ $key }}"
                                    id="{{ $key }}"
                                    {{ in_array($key, old('hari', [])) ? 'checked' : '' }}>

                                <label class="form-check-label" for="{{ $key }}">
                                    {{ $day }}
                                </label>
                            </div>

                            <div class="day-detail mt-2"
                                id="detail-{{ $key }}"
                                style="display: none;">

                                <div class="row">

                                    <div class="col-md-4">
                                        <label class="form-label">Jam Mulai</label>

                                        <input type="time"
                                            name="jam_mulai[{{ $key }}]"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Jam Selesai</label>

                                        <input type="time"
                                                name="jam_selesai[{{ $key }}]"
                                                class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Kuota</label>

                                        <input type="number"
                                            name="kuota[{{ $key }}]"
                                            class="form-control"
                                            min="1"
                                            max="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" required class="form-control @error('status') is-invalid @enderror" required>
                                <option value="">Pilih Status</option>

                                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak aktif" {{ old('status') == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            
                            @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <span class="fa fa-save"></span> Save
                        </button>

                        <a href="{{ route('admin.schedule.index') }}" class="btn btn-secondary">
                            <span class="fa fa-times-circle"></span> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    document.querySelectorAll('.day-checkbox').forEach(function (checkbox) {

        checkbox.addEventListener('change', function () {

            let detail = document.getElementById('detail-' + this.value);

            if (this.checked) {
                detail.style.display = 'block';
            } else {
                detail.style.display = 'none';
            }

        });

    });
</script>

@endsection