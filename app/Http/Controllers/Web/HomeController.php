<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\League;
use App\Models\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Página de inicio - Vista general de todas las ligas
     */
    public function inicio()
    {
        $leagues = League::where('is_active', true)
            ->with([
                'teams' => fn($q) => $q->where('is_active', true)->withCount('players'),
                'seasons' => function($q) {
                    $q->orderBy('is_active', 'desc')
                      ->orderBy('created_at', 'desc');
                },
                'seasons.standings.team',
            ])
            ->withCount(['teams', 'seasons'])
            ->get();

        // Standings de la temporada activa - CORREGIDO
        foreach ($leagues as $league) {
            $activeSeason = $league->seasons
                ->where('is_active', true)->first()
                ?? $league->seasons->first();

            $league->standings = $activeSeason && $activeSeason->standings
                ? $activeSeason->standings
                    ->load('team')
                    ->sortByDesc('points')
                    ->sortByDesc('goal_difference')
                : collect();
        }

        // Partidos próximos - ordenar por game_datetime
        try {
            $games = Game::with(['homeTeam', 'awayTeam', 'jornada.season'])
                ->orderBy('game_datetime', 'asc')
                ->limit(10)
                ->get()
                ->groupBy(fn($g) => \Carbon\Carbon::parse($g->game_datetime)->format('Y-m-d'));
        } catch (\Exception $e) {
            $games = collect();
        }

        return view('home', compact('leagues', 'games'));
    }

    /**
     * Vista específica de una liga
     */
    public function leagueHome($leagueId)
    {
        $league = League::where('is_active', true)
            ->with([
                'teams' => fn($q) => $q->where('is_active', true),
                'seasons' => function($q) {
                    $q->orderBy('is_active', 'desc')
                      ->orderBy('created_at', 'desc');
                }
            ])
            ->findOrFail($leagueId);

        // Temporada activa
        $activeSeason = $league->seasons
            ->where('is_active', true)->first()
            ?? $league->seasons->first();

        // Tabla de posiciones de la temporada activa
        $standings = $activeSeason 
            ? $activeSeason->standings()
                ->with('team')
                ->orderBy('points', 'desc')
                ->orderBy('goal_difference', 'desc')
                ->orderBy('goals_for', 'desc')
                ->get()
            : collect();

        // Próximos partidos de esta liga
        $games = Game::with(['homeTeam', 'awayTeam', 'jornada'])
            ->whereHas('jornada.season', function($q) use ($league) {
                $q->where('league_id', $league->id);
            })
            ->where('game_datetime', '>=', now())
            ->orderBy('game_datetime', 'asc')
            ->limit(5)
            ->get();

        return view('league.home', compact('league', 'activeSeason', 'standings', 'games'));
    }

    /**
     * Tabla de posiciones / Clasificación general
     */
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