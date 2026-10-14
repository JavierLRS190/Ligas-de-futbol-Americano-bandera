<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Partidos - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ff6b35;
            --secondary: #1a472a;
            --gray-100: #f5f5f5;
            --gray-600: #757575;
            --success: #10b981;
            --error: #ef4444;
            --info: #3b82f6;
            --warning: #f59e0b;
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
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 968px) {
            .main-content { margin-left: 0; padding: 20px 15px; }
        }

        .container { max-width: 1400px; margin: 0 auto; }

        .breadcrumb {
            background: rgba(255, 255, 255, 0.97);
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .breadcrumb a { color: var(--primary); text-decoration: none; font-weight: 600; }
        .breadcrumb span { color: var(--gray-600); }

        .page-header {
            background: rgba(255, 255, 255, 0.97);
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .page-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            color: var(--secondary);
            letter-spacing: 2px;
        }

        .btn-add {
            background: linear-gradient(135deg, var(--primary), #d94a1a);
            color: white;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .filters {
            background: rgba(255, 255, 255, 0.97);
            padding: 20px 30px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .filter-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-label {
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 8px;
            font-size: 13px;
        }

        .filter-select {
            padding: 10px 15px;
            border: 2px solid #e5e5e5;
            border-radius: 8px;
            font-size: 14px;
        }

        .games-list {
            display: grid;
            gap: 20px;
        }

        .game-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .game-status {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-scheduled {
            background: rgba(59, 130, 246, 0.1);
            color: var(--info);
        }

        .status-in_progress {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .status-finished {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .game-info {
            margin-bottom: 20px;
        }

        .game-meta {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 15px;
            font-size: 14px;
            color: var(--gray-600);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .teams-container {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 20px;
            align-items: center;
            margin-bottom: 20px;
        }

        .team {
            text-align: center;
        }

        .team.home { text-align: right; }
        .team.away { text-align: left; }

        .team-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            color: var(--secondary);
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .team-score {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            color: var(--primary);
            letter-spacing: 2px;
        }

        .vs-separator {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--gray-600);
            padding: 0 20px;
        }

        .game-actions {
            display: flex;
            gap: 10px;
            padding-top: 20px;
            border-top: 2px solid #e5e5e5;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background: var(--warning);
            color: white;
            flex: 1;
        }

        .btn-delete {
            background: var(--error);
            color: white;
        }

        .empty-state {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 16px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
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
        }

        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 2px solid var(--success);
            color: #047857;
        }

        @media (max-width: 768px) {
            .teams-container {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .team.home, .team.away {
                text-align: center;
            }

            .vs-separator {
                display: none;
            }
        }
    </style>
</head>
<body>
    @include('components.admin-sidebar')

    <div class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>→</span>
                <span>Partidos</span>
            </div>

            <div class="page-header">
                <h1 class="page-title">⚽ Gestión de Partidos</h1>
                <a href="{{ route('admin.games.create') }}" class="btn-add">
                    ➕ Nuevo Partido
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <span>✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Filtros -->
            <div class="filters">
                <form method="GET" action="{{ route('admin.games.index') }}">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label class="filter-label">Temporada:</label>
                            <select name="season_id" class="filter-select" onchange="this.form.submit()">
                                <option value="">Todas</option>
                                @foreach($seasons as $season)
                                    <option value="{{ $season->id }}" {{ request('season_id') == $season->id ? 'selected' : '' }}>
                                        {{ $season->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Estado:</label>
                            <select name="status" class="filter-select" onchange="this.form.submit()">
                                <option value="">Todos</option>
                                <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Programados</option>
                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>En Progreso</option>
                                <option value="finished" {{ request('status') == 'finished' ? 'selected' : '' }}>Finalizados</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Lista de Partidos -->
            @if($games->count() > 0)
                <div class="games-list">
                    @foreach($games as $game)
                        <div class="game-card">
                            <span class="game-status status-{{ $game->status }}">
                                @if($game->status == 'scheduled')
                                    📅 Programado
                                @elseif($game->status == 'in_progress')
                                    ⏱️ En Progreso
                                @else
                                    ✓ Finalizado
                                @endif
                            </span>

                            <div class="game-info">
                                <div class="game-meta">
                                    <div class="meta-item">
                                        <span>🏆</span>
                                        <span><strong>{{ $game->jornada->season->name }}</strong></span>
                                    </div>
                                    <div class="meta-item">
                                        <span>📅</span>
                                        <span><strong>{{ $game->jornada->name }}</strong></span>
                                    </div>
                                    <div class="meta-item">
                                        <span>🕐</span>
                                        <span>{{ \Carbon\Carbon::parse($game->game_datetime)->format('d/m/Y H:i') }}</span>
                                    </div>
                                    @if($game->location)
                                        <div class="meta-item">
                                            <span>📍</span>
                                            <span>{{ $game->location }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="teams-container">
                                <div class="team home">
                                    <div class="team-name">{{ $game->homeTeam->name }}</div>
                                    @if($game->status == 'finished')
                                        <div class="team-score">{{ $game->home_score ?? '-' }}</div>
                                    @endif
                                </div>

                                <div class="vs-separator">VS</div>

                                <div class="team away">
                                    <div class="team-name">{{ $game->awayTeam->name }}</div>
                                    @if($game->status == 'finished')
                                        <div class="team-score">{{ $game->away_score ?? '-' }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="game-actions">
                                <a href="{{ route('admin.games.edit', $game->id) }}" class="btn btn-edit">
                                    ✏️ Editar / Registrar Resultado
                                </a>
                                <form action="{{ route('admin.games.destroy', $game->id) }}" 
                                      method="POST" 
                                      style="display: inline;"
                                      onsubmit="return confirm('¿Eliminar este partido?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div style="margin-top: 30px;">
                    {{ $games->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">⚽</div>
                    <h3>No hay partidos registrados</h3>
                    <p>
                        @if(request('season_id') || request('status'))
                            No hay partidos con los filtros seleccionados
                        @else
                            Comienza creando tu primer partido
                        @endif
                    </p>
                    <a href="{{ route('admin.games.create') }}" class="btn-add">
                        ➕ Crear Primer Partido
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>