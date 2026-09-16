<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialist;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::paginate(10);

        return view('pages.doctor.index', compact('doctors'));
    }

    public function create()
    {
        $specialists = Specialist::all();

        return view('pages.doctor.create', compact('specialists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialist_id' => 'required|exists:specialists,id',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'no_hp' => 'required|digits_between:10,13',
        ], [
            'name.required' => 'Nama dokter harus diisi.',
            'name.string' => 'Nama dokter harus berupa teks.',
            'name.max' => 'Nama dokter maksimal 255 karakter.',

            'specialist_id.required' => 'Spesialis harus dipilih.',
            'specialist_id.exists' => 'Spesialis tidak ditemukan.',

            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status tidak valid.',

            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.digits_between' => 'Nomor HP harus terdiri dari 10–13 angka.',
        ]);

        Doctor::create($request->all());

        return redirect()->route('admin.doctor.index')
            ->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $doctor = Doctor::findOrFail(decrypt($id));

        return view('pages.doctor.show', compact('doctor'));
    }

    public function edit(string $id)
    {
        $doctor = Doctor::findOrFail(decrypt($id));
        $specialists = Specialist::all();

        return view('pages.doctor.edit', compact('doctor', 'specialists'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialist_id' => 'required|exists:specialists,id',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'no_hp' => 'required|digits_between:10,13',
        ], [
            'name.required' => 'Nama dokter harus diisi.',
            'name.string' => 'Nama dokter harus berupa teks.',
            'name.max' => 'Nama dokter maksimal 255 karakter.',

            'specialist_id.required' => 'Spesialis harus dipilih.',
            'specialist_id.exists' => 'Spesialis tidak ditemukan.',

            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status tidak valid.',

            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.digits_between' => 'Nomor HP harus terdiri dari 10–13 angka.',
        ]);

        $doctor = Doctor::findOrFail($id);

        $doctor->update($request->all());

        return redirect()->route('admin.doctor.index')
            ->with('success', 'Dokter berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail(decrypt($id));

        $doctor->delete();

        return redirect()->route('admin.doctor.index')
            ->with('success', 'Dokter berhasil dihapus.');
    }
}