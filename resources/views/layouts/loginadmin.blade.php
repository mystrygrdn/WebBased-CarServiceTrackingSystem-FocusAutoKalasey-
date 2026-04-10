<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - FocusAuto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        width: 100%;
        max-width: 1000px;
        display: flex;
        overflow: hidden;
    }

    /* Left Side - Form */
    .form-side {
        flex: 1;
        padding: 60px 50px;
    }

    .logo {
        margin-bottom: 40px;
    }

    .logo img {
        height: 50px;
    }

    h1 {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .subtitle {
        font-size: 15px;
        color: #6b7280;
        margin-bottom: 36px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .input-wrapper {
        position: relative;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        height: 50px;
        padding: 0 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.2s;
        background: #f9fafb;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        outline: none;
        border-color: #d9a10b;
        background: white;
    }

    input::placeholder {
        color: #9ca3af;
    }

    .password-toggle {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6b7280;
        cursor: pointer;
        padding: 6px;
    }

    .password-toggle:hover {
        color: #374151;
    }

    .password-toggle i {
        font-size: 20px;
    }

    .btn-login {
        width: 100%;
        height: 52px;
        background: #d9a10b;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 32px;
        transition: all 0.2s;
    }

    .btn-login:hover {
        background: #c49209;
        transform: translateY(-1px);
    }

    /* Right Side - Illustration */
    .illustration-side {
        flex: 1;
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 40px;
        position: relative;
    }

    .illustration-wrapper {
        text-align: center;
        position: relative;
    }

    .car-circle {
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    .car-illustration {
        width: 240px;
        height: auto;
        filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.15));
    }

    .decoration-icon {
        position: absolute;
        color: rgba(255, 255, 255, 0.9);
        font-size: 40px;
    }

    .icon-wrench {
        top: 20%;
        right: 15%;
    }

    .icon-bolt {
        bottom: 25%;
        left: 10%;
    }

    /* Alert */
    .alert {
        border-radius: 10px;
        padding: 14px 18px;
        margin-bottom: 24px;
        font-size: 14px;
        border: none;
    }

    .alert-danger {
        background: #fef2f2;
        color: #dc2626;
    }

    .alert-warning {
        background: #fffbeb;
        color: #d97706;
    }

    .alert-success {
        background: #f0fdf4;
        color: #16a34a;
    }

    .alert i {
        margin-right: 8px;
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .login-card {
            flex-direction: column;
            max-width: 500px;
        }

        .form-side {
            padding: 40px 32px;
        }

        .illustration-side {
            padding: 40px;
            min-height: 300px;
        }

        .car-circle {
            width: 240px;
            height: 240px;
        }

        .car-illustration {
            width: 180px;
        }

        .decoration-icon {
            font-size: 32px;
        }
    }

    @media (max-width: 576px) {
        body {
            padding: 16px;
        }

        .form-side {
            padding: 32px 24px;
        }

        h1 {
            font-size: 28px;
        }

        .logo img {
            height: 42px;
        }

        .illustration-side {
            display: none;
        }
    }
    </style>
</head>

<body>

    <div class="login-card">
        <!-- Left Side - Form -->
        <div class="form-side">
            <div class="logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="FocusAuto">
            </div>

            <h1>Login Admin</h1>
            <p class="subtitle">Silakan masuk untuk melanjutkan</p>

            {{-- ALERT ERROR LOGIN --}}
            @if ($errors->has('login'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> {{ $errors->first('login') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- TIMEOUT MESSAGE --}}
            @if(session('timeout'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-clock-history"></i> {{ session('timeout') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- ERROR MESSAGE --}}
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- LOGOUT MESSAGE --}}
            @if(session('logout'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('logout') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- VALIDATION ERRORS --}}
            @if ($errors->has('username') || $errors->has('password'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @error('username')
                    <li>{{ $message }}</li>
                    @enderror
                    @error('password')
                    <li>{{ $message }}</li>
                    @enderror
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <form action="{{ url('/loginadmin') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username"
                        value="{{ old('username') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                        <button type="button" class="password-toggle" id="toggleBtn">
                            <i class="bi bi-eye-slash" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login">Masuk</button>
            </form>
        </div>

        <!-- Right Side - Illustration -->
        <div class="illustration-side">
            <i class="bi bi-wrench decoration-icon icon-wrench"></i>
            <i class="bi bi-lightning-charge-fill decoration-icon icon-bolt"></i>

            <div class="illustration-wrapper">
                <div class="car-circle">
                    <img src="{{ asset('assets/img/car.png') }}" alt="Car" class="car-illustration">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    const toggleBtn = document.getElementById('toggleBtn');
    const password = document.getElementById('password');
    const icon = document.getElementById('toggleIcon');

    toggleBtn.addEventListener('click', function(e) {
        e.preventDefault();

        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            password.type = 'password';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    });
    </script>

</body>

</html>