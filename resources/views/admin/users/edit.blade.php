@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        CUSTOM STYLE FORM ADMIN
    =========================== */
    .admin-form-card {
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 20px;
        background: #FFFFFF;
        box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.05);
        overflow: hidden;
    }

    .admin-form-header {
        background: #F8FAFC;
        border-bottom: 1px solid #F1F5F9;
        padding: 24px 30px;
        display: flex;
        align-items: center;
    }

    .header-icon-box {
        width: 48px;
        height: 48px;
        background: rgba(79, 70, 229, 0.1);
        color: #4F46E5;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-right: 16px;
    }

    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 14px;
        margin-bottom: 8px;
    }

    /* Input Group Styling */
    .input-group {
        border: 1px solid #CBD5E1;
        border-radius: 14px;
        background: #FFFFFF;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .input-group:focus-within {
        border-color: #4F46E5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    .input-group-text {
        background: transparent;
        border: none;
        color: #94A3B8;
        padding-left: 16px;
        padding-right: 10px;
    }

    .form-control {
        border: none;
        border-radius: 0 14px 14px 0;
        height: 52px;
        padding-left: 6px;
        font-size: 14.5px;
        color: #1E293B;
        background: transparent;
    }

    .form-control:focus {
        background: transparent;
        box-shadow: none;
        border: none;
    }

    .form-control::placeholder {
        color: #94A3B8;
        font-size: 14px;
    }

    /* Error Handling Style */
    .input-group.is-invalid-group {
        border-color: #EF4444;
    }
    .input-group.is-invalid-group:focus-within {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    /* Custom Password Info Box */
    .password-info-box {
        background: rgba(79, 70, 229, 0.05);
        border: 1px dashed rgba(79, 70, 229, 0.3);
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        margin-bottom: 24px;
    }

    /* Button Actions */
    .btn-action {
        height: 50px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 14.5px;
        padding: 0 24px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        letter-spacing: 0.3px;
    }

    .btn-save {
        background: linear-gradient(135deg, #4F46E5 0%, #3B82F6 100%);
        border: none;
        color: white;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
    }

    .btn-save:hover {
        background: linear-gradient(135deg, #4338CA 0%, #2563EB 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.25);
        color: white;
    }

    .btn-cancel {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        color: #475569;
    }

    .btn-cancel:hover {
        background: #F8FAFC;
        border-color: #94A3B8;
        color: #0F172A;
    }

    @media(max-width: 576px) {
        .admin-form-header {
            padding: 20px;
        }
        .action-buttons {
            flex-direction: column-reverse;
            gap: 12px;
        }
        .btn-action {
            width: 100%;
        }
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            
            <div class="card admin-form-card">
                <div class="admin-form-header">
                    <div class="header-icon-box">
                        <i class="bi bi-person-gear"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Edit Akun Mahasiswa</h4>
                        <p class="text-muted mb-0" style="font-size: 13.5px;">Perbarui data username atau atur ulang password akun anonim.</p>
                    </div>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="username" class="form-label">Username (Digunakan untuk Login)</label>
                            <div class="input-group @error('username') is-invalid-group @enderror">
                                <span class="input-group-text">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" 
                                       class="form-control @error('username') is-invalid @enderror" 
                                       id="username" 
                                       name="username" 
                                       value="{{ old('username', $user->username) }}" 
                                       placeholder="Contoh: mhs_anonim123" 
                                       required>
                            </div>
                            @error('username') 
                                <div class="invalid-feedback d-block mt-2 px-1">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="password-info-box">
                            <i class="bi bi-info-circle text-primary fs-4 me-3"></i>
                            <div>
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 13.5px;">Reset Password?</h6>
                                <p class="text-muted mb-0" style="font-size: 13px;">Kosongkan kolom password di bawah ini jika Anda <strong>tidak ingin</strong> mengubah password mahasiswa saat ini.</p>
                            </div>
                        </div>
                        
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password Baru <span class="text-muted fw-normal">(Opsional)</span></label>
                                <div class="input-group @error('password') is-invalid-group @enderror">
                                    <span class="input-group-text">
                                        <i class="bi bi-unlock"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Ketik password baru">
                                </div>
                                @error('password') 
                                    <div class="invalid-feedback d-block mt-2 px-1">{{ $message }}</div> 
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-shield-lock"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="Ulangi password baru">
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between action-buttons border-top pt-4 mt-2">
                            <a href="{{ route('admin.users.index') }}" class="text-decoration-none btn-action btn-cancel">
                                <i class="bi bi-arrow-left me-2"></i> Kembali
                            </a>
                            <button type="submit" class="btn-action btn-save">
                                <i class="bi bi-cloud-check-fill me-2"></i> Update Akun
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection