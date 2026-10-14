 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Posiciones - Flag Football League</title>
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
            --gold: #ffd700;
            --silver: #c0c0c0;
            --bronze: #cd7f32;
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 30px;
            position: relative;
            z-index: 1;
        }

        /* Page Header */
        .page-header {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            border-left: 6px solid var(--accent);
            text-align: center;
        }

        .page-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 56px;
            color: var(--secondary);
            letter-spacing: 3px;
            margin-bottom: 10px;
        }

        .page-header p {
            color: var(--gray-600);
            font-size: 18px;
        }

        .season-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            padding: 12px 20px;
            background: linear-gradient(135deg, var(--accent), #e6c200);
            color: var(--secondary);
            border-radius: 10px;
            font-weight: 800;
            font-size: 16px;
        }

        /* Legend */
        .legend {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 25px 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .legend-title {
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 15px;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .legend-items {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .legend-color {
            width: 30px;
            height: 20px;
            border-radius: 4px;
        }

        .legend-color.gold {
            background: linear-gradient(135deg, var(--gold), #e6c200);
        }

        .legend-color.silver {
            background: linear-gradient(135deg, var(--silver), #a8a8a8);
        }

        .legend-color.bronze {
            background: linear-gradient(135deg, var(--bronze), #b8732d);
        }

        /* Standings Table */
        .standings-table-container {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }

        .standings-table {
            width: 100%;
            border-collapse: collapse;
        }

        .standings-table thead {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-light));
            color: white;
        }

        .standings-table th {
            padding: 20px 15px;
            text-align: left;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 13px;
        }

        .standings-table th.center {
            text-align: center;
        }

        .standings-table tbody tr {
            border-bottom: 2px solid var(--gray-200);
            transition: all 0.3s;
        }

        .standings-table tbody tr:hover {
            background: var(--gray-100);
        }

        .standings-table tbody tr:last-child {
            border-bottom: none;
        }

        .standings-table tbody tr.position-1 {
            background: linear-gradient(90deg, rgba(255, 215, 0, 0.15), transparent);
        }

        .standings-table tbody tr.position-2 {
            background: linear-gradient(90deg, rgba(192, 192, 192, 0.15), transparent);
        }

        .standings-table tbody tr.position-3 {
            background: linear-gradient(90deg, rgba(205, 127, 50, 0.15), transparent);
        }

        .standings-table td {
            padding: 18px 15px;
            font-size: 15px;
        }

        .standings-table td.center {
            text-align: center;
        }

        .rank {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            color: var(--text-dark);
            font-weight: 700;
            width: 60px;
            text-align: center;
        }

        .rank.position-1 {
            color: var(--gold);
        }

        .rank.position-2 {
            color: var(--silver);
        }

        .rank.position-3 {
            color: var(--bronze);
        }

        .rank-medal {
            font-size: 24px;
        }

        .team-cell {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .team-logo-small {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid var(--gray-300);
            background: white;
        }

        .team-logo-placeholder-small {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
            border: 2px solid var(--gray-300);
        }

        .team-info {
            flex: 1;
        }

        .team-name-standings {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 16px;
            margin-bottom: 3px;
        }

        .team-short {
            color: var(--gray-600);
            font-size: 12px;
            font-weight: 600;
        }

        .stat-highlight {
            font-weight: 700;
            color: var(--text-dark);
        }

        .stat-good {
            color: var(--success);
            font-weight: 700;
        }

        .stat-bad {
            color: var(--error);
            font-weight: 700;
        }

        .points-badge {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            letter-spacing: 1px;
            display: inline-block;
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
        @media (max-width: 1024px) {
            .standings-table-container {
                overflow-x: auto;
            }

            .standings-table {
                min-width: 900px;
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
                padding: 30px 20px;
            }

            .page-header h1 {
                font-size: 40px;
            }

            .legend {
                padding: 20px;
            }

            .legend-items {
                flex-direction: column;
                gap: 12px;
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
                <a href="{{ route('teams.index') }}" class="btn-nav">
                    <span>👥</span>
                    <span>Equipos</span>
                </a>
                <a href="{{ route('games') }}" class="btn-nav">
                    <span>📅</span>
                    <span>Partidos</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>🏆 Tabla de Posiciones 🏆</h1>
            <p>Clasificación oficial de la liga</p>
            @if(isset($activeSeason))
                <div class="season-badge">
                    <span>⭐</span>
                    <span>{{ $activeSeason->name }}</span>
                </div>
            @endif
        </div>

        @if(isset($standings) && $standings->count() > 0)
            <!-- Legend -->
            <div class="legend">
                <div class="legend-title">🏅 Posiciones Destacadas</div>
                <div class="legend-items">
                    <div class="legend-item">
                        <div class="legend-color gold"></div>
                        <span><strong>1er Lugar</strong> - Campeón</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color silver"></div>
                        <span><strong>2do Lugar</strong> - Subcampeón</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color bronze"></div>
                        <span><strong>3er Lugar</strong> - Tercer puesto</span>
                    </div>
                </div>
            </div>

            <!-- Standings Table -->
            <div class="standings-table-container">
                <table class="standings-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Equipo</th>
                            <th class="center">PJ</th>
                            <th class="center">G</th>
                            <th class="center">P</th>
                            <th class="center">E</th>
                            <th class="center">PF</th>
                            <th class="center">PC</th>
                            <th class="center">DIF</th>
                            <th class="center">PTS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($standings as $index => $standing)
                            <tr class="position-{{ $index + 1 }}">
                                <td>
                                    <div class="rank position-{{ $index + 1 }}">
                                        @if($index === 0)
                                            <span class="rank-medal">🥇</span>
                                        @elseif($index === 1)
                                            <span class="rank-medal">🥈</span>
                                        @elseif($index === 2)
                                            <span class="rank-medal">🥉</span>
                                        @else
                                            {{ $index + 1 }}
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="team-cell">
                                        @if($standing->team->logo)
                                            <img src="{{ asset('storage/' . $standing->team->logo) }}" alt="{{ $standing->team->name }}" class="team-logo-small">
                                        @else
                                            <div class="team-logo-placeholder-small">
                                                {{ strtoupper(substr($standing->team->short_name, 0, 2)) }}
                                            </div>
                                        @endif
                                        <div class="team-info">
                                            <div class="team-name-standings">{{ $standing->team->name }}</div>
                                            <div class="team-short">{{ $standing->team->short_name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="center stat-highlight">{{ $standing->games_played }}</td>
                                <td class="center stat-good">{{ $standing->wins }}</td>
                                <td class="center stat-bad">{{ $standing->losses }}</td>
                                <td class="center">{{ $standing->draws }}</td>
                                <td class="center">{{ $standing->points_for }}</td>
                                <td class="center">{{ $standing->points_against }}</td>
                                <td class="center stat-highlight">
                                    @php
                                        $diff = $standing->points_for - $standing->points_against;
                                    @endphp
                                    <span class="{{ $diff > 0 ? 'stat-good' : ($diff < 0 ? 'stat-bad' : '') }}">
                                        {{ $diff > 0 ? '+' : '' }}{{ $diff }}
                                    </span>
                                </td>
                                <td class="center">
                                    <span class="points-badge">{{ $standing->points }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Legend Info -->
            <div class="legend">
                <div class="legend-title">📊 Leyenda de la Tabla</div>
                <div class="legend-items">
                    <div class="legend-item">
                        <strong>PJ:</strong> Partidos Jugados
                    </div>
                    <div class="legend-item">
                        <strong>G:</strong> Ganados
                    </div>
                    <div class="legend-item">
                        <strong>P:</strong> Perdidos
                    </div>
                    <div class="legend-item">
                        <strong>E:</strong> Empatados
                    </div>
                    <div class="legend-item">
                        <strong>PF:</strong> Puntos a Favor
                    </div>
                    <div class="legend-item">
                        <strong>PC:</strong> Puntos en Contra
                    </div>
                    <div class="legend-item">
                        <strong>DIF:</strong> Diferencia de Puntos
                    </div>
                    <div class="legend-item">
                        <strong>PTS:</strong> Puntos de la Tabla
                    </div>
                </div>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">🏆</div>
                <h3>No hay clasificación disponible</h3>
                <p>La tabla de posiciones se actualizará cuando comiencen los partidos de la temporada</p>
            </div>
        @endif
    </div>
</body>
</html>