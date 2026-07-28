@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        CUSTOM STYLE RIWAYAT
    =========================== */
    .history-card {
        border: 1px solid rgba(203, 213, 208, 0.6);
        border-radius: 20px;
        background: #FFFFFF;
        box-shadow: 0 4px 15px rgba(74, 122, 109, 0.04);
        transition: all 0.3s ease;
        margin-bottom: 24px;
        overflow: hidden;
    }

    .history-card-header {
        background: #FFFFFF;
        border-bottom: 1px solid rgba(203, 213, 208, 0.3);
        padding: 20px 24px;
    }

    /* Tabel Modern - TEMA SAGE GREEN */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .custom-table {
        margin-bottom: 0;
        white-space: nowrap; /* Mencegah teks turun ke bawah / tergencet di HP */
    }

    .custom-table thead th {
        background: var(--primary, #4A7A6D) !important; 
        color: #FFFFFF !important; 
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px 20px;
        border: none;
    }

    .custom-table tbody tr { background-color: #FFFFFF; transition: background-color 0.2s ease; }
    .custom-table tbody tr:nth-child(even) { background-color: rgba(74, 122, 109, 0.03); }
    .custom-table tbody tr:hover { background-color: rgba(74, 122, 109, 0.08); }

    .custom-table tbody td {
        padding: 18px 20px;
        color: #2D3748;
        font-size: 14.5px;
        border-bottom: 1px solid rgba(203, 213, 208, 0.4);
        vertical-align: middle;
    }

    /* Wrapper Flex untuk Badge agar Rapi di Mobile */
    .badge-hasil-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        min-width: 260px; /* Lebar minimal supaya baris tabel rapi */
    }

    /* Badge Dasar */
    .badge-status {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.3px;
        padding: 6px 12px;
        border-radius: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.06);
        display: inline-flex;
        align-items: center;
    }

    /* CLASS WARNA SPESIFIK (Mengatasi Blokir Inline Style) */
    .badge-normal { background-color: #22C55E !important; color: #FFFFFF !important; border: none; }
    .badge-ringan { background-color: #EAB308 !important; color: #000000 !important; border: none; }
    .badge-sedang { background-color: #F97316 !important; color: #FFFFFF !important; border: none; }
    .badge-parah { background-color: #EF4444 !important; color: #FFFFFF !important; border: none; }
    .badge-sangat-parah { background-color: #7C3AED !important; color: #FFFFFF !important; border: none; }
    .badge-default { background-color: #F1F5F9 !important; color: #334155 !important; border: 1px solid #CBD5E1; }

    /* Action Button Custom - Tema Sage */
    .btn-detail {
        background: #FFFFFF;
        color: var(--primary, #4A7A6D);
        border: 1px solid var(--primary, #4A7A6D);
        font-weight: 600;
        font-size: 13px;
        padding: 6px 16px;
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .btn-detail:hover {
        background: var(--primary, #4A7A6D);
        color: #FFFFFF;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(74, 122, 109, 0.2);
    }
    
    /* Custom Scrollbar untuk area grafik */
    .chart-scroll-area::-webkit-scrollbar {
        height: 6px;
    }
    .chart-scroll-area::-webkit-scrollbar-thumb {
        background: #A3C1AD;
        border-radius: 10px;
    }
</style>

<div class="container pb-4">
    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Riwayat Skrining</h3>
            <p class="text-muted mb-0" style="font-size: 14.5px;">
                Pantau perkembangan tingkat depresi, kecemasan, dan stres Anda.
            </p>
        </div>
        <a href="{{ route('mahasiswa.screenings.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm d-inline-flex align-items-center">
            <i class="bi bi-plus-circle me-2"></i> Mulai Skrining Baru
        </a>
    </div>

    <!-- Panel Informasi Klasifikasi Skor -->
    <div class="accordion mb-4 shadow-sm" id="accordionInformasiSkor" style="border-radius: 16px; overflow: hidden; border: 1px solid rgba(203, 213, 208, 0.6);">
        <div class="accordion-item" style="border: none;">
            <h2 class="accordion-header" id="headingSkor">
                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSkor" aria-expanded="false" aria-controls="collapseSkor" style="background-color: rgba(74, 122, 109, 0.05); box-shadow: none;">
                    <i class="bi bi-info-circle text-primary me-2" style="color: var(--primary) !important;"></i> Klik untuk melihat panduan klasifikasi tingkat keparahan (DASS)
                </button>
            </h2>
            <div id="collapseSkor" class="accordion-collapse collapse" aria-labelledby="headingSkor" data-bs-parent="#accordionInformasiSkor">
                <div class="accordion-body p-4 bg-white">
                    <p class="text-muted small mb-3">
                        Skrining ini menggunakan instrumen standar yang memiliki ambang batas <em>(cutoff)</em> spesifik untuk tiap kondisi. Kategori <strong>"Sangat Parah"</strong> adalah batas maksimal.
                    </p>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" style="font-size: 14px;">
                            <thead style="background-color: #E8F0EC; color: #2D3748;">
                                <tr>
                                    <th width="25%">Tingkat Keparahan</th>
                                    <th width="25%" class="text-center">Skor Depresi</th>
                                    <th width="25%" class="text-center">Skor Kecemasan</th>
                                    <th width="25%" class="text-center">Skor Stres</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><span class="badge" style="background-color: #22C55E; color: white; border: none;">Normal</span></td>
                                <td class="text-center">0 - 9</td>
                                <td class="text-center">0 - 7</td>
                                <td class="text-center">0 - 14</td>
                            </tr>
                            <tr>
                                <td><span class="badge" style="background-color: #EAB308; color: black; border: none;">Ringan</span></td>
                                <td class="text-center">10 - 13</td>
                                <td class="text-center">8 - 9</td>
                                <td class="text-center">15 - 18</td>
                            </tr>
                            <tr>
                                <td><span class="badge" style="background-color: #F97316; color: white; border: none;">Sedang</span></td>
                                <td class="text-center">14 - 20</td>
                                <td class="text-center">10 - 14</td>
                                <td class="text-center">19 - 25</td>
                            </tr>
                            <tr>
                                <td><span class="badge" style="background-color: #EF4444; color: white; border: none;">Parah</span></td>
                                <td class="text-center">21 - 27</td>
                                <td class="text-center">15 - 19</td>
                                <td class="text-center">26 - 33</td>
                            </tr>
                            <tr>
                                <td><span class="badge" style="background-color: #7C3AED; color: white; border: none;">Sangat Parah</span></td>
                                <td class="text-center fw-bold">28 - 42</td>
                                <td class="text-center fw-bold">20 - 42</td>
                                <td class="text-center fw-bold">34 - 42</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel Grafik -->
    @if(count($labels ?? []) > 0)
    <div class="history-card">
        <div class="history-card-header d-flex align-items-center">
            <div class="p-2 rounded-lg me-3" style="background-color: rgba(74, 122, 109, 0.1);">
                <i class="bi bi-activity fs-5" style="color: var(--primary, #4A7A6D);"></i>
            </div>
            <h6 class="mb-0 fw-bold text-dark">Grafik Pemantauan Tingkat Stres</h6>
        </div>
        <div class="card-body p-4 pt-3">
            <div class="chart-scroll-area" style="overflow-x: auto; overflow-y: hidden; width: 100%; border-radius: 12px; background: rgba(244, 247, 246, 0.5); padding: 15px;">
                <!-- min-width diset 100% agar di layar PC tetap penuh -->
                <div id="chartWrapper" style="position: relative; height: 350px; min-width: 100%;">
                    <canvas id="historyChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Panel Tabel Riwayat -->
    <div class="history-card">
        <div class="history-card-header d-flex align-items-center">
            <div class="p-2 rounded-lg me-3" style="background-color: rgba(74, 122, 109, 0.1);">
                <i class="bi bi-clock-history fs-5" style="color: var(--primary, #4A7A6D);"></i>
            </div>
            <h6 class="mb-0 fw-bold text-dark">Detail Riwayat Skrining</h6>
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
                        
                        {{-- Logika Mapping Class CSS Aman --}}
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
                            // Ambil nama class berdasarkan status (lowercase), jika tidak cocok pakai default
                            $classDepresi = $badgeMap[strtolower(trim($s->status_depresi ?? ''))] ?? 'badge-default';
                            $classCemas = $badgeMap[strtolower(trim($s->status_kecemasan ?? ''))] ?? 'badge-default';
                            $classStres = $badgeMap[strtolower(trim($s->status_stres ?? ''))] ?? 'badge-default';
                        @endphp
                        <tr>
                            <td class="text-center fw-bold">
                                {{ $screenings->firstItem() + $index }}
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $s->created_at->format('d M Y') }}</div>
                                <div class="text-muted small">{{ $s->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                <!-- Diubah menjadi Wrapper Fleksibel agar tidak tergencet -->
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
                                <a href="{{ route('mahasiswa.screenings.show', $s->id) }}" class="btn btn-detail">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5" style="background-color: #FFFFFF;">
                                <div class="d-flex flex-column align-items-center justify-content-center opacity-50">
                                    <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
                                    <span class="text-muted fw-medium">Belum ada riwayat skrining yang tercatat.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Wrapper -->
            @if($screenings->hasPages())
                <div class="d-flex justify-content-center pt-4 pb-3 border-top" style="background-color: #FFFFFF;">
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
        
        const labels = Object.values({!! json_encode($labels ?? []) !!});
        const dataDepresi = Object.values({!! json_encode($dataDepresi ?? []) !!}).map(Number);
        const dataKecemasan = Object.values({!! json_encode($dataKecemasan ?? []) !!}).map(Number);
        const dataStres = Object.values({!! json_encode($dataStres ?? []) !!}).map(Number);

        if(labels.length === 0) return;

        // --- PERBAIKAN LOGIKA LEBAR GRAFIK UNTUK MOBILE ---
        const chartWrapper = document.getElementById('chartWrapper');
        const parentLayar = chartWrapper.parentElement;
        
        // Tentukan lebar minimal yang dibutuhkan per titik data (misal 90px agar renggang)
        const minWidthPerPoint = 90;
        const requiredWidth = labels.length * minWidthPerPoint;
        const containerWidth = parentLayar.clientWidth;

        // Jika lebar yang dibutuhkan untuk merenggangkan data lebih besar dari lebar layar HP
        if (requiredWidth > containerWidth) {
            chartWrapper.style.width = requiredWidth + 'px';
        } else {
            // Jika di PC/Tablet (layar cukup luas), biarkan memenuhi layar (100%)
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
                            color: 'rgba(203, 213, 208, 0.4)',
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
@endpush