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

    <style>
        /* PALETTE WARNA "CALMING SAGE & SOFT EARTH" */
        :root {
            --primary: #4A7A6D;          /* Sage Green: Menenangkan, terapeutik, ramah */
            --primary-hover: #3B6358;
            --secondary: #6B9080;        /* Soft Teal Mint */
            --accent: #A3C1AD;           /* Soft Leaf */
            
            /* Warna turunan palet khusus untuk gradasi background */
            --bg-light: #F4F7F6;
            --bg-mid: #E8F0EC;
            --bg-soft: #F0F4F1;
            
            --success: #38A169;          /* Emerald Muted */
            --danger: #E53E3E;           /* Soft Coral Red (tidak intimidatif) */
            --warning: #DD6B20;          /* Warm Terracotta */
            --card-bg: rgba(255, 255, 255, 0.88);
            --border: rgba(203, 213, 208, 0.6);
            --text: #2D3748;             /* Slate Gray (Pengganti Hitam Pekat) */
            --muted: #64748B;
            --radius-lg: 22px;
            --radius-md: 14px;
            --sidebar-width: 280px;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        /* LATAR BELAKANG GRADASI MENENANGKAN (Berbasis Palet) */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            /* Gradasi dasar dibuat lebih smooth dan menyebar */
            background: linear-gradient(135deg, #F4F7F6 0%, #E6EFE9 50%, #EEF2F0 100%);
            background-attachment: fixed;
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* AMBIENT GLOW SOFT SAGE IN BACKGROUND (Mesh Gradient Effect) */
        body::before {
            content: '';
            position: fixed;
            top: -15%;
            right: -10%;
            width: 750px;
            height: 750px;
            /* Warna Teal Mint dengan opacity lebih pas */
            background: radial-gradient(circle, rgba(107, 144, 128, 0.18) 0%, rgba(107, 144, 128, 0) 70%);
            border-radius: 50%;
            z-index: -1;
            pointer-events: none;
            filter: blur(40px); /* Kunci untuk membuat gradasi menyatu sempurna (Mesh effect) */
            animation: floatAmbient 12s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -15%;
            left: -10%;
            width: 800px;
            height: 800px;
            /* Warna Soft Leaf dengan opacity */
            background: radial-gradient(circle, rgba(163, 193, 173, 0.22) 0%, rgba(163, 193, 173, 0) 70%);
            border-radius: 50%;
            z-index: -1;
            pointer-events: none;
            filter: blur(40px);
            animation: floatAmbient 15s ease-in-out infinite reverse;
        }

        /* ANIMASI NAFAS HALUS UNTUK GRADASI */
        @keyframes floatAmbient {
            0% {
                transform: translate(0, 0) scale(1);
            }
            50% {
                transform: translate(-30px, 20px) scale(1.05);
            }
            100% {
                transform: translate(0, 0) scale(1);
            }
        }

        /* LAYOUT CONTAINER */
        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR (SOFT GLASSMORPHISM) */
        .sidebar {
            width: var(--sidebar-width);
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            /* Border disesuaikan agar nyambung dengan gradasi */
            border-right: 1px solid rgba(163, 193, 173, 0.4);
            box-shadow: 4px 0 24px rgba(74, 122, 109, 0.04);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1020;
            display: flex;
            flex-direction: column;
            padding: 26px 22px;
            overflow-y: auto;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* LOGO BRANDING */
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            margin-bottom: 30px;
        }

        .brand-icon-wrapper {
            width: 44px;
            height: 44px;
            /* Dipadukan langsung dari --primary dan --secondary palette dengan opacity */
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

        /* PROFIL USER DI SIDEBAR */
        .user-profile-card {
            display: flex;
            align-items: center;
            padding: 12px 14px;
            background: rgba(244, 247, 246, 0.85);
            border: 1px solid rgba(203, 213, 208, 0.6);
            border-radius: var(--radius-md);
            margin-bottom: 24px;
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
            padding: 12px 12px 6px;
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
        }

        /* RESPONSIVE LAYOUT (UNTUK TABLET & HP) */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: 10px 0 30px rgba(0, 0, 0, 0.08);
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
            border: 1px solid rgba(255, 255, 255, 0.9);
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
            border-radius: var(--radius-md); background-color: rgba(255, 255, 255, 0.9);
            color: var(--text); font-weight: 600; transition: all 0.2s ease-in-out;
        }

        .option-label:hover .option-button {
            border-color: var(--primary); background-color: rgba(74, 122, 109, 0.05);
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
        .status-normal { border-color: #38A169; color: #2F855A; }
        .status-ringan { border-color: #3182CE; color: #2B6CB0; }
        .status-sedang { border-color: #DD6B20; color: #C05621; }
        .status-parah { border-color: #E53E3E; color: #C53030; }
        .status-sangat-parah { border-color: #9B2C2C; color: #742A2A; }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }
    </style>
</head>
<body>

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
                            <!-- PERUBAHAN: Link diarahkan ke onboarding, dan deteksi rute aktif mencakup onboarding dan create -->
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
            </ul>

            @auth
                <!-- TOMBOL KELUAR DI BAWAH SIDEBAR -->
                <div class="pt-3 border-top mt-auto" style="border-color: rgba(203, 213, 208, 0.6) !important;">
                    <button type="button" class="btn w-100 fw-bold d-flex align-items-center justify-content-center" 
                            style="border: 1px solid rgba(229, 62, 62, 0.2); background: rgba(254, 242, 242, 0.9); color: #C53030; border-radius: var(--radius-md); padding: 11px;"
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
                <button class="btn btn-light border p-2" type="button" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
            </header>

            <!-- KONTEN UTAMA HALAMAN -->
            <div class="content-area">
                @yield('content')
            </div>

            <!-- FOOTER -->
            <footer class="mt-auto py-4 px-4 text-center text-muted" style="font-size: 13px; background: rgba(255,255,255,0.4); backdrop-filter: blur(8px);">
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
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(16px);">
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
                    <button type="button" class="btn btn-light px-4 py-2 fw-semibold rounded-pill" data-bs-dismiss="modal">
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
            // Toast Notification
            const toastElList = document.querySelectorAll('.toast');
            const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl, { delay: 3000 }));
            toastList.forEach(toast => toast.show());

            // Toggle Sidebar khusus layar Mobile
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mainSidebar = document.getElementById('mainSidebar');

            if (sidebarToggle && mainSidebar) {
                sidebarToggle.addEventListener('click', function() {
                    mainSidebar.classList.toggle('show');
                });
            }
        });
    </script>

    @stack('scripts')

</body>
</html>