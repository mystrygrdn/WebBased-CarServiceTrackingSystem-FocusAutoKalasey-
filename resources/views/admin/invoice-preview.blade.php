@extends('layouts.admin')

@section('title', 'Preview Invoice')

@section('content')

<style>
/* ================= MOBILE RESPONSIVE ================= */
@media (max-width: 768px) {

    /* Container padding */
    .container-fluid {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
        margin-top: 1rem !important;
    }

    /* Card adjustments */
    .card {
        border-radius: 0.5rem;
        margin-bottom: 1rem;
    }

    .card-body {
        padding: 1rem;
    }

    /* Header section */
    .preview-header {
        margin-bottom: 1rem !important;
    }

    .preview-header h5 {
        font-size: 1.1rem;
        margin-bottom: 0.75rem !important;
    }

    /* Button group on mobile */
    .button-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
        width: 100%;
    }

    .button-group .btn {
        width: 100%;
        font-size: 0.85rem;
        padding: 0.625rem 0.75rem;
        white-space: nowrap;
    }

    /* Back button takes full width on first row */
    .button-group .btn-back {
        grid-column: 1 / -1;
    }

    /* PDF iframe on mobile */
    #pdfFrame {
        width: 100% !important;
        height: 500px !important;
        border: 1px solid #ddd !important;
        border-radius: 0.5rem !important;
    }

    /* Better scrolling on mobile */
    .card-body {
        overflow-x: hidden;
    }
}

/* Tablet optimization (768px - 1024px) */
@media (min-width: 768px) and (max-width: 1024px) {
    #pdfFrame {
        height: 650px !important;
    }

    .button-group .btn {
        font-size: 0.9rem;
    }
}

/* Desktop */
@media (min-width: 769px) {
    .button-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .preview-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .preview-header h5 {
        margin-bottom: 0;
    }
}

/* Common styles */
.btn-sm {
    font-weight: 600;
}

.btn i {
    margin-right: 0.25rem;
}
</style>

<div class="container-fluid mt-4">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="preview-header">
                <h5 class="font-weight-bold">Preview Invoice</h5>

                <div class="button-group">
                    <a href="{{ route('invoice.history') }}" class="btn btn-secondary btn-sm btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>

                    <a href="{{ $pdfUrl }}" target="_blank" class="btn btn-primary btn-sm">
                        <i class="fas fa-external-link-alt"></i> Tab Baru
                    </a>

                    <a href="{{ $pdfUrl }}" download class="btn btn-success btn-sm">
                        <i class="fas fa-download"></i> Download
                    </a>

                    <button onclick="printPDF()" class="btn btn-info btn-sm text-white">
                        <i class="fas fa-print"></i> Cetak
                    </button>
                </div>
            </div>

            <iframe id="pdfFrame" src="{{ $pdfUrl }}"
                style="width:100%; height:750px; border:1px solid #ddd; border-radius:10px;">
            </iframe>

        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
function printPDF() {
    const iframe = document.getElementById('pdfFrame');
    iframe.contentWindow.focus();
    iframe.contentWindow.print();
}
</script>
@endsection