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

        /* Variabel Tag Jawaban */
        --ans-0-bg: #F1F5F9; --ans-0-text: #64748B; --ans-0-border: #E2E8F0;
        --ans-1-bg: #ECFDF5; --ans-1-text: #059669; --ans-1-border: #A7F3D0;
        --ans-2-bg: #FFF7ED; --ans-2-text: #EA580C; --ans-2-border: #FED7AA;
        --ans-3-bg: #FEF2F2; --ans-3-text: #DC2626; --ans-3-border: #FECACA;
    }

    /* ===========================
        VARIABEL TEMA & WARNA (DARK MODE)
        Menggunakan class untuk sinkronisasi dengan toggle aplikasi
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

        /* Variabel Tag Jawaban Dark Mode */
        --ans-0-bg: #334155; --ans-0-text: #cbd5e1; --ans-0-border: #475569;
        --ans-1-bg: rgba(6, 78, 59, 0.4); --ans-1-text: #34d399; --ans-1-border: rgba(52, 211, 153, 0.3);
        --ans-2-bg: rgba(124, 45, 18, 0.4); --ans-2-text: #fb923c; --ans-2-border: rgba(251, 146, 60, 0.3);
        --ans-3-bg: rgba(127, 29, 29, 0.4); --ans-3-text: #f87171; --ans-3-border: rgba(248, 113, 113, 0.3);
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
        CUSTOM STYLE DETAIL
    =========================== */
    .page-title-section h3 {
        color: var(--text-dark);
        letter-spacing: -0.5px;
    }

    .detail-card {
        border: none;
        border-radius: var(--radius-xl);
        background: var(--bg-card);
        box-shadow: var(--shadow-soft);
        overflow: hidden;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .detail-header {
        background: var(--bg-card);
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
        background: var(--bg-card);
        border: 1px solid var(--border-soft);
        border-radius: var(--radius-lg);
        padding: 24px 16px;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }

    .stat-box:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-soft);
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
        background-color: var(--bg-card); 
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

    .badge-normal { background-color: rgba(34, 197, 94, 0.15) !important; color: #34d399 !important; border: 1px solid rgba(34, 197, 94, 0.3); }
    .badge-ringan { background-color: rgba(234, 179, 8, 0.15) !important; color: #fbbf24 !important; border: 1px solid rgba(234, 179, 8, 0.3); }
    .badge-sedang { background-color: rgba(249, 115, 22, 0.15) !important; color: #fb923c !important; border: 1px solid rgba(249, 115, 22, 0.3); }
    .badge-parah { background-color: rgba(239, 68, 68, 0.15) !important; color: #f87171 !important; border: 1px solid rgba(239, 68, 68, 0.3); }
    .badge-sangat-parah { background-color: rgba(124, 58, 237, 0.15) !important; color: #a78bfa !important; border: 1px solid rgba(124, 58, 237, 0.3); }
    .badge-default { background-color: var(--sage-surface) !important; color: var(--text-muted) !important; border: 1px solid var(--border-soft); }

    /* --- PERBAIKAN TAMPILAN JAWABAN (ANSWER TAGS) --- */
    .answer-tag {
        font-weight: 600;
        padding: 6px 16px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        white-space: nowrap;
        border: 1px solid transparent;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }

    .ans-0 { background-color: var(--ans-0-bg); color: var(--ans-0-text); border-color: var(--ans-0-border); }
    .ans-1 { background-color: var(--ans-1-bg); color: var(--ans-1-text); border-color: var(--ans-1-border); }
    .ans-2 { background-color: var(--ans-2-bg); color: var(--ans-2-text); border-color: var(--ans-2-border); }
    .ans-3 { background-color: var(--ans-3-bg); color: var(--ans-3-text); border-color: var(--ans-3-border); }

    /* ===========================
        INFO PANEL (ACCORDION)
    =========================== */
    .info-panel-wrapper {
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-soft);
        background: var(--bg-card);
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
        background: var(--bg-card);
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
                    <h3 class="fw-bolder text-adaptive mb-2">Detail Skrining</h3>
                    <p class="text-adaptive-muted mb-0" style="font-size: 15px;">
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
                            <h5 class="mb-0 fw-bold text-adaptive">Hasil Analisis DASS-42</h5>
                            <span class="text-adaptive-muted" style="font-size: 13px;">Skor evaluasi berdasarkan kuesioner yang Anda isi</span>
                        </div>
                    </div>
                    <span class="badge" style="background-color: var(--sage-surface); color: var(--sage-primary); border: 1px solid var(--border-soft); padding: 8px 16px; border-radius: 20px; font-weight: 600;">
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
                                <h6 class="text-adaptive-muted fw-bold text-uppercase mb-3" style="font-size: 12.5px; letter-spacing: 1.5px;">Depresi</h6>
                                <h1 class="fw-bolder text-adaptive mb-4" style="font-size: 3rem; letter-spacing: -1.5px;">{{ $screening->score_depresi ?? 0 }}</h1>
                                <span class="badge-status w-100 {{ $classDepresi }}">
                                    {{ ucfirst($screening->status_depresi ?? '-') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="stat-box">
                                <h6 class="text-adaptive-muted fw-bold text-uppercase mb-3" style="font-size: 12.5px; letter-spacing: 1.5px;">Kecemasan</h6>
                                <h1 class="fw-bolder text-adaptive mb-4" style="font-size: 3rem; letter-spacing: -1.5px;">{{ $screening->score_kecemasan ?? 0 }}</h1>
                                <span class="badge-status w-100 {{ $classCemas }}">
                                    {{ ucfirst($screening->status_kecemasan ?? '-') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="stat-box">
                                <h6 class="text-adaptive-muted fw-bold text-uppercase mb-3" style="font-size: 12.5px; letter-spacing: 1.5px;">Stres</h6>
                                <h1 class="fw-bolder text-adaptive mb-4" style="font-size: 3rem; letter-spacing: -1.5px;">{{ $screening->score_stres ?? 0 }}</h1>
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
                <div class="accordion-item" style="border: none; background: transparent;">
                    <h2 class="accordion-header" id="headingSkor">
                        <button class="accordion-button custom-acc collapsed text-adaptive" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSkor" aria-expanded="false" aria-controls="collapseSkor">
                            <i class="bi bi-info-circle-fill me-2 fs-5"></i> Mengapa skor saya termasuk kategori ini? (Panduan DASS-42)
                        </button>
                    </h2>
                    <div id="collapseSkor" class="accordion-collapse collapse" aria-labelledby="headingSkor" data-bs-parent="#accordionInformasiSkor">
                        <div class="accordion-body p-4 p-md-5 bg-adaptive">
                            <p class="text-adaptive-muted mb-4" style="font-size: 14.5px;">
                                DASS-42 adalah instrumen psikologis standar yang memiliki 14 pertanyaan untuk masing-masing kategori (Depresi, Kecemasan, Stres). Karena skor poin tertinggi setiap pertanyaan adalah 3, maka <strong>batas maksimal skor untuk setiap kategori adalah 42</strong>. Kategori <strong>"Sangat Parah"</strong> merupakan rentang batas atas tertinggi, sehingga skor berapapun yang masuk di dalam rentang tersebut akan diklasifikasikan ke tingkat keparahan yang sama.
                            </p>
                            <div class="table-responsive px-0">
                                <table class="table table-bordered mb-0 border-adaptive" style="font-size: 14px;">
                                    <thead style="background-color: var(--sage-surface); color: var(--text-dark);">
                                        <tr>
                                            <th width="25%" class="fw-bold border-adaptive">Tingkat Keparahan</th>
                                            <th width="25%" class="text-center fw-bold border-adaptive">Skor Depresi</th>
                                            <th width="25%" class="text-center fw-bold border-adaptive">Skor Kecemasan</th>
                                            <th width="25%" class="text-center fw-bold border-adaptive">Skor Stres</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border-adaptive"><span class="badge-status badge-normal">Normal</span></td>
                                            <td class="text-center text-adaptive-muted border-adaptive">0 - 9</td>
                                            <td class="text-center text-adaptive-muted border-adaptive">0 - 7</td>
                                            <td class="text-center text-adaptive-muted border-adaptive">0 - 14</td>
                                        </tr>
                                        <tr>
                                            <td class="border-adaptive"><span class="badge-status badge-ringan">Ringan</span></td>
                                            <td class="text-center text-adaptive-muted border-adaptive">10 - 13</td>
                                            <td class="text-center text-adaptive-muted border-adaptive">8 - 9</td>
                                            <td class="text-center text-adaptive-muted border-adaptive">15 - 18</td>
                                        </tr>
                                        <tr>
                                            <td class="border-adaptive"><span class="badge-status badge-sedang">Sedang</span></td>
                                            <td class="text-center text-adaptive-muted border-adaptive">14 - 20</td>
                                            <td class="text-center text-adaptive-muted border-adaptive">10 - 14</td>
                                            <td class="text-center text-adaptive-muted border-adaptive">19 - 25</td>
                                        </tr>
                                        <tr>
                                            <td class="border-adaptive"><span class="badge-status badge-parah">Parah</span></td>
                                            <td class="text-center text-adaptive-muted border-adaptive">21 - 27</td>
                                            <td class="text-center text-adaptive-muted border-adaptive">15 - 19</td>
                                            <td class="text-center text-adaptive-muted border-adaptive">26 - 33</td>
                                        </tr>
                                        <tr>
                                            <td class="border-adaptive"><span class="badge-status badge-sangat-parah">Sangat Parah</span></td>
                                            <td class="text-center fw-bold text-adaptive border-adaptive">28 - 42</td>
                                            <td class="text-center fw-bold text-adaptive border-adaptive">20 - 42</td>
                                            <td class="text-center fw-bold text-adaptive border-adaptive">34 - 42</td>
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
                        <h5 class="mb-0 fw-bold text-adaptive">Review Jawaban Anda</h5>
                        <span class="text-adaptive-muted" style="font-size: 13px;">Riwayat pilihan pada setiap instrumen pertanyaan</span>
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
                                        $opsiTeks = [
                                            0 => 'Tidak pernah (0)',
                                            1 => 'Kadang-kadang (1)',
                                            2 => 'Sering (2)',
                                            3 => 'Sangat sering (3)'
                                        ];
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
                                            <td class="text-center fw-bold text-adaptive-muted">{{ $index + 1 }}</td>
                                            <td class="fw-medium text-adaptive">{{ $q->pertanyaan ?? $q->question_text ?? 'Teks pertanyaan tidak ditemukan' }}</td>
                                            <td class="text-center">
                                                @if($jawabanSkor !== null)
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
                        <div class="text-center py-5 bg-adaptive">
                            <div class="d-flex flex-column align-items-center justify-content-center py-4 opacity-75">
                                <div class="mb-3" style="width: 80px; height: 80px; background: var(--sage-light); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-inbox fs-1" style="color: var(--sage-primary);"></i>
                                </div>
                                <h6 class="fw-bold text-adaptive mb-2">Data Tidak Lengkap</h6>
                                <p class="text-adaptive-muted mb-0" style="max-width: 300px;">Detail rekaman jawaban tidak tersedia untuk skrining versi lama ini.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection