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
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pengeluaran</h6>
                <a href="{{ route('pengeluaran.create') }}" class="btn btn-info mb-1"><i class="fas fa-plus"
                        style="margin-right: 5px;"></i>Tambah</a>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th class="mini-th">No</th>
                            <th>Nama</th>
                            <th>Pengeluaran(Rp)</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th class="text-center mini-th">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengeluaran as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ Auth::user()->username }}</td>
                            <td>{{ $p->pengeluaran }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $p->keterangan }}</td>
                            <td class="d-flex justify-content-between">
                                <a href="{{ route('pengeluaran.edit', $p->id_pengeluaran) }}" class="btn btn-primary btn-sm mr-2"><i
                                        class="fas fa-pen-alt"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm ml-2" data-toggle="modal"
                                        data-target="#deleteModal{{ $p->id_pengeluaran }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                            </td>
                        </tr>
                          <!-- Modal Delete -->
                          <div class="modal fade" id="deleteModal{{ $p->id_pengeluaran }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus data ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Batal</button>
                                        <form action="{{ route('pengeluaran.delete', $p->id_pengeluaran) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Delete -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
