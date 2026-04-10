@extends('layouts.customer')

@section('title', 'Invoice')

@section('content')
<style>
/* Mobile card styles - default for small screens */
.mobile-cards {
    display: block;
}

.desktop-table {
    display: none;
}

/* Desktop table - visible on medium screens and up */
@media (min-width: 768px) {
    .desktop-table {
        display: block;
    }

    .mobile-cards {
        display: none;
    }
}

.invoice-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 12px;
}

.invoice-card-row {
    display: flex;
    justify-content: space-between;
    align-items: start;
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.invoice-card-row:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.invoice-card-label {
    font-weight: 600;
    color: #6c757d;
    font-size: 0.875rem;
    flex-shrink: 0;
    width: 100px;
}

.invoice-card-value {
    text-align: right;
    flex-grow: 1;
    word-break: break-word;
}

.invoice-card-actions {
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid #f0f0f0;
}
</style>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card-flat mb-4">
                <h4 style="font-weight:700;">Invoice Saya</h4>
                <div class="meta-small mb-3">
                    Daftar invoice berdasarkan service kendaraan Anda
                </div>

                @if($invoices->count() == 0)
                <div class="text-center text-muted py-5">
                    Belum ada invoice.
                </div>
                @else

                <!-- Desktop Table View -->
                <div class="table-responsive desktop-table">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>No Invoice</th>
                                <th>No Service</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $inv)
                            <tr>
                                <td>{{ $inv->nomor_invoice }}</td>
                                <td>{{ $inv->serviceTracking->no_service ?? '-' }}</td>
                                <td>{{ $inv->tanggal_masuk }}</td>
                                <td>Rp {{ number_format($inv->total,0,',','.') }}</td>
                                <td>
                                    <a href="{{ route('customer.invoice.show', $inv->id) }}"
                                        class="btn btn-sm btn-primary">
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="mobile-cards">
                    @foreach($invoices as $inv)
                    <div class="invoice-card">
                        <div class="invoice-card-row">
                            <span class="invoice-card-label">No Invoice</span>
                            <span class="invoice-card-value">{{ $inv->nomor_invoice }}</span>
                        </div>
                        <div class="invoice-card-row">
                            <span class="invoice-card-label">No Service</span>
                            <span class="invoice-card-value">{{ $inv->serviceTracking->no_service ?? '-' }}</span>
                        </div>
                        <div class="invoice-card-row">
                            <span class="invoice-card-label">Tanggal</span>
                            <span class="invoice-card-value">{{ $inv->tanggal_masuk }}</span>
                        </div>
                        <div class="invoice-card-row">
                            <span class="invoice-card-label">Total</span>
                            <span class="invoice-card-value" style="font-weight: 600;">
                                Rp {{ number_format($inv->total,0,',','.') }}
                            </span>
                        </div>
                        <div class="invoice-card-actions">
                            <a href="{{ route('customer.invoice.show', $inv->id) }}"
                                class="btn btn-sm btn-primary w-100">
                                Lihat Invoice
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @endif

            </div>

        </div>
    </div>
</div>
@endsection