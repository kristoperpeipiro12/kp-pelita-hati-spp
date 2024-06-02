@extends('layout.main')
@section('content')
    <div class="container-fluid" id="container-wrapper">

        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Edit Data Pengeluaran</h6>
            </div>

            <div class="card-body">
                <form action="{{ route('pengeluaran.update', $pengeluaran->id_pengeluaran) }}" method="POST"
                    class="d-flex flex-column">
                    @csrf
                    @method('PUT')

                    <div class="hpeng-con-form-group">
                        <div class="form-group w-100">
                            <label for="pengeluaran">Nominal Pengeluaran</label>
                            <input type="text" class="form-control" name="pengeluaran" id="numberInput"
                                value="{{ $pengeluaran->pengeluaran }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="hpeng-con-form-group">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Pengeluaran</label>
                            <input type="date" class="form-control" name="tanggal" placeholder="Tanggal Pengeluaran"
                                id="tanggal" value="{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="hpeng-con-form-group">
                        <div class="form-group w-100">
                            <label for="keterangan">Keterangan Pengeluaran</label>
                            <textarea name="keterangan" class="form-control" rows="5" id="ket_pengeluaran" class="peng-textarea"
                                autocomplete="off">{{ $pengeluaran->keterangan }}</textarea>
                        </div>
                    </div>

                    <div class="w-50 d-flex align-self-end justify-content-end">
                        <button type="submit" class="btn btn-success w-25">Simpan</button>
                        <div style="width: 30px; height: 100%;"></div>
                        <a href="{{ route('pengeluaran.index') }}" class="btn btn-secondary w-25">Batal</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
