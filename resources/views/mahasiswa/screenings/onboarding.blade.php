@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        CUSTOM STYLE ONBOARDING
    =========================== */
    .onboarding-card {
        border: none;
        border-radius: 24px;
        background: #FFFFFF;
        box-shadow: 0 15px 50px -10px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }

    .hero-section {
        background: linear-gradient(135deg, #F0F7FF 0%, #E0EFFF 100%);
        padding: 60px 30px;
        text-align: center;
        border-bottom: 1px solid #E2E8F0;
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
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.15);
        color: #3B82F6;
        font-size: 36px;
    }

    .feature-box {
        padding: 24px;
        background: #F8FAFC;
        border-radius: 16px;
        border: 1px solid #E2E8F0;
        height: 100%;
        transition: transform 0.3s ease;
    }

    .feature-box:hover {
        transform: translateY(-5px);
        background: #FFFFFF;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
        border-color: #CBD5E1;
    }

    .feature-icon {
        font-size: 28px;
        margin-bottom: 16px;
        color: #4F46E5;
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
        background: #CBD5E1;
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
        background: #4F46E5;
        border: 4px solid #F8FAFC;
        border-radius: 50%;
        z-index: 1;
    }

    .btn-start {
        height: 56px;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 0.5px;
        border-radius: 16px;
        background: linear-gradient(135deg, #4F46E5 0%, #3B82F6 100%);
        border: none;
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.2);
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFFFFF;
    }

    .btn-start:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(79, 70, 229, 0.3);
        color: #FFFFFF;
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
                <h2 class="fw-bold text-dark mb-3">Selamat Datang</h2>
                <p class="text-secondary mb-0 mx-auto" style="max-width: 600px; font-size: 16px; line-height: 1.6;">
                    Sebelum kita mulai, luangkan waktu sejenak untuk memahami bagaimana proses skrining ini bekerja. Tes ini dirancang untuk memantau tingkat stres, kecemasan, dan depresi Anda (DASS-42).
                </p>
            </div>

            <div class="card-body p-4 p-md-5">
                
                <!-- Info Grid -->
                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <div class="feature-box text-center">
                            <i class="bi bi-ui-checks-grid feature-icon"></i>
                            <h6 class="fw-bold mb-2">42 Pertanyaan</h6>
                            <p class="text-secondary mb-0" style="font-size: 14px;">Bentuk pilihan ganda (Tidak Pernah hingga Hampir Selalu).</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-box text-center">
                            <i class="bi bi-stopwatch feature-icon"></i>
                            <h6 class="fw-bold mb-2">Estimasi 5-10 Menit</h6>
                            <p class="text-secondary mb-0" style="font-size: 14px;">Luangkan waktu sejenak di tempat yang tenang agar fokus.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-box text-center">
                            <i class="bi bi-shield-lock feature-icon"></i>
                            <h6 class="fw-bold mb-2">Privasi Terjaga</h6>
                            <p class="text-secondary mb-0" style="font-size: 14px;">Data Anda dienkripsi dan hanya digunakan untuk konseling.</p>
                        </div>
                    </div>
                </div>

                <hr class="mb-5" style="opacity: 0.1;">

                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <h4 class="fw-bold mb-4">Bagaimana Prosesnya?</h4>
                        <div class="timeline-steps">
                            <div class="step-item">
                                <div class="step-dot"></div>
                                <h6 class="fw-bold mb-1">Jawab dengan Jujur</h6>
                                <p class="text-secondary" style="font-size: 14px;">Tidak ada jawaban benar/salah. Pilih yang paling menggambarkan kondisi Anda selama satu minggu terakhir.</p>
                            </div>
                            <div class="step-item">
                                <div class="step-dot"></div>
                                <h6 class="fw-bold mb-1">Sistem Memproses Data</h6>
                                <p class="text-secondary" style="font-size: 14px;">Algoritma kami akan menghitung skor berdasarkan indikator psikologis standar (DASS).</p>
                            </div>
                            <div class="step-item">
                                <div class="step-dot"></div>
                                <h6 class="fw-bold mb-1">Lihat Hasil & Rekomendasi</h6>
                                <p class="text-secondary" style="font-size: 14px;">Setelah selesai, Anda akan langsung melihat tingkat kesejahteraan Anda beserta langkah yang bisa diambil selanjutnya.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 px-lg-4">
                        <div class="p-4 bg-light rounded-4 border">
                            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-lightbulb-fill text-warning me-2"></i>Tips Pengisian:</h6>
                            <ul class="text-secondary mb-4" style="font-size: 14px; padding-left: 20px;">
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