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
                        <form action="{{ route('admin.siswa.store') }}" method="POST" enctype="multipart/form-data"
                            class="d-flex flex-column">
                            @csrf
                            <div class="hts-con-form-group">
                                <div class="form-group w-100">
                                    <label for="nis">NIS</label>
                                    <input type="text" class="form-control" name="nis" placeholder="Nomor Induk Siswa" id="nis" autocomplete="off" value="{{ old('nis') }}">
                                    <small id="nisError" class="text-danger"></small>
                                    @error('nis')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group w-100">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Siswa/i"
                                        id="nama" autocomplete="off" value="{{ old('nama') }}">
                                        @error('nama')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="hts-con-form-group">
                                <div class="form-group w-100">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="alamat" autocomplete="off"
                                        placeholder="Jl. Veteran" value="{{ old('alamat') }}">
                                        @error('alamat')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group w-100">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir"
                                        placeholder="Tanggal Lahir" value="{{ old('tanggal_lahir') }}">
                                        @error('tanggal_lahir')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="hts-con-form-group">
                                <div class="form-group w-100">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin" required>
                                        <option value="" disabled {{ old('jenis_kelamin') == '' ? 'selected' : '' }}>-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group w-100">
                                    <label for="kelas">Kelas</label>
                                    <select class="form-control" name="kelas">
                                        <option value="" disabled {{ old('kelas') == '' ? 'selected' : '' }}>-- Pilih Kelas --</option>
                                        <option value="1" {{ old('kelas') == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ old('kelas') == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ old('kelas') == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ old('kelas') == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ old('kelas') == '5' ? 'selected' : '' }}>5</option>
                                        <option value="6" {{ old('kelas') == '6' ? 'selected' : '' }}>6</option>
                                    </select>
                                    @error('kelas')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            <div class="hts-con-form-group">
                                <div class="form-group w-100">
                                    <label for="nohp">No. HP Ortu/Wali</label>
                                    <input type="tel" class="form-control" name="nohp" placeholder=""
                                        id="nohp" autocomplete="off" value="{{ old('nohp') }}">
                                    <small id="nohpError" class="text-danger"></small>
                                    @error('nohp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>

                                <div class="form-group w-100">
                                    <label for="foto">Foto Murid</label>
                                    <input type="file" class="form-control" name="foto" id="foto" value="{{ old('foto') }}">
                                    @error('foto')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>
                            <div class="d-flex w-25" style="gap: 20px">
                                <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary w-100">Batal</a>
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

@endsection
