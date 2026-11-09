
@extends('layouts.auth')

@section('content')

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow rounded text-center p-4" style="max-width: 500px; width: 100%;">

        <div class="mb-3">
            <i class="fas fa-check-circle text-success"
               style="font-size: 75px;"></i>
        </div>

        <h4 class="font-weight-bold text-success mb-3">
            Pendaftaran Berhasil Dikirim!
        </h4>

        <p class="text-muted mb-2">
            Data pendaftaran Anda telah berhasil dikirim.
        </p>

        <p class="text-muted mb-4">
            Silakan menunggu proses konfirmasi dari pihak klinik.
            Untuk mengetahui perkembangan pendaftaran, silakan cek status
            secara berkala menggunakan NIK Anda.
        </p>

        <a href="{{ route('registration.check.form') }}"
           class="btn btn-primary btn-block">
            CEK STATUS PENDAFTARAN
        </a>

        <a href="{{ url('/') }}"
           class="text-primary mt-3">
            Kembali ke Beranda
        </a>

    </div>
</div>

@endsection
