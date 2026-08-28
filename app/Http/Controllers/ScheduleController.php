<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Doctor; // 
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::paginate(10);
        return view('pages.schedule.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::all(); // 
        return view('pages.schedule.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'     => 'required|date|after_or_equal:today', //
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai', // 
            'kuota'       => 'required|integer|min:1|max:100', // 
            'status'      => 'required|in:aktif,tidak aktif',
            'doctor_id'   => 'required|exists:doctors,id',
        ], [ //  CUSTOM ERROR MESSAGE
            'jam_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai',
            'tanggal.after_or_equal' => 'Tanggal tidak boleh kurang dari hari ini',
        ]);

        //  CEK DUPLIKAT
        $existing = Schedule::where('doctor_id', $request->doctor_id)
            ->where('tanggal', $request->tanggal)
            ->where('jam_mulai', $request->jam_mulai)
            ->first();

        if ($existing) {
            return redirect()->back()
                ->with('error', 'Jadwal sudah ada untuk dokter ini di tanggal dan jam tersebut!')
                ->withInput();
        }

        Schedule::create([
            'tanggal'    => $request->tanggal,
            'jam_mulai'  => $request->jam_mulai,
            'jam_selesai'=> $request->jam_selesai,
            'kuota'      => $request->kuota,
            'status'     => $request->status,
            'doctor_id'  => $request->doctor_id,
        ]);

        // REDIRECT
        return redirect()
            ->route('admin.schedule.index')
            ->with('success', 'Berhasil menambahkan data schedule.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $schedule = Schedule::with('doctor')->findOrFail(decrypt($id)); // 
        return view('pages.schedule.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $schedule = Schedule::findOrFail(decrypt($id));
        $doctors = Doctor::all(); // 
        return view('pages.schedule.edit', compact('schedule', 'doctors')); // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $schedule = Schedule::findOrFail(decrypt($id));

        $request->validate([
            'tanggal'     => 'required|date|after_or_equal:today', //
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai', // 
            'kuota'       => 'required|integer|min:1|max:100', // 
            'status'      => 'required|in:aktif,tidak aktif',
            'doctor_id'   => 'required|exists:doctors,id',
        ], [ //  CUSTOM ERROR MESSAGE
            'jam_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai',
            'tanggal.after_or_equal' => 'Tanggal tidak boleh kurang dari hari ini',
        ]);

        // CEK DUPLIKAT (KECUALI DIRINYA SENDIRI)
        $existing = Schedule::where('doctor_id', $request->doctor_id)
            ->where('tanggal', $request->tanggal)
            ->where('jam_mulai', $request->jam_mulai)
            ->where('id', '!=', $schedule->id)
            ->first();

        if ($existing) {
            return redirect()->back()
                ->with('error', 'Jadwal sudah ada untuk dokter ini di tanggal dan jam tersebut!')
                ->withInput();
        }

        $schedule->update([
            'tanggal'    => $request->tanggal,
            'jam_mulai'  => $request->jam_mulai,
            'jam_selesai'=> $request->jam_selesai,
            'kuota'      => $request->kuota,
            'status'     => $request->status,
            'doctor_id'  => $request->doctor_id,
        ]);

        return redirect()
            ->route('admin.schedule.index')
            ->with('success', 'Berhasil mengubah data schedule.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schedule = Schedule::findOrFail(decrypt($id));

        $schedule->delete();

        return redirect()
            ->route('admin.schedule.index')
            ->with('success', 'Berhasil menghapus data schedule.');
    }
}