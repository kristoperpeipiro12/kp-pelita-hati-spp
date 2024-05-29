@extends('layout.main')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-500">Edit Tagihan</h3>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    {{-- <h6 class="m-0 font-weight-bold text-dark">Tambah Data Siswa</h6> --}}
                </div>
                <div class="card-body">
                    <form action="{{ route('tagihan.update', $tagihan->kelas) }}" method="POST" class="d-flex flex-column">
                        @csrf
                        @method('PUT')
                        <div class="hts-con-form-group">
                            <div class="form-group w-100">
                                <label for="kelas">Kelas</label>
                                <select class="form-control" id="kelas" name="kelas">
                                    <option value="" disabled>-- Pilih Kelas --</option>
                                    @for ($i = 1; $i <= 6; $i++)
                                        <option value="{{ $i }}" {{ $tagihan->kelas == $i ? 'selected' : '' }}> {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>



                            <div class="form-group w-100">
                                <label for="tagihan_perbulan">Nominal Pemasukan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" name="tagihan_perbulan" id="numberInput" value="{{ $tagihan->tagihan_perbulan }}" autocomplete="off">
                                </div>
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
