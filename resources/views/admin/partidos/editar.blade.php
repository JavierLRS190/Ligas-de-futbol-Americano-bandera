<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Partido - Admin</title>
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

        .container { max-width: 900px; margin: 0 auto; }

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
        }

        .page-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            color: var(--secondary);
            letter-spacing: 2px;
        }

        .form-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            color: var(--secondary);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e5e5e5;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group { margin-bottom: 20px; }
        .form-group.full-width { grid-column: 1 / -1; }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e5e5e5;
            border-radius: 8px;
            font-size: 14px;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--info);
        }

        .btn {
            padding: 14px 30px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--success), #059669);
            color: white;
            flex: 1;
        }

        .btn-secondary {
            background: var(--gray-600);
            color: white;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #e5e5e5;
        }

        .score-input {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
        }

        @media (max-width: 768px) {
            .form-row { grid-template-columns: 1fr; }
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
                <a href="{{ route('admin.games.index') }}">Partidos</a>
                <span>→</span>
                <span>Editar</span>
            </div>

            <div class="page-header">
                <h1 class="page-title">✏️ Editar Partido</h1>
                <p style="color: var(--gray-600); margin-top: 10px;">
                    {{ $game->homeTeam->name }} vs {{ $game->awayTeam->name }}
                </p>
            </div>

            <div class="form-card">
                <form action="{{ route('admin.games.update', $game->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Información del Partido -->
                    <h3 class="section-title">📋 Información del Partido</h3>

                    <div class="form-group">
                        <label class="form-label">Jornada *</label>
                        <select name="jornada_id" class="form-control" required>
                            <option value="">Seleccionar...</option>
                            @foreach($jornadas as $jornada)
                                <option value="{{ $jornada->id }}" {{ $game->jornada_id == $jornada->id ? 'selected' : '' }}>
                                    {{ $jornada->season->name }} - {{ $jornada->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Equipo Local *</label>
                            <select name="home_team_id" class="form-control" required>
                                <option value="">Seleccionar...</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ $game->home_team_id == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Equipo Visitante *</label>
                            <select name="away_team_id" class="form-control" required>
                                <option value="">Seleccionar...</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ $game->away_team_id == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Fecha *</label>
                            <input 
                                type="date" 
                                name="date" 
                                class="form-control" 
                                value="{{ \Carbon\Carbon::parse($game->game_datetime)->format('Y-m-d') }}"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label">Hora *</label>
                            <input 
                                type="time" 
                                name="time" 
                                class="form-control" 
                                value="{{ \Carbon\Carbon::parse($game->game_datetime)->format('H:i') }}"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Ubicación</label>
                        <input 
                            type="text" 
                            name="location" 
                            class="form-control" 
                            value="{{ $game->location }}"
                            placeholder="Estadio..."
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">Estado *</label>
                        <select name="status" class="form-control" required>
                            <option value="scheduled" {{ $game->status == 'scheduled' ? 'selected' : '' }}>Programado</option>
                            <option value="in_progress" {{ $game->status == 'in_progress' ? 'selected' : '' }}>En Progreso</option>
                            <option value="finished" {{ $game->status == 'finished' ? 'selected' : '' }}>Finalizado</option>
                        </select>
                    </div>

                    <!-- Resultado -->
                    <h3 class="section-title" style="margin-top: 40px;">⚽ Resultado</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Marcador Local</label>
                            <input 
                                type="number" 
                                name="home_score" 
                                class="form-control score-input" 
                                value="{{ $game->home_score }}"
                                min="0"
                                placeholder="0"
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label">Marcador Visitante</label>
                            <input 
                                type="number" 
                                name="away_score" 
                                class="form-control score-input" 
                                value="{{ $game->away_score }}"
                                min="0"
                                placeholder="0"
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Notas</label>
                        <textarea 
                            name="notes" 
                            class="form-control" 
                            rows="4"
                            placeholder="Observaciones del partido..."
                        >{{ $game->notes }}</textarea>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.games.index') }}" class="btn btn-secondary">← Cancelar</a>
                        <button type="submit" class="btn btn-primary">💾 Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Validar que los equipos sean diferentes
        document.querySelector('form').addEventListener('submit', function(e) {
            const home = document.querySelector('[name="home_team_id"]').value;
            const away = document.querySelector('[name="away_team_id"]').value;
            
            if (home && away && home === away) {
                e.preventDefault();
                alert('Los equipos deben ser diferentes');
            }
        });
    </script>
</body>
</html>