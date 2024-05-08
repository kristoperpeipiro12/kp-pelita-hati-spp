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
                    <form action="{{ route('user.store') }}" method="POST" class="d-flex flex-column">
                        @csrf
                        <div class="hts-con-form-group">
                            <div class="form-group w-100">
                                <label for="username">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Nama Pengguna" id="nama_user" value="{{ old('username') }}">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="hts-con-form-group">
                            <div class="form-group w-100">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="****" id="password_user">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="hts-con-form-group">
                            <div class="form-group w-100">
                                <label for="role">Role</label>
                                <select class="form-control @error('role') is-invalid @enderror" name="role" required>
                                    <option value="" disabled selected>-- Pilih Role --</option>
                                    <option value="yayasan" {{ old('role') == 'yayasan' ? 'selected' : '' }}>Yayasan</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
