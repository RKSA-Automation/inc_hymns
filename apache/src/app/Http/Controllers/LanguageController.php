<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language; // Replace with relevant model

class LanguageController  extends Controller
{ 
    // Display a listing of the language
    public function index()
    {
        $language = Language::all();
        return view('language.index', compact('language'));
    }

    // Show the form for creating a new language
    public function create()
    {
        return view('language.create');
    }

    // Store a newly created language in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        Language::create($validatedData);

        return redirect()->route('language.index')->with('success', 'Language created successfully!');
    }

    // Display the specified language
    public function show(Language $language)
    {
        return view('language.show', compact('language'));
    }

    // Show the form for editing the specified language
    public function edit(Language $language)
    {
        return view('language.edit', compact('language'));
    }

    // Update the specified language in the database
    public function update(Request $request, Language $language)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $language->update($validatedData);

        return redirect()->route('language.index')->with('success', 'Language updated successfully!');
    }

    // Delete the specified language from the database
    public function destroy(Language $language)
    {
        $language->delete();

        return redirect()->route('language.index')->with('success', 'Language deleted successfully!');
    }
}
