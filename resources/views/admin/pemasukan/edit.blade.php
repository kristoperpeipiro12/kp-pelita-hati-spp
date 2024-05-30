@extends('layout.main')
@section('content')

@php
$tahun_sekarang = now()->year;
$nama_bulan = [
1 => 'Januari',
2 => 'Februari',
3 => 'Maret',
4 => 'April',
5 => 'Mei',
6 => 'Juni',
7 => 'Juli',
8 => 'Agustus',
9 => 'September',
10 => 'Oktober',
11 => 'November',
12 => 'Desember'
];
@endphp


<div class="container-fluid" id="container-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Edit Data Pemasukan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <form id="form-pemasukan" action="{{ route('pemasukan.update', $pemasukan->id) }}" method="POST" class="d-flex flex-column">
                                @csrf
                                @method('PUT')
                                <div class="hpem-con-form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">NIS</span>
                                        <input type="text" class="form-control" placeholder="Nomor Induk Siswa" name="nis" id="nis" autocomplete="off" value="{{ $pemasukan->nis }}" readonly>
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
                                <span id="not-found" class="d-none bg-danger text-white element-rec">NIS Tidak Terdaftar!</span>

                                <div class="hpem-con-form-group">
                                    <div class="form-group">
                                        <label for="tanggal_bayar">Tanggal Bayar</label>
                                        <input type="date" class="form-control" name="tanggal_bayar" id="tanggal_bayar" value="{{ $pemasukan->tanggal_bayar }}">

                                    </div>
                                </div>

                                <div class="hpem-con-form-group">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="">Periode Tagihan</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <select class="form-control" name="bulan_tagihan" disabled required>
                                                    @foreach ($nama_bulan as $bulan => $nama)
                                                    <option value="{{ $bulan }}" {{ ($bulan == $pemasukan->bulan_tagihan) ? "selected" : "" }}>
                                                        {{ $nama }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <select class="form-control" name="tahun_tagihan" disabled required>
                                                    @for ($tahun = $tahun_sekarang; $tahun >= ($tahun_sekarang - 6); $tahun--)
                                                    <option value="{{ $tahun }}" {{ ($tahun == $pemasukan->tahun_tagihan) ? "selected" : "" }}>
                                                        {{ $tahun }}
                                                    </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="hpem-con-form-group">
                                    <div class="form-group w-100">
                                        <label for="jenis_transaksi">Jenis Pemasukan</label>
                                        <select class="form-control" name="jenis_transaksi" required>
                                            <option value="" disabled>-- Pilih Jenis Pemasukan --</option>
                                            <option value="Kontan" {{ $pemasukan->jenis_transaksi === 'Kontan' ? 'selected' : '' }}>
                                                Kontan</option>
                                            <option value="Transfer" {{ $pemasukan->jenis_transaksi === 'Transfer' ? 'selected' : '' }}>
                                                Transfer
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex w-100" style="gap: 20px">
                                    <button type="submit" class="btn btn-success flex-fill">Simpan</button>
                                    <a href="{{ route('pemasukan.index') }}" class="btn btn-secondary flex-fill">Batal</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
