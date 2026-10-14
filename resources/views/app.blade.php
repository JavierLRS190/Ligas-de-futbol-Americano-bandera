<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Liga Football')</title>
    
    <!-- Tailwind CSS desde CDN (puedes usar Vite después) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js para interactividad -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Estilos personalizados -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Navegación -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-xl font-bold">LIGA FOOTBALL</span>
                    </a>
                </div>
                
                <!-- Menú principal -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-blue-200 transition">Inicio</a>
                    <a href="{{ route('teams.index') }}" class="hover:text-blue-200 transition">Equipos</a>
                    <a href="{{ route('games.index') }}" class="hover:text-blue-200 transition">Partidos</a>
                    <a href="{{ route('standings') }}" class="hover:text-blue-200 transition">Tabla</a>
                    
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="bg-blue-700 px-4 py-2 rounded hover:bg-blue-800 transition">
                                Panel Admin
                            </a>
                        @elseif(auth()->user()->isCoach())
                            <a href="{{ route('coach.dashboard') }}" class="bg-blue-700 px-4 py-2 rounded hover:bg-blue-800 transition">
                                Mi Equipo
                            </a>
                        @endif
                        
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-blue-200 transition">
                                Cerrar Sesión
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-white text-blue-600 px-4 py-2 rounded font-semibold hover:bg-blue-50 transition">
                            Iniciar Sesión
                        </a>
                    @endauth
                </div>
                
                <!-- Menú móvil -->
                <div class="md:hidden" x-data="{ open: false }">
                    <button @click="open = !open" class="text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    
                    <div x-show="open" @click.away="open = false" x-cloak
                         class="absolute top-16 right-0 left-0 bg-blue-600 shadow-lg py-4 px-4 space-y-3">
                        <a href="{{ route('home') }}" class="block hover:text-blue-200">Inicio</a>
                        <a href="{{ route('teams.index') }}" class="block hover:text-blue-200">Equipos</a>
                        <a href="{{ route('games.index') }}" class="block hover:text-blue-200">Partidos</a>
                        <a href="{{ route('standings') }}" class="block hover:text-blue-200">Tabla</a>
                        @auth
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left hover:text-blue-200">
                                    Cerrar Sesión
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block hover:text-blue-200">Iniciar Sesión</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Mensajes flash -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-4 mt-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-4 mt-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    
    <!-- Contenido principal -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16 py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Liga Football. Todos los derechos reservados.</p>
        </div>
    </footer>
    
    @stack('scripts')
</body>
</html>

<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - Liga Football')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-800 text-white">
            <div class="p-4">
                <h2 class="text-2xl font-bold">Panel Admin</h2>
            </div>
            
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 hover:bg-blue-700 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.teams.index') }}" class="block px-4 py-3 hover:bg-blue-700 {{ request()->routeIs('admin.teams.*') ? 'bg-blue-700' : '' }}">
                    Equipos
                </a>
                <a href="{{ route('admin.players.index') }}" class="block px-4 py-3 hover:bg-blue-700 {{ request()->routeIs('admin.players.*') ? 'bg-blue-700' : '' }}">
                    Jugadores
                </a>
                <a href="{{ route('home') }}" class="block px-4 py-3 hover:bg-blue-700">
                    Ver sitio público
                </a>
                
                <form action="{{ route('logout') }}" method="POST" class="mt-8">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-3 hover:bg-blue-700">
                        Cerrar Sesión
                    </button>
                </form>
            </nav>
        </aside>
        
        <!-- Contenido principal -->
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow">
                <div class="px-6 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">@yield('header', 'Dashboard')</h1>
                </div>
            </header>
            
            <main class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>