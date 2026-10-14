<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Player;
use App\Models\Play;
use App\Models\League;
use App\Models\Season;
use App\Models\Jornada;
use App\Models\Game;
use App\Models\Standing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AdminController extends Controller
{
    // ============================================
    // DASHBOARD
    // ============================================
    public function panelAdministrador()
    {
       $stats = [
            'leagues' => League::count(),
            'active_leagues' => League::where('is_active', true)->count(),
            'teams' => Team::count(),
            'players' => Player::count(),
            'active_teams' => Team::where('is_active', true)->count(),
        ];
        
        return view('admin.panel-administrador', compact('stats'));
    }
    
    // ============================================
    // GESTIÓN DE LIGAS
    // ============================================
    
    public function listaLigas()
    {
        $leagues = League::withCount(['teams', 'seasons'])
                        ->latest()
                        ->get();
        
        return view('admin.lista-ligas', compact('leagues'));
    }

    public function crearLiga()
    {
        return view('admin.crear-liga');
    }

    public function guardarLiga(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:leagues|max:255',
            'short_name' => 'required|max:50',
            'logo' => 'nullable|image|max:2048',
            'description' => 'nullable',
            'country' => 'nullable|max:100',
            'city' => 'nullable|max:255',
            'founded_year' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'email' => 'nullable|email',
            'phone' => 'nullable|max:20',
            'website' => 'nullable|url',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'max_teams' => 'nullable|integer|min:2',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')
                                        ->store('leagues/logos', 'public');
        }

        League::create($validated);

        return redirect()
            ->route('admin.leagues.index')
            ->with('success', 'Liga creada exitosamente');
    }

    public function editarLiga($id)
    {
        $league = League::findOrFail($id);
        return view('admin.editar-liga', compact('league'));
    }

    public function actualizarLiga(Request $request, $id)
    {
        $league = League::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|max:255|unique:leagues,name,' . $id,
            'short_name' => 'required|max:50',
            'logo' => 'nullable|image|max:2048',
            'description' => 'nullable',
            'country' => 'nullable|max:100',
            'city' => 'nullable|max:255',
            'founded_year' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'email' => 'nullable|email',
            'phone' => 'nullable|max:20',
            'website' => 'nullable|url',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'max_teams' => 'nullable|integer|min:2',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($league->logo) {
                Storage::disk('public')->delete($league->logo);
            }
            $validated['logo'] = $request->file('logo')
                                        ->store('leagues/logos', 'public');
        }

        $league->update($validated);

        return redirect()
            ->route('admin.leagues.index')
            ->with('success', 'Liga actualizada exitosamente');
    }

    public function detalleLiga($id)
    {
        $league = League::with([
            'teams.players',
            'seasons' => function($query) {
                $query->orderBy('start_date', 'desc');
            },
            'seasons.jornadas',
            'seasons.games'
        ])
        ->withCount(['teams', 'seasons'])
        ->findOrFail($id);
        
        return view('admin.detalle-liga', compact('league'));
    }
    
    // ============================================
    // GESTIÓN DE EQUIPOS (ACTUALIZADO CON COACH)
    // ============================================
    
    public function listaEquipos(Request $request)
    {
        $query = Team::withCount('players')->with('league');

        if ($request->has('league_id') && $request->league_id != 'all') {
            $query->where('league_id', $request->league_id);
        }

        $teams = $query->latest()->get();
        $leagues = League::where('is_active', true)->get();

        return view('admin.equipos.lista-equipos', compact('teams', 'leagues'));
    }
    
    public function crearEquipo()
    {
        $leagues = League::where('is_active', true)->get();
        return view('admin.equipos.crear-equipo', compact('leagues'));
    }
    
    public function guardarEquipo(Request $request)
    {
        $validated = $request->validate([
            'league_id' => 'required|exists:leagues,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('teams')->where(function ($query) use ($request) {
                    return $query->where('league_id', $request->league_id);
                }),
            ],
            'short_name' => 'required|string|max:10',
            'city' => 'nullable|string|max:255',
            'stadium' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'founded_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'coach_name' => 'required|string|max:255',
            'coach_email' => 'required|email|unique:users,email',
            'coach_phone' => 'nullable|string|max:20',
            'coach_password' => 'required|string|min:8|confirmed',
            'coach_avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        DB::beginTransaction();
        
        try {
            $teamData = [
                'league_id' => $request->league_id,
                'name' => $request->name,
                'short_name' => $request->short_name,
                'city' => $request->city,
                'stadium' => $request->stadium,
                'description' => $request->description,
                'founded_year' => $request->founded_year,
                'is_active' => true,
            ];
            
            if ($request->hasFile('logo')) {
                $teamData['logo'] = $request->file('logo')->store('teams/logos', 'public');
            }
            
            $team = Team::create($teamData);
            
            $coachData = [
                'name' => $request->coach_name,
                'email' => $request->coach_email,
                'phone' => $request->coach_phone,
                'password' => Hash::make($request->coach_password),
                'role' => 'coach',
                'team_id' => $team->id,
                'league_id' => $team->league_id,
                'is_active' => true,
            ];
            
            if ($request->hasFile('coach_avatar')) {
                $coachData['avatar'] = $request->file('coach_avatar')->store('coaches/avatars', 'public');
            }
            
            $coach = User::create($coachData);
            
            DB::commit();
            
            return redirect()
                ->route('admin.teams.index')
                ->with('success', 'Equipo y Coach creados exitosamente');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            if (isset($teamData['logo'])) {
                Storage::disk('public')->delete($teamData['logo']);
            }
            if (isset($coachData['avatar'])) {
                Storage::disk('public')->delete($coachData['avatar']);
            }
            
            return back()
                ->withErrors(['error' => 'Error al crear equipo y coach: ' . $e->getMessage()])
                ->withInput();
        }
    }
    
    public function editarEquipo($id)
    {
        $team = Team::with('coach')->findOrFail($id);
        $leagues = League::where('is_active', true)->get();
        return view('admin.equipos.editar-equipo', compact('team', 'leagues'));
    }
    
    public function actualizarEquipo(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        
        $validated = $request->validate([
            'league_id' => 'required|exists:leagues,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('teams')->where(function ($query) use ($request) {
                    return $query->where('league_id', $request->league_id);
                })->ignore($id),
            ],
            'short_name' => 'required|string|max:10',
            'city' => 'nullable|string|max:255',
            'stadium' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'founded_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
        ]);
        
        if ($request->hasFile('logo')) {
            if ($team->logo) {
                Storage::disk('public')->delete($team->logo);
            }
            $validated['logo'] = $request->file('logo')->store('teams/logos', 'public');
        }
        
        $team->update($validated);
        
        if ($team->coach && $team->league_id != $team->getOriginal('league_id')) {
            $team->coach->update(['league_id' => $team->league_id]);
        }
        
        return redirect()->route('admin.teams.index')
            ->with('success', 'Equipo actualizado exitosamente');
    }
    
    public function eliminarEquipo($id)
    {
        $team = Team::findOrFail($id);
        
        if ($team->logo) {
            Storage::disk('public')->delete($team->logo);
        }
        
        $team->delete();
        
        return redirect()->route('admin.teams.index')
            ->with('success', 'Equipo eliminado exitosamente');
    }
    
    // ============================================
    // GESTIÓN DE JUGADORES
    // ============================================
    
   public function listaJugadores()
{
    $players = Player::with(['team', 'user'])->latest()->paginate(20);
    return view('admin.jugadores.lista-jugadores', compact('players'));
}
 
