<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Equipo - Admin</title>
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

        .breadcrumb {
            background: rgba(255, 255, 255, 0.97);
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .breadcrumb a { color: var(--primary); text-decoration: none; font-weight: 600; }
        .breadcrumb span { color: var(--gray-600); }

        .header-card {
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
            width: 120px;
            height: 120px;
            border-radius: 20px;
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            font-weight: 900;
            color: var(--primary);
            overflow: hidden;
            flex-shrink: 0;
        }

        .team-logo-big img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-info h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            color: var(--secondary);
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .team-meta {
            color: var(--gray-600);
            font-size: 16px;
            margin-top: 5px;
        }

        .team-badges {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .badge {
            padding: 6px 14px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.15);
            color: var(--success);
        }

        .badge-info {
            background: rgba(59, 157, 234, 0.15);
            color: var(--info);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .stat-card {
            background: var(--gray-100);
            padding: 25px;
            border-radius: 12px;
            text-align: center;
        }

        .stat-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            color: var(--primary);
            line-height: 1;
        }

        .stat-label {
            font-size: 13px;
            color: var(--gray-600);
            text-transform: uppercase;
            font-weight: 600;
            margin-top: 8px;
            letter-spacing: 0.5px;
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

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
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
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
        }

        .btn-secondary {
            background: var(--gray-600);
            color: white;
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .players-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .player-card {
            background: var(--gray-100);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s;
        }

        .player-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .player-number {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            font-weight: 900;
            flex-shrink: 0;
        }

        .player-info {
            flex: 1;
        }

        .player-name {
            font-weight: 700;
            font-size: 16px;
            color: var(--secondary);
            margin-bottom: 3px;
        }

        .player-position {
            font-size: 13px;
            color: var(--gray-600);
            font-weight: 600;
        }

        .coach-card {
            background: linear-gradient(135deg, var(--info), #2563eb);
            color: white;
            padding: 25px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .coach-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 900;
            overflow: hidden;
        }

        .coach-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .coach-info h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .coach-contact {
            font-size: 14px;
            opacity: 0.9;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray-600);
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 15px;
            opacity: 0.3;
        }

        .empty-text {
            font-size: 18px;
            font-weight: 600;
        }

        .actions-bar {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .header-card { flex-direction: column; text-align: center; }
            .team-info h1 { font-size: 36px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>
    @include('components.admin-sidebar')

    <div class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>→</span>
                <a href="{{ route('admin.teams.index') }}">Equipos</a>
                <span>→</span>
                <span>{{ $team->name }}</span>
            </div>

            <!-- Header con info del equipo -->
            <div class="header-card">
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
                        🏆 {{ $team->league->name }} • 
                        📍 {{ $team->city ?? 'Sin ciudad' }} •
                        🏟️ {{ $team->stadium ?? 'Sin estadio' }}
                    </div>
                    <div class="team-badges">
                        @if($team->is_active)
                            <span class="badge badge-success">✅ Activo</span>
                        @endif
                        <span class="badge badge-info">👥 {{ $team->players->count() }} Jugadores</span>
                        @if($team->founded_year)
                            <span class="badge badge-info">📅 Fundado en {{ $team->founded_year }}</span>
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
                            <div class="stat-value">{{ $team->games_as_home_count + $team->games_as_away_count ?? 0 }}</div>
                            <div class="stat-label">Partidos</div>
                        </div>
                    </div>

                    <div class="actions-bar" style="margin-top: 25px;">
                        <a href="{{ route('admin.teams.edit', $team->id) }}" class="btn btn-primary">
                            ✏️ Editar Equipo
                        </a>
                        <a href="{{ route('admin.players.create', ['team_id' => $team->id]) }}" class="btn btn-success">
                            ➕ Agregar Jugador
                        </a>
                    </div>
                </div>
            </div>

            <!-- Coach -->
            @if($team->coach)
                <div class="section-card">
                    <h2 class="section-title">🎓 Entrenador</h2>
                    <div class="coach-card">
                        <div class="coach-avatar">
                            @if($team->coach->avatar)
                                <img src="{{ asset('storage/' . $team->coach->avatar) }}" alt="{{ $team->coach->name }}">
                            @else
                                {{ strtoupper(substr($team->coach->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="coach-info">
                            <h3>{{ $team->coach->name }}</h3>
                            <div class="coach-contact">
                                📧 {{ $team->coach->email }}
                                @if($team->coach->phone)
                                    • 📞 {{ $team->coach->phone }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Jugadores -->
            <div class="section-card">
                <div class="section-header">
                    <h2 class="section-title">👥 Plantel ({{ $team->players->count() }})</h2>
                    <a href="{{ route('admin.players.create', ['team_id' => $team->id]) }}" class="btn btn-success">
                        ➕ Nuevo Jugador
                    </a>
                </div>

                @if($team->players->count() > 0)
                    <div class="players-grid">
                        @foreach($team->players->sortBy('jersey_number') as $player)
                            <div class="player-card">
                                <div class="player-number">{{ $player->jersey_number }}</div>
                                <div class="player-info">
                                    <div class="player-name">{{ $player->name }} {{ $player->last_name }}</div>
                                    <div class="player-position">{{ $player->position }}</div>
                                </div>
                                <a href="{{ route('admin.players.edit', $player->id) }}" class="btn btn-secondary" style="padding: 6px 12px; font-size: 12px;">
                                    ✏️
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">👥</div>
                        <div class="empty-text">No hay jugadores registrados</div>
                        <a href="{{ route('admin.players.create', ['team_id' => $team->id]) }}" class="btn btn-success" style="margin-top: 20px;">
                            ➕ Agregar Primer Jugador
                        </a>
                    </div>
                @endif
            </div>

            <!-- Descripción -->
            @if($team->description)
                <div class="section-card">
                    <h2 class="section-title">📝 Descripción</h2>
                    <p style="color: var(--gray-600); line-height: 1.8;">
                        {{ $team->description }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>