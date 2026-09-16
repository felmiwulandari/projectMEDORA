<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $menunggu = Registration::whereDate('tanggal_daftar', today())
            ->where('status', 'menunggu')
            ->count();

        $dikonfirmasi = Registration::whereDate('tanggal_daftar', today())
            ->where('status', 'dikonfirmasi')
            ->count();

        $totalPasien = Registration::whereDate('tanggal_daftar', today())
            ->distinct()
            ->count('patient_id');

        return view('pages.dashboard.index', compact(
        'menunggu',
        'dikonfirmasi',
        'totalPasien'
    ));
    }
}