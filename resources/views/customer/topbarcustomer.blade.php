<style>
/* ===== TOPBAR BUTTON STYLE ===== */
.topbar-btn {
    font-size: 14px;
    font-weight: 500;
    color: #444;
    padding: 8px 20px;
    border-radius: 20px;
    transition: 0.25s;
    text-decoration: none;
    white-space: nowrap;
}

.topbar-btn:hover {
    background: #f1f1f1;
    color: #000;
    text-decoration: none;
}

.topbar-active {
    background: #fff9b8;
    border: 2px solid #FFFFFF;
    font-weight: 600;
}

/* ===== CENTER ABSOLUTE (DESKTOP) ===== */
.center-menu-absolute {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 35px;
    z-index: 9;
}

/* ===== LOGO BALANCE ===== */
.navbar-logo img {
    width: 95px;
    height: auto;
    object-fit: contain;
    margin-left: 15px;
}


/* ================================
         RESPONSIVE FIX
    ================================ */
@media (max-width: 992px) {
    .center-menu-absolute {
        position: static !important;
        transform: none !important;
        left: auto !important;
        display: flex;
        gap: 16px;
        margin: 0 auto;
        padding-top: 8px;
        flex-wrap: wrap;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .topbar-btn {
        padding: 5px 10px !important;
        font-size: 12px !important;
        border-radius: 12px !important;
    }

    .center-menu-absolute {
        gap: 8px !important;
    }

    .navbar-logo img {
        width: 74px !important;
    }
}
</style>


<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="position: relative;">

    <!-- LOGO (kiri, tidak terlalu kanan) -->
    <a class="navbar-logo d-flex align-items-center" href="dashboardcustomer">
        <img src="{{ asset('assets/img/logo.png')}}" alt="Logo">
    </a>


    <div class="center-menu-absolute">

        <a href="{{ url('/dashboardcustomer') }}"
            class="topbar-btn {{ str_contains(request()->path(), 'dashboard') ? 'topbar-active' : '' }}">
            Service Tracking
        </a>

        <a href="{{ url('/invoice') }}"
            class="topbar-btn {{ str_contains(request()->path(), 'invoice') ? 'topbar-active' : '' }}">
            Invoice
        </a>

        <a href="{{ url('/riwayatcustomer') }}"
            class="topbar-btn {{ str_contains(request()->path(), 'riwayat') ? 'topbar-active' : '' }}">
            Riwayat
        </a>

    </div>

    <!-- USER KANAN -->
    <ul class="navbar-nav ml-auto d-flex align-items-center">

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">

                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    Halo, {{ session('customer_name', 'Guest') }}
                </span>



                <img class="img-profile rounded-circle" src="{{ asset('admin/img/undraw_profile.svg') }}">
            </a>

            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>