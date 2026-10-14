<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Jugador - Admin</title>
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
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 968px) {
            .main-content { margin-left: 0; }
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

        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

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

        .form-grid {
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

        .photo-preview {
            margin-top: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .photo-preview img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--info);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            background: var(--gray-100);
            border-radius: 8px;
        }

        .checkbox-group input { width: 20px; height: 20px; }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #e5e5e5;
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

        @media (max-width: 768px) {
            .form-grid { grid-template-columns: 1fr; }
            .main-content { padding: 20px 15px; }
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
                <a href="{{ route('admin.players.index') }}">Jugadores</a>
                <span>→</span>
                <span>Editar Jugador</span>
            </div>

            <div class="page-header">
                <h1 class="page-title">✏️ Editar Jugador</h1>
            </div>

            <div class="form-card">
                <form action="{{ route('admin.players.update', $player->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <!-- Equipo -->
                        <div class="form-group">
                            <label class="form-label">Equipo *</label>
                            <select name="team_id" class="form-control" required>
                                <option value="">Seleccionar...</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ old('team_id', $player->team_id) == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Número de Jersey *</label>
                            <input type="number" name="jersey_number" class="form-control" value="{{ old('jersey_number', $player->jersey_number) }}" min="0" max="99" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nombre *</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $player->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Apellido *</label>
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $player->last_name) }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Posición *</label>
                            <select name="position" class="form-control" required>
                                <option value="">Seleccionar...</option>
                                <option value="QB" {{ old('position', $player->position) == 'QB' ? 'selected' : '' }}>QB - Quarterback</option>
                                <option value="RB" {{ old('position', $player->position) == 'RB' ? 'selected' : '' }}>RB - Running Back</option>
                                <option value="WR" {{ old('position', $player->position) == 'WR' ? 'selected' : '' }}>WR - Wide Receiver</option>
                                <option value="TE" {{ old('position', $player->position) == 'TE' ? 'selected' : '' }}>TE - Tight End</option>
                                <option value="OL" {{ old('position', $player->position) == 'OL' ? 'selected' : '' }}>OL - Offensive Line</option>
                                <option value="DL" {{ old('position', $player->position) == 'DL' ? 'selected' : '' }}>DL - Defensive Line</option>
                                <option value="LB" {{ old('position', $player->position) == 'LB' ? 'selected' : '' }}>LB - Linebacker</option>
                                <option value="CB" {{ old('position', $player->position) == 'CB' ? 'selected' : '' }}>CB - Cornerback</option>
                                <option value="S" {{ old('position', $player->position) == 'S' ? 'selected' : '' }}>S - Safety</option>
                                <option value="K" {{ old('position', $player->position) == 'K' ? 'selected' : '' }}>K - Kicker</option>
                                <option value="P" {{ old('position', $player->position) == 'P' ? 'selected' : '' }}>P - Punter</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Fecha de Nacimiento</label>
                            <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $player->birth_date) }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Altura (cm)</label>
                            <input type="number" name="height" class="form-control" value="{{ old('height', $player->height) }}" step="0.01">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Peso (kg)</label>
                            <input type="number" name="weight" class="form-control" value="{{ old('weight', $player->weight) }}" step="0.01">
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label">Foto del Jugador</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                            @if($player->photo)
                                <div class="photo-preview">
                                    <img src="{{ asset('storage/' . $player->photo) }}" alt="{{ $player->name }}">
                                    <span>Foto actual</span>
                                </div>
                            @endif
                        </div>

                        <div class="form-group full-width">
                            <div class="checkbox-group">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $player->is_active) ? 'checked' : '' }}>
                                <label for="is_active">Jugador Activo</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.players.index') }}" class="btn btn-secondary">← Cancelar</a>
                        <button type="submit" class="btn btn-primary">💾 Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>