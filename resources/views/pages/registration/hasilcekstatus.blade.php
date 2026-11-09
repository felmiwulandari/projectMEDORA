@extends('layouts.auth')

@section('content')

<div class="container py-5">

    <div class="card shadow p-4" style="border-radius: 15px;">

        <div class="text-center mb-4">
            <h4 class="fw-bold">RIWAYAT PENDAFTARAN</h4>
            <p class="text-muted">Berikut riwayat pendaftaran Anda.</p>
        </div>

        <div class="mb-4">
            <p><strong>Nama:</strong> {{ $patient->name }}</p>
            <p><strong>NIK:</strong> {{ $patient->nik }}</p>
        </div>

        <hr>

        @foreach ($registrations as $registration)

            <div class="border rounded p-3 mb-3">

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong>Pendaftaran {{ $loop->iteration }}</strong>

                    @if ($registration->status == 'menunggu')
                        <span class="badge bg-warning text-white">Menunggu</span>
                    @elseif ($registration->status == 'dikonfirmasi')
                        <span class="badge bg-success text-white">Dikonfirmasi</span>
                    @elseif ($registration->status == 'ditolak')
                        <span class="badge bg-danger text-white">Ditolak</span>
                    @endif
                </div>

                <p><strong>Tanggal Daftar:</strong>
                    {{ $registration->tanggal_daftar }}
                </p>

                <p><strong>Dokter:</strong>
                    {{ $registration->schedule->doctor->name ?? '-' }}
                </p>

                <p><strong>Keluhan:</strong>
                    {{ $registration->keluhan }}
                </p>

                <a href="{{ route('registration.status', encrypt($registration->id)) }}"
                   class="btn btn-primary btn-sm">
                    Lihat Status
                </a>

            </div>

        @endforeach

        <div class="text-center mt-3">
            <a href="{{ url('/') }}" class="btn btn-secondary">
                Kembali ke Beranda
            </a>
        </div>

    </div>

</div>

@endsection