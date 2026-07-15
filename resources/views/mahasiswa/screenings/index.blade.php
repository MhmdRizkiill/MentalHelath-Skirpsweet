@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        CUSTOM STYLE RIWAYAT
    =========================== */
    .history-card {
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 20px;
        background: #FFFFFF;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03);
        transition: all 0.3s ease;
        margin-bottom: 24px;
        overflow: hidden;
    }

    .history-card-header {
        background: #FFFFFF;
        border-bottom: 1px solid #F1F5F9;
        padding: 20px 24px;
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
        padding: 18px 20px;
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

    /* Badge Label dalam Tabel */
    .badge-status {
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.3px;
        padding: 6px 12px;
        border-radius: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        display: inline-flex;
        align-items: center;
    }

    /* Action Button Custom */
    .btn-detail {
        background: #EEF6FF;
        color: #3B82F6;
        border: none;
        font-weight: 600;
        font-size: 13px;
        padding: 6px 16px;
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .btn-detail:hover {
        background: #3B82F6;
        color: #FFFFFF;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(59, 130, 246, 0.2);
    }
</style>

<div class="container pb-4">
    
    <!-- Header Halaman -->
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

    <!-- Panel Grafik -->
    <div class="history-card">
        <div class="history-card-header d-flex align-items-center">
            <div class="bg-primary bg-opacity-10 p-2 rounded-lg me-3">
                <i class="bi bi-activity text-primary fs-5"></i>
            </div>
            <h6 class="mb-0 fw-bold text-dark">Grafik Pemantauan Tingkat Stres</h6>
        </div>
        <div class="card-body p-4 pt-3">
            <div style="overflow-x: auto; overflow-y: hidden; width: 100%; border-radius: 12px; background: #F8FAFC; padding: 15px;">
                <div id="chartWrapper" style="position: relative; height: 350px; width: 100%;">
                    <canvas id="historyChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel Tabel Riwayat -->
    <div class="history-card">
        <div class="history-card-header d-flex align-items-center">
            <div class="bg-primary bg-opacity-10 p-2 rounded-lg me-3">
                <i class="bi bi-clock-history text-primary fs-5"></i>
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
                        @php
                            // Properti CSS disisipkan langsung ke dalam array untuk mendandani badge
                            $badgeColors = [
                                'Normal' => 'background-color: #22C55E; color: white;',
                                'Ringan' => 'background-color: #EAB308; color: black;',
                                'Sedang' => 'background-color: #F97316; color: white;',
                                'Parah' => 'background-color: #EF4444; color: white;',
                                'Sangat Parah' => 'background-color: #7C3AED; color: white;'
                            ];
                        @endphp
                        
                        @forelse($screenings as $index => $s)
                        <tr>
                            <td class="text-center fw-medium text-muted">{{ $screenings->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $s->created_at->format('d M Y') }}</div>
                                <div class="text-muted small">{{ $s->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                <div class="d-flex gap-2 flex-wrap">
                                    <span class="badge-status" style="{{ $badgeColors[$s->status_depresi ?? ''] ?? 'background-color: #64748B; color: white;' }}">
                                        Depresi: {{ $s->status_depresi ?? '-' }} ({{ $s->score_depresi ?? 0 }})
                                    </span>
                                    <span class="badge-status" style="{{ $badgeColors[$s->status_kecemasan ?? ''] ?? 'background-color: #64748B; color: white;' }}">
                                        Cemas: {{ $s->status_kecemasan ?? '-' }} ({{ $s->score_kecemasan ?? 0 }})
                                    </span>
                                    <span class="badge-status" style="{{ $badgeColors[$s->status_stres ?? ''] ?? 'background-color: #64748B; color: white;' }}">
                                        Stres: {{ $s->status_stres ?? '-' }} ({{ $s->score_stres ?? 0 }})
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
                            <td colspan="4" class="text-center py-5">
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
                <div class="d-flex justify-content-center pt-4 pb-3 border-top">
                    {{ $screenings->links('pagination::bootstrap-5') }}
                </div>
            @endif
            
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('historyChart');
        if(!canvas) return;
        const ctx = canvas.getContext('2d');
        
        // Memastikan format data tepat (menggunakan teknik dari Dashboard)
        const labels = {!! json_encode($labels ?? []) !!};
        const dataDepresi = {!! json_encode($dataDepresi ?? []) !!};
        const dataKecemasan = {!! json_encode($dataKecemasan ?? []) !!};
        const dataStres = {!! json_encode($dataStres ?? []) !!};

        if(labels.length === 0) {
            canvas.closest('.history-card').style.display = 'none';
            return;
        }

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
@endsection