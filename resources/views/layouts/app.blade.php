<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Monitoring Kesehatan Mental (DASS-42)</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=2">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = savedTheme || (systemDark ? 'dark' : 'light');
            document.documentElement.setAttribute('data-bs-theme', theme);
        })();
    </script>
    <style>
        :root {
            --primary: #4A7A6D;
            --primary-hover: #3B6358;
            --secondary: #6B9080;
            --accent: #A3C1AD;
            --bg-light: #F4F7F6;
            --bg-mid: #E8F0EC;
            --bg-soft: #F0F4F1;
            --success: #38A169;
            --danger: #E53E3E;
            --warning: #DD6B20;
            --card-bg: rgba(255,255,255,.88);
            --border: rgba(203,213,208,.6);
            --text: #2D3748;
            --muted: #64748B;
            --radius-lg: 22px;
            --radius-md: 14px;
            --sidebar-width: 280px;
        }

        [data-bs-theme="dark"] {
            --primary: #6BB29E;
            --primary-hover: #83C5B3;
            --secondary: #4A7A6D;
            --accent: #3B6358;
            --bg-light: #0F172A;
            --bg-mid: #1E293B;
            --bg-soft: #17211E;
            --card-bg: rgba(30,41,59,.9);
            --border: rgba(255,255,255,.1);
            --text: #F8FAFC;
            --muted: #94A3B8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg,var(--bg-light),var(--bg-mid),var(--bg-soft));
            background-attachment: fixed;
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
            transition: background .3s ease,color .3s ease;
        }

        body::before {
            content: '';
            position: fixed;
            top: -15%;
            right: -10%;
            width: 750px;
            height: 750px;
            background: radial-gradient(circle,rgba(107,144,128,.18),transparent 70%);
            border-radius: 50%;
            z-index: -1;
            pointer-events: none;
            filter: blur(40px);
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -15%;
            left: -10%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle,rgba(163,193,173,.22),transparent 70%);
            border-radius: 50%;
            z-index: -1;
            pointer-events: none;
            filter: blur(40px);
        }

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
            background: var(--card-bg) !important;
            color: var(--text) !important;
            border-color: var(--border) !important;
        }

        [data-bs-theme="dark"] .text-muted {
            color: #94A3B8 !important;
        }

        [data-bs-theme="dark"] .card,
        [data-bs-theme="dark"] .card-header,
        [data-bs-theme="dark"] .card-footer {
            background: var(--card-bg) !important;
            border-color: var(--border) !important;
            color: var(--text) !important;
        }

        [data-bs-theme="dark"] .table {
            --bs-table-color: var(--text);
            --bs-table-bg: transparent;
            --bs-table-border-color: var(--border);
        }

        [data-bs-theme="dark"] .form-control,
        [data-bs-theme="dark"] .form-select {
            background: rgba(15,23,42,.7);
            border-color: var(--border);
            color: var(--text);
        }

        [data-bs-theme="dark"] .form-control:focus,
        [data-bs-theme="dark"] .form-select:focus {
            background: rgba(15,23,42,.9);
            color: var(--text);
            border-color: var(--primary);
        }

        [data-bs-theme="dark"] .modal-content {
            background: rgba(30,41,59,.96) !important;
            border: 1px solid var(--border) !important;
            color: var(--text);
        }

        [data-bs-theme="dark"] .modal-header,
        [data-bs-theme="dark"] .modal-footer {
            border-color: var(--border) !important;
        }

        [data-bs-theme="dark"] .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: rgba(255,255,255,.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-right: 1px solid var(--border);
            height: 100vh;
            height: 100dvh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1020;
            display: flex;
            flex-direction: column;
            padding: 24px 20px;
            overflow-y: auto;
            transition: transform .3s ease,background .3s ease;
        }

        [data-bs-theme="dark"] .sidebar {
            background: rgba(15,23,42,.94);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.35);
            backdrop-filter: blur(4px);
            z-index: 1015;
        }

        .sidebar-overlay.show {
            display: block;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            margin-bottom: 24px;
        }

        .brand-icon-wrapper {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg,#4A7A6D26,#6B908033);
            border: 1px solid #4A7A6D33;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 22px;
        }

        .user-profile-card {
            display: flex;
            align-items: center;
            padding: 12px 14px;
            background: rgba(244,247,246,.85);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            margin-bottom: 20px;
        }

        [data-bs-theme="dark"] .user-profile-card {
            background: rgba(30,41,59,.85);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg,var(--primary),var(--secondary));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

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
            transition: all .25s ease;
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
        }

        .nav-link:hover {
            background: rgba(74,122,109,.08);
            color: var(--primary) !important;
            transform: translateX(3px);
        }

        .nav-link.active {
            background: linear-gradient(135deg,var(--primary),var(--primary-hover));
            color: #fff !important;
            box-shadow: 0 8px 18px rgba(74,122,109,.25);
        }

        .nav-link.active i {
            color: #fff;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: calc(100% - var(--sidebar-width));
        }

        .content-area {
            flex: 1;
            padding: 35px 40px;
            max-width: 1300px;
            width: 100%;
            margin: 0 auto;
        }

        .mobile-header {
            display: none;
            background: rgba(255,255,255,.85);
            backdrop-filter: blur(12px);
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1010;
            align-items: center;
            justify-content: space-between;
        }

        [data-bs-theme="dark"] .mobile-header {
            background: rgba(15,23,42,.9);
        }

        .theme-toggle {
            cursor: pointer;
            color: var(--text);
            transition: all .25s ease;
        }

        .theme-toggle:hover {
            color: var(--primary);
        }

        #themeToggleSidebar {
            color: var(--text) !important;
        }

        .card {
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            box-shadow: 0 10px 30px -5px rgba(74,122,109,.05);
            transition: all .3s ease;
        }

        .card:hover {
            box-shadow: 0 14px 35px -5px rgba(74,122,109,.08);
        }

        .btn {
            border-radius: var(--radius-md);
            font-weight: 600;
            padding: 10px 20px;
            transition: all .25s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg,var(--primary),var(--secondary));
            border: none;
            color: #fff;
            box-shadow: 0 6px 18px rgba(74,122,109,.22);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            color: #fff;
        }

        .form-control,
        .form-select {
            border-radius: var(--radius-md);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .2rem rgba(74,122,109,.15);
        }

        .option-label {
            display: block;
            margin-bottom: 12px;
            cursor: pointer;
        }

        .option-input {
            display: none;
        }

        .option-button {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 16px 20px;
            border: 2px solid var(--border);
            border-radius: var(--radius-md);
            background: var(--card-bg);
            color: var(--text);
            font-weight: 600;
            transition: all .2s ease;
        }

        .option-label:hover .option-button {
            border-color: var(--primary);
            background: rgba(74,122,109,.05);
        }

        .option-input:checked + .option-button {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
            box-shadow: 0 8px 20px rgba(74,122,109,.25);
        }

        .option-icon {
            margin-right: 12px;
            font-size: 1.2rem;
            color: var(--muted);
        }

        .option-input:checked + .option-button .option-icon {
            color: #fff;
        }

        .badge-status {
            background: transparent !important;
            border: 1.5px solid;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-normal {
            border-color: var(--success);
            color: var(--success);
        }

        .status-ringan {
            border-color: #3182CE;
            color: #3182CE;
        }

        .status-sedang {
            border-color: var(--warning);
            color: var(--warning);
        }

        .status-parah {
            border-color: var(--danger);
            color: var(--danger);
        }

        .status-sangat-parah {
            border-color: #9B2C2C;
            color: #E53E3E;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--muted);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: 10px 0 30px rgba(0,0,0,.12);
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

        @media (max-width: 575.98px) {
            .content-area {
                padding: 20px 14px;
            }

            .mobile-header {
                padding: 12px 14px;
            }

            .brand-icon-wrapper {
                width: 38px;
                height: 38px;
            }
        }
    </style>
</head>
<body>
<div class="app-layout">
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <aside class="sidebar" id="mainSidebar">
        <a href="#" class="brand-logo">
            <div class="brand-icon-wrapper"><i class="bi bi-heart-pulse-fill"></i></div>
            <span class="fw-bold fs-3" style="color:var(--text)">Mind<span style="color:var(--primary)">Screen</span></span>
        </a>

        @auth
        <div class="user-profile-card">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->username,0,1)) }}</div>
            <div class="ms-3 overflow-hidden">
                <div class="fw-bold text-truncate" style="font-size:14px;color:var(--text)">{{ Auth::user()->username }}</div>
                <div class="text-muted text-truncate text-capitalize" style="font-size:12px">{{ Auth::user()->role }}</div>
            </div>
        </div>
        @endauth

        <ul class="sidebar-menu">
            @auth
                @if(Auth::user()->role === 'admin')
                    <li class="menu-section-title">Menu Admin</li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.questions.*') ? 'active' : '' }}" href="{{ route('admin.questions.index') }}">
                            <i class="bi bi-patch-question"></i>Kelola Pertanyaan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people"></i>Kelola Pengguna
                        </a>
                    </li>
                @elseif(Auth::user()->role === 'mahasiswa')
                    <li class="menu-section-title">Menu Mahasiswa</li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}" href="{{ route('mahasiswa.dashboard') }}">
                            <i class="bi bi-house-door"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('mahasiswa.screenings.onboarding','mahasiswa.screenings.create') ? 'active' : '' }}" href="{{ route('mahasiswa.screenings.onboarding') }}">
                            <i class="bi bi-clipboard2-pulse"></i>Skrining Baru
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('mahasiswa.screenings.index') ? 'active' : '' }}" href="{{ route('mahasiswa.screenings.index') }}">
                            <i class="bi bi-clock-history"></i>Riwayat
                        </a>
                    </li>
                @endif

                <li class="menu-section-title mt-3">Pengaturan</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.index') }}">
                        <i class="bi bi-person-gear"></i>Profil Saya
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right"></i>Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">
                        <i class="bi bi-person-plus"></i>Register
                    </a>
                </li>
            @endauth

            <li class="nav-item mt-2">
                <button type="button" class="nav-link w-100 text-start bg-transparent border-0" id="themeToggleSidebar">
                    <i class="bi bi-moon-stars-fill" id="themeIconSidebar"></i>
                    <span id="themeTextSidebar">Mode Gelap</span>
                </button>
            </li>
        </ul>

        @auth
        <div class="pt-3 border-top mt-auto" style="border-color:var(--border)!important">
            <button type="button" class="btn w-100 fw-bold" style="border:1px solid rgba(229,62,62,.2);background:rgba(229,62,62,.05);color:var(--danger)" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right me-2"></i>Keluar Aplikasi
            </button>
        </div>
        @endauth
    </aside>

    <main class="main-content">
        <header class="mobile-header">
            <a href="#" class="d-flex align-items-center gap-2 text-decoration-none">
                <div class="brand-icon-wrapper" style="width:36px;height:36px;font-size:18px">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
                <span class="fw-bold fs-4" style="color:var(--text)">Mind<span style="color:var(--primary)">Screen</span></span>
            </a>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-link text-decoration-none p-2 theme-toggle" id="themeToggleMobile">
                    <i class="bi bi-moon-stars-fill fs-5" id="themeIconMobile"></i>
                </button>
                <button class="btn btn-light border p-2" type="button" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
            </div>
        </header>

        <div class="content-area">
            @yield('content')
        </div>

        <footer class="mt-auto py-4 px-4 text-center text-muted" style="font-size:13px">
            &copy; {{ date('Y') }} MentalHealthApp &bull; Sistem Skrining DASS-42
        </footer>
    </main>