public function crearJugador()
{
    $teams = Team::where('is_active', true)->get();
    return view('admin.jugadores.crear-jugador', compact('teams'));
}
 
public function guardarJugador(Request $request)
{
    $request->validate([
        // Datos del jugador
        'team_id'       => 'required|exists:teams,id',
        'name'          => 'required|string|max:255',
        'last_name'     => 'required|string|max:255',
        'jersey_number' => 'required|integer|min:0|max:99',
        'position'      => 'required|in:QB,RB,WR,TE,OL,DL,LB,CB,S,K,P',
        'birth_date'    => 'nullable|date',
        'height'        => 'nullable|numeric|min:0',
        'weight'        => 'nullable|numeric|min:0',
        'photo'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'is_active'     => 'sometimes|boolean',
        // Datos de la cuenta
        'email'         => 'required|email|max:255|unique:users,email',
        'phone'         => 'nullable|string|max:20',
        'password'      => 'required|string|min:8|confirmed',
    ]);
 
    // Verificar número de jersey único en el equipo
    $exists = Player::where('team_id', $request->team_id)
        ->where('jersey_number', $request->jersey_number)
        ->exists();
 
    if ($exists) {
        return back()->withErrors([
            'jersey_number' => 'Este número ya está en uso en el equipo',
        ])->withInput();
    }
 
    // Obtener team para asignar league_id al user
    $team = Team::findOrFail($request->team_id);
 
    DB::transaction(function () use ($request, $team) {
 
        // 1. Crear el User con role 'player'
        $user = User::create([
            'name'      => $request->name . ' ' . $request->last_name,
            'email'     => $request->email,
            'password'  => $request->password, // cast 'hashed' lo encripta
            'role'      => 'player',
            'team_id'   => $team->id,
            'league_id' => $team->league_id,
            'phone'     => $request->phone,
            'is_active' => $request->boolean('is_active', true),
        ]);
 
        // 2. Manejar foto
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('players/photos', 'public');
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
 
    return redirect()->route('admin.players.index')
        ->with('success', 'Jugador y cuenta de acceso creados correctamente.');
}
 
public function editarJugador($id)
{
    $player = Player::with('user')->findOrFail($id);
    $teams  = Team::where('is_active', true)->get();
    return view('admin.jugadores.editar-jugador', compact('player', 'teams'));
}
 
public function actualizarJugador(Request $request, $id)
{
    $player = Player::with('user')->findOrFail($id);
 
    $request->validate([
        'team_id'       => 'required|exists:teams,id',
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
 
    // Verificar número de jersey (excluye el jugador actual)
    $exists = Player::where('team_id', $request->team_id)
        ->where('jersey_number', $request->jersey_number)
        ->where('id', '!=', $id)
        ->exists();
 
    if ($exists) {
        return back()->withErrors([
            'jersey_number' => 'Este número ya está en uso en el equipo',
        ])->withInput();
    }
 
    DB::transaction(function () use ($request, $player) {
 
        // 1. Foto del jugador
        $photoPath = $player->photo;
        if ($request->hasFile('photo')) {
            if ($player->photo) {
                Storage::disk('public')->delete($player->photo);
            }
            $photoPath = $request->file('photo')->store('players/photos', 'public');
        }
 
        // 2. Actualizar datos del jugador
        $player->update([
            'team_id'       => $request->team_id,
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
 
        // 3. Sincronizar nombre en el User vinculado
        if ($player->user) {
            $team = Team::find($request->team_id);
            $player->user->update([
                'name'      => $request->name . ' ' . $request->last_name,
                'team_id'   => $request->team_id,
                'league_id' => $team->league_id ?? $player->user->league_id,
                'is_active' => $request->boolean('is_active', false),
            ]);
        }
    });
 
    return redirect()->route('admin.players.index')
        ->with('success', 'Jugador actualizado correctamente.');
}
 
public function eliminarJugador($id)
{
    $player = Player::with('user')->findOrFail($id);
 
    DB::transaction(function () use ($player) {
        if ($player->photo) {
            Storage::disk('public')->delete($player->photo);
        }
 
        if ($player->user) {
            if ($player->user->avatar) {
                Storage::disk('public')->delete($player->user->avatar);
            }
            $player->user->delete();
        }
 
        $player->delete();
    });
 
    return redirect()->route('admin.players.index')
        ->with('success', 'Jugador eliminado correctamente.');
}
 
// ── Actualizar solo la cuenta de usuario del jugador ──
public function actualizarUsuarioJugador(Request $request, $id)
{
    $player = Player::with('user')->findOrFail($id);
 
    if (!$player->user) {
        return back()->withErrors(['error' => 'Este jugador no tiene cuenta de usuario.']);
    }
 
    $request->validate([
        'email'       => 'required|email|max:255|unique:users,email,' . $player->user->id,
        'phone'       => 'nullable|string|max:20',
        'password'    => 'nullable|string|min:8|confirmed',
        'user_is_active' => 'sometimes|boolean',
    ]);
 
    $userData = [
        'email'     => $request->email,
        'phone'     => $request->phone,
        'is_active' => $request->boolean('user_is_active', false),
    ];
 
    // Solo actualizar contraseña si se proporcionó
    if ($request->filled('password')) {
        $userData['password'] = $request->password; // cast 'hashed' la encripta
    }
 
    $player->user->update($userData);
 
    return redirect()->route('admin.players.edit', $player->id)
        ->with('success', 'Cuenta de usuario actualizada correctamente.');
}
 
// ── Crear cuenta de usuario para jugador sin cuenta ──
public function crearUsuarioJugador(Request $request, $id)
{
    $player = Player::with('user')->findOrFail($id);
 
    if ($player->user) {
        return back()->withErrors(['error' => 'Este jugador ya tiene cuenta de usuario.']);
    }
 
    $request->validate([
        'email'    => 'required|email|max:255|unique:users,email',
        'phone'    => 'nullable|string|max:20',
        'password' => 'required|string|min:8|confirmed',
    ]);
 
    $team = Team::find($player->team_id);
 
    $user = User::create([
        'name'      => $player->name . ' ' . $player->last_name,
        'email'     => $request->email,
        'password'  => $request->password,
        'role'      => 'player',
        'team_id'   => $player->team_id,
        'league_id' => $team->league_id ?? null,
        'phone'     => $request->phone,
        'is_active' => true,
    ]);
 
    $player->update(['user_id' => $user->id]);
 
    return redirect()->route('admin.players.edit', $player->id)
        ->with('success', 'Cuenta de usuario creada correctamente.');
}

    // ============================================
    // GESTIÓN DE TEMPORADAS
    // ============================================

    public function listaTemporadas(Request $request)
    {
        $query = Season::with(['league', 'jornadas', 'games'])
            ->withCount(['jornadas', 'games']);
        
        if ($request->league_id) {
            $query->where('league_id', $request->league_id);
        }
        
        $seasons = $query->orderBy('start_date', 'desc')->get();
        $leagues = League::where('is_active', true)->get();
        
        return view('admin.temporadas.index', compact('seasons', 'leagues'));
    }

    public function crearTemporada()
    {
        $leagues = League::where('is_active', true)->get();
        return view('admin.temporadas.crear', compact('leagues'));
    }

    public function guardarTemporada(Request $request)
    {
        $validated = $request->validate([
            'league_id' => 'required|exists:leagues,id',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'nullable|boolean',
        ]);
        
        // Extraer el año automáticamente de start_date
        $validated['year'] = date('Y', strtotime($validated['start_date']));
        
        // Manejar checkbox is_active
        $validated['is_active'] = $request->has('is_active') ? true : false;
        
        // Si se marca como activa, desactivar otras temporadas de la misma liga
        if ($validated['is_active']) {
            Season::where('league_id', $validated['league_id'])
                ->update(['is_active' => false]);
        }
        
        Season::create($validated);
        
        return redirect()->route('admin.seasons.index')
            ->with('success', 'Temporada creada exitosamente');
    }

    public function editarTemporada($id)
    {
        $season = Season::findOrFail($id);
        $leagues = League::where('is_active', true)->get();
        return view('admin.temporadas.editar', compact('season', 'leagues'));
    }

    public function actualizarTemporada(Request $request, $id)
    {
        $season = Season::findOrFail($id);
        
        $request->validate([
            'league_id' => 'required|exists:leagues,id',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
        ]);
        
        if ($request->is_active) {
            Season::where('league_id', $request->league_id)
                ->where('id', '!=', $id)
                ->update(['is_active' => false]);
        }
        
        $season->update($request->all());
        
        return redirect()->route('admin.seasons.index')
            ->with('success', 'Temporada actualizada exitosamente');
    }

    public function eliminarTemporada($id)
    {
        $season = Season::findOrFail($id);
        
        if ($season->games()->exists() || $season->jornadas()->exists()) {
            return back()->withErrors([
                'error' => 'No se puede eliminar una temporada con partidos o jornadas registradas'
            ]);
        }
        
        $season->delete();
        
        return redirect()->route('admin.seasons.index')
            ->with('success', 'Temporada eliminada exitosamente');
    }

    // ============================================
    // DETALLE DE TEMPORADA Y GENERACIÓN DE CALENDARIO
    // ============================================

    public function detalleSeason($id)
    {
        $season = Season::with('league')->findOrFail($id);
        $teams = Team::where('league_id', $season->league_id)
            ->where('is_active', true)
            ->get();
        
        $teamsCount = $teams->count();
        $totalRounds = $teamsCount - 1;
        $gamesPerRound = $teamsCount / 2;
        $totalGames = $gamesPerRound * $totalRounds;
        
        return view('admin.temporadas.detalle', compact('season', 'teams', 'totalGames', 'totalRounds'));
    }

    public function generarCalendario(Request $request, $id)
    {
        $season = Season::findOrFail($id);
        
        $request->validate([
            'start_date' => 'required|date',
            'round_trip' => 'required|in:0,1',
            'days_between_rounds' => 'required|integer|min:1|max:30',
            'replace_existing' => 'nullable|boolean',
        ]);
        
        $teams = Team::where('league_id', $season->league_id)
            ->where('is_active', true)
            ->get();
        
        if ($teams->count() < 2) {
            return back()->withErrors(['error' => 'Se necesitan al menos 2 equipos']);
        }
        
        if ($teams->count() % 2 != 0) {
            return back()->withErrors(['error' => 'El número de equipos debe ser par']);
        }
        
        if ($request->replace_existing) {
            $season->games()->delete();
            $season->jornadas()->delete();
        }
        
        DB::beginTransaction();
        
        try {
            $startDate = Carbon::parse($request->start_date);
            $daysBetween = $request->days_between_rounds;
            $roundTrip = $request->round_trip;
            
            $fixtures = $this->generateRoundRobinFixtures($teams, $roundTrip);
            
            $roundNumber = 1;
            $currentDate = $startDate->copy();
            
            foreach ($fixtures as $roundFixtures) {
                $jornada = Jornada::create([
                    'season_id' => $season->id,
                    'number' => $roundNumber,
                    'name' => 'Jornada ' . $roundNumber,
                    'date' => $currentDate->copy()->toDateString(),
                    'is_completed' => false,
                ]);
                
                foreach ($roundFixtures as $fixture) {
                    Game::create([
                        'jornada_id' => $jornada->id,
                        'home_team_id' => $fixture['home'],
                        'away_team_id' => $fixture['away'],
                        'date' => $currentDate->copy()->addHours(18)->toDateTimeString(),
                        'status' => 'scheduled',
                    ]);
                }
                
                $roundNumber++;
                $currentDate->addDays($daysBetween);
            }
            
            DB::commit();
            
            $totalGames = $season->games()->count();
            $totalRounds = $season->jornadas()->count();
            
            return redirect()->route('admin.seasons.show', $season->id)
                ->with('success', "¡Calendario generado! {$totalRounds} jornadas con {$totalGames} partidos.");
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    private function generateRoundRobinFixtures($teams, $roundTrip = false)
    {
        $teamIds = $teams->pluck('id')->toArray();
        $n = count($teamIds);
        
        if ($n % 2 != 0) {
            $teamIds[] = null;
            $n++;
        }
        
        $rounds = [];
        $totalRounds = $n - 1;
        
        for ($round = 0; $round < $totalRounds; $round++) {
            $fixtures = [];
            
            for ($i = 0; $i < $n / 2; $i++) {
                $home = $teamIds[$i];
                $away = $teamIds[$n - 1 - $i];
                
                if ($home !== null && $away !== null) {
                    if ($round % 2 == 0) {
                        $fixtures[] = ['home' => $home, 'away' => $away];
                    } else {
                        $fixtures[] = ['home' => $away, 'away' => $home];
                    }
                }
            }
            
            $rounds[] = $fixtures;
            
            $last = array_pop($teamIds);
            array_splice($teamIds, 1, 0, [$last]);
        }
        
        if ($roundTrip) {
            $returnRounds = [];
            foreach ($rounds as $round) {
                $returnFixtures = [];
                foreach ($round as $fixture) {
                    $returnFixtures[] = [
                        'home' => $fixture['away'],
                        'away' => $fixture['home'],
                    ];
                }
                $returnRounds[] = $returnFixtures;
            }
            $rounds = array_merge($rounds, $returnRounds);
        }
        
        return $rounds;
    }

    // ============================================
    // GESTIÓN DE JORNADAS
    // ============================================

    public function listaJornadas(Request $request)
    {
        $query = Jornada::with(['season.league', 'games'])
            ->withCount('games');
        
        if ($request->season_id) {
            $query->where('season_id', $request->season_id);
        }
        
        $jornadas = $query->orderBy('number', 'asc')->get();
        $seasons = Season::with('league')->get();
        
        return view('admin.jornadas.index', compact('jornadas', 'seasons'));
    }

    public function crearJornada()
    {
        $seasons = Season::with('league')->where('is_active', true)->get();
        return view('admin.jornadas.crear', compact('seasons'));
    }

    public function guardarJornada(Request $request)
    {
        $request->validate([
            'season_id' => 'required|exists:seasons,id',
            'number' => 'required|integer|min:1',
            'name' => 'nullable|string|max:255',
            'date' => 'required|date',
            'is_completed' => 'boolean',
        ]);
        
        if (!$request->name) {
            $request->merge(['name' => 'Jornada ' . $request->number]);
        }
        
        Jornada::create($request->all());
        
        return redirect()->route('admin.jornadas.index', ['season_id' => $request->season_id])
            ->with('success', 'Jornada creada exitosamente');
    }

    public function editarJornada($id)
    {
        $jornada = Jornada::findOrFail($id);
        $seasons = Season::with('league')->get();
        return view('admin.jornadas.editar', compact('jornada', 'seasons'));
    }

    public function actualizarJornada(Request $request, $id)
    {
        $jornada = Jornada::findOrFail($id);
        
        $request->validate([
            'season_id' => 'required|exists:seasons,id',
            'number' => 'required|integer|min:1',
            'name' => 'nullable|string|max:255',
            'date' => 'required|date',
            'is_completed' => 'boolean',
        ]);
        
        $jornada->update($request->all());
        
        return redirect()->route('admin.jornadas.index')
            ->with('success', 'Jornada actualizada exitosamente');
    }

    public function eliminarJornada($id)
    {
        $jornada = Jornada::findOrFail($id);
        
        if ($jornada->games()->exists()) {
            return back()->withErrors([
                'error' => 'No se puede eliminar una jornada con partidos registrados'
            ]);
        }
        
        $jornada->delete();
        
        return redirect()->route('admin.jornadas.index')
            ->with('success', 'Jornada eliminada exitosamente');
    }

    // ============================================
    // GESTIÓN DE PARTIDOS Y RESULTADOS
    // ============================================

    public function listaPartidos(Request $request)
    {
        $query = Game::with(['homeTeam', 'awayTeam', 'jornada.season.league'])
            ->orderBy('game_datetime', 'desc');
        
        if ($request->season_id) {
            $query->whereHas('jornada', function($q) use ($request) {
                $q->where('season_id', $request->season_id);
            });
        }
        
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        $games = $query->paginate(20);
        $seasons = Season::with('league')->get();
        
        return view('admin.partidos.index', compact('games', 'seasons'));
    }

    public function crearPartido()
    {
        $seasons = Season::with('league')->where('is_active', true)->get();
        $jornadas = Jornada::with('season')->get();
        $teams = Team::where('is_active', true)->get();
        
        return view('admin.partidos.crear', compact('seasons', 'jornadas', 'teams'));
    }

    public function guardarPartido(Request $request)
{
    $request->validate([
        'jornada_id'   => 'required|exists:jornadas,id',
        'home_team_id' => 'required|exists:teams,id|different:away_team_id',
        'away_team_id' => 'required|exists:teams,id',
        'date'         => 'required|date',
        'time'         => 'required',
        'location'     => 'nullable|string',
        'status'       => 'required|in:scheduled,in_progress,finished',
    ]);

    Game::create([
        'jornada_id'    => $request->jornada_id,
        'home_team_id'  => $request->home_team_id,
        'away_team_id'  => $request->away_team_id,
        'game_datetime' => $request->date . ' ' . $request->time . ':00', // ← aquí la combinación
        'location'      => $request->location,
        'status'        => $request->status,
    ]);

    return redirect()->route('admin.games.index')->with('success', 'Partido creado correctamente.');
}

    public function editarPartido($id)
    {
        $game = Game::with(['homeTeam', 'awayTeam', 'jornada.season'])->findOrFail($id);
        $seasons = Season::with('league')->get();
        $jornadas = Jornada::with('season')->get();
        $teams = Team::where('is_active', true)->get();
        
        return view('admin.partidos.editar', compact('game', 'seasons', 'jornadas', 'teams'));
    }

    public function actualizarPartido(Request $request, $id)
    {
        $game = Game::findOrFail($id);
        
        // Guardar marcadores anteriores ANTES de actualizar
        $oldHomeScore = $game->home_score;
        $oldAwayScore = $game->away_score;
        $oldStatus = $game->status;
        
        $validated = $request->validate([
            'jornada_id' => 'required|exists:jornadas,id',
            'home_team_id' => 'required|exists:teams,id',
            'away_team_id' => 'required|exists:teams,id|different:home_team_id',
            'date' => 'required|date',
            'time' => 'required',
            'home_score' => 'nullable|integer|min:0',
            'away_score' => 'nullable|integer|min:0',
            'status' => 'required|in:scheduled,in_progress,finished',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        
        // Combinar fecha y hora en game_datetime
        $gameDateTime = $validated['date'] . ' ' . $validated['time'];
        
        $game->update([
            'jornada_id' => $validated['jornada_id'],
            'home_team_id' => $validated['home_team_id'],
            'away_team_id' => $validated['away_team_id'],
            'game_datetime' => $gameDateTime,
            'home_score' => $validated['home_score'] ?? null,
            'away_score' => $validated['away_score'] ?? null,
            'status' => $validated['status'],
            'location' => $validated['location'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);
        
        // Si el partido cambió a 'finished' o si ya estaba finished y cambiaron los marcadores
        if ($validated['status'] === 'finished' && $validated['home_score'] !== null && $validated['away_score'] !== null) {
            // Si ya estaba finalizado, primero revertir los valores anteriores
            if ($oldStatus === 'finished' && $oldHomeScore !== null && $oldAwayScore !== null) {
                $this->revertirTablaPosiciones($game, $oldHomeScore, $oldAwayScore);
            }
            // Ahora aplicar los nuevos valores
            $this->actualizarTablaPosiciones($game);
        }
        
        return redirect()->route('admin.games.index')
            ->with('success', 'Resultado actualizado exitosamente');
    }

    public function eliminarPartido($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();
        
        return redirect()->route('admin.games.index')
            ->with('success', 'Partido eliminado exitosamente');
    }

    // ============================================
    // ACTUALIZACIÓN AUTOMÁTICA DE TABLA
    // ============================================

    private function actualizarTablaPosiciones($game)
    {
        $jornada = $game->jornada;
        $season = $jornada->season;
        
        $homeStanding = Standing::firstOrCreate([
            'season_id' => $season->id,
            'team_id' => $game->home_team_id,
        ]);
        
        $awayStanding = Standing::firstOrCreate([
            'season_id' => $season->id,
            'team_id' => $game->away_team_id,
        ]);
        
        // Incrementar partidos jugados
        $homeStanding->increment('played');
        $awayStanding->increment('played');
        
        // Actualizar goles a favor y en contra
        $homeStanding->increment('goals_for', $game->home_score);
        $homeStanding->increment('goals_against', $game->away_score);
        $awayStanding->increment('goals_for', $game->away_score);
        $awayStanding->increment('goals_against', $game->home_score);
        
        // Determinar ganador y actualizar wins/losses/ties
        if ($game->home_score > $game->away_score) {
            // Local gana
            $homeStanding->increment('wins');
            $homeStanding->increment('points', 3);
            $awayStanding->increment('losses');
            // Actualizar form
            $this->updateForm($homeStanding, 'W');
            $this->updateForm($awayStanding, 'L');
        } elseif ($game->away_score > $game->home_score) {
            // Visitante gana
            $awayStanding->increment('wins');
            $awayStanding->increment('points', 3);
            $homeStanding->increment('losses');
            // Actualizar form
            $this->updateForm($awayStanding, 'W');
            $this->updateForm($homeStanding, 'L');
        } else {
            // Empate
            $homeStanding->increment('ties');
            $homeStanding->increment('points', 1);
            $awayStanding->increment('ties');
            $awayStanding->increment('points', 1);
            // Actualizar form
            $this->updateForm($homeStanding, 'D');
            $this->updateForm($awayStanding, 'D');
        }
        
        // Calcular diferencia de goles
        $homeStanding->update([
            'goal_difference' => $homeStanding->goals_for - $homeStanding->goals_against
        ]);
        $awayStanding->update([
            'goal_difference' => $awayStanding->goals_for - $awayStanding->goals_against
        ]);
    }
    
    private function revertirTablaPosiciones($game, $oldHomeScore, $oldAwayScore)
    {
        $jornada = $game->jornada;
        $season = $jornada->season;
        
        $homeStanding = Standing::where('season_id', $season->id)
            ->where('team_id', $game->home_team_id)
            ->first();
        
        $awayStanding = Standing::where('season_id', $season->id)
            ->where('team_id', $game->away_team_id)
            ->first();
        
        if (!$homeStanding || !$awayStanding) {
            return;
        }
        
        // Restar partidos jugados
        $homeStanding->decrement('played');
        $awayStanding->decrement('played');
        
        // Restar goles
        $homeStanding->decrement('goals_for', $oldHomeScore);
        $homeStanding->decrement('goals_against', $oldAwayScore);
        $awayStanding->decrement('goals_for', $oldAwayScore);
        $awayStanding->decrement('goals_against', $oldHomeScore);
        
        // Revertir wins/losses/ties y puntos
        if ($oldHomeScore > $oldAwayScore) {
            $homeStanding->decrement('wins');
            $homeStanding->decrement('points', 3);
            $awayStanding->decrement('losses');
        } elseif ($oldAwayScore > $oldHomeScore) {
            $awayStanding->decrement('wins');
            $awayStanding->decrement('points', 3);
            $homeStanding->decrement('losses');
        } else {
            $homeStanding->decrement('ties');
            $homeStanding->decrement('points', 1);
            $awayStanding->decrement('ties');
            $awayStanding->decrement('points', 1);
        }
        
        // Recalcular diferencia de goles
        $homeStanding->update([
            'goal_difference' => $homeStanding->goals_for - $homeStanding->goals_against
        ]);
        $awayStanding->update([
            'goal_difference' => $awayStanding->goals_for - $awayStanding->goals_against
        ]);
    }
    
    private function updateForm($standing, $result)
    {
        $form = $standing->form ?? '';
        $form = $result . $form;
        $form = substr($form, 0, 5); // Solo últimos 5
        $standing->update(['form' => $form]);
    }
}