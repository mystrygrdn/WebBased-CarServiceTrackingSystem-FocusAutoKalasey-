@extends('layouts.admin')

@section('title', 'Edit Admin')

@section('content')

<style>
/* ================= MOBILE RESPONSIVE ================= */
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

    .card-body {
        padding: 1rem;
    }

    /* Form elements */
    .mb-3 {
        margin-bottom: 0.875rem !important;
    }

    label {
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 0.375rem;
        color: #5a5c69;
        display: block;
    }

    .form-control {
        font-size: 0.875rem;
        padding: 0.625rem 0.75rem;
        border-radius: 0.35rem;
        min-height: 44px;
    }

    /* Action buttons */
    .form-actions {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .form-actions .btn {
        width: 100%;
        font-size: 0.875rem;
        padding: 0.625rem 1rem;
        font-weight: 600;
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
    .form-control {
        font-size: 0.9rem;
    }

    .card-body {
        padding: 1.25rem;
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

/* Desktop button layout */
@media (min-width: 769px) {
    .form-actions {
        display: flex;
        flex-direction: row;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .form-actions .btn {
        width: auto;
    }
}
</style>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">

            <h1 class="h3 mb-4 text-gray-800">Edit Admin</h1>

            <div class="card shadow mb-4">
                <div class="card-body">

                    <form id="editForm" action="{{ route('manajemenadmin.update', $admin->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ $admin->name }}"
                                placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="{{ $admin->username }}"
                                placeholder="Masukkan username" required>
                        </div>

                        <div class="mb-3">
                            <label>Password (isi jika ingin mengubah)</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Kosongkan jika tidak ingin mengubah">
                            <small class="text-muted d-block mt-1">
                                Biarkan kosong jika tidak ingin mengubah password
                            </small>
                        </div>

                        <!-- Action buttons -->
                        <div class="form-actions">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#updateModal">
                                <i class="fas fa-save"></i> Update Data
                            </button>
                            <a href="{{ route('manajemenadmin') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>

                    <!-- MODAL KONFIRMASI UPDATE -->
                    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog"
                        aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Konfirmasi Update</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    Apakah Anda yakin ingin memperbarui data admin
                                    <strong>{{ $admin->name }}</strong>?
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="document.getElementById('editForm').submit();">
                                        Ya, Update
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection