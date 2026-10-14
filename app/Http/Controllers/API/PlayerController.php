<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $query = Player::with('team:id,name,short_name,logo');

        if ($request->has('team_id')) {
            $query->where('team_id', $request->team_id);
        }

        if ($request->has('position')) {
            $query->where('position', $request->position);
        }

        $players = $query->where('is_active', true)->get();

        return response()->json([
            'success' => true,
            'data' => $players,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'jersey_number' => 'required|integer|min:0|max:99',
            'position' => 'required|in:QB,RB,WR,TE,OL,DL,LB,CB,S,K,P',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'birth_date' => 'nullable|date',
            'height' => 'nullable|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
        ]);

        $exists = Player::where('team_id', $request->team_id)
            ->where('jersey_number', $request->jersey_number)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'El número de jersey ya está en uso en este equipo',
            ], 422);
        }

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('players/photos', 'public');
            $data['photo'] = $photoPath;
        }

        $player = Player::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Jugador creado exitosamente',
            'data' => $player->load('team'),
        ], 201);
    }

    public function show($id)
    {
        $player = Player::with(['team', 'gameStats'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $player,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $player = Player::findOrFail($id);

        $request->validate([
            'team_id' => 'sometimes|required|exists:teams,id',
            'name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'jersey_number' => 'sometimes|required|integer|min:0|max:99',
            'position' => 'sometimes|required|in:QB,RB,WR,TE,OL,DL,LB,CB,S,K,P',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'birth_date' => 'nullable|date',
            'height' => 'nullable|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'is_active' => 'sometimes|boolean',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            if ($player->photo) {
                Storage::disk('public')->delete($player->photo);
            }
            $photoPath = $request->file('photo')->store('players/photos', 'public');
            $data['photo'] = $photoPath;
        }

        $player->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Jugador actualizado exitosamente',
            'data' => $player->load('team'),
        ], 200);
    }

    public function destroy($id)
    {
        $player = Player::findOrFail($id);

        if ($player->photo) {
            Storage::disk('public')->delete($player->photo);
        }

        $player->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jugador eliminado exitosamente',
        ], 200);
    }
}