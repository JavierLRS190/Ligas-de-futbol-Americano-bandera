<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Temporadas - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1a472a 0%, #2d5a3d 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }

        .admin-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            color: #1a472a;
            letter-spacing: 2px;
        }

        .admin-subtitle {
            color: #666;
            margin-top: 5px;
            font-size: 16px;
        }

        .breadcrumb {
            margin-top: 10px;
            color: #999;
            font-size: 14px;
        }

        .breadcrumb a {
            color: #ff5722;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff5722 0%, #e64a19 100%);
            color: white;
            padding: 14px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            display: inline-block;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 87, 34, 0.4);
        }

        .filter-section {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .filter-section label {
            font-weight: 600;
            color: #2d3748;
        }

        .filter-section select {
            flex: 1;
            max-width: 300px;
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            background: white;
        }

        .seasons-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }

        .season-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s;
        }

        .season-card:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            transform: translateY(-4px);
        }

        .season-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .season-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .season-badge.active {
            background: #d4edda;
            color: #155724;
        }

        .season-badge.inactive {
            background: #f8f9fa;
            color: #6c757d;
        }

        .season-menu {
            position: relative;
        }

        .btn-icon {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            padding: 5px 10px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 35px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            min-width: 180px;
            z-index: 10;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            display: block;
            width: 100%;
            padding: 12px 18px;
            text-align: left;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            color: #2d3748;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: #f8f9fa;
        }

        .league-badge {
            display: inline-block;
            background: #e3f2fd;
            color: #1976d2;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .season-name {
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
            margin: 10px 0;
        }

        .season-dates {
            color: #718096;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .season-stats {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-top: 1px solid #e0e0e0;
            border-bottom: 1px solid #e0e0e0;
            margin: 15px 0;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            display: block;
            font-size: 26px;
            font-weight: 700;
            color: #ff5722;
        }

        .stat-label {
            font-size: 11px;
            color: #718096;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .season-actions {
            margin-top: 15px;
        }

        .btn-secondary {
            display: block;
            width: 100%;
            padding: 12px;
            background: #f0f0f0;
            color: #2d3748;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background: #e0e0e0;
        }

        .empty-state {
            background: rgba(255, 255, 255, 0.95);
            padding: 60px 20px;
            border-radius: 12px;
            text-align: center;
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 24px;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #718096;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="admin-header">
            <div>
                <h1 class="admin-title">⚡ GESTIÓN DE TEMPORADAS</h1>
                <p class="admin-subtitle">Crea y gestiona las temporadas de cada liga</p>
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <span>→</span>
                    <span>Temporadas</span>
                </div>
            </div>
            <a href="{{ route('admin.seasons.create') }}" class="btn-primary">
                ➕ CREAR TEMPORADA
            </a>
        </div>

        <!-- Filtro por liga -->
        <div class="filter-section">
            <label for="league-filter">🏆 Filtrar por Liga:</label>
            <select id="league-filter" onchange="filterByLeague(this.value)">
                <option value="">Todas las ligas</option>
                @foreach($leagues as $league)
                    <option value="{{ $league->id }}" {{ request('league_id') == $league->id ? 'selected' : '' }}>
                        {{ $league->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Lista de temporadas -->
        <div class="seasons-grid">
            @forelse($seasons as $season)
                <div class="season-card" data-league="{{ $season->league_id }}">
                    <div class="season-header">
                        <div class="season-badge {{ $season->is_active ? 'active' : 'inactive' }}">
                            {{ $season->is_active ? '🟢 ACTIVA' : '⚪ INACTIVA' }}
                        </div>
                        <div class="season-menu">
                            <button class="btn-icon" onclick="toggleMenu({{ $season->id }})">⋮</button>
                            <div class="dropdown-menu" id="menu-{{ $season->id }}">
                                <a href="{{ route('admin.seasons.edit', $season->id) }}">✏️ Editar</a>
                                <a href="{{ route('admin.jornadas.index', ['season_id' => $season->id]) }}">📅 Ver Jornadas</a>
                                <form action="{{ route('admin.seasons.destroy', $season->id) }}" method="POST" 
                                      onsubmit="return confirm('¿Eliminar esta temporada?')" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">🗑️ Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="season-info">
                        <div class="league-badge">
                            🏆 {{ $season->league->name }}
                        </div>
                        <h3 class="season-name">{{ $season->name }}</h3>
                        <div class="season-dates">
                            📅 {{ \Carbon\Carbon::parse($season->start_date)->format('d/m/Y') }} 
                            - 
                            {{ \Carbon\Carbon::parse($season->end_date)->format('d/m/Y') }}
                        </div>
                    </div>

                    <div class="season-stats">
                        <div class="stat-item">
                            <span class="stat-value">{{ $season->rounds_count ?? 0 }}</span>
                            <span class="stat-label">Jornadas</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">{{ $season->games_count ?? 0 }}</span>
                            <span class="stat-label">Partidos</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">{{ $season->teams_count ?? 0 }}</span>
                            <span class="stat-label">Equipos</span>
                        </div>
                    </div>

                    <div class="season-actions">
                        <a href="{{ route('admin.jornadas.index', ['season_id' => $season->id]) }}" class="btn-secondary">
                            📅 Gestionar Jornadas
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">📆</div>
                    <h3>No hay temporadas creadas</h3>
                    <p>Crea tu primera temporada para comenzar a organizar el torneo</p>
                    <a href="{{ route('admin.seasons.create') }}" class="btn-primary">➕ Crear Temporada</a>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        function toggleMenu(id) {
            const menu = document.getElementById('menu-' + id);
            document.querySelectorAll('.dropdown-menu').forEach(m => {
                if (m.id !== 'menu-' + id) m.classList.remove('show');
            });
            menu.classList.toggle('show');
        }

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.season-menu')) {
                document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));
            }
        });

        function filterByLeague(leagueId) {
            if (leagueId) {
                window.location.href = '{{ route("admin.seasons.index") }}?league_id=' + leagueId;
            } else {
                window.location.href = '{{ route("admin.seasons.index") }}';
            }
        }
    </script>
