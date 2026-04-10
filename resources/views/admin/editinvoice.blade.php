@extends('layouts.admin')

@section('title', 'Edit Invoice')

@section('content')

<style>
/* ================= MOBILE RESPONSIVE ================= */
@media (max-width: 768px) {

    /* Container padding */
    .container-fluid {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
        margin-top: 1rem !important;
        margin-bottom: 2rem !important;
    }

    /* Header adjustments */
    .d-flex.justify-content-between {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 0.75rem;
    }

    .d-flex.justify-content-between .btn {
        width: 100%;
    }

    /* Page title */
    .h4 {
        font-size: 1.25rem;
    }

    /* Card adjustments */
    .card {
        border-radius: 0.5rem;
        margin-bottom: 1rem !important;
    }

    .card-header {
        padding: 0.75rem 1rem;
    }

    .card-header h6 {
        font-size: 0.95rem;
    }

    .card-header .d-flex {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 0.5rem;
    }

    .card-header .btn {
        width: 100%;
    }

    .card-body {
        padding: 1rem;
    }

    /* Form group adjustments */
    .form-group.row {
        margin-bottom: 1rem;
    }

    .form-group.row label {
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 0.375rem;
        color: #5a5c69;
    }

    .form-control {
        font-size: 0.875rem;
        padding: 0.625rem 0.75rem;
        border-radius: 0.35rem;
        min-height: 44px;
    }

    .col-form-label {
        padding-top: 0;
        padding-bottom: 0.375rem;
    }

    small.text-muted {
        font-size: 0.8rem;
    }

    /* Hide table on mobile */
    .table-responsive table {
        display: none;
    }

    /* Mobile item cards */
    .mobile-items-view {
        display: block;
    }

    .item-card {
        background: #f8f9fc;
        border: 1px solid #e3e6f0;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .item-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e3e6f0;
    }

    .item-number {
        font-size: 0.9rem;
        font-weight: bold;
        color: #4e73df;
    }

    .item-field {
        margin-bottom: 0.75rem;
    }

    .item-field label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: #5a5c69;
        margin-bottom: 0.25rem;
    }

    .item-field input {
        width: 100%;
    }

    .item-field .row {
        margin-left: 0;
        margin-right: 0;
    }

    .item-field .row>div {
        padding-left: 0.25rem;
        padding-right: 0.25rem;
    }

    .remove-item-btn {
        width: 100%;
        margin-top: 0.5rem;
    }

    /* Add button */
    .add-item-btn {
        width: 100%;
    }

    /* Total section on mobile */
    .row.justify-content-end {
        margin-left: 0;
        margin-right: 0;
    }

    .row.justify-content-end>div {
        padding-left: 0;
        padding-right: 0;
    }

    /* Action buttons */
    .text-right {
        text-align: center !important;
    }

    .text-right .btn {
        width: 100%;
        padding: 0.75rem;
        font-size: 0.9rem;
    }

    .mt-4 {
        margin-top: 1rem !important;
    }

    .mb-5 {
        margin-bottom: 2rem !important;
    }
}

@media (min-width: 769px) {

    /* Show table on desktop */
    .table-responsive table {
        display: table;
    }

    /* Hide mobile items on desktop */
    .mobile-items-view {
        display: none;
    }
}

/* Tablet optimization (768px - 1024px) */
@media (min-width: 768px) and (max-width: 1024px) {
    .form-control {
        font-size: 0.9rem;
    }

    table {
        font-size: 0.875rem;
    }

    th,
    td {
        padding: 0.5rem;
    }
}

/* Better touch targets for mobile */
@media (max-width: 768px) {

    input.form-control,
    button,
    .btn {
        min-height: 44px;
    }
}
</style>

