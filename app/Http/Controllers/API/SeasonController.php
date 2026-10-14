<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index()
    {
        $seasons = Season::with('league:id,name')
            ->orderBy('year', 'desc')
            ->orderBy('start_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $seasons,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'league_id' => 'required|exists:leagues,id',
            'name' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:2100',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $season = Season::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Temporada creada exitosamente',
            'data' => $season,
        ], 201);
    }

    public function show($id)
    {
        $season = Season::with(['league:id,name', 'jornadas'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $season,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $season = Season::findOrFail($id);

        $request->validate([
            'league_id' => 'sometimes|required|exists:leagues,id',
            'name' => 'sometimes|required|string|max:255',
            'year' => 'sometimes|required|integer|min:2000|max:2100',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'sometimes|boolean',
        ]);

        $season->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Temporada actualizada exitosamente',
            'data' => $season,
        ], 200);
    }

    public function destroy($id)
    {
        $season = Season::findOrFail($id);
        
        // Verificar si tiene jornadas asociadas
        if ($season->jornadas()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede eliminar una temporada con jornadas asociadas',
            ], 400);
        }

        $season->delete();

        return response()->json([
            'success' => true,
            'message' => 'Temporada eliminada exitosamente',
        ], 200);
    }
}