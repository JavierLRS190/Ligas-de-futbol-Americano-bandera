<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Mi Equipo - Coach</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ff6b35;
            --secondary: #1a472a;
            --success: #10b981;
            --error: #ef4444;
            --info: #3b82f6;
            --gray-100: #f5f5f5;
            --gray-600: #757575;
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
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: var(--gray-600);
            font-size: 15px;
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

        .alert-info {
            background: rgba(59, 157, 234, 0.1);
            border: 2px solid var(--info);
            color: #1e40af;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group { margin-bottom: 25px; }
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

        .logo-upload-area {
            border: 2px dashed #e5e5e5;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
        }

        .logo-upload-area:hover {
            border-color: var(--info);
            background: rgba(59, 157, 234, 0.05);
        }

        .logo-preview {
            width: 120px;
            height: 120px;
            border-radius: 16px;
            margin: 0 auto 15px;
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            overflow: hidden;
        }

        .logo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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

        .btn-primary { background: var(--success); color: white; flex: 1; }
        .btn-secondary { background: var(--gray-600); color: white; }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #e5e5e5;
        }
    </style>
</head>
<body>
    @include('components.coach-sidebar')

    <div class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('coach.dashboard') }}">Dashboard</a>
                <span>→</span>
                <a href="{{ route('coach.team.show') }}">Mi Equipo</a>
                <span>→</span>
                <span>Editar</span>
            </div>

            <div class="page-header">
                <h1 class="page-title">✏️ Editar Mi Equipo</h1>
                <p class="page-subtitle">Actualiza la información de tu equipo</p>
            </div>

            <div class="form-card">
                <div class="alert alert-info">
                    <span>ℹ️</span>
                    <div>
                        <strong>Nota:</strong> Solo puedes editar cierta información de tu equipo. 
                        Para cambios mayores contacta al administrador de la liga.
                    </div>
                </div>

                <form action="{{ route('coach.team.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Logo del Equipo</label>
                        <div class="logo-upload-area" onclick="document.getElementById('logo-input').click()">
                            <div class="logo-preview" id="logo-preview">
                                @if($team->logo)
                                    <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}">
                                @else
                                    {{ strtoupper(substr($team->short_name, 0, 2)) }}
                                @endif
                            </div>
                            <div style="font-size: 48px; opacity: 0.3;">📸</div>
                            <div style="font-size: 14px; color: var(--gray-600); font-weight: 600;">Click para cambiar el logo</div>
                        </div>
                        <input type="file" name="logo" id="logo-input" style="display: none;" accept="image/*" onchange="previewLogo(this)">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nombre del Equipo</label>
                        <input type="text" class="form-control" value="{{ $team->name }}" disabled style="background: #f9fafb;">
                        <div class="form-help">⚠️ Solo el administrador puede cambiar el nombre</div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Ciudad</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city', $team->city) }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Estadio</label>
                            <input type="text" name="stadium" class="form-control" value="{{ old('stadium', $team->stadium) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Descripción del Equipo</label>
                        <textarea name="description" class="form-control" rows="6">{{ old('description', $team->description) }}</textarea>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('coach.team.show') }}" class="btn btn-secondary">← Cancelar</a>
                        <button type="submit" class="btn btn-primary">💾 Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewLogo(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('logo-preview').innerHTML = '<img src="' + e.target.result + '" style="width: 100%; height: 100%; object-fit: cover;">';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>