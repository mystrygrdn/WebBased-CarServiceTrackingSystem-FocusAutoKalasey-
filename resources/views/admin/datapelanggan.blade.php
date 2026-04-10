@extends('layouts.admin')

@section('title', 'Data Pelanggan')
@section('page_title', 'Data Pelanggan')

@section('content')

<style>
/* ===== MODAL DI ATAS ===== */
.modal-dialog {
    margin-top: 60px;
}

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

    /* Hide page title on mobile, keep button */
    .page-heading h1 {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    /* Make add button full width on small screens */
    .btn-add-customer {
        width: 100%;
        margin-top: 10px;
    }

    /* Card adjustments */
    .card {
        margin-bottom: 1rem;
    }

    .card-body {
        padding: 0.75rem;
    }

    .card-header h6 {
        font-size: 0.95rem;
    }

    /* Hide table on mobile, show cards instead */
    .table-responsive table {
        display: none;
    }

    /* Mobile card view */
    .mobile-card-view {
        display: block;
    }

    .customer-card {
        background: #fff;
        border: 1px solid #e3e6f0;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 0.75rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .customer-card-header {
        margin-bottom: 0.75rem;
    }

    .customer-name {
        font-size: 1.15rem;
        font-weight: bold;
        color: #4e73df;
        margin: 0;
    }

    .customer-info {
        margin-bottom: 0.75rem;
        display: flex;
        align-items: start;
        gap: 0.5rem;
    }

    .customer-info i {
        color: #4e73df;
        width: 20px;
        margin-top: 0.125rem;
        font-size: 0.875rem;
    }

    .customer-info-content {
        flex: 1;
    }

    .customer-info-label {
        display: block;
        font-weight: 600;
        color: #5a5c69;
        font-size: 0.8rem;
        margin-bottom: 0.25rem;
    }

    .customer-info-value {
        display: block;
        color: #6e707e;
        font-size: 0.875rem;
        line-height: 1.4;
    }

    .vehicle-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 0.35rem;
        margin-top: 0.25rem;
    }

    .vehicle-badges .badge {
        background: #36b9cc;
        color: white;
        padding: 0.35rem 0.6rem;
        border-radius: 0.25rem;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        margin-top: 0.75rem;
        padding-top: 0.75rem;
        border-top: 1px solid #e3e6f0;
    }

    .action-buttons .btn {
        flex: 1;
        font-size: 0.875rem;
        padding: 0.5rem;
        font-weight: 600;
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

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }

    th,
    td {
        padding: 0.5rem;
    }
}

/* Desktop vehicle badges */
.vehicle-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 0.25rem;
}

.badge {
    font-size: 0.75rem;
}
</style>

<div class="container-fluid">

    {{-- PAGE HEADING --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4 page-heading">
        <h1 class="h3 mb-0 text-gray-800">Data Pelanggan</h1>
        <a href="{{ route('customer.add') }}" class="btn btn-primary btn-sm shadow-sm btn-add-customer">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Customer
        </a>
    </div>

    {{-- TABLE CARD --}}
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Daftar Customer FocusAuto
            </h6>
        </div>

        <div class="card-body">

            {{-- MOBILE SEARCH --}}
            <div class="mobile-search-box">
                <input type="text" id="mobileSearch" placeholder="🔍 Cari nama, no HP, atau alamat..." />
            </div>

            {{-- DESKTOP TABLE VIEW --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Kendaraan</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($customers as $index => $row)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="font-weight-bold">{{ $row->nama }}</td>
                            <td>{{ $row->no_hp }}</td>
                            <td>{{ $row->alamat }}</td>
                            <td>
                                <span class="badge badge-secondary mb-1">
                                    {{ $row->vehicles->count() }} Kendaraan
                                </span>
                                <div class="vehicle-badges mt-1">
                                    @foreach ($row->vehicles as $v)
                                    <span class="badge badge-info">
                                        {{ $v->nomor_polisi }}
                                    </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('customer.edit', $row->id) }}" class="btn btn-warning btn-sm mb-1">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button class="btn btn-danger btn-sm mb-1" data-toggle="modal"
                                    data-target="#deleteCustomerModal{{ $row->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- DELETE MODAL -->
                        <div class="modal fade" id="deleteCustomerModal{{ $row->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Hapus Customer</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        Yakin ingin menghapus customer
                                        <strong>{{ $row->nama }}</strong>?
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-dismiss="modal">
                                            Batal
                                        </button>

                                        <form action="{{ route('customer.delete', $row->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- MOBILE CARD VIEW --}}
            <div class="mobile-card-view" id="mobileCardContainer">
                @foreach ($customers as $index => $row)
                <div class="customer-card"
                    data-search-content="{{ strtolower($row->nama . ' ' . $row->no_hp . ' ' . $row->alamat) }}">
                    <div class="customer-card-header">
                        <h5 class="customer-name">{{ $row->nama }}</h5>
                    </div>

                    <div class="customer-info">
                        <i class="fas fa-phone"></i>
                        <div class="customer-info-content">
                            <span class="customer-info-label">No HP</span>
                            <span class="customer-info-value">{{ $row->no_hp }}</span>
                        </div>
                    </div>

                    <div class="customer-info">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="customer-info-content">
                            <span class="customer-info-label">Alamat</span>
                            <span class="customer-info-value">{{ $row->alamat }}</span>
                        </div>
                    </div>

                    @if($row->vehicles->count() > 0)
                    <div class="customer-info">
                        <i class="fas fa-car"></i>
                        <div class="customer-info-content">
                            <span class="customer-info-label">Kendaraan</span>
                            <div class="vehicle-badges">
                                @foreach ($row->vehicles as $v)
                                <span class="badge">{{ $v->nomor_polisi }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="action-buttons">
                        <a href="{{ route('customer.edit', $row->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                            data-target="#deleteCustomerModal{{ $row->id }}">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
                @endforeach

                <div class="no-results-message" id="noResults" style="display: none;">
                    <i class="fas fa-search fa-3x mb-3" style="color: #d1d3e2;"></i>
                    <p class="mb-0">Tidak ada customer yang ditemukan</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

{{-- ================= DATATABLES SCRIPT ================= --}}
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

        $('.customer-card').each(function() {
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