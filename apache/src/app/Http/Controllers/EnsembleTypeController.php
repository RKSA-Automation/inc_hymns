<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnsembleType; // Replace with relevant model

class EnsembleTypeController extends Controller
{ 
    // Display a listing of the ensembletypes
    public function index()
    {
    
        $ensembletypes = EnsembleType::all();
        return view('music_management/ensemble_types', compact('ensembletypes'));
    }

    // Show the form for creating a new ensembletype
    public function create()
    {
        return view('ensembletypes.create');
    }

    // Store a newly created ensembletype in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        EnsembleType::create($validatedData);

        return redirect()->route('ensemble_types.index')->with('success', 'EnsembleType created successfully!');
    }

    // Display the specified ensembletype
    public function show(EnsembleType $ensembletype)
    {
        return view('ensembletypes.show', compact('ensembletype'));
    }

    // Show the form for editing the specified ensembletype
    public function edit(EnsembleType $ensembletype)
    {
        return view('ensembletypes.edit', compact('ensembletype'));
    }

    // Update the specified ensembletype in the database
    public function update(Request $request, EnsembleType $ensemble_type)
    {
        //dd( $ensemble_type);
        $validatedData = $request->validate([
            'edit_name' => 'required|max:255',
        ]);

        $ensemble_type->update([
            'name' => $request->edit_name,
        ]);


        return redirect()->route('ensemble_types.index')->with('success', 'EnsembleType updated successfully!');
    }

    // Delete the specified ensembletype from the database
    public function destroy(EnsembleType $ensemble_type)
    {
        $ensemble_type->delete();

        return redirect()->route('ensemble_types.index')->with('success', 'EnsembleType deleted successfully!');
    }
}
