<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TeamController;
use App\Http\Controllers\API\PlayerController;
use App\Http\Controllers\API\SeasonController;
use App\Http\Controllers\API\GameController;
use App\Http\Controllers\API\StandingController;
use App\Http\Controllers\API\LeagueInfoController;
use App\Http\Controllers\API\JornadaController;

// Rutas públicas (sin autenticación)
Route::prefix('v1')->group(function () {
    // Auth
    Route::post('login', [AuthController::class, 'login']);
    
    // League Info (público)
    Route::get('league-info', [LeagueInfoController::class, 'show']);
    
    // Teams (público)
    Route::get('teams', [TeamController::class, 'index']);
    Route::get('teams/{id}', [TeamController::class, 'show']);
    Route::get('teams/{id}/players', [TeamController::class, 'players']);
    Route::get('teams/{id}/plays', [TeamController::class, 'plays']);
    
    // Players (público)
    Route::get('players', [PlayerController::class, 'index']);
    Route::get('players/{id}', [PlayerController::class, 'show']);
    
    // Seasons (público)
    Route::get('seasons', [SeasonController::class, 'index']);
    Route::get('seasons/{id}', [SeasonController::class, 'show']);
    Route::get('seasons/{id}/standings', [StandingController::class, 'index']);
    
    // Games (público)
    Route::get('games', [GameController::class, 'index']);
    Route::get('games/{id}', [GameController::class, 'show']);
    
    // Jornadas (público)
    Route::get('jornadas', [JornadaController::class, 'index']);
    Route::get('jornadas/{id}', [JornadaController::class, 'show']);
});

// Rutas protegidas (requieren autenticación)
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
    
    // Admin routes
    Route::middleware('admin')->group(function () {
        // Register (solo admin)
        Route::post('register', [AuthController::class, 'register']);
        
        // Teams
        Route::post('teams', [TeamController::class, 'store']);
        Route::put('teams/{id}', [TeamController::class, 'update']);
        Route::delete('teams/{id}', [TeamController::class, 'destroy']);
        
        // Players
        Route::post('players', [PlayerController::class, 'store']);
        Route::put('players/{id}', [PlayerController::class, 'update']);
        Route::delete('players/{id}', [PlayerController::class, 'destroy']);
        
        // Seasons
        Route::post('seasons', [SeasonController::class, 'store']);
        Route::put('seasons/{id}', [SeasonController::class, 'update']);
        Route::delete('seasons/{id}', [SeasonController::class, 'destroy']);
        
        // Jornadas (admin)
        Route::post('jornadas', [JornadaController::class, 'store']);
        Route::put('jornadas/{id}', [JornadaController::class, 'update']);
        Route::delete('jornadas/{id}', [JornadaController::class, 'destroy']);
        
        // Games (admin)
        Route::post('games', [GameController::class, 'store']);
        Route::put('games/{id}', [GameController::class, 'update']);
        Route::delete('games/{id}', [GameController::class, 'destroy']);
        
        // League Info (admin)
        Route::put('league-info', [LeagueInfoController::class, 'update']);
    });
    
    // Coach routes
    Route::middleware('coach')->group(function () {
        Route::get('my-team', [TeamController::class, 'show']); // Ajustar según tu lógica
        Route::get('my-team/players', [TeamController::class, 'players']); // Ajustar según tu lógica
    });
});