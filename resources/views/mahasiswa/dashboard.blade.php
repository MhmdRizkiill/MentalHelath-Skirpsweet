@extends('layouts.app')

@section('content')

<style>
    /* Custom Styling Khusus Dashboard (Calm & Steady Design) */
    .dashboard-header {
        background: transparent;
        border: none;
    }
    
    .dashboard-card {
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 20px;
        background: #FFFFFF;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03);
        position: relative;
        overflow: hidden;
        /* Menghapus transition dan hover transform agar card diam (steady) */
    }

    .stat-icon-bg {
        position: absolute;
        right: -20px;
        bottom: -20px;
        font-size: 140px;
        color: rgba(79, 70, 229, 0.04);
        z-index: 0;
        transform: rotate(-15deg);
        pointer-events: none;
    }

    .stat-box {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 16px 10px;
        /* Menghapus efek hover (perubahan warna) agar pengguna tidak terdistraksi */
    }

    .badge-modern {
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.3px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    /* Animasi HANYA diberikan pada elemen yang bisa diklik (Actionable) */
    .btn-actionable {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .btn-actionable:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(13, 110, 253, 0.15) !important;
    }
</style>

<div class="row mb-4 align-items-center">
    <div class="col-12">
        <div>
            <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Dashboard Mahasiswa</h3>
            <p class="text-muted mb-0">
                Halo, <span class="fw-semibold text-primary">{{ Auth::user()->username }}</span>. Pantau terus kesehatan mental Anda.
            </p>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-5 col-md-12">
        <div class="dashboard-card h-100 p-4 d-flex flex-column justify-content-center text-center">
            <i class="bi bi-journal-medical stat-icon-bg"></i>
            <div class="position-relative z-1">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-activity fs-3"></i>
                </div>
                <h6 class="text-muted fw-semibold mb-2 text-uppercase" style="letter-spacing: 1px; font-size: 13px;">Total Skrining</h6>
                <h1 class="display-3 fw-bold text-dark mb-4" style="letter-spacing: -2px;">{{ $totalScreening ?? 0 }}</h1>
                
                <div class="mt-auto">
                    @if(($totalScreening ?? 0) == 0)
                        <p class="text-muted small mb-3">Anda belum pernah melakukan skrining.</p>
                        <!-- Ditambahkan class btn-actionable -->
                        <a href="{{ route('mahasiswa.screenings.onboarding') }}" class="btn btn-primary btn-actionable px-4 py-2 w-100 rounded-pill shadow-sm">
                            <i class="bi bi-plus-circle me-2"></i> Mulai Skrining Pertama
                        </a>
                    @else
                        <!-- Ditambahkan class btn-actionable -->
                        <a href="{{ route('mahasiswa.screenings.onboarding') }}" class="btn btn-outline-primary btn-actionable px-4 py-2 w-100 rounded-pill">
                            <i class="bi bi-arrow-repeat me-2"></i> Lakukan Skrining Baru
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-7 col-md-12">
        <div class="dashboard-card h-100 p-4">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                <h6 class="fw-bold text-dark mb-0">Status Skrining Terakhir</h6>
                @if($latestScreening)
                    <span class="badge bg-light text-muted border px-3 py-2 rounded-pill">
                        <i class="bi bi-clock-history me-1"></i> {{ $latestScreening->created_at->format('d M Y, H:i') }}
                    </span>
                @endif
            </div>

            @if($latestScreening)
                @php
                    $badgeColors = [
                        'Normal' => 'background-color: #22C55E; color: white;',
                        'Ringan' => 'background-color: #EAB308; color: black;',
                        'Sedang' => 'background-color: #F97316; color: white;',
                        'Parah' => 'background-color: #EF4444; color: white;',
                        'Sangat Parah' => 'background-color: #7C3AED; color: white;'
                    ];
                @endphp
                
                <div class="row g-3 text-center">
                    <div class="col-4">
                        <div class="stat-box h-100 d-flex flex-column justify-content-between">
                            <p class="mb-2 fw-semibold text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Depresi</p>
                            <h2 class="text-dark fw-bold mb-3">{{ $latestScreening->score_depresi ?? 0 }}</h2>
                            <div>
                                <span class="badge rounded-pill px-3 py-2 badge-modern w-100" style="{{ $badgeColors[$latestScreening->status_depresi ?? ''] ?? 'background-color: #64748B; color: white;' }}">
                                    {{ $latestScreening->status_depresi ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-4">
                        <div class="stat-box h-100 d-flex flex-column justify-content-between">
                            <p class="mb-2 fw-semibold text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Kecemasan</p>
                            <h2 class="text-dark fw-bold mb-3">{{ $latestScreening->score_kecemasan ?? 0 }}</h2>
                            <div>
                                <span class="badge rounded-pill px-3 py-2 badge-modern w-100" style="{{ $badgeColors[$latestScreening->status_kecemasan ?? ''] ?? 'background-color: #64748B; color: white;' }}">
                                    {{ $latestScreening->status_kecemasan ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-4">
                        <div class="stat-box h-100 d-flex flex-column justify-content-between">
                            <p class="mb-2 fw-semibold text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Stres</p>
                            <h2 class="text-dark fw-bold mb-3">{{ $latestScreening->score_stres ?? 0 }}</h2>
                            <div>
                                <span class="badge rounded-pill px-3 py-2 badge-modern w-100" style="{{ $badgeColors[$latestScreening->status_stres ?? ''] ?? 'background-color: #64748B; color: white;' }}">
                                    {{ $latestScreening->status_stres ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="d-flex flex-column align-items-center justify-content-center h-100 py-4 opacity-50">
                    <i class="bi bi-folder2-open fs-1 text-muted mb-2"></i>
                    <span class="text-muted fw-medium">Belum ada data hasil skrining.</span>
                </div>
            @endif
        </div>
    </div>
</div>

@if(($totalScreening ?? 0) > 0)
<div class="dashboard-card mb-4 p-1">
    <div class="card-header bg-transparent border-bottom-0 pt-4 pb-2 px-4 d-flex align-items-center">
        <div class="bg-primary bg-opacity-10 p-2 rounded-lg me-3">
            <i class="bi bi-graph-up text-primary fs-5"></i>
        </div>
        <div>
            <h6 class="mb-0 fw-bold text-dark">Grafik Pemantauan DASS-42</h6>
            <small class="text-muted">Perkembangan skor kesehatan mental Anda dari waktu ke waktu</small>
        </div>
    </div>
    <div class="card-body px-4 pb-4 pt-2">
        <div style="overflow-x: auto; overflow-y: hidden; width: 100%; border-radius: 12px; background: #F8FAFC; padding: 15px;">
            <div id="chartWrapper" style="position: relative; height: 350px; width: 100%;">
                <canvas id="dashboardHistoryChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endif

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
        
        if (labels.length > 10) {
            let lebarLayar = parentLayar.clientWidth || 800; 
            const ekstraLebar = (labels.length - 10) * 100;
            chartWrapper.style.width = (lebarLayar + ekstraLebar) + 'px';
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
                        borderColor: '#3B82F6', 
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#3B82F6',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Skor Kecemasan',
                        data: dataKecemasan,
                        borderColor: '#EAB308', 
                        backgroundColor: 'rgba(234, 179, 8, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#EAB308',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Skor Stres',
                        data: dataStres,
                        borderColor: '#EF4444', 
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#EF4444',
                        pointRadius: 4,
                        pointHoverRadius: 6
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
                            color: 'rgba(226, 232, 240, 0.6)',
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
                            font: { family: "'Plus Jakarta Sans', sans-serif", weight: '500' }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13 },
                        bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13 },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: true
                    }
                }
            }
        });
    });
</script>
@endif
@endpush