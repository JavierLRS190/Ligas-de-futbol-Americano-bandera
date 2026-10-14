<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'league_id',  // ← AGREGAR ESTA LÍNEA
        'name',
        'year',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    // ============================================
    // RELACIONES
    // ============================================

    public function league()  // ← AGREGAR ESTA RELACIÓN
    {
        return $this->belongsTo(League::class);
    }

    public function jornadas()
    {
        return $this->hasMany(Jornada::class);
    }

    public function standings()
    {
        return $this->hasMany(Standing::class)->orderBy('points', 'desc');
    }
    
    public function games()  // ← AGREGAR ESTA RELACIÓN (útil)
    {
        return $this->hasManyThrough(Game::class, Jornada::class);
    }
}