<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $fillable = [
        'name', 'short_name', 'logo', 'description',
        'country', 'city', 'founded_year',
        'email', 'phone', 'website',
        'facebook', 'instagram', 'twitter',
        'max_teams', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ============================================
    // RELACIONES
    // ============================================

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function admins()
    {
        return $this->hasMany(User::class)->where('role', 'admin');
    }

    public function coaches()
    {
        return $this->hasMany(User::class)->where('role', 'coach');
    }

    /**
     * Partidos a través de temporadas (indirecto)
     * League → Seasons → Games
     */
    public function games()
    {
        return $this->hasManyThrough(
            Game::class,   // Destino
            Season::class, // Intermedio
            'league_id',   // FK en seasons → leagues
            'season_id',   // FK en games → seasons
            'id',          // PK en leagues
            'id'           // PK en seasons
        );
    }

    // ============================================
    // SCOPES
    // ============================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}