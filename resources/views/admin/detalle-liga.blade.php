<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Liga - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ff6b35;
            --secondary: #1a472a;
            --success: #10b981;
            --info: #3b82f6;
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

        .header-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .league-logo-big {
            width: 100px;
            height: 100px;
            border-radius: 16px;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            font-weight: 900;
            color: white;
        }

        .league-info h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            color: var(--secondary);
            letter-spacing: 2px;
        }

        .stats-row {
            display: flex;
            gap: 30px;
            margin-top: 15px;
        }

        .stat-item strong {
            color: var(--primary);
            font-size: 24px;
        }

        .section-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--secondary);
            margin-bottom: 20px;
        }

        .season-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .season-card {
            background: var(--gray-100);
            border-radius: 12px;
            padding: 20px;
            border: 2px solid transparent;
            transition: all 0.3s;
        }

        .season-card.active {
            border-color: var(--success);
            background: rgba(16, 185, 129, 0.1);
        }

        .season-name {
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .season-meta {
            display: flex;
            gap: 15px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }
    </style>
</head>
<body>
    @include('components.admin-sidebar')

    <div class="main-content">
        <div class="container">
            <!-- Header con info de la liga -->
            <div class="header-card">
                <div class="league-logo-big">
                    @if($league->logo)
                        <img src="{{ asset('storage/' . $league->logo) }}" alt="{{ $league->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 16px;">
                    @else
                        🏈
                    @endif
                </div>
                <div class="league-info">
                    <h1>{{ $league->name }}</h1>
                    <p style="color: var(--gray-600); margin-top: 5px;">
                        {{ $league->city }}, {{ $league->country }}
                    </p>
                    <div class="stats-row">
                        <div class="stat-item">
                            <strong>{{ $league->teams_count }}</strong> Equipos
                        </div>
                        <div class="stat-item">
                            <strong>{{ $league->seasons_count }}</strong> Temporadas
                        </div>
                    </div>
                </div>
            </div>

            <!-- Temporadas -->
            <div class="section-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2 class="section-title">📅 Temporadas</h2>
                    <a href="{{ route('admin.seasons.create', ['league_id' => $league->id]) }}" class="btn btn-primary">
                        ➕ Nueva Temporada
                    </a>
                </div>

                @if($league->seasons->count() > 0)
                    <div class="season-grid">
                        @foreach($league->seasons as $season)
                            <div class="season-card {{ $season->is_active ? 'active' : '' }}">
                                <div class="season-name">
                                    {{ $season->name }}
                                    @if($season->is_active)
                                        <span style="background: var(--success); color: white; padding: 2px 8px; border-radius: 4px; font-size: 12px; margin-left: 8px;">ACTIVA</span>
                                    @endif
                                </div>
                                <p style="color: var(--gray-600); font-size: 14px;">
                                    {{ \Carbon\Carbon::parse($season->start_date)->format('d/m/Y') }} - 
                                    {{ \Carbon\Carbon::parse($season->end_date)->format('d/m/Y') }}
                                </p>
                                <div class="season-meta">
                                    <span><strong>{{ $season->jornadas->count() }}</strong> Jornadas</span>
                                    <span><strong>{{ $season->games->count() }}</strong> Partidos</span>
                                </div>
                                <div style="margin-top: 15px; display: flex; gap: 10px;">
                                    <a href="{{ route('admin.seasons.show', $season->id) }}" class="btn" style="background: var(--info); color: white;">
                                        👁️ Ver
                                    </a>
                                    <a href="{{ route('admin.seasons.edit', $season->id) }}" class="btn" style="background: var(--gray-600); color: white;">
                                        ✏️ Editar
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 40px; color: var(--gray-600);">
                        <p style="font-size: 48px; margin-bottom: 10px;">📅</p>
                        <p>No hay temporadas creadas</p>
                        <a href="{{ route('admin.seasons.create', ['league_id' => $league->id]) }}" class="btn btn-primary" style="margin-top: 15px;">
                            ➕ Crear Primera Temporada
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>