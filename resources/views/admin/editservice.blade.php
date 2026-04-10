@extends('layouts.admin')

@section('title', 'Edit Service')

@section('content')
<style>
.stepper {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.step {
    flex: 1;
    text-align: center;
    position: relative;
}

.step:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 12px;
    right: -50%;
    width: 100%;
    height: 2px;
    background: #dee2e6;
    z-index: 0;
}

.step-circle {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #dee2e6;
    margin: 0 auto;
    line-height: 25px;
    color: #fff;
    z-index: 1;
    position: relative;
}

.step.active .step-circle {
    background: #4e73df;
}

.step-label {
    margin-top: 5px;
    font-size: 0.85rem;
}

.photo-card {
    width: 80px;
    height: 80px;
    overflow: hidden;
    border-radius: 8px;
    border: 1px solid #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 8px;
}

.photo-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ================= MOBILE RESPONSIVE ================= */
@media (max-width: 768px) {

    /* Container padding */
    .container-fluid {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }

    /* Page title */
    .h4 {
        font-size: 1.25rem;
        margin-bottom: 1rem !important;
    }

    /* Alert */
    .alert {
        font-size: 0.875rem;
        padding: 0.75rem;
        margin-bottom: 1rem;
        border-radius: 0.35rem;
    }

    /* Card adjustments */
    .card {
        border-radius: 0.5rem;
        margin-bottom: 1rem;
    }

    .card-body {
        padding: 1rem;
    }

    /* Form elements */
    label {
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 0.375rem;
        color: #5a5c69;
        display: block;
    }

    .form-control,
    select.form-control {
        font-size: 0.875rem;
        padding: 0.625rem 0.75rem;
        border-radius: 0.35rem;
        min-height: 44px;
    }

    textarea.form-control {
        min-height: 80px;
    }

    /* Mobile: Stack all columns */
    .row>[class*='col-'] {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

    .mb-3 {
        margin-bottom: 0.875rem !important;
    }

    .mb-4 {
        margin-bottom: 1rem !important;
    }

    /* Photo preview */
    #photoPreview {
        max-width: 100% !important;
        width: 100%;
        height: auto;
        border-radius: 0.5rem !important;
        margin-top: 0.5rem;
    }

    .text-muted {
        font-size: 0.8rem;
    }

    /* Buttons */
    .btn {
        font-size: 0.875rem;
        padding: 0.625rem 1rem;
        border-radius: 0.35rem;
        font-weight: 600;
        min-height: 44px;
    }

    /* Action buttons at bottom */
    .card-body>form>.btn,
    .card-body>form>a.btn {
        display: block;
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .card-body>form>.btn:last-child,
    .card-body>form>a.btn:last-child {
        margin-bottom: 0;
    }

    /* Modal adjustments */
    .modal-dialog {
        margin: 1rem;
        max-width: calc(100% - 2rem);
    }

    .modal-content {
        border-radius: 0.5rem;
    }

    .modal-content.mt-5 {
        margin-top: 1rem !important;
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

/* Tablet optimization (768px - 1024px) */
@media (min-width: 768px) and (max-width: 1024px) {

    .form-control,
    select.form-control {
        font-size: 0.9rem;
    }

    .card-body {
        padding: 1.25rem;
    }
}

/* Better touch targets for mobile */
@media (max-width: 768px) {

    select.form-control,
    input.form-control,
    textarea.form-control {
        min-height: 44px;
    }

    button,
    .btn {
        min-height: 44px;
    }
}
</style>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">

            <h1 class="h4 mb-4 text-gray-800">Edit Proses Service</h1>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow mb-4">
                <div class="card-body">
                    <form id="editServiceForm" action="{{ route('tracking.update', $service->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Info readonly -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Customer</label>
                                <input type="text" class="form-control" value="{{ $service->customer->nama }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label>Kendaraan</label>
                                <input type="text" class="form-control"
                                    value="{{ $service->vehicle->nomor_polisi }} ({{ $service->vehicle->merek }} {{ $service->vehicle->model }})"
                                    readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Admin Penanggung Jawab</label>
                                <input type="text" class="form-control" value="{{ $service->admin->name }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label>Tanggal Masuk</label>
                                <input type="date" class="form-control" value="{{ $service->tanggal_masuk }}" readonly>
                            </div>
                        </div>

                        <!-- Editable fields -->
                        <div class="mb-3">
                            <label>Status / Proses Service</label>
                            <select name="status" class="form-control" required>
                                @php $steps = ['Diterima','Diagnosa','Persiapan','Proses','Langkah Akhir','Selesai'];
                                @endphp
                                @foreach($steps as $index => $step)
                                <option value="{{ $index+1 }}" {{ ($service->status == $index+1) ? 'selected' : '' }}>
                                    {{ $step }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Jenis Service</label>
                            <input type="text" name="jenis_service" class="form-control"
                                value="{{ $service->jenis_service }}" placeholder="Contoh: Ganti Oli, Service Berkala">
                        </div>

                        <div class="mb-3">
                            <label>Catatan / Keluhan</label>
                            <textarea name="notes" class="form-control" rows="3"
                                placeholder="Masukkan catatan atau keluhan">{{ $service->notes }}</textarea>
                        </div>

                        <!-- Estimated Selesai -->
                        <div class="mb-3">
                            <label>Estimated Selesai</label>
                            <input type="date" name="estimated_date" class="form-control"
                                value="{{ $service->estimated_date ?? '' }}">
                        </div>

                        <!-- Foto upload -->
                        <div class="mb-3">
                            <label for="photoInput">Upload Foto (opsional)</label>
                            <input type="file" name="photo" id="photoInput" class="form-control" accept="image/*"
                                capture="environment">
                            <small class="text-muted d-block mt-1">Format: JPG, PNG. Max 3MB. Bisa ambil foto langsung
                                dari kamera.</small>

                            <div class="mt-2">
                                @if($service->photo_url)
                                <img id="photoPreview" src="{{ asset('storage/'.$service->photo_url) }}"
                                    style="max-width:150px; border-radius:8px; border:1px solid #ddd;">
                                @else
                                <img id="photoPreview" src=""
                                    style="max-width:150px; display:none; border-radius:8px; border:1px solid #ddd;">
                                @endif
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#confirmUpdateModal">
                            <i class="fas fa-save"></i> Update Data
                        </button>
                        <a href="{{ route('tracking.create') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Konfirmasi Update -->
<div class="modal fade" id="confirmUpdateModal" tabindex="-1" role="dialog" aria-labelledby="confirmUpdateLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content mt-5">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmUpdateLabel">Konfirmasi Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin memperbarui data proses service ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmUpdateButton">Ya, Update</button>
            </div>
        </div>
    </div>
</div>

<script>
const photoInput = document.getElementById('photoInput');
const photoPreview = document.getElementById('photoPreview');

photoInput.addEventListener('change', () => {
    if (photoInput.files && photoInput.files[0]) {
        photoPreview.src = URL.createObjectURL(photoInput.files[0]);
        photoPreview.style.display = 'block';
    }
});

// Tombol konfirmasi modal
document.getElementById('confirmUpdateButton').addEventListener('click', () => {
    document.getElementById('editServiceForm').submit();
});
</script>
@endsection