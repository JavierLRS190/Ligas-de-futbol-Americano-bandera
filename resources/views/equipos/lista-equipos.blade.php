<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos - Flag Football League</title>
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

        .header-nav {
            display: flex;
            gap: 20px;
        }

        .btn-nav {
            padding: 10px 20px;
            background: var(--gray-200);
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

        .btn-nav:hover {
            background: var(--gray-300);
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 30px;
            position: relative;
            z-index: 1;
        }

        /* Page Header */
        .page-header {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            border-left: 6px solid var(--primary);
            text-align: center;
        }

        .page-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 56px;
            color: var(--secondary);
            letter-spacing: 3px;
            margin-bottom: 10px;
        }

        .page-header p {
            color: var(--gray-600);
            font-size: 18px;
        }

        .team-count {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            padding: 12px 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
        }

        /* Search */
        .search-section {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 25px 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .search-box {
            position: relative;
            max-width: 500px;
            margin: 0 auto;
        }

        .search-input {
            width: 100%;
            padding: 15px 50px 15px 20px;
            border: 2px solid var(--gray-300);
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        .search-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-600);
            font-size: 20px;
        }

        /* Teams Grid */
        .teams-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .team-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--text-dark);
            display: flex;
            flex-direction: column;
            cursor: pointer;
        }

        .team-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        }

        .team-banner {
            height: 140px;
            background: linear-gradient(135deg, var(--secondary), var(--secondary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .team-banner::before {
            content: '🏈';
            position: absolute;
            font-size: 120px;
            opacity: 0.1;
            transform: rotate(-15deg);
        }

        .team-logo-wrapper {
            position: relative;
            z-index: 1;
        }

        .team-logo {
            width: 120px;
            height: 120px;
            border-radius: 16px;
            object-fit: cover;
            border: 5px solid white;
            background: white;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .team-logo-placeholder {
            width: 120px;
            height: 120px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            letter-spacing: 2px;
            border: 5px solid white;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .team-content {
            padding: 30px 25px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .team-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--secondary);
            margin-bottom: 8px;
            letter-spacing: 2px;
            text-align: center;
        }

        .team-short-name {
            text-align: center;
            color: var(--gray-600);
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .team-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: auto;
        }

        .team-info-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 15px;
            background: var(--gray-100);
            border-radius: 8px;
            font-size: 14px;
        }

        .team-info-label {
            color: var(--gray-600);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .team-info-value {
            font-weight: 700;
            color: var(--text-dark);
        }

        .team-footer {
            padding: 15px 25px;
            background: var(--gray-100);
            text-align: center;
        }

        .btn-view-team {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }

        .btn-view-team:hover {
            transform: scale(1.05);
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
            font-size: 16px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
            }

            .header-nav {
                width: 100%;
                justify-content: space-around;
            }

            .container {
                padding: 20px 15px;
            }

            .page-header {
                padding: 30px 20px;
            }

            .page-header h1 {
                font-size: 40px;
            }

            .teams-grid {
                grid-template-columns: 1fr;
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
                    <h1>Flag Football League</h1>
                    <p>Temporada 2025</p>
                </div>
            </div>

            <div class="header-nav">
                <a href="{{ route('home') }}" class="btn-nav">
                    <span>🏠</span>
                    <span>Inicio</span>
                </a>
                <a href="{{ route('games.index') }}" class="btn-nav">
                    <span>📅</span>
                    <span>Partidos</span>
                </a>
                <a href="{{ route('standings') }}" class="btn-nav">
                    <span>🏆</span>
                    <span>Posiciones</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>Nuestros Equipos</h1>
            <p>Conoce a todos los equipos de la liga</p>
            <div class="team-count">
                <span>🏈</span>
                <span>{{ $teams->count() }} {{ $teams->count() === 1 ? 'Equipo' : 'Equipos' }}</span>
            </div>
        </div>

        <!-- Search Section -->
        <div class="search-section">
            <div class="search-box">
                <input 
                    type="text" 
                    class="search-input" 
                    id="searchInput"
                    placeholder="Buscar equipo por nombre o ciudad..."
                >
                <span class="search-icon">🔍</span>
            </div>
        </div>

        <!-- Teams Grid -->
        @if($teams->count() > 0)
            <div class="teams-grid" id="teamsGrid">
                @foreach($teams as $team)
                    <a href="{{ route('teams.show', $team->id) }}" 
                       class="team-card"
                       data-team-name="{{ strtolower($team->name) }}"
                       data-team-city="{{ strtolower($team->city ?? '') }}">
                        <!-- Team Banner -->
                        <div class="team-banner">
                            <div class="team-logo-wrapper">
                                @if($team->logo)
                                    <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="team-logo">
                                @else
                                    <div class="team-logo-placeholder">
                                        {{ strtoupper(substr($team->short_name, 0, 3)) }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Team Content -->
                        <div class="team-content">
                            <h3 class="team-name">{{ $team->name }}</h3>
                            <div class="team-short-name">{{ $team->short_name }}</div>

                            <div class="team-info">
                                <div class="team-info-item">
                                    <span class="team-info-label">
                                        <span>👥</span>
                                        <span>Jugadores</span>
                                    </span>
                                    <span class="team-info-value">{{ $team->players_count }}</span>
                                </div>

                                @if($team->city)
                                    <div class="team-info-item">
                                        <span class="team-info-label">
                                            <span>📍</span>
                                            <span>Ciudad</span>
                                        </span>
                                        <span class="team-info-value">{{ $team->city }}</span>
                                    </div>
                                @endif

                                @if($team->founded_year)
                                    <div class="team-info-item">
                                        <span class="team-info-label">
                                            <span>📅</span>
                                            <span>Fundado</span>
                                        </span>
                                        <span class="team-info-value">{{ $team->founded_year }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Team Footer -->
                        <div class="team-footer">
                            <span class="btn-view-team">
                                <span>Ver Equipo</span>
                                <span>→</span>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">🏈</div>
                <h3>No hay equipos registrados</h3>
                <p>Pronto se anunciarán los equipos de la temporada</p>
            </div>
        @endif
    </div>

    <script>
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const teamCards = document.querySelectorAll('.team-card');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            teamCards.forEach(card => {
                const teamName = card.dataset.teamName;
                const teamCity = card.dataset.teamCity;

                if (teamName.includes(searchTerm) || teamCity.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>