</body>
</html>
<div class="admin-header">
    <div>
        <h1 class="admin-title">⚡ GESTIÓN DE TEMPORADAS</h1>
        <p class="admin-subtitle">Crea y gestiona las temporadas de cada liga</p>
        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <span>→</span>
            <span>Temporadas</span>
        </div>
    </div>
    <a href="{{ route('admin.seasons.create') }}" class="btn-primary">
        ➕ CREAR TEMPORADA
    </a>
</div>

<!-- Filtro por liga -->
<div class="filter-section">
    <label for="league-filter">🏆 Filtrar por Liga:</label>
    <select id="league-filter" class="form-control" onchange="filterByLeague(this.value)">
        <option value="">Todas las ligas</option>
        @foreach($leagues as $league)
            <option value="{{ $league->id }}" {{ request('league_id') == $league->id ? 'selected' : '' }}>
                {{ $league->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Lista de temporadas -->
<div class="seasons-grid">
    @forelse($seasons as $season)
        <div class="season-card" data-league="{{ $season->league_id }}">
            <div class="season-header">
                <div class="season-badge {{ $season->is_active ? 'active' : 'inactive' }}">
                    {{ $season->is_active ? '🟢 ACTIVA' : '⚪ INACTIVA' }}
                </div>
                <div class="season-menu">
                    <button class="btn-icon" onclick="toggleMenu({{ $season->id }})">⋮</button>
                    <div class="dropdown-menu" id="menu-{{ $season->id }}">
                        <a href="{{ route('admin.seasons.edit', $season->id) }}">✏️ Editar</a>
                        <a href="{{ route('admin.jornadas.index', ['season_id' => $season->id]) }}">📅 Ver Jornadas</a>
                        <form action="{{ route('admin.seasons.destroy', $season->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta temporada?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">🗑️ Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="season-info">
                <div class="league-badge">
                    🏆 {{ $season->league->name }}
                </div>
                <h3 class="season-name">{{ $season->name }}</h3>
                <div class="season-dates">
                    📅 {{ \Carbon\Carbon::parse($season->start_date)->format('d/m/Y') }} 
                    - 
                    {{ \Carbon\Carbon::parse($season->end_date)->format('d/m/Y') }}
                </div>
            </div>

            <div class="season-stats">
                <div class="stat-item">
                    <span class="stat-value">{{ $season->rounds_count ?? 0 }}</span>
                    <span class="stat-label">Jornadas</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">{{ $season->games_count ?? 0 }}</span>
                    <span class="stat-label">Partidos</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">{{ $season->teams_count ?? 0 }}</span>
                    <span class="stat-label">Equipos</span>
                </div>
            </div>

            <div class="season-actions">
                <a href="{{ route('admin.jornadas.index', ['season_id' => $season->id]) }}" class="btn-secondary">
                    📅 Gestionar Jornadas
                </a>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-icon">📆</div>
            <h3>No hay temporadas creadas</h3>
            <p>Crea tu primera temporada para comenzar a organizar el torneo</p>
            <a href="{{ route('admin.seasons.create') }}" class="btn-primary">➕ Crear Temporada</a>
        </div>
    @endforelse
</div>

<style>
.seasons-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.season-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    padding: 20px;
    transition: all 0.3s;
}

.season-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.season-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.season-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
}

