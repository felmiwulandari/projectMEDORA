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

                    {{-- DOCTOR --}}
                    <div class="form-group mb-3">
                        <label class="form-label">Dokter <span class="text-danger">*</span></label>

                        <input type="hidden" name="doctor_id" value="{{ $schedule->doctor_id }}">

                        <input type="text"
                            value="{{ $schedule->doctor->name }}"
                            class="form-control"
                            readonly>

                        @error('doctor_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TANGGAL MULAI MINGGU --}}
                    <div class="form-group mb-3">
                        <label for="tanggal" class="form-label">
                            Tanggal Mulai Minggu <span class="text-danger">*</span>
                        </label>

                        <input type="hidden"
                            name="tanggal"
                            value="{{ $schedule->tanggal }}">

                        <input type="text"
                            value="{{ \Carbon\Carbon::parse($schedule->tanggal)->format('d/m/Y') }}"
                            class="form-control"
                            readonly>

                        <small class="text-muted">
                            Tanggal minggu tidak dapat diubah.
                        </small>

                        @error('tanggal')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
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

                            $scheduleDays = [];

                            foreach ($weeklySchedules as $item) {
                                $day = strtolower(
                                    \Carbon\Carbon::parse($item->tanggal)
                                        ->locale('id')
                                        ->translatedFormat('l')
                                );

                                $scheduleDays[$day] = $item;
                            }

                            $oldDays = old('hari', array_keys($scheduleDays));
                        @endphp

                        @foreach($days as $key => $day)

                            @php
                                $daySchedule = $scheduleDays[$key] ?? null;
                                 $hasRegistration = $daySchedule
                                    ? $daySchedule->registrations()->exists()
                                    : false;
                            @endphp

                            <div class="border rounded p-2 mb-2">

                                <div class="form-check">
                                    <input type="checkbox"
                                        class="form-check-input day-checkbox"
                                        name="hari[]"
                                        value="{{ $key }}"
                                        id="{{ $key }}"
                                        {{ in_array($key, $oldDays) ? 'checked' : '' }}
                                        {{ $hasRegistration ? 'disabled' : '' }}>

                                    @if($hasRegistration)
                                        <input type="hidden" name="hari[]" value="{{ $key }}">
                                    @endif

                                    <label class="form-check-label" for="{{ $key }}">
                                        {{ $day }}

                                        @if($hasRegistration)
                                            <small class="text-danger">
                                                (sudah ada pendaftaran)
                                            </small>
                                        @endif
                                    </label>
                                </div>

                                <div class="day-detail mt-2"
                                    id="detail-{{ $key }}"
                                    style="{{ in_array($key, $oldDays) ? 'display:block;' : 'display:none;' }}">

                                    <div class="row">

                                        <div class="col-md-4">
                                            <label class="form-label">Jam Mulai</label>

                                            <input type="time"
                                                name="jam_mulai[{{ $key }}]"
                                                value="{{ old('jam_mulai.' . $key, $daySchedule ? \Carbon\Carbon::parse($daySchedule->jam_mulai)->format('H:i') : '') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Jam Selesai</label>

                                            <input type="time"
                                                name="jam_selesai[{{ $key }}]"
                                                value="{{ old('jam_selesai.' . $key, $daySchedule ? \Carbon\Carbon::parse($daySchedule->jam_selesai)->format('H:i') : '') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Kuota</label>

                                            <input type="number"
                                                name="kuota[{{ $key }}]"
                                                value="{{ old('kuota.' . $key, $daySchedule ? $daySchedule->kuota : '') }}"
                                                class="form-control"
                                                min="1"
                                                max="100">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>


                    {{-- STATUS --}}
                    <div class="form-group mb-3">

                        <label for="status" class="form-label">
                            Status <span class="text-danger">*</span>
                        </label>

                        <select name="status"
                                id="status"
                                class="form-control @error('status') is-invalid @enderror"
                                required>

                            <option value="aktif"
                                {{ old('status', $schedule->status) == 'aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="tidak aktif"
                                {{ old('status', $schedule->status) == 'tidak aktif' ? 'selected' : '' }}>
                                Tidak Aktif
                            </option>

                        </select>

                        @error('status')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- BUTTON --}}
                    <br>

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="{{ route('admin.schedule.index') }}"
                       class="btn btn-secondary">
                        Batal
                    </a>

                </form>

            </div>
        </div>
    </div>


    {{-- JAVASCRIPT --}}
    <script>
        document.querySelectorAll('.day-checkbox').forEach(function (checkbox) {

            checkbox.addEventListener('change', function () {

                let detail = document.getElementById('detail-' + this.value);

                if (this.checked) {
                    detail.style.display = 'block';
                } else {
                    detail.style.display = 'none';

                    detail.querySelectorAll('input').forEach(function (input) {
                        input.value = '';
                    });
                }

            });

        });
    </script>

@endsection