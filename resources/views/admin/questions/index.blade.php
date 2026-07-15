@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        CUSTOM STYLE KELOLA PERTANYAAN
    =========================== */
    .admin-card {
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 20px;
        background: #FFFFFF;
        box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04);
        overflow: hidden;
    }

    /* Header Halaman */
    .page-header-title {
        font-weight: 700;
        color: #0F172A;
        letter-spacing: -0.5px;
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
        padding: 18px 20px;
        border-bottom: 1px solid #E2E8F0;
        border-top: none;
        white-space: nowrap;
    }

    .custom-table tbody td {
        padding: 18px 20px;
        color: #334155;
        font-size: 14.5px;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
        line-height: 1.6;
    }

    .custom-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #F8FAFC;
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

    .cat-depression { background: #EEF2FF; color: #4F46E5; border: 1px solid #E0E7FF; }
    .cat-anxiety { background: #FEF9C3; color: #CA8A04; border: 1px solid #FEF08A; }
    .cat-stress { background: #FEF2F2; color: #DC2626; border: 1px solid #FEE2E2; }
    .cat-default { background: #F1F5F9; color: #475569; border: 1px solid #E2E8F0; }

    /* Action Buttons */
    .btn-action-table {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
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
        background: #EEF6FF;
        border-color: #3B82F6;
        color: #1D4ED8;
    }

    .btn-action-delete {
        color: #EF4444;
    }

    .btn-action-delete:hover {
        background: #FEF2F2;
        border-color: #EF4444;
        color: #B91C1C;
    }

    /* Paginasi Container */
    .pagination-container {
        padding: 20px;
        background: #FFFFFF;
        border-top: 1px solid #F1F5F9;
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
                <p class="text-muted mb-0" style="font-size: 14px;">Manajemen daftar instrumen kuesioner skrining.</p>
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
                            <td class="text-center fw-medium text-muted">{{ $questions->firstItem() + $index }}</td>
                            <td>
                                <span class="fw-medium text-dark">{{ $q->question_text }}</span>
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
                                    <i class="bi bi-journal-x fs-1 text-muted mb-3"></i>
                                    <h6 class="fw-bold text-dark mb-1">Data Pertanyaan Kosong</h6>
                                    <span class="text-muted">Belum ada instrumen kuesioner yang ditambahkan.</span>
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