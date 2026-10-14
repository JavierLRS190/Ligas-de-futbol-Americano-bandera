<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Team;

class TeamController extends Controller
{
    public function listaEquipos()
    {
        $teams = Team::where('is_active', true)
            ->withCount('players')
            ->orderBy('name', 'asc')
            ->get();
        
        return view('equipos.lista-equipos', compact('teams'));
    }
    
    public function detalleEquipo($id)
    {
        $team = Team::with(['players' => function($query) {
            $query->where('is_active', true)
                  ->orderBy('jersey_number', 'asc');
        }])->findOrFail($id);
        
        // Agrupar jugadores por posición
        $playersByPosition = $team->players->groupBy('position');
        
        // Estadísticas del equipo
        $stats = [
            'total_players' => $team->players->count(),
            'positions_covered' => $playersByPosition->keys()->count(),
        ];
        
        return view('equipos.detalle-equipo', compact('team', 'playersByPosition', 'stats'));
    }
}