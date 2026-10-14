<?php

// ============================================
// app/Http/Controllers/Web/PlayerController.php
// ============================================

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    /**
     * Dashboard principal del jugador.
     * Muestra: info del equipo, su perfil, roster de compañeros.
     */
    public function dashboard()
{
    $user   = Auth::user();
    $player = $user->player;
    $team   = $player->team;

    $teammates = $team->players()->orderBy('jersey_number')->get();
    $plays     = $team->plays()->orderBy('type')->get(); // ← agregar esto

    return view('player.panel-player', compact('player', 'team', 'teammates', 'plays'));
}

    /**
     * Ver y editar perfil del jugador (foto, teléfono, contraseña).
     */
    public function profile()
    {
        $user   = Auth::user();
        $player = $user->player;

        if (!$player) {
            return redirect()->route('player.dashboard')
                ->with('error', 'No tienes un perfil de jugador asignado.');
        }

        return view('player.perfil', compact('player', 'user'));
    }
}