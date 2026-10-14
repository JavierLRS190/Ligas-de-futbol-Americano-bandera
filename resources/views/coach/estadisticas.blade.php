<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas - Flag Football</title>
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

        /* Page Header */
        .page-header {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 30px 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            border-left: 6px solid var(--info);
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

        .team-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
            padding: 10px 15px;
            background: linear-gradient(135deg, var(--info), #2563eb);
            color: white;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
            font-size: 14px;
        }

        .breadcrumb a {
            color: var(--info);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .breadcrumb a:hover {
            color: #2563eb;
        }

        .breadcrumb span {
            color: var(--gray-600);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
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
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
        }

        .stat-card.players::before {
            background: linear-gradient(90deg, var(--info), #2563eb);
        }

        .stat-card.active::before {
            background: linear-gradient(90deg, var(--success), #059669);
        }

        .stat-card.plays::before {
            background: linear-gradient(90deg, var(--warning), #d97706);
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin-bottom: 20px;
        }

        .stat-card.players .stat-icon {
            background: rgba(59, 130, 246, 0.1);
        }

        .stat-card.active .stat-icon {
            background: rgba(16, 185, 129, 0.1);
        }

        .stat-card.plays .stat-icon {
            background: rgba(245, 158, 11, 0.1);
        }

        .stat-label {
            font-size: 14px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .stat-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            color: var(--text-dark);
            letter-spacing: 1px;
        }

        /* Chart Card */
        .chart-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }

        .chart-card h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--secondary);
            margin-bottom: 25px;
            letter-spacing: 1px;
            border-bottom: 3px solid var(--info);
            display: inline-block;
            padding-bottom: 5px;
        }

        /* Position Distribution */
        .position-distribution {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
        }

        .position-item {
            background: var(--gray-100);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s;
        }

        .position-item:hover {
            background: rgba(59, 130, 246, 0.1);
            transform: translateY(-2px);
        }

        .position-abbr {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--info);
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .position-count {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .position-label {
            font-size: 12px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Info Cards */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .info-card h4 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            color: var(--secondary);
            margin-bottom: 20px;
            letter-spacing: 1px;
            border-bottom: 2px solid var(--info);
            padding-bottom: 10px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--gray-200);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-item-label {
            color: var(--gray-600);
            font-size: 14px;
            font-weight: 500;
        }

        .info-item-value {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 16px;
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
            margin-bottom: 25px;
            font-size: 16px;
        }

        /* Alert */
        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.1);
            border: 2px solid var(--info);
            color: #1e40af;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
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

            .stats-grid,
            .info-grid,
            .position-distribution {
                grid-template-columns: 1fr;
            }

            .chart-card {
                padding: 25px 20px;
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
                    <h1>Flag Football</h1>
                    <p>Panel del Coach</p>
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('coach.dashboard') }}" class="btn-back">
                    <span>←</span>
                    <span>Dashboard</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>Estadísticas</h1>
            <p>Análisis y métricas de tu equipo</p>
            <div class="team-badge">
                <span>🏆</span>
                <span>{{ $team->name }}</span>
            </div>
            <div class="breadcrumb">
                <a href="{{ route('coach.dashboard') }}">Dashboard</a>
                <span>→</span>
                <span>Estadísticas</span>
            </div>
        </div>

        <!-- Alert Info -->
        <div class="alert alert-info">
            <span>ℹ️</span>
            <span>Estadísticas actualizadas en tiempo real de tu equipo</span>
        </div>

        <!-- Main Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card players">
                <div class="stat-icon">👥</div>
                <div class="stat-label">Total Jugadores</div>
                <div class="stat-value">{{ $stats['total_players'] }}</div>
            </div>

            <div class="stat-card active">
                <div class="stat-icon">✓</div>
                <div class="stat-label">Jugadores Activos</div>
                <div class="stat-value">{{ $stats['active_players'] }}</div>
            </div>

            <div class="stat-card plays">
                <div class="stat-icon">📋</div>
                <div class="stat-label">Jugadas Diseñadas</div>
                <div class="stat-value">{{ $stats['total_plays'] }}</div>
            </div>
        </div>

        <!-- Position Distribution -->
        <div class="chart-card">
            <h3>Distribución por Posición</h3>
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
                
                $positionCounts = $team->players->groupBy('position')->map->count();
            @endphp

            @if($positionCounts->count() > 0)
                <div class="position-distribution">
                    @foreach($positions as $abbr => $name)
                        @if($positionCounts->has($abbr))
                            <div class="position-item">
                                <div class="position-abbr">{{ $abbr }}</div>
                                <div class="position-count">{{ $positionCounts[$abbr] }}</div>
                                <div class="position-label">{{ $name }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">📊</div>
                    <h3>No hay datos de posiciones</h3>
                    <p>Agrega jugadores a tu equipo para ver la distribución por posiciones</p>
                </div>
            @endif
        </div>

        <!-- Additional Info -->
        <div class="info-grid">
            <!-- Team Summary -->
            <div class="info-card">
                <h4>Resumen del Equipo</h4>
                <div class="info-item">
                    <span class="info-item-label">Nombre del Equipo</span>
                    <span class="info-item-value">{{ $team->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-item-label">Nombre Corto</span>
                    <span class="info-item-value">{{ $team->short_name }}</span>
                </div>
                @if($team->city)
                    <div class="info-item">
                        <span class="info-item-label">Ciudad</span>
                        <span class="info-item-value">{{ $team->city }}</span>
                    </div>
                @endif
                @if($team->founded_year)
                    <div class="info-item">
                        <span class="info-item-label">Año de Fundación</span>
                        <span class="info-item-value">{{ $team->founded_year }}</span>
                    </div>
                @endif
            </div>

            <!-- Players Stats -->
            <div class="info-card">
                <h4>Análisis de Jugadores</h4>
                <div class="info-item">
                    <span class="info-item-label">Total de Jugadores</span>
                    <span class="info-item-value">{{ $stats['total_players'] }}</span>
                </div>
                <div class="info-item">
                    <span class="info-item-label">Jugadores Activos</span>
                    <span class="info-item-value">{{ $stats['active_players'] }}</span>
                </div>
                <div class="info-item">
                    <span class="info-item-label">Jugadores Inactivos</span>
                    <span class="info-item-value">{{ $stats['total_players'] - $stats['active_players'] }}</span>
                </div>
                <div class="info-item">
                    <span class="info-item-label">Posiciones Cubiertas</span>
                    <span class="info-item-value">{{ $positionCounts->count() }} de 11</span>
                </div>
            </div>

            <!-- Playbook Stats -->
            <div class="info-card">
                <h4>Libro de Jugadas</h4>
                @php
                    $playsByType = $team->plays->groupBy('type')->map->count();
                @endphp
                <div class="info-item">
                    <span class="info-item-label">Total de Jugadas</span>
                    <span class="info-item-value">{{ $stats['total_plays'] }}</span>
                </div>
                <div class="info-item">
                    <span class="info-item-label">Jugadas Ofensivas</span>
                    <span class="info-item-value">{{ $playsByType->get('offense', 0) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-item-label">Jugadas Defensivas</span>
                    <span class="info-item-value">{{ $playsByType->get('defense', 0) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-item-label">Jugadas Especiales</span>
                    <span class="info-item-value">{{ $playsByType->get('special', 0) }}</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>