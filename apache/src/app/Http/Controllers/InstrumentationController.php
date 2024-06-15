<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instrumentation; // Replace with relevant model

class InstrumentationController extends Controller
{
    // Display a listing of the instrumentations
    public function index()
    {
  
        $instrumentations = Instrumentation::all();
        return view('music_management/instrumentations', compact('instrumentations'));
    }

    // Show the form for creating a new instrumentation
    public function create()
    {
        return view('instrumentations.create');
    }

    // Store a newly created instrumentation in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        Instrumentation::create($validatedData);

        return redirect()->route('instrumentations.index')->with('success', 'Instrumentation created successfully!');
    }

    // Display the specified instrumentation
    public function show(Instrumentation $instrumentation)
    {
        return view('instrumentations.show', compact('instrumentation'));
    }

    // Show the form for editing the specified instrumentation
    public function edit(Instrumentation $instrumentation)
    {
        return view('instrumentations.edit', compact('instrumentation'));
    }

    // Update the specified instrumentation in the database
    public function update(Request $request, Instrumentation $instrumentation)
    {
        $validatedData = $request->validate([
            'edit_name' => 'required|max:255',
        ]);

        $instrumentation->update([
            'name' => $request->edit_name,
        ]);


        return redirect()->route('instrumentations.index')->with('success', 'Instrumentation updated successfully!');
    }

    // Delete the specified instrumentation from the database
    public function destroy(Instrumentation $instrumentation)
    {
        $instrumentation->delete();

        return redirect()->route('instrumentations.index')->with('success', 'Instrumentation deleted successfully!');
    }
}
