<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jornada;
use Illuminate\Http\Request;

class JornadaController extends Controller
{
    public function index()
    {
        try {
            $jornadas = Jornada::with('season:id,name')
                ->orderBy('season_id', 'desc')
                ->orderBy('id', 'asc')
                ->get()
                ->map(function ($jornada) {
                    return [
                        'id' => $jornada->id,
                        'season_id' => $jornada->season_id,
                        'season_name' => $jornada->season ? $jornada->season->name : null,
                        'name' => $jornada->name,
                        'start_date' => $jornada->start_date,
                        'end_date' => $jornada->end_date,
                        'is_completed' => $jornada->is_completed ?? false,
                        'created_at' => $jornada->created_at,
                        'updated_at' => $jornada->updated_at,
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $jornadas,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener jornadas',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'season_id' => 'required|exists:seasons,id',
                'name' => 'required|string|max:255',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
            ]);

            $jornada = Jornada::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Jornada creada exitosamente',
                'data' => $jornada->load('season:id,name'),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear jornada',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $jornada = Jornada::with('season:id,name')->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $jornada->id,
                    'season_id' => $jornada->season_id,
                    'season_name' => $jornada->season ? $jornada->season->name : null,
                    'name' => $jornada->name,
                    'start_date' => $jornada->start_date,
                    'end_date' => $jornada->end_date,
                    'is_completed' => $jornada->is_completed ?? false,
                    'created_at' => $jornada->created_at,
                    'updated_at' => $jornada->updated_at,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Jornada no encontrada',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $jornada = Jornada::findOrFail($id);

            $request->validate([
                'season_id' => 'sometimes|required|exists:seasons,id',
                'name' => 'sometimes|required|string|max:255',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'is_completed' => 'sometimes|boolean',
            ]);

            $jornada->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Jornada actualizada exitosamente',
                'data' => $jornada->load('season:id,name'),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar jornada',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $jornada = Jornada::findOrFail($id);
            $jornada->delete();

            return response()->json([
                'success' => true,
                'message' => 'Jornada eliminada exitosamente',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar jornada',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}