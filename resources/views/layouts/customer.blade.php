<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dashboard Customer')</title>

    {{-- BOOTSTRAP --}}
    <link href="{{ asset('admin/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
    * {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    html {
        height: 100%;
    }

    body {
        background: #fafafa;
        min-height: 100%;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }

    /* Cards */
    .card-flat {
        background: #fff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        border: 1px solid #ebebeb;
    }

    .meta-small {
        font-size: 13px;
        color: #9ca3af;
    }

    /* Auto limit ALL images in cards */
    .card-flat img {
        max-width: 100%;
        max-height: 400px;
        object-fit: contain;
        border-radius: 12px;
        display: block;
        margin: 0 auto;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
        padding: 8px;
    }

    /* Table styling */
    .table-borderless td {
        padding: 10px 0;
        color: #6b7280;
    }

    .table-borderless td:first-child {
        width: 40%;
        font-weight: 500;
    }

    .table-borderless td strong {
        color: #1f2937;
    }

    .photo-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 40px;
        color: #9ca3af;
    }

    .photo-placeholder i {
        font-size: 48px;
        margin-bottom: 16px;
        color: #d1d5db;
    }

    /* Navbar */
    .navbar {
        background: #ffffff !important;
        border-bottom: 1px solid #ebebeb;
        box-shadow: none !important;
        padding: 12px 20px;
    }

    .navbar-logo img {
        width: 120px;
        margin-left: 0;
    }

    /* Topbar Buttons */
    .topbar-btn {
        font-size: 14px;
        font-weight: 600;
        color: #6b7280;
        padding: 10px 24px;
        border-radius: 10px;
        transition: all 0.2s;
        text-decoration: none;
        white-space: nowrap;
    }

    .topbar-btn:hover {
        color: #374151;
        background: #f9fafb;
    }

    .topbar-active {
        background: #fffbf0;
        color: #d97706 !important;
        font-weight: 700;
    }

    .center-menu-absolute {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 8px;
        z-index: 9;
    }

    /* Burger Menu */
    .burger-menu {
        display: none;
        flex-direction: column;
        gap: 4px;
        cursor: pointer;
        padding: 8px;
        border-radius: 8px;
        transition: 0.2s;
    }

    .burger-menu:hover {
        background: #f3f4f6;
    }

    .burger-line {
        width: 24px;
        height: 2.5px;
        background: #374151;
        border-radius: 3px;
        transition: 0.3s;
    }

    .burger-menu.active .burger-line:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }

    .burger-menu.active .burger-line:nth-child(2) {
        opacity: 0;
    }

    .burger-menu.active .burger-line:nth-child(3) {
        transform: rotate(-45deg) translate(6px, -6px);
    }

    /* Mobile Menu */
    .mobile-menu-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .mobile-menu-overlay.active {
        display: block;
        opacity: 1;
    }

    .mobile-menu-panel {
        position: fixed;
        top: 0;
        left: -300px;
        width: 280px;
        height: 100%;
        background: #fff;
        z-index: 1000;
        transition: left 0.3s ease;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
    }

    .mobile-menu-panel.active {
        left: 0;
    }

    .mobile-menu-header {
        padding: 24px 20px;
        border-bottom: 1px solid #ebebeb;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .mobile-menu-close {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.2s;
        font-size: 24px;
        color: #6b7280;
    }

    .mobile-menu-close:hover {
        background: #f3f4f6;
    }

    .mobile-menu-items {
        padding: 16px 0;
    }

    .mobile-menu-item {
        display: flex;
        align-items: center;
        padding: 14px 20px;
        color: #6b7280;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: 0.2s;
        border-left: 3px solid transparent;
    }

    .mobile-menu-item i {
        width: 20px;
        margin-right: 12px;
    }

    .mobile-menu-item:hover {
        background: #f9fafb;
        color: #374151;
    }

    .mobile-menu-item.active {
        background: #fffbf0;
        border-left-color: #d97706;
        color: #d97706;
        font-weight: 600;
    }

    /* Profile */
    .img-profile {
        width: 36px;
        height: 36px;
        border: 2px solid #f3f4f6;
    }

    .nav-link .small {
        font-size: 13px;
    }

    /* Footer */
    footer {
        background: #ffffff;
        border-top: 1px solid #ebebeb;
        padding: 20px 0;
        margin-top: 60px;
    }

    footer .container {
        max-width: 1200px;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .center-menu-absolute {
            gap: 6px;
        }

        .topbar-btn {
            font-size: 13px;
            padding: 10px 20px;
        }

        .navbar-logo img {
            width: 110px;
        }
    }

    @media (max-width: 768px) {
        .navbar-logo img {
            width: 100px;
        }

        .card-flat {
            padding: 20px;
        }

        .photo-preview {
            height: 250px;
        }

        .card-flat img {
            max-height: 320px;
        }
    }

    @media (max-width: 767px) {
        .burger-menu {
            display: flex;
        }

        .center-menu-absolute {
            display: none !important;
        }

        .navbar {
            padding: 12px 16px;
        }
    }

    @media (max-width: 576px) {
        .navbar-logo img {
            width: 90px;
        }

        .card-flat {
            padding: 16px;
        }

        .photo-preview {
            height: 220px;
        }

        .card-flat img {
            max-height: 280px;
        }

        footer {
            font-size: 13px;
        }
    }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand navbar-light topbar static-top">

        <div class="burger-menu" onclick="toggleMobileMenu()">
            <div class="burger-line"></div>
            <div class="burger-line"></div>
            <div class="burger-line"></div>
        </div>

        <a class="navbar-logo d-flex align-items-center" href="{{ url('/dashboardcustomer') }}">
            <img src="{{ asset('assets/img/logo.png')}}" alt="Logo">
        </a>

        <div class="center-menu-absolute">
            <a href="{{ route('customer.dashboard') }}"
                class="topbar-btn {{ str_contains(request()->path(), 'dashboardcustomer') ? 'topbar-active' : '' }}">
                Service Tracking
            </a>

            <a href="{{ route('customer.invoice.index') }}"
                class="topbar-btn {{ str_contains(request()->path(), 'invoice') ? 'topbar-active' : '' }}">
                Invoice
            </a>

            <a href="{{ url('/riwayatcustomer') }}"
                class="topbar-btn {{ str_contains(request()->path(), 'riwayat') ? 'topbar-active' : '' }}">
                Riwayat
            </a>
        </div>

        <ul class="navbar-nav ml-auto d-flex align-items-center">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                    <span class="mr-2 text-gray-700 small font-weight-bold">
                        {{ session('customer_name', 'Guest') }}
                    </span>
                    <img class="img-profile rounded-circle" src="{{ asset('admin/img/undraw_profile.svg') }}">
                </a>

                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    {{-- MOBILE MENU --}}
    <div class="mobile-menu-overlay" onclick="toggleMobileMenu()"></div>
    <div class="mobile-menu-panel">
        <div class="mobile-menu-header">
            <img src="{{ asset('assets/img/logo.png')}}" alt="Logo" style="width: 100px;">
            <div class="mobile-menu-close" onclick="toggleMobileMenu()">×</div>
        </div>
        <div class="mobile-menu-items">
            <a href="{{ url('/dashboardcustomer') }}"
                class="mobile-menu-item {{ str_contains(request()->path(), 'dashboard') ? 'active' : '' }}">
                <i class="fas fa-search-location"></i> Service Tracking
            </a>
            <a href="{{ route('customer.invoice.index') }}"
                class="mobile-menu-item {{ str_contains(request()->path(), 'invoice') ? 'active' : '' }}">
                <i class="fas fa-file-invoice"></i> Invoice
            </a>
            <a href="{{ url('/riwayatcustomer') }}"
                class="mobile-menu-item {{ str_contains(request()->path(), 'riwayat') ? 'active' : '' }}">
                <i class="fas fa-history"></i> Riwayat
            </a>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <main class="container-fluid" style="max-width: 1400px; padding: 24px;">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="container text-center">
            <span style="color: #9ca3af; font-size: 14px;">
                © 2025 FocusAuto. All rights reserved.
            </span>
            <span style="color: #d1d5db; margin: 0 8px;">•</span>
            <span style="color: #9ca3af; font-size: 14px;">
                Developed by <strong style="color: #6b7280;">Darl</strong>
            </span>
        </div>
    </footer>

    {{-- LOGOUT MODAL --}}
    <div class="modal fade" id="logoutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 12px; border: 1px solid #e5e7eb;">
                <div class="modal-header" style="border-bottom: 1px solid #ebebeb;">
                    <h5 class="modal-title" style="font-weight: 700; color: #1f2937;">Logout</h5>
                    <button class="close" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body" style="color: #6b7280;">
                    Apakah Anda yakin ingin logout?
                </div>
                <div class="modal-footer" style="border-top: 1px solid #ebebeb;">
                    <button class="btn btn-secondary" data-dismiss="modal"
                        style="border-radius: 8px; font-weight: 600;">
                        Batal
                    </button>
                    <form action="{{ route('customer.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger" style="border-radius: 8px; font-weight: 600;">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
    function toggleMobileMenu() {
        const overlay = document.querySelector('.mobile-menu-overlay');
        const panel = document.querySelector('.mobile-menu-panel');
        const burger = document.querySelector('.burger-menu');

        overlay.classList.toggle('active');
        panel.classList.toggle('active');
        burger.classList.toggle('active');
    }
    </script>

</body>

</html>