</div>

<div class="toast-container position-fixed top-0 end-0 p-3 mt-3" style="z-index:1060">
    @if(session('success') || session('status'))
    <div class="toast align-items-center text-bg-success border-0 shadow-lg rounded-4 mb-2" role="alert">
        <div class="d-flex">
            <div class="toast-body fw-semibold py-3 px-4">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') ?? session('status') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-3 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="toast align-items-center text-bg-danger border-0 shadow-lg rounded-4 mb-2" role="alert">
        <div class="d-flex">
            <div class="toast-body fw-semibold py-3 px-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-3 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    @endif
</div>

<div class="modal fade" id="logoutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius:20px;background:var(--card-bg)">
            <div class="modal-header border-bottom-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 rounded-circle mb-4" style="width:80px;height:80px">
                    <i class="bi bi-box-arrow-right text-warning" style="font-size:2.5rem"></i>
                </div>
                <h5 class="fw-bold mb-2">Yakin Ingin Keluar?</h5>
                <p class="text-muted mb-0">Sesi Anda akan diakhiri. Pastikan semua pekerjaan Anda sudah tersimpan.</p>
            </div>
            <div class="modal-footer border-top-0 justify-content-center pt-0 pb-4 gap-2">
                <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger px-4 rounded-pill">Ya, Keluar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const html=document.documentElement;
    const sidebar=document.getElementById('mainSidebar');
    const overlay=document.getElementById('sidebarOverlay');
    const sidebarToggle=document.getElementById('sidebarToggle');
    const themeSidebar=document.getElementById('themeToggleSidebar');
    const themeMobile=document.getElementById('themeToggleMobile');
    const iconSidebar=document.getElementById('themeIconSidebar');
    const iconMobile=document.getElementById('themeIconMobile');
    const textSidebar=document.getElementById('themeTextSidebar');

    function updateTheme(theme){
        const dark=theme==='dark';
        const icon=dark?'bi-sun-fill':'bi-moon-stars-fill';
        if(iconSidebar) iconSidebar.className='bi '+icon;
        if(iconMobile) iconMobile.className='bi '+icon+' fs-5';
        if(textSidebar) textSidebar.textContent=dark?'Mode Terang':'Mode Gelap';
    }

    function toggleTheme(){
        const current=html.getAttribute('data-bs-theme')||'light';
        const theme=current==='dark'?'light':'dark';
        html.setAttribute('data-bs-theme',theme);
        localStorage.setItem('theme',theme);
        updateTheme(theme);
    }

    updateTheme(html.getAttribute('data-bs-theme')||'light');

    if(themeSidebar) themeSidebar.addEventListener('click',toggleTheme);
    if(themeMobile) themeMobile.addEventListener('click',toggleTheme);

    if(sidebarToggle){
        sidebarToggle.addEventListener('click',function(){
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });
    }

    if(overlay){
        overlay.addEventListener('click',function(){
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    }

    document.querySelectorAll('.toast').forEach(function(el){
        new bootstrap.Toast(el,{delay:3000}).show();
    });
});
</script>

@stack('scripts')
</body>
</html>