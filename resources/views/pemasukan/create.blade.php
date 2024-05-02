@extends('layout.main')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h3 mb-0 text-gray-500">Tambah Pemasukan</h3>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">Tambah Data Pemasukan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pemasukan.store') }}" method="POST"
                            class="d-flex flex-column">
                            @csrf
                            <div class="hpem-con-form-group">
                                <div class="form-group w-100">
                                    <label for="nis">NIS</label>
                                    <input type="text" class="form-control" name="nis" placeholder="Nomor Induk Siswa" id="nis">

                                </div>
                                <div class="form-group w-100">
                                    <label for="nominal_pemasukan">Nominal Pemasukan</label>
                                    <input type="text" class="form-control" name="nominal_pemasukan" placeholder="Rp. xxx . xxx" id="nominal_pemasukan">
                                </div>
                            </div>
                            <div class="hpem-con-form-group">
                                <div class="form-group w-100">
                                    <label for="tanggal_pemasukan">Tanggal Pemasukan</label>
                                    <input type="date" class="form-control" name="tanggal_pemasukan"
                                        placeholder="Tanggal Lahir" id="tanggal_pemasukan">
                                </div>
                            </div>
                            <div class="hpem-con-form-group">
                                <div class="form-group w-100">
                                    <label for="jenis_pemasukan">Jenis Pemasukan</label>
                                    <select class="form-control" name="jenis_pemasukan" required>
                                        <option value="" disabled selected>-- Pilih Jenis Pemasukan --</option>
                                        <option value="kontan">Kontan</option>
                                        <option value="transfer">Transfer</option>
                                    </select>
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
