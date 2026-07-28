@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        VARIABEL TEMA & WARNA
    =========================== */
    :root {
        --sage-primary: #4A7A6D;
        --sage-hover: #3b6358;
        --sage-light: #e8f0ec;
        --sage-surface: #f4f7f6;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --border-soft: rgba(74, 122, 109, 0.15);
        --radius-xl: 24px;
        --radius-lg: 16px;
        --shadow-soft: 0 12px 30px rgba(74, 122, 109, 0.06);
    }

    /* ===========================
        CUSTOM STYLING DASHBOARD
    =========================== */
    .dashboard-card {
        border: none;
        border-radius: var(--radius-xl);
        background: #FFFFFF;
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
        background: #FFFFFF;
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
        background: #FFFFFF;
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
            <h3 class="fw-bolder text-dark mb-2" style="letter-spacing: -0.5px;">Dashboard Mahasiswa</h3>
            <p class="text-muted mb-0" style="font-size: 15px;">
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
                    <h6 class="text-muted fw-bold mb-2 text-uppercase" style="letter-spacing: 1.5px; font-size: 12.5px;">Total Skrining</h6>
                    <h1 class="display-3 fw-bolder text-dark mb-4" style="letter-spacing: -2px;">{{ $totalScreening ?? 0 }}</h1>
                    
                    <div class="mt-auto">
                        @if(($totalScreening ?? 0) == 0)
                            <p class="text-muted small mb-3">Anda belum pernah melakukan skrining.</p>
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
                        <h5 class="fw-bold text-dark mb-0">Status Skrining Terakhir</h5>
                    </div>
                    @if($latestScreening)
                        <span class="badge" style="background-color: var(--sage-surface); color: var(--sage-hover); border: 1px solid var(--border-soft); padding: 8px 16px; border-radius: 20px; font-weight: 600;">
                            {{ $latestScreening->created_at->format('d M Y, H:i') }} WIB
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
                            'sangat parah' => 'badge-sangat-parah',
                        ];

                        $classDepresi = $badgeMap[strtolower(trim($latestScreening->status_depresi ?? ''))] ?? 'badge-default';
                        $classCemas = $badgeMap[strtolower(trim($latestScreening->status_kecemasan ?? ''))] ?? 'badge-default';
                        $classStres = $badgeMap[strtolower(trim($latestScreening->status_stres ?? ''))] ?? 'badge-default';
                    @endphp
                    
                    <div class="row g-3 text-center">
                        <div class="col-12 col-md-4">
                            <div class="stat-box h-100 d-flex flex-column justify-content-between">
                                <p class="mb-3 fw-bold text-muted text-uppercase" style="font-size: 12px; letter-spacing: 1px;">Depresi</p>
                                <h2 class="text-dark fw-bolder mb-3" style="font-size: 2.5rem;">{{ $latestScreening->score_depresi ?? 0 }}</h2>
                                <span class="badge-modern {{ $classDepresi }}">
                                    {{ ucfirst($latestScreening->status_depresi ?? '-') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-4">
                            <div class="stat-box h-100 d-flex flex-column justify-content-between">
                                <p class="mb-3 fw-bold text-muted text-uppercase" style="font-size: 12px; letter-spacing: 1px;">Kecemasan</p>
                                <h2 class="text-dark fw-bolder mb-3" style="font-size: 2.5rem;">{{ $latestScreening->score_kecemasan ?? 0 }}</h2>
                                <span class="badge-modern {{ $classCemas }}">
                                    {{ ucfirst($latestScreening->status_kecemasan ?? '-') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-4">
                            <div class="stat-box h-100 d-flex flex-column justify-content-between">
                                <p class="mb-3 fw-bold text-muted text-uppercase" style="font-size: 12px; letter-spacing: 1px;">Stres</p>
                                <h2 class="text-dark fw-bolder mb-3" style="font-size: 2.5rem;">{{ $latestScreening->score_stres ?? 0 }}</h2>
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
                        <span class="text-muted fw-medium">Belum ada data hasil skrining.</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- GRAFIK -->
    @if(($totalScreening ?? 0) > 0)
    <div class="dashboard-card mb-5 p-1">
        <div class="card-header bg-transparent border-bottom-0 pt-4 pb-2 px-4 px-md-5 d-flex align-items-center">
            <div class="bg-sage-light p-2 rounded-lg me-3" style="width: 42px; height: 42px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-graph-up text-sage fs-5"></i>
            </div>
            <div>
                <h5 class="mb-0 fw-bold text-dark">Grafik Pemantauan DASS-42</h5>
                <small class="text-muted" style="font-size: 13.5px;">Perkembangan skor kesehatan mental Anda dari waktu ke waktu</small>
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
@if(($totalScreening ?? 0) > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('dashboardHistoryChart');
        if(!canvas) return;
        const ctx = canvas.getContext('2d');
        
        const labels = Object.values({!! json_encode($labels ?? []) !!});
        const dataDepresi = Object.values({!! json_encode($dataDepresi ?? []) !!}).map(Number);
        const dataKecemasan = Object.values({!! json_encode($dataKecemasan ?? []) !!}).map(Number);
        const dataStres = Object.values({!! json_encode($dataStres ?? []) !!}).map(Number);

        if(labels.length === 0) return;

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
                        borderColor: '#4A7A6D', // Sage
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
                        borderColor: '#E9C46A', // Soft Gold
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
                        borderColor: '#E76F51', // Terracotta
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
                        title: { display: true, text: 'Skor Penilaian', font: { weight: '600', family: "'Plus Jakarta Sans', sans-serif" }, color: '#64748B' }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                        title: { display: true, text: 'Tanggal Skrining', font: { weight: '600', family: "'Plus Jakarta Sans', sans-serif" }, color: '#64748B' }
                    }
                },
                plugins: {
                    legend: { 
                        display: true, 
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { family: "'Plus Jakarta Sans', sans-serif", weight: '600', size: 13 },
                            color: '#1e293b'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(30, 41, 59, 0.95)', // text-dark with opacity
                        titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13, weight: '700' },
                        bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13 },
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