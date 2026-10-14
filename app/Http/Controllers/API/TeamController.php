<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::where('is_active', true)
            ->withCount('players')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $teams,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'league_id' => 'required|exists:leagues,id',
            'name' => 'required|string|max:255|unique:teams',
            'short_name' => 'required|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'city' => 'nullable|string|max:255',
            'stadium' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'founded_year' => 'nullable|integer|min:1900|max:' . date('Y'),
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('teams/logos', 'public');
            $data['logo'] = $logoPath;
        }

        $team = Team::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Equipo creado exitosamente',
            'data' => $team,
        ], 201);
    }

    public function show($id)
    {
        $team = Team::with([
            'players' => function ($query) {
                $query->where('is_active', true);
            }
        ])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $team,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:teams,name,' . $id,
            'short_name' => 'sometimes|required|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'city' => 'nullable|string|max:255',
            'stadium' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'founded_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'is_active' => 'sometimes|boolean',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            if ($team->logo) {
                Storage::disk('public')->delete($team->logo);
            }
            $logoPath = $request->file('logo')->store('teams/logos', 'public');
            $data['logo'] = $logoPath;
        }

        $team->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Equipo actualizado exitosamente',
            'data' => $team,
        ], 200);
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        if ($team->logo) {
            Storage::disk('public')->delete($team->logo);
        }

        $team->delete();

        return response()->json([
            'success' => true,
            'message' => 'Equipo eliminado exitosamente',
        ], 200);
    }

    public function players($id)
    {
        $team = Team::findOrFail($id);
        $players = $team->players()->where('is_active', true)->get();

        return response()->json([
            'success' => true,
            'data' => $players,
        ], 200);
    }

    public function plays($id)
{
    $team = Team::findOrFail($id);
    $plays = $team->plays()
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'success' => true,
        'data' => $plays,
    ], 200);
}
}