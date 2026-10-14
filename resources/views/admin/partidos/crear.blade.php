<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Partido - Admin</title>
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

        .container { max-width: 800px; margin: 0 auto; }

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

        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.1);
            border: 2px solid var(--info);
            color: #1e40af;
        }

        .form-group { margin-bottom: 25px; }

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

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .btn {
            padding: 14px 30px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            border: none;
            text-decoration: none;
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
                <span>Crear</span>
            </div>

            <div class="page-header">
                <h1 class="page-title">⚽ Crear Nuevo Partido</h1>
            </div>

            <div class="form-card">
                <div class="alert alert-info">
                    💡 <strong>Tip:</strong> Para generar múltiples partidos automáticamente, usa "Iniciar Torneo" desde la temporada.
                </div>

                <form action="{{ route('admin.games.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Jornada *</label>
                        <select name="jornada_id" class="form-control" required>
                            <option value="">Seleccionar...</option>
                            @foreach($jornadas as $jornada)
                                <option value="{{ $jornada->id }}">
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
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Equipo Visitante *</label>
                            <select name="away_team_id" class="form-control" required>
                                <option value="">Seleccionar...</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Fecha *</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Hora *</label>
                            <input type="time" name="time" class="form-control" value="18:00" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Ubicación</label>
                        <input type="text" name="location" class="form-control" placeholder="Estadio...">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Estado</label>
                        <select name="status" class="form-control">
                            <option value="scheduled">Programado</option>
                            <option value="in_progress">En Progreso</option>
                            <option value="finished">Finalizado</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.games.index') }}" class="btn btn-secondary">← Cancelar</a>
                        <button type="submit" class="btn btn-primary">✓ Crear Partido</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
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