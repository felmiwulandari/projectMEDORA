<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Registration;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
{
    // Pasien hari ini yang sudah dikonfirmasi
    $totalPasien = Registration::whereDate('tanggal_daftar', today())
        ->where('status', 'dikonfirmasi')
        ->distinct()
        ->count('patient_id');

    // Semua pendaftaran hari ini
    $pendaftaranHariIni = Registration::whereDate(
        'tanggal_daftar',
        today()
    )->count();

    // Pendaftaran hari ini yang masih menunggu
    $menunggu = Registration::whereDate('tanggal_daftar', today())
        ->where('status', 'menunggu')
        ->count();

    return view('home', compact(
        'totalPasien',
        'pendaftaranHariIni',
        'menunggu'
        ));
    }
}