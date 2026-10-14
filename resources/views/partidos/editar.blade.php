<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Resultado - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1a472a 0%, #2d5a3d 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .page-header {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        
        .page-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 38px;
            color: #1a472a;
            letter-spacing: 2px;
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
        
        .game-info-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .league-info {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .jornada-info, .game-date {
            font-size: 14px;
            opacity: 0.95;
            margin: 4px 0;
        }
        
        .scoreboard {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 30px;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        
        .team-section {
            text-align: center;
        }
        
        .team-logo {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #f0f0f0;
        }
        
        .team-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .logo-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #ff5722 0%, #e64a19 100%);
            color: white;
            font-size: 36px;
            font-weight: 900;
        }
        
        .team-name {
            font-size: 22px;
            font-weight: 700;
            color: #2d3748;
            margin: 10px 0;
        }
        
        .team-label {
            display: inline-block;
            background: #e3f2fd;
            color: #1976d2;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .score-input {
            width: 120px;
            height: 120px;
            font-size: 56px;
            font-weight: 900;
            text-align: center;
            border: 3px solid #e0e0e0;
            border-radius: 12px;
            background: #f9fafb;
            margin-top: 20px;
        }
        
        .score-input:focus {
            outline: none;
            border-color: #ff5722;
            background: white;
            box-shadow: 0 0 0 4px rgba(255, 87, 34, 0.1);
        }
        
        .vs-separator {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .vs-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #ff5722;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 900;
            box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
        }
        
        .status-section, .notes-section {
            background: rgba(255, 255, 255, 0.95);
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 15px;
            font-size: 16px;
        }
        
        .status-options {
            display: flex;
            gap: 15px;
        }
        
        .status-radio {
            cursor: pointer;
            flex: 1;
        }
        
        .status-radio input {
            display: none;
        }
        
        .status-badge {
            display: block;
            padding: 15px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            border: 2px solid #e0e0e0;
            text-align: center;
            transition: all 0.3s;
        }
        
        .status-radio input:checked + .status-badge {
            transform: scale(1.05);
        }
        
        .status-radio input:checked + .status-badge.scheduled {
            background: #e3f2fd;
            border-color: #1976d2;
            color: #1976d2;
        }
        
        .status-radio input:checked + .status-badge.live {
            background: #d4edda;
            border-color: #28a745;
            color: #28a745;
        }
        
        .status-radio input:checked + .status-badge.finished {
            background: #f8f9fa;
            border-color: #6c757d;
            color: #6c757d;
        }
        
        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }
        
        .btn {
            padding: 14px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }
        
        .btn-secondary {
            background: #e0e0e0;
            color: #2d3748;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #ff5722 0%, #e64a19 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 87, 34, 0.4);
        }
        
        @media (max-width: 768px) {
            .scoreboard {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .status-options {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">⚽ ACTUALIZAR RESULTADO</h1>
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>→</span>
                <a href="{{ route('admin.games.index') }}">Partidos</a>
                <span>→</span>
                <span>Actualizar Resultado</span>
            </div>
        </div>

        <form action="{{ route('admin.games.update', $game->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Información del partido -->
            <div class="game-info-card">
                <div class="league-info">
                    🏆 {{ $game->round->season->league->name ?? 'Liga' }} - {{ $game->round->season->name ?? 'Temporada' }}
                </div>
                <div class="jornada-info">
                    📅 {{ $game->round->name ?? 'Jornada' }}
                </div>
                <div class="game-date">
                    🗓️ {{ \Carbon\Carbon::parse($game->date)->format('d/m/Y H:i') }}
                </div>
            </div>

            <!-- Marcador -->
            <div class="scoreboard">
                <!-- Equipo Local -->
                <div class="team-section">
                    <div class="team-logo">
                        @if($game->homeTeam->logo)
                            <img src="{{ asset('storage/' . $game->homeTeam->logo) }}" alt="{{ $game->homeTeam->name }}">
                        @else
                            <div class="logo-placeholder">{{ substr($game->homeTeam->short_name, 0, 2) }}</div>
                        @endif
                    </div>
                    <h2 class="team-name">{{ $game->homeTeam->name }}</h2>
                    <span class="team-label">LOCAL</span>
                    <input 
                        type="number" 
                        name="home_score" 
                        class="score-input" 
                        value="{{ old('home_score', $game->home_score ?? 0) }}"
                        min="0"
                        max="99"
                        required
                    >
                </div>

                <!-- VS -->
                <div class="vs-separator">
                    <div class="vs-circle">VS</div>
                </div>

                <!-- Equipo Visitante -->
                <div class="team-section">
                    <div class="team-logo">
                        @if($game->awayTeam->logo)
                            <img src="{{ asset('storage/' . $game->awayTeam->logo) }}" alt="{{ $game->awayTeam->name }}">
                        @else
                            <div class="logo-placeholder">{{ substr($game->awayTeam->short_name, 0, 2) }}</div>
                        @endif
                    </div>
                    <h2 class="team-name">{{ $game->awayTeam->name }}</h2>
                    <span class="team-label">VISITANTE</span>
                    <input 
                        type="number" 
                        name="away_score" 
                        class="score-input" 
                        value="{{ old('away_score', $game->away_score ?? 0) }}"
                        min="0"
                        max="99"
                        required
                    >
                </div>
            </div>

            <!-- Estado del partido -->
            <div class="status-section">
                <label class="form-label">📊 Estado del Partido:</label>
                <div class="status-options">
                    <label class="status-radio">
                        <input type="radio" name="status" value="scheduled" 
                               {{ old('status', $game->status) == 'scheduled' ? 'checked' : '' }}>
                        <span class="status-badge scheduled">🔵 Programado</span>
                    </label>
                    <label class="status-radio">
                        <input type="radio" name="status" value="in_progress" 
                               {{ old('status', $game->status) == 'in_progress' ? 'checked' : '' }}>
                        <span class="status-badge live">🟢 En Vivo</span>
                    </label>
                    <label class="status-radio">
                        <input type="radio" name="status" value="finished" 
                               {{ old('status', $game->status) == 'finished' ? 'checked' : '' }}>
                        <span class="status-badge finished">⚪ Finalizado</span>
                    </label>
                </div>
            </div>

            <!-- Notas -->
            <div class="notes-section">
                <label class="form-label">📝 Notas del Partido (Opcional):</label>
                <textarea 
                    name="notes" 
                    class="form-control" 
                    rows="3"
                    placeholder="Ej: Gran remontada en el último cuarto, lesión del QB..."
                >{{ old('notes', $game->notes) }}</textarea>
            </div>

            <!-- Botones -->
            <div class="form-actions">
                <a href="{{ route('admin.games.index') }}" class="btn btn-secondary">
                    ← Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    💾 Guardar Resultado
                </button>
            </div>
        </form>
    </div>
</body>
</html>