@extends('layout.main')
@section('content')
<!-- DataTable with Hover -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengeluaran</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-p"><a href="#">Admin</a></li>
            <li class="breadcrumb-p active" aria-current="page">Pengeluaran</li>
        </ol>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                {{-- <h6 class="m-0 font-weight-bold text-primary">Daftar Pengeluaran</h6> --}}
                <div>
                    <!-- Tombol untuk cetak data dalam bentuk Excel -->
                    <a href="#" class="btn btn-success mb-1">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                    <!-- Tombol untuk cetak data dalam bentuk PDF -->
                    <a href="#" class="btn btn-danger mb-1">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
                </div>

            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th class="mini-th">No</th>
                            {{-- <th>Nama</th> --}}
                            <th>Pengeluaran(Rp)</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengeluaran as $keluar)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            {{-- <td>{{ Auth::user()->username }}</td> --}}
                            <td>Rp. {{ number_format($keluar->pengeluaran, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($keluar->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $keluar->keterangan }}</td>

                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
