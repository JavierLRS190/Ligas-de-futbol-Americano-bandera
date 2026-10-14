<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name', 'email', 'password', 'role',
        'team_id', 'league_id',
        'phone', 'avatar', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'password' => 'hashed',
    ];

    // ============================================
    // RELACIONES
    // ============================================

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function league()
    {
        return $this->belongsTo(League::class);
    }

    // ============================================
    // HELPERS DE ROL
    // ============================================

    /**
     * Admin = role es 'admin' (gestiona TODO el sistema)
     * Reemplaza isSuperAdmin() e isLeagueAdmin()
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCoach(): bool
    {
        return $this->role === 'coach';
    }

    /**
     * @deprecated Usar isAdmin() — se mantiene por compatibilidad
     */
    public function isSuperAdmin(): bool
    {
        return $this->isAdmin();
    }

    /**
     * @deprecated Usar isAdmin() — se mantiene por compatibilidad
     */
    public function isLeagueAdmin(): bool
    {
        return $this->isAdmin();
    }

    /**
     * El admin puede gestionar cualquier liga
     */
    public function canManageLeague($leagueId): bool
    {
        return $this->isAdmin();
    }
    public function isPlayer(): bool
{
    return $this->role === 'player';
}
public function player()
{
    return $this->hasOne(Player::class);
}
}