<div class="container-fluid mt-4 mb-5">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 text-gray-800 mb-0">Edit Invoice</h1>

        <a href="{{ route('invoice.history') }}" class="btn btn-secondary btn-sm"
            style="background:#e5e7eb;border-color:#e5e7eb;color:#374151;">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('invoice.update', $invoice->id) }}" method="POST" id="invoiceForm"
        data-index="{{ $invoice->items->count() }}">
        @csrf
        @method('PUT')

        {{-- INFO INVOICE --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Invoice</h6>
            </div>
            <div class="card-body">

                <div class="form-group row">
                    <label class="col-md-3 col-form-label font-weight-bold">Nomor Invoice</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" value="{{ $invoice->nomor_invoice }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label font-weight-bold">
                        Service Tracking / Customer
                    </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" readonly value="{{ $invoice->serviceTracking->no_service }} —
                               {{ $invoice->serviceTracking->customer->nama ?? '-' }} —
                               {{ $invoice->serviceTracking->vehicle->nomor_polisi ?? '-' }}">
                        <small class="text-muted">
                            Service tracking tidak dapat diubah
                        </small>
                    </div>
                </div>

            </div>
        </div>

        {{-- TABEL ITEM --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Jasa / Part</h6>
                <button type="button" class="btn btn-success btn-sm add-item-btn">
                    <i class="fas fa-plus mr-1"></i> Tambah Item
                </button>
            </div>

            <div class="card-body">
                {{-- DESKTOP TABLE VIEW --}}
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Pekerjaan / Part</th>
                                <th width="80">Qty</th>
                                <th width="160">Harga</th>
                                <th width="160">Subtotal</th>
                                <th>Keterangan</th>
                                <th width="90">Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="itemTable">
                            @foreach ($invoice->items as $i => $item)
                            <tr data-index="{{ $i }}">
                                <td>
                                    <input type="text" name="items[{{ $i }}][pekerjaan_part]" class="form-control"
                                        value="{{ $item->pekerjaan_part }}" placeholder="Contoh: Ganti Oli" required>
                                </td>
                                <td>
                                    <input type="number" name="items[{{ $i }}][qty]" class="form-control qty"
                                        value="{{ $item->qty }}" min="1">
                                </td>
                                <td>
                                    <input type="text" name="items[{{ $i }}][harga]" class="form-control harga"
                                        value="{{ number_format($item->harga,0,'','.') }}" placeholder="0">
                                </td>
                                <td>
                                    <input type="text" class="form-control subtotal" readonly>
                                </td>
                                <td>
                                    <input type="text" name="items[{{ $i }}][keterangan]" class="form-control"
                                        value="{{ $item->keterangan }}" placeholder="Optional">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-danger btn-sm remove">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                {{-- MOBILE ITEMS VIEW --}}
                <div class="mobile-items-view" id="mobileItemsContainer">
                    @foreach ($invoice->items as $i => $item)
                    <div class="item-card" data-index="{{ $i }}">
                        <div class="item-card-header">
                            <span class="item-number">Item #{{ $i + 1 }}</span>
                            <button type="button" class="btn btn-outline-danger btn-sm remove-mobile">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>

                        <div class="item-field">
                            <label>Pekerjaan / Part</label>
                            <input type="text" name="items[{{ $i }}][pekerjaan_part]" class="form-control"
                                value="{{ $item->pekerjaan_part }}" placeholder="Contoh: Ganti Oli" required>
                        </div>

                        <div class="item-field">
                            <div class="row">
                                <div class="col-6">
                                    <label>Qty</label>
                                    <input type="number" name="items[{{ $i }}][qty]" class="form-control qty-mobile"
                                        value="{{ $item->qty }}" min="1">
                                </div>
                                <div class="col-6">
                                    <label>Harga</label>
                                    <input type="text" name="items[{{ $i }}][harga]" class="form-control harga-mobile"
                                        value="{{ number_format($item->harga,0,'','.') }}" placeholder="0">
                                </div>
                            </div>
                        </div>

                        <div class="item-field">
                            <label>Subtotal</label>
                            <input type="text" class="form-control subtotal-mobile" readonly>
                        </div>

                        <div class="item-field">
                            <label>Keterangan</label>
                            <input type="text" name="items[{{ $i }}][keterangan]" class="form-control"
                                value="{{ $item->keterangan }}" placeholder="Optional">
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>

        {{-- TOTAL --}}
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row justify-content-end">
                    <div class="col-md-5">

                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Subtotal</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="subtotal" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">PPN 11%</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="tax" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold">
                                Grand Total
                            </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control font-weight-bold" id="total" readonly>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- ACTION --}}
        <div class="text-right mt-4 mb-5">
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save mr-1"></i> Update Invoice
            </button>
        </div>

    </form>
</div>
@endsection

@section('scripts')
<script>
$(function() {

    let index = parseInt($('#invoiceForm').data('index')) || 0;
    const isMobile = $(window).width() <= 768;

    function cleanNumber(val) {
        return parseInt((val || '').toString().replace(/[^0-9]/g, '')) || 0;
    }

    function formatRupiah(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    /* =========================
       ✅ FIX UTAMA: RENUMBER MOBILE
    ========================= */
    function renumberMobileItems() {
        $('#mobileItemsContainer .item-card').each(function(i) {
            $(this).find('.item-number').text(`Item #${i + 1}`);
        });
    }

    function recalc() {
        let subtotalAll = 0;

        if (isMobile) {
            $('.item-card').each(function() {
                let qty = parseInt($(this).find('.qty-mobile').val()) || 0;
                let harga = cleanNumber($(this).find('.harga-mobile').val());
                let subtotal = qty * harga;

                $(this).find('.subtotal-mobile').val(formatRupiah(subtotal));
                subtotalAll += subtotal;
            });
        } else {
            $('#itemTable tr').each(function() {
                let qty = parseInt($(this).find('.qty').val()) || 0;
                let harga = cleanNumber($(this).find('.harga').val());
                let subtotal = qty * harga;

                $(this).find('.subtotal').val(formatRupiah(subtotal));
                subtotalAll += subtotal;
            });
        }

        let tax = Math.round(subtotalAll * 0.11);
        let total = subtotalAll + tax;

        $('#subtotal').val(formatRupiah(subtotalAll));
        $('#tax').val(formatRupiah(tax));
        $('#total').val(formatRupiah(total));
    }

    /* =========================
       DESKTOP HANDLERS
    ========================= */
    $('#itemTable').on('input', '.harga', function() {
        let angka = cleanNumber($(this).val());
        $(this).val(formatRupiah(angka));
        recalc();
    });

    $('#itemTable').on('input', '.qty', recalc);

    $('#itemTable').on('click', '.remove', function() {
        const idx = $(this).closest('tr').data('index');
        $(this).closest('tr').remove();
        $(`.item-card[data-index="${idx}"]`).remove();
        renumberMobileItems(); // ✅ FIX
        recalc();
    });

    /* =========================
       MOBILE HANDLERS
    ========================= */
    $('#mobileItemsContainer').on('input', '.harga-mobile', function() {
        let angka = cleanNumber($(this).val());
        $(this).val(formatRupiah(angka));
        recalc();
    });

    $('#mobileItemsContainer').on('input', '.qty-mobile', recalc);

    $('#mobileItemsContainer').on('click', '.remove-mobile', function() {
        const idx = $(this).closest('.item-card').data('index');
        $(this).closest('.item-card').remove();
        $(`#itemTable tr[data-index="${idx}"]`).remove();
        renumberMobileItems(); // ✅ FIX
        recalc();
    });

    /* =========================
       ADD ITEM
    ========================= */
    $('.add-item-btn').on('click', function() {

        if (isMobile) {
            $('#mobileItemsContainer').append(`
                <div class="item-card" data-index="${index}">
                    <div class="item-card-header">
                        <span class="item-number"></span>
                        <button type="button" class="btn btn-outline-danger btn-sm remove-mobile">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>

                    <div class="item-field">
                        <label>Pekerjaan / Part</label>
                        <input type="text" name="items[${index}][pekerjaan_part]" class="form-control" required>
                    </div>

                    <div class="item-field row">
                        <div class="col-6">
                            <label>Qty</label>
                            <input type="number" name="items[${index}][qty]" class="form-control qty-mobile" value="1" min="1">
                        </div>
                        <div class="col-6">
                            <label>Harga</label>
                            <input type="text" name="items[${index}][harga]" class="form-control harga-mobile" value="0">
                        </div>
                    </div>

                    <div class="item-field">
                        <label>Subtotal</label>
                        <input type="text" class="form-control subtotal-mobile" readonly>
                    </div>

                    <div class="item-field">
                        <label>Keterangan</label>
                        <input type="text" name="items[${index}][keterangan]" class="form-control">
                    </div>
                </div>
            `);

            renumberMobileItems(); // ✅ FIX
        } else {
            $('#itemTable').append(`
                <tr data-index="${index}">
                    <td><input type="text" name="items[${index}][pekerjaan_part]" class="form-control" required></td>
                    <td><input type="number" name="items[${index}][qty]" class="form-control qty" value="1"></td>
                    <td><input type="text" name="items[${index}][harga]" class="form-control harga" value="0"></td>
                    <td><input type="text" class="form-control subtotal" readonly></td>
                    <td><input type="text" name="items[${index}][keterangan]" class="form-control"></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-danger btn-sm remove">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `);
        }

        index++;
        recalc();
    });

    /* =========================
       INIT
    ========================= */
    renumberMobileItems(); // ✅ FIX saat load awal
    recalc();

});
</script>
@endsection