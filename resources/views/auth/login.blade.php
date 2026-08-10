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
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at 50% 30%, #E8F0EC 0%, #F4F7F6 100%);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            width: 100%;
            padding: 20px 15px;
        }

        .login-card {
            border: 1px solid rgba(203, 213, 208, 0.6);
            border-radius: 24px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 
                0 4px 6px -1px rgba(74, 122, 109, 0.03),
                0 20px 30px -5px rgba(74, 122, 109, 0.08);
            transition: all 0.4s ease;
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
            background: linear-gradient(135deg, #4A7A6D 0%, #6B9080 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            box-shadow: 0 8px 20px rgba(74, 122, 109, 0.25);
        }

        .login-title {
            font-weight: 800;
            color: #2D3748;
            letter-spacing: -0.5px;
        }

        .login-subtitle {
            color: #64748B;
            font-size: 14.5px;
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
            overflow: hidden;
            transition: all 0.3s ease;
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
            box-shadow: none;
        }

        .form-control::placeholder {
            color: #94A3B8;
            font-size: 14px;
        }

        .btn-login {
            height: 50px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 15px;
            background: linear-gradient(135deg, #4A7A6D 0%, #6B9080 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(74, 122, 109, 0.2);
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #3B6358 0%, #4A7A6D 100%);
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 8px 20px rgba(74, 122, 109, 0.3);
        }

        .login-footer a {
            text-decoration: none;
            font-weight: 600;
            color: #4A7A6D;
        }

        .login-footer a:hover {
            color: #3B6358;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    @include('components.theme-toggle')

<div class="login-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-9 col-12">

                <div class="card login-card">
                    <div class="card-header login-header text-center">
                        <div class="login-icon">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </div>
                        <h3 class="login-title mb-2">Selamat Datang</h3>
                        <div class="login-subtitle">
                            Login ke Aplikasi Monitoring Kesehatan Mental
                        </div>
                    </div>

                    <div class="card-body p-4 pt-2">
                        <form action="{{ url('/login') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username Anda" required autofocus>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-login">
                                    <i class="bi bi-box-arrow-in-right me-2"></i> Masuk
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4 login-footer">
                            <small class="text-muted">
                                Belum memiliki akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                            </small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>