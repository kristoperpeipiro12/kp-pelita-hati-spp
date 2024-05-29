@extends('layout.main')
@section('content')
<!-- DataTable with Hover -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pemasukan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pemasukan</li>
        </ol>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                {{-- <h6 class="m-0 font-weight-bold text-primary">Daftar Pemasukan</h6> --}}
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
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Pemasukan(Rp)</th>
                            <th>Tanggal</th>
                            <th>Jenis Transaksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemasukan as $p)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nis }}</td>
                        <td>{{ $p->siswa->nama }}</td>
                        <td>Rp. {{ number_format($p->pemasukan, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $p->jenistransaksi}}</td>


                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection