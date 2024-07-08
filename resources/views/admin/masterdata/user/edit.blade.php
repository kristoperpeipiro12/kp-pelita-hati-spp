@extends('layout.main')
@section('content')
    <div class="container-fluid" id="container-wrapper">

        <!-- Form Basic -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Edit Data User</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', $user->id) }}" method="POST" class="d-flex flex-column">
                    @csrf
                    @method('PUT')
                    <div class="hts-con-form-group">
                        <div class="form-group w-100">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" placeholder="Nama Pengguna" id="nama_user" value="{{ $user->username }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="hts-con-form-group">
                        <div class="form-group w-100">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="****" id="password_user">
                            <div class="con-hide w-100 d-flex justify-content-end">
                                <img id="hide" src="{{ asset('UI_login/assets/icons/eye.svg') }}" class="hide mt-1"
                                    style="width: 18px" alt="unhide" />
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="hts-con-form-group">
                        <div class="form-group w-100">
                            <label for="role">Role</label>
                            <select class="form-control @error('role') is-invalid @enderror" name="role" required>
                                <option value="" disabled>-- Pilih Role --</option>
                                <option value="yayasan" {{ $user->role == 'yayasan' ? 'selected' : '' }}>Yayasan</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
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
    <script>
        let hide = document.getElementById('hide')
        let pass = document.getElementById('password_user')

        let tampil = true

        hide.onclick = function() {
            if (tampil) {
                pass.setAttribute('type', 'text')
                hide.setAttribute('src', '../../assets/bootstrap-icons/eye-slash.svg')
                tampil = !tampil
            } else {
                pass.setAttribute('type', 'password')
                hide.setAttribute('src', '../../assets/bootstrap-icons/eye.svg')
                tampil = !tampil
            }
        }
    </script>
@endsection
