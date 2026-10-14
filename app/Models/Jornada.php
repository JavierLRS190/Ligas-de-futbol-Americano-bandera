<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'number',
        'name',
        'date',
        'is_completed',
    ];

    protected $casts = [
        'date' => 'date',
        'is_completed' => 'boolean',
    ];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}