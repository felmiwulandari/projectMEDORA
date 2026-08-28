<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialist;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::paginate(10);
        return view('pages.doctor.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialists = Specialist::all();
        return view('pages.doctor.create', compact('specialists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialist_id' => 'required|exists:specialists,id',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'no_hp' => 'required|string|max:15',
        ]);

        Doctor::create($request->all());

        return redirect()->route('admin.doctor.index')
            ->with('success', 'Doctor created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor = Doctor::findOrFail(decrypt($id));
        return view('pages.doctor.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor = Doctor::findOrFail(decrypt($id));
        $specialists = Specialist::all();
        return view('pages.doctor.edit', compact('doctor', 'specialists')); // FIX: tanpa 's'
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialist_id' => 'required|exists:specialists,id',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'no_hp' => 'required|string|max:15',
        ]);

        $doctor = Doctor::findOrFail($id);
        $doctor->update($request->all());

        return redirect()->route('admin.doctor.index')
            ->with('success', 'Doctor updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail(decrypt($id));
        $doctor->delete();

        return redirect()->route('admin.doctor.index')
            ->with('success', 'Delete successfully for ID: ' . decrypt($id));
    }
}