.season-badge.active {
    background: #d4edda;
    color: #155724;
}

.season-badge.inactive {
    background: #f8f9fa;
    color: #6c757d;
}

.season-menu {
    position: relative;
}

.dropdown-menu {
    display: none;
    position: absolute;
    right: 0;
    top: 30px;
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    min-width: 150px;
    z-index: 10;
}

.dropdown-menu.show {
    display: block;
}

.dropdown-menu a,
.dropdown-menu button {
    display: block;
    width: 100%;
    padding: 10px 15px;
    text-align: left;
    border: none;
    background: none;
    cursor: pointer;
    font-size: 14px;
}

.dropdown-menu a:hover,
.dropdown-menu button:hover {
    background: #f8f9fa;
}

.league-badge {
    display: inline-block;
    background: #e3f2fd;
    color: #1976d2;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 10px;
}

.season-name {
    font-size: 22px;
    font-weight: 700;
    color: #2d3748;
    margin: 10px 0;
}

.season-dates {
    color: #718096;
    font-size: 14px;
    margin-bottom: 15px;
}

.season-stats {
    display: flex;
    justify-content: space-between;
    padding: 15px 0;
    border-top: 1px solid #e0e0e0;
    border-bottom: 1px solid #e0e0e0;
    margin: 15px 0;
}

.stat-item {
    text-align: center;
}

.stat-value {
    display: block;
    font-size: 24px;
    font-weight: 700;
    color: #ff5722;
}

.stat-label {
    font-size: 12px;
    color: #718096;
    text-transform: uppercase;
}

.season-actions {
    margin-top: 15px;
}

.filter-section {
    background: white;
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.filter-section label {
    font-weight: 600;
    color: #2d3748;
}

.filter-section select {
    flex: 1;
    max-width: 300px;
}
</style>

<script>
function toggleMenu(id) {
    const menu = document.getElementById('menu-' + id);
    // Cerrar otros menús
    document.querySelectorAll('.dropdown-menu').forEach(m => {
        if (m.id !== 'menu-' + id) m.classList.remove('show');
    });
    menu.classList.toggle('show');
}

// Cerrar menús al hacer click fuera
document.addEventListener('click', function(e) {
    if (!e.target.closest('.season-menu')) {
        document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));
    }
});

function filterByLeague(leagueId) {
    if (leagueId) {
        window.location.href = '{{ route("admin.seasons.index") }}?league_id=' + leagueId;
    } else {
        window.location.href = '{{ route("admin.seasons.index") }}';
    }
}
</script>
</body>
</html>