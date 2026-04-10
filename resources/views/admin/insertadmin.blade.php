@extends('layouts.admin')

@section('title', 'Insert Admin')

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

    .card-header {
        padding: 0.75rem 1rem;
    }

    .card-header h6 {
        font-size: 0.95rem;
    }

    .card-body {
        padding: 1rem;
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
        margin-bottom: 0;
    }

    .alert li {
        font-size: 0.85rem;
    }

    /* Form elements */
    .mb-3 {
        margin-bottom: 0.875rem !important;
    }

    .form-label {
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
            <h1 class="h3 mb-4 text-gray-800">Tambah Admin</h1>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Admin</h6>
                </div>

                <div class="card-body">

                    {{-- Tampilkan error validasi --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Tampilkan pesan sukses --}}
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('manajemenadmin.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Masukkan username" value="{{ old('username') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukkan password" required>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('manajemenadmin') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection