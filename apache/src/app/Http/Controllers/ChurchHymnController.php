<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChurchHymn;

class ChurchHymnController extends Controller
{
    // Display a listing of the church hymns
    public function index()
    {
        $hymns = ChurchHymn::all();
        return view('church_hymns.index', compact('hymns'));
    }

    // Show the form for creating a new church hymn
    public function create()
    {
        return view('church_hymns.create');
    }

    // Store a newly created church hymn in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        ChurchHymn::create($validatedData);

        return redirect()->route('hymns.index')->with('success', 'Church hymn created successfully!');
    }

    // Display the specified church hymn
    public function show(ChurchHymn $hymn)
    {
        return view('church_hymns.show', compact('hymn'));
    }

    // Show the form for editing the specified church hymn
    public function edit(ChurchHymn $hymn)
    {
        return view('church_hymns.edit', compact('hymn'));
    }

    // Update the specified church hymn in the database
    public function update(Request $request, ChurchHymn $hymn)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $hymn->update($validatedData);

        return redirect()->route('hymns.index')->with('success', 'Church hymn updated successfully!');
    }

    // Delete the specified church hymn from the database
    public function destroy(ChurchHymn $hymn)
    {
        $hymn->delete();

        return redirect()->route('hymns.index')->with('success', 'Church hymn deleted successfully!');
    }
}
