<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Schedule;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrations = Registration::with(['patient', 'specialist', 'schedule'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.registration.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $registration = Registration::with(['patient', 'specialist', 'schedule'])
             ->findOrFail(decrypt($id));

        return view('pages.registration.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
    //  TOMBOL CENTANG (TERIMA/SETUJU PASIEN)
    public function approve($id)
    {
        $registration = Registration::findOrFail(decrypt($id));
        
        // Cek apakah status masih 'menunggu'
        if ($registration->status !== 'menunggu') {
            return redirect()->back()
                ->with('error', 'Data sudah diproses sebelumnya!');
        }

        // Cek kuota schedule
        $schedule = Schedule::findOrFail($registration->schedule_id);
        if ($schedule->kuota <= 0) {
            return redirect()->back()
                ->with('error', 'Kuota sudah penuh!');
        }

        // Update status jadi 'diterima' dan kurangi kuota
        $registration->update(['status' => 'diterima']);
        $schedule->decrement('kuota');

        return redirect()
            ->route('pages.Registration.index')
            ->with('success', '✅ Pendaftaran berhasil diterima!');
    }


    //  TOMBOL SILANG (TOLAK PASIEN)
    public function reject($id)
    {
        $registration = Registration::findOrFail(decrypt($id));
        
        // Cek apakah status masih 'menunggu'
        if ($registration->status !== 'menunggu') {
            return redirect()->back()
                ->with('error', 'Data sudah diproses sebelumnya!');
        }

        // Update status jadi 'ditutup'
        $registration->update(['status' => 'ditutup']);

        return redirect()
            ->route('pages.Registration.index')
            ->with('success', '❌ Mohon maaf,Pendaftaran ditolak kuota sudah habis!');
    }
}