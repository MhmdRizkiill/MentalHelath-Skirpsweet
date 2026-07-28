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
        CUSTOM STYLE DETAIL
    =========================== */
    .page-title-section h3 {
        color: var(--text-dark);
        letter-spacing: -0.5px;
    }

    .detail-card {
        border: none;
        border-radius: var(--radius-xl);
        background: #FFFFFF;
        box-shadow: var(--shadow-soft);
        overflow: hidden;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .detail-header {
        background: #FFFFFF;
        border-bottom: 1px solid var(--border-soft);
        padding: 24px 28px;
    }

    .icon-wrapper {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--sage-light);
        border-radius: 12px;
        color: var(--sage-primary);
    }

    /* ===========================
        KOTAK STATUS SKOR
    =========================== */
    .stat-box {
        background: #FFFFFF;
        border: 1px solid var(--border-soft);
        border-radius: var(--radius-lg);
        padding: 24px 16px;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 12px rgba(74, 122, 109, 0.02);
    }

    .stat-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(74, 122, 109, 0.08);
        border-color: var(--sage-primary);
        background: var(--sage-surface);
    }

    /* ===========================
        TABEL MODERN
    =========================== */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        padding: 0 10px;
    }

    .custom-table {
        margin-bottom: 15px;
        white-space: nowrap;
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    .custom-table thead th {
        background: var(--sage-surface) !important; 
        color: var(--text-muted) !important; 
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 18px 24px;
        border: none;
        border-bottom: 2px solid var(--border-soft);
    }

    .custom-table thead th:first-child { border-top-left-radius: 12px; }
    .custom-table thead th:last-child { border-top-right-radius: 12px; }

    .custom-table tbody tr { 
        background-color: #FFFFFF; 
        transition: all 0.2s ease; 
    }
    
    .custom-table tbody tr:hover { 
        background-color: var(--sage-surface); 
    }

    .custom-table tbody td {
        padding: 20px 24px;
        color: var(--text-dark);
        font-size: 14.5px;
        border-bottom: 1px dashed var(--border-soft);
        vertical-align: middle;
        white-space: normal;
    }

    /* ===========================
        BADGES & TAGS
    =========================== */
    .badge-status {
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.3px;
        padding: 8px 18px;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .badge-normal { background-color: rgba(34, 197, 94, 0.15) !important; color: #16a34a !important; border: 1px solid rgba(34, 197, 94, 0.3); }
    .badge-ringan { background-color: rgba(234, 179, 8, 0.15) !important; color: #ca8a04 !important; border: 1px solid rgba(234, 179, 8, 0.3); }
    .badge-sedang { background-color: rgba(249, 115, 22, 0.15) !important; color: #ea580c !important; border: 1px solid rgba(249, 115, 22, 0.3); }
    .badge-parah { background-color: rgba(239, 68, 68, 0.15) !important; color: #dc2626 !important; border: 1px solid rgba(239, 68, 68, 0.3); }
    .badge-sangat-parah { background-color: rgba(124, 58, 237, 0.15) !important; color: #6d28d9 !important; border: 1px solid rgba(124, 58, 237, 0.3); }
    .badge-default { background-color: #F1F5F9 !important; color: #475569 !important; border: 1px solid #CBD5E1; }

    /* --- PERBAIKAN TAMPILAN JAWABAN (ANSWER TAGS) --- */
    .answer-tag {
        font-weight: 600;
        padding: 6px 16px;
        border-radius: 50px; /* Diubah menjadi pill shape agar lebih modern */
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        white-space: nowrap;
        border: 1px solid transparent;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }

    /* Warna gradasi berdasarkan tingkat intensitas jawaban */
    .ans-0 { background-color: #F1F5F9; color: #64748B; border-color: #E2E8F0; } /* Tidak Pernah - Abu-abu netral */
    .ans-1 { background-color: #ECFDF5; color: #059669; border-color: #A7F3D0; } /* Kadang-kadang - Hijau lembut */
    .ans-2 { background-color: #FFF7ED; color: #EA580C; border-color: #FED7AA; } /* Sering - Oranye terang */
    .ans-3 { background-color: #FEF2F2; color: #DC2626; border-color: #FECACA; } /* Sangat Sering - Merah tegas */

    /* ===========================
        INFO PANEL (ACCORDION)
    =========================== */
    .info-panel-wrapper {
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-soft);
        background: #FFFFFF;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        overflow: hidden;
    }
    
    .accordion-button.custom-acc {
        background-color: var(--sage-surface);
        color: var(--sage-primary);
        font-weight: 600;
        box-shadow: none !important;
        padding: 18px 24px;
        border: none;
    }
    
    .accordion-button.custom-acc:not(.collapsed) {
        background-color: var(--sage-light);
        color: var(--sage-primary);
    }

    /* ===========================
        TOMBOL KEMBALI
    =========================== */
    .btn-back {
        background: #FFFFFF;
        border: 1.5px solid var(--sage-primary);
        color: var(--sage-primary);
        font-weight: 600;
        font-size: 14px;
        padding: 10px 24px;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background: var(--sage-primary);
        color: #FFFFFF;
        box-shadow: 0 6px 15px rgba(74, 122, 109, 0.2);
        transform: translateY(-2px);
    }
</style>

<div class="container pb-5 pt-3">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-10">

            <!-- HEADER HALAMAN -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-2 gap-3 page-title-section">
                <div>
                    <h3 class="fw-bolder mb-2">Detail Skrining</h3>
                    <p class="text-muted mb-0" style="font-size: 15px;">
                        Tinjauan lengkap hasil evaluasi kesehatan mental Anda.
                    </p>
                </div>
                <a href="{{ route('mahasiswa.screenings.index') }}" class="btn btn-back d-inline-flex align-items-center">
                    <i class="bi bi-arrow-left me-2" style="-webkit-text-stroke: 0.5px;"></i> Kembali ke Riwayat
                </a>
            </div>

            <!-- PANEL HASIL UTAMA -->
            <div class="detail-card">
                <div class="detail-header d-flex flex-column flex-sm-row justify-content-between align-items-sm-center">
                    <div class="d-flex align-items-center mb-3 mb-sm-0">
                        <div class="icon-wrapper me-3">
                            <i class="bi bi-clipboard2-data fs-5"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold text-dark">Hasil Analisis DASS-42</h5>
                            <span class="text-muted" style="font-size: 13px;">Skor evaluasi berdasarkan kuesioner yang Anda isi</span>
                        </div>
                    </div>
                    <span class="badge" style="background-color: var(--sage-surface); color: var(--sage-hover); border: 1px solid var(--border-soft); padding: 8px 16px; border-radius: 20px; font-weight: 600;">
                        <i class="bi bi-calendar3 me-2"></i> {{ $screening->created_at->format('d M Y - H:i') }} WIB
                    </span>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    @php
                        $badgeMap = [
                            'normal' => 'badge-normal',
                            'ringan' => 'badge-ringan',
                            'sedang' => 'badge-sedang',
                            'parah' => 'badge-parah',
                            'sangat parah' => 'badge-sangat-parah',
                        ];

                        $classDepresi = $badgeMap[strtolower(trim($screening->status_depresi ?? ''))] ?? 'badge-default';
                        $classCemas = $badgeMap[strtolower(trim($screening->status_kecemasan ?? ''))] ?? 'badge-default';
                        $classStres = $badgeMap[strtolower(trim($screening->status_stres ?? ''))] ?? 'badge-default';
                    @endphp

                    <div class="row g-4 mb-2">
                        <div class="col-md-4">
                            <div class="stat-box">
                                <h6 class="text-muted fw-bold text-uppercase mb-3" style="font-size: 12.5px; letter-spacing: 1.5px;">Depresi</h6>
                                <h1 class="fw-bolder text-dark mb-4" style="font-size: 3rem; letter-spacing: -1.5px;">{{ $screening->score_depresi ?? 0 }}</h1>
                                <span class="badge-status w-100 {{ $classDepresi }}">
                                    {{ ucfirst($screening->status_depresi ?? '-') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="stat-box">
                                <h6 class="text-muted fw-bold text-uppercase mb-3" style="font-size: 12.5px; letter-spacing: 1.5px;">Kecemasan</h6>
                                <h1 class="fw-bolder text-dark mb-4" style="font-size: 3rem; letter-spacing: -1.5px;">{{ $screening->score_kecemasan ?? 0 }}</h1>
                                <span class="badge-status w-100 {{ $classCemas }}">
                                    {{ ucfirst($screening->status_kecemasan ?? '-') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="stat-box">
                                <h6 class="text-muted fw-bold text-uppercase mb-3" style="font-size: 12.5px; letter-spacing: 1.5px;">Stres</h6>
                                <h1 class="fw-bolder text-dark mb-4" style="font-size: 3rem; letter-spacing: -1.5px;">{{ $screening->score_stres ?? 0 }}</h1>
                                <span class="badge-status w-100 {{ $classStres }}">
                                    {{ ucfirst($screening->status_stres ?? '-') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PANEL EDUKASI / INFORMASI DASS -->
            <div class="accordion mb-5 info-panel-wrapper" id="accordionInformasiSkor">
                <div class="accordion-item" style="border: none;">
                    <h2 class="accordion-header" id="headingSkor">
                        <button class="accordion-button custom-acc collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSkor" aria-expanded="false" aria-controls="collapseSkor">
                            <i class="bi bi-info-circle-fill me-2 fs-5"></i> Mengapa skor saya termasuk kategori ini? (Panduan DASS-42)
                        </button>
                    </h2>
                    <div id="collapseSkor" class="accordion-collapse collapse" aria-labelledby="headingSkor" data-bs-parent="#accordionInformasiSkor">
                        <div class="accordion-body p-4 p-md-5 bg-white">
                            <p class="text-muted mb-4" style="font-size: 14.5px;">
                                DASS-42 adalah instrumen psikologis standar yang memiliki 14 pertanyaan untuk masing-masing kategori (Depresi, Kecemasan, Stres). Karena skor poin tertinggi setiap pertanyaan adalah 3, maka <strong>batas maksimal skor untuk setiap kategori adalah 42</strong>. Kategori <strong>"Sangat Parah"</strong> merupakan rentang batas atas tertinggi, sehingga skor berapapun yang masuk di dalam rentang tersebut akan diklasifikasikan ke tingkat keparahan yang sama.
                            </p>
                            <div class="table-responsive px-0">
                                <table class="table table-bordered mb-0" style="font-size: 14px; border-color: var(--border-soft);">
                                    <thead style="background-color: var(--sage-surface); color: var(--text-dark);">
                                        <tr>
                                            <th width="25%" class="fw-bold border-bottom-0">Tingkat Keparahan</th>
                                            <th width="25%" class="text-center fw-bold border-bottom-0">Skor Depresi</th>
                                            <th width="25%" class="text-center fw-bold border-bottom-0">Skor Kecemasan</th>
                                            <th width="25%" class="text-center fw-bold border-bottom-0">Skor Stres</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="badge" style="background-color: #22C55E; color: white;">Normal</span></td>
                                            <td class="text-center">0 - 9</td>
                                            <td class="text-center">0 - 7</td>
                                            <td class="text-center">0 - 14</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge" style="background-color: #EAB308; color: black;">Ringan</span></td>
                                            <td class="text-center">10 - 13</td>
                                            <td class="text-center">8 - 9</td>
                                            <td class="text-center">15 - 18</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge" style="background-color: #F97316; color: white;">Sedang</span></td>
                                            <td class="text-center">14 - 20</td>
                                            <td class="text-center">10 - 14</td>
                                            <td class="text-center">19 - 25</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge" style="background-color: #EF4444; color: white;">Parah</span></td>
                                            <td class="text-center">21 - 27</td>
                                            <td class="text-center">15 - 19</td>
                                            <td class="text-center">26 - 33</td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge" style="background-color: #7C3AED; color: white;">Sangat Parah</span></td>
                                            <td class="text-center fw-bold text-dark">28 - 42</td>
                                            <td class="text-center fw-bold text-dark">20 - 42</td>
                                            <td class="text-center fw-bold text-dark">34 - 42</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PANEL TABEL JAWABAN -->
            <div class="detail-card mb-0">
                <div class="detail-header d-flex align-items-center">
                    <div class="icon-wrapper me-3">
                        <i class="bi bi-ui-checks fs-5"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Review Jawaban Anda</h5>
                        <span class="text-muted" style="font-size: 13px;">Riwayat pilihan pada setiap instrumen pertanyaan</span>
                    </div>
                </div>
                
                <div class="card-body p-3">
                    @if($screening->answers)
                        <div class="table-responsive">
                            <table class="table custom-table">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="8%">No</th>
                                        <th width="62%">Pertanyaan</th>
                                        <th class="text-center" width="30%">Jawaban Anda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        // Array label teks
                                        $opsiTeks = [
                                            0 => 'Tidak pernah (0)',
                                            1 => 'Kadang-kadang (1)',
                                            2 => 'Sering (2)',
                                            3 => 'Sangat sering (3)'
                                        ];
                                        // Array class warna spesifik untuk mempercantik tampilan
                                        $opsiClass = [
                                            0 => 'ans-0',
                                            1 => 'ans-1',
                                            2 => 'ans-2',
                                            3 => 'ans-3'
                                        ];
                                    @endphp

                                    @foreach($questions as $index => $q)
                                        @php
                                            $jawabanSkor = $screening->answers[$q->id] ?? null;
                                        @endphp
                                        <tr>
                                            <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                                            <td class="fw-medium text-dark">{{ $q->pertanyaan ?? $q->question_text ?? 'Teks pertanyaan tidak ditemukan' }}</td>
                                            <td class="text-center">
                                                @if($jawabanSkor !== null)
                                                    <!-- Class akan dinamis menyesuaikan array $opsiClass -->
                                                    <span class="answer-tag {{ $opsiClass[$jawabanSkor] ?? 'ans-0' }}">
                                                        {{ $opsiTeks[$jawabanSkor] }}
                                                    </span>
                                                @else
                                                    <span class="badge" style="background-color: var(--sage-surface); color: var(--text-muted); border: 1px solid var(--border-soft); padding: 6px 12px; border-radius: 8px;">
                                                        Tidak dijawab
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="d-flex flex-column align-items-center justify-content-center py-4">
                                <div class="mb-3" style="width: 80px; height: 80px; background: var(--sage-light); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-inbox fs-1" style="color: var(--sage-primary);"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-2">Data Tidak Lengkap</h6>
                                <p class="text-muted mb-0" style="max-width: 300px;">Detail rekaman jawaban tidak tersedia untuk skrining versi lama ini.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection