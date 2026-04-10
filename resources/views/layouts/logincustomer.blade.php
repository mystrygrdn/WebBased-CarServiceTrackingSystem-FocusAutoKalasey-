<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Customer - FocusAuto</title>

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

    input[type="text"] {
        width: 100%;
        height: 50px;
        padding: 0 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.2s;
        background: #f9fafb;
    }

    input[type="text"]:focus {
        outline: none;
        border-color: #d9a10b;
        background: white;
    }

    input::placeholder {
        color: #9ca3af;
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
    }

    .customer-circle {
        width: 380px;
        height: 380px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .customer-illustration {
        width: 310px;
        height: auto;
        filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.15));
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

        .customer-circle {
            width: 240px;
            height: 240px;
        }

        .customer-illustration {
            width: 180px;
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

            <h1>Login Customer</h1>
            <p class="subtitle">Masuk untuk melihat status servis & invoice</p>

            {{-- VALIDATION ERRORS --}}
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
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

            <form action="{{ url('/logincustomer') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nomor_polisi">Nomor Polisi</label>
                    <input type="text" id="nomor_polisi" name="nomor_polisi" placeholder="Contoh: DB 1234 AB"
                        value="{{ old('nomor_polisi') }}" required>
                </div>

                <button type="submit" class="btn-login">Masuk</button>
            </form>
        </div>

        <!-- Right Side - Illustration -->
        <div class="illustration-side">
            <div class="customer-circle">
                <img src="{{ asset('assets/img/customer.png') }}" alt="Customer" class="customer-illustration">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>