@extends('layout.main')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>

    <div class="row mb-3">
        <!-- Total Pemasukan -->
        <div class="col-xl-3 col-md-6 mb-4">
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
        <div class="col-xl-3 col-md-6 mb-4">
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
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Siswa Aktif</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                {{ App\Models\Siswa::getTotalSiswa() }}
                            </div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span>Tahun Angkatan {{ date('Y') - 1}}/{{ date('Y')}}</span>
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
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pemasukan Hari ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{-- Menampilkan total pemasukan hari ini --}}
                                Rp. {{ number_format(App\Models\Pemasukan::whereDate('tanggal', today())->sum('pemasukan'), 0, ',', '.') }}
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


        <!-- Area Chart -->
        <div class="col-12">
            <div class="card mb-4">

            </div>
        </div>
    </div>

</div>
@endsection
