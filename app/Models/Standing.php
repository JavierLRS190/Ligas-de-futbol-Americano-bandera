<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'team_id',
        'played',           // ← CAMBIADO de games_played
        'wins',
        'losses',
        'ties',
        'goals_for',        // ← CAMBIADO de points_for
        'goals_against',    // ← CAMBIADO de points_against
        'goal_difference',  // ← NUEVO
        'points',
        'form',             // ← NUEVO
    ];

    protected $casts = [
        'played' => 'integer',
        'wins' => 'integer',
        'losses' => 'integer',
        'ties' => 'integer',
        'goals_for' => 'integer',
        'goals_against' => 'integer',
        'goal_difference' => 'integer',
        'points' => 'integer',
    ];

    // ============================================
    // RELACIONES
    // ============================================

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    // ============================================
    // ACCESSORS (Atributos calculados)
    // ============================================

    /**
     * Porcentaje de victorias
     */
    public function getWinPercentageAttribute()
    {
        if ($this->played === 0) {
            return 0;
        }

        return round(($this->wins / $this->played) * 100, 2);
    }

    /**
     * Últimos 5 resultados formateados
     * Ejemplo: "WWLDW" → ["W", "W", "L", "D", "W"]
     */
    public function getFormArrayAttribute()
    {
        if (!$this->form) {
            return [];
        }

        return str_split($this->form);
    }

    /**
     * Promedio de goles por partido
     */
    public function getAverageGoalsForAttribute()
    {
        if ($this->played === 0) {
            return 0;
        }

        return round($this->goals_for / $this->played, 2);
    }

    /**
     * Promedio de goles en contra por partido
     */
    public function getAverageGoalsAgainstAttribute()
    {
        if ($this->played === 0) {
            return 0;
        }

        return round($this->goals_against / $this->played, 2);
    }

    /**
     * Puntos por partido
     */
    public function getPointsPerGameAttribute()
    {
        if ($this->played === 0) {
            return 0;
        }

        return round($this->points / $this->played, 2);
    }
}