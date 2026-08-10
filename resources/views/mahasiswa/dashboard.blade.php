@extends('layouts.app')

@section('content')
<style>
    /* ===========================
       VARIABEL TEMA & WARNA 
       (Default: MODE TERANG)
    =========================== */
    :root {
        --sage-primary: #4A7A6D;
        --sage-hover: #3b6358;
        --sage-light: #e8f0ec;
        --sage-surface: #f4f7f6;
        --card-bg: #FFFFFF;   /* Latar kotak terang */
        --text-dark: #1e293b; /* Teks warna gelap agar terbaca */
        --text-muted: #64748b;
        --border-soft: rgba(74, 122, 109, 0.15);
        --radius-xl: 24px;
        --radius-lg: 16px;
        --shadow-soft: 0 12px 30px rgba(74, 122, 109, 0.06);
    }

    /* ===========================
       MODE GELAP (DARK MODE)
       (Otomatis berubah jika tombol mode gelap diklik)
    =========================== */
    html.dark, body.dark, body.dark-mode, [data-theme="dark"], [data-bs-theme="dark"] {
        --sage-hover: #5b9686;
        --sage-light: rgba(74, 122, 109, 0.2);
        --sage-surface: #1e293b;
        --card-bg: #151e2b;   /* Latar kotak gelap */
        --text-dark: #f8fafc; /* Teks warna terang agar terbaca */
        --text-muted: #94a3b8;
        --border-soft: rgba(255, 255, 255, 0.1);
        --shadow-soft: 0 8px 25px rgba(0, 0, 0, 0.3);
    }
    .dashboard-card {
        border: none;
        border-radius: var(--radius-xl);
        background: var(--card-bg);
        box-shadow: var(--shadow-soft);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 32px rgba(74, 122, 109, 0.08);
    }

    .stat-icon-bg {
        position: absolute;
        right: -20px;
        bottom: -20px;
        font-size: 150px;
        color: rgba(74, 122, 109, 0.03);
        z-index: 0;
        transform: rotate(-15deg);
        pointer-events: none;
    }

    /* KOTAK STATISTIK */
    .stat-box {
        background: var(--card-bg);
        border: 1px solid var(--border-soft);
        border-radius: var(--radius-lg);
        padding: 20px 16px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(74, 122, 109, 0.02);
    }

    .stat-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(74, 122, 109, 0.08);
        border-color: var(--sage-primary);
        background: var(--sage-surface);
    }

    /* ===========================
       BADGES & TAGS
    =========================== */
    .badge-modern {
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.3px;
        padding: 8px 18px;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .badge-normal { background-color: rgba(34, 197, 94, 0.15) !important; color: #16a34a !important; border: 1px solid rgba(34, 197, 94, 0.3); }
    .badge-ringan { background-color: rgba(234, 179, 8, 0.15) !important; color: #ca8a04 !important; border: 1px solid rgba(234, 179, 8, 0.3); }
    .badge-sedang { background-color: rgba(249, 115, 22, 0.15) !important; color: #ea580c !important; border: 1px solid rgba(249, 115, 22, 0.3); }
    .badge-parah { background-color: rgba(239, 68, 68, 0.15) !important; color: #dc2626 !important; border: 1px solid rgba(239, 68, 68, 0.3); }
    .badge-sangat-parah { background-color: rgba(124, 58, 237, 0.15) !important; color: #6d28d9 !important; border: 1px solid rgba(124, 58, 237, 0.3); }
    .badge-default { background-color: var(--sage-surface) !important; color: var(--text-muted) !important; border: 1px solid var(--border-soft); }

    /* UTILITIES SAGE */
    .text-sage { color: var(--sage-primary) !important; }
    .bg-sage-light { background-color: var(--sage-light) !important; }

    /* ===========================
       TOMBOL SAGE
    =========================== */
    .btn-sage {
        background: var(--sage-primary);
        border: none;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-sage:hover {
        background: var(--sage-hover);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(74, 122, 109, 0.2);
    }

    .btn-outline-sage {
        background: var(--card-bg);
        border: 1.5px solid var(--sage-primary);
        color: var(--sage-primary);
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-sage:hover {
        background: var(--sage-primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(74, 122, 109, 0.15);
    }
</style>

<div class="container pb-5 pt-3">
    <!-- HEADER -->
    <div class="row mb-4 align-items-center page-title-section">
        <div class="col-12">
            <h3 class="fw-bolder mb-2" style="letter-spacing: -0.5px; color: var(--text-dark);">Dashboard Mahasiswa</h3>
            <p class="mb-0" style="font-size: 15px; color: var(--text-muted);">
                Halo, <span class="fw-bold text-sage">{{ Auth::user()->username }}</span>. Pantau terus kesehatan mental Anda secara berkala.
            </p>
        </div>
    </div>

    <!-- KARTU UTAMA -->
    <div class="row g-4 mb-4">
        <!-- Kartu Total Skrining -->
        <div class="col-lg-5 col-md-12">
            <div class="dashboard-card h-100 p-4 p-md-5 d-flex flex-column justify-content-center text-center">
                <i class="bi bi-journal-medical stat-icon-bg"></i>
                <div class="position-relative z-1">
                    <div class="d-inline-flex align-items-center justify-content-center bg-sage-light text-sage rounded-circle mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-activity fs-2"></i>
                    </div>
                    <h6 class="fw-bold mb-2 text-uppercase" style="letter-spacing: 1.5px; font-size: 12.5px; color: var(--text-muted);">Total Skrining</h6>
                    <h1 class="display-3 fw-bolder mb-4" style="letter-spacing: -2px; color: var(--text-dark);">{{ $totalScreening ?? 0 }}</h1>
                    
                    <div class="mt-auto">
                        @if(empty($totalScreening) || $totalScreening == 0)
                            <p class="small mb-3" style="color: var(--text-muted);">Anda belum pernah melakukan skrining.</p>
                            <a href="{{ route('mahasiswa.screenings.onboarding') }}" class="btn btn-sage px-4 py-2 w-100 rounded-pill">
                                <i class="bi bi-plus-circle me-2"></i> Mulai Skrining Pertama
                            </a>
                        @else
                            <a href="{{ route('mahasiswa.screenings.onboarding') }}" class="btn btn-outline-sage px-4 py-2 w-100 rounded-pill">
                                <i class="bi bi-arrow-repeat me-2"></i> Lakukan Skrining Baru
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Kartu Status Terakhir -->
        <div class="col-lg-7 col-md-12">
            <div class="dashboard-card h-100 p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4 flex-wrap gap-2" style="border-color: var(--border-soft) !important;">
                    <div class="d-flex align-items-center">
                        <div class="bg-sage-light p-2 rounded-lg me-3 text-sage">
                            <i class="bi bi-clock-history fs-5"></i>
                        </div>
                        <h5 class="fw-bold mb-0" style="color: var(--text-dark);">Status Skrining Terakhir</h5>
                    </div>
                    @if($latestScreening)
                        <span class="badge" style="background-color: var(--sage-surface); color: var(--sage-hover); border: 1px solid var(--border-soft); padding: 8px 16px; border-radius: 20px; font-weight: 600;">
                            {{ $latestScreening->created_at ? $latestScreening->created_at->format('d M Y - H:i') : '' }} WIB
                        </span>
                    @endif
                </div>

                @if($latestScreening)
                    @php
                        $badgeMap = [
                            'normal' => 'badge-normal',
                            'ringan' => 'badge-ringan',
                            'sedang' => 'badge-sedang',
                            'parah' => 'badge-parah',
                            'sangat parah' => 'badge-sangat-parah'
                        ];

                        // Logika PHP yang dipecah agar aman dari compiler syntax error
                        $statusDepresi = strtolower(trim($latestScreening->status_depresi ?? ''));
                        $statusCemas = strtolower(trim($latestScreening->status_kecemasan ?? ''));
                        $statusStres = strtolower(trim($latestScreening->status_stres ?? ''));

                        $classDepresi = $badgeMap[$statusDepresi] ?? 'badge-default';
                        $classCemas = $badgeMap[$statusCemas] ?? 'badge-default';
                        $classStres = $badgeMap[$statusStres] ?? 'badge-default';
                    @endphp
                    
                    <div class="row g-3 text-center">
                        <div class="col-12 col-md-4">
                            <div class="stat-box h-100 d-flex flex-column justify-content-between">
                                <p class="mb-3 fw-bold text-uppercase" style="font-size: 12px; letter-spacing: 1px; color: var(--text-muted);">Depresi</p>
                                <h2 class="fw-bolder mb-3" style="font-size: 2.5rem; color: var(--text-dark);">{{ $latestScreening->score_depresi ?? 0 }}</h2>
                                <span class="badge-modern {{ $classDepresi }}">
                                    {{ ucfirst($latestScreening->status_depresi ?? '-') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-4">
                            <div class="stat-box h-100 d-flex flex-column justify-content-between">
                                <p class="mb-3 fw-bold text-uppercase" style="font-size: 12px; letter-spacing: 1px; color: var(--text-muted);">Kecemasan</p>
                                <h2 class="fw-bolder mb-3" style="font-size: 2.5rem; color: var(--text-dark);">{{ $latestScreening->score_kecemasan ?? 0 }}</h2>
                                <span class="badge-modern {{ $classCemas }}">
                                    {{ ucfirst($latestScreening->status_kecemasan ?? '-') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-4">
                            <div class="stat-box h-100 d-flex flex-column justify-content-between">
                                <p class="mb-3 fw-bold text-uppercase" style="font-size: 12px; letter-spacing: 1px; color: var(--text-muted);">Stres</p>
                                <h2 class="fw-bolder mb-3" style="font-size: 2.5rem; color: var(--text-dark);">{{ $latestScreening->score_stres ?? 0 }}</h2>
                                <span class="badge-modern {{ $classStres }}">
                                    {{ ucfirst($latestScreening->status_stres ?? '-') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 py-4 opacity-75">
                        <div class="mb-3" style="width: 80px; height: 80px; background: var(--sage-light); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-folder2-open fs-1 text-sage"></i>
                        </div>
                        <span class="fw-medium" style="color: var(--text-muted);">Belum ada data hasil skrining.</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- GRAFIK -->
    @if(!empty($totalScreening) && $totalScreening > 0)
    <div class="dashboard-card mb-5 p-1">
        <div class="card-header bg-transparent border-bottom-0 pt-4 pb-2 px-4 px-md-5 d-flex align-items-center">
            <div class="bg-sage-light p-2 rounded-lg me-3" style="width: 42px; height: 42px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-graph-up text-sage fs-5"></i>
            </div>
            <div>
                <h5 class="mb-0 fw-bold" style="color: var(--text-dark);">Grafik Pemantauan DASS-42</h5>
                <small style="font-size: 13.5px; color: var(--text-muted);">Perkembangan skor kesehatan mental Anda dari waktu ke waktu</small>
            </div>
        </div>
        <div class="card-body px-4 px-md-5 pb-5 pt-3">
            <div style="overflow-x: auto; overflow-y: hidden; width: 100%; border-radius: var(--radius-lg); background: var(--sage-surface); padding: 20px; border: 1px solid var(--border-soft);">
                <div id="chartWrapper" style="position: relative; height: 350px; width: 100%;">
                    <canvas id="dashboardHistoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
@if(!empty($totalScreening) && $totalScreening > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('dashboardHistoryChart');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        
        // Pendekatan anti ParseError Blade & aman untuk Data Object/Array
        const rawLabels = {!! json_encode($labels ?? []) !!};
        const rawDepresi = {!! json_encode($dataDepresi ?? []) !!};
        const rawKecemasan = {!! json_encode($dataKecemasan ?? []) !!};
        const rawStres = {!! json_encode($dataStres ?? []) !!};

        const labels = Array.isArray(rawLabels) ? rawLabels : Object.values(rawLabels);
        const dataDepresi = (Array.isArray(rawDepresi) ? rawDepresi : Object.values(rawDepresi)).map(Number);
        const dataKecemasan = (Array.isArray(rawKecemasan) ? rawKecemasan : Object.values(rawKecemasan)).map(Number);
        const dataStres = (Array.isArray(rawStres) ? rawStres : Object.values(rawStres)).map(Number);

        if (!labels || labels.length === 0) return;

        const chartWrapper = document.getElementById('chartWrapper');
        const parentLayar = chartWrapper.parentElement;
        
        const minWidthPerPoint = 120; 
        let calculatedWidth = labels.length * minWidthPerPoint;
        let parentWidth = parentLayar.clientWidth || window.innerWidth;

        if (calculatedWidth > parentWidth) {
            chartWrapper.style.width = calculatedWidth + 'px';
        } else {
            chartWrapper.style.width = '100%';
        }

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Skor Depresi',
                        data: dataDepresi,
                        borderColor: '#4A7A6D',
                        backgroundColor: 'rgba(74, 122, 109, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#4A7A6D',
                        pointRadius: 5,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Skor Kecemasan',
                        data: dataKecemasan,
                        borderColor: '#E9C46A',
                        backgroundColor: 'rgba(233, 196, 106, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#E9C46A',
                        pointRadius: 5,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Skor Stres',
                        data: dataStres,
                        borderColor: '#E76F51',
                        backgroundColor: 'rgba(231, 111, 81, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#E76F51',
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, 
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 42, 
                        grid: {
                            color: 'rgba(74, 122, 109, 0.1)',
                            drawBorder: false,
                        },
                        title: { display: true, text: 'Skor Penilaian', font: { weight: '600' }, color: '#64748B' }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                        title: { display: true, text: 'Tanggal Skrining', font: { weight: '600' }, color: '#64748B' }
                    }
                },
                plugins: {
                    legend: { 
                        display: true, 
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { weight: '600', size: 13 },
                            color: '#1e293b'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(30, 41, 59, 0.95)',
                        titleFont: { size: 13, weight: '700' },
                        bodyFont: { size: 13 },
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: true
                    }
                }
            }
        });
    });
</script>
@endif
@endpush