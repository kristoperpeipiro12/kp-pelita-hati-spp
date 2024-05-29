@extends('layout.main')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Informasi</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Informasi</li>
        </ol>
    </div>

    <div class="info-content">
        <div class="card w-100 info-con-catat">
            <h5 class="text-center mt-4">Edit Informasi</h5>
            <hr class="mx-4" style="margin-bottom: 10%" size="2" color="#8EA7E9">
            <form action="{{ route('informasi.update', $informasi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group info-con-input w-100">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" name="judul" placeholder="Judul Informasi" id="judul" value="{{ $informasi->judul }}" >
                </div>
                <div class="form-group info-con-input w-100">
                    <label for="info">Informasi</label>
                    <textarea name="info" id="info" class="form-control info-textarea" >{{ $informasi->info }}</textarea>
                </div>
                <div class="form-group info-con-input w-100">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" value="{{ $informasi->tanggal }}" id="tanggal" >
                </div>

                <div class="d-flex w-100" style="gap: 20px">
                    <button type="submit" class="btn btn-primary flex-fill">Simpan</button>
                    <a href="{{ route('informasi.index') }}" class="btn btn-secondary flex-fill">Batal</a>
                </div>
            </form>
        </div>
        <div class="card w-100 info-con-record">
            <h3 class="text-center mt-3 info-terkini">Informasi Terkini</h3>
            @if ($informasi)
            <hr class="mx-4" style="margin-bottom: 5%" size="2" color="#8EA7E9">
                <span class="record-judul d-inline-block w-100">{{ $informasi->judul }}</span>
                <span class="text-justify record-info d-inline-block w-100">{{ $informasi->info }}</span>
                <div class="record-tgl">
                    <p class="text-right" style="font-size: 13px">Tercatat tanggal : <span class="font-weight-bold">{{ \Carbon\Carbon::parse($informasi->tanggal)->format('d-m-Y') }}</span></p>
                </div>
            @else
            <p class="text-center">Tidak ada informasi yang tersedia.</p>
            @endif
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus informasi ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="{{ route('informasi.delete', $informasi->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
