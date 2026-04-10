@extends('layouts.admin')

@section('title', 'Proses Service')

@section('content')

@php
// ===== DETECT LOGGED IN ADMIN (semua kemungkinan guard/session) =====
$loggedAdmin = auth('admin')->user()
?? auth()->user()
?? null;

$loggedAdminName = $loggedAdmin->name
?? session('admin_name')
?? session('name')
?? session('admin')
?? '-';

$loggedAdminId = $loggedAdmin->id
?? session('admin_id')
?? null;
@endphp

<style>
/* ================= STEPPER ================= */
.stepper {
    display: flex;
    justify-content: space-between;
    gap: 6px;
    margin-bottom: 1rem;
    flex-wrap: nowrap;
}

.step {
    flex: 1;
    text-align: center;
    position: relative;
    min-width: 70px;
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
    font-size: 12px;
}

.step.active .step-circle {
    background: #4e73df;
}

.step-label {
    margin-top: 5px;
    font-size: 0.75rem;
    white-space: nowrap;
}

/* ================= FOTO ================= */
.photo-card {
    width: 80px;
    height: 80px;
    overflow: hidden;
    border-radius: 8px;
    border: 1px solid #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
}

.photo-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ================= MOBILE RESPONSIVE ================= */
@media (max-width: 768px) {

    .container-fluid {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }

    .h4 {
        font-size: 1.25rem;
        margin-bottom: 1rem !important;
    }

    .alert {
        font-size: 0.875rem;
        padding: 0.75rem;
        margin-bottom: 1rem;
    }

    .card {
        border-radius: 0.5rem;
        margin-bottom: 1rem;
    }

    .card-body {
        padding: 1rem;
    }

    .card-body h5 {
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .btn {
        font-size: 0.875rem;
        padding: 0.625rem 1rem;
        border-radius: 0.35rem;
    }

    .mb-3 .btn {
        width: 100%;
    }

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

    .w-100 {
        font-weight: 600;
    }

    .table-responsive table {
        display: none;
    }

    .mobile-service-view {
        display: block;
    }

    .service-card {
        background: #fff;
        border: 1px solid #e3e6f0;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .service-card-header {
        margin-bottom: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e3e6f0;
    }

    .service-customer-name {
        font-size: 1.05rem;
        font-weight: bold;
        color: #4e73df;
        margin: 0 0 0.25rem 0;
    }

    .service-vehicle {
        font-size: 0.875rem;
        color: #6e707e;
    }

    .service-info {
        margin-bottom: 0.75rem;
    }

    .service-info-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #5a5c69;
        display: block;
        margin-bottom: 0.25rem;
    }

    .service-info-value {
        font-size: 0.875rem;
        color: #6e707e;
    }

    .stepper {
        gap: 1px;
        margin-top: 0.5rem;
    }

    .step {
        min-width: 38px;
    }

    .step-circle {
        width: 18px;
        height: 18px;
        line-height: 18px;
        font-size: 9px;
    }

    .step-label {
        font-size: 0.55rem;
        margin-top: 2px;
        line-height: 1.1;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .step:not(:last-child)::after {
        top: 8px;
        height: 1.5px;
    }

    .mobile-photo {
        margin-top: 0.5rem;
    }

    .photo-card {
        width: 100%;
        height: 150px;
        margin-bottom: 0.75rem;
    }

    .service-actions {
        display: flex;
        gap: 0.5rem;
        padding-top: 0.75rem;
        border-top: 1px solid #e3e6f0;
    }

    .service-actions .btn {
        flex: 1;
        font-size: 0.8rem;
        padding: 0.5rem;
        font-weight: 600;
    }

    .btn-sm {
        font-size: 0.8rem;
        padding: 0.375rem 0.75rem;
    }

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
    .table-responsive table {
        display: table;
    }

    .mobile-service-view {
        display: none;
    }

    .table {
        white-space: nowrap;
    }

    table {
        min-width: 90px;
    }
}

@media (min-width: 768px) and (max-width: 1024px) {

    .form-control,
    select.form-control {
        font-size: 0.9rem;
    }

    table {
        font-size: 0.875rem;
    }
}

.modal-dialog {
    margin-top: 60px;
}

@media (max-width: 768px) {
    .modal-dialog {
        margin-top: 1rem;
    }
}

/* Admin field locked style */
.admin-locked {
    background-color: #f8f9fc !important;
    color: #5a5c69 !important;
    cursor: not-allowed !important;
    border: 1px solid #d1d3e2 !important;
}
</style>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <h1 class="h4 mb-4 text-gray-800">Proses Service</h1>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- DEBUG SEMENTARA - hapus setelah konfirmasi nama muncul --}}
            {{-- <div class="alert alert-info" style="font-size:12px;">
                DEBUG — auth('admin'): {{ optional(auth('admin')->user())->name ?? 'NULL' }} |
            auth(): {{ optional(auth()->user())->name ?? 'NULL' }} |
            session admin_id: {{ session('admin_id') ?? 'NULL' }} |
            session name: {{ session('name') ?? 'NULL' }} |
            Hasil: {{ $loggedAdminName }} (ID: {{ $loggedAdminId ?? 'NULL' }})
        </div> --}}

        <!-- Tombol collapse -->
        <div class="mb-3">
            <button class="btn btn-primary d-flex justify-content-between align-items-center" type="button"
                data-toggle="collapse" data-target="#formServiceCollapse">
                <span><i class="fas fa-plus"></i> Tambah Proses Service</span>
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>

        <div class="collapse" id="formServiceCollapse">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">

                    <form action="{{ route('tracking.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Pilih Customer</label>
                                <select name="customers_id" class="form-control" id="customerSelect" required>
                                    <option value="">-- Pilih Customer --</option>
                                    @foreach($customers as $c)
                                    <option value="{{ $c->id }}">{{ $c->nama }} ({{ $c->no_hp }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label>Pilih Kendaraan</label>
                                <select name="vehicles_id" class="form-control" id="vehicleSelect" required>
                                    <option value="">-- Pilih Customer terlebih dahulu --</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Admin Penanggung Jawab</label>
                                {{-- Tampilkan nama, tidak bisa diubah --}}
                                <input type="text" class="form-control admin-locked" value="{{ $loggedAdminName }}"
                                    disabled readonly>
                                {{-- Kirim ID ke controller --}}
                                <input type="hidden" name="admin_id" value="{{ $loggedAdminId }}">
                            </div>

                            <div class="col-md-6">
                                <label>Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Estimated Selesai</label>
                                <input type="date" name="estimated_date" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Jenis Service</label>
                            <input type="text" name="jenis_service" class="form-control"
                                placeholder="Contoh: Ganti Oli, Service Berkala">
                        </div>

                        <div class="mb-3">
                            <label>Catatan / Keluhan (Optional)</label>
                            <textarea name="notes" class="form-control" rows="3"
                                placeholder="Masukkan catatan atau keluhan customer"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="">-- Pilih Status --</option>
                                @php
                                $stepLabels = ['Diterima','Diagnosa','Persiapan','Proses','Langkah Akhir','Selesai'];
                                @endphp
                                @foreach($stepLabels as $index => $step)
                                <option value="{{ $index+1 }}">{{ $step }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label>Upload Foto</label>
                            <input type="file" name="photo" class="form-control" accept="image/*" capture="environment">
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="fas fa-save"></i> Tambahkan Proses Service
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <!-- DAFTAR PROSES SERVICE -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h5>Daftar Proses Service</h5>

                <!-- DESKTOP TABLE VIEW -->
                <div class="table-responsive">
                    <table class="table table-hover table-sm align-middle">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Kendaraan</th>
                                <th>Status</th>
                                <th>Estimasi</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $steps = ['Diterima','Diagnosa','Persiapan','Proses','Langkah Akhir','Selesai'];
                            @endphp

                            @foreach($service_tracking as $s)
                            <tr>
                                <td>{{ optional($s->customer)->nama }}</td>
                                <td>{{ optional($s->vehicle)->nomor_polisi }} ({{ optional($s->vehicle)->merek }}
                                    {{ optional($s->vehicle)->model }})</td>
                                <td>
                                    <div class="stepper">
                                        @foreach($steps as $index => $step)
                                        <div class="step {{ ($index+1) <= $s->status ? 'active' : '' }}">
                                            <div class="step-circle">{{ $index+1 }}</div>
                                            <div class="step-label">{{ $step }}</div>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    {{ $s->estimated_date ? \Carbon\Carbon::parse($s->estimated_date)->format('d-m-Y') : '-' }}
                                </td>
                                <td>
                                    @if($s->photo_url)
                                    <div class="photo-card mb-1">
                                        <a href="{{ asset('storage/'.$s->photo_url) }}" target="_blank">
                                            <img src="{{ asset('storage/'.$s->photo_url) }}">
                                        </a>
                                    </div>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('tracking.edit', $s->id) }}" class="btn btn-warning btn-sm mb-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm mb-1" data-toggle="modal"
                                        data-target="#deleteModal{{ $s->id }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- DELETE MODAL -->
                            <div class="modal fade" id="deleteModal{{ $s->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus Data</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Yakin ingin menghapus data service ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <form action="{{ route('tracking.destroy', $s->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- MOBILE CARD VIEW -->
                <div class="mobile-service-view">
                    @php
                    $steps = ['Diterima','Diagnosa','Persiapan','Proses','Langkah Akhir','Selesai'];
                    @endphp

                    @foreach($service_tracking as $s)
                    <div class="service-card">
                        <div class="service-card-header">
                            <h6 class="service-customer-name">{{ optional($s->customer)->nama }}</h6>
                            <div class="service-vehicle">
                                <i class="fas fa-car text-primary"></i>
                                {{ optional($s->vehicle)->nomor_polisi }} - {{ optional($s->vehicle)->merek }}
                                {{ optional($s->vehicle)->model }}
                            </div>
                        </div>

                        <div class="service-info">
                            <span class="service-info-label">Status Progress</span>
                            <div class="stepper">
                                @foreach($steps as $index => $step)
                                <div class="step {{ ($index+1) <= $s->status ? 'active' : '' }}">
                                    <div class="step-circle">{{ $index+1 }}</div>
                                    <div class="step-label">{{ $step }}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        @if($s->estimated_date)
                        <div class="service-info">
                            <span class="service-info-label">Estimasi Selesai</span>
                            <span class="service-info-value">
                                <i class="fas fa-calendar text-primary"></i>
                                {{ \Carbon\Carbon::parse($s->estimated_date)->format('d-m-Y') }}
                            </span>
                        </div>
                        @endif

                        @if($s->photo_url)
                        <div class="mobile-photo">
                            <span class="service-info-label">Foto Kendaraan</span>
                            <div class="photo-card">
                                <a href="{{ asset('storage/'.$s->photo_url) }}" target="_blank">
                                    <img src="{{ asset('storage/'.$s->photo_url) }}" alt="Service Photo">
                                </a>
                            </div>
                        </div>
                        @endif

                        <div class="service-actions">
                            <a href="{{ route('tracking.edit', $s->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#deleteModal{{ $s->id }}">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let customers = @json($customers);
    let customerSelect = document.getElementById('customerSelect');
    let vehicleSelect = document.getElementById('vehicleSelect');

    customerSelect.addEventListener('change', function() {
        let customerId = this.value;
        let customer = customers.find(c => c.id == customerId);

        vehicleSelect.innerHTML = '<option value="">-- Pilih Kendaraan --</option>';

        if (customer && customer.vehicles && customer.vehicles.length > 0) {
            customer.vehicles.forEach(v => {
                let option = document.createElement('option');
                option.value = v.id;
                option.text = `${v.nomor_polisi} - ${v.merek} ${v.model}`;
                vehicleSelect.appendChild(option);
            });
        }
    });
});
</script>

@endsection