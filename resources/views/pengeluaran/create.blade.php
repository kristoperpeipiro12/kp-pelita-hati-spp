@extends('layout.main')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-500">Tambah Pengeluaran</h3>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Tambah Data Pengeluaran</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengeluaran.store') }}" method="POST" class="d-flex flex-column">
                        @csrf
                        <div class="hpeng-con-form-group">
                            <div class="form-group w-100">
                                <label for="pengeluaran">Nominal Pengeluaran</label>
                                <input type="text" class="form-control" name="pengeluaran"
                                    placeholder="Rp. xxx . xxx" id="numberInput" autocomplete="off" autocomplete="off">
                            </div>
                        </div>
                        <div class="hpeng-con-form-group">
                            <div class="form-group w-100">
                                <label for="tanggal">Tanggal Pengeluaran</label>
                                <input type="date" class="form-control" name="tanggal"
                                    placeholder="Tanggal Pengeluaran" id="tanggal">
                            </div>
                        </div>
                        <div class="hpeng-con-form-group">
                            <div class="form-group w-100">
                                <label for="keterangan">Keterangan Pengeluaran</label>
                                <textarea name="keterangan" id="ket_pengeluaran" class="peng-textarea" autocomplete="off"></textarea>
                            </div>
                        </div>

                        <div class="d-flex w-25" style="gap: 20px">
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                            <a href="{{ route('pengeluaran.index') }}" class="btn btn-secondary w-100">Batal</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection