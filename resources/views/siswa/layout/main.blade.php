<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('siswa/bootstrapv5.3/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('siswa/css/style-murid.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Pelita Hati</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg border-bottom border-body">
        <div class=" container-fluid d-flex justify-content-between">
            <div class=" d-flex align-items-center gap-2">
                <img src="{{ asset('siswa/assets/logoSekolah.png') }}" alt="logo-sekolah" width="35px">
                <a class="navbar-brand fw-bolder fs-4" href="#">SD K Pelita Hati</a>
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
                    <a class="nav-link text-white" href="{{ route('logout') }}">logout</a>

                </div>
            </div>
        </div>
    </nav>



    <!-- konten-siswa -->
    @yield('content')
    @include('sweetalert::alert')

    <!-- Modal -->


    <br>
    <br>
    <script src="{{ asset('siswa/js/jquery.js')}}"></script>
    <script src="{{ asset('siswa/js/jquery.min.js')}}"></script>
    <script src="{{ asset('siswa/bootstrapv5.3/js/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('siswa/js/script-murid.js')}}"></script>
</body>

</html>

