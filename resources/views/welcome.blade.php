<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skrining Kesehatan Mental DASS-42 | MindScreen</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* PALET WARNA CALMING SAGE & SOFT EARTH */
        :root {
            --primary: #4A7A6D;          /* Sage Green */
            --primary-hover: #3B6358;
            --secondary: #6B9080;        /* Soft Teal Mint */
            --text-main: #2D3748;        /* Slate Gray */
            --text-muted: #64748B;
            --bg-soft: #F4F7F6;          /* Kabut Pagi / Off-white */
            --warning-soft: #DD6B20;     /* Warm Amber untuk disclaimer */
            --footer-bg: #2C3E38;        /* Deep Forest Muted */
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            background-color: var(--bg-soft);
            overflow-x: hidden;
        }

        /* Override Class Bootstrap Default */
        .text-primary { color: var(--primary) !important; }
        .bg-primary { background-color: var(--primary) !important; }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(74, 122, 109, 0.2);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-hover) 0%, var(--primary) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(74, 122, 109, 0.3);
            color: white;
        }
        
        /* Custom Outline Button Fix */
        .btn-outline-custom {
            background-color: white;
            border: 1px solid rgba(203, 213, 208, 0.8);
            color: var(--text-main) !important;
            transition: all 0.3s ease;
        }
        .btn-outline-custom:hover {
            background-color: var(--bg-soft);
            border-color: var(--primary);
            color: var(--primary) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(74, 122, 109, 0.1);
        }
        
        /* Navbar */
        .navbar {
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(203, 213, 208, 0.4);
            padding: 15px 0;
            transition: all 0.3s ease;
        }

        .nav-link {
            color: var(--text-main) !important;
            transition: color 0.2s ease;
        }
        .nav-link:hover { color: var(--primary) !important; }

        /* Hero Section */
        .hero-section {
            padding: 140px 0 80px;
            background: linear-gradient(135deg, #E8F0EC 0%, #F4F7F6 50%, #FFFFFF 100%);
            position: relative;
        }

        /* Ambient Blob in Hero */
        .hero-section::before {
            content: '';
            position: absolute;
            top: 10%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(107, 144, 128, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            z-index: 0;
        }
        
        .hero-content { position: relative; z-index: 1; }

        .hero-title {
            font-weight: 800;
            color: var(--text-main);
            line-height: 1.25;
            letter-spacing: -1px;
        }

        .text-gradient {
            background: linear-gradient(90deg, var(--primary), #38A169);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Feature Cards */
        .feature-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 22px;
            padding: 40px 30px;
            border: 1px solid rgba(203, 213, 208, 0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(74, 122, 109, 0.08);
        }

        .feature-icon {
            width: 65px;
            height: 65px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 24px;
        }

        /* Soft Icon Colors */
        .icon-sage { background: rgba(74, 122, 109, 0.1); color: var(--primary); }
        .icon-emerald { background: rgba(56, 161, 105, 0.1); color: #38A169; }
        .icon-warm { background: rgba(221, 107, 32, 0.1); color: var(--warning-soft); }

        /* Step Numbering */
        .step-number {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 700;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(74, 122, 109, 0.12);
        }
        
        .step-number-1 {
            background: rgba(74, 122, 109, 0.1);
            color: var(--primary);
        }
        
        .step-number-2 {
            background: rgba(74, 122, 109, 0.25);
            color: var(--primary-hover);
        }
        
        .step-number-3 {
            background: var(--primary);
            color: #ffffff;
        }

        /* Accordion Custom (FAQ) */
        .accordion-item {
            border: 1px solid rgba(203, 213, 208, 0.5);
            border-radius: 16px !important;
            margin-bottom: 12px;
            overflow: hidden;
            background: white;
        }
        .accordion-button {
            font-weight: 600;
            color: var(--text-main);
            padding: 20px 24px;
        }
        .accordion-button:not(.collapsed) {
            background-color: rgba(74, 122, 109, 0.05);
            color: var(--primary);
            box-shadow: none;
        }
        .accordion-button:focus {
            box-shadow: none;
            border-color: transparent;
        }
        .accordion-body {
            color: var(--text-muted);
            padding: 0 24px 24px;
            line-height: 1.7;
        }

        /* Disclaimer Box */
        .disclaimer-box {
            background-color: rgba(221, 107, 32, 0.06);
            border-left: 4px solid var(--warning-soft);
            padding: 20px 24px;
            border-radius: 0 12px 12px 0;
            margin: 0;
        }

        /* Bottom CTA */
        .cta-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 24px;
            padding: 60px 40px;
            text-align: center;
            color: white;
            box-shadow: 0 20px 40px rgba(74, 122, 109, 0.2);
            position: relative;
            overflow: hidden;
        }

        .cta-section::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
        }

        /* Footer */
        .footer {
            background-color: var(--footer-bg);
            color: #A3B1AB;
            padding: 60px 0 30px;
        }
        
        .footer a {
            color: #A3B1AB;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer a:hover {
            color: #FFFFFF;
        }

        /* Animations */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .floating-img {
            animation: float 6s ease-in-out infinite;
        }
    
        /* =========================================
           DARK MODE - FULL WELCOME PAGE
           ========================================= */

        html[data-bs-theme="dark"] {
            --primary: #6BB29E;
            --primary-hover: #83C5B3;
            --secondary: #5FA18E;
            --text-main: #F1F5F9;
            --text-muted: #A8B4C3;
            --bg-soft: #111827;
            --warning-soft: #F0A06A;
            --footer-bg: #080D17;
        }

        html[data-bs-theme="dark"] body {
            background-color: #0F172A !important;
            color: #F1F5F9 !important;
        }

        html[data-bs-theme="dark"] .navbar {
            background-color: rgba(15, 23, 42, 0.94) !important;
            border-bottom-color: rgba(71, 85, 105, 0.55) !important;
        }

        html[data-bs-theme="dark"] .navbar-brand,
        html[data-bs-theme="dark"] .nav-link {
            color: #F1F5F9 !important;
        }

        html[data-bs-theme="dark"] .nav-link:hover {
            color: #83C5B3 !important;
        }

        html[data-bs-theme="dark"] .navbar-toggler i {
            color: #F1F5F9 !important;
        }

        html[data-bs-theme="dark"] .hero-section {
            background: linear-gradient(
                135deg,
                #172A25 0%,
                #111827 48%,
                #0F172A 100%
            ) !important;
        }

        html[data-bs-theme="dark"] .hero-section::before {
            background: radial-gradient(
                circle,
                rgba(107, 178, 158, 0.14) 0%,
                rgba(15, 23, 42, 0) 70%
            );
        }

        html[data-bs-theme="dark"] .hero-title,
        html[data-bs-theme="dark"] h1,
        html[data-bs-theme="dark"] h2,
        html[data-bs-theme="dark"] h3,
        html[data-bs-theme="dark"] h4,
        html[data-bs-theme="dark"] h5,
        html[data-bs-theme="dark"] h6 {
            color: #F1F5F9;
        }

        html[data-bs-theme="dark"] .hero-section .lead,
        html[data-bs-theme="dark"] .hero-section p {
            color: #A8B4C3 !important;
        }

        html[data-bs-theme="dark"] .text-gradient {
            background: linear-gradient(90deg, #6BB29E, #65C7B2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        html[data-bs-theme="dark"] .btn-outline-custom {
            background-color: #1E293B !important;
            border-color: #475569 !important;
            color: #F1F5F9 !important;
        }

        html[data-bs-theme="dark"] .btn-outline-custom:hover {
            background-color: #263548 !important;
            border-color: #6BB29E !important;
            color: #83C5B3 !important;
        }

        html[data-bs-theme="dark"] .hero-section .badge {
            background: rgba(107, 178, 158, 0.14) !important;
            color: #83C5B3 !important;
        }

        html[data-bs-theme="dark"] section.bg-white {
            background-color: #111827 !important;
            border-color: #334155 !important;
        }

        html[data-bs-theme="dark"] #about {
            background-color: #0F172A !important;
        }

        html[data-bs-theme="dark"] #about .badge {
            background: #1E293B !important;
            color: #83C5B3 !important;
            border-color: #475569 !important;
        }

        html[data-bs-theme="dark"] #about p,
        html[data-bs-theme="dark"] #why p,
        html[data-bs-theme="dark"] #how p {
            color: #A8B4C3 !important;
        }

        html[data-bs-theme="dark"] #about .bg-white {
            background-color: #1E293B !important;
            border-color: #334155 !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.16) !important;
        }

        html[data-bs-theme="dark"] #why,
        html[data-bs-theme="dark"] #how {
            background-color: #111827 !important;
            border-color: #334155 !important;
        }

        html[data-bs-theme="dark"] .feature-card {
            background: #1E293B !important;
            border-color: #334155 !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.14);
        }

        html[data-bs-theme="dark"] .feature-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.28);
        }

        html[data-bs-theme="dark"] .icon-sage {
            background: rgba(107, 178, 158, 0.13) !important;
            color: #83C5B3 !important;
        }

        html[data-bs-theme="dark"] .icon-emerald {
            background: rgba(56, 161, 105, 0.13) !important;
            color: #6EE7A8 !important;
        }

        html[data-bs-theme="dark"] .icon-warm {
            background: rgba(240, 160, 106, 0.13) !important;
            color: #F0A06A !important;
        }

        html[data-bs-theme="dark"] .step-number-1 {
            background: rgba(107, 178, 158, 0.13) !important;
            color: #83C5B3 !important;
        }

        html[data-bs-theme="dark"] .step-number-2 {
            background: rgba(107, 178, 158, 0.22) !important;
            color: #9BD2C2 !important;
        }

        html[data-bs-theme="dark"] .step-number-3 {
            background: #5FA18E !important;
            color: #FFFFFF !important;
        }

        html[data-bs-theme="dark"] #how .rounded-4 {
            background-color: #1E293B !important;
            border-color: #475569 !important;
        }

        html[data-bs-theme="dark"] #how .text-primary {
            color: #83C5B3 !important;
        }

        html[data-bs-theme="dark"] #faq {
            background-color: #0F172A !important;
        }

        html[data-bs-theme="dark"] .accordion-item {
            background: #1E293B !important;
            border-color: #334155 !important;
        }

        html[data-bs-theme="dark"] .accordion-button {
            background-color: #1E293B !important;
            color: #F1F5F9 !important;
        }

        html[data-bs-theme="dark"] .accordion-button:not(.collapsed) {
            background-color: #263548 !important;
            color: #83C5B3 !important;
        }

        html[data-bs-theme="dark"] .accordion-button::after {
            filter: invert(1) brightness(1.4);
        }

        html[data-bs-theme="dark"] .accordion-body {
            background-color: #1E293B !important;
            color: #A8B4C3 !important;
        }

        html[data-bs-theme="dark"] .accordion-body strong {
            color: #F1F5F9 !important;
        }

        html[data-bs-theme="dark"] .disclaimer-box {
            background-color: rgba(240, 160, 106, 0.08) !important;
            border-left-color: #F0A06A !important;
        }

        html[data-bs-theme="dark"] .disclaimer-box h6 {
            color: #F3B28A !important;
        }

        html[data-bs-theme="dark"] .disclaimer-box p {
            color: #E2A27D !important;
        }

        html[data-bs-theme="dark"] .cta-section {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.30);
        }

        html[data-bs-theme="dark"] .footer {
            background-color: #080D17 !important;
            color: #94A3B8 !important;
        }

        html[data-bs-theme="dark"] .footer a {
            color: #94A3B8 !important;
        }

        html[data-bs-theme="dark"] .footer a:hover {
            color: #83C5B3 !important;
        }

        html[data-bs-theme="dark"] .footer h4 {
            color: #F1F5F9 !important;
        }

        html[data-bs-theme="dark"] .footer p {
            color: #7F8DA0 !important;
        }

        html[data-bs-theme="dark"] .footer .border-bottom {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        html[data-bs-theme="dark"] .btn-light {
            background-color: #F1F5F9 !important;
            border-color: #F1F5F9 !important;
            color: #315B50 !important;
        }

        html[data-bs-theme="dark"] .btn-light:hover {
            background-color: #DDE7E3 !important;
            border-color: #DDE7E3 !important;
            color: #24483F !important;
        }

        html[data-bs-theme="dark"] .text-muted {
            color: #A8B4C3 !important;
        }

        html[data-bs-theme="dark"] .text-dark {
            color: #F1F5F9 !important;
        }

        html[data-bs-theme="dark"] .bg-white {
            background-color: #1E293B !important;
        }

        html[data-bs-theme="dark"] .border-light {
            border-color: #334155 !important;
        }

        html[data-bs-theme="dark"] .shadow-sm {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.16) !important;
        }

        /* Mobile Navbar */
        @media (max-width: 991.98px) {
            html[data-bs-theme="dark"] .navbar-collapse {
                background-color: #0F172A;
                padding: 15px;
                border-radius: 0 0 16px 16px;
                margin-top: 10px;
                border: 1px solid #334155;
            }
        }

        html[data-bs-theme="dark"] .hero-section .btn {
    background: linear-gradient(135deg, #315B50 0%, #477D6D 100%) !important;
    border-color: #477D6D !important;
    color: #D5E9E2 !important;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.30) !important;
}

html[data-bs-theme="dark"] .hero-section .btn:hover {
    background: linear-gradient(135deg, #477D6D 0%, #5FA18E 100%) !important;
    border-color: #5FA18E !important;
    color: #FFFFFF !important;
}
    </style>
</head>
<body>
    @include('components.theme-toggle')
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center gap-2" href="#">
                <i class="bi bi-heart-pulse-fill fs-4"></i>
                <span>MindScreen</span>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-2 text-dark"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item"><a class="nav-link fw-medium" href="#about">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="#why">Kenapa Penting?</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="#how">Cara Kerja</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="#faq">FAQ</a></li>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold w-100">Dashboard Admin</a>
                            @else
                                <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold w-100">Dashboard</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm w-100">Masuk / Daftar</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-section text-center text-lg-start d-flex align-items-center">
        <div class="container hero-content">
            <div class="row align-items-center justify-content-between g-5">
                <div class="col-lg-6">
                    <span class="badge px-3 py-2 rounded-pill mb-4 fw-bold" style="background: rgba(74, 122, 109, 0.12); color: var(--primary); font-size: 13px;">
                        <i class="bi bi-stars me-1"></i> Skrining Mandiri DASS-42
                    </span>
                    <h1 class="hero-title display-4 mb-4">
                        Pahami Kondisi Mentalmu, <br>
                        <span class="text-gradient">Mulai Langkah Pertamamu.</span>
                    </h1>
                    <p class="lead mb-5" style="font-size: 1.15rem; line-height: 1.7; color: var(--text-muted);">
                        Aplikasi skrining ini membantu Anda mengevaluasi tingkat depresi, kecemasan, dan stres secara mandiri dalam waktu kurang dari 10 menit. Kenali diri Anda lebih baik hari ini.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold">
                                Mulai Skrining Sekarang <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        @else
                            <a href="{{ route('mahasiswa.screenings.onboarding') }}" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold">
                                Mulai Skrining Sekarang <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        @endguest
                        
                        <a href="#about" class="btn btn-outline-custom btn-lg rounded-pill px-5 fw-bold">
                            Pelajari Dulu
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center">
                    <img src="{{ asset('images/hero-image.png') }}" alt="Ilustrasi Ketenangan" class="img-fluid floating-img" style="max-height: 450px; filter: drop-shadow(0 20px 30px rgba(74, 122, 109, 0.15));">
                </div>
            </div>
        </div>
    </section>

    <!-- DISCLAIMER & VALIDATION -->
    <section class="py-4 bg-white border-bottom border-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="disclaimer-box d-flex gap-3 align-items-start">
                        <i class="bi bi-info-circle-fill fs-3" style="color: var(--warning-soft);"></i>
                        <div>
                            <h6 class="fw-bold mb-1" style="color: #9C4221;">Penting untuk Diketahui (Disclaimer)</h6>
                            <p class="mb-0 small" style="color: #B75D29; line-height: 1.6;">
                                Aplikasi ini dirancang menggunakan instrumen <strong>DASS-42 (Depression Anxiety Stress Scales)</strong>. Namun, hasil dari skrining ini <strong>BUKAN merupakan diagnosis medis atau psikologis</strong>. Aplikasi ini berfungsi sebagai alat evaluasi awal. Jika Anda merasa kewalahan, mohon jangan ragu untuk berdiskusi dengan psikolog, psikiater, atau layanan bantuan profesional.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="about" class="py-5 my-3">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <span class="badge px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm" style="background: white; color: var(--primary); border: 1px solid rgba(74, 122, 109, 0.2);">
                        Tentang MindScreen
                    </span>
                    <h2 class="fw-bold mb-4" style="color: var(--text-main);">Membangun Kesadaran Mental, Satu Langkah Kecil Setiap Harinya.</h2>
                    <p style="color: var(--text-muted); line-height: 1.7;">
                        Kami percaya bahwa kesehatan mental sama pentingnya dengan kesehatan fisik. MindScreen diciptakan untuk mendobrak stigma dengan menyediakan akses evaluasi awal yang mudah dipahami, aman, dan dapat dilakukan kapan saja.
                    </p>
                    <p style="color: var(--text-muted); line-height: 1.7;">
                        Fokus utama kami adalah memberikan ruang bagi Anda untuk berhenti sejenak, mengenali emosi yang sedang dirasakan, dan memberikan panduan langkah selanjutnya yang tepat.
                    </p>
                </div>
                
                <div class="col-lg-6 offset-lg-1">
                    <div class="d-flex flex-column gap-3">
                        
                        <div class="d-flex align-items-start gap-3 p-4 rounded-4 bg-white shadow-sm" style="border: 1px solid rgba(203, 213, 208, 0.3);">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 48px; height: 48px; background: rgba(74, 122, 109, 0.1); color: var(--primary); font-size: 1.25rem;">
                                <i class="bi bi-clipboard2-pulse"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1" style="color: var(--text-main);">Berbasis Ilmiah (DASS-42)</h6>
                                <p class="small mb-0" style="color: var(--text-muted); line-height: 1.6;">Dirancang mengadaptasi instrumen skala psikologis internasional yang teruji validitasnya untuk mengukur intensitas Depresi, Kecemasan, dan Stres.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 p-4 rounded-4 bg-white shadow-sm" style="border: 1px solid rgba(203, 213, 208, 0.3);">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 48px; height: 48px; background: rgba(74, 122, 109, 0.1); color: var(--primary); font-size: 1.25rem;">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1" style="color: var(--text-main);">Ruang Aman & Rahasia</h6>
                                <p class="small mb-0" style="color: var(--text-muted); line-height: 1.6;">Setiap data jawaban Anda dienkripsi secara ketat. Tidak ada data yang dipublikasikan. Ini adalah ruang privat murni untuk wawasan Anda sendiri.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 p-4 rounded-4 bg-white shadow-sm" style="border: 1px solid rgba(203, 213, 208, 0.3);">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 48px; height: 48px; background: rgba(221, 107, 32, 0.1); color: var(--warning-soft); font-size: 1.25rem;">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1" style="color: var(--text-main);">Bukan Pengganti Profesional</h6>
                                <p class="small mb-0" style="color: var(--text-muted); line-height: 1.6;">Hasil skrining berfungsi sebagai alarm pencegahan dini. Kami selalu mendorong konsultasi dengan psikolog klinis jika Anda membutuhkan pendampingan lebih lanjut.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY QUESTION & SOLUTION -->
    <section id="why" class="py-5 bg-white border-top border-light">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3" style="color: var(--text-main);">Mengapa Skrining Ini Penting?</h2>
                <p class="mx-auto" style="max-width: 600px; color: var(--text-muted); line-height: 1.7;">
                    Sering merasa lelah berlebihan, sulit fokus, atau mudah gelisah akhir-akhir ini? Mengetahui kondisi mental adalah langkah pertama menuju keseimbangan diri.
                </p>
            </div>
            
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="feature-card text-center bg-soft">
                        <div class="feature-icon icon-sage mx-auto">
                            <i class="bi bi-journal-check"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Instrumen Valid</h5>
                        <p class="small mb-0" style="color: var(--text-muted); line-height: 1.6;">Menggunakan kuesioner standar internasional DASS-42 yang teruji untuk mengukur tingkat Depresi, Kecemasan, dan Stres.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center bg-soft">
                        <div class="feature-icon icon-emerald mx-auto">
                            <i class="bi bi-person-bounding-box"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Kenali Diri Sendiri</h5>
                        <p class="small mb-0" style="color: var(--text-muted); line-height: 1.6;">Membantu Anda mengidentifikasi beban pikiran yang mungkin sering diabaikan selama menjalani rutinitas harian.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center bg-soft">
                        <div class="feature-icon icon-warm mx-auto">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Pantau Perkembangan</h5>
                        <p class="small mb-0" style="color: var(--text-muted); line-height: 1.6;">Lakukan skrining secara berkala dan lihat riwayat hasil Anda untuk memantau perjalanan emosional dari waktu ke waktu.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section id="how" class="py-5 bg-white border-top border-light">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="fw-bold mb-4" style="color: var(--text-main);">Cara Kerja yang Sederhana</h2>
                    <p class="mb-5" style="color: var(--text-muted);">Proses evaluasi didesain agar mudah, mengalir, dan nyaman untuk digunakan pada saat Anda memiliki waktu luang.</p>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="step-number step-number-1">1</div>
                        <div class="ms-4">
                            <h6 class="fw-bold mb-1">Buat Akun Pribadi</h6>
                            <p class="small mb-0" style="color: var(--text-muted);">Daftar agar sistem dapat menyimpan riwayat Anda secara aman.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="step-number step-number-2">2</div>
                        <div class="ms-4">
                            <h6 class="fw-bold mb-1">Jawab dengan Jujur</h6>
                            <p class="small mb-0" style="color: var(--text-muted);">Terdapat 42 pernyataan. Pilih yang paling sesuai dengan perasaanmu seminggu terakhir. Tidak ada jawaban yang salah.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start">
                        <div class="step-number step-number-3">3</div>
                        <div class="ms-4">
                            <h6 class="fw-bold mb-1">Lihat Hasil & Insight</h6>
                            <p class="small mb-0" style="color: var(--text-muted);">Dapatkan gambaran kondisi emosional Anda saat ini beserta saran langkah selanjutnya.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="rounded-4 p-5 text-center" style="background: var(--bg-soft); border: 1px dashed rgba(203, 213, 208, 0.8);">
                        <i class="bi bi-cup-hot text-primary opacity-50" style="font-size: 7rem;"></i>
                        <h4 class="fw-bold mt-4">Ambil Waktu Sejenak</h4>
                        <p class="text-muted">Siapkan minuman hangat, cari tempat tenang, dan butuh waktu sekitar 5-10 menit saja.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section id="faq" class="py-5 my-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3" style="color: var(--text-main);">Pertanyaan yang Sering Diajukan</h2>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Siapa yang mengembangkan aplikasi ini?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Aplikasi ini dikembangkan sebagai dedikasi untuk mempermudah akses skrining kesehatan mental berbasis bukti ilmiah menggunakan instrumen DASS-42. Tujuannya adalah membangun kesadaran (<em>awareness</em>) kesehatan mental di lingkungan institusi.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Apakah data jawaban saya dibagikan ke publik?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <strong>Sama sekali tidak.</strong> Privasi Anda adalah prioritas utama. Data Anda disimpan secara aman di server kami dan hanya digunakan untuk menampilkan histori hasil Anda secara pribadi.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Bagaimana jika hasil skrining saya "Sangat Parah"?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Hal pertama: tarik napas panjang, Anda tidak sendirian. Hasil kuesioner bukanlah vonis pasti, melainkan sinyal dari tubuh dan pikiran yang meminta jeda. Kami sangat menyarankan Anda untuk menggunakan hasil ini sebagai langkah awal untuk berdiskusi dengan konselor, psikolog, atau layanan kesehatan di kampus/fasilitas kesehatan terdekat.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BOTTOM CTA -->
    <section class="py-5 mb-5">
        <div class="container">
            <div class="cta-section">
                <div class="position-relative z-1">
                    <h2 class="fw-bold mb-3">Beri Ruang untuk Dirimu Sendiri.</h2>
                    <p class="mb-4 fs-5" style="color: rgba(255,255,255,0.85);">Kesehatan pikiranmu sama berharganya dengan kesehatan fisikmu.</p>
                    
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg rounded-pill px-5 fw-bold shadow-sm text-primary" style="transition: transform 0.3s ease;">
                            Mulai Skrining Gratis
                        </a>
                    @else
                        <a href="{{ route('mahasiswa.screenings.onboarding') }}" class="btn btn-light btn-lg rounded-pill px-5 fw-bold shadow-sm text-primary" style="transition: transform 0.3s ease;">
                            Mulai Skrining Gratis
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center border-bottom pb-4 mb-4" style="border-color: rgba(255,255,255,0.1) !important;">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <h4 class="text-white fw-bold d-flex align-items-center justify-content-center justify-content-md-start gap-2">
                        <i class="bi bi-heart-pulse-fill" style="color: #6B9080;"></i> MindScreen
                    </h4>
                    <p class="small mb-0 mt-2" style="color: #8C9C95;">Platform Evaluasi Kesehatan Mental Mandiri Berbasis DASS-42.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#about" class="me-3 small opacity-75">Tentang Kami</a>
                    <a href="#why" class="me-3 small opacity-75">Kenapa Penting?</a>
                    <a href="#how" class="me-3 small opacity-75">Cara Kerja</a>
                    <a href="#faq" class="small opacity-75">FAQ</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center small" style="color: #6C8076;">
                    &copy; {{ date('Y') }} MindScreen. All rights reserved.<br>
                    Dikembangkan untuk memajukan kesejahteraan mental.
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>