<style>
.admin-sidebar {
    width: 280px;
    background: linear-gradient(180deg, #1a472a 0%, #0a1f14 100%);
    color: #fff;
    height: 100vh;
    position: sticky;
    top: 0;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    float: left;
    z-index: 100;
}

.sidebar-brand {
    padding: 24px;
    border-bottom: 1px solid rgba(255,255,255,0.15);
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.sidebar-brand-title {
    font-size: 20px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
}

.sidebar-brand-title svg {
    width: 28px;
    height: 28px;
    color: #f59e0b;
    flex-shrink: 0;
}

.sidebar-brand-user {
    font-size: 13px;
    color: rgba(167,243,208,0.8);
    padding-left: 38px;
}

.sidebar-nav {
    margin-top: 16px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.sidebar-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 24px;
    color: rgba(255,255,255,0.85);
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: background 0.2s ease;
    border-left: 3px solid transparent;
}

.sidebar-link svg {
    width: 18px;
    height: 18px;
    flex-shrink: 0;
}

.sidebar-link:hover {
    background: rgba(255,255,255,0.08);
    color: #fff;
}

.sidebar-link.active {
    background: rgba(245,158,11,0.2);
    border-left-color: #f59e0b;
    color: #fcd34d;
}

.sidebar-divider {
    border: none;
    border-top: 1px solid rgba(255,255,255,0.15);
    margin: 12px 0;
}

.sidebar-logout-form {
    margin-top: auto;
    padding: 8px 0 16px;
}

.sidebar-logout-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 24px;
    width: 100%;
    background: none;
    border: none;
    cursor: pointer;
    color: rgba(254,202,202,0.8);
    font-size: 14px;
    font-weight: 500;
    transition: background 0.2s ease, color 0.2s ease;
    border-left: 3px solid transparent;
    text-align: left;
}

.sidebar-logout-btn svg {
    width: 18px;
    height: 18px;
    flex-shrink: 0;
}

.sidebar-logout-btn:hover {
    background: rgba(239,68,68,0.2);
    color: #fff;
}
</style>

<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-title">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span>Panel Admin</span>
        </div>
        <p class="sidebar-brand-user">{{ auth()->user()->name }}</p>
    </div>

    <nav class="sidebar-nav">

        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.leagues.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.leagues.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
            </svg>
            <span>Ligas</span>
        </a>

        <a href="{{ route('admin.teams.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
            <span>Equipos</span>
        </a>

        <a href="{{ route('admin.players.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.players.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span>Jugadores</span>
        </a>

        <hr class="sidebar-divider">

        <a href="{{ route('admin.jornadas.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.jornadas.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span>Jornadas</span>
        </a>

        <a href="{{ route('admin.games.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.games.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Partidos</span>
        </a>

        <hr class="sidebar-divider">

        <a href="{{ route('home') }}" class="sidebar-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
            <span>Ver sitio público</span>
        </a>

        <div class="sidebar-logout-form">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-logout-btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </div>

    </nav>
</aside>