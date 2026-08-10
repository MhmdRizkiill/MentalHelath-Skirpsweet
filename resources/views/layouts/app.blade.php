<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Monitoring Kesehatan Mental (DASS-42)</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=2">

    <!-- Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Script Pencegah FOUC (Flash of Unstyled Content) -->
    <script>
        const savedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const theme = savedTheme || (systemPrefersDark ? 'dark' : 'light');
        document.documentElement.setAttribute('data-bs-theme', theme);
    </script>

    <style>
        /* PALETTE WARNA "CALMING SAGE & SOFT EARTH" (LIGHT MODE) */
        :root {
            --primary: #4A7A6D;          /* Sage Green */
            --primary-hover: #3B6358;
            --secondary: #6B9080;        /* Soft Teal Mint */
            --accent: #A3C1AD;           /* Soft Leaf */

            --bg-light: #F4F7F6;
            --bg-mid: #E8F0EC;
            --bg-soft: #F0F4F1;

            --success: #38A169;
            --danger: #E53E3E;
            --warning: #DD6B20;
            --card-bg: rgba(255, 255, 255, 0.88);
            --border: rgba(203, 213, 208, 0.6);
            --text: #2D3748;             /* Slate Gray */
            --muted: #64748B;
            --radius-lg: 22px;
            --radius-md: 14px;
            --sidebar-width: 280px;
        }

        /* PALETTE WARNA "NIGHT SAGE" (DARK MODE) */
        [data-bs-theme="dark"] {
            --primary: #6BB29E;          /* Sage lebih terang untuk dark mode */
            --primary-hover: #83C5B3;
            --secondary: #4A7A6D;
            --accent: #3B6358;

            --bg-light: #0F172A;         /* Dark Slate */
            --bg-mid: #1E293B;           /* Medium Dark Slate */
            --bg-soft: #1E293B;

            --card-bg: rgba(30, 41, 59, 0.88);
            --border: rgba(255, 255, 255, 0.1);
            --text: #F8FAFC;             /* Putih terang */
            --muted: #94A3B8;
        }

        /* ==========================================
           OVERRIDE UTILITY BOOTSTRAP UNTUK DARK MODE
           (Agar dashboard bawaan langsung rapi tanpa diubah)
        =========================================== */
        [data-bs-theme="dark"] .text-dark,
        [data-bs-theme="dark"] h1,
        [data-bs-theme="dark"] h2,
        [data-bs-theme="dark"] h3,
        [data-bs-theme="dark"] h4,
        [data-bs-theme="dark"] h5,
        [data-bs-theme="dark"] h6 {
            color: #F8FAFC !important;
        }

        [data-bs-theme="dark"] .bg-white {
            background-color: var(--card-bg) !important;
            color: var(--text) !important;
            border-color: var(--border) !important;
        }

        [data-bs-theme="dark"] .text-muted {
            color: #94A3B8 !important;
        }

        [data-bs-theme="dark"] .card,
        [data-bs-theme="dark"] .card-header,
        [data-bs-theme="dark"] .card-footer {
            background-color: var(--card-bg) !important;
            border-color: var(--border) !important;
            color: var(--text) !important;
        }

        [data-bs-theme="dark"] canvas {
            filter: initial;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        /* LATAR BELAKANG GRADASI MENENANGKAN */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, var(--bg-light) 0%, var(--bg-mid) 50%, var(--bg-soft) 100%);
            background-attachment: fixed;
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            transition: background 0.3s ease, color 0.3s ease;
        }

        /* AMBIENT GLOW SOFT SAGE IN BACKGROUND */
        body::before {
            content: '';
            position: fixed;
            top: -15%;
            right: -10%;
            width: 750px;
            height: 750px;
            background: radial-gradient(circle, rgba(107, 144, 128, 0.18) 0%, rgba(107, 144, 128, 0) 70%);
            border-radius: 50%;
            z-index: -1;
            pointer-events: none;
            filter: blur(40px);
            animation: floatAmbient 12s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -15%;
            left: -10%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(163, 193, 173, 0.22) 0%, rgba(163, 193, 173, 0) 70%);
            border-radius: 50%;
            z-index: -1;
            pointer-events: none;
            filter: blur(40px);
            animation: floatAmbient 15s ease-in-out infinite reverse;
        }

        /* Penyesuaian Ambient Dark Mode */
        [data-bs-theme="dark"] body::before {
            background: radial-gradient(circle, rgba(107, 178, 158, 0.08) 0%, rgba(10, 15, 24, 0) 70%);
        }
        [data-bs-theme="dark"] body::after {
            background: radial-gradient(circle, rgba(74, 122, 109, 0.1) 0%, rgba(10, 15, 24, 0) 70%);
        }

        @keyframes floatAmbient {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-30px, 20px) scale(1.05); }
            100% { transform: translate(0, 0) scale(1); }
        }

        /* LAYOUT CONTAINER */
        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR (SOFT GLASSMORPHISM) */
        .sidebar {
            width: var(--sidebar-width);
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-right: 1px solid var(--border);
            box-shadow: 4px 0 24px rgba(74, 122, 109, 0.04);
            height: 100vh;
            height: 100dvh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1020;
            display: flex;
            flex-direction: column;
            padding: 24px 20px 24px 20px;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), background 0.3s ease;
        }

        [data-bs-theme="dark"] .sidebar {
            background: rgba(15, 23, 42, 0.92);
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.2);
        }

        /* OVERLAY UNTUK MOBILE SAAT SIDEBAR TERBUKA */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            height: 100dvh;
            background: rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: 1015;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        /* LOGO BRANDING */
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            margin-bottom: 24px;
            flex-shrink: 0;
        }

        .brand-icon-wrapper {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #4A7A6D26 0%, #6B908033 100%);
            border: 1px solid #4A7A6D33;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 22px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(74, 122, 109, 0.1);
        }

        [data-bs-theme="dark"] .brand-icon-wrapper {
            background: rgba(107, 178, 158, 0.15);
            border-color: rgba(107, 178, 158, 0.2);
        }

        /* PROFIL USER DI SIDEBAR */
        .user-profile-card {
            display: flex;
            align-items: center;
            padding: 12px 14px;
            background: rgba(244, 247, 246, 0.85);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            flex-shrink: 0;
            transition: background 0.3s ease;
        }

        [data-bs-theme="dark"] .user-profile-card {
            background: rgba(30, 41, 59, 0.85);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 15px;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(74, 122, 109, 0.2);
        }

        /* MENU NAVIGASI SIDEBAR */
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex: 1;
        }

        .menu-section-title {
            font-size: 11px;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 700;
            letter-spacing: 1px;
            padding: 10px 12px 6px;
        }

        .nav-item {
            margin-bottom: 6px;
        }

        .nav-link {
            font-weight: 600;
            font-size: 14.5px;
            color: var(--text) !important;
            padding: 12px 16px !important;
            border-radius: var(--radius-md);
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .nav-link i {
            font-size: 19px;
            width: 24px;
            text-align: center;
            margin-right: 12px;
            color: var(--primary);
            transition: transform 0.2s ease;
        }

        .nav-link:hover {
            background: rgba(74, 122, 109, 0.08);
            color: var(--primary) !important;
            transform: translateX(3px);
        }

        [data-bs-theme="dark"] .nav-link:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
            color: #FFFFFF !important;
            box-shadow: 0 8px 18px rgba(74, 122, 109, 0.25);
        }

        .nav-link.active i {
            color: #FFFFFF;
        }

        /* MAIN CONTENT AREA */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: calc(100% - var(--sidebar-width));
            transition: all 0.3s ease;
        }

        .content-area {
            flex: 1;
            padding: 35px 40px;
            max-width: 1300px;
            width: 100%;
            margin: 0 auto;
        }

        /* MOBILE HEADER BAR */
        .mobile-header {
            display: none;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1010;
            align-items: center;
            justify-content: space-between;
            transition: background 0.3s ease;
        }

        [data-bs-theme="dark"] .mobile-header {
            background: rgba(15, 23, 42, 0.85);
        }

        [data-bs-theme="dark"] #sidebarToggle {
            background: var(--bg-mid);
            border-color: var(--border);
            color: var(--text);
        }

        /* RESPONSIVE LAYOUT (UNTUK TABLET & HP) */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: 10px 0 30px rgba(0, 0, 0, 0.12);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .mobile-header {
                display: flex;
            }

            .content-area {
                padding: 24px 16px;
            }
        }

        /* CARDS DENGAN SOFT GLASSMORPHISM */
        .card {
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 10px 30px -5px rgba(74, 122, 109, 0.05), 0 4px 12px rgba(15, 23, 42, 0.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            box-shadow: 0 14px 35px -5px rgba(74, 122, 109, 0.08), 0 6px 15px rgba(15, 23, 42, 0.03);
        }

        [data-bs-theme="dark"] .card {
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.3);
        }

        /* TOMBOL SOFT & RAMAH */
        .btn {
            border-radius: var(--radius-md);
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.25s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            color: white;
            box-shadow: 0 6px 18px rgba(74, 122, 109, 0.22);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(74, 122, 109, 0.32);
            color: white;
            background: linear-gradient(135deg, var(--primary-hover) 0%, var(--primary) 100%);
        }

        /* OPSI JAWABAN SKRINING */
        .option-label { display: block; margin-bottom: 12px; cursor: pointer; }
        .option-input { display: none; }

        .option-button {
            display: flex; align-items: center; width: 100%;
            padding: 16px 20px; border: 2px solid var(--border);
            border-radius: var(--radius-md); background-color: var(--card-bg);
            color: var(--text); font-weight: 600; transition: all 0.2s ease-in-out;
        }

        .option-label:hover .option-button {
            border-color: var(--primary); background-color: rgba(74, 122, 109, 0.05);
        }

        [data-bs-theme="dark"] .option-label:hover .option-button {
            background-color: rgba(107, 178, 158, 0.1);
        }

        .option-input:checked + .option-button {
            background-color: var(--primary); border-color: var(--primary);
            color: #ffffff; box-shadow: 0 8px 20px rgba(74, 122, 109, 0.25);
        }

        .option-input:checked + .option-button .text-muted,
        .option-input:checked + .option-button .option-point {
            color: rgba(255, 255, 255, 0.85) !important;
        }

        .option-icon { margin-right: 12px; font-size: 1.2rem; color: var(--muted); transition: all 0.2s; }
        .option-input:checked + .option-button .option-icon { color: #ffffff; }

        /* BADGE STATUS YANG TIDAK INTIMIDATIF */
        .badge-status {
            background-color: transparent !important;
            border: 1.5px solid;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .status-normal { border-color: var(--success); color: var(--success); }
        .status-ringan { border-color: #3182CE; color: #3182CE; }
        .status-sedang { border-color: var(--warning); color: var(--warning); }
        .status-parah { border-color: var(--danger); color: var(--danger); }
        .status-sangat-parah { border-color: #9B2C2C; color: #E53E3E; }

        /* SCROLLBAR */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-thumb { background: var(--muted); border-radius: 10px; }

        /* Modal Adjustments for Dark Mode */
        [data-bs-theme="dark"] .modal-content {
            background: rgba(30, 41, 59, 0.95) !important;
            border: 1px solid var(--border) !important;
        }
    </style>
</head>
<body>

    <!-- OVERLAY GELAP SAAT SIDEBAR HP TERBUKA -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="app-layout">

        <!-- ==========================================
             SIDEBAR NAVIGASI
        =========================================== -->
        <aside class="sidebar" id="mainSidebar">

            <!-- BRAND LOGO -->
            <a href="#" class="brand-logo">
                <div class="brand-icon-wrapper">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
                <span class="fw-bold fs-3" style="letter-spacing: -0.5px; color: var(--text);">
                    Mind<span style="color: var(--primary);">Screen</span>
                </span>
            </a>

            @auth
                <!-- PROFIL USER -->
                <div class="user-profile-card">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                    </div>
                    <div class="ms-3 overflow-hidden">
                        <div class="fw-bold text-truncate" style="font-size: 14px; color: var(--text);">{{ Auth::user()->username }}</div>
                        <div class="text-muted text-truncate text-capitalize" style="font-size: 12px;">{{ Auth::user()->role }}</div>
                    </div>
                </div>
            @endauth

            <!-- MENU NAVIGASI -->
            <ul class="sidebar-menu">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <li class="menu-section-title">Menu Admin</li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.questions.*') ? 'active' : '' }}" href="{{ route('admin.questions.index') }}">
                                <i class="bi bi-patch-question"></i> Kelola Pertanyaan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                <i class="bi bi-people"></i> Kelola Pengguna
                            </a>
                        </li>
                    @elseif(Auth::user()->role === 'mahasiswa')
                        <li class="menu-section-title">Menu Mahasiswa</li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}" href="{{ route('mahasiswa.dashboard') }}">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('mahasiswa.screenings.onboarding', 'mahasiswa.screenings.create') ? 'active' : '' }}" href="{{ route('mahasiswa.screenings.onboarding') }}">
                                <i class="bi bi-clipboard2-pulse"></i> Skrining Baru
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('mahasiswa.screenings.index') ? 'active' : '' }}" href="{{ route('mahasiswa.screenings.index') }}">
                                <i class="bi bi-clock-history"></i> Riwayat
                            </a>
                        </li>
                    @endif

                    <li class="menu-section-title mt-3">Pengaturan</li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.index') }}">
                            <i class="bi bi-person-gear"></i> Profil Saya
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="bi bi-person-plus"></i> Register
                        </a>
                    </li>
                @endauth

                <!-- TOMBOL TOGGLE TEMA (Desktop/Sidebar) -->
                <li class="nav-item mt-2">
                    <button class="nav-link w-100 text-start bg-transparent border-0" id="themeToggleSidebar">
                        <i class="bi bi-moon-stars-fill" id="themeIconSidebar"></i>
                        <span id="themeTextSidebar">Mode Gelap</span>
                    </button>
                </li>
            </ul>

            @auth
                <!-- TOMBOL KELUAR DI BAWAH SIDEBAR -->
                <div class="pt-3 border-top mt-auto flex-shrink-0" style="border-color: var(--border) !important;">
                    <button type="button" class="btn w-100 fw-bold d-flex align-items-center justify-content-center"
                            style="border: 1px solid rgba(229, 62, 62, 0.2); background: rgba(229, 62, 62, 0.05); color: var(--danger); border-radius: var(--radius-md); padding: 11px;"
                            data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="bi bi-box-arrow-right me-2"></i> Keluar Aplikasi
                    </button>
                </div>
            @endauth

        </aside>

        <!-- ==========================================
             MAIN CONTENT AREA
        =========================================== -->
        <main class="main-content">

            <!-- HEADER KHUSUS MOBILE -->
            <header class="mobile-header">
                <a href="#" class="d-flex align-items-center gap-2 text-decoration-none">
                    <div class="brand-icon-wrapper" style="width: 36px; height: 36px; font-size: 18px;">
                        <i class="bi bi-heart-pulse-fill"></i>
                    </div>
                    <span class="fw-bold fs-4" style="color: var(--text);">Mind<span style="color: var(--primary);">Screen</span></span>
                </a>

                <div class="d-flex align-items-center gap-2">
                    <!-- TOMBOL TOGGLE TEMA (Mobile) -->
                    <button class="btn btn-link text-decoration-none p-2" id="themeToggleMobile" style="color: var(--text);">
                        <i class="bi bi-moon-stars-fill fs-5" id="themeIconMobile"></i>
                    </button>
                    <!-- TOGGLE SIDEBAR -->
                    <button class="btn btn-light border p-2" type="button" id="sidebarToggle">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                </div>
            </header>

            <!-- KONTEN UTAMA HALAMAN -->
            <div class="content-area">
                @yield('content')
            </div>

            <!-- FOOTER -->
            <footer class="mt-auto py-4 px-4 text-center text-muted" style="font-size: 13px; background: rgba(255,255,255,0.05); backdrop-filter: blur(8px);">
                &copy; {{ date('Y') }} MentalHealthApp &bull; Sistem Skrining DASS-42
            </footer>

        </main>

    </div>

    <!-- TOAST NOTIFICATION CONTAINER -->
    <div class="toast-container position-fixed top-0 end-0 p-3 mt-3" style="z-index: 1060;">
        @if (session('success') || session('status'))
            <div class="toast align-items-center text-bg-success border-0 shadow-lg rounded-4 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fw-semibold py-3 px-4 d-flex align-items-center" style="font-size: 14px;">
                        <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                        {{ session('success') ?? session('status') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-3 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="toast align-items-center text-bg-danger border-0 shadow-lg rounded-4 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fw-semibold py-3 px-4 d-flex align-items-center" style="font-size: 14px;">
                        <i class="bi bi-exclamation-triangle-fill me-3 fs-5"></i>
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-3 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>

    <!-- MODAL KONFIRMASI LOGOUT -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; background: var(--card-bg); backdrop-filter: blur(16px);">
                <div class="modal-header border-bottom-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center py-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 rounded-circle mb-4" style="width: 80px; height: 80px;">
                        <i class="bi bi-box-arrow-right text-warning" style="font-size: 2.5rem;"></i>
                    </div>

                    <h5 class="fw-bold mb-2" style="color: var(--text);">Yakin Ingin Keluar?</h5>
                    <p class="text-muted mb-0" style="font-size: 15px;">
                        Sesi Anda akan diakhiri. Pastikan semua pekerjaan Anda sudah tersimpan.
                    </p>
                </div>

                <div class="modal-footer border-top-0 justify-content-center pt-0 pb-4 gap-2">
                    <button type="button" class="btn btn-secondary px-4 py-2 fw-semibold rounded-pill" data-bs-dismiss="modal" style="background-color: var(--bg-mid); color: var(--text); border: none;">
                        Batal
                    </button>

                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4 py-2 fw-semibold rounded-pill shadow-sm" style="background-color: var(--danger); border: none;">
                            Ya, Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ==========================================
            // LOGIKA DARK MODE / LIGHT MODE
            // ==========================================
            const themeToggleSidebar = document.getElementById('themeToggleSidebar');
            const themeToggleMobile = document.getElementById('themeToggleMobile');
            const themeIconSidebar = document.getElementById('themeIconSidebar');
            const themeIconMobile = document.getElementById('themeIconMobile');
            const themeTextSidebar = document.getElementById('themeTextSidebar');

            // Fungsi untuk update icon & text berdasarkan tema aktif
            function updateThemeUI(theme) {
                const isDark = theme === 'dark';
                const iconClass = isDark ? 'bi-sun-fill' : 'bi-moon-stars-fill';
                const iconColor = isDark ? '#FBBF24' : ''; // Kuning saat dark (matahari)
                const text = isDark ? 'Mode Terang' : 'Mode Gelap';

                if (themeIconSidebar) {
                    themeIconSidebar.className = `bi ${iconClass}`;
                    themeIconSidebar.style.color = iconColor;
                }
                if (themeTextSidebar) {
                    themeTextSidebar.textContent = text;
                }
                if (themeIconMobile) {
                    themeIconMobile.className = `bi ${iconClass} fs-5`;
                    themeIconMobile.style.color = iconColor;
                }
            }

            // Inisialisasi UI pertama kali
            const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
            updateThemeUI(currentTheme);

            // Fungsi saat tombol toggle diklik
            function toggleTheme() {
                let activeTheme = document.documentElement.getAttribute('data-bs-theme');
                let newTheme = activeTheme === 'dark' ? 'light' : 'dark';

                document.documentElement.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateThemeUI(newTheme);
                window.dispatchEvent(new CustomEvent('themeChanged', {
                    detail: { theme: newTheme }
                }));
            }

            // Pasang event listener ke tombol desktop dan mobile
            if (themeToggleSidebar) themeToggleSidebar.addEventListener('click', toggleTheme);
            if (themeToggleMobile) themeToggleMobile.addEventListener('click', toggleTheme);

            // ==========================================
            // LOGIKA SIDEBAR MOBILE & TOAST
            // ==========================================
            const toastElList = document.querySelectorAll('.toast');
            const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl, { delay: 3000 }));
            toastList.forEach(toast => toast.show());

            const sidebarToggle = document.getElementById('sidebarToggle');
            const mainSidebar = document.getElementById('mainSidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            // Buka / Tutup Sidebar via Tombol Hamburger
            if (sidebarToggle && mainSidebar && sidebarOverlay) {
                sidebarToggle.addEventListener('click', function() {
                    mainSidebar.classList.toggle('show');
                    sidebarOverlay.classList.toggle('show');
                });

                // Tutup sidebar jika overlay (background gelap) diklik
                sidebarOverlay.addEventListener('click', function() {
                    mainSidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                });
            }
        });
    </script>

    {{-- Script tambahan dari setiap halaman melalui @push('scripts') --}}
    @stack('scripts')

</body>
</html>