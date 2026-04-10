@extends('layouts.admin')

@section('title', 'Invoice')

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
        flex-direction: column;
        align-items: flex-start !important;
        gap: 0.5rem;
    }

    .card-header h6 {
        font-size: 0.95rem;
    }

    .card-header .btn {
        width: 100%;
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

    .invoice-card {
        background: #fff;
        border: 1px solid #e3e6f0;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .invoice-card-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e3e6f0;
    }

    .invoice-number {
        font-size: 0.8rem;
        background: #36b9cc;
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-weight: 600;
    }

    .invoice-date {
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

    .invoice-info {
        margin-bottom: 0.75rem;
        display: flex;
        align-items: start;
        gap: 0.5rem;
    }

    .invoice-info i {
        color: #4e73df;
        width: 20px;
        margin-top: 0.125rem;
        font-size: 0.875rem;
    }

    .invoice-info-content {
        flex: 1;
    }

    .invoice-info-label {
        display: block;
        font-weight: 600;
        color: #5a5c69;
        font-size: 0.8rem;
        margin-bottom: 0.25rem;
    }

    .invoice-info-value {
        display: block;
        color: #6e707e;
        font-size: 0.875rem;
        line-height: 1.4;
    }

    .invoice-info-small {
        display: block;
        color: #858796;
        font-size: 0.8rem;
        margin-top: 0.125rem;
    }

    .invoice-total {
        background: #f8f9fc;
        padding: 0.75rem;
        border-radius: 0.35rem;
        margin-bottom: 0.75rem;
        text-align: center;
    }

    .invoice-total-label {
        font-size: 0.8rem;
        color: #5a5c69;
        margin-bottom: 0.25rem;
    }

    .invoice-total-value {
        font-size: 1.1rem;
        font-weight: bold;
        color: #1cc88a;
    }

    .invoice-actions {
        display: flex;
        gap: 0.5rem;
        padding-top: 0.75rem;
        border-top: 1px solid #e3e6f0;
    }

    .invoice-actions .btn {
        flex: 1;
        font-size: 0.8rem;
        padding: 0.5rem;
        font-weight: 600;
    }

    .no-results-message {
        text-align: center;
        padding: 2rem 1rem;
        color: #858796;
    }

    /* Modal adjustments */
    .modal-dialog {
        margin: 1rem;
        max-width: calc(100% - 2rem);
    }

    .modal-content {
        border-radius: 0.5rem;
    }

    .modal-header {
        padding: 1rem;
    }

    .modal-title {
        font-size: 1rem;
    }

    .modal-body {
        padding: 1rem;
        font-size: 0.9rem;
    }

    .modal-footer {
        padding: 0.75rem 1rem;
        flex-direction: column;
        gap: 0.5rem;
    }

    .modal-footer .btn {
        width: 100%;
        margin: 0;
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

    <h1 class="h3 mb-4 text-gray-800">Invoice</h1>

    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">List Invoice</h6>
            <a href="{{ route('invoice.index') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus mr-1"></i> Buat Invoice
            </a>
        </div>

        <div class="card-body">

            {{-- MOBILE SEARCH --}}
            <div class="mobile-search-box">
                <input type="text" id="mobileSearch" placeholder="🔍 Cari invoice, customer, atau kendaraan..." />
            </div>

            {{-- DESKTOP TABLE VIEW --}}
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>No Invoice</th>
                            <th>No Service</th>
                            <th>Customer</th>
                            <th>Kendaraan</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th width="160" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($invoices as $i => $row)
                        <tr>
                            <td>{{ $i + 1 }}</td>

                            <td>
                                <span class="badge badge-info">
                                    {{ $row->nomor_invoice }}
                                </span>
                            </td>

                            <td>{{ $row->serviceTracking->no_service ?? '-' }}</td>

                            <td>
                                {{ $row->serviceTracking->customer->nama ?? '-' }}<br>
                                <small class="text-muted">
                                    {{ $row->serviceTracking->customer->no_hp ?? '-' }}
                                </small>
                            </td>

                            <td>
                                {{ $row->serviceTracking->vehicle->nomor_polisi ?? '-' }}<br>
                                <small class="text-muted">
                                    {{ $row->serviceTracking->vehicle->merek ?? '-' }}
                                    - {{ $row->serviceTracking->vehicle->model ?? '-' }}
                                </small>
                            </td>

                            <td>
                                <strong>
                                    Rp {{ number_format($row->total, 0, ',', '.') }}
                                </strong>
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($row->tanggal_masuk)->format('d/m/Y') }}
                            </td>

                            <td class="text-center">
                                {{-- PREVIEW --}}
                                <a href="{{ route('invoice.preview', $row->id) }}" class="btn btn-sm btn-secondary mb-1"
                                    title="Preview">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('invoice.edit', $row->id) }}" class="btn btn-sm btn-warning mb-1"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- DELETE --}}
                                <button type="button" class="btn btn-sm btn-danger mb-1 btn-delete"
                                    data-id="{{ $row->id }}" data-invoice="{{ $row->nomor_invoice }}" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

            {{-- MOBILE CARD VIEW --}}
            <div class="mobile-card-view" id="mobileCardContainer">
                @foreach ($invoices as $row)
                <div class="invoice-card"
                    data-search-content="{{ strtolower($row->nomor_invoice . ' ' . ($row->serviceTracking->no_service ?? '') . ' ' . ($row->serviceTracking->customer->nama ?? '') . ' ' . ($row->serviceTracking->customer->no_hp ?? '') . ' ' . ($row->serviceTracking->vehicle->nomor_polisi ?? '') . ' ' . ($row->serviceTracking->vehicle->merek ?? '')) }}">

                    <div class="invoice-card-header">
                        <span class="invoice-number">{{ $row->nomor_invoice }}</span>
                        <span class="invoice-date">
                            <i class="fas fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($row->tanggal_masuk)->format('d/m/Y') }}
                        </span>
                    </div>

                    <div class="invoice-info">
                        <i class="fas fa-user"></i>
                        <div class="invoice-info-content">
                            <h6 class="customer-name">{{ $row->serviceTracking->customer->nama ?? '-' }}</h6>
                            <span class="customer-phone">
                                <i class="fas fa-phone text-primary"></i>
                                {{ $row->serviceTracking->customer->no_hp ?? '-' }}
                            </span>
                        </div>
                    </div>

                    <div class="invoice-info">
                        <i class="fas fa-clipboard-list"></i>
                        <div class="invoice-info-content">
                            <span class="invoice-info-label">No Service</span>
                            <span class="invoice-info-value">{{ $row->serviceTracking->no_service ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="invoice-info">
                        <i class="fas fa-car"></i>
                        <div class="invoice-info-content">
                            <span class="invoice-info-label">Kendaraan</span>
                            <span
                                class="invoice-info-value">{{ $row->serviceTracking->vehicle->nomor_polisi ?? '-' }}</span>
                            <span class="invoice-info-small">
                                {{ $row->serviceTracking->vehicle->merek ?? '-' }} -
                                {{ $row->serviceTracking->vehicle->model ?? '-' }}
                            </span>
                        </div>
                    </div>

                    <div class="invoice-total">
                        <div class="invoice-total-label">Total Invoice</div>
                        <div class="invoice-total-value">Rp {{ number_format($row->total, 0, ',', '.') }}</div>
                    </div>

                    <div class="invoice-actions">
                        <a href="{{ route('invoice.preview', $row->id) }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-eye"></i> Preview
                        </a>
                        <a href="{{ route('invoice.edit', $row->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $row->id }}"
                            data-invoice="{{ $row->nomor_invoice }}">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>

                </div>
                @endforeach

                <div class="no-results-message" id="noResults" style="display: none;">
                    <i class="fas fa-search fa-3x mb-3" style="color: #d1d3e2;"></i>
                    <p class="mb-0">Tidak ada invoice yang ditemukan</p>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- ================= MODAL DELETE ================= -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">
                    Hapus Invoice?
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <p class="mb-1">
                        Apakah Anda yakin ingin menghapus invoice
                        <strong id="invoiceNumber"></strong>?
                    </p>
                    <p class="text-muted mb-0">
                        Invoice yang dihapus tidak dapat dikembalikan.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Ya, Hapus
                    </button>
                </div>
            </form>

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

        $('.invoice-card').each(function() {
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

/* DELETE MODAL */
$(document).on('click', '.btn-delete', function() {
    let id = $(this).data('id');
    let invoice = $(this).data('invoice');

    $('#invoiceNumber').text(invoice);
    $('#deleteForm').attr('action', '/riwayatinvoice/' + id);
    $('#deleteModal').modal('show');
});
</script>
@endsection