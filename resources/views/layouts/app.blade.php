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
                MAIN LAYOUT
        =========================== */
        .main-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content-area {
            flex: 1;
            padding: 20px 15px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        /* ===========================
                TOPBAR NAVIGATION
        =========================== */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.98);
            padding: 12px 20px;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1050;
        }

        /* ===========================
                TOP-DOWN MENU DROPDOWN
        =========================== */
        .mobile-menu-dropdown {
            position: fixed;
            top: 61px; /* Menyesuaikan tinggi topbar */
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 10px 15px rgba(0,0,0,0.05);
            z-index: 1040;
            
            /* Animasi Sembunyi/Muncul */
            opacity: 0;
            visibility: hidden;
            transform: translateY(-20px);
            transition: all 0.3s ease;
            
            max-height: calc(100vh - 65px);
            overflow-y: auto;
        }

        .mobile-menu-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .nav-menu-wrapper {
            padding: 15px 20px 25px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .mobile-user-profile {
            display: flex;
            align-items: center;
            padding: 10px 15px 20px;
            border-bottom: 1px dashed var(--border);
            margin-bottom: 10px;
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

        .menu-section-title {
            font-size: 11px;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 700;
            letter-spacing: 1px;
            padding: 10px 16px 5px;
            margin-top: 10px;
            list-style: none;
        }

        .nav-item {
            list-style: none;
            margin-bottom: 4px;
        }

        .nav-link {
            font-weight: 600;
            font-size: 14.5px;
            color: var(--text) !important;
            padding: 12px 16px !important;
            border-radius: 12px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .nav-link i {
            font-size: 18px;
            width: 24px;
            text-align: center;
            margin-right: 12px;
            color: var(--primary);
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(79, 70, 229, 0.08);
            color: var(--primary) !important;
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

        @media(min-width: 992px) {
            .content-area {
                padding: 40px 30px;
            }
        }
    </style>
</head>

<body>

    <div class="main-wrapper">
        
        <!-- Topbar Utama -->
        <div class="topbar shadow-sm">
            <div class="d-flex align-items-center fw-bold text-dark fs-5">
                <i class="bi bi-heart-pulse-fill text-primary me-2"></i> MentalHealth
            </div>
            <button class="btn btn-light border-0" id="topMenuToggle" style="padding: 6px 10px;">
                <i class="bi bi-list fs-3 text-dark"></i>
            </button>
        </div>

        <!-- Menu Dropdown (Top-Down) -->
        <div class="mobile-menu-dropdown" id="mobileMenuDropdown">
            <div class="nav-menu-wrapper">
                @auth
                    <!-- Profil Ringkas -->
                    <div class="mobile-user-profile">
                        <div class="user-avatar" style="width: 45px; height: 45px; font-size: 16px;">
                            {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                        </div>
                        <div class="ms-3 overflow-hidden">
                            <div class="fw-bold text-dark text-truncate" style="font-size: 15px;">{{ Auth::user()->username }}</div>
                            <div class="text-muted text-truncate text-capitalize" style="font-size: 12px;">{{ Auth::user()->role }}</div>
                        </div>
                    </div>
                @endauth

                <ul class="p-0 m-0">
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
                                <a class="nav-link {{ request()->routeIs('mahasiswa.screenings.create') ? 'active' : '' }}" href="{{ route('mahasiswa.screenings.create') }}">
                                    <i class="bi bi-clipboard2-pulse"></i> Skrining Baru
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('mahasiswa.screenings.index') ? 'active' : '' }}" href="{{ route('mahasiswa.screenings.index') }}">
                                    <i class="bi bi-clock-history"></i> Riwayat
                                </a>
                            </li>
                        @endif
                        
                        <!-- ================= MULAI TAMBAHAN MENU PROFIL ================= -->
                        <hr class="my-3 text-muted" style="opacity: 0.2;">

                        <li class="menu-section-title">Pengaturan</li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.index') }}">
                                <i class="bi bi-person-gear"></i> Profil Saya
                            </a>
                        </li>
                        <!-- ================= AKHIR TAMBAHAN MENU PROFIL ================= -->
                        
                        <!-- Logout Button -->
                        <li class="mt-4 px-2">
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="btn w-100 text-danger fw-bold d-flex align-items-center justify-content-center" style="border: 1px solid #FEE2E2; background: #FEF2F2; border-radius: 12px; padding: 12px;">
                                    <i class="bi bi-box-arrow-right me-2"></i> Keluar Aplikasi
                                </button>
                            </form>
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
                </ul>
            </div>
        </div>

        <!-- Content Area -->
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
            const topMenuToggle = document.getElementById('topMenuToggle');
            const mobileMenuDropdown = document.getElementById('mobileMenuDropdown');

            if (topMenuToggle && mobileMenuDropdown) {
                topMenuToggle.addEventListener('click', function(e) {
                    e.stopPropagation(); 
                    mobileMenuDropdown.classList.toggle('show');
                });

                document.addEventListener('click', function(e) {
                    if (!mobileMenuDropdown.contains(e.target) && !topMenuToggle.contains(e.target)) {
                        mobileMenuDropdown.classList.remove('show');
                    }
                });
            }
        });
    </script>

    @stack('scripts')

</body>
</html>