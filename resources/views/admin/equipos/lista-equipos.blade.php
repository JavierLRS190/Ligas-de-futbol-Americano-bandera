<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Equipos - Admin</title>
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

        /* Filter Section */
        .filter-section {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 25px 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .filter-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .filter-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            color: var(--secondary);
            letter-spacing: 1px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-label {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filter-select,
        .filter-input {
            padding: 12px 15px;
            border: 2px solid var(--gray-300);
            border-radius: 10px;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            background: white;
        }

        .filter-select:focus,
        .filter-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        .btn-filter {
            padding: 12px 25px;
            background: var(--info);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-filter:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }

        .btn-clear {
            padding: 12px 25px;
            background: var(--gray-200);
            color: var(--text-dark);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-clear:hover {
            background: var(--gray-300);
        }

        .filter-actions {
            display: flex;
            gap: 10px;
        }

        /* Active Filter Badge */
        .active-filter {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 15px;
            background: rgba(59, 130, 246, 0.1);
            border: 2px solid var(--info);
            border-radius: 10px;
            color: var(--info);
            font-weight: 600;
            font-size: 14px;
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

        /* Teams Grid */
        .teams-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .team-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
        }

        .team-header {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-light));
            padding: 25px;
            position: relative;
            overflow: hidden;
        }

        .team-header::before {
            content: '🏈';
            position: absolute;
            font-size: 100px;
            opacity: 0.1;
            right: -10px;
            top: 50%;
            transform: translateY(-50%) rotate(-15deg);
        }

        .team-logo-wrapper {
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
        }

        .team-logo {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            border: 3px solid white;
            background: white;
            flex-shrink: 0;
        }

        .team-logo-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            letter-spacing: 1px;
            border: 3px solid white;
            flex-shrink: 0;
        }

        .team-title {
            flex: 1;
        }

        .team-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            color: white;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        .team-league {
            color: rgba(255, 255, 255, 0.8);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .team-body {
            padding: 20px 25px;
        }

        .team-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 15px;
        }

        .info-item {
            background: var(--gray-100);
            padding: 12px;
            border-radius: 8px;
            text-align: center;
        }

        .info-label {
            font-size: 11px;
            color: var(--gray-600);
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            color: var(--primary);
            letter-spacing: 1px;
        }

        .team-actions {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-edit {
            background: var(--warning);
            color: white;
        }

        .btn-edit:hover {
            background: #d97706;
        }

        .btn-delete {
            background: var(--error);
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
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
            margin-bottom: 25px;
        }

        /* Delete Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .modal-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .modal-icon {
            font-size: 64px;
            margin-bottom: 15px;
        }

        .modal-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--text-dark);
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .modal-text {
            color: var(--gray-600);
            font-size: 16px;
        }

        .modal-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-modal {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-cancel {
            background: var(--gray-200);
            color: var(--text-dark);
        }

        .btn-cancel:hover {
            background: var(--gray-300);
        }

        .btn-confirm {
            background: var(--error);
            color: white;
        }

        .btn-confirm:hover {
            background: #dc2626;
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

            .filter-section {
                padding: 20px;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .teams-grid {
                grid-template-columns: 1fr;
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
                <h1>Gestión de Equipos</h1>
                <p>Administra todos los equipos del sistema</p>
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <span>→</span>
                    <span>Equipos</span>
                </div>
            </div>
            <a href="{{ route('admin.teams.create') }}" class="btn-primary">
                <span>➕</span>
                <span>Crear Equipo</span>
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-header">
                <span style="font-size: 24px;">🔍</span>
                <h2 class="filter-title">Filtros</h2>
                @if(request('league_id') && request('league_id') != 'all')
                    <div class="active-filter">
                        <span>Filtrado por liga</span>
                    </div>
                @endif
            </div>

            <form action="{{ route('admin.teams.index') }}" method="GET">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label class="filter-label">Liga</label>
                        <select name="league_id" class="filter-select" id="leagueFilter">
                            <option value="all" {{ request('league_id') == 'all' || !request('league_id') ? 'selected' : '' }}>
                                📋 Todas las ligas
                            </option>
                            @foreach($leagues as $league)
                                <option value="{{ $league->id }}" {{ request('league_id') == $league->id ? 'selected' : '' }}>
                                    🏆 {{ $league->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn-filter">
                            <span>🔍</span>
                            <span>Filtrar</span>
                        </button>
                        @if(request('league_id'))
                            <a href="{{ route('admin.teams.index') }}" class="btn-clear">
                                <span>✕</span>
                                <span>Limpiar</span>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Teams Grid -->
        @if($teams->count() > 0)
            <div class="teams-grid">
                @foreach($teams as $team)
                    <div class="team-card">
                        <!-- Team Header -->
                        <div class="team-header">
                            <div class="team-logo-wrapper">
                                @if($team->logo)
                                    <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="team-logo">
                                @else
                                    <div class="team-logo-placeholder">
                                        {{ strtoupper(substr($team->short_name, 0, 2)) }}
                                    </div>
                                @endif
                                <div class="team-title">
                                    <div class="team-name">{{ $team->name }}</div>
                                    <div class="team-league">
                                        <span>🏆</span>
                                        <span>{{ $team->league->name ?? 'Sin liga' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Team Body -->
                        <div class="team-body">
                            <div class="team-info">
                                <div class="info-item">
                                    <div class="info-label">Jugadores</div>
                                    <div class="info-value">{{ $team->players_count }}</div>
                                </div>
                                @if($team->city)
                                    <div class="info-item">
                                        <div class="info-label">Ciudad</div>
                                        <div class="info-value" style="font-size: 16px; color: var(--text-dark);">
                                            {{ $team->city }}
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="team-actions">
                                <a href="{{ route('admin.teams.edit', $team->id) }}" class="btn-action btn-edit">
                                    <span>✏️</span>
                                    <span>Editar</span>
                                </a>
                                <button type="button" class="btn-action btn-delete" onclick="openDeleteModal({{ $team->id }}, '{{ $team->name }}')">
                                    <span>🗑️</span>
                                    <span>Eliminar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">🏢</div>
                <h3>No hay equipos</h3>
                <p>
                    @if(request('league_id') && request('league_id') != 'all')
                        No hay equipos en esta liga. Intenta con otro filtro.
                    @else
                        No hay equipos registrados. Crea el primer equipo.
                    @endif
                </p>
                <a href="{{ route('admin.teams.create') }}" class="btn-primary">
                    <span>➕</span>
                    <span>Crear Primer Equipo</span>
                </a>
            </div>
        @endif
    </div>

    <!-- Delete Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-icon">⚠️</div>
                <h3 class="modal-title">Confirmar Eliminación</h3>
                <p class="modal-text">¿Estás seguro de eliminar el equipo <strong id="teamName"></strong>?</p>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeDeleteModal()">Cancelar</button>
                    <button type="submit" class="btn-modal btn-confirm">Eliminar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDeleteModal(teamId, teamName) {
            document.getElementById('teamName').textContent = teamName;
            document.getElementById('deleteForm').action = `/admin/equipos/${teamId}`;
            document.getElementById('deleteModal').classList.add('active');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('active');
        }

        // Close modal on ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });

        // Close modal on outside click
        document.getElementById('deleteModal').addEventListener('click', (e) => {
            if (e.target.id === 'deleteModal') {
                closeDeleteModal();
            }
        });
    </script>
</body>
</html>