<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Flag Football</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ff6b35;
            --primary-dark: #d94a1a;
            --secondary: #1a472a;
            --secondary-light: #2d5a3d;
            --accent: #ffd700;
            --bg-dark: #0a1f14;
            --text-light: #ffffff;
            --text-dark: #111827;
            --gray-100: #f9fafb;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
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
            font-family: 'DM Sans', sans-serif;
            background: #0d1f15;
            min-height: 100vh;
            color: var(--text-dark);
        }

        /* ─── Layout ─── */
        .main-content {
            margin-left: 280px;
            padding: 32px 36px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 968px) {
            .main-content { margin-left: 0; padding: 20px 16px; }
        }

        /* ─── Page Header ─── */
        .page-header {
            background: linear-gradient(135deg, #1a472a 0%, #0a1f14 100%);
            border-radius: 20px;
            padding: 40px 44px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.06);
        }

        .page-header::before {
            content: '🏈';
            position: absolute;
            right: 40px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 130px;
            opacity: 0.07;
            pointer-events: none;
        }

        .page-header::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 20px 20px 0 0;
        }

        .page-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 52px;
            color: #fff;
            letter-spacing: 3px;
            margin-bottom: 8px;
            line-height: 1;
        }

        .page-header p {
            color: rgba(255,255,255,0.55);
            font-size: 16px;
            font-weight: 500;
        }

        .welcome-name {
            color: var(--primary);
            font-weight: 700;
        }

        /* ─── Stats Grid ─── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        @media (max-width: 900px) { .stats-grid { grid-template-columns: 1fr; } }

        .stat-card {
            background: #fff;
            border-radius: 18px;
            padding: 28px 30px;
            position: relative;
            overflow: hidden;
            border: 1px solid var(--gray-200);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
        }

        .stat-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(255,107,53,0.12), rgba(255,107,53,0.04));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
        }

        .stat-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 58px;
            color: var(--text-dark);
            letter-spacing: 2px;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 12px;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-weight: 600;
        }

        .stat-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(16,185,129,0.1);
            color: var(--success);
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            margin-top: 10px;
        }

        /* ─── Quick Actions ─── */
        .quick-actions {
            background: #fff;
            border-radius: 18px;
            padding: 32px 36px;
            margin-bottom: 28px;
            border: 1px solid var(--gray-200);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .section-header h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--secondary);
            letter-spacing: 2px;
        }

        .section-divider {
            flex: 1;
            height: 2px;
            background: linear-gradient(90deg, var(--primary), transparent);
            border-radius: 2px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        @media (max-width: 900px) { .actions-grid { grid-template-columns: 1fr; } }
        @media (min-width: 901px) and (max-width: 1200px) { .actions-grid { grid-template-columns: repeat(2, 1fr); } }

        .action-card {
            background: var(--gray-100);
            border-radius: 14px;
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.25s ease;
            text-decoration: none;
            color: var(--text-dark);
            border: 1.5px solid transparent;
        }

        .action-card:hover {
            background: #fff;
            border-color: var(--primary);
            transform: translateX(4px);
            box-shadow: 0 6px 20px rgba(255,107,53,0.15);
        }

        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .action-content h3 {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 3px;
            color: var(--text-dark);
        }

        .action-content p {
            font-size: 12px;
            color: var(--gray-500);
        }

        /* ─── Info Cards ─── */
        .info-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        @media (max-width: 900px) { .info-cards { grid-template-columns: 1fr; } }
        @media (min-width: 901px) and (max-width: 1200px) { .info-cards { grid-template-columns: repeat(2, 1fr); } }

        .info-card {
            background: #fff;
            border-radius: 18px;
            padding: 28px 30px;
            border: 1px solid var(--gray-200);
            transition: box-shadow 0.25s ease;
        }

        .info-card:hover {
            box-shadow: 0 12px 36px rgba(0,0,0,0.08);
        }

        .info-card h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            color: var(--secondary);
            margin-bottom: 12px;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 2px solid var(--gray-100);
            padding-bottom: 12px;
        }

        .info-card p {
            color: var(--gray-500);
            line-height: 1.6;
            margin-bottom: 14px;
            font-size: 14px;
        }

        .info-card ul {
            list-style: none;
            padding: 0;
        }

        .info-card li {
            padding: 9px 0;
            border-bottom: 1px solid var(--gray-100);
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--gray-600);
            font-size: 13.5px;
            font-weight: 500;
        }

        .info-card li:last-child { border-bottom: none; }

        .info-card li::before {
            content: '✓';
            width: 20px;
            height: 20px;
            background: rgba(16,185,129,0.1);
            color: var(--success);
            font-weight: 700;
            font-size: 11px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
    </style>
</head>
<body>
    @include('components.admin-sidebar')

    <div class="main-content">

        {{-- Page Header --}}
        <div class="page-header">
            <h1>Panel de Administración</h1>
            <p>Bienvenido, <span class="welcome-name">{{ Auth::user()->name }}</span></p>
        </div>

        {{-- Stats Grid --}}
        <div class="stats-grid">

            <div class="stat-card">
                <div class="stat-top">
                    <div>
                        <div class="stat-value">{{ $stats['leagues'] }}</div>
                        <div class="stat-label">Ligas Totales</div>
                    </div>
                    <div class="stat-icon">🏆</div>
                </div>
                <div class="stat-badge">
                    <span>✓</span>
                    <span>{{ $stats['active_leagues'] }} activas</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <div>
                        <div class="stat-value">{{ $stats['teams'] }}</div>
                        <div class="stat-label">Equipos Totales</div>
                    </div>
                    <div class="stat-icon">🏢</div>
                </div>
                <div class="stat-badge">
                    <span>✓</span>
                    <span>{{ $stats['active_teams'] }} activos</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <div>
                        <div class="stat-value">{{ $stats['players'] }}</div>
                        <div class="stat-label">Jugadores Totales</div>
                    </div>
                    <div class="stat-icon">👥</div>
                </div>
                <div class="stat-badge">
                    <span>✓</span>
                    <span>En todas las ligas</span>
                </div>
            </div>

        </div>

        {{-- Quick Actions --}}
        <div class="quick-actions">
            <div class="section-header">
                <h2>Acciones Rápidas</h2>
                <div class="section-divider"></div>
            </div>
            <div class="actions-grid">

                <a href="{{ route('admin.leagues.create') }}" class="action-card">
                    <div class="action-icon">🏆</div>
                    <div class="action-content">
                        <h3>Crear Liga</h3>
                        <p>Registra una nueva liga</p>
                    </div>
                </a>

                <a href="{{ route('admin.teams.create') }}" class="action-card">
                    <div class="action-icon">➕</div>
                    <div class="action-content">
                        <h3>Crear Equipo</h3>
                        <p>Agrega un nuevo equipo</p>
                    </div>
                </a>

                <a href="{{ route('admin.players.create') }}" class="action-card">
                    <div class="action-icon">👤</div>
                    <div class="action-content">
                        <h3>Crear Jugador</h3>
                        <p>Registra un nuevo jugador</p>
                    </div>
                </a>

                <a href="{{ route('admin.leagues.index') }}" class="action-card">
                    <div class="action-icon">📋</div>
                    <div class="action-content">
                        <h3>Ver Ligas</h3>
                        <p>Gestiona todas las ligas</p>
                    </div>
                </a>

                <a href="{{ route('admin.teams.index') }}" class="action-card">
                    <div class="action-icon">🏢</div>
                    <div class="action-content">
                        <h3>Ver Equipos</h3>
                        <p>Administra los equipos</p>
                    </div>
                </a>

                <a href="{{ route('admin.players.index') }}" class="action-card">
                    <div class="action-icon">👥</div>
                    <div class="action-content">
                        <h3>Ver Jugadores</h3>
                        <p>Lista de todos los jugadores</p>
                    </div>
                </a>

            </div>
        </div>

        {{-- Info Cards --}}
        <div class="info-cards">

            <div class="info-card">
                <h3>📊 Sistema Multi-Liga</h3>
                <p>Gestiona múltiples ligas desde un solo panel:</p>
                <ul>
                    <li>Crea y administra ligas independientes</li>
                    <li>Cada liga con sus propios equipos</li>
                    <li>Temporadas y standings por liga</li>
                    <li>Control total desde el panel admin</li>
                </ul>
            </div>

            <div class="info-card">
                <h3>⚙️ Funcionalidades</h3>
                <p>Todo lo que puedes hacer:</p>
                <ul>
                    <li>Gestión completa de ligas</li>
                    <li>Administrar equipos por liga</li>
                    <li>Registro de jugadores</li>
                    <li>Filtros por liga en todas las vistas</li>
                </ul>
            </div>

            <div class="info-card">
                <h3>🔑 Tu Rol</h3>
                <p>Como administrador tienes acceso a:</p>
                <ul>
                    <li>Crear y editar todas las ligas</li>
                    <li>Gestionar equipos de cualquier liga</li>
                    <li>Administrar todos los jugadores</li>
                    <li>Acceso completo al sistema</li>
                </ul>
            </div>

        </div>

    </div>
</body>
</html>