<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Specialist;
use App\Models\Doctor;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Menampilkan daftar pasien untuk Admin (index.blade.php)
     */
    public function index()
    {
        $patients = Patient::all();

        return view('patients.index', compact('patients'));
    }

    /**
     * Menampilkan form pendaftaran data diri pasien (welcome.blade.php)
     */
    public function create()
    {
        // Mengambil data specialist dan doctor untuk kebutuhan dropdown di view jika diperlukan
        $specialists = Specialist::all();
        $doctors     = Doctor::all();

        return view('welcome', compact('specialists', 'doctors'));
    }

    /**
     * Menyimpan data pasien dari form pendaftaran
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:128',
            'nik'           => 'required|string|max:128|unique:patients,nik',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:128',
            'alamat'        => 'required|string|max:255',
            'no_hp'         => 'required|string|max:24',
        ]);

        // Simpan Data Pasien
        $patient = Patient::create([
            'name'          => $request->name,
            'nik'           => $request->nik,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
        ]);

        return redirect()->back()->with('success', 'Data Pasien berhasil disimpan!');
    }

    /**
     * Menampilkan detail data pasien untuk Admin (show.blade.php)
     */
    public function show(Patient $patient)
    {
        return view('pages.patient.show', compact('patient'));
    }
}