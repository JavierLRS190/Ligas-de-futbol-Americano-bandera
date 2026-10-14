<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Jugada - Flag Football</title>
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
        .form-textarea:focus {
            outline: none;
            border-color: var(--info);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
            font-family: 'Inter', sans-serif;
        }

        .form-input.error,
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

        /* Type Selector */
        .type-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
        }

        .type-option {
            position: relative;
        }

        .type-radio {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .type-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 25px 15px;
            background: var(--gray-100);
            border: 3px solid var(--gray-300);
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
        }

        .type-label:hover {
            background: rgba(59, 130, 246, 0.05);
            border-color: var(--info);
        }

        .type-radio:checked + .type-label {
            background: linear-gradient(135deg, var(--info), #2563eb);
            color: white;
            border-color: #2563eb;
            transform: scale(1.05);
        }

        .type-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .type-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .type-desc {
            font-size: 12px;
            font-weight: 500;
            opacity: 0.8;
        }

        /* File Upload */
        .file-upload-wrapper {
            position: relative;
        }

        .current-diagram {
            margin-bottom: 20px;
            padding: 20px;
            background: var(--gray-100);
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .current-diagram-image {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            object-fit: cover;
            border: 3px solid var(--gray-300);
        }

        .current-diagram-placeholder {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            border: 3px solid var(--gray-300);
        }

        .current-diagram-info {
            flex: 1;
        }

        .current-diagram-label {
            font-size: 13px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .current-diagram-text {
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

        /* Info Box */
        .info-box {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(37, 99, 235, 0.05));
            border: 2px solid rgba(59, 130, 246, 0.3);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .info-icon {
            font-size: 32px;
        }

        .info-content h3 {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 5px;
            font-size: 16px;
        }

        .info-content p {
            color: var(--gray-600);
            font-size: 14px;
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

            .type-grid {
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
    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <h1>Editar Jugada</h1>
            <p>Actualiza la estrategia de tu equipo</p>
            <div class="team-badge">
                <span>🏆</span>
                <span>{{ $team->name }}</span>
            </div>
            <div class="breadcrumb">
                <a href="{{ route('coach.dashboard') }}">Dashboard</a>
                <span>→</span>
                <a href="{{ route('coach.plays.index') }}">Jugadas</a>
                <span>→</span>
                <span>Editar: {{ $play->name }}</span>
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

            <div class="info-box">
                <div class="info-icon">📝</div>
                <div class="info-content">
                    <h3>Editando: {{ $play->name }}</h3>
                    <p>Actualiza los detalles de esta jugada estratégica</p>
                </div>
            </div>

            <form action="{{ route('coach.plays.update', $play->id) }}" method="POST" enctype="multipart/form-data" id="playForm">
                @csrf
                @method('PUT')

                <!-- Información Básica -->
                <div class="form-section">
                    <h2 class="section-title">Información Básica</h2>
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label class="form-label">
                                Nombre de la Jugada <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                class="form-input @error('name') error @enderror" 
                                value="{{ old('name', $play->name) }}"
                                placeholder="Ej: Bomba Profunda, Slant Derecha, Blitz 52..."
                                required
                            >
                            @error('name')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                            <span class="help-text">Usa un nombre descriptivo y fácil de recordar</span>
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label">Descripción</label>
                            <textarea 
                                name="description" 
                                class="form-textarea @error('description') error @enderror"
                                placeholder="Describe los detalles de la jugada, asignaciones de jugadores, timing, etc..."
                            >{{ old('description', $play->description) }}</textarea>
                            @error('description')
                                <span class="error-message">⚠ {{ $message }}</span>
                            @enderror
                            <span class="help-text">Incluye instrucciones específicas para cada posición</span>
                        </div>
                    </div>
                </div>

                <!-- Tipo de Jugada -->
                <div class="form-section">
                    <h2 class="section-title">Tipo de Jugada <span class="required" style="color: var(--error); font-size: 24px;">*</span></h2>
                    <div class="type-grid">
                        <div class="type-option">
                            <input type="radio" name="type" value="offense" id="type_offense" class="type-radio" {{ old('type', $play->type) == 'offense' ? 'checked' : '' }} required>
                            <label for="type_offense" class="type-label">
                                <span class="type-icon">⚡</span>
                                <span class="type-name">Ofensiva</span>
                                <span class="type-desc">Jugadas de ataque</span>
                            </label>
                        </div>

                        <div class="type-option">
                            <input type="radio" name="type" value="defense" id="type_defense" class="type-radio" {{ old('type', $play->type) == 'defense' ? 'checked' : '' }}>
                            <label for="type_defense" class="type-label">
                                <span class="type-icon">🛡️</span>
                                <span class="type-name">Defensiva</span>
                                <span class="type-desc">Jugadas de defensa</span>
                            </label>
                        </div>

                        <div class="type-option">
                            <input type="radio" name="type" value="special" id="type_special" class="type-radio" {{ old('type', $play->type) == 'special' ? 'checked' : '' }}>
                            <label for="type_special" class="type-label">
                                <span class="type-icon">✨</span>
                                <span class="type-name">Especial</span>
                                <span class="type-desc">Patadas y situaciones especiales</span>
                            </label>
                        </div>
                    </div>
                    @error('type')
                        <span class="error-message">⚠ {{ $message }}</span>
                    @enderror
                </div>

                <!-- Diagrama -->
                <div class="form-section">
                    <h2 class="section-title">Diagrama de la Jugada</h2>
                    <div class="form-group">
                        @if($play->diagram)
                            <div class="current-diagram">
                                <img src="{{ asset('storage/' . $play->diagram) }}" alt="{{ $play->name }}" class="current-diagram-image">
                                <div class="current-diagram-info">
                                    <div class="current-diagram-label">Diagrama Actual</div>
                                    <div class="current-diagram-text">{{ basename($play->diagram) }}</div>
                                </div>
                            </div>
                        @else
                            <div class="current-diagram">
                                <div class="current-diagram-placeholder">📐</div>
                                <div class="current-diagram-info">
                                    <div class="current-diagram-label">Diagrama Actual</div>
                                    <div class="current-diagram-text">Sin diagrama</div>
                                </div>
                            </div>
                        @endif

                        <div class="file-upload-wrapper">
                            <div class="file-upload-area" id="fileUploadArea">
                                <div class="file-upload-icon">📤</div>
                                <div class="file-upload-text">
                                    <strong>Click para cambiar el diagrama</strong> o arrastra uno nuevo aquí
                                    <br>
                                    <small>JPG, PNG (máx. 2MB) - Deja vacío para mantener el actual</small>
                                </div>
                            </div>
                            <input 
                                type="file" 
                                name="diagram" 
                                class="file-input" 
                                id="diagramInput"
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
                        @error('diagram')
                            <span class="error-message">⚠ {{ $message }}</span>
                        @enderror
                        <span class="help-text">Actualiza el diagrama de la jugada (opcional)</span>
                    </div>
                </div>

                <!-- Video URL -->
                <div class="form-section">
                    <h2 class="section-title">Video de Referencia</h2>
                    <div class="form-group">
                        <label class="form-label">URL del Video (YouTube, Vimeo, etc.)</label>
                        <input 
                            type="url" 
                            name="video_url" 
                            class="form-input @error('video_url') error @enderror" 
                            value="{{ old('video_url', $play->video_url) }}"
                            placeholder="https://www.youtube.com/watch?v=..."
                        >
                        @error('video_url')
                            <span class="error-message">⚠ {{ $message }}</span>
                        @enderror
                        <span class="help-text">Enlace a un video de ejemplo o explicación de la jugada (opcional)</span>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="form-actions">
                    <a href="{{ route('coach.plays.index') }}" class="btn btn-secondary">
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
        const diagramInput = document.getElementById('diagramInput');
        const filePreview = document.getElementById('filePreview');
        const previewImage = document.getElementById('previewImage');
        const previewName = document.getElementById('previewName');
        const previewSize = document.getElementById('previewSize');
        const removeFile = document.getElementById('removeFile');

        // Click to upload
        fileUploadArea.addEventListener('click', () => diagramInput.click());

        // Drag and drop
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
                diagramInput.files = files;
                handleFileSelect(files[0]);
            }
        });

        // File selection
        diagramInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files[0]);
            }
        });

        // Remove file
        removeFile.addEventListener('click', () => {
            diagramInput.value = '';
            filePreview.classList.remove('active');
            fileUploadArea.style.display = 'block';
        });

        function handleFileSelect(file) {
            // Validate file type
            if (!file.type.match('image/jpeg') && !file.type.match('image/png') && !file.type.match('image/jpg')) {
                alert('Por favor selecciona una imagen JPG o PNG');
                return;
            }

            // Validate file size (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('El archivo es muy grande. Máximo 2MB');
                return;
            }

            // Show preview
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

        // Form submission
        const playForm = document.getElementById('playForm');
        const submitBtn = document.getElementById('submitBtn');

        playForm.addEventListener('submit', () => {
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        });

        // Remove error class on input
        const inputs = document.querySelectorAll('.form-input, .form-textarea');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('error');
            });
        });
    </script>
</body>
</html>