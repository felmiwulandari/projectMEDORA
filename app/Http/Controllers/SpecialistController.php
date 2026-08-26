<?php

namespace App\Http\Controllers;

use App\Models\Specialist;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialists = Specialist::all();
        return view('pages.specialist.index', compact('specialists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.specialist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'status' => 'required',
        ]);

        $specialists = Specialist::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.specialist.index')
         ->with('success', 'Create new specialist is successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $specialists = Specialist::findOrFail(decrypt($id));
        return view('pages.specialist.show', compact('specialists'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $specialists = Specialist::findOrFail(decrypt($id));
        return view('pages.specialist.edit', compact('specialists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'status' => 'required'
        ]);

        $specialists = Specialist::findOrFail($id);
        $specialists->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.specialist.index')
            ->with('success', 'Specialist data successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $specialists = Specialist::findOrFail(decrypt($id));
        $specialists->delete();
 
        return redirect()->route('admin.specialist.index')
        ->with('success', 'Delete successfully for ID:' . (decrypt($id)));
    }
}
