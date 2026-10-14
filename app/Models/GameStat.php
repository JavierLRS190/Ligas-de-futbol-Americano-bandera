<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'player_id',
        'team_id',
        'touchdowns',
        'passing_yards',
        'rushing_yards',
        'receiving_yards',
        'receptions',
        'completions',
        'attempts',
        'interceptions_thrown',
        'tackles',
        'sacks',
        'interceptions',
        'fumbles_recovered',
        'fumbles_forced',
        'field_goals_made',
        'field_goals_attempted',
        'extra_points_made',
        'extra_points_attempted',
    ];

    protected $casts = [
        'sacks' => 'decimal:1',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}