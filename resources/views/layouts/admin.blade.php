<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title', 'FocusAuto Admin')</title>

    {{-- Font --}}
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- SB Admin 2 --}}
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <style>
    * {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    body {
        background: #fafafa;
    }

    /* Sidebar */
    .sidebar {
        background: #ffffff !important;
        box-shadow: none;
        border-right: 1px solid #ebebeb;
    }

    .sidebar-brand {
        padding: 0;
        height: 4.375rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid #ebebeb;
    }

    .sidebar-brand+.sidebar-divider {
        display: none;
    }

    .sidebar-logo {
        width: 140px;
        transition: .3s;
    }

    body.sidebar-toggled .sidebar-logo {
        width: 50px;
    }

    .sidebar .nav-item .nav-link {
        color: #6b7280;
        font-weight: 500;
    }

    .sidebar .nav-item .nav-link:hover {
        color: #374151;
        background: #f9fafb;
    }

    .sidebar .nav-item.active .nav-link {
        color: #d97706;
        background: #fffbf0;
        border-left: 4px solid #d97706;
        padding-left: calc(1rem - 4px);
    }

    .sidebar .nav-item .nav-link i {
        color: #9ca3af;
    }

    .sidebar .nav-item.active .nav-link i {
        color: #d97706;
    }

    .sidebar-divider {
        border-color: #ebebeb;
    }

    .sidebar-heading {
        color: #9ca3af;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
    }

    .sidebar .collapse-inner {
        background: #f9fafb;
        border-radius: 0;
    }

    .sidebar .collapse-item {
        color: #6b7280;
        font-weight: 500;
    }

    .sidebar .collapse-item:hover {
        color: #374151;
        background: #f3f4f6;
    }

    #sidebarToggle {
        background: #f3f4f6;
    }

    /* Topbar */
    .topbar {
        background: #ffffff !important;
        border-bottom: 1px solid #ebebeb;
        box-shadow: none !important;
        min-height: 70px;
        padding: 0 20px;
        display: flex;
        align-items: center;
    }

    .topbar h4 {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    #sidebarToggleTop {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        color: #6b7280;
        padding: 0;
        border-radius: 8px;
    }

    #sidebarToggleTop:hover {
        background: #f3f4f6;
    }

    .img-profile {
        width: 36px;
        height: 36px;
        border: 2px solid #f3f4f6;
    }

    .topbar .dropdown-menu {
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-radius: 10px;
    }

    /* Cards */
    .card {
        border-radius: 12px;
        border: 1px solid #ebebeb;
        box-shadow: none;
    }

    .card-header {
        background: #ffffff;
        border-bottom: 1px solid #ebebeb;
        font-weight: 600;
    }

    /* Buttons */
    .btn {
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-primary {
        background: #3b82f6;
        border: none;
    }

    .btn-warning {
        background: #d97706;
        border: none;
        color: #fff;
    }

    .btn-danger {
        background: #ef4444;
        border: none;
    }

    .btn-success {
        background: #10b981;
        border: none;
    }

    .btn-secondary {
        background: #6b7280;
        border: none;
    }

    /* Footer */
    .sticky-footer {
        background: #ffffff;
        border-top: 1px solid #ebebeb;
    }

    .sticky-footer span {
        color: #9ca3af;
        font-size: 14px;
    }

    /* Modal */
    .modal-dialog {
        margin-top: 100px;
    }

    .modal-content {
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }

    .modal-header {
        border-bottom: 1px solid #ebebeb;
    }

    .modal-title {
        font-weight: 700;
        color: #1f2937;
    }

    .modal-body {
        color: #6b7280;
    }

    .modal-footer {
        border-top: 1px solid #ebebeb;
    }

    /* Mobile */
    @media (max-width: 768px) {
        .sidebar-brand {
            height: 65px;
        }

        .sidebar-logo {
            width: 110px !important;
        }

        body.sidebar-toggled .sidebar-logo {
            width: 45px !important;
        }

        .topbar {
            height: 65px;
            padding: 0 16px;
        }

        .topbar h4 {
            font-size: 16px;
        }

        #sidebarToggleTop {
            width: 36px;
            height: 36px;
        }

        .img-profile {
            width: 34px;
            height: 34px;
        }
    }

    @media (max-width: 576px) {
        .sidebar-brand {
            height: 60px;
        }

        .sidebar-logo {
            width: 100px !important;
        }

        .topbar {
            height: 60px;
            padding: 0 12px;
        }

        .topbar h4 {
            font-size: 14px;
        }

        #sidebarToggleTop {
            width: 34px;
            height: 34px;
        }

        .img-profile {
            width: 32px;
            height: 32px;
        }
    }

    @media (max-width: 400px) {
        .topbar h4 {
            font-size: 13px;
        }

        .sidebar-logo {
            width: 90px !important;
        }
    }
    </style>

    @stack('styles')
</head>

<body id="page-top">
    <div id="wrapper">

        {{-- SIDEBAR --}}
        <ul class="navbar-nav bg-white sidebar sidebar-light accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('dashboardadmin') }}">
                <img src="{{ asset('assets/img/logo.png') }}" class="sidebar-logo">
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item {{ Request::routeIs('dashboardadmin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboardadmin') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Customers</div>

            <li class="nav-item {{ Request::routeIs('customer.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('customer.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Pelanggan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseService">
                    <i class="fas fa-fw fa-tools"></i>
                    <span>Proses Service</span>
                </a>
                <div id="collapseService" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('tracking.create') }}">Daftar Service</a>
                        <a class="collapse-item" href="{{ route('riwayatservice') }}">Riwayat Service</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Pembayaran</div>

            <li class="nav-item {{ Request::routeIs('invoice.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('invoice.history') }}">
                    <i class="fas fa-fw fa-file-invoice"></i>
                    <span>Invoice</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Settings</div>

            <li class="nav-item {{ Request::routeIs('manajemenadmin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manajemenadmin') }}">
                    <i class="fas fa-fw fa-user-cog"></i>
                    <span>Manajemen Admin</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                {{-- TOPBAR --}}
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <h4 class="mb-0">
                        @yield('page_title', 'Dashboard Admin')
                    </h4>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                <span class="mr-2 text-gray-700 small font-weight-bold">
                                    {{ Session::get('admin_name', 'Admin') }}
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('admin/img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto text-center">
                    <span>© FocusAuto by Darl 2025</span>
                </div>
            </footer>
        </div>
    </div>

    <!-- LOGOUT MODAL -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Logout</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    Apakah Anda yakin ingin logout?
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>

                    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Logout
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- CORE JS --}}
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>

    @yield('scripts')

</body>

</html>