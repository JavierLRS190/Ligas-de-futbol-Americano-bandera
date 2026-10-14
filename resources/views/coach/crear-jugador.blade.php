<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Jugador - Flag Football</title>
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
            overflow-x: hidden;
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

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            position: relative;
            z-index: 1;
        }

        /* Header */
        .page-header {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 30px 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            border-left: 6px solid var(--info);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '👤';
            position: absolute;
            right: 30px;
            top: 50%;
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

        .page-header p {
            color: var(--gray-600);
            font-size: 16px;
        }

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

        .breadcrumb a:hover {
            color: #2563eb;
        }

        .breadcrumb span {
            color: var(--gray-600);
        }

        /* Form Card */
        .form-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        .form-section {
            margin-bottom: 40px;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

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

        .section-title.user-section {
            border-bottom-color: var(--primary);
            color: var(--primary-dark);
        }

        .section-subtitle {
            color: var(--gray-600);
            font-size: 14px;
            margin-bottom: 20px;
            margin-top: -12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

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

        .form-label .required {
            color: var(--error);
            font-size: 18px;
        }

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
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-input.error,
        .form-select.error {
            border-color: var(--error);
        }

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

        /* Password input wrapper */
        .input-with-toggle {
            position: relative;
        }

        .input-with-toggle .form-input {
            padding-right: 52px;
            width: 100%;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            padding: 0;
            line-height: 1;
            color: var(--gray-600);
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: var(--info);
        }

        /* Password strength indicator */
        .password-strength {
            margin-top: 8px;
        }

        .strength-bar {
            height: 4px;
            border-radius: 4px;
            background: var(--gray-200);
            overflow: hidden;
            margin-bottom: 5px;
        }

        .strength-fill {
            height: 100%;
            border-radius: 4px;
            transition: all 0.4s ease;
            width: 0%;
        }

        .strength-fill.weak   { background: var(--error); width: 33%; }
        .strength-fill.medium { background: var(--accent); width: 66%; }
        .strength-fill.strong { background: var(--success); width: 100%; }

        .strength-label {
            font-size: 12px;
            font-weight: 600;
        }

        .strength-label.weak   { color: var(--error); }
        .strength-label.medium { color: #b45309; }
        .strength-label.strong { color: var(--success); }

        /* User account box */
        .user-account-box {
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.04), rgba(217, 74, 26, 0.08));
            border: 2px solid rgba(255, 107, 53, 0.2);
            border-radius: 16px;
            padding: 30px;
        }

        /* Position Selector */
        .position-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 10px;
        }

        .position-option {
            position: relative;
        }

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
            background: rgba(59, 130, 246, 0.05);
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

        .position-name {
            font-size: 11px;
            font-weight: 600;
        }

        /* File Upload */
        .file-upload-wrapper {
            position: relative;
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

        .file-upload-area:hover {
            border-color: var(--info);
            background: rgba(59, 130, 246, 0.05);
        }

        .file-upload-area.dragover {
            border-color: var(--info);
            background: rgba(59, 130, 246, 0.1);
        }

        .file-upload-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .file-upload-text {
            color: var(--gray-600);
            font-size: 14px;
        }

        .file-upload-text strong {
            color: var(--info);
            font-weight: 600;
        }

        .file-input {
            display: none;
        }

        .file-preview {
            margin-top: 15px;
            padding: 15px;
            background: var(--gray-100);
            border-radius: 10px;
            display: none;
            align-items: center;
            gap: 15px;
        }

        .file-preview.active {
            display: flex;
        }

        .preview-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--gray-300);
        }

        .preview-info {
            flex: 1;
        }

        .preview-name {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .preview-size {
            font-size: 13px;
            color: var(--gray-600);
        }

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

        .remove-file:hover {
            background: #dc2626;
        }

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

        .checkbox-wrapper:hover {
            background: rgba(59, 130, 246, 0.05);
        }

        .checkbox-input {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: var(--info);
        }

        .checkbox-label {
            font-weight: 500;
            color: var(--text-dark);
            cursor: pointer;
        }

        /* Divider */
        .section-divider {
            border: none;
            border-top: 2px dashed var(--gray-200);
            margin: 10px 0 40px 0;
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
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        .btn-secondary {
            background: var(--gray-200);
            color: var(--text-dark);
        }

        .btn-secondary:hover {
            background: var(--gray-300);
        }

        .btn-primary:active,
        .btn-secondary:active {
            transform: translateY(0);
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

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 2px solid var(--error);
            color: #991b1b;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 20px 15px;
            }

            .page-header {
                padding: 25px 20px;
            }

            .page-header h1 {
                font-size: 36px;
            }

            .form-card {
                padding: 25px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .position-grid {
                grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .user-account-box {
                padding: 20px;
            }
        }

        /* Loading State */
        .btn.loading {
            pointer-events: none;
            opacity: 0.7;
            position: relative;
        }

        .btn.loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
            right: 15px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Password match indicator */
        .match-indicator {
            font-size: 13px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 500;
        }

        .match-indicator.match   { color: var(--success); }
        .match-indicator.nomatch { color: var(--error); }
        .match-indicator.hidden  { visibility: hidden; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <h1>Agregar Jugador</h1>
            <p>Registra un nuevo jugador y crea su cuenta de acceso</p>
            <div class="team-badge">
                <span>🏆</span>
                <span>{{ $team->name }}</span>
            </div>
            <div class="breadcrumb">
                <a href="{{ route('coach.dashboard') }}">Dashboard</a>
                <span>→</span>
                <a href="{{ route('coach.players.index') }}">Jugadores</a>
                <span>→</span>
                <span>Agregar Jugador</span>
            </div>
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

            <form action="{{ route('coach.players.store') }}" method="POST" enctype="multipart/form-data" id="playerForm">
                @csrf

                <!-- ═══════════════════════════════════════ -->
                <!-- SECCIÓN 1: Información Personal        -->
                <!-- ═══════════════════════════════════════ -->
                <div class="form-section">
                    <h2 class="section-title">Información Personal</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">
                                Nombre <span class="required">*</span>
                            </label>
                            <input
                                type="text"
                                name="name"
                                class="form-input @error('name') error @enderror"
                                value="{{ old('name') }}"
                                placeholder="Ej: Juan"
                                required
                            >
                            @error('name')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Apellido <span class="required">*</span>
                            </label>
                            <input
                                type="text"
                                name="last_name"
                                class="form-input @error('last_name') error @enderror"
                                value="{{ old('last_name') }}"
                                placeholder="Ej: Pérez García"
                                required
                            >
                            @error('last_name')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Fecha de Nacimiento</label>
                            <input
                                type="date"
                                name="birth_date"
                                class="form-input @error('birth_date') error @enderror"
                                value="{{ old('birth_date') }}"
                            >
                            @error('birth_date')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Número de Jersey <span class="required">*</span>
                            </label>
                            <input
                                type="number"
                                name="jersey_number"
                                class="form-input @error('jersey_number') error @enderror"
                                value="{{ old('jersey_number') }}"
                                placeholder="0-99"
                                min="0"
                                max="99"
                                required
                            >
                            @error('jersey_number')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                            <span class="help-text">Número único en tu equipo (0-99)</span>
                        </div>
                    </div>
                </div>

                <!-- ═══════════════════════════════════════ -->
                <!-- SECCIÓN 2: Posición                    -->
                <!-- ═══════════════════════════════════════ -->
                <div class="form-section">
                    <h2 class="section-title">Posición <span class="required" style="color: var(--error); font-size: 24px;">*</span></h2>
                    <div class="position-grid">
                        <div class="position-option">
                            <input type="radio" name="position" value="QB" id="pos_qb" class="position-radio" {{ old('position') == 'QB' ? 'checked' : '' }} required>
                            <label for="pos_qb" class="position-label">
                                <span class="position-abbr">QB</span>
                                <span class="position-name">Quarterback</span>
                            </label>
                        </div>
                        <div class="position-option">
                            <input type="radio" name="position" value="RB" id="pos_rb" class="position-radio" {{ old('position') == 'RB' ? 'checked' : '' }}>
                            <label for="pos_rb" class="position-label">
                                <span class="position-abbr">RB</span>
                                <span class="position-name">Running Back</span>
                            </label>
                        </div>
                        <div class="position-option">
                            <input type="radio" name="position" value="WR" id="pos_wr" class="position-radio" {{ old('position') == 'WR' ? 'checked' : '' }}>
                            <label for="pos_wr" class="position-label">
                                <span class="position-abbr">WR</span>
                                <span class="position-name">Wide Receiver</span>
                            </label>
                        </div>
                        <div class="position-option">
                            <input type="radio" name="position" value="TE" id="pos_te" class="position-radio" {{ old('position') == 'TE' ? 'checked' : '' }}>
                            <label for="pos_te" class="position-label">
                                <span class="position-abbr">TE</span>
                                <span class="position-name">Tight End</span>
                            </label>
                        </div>
                        <div class="position-option">
                            <input type="radio" name="position" value="OL" id="pos_ol" class="position-radio" {{ old('position') == 'OL' ? 'checked' : '' }}>
                            <label for="pos_ol" class="position-label">
                                <span class="position-abbr">OL</span>
                                <span class="position-name">Offensive Line</span>
                            </label>
                        </div>
                        <div class="position-option">
                            <input type="radio" name="position" value="DL" id="pos_dl" class="position-radio" {{ old('position') == 'DL' ? 'checked' : '' }}>
                            <label for="pos_dl" class="position-label">
                                <span class="position-abbr">DL</span>
                                <span class="position-name">Defensive Line</span>
                            </label>
                        </div>
                        <div class="position-option">
                            <input type="radio" name="position" value="LB" id="pos_lb" class="position-radio" {{ old('position') == 'LB' ? 'checked' : '' }}>
                            <label for="pos_lb" class="position-label">
                                <span class="position-abbr">LB</span>
                                <span class="position-name">Linebacker</span>
                            </label>
                        </div>
                        <div class="position-option">
                            <input type="radio" name="position" value="CB" id="pos_cb" class="position-radio" {{ old('position') == 'CB' ? 'checked' : '' }}>
                            <label for="pos_cb" class="position-label">
                                <span class="position-abbr">CB</span>
                                <span class="position-name">Cornerback</span>
                            </label>
                        </div>
                        <div class="position-option">
                            <input type="radio" name="position" value="S" id="pos_s" class="position-radio" {{ old('position') == 'S' ? 'checked' : '' }}>
                            <label for="pos_s" class="position-label">
                                <span class="position-abbr">S</span>
                                <span class="position-name">Safety</span>
                            </label>
                        </div>
                        <div class="position-option">
                            <input type="radio" name="position" value="K" id="pos_k" class="position-radio" {{ old('position') == 'K' ? 'checked' : '' }}>
                            <label for="pos_k" class="position-label">
                                <span class="position-abbr">K</span>
                                <span class="position-name">Kicker</span>
                            </label>
                        </div>
                        <div class="position-option">
                            <input type="radio" name="position" value="P" id="pos_p" class="position-radio" {{ old('position') == 'P' ? 'checked' : '' }}>
                            <label for="pos_p" class="position-label">
                                <span class="position-abbr">P</span>
                                <span class="position-name">Punter</span>
                            </label>
                        </div>
                    </div>
                    @error('position')
                        <span class="error-message" style="margin-top: 12px;">⚠ {{ $message }}</span>
                    @enderror
                </div>

                <!-- ═══════════════════════════════════════ -->
                <!-- SECCIÓN 3: Información Física          -->
                <!-- ═══════════════════════════════════════ -->
                <div class="form-section">
                    <h2 class="section-title">Información Física</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Altura (cm)</label>
                            <input
                                type="number"
                                name="height"
                                class="form-input @error('height') error @enderror"
                                value="{{ old('height') }}"
                                placeholder="Ej: 180"
                                min="0"
                                step="0.1"
                            >
                            @error('height')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                            <span class="help-text">En centímetros</span>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Peso (kg)</label>
                            <input
                                type="number"
                                name="weight"
                                class="form-input @error('weight') error @enderror"
                                value="{{ old('weight') }}"
                                placeholder="Ej: 75"
                                min="0"
                                step="0.1"
                            >
                            @error('weight')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                            <span class="help-text">En kilogramos</span>
                        </div>
                    </div>
                </div>

                <!-- ═══════════════════════════════════════ -->
                <!-- SECCIÓN 4: Foto del Jugador            -->
                <!-- ═══════════════════════════════════════ -->
                <div class="form-section">
                    <h2 class="section-title">Foto del Jugador</h2>
                    <div class="form-group">
                        <div class="file-upload-wrapper">
                            <div class="file-upload-area" id="fileUploadArea">
                                <div class="file-upload-icon">📸</div>
                                <div class="file-upload-text">
                                    <strong>Click para seleccionar</strong> o arrastra la foto aquí
                                    <br>
                                    <small>JPG, PNG (máx. 2MB)</small>
                                </div>
                            </div>
                            <input
                                type="file"
                                name="photo"
                                class="file-input"
                                id="photoInput"
                                accept="image/jpeg,image/png,image/jpg"
                            >
                            <div class="file-preview" id="filePreview">
                                <img src="" alt="Preview" class="preview-image" id="previewImage">
                                <div class="preview-info">
                                    <div class="preview-name" id="previewName"></div>
                                    <div class="preview-size" id="previewSize"></div>
                                </div>
                                <button type="button" class="remove-file" id="removeFile">Eliminar</button>
                            </div>
                        </div>
                        @error('photo')
                            <span class="error-message">⚠ {{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- ═══════════════════════════════════════ -->
                <!-- SECCIÓN 5: Cuenta de Acceso            -->
                <!-- ═══════════════════════════════════════ -->
                <div class="form-section">
                    <h2 class="section-title user-section">Cuenta de Acceso</h2>
                    <p class="section-subtitle">
                        🔐 El jugador usará estas credenciales para iniciar sesión y consultar información del equipo
                    </p>

                    <div class="user-account-box">
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">
                                    Correo Electrónico <span class="required">*</span>
                                </label>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-input @error('email') error @enderror"
                                    value="{{ old('email') }}"
                                    placeholder="Ej: jugador@correo.com"
                                    required
                                >
                                @error('email')
                                    <span class="error-message">⚠ {{ $message }}</span>
                                @enderror
                                <span class="help-text">Debe ser un correo único en el sistema</span>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Teléfono</label>
                                <input
                                    type="tel"
                                    name="phone"
                                    class="form-input @error('phone') error @enderror"
                                    value="{{ old('phone') }}"
                                    placeholder="Ej: 2221234567"
                                >
                                @error('phone')
                                    <span class="error-message">⚠ {{ $message }}</span>
                                @enderror
                                <span class="help-text">Opcional</span>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    Contraseña Temporal <span class="required">*</span>
                                </label>
                                <div class="input-with-toggle">
                                    <input
                                        type="password"
                                        name="password"
                                        id="passwordInput"
                                        class="form-input @error('password') error @enderror"
                                        placeholder="Mínimo 8 caracteres"
                                        minlength="8"
                                        required
                                        autocomplete="new-password"
                                    >
                                    <button type="button" class="toggle-password" id="togglePass" title="Mostrar/ocultar contraseña">
                                        👁️
                                    </button>
                                </div>
                                <div class="password-strength" id="strengthWrapper" style="display:none;">
                                    <div class="strength-bar">
                                        <div class="strength-fill" id="strengthFill"></div>
                                    </div>
                                    <span class="strength-label" id="strengthLabel"></span>
                                </div>
                                @error('password')
                                    <span class="error-message">⚠ {{ $message }}</span>
                                @enderror
                                <span class="help-text">El jugador podrá cambiarla después de iniciar sesión</span>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    Confirmar Contraseña <span class="required">*</span>
                                </label>
                                <div class="input-with-toggle">
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        id="passwordConfirm"
                                        class="form-input"
                                        placeholder="Repite la contraseña"
                                        minlength="8"
                                        required
                                        autocomplete="new-password"
                                    >
                                    <button type="button" class="toggle-password" id="toggleConfirm" title="Mostrar/ocultar contraseña">
                                        👁️
                                    </button>
                                </div>
                                <span class="match-indicator hidden" id="matchIndicator"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ═══════════════════════════════════════ -->
                <!-- SECCIÓN 6: Estado del Jugador          -->
                <!-- ═══════════════════════════════════════ -->
                <div class="form-section">
                    <h2 class="section-title">Estado del Jugador</h2>
                    <div class="checkbox-wrapper">
                        <input
                            type="checkbox"
                            name="is_active"
                            id="is_active"
                            class="checkbox-input"
                            value="1"
                            {{ old('is_active', true) ? 'checked' : '' }}
                        >
                        <label for="is_active" class="checkbox-label">
                            Jugador Activo (puede participar en partidos)
                        </label>
                    </div>
                </div>

                <!-- ═══════════════════════════════════════ -->
                <!-- BOTONES                                 -->
                <!-- ═══════════════════════════════════════ -->
                <div class="form-actions">
                    <a href="{{ route('coach.players.index') }}" class="btn btn-secondary">
                        ← Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        ➕ Agregar Jugador
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // ─── File Upload Handler ───────────────────────────────────
        const fileUploadArea = document.getElementById('fileUploadArea');
        const photoInput     = document.getElementById('photoInput');
        const filePreview    = document.getElementById('filePreview');
        const previewImage   = document.getElementById('previewImage');
        const previewName    = document.getElementById('previewName');
        const previewSize    = document.getElementById('previewSize');
        const removeFile     = document.getElementById('removeFile');

        fileUploadArea.addEventListener('click', () => photoInput.click());

        fileUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadArea.classList.add('dragover');
        });

        fileUploadArea.addEventListener('dragleave', () => {
            fileUploadArea.classList.remove('dragover');
        });

        fileUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                photoInput.files = files;
                handleFileSelect(files[0]);
            }
        });

        photoInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) handleFileSelect(e.target.files[0]);
        });

        removeFile.addEventListener('click', () => {
            photoInput.value = '';
            filePreview.classList.remove('active');
            fileUploadArea.style.display = 'block';
        });

        function handleFileSelect(file) {
            if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                alert('Por favor selecciona una imagen JPG o PNG');
                return;
            }
            if (file.size > 2 * 1024 * 1024) {
                alert('El archivo es muy grande. Máximo 2MB');
                return;
            }
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage.src = e.target.result;
                previewName.textContent = file.name;
                previewSize.textContent = formatFileSize(file.size);
                filePreview.classList.add('active');
                fileUploadArea.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }

        // ─── Toggle Password Visibility ───────────────────────────
        document.getElementById('togglePass').addEventListener('click', function () {
            const input = document.getElementById('passwordInput');
            const isText = input.type === 'text';
            input.type = isText ? 'password' : 'text';
            this.textContent = isText ? '👁️' : '🙈';
        });

        document.getElementById('toggleConfirm').addEventListener('click', function () {
            const input = document.getElementById('passwordConfirm');
            const isText = input.type === 'text';
            input.type = isText ? 'password' : 'text';
            this.textContent = isText ? '👁️' : '🙈';
        });

        // ─── Password Strength ────────────────────────────────────
        const passwordInput    = document.getElementById('passwordInput');
        const strengthWrapper  = document.getElementById('strengthWrapper');
        const strengthFill     = document.getElementById('strengthFill');
        const strengthLabel    = document.getElementById('strengthLabel');

        passwordInput.addEventListener('input', function () {
            const val = this.value;
            if (!val) {
                strengthWrapper.style.display = 'none';
                return;
            }
            strengthWrapper.style.display = 'block';

            let score = 0;
            if (val.length >= 8)              score++;
            if (/[A-Z]/.test(val))            score++;
            if (/[0-9]/.test(val))            score++;
            if (/[^A-Za-z0-9]/.test(val))     score++;

            strengthFill.className = 'strength-fill';
            if (score <= 1) {
                strengthFill.classList.add('weak');
                strengthLabel.className = 'strength-label weak';
                strengthLabel.textContent = '🔴 Débil';
            } else if (score <= 2) {
                strengthFill.classList.add('medium');
                strengthLabel.className = 'strength-label medium';
                strengthLabel.textContent = '🟡 Media';
            } else {
                strengthFill.classList.add('strong');
                strengthLabel.className = 'strength-label strong';
                strengthLabel.textContent = '🟢 Fuerte';
            }

            checkPasswordMatch();
        });

        // ─── Password Match ───────────────────────────────────────
        const passwordConfirm  = document.getElementById('passwordConfirm');
        const matchIndicator   = document.getElementById('matchIndicator');

        passwordConfirm.addEventListener('input', checkPasswordMatch);

        function checkPasswordMatch() {
            const pass    = passwordInput.value;
            const confirm = passwordConfirm.value;

            if (!confirm) {
                matchIndicator.className = 'match-indicator hidden';
                return;
            }

            if (pass === confirm) {
                matchIndicator.className = 'match-indicator match';
                matchIndicator.textContent = '✓ Las contraseñas coinciden';
                passwordConfirm.style.borderColor = 'var(--success)';
            } else {
                matchIndicator.className = 'match-indicator nomatch';
                matchIndicator.textContent = '✗ Las contraseñas no coinciden';
                passwordConfirm.style.borderColor = 'var(--error)';
            }
        }

        // ─── Form Submission ──────────────────────────────────────
        const playerForm = document.getElementById('playerForm');
        const submitBtn  = document.getElementById('submitBtn');

        playerForm.addEventListener('submit', (e) => {
            const pass    = passwordInput.value;
            const confirm = passwordConfirm.value;

            if (pass !== confirm) {
                e.preventDefault();
                matchIndicator.className = 'match-indicator nomatch';
                matchIndicator.textContent = '✗ Las contraseñas no coinciden';
                passwordConfirm.focus();
                return;
            }

            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        });

        // ─── Remove error class on input ──────────────────────────
        document.querySelectorAll('.form-input, .form-select').forEach(input => {
            input.addEventListener('input', function () {
                this.classList.remove('error');
                if (this.id !== 'passwordConfirm') {
                    this.style.borderColor = '';
                }
            });
        });
    </script>
</body>
</html>