<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    'team_id',
    'name',
    'last_name',
    'jersey_number',
    'position',
    'birth_date',
    'height',
    'weight',
    'photo',
    'is_active',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_active' => 'boolean',
        'height' => 'decimal:2',
        'weight' => 'decimal:2',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function gameStats()
    {
        return $this->hasMany(GameStat::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->last_name}";
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}