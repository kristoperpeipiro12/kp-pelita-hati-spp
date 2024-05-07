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
                        <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data"
                            class="d-flex flex-column">
                            @csrf
                            <div class="hts-con-form-group">
                                <div class="form-group w-100">
                                    <label for="nis">NIS</label>
                                    <input type="text" class="form-control" name="nis"
                                        placeholder="Nomor Induk Siswa" id="nis">
                                    <small id="nisError" class="text-danger"></small>
                                </div>

                                <div class="form-group w-100">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Siswa/i"
                                        id="nama">
                                </div>
                            </div>
                            <div class="hts-con-form-group">
                                <div class="form-group w-100">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="alamat"
                                        placeholder="Jl. Veteran, Komp. Nusa Indah, No. A-xx">
                                </div>
                                <div class="form-group w-100">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir"
                                        placeholder="Tanggal Lahir">
                                </div>
                            </div>
                            <div class="hts-con-form-group">
                                <div class="form-group w-100">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin" required>
                                        <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group w-100">
                                    <label for="kelas">Kelas</label>
                                    <select class="form-control" name="kelas">
                                        <option value="" disabled selected>-- Pilih Kelas --</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>

                            <div class="hts-con-form-group">
                                <div class="form-group w-100">
                                    <label for="nohp">No. HP Ortu/Wali</label>
                                    <input type="tel" class="form-control" name="nohp" placeholder="+62 ..."
                                        id="nohp">
                                    <small id="nohpError" class="text-danger"></small>
                                </div>

                                <div class="form-group w-100">
                                    <label for="foto">Foto Murid</label>
                                    <input type="file" class="form-control" name="foto" id="foto">
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var nisInput = document.getElementById('nis');
            var nisError = document.getElementById('nisError');
            var nohpInput = document.getElementById('nohp');
            var nohpError = document.getElementById('nohpError');

            // Fungsi untuk memastikan input hanya berupa angka
            function validateInputNumber(input, errorElement, maxLength) {
                input.addEventListener('input', function() {
                    var value = this.value.replace(/\D/g, ''); // Hapus semua karakter selain angka
                    this.value = value; // Update nilai input

                    if (value.length > maxLength) {
                        this.value = value.slice(0, maxLength); // Batasi panjang input
                        errorElement.textContent = "Tidak boleh lebih dari " + maxLength + " angka";
                    } else {
                        errorElement.textContent = ""; // Hapus pesan error jika panjang input sudah sesuai
                    }
                });
            }

            validateInputNumber(nisInput, nisError, 8); // Untuk NIS, maksimal 8 angka

            validateInputNumber(nohpInput, nohpError, 15); // Untuk nomor HP, maksimal 15 angka
        });
    </script>



    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            var nohpInput = document.getElementById('nohp');
            var nohpError = document.getElementById('nohpError');

            nohpInput.addEventListener('input', function() {
                if (this.value.length > 15) {
                    this.value = this.value.slice(0, 15); // Batasi panjang input menjadi 15 karakter
                    nohpError.textContent = "Nomor HP tidak boleh lebih dari 15 karakter";
                } else {
                    nohpError.textContent = ""; // Hapus pesan error jika panjang input sudah sesuai
                }
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var nisInput = document.getElementById('nis');
            var nisError = document.getElementById('nisError');

            nisInput.addEventListener('input', function() {
                if (this.value.length > 8) {
                    this.value = this.value.slice(0, 8); // Batasi panjang input menjadi 8 karakter
                    nisError.textContent = "NIS tidak boleh lebih dari 8 angka";
                } else {
                    nisError.textContent = ""; // Hapus pesan error jika panjang input sudah sesuai
                }
            });
        });
    </script> --}}
@endsection
