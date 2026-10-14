<nav class="bg-gradient-to-r from-blue-700 to-blue-900 text-white shadow-lg" x-data="{ mobileMenuOpen: false }">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo y nombre -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 hover:opacity-80 transition">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                    </svg>
                    <div>
                        <span class="text-xl font-bold block">LIGA FOOTBALL</span>
                        <span class="text-xs text-blue-200">Temporada 2024</span>
                    </div>
                </a>
            </div>
            
            <!-- Menú Desktop -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" 
                   class="hover:text-blue-200 transition {{ request()->routeIs('home') ? 'text-yellow-400 font-semibold' : '' }}">
                    Inicio
                </a>
                <a href="{{ route('teams.index') }}" 
                   class="hover:text-blue-200 transition {{ request()->routeIs('teams.*') ? 'text-yellow-400 font-semibold' : '' }}">
                    Equipos
                </a>
                <a href="{{ route('games.index') }}" 
                   class="hover:text-blue-200 transition {{ request()->routeIs('games.*') ? 'text-yellow-400 font-semibold' : '' }}">
                    Partidos
                </a>
                <a href="{{ route('standings') }}" 
                   class="hover:text-blue-200 transition {{ request()->routeIs('standings') ? 'text-yellow-400 font-semibold' : '' }}">
                    Tabla
                </a>
                
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" 
                           class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg font-semibold transition flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Admin</span>
                        </a>
                    @elseif(auth()->user()->isCoach())
                        <a href="{{ route('coach.dashboard') }}" 
                           class="bg-cyan-600 hover:bg-cyan-700 px-4 py-2 rounded-lg font-semibold transition flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>Mi Equipo</span>
                        </a>
                    @endif
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-red-300 transition flex items-center space-x-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Salir</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 px-6 py-2 rounded-lg font-bold transition shadow-lg">
                        Iniciar Sesión
                    </a>
                @endauth
            </div>
            
            <!-- Botón menú móvil -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Menú móvil -->
        <div x-show="mobileMenuOpen" 
             x-cloak
             @click.away="mobileMenuOpen = false"
             class="md:hidden pb-4 space-y-2">
            <a href="{{ route('home') }}" class="block py-2 px-4 hover:bg-blue-800 rounded transition">Inicio</a>
            <a href="{{ route('teams.index') }}" class="block py-2 px-4 hover:bg-blue-800 rounded transition">Equipos</a>
            <a href="{{ route('games.index') }}" class="block py-2 px-4 hover:bg-blue-800 rounded transition">Partidos</a>
            <a href="{{ route('standings') }}" class="block py-2 px-4 hover:bg-blue-800 rounded transition">Tabla</a>
            
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 bg-green-600 rounded hover:bg-green-700 transition">Panel Admin</a>
                @elseif(auth()->user()->isCoach())
                    <a href="{{ route('coach.dashboard') }}" class="block py-2 px-4 bg-cyan-600 rounded hover:bg-cyan-700 transition">Mi Equipo</a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="block w-full text-left py-2 px-4 hover:bg-blue-800 rounded transition">
                        Cerrar Sesión
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block py-2 px-4 bg-yellow-500 text-gray-900 font-bold rounded hover:bg-yellow-600 transition text-center">
                    Iniciar Sesión
                </a>
            @endauth
        </div>
    </div>
</nav>