<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();

        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.patient.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:128',
            'nik'           => 'required|string|max:128|unique:patients,nik',
            'tanggal_lahir' => 'required|string|max:128',
            'jenis_kelamin' => 'required|string|max:128',
            'alamat'        => 'required|string|max:128',
            'no_hp'         => 'required|string|max:24',
        ]);

         Patient::create([
            'nama'          => $request->nama,
            'nik'           => $request->nik,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
        ]);

        return redirect()->back()->with('success', 'Data Patient berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return view('pages.patient.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
