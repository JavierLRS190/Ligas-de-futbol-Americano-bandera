<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Flag Football</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a472a 0%, #2d5a3d 50%, #1a472a 100%);
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 35px,
                    rgba(255, 255, 255, 0.03) 35px,
                    rgba(255, 255, 255, 0.03) 70px
                );
            pointer-events: none;
        }

        .field-lines {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.1;
            pointer-events: none;
        }

        .yard-line {
            position: absolute;
            left: 0;
            right: 0;
            height: 2px;
            background: white;
        }

        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .header {
            background: linear-gradient(135deg, #ff6b35 0%, #d94a1a 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .header::before {
            content: '🏈';
            font-size: 48px;
            display: block;
            margin-bottom: 15px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .header h1 {
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
        }

        .form-container {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 18px;
        }

        .form-control {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #ff6b35;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        .form-control.error {
            border-color: #e74c3c;
        }

        .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .remember-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            user-select: none;
        }

        .remember-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #ff6b35;
        }

        .remember-label span {
            color: #555;
            font-size: 14px;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #ff6b35 0%, #d94a1a 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 30px 0;
            color: #999;
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e0e0e0;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #ff6b35;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .back-link a:hover {
            color: #d94a1a;
            gap: 8px;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-danger {
            background: #fee;
            border: 1px solid #fcc;
            color: #c33;
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }

            .header {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .form-container {
                padding: 30px 20px;
            }
        }

        .loading {
            display: none;
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        @keyframes spin {
            to { transform: translateY(-50%) rotate(360deg); }
        }

        .btn-login.is-loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-login.is-loading .loading {
            display: block;
        }
    </style>
</head>
<body>
    <div class="field-lines">
        <div class="yard-line" style="top: 20%"></div>
        <div class="yard-line" style="top: 40%"></div>
        <div class="yard-line" style="top: 60%"></div>
        <div class="yard-line" style="top: 80%"></div>
    </div>

    <div class="container">
        <div class="login-card">
            <div class="header">
                <h1>Bienvenido</h1>
                <p>Ingresa a tu cuenta de Flag Football</p>
            </div>

            <div class="form-container">
                @if ($errors->has('email') && !$errors->has('password'))
                    <div class="alert alert-danger">
                        <span>⚠️</span>
                        <span>{{ $errors->first('email') }}</span>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" id="loginForm">
                    @csrf

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <div class="input-wrapper">
                            <span class="input-icon">📧</span>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="form-control @error('email') error @enderror" 
                                value="{{ old('email') }}"
                                placeholder="tu@email.com"
                                required
                                autocomplete="email"
                                autofocus
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <div class="input-wrapper">
                            <span class="input-icon">🔒</span>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="form-control" 
                                placeholder="••••••••"
                                required
                                autocomplete="current-password"
                            >
                        </div>
                    </div>

                    <div class="remember-wrapper">
                        <label class="remember-label">
                            <input type="checkbox" name="remember" id="remember">
                            <span>Recordarme</span>
                        </label>
                    </div>

                    <button type="submit" class="btn-login" id="btnLogin">
                        <span class="btn-text">Iniciar Sesión</span>
                        <span class="loading"></span>
                    </button>
                </form>

                <div class="divider">O</div>

                <div class="back-link">
                    <a href="{{ route('home') }}">
                        <span>←</span>
                        <span>Volver al inicio</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('btnLogin');
            btn.classList.add('is-loading');
        });

        // Remover clase de error al escribir
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('error');
            });
        });
    </script>
</body>
</html>