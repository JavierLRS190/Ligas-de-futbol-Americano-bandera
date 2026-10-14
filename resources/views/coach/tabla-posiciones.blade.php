<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clasificación - Coach</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ff6b35;
            --secondary: #1a472a;
            --success: #10b981;
            --gold: #fbbf24;
            --gray-100: #f5f5f5;
            --gray-600: #757575;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--secondary) 0%, #0a1f14 100%);
            min-height: 100vh;
        }
        .main-content { margin-left: 280px; padding: 40px 30px; }
        .container { max-width: 1400px; margin: 0 auto; }
        .page-header {
            background: rgba(255, 255, 255, 0.97);
            padding: 30px 40px;
            border-radius: 16px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        .page-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            color: var(--secondary);
        }
        .standings-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            overflow-x: auto;
        }
        .standings-table {
            width: 100%;
            border-collapse: collapse;
        }
        .standings-table th {
            padding: 12px 10px;
            text-align: center;
            font-size: 12px;
            font-weight: 700;
            color: var(--gray-600);
            text-transform: uppercase;
        }
        .standings-table tbody tr.my-team {
            background: rgba(255, 107, 53, 0.08);
            border-left: 4px solid var(--primary);
        }
        .position {
            display: inline-flex;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            font-weight: 900;
        }
        .position.gold { background: linear-gradient(135deg, var(--gold), #f59e0b); color: white; }
        .team-badge {
            padding: 3px 8px;
            background: var(--primary);
            color: white;
            border-radius: 100px;
            font-size: 10px;
            font-weight: 700;
        }
        .points {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            font-weight: 900;
            color: var(--primary);
        }
    </style>
</head>
<body>
    @include('components.coach-sidebar')
    <div class="main-content">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">🏆 Clasificación</h1>
                <p>Tabla de posiciones de {{ $league->name }}</p>
            </div>
            <div class="standings-card">
                <h2>{{ $season->name }}</h2>
                @if($standings->count() > 0)
                    <table class="standings-table">
                        <thead>
                            <tr>
                                <th>#</th><th>Equipo</th><th>PJ</th><th>PG</th><th>PE</th><th>PP</th>
                                <th>GF</th><th>GC</th><th>DIF</th><th>PTS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($standings as $index => $standing)
                                <tr class="{{ $standing->team_id == auth()->user()->team_id ? 'my-team' : '' }}">
                                    <td><span class="position {{ $index === 0 ? 'gold' : '' }}">{{ $index + 1 }}</span></td>
                                    <td>{{ $standing->team->name }}
                                        @if($standing->team_id == auth()->user()->team_id)
                                            <span class="team-badge">TU EQUIPO</span>
                                        @endif
                                    </td>
                                    <td>{{ $standing->played }}</td>
                                    <td>{{ $standing->wins }}</td>
                                    <td>{{ $standing->ties }}</td>
                                    <td>{{ $standing->losses }}</td>
                                    <td>{{ $standing->goals_for }}</td>
                                    <td>{{ $standing->goals_against }}</td>
                                    <td>{{ $standing->goal_difference > 0 ? '+' : '' }}{{ $standing->goal_difference }}</td>
                                    <td><span class="points">{{ $standing->points }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No hay clasificación disponible</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>