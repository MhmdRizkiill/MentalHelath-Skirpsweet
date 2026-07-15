@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        CUSTOM STYLE DETAIL HASIL
    =========================== */
    .detail-card {
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 20px;
        background: #FFFFFF;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03);
        overflow: hidden;
        margin-bottom: 24px;
    }

    .detail-header {
        background: #FFFFFF;
        border-bottom: 1px solid #F1F5F9;
        padding: 20px 24px;
    }

    /* Kotak Status Skor */
    .stat-box {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 20px 16px;
        transition: all 0.2s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .stat-box:hover {
        background: #F1F5F9;
        border-color: #CBD5E1;
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
        line-height: 1.5;
    }

    .custom-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #F8FAFC;
    }

    /* Badge & Label */
    .badge-status {
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.3px;
        padding: 8px 16px;
        border-radius: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .answer-tag {
        background: rgba(59, 130, 246, 0.1);
        color: #1D4ED8;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 8px;
        display: inline-block;
        font-size: 13.5px;
    }

    /* Tombol Kembali */
    .btn-back {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        color: #475569;
        font-weight: 600;
        font-size: 14px;
        padding: 8px 20px;
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background: #F1F5F9;
        color: #0F172A;
        border-color: #94A3B8;
        transform: translateY(-1px);
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center border-0 shadow-sm" style="border-radius: 16px;" role="alert">
                    <i class="bi bi-check-circle-fill fs-5 me-3 text-success"></i>
                    <div class="flex-grow-1 fw-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <div>
                    <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Detail Skrining</h3>
                    <p class="text-muted mb-0" style="font-size: 14.5px;">Tinjauan lengkap hasil evaluasi kesehatan mental Anda.</p>
                </div>
                <a href="{{ route('mahasiswa.screenings.index') }}" class="btn btn-back rounded-pill shadow-sm d-inline-flex align-items-center">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Riwayat
                </a>
            </div>

            <div class="detail-card">
                <div class="detail-header d-flex flex-column flex-sm-row justify-content-between align-items-sm-center">
                    <div class="d-flex align-items-center mb-2 mb-sm-0">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-lg me-3">
                            <i class="bi bi-clipboard2-data text-primary fs-5"></i>
                        </div>
                        <h6 class="mb-0 fw-bold text-dark">Hasil Analisis DASS-42</h6>
                    </div>
                    <span class="badge bg-light text-muted border px-3 py-2 rounded-pill fw-medium">
                        <i class="bi bi-calendar3 me-1"></i> {{ $screening->created_at->format('d M Y - H:i') }}
                    </span>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    @php
                        // Logika bawaan PHP dipertahankan 100%
                        $badgeColors = [
                            'Normal' => 'background-color: #22C55E; color: white;',
                            'Ringan' => 'background-color: #EAB308; color: black;',
                            'Sedang' => 'background-color: #F97316; color: white;',
                            'Parah' => 'background-color: #EF4444; color: white;',
                            'Sangat Parah' => 'background-color: #7C3AED; color: white;'
                        ];
                    @endphp

                    <div class="row g-3 g-md-4">
                        <div class="col-md-4">
                            <div class="stat-box">
                                <h6 class="text-muted fw-semibold text-uppercase mb-2" style="font-size: 12px; letter-spacing: 1px;">Depresi</h6>
                                <h1 class="fw-bold text-dark mb-3" style="font-size: 2.5rem; letter-spacing: -1px;">{{ $screening->score_depresi ?? 0 }}</h1>
                                <span class="badge-status w-100 text-center" style="{{ $badgeColors[$screening->status_depresi ?? ''] ?? 'background-color: #64748B; color: white;' }}">
                                    {{ $screening->status_depresi ?? '-' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="stat-box">
                                <h6 class="text-muted fw-semibold text-uppercase mb-2" style="font-size: 12px; letter-spacing: 1px;">Kecemasan</h6>
                                <h1 class="fw-bold text-dark mb-3" style="font-size: 2.5rem; letter-spacing: -1px;">{{ $screening->score_kecemasan ?? 0 }}</h1>
                                <span class="badge-status w-100 text-center" style="{{ $badgeColors[$screening->status_kecemasan ?? ''] ?? 'background-color: #64748B; color: white;' }}">
                                    {{ $screening->status_kecemasan ?? '-' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="stat-box">
                                <h6 class="text-muted fw-semibold text-uppercase mb-2" style="font-size: 12px; letter-spacing: 1px;">Stres</h6>
                                <h1 class="fw-bold text-dark mb-3" style="font-size: 2.5rem; letter-spacing: -1px;">{{ $screening->score_stres ?? 0 }}</h1>
                                <span class="badge-status w-100 text-center" style="{{ $badgeColors[$screening->status_stres ?? ''] ?? 'background-color: #64748B; color: white;' }}">
                                    {{ $screening->status_stres ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="detail-card">
                <div class="detail-header d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-lg me-3">
                        <i class="bi bi-ui-checks text-primary fs-5"></i>
                    </div>
                    <h6 class="mb-0 fw-bold text-dark">Review Jawaban Anda</h6>
                </div>
                
                <div class="card-body p-0">
                    @if($screening->answers)
                        <div class="table-responsive">
                            <table class="table custom-table">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="8%">No</th>
                                        <th width="62%">Pertanyaan</th>
                                        <th class="text-center" width="30%">Jawaban Anda (Skor)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        // Kamus opsi jawaban DASS-42
                                        $opsiTeks = [
                                            0 => 'Tidak pernah (0)',
                                            1 => 'Kadang-kadang (1)',
                                            2 => 'Sering (2)',
                                            3 => 'Sangat sering (3)'
                                        ];
                                    @endphp

                                    @foreach($questions as $index => $q)
                                        @php
                                            // Mengambil skor jawaban yang dipilih berdasarkan ID pertanyaan
                                            $jawabanSkor = $screening->answers[$q->id] ?? null;
                                        @endphp
                                        <tr>
                                            <td class="text-center fw-medium text-muted">{{ $index + 1 }}</td>
                                            <td class="fw-medium">{{ $q->pertanyaan ?? $q->question_text ?? 'Teks pertanyaan tidak ditemukan' }}</td>
                                            <td class="text-center">
                                                @if($jawabanSkor !== null)
                                                    <span class="answer-tag">
                                                        {{ $opsiTeks[$jawabanSkor] }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-light text-muted border px-2 py-1">Tidak dijawab</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3" style="width: 80px; height: 80px;">
                                <i class="bi bi-inbox fs-1 text-muted opacity-50"></i>
                            </div>
                            <h6 class="fw-bold text-dark">Data Tidak Lengkap</h6>
                            <p class="text-muted mb-0">Detail rekaman jawaban tidak tersedia untuk skrining versi lama ini.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection