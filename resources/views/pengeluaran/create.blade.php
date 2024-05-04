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
                                <label for="nominal_pengeluaran">Nominal Pengeluaran</label>
                                <input type="text" class="form-control" name="nominal_pengeluaran"
                                    placeholder="Rp. xxx . xxx" id="nominal_pengeluaran">
                            </div>
                        </div>
                        <div class="hpeng-con-form-group">
                            <div class="form-group w-100">
                                <label for="tanggal_pengeluaran">Tanggal Pengeluaran</label>
                                <input type="date" class="form-control" name="tanggal_pengeluaran"
                                    placeholder="Tanggal Lahir" id="tanggal_pengeluaran">
                            </div>
                        </div>
                        <div class="hpeng-con-form-group">
                            <div class="form-group w-100">
                                <label for="ket_pengeluaran">Keterangan Pengeluaran</label>
                                <textarea name="ket_pengeluaran" id="ket_pengeluaran" class="peng-textarea"></textarea>
                            </div>
                        </div>

                        <div class="d-flex w-25" style="gap: 20px">
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary w-100">Batal</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection