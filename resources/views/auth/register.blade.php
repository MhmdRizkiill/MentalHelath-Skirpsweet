<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindScreen - Daftar Akun Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary:#4A7A6D;
            --primary-hover:#3B6358;
            --secondary:#6B9080;
            --page-bg-start:#E8F0EC;
            --page-bg-end:#F4F7F6;
            --card-bg:rgba(255,255,255,.92);
            --card-border:rgba(203,213,208,.6);
            --text-main:#2D3748;
            --text-muted:#64748B;
            --label-text:#334155;
            --input-bg:#FFFFFF;
            --input-border:#CBD5E1;
            --input-text:#1E293B;
            --placeholder:#94A3B8;
        }

        * { box-sizing:border-box; }

        html,body { min-height:100%; }

        body {
            font-family:'Plus Jakarta Sans',sans-serif;
            background:radial-gradient(circle at 50% 30%,var(--page-bg-start) 0%,var(--page-bg-end) 100%);
            min-height:100vh;
            margin:0;
            display:flex;
            align-items:center;
            justify-content:center;
            color:var(--text-main);
            transition:background .35s ease,color .35s ease;
        }

        .register-wrapper { width:100%; padding:30px 15px; }

        .register-card {
            border:1px solid var(--card-border);
            border-radius:24px;
            overflow:hidden;
            background:var(--card-bg);
            backdrop-filter:blur(16px);
            -webkit-backdrop-filter:blur(16px);
            box-shadow:0 4px 6px -1px rgba(74,122,109,.03),0 20px 30px -5px rgba(74,122,109,.08);
            transition:transform .4s cubic-bezier(.16,1,.3,1),box-shadow .4s ease,background .35s ease,border-color .35s ease;
        }

        .register-card:hover {
            transform:translateY(-4px);
            box-shadow:0 10px 15px -3px rgba(74,122,109,.05),0 25px 35px -5px rgba(74,122,109,.12);
        }

        .register-header { padding:40px 40px 15px;border-bottom:none;background:transparent; }

        .register-icon {
            width:64px;
            height:64px;
            margin:0 auto 20px;
            border-radius:18px;
            background:linear-gradient(135deg,var(--primary) 0%,var(--secondary) 100%);
            color:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:26px;
            box-shadow:0 8px 20px rgba(74,122,109,.25);
            transition:transform .3s ease,box-shadow .35s ease;
        }

        .register-card:hover .register-icon { transform:scale(1.05) rotate(-5deg); }

        .register-title {
            font-weight:800;
            color:var(--text-main);
            letter-spacing:-.5px;
            transition:color .35s ease;
        }

        .register-subtitle {
            color:var(--text-muted);
            font-size:14px;
            font-weight:400;
            line-height:1.5;
            transition:color .35s ease;
        }

        .form-label {
            font-weight:600;
            color:var(--label-text);
            font-size:14px;
            margin-bottom:8px;
            transition:color .35s ease;
        }

        .input-group {
            border:1px solid var(--input-border);
            border-radius:14px;
            background:var(--input-bg);
            transition:border-color .3s ease,box-shadow .3s ease,background .35s ease;
            overflow:hidden;
        }

        .input-group:focus-within {
            border-color:var(--primary);
            box-shadow:0 0 0 4px rgba(74,122,109,.15);
        }

        .input-group.is-invalid-group { border-color:#E53E3E; }

        .input-group.is-invalid-group:focus-within {
            box-shadow:0 0 0 4px rgba(229,62,62,.15);
        }

        .input-group-text {
            background:transparent;
            border:none;
            color:var(--placeholder);
            padding-left:16px;
            padding-right:10px;
            transition:color .35s ease;
        }

        .form-control {
            border:none;
            border-radius:0 14px 14px 0;
            height:50px;
            padding-left:6px;
            font-size:15px;
            color:var(--input-text);
            background:transparent;
            transition:color .35s ease;
        }

        .form-control:focus { background:transparent;box-shadow:none;border:none; }
        .form-control::placeholder { color:var(--placeholder);font-size:14px; }

        .btn-register {
            height:50px;
            border-radius:14px;
            font-weight:600;
            font-size:15px;
            letter-spacing:.2px;
            background:linear-gradient(135deg,var(--primary) 0%,var(--secondary) 100%);
            border:none;
            color:#fff;
            box-shadow:0 4px 15px rgba(74,122,109,.2);
            transition:all .3s cubic-bezier(.16,1,.3,1);
        }

        .btn-register:hover {
            background:linear-gradient(135deg,var(--primary-hover) 0%,var(--primary) 100%);
            transform:translateY(-2px);
            color:#fff;
            box-shadow:0 8px 20px rgba(74,122,109,.3);
        }

        .btn-register:active { transform:translateY(0); }

        .register-footer a {
            text-decoration:none;
            font-weight:600;
            color:var(--primary);
            transition:color .2s ease;
        }

        .register-footer a:hover { color:var(--primary-hover);text-decoration:underline; }

        /* DARK MODE */
        html[data-bs-theme="dark"] {
            --primary:#6BB29E;
            --primary-hover:#83C5B3;
            --secondary:#5FA18E;
            --page-bg-start:#172A25;
            --page-bg-end:#0F172A;
            --card-bg:rgba(30,41,59,.94);
            --card-border:rgba(71,85,105,.65);
            --text-main:#F1F5F9;
            --text-muted:#A8B4C3;
            --label-text:#CBD5E1;
            --input-bg:#111827;
            --input-border:#475569;
            --input-text:#F8FAFC;
            --placeholder:#94A3B8;
        }

        html[data-bs-theme="dark"] body {
            background:radial-gradient(circle at 50% 20%,rgba(74,122,109,.20) 0%,rgba(15,23,42,.95) 45%,#080D17 100%);
            color:#F1F5F9;
        }

        html[data-bs-theme="dark"] .register-card {
            background:var(--card-bg);
            border-color:var(--card-border);
            box-shadow:0 10px 30px rgba(0,0,0,.25),0 25px 60px rgba(0,0,0,.22);
        }

        html[data-bs-theme="dark"] .register-card:hover {
            box-shadow:0 15px 35px rgba(0,0,0,.30),0 30px 65px rgba(0,0,0,.28);
        }

        html[data-bs-theme="dark"] .register-icon { box-shadow:0 10px 25px rgba(0,0,0,.28); }
        html[data-bs-theme="dark"] .register-title { color:#F8FAFC; }
        html[data-bs-theme="dark"] .register-subtitle { color:#A8B4C3; }
        html[data-bs-theme="dark"] .form-label { color:#CBD5E1; }

        html[data-bs-theme="dark"] .input-group {
            background:#111827;
            border-color:#475569;
        }

        html[data-bs-theme="dark"] .input-group:focus-within {
            border-color:#6BB29E;
            box-shadow:0 0 0 4px rgba(107,178,158,.15);
        }

        html[data-bs-theme="dark"] .input-group-text { color:#94A3B8; }
        html[data-bs-theme="dark"] .form-control { color:#F8FAFC;background:transparent; }
        html[data-bs-theme="dark"] .form-control:focus { color:#F8FAFC;background:transparent; }
        html[data-bs-theme="dark"] .form-control::placeholder { color:#64748B; }
        html[data-bs-theme="dark"] .register-footer .text-muted { color:#94A3B8!important; }
        html[data-bs-theme="dark"] .register-footer a { color:#83C5B3; }
        html[data-bs-theme="dark"] .register-footer a:hover { color:#A3D8CA; }
        html[data-bs-theme="dark"] .invalid-feedback { color:#FCA5A5; }

        @media(max-width:576px) {
            .register-wrapper { padding:15px; }
            .register-card { border-radius:20px; }
            .register-header { padding:35px 25px 10px; }
            .card-body { padding:25px!important; }
            .register-icon { width:58px;height:58px;font-size:23px;border-radius:16px; }
            .register-title { font-size:1.45rem; }
            .register-subtitle { font-size:13px; }
        }
    </style>
</head>
<body>
    @include('components.theme-toggle')

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

                                <div class="mb-4">
                                    <label for="username" class="form-label">Username (Nama Samaran)</label>
                                    <div class="input-group @error('username') is-invalid-group @enderror">
                                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" placeholder="Buat username unik (contoh: user123)" required autofocus>
                                    </div>
                                    @error('username')
                                        <div class="invalid-feedback d-block mt-2 px-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group @error('password') is-invalid-group @enderror">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password" required>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block mt-2 px-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                                    </div>
                                </div>

                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-register">
                                        <i class="bi bi-person-check-fill me-2"></i>Daftar Sekarang
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