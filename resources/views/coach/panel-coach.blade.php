<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Coach - Flag Football</title>
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

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--info), #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 14px;
        }

        .user-role {
            font-size: 12px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-logout {
            padding: 10px 20px;
            background: var(--error);
            color: white;
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

        .btn-logout:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 30px;
            position: relative;
            z-index: 1;
        }

        /* Team Banner */
        .team-banner {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            gap: 30px;
            position: relative;
            overflow: hidden;
        }

        .team-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
        }

        .team-logo-large {
            width: 120px;
            height: 120px;
            border-radius: 20px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 4px solid var(--gray-300);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            flex-shrink: 0;
        }

        .team-logo-large img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-logo-placeholder {
            font-size: 64px;
        }

        .team-info {
            flex: 1;
        }

        .team-info h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            color: var(--secondary);
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .team-subtitle {
            color: var(--gray-600);
            font-size: 16px;
            margin-bottom: 15px;
        }

        .team-meta {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
        }

        .team-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray-600);
            font-size: 14px;
        }

        .team-meta-item span:first-child {
            font-size: 18px;
        }

        /* Welcome Section */
        .welcome-section {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 30px 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            border-left: 6px solid var(--info);
        }

        .welcome-section h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--secondary);
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .welcome-section p {
            color: var(--gray-600);
            font-size: 16px;
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

        /* Quick Actions */
        .quick-actions {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }

        .quick-actions h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--secondary);
            margin-bottom: 25px;
            letter-spacing: 1px;
            border-bottom: 3px solid var(--info);
            display: inline-block;
            padding-bottom: 5px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .action-card {
            background: linear-gradient(135deg, var(--gray-100), white);
            border-radius: 15px;
            padding: 25px;
            text-decoration: none;
            color: var(--text-dark);
            transition: all 0.3s ease;
            border: 2px solid transparent;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .action-card:hover {
            transform: translateY(-3px);
            border-color: var(--info);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.2);
        }

        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--info), #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            flex-shrink: 0;
        }

        .action-content h4 {
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .action-content p {
            font-size: 13px;
            color: var(--gray-600);
        }

        /* Navigation Menu */
        .nav-menu {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .nav-menu h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--secondary);
            margin-bottom: 25px;
            letter-spacing: 1px;
            border-bottom: 3px solid var(--info);
            display: inline-block;
            padding-bottom: 5px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .menu-item {
            padding: 20px;
            background: var(--gray-100);
            border-radius: 12px;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            transition: all 0.3s;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .menu-item:hover {
            background: linear-gradient(135deg, var(--info), #2563eb);
            color: white;
            transform: translateY(-2px);
        }

        .menu-item-icon {
            font-size: 32px;
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

        /* Responsive */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 20px;
                padding: 20px;
            }

            .header-actions {
                width: 100%;
                justify-content: space-between;
            }

            .container {
                padding: 20px 15px;
            }

            .team-banner {
                flex-direction: column;
                text-align: center;
                padding: 30px 20px;
            }

            .team-info h2 {
                font-size: 32px;
            }

            .team-meta {
                justify-content: center;
            }

            .stats-grid,
            .actions-grid,
            .menu-grid {
                grid-template-columns: 1fr;
            }

            .quick-actions,
            .nav-menu {
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
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="user-role">Coach</span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <span>🚪</span>
                        <span>Salir</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        @if(session('error'))
            <div class="alert alert-error">
                <span>⚠</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Team Banner -->
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
                <p class="team-subtitle">{{ $team->short_name }}</p>
                <div class="team-meta">
                    @if($team->city)
                        <div class="team-meta-item">
                            <span>📍</span>
                            <span>{{ $team->city }}</span>
                        </div>
                    @endif
                    @if($team->stadium)
                        <div class="team-meta-item">
                            <span>🏟️</span>
                            <span>{{ $team->stadium }}</span>
                        </div>
                    @endif
                    @if($team->founded_year)
                        <div class="team-meta-item">
                            <span>📅</span>
                            <span>Fundado en {{ $team->founded_year }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Welcome Section -->
        <div class="welcome-section">
            <h3>¡Bienvenido, Coach {{ Auth::user()->name }}!</h3>
            <p>Gestiona tu equipo, jugadores y estrategias desde este panel de control</p>
        </div>

        <!-- Stats Grid -->
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
                <div class="stat-label">Jugadas Creadas</div>
                <div class="stat-value">{{ $stats['total_plays'] }}</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h3>Acciones Rápidas</h3>
            <div class="actions-grid">
                <a href="{{ route('coach.players.create') }}" class="action-card">
                    <div class="action-icon">👤</div>
                    <div class="action-content">
                        <h4>Agregar Jugador</h4>
                        <p>Registra un nuevo jugador</p>
                    </div>
                </a>

                <a href="{{ route('coach.plays.create') }}" class="action-card">
                    <div class="action-icon">📝</div>
                    <div class="action-content">
                        <h4>Crear Jugada</h4>
                        <p>Diseña una nueva estrategia</p>
                    </div>
                </a>

                <a href="{{ route('coach.team.edit') }}" class="action-card">
                    <div class="action-icon">⚙️</div>
                    <div class="action-content">
                        <h4>Editar Equipo</h4>
                        <p>Actualiza información del equipo</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="nav-menu">
            <h3>Navegación</h3>
            <div class="menu-grid">
                <a href="{{ route('coach.team.show') }}" class="menu-item">
                    <span class="menu-item-icon">🏆</span>
                    <span>Mi Equipo</span>
                </a>

                <a href="{{ route('coach.players.index') }}" class="menu-item">
                    <span class="menu-item-icon">👥</span>
                    <span>Jugadores</span>
                </a>

                <a href="{{ route('coach.plays.index') }}" class="menu-item">
                    <span class="menu-item-icon">📋</span>
                    <span>Jugadas</span>
                </a>

                <a href="{{ route('coach.stats') }}" class="menu-item">
                    <span class="menu-item-icon">📊</span>
                    <span>Estadísticas</span>
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