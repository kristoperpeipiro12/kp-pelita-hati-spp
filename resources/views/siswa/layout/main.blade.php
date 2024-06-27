<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('siswa/bootstrapv5.3/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('siswa/css/style-murid.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>{{ $pageTitle }}</title>
    <script src="{{ asset('siswa/js/jquery.js')}}"></script>
    <script src="{{ asset('siswa/js/jquery.min.js')}}"></script>
    <script src="{{ asset('siswa/bootstrapv5.3/js/bootstrap.bundle.js')}}"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg border-bottom border-body">
        <div class="container-fluid d-flex justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <img src="{{ asset('siswa/assets/logoSekolah.png') }}" alt="logo-sekolah" width="35px">
                <a class="navbar-brand fw-bolder fs-4" href="#">SD Kristen Pelita Hati</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav w-100 justify-content-end">
                    <a class="nav-link text-white" aria-current="page" href="#identitas">Identitas</a>
                    <a class="nav-link text-white" href="#tagihan">Tagihan</a>
                    <a class="nav-link text-white" href="#informasi">Informasi</a>
                    <a class="nav-link text-white" href="javascript:void(0);" data-bs-toggle="modal"
                        data-bs-target="#logoutModal">
                        Logout
                    </a>
                    {{-- <a class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a> --}}
                </div>
            </div>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="logout-form" action="{{ route('logout.post') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @yield('content')
    @include('sweetalert::alert')
    <script src="{{ asset('siswa/js/script-murid.js')}}"></script>
</body>

</html>