@extends('layout.main')
@section('content')
<!-- DataTable with Hover -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">WhatsApp</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">WhatsApp</li>
        </ol>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Tagihan</h6>
                <a href="{{ route('tagihan.create') }}" class="btn btn-info mb-1"><i class="fas fa-plus"
                        style="margin-right: 5px;"></i>Tambah</a>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th class="mini-th">No</th>
                            <th>Nama Tagihan</th>
                            <th>Jumlah</th>
                            <th>Cakupan</th>
                            <th>Jatuh Tempo</th>
                            <!-- jangkauan = perkelas/perangkatan -->
                            <th class="text-center mini-th">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($tagihan as $t)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                        <td>{{$t -> namatagihan}}</td>
                        <td>{{$t -> jumlah}}</td>
                        <td>{{$t -> cakupan}}</td>

                            <td class="d-flex justify-content-between">
                                <a href="{{ route('siswa.edit', $item->nis) }}" class="btn btn-primary btn-sm mr-2"><i
                                        class="fas fa-pen-alt"></i></a>
                                <form action="{{ route('siswa.delete', $item->nis) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection