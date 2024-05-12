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
                        <form action="{{ route('pemasukan.store') }}" method="POST" class="d-flex flex-column"
                            id="form-pemasukan">
                            @csrf
                            <div class="hpem-con-form-group">
                                <div class="input-group">
                                    <span class="input-group-text">NIS</span>
                                    <input type="text" class="form-control" placeholder="Nomor Induk Siswa"
                                        name="keyword" id="nisInput" autocomplete="off">
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
                                    <label for="nominal_pemasukan">Nominal Pemasukan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" name="pemasukan" id="numberInput" autocomplete="off">
                                    </div>
                                </div>
                            </div>
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
    {{-- 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#nisInput').on('input', function() {
                var inputNis = $(this).val();
                $.ajax({
                    url: '/getSiswaNis', // Sesuaikan dengan rute Anda
                    method: 'GET',
                    data: {
                        nis: inputNis
                    },
                    success: function(response) {
                        $('.recommend')
                    .empty(); // Kosongkan opsi rekomendasi sebelum menambahkan yang baru
                        if (response.length > 0) {
                            response.forEach(function(nis) {
                                $('.recommend').append(
                                    '<div class="d-none bg-primary text-white mb-1 element-rec">' +
                                    nis + '</div>');
                            });
                            $('.recommend').removeClass('d-none'); // Tampilkan rekomendasi
                            $('#not-found').addClass(
                            'd-none'); // Sembunyikan pesan "NIS Tidak Terdaftar"
                        } else {
                            $('.recommend').addClass(
                            'd-none'); // Sembunyikan rekomendasi jika tidak ada yang ditemukan
                            $('#not-found').removeClass(
                            'd-none'); // Tampilkan pesan "NIS Tidak Terdaftar"
                        }

                        // Menampilkan rekomendasi saat pengguna memilih NIS dari daftar
                        $('.element-rec').on('click', function() {
                            $('#nisInput').val($(this)
                        .text()); // Atur nilai input NIS dengan NIS yang dipilih
                            $('.recommend').addClass(
                            'd-none'); // Sembunyikan daftar rekomendasi setelah dipilih
                        });
                    }
                });
            });

            // Format input menjadi angka
            $('#nominal_pemasukan').on('input', function() {
                var nominal = $(this).val().replace(/\D/g, '');
                $(this).val(nominal.toLocaleString());
            });

            // Validasi Form Pemasukan
            $('#form-pemasukan').submit(function(e) {
                // Mendapatkan nilai NIS dari input
                var nis = $('#nisInput').val();

                // Validasi NIS
                if (nis.trim() == '') {
                    // Mencegah formulir untuk disubmit
                    e.preventDefault();

                    // Menampilkan pesan error
                    alert('NIS tidak boleh kosong. Silakan isi NIS.');

                    // Fokuskan kursor ke input NIS
                    $('#nisInput').focus();

                    // Mengembalikan false untuk mencegah formulir dari disubmit
                    return false;
                }
            });
        });
    </script> --}}
@endsection
