<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Panel - Flag Football</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ff6b35;
            --primary-dark: #d94a1a;
            --secondary: #1a472a;
            --accent: #ffd700;
            --bg-dark: #0a1f14;
            --text-dark: #1a1a1a;
            --gray-100: #f5f5f5;
            --gray-200: #e5e5e5;
            --gray-300: #d4d4d4;
            --gray-600: #757575;
            --success: #10b981;
            --error: #ef4444;
            --info: #3b82f6;
            --warning: #f59e0b;
            --player: #8b5cf6;
            --player-dark: #7c3aed;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--secondary) 0%, var(--bg-dark) 100%);
            min-height: 100vh;
            color: var(--text-dark);
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: repeating-linear-gradient(0deg, transparent, transparent 50px, rgba(255,255,255,0.02) 50px, rgba(255,255,255,0.02) 100px);
            pointer-events: none;
            z-index: 0;
        }

        /* Header */
        .header { background: rgba(255,255,255,0.97); box-shadow: 0 4px 20px rgba(0,0,0,0.3); position: sticky; top: 0; z-index: 100; }
        .header-container { max-width: 1400px; margin: 0 auto; padding: 20px 30px; display: flex; justify-content: space-between; align-items: center; }
        .logo { display: flex; align-items: center; gap: 15px; }
        .logo-icon { font-size: 40px; }
        .logo-text h1 { font-family: 'Bebas Neue', sans-serif; font-size: 28px; color: var(--secondary); letter-spacing: 2px; }
        .logo-text p { font-size: 12px; color: var(--gray-600); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        .header-actions { display: flex; align-items: center; gap: 20px; }
        .user-info { display: flex; align-items: center; gap: 12px; }

        .user-avatar {
            width: 45px; height: 45px; border-radius: 50%;
            background: linear-gradient(135deg, var(--player), var(--player-dark));
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 700; font-size: 18px; overflow: hidden; flex-shrink: 0;
        }
        .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .user-details { display: flex; flex-direction: column; }
        .user-name { font-weight: 700; color: var(--text-dark); font-size: 14px; }
        .user-role { font-size: 12px; color: var(--player); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }

        .btn-logout { padding: 10px 20px; background: var(--error); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; transition: all 0.3s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-logout:hover { background: #dc2626; transform: translateY(-2px); }

        /* Container */
        .container { max-width: 1400px; margin: 0 auto; padding: 40px 30px; position: relative; z-index: 1; }

        /* Alerts */
        .alert { padding: 15px 20px; border-radius: 12px; margin-bottom: 25px; display: flex; align-items: center; gap: 12px; font-size: 14px; font-weight: 500; }
        .alert-success { background: rgba(16,185,129,0.1); border: 2px solid var(--success); color: #047857; }
        .alert-error   { background: rgba(239,68,68,0.1);  border: 2px solid var(--error);   color: #991b1b; }

        /* Team Banner */
        .team-banner { background: rgba(255,255,255,0.97); border-radius: 20px; padding: 40px; margin-bottom: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); display: flex; align-items: center; gap: 30px; position: relative; overflow: hidden; }
        .team-banner::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 6px; background: linear-gradient(90deg, var(--primary), var(--accent)); }
        .team-logo-large { width: 120px; height: 120px; border-radius: 20px; background: white; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 4px solid var(--gray-300); box-shadow: 0 5px 20px rgba(0,0,0,0.2); flex-shrink: 0; }
        .team-logo-large img { width: 100%; height: 100%; object-fit: cover; }
        .team-logo-placeholder { font-size: 64px; }
        .team-info { flex: 1; }
        .team-info h2 { font-family: 'Bebas Neue', sans-serif; font-size: 42px; color: var(--secondary); letter-spacing: 2px; margin-bottom: 5px; }
        .team-subtitle { color: var(--gray-600); font-size: 16px; margin-bottom: 15px; }
        .team-meta { display: flex; gap: 25px; flex-wrap: wrap; }
        .team-meta-item { display: flex; align-items: center; gap: 8px; color: var(--gray-600); font-size: 14px; }
        .team-meta-item span:first-child { font-size: 18px; }

        /* Player Hero */
        .player-hero { background: rgba(255,255,255,0.97); border-radius: 20px; padding: 35px 40px; margin-bottom: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); border-left: 6px solid var(--player); display: flex; align-items: center; gap: 35px; position: relative; overflow: hidden; }
        .player-hero::after { content: attr(data-jersey); position: absolute; right: 30px; top: 50%; transform: translateY(-50%); font-family: 'Bebas Neue', sans-serif; font-size: 120px; color: var(--player); opacity: 0.07; letter-spacing: -5px; line-height: 1; }
        .player-photo { width: 110px; height: 110px; border-radius: 18px; overflow: hidden; border: 4px solid var(--player); box-shadow: 0 5px 20px rgba(139,92,246,0.3); flex-shrink: 0; }
        .player-photo img { width: 100%; height: 100%; object-fit: cover; }
        .player-photo-placeholder { width: 100%; height: 100%; background: linear-gradient(135deg, var(--player), var(--player-dark)); display: flex; align-items: center; justify-content: center; color: white; font-family: 'Bebas Neue', sans-serif; font-size: 42px; letter-spacing: 2px; }
        .player-details { flex: 1; }
        .player-welcome { font-size: 13px; color: var(--gray-600); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 5px; }
        .player-name { font-family: 'Bebas Neue', sans-serif; font-size: 38px; color: var(--text-dark); letter-spacing: 2px; margin-bottom: 10px; line-height: 1; }
        .player-badges { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 15px; }
        .badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: 700; }
        .badge-position { background: linear-gradient(135deg, var(--player), var(--player-dark)); color: white; }
        .badge-jersey   { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; }
        .badge-active   { background: rgba(16,185,129,0.15); color: #047857; border: 1.5px solid var(--success); }
        .badge-inactive { background: rgba(239,68,68,0.1);   color: #991b1b; border: 1.5px solid var(--error); }
        .player-meta { display: flex; gap: 20px; flex-wrap: wrap; }
        .player-meta-item { display: flex; align-items: center; gap: 6px; color: var(--gray-600); font-size: 14px; }

        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: rgba(255,255,255,0.97); border-radius: 18px; padding: 28px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); position: relative; overflow: hidden; transition: transform 0.3s ease; }
        .stat-card:hover { transform: translateY(-4px); }
        .stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 5px; }
        .stat-card.jersey::before   { background: linear-gradient(90deg, var(--primary), var(--primary-dark)); }
        .stat-card.position::before { background: linear-gradient(90deg, var(--player), var(--player-dark)); }
        .stat-card.height::before   { background: linear-gradient(90deg, var(--info), #2563eb); }
        .stat-card.weight::before   { background: linear-gradient(90deg, var(--success), #059669); }
        .stat-icon { width: 60px; height: 60px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 30px; margin-bottom: 16px; }
        .stat-card.jersey .stat-icon   { background: rgba(255,107,53,0.1); }
        .stat-card.position .stat-icon { background: rgba(139,92,246,0.1); }
        .stat-card.height .stat-icon   { background: rgba(59,130,246,0.1); }
        .stat-card.weight .stat-icon   { background: rgba(16,185,129,0.1); }
        .stat-label { font-size: 12px; color: var(--gray-600); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 6px; }
        .stat-value { font-family: 'Bebas Neue', sans-serif; font-size: 38px; color: var(--text-dark); letter-spacing: 1px; line-height: 1; }
        .stat-value.text-value { font-size: 28px; }
        .stat-unit { font-size: 14px; color: var(--gray-600); font-family: 'Inter', sans-serif; font-weight: 600; margin-left: 4px; }

        /* Section Card */
        .section-card { background: rgba(255,255,255,0.97); border-radius: 20px; padding: 35px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); margin-bottom: 30px; }
        .section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 3px solid var(--player); }
        .section-title { font-family: 'Bebas Neue', sans-serif; font-size: 30px; color: var(--secondary); letter-spacing: 1px; }
        .section-count { background: linear-gradient(135deg, var(--player), var(--player-dark)); color: white; padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: 700; }

        /* Plays */
        .play-card { display: flex; align-items: center; gap: 18px; padding: 18px; background: var(--gray-100); border-radius: 14px; margin-bottom: 12px; border-left: 5px solid var(--player); transition: all 0.3s; }
        .play-card:last-child { margin-bottom: 0; }
        .play-card:hover { transform: translateX(4px); background: rgba(139,92,246,0.06); }
        .play-card.offense { border-left-color: var(--info); }
        .play-card.defense { border-left-color: var(--error); }
        .play-card.special { border-left-color: var(--warning); }

        .play-diagram { width: 64px; height: 64px; border-radius: 12px; overflow: hidden; flex-shrink: 0; background: var(--gray-200); display: flex; align-items: center; justify-content: center; font-size: 28px; }
        .play-diagram img { width: 100%; height: 100%; object-fit: cover; }
        .play-info { flex: 1; }
        .play-name { font-weight: 700; font-size: 16px; margin-bottom: 5px; color: var(--text-dark); }
        .play-description { font-size: 13px; color: var(--gray-600); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

        .play-type-badge { padding: 4px 12px; border-radius: 12px; font-size: 11px; font-weight: 700; letter-spacing: 0.5px; flex-shrink: 0; }
        .play-type-badge.offense { background: rgba(59,130,246,0.1);  color: var(--info);    border: 1px solid rgba(59,130,246,0.3); }
        .play-type-badge.defense { background: rgba(239,68,68,0.1);   color: var(--error);   border: 1px solid rgba(239,68,68,0.3); }
        .play-type-badge.special { background: rgba(245,158,11,0.1);  color: var(--warning); border: 1px solid rgba(245,158,11,0.3); }
        .play-type-badge.default { background: rgba(139,92,246,0.1);  color: var(--player);  border: 1px solid rgba(139,92,246,0.3); }

        .empty-state { text-align: center; padding: 40px 20px; color: var(--gray-600); }
        .empty-state-icon { font-size: 48px; margin-bottom: 10px; opacity: 0.5; }

        /* Roster */
        .roster-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 15px; }
        .roster-card { background: var(--gray-100); border-radius: 14px; padding: 20px 15px; text-align: center; border: 2px solid transparent; transition: all 0.3s ease; position: relative; overflow: hidden; }
        .roster-card:hover { border-color: var(--player); background: rgba(139,92,246,0.04); transform: translateY(-2px); }
        .roster-card.is-me { border-color: var(--player); background: linear-gradient(135deg, rgba(139,92,246,0.08), rgba(124,58,237,0.04)); }
        .roster-card.is-me::before { content: 'YO'; position: absolute; top: 8px; right: 8px; background: var(--player); color: white; font-size: 9px; font-weight: 800; padding: 2px 7px; border-radius: 6px; letter-spacing: 1px; }
        .roster-photo { width: 70px; height: 70px; border-radius: 50%; margin: 0 auto 12px; overflow: hidden; border: 3px solid var(--gray-300); }
        .roster-card.is-me .roster-photo { border-color: var(--player); }
        .roster-photo img { width: 100%; height: 100%; object-fit: cover; }
        .roster-photo-placeholder { width: 100%; height: 100%; background: linear-gradient(135deg, var(--info), #2563eb); display: flex; align-items: center; justify-content: center; color: white; font-family: 'Bebas Neue', sans-serif; font-size: 22px; }
        .roster-card.is-me .roster-photo-placeholder { background: linear-gradient(135deg, var(--player), var(--player-dark)); }
        .roster-jersey { font-family: 'Bebas Neue', sans-serif; font-size: 22px; color: var(--primary); letter-spacing: 1px; margin-bottom: 3px; }
        .roster-name { font-weight: 700; font-size: 13px; color: var(--text-dark); margin-bottom: 5px; line-height: 1.2; }
        .roster-position { display: inline-block; background: rgba(139,92,246,0.12); color: var(--player-dark); font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 10px; }
        .roster-active   { position: absolute; top: 8px; left: 8px; width: 8px; height: 8px; background: var(--success);  border-radius: 50%; }
        .roster-inactive { position: absolute; top: 8px; left: 8px; width: 8px; height: 8px; background: var(--gray-300); border-radius: 50%; }

        /* Nav Menu */
        .nav-menu { background: rgba(255,255,255,0.97); border-radius: 20px; padding: 35px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); margin-bottom: 30px; }
        .nav-menu h3 { font-family: 'Bebas Neue', sans-serif; font-size: 30px; color: var(--secondary); margin-bottom: 25px; letter-spacing: 1px; border-bottom: 3px solid var(--player); display: inline-block; padding-bottom: 5px; }
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; }
        .menu-item { padding: 22px 15px; background: var(--gray-100); border-radius: 14px; text-decoration: none; color: var(--text-dark); font-weight: 600; transition: all 0.3s; text-align: center; display: flex; flex-direction: column; align-items: center; gap: 10px; font-size: 14px; border: 2px solid transparent; }
        .menu-item:hover { background: linear-gradient(135deg, var(--player), var(--player-dark)); color: white; transform: translateY(-2px); border-color: var(--player-dark); }
        .menu-item-icon { font-size: 30px; }

        /* Responsive */
        @media (max-width: 768px) {
            .header-container { flex-direction: column; gap: 20px; padding: 20px; }
            .header-actions { width: 100%; justify-content: space-between; }
            .container { padding: 20px 15px; }
            .team-banner { flex-direction: column; text-align: center; padding: 30px 20px; }
            .team-info h2 { font-size: 32px; }
            .team-meta { justify-content: center; }
            .player-hero { flex-direction: column; text-align: center; padding: 25px 20px; }
            .player-hero::after { display: none; }
            .player-badges { justify-content: center; }
            .player-meta { justify-content: center; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .roster-grid { grid-template-columns: repeat(2, 1fr); }
            .menu-grid { grid-template-columns: repeat(2, 1fr); }
            .play-card { flex-wrap: wrap; }
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="header-container">
            <div class="logo">
                <div class="logo-icon">🏈</div>
                <div class="logo-text">
                    <h1>Flag Football</h1>
                    <p>Panel del Jugador</p>
                </div>
            </div>
            <div class="header-actions">
                <div class="user-info">
                    <div class="user-avatar">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                        @else
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        @endif
                    </div>
                    <div class="user-details">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="user-role">Jugador</span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <span>🚪</span>
                        <span>Salir</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="container">

        @if(session('error'))
            <div class="alert alert-error"><span>⚠</span><span>{{ session('error') }}</span></div>
        @endif
        @if(session('success'))
            <div class="alert alert-success"><span>✓</span><span>{{ session('success') }}</span></div>
        @endif

        {{-- Team Banner --}}
        <div class="team-banner">
            <div class="team-logo-large">
                @if($team->logo)
                    <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}">
                @else
                    <span class="team-logo-placeholder">🏈</span>
                @endif
            </div>
            <div class="team-info">
                <h2>{{ $team->name }}</h2>
                <p class="team-subtitle">{{ $team->short_name ?? '' }}</p>
                <div class="team-meta">
                    @if($team->city)
                        <div class="team-meta-item"><span>📍</span><span>{{ $team->city }}</span></div>
                    @endif
                    @if($team->stadium)
                        <div class="team-meta-item"><span>🏟️</span><span>{{ $team->stadium }}</span></div>
                    @endif
                    @if($team->founded_year)
                        <div class="team-meta-item"><span>📅</span><span>Fundado en {{ $team->founded_year }}</span></div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Player Hero --}}
        <div class="player-hero" data-jersey="#{{ $player->jersey_number }}">
            <div class="player-photo">
                @if($player->photo)
                    <img src="{{ asset('storage/' . $player->photo) }}" alt="{{ $player->name }}">
                @else
                    <div class="player-photo-placeholder">
                        {{ strtoupper(substr($player->name, 0, 1)) }}{{ strtoupper(substr($player->last_name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div class="player-details">
                <p class="player-welcome">¡Bienvenido de vuelta!</p>
                <h2 class="player-name">{{ $player->name }} {{ $player->last_name }}</h2>
                <div class="player-badges">
                    <span class="badge badge-position">{{ $player->position }}</span>
                    <span class="badge badge-jersey">#{{ $player->jersey_number }}</span>
                    @if($player->is_active)
                        <span class="badge badge-active">✓ Activo</span>
                    @else
                        <span class="badge badge-inactive">✗ Inactivo</span>
                    @endif
                </div>
                <div class="player-meta">
                    @if($player->birth_date)
                        <div class="player-meta-item">
                            <span>🎂</span>
                            <span>{{ \Carbon\Carbon::parse($player->birth_date)->age }} años</span>
                        </div>
                    @endif
                    @if(Auth::user()->phone)
                        <div class="player-meta-item"><span>📱</span><span>{{ Auth::user()->phone }}</span></div>
                    @endif
                    <div class="player-meta-item"><span>✉️</span><span>{{ Auth::user()->email }}</span></div>
                </div>
            </div>
        </div>

        {{-- Stats físicos --}}
        <div class="stats-grid">
            <div class="stat-card jersey">
                <div class="stat-icon">🔢</div>
                <div class="stat-label">Número de Jersey</div>
                <div class="stat-value">#{{ $player->jersey_number }}</div>
            </div>
            <div class="stat-card position">
                <div class="stat-icon">🏈</div>
                <div class="stat-label">Posición</div>
                <div class="stat-value text-value">{{ $player->position }}</div>
            </div>
            <div class="stat-card height">
                <div class="stat-icon">📏</div>
                <div class="stat-label">Altura</div>
                <div class="stat-value">
                    {{ $player->height ?? '—' }}
                    @if($player->height)<span class="stat-unit">cm</span>@endif
                </div>
            </div>
            <div class="stat-card weight">
                <div class="stat-icon">⚖️</div>
                <div class="stat-label">Peso</div>
                <div class="stat-value">
                    {{ $player->weight ?? '—' }}
                    @if($player->weight)<span class="stat-unit">kg</span>@endif
                </div>
            </div>
        </div>

        {{-- Jugadas del Equipo --}}
        <div class="section-card">
            <div class="section-header">
                <h3 class="section-title">📋 Jugadas del Equipo</h3>
                <span class="section-count">{{ $plays->count() }} jugadas</span>
            </div>

            @if($plays->isEmpty())
                <div class="empty-state">
                    <div class="empty-state-icon">📋</div>
                    <p>No hay jugadas registradas para este equipo.</p>
                </div>
            @else
                @foreach($plays as $play)
                    @php
                        $typeClass = match($play->type) { 'offense' => 'offense', 'defense' => 'defense', 'special' => 'special', default => 'default' };
                        $typeLabel = match($play->type) { 'offense' => 'OFENSIVA', 'defense' => 'DEFENSIVA', 'special' => 'ESPECIAL', default => strtoupper($play->type ?? '—') };
                    @endphp
                    <div class="play-card {{ $typeClass }}">
                        <div class="play-diagram">
                            @if($play->diagram)
                                <img src="{{ asset('storage/' . $play->diagram) }}" alt="{{ $play->name }}">
                            @else
                                🏈
                            @endif
                        </div>
                        <div class="play-info">
                            <div class="play-name">{{ $play->name }}</div>
                            @if($play->description)
                                <div class="play-description">{{ $play->description }}</div>
                            @endif
                        </div>
                        <span class="play-type-badge {{ $typeClass }}">{{ $typeLabel }}</span>
                    </div>
                @endforeach
            @endif
        </div>

        {{-- Roster del Equipo --}}
        <div class="section-card">
            <div class="section-header">
                <h3 class="section-title">👥 Roster del Equipo</h3>
                <span class="section-count">{{ $teammates->count() }} jugadores</span>
            </div>

            @if($teammates->isEmpty())
                <div class="empty-state">
                    <div class="empty-state-icon">👥</div>
                    <p>Aún no hay otros jugadores registrados en el equipo.</p>
                </div>
            @else
                <div class="roster-grid">
                    @foreach($teammates as $mate)
                        <div class="roster-card {{ $mate->id === $player->id ? 'is-me' : '' }}">
                            @if($mate->is_active)
                                <div class="roster-active"></div>
                            @else
                                <div class="roster-inactive"></div>
                            @endif
                            <div class="roster-photo">
                                @if($mate->photo)
                                    <img src="{{ asset('storage/' . $mate->photo) }}" alt="{{ $mate->name }}">
                                @else
                                    <div class="roster-photo-placeholder">
                                        {{ strtoupper(substr($mate->name, 0, 1)) }}{{ strtoupper(substr($mate->last_name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="roster-jersey">#{{ $mate->jersey_number }}</div>
                            <div class="roster-name">{{ $mate->name }} {{ $mate->last_name }}</div>
                            <span class="roster-position">{{ $mate->position }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Navegación --}}
        <div class="nav-menu">
            <h3>Navegación</h3>
            <div class="menu-grid">
                <a href="{{ route('player.dashboard') }}" class="menu-item">
                    <span class="menu-item-icon">🏠</span>
                    <span>Inicio</span>
                </a>
                <a href="{{ route('standings') }}" class="menu-item">
                    <span class="menu-item-icon">🏅</span>
                    <span>Posiciones</span>
                </a>
                <a href="{{ route('home') }}" class="menu-item">
                    <span class="menu-item-icon">🌐</span>
                    <span>Ver Sitio</span>
                </a>
            </div>
        </div>

    </div>
</body>
</html>