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
                        <form id="form-pemasukan" action="{{ route('pemasukan.update', $pemasukan->id) }}" method="POST" class="d-flex flex-column">
                            @csrf
                            @method('PUT')
                            <div class="hpem-con-form-group">
                                <div class="input-group">
                                    <span class="input-group-text">NIS</span>
                                    <input type="text" class="form-control" placeholder="Nomor Induk Siswa" name="nis" id="nis" autocomplete="off" value="{{ $pemasukan->nis }}" autocomplete="off">
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

                            <div class="form-group w-100">
                                <label for="nominal_pemasukan">Nominal Pemasukan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" name="pemasukan" id="numberInput" value="{{ $pemasukan->pemasukan }}" autocomplete="off">
                                </div>
                            </div>

                            <div class="hpem-con-form-group">
                                <div class="form-group w-100">
                                    <label for="tanggal_pemasukan">Tanggal Pemasukan</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal_pemasukan" value="{{ $pemasukan->tanggal }}">
                                </div>
                            </div>
                            <div class="hpem-con-form-group">
                                <div class="form-group w-100">
                                    <label for="jenis_pemasukan">Jenis Pemasukan</label>
                                    <select class="form-control" name="jenistransaksi" required>
                                        <option value="" disabled>-- Pilih Jenis Pemasukan --</option>
                                        <option value="kontan" {{ $pemasukan->jenistransaksi === 'kontan' ? 'selected' : '' }}>
                                            Kontan</option>
                                        <option value="transfer" {{ $pemasukan->jenistransaksi === 'transfer' ? 'selected' : '' }}>
                                            Transfer
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex w-25" style="gap: 20px">
                                <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                <a href="{{ route('pemasukan.index') }}" class="btn btn-secondary w-100">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection