<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Luxury Bridal</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-gold: #c5a880;
            --primary-gold-hover: #b09167;
            --dark-bg: #121212;
            --dark-card: #1e1e1e;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--dark-bg);
            color: #e0e0e0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: linear-gradient(rgba(18, 18, 18, 0.9), rgba(18, 18, 18, 0.9)), url('https://images.unsplash.com/photo-1594552072238-16e7887fc15a?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
        .login-card {
            background-color: rgba(30, 30, 30, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(197, 168, 128, 0.3);
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
        }
        .logo {
            color: var(--primary-gold);
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            letter-spacing: 2px;
            margin-bottom: 30px;
            text-transform: uppercase;
        }
        .form-control {
            background-color: rgba(0,0,0,0.5);
            border: 1px solid rgba(255,255,255,0.1);
            color: #fff;
            padding: 12px 15px;
        }
        .form-control:focus {
            background-color: rgba(0,0,0,0.7);
            border-color: var(--primary-gold);
            color: #fff;
            box-shadow: 0 0 0 0.25rem rgba(197, 168, 128, 0.25);
        }
        .btn-gold {
            background-color: var(--primary-gold);
            border-color: var(--primary-gold);
            color: #fff;
            font-weight: 600;
            padding: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .btn-gold:hover {
            background-color: var(--primary-gold-hover);
            border-color: var(--primary-gold-hover);
            color: #fff;
        }
        .form-label {
            font-weight: 500;
            color: #ccc;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo">
            RaniSahab
        </div>
        <h5 class="text-center mb-4 fw-light text-white">Admin Secure Login</h5>
        
        @if($errors->any())
            <div class="alert alert-danger border-0 bg-danger text-white bg-opacity-25 rounded-3">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 text-muted"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control border-start-0 ps-0" id="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 text-muted"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" required>
                </div>
            </div>
            
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label text-muted" for="remember">Remember Me</label>
                </div>
                <a href="#" class="text-decoration-none" style="color: var(--primary-gold);">Forgot Password?</a>
            </div>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-gold rounded-pill">
                    Sign In <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </form>
    </div>
</body>
</html>
