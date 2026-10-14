<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Equipo - Coach</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ff6b35;
            --secondary: #1a472a;
            --success: #10b981;
            --info: #3b82f6;
            --warning: #f59e0b;
            --gray-100: #f5f5f5;
            --gray-600: #757575;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--secondary) 0%, #0a1f14 100%);
            min-height: 100vh;
        }

        .main-content {
            margin-left: 280px;
            padding: 40px 30px;
        }

        @media (max-width: 968px) {
            .main-content { margin-left: 0; padding: 20px 15px; }
        }

        .container { max-width: 1400px; margin: 0 auto; }

        .page-header {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 16px;
            padding: 40px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .team-logo-big {
            width: 140px;
            height: 140px;
            border-radius: 20px;
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 56px;
            font-weight: 900;
            color: var(--primary);
            overflow: hidden;
            flex-shrink: 0;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .team-logo-big img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-info h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 52px;
            color: var(--secondary);
            letter-spacing: 2px;
            margin-bottom: 8px;
            line-height: 1;
        }

        .team-meta {
            color: var(--gray-600);
            font-size: 16px;
            margin-top: 5px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .team-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

        .stat-card {
            background: var(--gray-100);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
        }

        .stat-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 40px;
            color: var(--primary);
            line-height: 1;
        }

        .stat-label {
            font-size: 12px;
            color: var(--gray-600);
            text-transform: uppercase;
            font-weight: 600;
            margin-top: 8px;
            letter-spacing: 0.5px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #d94a1a);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-info {
            background: var(--info);
            color: white;
        }

        .actions-bar {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .section-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--secondary);
            letter-spacing: 1px;
        }

        .players-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
        }

        .player-card {
            background: var(--gray-100);
            border-radius: 12px;
            padding: 18px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .player-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            border-color: var(--primary);
        }

        .player-number {
            width: 52px;
            height: 52px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), #d94a1a);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 26px;
            font-weight: 900;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
        }

        .player-info {
            flex: 1;
        }

        .player-name {
            font-weight: 700;
            font-size: 15px;
            color: var(--secondary);
            margin-bottom: 4px;
        }

        .player-position {
            font-size: 13px;
            color: var(--gray-600);
            font-weight: 600;
        }

        .player-status {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--success);
            flex-shrink: 0;
        }

        .player-status.inactive {
            background: var(--gray-600);
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: var(--gray-600);
        }

        .empty-icon {
            font-size: 72px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-text {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .empty-desc {
            font-size: 14px;
            margin-bottom: 25px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-item {
            display: flex;
            gap: 12px;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 12px;
            color: var(--gray-600);
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 15px;
            color: var(--secondary);
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .page-header { flex-direction: column; text-align: center; }
            .team-info h1 { font-size: 40px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .players-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    @include('components.coach-sidebar')

    <div class="main-content">
        <div class="container">
            <!-- Header del Equipo -->
            <div class="page-header">
                <div class="team-logo-big">
                    @if($team->logo)
                        <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}">
                    @else
                        {{ strtoupper(substr($team->short_name, 0, 2)) }}
                    @endif
                </div>
                <div class="team-info" style="flex: 1;">
                    <h1>{{ $team->name }}</h1>
                    <div class="team-meta">
                        <span>🏆 {{ $team->league->name }}</span>
                        @if($team->city)
                            <span>📍 {{ $team->city }}</span>
                        @endif
                        @if($team->stadium)
                            <span>🏟️ {{ $team->stadium }}</span>
                        @endif
                        @if($team->founded_year)
                            <span>📅 Fundado en {{ $team->founded_year }}</span>
                        @endif
                    </div>

                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-value">{{ $team->players->count() }}</div>
                            <div class="stat-label">Jugadores</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value">{{ $team->players->where('is_active', true)->count() }}</div>
                            <div class="stat-label">Activos</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value">{{ $totalPartidos ?? 0 }}</div>
                            <div class="stat-label">Partidos</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value">{{ $totalJugadas ?? 0 }}</div>
                            <div class="stat-label">Jugadas</div>
                        </div>
                    </div>

                    <div class="actions-bar">
                        <a href="{{ route('coach.team.edit') }}" class="btn btn-primary">
                            ✏️ Editar Equipo
                        </a>
                        <a href="{{ route('coach.players.create') }}" class="btn btn-success">
                            ➕ Nuevo Jugador
                        </a>
                        <a href="{{ route('coach.plays.create') }}" class="btn btn-info">
                            📋 Nueva Jugada
                        </a>
                    </div>
                </div>
            </div>

            <!-- Información del Equipo -->
            @if($team->description || $team->stadium || $team->city)
                <div class="section-card">
                    <h2 class="section-title">ℹ️ Información del Equipo</h2>
                    
                    <div class="info-grid">
                        @if($team->city)
                            <div class="info-item">
                                <div class="info-icon">📍</div>
                                <div class="info-content">
                                    <div class="info-label">Ciudad</div>
                                    <div class="info-value">{{ $team->city }}</div>
                                </div>
                            </div>
                        @endif

                        @if($team->stadium)
                            <div class="info-item">
                                <div class="info-icon">🏟️</div>
                                <div class="info-content">
                                    <div class="info-label">Estadio</div>
                                    <div class="info-value">{{ $team->stadium }}</div>
                                </div>
                            </div>
                        @endif

                        @if($team->founded_year)
                            <div class="info-item">
                                <div class="info-icon">📅</div>
                                <div class="info-content">
                                    <div class="info-label">Fundación</div>
                                    <div class="info-value">{{ $team->founded_year }}</div>
                                </div>
                            </div>
                        @endif

                        <div class="info-item">
                            <div class="info-icon">🏆</div>
                            <div class="info-content">
                                <div class="info-label">Liga</div>
                                <div class="info-value">{{ $team->league->name }}</div>
                            </div>
                        </div>
                    </div>

                    @if($team->description)
                        <div style="margin-top: 25px; padding-top: 25px; border-top: 2px solid #e5e5e5;">
                            <div class="info-label" style="margin-bottom: 10px;">📝 Descripción</div>
                            <p style="color: var(--gray-600); line-height: 1.8;">
                                {{ $team->description }}
                            </p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Plantel -->
            <div class="section-card">
                <div class="section-header">
                    <h2 class="section-title">👥 Mi Plantel ({{ $team->players->count() }})</h2>
                    <a href="{{ route('coach.players.create') }}" class="btn btn-success">
                        ➕ Agregar Jugador
                    </a>
                </div>

                @if($team->players->count() > 0)
                    <div class="players-grid">
                        @foreach($team->players->sortBy('jersey_number') as $player)
                            <div class="player-card">
                                <div class="player-number">#{{ $player->jersey_number }}</div>
                                <div class="player-info">
                                    <div class="player-name">{{ $player->name }} {{ $player->last_name }}</div>
                                    <div class="player-position">{{ $player->position }}</div>
                                </div>
                                <div class="player-status {{ $player->is_active ? '' : 'inactive' }}"></div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">👥</div>
                        <div class="empty-text">Aún no tienes jugadores</div>
                        <div class="empty-desc">Comienza agregando jugadores a tu equipo</div>
                        <a href="{{ route('coach.players.create') }}" class="btn btn-success">
                            ➕ Agregar Primer Jugador
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>