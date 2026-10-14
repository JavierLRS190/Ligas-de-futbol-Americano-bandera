<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Equipo - Flag Football</title>
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

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
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
            padding: 50px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .team-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(90deg, var(--info), #2563eb, var(--accent));
        }

        .team-hero-content {
            display: flex;
            align-items: center;
            gap: 40px;
            margin-bottom: 30px;
        }

        .team-logo-container {
            position: relative;
        }

        .team-logo-large {
            width: 150px;
            height: 150px;
            border-radius: 20px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 5px solid var(--gray-300);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .team-logo-large img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-logo-placeholder {
            font-size: 72px;
        }

        .status-badge {
            position: absolute;
            bottom: -10px;
            right: -10px;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .status-badge.active {
            background: var(--success);
            color: white;
        }

        .status-badge.inactive {
            background: var(--error);
            color: white;
        }

        .team-info {
            flex: 1;
        }

        .team-name-section h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 56px;
            color: var(--secondary);
            letter-spacing: 3px;
            margin-bottom: 10px;
            line-height: 1;
        }

        .team-short-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            color: var(--info);
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .team-meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .meta-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--info), #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .meta-content {
            flex: 1;
        }

        .meta-label {
            font-size: 12px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 3px;
        }

        .meta-value {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 16px;
        }

        .team-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-edit {
            padding: 15px 30px;
            background: linear-gradient(135deg, var(--info), #2563eb);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            font-size: 15px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        /* Description */
        .team-description {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 35px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .team-description h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--secondary);
            margin-bottom: 20px;
            letter-spacing: 1px;
            border-bottom: 3px solid var(--info);
            display: inline-block;
            padding-bottom: 5px;
        }

        .team-description p {
            color: var(--gray-600);
            line-height: 1.8;
            font-size: 16px;
        }

        .no-description {
            color: var(--gray-600);
            font-style: italic;
        }

        /* Stats Grid */
        .stats-section {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }

        .stats-section h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--secondary);
            margin-bottom: 25px;
            letter-spacing: 1px;
            border-bottom: 3px solid var(--info);
            display: inline-block;
            padding-bottom: 5px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .stat-box {
            background: linear-gradient(135deg, var(--gray-100), white);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            border: 2px solid var(--gray-300);
            transition: all 0.3s;
        }

        .stat-box:hover {
            transform: translateY(-5px);
            border-color: var(--info);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.2);
        }

        .stat-icon {
            font-size: 40px;
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

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 2px solid var(--success);
            color: #047857;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 2px solid var(--error);
            color: #991b1b;
        }

        /* Quick Links */
        .quick-links {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .quick-links h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--secondary);
            margin-bottom: 25px;
            letter-spacing: 1px;
            border-bottom: 3px solid var(--info);
            display: inline-block;
            padding-bottom: 5px;
        }

        .links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .link-card {
            padding: 20px;
            background: var(--gray-100);
            border-radius: 12px;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 15px;
            border: 2px solid transparent;
        }

        .link-card:hover {
            background: linear-gradient(135deg, var(--info), #2563eb);
            color: white;
            transform: translateY(-2px);
            border-color: #2563eb;
        }

        .link-icon {
            font-size: 28px;
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

            .team-hero {
                padding: 30px 20px;
            }

            .team-hero-content {
                flex-direction: column;
                text-align: center;
            }

            .team-name-section h1 {
                font-size: 42px;
            }

            .team-meta-grid,
            .stats-grid,
            .links-grid {
                grid-template-columns: 1fr;
            }

            .stats-section,
            .team-description,
            .quick-links {
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
        @if(session('success'))
            <div class="alert alert-success">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <span>⚠</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Team Hero -->
        <div class="team-hero">
            <div class="team-hero-content">
                <div class="team-logo-container">
                    <div class="team-logo-large">
                        @if($team->logo)
                            <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}">
                        @else
                            <span class="team-logo-placeholder">🏈</span>
                        @endif
                    </div>
                    <div class="status-badge {{ $team->is_active ? 'active' : 'inactive' }}">
                        {{ $team->is_active ? '✓ Activo' : '✗ Inactivo' }}
                    </div>
                </div>

                <div class="team-info">
                    <div class="team-name-section">
                        <h1>{{ $team->name }}</h1>
                        <div class="team-short-name">{{ $team->short_name }}</div>
                    </div>

                    <div class="team-meta-grid">
                        @if($team->city)
                            <div class="meta-item">
                                <div class="meta-icon">📍</div>
                                <div class="meta-content">
                                    <div class="meta-label">Ciudad</div>
                                    <div class="meta-value">{{ $team->city }}</div>
                                </div>
                            </div>
                        @endif

                        @if($team->stadium)
                            <div class="meta-item">
                                <div class="meta-icon">🏟️</div>
                                <div class="meta-content">
                                    <div class="meta-label">Estadio</div>
                                    <div class="meta-value">{{ $team->stadium }}</div>
                                </div>
                            </div>
                        @endif

                        @if($team->founded_year)
                            <div class="meta-item">
                                <div class="meta-icon">📅</div>
                                <div class="meta-content">
                                    <div class="meta-label">Fundado</div>
                                    <div class="meta-value">{{ $team->founded_year }}</div>
                                </div>
                            </div>
                        @endif

                        <div class="meta-item">
                            <div class="meta-icon">👥</div>
                            <div class="meta-content">
                                <div class="meta-label">Jugadores</div>
                                <div class="meta-value">{{ $team->players->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="team-actions">
                <a href="{{ route('coach.team.edit') }}" class="btn-edit">
                    <span>✏️</span>
                    <span>Editar Equipo</span>
                </a>
            </div>
        </div>

        <!-- Description -->
        @if($team->description)
            <div class="team-description">
                <h2>Acerca del Equipo</h2>
                <p>{{ $team->description }}</p>
            </div>
        @endif

        <!-- Stats -->
        <div class="stats-section">
            <h2>Estadísticas del Equipo</h2>
            <div class="stats-grid">
                <div class="stat-box">
                    <div class="stat-icon">👥</div>
                    <div class="stat-label">Total Jugadores</div>
                    <div class="stat-value">{{ $team->players->count() }}</div>
                </div>

                <div class="stat-box">
                    <div class="stat-icon">✓</div>
                    <div class="stat-label">Jugadores Activos</div>
                    <div class="stat-value">{{ $team->players->where('is_active', true)->count() }}</div>
                </div>

                <div class="stat-box">
                    <div class="stat-icon">⚡</div>
                    <div class="stat-label">Ofensivos</div>
                    <div class="stat-value">{{ $team->players->whereIn('position', ['QB', 'RB', 'WR', 'TE', 'OL'])->count() }}</div>
                </div>

                <div class="stat-box">
                    <div class="stat-icon">🛡️</div>
                    <div class="stat-label">Defensivos</div>
                    <div class="stat-value">{{ $team->players->whereIn('position', ['DL', 'LB', 'CB', 'S'])->count() }}</div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="quick-links">
            <h2>Acciones Rápidas</h2>
            <div class="links-grid">
                <a href="{{ route('coach.players.index') }}" class="link-card">
                    <span class="link-icon">👥</span>
                    <span>Ver Jugadores</span>
                </a>

                <a href="{{ route('coach.players.create') }}" class="link-card">
                    <span class="link-icon">➕</span>
                    <span>Agregar Jugador</span>
                </a>

                <a href="{{ route('coach.plays.index') }}" class="link-card">
                    <span class="link-icon">📋</span>
                    <span>Ver Jugadas</span>
                </a>

                <a href="{{ route('coach.team.edit') }}" class="link-card">
                    <span class="link-icon">⚙️</span>
                    <span>Configuración</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>