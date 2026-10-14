<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipo - Admin</title>
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
        }

        .main-content {
            margin-left: 280px;
            padding: 40px 30px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 968px) {
            .main-content {
                margin-left: 0;
            }
        }

        /* Page Header */
        .page-header {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 30px 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            border-left: 6px solid var(--warning);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '✏️';
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

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
            font-size: 14px;
        }

        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .breadcrumb a:hover {
            color: var(--primary-dark);
        }

        .breadcrumb span {
            color: var(--gray-600);
        }

        /* Info Alert */
        .info-box {
            background: rgba(245, 158, 11, 0.1);
            border: 2px solid var(--warning);
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .info-box-icon {
            font-size: 24px;
        }

        .info-box-text {
            color: #92400e;
            font-size: 14px;
            font-weight: 500;
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
            border-bottom: 3px solid var(--warning);
            display: inline-block;
            letter-spacing: 1px;
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
        .form-select,
        .form-textarea {
            padding: 14px 18px;
            border: 2px solid var(--gray-300);
            border-radius: 12px;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--warning);
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
            font-family: 'Inter', sans-serif;
        }

        .form-input.error,
        .form-select.error,
        .form-textarea.error {
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

        /* League Selector Highlight */
        .league-selector {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(59, 130, 246, 0.02));
            border: 2px solid var(--info);
            border-radius: 12px;
            padding: 20px;
        }

        .league-selector .form-label {
            color: var(--info);
            font-size: 15px;
        }

        .league-selector .form-select {
            border-color: var(--info);
        }

        .league-selector .help-text {
            color: var(--info);
            font-weight: 600;
        }

        /* Current Logo Preview */
        .current-logo-preview {
            margin-bottom: 15px;
            padding: 15px;
            background: var(--gray-100);
            border-radius: 12px;
        }

        .current-logo-label {
            font-size: 13px;
            color: var(--gray-600);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .current-logo-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 12px;
            border: 3px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .current-logo-placeholder {
            width: 150px;
            height: 150px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            letter-spacing: 2px;
            border: 3px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* File Upload */
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
            border-color: var(--warning);
            background: rgba(245, 158, 11, 0.05);
        }

        .file-upload-area.dragover {
            border-color: var(--warning);
            background: rgba(245, 158, 11, 0.1);
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
            color: var(--warning);
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
            background: rgba(245, 158, 11, 0.05);
        }

        .checkbox-input {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: var(--warning);
        }

        .checkbox-label {
            font-weight: 500;
            color: var(--text-dark);
            cursor: pointer;
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
            background: linear-gradient(135deg, var(--warning) 0%, #d97706 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
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

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 2px solid var(--error);
            color: #991b1b;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
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

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
                justify-content: center;
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
    </style>
</head>
<body>
    <!-- Include Sidebar -->
    @include('components.admin-sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1>Editar Equipo</h1>
            <p>Actualiza la información del equipo</p>
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>→</span>
                <a href="{{ route('admin.teams.index') }}">Equipos</a>
                <span>→</span>
                <span>{{ $team->name }}</span>
            </div>
        </div>

        <!-- Info Box -->
        <div class="info-box">
            <span class="info-box-icon">ℹ️</span>
            <span class="info-box-text">
                Estás editando: <strong>{{ $team->name }}</strong> ({{ $team->league->name ?? 'Sin liga' }})
            </span>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            @if($errors->any())
                <div class="alert alert-error">
                    <span>⚠</span>
                    <span>Por favor corrige los errores en el formulario</span>
                </div>
            @endif

            <form action="{{ route('admin.teams.update', $team->id) }}" method="POST" enctype="multipart/form-data" id="teamForm">
                @csrf
                @method('PUT')

                <!-- Selección de Liga -->
                <div class="form-section">
                    <h2 class="section-title">Liga</h2>
                    <div class="league-selector">
                        <div class="form-group">
                            <label class="form-label">
                                Selecciona la Liga <span class="required">*</span>
                            </label>
                            <select 
                                name="league_id" 
                                class="form-select @error('league_id') error @enderror"
                                required
                            >
                                <option value="">-- Selecciona una liga --</option>
                                @foreach($leagues as $league)
                                    <option value="{{ $league->id }}" {{ old('league_id', $team->league_id) == $league->id ? 'selected' : '' }}>
                                        🏆 {{ $league->name }} ({{ $league->country ?? 'Internacional' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('league_id')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                            <span class="help-text">ℹ️ Cambiar la liga moverá este equipo a otra liga</span>
                        </div>
                    </div>
                </div>

                <!-- Información Básica -->
                <div class="form-section">
                    <h2 class="section-title">Información Básica</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">
                                Nombre del Equipo <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                class="form-input @error('name') error @enderror" 
                                value="{{ old('name', $team->name) }}"
                                placeholder="Ej: Águilas Doradas"
                                required
                            >
                            @error('name')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                            <span class="help-text">Nombre único dentro de la liga</span>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Nombre Corto <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="short_name" 
                                class="form-input @error('short_name') error @enderror" 
                                value="{{ old('short_name', $team->short_name) }}"
                                placeholder="Ej: AGD"
                                maxlength="10"
                                required
                            >
                            @error('short_name')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                            <span class="help-text">Máximo 10 caracteres</span>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Ciudad</label>
                            <input 
                                type="text" 
                                name="city" 
                                class="form-input @error('city') error @enderror" 
                                value="{{ old('city', $team->city) }}"
                                placeholder="Ej: Ciudad de México"
                            >
                            @error('city')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Estadio</label>
                            <input 
                                type="text" 
                                name="stadium" 
                                class="form-input @error('stadium') error @enderror" 
                                value="{{ old('stadium', $team->stadium) }}"
                                placeholder="Ej: Estadio Azteca"
                            >
                            @error('stadium')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Año de Fundación</label>
                            <input 
                                type="number" 
                                name="founded_year" 
                                class="form-input @error('founded_year') error @enderror" 
                                value="{{ old('founded_year', $team->founded_year) }}"
                                placeholder="Ej: 2020"
                                min="1900"
                                max="{{ date('Y') }}"
                            >
                            @error('founded_year')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label">Descripción</label>
                            <textarea 
                                name="description" 
                                class="form-textarea @error('description') error @enderror"
                                placeholder="Descripción del equipo, historia, logros..."
                            >{{ old('description', $team->description) }}</textarea>
                            @error('description')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Logo del Equipo -->
                <div class="form-section">
                    <h2 class="section-title">Logo del Equipo</h2>
                    
                    <!-- Current Logo -->
                    @if($team->logo)
                        <div class="current-logo-preview">
                            <div class="current-logo-label">Logo Actual</div>
                            <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="current-logo-image">
                        </div>
                    @else
                        <div class="current-logo-preview">
                            <div class="current-logo-label">Logo Actual</div>
                            <div class="current-logo-placeholder">
                                {{ strtoupper(substr($team->short_name, 0, 2)) }}
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="file-upload-area" id="fileUploadArea">
                            <div class="file-upload-icon">📤</div>
                            <div class="file-upload-text">
                                <strong>Click para cambiar logo</strong> o arrastra aquí
                                <br>
                                <small>JPG, PNG (máx. 2MB) - Dejar vacío para mantener el actual</small>
                            </div>
                        </div>
                        <input 
                            type="file" 
                            name="logo" 
                            class="file-input" 
                            id="logoInput"
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
                        @error('logo')
                            <span class="error-message">⚠ {{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Estado -->
                <div class="form-section">
                    <h2 class="section-title">Estado</h2>
                    <div class="checkbox-wrapper">
                        <input 
                            type="checkbox" 
                            name="is_active" 
                            id="is_active" 
                            class="checkbox-input"
                            value="1"
                            {{ old('is_active', $team->is_active) ? 'checked' : '' }}
                        >
                        <label for="is_active" class="checkbox-label">
                            Equipo Activo (visible en el sistema)
                        </label>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="form-actions">
                    <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">
                        ← Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        💾 Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // File Upload Handler
        const fileUploadArea = document.getElementById('fileUploadArea');
        const logoInput = document.getElementById('logoInput');
        const filePreview = document.getElementById('filePreview');
        const previewImage = document.getElementById('previewImage');
        const previewName = document.getElementById('previewName');
        const previewSize = document.getElementById('previewSize');
        const removeFile = document.getElementById('removeFile');

        fileUploadArea.addEventListener('click', () => logoInput.click());

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
                logoInput.files = files;
                handleFileSelect(files[0]);
            }
        });

        logoInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files[0]);
            }
        });

        removeFile.addEventListener('click', () => {
            logoInput.value = '';
            filePreview.classList.remove('active');
            fileUploadArea.style.display = 'block';
        });

        function handleFileSelect(file) {
            if (!file.type.match('image/jpeg') && !file.type.match('image/png') && !file.type.match('image/jpg')) {
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

        const teamForm = document.getElementById('teamForm');
        const submitBtn = document.getElementById('submitBtn');

        teamForm.addEventListener('submit', () => {
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        });

        const inputs = document.querySelectorAll('.form-input, .form-select, .form-textarea');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('error');
            });
        });
    </script>
</body>
</html>