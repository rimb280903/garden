<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | LAPRINT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- Bootstrap CSS -->
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"
        integrity="sha512-fX9YdV8WnyFr78GgV7zqJmK0sEwLxkxqZ1q3H1URdbiSDtTQzjlTndm2M29FbKd8Q2l1ImawzwZpjLXpE9C1jg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"
        integrity="sha512-cy1rlvVV8V4WxRqbJ7V0Q9f0c8HkbgJRUuA0zqGZZ+5N5dGw5NR85xP37oO/9p/QVYcn3tPApP5Jl10XszWFQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/assets/images/logo/favicon.png') }}">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">

    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/daterangepicker/daterangepicker.css') }}">

    <!-- Vector Map css -->
    <link rel="stylesheet"
        href="{{ asset('/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('/assets/js/hyper-config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('/assets/css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Datatables css -->
    <link href="{{ asset('/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />


</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">


        <!-- ========== Topbar Start ========== -->
        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-lg-2 gap-1">

                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="{{ url('/') }}" class="logo-light">
                            <span class="logo-lg">
                                <img src="{{ asset('/assets/images/logo/logo2.png') }}" alt="logo" width="400px">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('/assets/images/logo/favicon.png') }}" alt="small logo">
                            </span>
                        </a>
                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="button-toggle-menu">
                        <i class="mdi mdi-menu"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>

                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">
                    <li class="dropdown d-lg-none">
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown"
                            href="{{ url('#') }}" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ri-search-line font-22"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                            <form class="p-3">
                                <input type="search" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                            </form>
                        </div>
                    </li>


                    <li class="d-none d-sm-inline-block">
                        <div class="nav-link" id="light-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left"
                            title="Theme Mode">
                            <i class="ri-moon-line font-22"></i>
                        </div>
                    </li>


                    <li class="d-none d-md-inline-block">
                        <a class="nav-link" href="{{ url('') }}" data-toggle="fullscreen">
                            <i class="ri-fullscreen-line font-22"></i>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown"
                            href="{{ url('#') }}" role="button" aria-haspopup="false" aria-expanded="false">

                            <span class="d-lg-flex flex-column gap-1 d-none">
                                <h5 class="my-0">{{ auth()->user()->name }}</h5>
                                <h6 class="my-0 fw-normal text-center">{{ auth()->user()->role }}</h6>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            <!-- item-->
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0 text-center">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="{{ url('javascript:void(0);') }}" class="dropdown-item">

                                <center>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger px-4"><i
                                                class="mdi mdi-logout me-1"></i>Logout</button>
                                    </form>
                                </center>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->

























        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

            <!-- Brand Logo Light -->
            <a href="{{ url('') }}" class="logo logo-light">
                <span class="logo-lg">
                    <img src="{{ asset('/assets/images/logo/logo2.png') }}" alt="logo">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('/assets/images/logo/favicon.png') }}" alt="small logo">
                </span>
            </a>

            <!-- Brand Logo Dark -->
            <a href="{{ url('/') }}" class="logo logo-dark">
                <span class="logo-lg">
                    <img src="{{ asset('/assets/images/logo-dark.png') }}" alt="dark logo">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('/assets/images/logo-dark-sm.png') }}" alt="small logo">
                </span>
            </a>

            <!-- Sidebar Hover Menu Toggle Button -->
            <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Show Full Sidebar">
                <i class="ri-checkbox-blank-circle-line align-middle"></i>
            </div>

            <!-- Full Sidebar Menu Close Button -->
            <div class="button-close-fullsidebar">
                <i class="ri-close-fill align-middle"></i>
            </div>

            <!-- Sidebar -left -->
            <div class="h-100" id="leftside-menu-container" data-simplebar>


                <!--- Sidemenu -->
                <ul class="side-nav">

                    <li class="side-nav-item">
                        <a href="{{ url('admin2/dashboard/products') }}" class="side-nav-link">

                            <i class="uil uil-angle-double-right"></i> <span> Products </span>
                        </a>
                    </li>


                    <li class="side-nav-item">
                        <a href="{{ url('admin2/dashboard/categories') }}" class="side-nav-link">

                            <i class="uil uil-angle-double-right"></i><span> Categories </span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="{{ url('admin2/dashboard/variants') }}" class="side-nav-link">

                            <i class="uil uil-angle-double-right"></i> <span> Variants </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="{{ url('/admin2/dashboard/mails') }}" class="side-nav-link">

                            <i class="uil uil-angle-double-right"></i> <span>Mails </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="{{ url('admin2/dashboard/blogs') }}" class="side-nav-link">

                            <i class="uil uil-angle-double-right"></i> <span>Blogs </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="{{ url('admin2/dashboard/tags') }}" class="side-nav-link">

                            <i class="uil uil-angle-double-right"></i> <span>Tags </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="{{ url('admin2/dashboard/restoreProducts') }}" class="side-nav-link">

                            <i class="uil uil-angle-double-right"></i> <span>Restore Products </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="{{ url('admin2/dashboard/restoreCategories') }}" class="side-nav-link">

                            <i class="uil uil-angle-double-right"></i> <span>Restore Categories </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="{{ url('/admin2/dashboard/restoreMails') }}" class="side-nav-link">

                            <i class="uil uil-angle-double-right"></i> <span>Restore Mails </span>
                        </a>
                    </li>
                   

                    

                </ul>
            </div>
        </div>



























        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!-- content -->
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->



    <!-- Vendor js -->

    <script src="{{ asset('/assets/js/vendor.min.js') }}"></script>

    <!-- Daterangepicker js -->
    <script src="{{ asset('/assets/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Apex Charts js -->
    <script src="{{ asset('/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector Map js -->
    <script src="{{ asset('/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
    </script>

    <!-- Dashboard App js -->
    <script src="{{ asset('/assets/js/pages/demo.dashboard.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('/assets/js/app.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>


    <!-- Datatables js -->
    <script src="{{ asset('/assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

    <!-- Datatable Init js -->
    <script src="{{ asset('/assets/js/pages/demo.datatable-init.js') }}"></script>
</body>

</html>
