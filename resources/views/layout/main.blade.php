<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('RuangAdmin/img/logo/logoSekolah.png') }}" rel="icon">
    <title>{{ $pageTitle }}</title>
    {{-- <title>PELITA HATI</title> --}}

    <link href="{{ asset('RuangAdmin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/font/bootstrap-icons.css') }}">
    <link href="{{ asset('RuangAdmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('RuangAdmin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <link href="{{ asset('RuangAdmin/css/ruang-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS -->

    <!-- Tambahkan ini di bagian <head> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('RuangAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('RuangAdmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('RuangAdmin/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('RuangAdmin/js/demo/chart-area-demo.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">

        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('RuangAdmin/img/logo/logoSekolah.png') }}">
                </div>
                <div class="sidebar-brand-text mx-3">PELITA HATI</div>
            </a>

            <hr class="sidebar-divider my-0">

            @auth('web')
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('admin') }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('tagihan.index') }}">
                            <i class="bi bi-safe"></i>
                            <span>Tagihan</span>
                        </a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('pemasukan.index') }}">
                            <i class="bi bi-currency-dollar"></i>
                            <span>Pemasukan</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('pengeluaran.index') }}">
                            <i class="bi bi-wallet2"></i>
                            <span>Pengeluaran</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('informasi.index') }}">
                            <i class="bi bi-info-circle"></i>
                            <span>Informasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                            aria-expanded="true" aria-controls="collapseBootstrap">
                            <i class="bi bi-database"></i>
                            <span><strong>Master Data</strong></span>
                        </a>
                        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="{{ route('admin.siswa.index') }}">Data Siswa</a>
                                <a class="collapse-item" href="{{ route('admin.siswa.naikkelas') }}">Kenaikan Kelas</a>
                                <a class="collapse-item" href="{{ route('admin.siswa.lulus') }}">Siswa Lulus</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <i class="bi bi-people"></i>
                            <span>Daftar Pengguna</span>
                        </a>
                    </li>
                @elseif (Auth::user()->role == 'yayasan')
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('yayasan') }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('yayasan.pemasukan') }}">
                            <i class="bi bi-currency-dollar"></i>
                            <span>Pemasukan</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('yayasan.pengeluaran') }}">
                            <i class="bi bi-wallet2"></i>
                            <span>Pengeluaran</span>
                        </a>
                    </li>
                @endif
            @endauth

            {{-- @auth('siswa')
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('siswa.dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
            </a>
            </li>
            @endauth --}}

            <li class="nav-item active">
                <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Log Out</span>
                </a>
            </li>

        </ul>
        <!-- Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <div class="d-flex p-0 align-items-center">
                        <button id="sidebarToggleTop" class="btn btn-link text-white mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <span class="text-white">School Fee Management System</span>
                    </div>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">

                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="{{ asset('RuangAdmin/img/boy.png') }}"
                                    style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small">
                                    @auth('web')
                                        {{ Auth::user()->username }}
                                    @endauth

                                    @auth('siswa')
                                        {{ Auth::user()->nama }}
                                    @endauth
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                    data-target="#profilModal">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Modal Profil -->
                <div class="modal fade" id="profilModal" tabindex="-1" role="dialog"
                    aria-labelledby="profilModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="profilModalLabel">My Profile</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex w-100">
                                    <div class="w-50 d-flex ">
                                        <table>
                                            <tr>
                                                <td style="padding-right: 5px">Username</td>
                                                <td style="padding-right: 5px">:</td>
                                                <td style="padding-left: 5px">{{ Auth::user()->username }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-right: 5px">Role</td>
                                                <td style="padding-right: 5px">:</td>
                                                <td style="padding-left: 5px">{{ Auth::user()->role }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="w-50 d-flex justify-content-center">
                                        <img class="img-profile rounded-circle"
                                            src="{{ asset('RuangAdmin/img/boy.png') }}" style="max-width: 60px"
                                            alt="Photo Profile Admin">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Logout -->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                    aria-labelledby="logoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin logout?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form id="logout-form" action="{{ route('logout.post') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- isi content --}}
                @yield('content')

                @include('sweetalert::alert')
                {{-- end content --}}
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            - <b><a href="https://wa.me/6285845177710">Hubungi Developer</a></b>
                        </span>
                    </div>
                </div>
            </footer>
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('js/pemasukan.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    <script src="{{ asset('RuangAdmin/js/ruang-admin.min.js') }}"></script>


</body>

</html>
