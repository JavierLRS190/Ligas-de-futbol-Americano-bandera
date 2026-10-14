<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Jugador - Flag Football</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            --purple: #8b5cf6;
            --purple-dark: #7c3aed;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--secondary) 0%, var(--bg-dark) 100%);
            min-height: 100vh;
            color: var(--text-dark);
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: repeating-linear-gradient(
                0deg, transparent, transparent 50px,
                rgba(255,255,255,0.02) 50px, rgba(255,255,255,0.02) 100px
            );
            pointer-events: none;
            z-index: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            position: relative;
            z-index: 1;
        }

        /* Header */
        .page-header {
            background: rgba(255,255,255,0.97);
            border-radius: 20px;
            padding: 30px 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            border-left: 6px solid var(--info);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '✏️';
            position: absolute;
            right: 30px; top: 50%;
            transform: translateY(-50%);
            font-size: 80px;
            opacity: 0.1;
        }

        .page-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            color: var(--secondary);
            letter-spacing: 2px;
            margin-bottom: 8px;
        }

        .page-header p { color: var(--gray-600); font-size: 16px; }

        .team-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
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
            margin-top: 15px;
            font-size: 14px;
        }

        .breadcrumb a {
            color: var(--info);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .breadcrumb a:hover { color: #2563eb; }
        .breadcrumb span { color: var(--gray-600); }

        /* Tabs */
        .tabs-wrapper {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
            background: rgba(255,255,255,0.1);
            padding: 8px;
            border-radius: 16px;
        }

        .tab-btn {
            flex: 1;
            padding: 14px 20px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: transparent;
            color: rgba(255,255,255,0.7);
            letter-spacing: 0.5px;
        }

        .tab-btn.active {
            background: rgba(255,255,255,0.97);
            color: var(--text-dark);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .tab-btn.active.tab-player { color: var(--info); }
        .tab-btn.active.tab-user { color: var(--purple); }

        .tab-btn:hover:not(.active) {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        /* Form Card */
        .form-card {
            background: rgba(255,255,255,0.97);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        /* Tab Panels */
        .tab-panel { display: none; }
        .tab-panel.active { display: block; }

        .form-section { margin-bottom: 40px; }
        .form-section:last-child { margin-bottom: 0; }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            color: var(--secondary);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid var(--info);
            display: inline-block;
            letter-spacing: 1px;
        }

        .section-title.user-title {
            border-bottom-color: var(--purple);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .form-group { display: flex; flex-direction: column; }
        .form-group.full-width { grid-column: 1 / -1; }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .form-label .required { color: var(--error); font-size: 18px; }

        .form-input,
        .form-select {
            padding: 14px 18px;
            border: 2px solid var(--gray-300);
            border-radius: 12px;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--info);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }

        .form-input.user-field:focus,
        .form-select.user-field:focus {
            border-color: var(--purple);
            box-shadow: 0 0 0 3px rgba(139,92,246,0.1);
        }

        .form-input.error,
        .form-select.error { border-color: var(--error); }

        .error-message {
            color: var(--error);
            font-size: 13px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .help-text {
            font-size: 13px;
            color: var(--gray-600);
            margin-top: 6px;
        }

        /* Password strength */
        .password-wrapper { position: relative; }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            color: var(--gray-600);
            padding: 4px;
            transition: color 0.3s;
        }

        .password-toggle:hover { color: var(--purple); }

        .password-strength {
            margin-top: 8px;
            display: none;
        }

        .password-strength.visible { display: block; }

        .strength-bar {
            height: 4px;
            border-radius: 2px;
            background: var(--gray-200);
            overflow: hidden;
            margin-bottom: 5px;
        }

        .strength-fill {
            height: 100%;
            border-radius: 2px;
            transition: all 0.3s ease;
            width: 0%;
        }

        .strength-fill.weak { background: var(--error); width: 33%; }
        .strength-fill.medium { background: var(--accent); width: 66%; }
        .strength-fill.strong { background: var(--success); width: 100%; }

        .strength-text {
            font-size: 12px;
            font-weight: 600;
        }

        .strength-text.weak { color: var(--error); }
        .strength-text.medium { color: #d97706; }
        .strength-text.strong { color: var(--success); }

        /* Position Selector */
        .position-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 10px;
        }

        .position-option { position: relative; }

        .position-radio {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .position-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 15px 10px;
            background: var(--gray-100);
            border: 2px solid var(--gray-300);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
        }

        .position-label:hover {
            background: rgba(59,130,246,0.05);
            border-color: var(--info);
        }

        .position-radio:checked + .position-label {
            background: linear-gradient(135deg, var(--info), #2563eb);
            color: white;
            border-color: #2563eb;
            transform: scale(1.05);
        }

        .position-abbr {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .position-name { font-size: 11px; font-weight: 600; }

        /* File Upload */
        .current-photo {
            margin-bottom: 20px;
            padding: 20px;
            background: var(--gray-100);
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .current-photo-image {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            object-fit: cover;
            border: 3px solid var(--gray-300);
        }

        .current-photo-placeholder {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--info), #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: 700;
            border: 3px solid var(--gray-300);
            flex-shrink: 0;
        }

        .current-photo-placeholder.purple-avatar {
            background: linear-gradient(135deg, var(--purple), var(--purple-dark));
        }

        .current-photo-info { flex: 1; }

        .current-photo-label {
            font-size: 13px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .current-photo-text {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 15px;
        }

        .file-upload-area {
            border: 3px dashed var(--gray-300);
            border-radius: 12px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: var(--gray-100);
        }

        .file-upload-area:hover,
        .file-upload-area.dragover {
            border-color: var(--info);
            background: rgba(59,130,246,0.05);
        }

        .file-upload-area.purple-upload:hover,
        .file-upload-area.purple-upload.dragover {
            border-color: var(--purple);
            background: rgba(139,92,246,0.05);
        }

        .file-upload-icon { font-size: 48px; margin-bottom: 10px; }

        .file-upload-text { color: var(--gray-600); font-size: 14px; }
        .file-upload-text strong { color: var(--info); font-weight: 600; }
        .file-upload-text strong.purple { color: var(--purple); }

        .file-input { display: none; }

        .file-preview {
            margin-top: 15px;
            padding: 15px;
            background: var(--gray-100);
            border-radius: 10px;
            display: none;
            align-items: center;
            gap: 15px;
        }

        .file-preview.active { display: flex; }

        .preview-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--gray-300);
        }

        .preview-info { flex: 1; }
        .preview-name { font-weight: 600; color: var(--text-dark); margin-bottom: 5px; }
        .preview-size { font-size: 13px; color: var(--gray-600); }

        .remove-file {
            background: var(--error);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .remove-file:hover { background: #dc2626; }

        /* Checkbox */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            background: var(--gray-100);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .checkbox-wrapper:hover { background: rgba(59,130,246,0.05); }
        .checkbox-wrapper.purple-check:hover { background: rgba(139,92,246,0.05); }

        .checkbox-input {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: var(--info);
        }

        .checkbox-input.purple-accent { accent-color: var(--purple); }
        .checkbox-label { font-weight: 500; color: var(--text-dark); cursor: pointer; }

        /* Info Box */
        .info-box {
            background: linear-gradient(135deg, rgba(59,130,246,0.1), rgba(37,99,235,0.05));
            border: 2px solid rgba(59,130,246,0.3);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .info-box.purple-box {
            background: linear-gradient(135deg, rgba(139,92,246,0.1), rgba(124,58,237,0.05));
            border-color: rgba(139,92,246,0.3);
        }

        .info-icon { font-size: 32px; }

        .info-content h3 { font-weight: 700; color: var(--text-dark); margin-bottom: 5px; font-size: 16px; }
        .info-content p { color: var(--gray-600); font-size: 14px; }

        /* User panel header badge */
        .user-no-account {
            background: linear-gradient(135deg, rgba(239,68,68,0.1), rgba(220,38,38,0.05));
            border: 2px solid rgba(239,68,68,0.3);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-no-account p { color: #991b1b; font-size: 14px; font-weight: 500; }

        /* Divider */
        .section-divider {
            border: none;
            border-top: 2px dashed var(--gray-200);
            margin: 35px 0;
        }

        /* Buttons */
        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid var(--gray-200);
        }

        .btn {
            padding: 15px 35px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Inter', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--info) 0%, #2563eb 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(59,130,246,0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59,130,246,0.4);
        }

        .btn-secondary {
            background: var(--gray-200);
            color: var(--text-dark);
        }

        .btn-secondary:hover { background: var(--gray-300); }
        .btn-primary:active, .btn-secondary:active { transform: translateY(0); }

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
            background: rgba(16,185,129,0.1);
            border: 2px solid var(--success);
            color: #047857;
        }

        .alert-error {
            background: rgba(239,68,68,0.1);
            border: 2px solid var(--error);
            color: #991b1b;
        }

        /* Loading */
        .btn.loading {
            pointer-events: none;
            opacity: 0.7;
            position: relative;
        }

        .btn.loading::after {
            content: '';
            position: absolute;
            width: 16px; height: 16px;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
            right: 15px;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* Responsive */
        @media (max-width: 768px) {
            .container { padding: 20px 15px; }
            .page-header { padding: 25px 20px; }
            .page-header h1 { font-size: 36px; }
            .form-card { padding: 25px 20px; }
            .form-grid { grid-template-columns: 1fr; }
            .position-grid { grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); }
            .form-actions { flex-direction: column-reverse; }
            .btn { width: 100%; justify-content: center; }
            .tabs-wrapper { flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <h1>Editar Jugador</h1>
            <p>Actualiza la información del jugador y su cuenta de usuario</p>
            <div class="team-badge">
                <span>🏆</span>
                <span>{{ $team->name }}</span>
            </div>
            <div class="breadcrumb">
                <a href="{{ route('coach.dashboard') }}">Dashboard</a>
                <span>→</span>
                <a href="{{ route('coach.players.index') }}">Jugadores</a>
                <span>→</span>
                <span>Editar: {{ $player->name }} {{ $player->last_name }}</span>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs-wrapper">
            <button class="tab-btn tab-player active" onclick="switchTab('player', this)">
                🏈 Datos del Jugador
            </button>
            <button class="tab-btn tab-user" onclick="switchTab('user', this)">
                👤 Cuenta de Usuario
            </button>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            @if(session('success'))
                <div class="alert alert-success">
                    <span>✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <span>⚠</span>
                    <span>Por favor corrige los errores en el formulario</span>
                </div>
            @endif

            <form action="{{ route('coach.players.update', $player->id) }}" method="POST" enctype="multipart/form-data" id="playerForm">
                @csrf
                @method('PUT')

                {{-- ============================================ --}}
                {{-- TAB: DATOS DEL JUGADOR --}}
                {{-- ============================================ --}}
                <div class="tab-panel active" id="panel-player">

                    <div class="info-box">
                        <div class="info-icon">ℹ️</div>
                        <div class="info-content">
                            <h3>Editando: {{ $player->name }} {{ $player->last_name }} — #{{ $player->jersey_number }}</h3>
                            <p>Actualiza los datos deportivos y físicos de este jugador</p>
                        </div>
                    </div>

                    <!-- Información Personal -->
                    <div class="form-section">
                        <h2 class="section-title">Información Personal</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Nombre <span class="required">*</span></label>
                                <input type="text" name="name"
                                    class="form-input @error('name') error @enderror"
                                    value="{{ old('name', $player->name) }}"
                                    placeholder="Ej: Juan" required>
                                @error('name')
                                    <span class="error-message">⚠ {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Apellido <span class="required">*</span></label>
                                <input type="text" name="last_name"
                                    class="form-input @error('last_name') error @enderror"
                                    value="{{ old('last_name', $player->last_name) }}"
                                    placeholder="Ej: Pérez García" required>
                                @error('last_name')
                                    <span class="error-message">⚠ {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Fecha de Nacimiento</label>
                                <input type="date" name="birth_date"
                                    class="form-input @error('birth_date') error @enderror"
                                    value="{{ old('birth_date', $player->birth_date?->format('Y-m-d')) }}">
                                @error('birth_date')
                                    <span class="error-message">⚠ {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Número de Jersey <span class="required">*</span></label>
                                <input type="number" name="jersey_number"
                                    class="form-input @error('jersey_number') error @enderror"
                                    value="{{ old('jersey_number', $player->jersey_number) }}"
                                    placeholder="0-99" min="0" max="99" required>
                                @error('jersey_number')
                                    <span class="error-message">⚠ {{ $message }}</span>
                                @enderror
                                <span class="help-text">Número único en tu equipo (0-99)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Posición -->
                    <div class="form-section">
                        <h2 class="section-title">Posición <span class="required" style="color:var(--error);font-size:24px;">*</span></h2>
                        <div class="position-grid">
                            @foreach([
                                'QB' => 'Quarterback',
                                'RB' => 'Running Back',
                                'WR' => 'Wide Receiver',
                                'TE' => 'Tight End',
                                'OL' => 'Offensive Line',
                                'DL' => 'Defensive Line',
                                'LB' => 'Linebacker',
                                'CB' => 'Cornerback',
                                'S'  => 'Safety',
                                'K'  => 'Kicker',
                                'P'  => 'Punter',
                            ] as $abbr => $fullName)
                                <div class="position-option">
                                    <input type="radio" name="position" value="{{ $abbr }}"
                                        id="pos_{{ strtolower($abbr) }}" class="position-radio"
                                        {{ old('position', $player->position) == $abbr ? 'checked' : '' }}
                                        {{ $abbr === 'QB' ? 'required' : '' }}>
                                    <label for="pos_{{ strtolower($abbr) }}" class="position-label">
                                        <span class="position-abbr">{{ $abbr }}</span>
                                        <span class="position-name">{{ $fullName }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('position')
                            <span class="error-message" style="margin-top:10px;">⚠ {{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Información Física -->
                    <div class="form-section">
                        <h2 class="section-title">Información Física</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Altura (cm)</label>
                                <input type="number" name="height"
                                    class="form-input @error('height') error @enderror"
                                    value="{{ old('height', $player->height) }}"
                                    placeholder="Ej: 180" min="0" step="0.1">
                                @error('height')
                                    <span class="error-message">⚠ {{ $message }}</span>
                                @enderror
                                <span class="help-text">En centímetros</span>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Peso (kg)</label>
                                <input type="number" name="weight"
                                    class="form-input @error('weight') error @enderror"
                                    value="{{ old('weight', $player->weight) }}"
                                    placeholder="Ej: 75" min="0" step="0.1">
                                @error('weight')
                                    <span class="error-message">⚠ {{ $message }}</span>
                                @enderror
                                <span class="help-text">En kilogramos</span>
                            </div>
                        </div>
                    </div>

                    <!-- Foto del Jugador -->
                    <div class="form-section">
                        <h2 class="section-title">Foto del Jugador</h2>
                        <div class="form-group">
                            <div class="current-photo">
                                @if($player->photo)
                                    <img src="{{ asset('storage/' . $player->photo) }}" alt="{{ $player->name }}" class="current-photo-image">
                                @else
                                    <div class="current-photo-placeholder">
                                        {{ strtoupper(substr($player->name, 0, 1)) }}{{ strtoupper(substr($player->last_name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="current-photo-info">
                                    <div class="current-photo-label">Foto Actual del Jugador</div>
                                    <div class="current-photo-text">{{ $player->photo ? basename($player->photo) : 'Sin foto' }}</div>
                                </div>
                            </div>

                            <div class="file-upload-area" id="photoUploadArea">
                                <div class="file-upload-icon">📤</div>
                                <div class="file-upload-text">
                                    <strong>Click para cambiar la foto</strong> o arrastra una nueva aquí<br>
                                    <small>JPG, PNG (máx. 2MB) — Deja vacío para mantener la actual</small>
                                </div>
                            </div>
                            <input type="file" name="photo" class="file-input" id="photoInput" accept="image/jpeg,image/png,image/jpg">
                            <div class="file-preview" id="photoPreview">
                                <img src="" alt="Preview" class="preview-image" id="photoPreviewImg">
                                <div class="preview-info">
                                    <div class="preview-name" id="photoPreviewName"></div>
                                    <div class="preview-size" id="photoPreviewSize"></div>
                                </div>
                                <button type="button" class="remove-file" onclick="removeFile('photo')">Eliminar</button>
                            </div>
                            @error('photo')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Estado del Jugador -->
                    <div class="form-section">
                        <h2 class="section-title">Estado del Jugador</h2>
                        <label class="checkbox-wrapper">
                            <input type="checkbox" name="is_active" id="is_active"
                                class="checkbox-input" value="1"
                                {{ old('is_active', $player->is_active) ? 'checked' : '' }}>
                            <span class="checkbox-label">Jugador Activo (puede participar en partidos)</span>
                        </label>
                    </div>

                </div>{{-- /panel-player --}}

                {{-- ============================================ --}}
                {{-- TAB: CUENTA DE USUARIO --}}
                {{-- ============================================ --}}
                <div class="tab-panel" id="panel-user">

                    @if($player->user_id && $player->user)
                        <div class="info-box purple-box">
                            <div class="info-icon">👤</div>
                            <div class="info-content">
                                <h3>Usuario: {{ $player->user->name }} — {{ $player->user->email }}</h3>
                                <p>Actualiza las credenciales y datos de acceso de este jugador</p>
                            </div>
                        </div>

                        <!-- Información de la Cuenta -->
                        <div class="form-section">
                            <h2 class="section-title user-title">Datos de la Cuenta</h2>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Nombre de Usuario <span class="required">*</span></label>
                                    <input type="text" name="user_name"
                                        class="form-input user-field @error('user_name') error @enderror"
                                        value="{{ old('user_name', $player->user->name) }}"
                                        placeholder="Nombre en el sistema" required>
                                    @error('user_name')
                                        <span class="error-message">⚠ {{ $message }}</span>
                                    @enderror
                                    <span class="help-text">Nombre que aparece en el sistema</span>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Correo Electrónico <span class="required">*</span></label>
                                    <input type="email" name="user_email"
                                        class="form-input user-field @error('user_email') error @enderror"
                                        value="{{ old('user_email', $player->user->email) }}"
                                        placeholder="correo@ejemplo.com" required>
                                    @error('user_email')
                                        <span class="error-message">⚠ {{ $message }}</span>
                                    @enderror
                                    <span class="help-text">Se usa para iniciar sesión</span>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Teléfono</label>
                                    <input type="tel" name="user_phone"
                                        class="form-input user-field @error('user_phone') error @enderror"
                                        value="{{ old('user_phone', $player->user->phone) }}"
                                        placeholder="Ej: +52 221 123 4567">
                                    @error('user_phone')
                                        <span class="error-message">⚠ {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="section-divider">

                        <!-- Cambiar Contraseña -->
                        <div class="form-section">
                            <h2 class="section-title user-title">Cambiar Contraseña</h2>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Nueva Contraseña</label>
                                    <div class="password-wrapper">
                                        <input type="password" name="user_password" id="userPassword"
                                            class="form-input user-field @error('user_password') error @enderror"
                                            placeholder="Deja vacío para no cambiar"
                                            autocomplete="new-password"
                                            style="padding-right: 50px;">
                                        <button type="button" class="password-toggle" onclick="togglePassword('userPassword', this)">👁️</button>
                                    </div>
                                    <div class="password-strength" id="passwordStrength">
                                        <div class="strength-bar">
                                            <div class="strength-fill" id="strengthFill"></div>
                                        </div>
                                        <span class="strength-text" id="strengthText"></span>
                                    </div>
                                    @error('user_password')
                                        <span class="error-message">⚠ {{ $message }}</span>
                                    @enderror
                                    <span class="help-text">Mínimo 8 caracteres. Deja vacío para mantener la contraseña actual.</span>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Confirmar Contraseña</label>
                                    <div class="password-wrapper">
                                        <input type="password" name="user_password_confirmation" id="userPasswordConfirm"
                                            class="form-input user-field"
                                            placeholder="Repite la nueva contraseña"
                                            autocomplete="new-password"
                                            style="padding-right: 50px;">
                                        <button type="button" class="password-toggle" onclick="togglePassword('userPasswordConfirm', this)">👁️</button>
                                    </div>
                                    <div class="help-text" id="passwordMatch" style="margin-top:6px;"></div>
                                </div>
                            </div>
                        </div>

                        <hr class="section-divider">

                        <!-- Avatar del Usuario -->
                        <div class="form-section">
                            <h2 class="section-title user-title">Avatar del Usuario</h2>
                            <div class="form-group">
                                <div class="current-photo">
                                    @if($player->user->avatar)
                                        <img src="{{ asset('storage/' . $player->user->avatar) }}" alt="Avatar" class="current-photo-image">
                                    @else
                                        <div class="current-photo-placeholder purple-avatar">
                                            {{ strtoupper(substr($player->user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="current-photo-info">
                                        <div class="current-photo-label">Avatar Actual del Usuario</div>
                                        <div class="current-photo-text">{{ $player->user->avatar ? basename($player->user->avatar) : 'Sin avatar' }}</div>
                                    </div>
                                </div>

                                <div class="file-upload-area purple-upload" id="avatarUploadArea">
                                    <div class="file-upload-icon">🖼️</div>
                                    <div class="file-upload-text">
                                        <strong class="purple">Click para cambiar el avatar</strong> o arrastra uno nuevo aquí<br>
                                        <small>JPG, PNG (máx. 2MB) — Deja vacío para mantener el actual</small>
                                    </div>
                                </div>
                                <input type="file" name="user_avatar" class="file-input" id="avatarInput" accept="image/jpeg,image/png,image/jpg">
                                <div class="file-preview" id="avatarPreview">
                                    <img src="" alt="Preview" class="preview-image" id="avatarPreviewImg">
                                    <div class="preview-info">
                                        <div class="preview-name" id="avatarPreviewName"></div>
                                        <div class="preview-size" id="avatarPreviewSize"></div>
                                    </div>
                                    <button type="button" class="remove-file" onclick="removeFile('avatar')">Eliminar</button>
                                </div>
                                @error('user_avatar')
                                    <span class="error-message">⚠ {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr class="section-divider">

                        <!-- Estado de la Cuenta -->
                        <div class="form-section">
                            <h2 class="section-title user-title">Estado de la Cuenta</h2>
                            <label class="checkbox-wrapper purple-check">
                                <input type="checkbox" name="user_is_active" id="user_is_active"
                                    class="checkbox-input purple-accent" value="1"
                                    {{ old('user_is_active', $player->user->is_active) ? 'checked' : '' }}>
                                <span class="checkbox-label">Cuenta activa (el jugador puede iniciar sesión)</span>
                            </label>
                        </div>

                    @else
                        {{-- Sin usuario vinculado --}}
                        <div class="user-no-account">
                            <div class="info-icon">⚠️</div>
                            <div>
                                <p><strong>Este jugador no tiene una cuenta de usuario vinculada.</strong></p>
                                <p>Para crear una cuenta, contacta al administrador del sistema.</p>
                            </div>
                        </div>
                    @endif

                </div>{{-- /panel-user --}}

                <!-- Botones -->
                <div class="form-actions">
                    <a href="{{ route('coach.dashboard') }}" class="btn btn-secondary">
                        ← Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        💾 Guardar Cambios
                    </button>
                </div>

            </form>
        </div>{{-- /form-card --}}
    </div>{{-- /container --}}

    <script>
        // ============================================
        // TABS
        // ============================================
        function switchTab(tab, btn) {
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.getElementById('panel-' + tab).classList.add('active');
            btn.classList.add('active');
        }

        // Si hay errores de usuario, abrir ese tab automáticamente
        @if($errors->hasAny(['user_name','user_email','user_phone','user_password','user_avatar']))
            document.addEventListener('DOMContentLoaded', () => {
                const userBtn = document.querySelector('.tab-btn.tab-user');
                switchTab('user', userBtn);
            });
        @endif

        // ============================================
        // FILE UPLOADS
        // ============================================
        function setupFileUpload(areaId, inputId, previewId, imgId, nameId, sizeId) {
            const area = document.getElementById(areaId);
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            const img = document.getElementById(imgId);
            const name = document.getElementById(nameId);
            const size = document.getElementById(sizeId);

            area.addEventListener('click', () => input.click());

            area.addEventListener('dragover', (e) => { e.preventDefault(); area.classList.add('dragover'); });
            area.addEventListener('dragleave', () => area.classList.remove('dragover'));
            area.addEventListener('drop', (e) => {
                e.preventDefault();
                area.classList.remove('dragover');
                if (e.dataTransfer.files.length > 0) {
                    input.files = e.dataTransfer.files;
                    handleFile(e.dataTransfer.files[0], area, preview, img, name, size);
                }
            });

            input.addEventListener('change', (e) => {
                if (e.target.files.length > 0) handleFile(e.target.files[0], area, preview, img, name, size);
            });
        }

        function handleFile(file, area, preview, img, nameEl, sizeEl) {
            if (!file.type.match('image/(jpeg|png|jpg)')) {
                alert('Por favor selecciona una imagen JPG o PNG');
                return;
            }
            if (file.size > 2 * 1024 * 1024) {
                alert('El archivo es muy grande. Máximo 2MB');
                return;
            }
            const reader = new FileReader();
            reader.onload = (e) => {
                img.src = e.target.result;
                nameEl.textContent = file.name;
                sizeEl.textContent = formatFileSize(file.size);
                preview.classList.add('active');
                area.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        function removeFile(type) {
            if (type === 'photo') {
                document.getElementById('photoInput').value = '';
                document.getElementById('photoPreview').classList.remove('active');
                document.getElementById('photoUploadArea').style.display = 'block';
            } else {
                document.getElementById('avatarInput').value = '';
                document.getElementById('avatarPreview').classList.remove('active');
                document.getElementById('avatarUploadArea').style.display = 'block';
            }
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }

        setupFileUpload('photoUploadArea', 'photoInput', 'photoPreview', 'photoPreviewImg', 'photoPreviewName', 'photoPreviewSize');
        setupFileUpload('avatarUploadArea', 'avatarInput', 'avatarPreview', 'avatarPreviewImg', 'avatarPreviewName', 'avatarPreviewSize');

        // ============================================
        // PASSWORD STRENGTH + CONFIRM
        // ============================================
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = '🙈';
            } else {
                input.type = 'password';
                btn.textContent = '👁️';
            }
        }

        const passwordInput = document.getElementById('userPassword');
        const passwordConfirm = document.getElementById('userPasswordConfirm');

        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const val = this.value;
                const strengthBox = document.getElementById('passwordStrength');
                const fill = document.getElementById('strengthFill');
                const text = document.getElementById('strengthText');

                if (val.length === 0) {
                    strengthBox.classList.remove('visible');
                    return;
                }

                strengthBox.classList.add('visible');
                fill.className = 'strength-fill';
                text.className = 'strength-text';

                if (val.length < 6) {
                    fill.classList.add('weak');
                    text.classList.add('weak');
                    text.textContent = 'Débil';
                } else if (val.length < 10 || !/[A-Z]/.test(val) || !/[0-9]/.test(val)) {
                    fill.classList.add('medium');
                    text.classList.add('medium');
                    text.textContent = 'Media';
                } else {
                    fill.classList.add('strong');
                    text.classList.add('strong');
                    text.textContent = 'Fuerte';
                }

                checkPasswordMatch();
            });
        }

        if (passwordConfirm) {
            passwordConfirm.addEventListener('input', checkPasswordMatch);
        }

        function checkPasswordMatch() {
            const matchEl = document.getElementById('passwordMatch');
            if (!passwordInput || !passwordConfirm || !matchEl) return;
            const pw = passwordInput.value;
            const confirm = passwordConfirm.value;

            if (confirm.length === 0) {
                matchEl.textContent = '';
                return;
            }
            if (pw === confirm) {
                matchEl.textContent = '✓ Las contraseñas coinciden';
                matchEl.style.color = 'var(--success)';
                matchEl.style.fontWeight = '600';
            } else {
                matchEl.textContent = '✗ Las contraseñas no coinciden';
                matchEl.style.color = 'var(--error)';
                matchEl.style.fontWeight = '600';
            }
        }

        // ============================================
        // FORM SUBMIT
        // ============================================
        document.getElementById('playerForm').addEventListener('submit', () => {
            const btn = document.getElementById('submitBtn');
            btn.classList.add('loading');
            btn.disabled = true;
        });

        // Limpiar clase error al escribir
        document.querySelectorAll('.form-input, .form-select').forEach(input => {
            input.addEventListener('input', function() { this.classList.remove('error'); });
        });
    </script>
</body>
</html>