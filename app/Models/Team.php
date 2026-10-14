<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'league_id',  // NUEVO
        'name', 'short_name', 'logo', 'description',
        'colors', 'city', 'stadium', 'founded_year', 'is_active'
    ];

    protected $casts = [
        'colors' => 'array',
        'is_active' => 'boolean',
    ];

    // Relaciones
    public function league()  // NUEVO
    {
        return $this->belongsTo(League::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function plays()
    {
        return $this->hasMany(Play::class);
    }

    public function coach()
    {
        return $this->hasOne(User::class)->where('role', 'coach');
    }

    // Scopes
    public function scopeInLeague($query, $leagueId)  // NUEVO
    {
        return $query->where('league_id', $leagueId);
    }
}