@extends('layout.main')
@section('content')
    <!-- DataTable with Hover -->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Siswa</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
            </ol>
        </div>
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa/i</h6>
                    <div>
                        <!-- Tombol untuk cetak data dalam bentuk Excel -->
                        <a href="{{ route('siswa.export.excel') }}" class="btn btn-success mb-1">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                        <!-- Tombol untuk cetak data dalam bentuk PDF -->
                        <a href="{{ route('siswa.export.pdf') }}" class="btn btn-danger mb-1">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                    </div>
                    <a href="{{ route('siswa.create') }}" class="btn btn-info mb-1"><i class="fas fa-plus"
                            style="margin-right: 5px;"></i>Tambah</a>
                </div>
                <div class="table-responsive p-3">
                    @include('admin.masterdata.siswa.table',$siswa)
                </div>
            </div>
        </div>
    </div>
@endsection
