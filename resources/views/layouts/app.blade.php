<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Monitoring Kesehatan Mental (DASS-42)</title>
    
    <!-- TARUH KODE INI TEPAT DI SINI -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=2">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- ... kode ke bawahnya tetap sama ... -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary: #4F46E5;
            --primary-hover: #4338CA;
            --secondary: #3B82F6;
            --success: #10B981;
            --danger: #EF4444;
            --warning: #F59E0B;
            --bg: #F8FAFC;
            --card: #FFFFFF;
            --border: #E2E8F0;
            --text: #0F172A;
            --muted: #64748B;
            --radius-lg: 18px;
            --radius-md: 14px;
            --sidebar-width: 260px; /* Lebar Sidebar */
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F8FAFC;
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===========================
                SIDEBAR STYLING
        =========================== */
        .sidebar {
            width: var(--sidebar-width);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            background: #FFFFFF;
            border-right: 1px solid var(--border);
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 4px 0 24px rgba(15, 23, 42, 0.02);
        }

        .sidebar-brand {
            padding: 24px 20px;
            display: flex;
            align-items: center;
            font-weight: 800;
            font-size: 18px;
            color: var(--text);
            text-decoration: none;
            border-bottom: 1px dashed var(--border);
        }

        .sidebar-brand i {
            font-size: 24px;
            color: var(--primary);
            margin-right: 12px;
            background: rgba(79, 70, 229, 0.1);
            padding: 6px 8px;
            border-radius: 10px;
        }

        .sidebar-menu {
            flex: 1;
            padding: 20px 14px;
            overflow-y: auto;
        }

        .nav-item {
            list-style: none;
            margin-bottom: 6px;
        }

        .nav-link {
            font-weight: 600;
            font-size: 14.5px;
            color: var(--muted) !important;
            padding: 12px 16px !important;
            border-radius: 12px;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
        }

        .nav-link i {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            background: rgba(79, 70, 229, 0.05);
            transform: translateX(4px);
        }

        .nav-link.active {
            color: var(--primary) !important;
            background: rgba(79, 70, 229, 0.1);
            position: relative;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: -14px;
            top: 10%;
            height: 80%;
            width: 4px;
            background: var(--primary);
            border-radius: 0 4px 4px 0;
        }

        /* Sidebar Footer (User Profile) */
        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid var(--border);
            background: #FAFAFA;
        }

        .user-profile-box {
            display: flex;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 1px dashed #E2E8F0;
            margin-bottom: 15px;
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
            font-weight: bold;
            font-size: 16px;
            flex-shrink: 0;
        }

        /* ===========================
                MAIN CONTENT
        =========================== */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .topbar-mobile {
            display: none;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            padding: 15px 20px;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .content-area {
            flex: 1;
            padding: 30px;
        }

        /* ===========================
                GLOBAL COMPONENTS
        =========================== */
        .card {
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: var(--radius-lg);
            background: var(--card);
            box-shadow: 0 4px 15px -3px rgba(15, 23, 42, 0.03);
            transition: all 0.3s ease;
        }

        .btn {
            border-radius: var(--radius-md);
            font-weight: 600;
            padding: 10px 20px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.25);
        }

        .alert { border-radius: var(--radius-md); border: none; }
        
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }

        /* ===========================
                RESPONSIVE (MOBILE)
        =========================== */
        @media(max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: none;
            }

            .sidebar.show {
                transform: translateX(0);
                box-shadow: 10px 0 25px rgba(0,0,0,0.1);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .topbar-mobile {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .content-area {
                padding: 20px 15px;
            }

            /* Overlay saat sidebar terbuka di HP */
            .sidebar-overlay {
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                background: rgba(15, 23, 42, 0.4);
                backdrop-filter: blur(2px);
                z-index: 1035;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .sidebar-overlay.show {
                opacity: 1;
                visibility: visible;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <aside class="sidebar" id="sidebar">
        <a href="#" class="sidebar-brand">
            <i class="bi bi-heart-pulse-fill"></i>
            <div>Mental<span class="text-primary">Health</span></div>
        </a>

        <div class="sidebar-menu">
            <ul class="p-0 m-0">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <span class="text-xs fw-bold text-muted text-uppercase px-3 mb-2 d-block" style="font-size: 11px; letter-spacing: 0.5px;">Menu Admin</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.questions.*') ? 'active' : '' }}" href="{{ route('admin.questions.index') }}">
                                <i class="bi bi-patch-question me-2"></i> Kelola Pertanyaan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                <i class="bi bi-people me-2"></i> Kelola Pengguna
                            </a>
                        </li>
                    @elseif(Auth::user()->role === 'mahasiswa')
                        <li class="nav-item">
                            <span class="text-xs fw-bold text-muted text-uppercase px-3 mb-2 d-block mt-2" style="font-size: 11px; letter-spacing: 0.5px;">Menu Mahasiswa</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}" href="{{ route('mahasiswa.dashboard') }}">
                                <i class="bi bi-house-door me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('mahasiswa.screenings.create') ? 'active' : '' }}" href="{{ route('mahasiswa.screenings.create') }}">
                                <i class="bi bi-clipboard2-pulse me-2"></i> Skrining Baru
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('mahasiswa.screenings.index') ? 'active' : '' }}" href="{{ route('mahasiswa.screenings.index') }}">
                                <i class="bi bi-clock-history me-2"></i> Riwayat
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-2"></i> Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>

        @auth
        <div class="sidebar-footer">
            <div class="user-profile-box">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                </div>
                <div class="ms-3 overflow-hidden">
                    <div class="fw-bold text-dark text-truncate" style="font-size: 14px;">{{ Auth::user()->username }}</div>
                    <div class="text-muted text-truncate text-capitalize" style="font-size: 12px;">{{ Auth::user()->role }}</div>
                </div>
            </div>
            
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-light w-100 text-danger fw-bold d-flex align-items-center justify-content-center" style="border: 1px solid #FEE2E2; background: #FEF2F2;">
                    <i class="bi bi-box-arrow-right me-2"></i> Keluar
                </button>
            </form>
        </div>
        @endauth
    </aside>

    <div class="main-wrapper">
        
        <div class="topbar-mobile shadow-sm">
            <div class="d-flex align-items-center fw-bold text-dark fs-5">
                <i class="bi bi-heart-pulse-fill text-primary me-2"></i> MentalHealth
            </div>
            <button class="btn btn-light border-0" id="sidebarToggle" style="padding: 6px 10px;">
                <i class="bi bi-list fs-3 text-dark"></i>
            </button>
        </div>

        <div class="content-area">
            
            {{-- FLASHELEMENT SUCCESS --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill fs-5 me-3"></i>
                    <div class="flex-grow-1 fw-medium">
                        {{ session('success') }}
                    </div>
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- FLASHELEMENT ERROR --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-5 me-3"></i>
                    <div class="flex-grow-1 fw-medium">
                        {{ session('error') }}
                    </div>
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
            
        </div>

        <footer class="mt-auto py-4 px-4">
            <div class="text-center text-muted" style="font-size: 13px; font-weight: 500;">
                &copy; {{ date('Y') }} MentalHealthApp &bull; Sistem Skrining DASS-42
            </div>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');
            const overlay = document.getElementById('sidebarOverlay');

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                });
            }

            if (overlay) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });
            }
        });
    </script>

    @stack('scripts')

</body>
</html>