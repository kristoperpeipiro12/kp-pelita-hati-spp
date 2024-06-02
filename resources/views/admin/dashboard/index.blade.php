@extends('layout.main')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <div class="container-fluid" id="container-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pemasukan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ 'Rp ' . number_format(App\Models\Pemasukan::getTotalPemasukan(), 2, ',', '.') }}
                                        </div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span>Tercatat sejak {{ now()->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pengeluaran -->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pengeluaran</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ 'Rp ' . number_format(App\Models\Pengeluaran::getTotalPengeluaran(), 2, ',', '.') }}
                                        </div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span>Tercatat sejak {{ now()->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-money-bill fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Siswa Aktif-->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Siswa Aktif</div>
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            {{ App\Models\Siswa::getTotalSiswa() }}
                                        </div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span>Tahun Angkatan {{ date('Y') - 1 }}/{{ date('Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pending Requests Card Example -->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pemasukan Hari ini</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{-- Menampilkan total pemasukan hari ini --}}
                                            Rp.
                                            {{ number_format(App\Models\Pemasukan::where('konfirmasi', 'Terima')->whereDate('tanggal_bayar', today())->sum('jumlah_bayar'), 0, ',', '.') }}
                                        </div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span>Tercatat sejak {{ now()->formatLocalized('%d %B %Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Grafik Total Pemasukan & Pengeluaran</h6>
                            </div>
                            <div class="card-body justify-content-center">
                                <div class="d-flex justify-content-center w-100">
                                    <canvas id="pemasukanPengeluaranChart"
                                        style="max-width: 400px; max-height: 400px"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/admin/chart/get-total-pemasukan-pengeluaran')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('pemasukanPengeluaranChart').getContext('2d');
                    const pemasukanPengeluaranChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Total Pemasukan', 'Total Pengeluaran'],
                            datasets: [{
                                data: [data.totalPemasukan, data.totalPengeluaran],
                                backgroundColor: ['rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 99, 132, 0.2)'
                                ],
                                borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return 'Rp ' + tooltipItem.raw.toLocaleString('id-ID');
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
        });
    </script>
@endsection
