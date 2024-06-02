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
            12 => 'Desember',
        ];
    @endphp

    <div class="container-fluid" id="container-wrapper">
        <div class="row justify-content-center">
            <div class="col-lg-12">
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
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="tanggal_bayar">NIS / Nama Siswa</label>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-control js-select2" name="nis" id="nis">
                                            <option value="">Pilih NIS</option>
                                            @php
                                                $siswa = App\Models\Siswa::all();
                                            @endphp
                                            @foreach ($siswa as $p)
                                                <option value="{{ $p->nis }}">{{ $p->nis }} -
                                                    {{ $p->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_bayar">Tanggal Bayar</label>
                                    <input type="date" class="form-control" name="tanggal_bayar"
                                        value="{{ date('Y-m-d') }}" id="tanggal_bayar">
                                </div>
                            </div>

                            <div class="d-flex flex-column">
                                <div class="form-group">
                                    <label for="">Periode Tagihan</label>
                                    <div class="hpem-con-form-group">
                                        <div class="col-lg-4 p-0">
                                            <select class="form-control" name="bulan_tagihan" required>
                                                <option value="">-- Pilih Bulan --</option>
                                                @foreach ($nama_bulan as $bulan => $nama)
                                                    <option value="{{ $bulan }}">{{ $nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4 p-0">
                                            <select class="form-control" name="tahun_tagihan" required>
                                                <option value="">-- Pilih Tahun --</option>
                                                @for ($tahun = $tahun_sekarang; $tahun >= $tahun_sekarang - 6; $tahun--)
                                                    <option value="{{ $tahun }}">{{ $tahun }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="hpem-con-form-group">
                                <div class="form-group w-100">
                                    <label for="jenis_transaksi">Jenis Transaksi</label>
                                    <select class="form-control" name="jenis_transaksi" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Kontan">Kontan</option>
                                        <option value="Transfer">Transfer</option>
                                    </select>
                                </div>
                            </div>

                            <div class="w-50 d-flex align-self-end">
                                <button type="submit"
                                    class="btn btn-success flex-fill hpem-btn-create w-25">Simpan</button>
                                <div style="width: 30px; height: 100%;"></div>
                                <a href="{{ route('pemasukan.index') }}" class="btn btn-secondary flex-fill w-25">Batal</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('.js-select2').select2({
                placeholder: "Pilih NIS",
                allowClear: true
            });
        });
    </script>
@endsection
