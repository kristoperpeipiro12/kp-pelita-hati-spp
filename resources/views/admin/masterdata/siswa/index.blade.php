@extends('layout.main')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="col-lg-12">
        <div class="card my-3">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h3 mb-0 text-gray-800">Data Siswa</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
                    </ol>
                </div>
            </div>

            <div class="card-body">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-2 pt-3">
                        <div class="form-group d-flex align-items-center">
                            <label for="filterKelas" class="d-flex align-items-center mt-2 mr-2">Kelas</label>
                            <select id="filterKelas" class="form-control form-control-sm" style="width: 120px;">
                                <option value="">Semua Kelas</option>
                                @php
                                $kelasList = ['1', '2', '3', '4', '5', '6'];
                                @endphp
                                @foreach ($kelasList as $kelas)
                                <option value="{{ $kelas }}">Kelas {{ $kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 pt-3">
                        <div class="form-group d-flex align-items-center">
                            <label for="filterJenisKelamin" class="d-flex align-items-center mt-2 mr-2">Jenis Kelamin</label>
                            <select id="filterJenisKelamin" class="form-control form-control-sm" style="width: 120px;">
                                <option value="">Semua</option>
                                @php
                                $jkList = ['Laki-laki', 'Perempuan'];
                                @endphp
                                @foreach ($jkList as $jk)
                                <option value="{{ $jk }}">{{ $jk }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-7"></div>

                    <div class="col-lg-1">
                        <a href="{{ route('admin.siswa.create') }}" class="btn btn-info">
                            <i class="fas fa-plus mr-2"></i>Tambah
                        </a>
                    </div>
                </div>

                @include('admin.masterdata.siswa.table',$siswa)
            </div>
        </div>
    </div>
</div>


@endsection
