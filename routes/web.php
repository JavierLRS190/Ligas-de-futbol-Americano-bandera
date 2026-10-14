<?php

// ============================================
// routes/web.php - Sistema Multi-Liga Completo
// ============================================

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\TeamController;
use App\Http\Controllers\Web\GameController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\CoachController;
use App\Http\Controllers\Web\PlayerController;

/*
|--------------------------------------------------------------------------
| Web Routes - Frontend Público
|--------------------------------------------------------------------------
*/

// Home - Selector de Ligas
Route::get('/', [HomeController::class, 'inicio'])->name('home');

// Rutas públicas por liga
Route::prefix('liga/{league}')->name('league.')->group(function () {
    Route::get('/', [HomeController::class, 'leagueHome'])->name('home');
    Route::get('/equipos', [TeamController::class, 'listaEquipos'])->name('teams.index');
    Route::get('/equipos/{id}', [TeamController::class, 'detalleEquipo'])->name('teams.show');
    Route::get('/partidos', [GameController::class, 'listaPartidos'])->name('games.index');
    Route::get('/tabla-posiciones', [HomeController::class, 'tablaPosiciones'])->name('standings');
});

// Rutas públicas globales (legacy - mantener por compatibilidad)
Route::get('/equipos', [TeamController::class, 'listaEquipos'])->name('teams.index');
Route::get('/equipos/{id}', [TeamController::class, 'detalleEquipo'])->name('teams.show');
Route::get('/partidos', [GameController::class, 'listaPartidos'])->name('games.index');
Route::get('/tabla-posiciones', [HomeController::class, 'tablaPosiciones'])->name('standings');

/*
|--------------------------------------------------------------------------
| Autenticación
|--------------------------------------------------------------------------
*/

Route::get('/iniciar-sesion', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/iniciar-sesion', [AuthController::class, 'login'])->name('login.post');
Route::post('/cerrar-sesion', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Panel Admin - Gestión Completa del Sistema
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/', [AdminController::class, 'panelAdministrador'])->name('dashboard');
    Route::get('/panel', [AdminController::class, 'panelAdministrador']); // Alias
    
    // ============================================
    // GESTIÓN DE LIGAS
    // ============================================
    Route::get('/ligas', [AdminController::class, 'listaLigas'])->name('leagues.index');
    Route::get('/ligas/crear', [AdminController::class, 'crearLiga'])->name('leagues.create');
    Route::post('/ligas', [AdminController::class, 'guardarLiga'])->name('leagues.store');
    Route::get('/ligas/{id}', [AdminController::class, 'detalleLiga'])->name('leagues.show');
    Route::get('/ligas/{id}/editar', [AdminController::class, 'editarLiga'])->name('leagues.edit');
    Route::put('/ligas/{id}', [AdminController::class, 'actualizarLiga'])->name('leagues.update');
    Route::delete('/ligas/{id}', [AdminController::class, 'eliminarLiga'])->name('leagues.destroy');
    
    // ============================================
    // GESTIÓN DE EQUIPOS
    // ============================================
    Route::get('/equipos', [AdminController::class, 'listaEquipos'])->name('teams.index');
    Route::get('/equipos/crear', [AdminController::class, 'crearEquipo'])->name('teams.create');
    Route::post('/equipos', [AdminController::class, 'guardarEquipo'])->name('teams.store');
    Route::get('/equipos/{id}', [AdminController::class, 'detalleEquipo'])->name('teams.show');
    Route::get('/equipos/{id}/editar', [AdminController::class, 'editarEquipo'])->name('teams.edit');
    Route::put('/equipos/{id}', [AdminController::class, 'actualizarEquipo'])->name('teams.update');
    Route::delete('/equipos/{id}', [AdminController::class, 'eliminarEquipo'])->name('teams.destroy');
    
    // ============================================
    // GESTIÓN DE JUGADORES
    // ============================================
    Route::get('/jugadores', [AdminController::class, 'listaJugadores'])->name('players.index');
    Route::get('/jugadores/crear', [AdminController::class, 'crearJugador'])->name('players.create');
    Route::post('/jugadores', [AdminController::class, 'guardarJugador'])->name('players.store');
    Route::get('/jugadores/{id}/editar', [AdminController::class, 'editarJugador'])->name('players.edit');
    Route::put('/jugadores/{id}', [AdminController::class, 'actualizarJugador'])->name('players.update');
    Route::delete('/jugadores/{id}', [AdminController::class, 'eliminarJugador'])->name('players.destroy');
    Route::put('/jugadores/{id}/usuario',  [AdminController::class, 'actualizarUsuarioJugador'])->name('players.updateUser');
Route::post('/jugadores/{id}/usuario', [AdminController::class, 'crearUsuarioJugador'])->name('players.createUser');
    
    // ============================================
    // GESTIÓN DE TEMPORADAS
    // ============================================
    Route::get('/temporadas', [AdminController::class, 'listaTemporadas'])->name('seasons.index');
    Route::get('/temporadas/crear', [AdminController::class, 'crearTemporada'])->name('seasons.create');
    Route::post('/temporadas', [AdminController::class, 'guardarTemporada'])->name('seasons.store');
    Route::get('/temporadas/{id}', [AdminController::class, 'detalleSeason'])->name('seasons.show'); // NUEVO: Vista detalle con generación de calendario
    Route::get('/temporadas/{id}/editar', [AdminController::class, 'editarTemporada'])->name('seasons.edit');
    Route::put('/temporadas/{id}', [AdminController::class, 'actualizarTemporada'])->name('seasons.update');
    Route::delete('/temporadas/{id}', [AdminController::class, 'eliminarTemporada'])->name('seasons.destroy');
    
    // NUEVO: Generar calendario automático
    Route::post('/temporadas/{id}/generar-calendario', [AdminController::class, 'generarCalendario'])->name('seasons.generate-calendar');
    
    // ============================================
    // GESTIÓN DE JORNADAS
    // ============================================
    Route::get('/jornadas', [AdminController::class, 'listaJornadas'])->name('jornadas.index');
    Route::get('/jornadas/crear', [AdminController::class, 'crearJornada'])->name('jornadas.create');
    Route::post('/jornadas', [AdminController::class, 'guardarJornada'])->name('jornadas.store');
    Route::get('/jornadas/{id}/editar', [AdminController::class, 'editarJornada'])->name('jornadas.edit');
    Route::put('/jornadas/{id}', [AdminController::class, 'actualizarJornada'])->name('jornadas.update');
    Route::delete('/jornadas/{id}', [AdminController::class, 'eliminarJornada'])->name('jornadas.destroy');
    
    // ============================================
    // GESTIÓN DE PARTIDOS
    // ============================================
    Route::get('/partidos', [AdminController::class, 'listaPartidos'])->name('games.index');
    Route::get('/partidos/crear', [AdminController::class, 'crearPartido'])->name('games.create');
    Route::post('/partidos', [AdminController::class, 'guardarPartido'])->name('games.store');
    Route::get('/partidos/{id}/editar', [AdminController::class, 'editarPartido'])->name('games.edit');
    Route::put('/partidos/{id}', [AdminController::class, 'actualizarPartido'])->name('games.update');
    Route::delete('/partidos/{id}', [AdminController::class, 'eliminarPartido'])->name('games.destroy');
    
    // ============================================
    // GESTIÓN DE COACHES (Opcional - para reasignar)
    // ============================================
    Route::get('/coaches', [AdminController::class, 'listaCoaches'])->name('coaches.index');
    Route::get('/coaches/{id}/editar', [AdminController::class, 'editarCoach'])->name('coaches.edit');
    Route::put('/coaches/{id}', [AdminController::class, 'actualizarCoach'])->name('coaches.update');
});

