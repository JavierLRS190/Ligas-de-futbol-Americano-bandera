<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'jornada_id',
        'home_team_id',
        'away_team_id',
        'home_score',
        'away_score',
        'game_datetime',
        'location',
        'status',
        'notes',
    ];

    protected $casts = [
        'game_datetime' => 'datetime',
    ];

    public function jornada()
    {
        return $this->belongsTo(Jornada::class);
    }

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function stats()
    {
        return $this->hasMany(GameStat::class);
    }

    public function getWinnerAttribute()
    {
        if ($this->status !== 'finished' || is_null($this->home_score) || is_null($this->away_score)) {
            return null;
        }

        if ($this->home_score > $this->away_score) {
            return $this->homeTeam;
        } elseif ($this->away_score > $this->home_score) {
            return $this->awayTeam;
        }

        return 'tie';
    }
}
