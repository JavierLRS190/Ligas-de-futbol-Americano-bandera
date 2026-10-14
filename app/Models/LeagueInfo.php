<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueInfo extends Model
{
    use HasFactory;

    protected $table = 'league_info';

    protected $fillable = [
        'league_name',
        'logo',
        'description',
        'mission',
        'vision',
        'email',
        'phone',
        'address',
        'social_media',
    ];

    protected $casts = [
        'social_media' => 'array',
    ];
}