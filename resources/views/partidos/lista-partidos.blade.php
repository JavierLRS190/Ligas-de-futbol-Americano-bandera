<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partidos - Flag Football</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ff6b35;
            --primary-dark: #d94a1a;
            --secondary: #1a472a;
            --secondary-light: #2d5a3d;
            --accent: #ffd700;
            --bg-dark: #0a1f14;
            --text-light: #ffffff;
            --text-dark: #1a1a1a;
            --gray-100: #f5f5f5;
            --gray-200: #e5e5e5;
            --gray-300: #d4d4d4;
            --gray-600: #757575;
            --success: #10b981;
            --error: #ef4444;
            --info: #3b82f6;
            --warning: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--secondary) 0%, var(--bg-dark) 100%);
            min-height: 100vh;
            color: var(--text-dark);
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 50px,
                    rgba(255, 255, 255, 0.02) 50px,
                    rgba(255, 255, 255, 0.02) 100px
                );
            pointer-events: none;
            z-index: 0;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.97);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-icon {
            font-size: 40px;
        }

        .logo-text h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            color: var(--secondary);
            letter-spacing: 2px;
        }

        .logo-text p {
            font-size: 12px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .header-nav {
            display: flex;
            gap: 20px;
        }

        .btn-nav {
            padding: 10px 20px;
            background: var(--gray-200);
            color: var(--text-dark);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav:hover {
            background: var(--gray-300);
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 30px;
            position: relative;
            z-index: 1;
        }

        /* Page Header */
        .page-header {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 30px 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            border-left: 6px solid var(--primary);
        }

        .page-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            color: var(--secondary);
            letter-spacing: 2px;
            margin-bottom: 8px;
        }

        .page-header p {
            color: var(--gray-600);
            font-size: 16px;
        }

        /* Games List */
        .games-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 30px;
        }

        .game-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .game-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
        }

        .game-header {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-light));
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .game-jornada {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            letter-spacing: 1px;
        }

        .game-datetime {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 14px;
        }

        .game-date {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .game-time {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .game-status-badge {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .game-status-badge.scheduled {
            background: rgba(59, 130, 246, 0.2);
            color: white;
        }

        .game-status-badge.live {
            background: var(--error);
            color: white;
            animation: pulse 2s infinite;
        }

        .game-status-badge.finished {
            background: rgba(16, 185, 129, 0.2);
            color: white;
        }

        .game-status-badge.cancelled {
            background: rgba(107, 114, 128, 0.2);
            color: white;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        .game-body {
            padding: 30px;
        }

        .game-matchup {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 30px;
        }

        .team {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .team.away {
            justify-content: flex-end;
        }

        .team.away .team-info {
            text-align: right;
        }

        .team-logo {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            border: 3px solid var(--gray-300);
            background: white;
        }

        .team-logo-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            font-weight: 700;
            border: 3px solid var(--gray-300);
        }

        .team-info {
            flex: 1;
        }

        .team-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            color: var(--secondary);
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        .team-record {
            color: var(--gray-600);
            font-size: 14px;
            font-weight: 600;
        }

        .team.winner .team-name {
            color: var(--success);
        }

        .score-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .score {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 56px;
            color: var(--text-dark);
            letter-spacing: 2px;
            line-height: 1;
        }

        .vs {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            color: var(--gray-600);
            letter-spacing: 1px;
        }

        .game-footer {
            padding: 20px 30px;
            background: var(--gray-100);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .game-location {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray-600);
            font-size: 14px;
        }

        .game-location strong {
            color: var(--text-dark);
        }

        .game-notes {
            color: var(--gray-600);
            font-size: 13px;
            font-style: italic;
        }

        /* Pagination */
        .pagination {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 16px;
            border: 2px solid var(--gray-300);
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            transition: all 0.3s;
        }

        .pagination a:hover {
            border-color: var(--primary);
            background: var(--primary);
            color: white;
        }

        .pagination .active {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .pagination .disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Empty State */
        .empty-state {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .empty-icon {
            font-size: 80px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--text-dark);
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .empty-state p {
            color: var(--gray-600);
            font-size: 16px;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .game-matchup {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .team.away {
                flex-direction: row-reverse;
                justify-content: flex-start;
            }

            .team.away .team-info {
                text-align: left;
            }

            .score-section {
                order: -1;
            }

            .team-logo,
            .team-logo-placeholder {
                width: 60px;
                height: 60px;
            }

            .team-name {
                font-size: 22px;
            }

            .score {
                font-size: 42px;
            }
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
            }

            .header-nav {
                width: 100%;
                justify-content: space-around;
            }

            .container {
                padding: 20px 15px;
            }

            .page-header {
                padding: 25px 20px;
            }

            .page-header h1 {
                font-size: 36px;
            }

            .game-header {
                padding: 15px 20px;
            }

            .game-body {
                padding: 20px;
            }

            .game-footer {
                padding: 15px 20px;
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <div class="logo-icon">🏈</div>
                <div class="logo-text">
                    <h1>Flag Football League</h1>
                    <p>Temporada 2025</p>
                </div>
            </div>

            <div class="header-nav">
                <a href="{{ route('home') }}" class="btn-nav">
                    <span>🏠</span>
                    <span>Inicio</span>
                </a>
                <a href="{{ route('standings') }}" class="btn-nav">
                    <span>🏆</span>
                    <span>Posiciones</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>Calendario de Partidos</h1>
            <p>Todos los encuentros de la temporada</p>
        </div>

        <!-- Games List -->
        @if($games->count() > 0)
            <div class="games-list">
                @foreach($games as $game)
                    <div class="game-card">
                        <!-- Game Header -->
                        <div class="game-header">
                            <div class="game-jornada">
                                {{ $game->jornada ? $game->jornada->name : 'Jornada TBD' }}
                            </div>
                            <div class="game-datetime">
                                <div class="game-date">
                                    <span>📅</span>
                                    <span>{{ \Carbon\Carbon::parse($game->game_datetime)->format('d/m/Y') }}</span>
                                </div>
                                <div class="game-time">
                                    <span>🕐</span>
                                    <span>{{ \Carbon\Carbon::parse($game->game_datetime)->format('H:i') }}</span>
                                </div>
                            </div>
                            <span class="game-status-badge {{ $game->status }}">
                                @if($game->status === 'scheduled')
                                    Programado
                                @elseif($game->status === 'live')
                                    🔴 En Vivo
                                @elseif($game->status === 'finished')
                                    Finalizado
                                @else
                                    Cancelado
                                @endif
                            </span>
                        </div>

                        <!-- Game Body -->
                        <div class="game-body">
                            <div class="game-matchup">
                                <!-- Home Team -->
                                <div class="team home {{ $game->status === 'finished' && $game->home_score > $game->away_score ? 'winner' : '' }}">
                                    @if($game->homeTeam)
                                        @if($game->homeTeam->logo)
                                            <img src="{{ asset('storage/' . $game->homeTeam->logo) }}" alt="{{ $game->homeTeam->name }}" class="team-logo">
                                        @else
                                            <div class="team-logo-placeholder">
                                                {{ strtoupper(substr($game->homeTeam->short_name, 0, 2)) }}
                                            </div>
                                        @endif
                                        <div class="team-info">
                                            <div class="team-name">{{ $game->homeTeam->name }}</div>
                                            <div class="team-record">{{ $game->homeTeam->short_name }}</div>
                                        </div>
                                    @else
                                        <div class="team-logo-placeholder">?</div>
                                        <div class="team-info">
                                            <div class="team-name">TBD</div>
                                            <div class="team-record">Por Definir</div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Score Section -->
                                <div class="score-section">
                                    @if($game->status === 'finished' || $game->status === 'live')
                                        <div style="display: flex; align-items: center; gap: 20px;">
                                            <div class="score">{{ $game->home_score ?? 0 }}</div>
                                            <div class="vs">-</div>
                                            <div class="score">{{ $game->away_score ?? 0 }}</div>
                                        </div>
                                    @else
                                        <div class="vs">VS</div>
                                    @endif
                                </div>

                                <!-- Away Team -->
                                <div class="team away {{ $game->status === 'finished' && $game->away_score > $game->home_score ? 'winner' : '' }}">
                                    <div class="team-info">
                                        @if($game->awayTeam)
                                            <div class="team-name">{{ $game->awayTeam->name }}</div>
                                            <div class="team-record">{{ $game->awayTeam->short_name }}</div>
                                        @else
                                            <div class="team-name">TBD</div>
                                            <div class="team-record">Por Definir</div>
                                        @endif
                                    </div>
                                    @if($game->awayTeam)
                                        @if($game->awayTeam->logo)
                                            <img src="{{ asset('storage/' . $game->awayTeam->logo) }}" alt="{{ $game->awayTeam->name }}" class="team-logo">
                                        @else
                                            <div class="team-logo-placeholder">
                                                {{ strtoupper(substr($game->awayTeam->short_name, 0, 2)) }}
                                            </div>
                                        @endif
                                    @else
                                        <div class="team-logo-placeholder">?</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Game Footer -->
                        @if($game->location || $game->notes)
                            <div class="game-footer">
                                @if($game->location)
                                    <div class="game-location">
                                        <span>📍</span>
                                        <strong>{{ $game->location }}</strong>
                                    </div>
                                @endif
                                @if($game->notes)
                                    <div class="game-notes">{{ $game->notes }}</div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination">
                {{ $games->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">🏈</div>
                <h3>No hay partidos programados</h3>
                <p>Pronto se anunciarán los encuentros de la temporada</p>
            </div>
        @endif
    </div>
</body>
</html>