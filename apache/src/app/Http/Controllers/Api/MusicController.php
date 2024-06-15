<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\MusicCreator;
use App\Models\ApiDocumentation;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function listApiEndpoints()
    {
        $apiDocumentations = ApiDocumentation::pluck('endpoint');
        return response()->json($apiDocumentations);
    }

    public function index()
    {
        $musics = Music::all(); 

        return response()->json($musics);
    }

    public function show($id)
    {
        $music = Music::findOrFail($id); // Assuming Music is the model for your music records

        if (!$music) {
            return response()->json(['error' => 'Music not found'], 404);
        }

        return response()->json($music);
    }

    public function store(Request $request)
    {
        $music = Music::create($request->all());
        return response()->json($music, 201);
    }

    public function update(Request $request, $id)
    {
        $music = Music::find($id);

        if (!$music) {
            return response()->json(['error' => 'Music not found'], 404);
        }

        $music->update($request->all());
        return response()->json($music);
    }

    public function destroy($id)
    {
        $music = Music::find($id);

        if (!$music) {
            return response()->json(['error' => 'Music not found'], 404);
        }

        $music->delete();
        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        $query = Music::query();

        if ($request->has('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->category . '%');
            });
        }

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->has('hymn_number')) {
            $query->where('song_number', $request->hymn_number);
        }

        if ($request->has('arranger')) {
            $query->whereHas('arrangers', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->arranger . '%');
            });
        }
        
        if ($request->has('composer')) {
            $query->orWhereHas('composers', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->composer . '%');
            });
        }
        
        if ($request->has('lyricist')) {
            $query->orWhereHas('lyricists', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->lyricist . '%');
            });
        }
        
        $musics = $query->get();

        return response()->json($musics);
    }

}