/*
|--------------------------------------------------------------------------
| Panel Coach - Gestión de MI Equipo
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'coach'])->prefix('coach')->name('coach.')->group(function () {
    
    // Dashboard
    Route::get('/', [CoachController::class, 'panelCoach'])->name('dashboard');
    Route::get('/panel', [CoachController::class, 'panelCoach']); // Alias
    
    // ============================================
    // MI EQUIPO
    // ============================================
    Route::get('/mi-equipo', [CoachController::class, 'miEquipo'])->name('team.show');
    Route::get('/mi-equipo/editar', [CoachController::class, 'editarMiEquipo'])->name('team.edit');
    Route::put('/mi-equipo', [CoachController::class, 'actualizarMiEquipo'])->name('team.update');
    
    // ============================================
    // MIS JUGADORES
    // ============================================
    Route::get('/jugadores', [CoachController::class, 'listaJugadores'])->name('players.index');
    Route::get('/jugadores/crear', [CoachController::class, 'crearJugador'])->name('players.create');
    Route::post('/jugadores', [CoachController::class, 'guardarJugador'])->name('players.store');
    Route::get('/jugadores/{id}/editar', [CoachController::class, 'editarJugador'])->name('players.edit');
    Route::put('/jugadores/{id}', [CoachController::class, 'actualizarJugador'])->name('players.update');
    Route::delete('/jugadores/{id}', [CoachController::class, 'eliminarJugador'])->name('players.destroy');
    
    // ============================================
    // MIS JUGADAS
    // ============================================
    Route::get('/jugadas', [CoachController::class, 'listaJugadas'])->name('plays.index');
    Route::get('/jugadas/crear', [CoachController::class, 'crearJugada'])->name('plays.create');
    Route::post('/jugadas', [CoachController::class, 'guardarJugada'])->name('plays.store');
    Route::get('/jugadas/{id}/editar', [CoachController::class, 'editarJugada'])->name('plays.edit');
    Route::put('/jugadas/{id}', [CoachController::class, 'actualizarJugada'])->name('plays.update');
    Route::delete('/jugadas/{id}', [CoachController::class, 'eliminarJugada'])->name('plays.destroy');
    
    // ============================================
    // ESTADÍSTICAS Y REPORTES
    // ============================================
    Route::get('/estadisticas', [CoachController::class, 'estadisticas'])->name('stats');
    
    // ============================================
    // VISTAS PÚBLICAS (desde panel coach)
    // ============================================
    Route::get('/partidos', [CoachController::class, 'listaPartidos'])->name('games.index');
    Route::get('/tabla-posiciones', [CoachController::class, 'tablaPosiciones'])->name('standings');
});


Route::middleware(['auth', 'player'])->prefix('jugador')->name('player.')->group(function () {
    Route::get('/dashboard', [PlayerController::class, 'dashboard'])->name('dashboard');
    Route::get('/perfil',    [PlayerController::class, 'profile'])->name('profile');
});