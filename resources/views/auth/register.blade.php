<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MindScreen</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #F4F7F6;
            --bg-secondary: #E8F0EC;
            --card: #FFFFFF;
            --text: #2D3748;
            --text-secondary: #64748B;
            --border: #CBD5E1;
            --input: #FFFFFF;
            --primary: #4A7A6D;
            --primary-dark: #3B6358;
            --primary-light: #6B9080;
        }

        html[data-bs-theme="dark"] {
            --bg: #0F172A;
            --bg-secondary: #172235;
            --card: #1E293B;
            --text: #F8FAFC;
            --text-secondary: #94A3B8;
            --border: #475569;
            --input: #172033;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(
                circle at 50% 30%,
                var(--bg-secondary) 0%,
                var(--bg) 100%
            );
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
        }

        html[data-bs-theme="dark"] body {
            background: radial-gradient(
                circle at 50% 30%,
                #172235 0%,
                #0F172A 100%
            );
            color: var(--text);
        }

        /* Register */
        .register-wrapper {
            width: 100%;
            padding: 30px 15px;
        }

        .register-card {
            width: 100%;
            max-width: 520px;
            margin: auto;
            border: 1px solid var(--border);
            border-radius: 24px;
            overflow: hidden;
            background: var(--card);
            color: var(--text);
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .register-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.12);
        }

        .register-header {
            padding: 35px 40px 15px;
            text-align: center;
            background: transparent;
            border: 0;
        }

        .register-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 18px;
            border-radius: 18px;
            background: linear-gradient(
                135deg,
                var(--primary),
                var(--primary-light)
            );
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            box-shadow: 0 8px 20px rgba(74, 122, 109, 0.25);
        }

        .register-title {
            font-weight: 800;
            color: var(--text);
            letter-spacing: -0.5px;
        }

        .register-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* Form */
        .form-label {
            font-weight: 600;
            color: var(--text);
            font-size: 14px;
            margin-bottom: 8px;
        }

        .input-group {
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--input);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .input-group:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(74, 122, 109, 0.15);
        }

        .input-group-text {
            background: transparent;
            border: 0;
            color: #94A3B8;
            padding-left: 16px;
            padding-right: 10px;
        }

        .form-control {
            border: 0;
            border-radius: 0 14px 14px 0;
            height: 50px;
            padding-left: 6px;
            font-size: 14px;
            color: var(--text);
            background: transparent;
        }

        .form-control:focus {
            box-shadow: none;
            background: transparent;
            color: var(--text);
        }

        .form-control::placeholder {
            color: #94A3B8;
            font-size: 13px;
        }

        /* Button */
        .btn-register {
            height: 50px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 15px;
            background: linear-gradient(
                135deg,
                var(--primary),
                var(--primary-light)
            );
            border: none;
            color: #FFFFFF;
            box-shadow: 0 4px 15px rgba(74, 122, 109, 0.2);
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background: linear-gradient(
                135deg,
                var(--primary-dark),
                var(--primary)
            );
            transform: translateY(-2px);
            color: #FFFFFF;
            box-shadow: 0 8px 20px rgba(74, 122, 109, 0.3);
        }

        /* Footer */
        .register-footer {
            color: var(--text-secondary);
        }

        .register-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .register-footer a:hover {
            color: #83C5B3;
            text-decoration: underline;
        }

        /* Dark Mode */
        html[data-bs-theme="dark"] .register-card {
            background: #1E293B !important;
            color: #F8FAFC !important;
            border-color: #334155 !important;
        }

        html[data-bs-theme="dark"] .register-title,
        html[data-bs-theme="dark"] .form-label {
            color: #F8FAFC !important;
        }

        html[data-bs-theme="dark"] .register-subtitle,
        html[data-bs-theme="dark"] .register-footer {
            color: #94A3B8 !important;
        }

        html[data-bs-theme="dark"] .input-group {
            background: #172033 !important;
            border-color: #475569 !important;
        }

        html[data-bs-theme="dark"] .form-control {
            background: transparent !important;
            color: #F8FAFC !important;
        }

        html[data-bs-theme="dark"] .form-control::placeholder {
            color: #64748B !important;
        }

        html[data-bs-theme="dark"] .input-group-text {
            color: #94A3B8 !important;
        }

        html[data-bs-theme="dark"] .register-footer a {
            color: #83C5B3 !important;
        }

        /* Theme Toggle */
        .theme-toggle-auth {
            position: fixed;
            top: 24px;
            right: 24px;
            width: 50px;
            height: 50px;
            padding: 0;
            border: 1px solid rgba(203, 213, 208, 0.7);
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.95);
            color: #2D3748;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 99999;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(12px);
            transition: all 0.3s ease;
        }

        .theme-toggle-auth i {
            font-size: 21px;
            line-height: 1;
        }

        .theme-toggle-auth:hover {
            transform: translateY(-2px) rotate(8deg);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        html[data-bs-theme="dark"] .theme-toggle-auth {
            background: #1E293B !important;
            border-color: #475569 !important;
            color: #F8FAFC !important;
        }

        html[data-bs-theme="dark"] .theme-toggle-auth:hover {
            color: #83C5B3 !important;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .theme-toggle-auth {
                top: 15px;
                right: 15px;
                width: 46px;
                height: 46px;
            }

            .theme-toggle-auth i {
                font-size: 19px;
            }

            .register-wrapper {
                padding: 25px 15px;
            }

            .register-header {
                padding: 30px 25px 15px;
            }
        }
    </style>

    <script>
        (function () {
            const html = document.documentElement;
            const savedTheme = localStorage.getItem('theme');
            const systemDark = window.matchMedia(
                '(prefers-color-scheme: dark)'
            ).matches;

            const theme = savedTheme || (systemDark ? 'dark' : 'light');
            html.setAttribute('data-bs-theme', theme);
        })();
    </script>
