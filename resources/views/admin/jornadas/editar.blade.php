<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Jornada - Admin</title>
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

        .form-help {
            font-size: 13px;
            color: var(--gray-600);
            margin-top: 5px;
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
            .form-actions { flex-direction: column; }
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
                <a href="{{ route('admin.jornadas.index') }}">Jornadas</a>
                <span>→</span>
                <span>Editar</span>
            </div>

            <div class="page-header">
                <h1 class="page-title">✏️ Editar Jornada</h1>
            </div>

            <div class="form-card">
                <form action="{{ route('admin.jornadas.update', $jornada->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Temporada *</label>
                        <select name="season_id" class="form-control" required>
                            <option value="">Seleccionar...</option>
                            @foreach($seasons as $season)
                                <option value="{{ $season->id }}" {{ old('season_id', $jornada->season_id) == $season->id ? 'selected' : '' }}>
                                    {{ $season->name }} - {{ $season->league->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Número de Jornada *</label>
                        <input 
                            type="number" 
                            name="number" 
                            class="form-control" 
                            value="{{ old('number', $jornada->number) }}"
                            min="1"
                            required
                        >
                        <div class="form-help">Número consecutivo de la jornada</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nombre de la Jornada</label>
                        <input 
                            type="text" 
                            name="name" 
                            class="form-control" 
                            value="{{ old('name', $jornada->name) }}"
                            placeholder="Ej: Jornada 1, Semifinal, Final"
                        >
                        <div class="form-help">Si se deja vacío, se generará como "Jornada X"</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Fecha de la Jornada *</label>
                        <input 
                            type="date" 
                            name="date" 
                            class="form-control" 
                            value="{{ old('date', $jornada->date) }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input 
                                type="checkbox" 
                                name="is_completed" 
                                id="is_completed" 
                                value="1"
                                {{ old('is_completed', $jornada->is_completed) ? 'checked' : '' }}
                            >
                            <label for="is_completed">Marcar como completada</label>
                        </div>
                        <div class="form-help" style="margin-left: 30px;">
                            Solo marca esto si todos los partidos de esta jornada ya finalizaron
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.jornadas.index') }}" class="btn btn-secondary">← Cancelar</a>
                        <button type="submit" class="btn btn-primary">💾 Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>