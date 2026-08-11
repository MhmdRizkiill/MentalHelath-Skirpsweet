@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        VARIABEL TEMA KELOLA PERTANYAAN
    =========================== */
    :root {
        --admin-bg-card: #FFFFFF;
        --admin-border: rgba(226, 232, 240, 0.8);
        --admin-text-main: #0F172A;
        --admin-text-muted: #64748B;
        --admin-bg-header: #F8FAFC;
        --admin-bg-hover: #F8FAFC;
        --admin-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04);
        
        /* Tombol Aksi */
        --btn-action-bg: #FFFFFF;
        --btn-action-border: #CBD5E1;
        --btn-action-edit-hover-bg: #EEF6FF;
        --btn-action-del-hover-bg: #FEF2F2;
        
        /* Badges */
        --badge-dep-bg: #EEF2FF; --badge-dep-text: #4F46E5; --badge-dep-border: #E0E7FF;
        --badge-anx-bg: #FEF9C3; --badge-anx-text: #CA8A04; --badge-anx-border: #FEF08A;
        --badge-str-bg: #FEF2F2; --badge-str-text: #DC2626; --badge-str-border: #FEE2E2;
        --badge-def-bg: #F1F5F9; --badge-def-text: #475569; --badge-def-border: #E2E8F0;
    }

    html.dark, body.dark-mode, [data-bs-theme="dark"] {
        --admin-bg-card: #1e293b;
        --admin-border: rgba(255, 255, 255, 0.1);
        --admin-text-main: #f8fafc;
        --admin-text-muted: #94a3b8;
        --admin-bg-header: #0f172a; /* Lebih gelap untuk header tabel di dark mode */
        --admin-bg-hover: #334155;
        --admin-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.3);
        
        /* Tombol Aksi */
        --btn-action-bg: #1e293b;
        --btn-action-border: #475569;
        --btn-action-edit-hover-bg: rgba(59, 130, 246, 0.15);
        --btn-action-del-hover-bg: rgba(239, 68, 68, 0.15);
        
        /* Badges penyesuaian dark mode */
        --badge-dep-bg: rgba(79, 70, 229, 0.2); --badge-dep-text: #818CF8; --badge-dep-border: rgba(79, 70, 229, 0.3);
        --badge-anx-bg: rgba(202, 138, 4, 0.2); --badge-anx-text: #FBBF24; --badge-anx-border: rgba(202, 138, 4, 0.3);
        --badge-str-bg: rgba(220, 38, 38, 0.2); --badge-str-text: #F87171; --badge-str-border: rgba(220, 38, 38, 0.3);
        --badge-def-bg: rgba(71, 85, 105, 0.2); --badge-def-text: #CBD5E1; --badge-def-border: rgba(71, 85, 105, 0.3);
    }

    /* Helper Classes */
    .text-adaptive { color: var(--admin-text-main) !important; }
    .text-adaptive-muted { color: var(--admin-text-muted) !important; }

    /* ===========================
        CUSTOM STYLE KELOLA PERTANYAAN
    =========================== */
    .admin-card {
        border: 1px solid var(--admin-border);
        border-radius: 20px;
        background: var(--admin-bg-card);
        box-shadow: var(--admin-shadow);
        overflow: hidden;
    }

    /* Header Halaman */
    .page-header-title {
        font-weight: 700;
        color: var(--admin-text-main);
        letter-spacing: -0.5px;
    }

    /* Tabel Modern */
    .custom-table {
        margin-bottom: 0;
    }

    .custom-table thead th {
        background: var(--admin-bg-header);
        color: var(--admin-text-muted);
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 18px 20px;
        border-bottom: 1px solid var(--admin-border);
        border-top: none;
        white-space: nowrap;
    }

    .custom-table tbody td {
        padding: 18px 20px;
        color: var(--admin-text-main);
        font-size: 14.5px;
        border-bottom: 1px solid var(--admin-border);
        vertical-align: middle;
        line-height: 1.6;
    }

    .custom-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background-color: var(--admin-bg-hover);
    }

    /* Badge Kategori */
    .badge-category {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 600;
        display: inline-block;
        letter-spacing: 0.3px;
        white-space: nowrap;
    }

    .cat-depression { background: var(--badge-dep-bg); color: var(--badge-dep-text); border: 1px solid var(--badge-dep-border); }
    .cat-anxiety { background: var(--badge-anx-bg); color: var(--badge-anx-text); border: 1px solid var(--badge-anx-border); }
    .cat-stress { background: var(--badge-str-bg); color: var(--badge-str-text); border: 1px solid var(--badge-str-border); }
    .cat-default { background: var(--badge-def-bg); color: var(--badge-def-text); border: 1px solid var(--badge-def-border); }

    /* Action Buttons */
    .btn-action-table {
        background: var(--btn-action-bg);
        border: 1px solid var(--btn-action-border);
        font-weight: 600;
        font-size: 13px;
        padding: 6px 14px;
        border-radius: 20px;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-action-edit {
        color: #3B82F6;
    }
    
    .btn-action-edit:hover {
        background: var(--btn-action-edit-hover-bg);
        border-color: #3B82F6;
        color: #3B82F6;
    }

    .btn-action-delete {
        color: #EF4444;
    }

    .btn-action-delete:hover {
        background: var(--btn-action-del-hover-bg);
        border-color: #EF4444;
        color: #EF4444;
    }

    /* Paginasi Container */
    .pagination-container {
        padding: 20px;
        background: var(--admin-bg-card);
        border-top: 1px solid var(--admin-border);
    }

    @media(max-width: 768px) {
        .page-header-container {
            flex-direction: column;
            align-items: stretch !important;
            gap: 16px;
        }
        .btn-add-item {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header-container">
        <div class="d-flex align-items-center">
            <div class="bg-primary bg-opacity-10 p-2 rounded-lg me-3 d-none d-sm-flex">
                <i class="bi bi-patch-question text-primary fs-4"></i>
            </div>
            <div>
                <h3 class="page-header-title mb-1">Kelola Pertanyaan DASS-42</h3>
                <p class="text-adaptive-muted mb-0" style="font-size: 14px;">Manajemen daftar instrumen kuesioner skrining.</p>
            </div>
        </div>
        <a href="{{ route('admin.questions.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm btn-add-item d-inline-flex align-items-center" style="height: 46px; font-weight: 600;">
            <i class="bi bi-plus-circle-fill me-2"></i> Tambah Pertanyaan
        </a>
    </div>

    <div class="card admin-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th class="text-center" width="6%">No</th>
                            <th width="54%">Teks Pertanyaan</th>
                            <th class="text-center" width="20%">Kategori</th>
                            <th class="text-center" width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($questions as $index => $q)
                        <tr>
                            <td class="text-center fw-medium text-adaptive-muted">{{ $questions->firstItem() + $index }}</td>
                            <td>
                                <span class="fw-medium text-adaptive">{{ $q->question_text }}</span>
                            </td>
                            <td class="text-center">
                                @php
                                    // Logika identifikasi string dipertahankan 100%
                                    $kategori = strtolower(trim($q->category));
                                @endphp

                                @if($kategori === 'depression' || $kategori === 'depresi')
                                    <span class="badge-category cat-depression">{{ ucfirst($q->category) }}</span>
                                @elseif($kategori === 'anxiety' || $kategori === 'kecemasan')
                                    <span class="badge-category cat-anxiety">{{ ucfirst($q->category) }}</span>
                                @elseif($kategori === 'stress' || $kategori === 'stres')
                                    <span class="badge-category cat-stress">{{ ucfirst($q->category) }}</span>
                                @else
                                    <span class="badge-category cat-default">{{ ucfirst($q->category) }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.questions.edit', $q->id) }}" class="btn-action-table btn-action-edit text-decoration-none">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>
                                    
                                    <form action="{{ route('admin.questions.destroy', $q->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pertanyaan ini secara permanen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-table btn-action-delete">
                                            <i class="bi bi-trash3 me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center opacity-50 my-3">
                                    <i class="bi bi-journal-x fs-1 text-adaptive-muted mb-3"></i>
                                    <h6 class="fw-bold text-adaptive mb-1">Data Pertanyaan Kosong</h6>
                                    <span class="text-adaptive-muted">Belum ada instrumen kuesioner yang ditambahkan.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($questions->hasPages())
        <div class="pagination-container d-flex justify-content-center">
            {{ $questions->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

@endsection