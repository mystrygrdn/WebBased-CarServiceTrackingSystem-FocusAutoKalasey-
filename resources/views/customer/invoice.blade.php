@extends('layouts.customer')

@section('title', 'Invoice Detail')

@section('content')
<style>
.card-flat {
    background: #fff;
    border-radius: 12px;
    padding: 22px;
    box-shadow: 0 6px 18px rgba(12, 23, 36, 0.05);
    border: 0;
}

.meta-small {
    font-size: 13px;
    color: #94a3b8;
}

.invoice-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.invoice-title {
    margin: 0;
    font-weight: 700;
    color: #0f172a;
}

.invoice-actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.btn-soft {
    border-radius: 8px;
    font-size: 13px;
    padding: 6px 12px;
    font-weight: 600;
    white-space: nowrap;
}

.pdf-frame {
    width: 100%;
    height: 720px;
    border: 1px solid #e5eaf1;
    border-radius: 12px;
}

/* Responsive Styles */
@media (max-width: 991px) {
    .invoice-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }

    .invoice-actions {
        width: 100%;
        justify-content: flex-start;
    }

    .pdf-frame {
        height: 600px;
    }
}

@media (max-width: 768px) {
    .card-flat {
        padding: 16px;
    }

    .invoice-title {
        font-size: 1.25rem;
    }

    .invoice-actions {
        flex-direction: column;
        width: 100%;
    }

    .btn-soft {
        width: 100%;
        justify-content: center;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pdf-frame {
        height: 500px;
    }
}

@media (max-width: 576px) {
    .card-flat {
        padding: 12px;
    }

    .invoice-title {
        font-size: 1.1rem;
    }

    .meta-small {
        font-size: 12px;
    }

    .btn-soft {
        font-size: 12px;
        padding: 8px 12px;
    }

    .pdf-frame {
        height: 400px;
        border-radius: 8px;
    }
}
</style>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 mb-4">
            <div class="card-flat">

                {{-- HEADER --}}
                <div class="invoice-header">
                    <div>
                        <h4 class="invoice-title">Invoice Pembayaran</h4>
                        <div class="meta-small">Detail tagihan service kendaraan</div>
                    </div>

                    <div class="invoice-actions">
                        <a href="{{ route('customer.invoice.index') }}" class="btn btn-secondary btn-soft">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>

                        <a href="{{ $pdfUrl }}" target="_blank" class="btn btn-primary btn-soft">
                            <i class="fas fa-external-link-alt"></i> Tab Baru
                        </a>

                        <a href="{{ $pdfUrl }}" class="btn btn-success btn-soft" download>
                            <i class="fas fa-download"></i> Download
                        </a>

                        <button onclick="printPDF()" class="btn btn-info btn-soft">
                            <i class="fas fa-print"></i> Cetak
                        </button>
                    </div>
                </div>

                <hr style="border:none; height:1px; background:#eef2f7;">

                {{-- PREVIEW PDF --}}
                <iframe id="pdfFrame" src="{{ $pdfUrl }}" class="pdf-frame"></iframe>

            </div>
        </div>
    </div>
</div>

<script>
function printPDF() {
    const iframe = document.getElementById('pdfFrame');
    iframe.contentWindow.focus();
    iframe.contentWindow.print();
}
</script>

@endsection