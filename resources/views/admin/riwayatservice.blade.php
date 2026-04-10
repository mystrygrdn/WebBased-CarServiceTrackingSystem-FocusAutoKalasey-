@extends('layouts.admin')

@section('title', 'Riwayat Service')

@section('content')

<style>
/* ===== MOBILE RESPONSIVE STYLES ===== */
@media (max-width: 768px) {

    /* Hide DataTables controls on mobile */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        display: none !important;
    }

    /* Mobile search box */
    .mobile-search-box {
        display: block;
        margin-bottom: 1rem;
    }

    .mobile-search-box input {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
        font-size: 0.9rem;
    }

    /* Container padding */
    .container-fluid {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }

    /* Page title */
    .h3 {
        font-size: 1.25rem;
        margin-bottom: 1rem !important;
    }

    /* Card adjustments */
    .card {
        border-radius: 0.5rem;
        margin-bottom: 1rem;
    }

    .card-header {
        padding: 0.75rem 1rem;
    }

    .card-header h6 {
        font-size: 0.95rem;
    }

    .card-body {
        padding: 1rem;
    }

    /* Hide table on mobile, show cards instead */
    .table-responsive table {
        display: none;
    }

    /* Mobile card view */
    .mobile-card-view {
        display: block;
    }

    .history-card {
        background: #fff;
        border: 1px solid #e3e6f0;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .history-card-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e3e6f0;
    }

    .service-number {
        font-size: 0.8rem;
        background: #4e73df;
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-weight: 600;
    }

    .service-date {
        font-size: 0.8rem;
        color: #858796;
    }

    .customer-name {
        font-size: 1.05rem;
        font-weight: bold;
        color: #4e73df;
        margin: 0 0 0.25rem 0;
    }

    .customer-phone {
        font-size: 0.875rem;
        color: #6e707e;
    }

    .history-info {
        margin-bottom: 0.75rem;
        display: flex;
        align-items: start;
        gap: 0.5rem;
    }

    .history-info i {
        color: #4e73df;
        width: 20px;
        margin-top: 0.125rem;
        font-size: 0.875rem;
    }

    .history-info-content {
        flex: 1;
    }

    .history-info-label {
        display: block;
        font-weight: 600;
        color: #5a5c69;
        font-size: 0.8rem;
        margin-bottom: 0.25rem;
    }

    .history-info-value {
        display: block;
        color: #6e707e;
        font-size: 0.875rem;
        line-height: 1.4;
    }

    .history-info-small {
        display: block;
        color: #858796;
        font-size: 0.8rem;
        margin-top: 0.125rem;
    }

    .no-results-message {
        text-align: center;
        padding: 2rem 1rem;
        color: #858796;
    }
}

@media (min-width: 769px) {

    /* Show table on desktop */
    .table-responsive table {
        display: table;
    }

    /* Hide mobile elements on desktop */
    .mobile-card-view,
    .mobile-search-box {
        display: none;
    }
}

/* Tablet optimization (768px - 1024px) */
@media (min-width: 768px) and (max-width: 1024px) {
    .table {
        font-size: 0.875rem;
    }

    th,
    td {
        padding: 0.5rem;
    }
}

/* Badge styling */
.badge {
    font-size: 0.75rem;
    padding: 0.35rem 0.6rem;
}
</style>

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Riwayat Service Selesai</h1>

    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                List Service yang Sudah Selesai
            </h6>
        </div>

        <div class="card-body">

            {{-- MOBILE SEARCH --}}
            <div class="mobile-search-box">
                <input type="text" id="mobileSearch" placeholder="🔍 Cari customer, kendaraan, atau no service..." />
            </div>

            {{-- DESKTOP TABLE VIEW --}}
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>No. Service</th>
                            <th>Customer</th>
                            <th>Kendaraan</th>
                            <th>Jenis Service</th>
                            <th>Tgl Masuk</th>
                            <th>Admin</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($riwayat as $row)
                        <tr>
                            <td>{{ $no++ }}</td>

                            <td>
                                <span class="badge badge-primary">
                                    {{ $row->no_service }}
                                </span>
                            </td>

                            <td>
                                {{ $row->customer->nama ?? '-' }}<br>
                                <small class="text-muted">
                                    {{ $row->customer->no_hp ?? '-' }}
                                </small>
                            </td>

                            <td>
                                {{ $row->vehicle->nomor_polisi ?? '-' }}<br>
                                <small class="text-muted">
                                    {{ $row->vehicle->merek ?? '-' }} -
                                    {{ $row->vehicle->warna ?? '-' }}
                                </small>
                            </td>

                            <td>{{ $row->jenis_service }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($row->tanggal_masuk)->format('d/m/Y') }}
                            </td>

                            <td>{{ $row->admin->name ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

            {{-- MOBILE CARD VIEW --}}
            <div class="mobile-card-view" id="mobileCardContainer">
                @foreach ($riwayat as $row)
                <div class="history-card"
                    data-search-content="{{ strtolower(($row->customer->nama ?? '') . ' ' . ($row->customer->no_hp ?? '') . ' ' . ($row->vehicle->nomor_polisi ?? '') . ' ' . ($row->vehicle->merek ?? '') . ' ' . $row->no_service . ' ' . $row->jenis_service) }}">

                    <div class="history-card-header">
                        <span class="service-number">{{ $row->no_service }}</span>
                        <span class="service-date">
                            <i class="fas fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($row->tanggal_masuk)->format('d/m/Y') }}
                        </span>
                    </div>

                    <div class="history-info">
                        <i class="fas fa-user"></i>
                        <div class="history-info-content">
                            <h6 class="customer-name">{{ $row->customer->nama ?? '-' }}</h6>
                            <span class="customer-phone">
                                <i class="fas fa-phone text-primary"></i> {{ $row->customer->no_hp ?? '-' }}
                            </span>
                        </div>
                    </div>

                    <div class="history-info">
                        <i class="fas fa-car"></i>
                        <div class="history-info-content">
                            <span class="history-info-label">Kendaraan</span>
                            <span class="history-info-value">{{ $row->vehicle->nomor_polisi ?? '-' }}</span>
                            <span class="history-info-small">
                                {{ $row->vehicle->merek ?? '-' }} - {{ $row->vehicle->warna ?? '-' }}
                            </span>
                        </div>
                    </div>

                    <div class="history-info">
                        <i class="fas fa-tools"></i>
                        <div class="history-info-content">
                            <span class="history-info-label">Jenis Service</span>
                            <span class="history-info-value">{{ $row->jenis_service }}</span>
                        </div>
                    </div>

                    <div class="history-info">
                        <i class="fas fa-user-tie"></i>
                        <div class="history-info-content">
                            <span class="history-info-label">Admin</span>
                            <span class="history-info-value">{{ $row->admin->name ?? '-' }}</span>
                        </div>
                    </div>

                </div>
                @endforeach

                <div class="no-results-message" id="noResults" style="display: none;">
                    <i class="fas fa-search fa-3x mb-3" style="color: #d1d3e2;"></i>
                    <p class="mb-0">Tidak ada riwayat service yang ditemukan</p>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script>
$(document).ready(function() {
    // Only initialize DataTable on desktop
    if ($(window).width() > 768) {
        $('#dataTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            ordering: true,
            searching: true,
            paging: true,
            info: true,
            autoWidth: false,
            responsive: true
        });
    }

    // Mobile search functionality
    $('#mobileSearch').on('keyup', function() {
        var searchValue = $(this).val().toLowerCase();
        var visibleCount = 0;

        $('.history-card').each(function() {
            var searchContent = $(this).attr('data-search-content');

            if (searchContent.indexOf(searchValue) > -1) {
                $(this).show();
                visibleCount++;
            } else {
                $(this).hide();
            }
        });

        // Show/hide no results message
        if (visibleCount === 0) {
            $('#noResults').show();
        } else {
            $('#noResults').hide();
        }
    });
});
</script>
@endsection