<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedule = Schedule::all();
        return view('pages.schedule.index', compact('schedule'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'     => 'required|date',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'kuota'       => 'required|integer|min:1',
            'status'      => 'required|in:aktif,tidak aktif',
            'doctor_id'   => 'required|exists:doctors,id',
        ]);

        Schedule::create([
            'tanggal'    => $request->tanggal,
            'jam_mulai'  => $request->jam_mulai,
            'jam_selesai'=> $request->jam_selesai,
            'kuota'      => $request->kuota,
            'status'     => $request->status,
            'doctor_id'     => $request->doctor_id,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
