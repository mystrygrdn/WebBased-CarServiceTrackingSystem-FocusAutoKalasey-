@extends('layouts.admin')

@section('title', 'Edit Customer')

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

/* Tablet optimization (768px - 1024px) */
@media (min-width: 768px) and (max-width: 1024px) {
    .form-section {
        padding: 1.25rem;
    }

    .vehicle-item {
        padding: 1.25rem;
    }

    .form-control,
    select.form-control {
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

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Edit Customer</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Customer</h6>
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

            <form id="updateForm" action="{{ route('customer.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- ✅ HIDDEN INPUT: Track kendaraan yang dihapus --}}
                <input type="hidden" name="deleted_vehicles" id="deletedVehiclesInput" value="">

                {{-- DATA CUSTOMER --}}
                <div class="form-section">
                    <h5 class="text-primary">Data Customer</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control"
                                value="{{ old('nama', $customer->nama) }}" placeholder="Masukkan nama customer"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Telepon</label>
                            <input type="text" name="telepon" class="form-control"
                                value="{{ old('telepon', $customer->no_hp) }}" placeholder="Contoh: 08123456789"
                                required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap"
                                required>{{ old('alamat', $customer->alamat) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- KENDARAAN --}}
                <div class="form-section">
                    <h5 class="text-primary">Kendaraan</h5>
                    <div id="vehicles-container">

                        @php
                        $mereks =
                        ['Toyota','Honda','Suzuki','Daihatsu','Mitsubishi','Nissan','Wuling','Mazda','Lexus','Hyundai','Ford','Volkswagen','Kia','Lainnya'];
                        @endphp

                        @foreach ($customer->vehicles as $index => $v)
                        <div class="vehicle-item">
                            <div class="d-flex justify-content-between align-items-center vehicle-header">
                                <h6 class="mb-0">Kendaraan {{ $index + 1 }}</h6>
                                <button type="button" class="btn btn-danger btn-sm removeVehicleBtn">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>

                            <input type="hidden" name="vehicles[{{ $index }}][id]" value="{{ $v->id }}">

                            <div class="row mt-2">
                                <div class="col-md-4 mb-3">
                                    <label>Merek</label>
                                    <select name="vehicles[{{ $index }}][merek]" class="form-control" required>
                                        <option value="">Pilih Merek</option>
                                        @foreach ($mereks as $merek)
                                        <option value="{{ $merek }}" {{ $v->merek == $merek ? 'selected' : '' }}>
                                            {{ $merek }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Model</label>
                                    <input type="text" name="vehicles[{{ $index }}][model]" class="form-control"
                                        value="{{ $v->model }}" placeholder="Contoh: Avanza" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Tahun</label>
                                    <input type="text" name="vehicles[{{ $index }}][tahun]" class="form-control"
                                        maxlength="4" value="{{ $v->tahun }}" placeholder="Contoh: 2023" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Warna</label>
                                    <input type="text" name="vehicles[{{ $index }}][warna]" class="form-control"
                                        value="{{ $v->warna }}" placeholder="Contoh: Hitam" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Nomor Polisi</label>
                                    <input type="text" name="vehicles[{{ $index }}][nomor_polisi]" class="form-control"
                                        value="{{ $v->nomor_polisi }}" placeholder="Contoh: B 1234 XYZ" required>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <button type="button" id="addVehicleBtn" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah Kendaraan Lain
                    </button>
                </div>

                <div class="form-actions">
                    <button type="button" id="confirmUpdateBtn" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Data
                    </button>
                    <a href="{{ route('customer.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- MODAL KONFIRMASI (Bootstrap 4) --}}
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin memperbarui data customer ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="modalSubmitBtn">Ya, Update</button>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function() {

    const container = document.getElementById('vehicles-container');
    const deletedVehiclesInput = document.getElementById('deletedVehiclesInput');

    const mereks = ['Toyota', 'Honda', 'Suzuki', 'Daihatsu', 'Mitsubishi', 'Nissan', 'Wuling', 'Mazda', 'Lexus',
        'Hyundai', 'Ford', 'Volkswagen', 'Kia', 'Lainnya'
    ];
    let newVehicleCount = 0;

    // Tambah kendaraan baru
    document.getElementById('addVehicleBtn').addEventListener('click', function() {
        newVehicleCount++;
        const options = mereks.map(m => `<option value="${m}">${m}</option>`).join('');
        const html = `
        <div class="vehicle-item">
            <div class="d-flex justify-content-between align-items-center vehicle-header">
                <h6 class="mb-0">Kendaraan Baru</h6>
                <button type="button" class="btn btn-danger btn-sm removeVehicleBtn">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
            <div class="row mt-2">
                <div class="col-md-4 mb-3">
                    <label>Merek</label>
                    <select name="vehicles[new_${newVehicleCount}][merek]" class="form-control" required>
                        <option value="">Pilih Merek</option>
                        ${options}
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Model</label>
                    <input type="text" name="vehicles[new_${newVehicleCount}][model]" class="form-control" placeholder="Contoh: Avanza" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Tahun</label>
                    <input type="text" name="vehicles[new_${newVehicleCount}][tahun]" class="form-control" maxlength="4" placeholder="Contoh: 2023" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Warna</label>
                    <input type="text" name="vehicles[new_${newVehicleCount}][warna]" class="form-control" placeholder="Contoh: Hitam" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Nomor Polisi</label>
                    <input type="text" name="vehicles[new_${newVehicleCount}][nomor_polisi]" class="form-control" placeholder="Contoh: B 1234 XYZ" required>
                </div>
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', html);
    });

    // ✅ HAPUS KENDARAAN (dengan tracking untuk delete dari database)
    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('removeVehicleBtn') || e.target.closest('.removeVehicleBtn')) {
            const vehicleItem = e.target.closest('.vehicle-item');
            if (vehicleItem) {
                // Cek apakah ini kendaraan existing (ada input hidden dengan name="vehicles[X][id]")
                const vehicleIdInput = vehicleItem.querySelector('input[name*="[id]"]');

                if (vehicleIdInput && vehicleIdInput.value) {
                    // Kendaraan existing - tambahkan ID ke deleted list
                    const vehicleId = vehicleIdInput.value;
                    const currentDeleted = deletedVehiclesInput.value;

                    // Append ID ke hidden input (comma separated)
                    deletedVehiclesInput.value = currentDeleted ?
                        currentDeleted + ',' + vehicleId :
                        vehicleId;

                    console.log('✅ Vehicle ID akan dihapus:', vehicleId);
                    console.log('📝 Total IDs yang akan dihapus:', deletedVehiclesInput.value);
                }

                // Hapus dari UI
                vehicleItem.remove();
            }
        }
    });

    // Modal konfirmasi update (Bootstrap 4)
    document.getElementById('confirmUpdateBtn').addEventListener('click', function() {
        $('#updateModal').modal('show');
    });

    document.getElementById('modalSubmitBtn').addEventListener('click', function() {
        document.getElementById('updateForm').submit();
    });

});
</script>

@endsection