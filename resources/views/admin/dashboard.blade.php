@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        CUSTOM STYLE ADMIN DASHBOARD
    =========================== */
    .admin-header {
        letter-spacing: -0.5px;
    }

    /* Kartu Ringkasan */
    .stat-card {
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 18px;
        background: #FFFFFF;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        overflow: hidden;
        position: relative;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(15, 23, 42, 0.06);
    }

    .stat-icon-wrapper {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .bg-icon-primary { background: rgba(59, 130, 246, 0.1); color: #3B82F6; }
    .bg-icon-success { background: rgba(16, 185, 129, 0.1); color: #10B981; }
    .bg-icon-warning { background: rgba(79, 70, 229, 0.1); color: #4F46E5; }

    /* Panel Dashboard umum */
    .dashboard-panel {
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 20px;
        background: #FFFFFF;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03);
        margin-bottom: 24px;
    }

    .panel-header {
        background: #FFFFFF;
        border-bottom: 1px solid #F1F5F9;
        padding: 20px 24px;
        border-radius: 20px 20px 0 0;
    }

    /* Tabel Modern */
    .custom-table {
        margin-bottom: 0;
    }

    .custom-table thead th {
        background: #F8FAFC;
        color: #64748B;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px 20px;
        border-bottom: 1px solid #E2E8F0;
        border-top: none;
    }

    .custom-table tbody td {
        padding: 16px 20px;
        color: #334155;
        font-size: 14.5px;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
    }

    .custom-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #F8FAFC;
    }

    /* Modifikasi Label Badge */
    .badge-modern {
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.3px;
        padding: 6px 12px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
</style>

<div class="row mb-4 align-items-center">
    <div class="col-12">
        <h3 class="fw-bold text-dark admin-header mb-1">Dashboard Admin</h3>
        <p class="text-muted mb-0">
            Selamat datang, <span class="fw-semibold text-primary">{{ Auth::user()->username }}</span>. Berikut adalah ringkasan sistem saat ini.
        </p>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-4 col-md-6">
        <div class="stat-card p-4 h-100 d-flex align-items-center">
            <div class="stat-icon-wrapper bg-icon-primary me-4 flex-shrink-0">
                <i class="bi bi-people-fill"></i>
            </div>
            <div>
                <p class="text-muted fw-semibold text-uppercase mb-1" style="font-size: 12px; letter-spacing: 0.5px;">Total Mahasiswa</p>
                <h2 class="fw-bold text-dark mb-0" style="letter-spacing: -1px;">{{ $totalMahasiswa ?? 0 }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6">
        <div class="stat-card p-4 h-100 d-flex align-items-center">
            <div class="stat-icon-wrapper bg-icon-success me-4 flex-shrink-0">
                <i class="bi bi-clipboard2-data-fill"></i>
            </div>
            <div>
                <p class="text-muted fw-semibold text-uppercase mb-1" style="font-size: 12px; letter-spacing: 0.5px;">Total Skrining</p>
                <h2 class="fw-bold text-dark mb-0" style="letter-spacing: -1px;">{{ $totalScreening ?? 0 }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-12">
        <div class="stat-card p-4 h-100 d-flex align-items-center">
            <div class="stat-icon-wrapper bg-icon-warning me-4 flex-shrink-0">
                <i class="bi bi-patch-question-fill"></i>
            </div>
            <div>
                <p class="text-muted fw-semibold text-uppercase mb-1" style="font-size: 12px; letter-spacing: 0.5px;">Pertanyaan DASS-42</p>
                <h2 class="fw-bold text-dark mb-0" style="letter-spacing: -1px;">{{ $totalQuestion ?? 42 }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="dashboard-panel">
            <div class="panel-header d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 p-2 rounded-lg me-3">
                    <i class="bi bi-bar-chart-line text-primary fs-5"></i>
                </div>
                <div>
                    <h6 class="text-dark fw-bold mb-0">Distribusi Kondisi Mental Mahasiswa</h6>
                    <small class="text-muted">Akumulasi keseluruhan data skrining DASS-42</small>
                </div>
            </div>
            <div class="card-body p-4">
                <div style="position: relative; height: 380px; width: 100%;">
                    <canvas id="statusDistributionChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="dashboard-panel">
            <div class="panel-header d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-lg me-3">
                        <i class="bi bi-clock-history text-primary fs-5"></i>
                    </div>
                    <h6 class="text-dark fw-bold mb-0">5 Riwayat Skrining Terbaru</h6>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-light border shadow-sm rounded-pill px-3">
                    <i class="bi bi-arrow-repeat me-1"></i> Segarkan
                </a>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th class="align-middle text-start ps-4">Tanggal & Waktu</th>
                                <th class="align-middle text-start">Data Mahasiswa</th>
                                <th class="align-middle text-center">Depresi</th>
                                <th class="align-middle text-center">Kecemasan</th>
                                <th class="align-middle text-center">Stres</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $badgeColors = [
                                    'Normal' => 'background-color: #22C55E; color: white;',
                                    'Ringan' => 'background-color: #EAB308; color: black;',
                                    'Sedang' => 'background-color: #F97316; color: white;',
                                    'Parah' => 'background-color: #EF4444; color: white;',
                                    'Sangat Parah' => 'background-color: #7C3AED; color: white;'
                                ];
                            @endphp

                            @forelse($recentScreenings as $scr)
                            <tr>
                                <td class="align-middle text-start ps-4">
                                    <div class="fw-semibold text-dark">{{ $scr->created_at->format('d M Y') }}</div>
                                    <div class="text-muted small"><i class="bi bi-clock me-1"></i> {{ $scr->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td class="align-middle text-start">
                                    <div class="fw-bold text-primary">{{ $scr->user->username ?? 'Akun Dihapus' }}</div>
                                    <div class="text-muted small"><i class="bi bi-person-badge"></i> Pengguna Anonim</div>
                                </td>
                                
                                <td class="align-middle text-center">
                                    <span class="badge badge-modern rounded-pill mb-1" style="{{ $badgeColors[$scr->status_depresi ?? ''] ?? 'background-color: #64748B; color: white;' }}">
                                        {{ $scr->status_depresi ?? '-' }}
                                    </span><br>
                                    <small class="text-muted fw-medium">Skor: {{ $scr->score_depresi ?? 0 }}</small>
                                </td>
                                
                                <td class="align-middle text-center">
                                    <span class="badge badge-modern rounded-pill mb-1" style="{{ $badgeColors[$scr->status_kecemasan ?? ''] ?? 'background-color: #64748B; color: white;' }}">
                                        {{ $scr->status_kecemasan ?? '-' }}
                                    </span><br>
                                    <small class="text-muted fw-medium">Skor: {{ $scr->score_kecemasan ?? 0 }}</small>
                                </td>

                                <td class="align-middle text-center">
                                    <span class="badge badge-modern rounded-pill mb-1" style="{{ $badgeColors[$scr->status_stres ?? ''] ?? 'background-color: #64748B; color: white;' }}">
                                        {{ $scr->status_stres ?? '-' }}
                                    </span><br>
                                    <small class="text-muted fw-medium">Skor: {{ $scr->score_stres ?? 0 }}</small>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center opacity-50">
                                        <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
                                        <span class="text-muted fw-medium">Belum ada data riwayat skrining mahasiswa.</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('statusDistributionChart');
        if(!canvas) return;
        const ctx = canvas.getContext('2d');
        
        const dataDepresi = {!! json_encode($chartDepresi ?? [0,0,0,0,0]) !!};
        const dataKecemasan = {!! json_encode($chartKecemasan ?? [0,0,0,0,0]) !!};
        const dataStres = {!! json_encode($chartStres ?? [0,0,0,0,0]) !!};
        
        // Cek jika belum ada data sama sekali (semua 0)
        const totalData = [...dataDepresi, ...dataKecemasan, ...dataStres].reduce((a, b) => a + b, 0);
        
        if (totalData === 0) {
            canvas.parentElement.innerHTML = '<div class="d-flex flex-column align-items-center justify-content-center h-100 opacity-50"><i class="bi bi-bar-chart-steps fs-1 text-muted mb-2"></i><p class="text-muted fw-medium">Belum ada data skrining untuk ditampilkan grafik.</p></div>';
            return;
        }

        new Chart(ctx, {
            type: 'bar', 
            data: {
                labels: ['Normal', 'Ringan', 'Sedang', 'Parah', 'Sangat Parah'],
                datasets: [
                    {
                        label: 'Depresi',
                        data: dataDepresi,
                        backgroundColor: '#3B82F6', // Biru
                        borderRadius: 6,
                        borderSkipped: false
                    },
                    {
                        label: 'Kecemasan',
                        data: dataKecemasan,
                        backgroundColor: '#EAB308', // Kuning
                        borderRadius: 6,
                        borderSkipped: false
                    },
                    {
                        label: 'Stres',
                        data: dataStres,
                        backgroundColor: '#EF4444', // Merah
                        borderRadius: 6,
                        borderSkipped: false
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
                        ticks: { 
                            stepSize: 1,
                            font: { family: "'Plus Jakarta Sans', sans-serif" }
                        },
                        grid: {
                            color: 'rgba(226, 232, 240, 0.6)',
                            drawBorder: false,
                        },
                        title: { display: true, text: 'Jumlah Mahasiswa', font: { weight: '600', family: "'Plus Jakarta Sans', sans-serif" }, color: '#64748B' }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: { font: { family: "'Plus Jakarta Sans', sans-serif", weight: '500' } }
                    }
                },
                plugins: {
                    legend: { 
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { family: "'Plus Jakarta Sans', sans-serif", weight: '600' }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13 },
                        bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13 },
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                return ` ${context.dataset.label}: ${context.raw} Mahasiswa`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush