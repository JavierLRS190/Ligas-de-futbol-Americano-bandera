<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Jugadores - {{ $team->name }}</title>
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
        }

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
            background: var(--gray-300);
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
            background: var(--gray-600);
            color: white;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 30px;
        }

        .page-header {
            background: rgba(255, 255, 255, 0.97);
            padding: 30px 40px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            color: var(--secondary);
            letter-spacing: 2px;
        }

        .page-subtitle {
            color: var(--gray-600);
            font-size: 16px;
            margin-top: 5px;
        }

        .btn-add {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 14px 30px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
        }

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

        .players-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }

        .player-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
        }

        .player-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
        }

        .player-card-header {
            background: linear-gradient(135deg, var(--info), #2563eb);
            padding: 20px;
            position: relative;
            height: 120px;
            display: flex;
            align-items: flex-end;
        }

        .player-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 5px solid white;
            object-fit: cover;
            position: absolute;
            bottom: -50px;
            left: 20px;
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        }

        .player-photo-placeholder {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 5px solid white;
            background: linear-gradient(135deg, var(--gray-300), var(--gray-600));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            position: absolute;
            bottom: -50px;
            left: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        }

        .player-jersey {
            position: absolute;
            top: 20px;
            right: 20px;
            background: white;
            color: var(--info);
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            font-weight: 900;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .player-card-body {
            padding: 60px 20px 20px 20px;
        }

        .player-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            color: var(--secondary);
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .player-position {
            display: inline-block;
            background: rgba(59, 130, 246, 0.1);
            color: var(--info);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .player-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 15px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .info-label {
            font-size: 11px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .info-value {
            font-size: 14px;
            color: var(--text-dark);
            font-weight: 600;
        }

        .player-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .player-status.active {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .player-status.inactive {
            background: rgba(239, 68, 68, 0.1);
            color: var(--error);
        }

        .player-actions {
            display: flex;
            gap: 10px;
            padding-top: 15px;
            border-top: 2px solid var(--gray-200);
        }

        .btn-edit {
            flex: 1;
            padding: 10px;
            background: var(--warning);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s;
        }

        .btn-edit:hover {
            background: #d97706;
        }

        .btn-delete {
            padding: 10px 15px;
            background: var(--error);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

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
            font-size: 36px;
            color: var(--secondary);
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .empty-state p {
            color: var(--gray-600);
            font-size: 16px;
            margin-bottom: 25px;
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 20px;
            }

            .container {
                padding: 20px 15px;
            }

            .page-header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .page-title {
                font-size: 36px;
            }

            .players-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <div class="logo-icon">👥</div>
                <div class="logo-text">
                    <h1>Mis Jugadores</h1>
                    <p>{{ $team->name }}</p>
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('coach.dashboard') }}" class="btn-back">
                    <span>←</span>
                    <span>Volver al Panel</span>
                </a>
            </div>
        </div>
    </header>

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

        <div class="page-header">
            <div>
                <h1 class="page-title">Mis Jugadores</h1>
                <p class="page-subtitle">{{ $players->count() }} jugador(es) registrado(s)</p>
            </div>
            <a href="{{ route('coach.players.create') }}" class="btn-add">
                <span>➕</span>
                <span>Agregar Jugador</span>
            </a>
        </div>

        @if($players->count() > 0)
            <div class="players-grid">
                @foreach($players as $player)
                    <div class="player-card">
                        <div class="player-card-header">
                            @if($player->photo)
                                <img src="{{ asset('storage/' . $player->photo) }}" alt="{{ $player->name }}" class="player-photo">
                            @else
                                <div class="player-photo-placeholder">
                                    👤
                                </div>
                            @endif
                            <div class="player-jersey">#{{ $player->jersey_number }}</div>
                        </div>

                        <div class="player-card-body">
                            <h3 class="player-name">{{ $player->name }} {{ $player->last_name }}</h3>
                            <span class="player-position">{{ $player->position }}</span>

                            @if($player->is_active)
                                <div class="player-status active">
                                    <span>🟢</span>
                                    <span>Activo</span>
                                </div>
                            @else
                                <div class="player-status inactive">
                                    <span>🔴</span>
                                    <span>Inactivo</span>
                                </div>
                            @endif

                            <div class="player-info">
                                @if($player->birth_date)
                                    <div class="info-item">
                                        <span class="info-label">Edad</span>
                                        <span class="info-value">{{ \Carbon\Carbon::parse($player->birth_date)->age }} años</span>
                                    </div>
                                @endif

                                @if($player->height)
                                    <div class="info-item">
                                        <span class="info-label">Altura</span>
                                        <span class="info-value">{{ $player->height }} cm</span>
                                    </div>
                                @endif

                                @if($player->weight)
                                    <div class="info-item">
                                        <span class="info-label">Peso</span>
                                        <span class="info-value">{{ $player->weight }} kg</span>
                                    </div>
                                @endif

                                <div class="info-item">
                                    <span class="info-label">Posición</span>
                                    <span class="info-value">{{ $player->position }}</span>
                                </div>
                            </div>

                            <div class="player-actions">
                                <a href="{{ route('coach.players.edit', $player->id) }}" class="btn-edit">
                                    ✏️ Editar
                                </a>
                                <form action="{{ route('coach.players.destroy', $player->id) }}" 
                                      method="POST" 
                                      style="display: inline;"
                                      onsubmit="return confirm('¿Estás seguro de eliminar a {{ $player->name }} {{ $player->last_name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">👥</div>
                <h3>No hay jugadores registrados</h3>
                <p>Comienza agregando jugadores a tu equipo</p>
                <a href="{{ route('coach.players.create') }}" class="btn-add">
                    <span>➕</span>
                    <span>Agregar Primer Jugador</span>
                </a>
            </div>
        @endif
    </div>
</body>
</html>