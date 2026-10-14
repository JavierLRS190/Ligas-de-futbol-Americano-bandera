<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ligas - Admin</title>
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
        }

        .main-content {
            margin-left: 280px;
            padding: 40px 30px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 968px) {
            .main-content {
                margin-left: 0;
            }
        }

        /* Page Header */
        .page-header {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 30px 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            border-left: 6px solid var(--primary);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .page-title-section h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            color: var(--secondary);
            letter-spacing: 2px;
            margin-bottom: 8px;
        }

        .page-title-section p {
            color: var(--gray-600);
            font-size: 16px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
            font-size: 14px;
        }

        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .breadcrumb a:hover {
            color: var(--primary-dark);
        }

        .breadcrumb span {
            color: var(--gray-600);
        }

        .btn-primary {
            padding: 15px 30px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
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

        /* Leagues Grid */
        .leagues-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .league-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .league-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
        }

        .league-header {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-light));
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        .league-header::before {
            content: '🏈';
            position: absolute;
            font-size: 120px;
            opacity: 0.1;
            right: -20px;
            top: 50%;
            transform: translateY(-50%) rotate(-15deg);
        }

        .league-logo-wrapper {
            display: flex;
            align-items: center;
            gap: 20px;
            position: relative;
        }

        .league-logo {
            width: 100px;
            height: 100px;
            border-radius: 16px;
            object-fit: cover;
            border: 4px solid white;
            background: white;
            flex-shrink: 0;
        }

        .league-logo-placeholder {
            width: 100px;
            height: 100px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 36px;
            letter-spacing: 2px;
            border: 4px solid white;
            flex-shrink: 0;
        }

        .league-title {
            flex: 1;
        }

        .league-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: white;
            margin-bottom: 5px;
            letter-spacing: 2px;
        }

        .league-short {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .league-body {
            padding: 25px 30px;
        }

        .league-location {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray-600);
            font-size: 14px;
            margin-bottom: 15px;
        }

        .league-location strong {
            color: var(--text-dark);
        }

        .league-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-item {
            background: var(--gray-100);
            padding: 15px;
            border-radius: 10px;
            text-align: center;
        }

        .stat-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--primary);
            letter-spacing: 1px;
        }

        .stat-label {
            font-size: 12px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .league-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
        }

        .league-status.active {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .league-status.inactive {
            background: rgba(107, 114, 128, 0.1);
            color: var(--gray-600);
        }

        .league-actions {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-view {
            background: var(--info);
            color: white;
        }

        .btn-view:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }

        .btn-edit {
            background: var(--warning);
            color: white;
        }

        .btn-edit:hover {
            background: #d97706;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: var(--error);
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
            transform: translateY(-2px);
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

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 20px 15px;
            }

            .page-header {
                padding: 25px 20px;
                flex-direction: column;
                align-items: flex-start;
            }

            .page-title-section h1 {
                font-size: 36px;
            }

            .leagues-grid {
                grid-template-columns: 1fr;
            }

            .league-logo-wrapper {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Include Sidebar -->
    @include('components.admin-sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title-section">
                <h1>Gestión de Ligas</h1>
                <p>Administra todas las ligas del sistema</p>
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <span>→</span>
                    <span>Ligas</span>
                </div>
            </div>
            <a href="{{ route('admin.leagues.create') }}" class="btn-primary">
                <span>➕</span>
                <span>Crear Liga</span>
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Leagues Grid -->
        @if($leagues->count() > 0)
            <div class="leagues-grid">
                @foreach($leagues as $league)
                    <div class="league-card">
                        <!-- League Header -->
                        <div class="league-header">
                            <div class="league-logo-wrapper">
                                @if($league->logo)
                                    <img src="{{ asset('storage/' . $league->logo) }}" alt="{{ $league->name }}" class="league-logo">
                                @else
                                    <div class="league-logo-placeholder">
                                        {{ strtoupper(substr($league->short_name, 0, 3)) }}
                                    </div>
                                @endif
                                <div class="league-title">
                                    <div class="league-name">{{ $league->name }}</div>
                                    <div class="league-short">{{ $league->short_name }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- League Body -->
                        <div class="league-body">
                            @if($league->country || $league->city)
                                <div class="league-location">
                                    <span>📍</span>
                                    @if($league->country && $league->city)
                                        <span><strong>{{ $league->city }}, {{ $league->country }}</strong></span>
                                    @elseif($league->country)
                                        <span><strong>{{ $league->country }}</strong></span>
                                    @else
                                        <span><strong>{{ $league->city }}</strong></span>
                                    @endif
                                </div>
                            @endif

                            <div class="league-stats">
                                <div class="stat-item">
                                    <div class="stat-value">{{ $league->teams_count }}</div>
                                    <div class="stat-label">Equipos</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">{{ $league->seasons_count }}</div>
                                    <div class="stat-label">Temporadas</div>
                                </div>
                            </div>

                            <span class="league-status {{ $league->is_active ? 'active' : 'inactive' }}">
                                {{ $league->is_active ? '✓ Activa' : '✕ Inactiva' }}
                            </span>

                            <div class="league-actions">
                                <a href="{{ route('admin.leagues.show', $league->id) }}" class="btn-action btn-view">
                                    <span>👁️</span>
                                    <span>Ver</span>
                                </a>
                                <a href="{{ route('admin.leagues.edit', $league->id) }}" class="btn-action btn-edit">
                                    <span>✏️</span>
                                    <span>Editar</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">🏈</div>
                <h3>No hay ligas registradas</h3>
                <p>Comienza creando tu primera liga</p>
                <a href="{{ route('admin.leagues.create') }}" class="btn-primary">
                    <span>➕</span>
                    <span>Crear Primera Liga</span>
                </a>
            </div>
        @endif
    </div>
</body>
</html>