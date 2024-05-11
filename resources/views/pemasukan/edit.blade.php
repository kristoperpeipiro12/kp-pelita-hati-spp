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
                        <form action="{{ route('pemasukan.update', $pemasukan->id) }}" method="POST"
                            class="d-flex flex-column">
                            @csrf
                            @method('PUT')
                            <div class="hpem-con-form-group">
                                <div class="form-group w-100">
                                    <label for="nis">NIS</label>
                                    <input type="text" class="form-control" name="nis"
                                        placeholder="Nomor Induk Siswa" id="nis" value="{{ $pemasukan->nis }}">
                                    <span class="text-danger" id="nis-error"></span>
                                    @error('nis')
                                        <span class="text-danger">NIS TIDAK TERDAFTAR !</span>
                                    @enderror
                                </div>
                                <!-- Pesan error untuk NIS -->

                                <div class="form-group w-100">
                                    <label for="nominal_pemasukan">Nominal Pemasukan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" name="pemasukan" id="nominal_pemasukan"
                                            value="{{ $pemasukan->pemasukan }}">
                                    </div>
                                </div>

                            </div>
                            <div class="hpem-con-form-group">
                                <div class="form-group w-100">
                                    <label for="tanggal_pemasukan">Tanggal Pemasukan</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal_pemasukan"
                                        value="{{ $pemasukan->tanggal }}">
                                </div>
                            </div>
                            <div class="hpem-con-form-group">
                                <div class="form-group w-100">
                                    <label for="jenis_pemasukan">Jenis Pemasukan</label>
                                    <select class="form-control" name="jenistransaksi" required>
                                        <option value="" disabled>-- Pilih Jenis Pemasukan --</option>
                                        <option value="kontan"
                                            {{ $pemasukan->jenistransaksi === 'kontan' ? 'selected' : '' }}>Kontan</option>
                                        <option value="transfer"
                                            {{ $pemasukan->jenistransaksi === 'transfer' ? 'selected' : '' }}>Transfer
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
    <script>
        $(document).ready(function() {
            // Format input menjadi angka
            $('#nominal_pemasukan').on('input', function() {
                var nominal = $(this).val().replace(/\D/g, '');
                $(this).val(nominal.toLocaleString());
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#form-pemasukan').submit(function(e) {
                // Mendapatkan nilai NIS dari input
                var nis = $('#nis').val();

                // Validasi NIS
                if (nis.trim() == '') {
                    // Mencegah formulir untuk disubmit
                    e.preventDefault();

                    // Menampilkan pesan error
                    alert('NIS tidak boleh kosong. Silakan isi NIS.');

                    // Fokuskan kursor ke input NIS
                    $('#nis').focus();

                    // Mengembalikan false untuk mencegah formulir dari disubmit
                    return false;
                }
            });
        });
    </script>
@endsection
