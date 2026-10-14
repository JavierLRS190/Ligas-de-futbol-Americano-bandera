<?php

// ============================================
// app/Http/Controllers/Web/CoachController.php
// COACH CON CONTROL TOTAL DE SU EQUIPO
// ============================================

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Player;
use App\Models\User;
use App\Models\Play;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class CoachController extends Controller
{
    // ===== DASHBOARD =====

    public function panelCoach()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión primero.');
        }

        $team = $user->team;

        if (!$team) {
            return redirect()->route('home')
                ->with('error', 'No tienes un equipo asignado. Contacta al administrador.');
        }

        $team->loadMissing(['players', 'plays']);

        $stats = [
            'total_players'  => $team->players->count(),
            'active_players' => $team->players->where('is_active', true)->count(),
            'total_plays'    => $team->plays->count(),
        ];

        return view('coach.panel-coach', compact('team', 'stats'));
    }

    // ===== GESTIÓN DEL EQUIPO =====

    public function miEquipo()
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        return view('coach.detalle-equipo', compact('team'));
    }

    public function editarMiEquipo()
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        return view('coach.editar-equipo', compact('team'));
    }

    public function actualizarMiEquipo(Request $request)
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        $validated = $request->validate([
            'name'         => 'required|string|max:255|unique:teams,name,' . $team->id,
            'short_name'   => 'required|string|max:10',
            'city'         => 'nullable|string|max:255',
            'stadium'      => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'founded_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'logo'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($team->logo) {
                Storage::disk('public')->delete($team->logo);
            }
            $validated['logo'] = $request->file('logo')->store('teams/logos', 'public');
        }

        $team->update($validated);

        return redirect()->route('coach.team.show')
            ->with('success', 'Equipo actualizado exitosamente');
    }

    // ===== GESTIÓN DE JUGADORES =====

    public function listaJugadores()
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        $players = $team->players()->latest()->get();

        return view('coach.lista-jugadores', compact('players', 'team'));
    }

    public function crearJugador()
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        return view('coach.crear-jugador', compact('team'));
    }

    public function guardarJugador(Request $request)
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        // ── Validación unificada: jugador + usuario ──────────────
        $request->validate([
            // Datos del jugador
            'name'         => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'jersey_number'=> 'required|integer|min:0|max:99',
            'position'     => 'required|in:QB,RB,WR,TE,OL,DL,LB,CB,S,K,P',
            'birth_date'   => 'nullable|date',
            'height'       => 'nullable|numeric|min:0',
            'weight'       => 'nullable|numeric|min:0',
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active'    => 'sometimes|boolean',
            // Datos de la cuenta de usuario
            'email'        => 'required|email|max:255|unique:users,email',
            'phone'        => 'nullable|string|max:20',
            'password'     => ['required', 'confirmed', Password::min(8)],
        ]);

        // Verificar que el número de jersey no esté en uso en el equipo
        $jerseyExists = $team->players()
            ->where('jersey_number', $request->jersey_number)
            ->exists();

        if ($jerseyExists) {
            return back()->withErrors([
                'jersey_number' => 'Este número ya está en uso en tu equipo',
            ])->withInput();
        }

        // ── Crear ambos registros en una transacción ─────────────
        DB::transaction(function () use ($request, $team) {

            // 1. Crear el User con role 'player'
            $user = User::create([
                'name'      => $request->name . ' ' . $request->last_name,
                'email'     => $request->email,
                'password'  => $request->password, // cast 'hashed' lo encripta
                'role'      => 'player',
                'team_id'   => $team->id,
                'phone'     => $request->phone,
                'is_active' => $request->boolean('is_active', true),
            ]);

            // 2. Manejar foto del jugador
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')
                    ->store('players/photos', 'public');
            }

            // 3. Crear el Player vinculado al User
            Player::create([
                'user_id'       => $user->id,
                'team_id'       => $team->id,
                'name'          => $request->name,
                'last_name'     => $request->last_name,
                'birth_date'    => $request->birth_date,
                'jersey_number' => $request->jersey_number,
                'position'      => $request->position,
                'height'        => $request->height,
                'weight'        => $request->weight,
                'photo'         => $photoPath,
                'is_active'     => $request->boolean('is_active', true),
            ]);
        });

        return redirect()->route('coach.players.index')
            ->with('success', 'Jugador y cuenta de acceso creados correctamente.');
    }

    public function editarJugador($id)
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        // Cargar el jugador con su usuario vinculado
        $player = $team->players()->with('user')->findOrFail($id);

        return view('coach.editar-jugador', compact('player', 'team'));
    }

    public function actualizarJugador(Request $request, $id)
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        // Cargar jugador con su usuario
        $player = $team->players()->with('user')->findOrFail($id);

        // ── Validación: datos del jugador ────────────────────────
        $request->validate([
            'name'          => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'jersey_number' => 'required|integer|min:0|max:99',
            'position'      => 'required|in:QB,RB,WR,TE,OL,DL,LB,CB,S,K,P',
            'birth_date'    => 'nullable|date',
            'height'        => 'nullable|numeric|min:0',
            'weight'        => 'nullable|numeric|min:0',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active'     => 'sometimes|boolean',
        ]);

        // ── Validación condicional: datos del usuario ────────────
        if ($player->user) {
            $request->validate([
                'user_name'     => 'required|string|max:255',
                'user_email'    => 'required|email|max:255|unique:users,email,' . $player->user->id,
                'user_phone'    => 'nullable|string|max:20',
                // Contraseña solo obligatoria si se proporciona
                'user_password' => ['nullable', 'confirmed', Password::min(8)],
                'user_avatar'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'user_is_active'=> 'sometimes|boolean',
            ]);
        }

        // Verificar número de jersey (excluye el jugador actual)
        $jerseyExists = $team->players()
            ->where('jersey_number', $request->jersey_number)
            ->where('id', '!=', $id)
            ->exists();

        if ($jerseyExists) {
            return back()->withErrors([
                'jersey_number' => 'Este número ya está en uso en tu equipo',
            ])->withInput();
        }

        // ── Actualizar en una transacción ────────────────────────
        DB::transaction(function () use ($request, $player) {

            // 1. Actualizar foto del jugador
            $photoPath = $player->photo;
            if ($request->hasFile('photo')) {
                if ($player->photo) {
                    Storage::disk('public')->delete($player->photo);
                }
                $photoPath = $request->file('photo')
                    ->store('players/photos', 'public');
            }

            // 2. Actualizar datos del jugador
            $player->update([
                'name'          => $request->name,
                'last_name'     => $request->last_name,
                'birth_date'    => $request->birth_date,
                'jersey_number' => $request->jersey_number,
                'position'      => $request->position,
                'height'        => $request->height,
                'weight'        => $request->weight,
                'photo'         => $photoPath,
                'is_active'     => $request->boolean('is_active', false),
            ]);

            // 3. Actualizar User vinculado (si existe)
            if ($player->user) {

                $userAvatar = $player->user->avatar;
                if ($request->hasFile('user_avatar')) {
                    if ($player->user->avatar) {
                        Storage::disk('public')->delete($player->user->avatar);
                    }
                    $userAvatar = $request->file('user_avatar')
                        ->store('users/avatars', 'public');
                }

                $userUpdates = [
                    'name'      => $request->user_name,
                    'email'     => $request->user_email,
                    'phone'     => $request->user_phone,
                    'avatar'    => $userAvatar,
                    'is_active' => $request->boolean('user_is_active', false),
                ];

                // Solo actualizar contraseña si se proporcionó una nueva
                if ($request->filled('user_password')) {
                    $userUpdates['password'] = $request->user_password; // cast 'hashed' la encripta
                }

                $player->user->update($userUpdates);
            }
        });

        return redirect()->route('coach.players.index')
            ->with('success', 'Jugador actualizado correctamente.');
    }

    public function eliminarJugador($id)
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        $player = $team->players()->with('user')->findOrFail($id);

        DB::transaction(function () use ($player) {
            // Eliminar foto del jugador
            if ($player->photo) {
                Storage::disk('public')->delete($player->photo);
            }

            // Eliminar avatar y cuenta del usuario vinculado
            if ($player->user) {
                if ($player->user->avatar) {
                    Storage::disk('public')->delete($player->user->avatar);
                }
                $player->user->delete();
            }

            $player->delete();
        });

        return redirect()->route('coach.players.index')
            ->with('success', 'Jugador eliminado correctamente.');
    }

    // ===== GESTIÓN DE JUGADAS (PRIVADAS) =====

    public function listaJugadas()
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        $plays = $team->plays()->latest()->get();

        return view('coach.lista-jugadas', compact('plays', 'team'));
    }

    public function crearJugada()
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        return view('coach.crear-jugada', compact('team'));
    }

    public function guardarJugada(Request $request)
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'required|in:offense,defense,special',
            'diagram'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video_url'   => 'nullable|url|max:500',
        ]);

        $validated['team_id']    = $team->id;
        $validated['is_private'] = true;

        if ($request->hasFile('diagram')) {
            $validated['diagram'] = $request->file('diagram')
                ->store('plays/diagrams', 'public');
        }

        Play::create($validated);

        return redirect()->route('coach.plays.index')
            ->with('success', 'Jugada creada exitosamente');
    }

    public function editarJugada($id)
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        $play = $team->plays()->findOrFail($id);

        return view('coach.editar-jugada', compact('play', 'team'));
    }

    public function actualizarJugada(Request $request, $id)
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        $play = $team->plays()->findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'required|in:offense,defense,special',
            'diagram'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video_url'   => 'nullable|url|max:500',
        ]);

        if ($request->hasFile('diagram')) {
            if ($play->diagram) {
                Storage::disk('public')->delete($play->diagram);
            }
            $validated['diagram'] = $request->file('diagram')
                ->store('plays/diagrams', 'public');
        }

        $play->update($validated);

        return redirect()->route('coach.plays.index')
            ->with('success', 'Jugada actualizada exitosamente');
    }

    public function eliminarJugada($id)
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        $play = $team->plays()->findOrFail($id);

        if ($play->diagram) {
            Storage::disk('public')->delete($play->diagram);
        }

        $play->delete();

        return redirect()->route('coach.plays.index')
            ->with('success', 'Jugada eliminada exitosamente');
    }

    // ===== ESTADÍSTICAS =====

    public function estadisticas()
    {
        $team = Auth::user()->team;

        if (!$team) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'No tienes un equipo asignado.');
        }

        $team->loadMissing(['players', 'plays']);

        $stats = [
            'total_players'  => $team->players->count(),
            'active_players' => $team->players->where('is_active', true)->count(),
            'total_plays'    => $team->plays->count(),
        ];

        return view('coach.estadisticas', compact('team', 'stats'));
    }

    // ===== VISTAS PÚBLICAS =====

    public function listaPartidos()
    {
        return view('coach.lista-partidos');
    }

    public function tablaPosiciones()
    {
        return view('coach.tabla-posiciones');
    }
}