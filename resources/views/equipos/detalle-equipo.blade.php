<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $team->name }} - Flag Football League</title>
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

        .btn-back {
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

        .btn-back:hover {
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

        /* Team Hero */
        .team-hero {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .team-hero-banner {
            height: 200px;
            background: linear-gradient(135deg, var(--secondary), var(--secondary-light));
            position: relative;
            overflow: hidden;
        }

        .team-hero-banner::before {
            content: '🏈';
            position: absolute;
            font-size: 200px;
            opacity: 0.1;
            right: -50px;
            top: 50%;
            transform: translateY(-50%) rotate(-15deg);
        }

        .team-hero-content {
            padding: 40px;
            display: flex;
            align-items: flex-start;
            gap: 40px;
            margin-top: -80px;
            position: relative;
        }

        .team-logo-large {
            width: 180px;
            height: 180px;
            border-radius: 20px;
            object-fit: cover;
            border: 6px solid white;
            background: white;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            flex-shrink: 0;
        }

        .team-logo-placeholder-large {
            width: 180px;
            height: 180px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 64px;
            letter-spacing: 2px;
            border: 6px solid white;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            flex-shrink: 0;
        }

        .team-info-header {
            flex: 1;
            padding-top: 60px;
        }

        .team-name-large {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 56px;
            color: var(--secondary);
            margin-bottom: 10px;
            letter-spacing: 3px;
        }

        .team-short-name-large {
            color: var(--gray-600);
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .team-meta {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        .team-meta-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--gray-600);
            font-size: 16px;
        }

        .team-meta-item span:first-child {
            font-size: 24px;
        }

        .team-meta-item strong {
            color: var(--text-dark);
        }

        .team-description {
            padding: 0 40px 40px 40px;
        }

        .team-description p {
            color: var(--gray-600);
            font-size: 16px;
            line-height: 1.8;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: rgba(255, 107, 53, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 15px;
        }

        .stat-label {
            font-size: 13px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .stat-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            color: var(--text-dark);
            letter-spacing: 1px;
        }

        /* Section */
        .section {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 35px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 36px;
            color: var(--secondary);
            margin-bottom: 25px;
            letter-spacing: 2px;
            border-bottom: 3px solid var(--primary);
            display: inline-block;
            padding-bottom: 5px;
        }

        /* Position Groups */
        .position-group {
            margin-bottom: 30px;
        }

        .position-group:last-child {
            margin-bottom: 0;
        }

        .position-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--gray-200);
        }

        .position-badge {
            background: linear-gradient(135deg, var(--info), #2563eb);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .position-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            color: var(--secondary);
            letter-spacing: 1px;
        }

        .position-count {
            margin-left: auto;
            color: var(--gray-600);
            font-weight: 600;
        }

        /* Players Grid */
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
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .player-photo {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            object-fit: cover;
            border: 3px solid white;
            flex-shrink: 0;
        }

        .player-photo-placeholder {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--info), #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 20px;
            border: 3px solid white;
            flex-shrink: 0;
        }

        .player-info {
            flex: 1;
        }

        .player-name {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 16px;
            margin-bottom: 5px;
        }

        .player-meta {
            color: var(--gray-600);
            font-size: 13px;
        }

        .player-jersey {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 10px 15px;
            border-radius: 10px;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            letter-spacing: 1px;
            flex-shrink: 0;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 15px;
            opacity: 0.3;
        }

        .empty-state h4 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            color: var(--text-dark);
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .empty-state p {
            color: var(--gray-600);
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .team-hero-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .team-info-header {
                padding-top: 0;
            }

            .team-meta {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
            }

            .container {
                padding: 20px 15px;
            }

            .team-name-large {
                font-size: 40px;
            }

            .team-hero-content {
                padding: 30px 20px;
            }

            .team-description {
                padding: 0 20px 30px 20px;
            }

            .section {
                padding: 25px 20px;
            }

            .stats-grid,
            .players-grid {
                grid-template-columns: 1fr;
            }

            .team-logo-large,
            .team-logo-placeholder-large {
                width: 140px;
                height: 140px;
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

            <a href="{{ route('teams.index') }}" class="btn-back">
                <span>←</span>
                <span>Todos los Equipos</span>
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <!-- Team Hero -->
        <div class="team-hero">
            <div class="team-hero-banner"></div>
            <div class="team-hero-content">
                @if($team->logo)
                    <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="team-logo-large">
                @else
                    <div class="team-logo-placeholder-large">
                        {{ strtoupper(substr($team->short_name, 0, 3)) }}
                    </div>
                @endif

                <div class="team-info-header">
                    <h1 class="team-name-large">{{ $team->name }}</h1>
                    <div class="team-short-name-large">{{ $team->short_name }}</div>

                    <div class="team-meta">
                        @if($team->city)
                            <div class="team-meta-item">
                                <span>📍</span>
                                <span><strong>{{ $team->city }}</strong></span>
                            </div>
                        @endif

                        @if($team->stadium)
                            <div class="team-meta-item">
                                <span>🏟️</span>
                                <span><strong>{{ $team->stadium }}</strong></span>
                            </div>
                        @endif

                        @if($team->founded_year)
                            <div class="team-meta-item">
                                <span>📅</span>
                                <span>Fundado en <strong>{{ $team->founded_year }}</strong></span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($team->description)
                <div class="team-description">
                    <p>{{ $team->description }}</p>
                </div>
            @endif
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-label">Jugadores Activos</div>
                <div class="stat-value">{{ $stats['total_players'] }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📋</div>
                <div class="stat-label">Posiciones Cubiertas</div>
                <div class="stat-value">{{ $stats['positions_covered'] }}/11</div>
            </div>
        </div>

        <!-- Roster Section -->
        <div class="section">
            <h2 class="section-title">Roster del Equipo</h2>

            @if($team->players->count() > 0)
                @php
                    $positions = [
                        'QB' => 'Quarterback',
                        'RB' => 'Running Back',
                        'WR' => 'Wide Receiver',
                        'TE' => 'Tight End',
                        'OL' => 'Offensive Line',
                        'DL' => 'Defensive Line',
                        'LB' => 'Linebacker',
                        'CB' => 'Cornerback',
                        'S' => 'Safety',
                        'K' => 'Kicker',
                        'P' => 'Punter'
                    ];
                @endphp

                @foreach($positions as $abbr => $name)
                    @if($playersByPosition->has($abbr))
                        <div class="position-group">
                            <div class="position-header">
                                <div class="position-badge">{{ $abbr }}</div>
                                <div class="position-name">{{ $name }}</div>
                                <div class="position-count">{{ $playersByPosition[$abbr]->count() }} {{ $playersByPosition[$abbr]->count() === 1 ? 'jugador' : 'jugadores' }}</div>
                            </div>

                            <div class="players-grid">
                                @foreach($playersByPosition[$abbr] as $player)
                                    <div class="player-card">
                                        @if($player->photo)
                                            <img src="{{ asset('storage/' . $player->photo) }}" alt="{{ $player->name }}" class="player-photo">
                                        @else
                                            <div class="player-photo-placeholder">
                                                {{ strtoupper(substr($player->name, 0, 1)) }}{{ strtoupper(substr($player->last_name, 0, 1)) }}
                                            </div>
                                        @endif

                                        <div class="player-info">
                                            <div class="player-name">{{ $player->name }} {{ $player->last_name }}</div>
                                            <div class="player-meta">
                                                @if($player->height && $player->weight)
                                                    {{ number_format($player->height, 0) }}cm • {{ number_format($player->weight, 0) }}kg
                                                @elseif($player->height)
                                                    {{ number_format($player->height, 0) }}cm
                                                @elseif($player->weight)
                                                    {{ number_format($player->weight, 0) }}kg
                                                @else
                                                    {{ $abbr }}
                                                @endif
                                            </div>
                                        </div>

                                        <div class="player-jersey">
                                            #{{ $player->jersey_number }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="empty-state">
                    <div class="empty-icon">👥</div>
                    <h4>No hay jugadores registrados</h4>
                    <p>Este equipo aún no tiene jugadores en su roster</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>