<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Temporada - Admin</title>
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
            --warning: #f59e0b;
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
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: var(--gray-600);
            font-size: 16px;
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
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 2px solid var(--error);
            color: #991b1b;
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            border: 2px solid var(--warning);
            color: #92400e;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-label span {
            color: var(--error);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e5e5e5;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
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

        .checkbox-group input {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .checkbox-group label {
            cursor: pointer;
            font-weight: 600;
            user-select: none;
        }

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
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--success), #059669);
            color: white;
            flex: 1;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-secondary {
            background: var(--gray-600);
            color: white;
        }

        .btn-secondary:hover {
            background: #333;
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
                <a href="{{ route('admin.seasons.index') }}">Temporadas</a>
                <span>→</span>
                <span>Editar</span>
            </div>

            <div class="page-header">
                <h1 class="page-title">✏️ Editar Temporada</h1>
                <p class="page-subtitle">{{ $season->name }}</p>
            </div>

            @if($errors->any())
                <div class="alert alert-error">
                    <span>⚠️</span>
                    <div>
                        <strong>Por favor corrige los siguientes errores:</strong>
                        <ul style="margin-top: 8px; margin-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if($season->games()->exists())
                <div class="alert alert-warning">
                    <span>⚠️</span>
                    <div>
                        <strong>Atención:</strong> Esta temporada ya tiene partidos registrados. 
                        Cambiar fechas puede afectar la coherencia del torneo.
                    </div>
                </div>
            @endif

            <div class="form-card">
                <form action="{{ route('admin.seasons.update', $season->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Liga -->
                    <div class="form-group">
                        <label class="form-label">Liga <span>*</span></label>
                        <select name="league_id" class="form-control" required>
                            <option value="">Seleccionar liga...</option>
                            @foreach($leagues as $league)
                                <option value="{{ $league->id }}" {{ old('league_id', $season->league_id) == $league->id ? 'selected' : '' }}>
                                    {{ $league->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-help">Liga a la que pertenece esta temporada</div>
                    </div>

                    <!-- Nombre de la Temporada -->
                    <div class="form-group">
                        <label class="form-label">Nombre de la Temporada <span>*</span></label>
                        <input 
                            type="text" 
                            name="name" 
                            class="form-control" 
                            value="{{ old('name', $season->name) }}"
                            placeholder="Ej: Apertura 2026, Clausura 2026"
                            required
                        >
                        <div class="form-help">Nombre descriptivo del torneo o temporada</div>
                    </div>

                    <!-- Fechas -->
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                        <div class="form-group">
                            <label class="form-label">Fecha de Inicio <span>*</span></label>
                            <input 
                                type="date" 
                                name="start_date" 
                                class="form-control" 
                                value="{{ old('start_date', $season->start_date) }}"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label">Fecha de Fin <span>*</span></label>
                            <input 
                                type="date" 
                                name="end_date" 
                                class="form-control" 
                                value="{{ old('end_date', $season->end_date) }}"
                                required
                            >
                        </div>
                    </div>

                    <!-- Temporada Activa -->
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input 
                                type="checkbox" 
                                name="is_active" 
                                id="is_active" 
                                value="1"
                                {{ old('is_active', $season->is_active) ? 'checked' : '' }}
                            >
                            <label for="is_active">Marcar como temporada activa</label>
                        </div>
                        <div class="form-help" style="margin-left: 30px;">
                            ⚠️ Solo puede haber una temporada activa por liga. Si marcas esta como activa, las demás se desactivarán.
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.seasons.index') }}" class="btn btn-secondary">
                            ← Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            💾 Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>