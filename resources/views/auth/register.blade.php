<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindScreen - Daftar Akun Baru</title>
    
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
            --bg-soft: #F4F7F6;
            --text-main: #2D3748;
            --text-muted: #64748B;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at 50% 30%, #E8F0EC 0%, #F4F7F6 100%);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
        }

        .register-wrapper {
            width: 100%;
            padding: 30px 15px;
        }

        .register-card {
            border: 1px solid rgba(203, 213, 208, 0.6);
            border-radius: 24px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 
                0 4px 6px -1px rgba(74, 122, 109, 0.03),
                0 20px 30px -5px rgba(74, 122, 109, 0.08);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .register-card:hover {
            transform: translateY(-4px);
            box-shadow: 
                0 10px 15px -3px rgba(74, 122, 109, 0.05),
                0 25px 35px -5px rgba(74, 122, 109, 0.12);
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
            border-radius: 18px;
            background: linear-gradient(135deg, #4A7A6D 0%, #6B9080 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            box-shadow: 0 8px 20px rgba(74, 122, 109, 0.25);
            transition: transform 0.3s ease;
        }
        
        .register-card:hover .register-icon {
            transform: scale(1.05) rotate(-5deg);
        }

        .register-title {
            font-weight: 800;
            color: #2D3748;
            letter-spacing: -0.5px;
        }

        .register-subtitle {
            color: #64748B;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5;
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
            border-color: #4A7A6D;
            box-shadow: 0 0 0 4px rgba(74, 122, 109, 0.15);
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

        /* Error state */
        .input-group.is-invalid-group {
            border-color: #E53E3E;
        }
        .input-group.is-invalid-group:focus-within {
            box-shadow: 0 0 0 4px rgba(229, 62, 62, 0.15);
        }

        .btn-register {
            height: 50px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 15px;
            letter-spacing: 0.2px;
            background: linear-gradient(135deg, #4A7A6D 0%, #6B9080 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(74, 122, 109, 0.2);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #3B6358 0%, #4A7A6D 100%);
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 8px 20px rgba(74, 122, 109, 0.3);
        }
        
        .btn-register:active {
            transform: translateY(0);
        }

        .register-footer a {
            text-decoration: none;
            font-weight: 600;
            color: #4A7A6D;
            transition: color 0.2s ease;
        }

        .register-footer a:hover {
            color: #3B6358;
            text-decoration: underline;
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
</head>
<body>

<div class="register-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 col-sm-10 col-12">

                <div class="card register-card">
                    <div class="card-header register-header text-center">
                        <div class="register-icon">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <h3 class="register-title mb-2">Daftar Akun Baru</h3>
                        <p class="register-subtitle mb-0">
                            Buat username anonim Anda untuk mulai menggunakan aplikasi monitoring kesehatan mental.
                        </p>
                    </div>

                    <div class="card-body p-4 pt-2">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Username Field -->
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

                            <!-- Password Field -->
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

                            <!-- Password Confirmation Field -->
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

                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-register">
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>