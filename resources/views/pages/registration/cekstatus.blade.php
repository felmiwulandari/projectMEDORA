@extends('layouts.auth')

@section('content')

<div class="container min-vh-100 d-flex align-items-center justify-content-center">

    <div class="card shadow p-4" style="width: 100%; max-width: 500px; border-radius: 15px;">

        <div class="text-center mb-4">
            <h4 class="fw-bold">CEK STATUS PENDAFTARAN</h4>
            <p class="text-muted">Masukkan NIK untuk melihat status pendaftaran Anda.</p>
        </div>

        <form action="{{ route('registration.check') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nik" class="form-label fw-bold">NIK</label>

                <input
                    type="text"
                    name="nik"
                    id="nik"
                    class="form-control @error('nik') is-invalid @enderror"
                    placeholder="Masukkan NIK Anda"
                    value="{{ old('nik') }}"
                >

                @error('nik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">
                CEK STATUS
            </button>

            <div class="text-center mt-3">
                <a href="{{ url('/') }}" class="text-decoration-none">
                    Kembali ke Beranda
                </a>
            </div>

        </form>

    </div>

</div>

@endsection