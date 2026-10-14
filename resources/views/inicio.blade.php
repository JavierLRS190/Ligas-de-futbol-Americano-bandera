 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inicio - Liga Football</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Configuración de Tailwind personalizada -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#1E40AF',
                            600: '#2563EB',
                            700: '#1E40AF',
                            800: '#1E3A8A',
                        },
                        success: {
                            DEFAULT: '#047857',
                            600: '#059669',
                            700: '#047857',
                        },
                        accent: {
                            DEFAULT: '#F59E0B',
                            500: '#F59E0B',
                            600: '#D97706',
                        },
                        danger: {
                            DEFAULT: '#DC2626',
                            600: '#DC2626',
                            700: '#B91C1C',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        [x-cloak] { display: none !important; }
        
        .hero-pattern {
            background-color: #1E40AF;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    @include('components.navbar')
    
    <!-- Hero Section -->
    <section class="hero-pattern text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/90 to-blue-900/90"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 animate-fade-in">
                    Bienvenido a la Liga Football
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100">
                    La mejor liga de fútbol americano flag de la región
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('teams.index') }}" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 px-8 py-4 rounded-lg font-bold text-lg transition shadow-lg transform hover:scale-105">
                        Ver Equipos
                    </a>
                    <a href="{{ route('games.index') }}" 
                       class="bg-white hover:bg-gray-100 text-blue-900 px-8 py-4 rounded-lg font-bold text-lg transition shadow-lg transform hover:scale-105">
                        Calendario de Partidos
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decoración -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#F9FAFB"/>
            </svg>
        </div>
    </section>
    
    <!-- Estadísticas rápidas -->
    <section class="py-12 -mt-16 relative z-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg shadow-lg p-6 text-center transform hover:scale-105 transition">
                    <div class="text-blue-600 mb-2">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $teams->count() }}</h3>
                    <p class="text-gray-600">Equipos Activos</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-6 text-center transform hover:scale-105 transition">
                    <div class="text-green-600 mb-2">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $teams->sum('players_count') }}</h3>
                    <p class="text-gray-600">Jugadores Registrados</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-6 text-center transform hover:scale-105 transition">
                    <div class="text-yellow-600 mb-2">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $upcomingGames->count() }}</h3>
                    <p class="text-gray-600">Próximos Partidos</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-6 text-center transform hover:scale-105 transition">
                    <div class="text-purple-600 mb-2">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $activeSeason ? $activeSeason->year : 'N/A' }}</h3>
                    <p class="text-gray-600">Temporada Actual</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Equipos Destacados -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Equipos Participantes</h2>
                <p class="text-gray-600 text-lg">Conoce a los equipos de nuestra liga</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($teams as $team)
                <div class="bg-gray-50 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div class="bg-gradient-to-br from-blue-600 to-blue-800 h-32 flex items-center justify-center">
                        @if($team->logo)
                            <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="h-20 w-20 object-contain">
                        @else
                            <div class="bg-white rounded-full p-4">
                                <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $team->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ $team->short_name }}</p>
                        
                        <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>{{ $team->players_count }} jugadores</span>
                            </div>
                            @if($team->city)
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $team->city }}</span>
                            </div>
                            @endif
                        </div>
                        
                        <a href="{{ route('teams.show', $team->id) }}" 
                           class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition">
                            Ver Equipo
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('teams.index') }}" 
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold transition shadow-lg">
                    Ver Todos los Equipos
                </a>
            </div>
        </div>
    </section>
    
    <!-- Próximos Partidos -->
    @if($upcomingGames->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Próximos Partidos</h2>
                <p class="text-gray-600 text-lg">No te pierdas los encuentros de esta semana</p>
            </div>
            
            <div class="max-w-4xl mx-auto space-y-4">
                @foreach($upcomingGames as $game)
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <!-- Equipo Local -->
                        <div class="flex-1 text-center md:text-right">
                            <h3 class="text-xl font-bold text-gray-800">{{ $game->homeTeam->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $game->homeTeam->short_name }}</p>
                        </div>
                        
                        <!-- VS y Fecha -->
                        <div class="text-center px-6">
                            <div class="bg-blue-600 text-white rounded-full w-16 h-16 flex items-center justify-center font-bold text-xl mb-2">
                                VS
                            </div>
                            <p class="text-sm text-gray-600">{{ $game->game_datetime->format('d/m/Y') }}</p>
                            <p class="text-sm font-semibold text-blue-600">{{ $game->game_datetime->format('H:i') }}</p>
                        </div>
                        
                        <!-- Equipo Visitante -->
                        <div class="flex-1 text-center md:text-left">
                            <h3 class="text-xl font-bold text-gray-800">{{ $game->awayTeam->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $game->awayTeam->short_name }}</p>
                        </div>
                    </div>
                    
                    @if($game->location)
                    <div class="mt-4 text-center">
                        <div class="inline-flex items-center space-x-2 text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                            <span class="text-sm">{{ $game->location }}</span>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('games.index') }}" 
                   class="inline-block bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-bold transition shadow-lg">
                    Ver Calendario Completo
                </a>
            </div>
        </div>
    </section>
    @endif
    
    <!-- Call to Action -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-4">¿Eres Coach o Administrador?</h2>
            <p class="text-xl mb-8 text-blue-100">Accede al panel de control para gestionar tu equipo</p>
            <a href="{{ route('login') }}" 
               class="inline-block bg-yellow-500 hover:bg-yellow-600 text-gray-900 px-8 py-4 rounded-lg font-bold text-lg transition shadow-lg transform hover:scale-105">
                Iniciar Sesión
            </a>
        </div>
    </section>
    
    <!-- Footer -->
    @include('components.footer')
</body>
</html>