<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard | {{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ env('APP_DESC') }}" name="description" />
    <meta content="{{ env('APP_AUTHOR') }}" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('img/fav.png') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('skote') }}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('skote') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('skote') }}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('skote') }}/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <link href="{{ asset('skote') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    @if (isset($datatable))
        <!-- DataTables -->
        <link href="{{ asset('skote') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
            rel="stylesheet" type="text/css" />
        <link href="{{ asset('skote') }}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
            rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('skote') }}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
            rel="stylesheet" type="text/css" />
    @endif

    @stack('css')

    <style>
        .judul,
        .nomor {
            text-align: center;
        }

        .nomor {
            margin-top: -10px;
        }

        .ttd {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .right {
            margin-right: 50px;
        }

        .materai {
            border: 1px solid black;
            padding: 4px;
            width: 80px;
            height: 80px;
            text-align: center;
            vertical-align: middle;
            margin-top: 10px;
        }

        .sptjm tr td {
            /* border: 1px solid black; */
        }

        .fw-bold {
            font-weight: bold
        }

        .identitas tr td {
            padding: 0px;
        }

        .sptjm tr td {
            padding: 0px;
        }
    </style>

</head>

<body data-sidebar="dark" data-layout-mode="light">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('img/cirebonkab.png') }}" alt="" height="20">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('img/logo.png') }}"
                                    style="background-color: white;padding:8px 4px 4px 4px;" alt=""
                                    height="60">
                            </span>
                        </a>

                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('img/cirebonkab.png') }}" alt="" height="40">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('img/logo.png') }}"
                                    style="background-color: white;padding:8px 4px 4px 4px;" alt=""
                                    height="60">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            data-bs-toggle="fullscreen">
                            <i class="bx bx-fullscreen"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{ asset('img/fav.png') }}"
                                alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1"
                                key="t-henry">{{ Auth::user()->name }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="{{ route('dashboard.user.profile') }}"><i
                                    class="bx bx-user font-size-16 align-middle me-1"></i> <span
                                    key="t-profile">Profile</span></a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"><i
                                        class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                                        key="t-logout">Logout</span></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title" key="t-menu">Dashboard</li>
                        <li>
                            <a href="{{ route('dashboard.index') }}" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span key="t-dashboards">Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-title" key="t-apps">Menu Utama</li>
                        @if (in_array(Auth::user()->role, ['admin']))
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-cog"></i>
                                    <span key="t-dashboards">Setting Website</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('dashboard.slider.index') }}"
                                            key="t-tui-paud">Slider/Banner</a></li>
                                    <li><a href="{{ route('dashboard.link_terkait.index') }}" key="t-tui-paud">Link
                                            Terkait</a></li>
                                    <li><a href="{{ route('dashboard.page.index') }}" key="t-tui-paud">Halaman</a></li>
                                    <li><a href="{{ route('dashboard.dynamic_menu.index') }}" key="t-tui-paud">Menu</a></li>
                                    <li><a href="{{ route('dashboard.layanan.index') }}" key="t-tui-paud">Layanan Digital</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('dashboard.kategori.index') }}" class="waves-effect">
                                    <i class="bx bx-flag"></i>
                                    <span key="t-chat">Kategori Berita</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard.berita.index') }}" class="waves-effect">
                                    <i class="bx bx-news"></i>
                                    <span key="t-chat">Berita</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-info-circle"></i>
                                    <span key="t-dashboards">Informasi</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('dashboard.bank_data.index') }}" key="t-tui-paud">Bank
                                            Data</a></li>
                                    <li><a href="{{ route('dashboard.faq.index') }}" key="t-tui-paud">Faqs</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-image"></i>
                                    <span key="t-dashboards">Galeri</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('dashboard.folder.index') }}" key="t-komponen">Folder</a>
                                    </li>
                                    <li><a href="{{ route('dashboard.foto.index') }}" key="t-komponen">Foto</a></li>
                                    <li><a href="{{ route('dashboard.video.index') }}" key="t-tui-paud">Video</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (in_array(Auth::user()->role, ['admin']))
                            <li>
                                <a href="{{ route('dashboard.user.index') }}" class="waves-effect">
                                    <i class="bx bx-user"></i>
                                    <span key="t-file-manager">Manajemen User</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard.kontak.index') }}" class="waves-effect">
                                    <i class="fab fa-wpforms"></i>
                                    <span key="t-file-manager">Pesan Kontak</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        @yield('content')
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->

    <script>
        var baseUrl = "{{ asset('skote') }}/";
    </script>

    <script src="{{ asset('skote') }}/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ asset('skote') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('skote') }}/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ asset('skote') }}/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('skote') }}/assets/libs/node-waves/waves.min.js"></script>

    <!-- apexcharts -->
    <script src="{{ asset('skote') }}/assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- dashboard init -->
    <script src="{{ asset('skote') }}/assets/js/pages/dashboard.init.js"></script>

    <!-- App js -->
    <script src="{{ asset('skote') }}/assets/js/app.js"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('skote') }}/assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('skote') }}/assets/libs/select2/js/select2.min.js"></script>

    @if (isset($datatable))
        <!-- Required datatable js -->
        <script src="{{ asset('skote') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('skote') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Responsive examples -->
        <script src="{{ asset('skote') }}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{ asset('skote') }}/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    @endif

    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $(".myForm").on('submit', function(event) {
                $(".formSubmitter").attr('disabled', true).addClass('disabled');
                $(".myForm").attr('onsubmit', 'return false');
            });

            $(document).on('click', '.buttonDeletion', function(e) {
                e.preventDefault();
                let form = $(this).parents('form');

                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus data ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((Delete) => {
                    if (Delete.isConfirmed) {
                        form.submit()
                        swal({
                            title: 'Dikonfirmasi!',
                            text: 'Data akan dihapus.',
                            icon: 'success',
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            }
                        });
                    } else {
                        swal.close();
                    }
                });
            })

            $(document).on('click', '.confirmButton', function(e) {
                e.preventDefault();
                let form = $(this).parents('form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Silahkan cek kembali datanya sebelum dikonfirmasi",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Konfirmasi!'
                }).then((Delete) => {
                    if (Delete.isConfirmed) {
                        form.submit()
                        swal({
                            title: 'Dikonfirmasi!',
                            text: 'Data akan diupdate.',
                            icon: 'success',
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            }
                        });
                    } else {
                        swal.close();
                    }
                });
            })

            $(document).on('click', '.confirmTolakButton', function(e) {
                e.preventDefault();
                let form = $(this).parents('form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Apakah anda yakin untuk merevisi permintaan ini",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Revisi!'
                }).then((Delete) => {
                    if (Delete.isConfirmed) {
                        form.submit()
                        swal({
                            title: 'Direvisi!',
                            text: 'Data akan diupdate.',
                            icon: 'success',
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            }
                        });
                    } else {
                        swal.close();
                    }
                });
            })

            // User functionalities
            $('#role').change(function() {
                if ($(this).val() == 'paud') {
                    $('.div_paud').show();
                } else {
                    $('.div_paud').hide();
                }
            })
        })
    </script>

<script>
    $(document).ready(function() {
        $('#level').change(function() {
            var level = $(this).val();
            if (level == '2') {
                $('.div_primary').fadeIn();
            } else if(level == '3') {
                $('.div_primary').fadeIn();
                $('.div_secondary').fadeIn();
            } else {
                $('.div_primary').hide();
                $('.div_secondary').hide();
            }
        })

        $('#tipe_menu').change(function() {
            var tipe_menu = $(this).val();
            if (tipe_menu == 'page') {
                $('.div_page').fadeIn();
                $('.div_link').hide();
            } else if(tipe_menu == 'link') {
                $('.div_page').hide();
                $('.div_link').fadeIn();
            }
        })
    })
</script>

    @stack('js')
</body>

</html>