</head>

<body>

    <!-- Theme Toggle -->
    <button
        type="button"
        class="theme-toggle-auth"
        id="authThemeToggle"
        aria-label="Ganti tema"
    >
        <i class="bi bi-moon-stars-fill" id="authThemeIcon"></i>
    </button>

    <!-- Register -->
    <div class="register-wrapper">
        <div class="register-card">

            <!-- Header -->
            <div class="register-header">
                <div class="register-icon">
                    <i class="bi bi-person-plus-fill"></i>
                </div>

                <h3 class="register-title mb-2">
                    Buat Akun
                </h3>

                <div class="register-subtitle">
                    Daftar untuk menggunakan Aplikasi Monitoring Kesehatan Mental
                </div>
            </div>

            <!-- Form -->
            <div class="card-body p-4 pt-2">
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Nama Lengkap
                        </label>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
                            </span>

                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap"
                                required
                            >
                        </div>

                        @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">
                            Username
                        </label>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-badge"></i>
                            </span>

                            <input
                                type="text"
                                class="form-control"
                                id="username"
                                name="username"
                                value="{{ old('username') }}"
                                placeholder="Masukkan username"
                                required
                            >
                        </div>

                        @error('username')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email
                        </label>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>

                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Masukkan email"
                                required
                            >
                        </div>

                        @error('email')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
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
                                placeholder="Masukkan password"
                                required
                            >
                        </div>

                        @error('password')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">
                            Konfirmasi Password
                        </label>

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
                                required
                            >
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="d-grid mt-4">
                        <button
                            type="submit"
                            class="btn btn-register"
                        >
                            <i class="bi bi-person-plus me-2"></i>
                            Daftar
                        </button>
                    </div>
                </form>

                <!-- Footer -->
                <div class="text-center mt-4 register-footer">
                    <small>
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}">
                            Login sekarang
                        </a>
                    </small>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const html = document.documentElement;
            const button = document.getElementById('authThemeToggle');
            const icon = document.getElementById('authThemeIcon');

            function updateTheme(theme) {
                html.setAttribute('data-bs-theme', theme);
                localStorage.setItem('theme', theme);

                if (icon) {
                    icon.className = theme === 'dark'
                        ? 'bi bi-sun-fill'
                        : 'bi bi-moon-stars-fill';
                }
            }

            updateTheme(
                html.getAttribute('data-bs-theme') || 'light'
            );

            if (button) {
                button.addEventListener('click', function () {
                    const currentTheme =
                        html.getAttribute('data-bs-theme') || 'light';

                    updateTheme(
                        currentTheme === 'dark'
                            ? 'light'
                            : 'dark'
                    );
                });
            }
        });
    </script>

</body>
</html>