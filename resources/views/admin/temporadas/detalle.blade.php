<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Temporada - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ff6b35;
            --secondary: #1a472a;
            --success: #10b981;
            --info: #3b82f6;
            --warning: #f59e0b;
            --gray-100: #f5f5f5;
            --gray-600: #757575;
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

        .header-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .season-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            color: var(--secondary);
            letter-spacing: 2px;
        }

        .season-badge {
            background: var(--success);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .stat-card {
            background: var(--gray-100);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
        }

        .stat-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 36px;
            color: var(--primary);
        }

        .stat-label {
            font-size: 12px;
            color: var(--gray-600);
            text-transform: uppercase;
            font-weight: 600;
            margin-top: 5px;
        }

        .action-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 16px;
            padding: 40px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .action-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }

        .action-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--secondary);
            margin-bottom: 10px;
        }

        .action-desc {
            color: var(--gray-600);
            font-size: 16px;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn {
            padding: 14px 30px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #d94a1a);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--secondary);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e5e5e5;
            border-radius: 8px;
            font-size: 14px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            background: var(--gray-100);
            border-radius: 8px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 2px solid var(--success);
            color: #047857;
        }

        .jornadas-list {
            display: grid;
            gap: 15px;
            margin-top: 20px;
        }

        .jornada-item {
            background: var(--gray-100);
            padding: 20px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .jornada-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .jornada-number {
            background: var(--info);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
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
                <a href="{{ route('admin.seasons.index') }}">Temporadas</a>
                <span>→</span>
                <span>{{ $season->name }}</span>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <!-- Header -->
            <div class="header-card">
                <div class="header-top">
                    <div>
                        <h1 class="season-title">{{ $season->name }}</h1>
                        <p style="color: var(--gray-600); margin-top: 5px;">
                            {{ $season->league->name }} • 
                            {{ \Carbon\Carbon::parse($season->start_date)->format('d/m/Y') }} - 
                            {{ \Carbon\Carbon::parse($season->end_date)->format('d/m/Y') }}
                        </p>
                    </div>
                    @if($season->is_active)
                        <span class="season-badge">ACTIVA</span>
                    @endif
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value">{{ $season->league->teams->count() }}</div>
                        <div class="stat-label">Equipos</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $totalRounds ?? $season->jornadas->count() }}</div>
                        <div class="stat-label">Jornadas</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $totalGames ?? $season->games->count() }}</div>
                        <div class="stat-label">Partidos</div>
                    </div>
                </div>
            </div>

            <!-- Generar Calendario -->
            @if($season->jornadas->count() === 0)
                <div class="action-card">
                    <div class="action-icon">🗓️</div>
                    <h2 class="action-title">Iniciar Torneo</h2>
                    <p class="action-desc">
                        Genera automáticamente el calendario completo con el algoritmo Round-Robin. 
                        Todos los equipos jugarán entre sí de manera balanceada.
                    </p>

                    <form action="{{ route('admin.seasons.generate-calendar', $season->id) }}" method="POST" style="max-width: 500px; margin: 0 auto;">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">Fecha de inicio de jornadas</label>
                            <input type="date" name="start_date" class="form-control" value="{{ $season->start_date }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Días entre jornadas</label>
                            <input type="number" name="days_between_rounds" class="form-control" value="7" min="1" max="30" required>
                        </div>

                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" name="round_trip" id="round_trip" value="1" checked>
                                <label for="round_trip">Incluir vuelta (todos contra todos ida y vuelta)</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            🚀 Generar Calendario
                        </button>
                    </form>
                </div>
            @else
                <div class="action-card">
                    <div class="action-icon">✅</div>
                    <h2 class="action-title">Torneo Iniciado</h2>
                    <p class="action-desc">
                        El calendario ya está generado con {{ $season->jornadas->count() }} jornadas 
                        y {{ $season->games->count() }} partidos programados.
                    </p>

                    <div style="display: flex; gap: 15px; justify-content: center; margin-top: 20px;">
                        <a href="{{ route('admin.jornadas.index', ['season_id' => $season->id]) }}" class="btn btn-success">
                            📅 Ver Jornadas
                        </a>
                        <a href="{{ route('admin.games.index', ['season_id' => $season->id]) }}" class="btn btn-success">
                            ⚽ Ver Partidos
                        </a>
                    </div>

                    <!-- Lista resumida de jornadas -->
                    @if($season->jornadas->count() > 0)
                        <div class="jornadas-list" style="margin-top: 40px;">
                            @foreach($season->jornadas->take(5) as $jornada)
                                <div class="jornada-item">
                                    <div class="jornada-info">
                                        <div class="jornada-number">#{{ $jornada->number }}</div>
                                        <div>
                                            <strong>{{ $jornada->name }}</strong>
                                            <p style="font-size: 14px; color: var(--gray-600); margin-top: 3px;">
                                                {{ \Carbon\Carbon::parse($jornada->date)->format('d/m/Y') }} • 
                                                {{ $jornada->games->count() }} partidos
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            @if($season->jornadas->count() > 5)
                                <p style="text-align: center; color: var(--gray-600); margin-top: 10px;">
                                    Y {{ $season->jornadas->count() - 5 }} jornadas más...
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</body>
</html>