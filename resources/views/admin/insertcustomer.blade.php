@extends('layouts.admin')

@section('title', 'Insert Customer')

@section('content')

<style>
.form-section {
    background: #ffffff;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.vehicle-item {
    background: #f8f9fc;
    border: 1px solid #e3e6f0;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 15px;
}

/* ===== MOBILE RESPONSIVE STYLES ===== */
@media (max-width: 768px) {

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

    /* Form sections */
    .form-section {
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.5rem;
    }

    .form-section h5 {
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    /* Vehicle items */
    .vehicle-item {
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.5rem;
    }

    .vehicle-item h6 {
        font-size: 0.95rem;
        margin: 0;
    }

    .vehicle-header {
        flex-direction: row;
        align-items: center;
        margin-bottom: 1rem;
    }

    /* Form elements */
    .form-label {
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 0.375rem;
        color: #5a5c69;
    }

    .form-control,
    .form-select {
        font-size: 0.875rem;
        padding: 0.625rem 0.75rem;
        border-radius: 0.35rem;
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

    /* Buttons */
    .btn {
        font-size: 0.875rem;
        padding: 0.625rem 1rem;
        border-radius: 0.35rem;
        font-weight: 600;
    }

    .btn-sm {
        font-size: 0.8rem;
        padding: 0.375rem 0.75rem;
    }

    /* Action buttons at bottom */
    .form-actions {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .form-actions .btn {
        width: 100%;
    }

    /* Add vehicle button */
    #addVehicleBtn {
        width: 100%;
        margin-top: 0.5rem;
    }

    /* Remove button in vehicle item */
    .removeVehicleBtn {
        white-space: nowrap;
        flex-shrink: 0;
    }

    /* Alert messages */
    .alert {
        font-size: 0.875rem;
        padding: 0.75rem;
        margin-bottom: 1rem;
        border-radius: 0.35rem;
    }

    .alert ul {
        padding-left: 1.25rem;
    }

    .alert li {
        font-size: 0.85rem;
    }
}

/* Tablet optimization (768px - 1024px) */
@media (min-width: 768px) and (max-width: 1024px) {
    .form-section {
        padding: 1.25rem;
    }

    .vehicle-item {
        padding: 1.25rem;
    }

    .form-control,
    .form-select {
        font-size: 0.9rem;
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

            <h1 class="h3 mb-4 text-gray-800">Tambah Customer</h1>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Customer</h6>
                </div>

                <div class="card-body">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('customer.store') }}" method="POST">
                        @csrf

                        {{-- DATA CUSTOMER --}}
                        <div class="form-section">
                            <h5 class="text-primary">Data Customer</h5>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama"
                                        placeholder="Masukkan nama customer" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Telepon</label>
                                    <input type="text" class="form-control" name="telepon"
                                        placeholder="Contoh: 08123456789" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" name="alamat" rows="3"
                                        placeholder="Masukkan alamat lengkap" required></textarea>
                                </div>
                            </div>
                        </div>

                        {{-- KENDARAAN --}}
                        <div class="form-section">
                            <h5 class="text-primary">Tambah Kendaraan</h5>

                            <div id="vehicles-container">

                                {{-- KENDARAAN PERTAMA --}}
                                <div class="vehicle-item">
                                    <div class="d-flex justify-content-between align-items-center vehicle-header">
                                        <h6 class="mb-0">Kendaraan 1</h6>
                                        <button type="button" class="btn btn-danger btn-sm removeVehicleBtn">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Merek</label>
                                            <select name="vehicles[0][merek]" class="form-control">
                                                <option value="">Pilih Merek</option>
                                                <option value="Toyota">Toyota</option>
                                                <option value="Honda">Honda</option>
                                                <option value="Suzuki">Suzuki</option>
                                                <option value="Daihatsu">Daihatsu</option>
                                                <option value="Mitsubishi">Mitsubishi</option>
                                                <option value="Nissan">Nissan</option>
                                                <option value="Wuling">Wuling</option>
                                                <option value="Mazda">Mazda</option>
                                                <option value="Lexus">Lexus</option>
                                                <option value="Hyundai">Hyundai</option>
                                                <option value="Ford">Ford</option>
                                                <option value="Volkswagen">Volkswagen</option>
                                                <option value="Kia">Kia</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Model</label>
                                            <input type="text" name="vehicles[0][model]" class="form-control"
                                                placeholder="Contoh: Avanza">
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Tahun</label>
                                            <input type="text" name="vehicles[0][tahun]" class="form-control"
                                                maxlength="4" placeholder="Contoh: 2023">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Warna</label>
                                            <input type="text" name="vehicles[0][warna]" class="form-control"
                                                placeholder="Contoh: Hitam">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nomor Polisi</label>
                                            <input type="text" name="vehicles[0][nomor_polisi]" class="form-control"
                                                placeholder="Contoh: B 1234 XYZ">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <button type="button" id="addVehicleBtn" class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i> Tambah Kendaraan Lain
                            </button>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Data
                            </button>
                            <a href="{{ route('customer.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function() {

    const container = document.getElementById('vehicles-container');
    const addBtn = document.getElementById('addVehicleBtn');

    // Function to update vehicle titles (Kendaraan 1, 2, 3...)
    function updateVehicleTitles() {
        const items = container.querySelectorAll('.vehicle-item');
        items.forEach((item, index) => {
            item.querySelector('h6').textContent = `Kendaraan ${index + 1}`;
        });
    }

    // Add vehicle
    addBtn.addEventListener('click', function() {

        const index = container.querySelectorAll('.vehicle-item').length;

        const html = `
        <div class="vehicle-item">
            <div class="d-flex justify-content-between align-items-center vehicle-header">
                <h6 class="mb-0">Kendaraan ${index + 1}</h6>
                <button type="button" class="btn btn-danger btn-sm removeVehicleBtn">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>

            <div class="row mt-2">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Merek</label>
                    <select name="vehicles[${index}][merek]" class="form-control">
                        <option value="">Pilih Merek</option>
                        <option value="Toyota">Toyota</option>
                        <option value="Honda">Honda</option>
                        <option value="Suzuki">Suzuki</option>
                        <option value="Daihatsu">Daihatsu</option>
                        <option value="Mitsubishi">Mitsubishi</option>
                        <option value="Nissan">Nissan</option>
                        <option value="Wuling">Wuling</option>
                        <option value="Mazda">Mazda</option>
                        <option value="Lexus">Lexus</option>
                        <option value="Hyundai">Hyundai</option>
                        <option value="Ford">Ford</option>
                        <option value="Volkswagen">Volkswagen</option>
                        <option value="Kia">Kia</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Model</label>
                    <input type="text" name="vehicles[${index}][model]" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Tahun</label>
                    <input type="text" name="vehicles[${index}][tahun]" class="form-control" maxlength="4">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Warna</label>
                    <input type="text" name="vehicles[${index}][warna]" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nomor Polisi</label>
                    <input type="text" name="vehicles[${index}][nomor_polisi]" class="form-control">
                </div>
            </div>
        </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        updateVehicleTitles();
    });

    // Remove vehicle
    container.addEventListener('click', function(e) {
        if (e.target.closest('.removeVehicleBtn')) {
            e.target.closest('.vehicle-item').remove();
            updateVehicleTitles();
        }
    });

});
</script>


@endsection