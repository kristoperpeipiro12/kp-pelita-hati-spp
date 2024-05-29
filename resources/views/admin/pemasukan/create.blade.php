@extends('layout.main')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h3 mb-0 text-gray-500">Tambah Pemasukan</h3>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-7">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">Tambah Data Pemasukan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pemasukan.store') }}" method="POST" class="d-flex flex-column"
                            id="form-pemasukan">
                            @csrf
                            <div class="hpem-con-form-group">
                                <div class="input-group">
                                    <span class="input-group-text">NIS</span>
                                    <input type="text" class="form-control" placeholder="Nomor Induk Siswa"
                                        name="nis" id="nisInput" autocomplete="off">
                                </div>
                            </div>
                            <div class="recommend">
                                @php
                                    $siswa = App\Models\Siswa::all();
                                @endphp
                                @foreach ($siswa as $p)
                                    <div class="d-none bg-primary text-white mb-1 element-rec">
                                        {{ $p->nis }}
                                    </div>
                                @endforeach
                            </div>
                            <span id="not-found" class="d-none bg-danger text-white">NIS Tidak Terdaftar!</span>

                            <div class="hpem-con-form-group">
                                <div class="form-group w-100">
                                    <label for="tanggal_pemasukan">Tanggal Pemasukan</label>
                                    <input type="date" class="form-control" name="tanggal"
                                        placeholder="Tanggal Pemasukan" id="tanggal_pemasukan">
                                </div>
                            </div>
                            <div class="hpem-con-form-group">
                                <div class="form-group w-100">
                                    <label for="jenis_pemasukan">Jenis Pemasukan</label>
                                    <select class="form-control" name="jenistransaksi" required>
                                        <option value="" disabled selected>-- Pilih Jenis Pemasukan --</option>
                                        <option value="kontan">Kontan</option>
                                        <option value="transfer">Transfer</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex w-100" style="gap: 20px">
                                <button type="submit" class="btn btn-primary flex-fill">Simpan</button>
                                <a href="{{ route('pemasukan.index') }}" class="btn btn-secondary flex-fill">Batal</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
