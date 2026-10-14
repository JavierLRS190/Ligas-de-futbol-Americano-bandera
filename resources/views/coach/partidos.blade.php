<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partidos - Coach</title>
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
            padding: 30px 40px;
            border-radius: 16px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .page-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            color: var(--secondary);
            letter-spacing: 2px;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--gray-600);
            font-size: 16px;
        }

        .filters-card {
            background: rgba(255, 255, 255, 0.97);
            padding: 20px 30px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-label {
            font-weight: 600;
            color: var(--secondary);
            font-size: 14px;
        }

        .filter-btn {
            padding: 8px 18px;
            border-radius: 8px;
            border: 2px solid #e5e5e5;
            background: white;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .filter-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .games-list {
            display: grid;
            gap: 15px;
        }

        .game-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 16px;
            padding: 25px 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: grid;
            grid-template-columns: auto 1fr auto 1fr auto;
            align-items: center;
            gap: 25px;
            transition: all 0.3s;
        }

        .game-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .game-card.my-team {
            border: 2px solid var(--primary);
            background: rgba(255, 107, 53, 0.05);
        }

        .game-meta {
            text-align: center;
            padding: 15px;
            background: var(--gray-100);
            border-radius: 10px;
        }

        .game-date {
            font-size: 12px;
            color: var(--gray-600);
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .game-time {
            font-size: 14px;
            font-weight: 700;
            color: var(--secondary);
        }

        .game-location {
            font-size: 11px;
            color: var(--gray-600);
            margin-top: 3px;
        }

        .team-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .team-section.right {
            flex-direction: row-reverse;
        }

        .team-logo {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            font-weight: 900;
            color: var(--primary);
            overflow: hidden;
            flex-shrink: 0;
        }

        .team-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-info {
            flex: 1;
        }

        .team-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: var(--secondary);
            letter-spacing: 0.5px;
        }

        .team-badge {
            display: inline-block;
            padding: 3px 10px;
            background: var(--primary);
            color: white;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 700;
            margin-top: 3px;
        }

        .score-section {
            text-align: center;
            min-width: 100px;
        }

        .score-display {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            font-weight: 900;
            letter-spacing: 2px;
            line-height: 1;
            color: var(--secondary);
        }

        .score-vs {
            font-size: 16px;
            color: var(--gray-600);
            margin: 5px 0;
        }

        .game-status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            margin-top: 8px;
        }

        .status-scheduled {
            background: rgba(59, 157, 234, 0.15);
            color: var(--info);
        }

        .status-in_progress {
            background: rgba(245, 158, 11, 0.15);
            color: var(--warning);
            animation: pulse 2s infinite;
        }

        .status-finished {
            background: rgba(16, 185, 129, 0.15);
            color: var(--success);
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }

        .empty-state {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 16px;
            padding: 80px 40px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .empty-icon {
            font-size: 80px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-text {
            font-size: 22px;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 10px;
        }

        .empty-desc {
            color: var(--gray-600);
            font-size: 15px;
        }

        @media (max-width: 968px) {
            .game-card {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .team-section.right {
                flex-direction: row;
            }

            .game-meta {
                order: -1;
            }
        }
    </style>
</head>
<body>
    @include('components.coach-sidebar')

    <div class="main-content">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">⚽ Mis Partidos</h1>
                <p class="page-subtitle">Calendario de partidos de {{ auth()->user()->team->name }}</p>
            </div>

            <div class="filters-card">
                <span class="filter-label">Filtrar:</span>
                <button class="filter-btn active" onclick="filterGames('all', this)">Todos</button>
                <button class="filter-btn" onclick="filterGames('upcoming', this)">Próximos</button>
                <button class="filter-btn" onclick="filterGames('in_progress', this)">En Progreso</button>
                <button class="filter-btn" onclick="filterGames('finished', this)">Finalizados</button>
            </div>

            <div class="games-list">
                @forelse($games as $game)
                    <div class="game-card my-team" data-status="{{ $game->status }}">
                        <!-- Metadata -->
                        <div class="game-meta">
                            <div class="game-date">
                                {{ \Carbon\Carbon::parse($game->game_datetime)->translatedFormat('D, d M Y') }}
                            </div>
                            <div class="game-time">
                                {{ \Carbon\Carbon::parse($game->game_datetime)->format('H:i') }}
                            </div>
                            @if($game->location)
                                <div class="game-location">📍 {{ $game->location }}</div>
                            @endif
                        </div>

                        <!-- Equipo Local -->
                        <div class="team-section">
                            <div class="team-logo">
                                @if($game->homeTeam->logo)
                                    <img src="{{ asset('storage/' . $game->homeTeam->logo) }}" alt="{{ $game->homeTeam->name }}">
                                @else
                                    {{ strtoupper(substr($game->homeTeam->short_name, 0, 2)) }}
                                @endif
                            </div>
                            <div class="team-info">
                                <div class="team-name">{{ $game->homeTeam->name }}</div>
                                @if($game->home_team_id == auth()->user()->team_id)
                                    <span class="team-badge">MI EQUIPO</span>
                                @endif
                            </div>
                        </div>

                        <!-- Marcador / Estado -->
                        <div class="score-section">
                            @if($game->status === 'finished')
                                <div class="score-display">
                                    {{ $game->home_score }} - {{ $game->away_score }}
                                </div>
                                <span class="game-status status-finished">Finalizado</span>
                            @elseif($game->status === 'in_progress')
                                <div class="score-display">
                                    {{ $game->home_score ?? 0 }} - {{ $game->away_score ?? 0 }}
                                </div>
                                <span class="game-status status-in_progress">● En Vivo</span>
                            @else
                                <div class="score-vs">VS</div>
                                <span class="game-status status-scheduled">Programado</span>
                            @endif
                        </div>

                        <!-- Equipo Visitante -->
                        <div class="team-section right">
                            <div class="team-logo">
                                @if($game->awayTeam->logo)
                                    <img src="{{ asset('storage/' . $game->awayTeam->logo) }}" alt="{{ $game->awayTeam->name }}">
                                @else
                                    {{ strtoupper(substr($game->awayTeam->short_name, 0, 2)) }}
                                @endif
                            </div>
                            <div class="team-info">
                                <div class="team-name">{{ $game->awayTeam->name }}</div>
                                @if($game->away_team_id == auth()->user()->team_id)
                                    <span class="team-badge">MI EQUIPO</span>
                                @endif
                            </div>
                        </div>

                        <!-- Info Jornada -->
                        <div class="game-meta">
                            <div class="game-date">{{ $game->jornada->name }}</div>
                            <div class="game-time">{{ $game->jornada->season->name }}</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">⚽</div>
                        <div class="empty-text">No hay partidos programados</div>
                        <div class="empty-desc">Aún no se han programado partidos para tu equipo</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function filterGames(status, btn) {
            // Actualizar botones activos
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Filtrar partidos
            const cards = document.querySelectorAll('.game-card');
            cards.forEach(card => {
                if (status === 'all') {
                    card.style.display = '';
                } else if (status === 'upcoming') {
                    card.style.display = card.dataset.status === 'scheduled' ? '' : 'none';
                } else {
                    card.style.display = card.dataset.status === status ? '' : 'none';
                }
            });
        }
    </script>
</body>
</html>