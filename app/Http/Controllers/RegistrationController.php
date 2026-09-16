<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\Registration;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrations = Registration::with([
            'patient',
            'schedule.doctor.specialist',      // Ambil dokter lewat schedule
        ])
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
    $request->validate([
        'name' => 'required',
        'nik' => 'required',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required',
        'no_hp' => 'required',
        'alamat' => 'required',
        'schedule_id' => 'required|exists:schedules,id',
        'keluhan' => 'required',
    ], [
        'name.required' => 'Nama harus diisi',
        'nik.required' => 'NIK harus diisi',
        'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
        'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid',
        'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
        'no_hp.required' => 'Nomor HP harus diisi',
        'alamat.required' => 'Alamat harus diisi',
        'schedule_id.required' => 'Jadwal harus dipilih',
        'schedule_id.exists' => 'Jadwal tidak ditemukan',
        'keluhan.required' => 'Keluhan harus diisi',
    ]);

   $registration = DB::transaction(function () use ($request) {

    $patient = Patient::firstOrCreate(
        ['nik' => $request->nik],
        [
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]
    );

    return Registration::create([
        'patient_id' => $patient->id,
        'schedule_id' => $request->schedule_id,
        'tanggal_daftar' => now()->toDateString(),
        'keluhan' => $request->keluhan,
        'status' => 'menunggu',
        ]);
    });

    return response()->json([
    'success' => true,
    'message' => 'Pendaftaran berhasil',
    'redirect' => route('registration.status', encrypt($registration->id))
        ]);
}

   public function status(string $id)
{
    $registration = Registration::with([
        'patient',
        'schedule.doctor'
    ])->findOrFail(decrypt($id));

    return view('pages.registration.status', compact('registration'));
}

public function checkStatus(string $id)
{
    $registration = Registration::findOrFail(decrypt($id));

    return response()->json([
        'status' => $registration->status
    ]);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $registration = Registration::with([
            'patient',
            'schedule.doctor.specialist',      // Ambil dokter lewat schedule
        ])->findOrFail(decrypt($id));

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


    // TOMBOL CENTANG (KONFIRMASI PASIEN)
    public function approve(Request $request, string $id)
    {
        $registration = Registration::findOrFail(decrypt($id));

        // Cek apakah status masih Menunggu
        if ($registration->status !== 'menunggu') {
            return redirect()->back()
                ->with('error', 'Data sudah diproses sebelumnya!');
        }

        // Ambil data jadwal
        $schedule = Schedule::findOrFail($registration->schedule_id);

        // Cek apakah kuota masih tersedia
        if ($schedule->kuota <= 0) {
            return redirect()->back()
                ->with('error', 'Kuota sudah penuh!');
        }

        // Ubah status menjadi Di konfirmasi
        $registration->update([
            'status' => 'dikonfirmasi'
        ]);

        // Kurangi kuota jadwal
        $schedule->decrement('kuota');

        return redirect()
            ->route('admin.registration.index')
            ->with('success', 'Pendaftaran berhasil dikonfirmasi!');
    }


    // TOMBOL SILANG (TOLAK PASIEN)
    public function reject(string $id)
    {
        $registration = Registration::findOrFail(decrypt($id));

        // Cek apakah status masih Menunggu
        if ($registration->status !== 'menunggu') {
            return redirect()->back()
                ->with('error', 'Data sudah diproses sebelumnya!');
        }

        // Ubah status menjadi Di tolak
        $registration->update([
            'status' => 'ditolak'
        ]);

        return redirect()
            ->route('admin.registration.index')
            ->with('success', 'Pendaftaran berhasil ditolak!');
    }
}