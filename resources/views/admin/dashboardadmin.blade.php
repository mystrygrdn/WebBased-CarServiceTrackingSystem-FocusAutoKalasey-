@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">

    <!-- ===== CARD ROW ===== -->
    <div class="row">

        <!-- SERVICE ON PROSES -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('tracking.create') }}" class="text-decoration-none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Service On Proses
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $serviceOnProcess }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tools fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- SERVICE SELESAI -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('riwayatservice') }}" class="text-decoration-none">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Service Selesai
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $serviceSelesai }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        @php $bulanIni = now()->month; @endphp
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pendapatan (Bulan Ini)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp {{ number_format($incomePerMonth[$bulanIni], 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ===== GRAFIK ===== -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    Pendapatan Invoice per Bulan
                </div>
                <div class="card-body" style="height:350px; position:relative;">
                    <canvas id="incomeChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('incomeChart');
    if (!ctx) return;

    var raw = @json($incomePerMonth);
    var incomeData = [];
    for (var i = 1; i <= 12; i++) {
        incomeData.push(parseInt(raw[i]) || 0);
    }

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov',
                'Des'
            ],
            datasets: [{
                label: 'Pendapatan',
                data: incomeData,
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78,115,223,0.08)',
                borderWidth: 2,
                pointRadius: 4,
                pointBackgroundColor: '#4e73df',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    min: 0,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
});
</script>

@endsection