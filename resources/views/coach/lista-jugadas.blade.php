<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jugadas - Flag Football</title>
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
            border-left: 6px solid var(--info);
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

        .team-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
            padding: 10px 15px;
            background: linear-gradient(135deg, var(--info), #2563eb);
            color: white;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
            font-size: 14px;
        }

        .breadcrumb a {
            color: var(--info);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .breadcrumb a:hover {
            color: #2563eb;
        }

        .breadcrumb span {
            color: var(--gray-600);
        }

        .btn-primary {
            padding: 15px 30px;
            background: linear-gradient(135deg, var(--info) 0%, #2563eb 100%);
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
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
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

        .alert-info {
            background: rgba(59, 130, 246, 0.1);
            border: 2px solid var(--info);
            color: #1e40af;
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
            border-color: var(--info);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
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
            border-color: var(--info);
        }

        /* Plays Grid */
        .plays-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .play-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .play-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
        }

        .play-header {
            padding: 25px;
            border-bottom: 2px solid var(--gray-200);
        }

        .play-type-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
        }

        .play-type-badge.offense {
            background: rgba(59, 130, 246, 0.1);
            color: var(--info);
        }

        .play-type-badge.defense {
            background: rgba(239, 68, 68, 0.1);
            color: var(--error);
        }

        .play-type-badge.special {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .play-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            color: var(--secondary);
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .play-description {
            color: var(--gray-600);
            font-size: 14px;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .play-diagram {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: var(--gray-100);
        }

        .play-diagram-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, var(--gray-100), var(--gray-200));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 64px;
            color: var(--gray-600);
        }

        .play-footer {
            padding: 20px 25px;
            display: flex;
            gap: 10px;
            justify-content: space-between;
            align-items: center;
        }

        .play-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .play-video-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: rgba(239, 68, 68, 0.1);
            color: var(--error);
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .play-video-link:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        .play-actions {
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

            .plays-grid {
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
                    <h1>Flag Football</h1>
                    <p>Panel del Coach</p>
                </div>
            </div>

            <div class="header-actions">
                <a href="{{ route('coach.dashboard') }}" class="btn-back">
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
                <h1>Libro de Jugadas</h1>
                <p>Gestiona tus estrategias privadas</p>
                <div class="team-badge">
                    <span>🏆</span>
                    <span>{{ $team->name }}</span>
                </div>
                <div class="breadcrumb">
                    <a href="{{ route('coach.dashboard') }}">Dashboard</a>
                    <span>→</span>
                    <span>Jugadas</span>
                </div>
            </div>
            <a href="{{ route('coach.plays.create') }}" class="btn-primary">
                <span>➕</span>
                <span>Crear Jugada</span>
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="alert alert-info">
            <span>🔒</span>
            <span>Todas tus jugadas son privadas y solo visibles para ti y tu equipo</span>
        </div>

        <!-- Search and Filter -->
        <div class="controls">
            <div class="search-box">
                <input 
                    type="text" 
                    class="search-input" 
                    id="searchInput"
                    placeholder="Buscar jugadas por nombre..."
                >
                <span class="search-icon">🔍</span>
            </div>
            <select class="filter-select" id="typeFilter">
                <option value="all">Todos los tipos</option>
                <option value="offense">Ofensivas</option>
                <option value="defense">Defensivas</option>
                <option value="special">Especiales</option>
            </select>
        </div>

        <!-- Plays Grid -->
        @if($plays->count() > 0)
            <div class="plays-grid" id="playsGrid">
                @foreach($plays as $play)
                    <div class="play-card" 
                         data-play-name="{{ strtolower($play->name) }}" 
                         data-play-type="{{ $play->type }}">
                        <div class="play-header">
                            <span class="play-type-badge {{ $play->type }}">
                                @if($play->type === 'offense')
                                    ⚡ Ofensiva
                                @elseif($play->type === 'defense')
                                    🛡️ Defensiva
                                @else
                                    ✨ Especial
                                @endif
                            </span>
                            <h3 class="play-name">{{ $play->name }}</h3>
                            @if($play->description)
                                <p class="play-description">{{ $play->description }}</p>
                            @else
                                <p class="play-description" style="font-style: italic; color: var(--gray-400);">Sin descripción</p>
                            @endif
                        </div>

                        @if($play->diagram)
                            <img src="{{ asset('storage/' . $play->diagram) }}" alt="{{ $play->name }}" class="play-diagram">
                        @else
                            <div class="play-diagram-placeholder">📐</div>
                        @endif

                        <div class="play-footer">
                            <div class="play-meta">
                                @if($play->video_url)
                                    <a href="{{ $play->video_url }}" target="_blank" class="play-video-link">
                                        <span>📹</span>
                                        <span>Ver Video</span>
                                    </a>
                                @endif
                            </div>
                            <div class="play-actions">
                                <a href="{{ route('coach.plays.edit', $play->id) }}" class="btn-action btn-edit">
                                    <span>✏️</span>
                                    <span>Editar</span>
                                </a>
                                <button class="btn-action btn-delete" onclick="confirmDelete({{ $play->id }}, '{{ $play->name }}')">
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
                <div class="empty-icon">📋</div>
                <h3>No hay jugadas registradas</h3>
                <p>Comienza creando tu primera jugada estratégica</p>
                <a href="{{ route('coach.plays.create') }}" class="btn-primary">
                    <span>➕</span>
                    <span>Crear Primera Jugada</span>
                </a>
            </div>
        @endif
    </div>

    <!-- Delete Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>¿Eliminar Jugada?</h3>
                <p>Estás a punto de eliminar la jugada "<strong id="playNameToDelete"></strong>". Esta acción no se puede deshacer.</p>
            </div>
            <form id="deleteForm" method="POST" style="margin: 0;">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Cancelar</button>
                    <button type="submit" class="btn-confirm">Eliminar Jugada</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Search and filter functionality
        const searchInput = document.getElementById('searchInput');
        const typeFilter = document.getElementById('typeFilter');
        const playCards = document.querySelectorAll('.play-card');

        function filterPlays() {
            const searchTerm = searchInput.value.toLowerCase();
            const typeValue = typeFilter.value;

            playCards.forEach(card => {
                const playName = card.dataset.playName;
                const playType = card.dataset.playType;

                const matchesSearch = playName.includes(searchTerm);
                const matchesType = typeValue === 'all' || playType === typeValue;

                if (matchesSearch && matchesType) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', filterPlays);
        typeFilter.addEventListener('change', filterPlays);

        // Delete modal
        function confirmDelete(playId, playName) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const playNameElement = document.getElementById('playNameToDelete');

            playNameElement.textContent = playName;
            form.action = `/coach/jugadas/${playId}`;
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