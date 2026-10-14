<!-- Admin Sidebar Component -->
<style>
    :root {
        --primary: #ff6b35;
        --primary-dark: #d94a1a;
        --secondary: #1a472a;
        --secondary-light: #2d5a3d;
        --text-light: #ffffff;
        --gray-100: #f5f5f5;
        --gray-600: #757575;
    }

    .admin-sidebar {
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        width: 280px;
        background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.3);
        z-index: 1000;
        overflow-y: auto;
        transition: all 0.3s ease;
    }

    .admin-sidebar.collapsed {
        width: 70px;
    }

    /* Header */
    .sidebar-header {
        padding: 25px 20px;
        background: rgba(0, 0, 0, 0.2);
        border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        position: relative;
    }

    .sidebar-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.3s;
    }

    .collapsed .sidebar-logo span {
        display: none;
    }

    .logo-icon {
        font-size: 32px;
        flex-shrink: 0;
    }

    .logo-text h2 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 22px;
        color: white;
        letter-spacing: 2px;
        margin: 0;
    }

    .logo-text p {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .toggle-btn {
        position: absolute;
        right: -15px;
        top: 30px;
        width: 30px;
        height: 30px;
        background: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.3s;
        font-size: 14px;
    }

    .toggle-btn:hover {
        background: var(--gray-100);
        transform: scale(1.1);
    }

    /* User Section */
    .sidebar-user {
        padding: 20px;
        border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        text-align: center;
    }

    .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: white;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 700;
        margin: 0 auto 12px;
        font-family: 'Bebas Neue', sans-serif;
        letter-spacing: 1px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .collapsed .user-avatar {
        width: 40px;
        height: 40px;
        font-size: 20px;
    }

    .user-name {
        color: white;
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 5px;
        transition: all 0.3s;
    }

    .user-role {
        color: rgba(255, 255, 255, 0.7);
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .collapsed .user-name,
    .collapsed .user-role {
        display: none;
    }

    /* Navigation */
    .sidebar-nav {
        padding: 20px 0;
    }

    .nav-section {
        margin-bottom: 25px;
    }

    .nav-section-title {
        padding: 0 20px 10px;
        font-size: 11px;
        color: rgba(255, 255, 255, 0.5);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
        transition: all 0.3s;
    }

    .collapsed .nav-section-title {
        opacity: 0;
        height: 0;
        padding: 0;
        margin: 0;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 14px;
        position: relative;
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .nav-link.active {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border-left: 4px solid white;
        font-weight: 700;
    }

    .nav-link.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: white;
    }

    .nav-icon {
        font-size: 20px;
        flex-shrink: 0;
        width: 24px;
        text-align: center;
    }

    .nav-text {
        transition: all 0.3s;
    }

    .collapsed .nav-text {
        display: none;
    }

    .collapsed .nav-link {
        justify-content: center;
        padding: 14px;
    }

    /* Logout */
    .logout-section {
        padding: 20px;
        border-top: 2px solid rgba(255, 255, 255, 0.1);
    }

    .logout-form {
        margin: 0;
    }

    .logout-btn {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        background: rgba(0, 0, 0, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        color: white;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 600;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
    }

    .logout-btn:hover {
        background: rgba(0, 0, 0, 0.4);
        border-color: rgba(255, 255, 255, 0.4);
    }

    .collapsed .logout-btn {
        padding: 14px;
        justify-content: center;
    }

    .collapsed .logout-btn span:last-child {
        display: none;
    }

    /* Mobile Overlay */
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    /* Responsive */
    @media (max-width: 968px) {
        .admin-sidebar {
            transform: translateX(-100%);
        }

        .admin-sidebar.mobile-open {
            transform: translateX(0);
        }

        .sidebar-overlay.active {
            display: block;
        }

        .admin-sidebar.collapsed {
            width: 280px;
        }

        .toggle-btn {
            display: none;
        }
    }

    /* Scrollbar */
    .admin-sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .admin-sidebar::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.1);
    }

    .admin-sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 3px;
    }

    .admin-sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }
</style>

<!-- Sidebar Overlay (Mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<aside class="admin-sidebar" id="adminSidebar">
    <!-- Header -->
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <div class="logo-icon">🏈</div>
            <div class="logo-text">
                <h2>Admin Panel</h2>
                <p>Flag Football</p>
            </div>
        </div>
        <button class="toggle-btn" id="toggleSidebar" title="Contraer/Expandir">
            ◀
        </button>
    </div>

    <!-- User Info -->
    <div class="sidebar-user">
        <div class="user-avatar">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <div class="user-name">{{ Auth::user()->name }}</div>
        <div class="user-role">Administrador</div>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">
        <!-- Main Section -->
        <div class="nav-section">
            <div class="nav-section-title">Principal</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon">📊</span>
                <span class="nav-text">Dashboard</span>
            </a>
        </div>

        <!-- Ligas Section - NUEVO -->
        <div class="nav-section">
            <div class="nav-section-title">Ligas</div>
            <a href="{{ route('admin.leagues.index') }}" class="nav-link {{ request()->routeIs('admin.leagues.*') ? 'active' : '' }}">
                <span class="nav-icon">🏆</span>
                <span class="nav-text">Gestión de Ligas</span>
            </a>
        </div>

        <!-- Teams Section -->
        <div class="nav-section">
            <div class="nav-section-title">Equipos</div>
            <a href="{{ route('admin.teams.index') }}" class="nav-link {{ request()->routeIs('admin.teams.index') ? 'active' : '' }}">
                <span class="nav-icon">🏢</span>
                <span class="nav-text">Ver Equipos</span>
            </a>
            <a href="{{ route('admin.teams.create') }}" class="nav-link {{ request()->routeIs('admin.teams.create') ? 'active' : '' }}">
                <span class="nav-icon">➕</span>
                <span class="nav-text">Crear Equipo</span>
            </a>
        </div>

        <!-- Players Section -->
        <div class="nav-section">
            <div class="nav-section-title">Jugadores</div>
            <a href="{{ route('admin.players.index') }}" class="nav-link {{ request()->routeIs('admin.players.index') ? 'active' : '' }}">
                <span class="nav-icon">👥</span>
                <span class="nav-text">Ver Jugadores</span>
            </a>
            <a href="{{ route('admin.players.create') }}" class="nav-link {{ request()->routeIs('admin.players.create') ? 'active' : '' }}">
                <span class="nav-icon">👤</span>
                <span class="nav-text">Crear Jugador</span>
            </a>
        </div>

        <!-- Public Section -->
        <div class="nav-section">
            <div class="nav-section-title">Público</div>
            <a href="{{ route('home') }}" class="nav-link" target="_blank">
                <span class="nav-icon">🌐</span>
                <span class="nav-text">Ver Sitio</span>
            </a>
        </div>
    </nav>

    <!-- Logout -->
    <div class="logout-section">
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <span>🚪</span>
                <span>Cerrar Sesión</span>
            </button>
        </form>
    </div>
</aside>

<script>
    // Sidebar Toggle
    const sidebar = document.getElementById('adminSidebar');
    const toggleBtn = document.getElementById('toggleSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    // Desktop toggle
    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            toggleBtn.textContent = sidebar.classList.contains('collapsed') ? '▶' : '◀';
            
            // Save state
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        });
    }

    // Restore state on page load
    if (localStorage.getItem('sidebarCollapsed') === 'true') {
        sidebar.classList.add('collapsed');
        if (toggleBtn) {
            toggleBtn.textContent = '▶';
        }
    }

    // Mobile overlay click
    if (overlay) {
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
        });
    }

    // Mobile menu button (if exists)
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.add('mobile-open');
            overlay.classList.add('active');
        });
    }

    // Close mobile menu on window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth > 968) {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
        }
    });
</script>