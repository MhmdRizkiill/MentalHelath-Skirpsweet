<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindScreen - Masuk</title>
    
 <!-- Bootstrap 5 CSS & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #4A7A6D;
        --primary-hover: #3B6358;
        --secondary: #6B9080;
        --text-main: #2D3748;
        --text-muted: #64748B;
        --page-bg-start: #E8F0EC;
        --page-bg-end: #F4F7F6;
        --card-bg: rgba(255, 255, 255, 0.92);
        --card-border: rgba(203, 213, 208, 0.6);
        --input-bg: #FFFFFF;
        --input-border: #CBD5E1;
        --input-text: #1E293B;
        --label-text: #334155;
        --placeholder: #94A3B8;
    }

    /* ================================
       LIGHT MODE
       ================================ */

    html,
    body {
        min-height: 100%;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: radial-gradient(
            circle at 50% 30%,
            var(--page-bg-start) 0%,
            var(--page-bg-end) 100%
        );
        min-height: 100vh;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-main);
        transition:
            background 0.35s ease,
            color 0.35s ease;
    }

    .login-wrapper {
        width: 100%;
        padding: 20px 15px;
    }

    .login-card {
        border: 1px solid var(--card-border);
        border-radius: 24px;
        overflow: hidden;
        background: var(--card-bg);
        box-shadow:
            0 4px 6px -1px rgba(74, 122, 109, 0.03),
            0 20px 30px -5px rgba(74, 122, 109, 0.08);
        transition:
            transform 0.4s ease,
            box-shadow 0.4s ease,
            background 0.35s ease,
            border-color 0.35s ease;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }

    .login-card:hover {
        transform: translateY(-4px);
        box-shadow:
            0 10px 15px -3px rgba(74, 122, 109, 0.05),
            0 25px 35px -5px rgba(74, 122, 109, 0.12);
    }

    .login-header {
        padding: 40px 40px 15px;
        border-bottom: none;
        background: transparent;
    }

    .login-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 20px;
        border-radius: 18px;
        background: linear-gradient(
            135deg,
            var(--primary) 0%,
            var(--secondary) 100%
        );
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        box-shadow: 0 8px 20px rgba(74, 122, 109, 0.25);
        transition: box-shadow 0.35s ease;
    }

    .login-title {
        font-weight: 800;
        color: var(--text-main);
        letter-spacing: -0.5px;
        transition: color 0.35s ease;
    }

    .login-subtitle {
        color: var(--text-muted);
        font-size: 14.5px;
        transition: color 0.35s ease;
    }

    .form-label {
        font-weight: 600;
        color: var(--label-text);
        font-size: 14px;
        margin-bottom: 8px;
        transition: color 0.35s ease;
    }

    .input-group {
        border: 1px solid var(--input-border);
        border-radius: 14px;
        background: var(--input-bg);
        overflow: hidden;
        transition:
            border-color 0.3s ease,
            box-shadow 0.3s ease,
            background 0.35s ease;
    }

    .input-group:focus-within {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(74, 122, 109, 0.15);
    }

    .input-group-text {
        background: transparent;
        border: none;
        color: var(--placeholder);
        padding-left: 16px;
        padding-right: 10px;
        transition: color 0.35s ease;
    }

    .form-control {
        border: none;
        border-radius: 0 14px 14px 0;
        height: 50px;
        padding-left: 6px;
        font-size: 15px;
        color: var(--input-text);
        background: transparent;
        transition: color 0.35s ease;
    }

    .form-control:focus {
        box-shadow: none;
        background: transparent;
    }

    .form-control::placeholder {
        color: var(--placeholder);
        font-size: 14px;
    }

    .btn-login {
        height: 50px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 15px;
        background: linear-gradient(
            135deg,
            var(--primary) 0%,
            var(--secondary) 100%
        );
        border: none;
        color: white;
        box-shadow: 0 4px 15px rgba(74, 122, 109, 0.2);
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        background: linear-gradient(
            135deg,
            var(--primary-hover) 0%,
            var(--primary) 100%
        );
        transform: translateY(-2px);
        color: white;
        box-shadow: 0 8px 20px rgba(74, 122, 109, 0.3);
    }

    .login-footer a {
        text-decoration: none;
        font-weight: 600;
        color: var(--primary);
        transition: color 0.25s ease;
    }

    .login-footer a:hover {
        color: var(--primary-hover);
        text-decoration: underline;
    }

    /* ================================
       DARK MODE
       ================================ */

    html[data-bs-theme="dark"] {
        --primary: #6BB29E;
        --primary-hover: #83C5B3;
        --secondary: #5FA18E;

        --text-main: #F1F5F9;
        --text-muted: #A8B4C3;

        --page-bg-start: #172A25;
        --page-bg-end: #0F172A;

        --card-bg: rgba(30, 41, 59, 0.94);
        --card-border: rgba(71, 85, 105, 0.65);

        --input-bg: #111827;
        --input-border: #475569;
        --input-text: #F1F5F9;
        --label-text: #CBD5E1;
        --placeholder: #94A3B8;
    }

    html[data-bs-theme="dark"] body {
        background:
            radial-gradient(
                circle at 50% 20%,
                rgba(74, 122, 109, 0.20) 0%,
                rgba(15, 23, 42, 0.95) 45%,
                #080D17 100%
            );
        color: #F1F5F9;
    }

    html[data-bs-theme="dark"] .login-card {
        background: var(--card-bg);
        border-color: var(--card-border);
        box-shadow:
            0 10px 30px rgba(0, 0, 0, 0.25),
            0 25px 60px rgba(0, 0, 0, 0.22);
    }

    html[data-bs-theme="dark"] .login-card:hover {
        box-shadow:
            0 15px 35px rgba(0, 0, 0, 0.30),
            0 30px 65px rgba(0, 0, 0, 0.28);
    }

    html[data-bs-theme="dark"] .login-icon {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.28);
    }

    html[data-bs-theme="dark"] .login-title {
        color: #F8FAFC;
    }

    html[data-bs-theme="dark"] .login-subtitle {
        color: #A8B4C3;
    }

    html[data-bs-theme="dark"] .form-label {
        color: #CBD5E1;
    }

    html[data-bs-theme="dark"] .input-group {
        background: #111827;
        border-color: #475569;
    }

    html[data-bs-theme="dark"] .input-group:focus-within {
        border-color: #6BB29E;
        box-shadow: 0 0 0 4px rgba(107, 178, 158, 0.15);
    }

    html[data-bs-theme="dark"] .input-group-text {
        color: #94A3B8;
    }

    html[data-bs-theme="dark"] .form-control {
        color: #F8FAFC;
        background: transparent;
    }

    html[data-bs-theme="dark"] .form-control:focus {
        color: #F8FAFC;
        background: transparent;
    }

    html[data-bs-theme="dark"] .form-control::placeholder {
        color: #64748B;
    }

    html[data-bs-theme="dark"] .login-footer .text-muted {
        color: #94A3B8 !important;
    }

    html[data-bs-theme="dark"] .login-footer a {
        color: #83C5B3;
    }

    html[data-bs-theme="dark"] .login-footer a:hover {
        color: #A3D8CA;
    }

    /* ================================
       RESPONSIVE
       ================================ */

    @media (max-width: 576px) {
        .login-wrapper {
            padding: 15px;
        }

        .login-card {
            border-radius: 20px;
        }

        .login-header {
            padding: 32px 25px 12px;
        }

        .login-card .card-body {
            padding: 24px !important;
        }

        .login-icon {
            width: 58px;
            height: 58px;
            font-size: 23px;
            border-radius: 16px;
        }

        .login-title {
            font-size: 1.45rem;
        }

        .login-subtitle {
            font-size: 13px;
            line-height: 1.6;
        }
    }
</style>

{{-- Theme Toggle --}}
@include('components.theme-toggle')

<div class="login-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">

                <div class="card login-card">
                    <div class="card-header login-header text-center">
                        <div class="login-icon">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </div>

                        <h3 class="login-title mb-2">
                            Selamat Datang
                        </h3>

                        <div class="login-subtitle">
                            Login ke Aplikasi Monitoring Kesehatan Mental
                        </div>
                    </div>

                    <div class="card-body p-4 pt-2">
                        <form action="{{ url('/login') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="username" class="form-label">
                                    Username
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person"></i>
                                    </span>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="username"
                                        name="username"
                                        placeholder="Masukkan Username Anda"
                                        required
                                        autofocus
                                    >
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">
                                    Password
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>

                                    <input
                                        type="password"
                                        class="form-control"
                                        id="password"
                                        name="password"
                                        placeholder="Masukkan Password"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-login">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Masuk
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4 login-footer">
                            <small class="text-muted">
                                Belum memiliki akun?
                                <a href="{{ route('register') }}">
                                    Daftar sekarang
                                </a>
                            </small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>