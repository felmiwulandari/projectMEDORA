@extends('layouts.auth')

@section('content')

<div class="container min-vh-100 d-flex align-items-center justify-content-center">

    {{-- MENUNGGU --}}
    @if($registration->status == 'menunggu')

        <div class="card shadow text-center" style="width: 245px;">
            <div class="card-body py-4 position-relative">
                <a href="#"
                onclick="history.back(); return false;"
                class="text-secondary position-absolute"
                style="top: 10px; left: 12px; font-size: 20px;">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <div class="mx-auto mb-3 border border-warning rounded-circle
                            d-flex align-items-center justify-content-center text-warning"
                     style="width: 50px; height: 50px; font-size: 25px;">
                    !
                </div>

                <div class="font-weight-bold" style="color: #777;">
                    Menunggu....
                </div>

            </div>
        </div>


    {{-- DIKONFIRMASI --}}
    @elseif($registration->status == 'dikonfirmasi')

        <div class="text-center" style="width: 360px;">

            {{-- JUDUL --}}
            <h2 class="font-weight-bold mb-3"
                style="font-size: 28px; color: white;">
                Pendaftaran Anda Berhasil!
            </h2>

            {{-- CARD --}}
            <div class="card shadow"
                 style="border-radius: 12px;">

                <div class="card-body px-3 py-4"
                     style="color: #212529;">

                    {{-- JUDUL CARD --}}
                    <h4 class="font-weight-bold mb-4"
                        style="font-size: 19px; color: #000;">
                        Ringkasan Pendaftaran
                    </h4>

                    {{-- NAMA PASIEN --}}
                    <div class="row text-left mb-2"
                         style="color: #212529;">
                        <div class="col-6">
                            Nama Pasien
                        </div>
                        <div class="col-6">
                            {{ $registration->patient->name }}
                        </div>
                    </div>

                    {{-- NIK --}}
                    <div class="row text-left mb-2"
                         style="color: #212529;">
                        <div class="col-6">
                            NIK
                        </div>
                        <div class="col-6">
                            {{ $registration->patient->nik }}
                        </div>
                    </div>

                    {{-- TANGGAL PENDAFTARAN --}}
                    <div class="row text-left mb-2"
                         style="color: #212529;">
                        <div class="col-6">
                            Tanggal Pendaftaran
                        </div>
                        <div class="col-6">
                            {{ \Carbon\Carbon::parse($registration->tanggal_daftar)->format('d-m-Y') }}
                        </div>
                    </div>

                    {{-- NAMA DOKTER --}}
                    <div class="row text-left mb-2"
                         style="color: #212529;">
                        <div class="col-6">
                            Nama Dokter
                        </div>
                        <div class="col-6">
                            {{ $registration->schedule->doctor->name }}
                        </div>
                    </div>

                    {{-- KELUHAN --}}
                    <div class="row text-left mb-2"
                         style="color: #212529;">
                        <div class="col-6">
                            Keluhan
                        </div>
                        <div class="col-6">
                            {{ $registration->keluhan }}
                        </div>
                    </div>

                    {{-- TANGGAL DAN JAM PERTEMUAN --}}
                    <div class="row text-left mb-2" style="color: #212529;">
                        <div class="col-6">
                            Jadwal Praktik
                        </div>
                        <div class="col-6">
                            {{ \Carbon\Carbon::parse($registration->schedule->tanggal)->format('d-m-Y') }}
                            <br>
                            {{ \Carbon\Carbon::parse($registration->schedule->jam_mulai)->format('H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($registration->schedule->jam_selesai)->format('H:i') }}
                        </div>
                    </div>

                    {{-- STATUS AKHIR --}}
                    <div class="row text-left align-items-center mb-2"
                         style="color: #212529;">

                        <div class="col-6">
                            Status Akhir
                        </div>

                        <div class="col-6 d-flex align-items-center"
                             style="color: #28a745;">

                            <span class="mr-2"
                                  style="font-size: 24px; line-height: 1;">
                                ✓
                            </span>

                            Dikonfirmasi

                        </div>

                    </div>

                    <hr class="mt-1 mb-3">

                    {{-- CETAK RINGKASAN --}}
                    <button type="button"
                            onclick="window.print()"
                            class="btn btn-primary btn-block font-weight-bold"
                            style="height: 30px; padding: 2px;">
                        Cetak Ringkasan
                    </button>

                    {{-- KEMBALI KE HASIL CEK STATUS --}}
                    <a href="{{ route('registration.check') }}"
                    class="btn btn-secondary btn-block font-weight-bold mb-0"
                    style="height: 30px; padding: 2px;">
                        Kembali
                    </a>

                </div>

            </div>

        </div>


    {{-- DITOLAK --}}
    @elseif($registration->status == 'ditolak')

        <div class="card shadow text-center" style="width: 245px;">
            <div class="card-body py-4 position-relative">
                <a href="#"
                onclick="history.back(); return false;"
                class="text-secondary position-absolute"
                style="top: 10px; left: 12px; font-size: 20px;">
                    <i class="fas fa-chevron-left"></i>
                </a>

                <div class="mx-auto mb-3 border border-danger rounded-circle
                            d-flex align-items-center justify-content-center text-danger"
                     style="width: 50px; height: 50px; font-size: 25px;">
                    ✕
                </div>

                <div class="font-weight-bold" style="color: #777;">
                    Ditolak
                </div>

                <small class="d-block mt-3" style="color: #999;">
                    Mohon maaf, pendaftaran ditolak.
                </small>

            </div>
        </div>

    @endif

</div>


{{-- CEK STATUS OTOMATIS --}}
<script>
    setInterval(function () {

        fetch("{{ route('registration.status.check', encrypt($registration->id)) }}")
            .then(response => response.json())
            .then(data => {

                if (data.status !== "{{ $registration->status }}") {
                    location.reload();
                }

            })
            .catch(error => {
                console.error(error);
            });

    }, 3000);
</script>

@endsection