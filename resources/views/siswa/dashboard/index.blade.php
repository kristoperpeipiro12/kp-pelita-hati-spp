<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('siswa/bootstrapv5.3/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('siswa/css/style-murid.css') }}">
    <link rel="stylesheet" href="{{ asset('siswa/https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css') }}">
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
    <div class="main-content container-fluid">
        <div class="d-flex justify-content-between align-items-center mt-3 mb-5">
            <h2 class="judul-page fw-medium m-0">School Fee Management System</h2>
            <button class="btn text-primary-emphasis h-50" data-bs-toggle="tooltip" data-bs-placement="bottom"
                data-bs-title="Hubungi Admin">
                <i class="bi bi-person-circle fs-4"></i>
            </button>
        </div>
        <div class="card" id="identitas">
            <div class="card-header text-center fw-bold fs-judul-ident">
                Identitas Murid
            </div>
            <div class="card-body card-identitas">
                <div class="w-75">
                    <table class="table tabel-murid w-100">
                        <tr class="px-5">
                            <td class="text-">Nomor Induk Siswa</td>
                            <td class="px-2 text-center">:</td>
                            <td> {{ Auth::user()->nis }}</td>
                        </tr>
                        <tr>
                            <td class="text-">Nama Murid</td>
                            <td class="px-2 text-center">:</td>
                            <td> {{ Auth::user()->nama }}</td>
                        </tr>
                        <tr>
                            <td class="text-">Kelas</td>
                            <td class="px-2 text-center">:</td>
                            <td> {{ Auth::user()->kelas }}</td>
                        </tr>
                        <tr>
                            <td class="text-">Jenis Kelamin</td>
                            <td class="px-2 text-center">:</td>
                            <td> {{ Auth::user()->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td class="text-">Status Murid</td>
                            <td class="px-2 text-center">:</td>
                            <td>{{ Auth::user()->status }}</td>
                        </tr>
                    </table>
                </div>
                <div class="d-flex justify-content-center w-25">
                    @if(Auth::user()->foto)
                        {{-- <img src="{{ asset(Auth::user()->foto) }}" alt="" class="img-murid rounded-circle">
                         --}}
                         <img src="{{ asset('storage/foto-siswa/' . Auth::user()->foto) }}" alt="" class="img-murid rounded-circle">

                    @else
                        <img src="{{ asset('siswa/assets/userprofile.png') }}" alt="foto-murid" class="img-murid rounded-circle">
                    @endif
                </div>
            </div>
        </div>


        <br>
        <br>

        <div class="accordion" id="accordionExample">
            <section id="tagihan">
                <div class="accordion-item">
                    <h2 class="accordion-header fw-bold">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <span class="fw-medium fs-judul-tag-inf">Tagihan SPP</span>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body accor-tagihan">
                            <div class=" sub-accor-tagihan">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title fs-tag-bulan">Januari</h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary text-end">Belum Lunas</h6>
                                        <p class="card-text text-end">Rp. 100.000</p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
                                            Transfer
                                        </button>
                                    </div>
                                </div>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title fs-tag-bulan">Februari</h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary text-end">Belum Lunas</h6>
                                        <p class="card-text text-end">Rp. 100.000</p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
                                            Transfer
                                        </button>
                                    </div>
                                </div>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title fs-tag-bulan">Februari</h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary text-end">Belum Lunas</h6>
                                        <p class="card-text text-end">Rp. 100.000</p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
                                            Transfer
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="sub-accor-tagihan">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title fs-tag-bulan">Januari</h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary text-end">Belum Lunas</h6>
                                        <p class="card-text text-end">Rp. 100.000</p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
                                            Transfer
                                        </button>
                                    </div>
                                </div>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title fs-tag-bulan">Februari</h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary text-end">Belum Lunas</h6>
                                        <p class="card-text text-end">Rp. 100.000</p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
                                            Transfer
                                        </button>
                                    </div>
                                </div>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title fs-tag-bulan">Maret</h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary text-end">Belum Lunas</h6>
                                        <p class="card-text text-end">Rp. 100.000</p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
                                            Transfer
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="sub-accor-tagihan">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title fs-tag-bulan">Januari</h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary text-end">Belum Lunas</h6>
                                        <p class="card-text text-end">Rp. 100.000</p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
                                            Transfer
                                        </button>
                                    </div>
                                </div>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title fs-tag-bulan">Februari</h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary text-end">Belum Lunas</h6>
                                        <p class="card-text text-end">Rp. 100.000</p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
                                            Transfer
                                        </button>
                                    </div>
                                </div>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title fs-tag-bulan">Maret</h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary text-end">Belum Lunas</h6>
                                        <p class="card-text text-end">Rp. 100.000</p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
                                            Transfer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="informasi">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span class="fw-medium fs-judul-tag-inf">Informasi</span>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="card">
                                <div class="card-header">
                                    Ujian Tengah Semester
                                </div>
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                        <p>Diharapkan untuk segera melunasi seluruh tagihan SPP sampai bulan Maret agar
                                            dapat mengikuti Ujian Tengah Semester 2024/2025</p>
                                        <footer class="blockquote-footer">Administrasi <cite title="Source Title">Ibu
                                                Ani</cite></footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Layanan Bank</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- ... -->
                    <div class="accordion" id="accordionBank">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseBankOne" aria-expanded="true"
                                    aria-controls="collapseBankOne">
                                    <span class="text-primary">BCA</span>
                                </button>
                            </h2>
                            <div id="collapseBankOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionBank">
                                <div class="accordion-body">
                                    <table class="bg- w-100">
                                        <tr>
                                            <td>No. Rekening</td>
                                            <td>:</td>
                                            <td>123-456-789-000</td>
                                        </tr>
                                        <tr>
                                            <td>atas nama</td>
                                            <td>:</td>
                                            <td>BUDI SETIAWAN</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseBankTwo" aria-expanded="false"
                                    aria-controls="collapseBankTwo">
                                    <span class="text-success">BNI</span>
                                </button>
                            </h2>
                            <div id="collapseBankTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionBank">
                                <div class="accordion-body">
                                    <table class="bg- w-100">
                                        <tr>
                                            <td>No. Rekening</td>
                                            <td>:</td>
                                            <td>123-456-789-000</td>
                                        </tr>
                                        <tr>
                                            <td>atas nama</td>
                                            <td>:</td>
                                            <td>BUDI SETIAWAN</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseBankThree" aria-expanded="false"
                                    aria-controls="collapseBankThree">
                                    <span class="text-primary-emphasis">Mandiri</span>
                                </button>
                            </h2>
                            <div id="collapseBankThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionBank">
                                <div class="accordion-body">
                                    <table class="bg- w-100">
                                        <tr>
                                            <td>No. Rekening</td>
                                            <td>:</td>
                                            <td>123-456-789-000</td>
                                        </tr>
                                        <tr>
                                            <td>atas nama</td>
                                            <td>:</td>
                                            <td>BUDI SETIAWAN</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ... -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <script src="{{ asset('siswa/js/jquery.js')}}"></script>
    <script src="{{ asset('siswa/js/jquery.min.js')}}"></script>
    <script src="{{ asset('siswa/bootstrapv5.3/js/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('siswa/js/script-murid.js')}}"></script>
</body>

</html>

