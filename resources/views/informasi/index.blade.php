@extends('layout.main')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Informasi</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
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
                    <input type="text" class="form-control" name="judul" placeholder="Judul Informasi" id="judul">
                </div>
                <div class="form-group info-con-input w-100">
                    <label for="info">Informasi</label>
                    <textarea name="info" id="info" class="form-control info-textarea"></textarea>
                </div>
                <div class="form-group info-con-input w-100">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" placeholder="Isi Informasi" id="tanggal">
                </div>
                <div class="info-con-input py-3">
                    <input type="submit" name="submit" id="kirim" class="btn btn-success">
                    <input type="reset" name="reset" id="hapus" class="btn btn-dark">
                </div>
            </form>
        </div>
        <div class="card w-100 info-con-record">
            <h3 class="text-center mt-3 info-terkini">Informasi Terkini</h3>
            @forelse ($informasi as $i)
            <hr class="mx-4" style="margin-bottom: 5%" size="2" color="#8EA7E9">
        <form action="" method="post" class="">
            <span class="record-judul d-inline-block w-100" id="isi-judul">{{ $i->judul }}</span>
            <input type="text" class="d-none w-100 form-control" id="edit-judul" placeholder="Edit Judul">
            <span class="text-justify record-info d-inline-block w-100" id="isi-info">
                {{ $i->info }}
            </span>
            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
            <input type="text" class="d-none w-100 form-control" id="edit-info" placeholder="Edit Info">
        </form>
            <div class="record-tgl">
                <p class="text-right" style="font-size: 13px">Tercatat tanggal : <span
                        class="font-weight-bold">{{ \Carbon\Carbon::parse($i->tanggal)->format('d-m-Y') }}</span></p>
            </div>
            <div class="con-record-button">
                <button class="btn btn-warning" id="btn-edit-info">Edit</button>
                <button class="btn btn-primary d-none" id="btn-baru-info">Simpan</button>
                <form action="{{ route('informasi.delete', $i->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm ml-2" id="btn-simpan-info">
                        Hapus
                    </button>
                </form>
            </div>
            @empty
            <p class="text-center">Tidak ada informasi yang tersedia.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
