<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('RuangAdmin/img/logo/logoSekolah.png') }}" rel="icon">
    <title>Pelita Hati</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/font/bootstrap-icons.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('RuangAdmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('RuangAdmin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('RuangAdmin/css/ruang-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('RuangAdmin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('RuangAdmin/img/logo/logoSekolah.png') }}">
                </div>
                <div class="sidebar-brand-text mx-3">PELITA HATI</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('tagihan.index') }}">
                    <i class="bi bi-whatsapp"></i>
                    <span>Kirim Tagihan</span></a>
            </li>
            <!-- <li class="nav-item active">
                <a class="nav-link" href="{{ route('tagihan.index') }}">
                    <i class="bi bi-bank"></i>
                    <span>Tagihan</span></a>
            </li> -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('pemasukan.index') }}">
                    <i class="bi bi-cash-stack"></i>
                    <span>Pemasukan</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('pengeluaran.index') }}">
                    <i class="bi bi-wallet2"></i>
                    <span>Pengeluaran</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('informasi.index') }}">
                    <i class="bi bi-info-circle"></i>
                    <span>Informasi</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                    aria-expanded="true" aria-controls="collapseBootstrap">
                    <i class="bi bi-database"></i>
                    <span>Master Data</span>
                </a>
                <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('siswa.index') }}">Data Siswa</a>
                        <a class="collapse-item" href="{{ route('user.index') }}">Data User</a>
                    </div>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Log Out</span></a>
            </li>
        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <div class="d-flex p-0 align-items-center">
                        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
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
                                <span class="ml-2 d-none d-lg-inline text-white small">Admin</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <!-- jangan lupa hapus data-toggle & data-target pada tag a profile jika
                                ingin menghapus modal dibawah ini -->
                                <!-- modal (start) -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal (end) -->
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
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
                <!-- Topbar -->


                {{-- isi content --}}
                <!-- Container Fluid-->
                @yield('content')
                <!---Container Fluid-->
                {{-- end content --}}
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>copyright &copy; <script>
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

    <script src="{{ asset('RuangAdmin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('RuangAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('RuangAdmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{ asset('RuangAdmin/js/ruang-admin.min.js')}}"></script>
    <script src="{{ asset('RuangAdmin/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('RuangAdmin/js/demo/chart-area-demo.js')}}"></script>
    
    <script src="{{ asset('RuangAdmin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('RuangAdmin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('RuangAdmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    
    <script src="{{ asset('js/script.js') }}"></script>
    
    <script>
    $(document).ready(function() {
        $('#dataTable').DataTable(); // ID From dataTable 
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
    </script>

</body>

</html>