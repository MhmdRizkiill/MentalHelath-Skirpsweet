@extends('layouts.app')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body {
        background: radial-gradient(circle at 10% 20%, rgba(238, 246, 255, 1) 0%, rgba(248, 250, 252, 1) 90%);
        min-height: 100vh;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .register-wrapper {
        min-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 0;
    }

    .register-card {
        border: 1px solid rgba(255, 255, 255, 0.7);
        border-radius: 20px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        box-shadow:
            0 4px 6px -1px rgba(0, 0, 0, 0.02),
            0 20px 25px -5px rgba(15, 23, 42, 0.06),
            0 10px 10px -5px rgba(15, 23, 42, 0.02);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .register-card:hover {
        transform: translateY(-4px);
        box-shadow:
            0 4px 6px -1px rgba(0, 0, 0, 0.02),
            0 25px 35px -5px rgba(15, 23, 42, 0.09),
            0 10px 15px -5px rgba(15, 23, 42, 0.03);
    }

    .register-header {
        padding: 40px 40px 15px;
        border-bottom: none;
        background: transparent;
    }

    .register-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 20px;
        border-radius: 16px;
        background: linear-gradient(135deg, #4F46E5 0%, #3B82F6 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.2);
        transition: transform 0.3s ease;
    }
    
    .register-card:hover .register-icon {
        transform: scale(1.05) rotate(-5deg);
    }

    .register-title {
        font-weight: 700;
        color: #0F172A;
        letter-spacing: -0.5px;
    }

    .register-subtitle {
        color: #64748B;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.6;
    }

    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 14px;
        margin-bottom: 8px;
    }

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
        height: 50px;
        padding-left: 6px;
        font-size: 15px;
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

    /* Penyesuaian khusus error validasi */
    .input-group.is-invalid-group {
        border-color: #EF4444;
    }
    .input-group.is-invalid-group:focus-within {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .btn-register {
        height: 50px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 15px;
        letter-spacing: 0.2px;
        background: linear-gradient(135deg, #4F46E5 0%, #3B82F6 100%);
        border: none;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-register:hover {
        background: linear-gradient(135deg, #4338CA 0%, #2563EB 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.25);
    }
    
    .btn-register:active {
        transform: translateY(0);
    }

    .register-footer a {
        text-decoration: none;
        font-weight: 600;
        color: #4F46E5;
        transition: color 0.2s ease;
    }

    .register-footer a:hover {
        color: #3730A3;
        text-decoration: none;
    }

    @media(max-width: 576px) {
        .register-header {
            padding: 35px 25px 10px;
        }
        .card-body {
            padding: 25px !important;
        }
    }
</style>

<div class="container register-wrapper">
    <div class="row justify-content-center w-100">
        <div class="col-lg-5 col-md-7 col-sm-10 col-12">

            <div class="card register-card">
                <div class="card-header register-header text-center">
                    <div class="register-icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h3 class="register-title mb-2">Daftar Akun Baru</h3>
                    <p class="register-subtitle mb-0">
                        Buat username anonim Anda untuk mulai menggunakan aplikasi monitoring kesehatan mental dengan aman.
                    </p>
                </div>

                <div class="card-body p-4 pt-2">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="username" class="form-label">Username (Nama Samaran)</label>
                            <div class="input-group @error('username') is-invalid-group @enderror">
                                <span class="input-group-text">
                                    <i class="bi bi-person-badge"></i>
                                </span>
                                <input
                                    type="text"
                                    class="form-control @error('username') is-invalid @enderror"
                                    id="username"
                                    name="username"
                                    value="{{ old('username') }}"
                                    placeholder="Buat username unik (contoh: user123)"
                                    required
                                    autofocus>
                            </div>
                            @error('username')
                                <div class="invalid-feedback d-block mt-2 px-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group @error('password') is-invalid-group @enderror">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="Masukkan password"
                                    required>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block mt-2 px-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-shield-lock"></i>
                                </span>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Ulangi password"
                                    required>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-register text-white">
                                <i class="bi bi-person-check-fill me-2"></i>
                                Daftar Sekarang
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4 register-footer">
                        <small class="text-muted">
                            Sudah memiliki akun? 
                            <a href="{{ route('login') }}">Login di sini</a>
                        </small>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection