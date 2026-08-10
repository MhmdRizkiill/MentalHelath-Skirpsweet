@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        VARIABEL TEMA & WARNA (LIGHT MODE)
    =========================== */
    :root {
        --sage-primary: #4A7A6D;
        --sage-hover: #3b6358;
        --sage-light: #e8f0ec;
        --sage-surface: #f4f7f6;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --border-soft: rgba(74, 122, 109, 0.15);
        --bg-card: #FFFFFF;
        
        --radius-xl: 24px;
        --radius-lg: 16px;
        --shadow-soft: 0 12px 30px rgba(74, 122, 109, 0.06);
    }

    /* ===========================
        VARIABEL TEMA & WARNA (DARK MODE)
        Menggunakan class atau atribut (misal: .dark, .dark-mode, atau data-bs-theme) 
        agar sinkron dengan toggle di sidebar, bukan OS.
    =========================== */
    html.dark, body.dark-mode, [data-bs-theme="dark"] {
        --sage-primary: #63a895;
        --sage-hover: #4A7A6D;
        --sage-light: #21332e;
        --sage-surface: #162420;
        --text-dark: #f8fafc;
        --text-muted: #94a3b8;
        --border-soft: rgba(255, 255, 255, 0.1);
        --bg-card: #1e293b;
        --shadow-soft: 0 12px 30px rgba(0, 0, 0, 0.3);
    }
    
    html.dark body, body.dark-mode, [data-bs-theme="dark"] body {
        background-color: #0f172a;
        color: var(--text-dark);
    }

    /* ===========================
        ADAPTIVE UTILITIES
    =========================== */
    .bg-adaptive { background-color: var(--bg-card) !important; }
    .text-adaptive { color: var(--text-dark) !important; }
    .text-adaptive-muted { color: var(--text-muted) !important; }
    .border-adaptive { border-color: var(--border-soft) !important; }

    /* ===========================
        CUSTOM STYLE RIWAYAT
    =========================== */
    .history-card {
        background: var(--bg-card);
        border: none;
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-soft);
        transition: all 0.3s ease;
        margin-bottom: 24px;
        overflow: hidden;
    }

    .history-card-header {
        background: var(--bg-card);
        border-bottom: 1px solid var(--border-soft);
        padding: 20px 24px;
    }

    /* Tabel Modern - TEMA SAGE GREEN */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .custom-table {
        margin-bottom: 0;
        white-space: nowrap;
    }

    .custom-table thead th {
        background: var(--sage-light) !important; 
        color: var(--sage-primary) !important; 
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px 20px;
        border: none;
    }

    .custom-table tbody tr { background-color: var(--bg-card); transition: background-color 0.2s ease; }
    .custom-table tbody tr:nth-child(even) { background-color: var(--sage-surface); }
    .custom-table tbody tr:hover { background-color: var(--sage-light); }

    .custom-table tbody td {
        padding: 18px 20px;
        color: var(--text-dark);
        font-size: 14.5px;
        border-bottom: 1px solid var(--border-soft);
        vertical-align: middle;
    }

    /* ===========================
        BADGES & TAGS
    =========================== */
    .badge-hasil-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        min-width: 260px;
    }

    .badge-status {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.3px;
        padding: 6px 14px;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
    }

    .badge-normal { background-color: rgba(34, 197, 94, 0.15) !important; color: #34d399 !important; border: 1px solid rgba(34, 197, 94, 0.3); }
    .badge-ringan { background-color: rgba(234, 179, 8, 0.15) !important; color: #fbbf24 !important; border: 1px solid rgba(234, 179, 8, 0.3); }
    .badge-sedang { background-color: rgba(249, 115, 22, 0.15) !important; color: #fb923c !important; border: 1px solid rgba(249, 115, 22, 0.3); }
    .badge-parah { background-color: rgba(239, 68, 68, 0.15) !important; color: #f87171 !important; border: 1px solid rgba(239, 68, 68, 0.3); }
    .badge-sangat-parah { background-color: rgba(124, 58, 237, 0.15) !important; color: #a78bfa !important; border: 1px solid rgba(124, 58, 237, 0.3); }
    .badge-default { background-color: var(--sage-surface) !important; color: var(--text-muted) !important; border: 1px solid var(--border-soft); }

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
        background: var(--bg-card);
        border: 1.5px solid var(--sage-primary);
        color: var(--sage-primary);
        font-weight: 600;
        font-size: 13px;
        padding: 6px 16px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn-outline-sage:hover {
        background: var(--sage-primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(74, 122, 109, 0.15);
    }
    
    /* Custom Scrollbar untuk area grafik */
    .chart-scroll-area::-webkit-scrollbar { height: 8px; }
    .chart-scroll-area::-webkit-scrollbar-thumb { background: var(--sage-primary); border-radius: 10px; }
    .chart-scroll-area::-webkit-scrollbar-track { background: var(--sage-light); border-radius: 10px; }
</style>

<div class="container pb-4 pt-3">
    
    <!-- HEADER -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold text-adaptive mb-1" style="letter-spacing: -0.5px;">Riwayat Skrining</h3>
            <p class="text-adaptive-muted mb-0" style="font-size: 14.5px;">
                Pantau perkembangan tingkat depresi, kecemasan, dan stres Anda.
            </p>
        </div>
        <a href="{{ route('mahasiswa.screenings.create') }}" class="btn btn-sage rounded-pill px-4 py-2 shadow-sm d-inline-flex align-items-center">
            <i class="bi bi-plus-circle me-2"></i> Mulai Skrining Baru
        </a>
    </div>

    <!-- PANEL INFORMASI SKOR -->
    <div class="accordion mb-4 shadow-sm" id="accordionInformasiSkor" style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border-soft); background: var(--bg-card);">
        <div class="accordion-item" style="border: none; background: transparent;">
            <h2 class="accordion-header" id="headingSkor">
                <button class="accordion-button collapsed fw-bold text-adaptive" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSkor" aria-expanded="false" aria-controls="collapseSkor" style="background-color: var(--sage-surface); box-shadow: none;">
                    <i class="bi bi-info-circle me-2" style="color: var(--sage-primary);"></i> Klik untuk melihat panduan klasifikasi tingkat keparahan (DASS-42)
                </button>
            </h2>
            <div id="collapseSkor" class="accordion-collapse collapse" aria-labelledby="headingSkor" data-bs-parent="#accordionInformasiSkor">
                <div class="accordion-body p-4 bg-adaptive">
                    <p class="text-adaptive-muted small mb-3">
                        Skrining ini menggunakan instrumen standar yang memiliki ambang batas <em>(cutoff)</em> spesifik untuk tiap kondisi. Kategori <strong>"Sangat Parah"</strong> adalah batas maksimal.
                    </p>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 border-adaptive" style="font-size: 14px;">
                            <thead style="background-color: var(--sage-light); color: var(--text-dark);">
                                <tr>
                                    <th width="25%" class="border-0">Tingkat Keparahan</th>
                                    <th width="25%" class="text-center border-0">Skor Depresi</th>
                                    <th width="25%" class="text-center border-0">Skor Kecemasan</th>
                                    <th width="25%" class="text-center border-0">Skor Stres</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-adaptive"><span class="badge-status badge-normal">Normal</span></td>
                                    <td class="text-center text-adaptive-muted fw-medium border-adaptive">0 - 9</td>
                                    <td class="text-center text-adaptive-muted fw-medium border-adaptive">0 - 7</td>
                                    <td class="text-center text-adaptive-muted fw-medium border-adaptive">0 - 14</td>
                                </tr>
                                <tr>
                                    <td class="border-adaptive"><span class="badge-status badge-ringan">Ringan</span></td>
                                    <td class="text-center text-adaptive-muted fw-medium border-adaptive">10 - 13</td>
                                    <td class="text-center text-adaptive-muted fw-medium border-adaptive">8 - 9</td>
                                    <td class="text-center text-adaptive-muted fw-medium border-adaptive">15 - 18</td>
                                </tr>
                                <tr>
                                    <td class="border-adaptive"><span class="badge-status badge-sedang">Sedang</span></td>
                                    <td class="text-center text-adaptive-muted fw-medium border-adaptive">14 - 20</td>
                                    <td class="text-center text-adaptive-muted fw-medium border-adaptive">10 - 14</td>
                                    <td class="text-center text-adaptive-muted fw-medium border-adaptive">19 - 25</td>
                                </tr>
                                <tr>
                                    <td class="border-adaptive"><span class="badge-status badge-parah">Parah</span></td>
                                    <td class="text-center text-adaptive-muted fw-medium border-adaptive">21 - 27</td>
                                    <td class="text-center text-adaptive-muted fw-medium border-adaptive">15 - 19</td>
                                    <td class="text-center text-adaptive-muted fw-medium border-adaptive">26 - 33</td>
                                </tr>
                                <tr>
                                    <td class="border-adaptive"><span class="badge-status badge-sangat-parah">Sangat Parah</span></td>
                                    <td class="text-center text-adaptive fw-bold border-adaptive">28 - 42</td>
                                    <td class="text-center text-adaptive fw-bold border-adaptive">20 - 42</td>
                                    <td class="text-center text-adaptive fw-bold border-adaptive">34 - 42</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PANEL GRAFIK -->
    @if(!empty($labels))
    <div class="history-card">
        <div class="history-card-header d-flex align-items-center">
            <div class="p-2 rounded-lg me-3" style="background-color: var(--sage-light); width: 42px; height: 42px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-graph-up fs-5" style="color: var(--sage-primary);"></i>
            </div>
            <h5 class="mb-0 fw-bold text-adaptive">Grafik Pemantauan Tingkat Stres</h5>
        </div>
        <div class="card-body p-4 pt-3">
            <div class="chart-scroll-area" style="overflow-x: auto; overflow-y: hidden; width: 100%; border-radius: var(--radius-lg); background: var(--sage-surface); padding: 20px; border: 1px solid var(--border-soft);">
                <div id="chartWrapper" style="position: relative; height: 350px; min-width: 100%;">
                    <canvas id="historyChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- PANEL TABEL RIWAYAT -->
    <div class="history-card">
        <div class="history-card-header d-flex align-items-center">
            <div class="p-2 rounded-lg me-3" style="background-color: var(--sage-light); width: 42px; height: 42px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-clock-history fs-5" style="color: var(--sage-primary);"></i>
            </div>
            <h5 class="mb-0 fw-bold text-adaptive">Detail Riwayat Skrining</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="20%">Tanggal</th>
                            <th width="60%">Hasil Skrining (Skor & Status)</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $badgeMap = [
                                'normal' => 'badge-normal',
                                'ringan' => 'badge-ringan',
                                'sedang' => 'badge-sedang',
                                'parah' => 'badge-parah',
                                'sangat parah' => 'badge-sangat-parah',
                            ];
                        @endphp
                        
                        @forelse($screenings as $index => $s)
                        @php
                            $classDepresi = $badgeMap[strtolower(trim($s->status_depresi ?? ''))] ?? 'badge-default';
                            $classCemas = $badgeMap[strtolower(trim($s->status_kecemasan ?? ''))] ?? 'badge-default';
                            $classStres = $badgeMap[strtolower(trim($s->status_stres ?? ''))] ?? 'badge-default';
                        @endphp
                        <tr>
                            <td class="text-center fw-bold">
                                {{ $screenings->firstItem() + $index }}
                            </td>
                            <td>
                                <div class="fw-bold text-adaptive">{{ $s->created_at->format('d M Y') }}</div>
                                <div class="text-adaptive-muted small">{{ $s->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                <div class="badge-hasil-wrapper">
                                    <span class="badge-status {{ $classDepresi }}">
                                        Depresi: {{ ucfirst($s->status_depresi ?? '-') }} ({{ $s->score_depresi ?? 0 }})
                                    </span>
                                    <span class="badge-status {{ $classCemas }}">
                                        Cemas: {{ ucfirst($s->status_kecemasan ?? '-') }} ({{ $s->score_kecemasan ?? 0 }})
                                    </span>
                                    <span class="badge-status {{ $classStres }}">
                                        Stres: {{ ucfirst($s->status_stres ?? '-') }} ({{ $s->score_stres ?? 0 }})
                                    </span>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('mahasiswa.screenings.show', $s->id) }}" class="btn btn-outline-sage">
                                    <i class="bi bi-eye me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 bg-adaptive">
                                <div class="d-flex flex-column align-items-center justify-content-center opacity-75">
                                    <div class="mb-3" style="width: 80px; height: 80px; background: var(--sage-light); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-folder2-open fs-1" style="color: var(--sage-primary);"></i>
                                    </div>
                                    <span class="text-adaptive-muted fw-medium">Belum ada riwayat skrining yang tercatat.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Wrapper -->
            @if($screenings->hasPages())
                <div class="d-flex justify-content-center pt-4 pb-3 border-top border-adaptive bg-adaptive">
                    {{ $screenings->links('pagination::bootstrap-5') }}
                </div>
            @endif
            
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('historyChart');
        if(!canvas) return;
        const ctx = canvas.getContext('2d');
        
        const labels = Object.values(@json($labels ?? []));
        const dataDepresi = Object.values(@json($dataDepresi ?? [])).map(Number);
        const dataKecemasan = Object.values(@json($dataKecemasan ?? [])).map(Number);
        const dataStres = Object.values(@json($dataStres ?? [])).map(Number);

        if(labels.length === 0) return;

        const chartWrapper = document.getElementById('chartWrapper');
        const parentLayar = chartWrapper.parentElement;
        
        const minWidthPerPoint = 100;
        const requiredWidth = labels.length * minWidthPerPoint;
        const containerWidth = parentLayar.clientWidth || window.innerWidth;

        if (requiredWidth > containerWidth) {
            chartWrapper.style.width = requiredWidth + 'px';
        } else {
            chartWrapper.style.width = '100%';
        }

        // Ambil warna adaptif dari CSS Variables untuk Chart
        const style = getComputedStyle(document.body);
        const textColor = style.getPropertyValue('--text-muted').trim() || '#64748B';
        const gridColor = style.getPropertyValue('--border-soft').trim() || 'rgba(74, 122, 109, 0.1)';
        const legendColor = style.getPropertyValue('--text-dark').trim() || '#1e293b';

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
                            color: gridColor,
                            drawBorder: false,
                        },
                        ticks: { color: textColor },
                        title: { display: true, text: 'Skor Penilaian', font: { weight: '600', family: "'Plus Jakarta Sans', sans-serif" }, color: textColor }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: { color: textColor },
                        title: { display: true, text: 'Tanggal Skrining', font: { weight: '600', family: "'Plus Jakarta Sans', sans-serif" }, color: textColor }
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
                            color: legendColor
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(30, 41, 59, 0.95)',
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
@endpush