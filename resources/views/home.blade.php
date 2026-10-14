<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flag Football League</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow+Condensed:wght@400;600;700;800;900&family=Barlow:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-void: #080a0f;
            --bg-dark: #0d1117;
            --bg-card: #111722;
            --bg-card-hover: #161e2e;
            --bg-surface: #1a2235;
            --accent: #f0a500;
            --accent-hot: #ff4f00;
            --accent-glow: rgba(240,165,0,0.18);
            --accent-glow-strong: rgba(240,165,0,0.35);
            --green: #00e676;
            --green-dim: rgba(0,230,118,0.12);
            --text-primary: #f5f7ff;
            --text-secondary: #bbc5db;
            --text-muted: #6b7fa0;
            --border: rgba(255,255,255,0.10);
            --border-accent: rgba(240,165,0,0.35);
            --shadow-glow: 0 0 40px rgba(240,165,0,0.15);
            --shadow-card: 0 8px 32px rgba(0,0,0,0.5);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Barlow', sans-serif;
            background: var(--bg-void);
            color: var(--text-primary);
            line-height: 1.7;
            font-size: 18px;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ═══════════════════════════════════════
           FONDO CON TEXTURA DE CAMPO
        ═══════════════════════════════════════ */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 59px,
                    rgba(255,255,255,0.018) 59px,
                    rgba(255,255,255,0.018) 60px
                ),
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    transparent 59px,
                    rgba(255,255,255,0.018) 59px,
                    rgba(255,255,255,0.018) 60px
                );
            pointer-events: none;
            z-index: 0;
        }

        /* ═══════════════════════════════════════
           NAVEGACIÓN
        ═══════════════════════════════════════ */
        nav {
            position: sticky;
            top: 0;
            z-index: 200;
            background: rgba(8,10,15,0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }

        nav::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 28px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 1;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
        }

        .logo-icon {
            width: 52px;
            height: 52px;
            background: var(--accent);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            box-shadow: 0 0 20px rgba(240,165,0,0.4);
            transition: box-shadow 0.3s;
        }

        .logo:hover .logo-icon {
            box-shadow: 0 0 30px rgba(240,165,0,0.6);
        }

        .logo-text {
            display: flex;
            flex-direction: column;
        }

        .logo-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 26px;
            color: var(--text-primary);
            letter-spacing: 2px;
            line-height: 1;
        }

        .logo-sub {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: var(--accent);
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .nav-tabs {
            display: flex;
            gap: 6px;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 6px;
        }

        .nav-tab {
            padding: 12px 26px;
            border: none;
            border-radius: 10px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            background: transparent;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .nav-tab:hover {
            color: var(--text-primary);
            background: rgba(255,255,255,0.08);
        }

        .nav-tab.active {
            background: var(--accent);
            color: #000;
            box-shadow: 0 0 16px rgba(240,165,0,0.4);
            font-size: 18px;
        }

        .btn-login {
            padding: 12px 26px;
            background: transparent;
            color: var(--accent);
            border: 2px solid var(--accent);
            border-radius: 10px;
            text-decoration: none;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            transition: all 0.2s;
        }

        .btn-login:hover {
            background: var(--accent);
            color: #000;
            box-shadow: 0 0 20px rgba(240,165,0,0.4);
        }

        /* ═══════════════════════════════════════
           HERO
        ═══════════════════════════════════════ */
        .hero {
            position: relative;
            padding: 80px 28px 72px;
            text-align: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 60% at 50% 0%, rgba(240,165,0,0.12) 0%, transparent 70%),
                radial-gradient(ellipse 40% 40% at 20% 50%, rgba(255,79,0,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 80% 50%, rgba(240,165,0,0.06) 0%, transparent 60%);
        }

        /* Líneas decorativas del campo */
        .hero-field-lines {
            position: absolute;
            inset: 0;
            overflow: hidden;
            opacity: 0.15;
        }

        .hero-field-lines::before,
        .hero-field-lines::after {
            content: '';
            position: absolute;
            top: 0; bottom: 0;
            width: 2px;
            background: linear-gradient(180deg, transparent, var(--accent), transparent);
        }

        .hero-field-lines::before { left: 15%; }
        .hero-field-lines::after { right: 15%; }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(240,165,0,0.1);
            border: 1px solid var(--border-accent);
            border-radius: 100px;
            padding: 6px 18px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 28px;
        }

        .hero-tag-dot {
            width: 8px; height: 8px;
            background: var(--accent);
            border-radius: 50%;
            animation: blink 2s ease-in-out infinite;
        }

        @keyframes blink {
            0%,100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .hero h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(64px, 10vw, 120px);
            line-height: 0.9;
            color: var(--text-primary);
            margin-bottom: 24px;
            letter-spacing: 3px;
        }

        .hero h1 .accent-word {
            color: var(--accent);
            text-shadow: 0 0 60px rgba(240,165,0,0.5);
        }

        .hero h1 .outline-word {
            -webkit-text-stroke: 2px var(--text-primary);
            color: transparent;
        }

        .hero-desc {
            font-size: 18px;
            font-weight: 400;
            color: var(--text-secondary);
            max-width: 520px;
            margin: 0 auto 40px;
        }

        .hero-stats-strip {
            display: inline-flex;
            gap: 0;
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            background: rgba(255,255,255,0.03);
        }

        .hero-stat {
            padding: 16px 32px;
            border-right: 1px solid var(--border);
            text-align: center;
        }

        .hero-stat:last-child { border-right: none; }

        .hero-stat-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 36px;
            color: var(--accent);
            line-height: 1;
            display: block;
        }

        .hero-stat-lbl {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-top: 4px;
        }

        /* ═══════════════════════════════════════
           CONTENEDOR
        ═══════════════════════════════════════ */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 48px 28px;
            position: relative;
            z-index: 1;
        }

        .tab-content { display: none; }
        .tab-content.active { display: block; }

        .mobile-tabs {
            display: none;
            overflow-x: auto;
            gap: 8px;
            margin-bottom: 28px;
            padding: 4px;
            scrollbar-width: none;
        }

        .mobile-tabs::-webkit-scrollbar { display: none; }

        /* ═══════════════════════════════════════
           SECTION HEADER
        ═══════════════════════════════════════ */
        .section-header {
            margin-bottom: 36px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            color: var(--text-primary);
            letter-spacing: 2px;
            line-height: 1;
            margin-bottom: 6px;
        }

        .section-subtitle {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--accent);
        }

        /* ═══════════════════════════════════════
           LEAGUES GRID
        ═══════════════════════════════════════ */
        .leagues-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .league-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
        }

        .league-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 16px;
            border: 1px solid var(--accent);
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }

        .league-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-glow), var(--shadow-card);
            background: var(--bg-card-hover);
        }

        .league-card:hover::before { opacity: 1; }

        .league-header {
            position: relative;
            padding: 32px 24px 28px;
            text-align: center;
            overflow: hidden;
        }

        .league-header-bg {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(240,165,0,0.15) 0%, rgba(255,79,0,0.08) 100%);
        }

        .league-header-pattern {
            position: absolute;
            inset: 0;
            background-image: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255,255,255,0.02) 10px,
                rgba(255,255,255,0.02) 11px
            );
        }

        .league-logo {
            width: 88px;
            height: 88px;
            margin: 0 auto 20px;
            background: var(--bg-dark);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            letter-spacing: 2px;
            color: var(--accent);
            border: 2px solid var(--border-accent);
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 20px rgba(0,0,0,0.4);
        }

        .league-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 16px;
        }

        .league-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            letter-spacing: 2px;
            color: var(--text-primary);
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .league-location {
            font-family: 'Barlow', sans-serif;
            font-size: 16px;
            font-weight: 500;
            color: rgba(255,255,255,0.8);
            position: relative;
            z-index: 1;
        }

        .league-body {
            padding: 24px;
        }

        .league-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 14px 8px;
            background: var(--bg-surface);
            border-radius: 10px;
            border: 1px solid var(--border);
            transition: border-color 0.2s;
        }

        .league-card:hover .stat-item {
            border-color: var(--border-accent);
        }

        .stat-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            color: var(--accent);
            display: block;
            line-height: 1;
            letter-spacing: 1px;
        }

        .stat-label {
            font-family: 'Barlow', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-top: 6px;
        }

        .btn-enter-league {
            width: 100%;
            padding: 18px;
            background: var(--accent);
            color: #000;
            border: none;
            border-radius: 12px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .btn-enter-league:hover {
            background: #ffc107;
            box-shadow: 0 0 24px rgba(240,165,0,0.5);
            transform: translateY(-2px);
        }

        /* ═══════════════════════════════════════
           EQUIPOS
        ═══════════════════════════════════════ */
        .league-section {
            margin-bottom: 40px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px;
        }

        .league-section-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .league-icon {
            width: 52px;
            height: 52px;
            background: var(--bg-surface);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            letter-spacing: 1px;
            color: var(--accent);
            border: 1px solid var(--border-accent);
            flex-shrink: 0;
        }

        .league-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .league-section-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            letter-spacing: 2px;
            color: var(--text-primary);
            line-height: 1;
        }

        .league-section-meta {
            font-family: 'Barlow', sans-serif;
            font-size: 15px;
            font-weight: 500;
            color: var(--text-secondary);
            margin-top: 5px;
        }

        .teams-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 14px;
        }

        .team-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px 16px;
            text-align: center;
            transition: all 0.25s;
            text-decoration: none;
            display: block;
        }

        .team-card:hover {
            border-color: var(--accent);
            background: var(--bg-card-hover);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.4), 0 0 20px rgba(240,165,0,0.1);
        }

        .team-logo {
            width: 64px;
            height: 64px;
            margin: 0 auto 14px;
            background: var(--bg-card);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 1px;
            color: var(--accent);
            border: 1px solid var(--border);
        }

        .team-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .team-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .team-city {
            font-size: 15px;
            color: var(--text-secondary);
        }

        .team-badge {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 14px;
            background: rgba(240,165,0,0.1);
            border: 1px solid var(--border-accent);
            border-radius: 100px;
            font-family: 'Barlow', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: var(--accent);
        }

        /* ═══════════════════════════════════════
           CALENDARIO
        ═══════════════════════════════════════ */
        .filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 36px;
        }

        .filter-btn {
            padding: 12px 24px;
            background: transparent;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-family: 'Barlow', sans-serif;
            font-size: 17px;
            font-weight: 600;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s;
        }

        .filter-btn:hover {
            color: var(--text-primary);
            border-color: var(--text-muted);
        }

        .filter-btn.active {
            background: var(--accent);
            color: #000;
            border-color: var(--accent);
            box-shadow: 0 0 16px rgba(240,165,0,0.3);
        }

        .match-day {
            margin-bottom: 36px;
        }

        .match-day-label {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .match-day-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, var(--border-accent), transparent);
        }

        .match-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 24px 28px;
            margin-bottom: 10px;
            display: grid;
            grid-template-columns: 1fr 180px 1fr;
            gap: 20px;
            align-items: center;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }

        .match-card::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 3px;
            background: transparent;
            transition: background 0.2s;
        }

        .match-card:hover {
            border-color: rgba(240,165,0,0.3);
            background: var(--bg-card-hover);
        }

        .match-card:hover::before { background: var(--accent); }

        .match-card.live {
            border-color: rgba(0,230,118,0.3);
            background: linear-gradient(to right, var(--green-dim), var(--bg-card));
        }

        .match-card.live::before { background: var(--green); }

        .match-team {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .match-team.right {
            flex-direction: row-reverse;
            text-align: right;
        }

        .match-team-logo {
            width: 50px;
            height: 50px;
            background: var(--bg-surface);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 16px;
            letter-spacing: 1px;
            color: var(--accent);
            border: 1px solid var(--border);
            flex-shrink: 0;
        }

        .match-team-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .match-team-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: var(--text-primary);
        }

        .match-team-league {
            font-size: 15px;
            color: var(--text-secondary);
            margin-top: 2px;
        }

        .match-center {
            text-align: center;
        }

        .match-score {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 50px;
            color: var(--text-primary);
            letter-spacing: 4px;
            line-height: 1;
        }

        .match-vs {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 34px;
            color: var(--text-muted);
            letter-spacing: 3px;
        }

        .match-status {
            display: inline-block;
            padding: 6px 18px;
            border-radius: 100px;
            font-family: 'Barlow', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 8px;
        }

        .status-live {
            background: var(--green-dim);
            color: var(--green);
            border: 1px solid rgba(0,230,118,0.3);
            animation: pulse-green 2s infinite;
        }

        @keyframes pulse-green {
            0%,100% { box-shadow: 0 0 0 rgba(0,230,118,0); }
            50% { box-shadow: 0 0 12px rgba(0,230,118,0.4); }
        }

        .status-upcoming {
            background: rgba(240,165,0,0.1);
            color: var(--accent);
            border: 1px solid var(--border-accent);
        }

        .status-finished {
            background: rgba(255,255,255,0.05);
            color: var(--text-secondary);
            border: 1px solid var(--border);
        }

        .match-time {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            color: var(--text-secondary);
            letter-spacing: 2px;
            margin-top: 4px;
        }

        /* ═══════════════════════════════════════
           CLASIFICACIÓN
        ═══════════════════════════════════════ */
        .standings-table {
            width: 100%;
            background: var(--bg-card);
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid var(--border);
            margin-bottom: 28px;
            border-collapse: collapse;
        }

        .standings-table thead {
            background: var(--bg-surface);
        }

        .standings-table thead tr {
            border-bottom: 1px solid var(--border-accent);
        }

        .standings-table th {
            padding: 16px 14px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-secondary);
            text-align: center;
        }

        .standings-table th:first-child,
        .standings-table th:nth-child(2) {
            text-align: left;
        }

        .standings-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.2s;
        }

        .standings-table tbody tr:last-child {
            border-bottom: none;
        }

        .standings-table tbody tr:hover {
            background: var(--bg-surface);
        }

        .standings-table tbody tr.top-3 {
            background: rgba(240,165,0,0.04);
        }

        .standings-table td {
            padding: 16px 14px;
            font-size: 17px;
            text-align: center;
            color: var(--text-secondary);
        }

        .standings-table td:first-child,
        .standings-table td:nth-child(2) {
            text-align: left;
        }

        .pos-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 26px;
            width: 36px;
            display: inline-block;
            text-align: center;
            letter-spacing: 1px;
        }

        .pos-num.gold { color: #f0c050; }
        .pos-num.silver { color: #b0b8cc; }
        .pos-num.bronze { color: #cd7c3a; }

        .st-team {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .st-team-logo {
            width: 40px;
            height: 40px;
            background: var(--bg-surface);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 13px;
            letter-spacing: 1px;
            color: var(--accent);
            border: 1px solid var(--border);
            flex-shrink: 0;
        }

        .st-team-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }

        .st-team-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 19px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .st-pts {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            color: var(--accent);
            letter-spacing: 1px;
        }

        .form-dot {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            font-family: 'Barlow', sans-serif;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0;
            margin: 0 2px;
        }

        .form-w { background: rgba(0,230,118,0.15); color: var(--green); border: 1px solid rgba(0,230,118,0.3); }
        .form-l { background: rgba(255,79,0,0.12); color: #ff6b4a; border: 1px solid rgba(255,79,0,0.3); }
        .form-d { background: rgba(255,255,255,0.05); color: var(--text-secondary); border: 1px solid var(--border); }

        /* ═══════════════════════════════════════
           EMPTY STATE
        ═══════════════════════════════════════ */
        .empty {
            text-align: center;
            padding: 80px 20px;
            background: var(--bg-card);
            border-radius: 16px;
            border: 1px dashed var(--border);
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-text {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--text-secondary);
        }

        /* ═══════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════ */
        @media (max-width: 768px) {
            .nav-tabs { display: none; }
            .mobile-tabs { display: flex !important; }
            .mobile-tabs .nav-tab { white-space: nowrap; font-size: 16px; padding: 10px 18px; }
            .leagues-grid { grid-template-columns: 1fr; }
            .teams-grid { grid-template-columns: repeat(2, 1fr); }
            .match-card {
                grid-template-columns: 1fr;
                gap: 16px;
                padding: 20px;
            }
            .match-team.right {
                flex-direction: row;
                text-align: left;
            }
            .hero h1 { font-size: 64px; }
            .hero-stats-strip {
                flex-wrap: wrap;
                border-radius: 12px;
            }
            .hero-stat {
                flex: 1 1 calc(33% - 1px);
                border-bottom: 1px solid var(--border);
            }
            .nav-container { padding: 0 16px; }
            body { font-size: 17px; }
        }

        /* ═══════════════════════════════════════
           SCROLL SUAVE
        ═══════════════════════════════════════ */
        html { scroll-behavior: smooth; }

        /* ═══════════════════════════════════════
           SCROLLBAR CUSTOM
        ═══════════════════════════════════════ */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-void); }
        ::-webkit-scrollbar-thumb { background: var(--bg-surface); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--accent); }
    </style>
</head>
<body>

    <!-- NAVEGACIÓN -->
    <nav>
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <div class="logo-icon">🏈</div>
                <div class="logo-text">
                    <span class="logo-title">Flag Football</span>
                    <span class="logo-sub">Liga Oficial</span>
                </div>
            </a>

            <div class="nav-tabs">
                <button class="nav-tab active" onclick="switchTab('ligas', this)">Ligas</button>
                <button class="nav-tab" onclick="switchTab('equipos', this)">Equipos</button>
                <button class="nav-tab" onclick="switchTab('calendario', this)">Calendario</button>
                <button class="nav-tab" onclick="switchTab('clasificacion', this)">Clasificación</button>
            </div>

            <a href="{{ route('login') }}" class="btn-login">Iniciar Sesión</a>
        </div>
    </nav>

    <!-- TABS MÓVILES -->
    <div class="container" style="padding-top: 24px; padding-bottom: 0;">
        <div class="mobile-tabs">
            <button class="nav-tab active" onclick="switchTab('ligas', this)">Ligas</button>
            <button class="nav-tab" onclick="switchTab('equipos', this)">Equipos</button>
            <button class="nav-tab" onclick="switchTab('calendario', this)">Calendario</button>
            <button class="nav-tab" onclick="switchTab('clasificacion', this)">Clasificación</button>
        </div>
    </div>

    <!-- HERO -->
    <div class="hero">
        <div class="hero-bg"></div>
        <div class="hero-field-lines"></div>
        <div class="hero-content">
            <div class="hero-tag">
                <div class="hero-tag-dot"></div>
                Temporada {{ date('Y') }} En Curso
            </div>
            <h1>
                El Mejor<br>
                <span class="accent-word">Flag</span> <span class="outline-word">Football</span>
            </h1>
            <p class="hero-desc">Sigue en tiempo real los resultados, equipos y clasificaciones de todas las ligas</p>
            <div class="hero-stats-strip">
                <div class="hero-stat">
                    <span class="hero-stat-val">{{ $leagues->count() }}</span>
                    <span class="hero-stat-lbl">Ligas</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-val">{{ $leagues->sum('teams_count') }}</span>
                    <span class="hero-stat-lbl">Equipos</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-val">{{ $leagues->sum('games_count') }}</span>
                    <span class="hero-stat-lbl">Partidos</span>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="container">

        <!-- TAB 1: LIGAS -->
        <div id="tab-ligas" class="tab-content active">
            <div class="section-header">
                <div>
                    <div class="section-subtitle">Temporada {{ date('Y') }}</div>
                    <h2 class="section-title">Ligas Activas</h2>
                </div>
            </div>

            @if($leagues->count() > 0)
                <div class="leagues-grid">
                    @foreach($leagues as $league)
                        <div class="league-card">
                            <div class="league-header">
                                <div class="league-header-bg"></div>
                                <div class="league-header-pattern"></div>
                                <div class="league-logo">
                                    @if($league->logo)
                                        <img src="{{ asset('storage/' . $league->logo) }}" alt="{{ $league->name }}">
                                    @else
                                        {{ strtoupper(substr($league->short_name, 0, 3)) }}
                                    @endif
                                </div>
                                <div class="league-name">{{ $league->name }}</div>
                                <div class="league-location">
                                    📍 {{ $league->city ? $league->city . ', ' : '' }}{{ $league->country ?? 'Internacional' }}
                                </div>
                            </div>
                            <div class="league-body">
                                <div class="league-stats">
                                    <div class="stat-item">
                                        <span class="stat-value">{{ $league->teams_count }}</span>
                                        <span class="stat-label">Equipos</span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-value">{{ $league->seasons_count }}</span>
                                        <span class="stat-label">Temporadas</span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-value">{{ $league->games_count ?? 0 }}</span>
                                        <span class="stat-label">Partidos</span>
                                    </div>
                                </div>
                                <a href="{{ route('league.home', $league->id) }}" class="btn-enter-league">
                                    Ver Liga →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty">
                    <div class="empty-icon">🏆</div>
                    <div class="empty-text">No hay ligas disponibles</div>
                </div>
            @endif
        </div>

        <!-- TAB 2: EQUIPOS -->
        <div id="tab-equipos" class="tab-content">
            <div class="section-header">
                <div>
                    <div class="section-subtitle">Registrados</div>
                    <h2 class="section-title">Equipos</h2>
                </div>
            </div>

            @forelse($leagues as $league)
                @if($league->teams->count() > 0)
                    <div class="league-section">
                        <div class="league-section-header">
                            <div class="league-icon">
                                @if($league->logo)
                                    <img src="{{ asset('storage/' . $league->logo) }}" alt="{{ $league->name }}">
                                @else
                                    {{ strtoupper(substr($league->short_name, 0, 3)) }}
                                @endif
                            </div>
                            <div>
                                <div class="league-section-name">{{ $league->name }}</div>
                                <div class="league-section-meta">{{ $league->teams->count() }} equipos registrados</div>
                            </div>
                        </div>

                        <div class="teams-grid">
                            @foreach($league->teams as $team)
                                <a href="{{ route('league.teams.show', [$league->id, $team->id]) }}" class="team-card">
                                    <div class="team-logo">
                                        @if($team->logo)
                                            <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}">
                                        @else
                                            {{ strtoupper(substr($team->short_name, 0, 2)) }}
                                        @endif
                                    </div>
                                    <div class="team-name">{{ $team->name }}</div>
                                    @if($team->city)
                                        <div class="team-city">{{ $team->city }}</div>
                                    @endif
                                    <div class="team-badge">
                                        👥 {{ $team->players_count ?? $team->players->count() }} jugadores
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @empty
                <div class="empty">
                    <div class="empty-icon">🏢</div>
                    <div class="empty-text">No hay equipos registrados</div>
                </div>
            @endforelse
        </div>

        <!-- TAB 3: CALENDARIO -->
        <div id="tab-calendario" class="tab-content">
            <div class="section-header">
                <div>
                    <div class="section-subtitle">Próximos & Recientes</div>
                    <h2 class="section-title">Calendario</h2>
                </div>
            </div>

            <div class="filters">
                <button class="filter-btn active" onclick="filterGames('all', this)">Todos</button>
                <button class="filter-btn" onclick="filterGames('live', this)">🔴 En vivo</button>
                <button class="filter-btn" onclick="filterGames('upcoming', this)">Próximos</button>
                <button class="filter-btn" onclick="filterGames('finished', this)">Finalizados</button>
            </div>

            @forelse($games as $date => $dayGames)
                <div class="match-day">
                    <div class="match-day-label">{{ \Carbon\Carbon::parse($date)->translatedFormat('l, j \de F \de Y') }}</div>

                    @foreach($dayGames as $game)
                        <div class="match-card {{ $game->status === 'in_progress' ? 'live' : '' }}"
                             data-status="{{ $game->status }}"
                             data-league="{{ $game->season->league_id ?? '' }}">

                            <div class="match-team">
                                <div class="match-team-logo">
                                    @if($game->homeTeam->logo)
                                        <img src="{{ asset('storage/' . $game->homeTeam->logo) }}" alt="{{ $game->homeTeam->name }}">
                                    @else
                                        {{ strtoupper(substr($game->homeTeam->short_name, 0, 2)) }}
                                    @endif
                                </div>
                                <div>
                                    <div class="match-team-name">{{ $game->homeTeam->name }}</div>
                                    <div class="match-team-league">{{ $game->homeTeam->league->name ?? '' }}</div>
                                </div>
                            </div>

                            <div class="match-center">
                                @if($game->status === 'in_progress')
                                    <div class="match-score">{{ $game->home_score ?? 0 }} - {{ $game->away_score ?? 0 }}</div>
                                    <span class="match-status status-live">● EN VIVO</span>
                                @elseif($game->status === 'finished')
                                    <div class="match-score">{{ $game->home_score }} - {{ $game->away_score }}</div>
                                    <span class="match-status status-finished">FINAL</span>
                                @else
                                    <div class="match-vs">VS</div>
                                    <div class="match-time">{{ \Carbon\Carbon::parse($game->date)->format('H:i') }}</div>
                                    <span class="match-status status-upcoming">PRÓXIMO</span>
                                @endif
                            </div>

                            <div class="match-team right">
                                <div class="match-team-logo">
                                    @if($game->awayTeam->logo)
                                        <img src="{{ asset('storage/' . $game->awayTeam->logo) }}" alt="{{ $game->awayTeam->name }}">
                                    @else
                                        {{ strtoupper(substr($game->awayTeam->short_name, 0, 2)) }}
                                    @endif
                                </div>
                                <div>
                                    <div class="match-team-name">{{ $game->awayTeam->name }}</div>
                                    <div class="match-team-league">{{ $game->awayTeam->league->name ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="empty">
                    <div class="empty-icon">📅</div>
                    <div class="empty-text">No hay partidos programados</div>
                </div>
            @endforelse
        </div>

        <!-- TAB 4: CLASIFICACIÓN -->
        <div id="tab-clasificacion" class="tab-content">
            <div class="section-header">
                <div>
                    <div class="section-subtitle">Temporada {{ date('Y') }}</div>
                    <h2 class="section-title">Clasificación</h2>
                </div>
            </div>

            @forelse($leagues as $league)
                @if($league->standings && $league->standings->count() > 0)
                    <div class="league-section">
                        <div class="league-section-header">
                            <div class="league-icon">
                                @if($league->logo)
                                    <img src="{{ asset('storage/' . $league->logo) }}" alt="{{ $league->name }}">
                                @else
                                    {{ strtoupper(substr($league->short_name, 0, 3)) }}
                                @endif
                            </div>
                            <div>
                                <div class="league-section-name">{{ $league->name }}</div>
                                <div class="league-section-meta">{{ $league->standings->count() }} equipos</div>
                            </div>
                        </div>

                        <table class="standings-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Equipo</th>
                                    <th>PJ</th>
                                    <th>PG</th>
                                    <th>PP</th>
                                    <th>PE</th>
                                    <th>PF</th>
                                    <th>PC</th>
                                    <th>Forma</th>
                                    <th>PTS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($league->standings->sortByDesc('points') as $i => $standing)
                                    <tr class="{{ $i < 3 ? 'top-3' : '' }}">
                                        <td>
                                            <span class="pos-num {{ $i === 0 ? 'gold' : ($i === 1 ? 'silver' : ($i === 2 ? 'bronze' : '')) }}">
                                                {{ $i + 1 }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="st-team">
                                                <div class="st-team-logo">
                                                    @if($standing->team->logo)
                                                        <img src="{{ asset('storage/' . $standing->team->logo) }}" alt="{{ $standing->team->name }}">
                                                    @else
                                                        {{ strtoupper(substr($standing->team->short_name, 0, 2)) }}
                                                    @endif
                                                </div>
                                                <span class="st-team-name">{{ $standing->team->name }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $standing->played }}</td>
                                        <td>{{ $standing->wins }}</td>
                                        <td>{{ $standing->losses }}</td>
                                        <td>{{ $standing->ties }}</td>
                                        <td>{{ $standing->goals_for }}</td>
                                        <td>{{ $standing->goals_against }}</td>
                                        <td>
                                            @foreach(str_split(substr($standing->form ?? 'XXXXX', -5)) as $f)
                                                <span class="form-dot {{ $f === 'W' ? 'form-w' : ($f === 'L' ? 'form-l' : 'form-d') }}">
                                                    {{ $f }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td><span class="st-pts">{{ $standing->points }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @empty
                <div class="empty">
                    <div class="empty-icon">🏅</div>
                    <div class="empty-text">No hay clasificaciones disponibles</div>
                </div>
            @endforelse
        </div>

    </div>

    <script>
        function switchTab(tab, btn) {
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
            document.getElementById('tab-' + tab).classList.add('active');
            document.querySelectorAll('.nav-tab').forEach(t => {
                if (t.getAttribute('onclick') && t.getAttribute('onclick').includes(tab)) {
                    t.classList.add('active');
                }
            });
        }

        function filterGames(filter, btn) {
            document.querySelectorAll('.filter-btn').forEach(f => f.classList.remove('active'));
            btn.classList.add('active');

            const cards = document.querySelectorAll('.match-card');
            cards.forEach(card => {
                if (filter === 'all') {
                    card.style.display = '';
                } else if (filter === 'live') {
                    card.style.display = card.dataset.status === 'in_progress' ? '' : 'none';
                } else if (filter === 'upcoming') {
                    card.style.display = card.dataset.status === 'scheduled' ? '' : 'none';
                } else if (filter === 'finished') {
                    card.style.display = card.dataset.status === 'finished' ? '' : 'none';
                }
            });

            document.querySelectorAll('.match-day').forEach(day => {
                const visible = day.querySelectorAll('.match-card:not([style*="none"])');
                day.style.display = visible.length === 0 ? 'none' : '';
            });
        }
    </script>
</body>
</html>