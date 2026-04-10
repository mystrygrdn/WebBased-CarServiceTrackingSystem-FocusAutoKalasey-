@extends('layouts.customer')

@section('title', 'Riwayat Service')

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

.riwayat-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 12px;
}

.riwayat-card-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 12px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f0f0f0;
}

.riwayat-card-number {
    font-weight: 700;
    font-size: 0.95rem;
    color: #0f172a;
}

.riwayat-card-row {
    display: flex;
    justify-content: space-between;
    align-items: start;
    padding: 8px 0;
    border-bottom: 1px solid #f8f9fa;
}

.riwayat-card-row:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.riwayat-card-label {
    font-weight: 600;
    color: #6c757d;
    font-size: 0.875rem;
    flex-shrink: 0;
    width: 110px;
}

.riwayat-card-value {
    text-align: right;
    flex-grow: 1;
    word-break: break-word;
    font-size: 0.875rem;
}
</style>

<div class="container-fluid mt-4">

    <div class="card-flat">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 style="font-weight:700;">Riwayat Service</h4>
                <div class="meta-small">
                    Riwayat service kendaraan Anda yang telah selesai
                </div>
            </div>
            <div class="meta-small">
                Update Terakhir: {{ now()->format('d M Y') }}
            </div>
        </div>

        @if($riwayat->count() == 0)
        <div class="text-center text-muted py-5">
            Belum ada riwayat service selesai.
        </div>
        @else

        <!-- Desktop Table View -->
        <div class="table-responsive desktop-table">
            <table class="table table-bordered table-hover">

                <thead class="bg-light">
                    <tr>
                        <th width="50">No</th>
                        <th>No Service</th>
                        <th>Kendaraan</th>
                        <th>Jenis Service</th>
                        <th>Tanggal Masuk</th>
                        <th>Admin</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($riwayat as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $item->no_service }}</strong></td>
                        <td>
                            {{ $item->vehicle->merek ?? '-' }}
                            {{ $item->vehicle->model ?? '-' }}
                            ({{ $item->vehicle->tahun ?? '-' }})
                            <br>
                            <small class="text-muted">
                                {{ $item->vehicle->nomor_polisi ?? '-' }}
                            </small>
                        </td>
                        <td>{{ $item->jenis_service }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d M Y') }}</td>
                        <td>{{ $item->admin->name ?? 'Admin' }}</td>
                        <td>
                            <span class="badge badge-success px-3 py-2">
                                Selesai
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="mobile-cards">
            @foreach($riwayat as $item)
            <div class="riwayat-card">
                <div class="riwayat-card-header">
                    <div>
                        <div style="font-size: 0.75rem; color: #94a3b8; margin-bottom: 4px;">
                            #{{ $loop->iteration }}
                        </div>
                        <div class="riwayat-card-number">{{ $item->no_service }}</div>
                    </div>
                    <span class="badge badge-success px-3 py-2">
                        Selesai
                    </span>
                </div>

                <div class="riwayat-card-row">
                    <span class="riwayat-card-label">Kendaraan</span>
                    <span class="riwayat-card-value">
                        {{ $item->vehicle->merek ?? '-' }}
                        {{ $item->vehicle->model ?? '-' }}
                        ({{ $item->vehicle->tahun ?? '-' }})
                        <br>
                        <small class="text-muted">
                            {{ $item->vehicle->nomor_polisi ?? '-' }}
                        </small>
                    </span>
                </div>

                <div class="riwayat-card-row">
                    <span class="riwayat-card-label">Jenis Service</span>
                    <span class="riwayat-card-value">{{ $item->jenis_service }}</span>
                </div>

                <div class="riwayat-card-row">
                    <span class="riwayat-card-label">Tanggal Masuk</span>
                    <span class="riwayat-card-value">
                        {{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d M Y') }}
                    </span>
                </div>

                <div class="riwayat-card-row">
                    <span class="riwayat-card-label">Admin</span>
                    <span class="riwayat-card-value">{{ $item->admin->name ?? 'Admin' }}</span>
                </div>
            </div>
            @endforeach
        </div>

        @endif

    </div>

</div>
@endsection