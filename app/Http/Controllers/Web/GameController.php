<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Season;
use App\Models\League;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Mostrar lista de partidos (calendario)
     */
    public function listaPartidos(Request $request)
    {
        // Obtener temporada activa o la seleccionada
        $seasonId = $request->get('season_id');
        
        if (!$seasonId) {
            // Si no hay temporada seleccionada, usar la activa
            $activeSeason = Season::where('is_active', true)->first();
            $seasonId = $activeSeason ? $activeSeason->id : null;
        }
        
        // Query de partidos
        $query = Game::with(['homeTeam', 'awayTeam', 'jornada.season'])
            ->orderBy('game_datetime', 'asc');
        
        // Filtrar por temporada si existe
        if ($seasonId) {
            $query->whereHas('jornada', function($q) use ($seasonId) {
                $q->where('season_id', $seasonId);
            });
        }
        
        // Filtrar por estado si se especifica
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        $games = $query->get();
        
        // Obtener todas las temporadas para el selector
        $seasons = Season::with('league')
            ->orderBy('start_date', 'desc')
            ->get();
        
        // Temporada actual
        $currentSeason = $seasonId ? Season::find($seasonId) : null;
        
        return view('partidos.index', compact('games', 'seasons', 'currentSeason'));
    }
    
    /**
     * Mostrar detalle de un partido
     */
    public function detallePartido($id)
    {
        $game = Game::with([
            'homeTeam.players',
            'awayTeam.players',
            'jornada.season.league'
        ])->findOrFail($id);
        
        return view('partidos.detalle', compact('game'));
    }
    
    /**
     * Mostrar tabla de posiciones
     */
    // Agregar este método en app/Http/Controllers/Web/GameController.php

public function tablaPosiciones()
{
    $leagues = League::where('is_active', true)
        ->with([
            'seasons' => function($query) {
                $query->orderBy('is_active', 'desc')
                      ->orderBy('created_at', 'desc');
            },
            'seasons.standings' => function($query) {
                $query->orderBy('points', 'desc')
                      ->orderBy('goal_difference', 'desc')
                      ->orderBy('goals_for', 'desc');
            },
            'seasons.standings.team'
        ])
        ->get();
    
    return view('clasificacion', compact('leagues'));
}
}