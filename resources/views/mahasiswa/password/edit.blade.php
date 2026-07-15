@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        CUSTOM STYLE UBAH PASSWORD
    =========================== */
    .password-card {
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 24px;
        background: #FFFFFF;
        box-shadow: 0 10px 40px -10px rgba(15, 23, 42, 0.06);
        overflow: hidden;
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

    /* Button Update */
    .btn-update {
        height: 52px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 15px;
        letter-spacing: 0.3px;
        background: linear-gradient(135deg, #4F46E5 0%, #3B82F6 100%);
        border: none;
        color: white;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-update:hover {
        background: linear-gradient(135deg, #4338CA 0%, #2563EB 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.25);
        color: white;
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center border-0 shadow-sm" style="border-radius: 16px; background-color: #ECFDF5;" role="alert">
                    <i class="bi bi-check-circle-fill fs-5 me-3 text-success"></i>
                    <div class="flex-grow-1 fw-medium text-dark">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card password-card">
                <div class="card-body p-4 p-md-5">
                    
                    <div class="d-flex align-items-center mb-4 pb-4 border-bottom">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-4 me-4 d-flex align-items-center justify-content-center text-primary" style="width: 60px; height: 60px;">
                            <i class="bi bi-key-fill fs-2"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Ubah Password</h4>
                            <p class="text-muted small mb-0" style="font-size: 13.5px;">Pastikan akun Anda tetap aman dengan menggunakan kombinasi password yang kuat.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('mahasiswa.password.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <div class="input-group @error('current_password') is-invalid-group @enderror">
                                <span class="input-group-text">
                                    <i class="bi bi-unlock"></i>
                                </span>
                                <input type="password" 
                                       class="form-control @error('current_password') is-invalid @enderror" 
                                       id="current_password" 
                                       name="current_password" 
                                       placeholder="Ketik password lama Anda"
                                       required>
                            </div>
                            @error('current_password')
                                <div class="invalid-feedback d-block mt-2 px-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password Baru</label>
                            <div class="input-group @error('password') is-invalid-group @enderror">
                                <span class="input-group-text">
                                    <i class="bi bi-shield-lock"></i>
                                </span>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Ketik password baru Anda"
                                       required>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block mt-2 px-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-check2-circle"></i>
                                </span>
                                <input type="password" 
                                       class="form-control" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       placeholder="Ulangi password baru Anda"
                                       required>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-update">
                                <i class="bi bi-floppy-fill me-2"></i> Simpan Password Baru
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>

        </div>
    </div>
</div>
@endsection