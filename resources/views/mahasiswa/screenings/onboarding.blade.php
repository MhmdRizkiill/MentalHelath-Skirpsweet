@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        CUSTOM STYLE ONBOARDING
    =========================== */
    .onboarding-card {
        border: 1px solid rgba(255, 255, 255, 0.9);
        border-radius: var(--radius-lg, 24px);
        background: var(--card-bg, rgba(255, 255, 255, 0.88));
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 15px 40px -10px rgba(74, 122, 109, 0.1);
        overflow: hidden;
    }

    .hero-section {
        /* Menggunakan nuansa sage yang lembut untuk hero section */
        background: linear-gradient(135deg, rgba(74, 122, 109, 0.06) 0%, rgba(107, 144, 128, 0.12) 100%);
        padding: 60px 30px;
        text-align: center;
        border-bottom: 1px solid var(--border);
    }

    .hero-icon {
        width: 80px;
        height: 80px;
        background: #FFFFFF;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px auto;
        box-shadow: 0 8px 25px rgba(74, 122, 109, 0.15);
        color: var(--primary);
        font-size: 36px;
    }

    .feature-box {
        padding: 24px;
        background: rgba(255, 255, 255, 0.6);
        border-radius: var(--radius-md, 16px);
        border: 1px solid var(--border);
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .feature-box:hover {
        transform: translateY(-5px);
        background: #FFFFFF;
        box-shadow: 0 12px 25px rgba(74, 122, 109, 0.08);
        border-color: var(--accent);
    }

    .feature-icon {
        font-size: 28px;
        margin-bottom: 16px;
        color: var(--secondary);
    }

    .timeline-steps {
        position: relative;
        padding-left: 30px;
        margin-top: 30px;
    }

    .timeline-steps::before {
        content: '';
        position: absolute;
        left: 11px;
        top: 10px;
        bottom: 20px;
        width: 2px;
        background: var(--border);
        border-radius: 2px;
    }

    .step-item {
        position: relative;
        margin-bottom: 24px;
    }
    
    .step-item:last-child {
        margin-bottom: 0;
    }

    .step-dot {
        position: absolute;
        left: -30px;
        top: 2px;
        width: 24px;
        height: 24px;
        background: var(--primary);
        border: 4px solid #FFFFFF;
        border-radius: 50%;
        z-index: 1;
        box-shadow: 0 2px 8px rgba(74, 122, 109, 0.2);
    }

    .btn-start {
        height: 56px;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 0.5px;
        border-radius: var(--radius-md, 16px);
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        border: none;
        box-shadow: 0 8px 20px rgba(74, 122, 109, 0.22);
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFFFFF !important;
    }

    .btn-start:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(74, 122, 109, 0.32);
        background: linear-gradient(135deg, var(--primary-hover) 0%, var(--primary) 100%);
    }

    .tips-box {
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
    }
</style>

<div class="row justify-content-center mb-5">
    <div class="col-lg-10 col-xl-9">
        <div class="card onboarding-card">
            
            <!-- Hero Section -->
            <div class="hero-section">
                <div class="hero-icon">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
                <h2 class="fw-bold mb-3" style="color: var(--text);">Selamat Datang</h2>
                <p class="mb-0 mx-auto" style="color: var(--muted); max-width: 600px; font-size: 16px; line-height: 1.6;">
                    Sebelum kita mulai, luangkan waktu sejenak untuk memahami bagaimana proses skrining ini bekerja. Tes ini dirancang untuk memantau tingkat stres, kecemasan, dan depresi Anda (DASS-42).
                </p>
            </div>

            <div class="card-body p-4 p-md-5">
                
                <!-- Info Grid -->
                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <div class="feature-box text-center">
                            <i class="bi bi-ui-checks-grid feature-icon"></i>
                            <h6 class="fw-bold mb-2" style="color: var(--text);">42 Pertanyaan</h6>
                            <p class="mb-0" style="color: var(--muted); font-size: 14px;">Bentuk pilihan ganda (Tidak Pernah hingga Hampir Selalu).</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-box text-center">
                            <i class="bi bi-stopwatch feature-icon"></i>
                            <h6 class="fw-bold mb-2" style="color: var(--text);">Estimasi 5-10 Menit</h6>
                            <p class="mb-0" style="color: var(--muted); font-size: 14px;">Luangkan waktu sejenak di tempat yang tenang agar fokus.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-box text-center">
                            <i class="bi bi-shield-check feature-icon"></i>
                            <h6 class="fw-bold mb-2" style="color: var(--text);">Privasi Terjaga</h6>
                            <p class="mb-0" style="color: var(--muted); font-size: 14px;">Data Anda dienkripsi dan hanya digunakan untuk konseling.</p>
                        </div>
                    </div>
                </div>

                <hr class="mb-5" style="border-color: var(--border);">

                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <h4 class="fw-bold mb-4" style="color: var(--text);">Bagaimana Prosesnya?</h4>
                        <div class="timeline-steps">
                            <div class="step-item">
                                <div class="step-dot"></div>
                                <h6 class="fw-bold mb-1" style="color: var(--text);">Jawab dengan Jujur</h6>
                                <p class="mb-0" style="color: var(--muted); font-size: 14px;">Tidak ada jawaban benar/salah. Pilih yang paling menggambarkan kondisi Anda selama satu minggu terakhir.</p>
                            </div>
                            <div class="step-item">
                                <div class="step-dot"></div>
                                <h6 class="fw-bold mb-1" style="color: var(--text);">Sistem Memproses Data</h6>
                                <p class="mb-0" style="color: var(--muted); font-size: 14px;">Algoritma kami akan menghitung skor berdasarkan indikator psikologis standar (DASS).</p>
                            </div>
                            <div class="step-item">
                                <div class="step-dot"></div>
                                <h6 class="fw-bold mb-1" style="color: var(--text);">Lihat Hasil & Rekomendasi</h6>
                                <p class="mb-0" style="color: var(--muted); font-size: 14px;">Setelah selesai, Anda akan langsung melihat tingkat kesejahteraan Anda beserta langkah yang bisa diambil selanjutnya.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 px-lg-4">
                        <div class="p-4 tips-box">
                            <h6 class="fw-bold mb-3" style="color: var(--text);">
                                <i class="bi bi-lightbulb-fill me-2" style="color: var(--warning);"></i>Tips Pengisian:
                            </h6>
                            <ul class="mb-4" style="color: var(--muted); font-size: 14px; padding-left: 20px;">
                                <li class="mb-2">Jangan terlalu lama berpikir pada satu pertanyaan. Reaksi pertama Anda biasanya adalah yang paling akurat.</li>
                                <li class="mb-2">Gunakan indikator "Progress Bar" di layar untuk melihat sisa pertanyaan.</li>
                                <li>Pastikan koneksi internet Anda stabil sebelum menekan tombol kirim.</li>
                            </ul>
                            
                            <!-- Ganti route() dengan route form create kuesioner Anda -->
                            <a href="{{ route('mahasiswa.screenings.create') }}" class="btn btn-start w-100">
                                Mulai Skrining Sekarang <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection