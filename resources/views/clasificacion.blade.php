<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clasificación - Flag Football</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ff6b35;
            --primary-dark: #d94a1a;
            --secondary: #1a472a;
            --bg-dark: #0f1419;
            --text-light: #ffffff;
            --text-gray: #9ca3af;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            color: var(--text-light);
            min-height: 100vh;
        }

        /* Header/Navbar */
        .navbar {
            background: rgba(15, 20, 25, 0.95);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .logo-icon {
            background: var(--primary);
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 24px;
        }

        .logo-text {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            color: var(--text-light);
            letter-spacing: 2px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }

        .nav-links a {
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: color 0.3s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--text-light);
        }

        .btn-login {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--text-light);
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background: var(--primary);
        }

        /* Hero Section */
        .hero {
            padding: 60px 30px 40px;
            text-align: center;
            background: linear-gradient(180deg, rgba(255, 107, 53, 0.1) 0%, transparent 100%);
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 107, 53, 0.2);
            border: 1px solid var(--primary);
            color: var(--primary);
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .hero-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 72px;
            letter-spacing: 4px;
            margin-bottom: 15px;
            background: linear-gradient(180deg, #fff 0%, #999 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 18px;
            color: var(--text-gray);
            max-width: 700px;
            margin: 0 auto;
        }

        /* Main Content */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 30px 80px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            letter-spacing: 2px;
            color: var(--text-light);
        }

        .season-badge {
            background: rgba(255, 107, 53, 0.2);
            border: 1px solid var(--primary);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
        }

        /* Tabla de Posiciones */
        .standings-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 40px;
        }

        .standings-card-header {
            padding: 20px 30px;
            background: rgba(255, 107, 53, 0.1);
            border-bottom: 1px solid rgba(255, 107, 53, 0.3);
        }

        .league-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            letter-spacing: 2px;
            color: var(--text-light);
        }

        .standings-table {
            width: 100%;
            border-collapse: collapse;
        }

        .standings-table thead {
            background: rgba(255, 255, 255, 0.05);
        }

        .standings-table th {
            padding: 15px 20px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-gray);
        }

        .standings-table th.center {
            text-align: center;
        }

        .standings-table tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: background 0.3s;
        }

        .standings-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .standings-table td {
            padding: 20px;
            font-size: 14px;
        }

        .standings-table td.center {
            text-align: center;
        }

        .position-cell {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            color: var(--text-gray);
            width: 60px;
        }

        .position-cell.top {
            color: var(--primary);
        }

        .team-cell {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .team-logo {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .team-name {
            font-weight: 700;
            color: var(--text-light);
        }

        .points-cell {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--primary);
            font-weight: 900;
        }

        .form-cell {
            display: flex;
            gap: 4px;
            justify-content: center;
        }

        .form-badge {
            width: 24px;
            height: 24px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
        }

        .form-badge.W {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .form-badge.L {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .form-badge.D {
            background: rgba(156, 163, 175, 0.2);
            color: #9ca3af;
        }

        .empty-state {
            padding: 80px 40px;
            text-align: center;
        }

        .empty-icon {
            font-size: 80px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: var(--text-gray);
            font-size: 16px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links { display: none; }
            
            .hero-title { font-size: 48px; }
            
            .standings-table { font-size: 12px; }
            
            .standings-table th,
            .standings-table td { padding: 12px 10px; }
            
            .team-logo { width: 30px; height: 30px; }
            
            .form-cell { display: none; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <div class="logo-icon">🏈</div>
                <span class="logo-text">Flag Football</span>
            </a>
            
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Ligas</a></li>
                <li><a href="{{ route('teams.index') }}">Equipos</a></li>
                <li><a href="{{ route('games.index') }}">Calendario</a></li>
                <li><a href="{{ route('standings') }}" class="active">Clasificación</a></li>
            </ul>
            
            <a href="{{ route('login') }}" class="btn-login">Iniciar Sesión →</a>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-badge">• TEMPORADA 2026 EN CURSO</div>
        <h1 class="hero-title">CLASIFICACIÓN</h1>
        <p class="hero-subtitle">
            Sigue en tiempo real los resultados, equipos y clasificaciones de todas las ligas.
        </p>
    </section>

    <!-- Contenido Principal -->
    <main class="container">
        @foreach($leagues as $league)
            @php
                $activeSeason = $league->seasons->where('is_active', true)->first() 
                    ?? $league->seasons->sortByDesc('created_at')->first();
                $standings = $activeSeason ? $activeSeason->standings : collect();
            @endphp

            <div class="standings-card">
                <div class="standings-card-header">
                    <div class="section-header">
                        <h2 class="league-name">{{ $league->name }}</h2>
                        @if($activeSeason)
                            <span class="season-badge">{{ $activeSeason->name }}</span>
                        @endif
                    </div>
                </div>

                @if($standings->count() > 0)
                    <table class="standings-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Equipo</th>
                                <th class="center">PJ</th>
                                <th class="center">G</th>
                                <th class="center">E</th>
                                <th class="center">P</th>
                                <th class="center">GF</th>
                                <th class="center">GC</th>
                                <th class="center">DIF</th>
                                <th class="center">Forma</th>
                                <th class="center">PTS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($standings as $index => $standing)
                                <tr>
                                    <td class="position-cell {{ $index < 4 ? 'top' : '' }}">
                                        {{ $index + 1 }}
                                    </td>
                                    <td>
                                        <div class="team-cell">
                                            <div class="team-logo">
                                                @if($standing->team->logo)
                                                    <img src="{{ asset('storage/' . $standing->team->logo) }}" 
                                                         alt="{{ $standing->team->name }}"
                                                         style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                                                @else
                                                    🏈
                                                @endif
                                            </div>
                                            <span class="team-name">{{ $standing->team->name }}</span>
                                        </div>
                                    </td>
                                    <td class="center">{{ $standing->played }}</td>
                                    <td class="center">{{ $standing->wins }}</td>
                                    <td class="center">{{ $standing->ties }}</td>
                                    <td class="center">{{ $standing->losses }}</td>
                                    <td class="center">{{ $standing->goals_for }}</td>
                                    <td class="center">{{ $standing->goals_against }}</td>
                                    <td class="center">{{ $standing->goal_difference > 0 ? '+' : '' }}{{ $standing->goal_difference }}</td>
                                    <td>
                                        <div class="form-cell">
                                            @if($standing->form)
                                                @foreach(str_split(substr($standing->form, -5)) as $result)
                                                    <span class="form-badge {{ $result }}">{{ $result }}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </td>
                                    <td class="center points-cell">{{ $standing->points }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">📊</div>
                        <h3>Sin clasificación disponible</h3>
                        <p>Aún no hay partidos jugados en esta temporada</p>
                    </div>
                @endif
            </div>
        @endforeach

        @if($leagues->count() === 0)
            <div class="standings-card">
                <div class="empty-state">
                    <div class="empty-icon">🏈</div>
                    <h3>No hay ligas disponibles</h3>
                    <p>Vuelve pronto para ver las clasificaciones</p>
                </div>
            </div>
        @endif
    </main>
</body>
</html>