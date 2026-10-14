<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Jornadas - Admin</title>
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
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
        }

        .filters {
            background: rgba(255, 255, 255, 0.97);
            padding: 20px 30px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .filter-row {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .filter-group {
            flex: 1;
        }

        .filter-label {
            display: block;
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 8px;
            font-size: 13px;
        }

        .filter-select {
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #e5e5e5;
            border-radius: 8px;
            font-size: 14px;
        }

        .jornadas-list {
            display: grid;
            gap: 20px;
        }

        .jornada-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .jornada-info {
            flex: 1;
        }

        .jornada-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        .jornada-number {
            background: linear-gradient(135deg, var(--info), #2563eb);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            font-weight: 900;
        }

        .jornada-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            color: var(--secondary);
            letter-spacing: 1px;
        }

        .jornada-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            color: var(--gray-600);
        }

        .meta-item strong { color: var(--secondary); }

        .jornada-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-completed {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .badge-pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .jornada-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
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

        .btn-view {
            background: var(--info);
            color: white;
        }

        .btn-view:hover { background: #2563eb; }

        .btn-edit {
            background: var(--warning);
            color: white;
        }

        .btn-edit:hover { background: #d97706; }

        .btn-delete {
            background: var(--error);
            color: white;
        }

        .btn-delete:hover { background: #dc2626; }

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

        .empty-state p {
            color: var(--gray-600);
            font-size: 16px;
            margin-bottom: 25px;
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
            .jornada-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .jornada-actions {
                width: 100%;
            }

            .btn {
                flex: 1;
                justify-content: center;
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
                <span>Jornadas</span>
            </div>

            <div class="page-header">
                <h1 class="page-title">📅 Gestión de Jornadas</h1>
                <a href="{{ route('admin.jornadas.create') }}" class="btn-add">
                    ➕ Nueva Jornada
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
                <form method="GET" action="{{ route('admin.jornadas.index') }}">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label class="filter-label">Filtrar por Temporada:</label>
                            <select name="season_id" class="filter-select" onchange="this.form.submit()">
                                <option value="">Todas las temporadas</option>
                                @foreach($seasons as $season)
                                    <option value="{{ $season->id }}" {{ request('season_id') == $season->id ? 'selected' : '' }}>
                                        {{ $season->name }} - {{ $season->league->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Lista de Jornadas -->
            @if($jornadas->count() > 0)
                <div class="jornadas-list">
                    @foreach($jornadas as $jornada)
                        <div class="jornada-card">
                            <div class="jornada-info">
                                <div class="jornada-header">
                                    <div class="jornada-number">#{{ $jornada->number }}</div>
                                    <div>
                                        <h3 class="jornada-title">{{ $jornada->name }}</h3>
                                        @if($jornada->is_completed)
                                            <span class="jornada-badge badge-completed">
                                                ✓ Completada
                                            </span>
                                        @else
                                            <span class="jornada-badge badge-pending">
                                                ⏳ Pendiente
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="jornada-meta">
                                    <div class="meta-item">
                                        <span>🏆</span>
                                        <span><strong>{{ $jornada->season->name }}</strong></span>
                                    </div>
                                    <div class="meta-item">
                                        <span>🏈</span>
                                        <span><strong>{{ $jornada->season->league->name }}</strong></span>
                                    </div>
                                    <div class="meta-item">
                                        <span>📅</span>
                                        <span>{{ \Carbon\Carbon::parse($jornada->date)->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <span>⚽</span>
                                        <span><strong>{{ $jornada->games_count }}</strong> partido(s)</span>
                                    </div>
                                </div>
                            </div>

                            <div class="jornada-actions">
                                <a href="{{ route('admin.games.index', ['jornada_id' => $jornada->id]) }}" class="btn btn-view">
                                    👁️ Ver Partidos
                                </a>
                                <a href="{{ route('admin.jornadas.edit', $jornada->id) }}" class="btn btn-edit">
                                    ✏️ Editar
                                </a>
                                <form action="{{ route('admin.jornadas.destroy', $jornada->id) }}" 
                                      method="POST" 
                                      style="display: inline;"
                                      onsubmit="return confirm('¿Eliminar jornada {{ $jornada->name }}? Esto eliminará todos sus partidos.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">📅</div>
                    <h3>No hay jornadas registradas</h3>
                    <p>
                        @if(request('season_id'))
                            No hay jornadas para la temporada seleccionada
                        @else
                            Comienza creando tu primera jornada
                        @endif
                    </p>
                    <a href="{{ route('admin.jornadas.create') }}" class="btn-add">
                        ➕ Crear Primera Jornada
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>