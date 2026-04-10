@extends('layouts.admin')

@section('title', 'Manajemen Admin')

@section('content')

<style>
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

    .card-header .btn {
        width: 100%;
        font-size: 0.875rem;
        padding: 0.625rem 1rem;
    }

    .card-body {
        padding: 1rem;
    }

    .card-body h6 {
        font-size: 0.95rem;
        margin: 0 0 1rem 0 !important;
    }

    /* Hide table on mobile, show cards instead */
    .table-responsive table {
        display: none;
    }

    /* Mobile card view */
    .mobile-card-view {
        display: block;
    }

    .admin-card {
        background: #fff;
        border: 1px solid #e3e6f0;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .admin-card-header {
        margin-bottom: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e3e6f0;
    }

    .admin-name {
        font-size: 1.05rem;
        font-weight: bold;
        color: #4e73df;
        margin: 0 0 0.25rem 0;
    }

    .admin-info {
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .admin-info i {
        color: #4e73df;
        width: 20px;
        font-size: 0.875rem;
    }

    .admin-info-label {
        font-weight: 600;
        color: #5a5c69;
        font-size: 0.8rem;
        margin-right: 0.25rem;
    }

    .admin-info-value {
        color: #6e707e;
        font-size: 0.875rem;
    }

    .admin-actions {
        display: flex;
        gap: 0.5rem;
        padding-top: 0.75rem;
        border-top: 1px solid #e3e6f0;
    }

    .admin-actions .btn {
        flex: 1;
        font-size: 0.8rem;
        padding: 0.5rem;
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

@media (min-width: 769px) {

    /* Show table on desktop */
    .table-responsive table {
        display: table;
    }

    /* Hide mobile elements on desktop */
    .mobile-card-view {
        display: none;
    }
}

/* Tablet optimization (768px - 1024px) */
@media (min-width: 768px) and (max-width: 1024px) {
    .table {
        font-size: 0.875rem;
    }

    th,
    td {
        padding: 0.5rem;
    }
}
</style>

<div id="content-wrapper" class="d-flex flex-column">

    <div id="content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Manajemen Admin</h1>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="{{ route('manajemenadmin.insert')}}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Admin
                    </a>
                </div>

                <div class="card-body">

                    <h6 class="m-2 font-weight-bold text-primary">List Data Admin FocusAuto</h6>

                    {{-- DESKTOP TABLE VIEW --}}
                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $no = 1; @endphp

                                @foreach ($admin as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->username }}</td>
                                    <td>
                                        <a href="{{ route('manajemenadmin.edit', $row->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#deleteModal{{ $row->id }}">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>

                    {{-- MOBILE CARD VIEW --}}
                    <div class="mobile-card-view">
                        @foreach ($admin as $row)
                        <div class="admin-card">
                            <div class="admin-card-header">
                                <h6 class="admin-name">{{ $row->name }}</h6>
                            </div>

                            <div class="admin-info">
                                <i class="fas fa-user"></i>
                                <div>
                                    <span class="admin-info-label">Username:</span>
                                    <span class="admin-info-value">{{ $row->username }}</span>
                                </div>
                            </div>

                            <div class="admin-actions">
                                <a href="{{ route('manajemenadmin.edit', $row->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deleteModal{{ $row->id }}">
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

{{-- ALL MODALS - OUTSIDE THE CARD, WORKS FOR BOTH DESKTOP AND MOBILE --}}
@foreach ($admin as $row)
<div class="modal fade" id="deleteModal{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalLabel{{ $row->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{ $row->id }}">
                    Hapus Admin?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                Apakah Anda yakin ingin menghapus admin
                <strong>{{ $row->name }}</strong>?
                <br>Data akan hilang permanen.
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                    Batal
                </button>

                <form action="{{ route('manajemenadmin.delete', $row->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Ya, Hapus
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endforeach

@endsection