<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skrining Kesehatan Mental DASS-42</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #334155;
            background-color: #F8FAFC;
        }
        
        /* Navbar */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #F1F5F9;
        }

        /* Hero Section */
        .hero-section {
            padding: 120px 0 80px;
            background: linear-gradient(135deg, #EFF6FF 0%, #FFFFFF 100%);
        }
        
        .hero-title {
            font-weight: 800;
            color: #0F172A;
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .text-gradient {
            background: linear-gradient(90deg, #2563EB, #7C3AED);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Feature Cards */
        .feature-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px 30px;
            border: 1px solid #E2E8F0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.05);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 24px;
        }

        /* Accordion Custom */
        .accordion-button:not(.collapsed) {
            background-color: #EFF6FF;
            color: #1D4ED8;
            box-shadow: none;
        }
        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0,0,0,.125);
        }

        /* Footer */
        .footer {
            background-color: #0F172A;
            color: #94A3B8;
            padding: 60px 0 30px;
        }
        
        .footer-heading {
            color: #FFFFFF;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .footer a {
            color: #94A3B8;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer a:hover {
            color: #FFFFFF;
        }

        .disclaimer-box {
            background-color: rgba(239, 68, 68, 0.1);
            border-left: 4px solid #EF4444;
            padding: 16px 20px;
            border-radius: 0 8px 8px 0;
            margin: 30px 0;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center gap-2" href="#">
                <i class="bi bi-heart-pulse-fill fs-4"></i>
                <span>MindScreen</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item"><a class="nav-link fw-medium" href="#why">Kenapa Penting?</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="#how">Cara Kerja</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="#faq">FAQ</a></li>
                    <li class="nav-item ms-lg-3">
                        @auth
                            <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-4 fw-semibold">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">Masuk / Daftar</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-section text-center text-lg-start d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center justify-content-between g-5">
                <div class="col-lg-6">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-bold">
                        <i class="bi bi-stars me-1"></i> Skrining Mandiri DASS-42
                    </span>
                    <h1 class="hero-title display-4 mb-4">
                        Pahami Kondisi Mentalmu, <br>
                        <span class="text-gradient">Mulai Langkah Pertamamu.</span>
                    </h1>
                    <p class="lead text-muted mb-5" style="font-size: 1.1rem; line-height: 1.7;">
                        Aplikasi skrining ini membantu Anda mengevaluasi tingkat depresi, kecemasan, dan stres secara mandiri dalam waktu kurang dari 10 menit. Kenali diri Anda lebih baik hari ini.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow">
                            Mulai Skrining Sekarang <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <a href="#how" class="btn btn-outline-secondary btn-lg rounded-pill px-5 fw-bold bg-white">
                            Pelajari Dulu
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <!-- Placeholder Ilustrasi/Gambar -->
                    <img src="https://ui-avatars.com/api/?name=Mental+Health&background=EFF6FF&color=2563EB&size=500&font-size=0.1" alt="Mental Health Illustration" class="img-fluid rounded-circle shadow-lg" style="animation: float 6s ease-in-out infinite;">
                </div>
            </div>
        </div>
    </section>

    <!-- DISCLAIMER & VALIDATION (Sangat Penting) -->
    <section class="py-5 bg-white border-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="disclaimer-box text-start text-danger d-flex gap-3 align-items-start">
                        <i class="bi bi-exclamation-triangle-fill fs-3"></i>
                        <div>
                            <h6 class="fw-bold mb-1">Penting untuk Diketahui (Disclaimer)</h6>
                            <p class="mb-0 small" style="color: #991B1B;">
                                Aplikasi ini dirancang menggunakan instrumen <strong>DASS-42 (Depression Anxiety Stress Scales)</strong> yang valid secara akademis. Namun, hasil dari skrining ini <strong>BUKAN merupakan diagnosis medis atau psikologis</strong>. Aplikasi ini hanya berfungsi sebagai alat evaluasi awal. Jika Anda merasa kewalahan atau berada dalam kondisi krisis, mohon segera hubungi psikolog, psikiater, atau layanan bantuan profesional.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY QUESTION & SOLUTION -->
    <section id="why" class="py-5 my-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Mengapa Skrining Ini Penting?</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">
                    Sering merasa lelah berlebihan, sulit fokus, atau mudah panik akhir-akhir ini? Mengetahui kondisi mental adalah langkah pertama menuju penyembuhan.
                </p>
            </div>
            
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon bg-primary bg-opacity-10 text-primary mx-auto">
                            <i class="bi bi-journal-check"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Instrumen Valid</h5>
                        <p class="text-muted small mb-0">Menggunakan kuesioner standar internasional DASS-42 yang teruji untuk mengukur tingkat keparahan Depresi, Kecemasan, dan Stres.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon bg-success bg-opacity-10 text-success mx-auto">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Privasi Terjaga</h5>
                        <p class="text-muted small mb-0">Data jawaban Anda dienkripsi dan dirahasiakan. Kami berkomitmen melindungi privasi pengguna sesuai standar keamanan data.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon bg-warning bg-opacity-10 text-warning mx-auto">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Pantau Perkembangan</h5>
                        <p class="text-muted small mb-0">Lakukan skrining secara berkala dan lihat riwayat hasil Anda untuk memantau perubahan kondisi mental dari waktu ke waktu.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section id="how" class="py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="fw-bold mb-4">Cara Kerja Aplikasi</h2>
                    <p class="text-muted mb-4">Proses evaluasi didesain agar mudah, cepat, dan nyaman untuk digunakan oleh siapa saja.</p>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 fw-bold shadow" style="width: 40px; height: 40px;">1</div>
                        <div class="ms-3">
                            <h6 class="fw-bold mb-1">Daftar / Buat Akun</h6>
                            <p class="text-muted small mb-0">Buat akun untuk menyimpan riwayat hasil evaluasi Anda.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 fw-bold shadow" style="width: 40px; height: 40px;">2</div>
                        <div class="ms-3">
                            <h6 class="fw-bold mb-1">Jawab 42 Pertanyaan</h6>
                            <p class="text-muted small mb-0">Pilih jawaban yang paling sesuai dengan kondisi Anda selama 1 minggu terakhir. Tidak ada jawaban salah.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 fw-bold shadow" style="width: 40px; height: 40px;">3</div>
                        <div class="ms-3">
                            <h6 class="fw-bold mb-1">Dapatkan Hasil Seketika</h6>
                            <p class="text-muted small mb-0">Sistem akan mengklasifikasikan skor Anda ke dalam kategori Normal hingga Sangat Parah.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="bg-light rounded-4 p-5 text-center border">
                        <i class="bi bi-ui-checks text-primary opacity-25" style="font-size: 8rem;"></i>
                        <h4 class="fw-bold mt-4">Siap untuk mulai?</h4>
                        <p class="text-muted">Butuh waktu sekitar 5-10 menit.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section id="faq" class="py-5 my-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Pertanyaan yang Sering Diajukan</h2>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        
                        <!-- FAQ 1 -->
                        <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Siapa yang mengembangkan aplikasi ini?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted bg-white">
                                    Aplikasi ini dikembangkan oleh [Nama Anda/Universitas/Tim] sebagai dedikasi untuk mempermudah akses skrining kesehatan mental berbasis bukti ilmiah (instrumen DASS-42).
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Apakah data jawaban saya dibagikan ke publik?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted bg-white">
                                    <strong>Sama sekali tidak.</strong> Privasi Anda adalah prioritas utama. Data Anda disimpan secara aman di server kami dan hanya digunakan untuk menampilkan histori hasil Anda secara pribadi.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="accordion-item border rounded-3 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Bagaimana jika hasil skrining saya "Sangat Parah"?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted bg-white">
                                    Jangan panik. Hasil kuesioner bukanlah vonis pasti. Namun, itu adalah "alarm" dari tubuh dan pikiran Anda yang meminta bantuan. Kami sangat menyarankan Anda untuk membawa hasil ini sebagai bahan diskusi awal kepada konselor, psikolog, atau layanan kesehatan mental terdekat.
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
            <div class="bg-primary rounded-4 p-5 text-center text-white position-relative overflow-hidden shadow-lg">
                <div class="position-relative z-1">
                    <h2 class="fw-bold mb-3">Kenali Pikiranmu Sekarang.</h2>
                    <p class="mb-4 opacity-75 fs-5">Kesehatan mental sama pentingnya dengan kesehatan fisik.</p>
                    <a href="{{ route('login') }}" class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-primary shadow">
                        Mulai Skrining Gratis
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center border-bottom border-secondary pb-4 mb-4">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <h4 class="text-white fw-bold d-flex align-items-center justify-content-center justify-content-md-start gap-2">
                        <i class="bi bi-heart-pulse-fill text-primary"></i> MindScreen
                    </h4>
                    <p class="small mb-0 mt-2">Platform Evaluasi Kesehatan Mental Mandiri Berbasis DASS-42.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="me-3 small">Kebijakan Privasi</a>
                    <a href="#" class="me-3 small">Syarat Penggunaan</a>
                    <a href="mailto:admin@example.com" class="small"><i class="bi bi-envelope"></i> Kontak Bantuan</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center small text-muted">
                    &copy; {{ date('Y') }} [MentalHealth / Institut Teknologi Garut]. All rights reserved.<br>
                    Dikembangkan untuk memajukan kesadaran kesehatan mental.
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>