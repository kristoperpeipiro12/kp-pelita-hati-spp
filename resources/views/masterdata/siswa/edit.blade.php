@extends('layout.main')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h3 mb-0 text-gray-500">Edit siswa</h3>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">Tambah Data Siswa</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('siswa.update',$siswa->nis) }}" method="POST" enctype="multipart/form-data"
                            class="d-flex flex-column">
                            @csrf
                            @method('PUT')
                            <div class="hts-con-form-group">
                                <div class="form-group w-100">
                                    <label for="nis">NIS</label>
                                    <input type="text" class="form-control" name="nis" id="nis" value="{{ $siswa->nis }}" autocomplete="off">
                                    <small id="nisError" class="text-danger"></small>
                                </div>
                                <div class="form-group w-100">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" value="{{ $siswa->nama }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="hts-con-form-group">
                                <div class="form-group w-100">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" value="{{ $siswa->alamat }}" autocomplete="off">
                                </div>
                                <div class="form-group w-100">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" value="{{ $siswa->tanggal_lahir }}">
                                </div>
                            </div>
                            <div class="hts-con-form-group">
                                <div class="form-group w-100">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin" required>
                                        <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki" {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group w-100">
                                    <label for="nohp">No HandPhone</label>
                                    <input type="number" class="form-control" name="nohp" id="nohp" value="{{ $siswa->nohp }}" autocomplete="off">
                                    <small id="nohpError" class="text-danger"></small>
                                </div>
                            </div>

                            <div class="hts-con-form-group">
                                <div class="form-group w-100">
                                    <label for="kelas">Kelas</label>
                                    <select class="form-control" name="kelas">
                                        <option value="" disabled>-- Pilih Kelas --</option>
                                        @for ($i = 1; $i <= 6; $i++)
                                            <option value="{{ $i }}" {{ $siswa->kelas == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group w-100">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control" name="foto" id="foto">
                                    <!-- Tampilkan nama file jika sudah ada -->
                                    @if(isset($siswa->foto))
                                        <small><strong>{{ $siswa->foto }}</strong></small>
                                    @endif
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
                    var value = this.value.replace(/\D/g, '');
                    this.value = value; 

                    if (value.length > maxLength) {
                        this.value = value.slice(0, maxLength);
                        errorElement.textContent = "Tidak boleh lebih dari " + maxLength + " angka";
                    } else {
                        errorElement.textContent = ""; 
                    }
                });
            }

            validateInputNumber(nisInput, nisError, 8);

            validateInputNumber(nohpInput, nohpError, 15);
        });
    </script>

@endsection
