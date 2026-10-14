<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jugadores - Flag Football</title>
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

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .btn-back {
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

        .btn-back:hover {
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

        /* Controls */
        .controls {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 25px 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 12px 45px 12px 20px;
            border: 2px solid var(--gray-300);
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-600);
            font-size: 18px;
        }

        .filter-select {
            padding: 12px 20px;
            border: 2px solid var(--gray-300);
            border-radius: 10px;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s;
            background: white;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
        }

        /* Table */
        .table-container {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }

        .players-table {
            width: 100%;
            border-collapse: collapse;
        }

        .players-table thead {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-light));
            color: white;
        }

        .players-table th {
            padding: 20px 15px;
            text-align: left;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 13px;
        }

        .players-table tbody tr {
            border-bottom: 1px solid var(--gray-200);
            transition: all 0.3s;
        }

        .players-table tbody tr:hover {
            background: var(--gray-100);
        }

        .players-table tbody tr:last-child {
            border-bottom: none;
        }

        .players-table td {
            padding: 18px 15px;
            font-size: 14px;
        }

        .player-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .player-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--gray-300);
            flex-shrink: 0;
        }

        .player-photo-placeholder {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
            border: 3px solid var(--gray-300);
            flex-shrink: 0;
        }

        .player-details {
            flex: 1;
        }

        .player-name {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 15px;
            margin-bottom: 3px;
        }

        .player-team {
            font-size: 12px;
            color: var(--gray-600);
        }

        .jersey-number {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 18px;
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 1px;
            display: inline-block;
        }

        .position-badge {
            background: var(--info);
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.active {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-badge.inactive {
            background: rgba(239, 68, 68, 0.1);
            color: var(--error);
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .player-actions {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            padding: 8px 15px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-edit {
            background: var(--info);
            color: white;
        }

        .btn-edit:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: var(--error);
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 20px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 16px;
            border: 2px solid var(--gray-300);
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            transition: all 0.3s;
        }

        .pagination a:hover {
            border-color: var(--primary);
            background: var(--primary);
            color: white;
        }

        .pagination .active {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .pagination .disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
            margin-bottom: 25px;
            font-size: 16px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .modal-header {
            margin-bottom: 25px;
        }

        .modal-header h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--error);
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .modal-header p {
            color: var(--gray-600);
            font-size: 15px;
        }

        .modal-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-cancel {
            flex: 1;
            padding: 15px;
            background: var(--gray-200);
            color: var(--text-dark);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-cancel:hover {
            background: var(--gray-300);
        }

        .btn-confirm {
            flex: 1;
            padding: 15px;
            background: var(--error);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-confirm:hover {
            background: #dc2626;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .table-container {
                overflow-x: auto;
            }

            .players-table {
                min-width: 900px;
            }
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
            }

            .container {
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

            .controls {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                min-width: 100%;
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
                    <h1>Flag Football</h1>
                    <p>Panel Administrador</p>
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('admin.dashboard') }}" class="btn-back">
                    <span>←</span>
                    <span>Dashboard</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title-section">
                <h1>Jugadores</h1>
                <p>Gestiona todos los jugadores de la liga</p>
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <span>→</span>
                    <span>Jugadores</span>
                </div>
            </div>
            <a href="{{ route('admin.players.create') }}" class="btn-primary">
                <span>➕</span>
                <span>Crear Jugador</span>
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Search and Filter -->
        <div class="controls">
            <div class="search-box">
                <input 
                    type="text" 
                    class="search-input" 
                    id="searchInput"
                    placeholder="Buscar jugadores por nombre, equipo..."
                >
                <span class="search-icon">🔍</span>
            </div>
            <select class="filter-select" id="teamFilter">
                <option value="all">Todos los equipos</option>
                @foreach($players->pluck('team')->unique('id')->filter() as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
            <select class="filter-select" id="positionFilter">
                <option value="all">Todas las posiciones</option>
                <option value="QB">QB - Quarterback</option>
                <option value="RB">RB - Running Back</option>
                <option value="WR">WR - Wide Receiver</option>
                <option value="TE">TE - Tight End</option>
                <option value="OL">OL - Offensive Line</option>
                <option value="DL">DL - Defensive Line</option>
                <option value="LB">LB - Linebacker</option>
                <option value="CB">CB - Cornerback</option>
                <option value="S">S - Safety</option>
                <option value="K">K - Kicker</option>
                <option value="P">P - Punter</option>
            </select>
            <select class="filter-select" id="statusFilter">
                <option value="all">Todos</option>
                <option value="active">Solo activos</option>
                <option value="inactive">Solo inactivos</option>
            </select>
        </div>

        <!-- Players Table -->
        @if($players->count() > 0)
            <div class="table-container">
                <table class="players-table">
                    <thead>
                        <tr>
                            <th>Jugador</th>
                            <th>Número</th>
                            <th>Posición</th>
                            <th>Equipo</th>
                            <th>Edad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="playersTableBody">
                        @foreach($players as $player)
                            <tr data-player-name="{{ strtolower($player->name . ' ' . $player->last_name) }}" 
                                data-team-id="{{ $player->team_id }}" 
                                data-team-name="{{ strtolower($player->team->name ?? '') }}"
                                data-position="{{ $player->position }}" 
                                data-status="{{ $player->is_active ? 'active' : 'inactive' }}">
                                <td>
                                    <div class="player-info">
                                        @if($player->photo)
                                            <img src="{{ asset('storage/' . $player->photo) }}" alt="{{ $player->name }}" class="player-photo">
                                        @else
                                            <div class="player-photo-placeholder">
                                                {{ strtoupper(substr($player->name, 0, 1)) }}{{ strtoupper(substr($player->last_name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div class="player-details">
                                            <div class="player-name">{{ $player->name }} {{ $player->last_name }}</div>
                                            <div class="player-team">{{ $player->team->name ?? 'Sin equipo' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="jersey-number">#{{ $player->jersey_number }}</span>
                                </td>
                                <td>
                                    <span class="position-badge">{{ $player->position }}</span>
                                </td>
                                <td>{{ $player->team->short_name ?? 'N/A' }}</td>
                                <td>
                                    @if($player->birth_date)
                                        {{ \Carbon\Carbon::parse($player->birth_date)->age }} años
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <span class="status-badge {{ $player->is_active ? 'active' : 'inactive' }}">
                                        <span class="status-dot"></span>
                                        <span>{{ $player->is_active ? 'Activo' : 'Inactivo' }}</span>
                                    </span>
                                </td>
                                <td>
                                    <div class="player-actions">
                                        <a href="{{ route('admin.players.edit', $player->id) }}" class="btn-action btn-edit">
                                            <span>✏️</span>
                                            <span>Editar</span>
                                        </a>
                                        <button class="btn-action btn-delete" onclick="confirmDelete({{ $player->id }}, '{{ $player->name }} {{ $player->last_name }}')">
                                            <span>🗑️</span>
                                            <span>Eliminar</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                {{ $players->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">👤</div>
                <h3>No hay jugadores registrados</h3>
                <p>Comienza creando tu primer jugador para la liga</p>
                <a href="{{ route('admin.players.create') }}" class="btn-primary">
                    <span>➕</span>
                    <span>Crear Primer Jugador</span>
                </a>
            </div>
        @endif
    </div>

    <!-- Delete Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>¿Eliminar Jugador?</h3>
                <p>Estás a punto de eliminar al jugador "<strong id="playerNameToDelete"></strong>". Esta acción no se puede deshacer.</p>
            </div>
            <form id="deleteForm" method="POST" style="margin: 0;">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Cancelar</button>
                    <button type="submit" class="btn-confirm">Eliminar Jugador</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Search and filter functionality
        const searchInput = document.getElementById('searchInput');
        const teamFilter = document.getElementById('teamFilter');
        const positionFilter = document.getElementById('positionFilter');
        const statusFilter = document.getElementById('statusFilter');
        const tableRows = document.querySelectorAll('#playersTableBody tr');

        function filterPlayers() {
            const searchTerm = searchInput.value.toLowerCase();
            const teamValue = teamFilter.value;
            const positionValue = positionFilter.value;
            const statusValue = statusFilter.value;

            tableRows.forEach(row => {
                const playerName = row.dataset.playerName;
                const teamId = row.dataset.teamId;
                const teamName = row.dataset.teamName;
                const position = row.dataset.position;
                const status = row.dataset.status;

                const matchesSearch = playerName.includes(searchTerm) || teamName.includes(searchTerm);
                const matchesTeam = teamValue === 'all' || teamId === teamValue;
                const matchesPosition = positionValue === 'all' || position === positionValue;
                const matchesStatus = statusValue === 'all' || status === statusValue;

                if (matchesSearch && matchesTeam && matchesPosition && matchesStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', filterPlayers);
        teamFilter.addEventListener('change', filterPlayers);
        positionFilter.addEventListener('change', filterPlayers);
        statusFilter.addEventListener('change', filterPlayers);

        // Delete modal
        function confirmDelete(playerId, playerName) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const playerNameElement = document.getElementById('playerNameToDelete');

            playerNameElement.textContent = playerName;
            form.action = `/admin/jugadores/${playerId}`;
            modal.classList.add('active');
        }

        function closeModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('active');
        }

        // Close modal on outside click
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>