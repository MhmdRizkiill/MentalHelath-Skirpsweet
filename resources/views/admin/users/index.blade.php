@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        VARIABEL TEMA TABEL ADMIN
    =========================== */
    :root {
        --card-bg: #FFFFFF;
        --card-border: rgba(226, 232, 240, 0.8);
        --card-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04);
        
        --text-main: #0F172A;
        --text-muted: #64748B;
        --text-td: #334155;
        
        --table-head-bg: #F8FAFC;
        --table-border: #E2E8F0;
        --table-row-hover: #F8FAFC;
        
        --badge-bg: #F1F5F9;
        --badge-border: #E2E8F0;
        --badge-text: #475569;
        
        --btn-action-bg: #FFFFFF;
        --btn-action-border: #CBD5E1;
        
        --btn-edit-color: #3B82F6;
        --btn-edit-hover-bg: #EEF6FF;
        --btn-edit-hover-color: #1D4ED8;
        
        --btn-delete-color: #EF4444;
        --btn-delete-hover-bg: #FEF2F2;
        --btn-delete-hover-color: #B91C1C;
        
        --icon-box-bg: rgba(13, 110, 253, 0.1);
        --icon-box-color: #0d6efd;
    }

    html.dark, body.dark-mode, [data-bs-theme="dark"] {
        --card-bg: #1e293b;
        --card-border: rgba(255, 255, 255, 0.1);
        --card-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.3);
        
        --text-main: #f8fafc;
        --text-muted: #94a3b8;
        --text-td: #cbd5e1;
        
        --table-head-bg: #0f172a;
        --table-border: rgba(255, 255, 255, 0.1);
        --table-row-hover: rgba(255, 255, 255, 0.03);
        
        --badge-bg: #0f172a;
        --badge-border: rgba(255, 255, 255, 0.15);
        --badge-text: #cbd5e1;
        
        --btn-action-bg: #1e293b;
        --btn-action-border: #475569;
        
        --btn-edit-color: #60a5fa;
        --btn-edit-hover-bg: rgba(59, 130, 246, 0.15);
        --btn-edit-hover-color: #93c5fd;
        
        --btn-delete-color: #f87171;
        --btn-delete-hover-bg: rgba(239, 68, 68, 0.15);
        --btn-delete-hover-color: #fca5a5;
        
        --icon-box-bg: rgba(59, 130, 246, 0.15);
        --icon-box-color: #60a5fa;
    }

    /* Helper Classes */
    .text-adaptive { color: var(--text-main) !important; }
    .text-adaptive-muted { color: var(--text-muted) !important; }

    /* ===========================
        CUSTOM STYLE KELOLA USER
    =========================== */
    .admin-card {
        border: 1px solid var(--card-border);
        border-radius: 20px;
        background: var(--card-bg);
        box-shadow: var(--card-shadow);
        overflow: hidden;
    }

    /* Header Halaman */
    .page-header-title {
        font-weight: 700;
        color: var(--text-main);
        letter-spacing: -0.5px;
    }

    .header-icon-box {
        background: var(--icon-box-bg);
        color: var(--icon-box-color);
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }

    /* Tabel Modern */
    .custom-table {
        margin-bottom: 0;
        --bs-table-bg: transparent;
    }

    .custom-table thead th {
        background: var(--table-head-bg);
        color: var(--text-muted);
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 18px 20px;
        border-bottom: 1px solid var(--table-border);
        border-top: none;
        white-space: nowrap;
    }

    .custom-table tbody td {
        padding: 16px 20px;
        color: var(--text-td);
        font-size: 14.5px;
        border-bottom: 1px solid var(--table-border);
        vertical-align: middle;
    }

    .custom-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background-color: var(--table-row-hover);
    }

    /* Custom Badge untuk Username */
    .badge-username {
        background: var(--badge-bg);
        color: var(--badge-text);
        border: 1px solid var(--badge-border);
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        letter-spacing: 0.5px;
        display: inline-block;
    }

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
        color: var(--btn-edit-color);
    }
    
    .btn-action-edit:hover {
        background: var(--btn-edit-hover-bg);
        border-color: var(--btn-edit-color);
        color: var(--btn-edit-hover-color);
    }

    .btn-action-delete {
        color: var(--btn-delete-color);
    }

    .btn-action-delete:hover {
        background: var(--btn-delete-hover-bg);
        border-color: var(--btn-delete-color);
        color: var(--btn-delete-hover-color);
    }

    /* Paginasi Container */
    .pagination-container {
        padding: 20px;
        background: var(--card-bg);
        border-top: 1px solid var(--table-border);
    }

    @media(max-width: 768px) {
        .page-header-container {
            flex-direction: column;
            align-items: stretch !important;
            gap: 16px;
        }
        .btn-add-user {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header-container">
        <div class="d-flex align-items-center">
            <div class="header-icon-box me-3 d-none d-sm-flex">
                <i class="bi bi-people fs-4"></i>
            </div>
            <div>
                <h3 class="page-header-title mb-1">Kelola Akun Mahasiswa</h3>
                <p class="text-adaptive-muted mb-0" style="font-size: 14px;">Manajemen kredensial anonim dan kontrol akses sistem.</p>
            </div>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm btn-add-user d-inline-flex align-items-center" style="height: 46px; font-weight: 600;">
            <i class="bi bi-person-plus-fill me-2"></i> Tambah Mahasiswa
        </a>
    </div>

    <div class="card admin-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th class="text-center" width="8%">No</th>
                            <th width="42%">Username Anonim</th>
                            <th width="25%">Tanggal Terdaftar</th>
                            <th class="text-center" width="25%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $u)
                        <tr>
                            <td class="text-center fw-medium text-adaptive-muted">{{ $users->firstItem() + $index }}</td>
                            <td>
                                <span class="badge-username">
                                    <i class="bi bi-person-circle me-1 opacity-75"></i> {{ $u->username }}
                                </span>
                            </td>
                            <td>
                                <div class="text-adaptive fw-medium">{{ $u->created_at->format('d M Y') }}</div>
                                <div class="text-adaptive-muted small">{{ $u->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.users.edit', $u->id) }}" class="btn-action-table btn-action-edit text-decoration-none">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>
                                    
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus akun mahasiswa ini beserta seluruh riwayat skriningnya? Tindakan ini tidak dapat dibatalkan.');">
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
                                    <i class="bi bi-person-x fs-1 text-adaptive-muted mb-3"></i>
                                    <h6 class="fw-bold text-adaptive mb-1">Belum Ada Mahasiswa</h6>
                                    <span class="text-adaptive-muted">Data akun mahasiswa yang dibuat akan muncul di sini.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($users->hasPages())
        <div class="pagination-container d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

@endsection