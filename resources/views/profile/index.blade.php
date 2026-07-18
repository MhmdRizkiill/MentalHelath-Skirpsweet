@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-4">
        <h4 class="fw-bold mb-0 text-dark">Profil Saya</h4>
    </div>

    <div class="row g-4">
        <!-- FORM UBAH PROFIL (USERNAME) -->
        <div class="col-lg-6">
            <div class="card h-100 border-0 shadow-sm" style="border-radius: var(--radius-lg);">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 d-flex align-items-center">
                        <i class="bi bi-person-badge text-primary me-2"></i> Informasi Akun
                    </h5>
                    <p class="text-muted small mb-4">Perbarui informasi profil atau username akun Anda di sini.</p>

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', Auth::user()->username) }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Peran (Role)</label>
                            <input type="text" class="form-control bg-light text-capitalize" value="{{ Auth::user()->role }}" readonly disabled>
                            <div class="form-text text-muted" style="font-size: 12px;">Role tidak dapat diubah sendiri.</div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-2">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- FORM UBAH PASSWORD -->
        <div class="col-lg-6">
            <div class="card h-100 border-0 shadow-sm" style="border-radius: var(--radius-lg);">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 d-flex align-items-center">
                        <i class="bi bi-shield-lock text-primary me-2"></i> Keamanan Akun
                    </h5>
                    <p class="text-muted small mb-4">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>

                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-semibold">Password Saat Ini</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            
                            <!-- INFORMASI REQUIREMENT PASSWORD (TERTULIS JELAS) -->
                            <div class="form-text mt-2 text-dark" style="font-size: 12.5px; background: #F8FAFC; padding: 10px; border-radius: 8px; border: 1px solid #E2E8F0;">
                                <strong>Persyaratan Password:</strong>
                                <ul class="mb-0 ps-3 mt-1 text-muted">
                                    <li>Minimal 8 karakter.</li>
                                    <li>Kombinasi huruf dan angka (opsional namun disarankan).</li>
                                    <li>Tidak boleh sama dengan password saat ini.</li>
                                </ul>
                            </div>

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-dark w-100">
                            Perbarui Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection