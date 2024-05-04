@extends('layout.main')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-500">Tambah User</h3>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Tambah Data User</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data"
                        class="d-flex flex-column">
                        @csrf
                        <div class="hts-con-form-group">
                            <div class="form-group w-100">
                                <label for="nama_user">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_user" placeholder="Nama Pengguna"
                                    id="nama_user">
                            </div>
                        </div>
                        <div class="hts-con-form-group">
                            <div class="form-group w-100">
                                <label for="password_user">Password</label>
                                <input type="password" class="form-control" name="password_user" placeholder="****"
                                    id="password_user">
                            </div>
                            <div class="form-group w-100">
                                <label for="conf_pass_user">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="conf_pass_user" placeholder="****"
                                    id="conf_pass_user">
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
                                <label for="role_user">Role</label>
                                <select class=" form-control" name="role_user" required>
                                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                    <option value="yayasan">Yayasan</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex w-25" style="gap: 20px">
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                            <a href="{{ route('user.index') }}" class="btn btn-secondary w-100">Batal</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection