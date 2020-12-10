<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Force Ranking - PTPN Group</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Force Ranking - Perkebunan Nusantara" name="description" />
        <meta content="TIM IT - PTPN IX" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="{{ asset('template/images/holding-favicon.png') }}">

        @yield('css')

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    </head>

    <body>

        <!-- Navigation Bar-->
        <header id="topnav">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">

                        <li class="dropdown notification-list">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                @if (Auth::user()->foto == NULL)
                                <img src="{{ asset('assets/images/default-user.jpg') }}" alt="user-image" class="rounded-circle">
                                @else
                                <img src="{{ url('storage/'.substr(Auth::user()->foto, 7)) }}" alt="foto-user" class="rounded-circle">
                                @endif
                                <span class="pro-user-name ml-1">
                                    {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                {{-- <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Selamat Datang !</h6>
                                </div> --}}

                                <!-- item-->
                                {{-- <a href="#" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>Profil saya</span>
                                </a>

                                <div class="dropdown-divider"></div> --}}

                                <!-- item-->
                                <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fe-log-out"></i>
                                    <span>Logout</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>

                    </ul>

                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="{{ route('beranda') }}" class="logo text-center">
                            <span class="logo-lg">
                                <img src="{{ asset('template/images/holding.png') }}" alt="" height="60">
                            </span>
                            <span class="logo-sm">
                                <!-- <span class="logo-sm-text-dark">U</span> -->
                                <img src="{{ asset('template/images/holding.png') }}" alt="" height="24">
                            </span>
                        </a>
                    </div>
                </div> <!-- end container-fluid-->
            </div>
            <!-- end Topbar -->

            <div class="topbar-menu">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <li>
                                <a href="{{ route('beranda') }}"><i class="fe-airplay"></i>Beranda</a>
                            </li>
                            @role('SUPER ADMINISTRATOR|ADMINISTRATOR HOLDING|ADMINISTRATOR ANPER')
                            <li class="has-submenu">
                                <a href="javascript:void(0)"> <i class="fe-database"></i>Manajemen Master Data <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    @role('SUPER ADMINISTRATOR|ADMINISTRATOR HOLDING|ADMINISTRATOR ANPER|')
                                    <li>
                                        <a href="{{ route('ptpn.index') }}">Perusahaan</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('kategori.index') }}">Komoditas</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('divisi.index') }}">Divisi/Bagian/Unitkerja</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('kpi.index') }}">Indikator KPI</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('penilaian_karya.index') }}">Distribusi Penilaian</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('karyawan.index') }}">Karyawan</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('pengguna.index') }}">Pengguna</a>
                                    </li>
                                    @endrole
                                    @role('SUPER ADMINISTRATOR')
                                    <li>
                                        <a href="{{ route('satuan.index') }}">Satuan Indikator</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('permissions.index') }}">Permissions</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('role.index') }}">Role Pengguna</a>
                                    </li>
                                    @endrole
                                </ul>
                            </li>
                            @endrole
                            @role('SUPER ADMINISTRATOR|ADMINISTRATOR HOLDING|ASISTEN/STAF/PIC BAGIAN/DIVISI|ADMINISTRATOR ANPER')
                            <li class="has-submenu">
                                <a href="javascript:void(0)"> <i class="fe-database"></i>Penilaian Kinerja <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    @role('SUPER ADMINISTRATOR|ADMINISTRATOR HOLDING|ADMINISTRATOR ANPER')
                                    <li>
                                        <a href="{{ route('indikator.index') }}">Penilaian KPI</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('distribusi.index') }}">Usulan Penilaian Karyawan</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('penetapan.index') }}">Sidang Komite/Penetapan Penilaian Karyawan</a>
                                    </li>
                                    @endrole
                                </ul>
                            </li>
                            @endrole
                        </ul>
                        <!-- End navigation menu -->

                        <div class="clearfix"></div>
                    </div>
                    <!-- end #navigation -->
                </div>
                <!-- end container -->
            </div>
            <!-- end navbar-custom -->

        </header>
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="wrapper">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            @yield('breadcrumb')

                            @yield('content')
                        </div>
                    </div>
                </div>
                <!-- end page title -->


            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        2020 &copy; <a href="#">Perkebunan Nusantara Group</a>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="javascript:void(0);">{{ Auth::user()->username }}</a>
                            <a href="javascript:void(0);">{{ Auth::user()->ptpn->company_code }}</a>
                            <a href="javascript:void(0);">{{ Auth::user()->divisi->kode_divisi }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        @yield('script')
        <!-- App js-->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
    </body>
</html>
