<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with([
                'homeTeam:id,name,logo',
                'awayTeam:id,name,logo',
                'jornada:id,name,number',       // ✅ round_number → number
            ])
            ->orderBy('game_datetime', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $games,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jornada_id'    => 'required|exists:jornadas,id',
            'home_team_id'  => 'required|exists:teams,id',
            'away_team_id'  => 'required|exists:teams,id|different:home_team_id',
            'game_datetime' => 'nullable|date',
            'location'      => 'nullable|string|max:255',
            'status'        => 'nullable|in:scheduled,in_progress,finished,cancelled', // ✅
            'home_score'    => 'nullable|integer|min:0',
            'away_score'    => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['status'] = $data['status'] ?? 'scheduled';

        $game = Game::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Partido creado exitosamente',
            'data'    => $game->load(['homeTeam', 'awayTeam', 'jornada']),
        ], 201);
    }

    public function show($id)
    {
        $game = Game::with([
            'homeTeam:id,name,logo,city',
            'awayTeam:id,name,logo,city',
            'jornada:id,name,number,season_id', // ✅ round_number → number
        ])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $game,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $request->validate([
            'jornada_id'    => 'sometimes|required|exists:jornadas,id',
            'home_team_id'  => 'sometimes|required|exists:teams,id',
            'away_team_id'  => 'sometimes|required|exists:teams,id|different:home_team_id',
            'game_datetime' => 'nullable|date',
            'location'      => 'nullable|string|max:255',
            'status'        => 'nullable|in:scheduled,in_progress,finished,cancelled', // ✅
            'home_score'    => 'nullable|integer|min:0',
            'away_score'    => 'nullable|integer|min:0',
        ]);

        $game->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Partido actualizado exitosamente',
            'data'    => $game->load(['homeTeam', 'awayTeam', 'jornada']),
        ], 200);
    }

    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return response()->json([
            'success' => true,
            'message' => 'Partido eliminado exitosamente',
        ], 200);
    }
}