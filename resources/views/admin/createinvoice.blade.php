@extends('layouts.admin')

@section('title', 'Buat Invoice')

@section('content')

<style>
@media (max-width: 768px) {

    .container-fluid {
        padding: 0.75rem;
        margin-top: 1rem;
        margin-bottom: 2rem;
    }

    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 0.75rem;
        align-items: flex-start !important;
    }

    .btn-back,
    .add-item-btn,
    .text-right .btn {
        width: 100%;
    }

    .table-responsive {
        display: none;
    }

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
        border-bottom: 1px solid #e3e6f0;
        padding-bottom: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .item-number {
        font-weight: bold;
        color: #4e73df;
    }

    .text-right {
        text-align: center !important;
    }
}

@media (min-width: 769px) {
    .mobile-items-view {
        display: none;
    }
}
</style>

<div class="container-fluid mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Buat Invoice</h1>
        <a href="{{ route('invoice.history') }}" class="btn btn-secondary btn-sm btn-back">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('invoice.store') }}" method="POST" id="invoiceForm">
        @csrf

        {{-- DATA SERVICE --}}
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong>Data Service</strong>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label font-weight-bold">
                        Service Tracking / Customer
                    </label>
                    <div class="col-md-6">
                        <select name="service_tracking_id" class="form-control" required>
                            <option value="">-- Pilih Service Tracking --</option>
                            @foreach ($serviceTrackings as $service)
                            <option value="{{ $service->id }}">
                                {{ $service->no_service }} —
                                {{ $service->customer->nama ?? '-' }} —
                                {{ $service->vehicle->nomor_polisi ?? '-' }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- ITEM --}}
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Jasa / Part</strong>
                <button type="button" class="btn btn-success btn-sm add-item-btn">
                    + Tambah Item
                </button>
            </div>

            <div class="card-body">

                {{-- DESKTOP --}}
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Pekerjaan / Part</th>
                                <th width="80">Qty</th>
                                <th width="150">Harga</th>
                                <th width="150">Subtotal</th>
                                <th>Keterangan</th>
                                <th width="80">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="itemTable"></tbody>
                    </table>
                </div>

                {{-- MOBILE --}}
                <div class="mobile-items-view" id="mobileItemsContainer"></div>
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
                                <input type="text" id="subtotal" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">PPN 11%</label>
                            <div class="col-sm-7">
                                <input type="text" id="tax" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold">Grand Total</label>
                            <div class="col-sm-7">
                                <input type="text" id="total" class="form-control font-weight-bold" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">
                Simpan & Generate PDF
            </button>
        </div>

    </form>
</div>
@endsection

@section('scripts')
<script>
$(function() {

    let index = 0;

    const clean = v => parseInt((v || '').replace(/[^0-9]/g, '')) || 0;
    const rupiah = n => n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    function addItem(i) {

        $('#itemTable').append(`
            <tr data-index="${i}">
                <td><input type="text" name="items[${i}][pekerjaan_part]" class="form-control"></td>
                <td><input type="number" name="items[${i}][qty]" class="form-control qty" value="1"></td>
                <td><input type="text" name="items[${i}][harga]" class="form-control harga" value="0"></td>
                <td><input type="text" class="form-control subtotal" readonly></td>
                <td><input type="text" name="items[${i}][keterangan]" class="form-control"></td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove">X</button>
                </td>
            </tr>
        `);

        $('#mobileItemsContainer').append(`
            <div class="item-card" data-index="${i}">
                <div class="item-card-header">
                    <span class="item-number">Item #${i + 1}</span>
                    <button type="button" class="btn btn-danger btn-sm remove-mobile">X</button>
                </div>

                <label>Pekerjaan / Part</label>
                <input type="text" name="items[${i}][pekerjaan_part]" class="form-control">

                <div class="row mt-2">
                    <div class="col-6">
                        <label>Qty</label>
                        <input type="number" name="items[${i}][qty]" class="form-control qty-mobile" value="1">
                    </div>
                    <div class="col-6">
                        <label>Harga</label>
                        <input type="text" name="items[${i}][harga]" class="form-control harga-mobile" value="0">
                    </div>
                </div>

                <label class="mt-2">Subtotal</label>
                <input type="text" class="form-control subtotal-mobile" readonly>

                <label class="mt-2">Keterangan</label>
                <input type="text" name="items[${i}][keterangan]" class="form-control keterangan-mobile">
            </div>
        `);
    }

    function recalc() {
        let total = 0;

        $('#itemTable tr').each(function() {
            const idx = $(this).data('index');
            const qty = +$(this).find('.qty').val() || 0;
            const harga = clean($(this).find('.harga').val());
            const sub = qty * harga;

            $(this).find('.subtotal').val(rupiah(sub));
            $(`.item-card[data-index="${idx}"] .subtotal-mobile`).val(rupiah(sub));

            total += sub;
        });

        const tax = Math.round(total * 0.11);
        $('#subtotal').val(rupiah(total));
        $('#tax').val(rupiah(tax));
        $('#total').val(rupiah(total + tax));
    }

    $(document)

        // QTY & HARGA
        .on('input', '.harga', function() {
            const i = $(this).closest('tr').data('index');
            const v = rupiah(clean($(this).val()));
            $(this).val(v);
            $(`.item-card[data-index="${i}"] .harga-mobile`).val(v);
            recalc();
        })
        .on('input', '.qty', function() {
            const i = $(this).closest('tr').data('index');
            $(`.item-card[data-index="${i}"] .qty-mobile`).val($(this).val());
            recalc();
        })
        .on('input', '.harga-mobile', function() {
            const i = $(this).closest('.item-card').data('index');
            const v = rupiah(clean($(this).val()));
            $(this).val(v);
            $(`#itemTable tr[data-index="${i}"] .harga`).val(v);
            recalc();
        })
        .on('input', '.qty-mobile', function() {
            const i = $(this).closest('.item-card').data('index');
            $(`#itemTable tr[data-index="${i}"] .qty`).val($(this).val());
            recalc();
        })

        // 🔥 SYNC PEKERJAAN
        .on('input', 'input[name*="[pekerjaan_part]"]', function() {
            const idx = $(this).closest('[data-index]').data('index');
            if ($(this).closest('.item-card').length) {
                $('#itemTable tr[data-index="' + idx + '"] input[name*="[pekerjaan_part]"]').val($(this)
                    .val());
            } else {
                $('.item-card[data-index="' + idx + '"] input[name*="[pekerjaan_part]"]').val($(this)
            .val());
            }
        })

        // 🔥 SYNC KETERANGAN (INI FIX TERAKHIR)
        .on('input', 'input[name*="[keterangan]"]', function() {
            const idx = $(this).closest('[data-index]').data('index');
            if ($(this).closest('.item-card').length) {
                $('#itemTable tr[data-index="' + idx + '"] input[name*="[keterangan]"]').val($(this).val());
            } else {
                $('.item-card[data-index="' + idx + '"] input[name*="[keterangan]"]').val($(this).val());
            }
        })

        // REMOVE
        .on('click', '.remove, .remove-mobile', function() {
            const i = $(this).closest('[data-index]').data('index');
            $(`[data-index="${i}"]`).remove();
            recalc();
        });

    $('.add-item-btn').click(function() {
        index++;
        addItem(index);
        recalc();
    });

    // FIX SUBMIT
    $('#invoiceForm').on('submit', function() {
        if (window.innerWidth <= 768) {
            $('#itemTable input').remove();
        } else {
            $('#mobileItemsContainer input').remove();
        }
        return true;
    });

    addItem(index);
    recalc();
});
</script>
@endsection