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
        CUSTOM CARDS
    =========================== */
    .profile-card {
        background: #FFFFFF;
        border: 1px solid var(--border-soft);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-soft);
        transition: all 0.3s ease;
    }

    .icon-wrapper {
        background-color: var(--sage-light);
        width: 48px;
        height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-lg);
        color: var(--sage-primary);
        margin-right: 15px;
    }

    /* ===========================
        FORM INPUTS & TOMBOL
    =========================== */
    .form-control-sage {
        border: 1px solid var(--border-soft);
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 14.5px;
        transition: all 0.2s ease-in-out;
        background-color: #FAFCFB;
    }

    .form-control-sage:focus {
        border-color: var(--sage-primary);
        background-color: #FFFFFF;
        box-shadow: 0 0 0 4px rgba(74, 122, 109, 0.1);
        outline: none;
    }

    .btn-sage {
        background: var(--sage-primary);
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px;
        border-radius: 12px;
        transition: all 0.3s ease;
        letter-spacing: 0.3px;
    }
    
    .btn-sage:hover {
        background: var(--sage-hover);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(74, 122, 109, 0.2);
    }

    /* Box Info Password */
    .password-req-box {
        background-color: var(--sage-surface);
        border: 1px solid var(--border-soft);
        border-radius: 12px;
        padding: 16px;
        margin-top: 12px;
    }
</style>

<div class="container pb-4 pt-3">
    
    <!-- HEADER -->
    <div class="d-flex align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Profil Saya</h3>
            <p class="text-muted mb-0" style="font-size: 14.5px;">
                Kelola informasi akun dan pengaturan keamanan Anda.
            </p>
        </div>
    </div>

    <div class="row g-4">
        <!-- FORM UBAH PROFIL (USERNAME) -->
        <div class="col-lg-6">
            <div class="profile-card h-100">
                <div class="card-body p-4 p-md-5">
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-wrapper">
                            <i class="bi bi-person-badge fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Informasi Akun</h5>
                            <p class="text-muted small mb-0">Perbarui profil atau username Anda</p>
                        </div>
                    </div>

                    <form id="formUpdateProfile" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="username" class="form-label fw-semibold text-dark mb-2">Username</label>
                            <input type="text" class="form-control form-control-sage @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', Auth::user()->username) }}" required placeholder="Masukkan username baru">
                            @error('username')
                                <div class="invalid-feedback mt-2 fw-medium">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-sage w-100 d-flex justify-content-center align-items-center">
                            <i class="bi bi-check2-circle me-2 fs-5"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- FORM UBAH PASSWORD -->
        <div class="col-lg-6">
            <div class="profile-card h-100">
                <div class="card-body p-4 p-md-5">
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-wrapper">
                            <i class="bi bi-shield-lock fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Keamanan Akun</h5>
                            <p class="text-muted small mb-0">Perbarui kata sandi secara berkala</p>
                        </div>
                    </div>

                    <form id="formUpdatePassword" action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-semibold text-dark mb-2">Password Saat Ini</label>
                            <input type="password" class="form-control form-control-sage @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required placeholder="Masukkan password lama">
                            @error('current_password')
                                <div class="invalid-feedback mt-2 fw-medium">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-dark mb-2">Password Baru</label>
                            <input type="password" class="form-control form-control-sage @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Masukkan password baru">
                            
                            <!-- INFORMASI REQUIREMENT PASSWORD -->
                            <div class="password-req-box">
                                <div class="fw-bold text-dark mb-2" style="font-size: 13.5px;">
                                    <i class="bi bi-info-circle me-1" style="color: var(--sage-primary);"></i> Persyaratan Password:
                                </div>
                                <ul class="mb-0 ps-3 text-muted" style="font-size: 13px; line-height: 1.6;">
                                    <li>Minimal 8 karakter.</li>
                                    <li>Kombinasi huruf dan angka (disarankan).</li>
                                    <li>Tidak boleh sama dengan password saat ini.</li>
                                </ul>
                            </div>

                            @error('password')
                                <div class="invalid-feedback mt-2 fw-medium">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold text-dark mb-2">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control form-control-sage" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi password baru">
                        </div>

                        <button type="submit" class="btn btn-sage w-100 d-flex justify-content-center align-items-center">
                            <i class="bi bi-key me-2 fs-5"></i> Perbarui Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PINDAHKAN SCRIPT KE SINI AGAR LANGSUNG DI-RENDER OLEH BLADE -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fungsi untuk menangani konfirmasi form
        function setupFormConfirmation(formId, title, text) {
            const form = document.getElementById(formId);
            if (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault(); // Mencegah form langsung tersubmit

                    Swal.fire({
                        title: title,
                        text: text,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#4A7A6D', // Warna sage
                        cancelButtonColor: '#94a3b8',
                        confirmButtonText: 'Ya, Simpan!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        customClass: {
                            popup: 'rounded-4'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Memproses...',
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            form.submit();
                        }
                    });
                });
            }
        }

        // Terapkan ke kedua form
        setupFormConfirmation(
            'formUpdateProfile',
            'Simpan Perubahan?',
            'Apakah Anda yakin ingin memperbarui informasi akun ini?'
        );

        setupFormConfirmation(
            'formUpdatePassword',
            'Ubah Password?',
            'Pastikan Anda mengingat password baru ini. Lanjutkan?'
        );
    });
</script>

@endsection