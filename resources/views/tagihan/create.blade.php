@extends('layout.main')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-500">Tambah siswa</h3>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Tambah Data Siswa</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('tagihan.store') }}" method="POST" class="d-flex flex-column">
                        @csrf
                        <div class="hts-con-form-group">
                            <div class="form-group w-100">
                                <label for="nama_tagihan">Nama Tagihan</label>
                                <input type="text" class="form-control" name="nama_tagihan"
                                    placeholder="Keterangan Tagihan" id="nama_tagihan">
                            </div>
                            <div class="form-group w-100">
                                <label for="nominal_tagihan">Nominal Tagihan</label>
                                <input type="text" class="form-control" name="nominal_tagiha"
                                    placeholder="Rp. xxx . xxx">
                            </div>
                        </div>
                        <div class="hts-con-form-group">
                            <div class="form-group w-100">
                                <label for="jatuh_tempo">Jatuh Tempo</label>
                                <input type="date" class="form-control" name="jatuh_tampo"
                                    placeholder="Tanggal Jatuh Tempo" id="jatuh_tempo">
                            </div>
                        </div>
                        <div class="hts-con-form-group">
                            <div class="form-group w-100">
                                <label for="jenis_kelamin">Cakupan Tagihan</label>
                                <select class="form-control" name="jenis_kelamin" required>
                                    <option value="" disabled selected>-- Pilih Cakupan--</option>
                                    <option value="perkelas">per-Kelas</option>
                                    <option value="perangkatan">per-Angkatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex w-25" style="gap: 20px">
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                            <a href="{{ route('tagihan.index') }}" class="btn btn-secondary w-100">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection