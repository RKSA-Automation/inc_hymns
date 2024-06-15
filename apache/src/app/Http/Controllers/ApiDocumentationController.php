<?php

// app/Http/Controllers/ApiDocumentationController.php

namespace App\Http\Controllers;

use App\Models\ApiDocumentation;
use Illuminate\Http\Request;

class ApiDocumentationController extends Controller
{
    public function index()
    {
        $apiDocumentations = ApiDocumentation::all();
        
        return view('api_documentations.index', compact('apiDocumentations'));
    }

    public function create()
    {
        return view('api_documentations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'endpoint' => 'required|string',
            'description' => 'required|string',
        ]);

        ApiDocumentation::create($request->all());
        return redirect()->route('api_documentations.index')->with('success', 'API Documentation created successfully.');
    }

    public function edit(ApiDocumentation $apiDocumentation)
    {
        return view('api_documentations.edit', compact('apiDocumentation'));
    }

    public function update(Request $request, ApiDocumentation $apiDocumentation)
    {
        $request->validate([
            'endpoint' => 'required|string',
            'description' => 'required|string',
        ]);

        $apiDocumentation->update($request->all());
        return redirect()->route('api_documentations.index')->with('success', 'API Documentation updated successfully.');
    }

    public function destroy(ApiDocumentation $apiDocumentation)
    {
        $apiDocumentation->delete();
        return redirect()->route('api_documentations.index')->with('success', 'API Documentation deleted successfully.');
    }
}
