@extends('layout.main')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Informasi</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Informasi</li>
            </ol>
        </div>

        <div class="info-content">
            <div class="card w-100 info-con-catat">
                <h5 class="text-center mt-4">Tambah Informasi</h5>
                <hr class="mx-4" style="margin-bottom: 10%" size="2" color="#8EA7E9">
                <form action="{{ route('informasi.store') }}" method="POST">
                    @csrf
                    <div class="form-group info-con-input w-100">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" name="judul" placeholder="Judul Informasi"
                            id="judul">
                    </div>
                    <div class="form-group info-con-input w-100">
                        <label for="info">Informasi</label>
                        <textarea name="info" id="info" class="info-textarea"></textarea>
                    </div>
                    <div class="form-group info-con-input w-100">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" placeholder="Isi Informasi"
                            id="tanggal">
                    </div>
                    <div class="info-con-input py-3">
                        <input type="submit" name="submit" id="kirim" class="btn btn-success">
                        <input type="reset" name="reset" id="hapus" class="btn btn-danger">
                    </div>
                </form>
            </div>
            <div class="card w-100 info-con-record">
                <h3 class="text-center mt-3 info-terkini">Informasi Terkini</h3>
                @foreach ($informasi as $i)
                <hr class="mx-4" style="margin-bottom: 5%" size="2" color="#8EA7E9">
                    
                <span class="record-judul">{{ $i->judul }}</span>
                <span class="text-justify record-info">
                   {{ $i->info }}
                </span>
                <div class="record-tgl">
                    <p class="text-right" style="font-size: 13px">Tercatat tanggal : <span class="font-weight-bold">{{ \Carbon\Carbon::parse($i->tanggal)->format('d-m-Y') }}</span></p>
                </div>
                <div class="con-record-button">
                    <button class="btn btn-warning">Edit</button>
                    <button class="btn btn-danger">Hapus</button>
                </div>
                @endforeach
            </div>



        </div>


    </div>
@endsection
