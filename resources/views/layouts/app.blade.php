<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
   <style>     
    .sidebar .nav-item .nav-link {
        padding-top: 0.65rem;
        padding-bottom: 0.65rem;
        font-size: 1.15rem;
    }

    .sidebar .nav-item .nav-link i {
        width: 35px;
        text-align: center;
        font-size: 1.4rem;
    }

    .sidebar .nav-item:first-of-type {
        margin-bottom: 1.2rem;
    }

    .sidebar .nav-item:last-child {
        margin-top: 1.5rem;
    }

    /* SIDEBAR DESKTOP */
    #accordionSidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 14rem;
        height: 100vh;
        z-index: 1030;
    }

    /* CONTENT DESKTOP */
    #content-wrapper {
        margin-left: 14rem;
        width: calc(100% - 14rem);
        min-width: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* NAVBAR DESKTOP */
    #content-wrapper .navbar {
        position: fixed;
        top: 0;
        right: 0;
        left: 14rem;
        z-index: 1020;
    }

    /* ISI HALAMAN */
    #content {
        padding-top: 70px;
        flex: 1 0 auto;
    }

    /* FOOTER */
    #content-wrapper .sticky-footer {
        margin-top: auto;
    }

    /* RESPONSIVE HP */
    @media (max-width: 767.98px) {

        /* Sidebar tersembunyi */
        #accordionSidebar {
            width: 6.5rem !important;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        /* Sidebar muncul saat tombol ditekan */
        body.sidebar-open #accordionSidebar {
            transform: translateX(0);
        }

        #accordionSidebar .nav-item .nav-link {
            width: 6.5rem;
        }

        #accordionSidebar .nav-item .nav-link span {
            display: none;
        }

        /* Konten memenuhi layar */
        #content-wrapper {
            margin-left: 0;
            width: 100%;
        }

        /* Navbar memenuhi layar */
        #content-wrapper .navbar {
            left: 0;
            width: 100%;
        }

        .container-fluid {
            padding-left: 10px;
            padding-right: 10px;
        }

        body.sidebar-open #content-wrapper {
            margin-left: 6.5rem;
            width: calc(100% - 6.5rem);
        }

        body.sidebar-open #content-wrapper .navbar {
            left: 6.5rem;
            width: calc(100% - 6.5rem);
        }
    }
    @media (min-width: 768px) {
        #accordionSidebar {
            width: 14rem !important;
            transform: none !important;
        }

        #content-wrapper {
            margin-left: 14rem !important;
            width: calc(100% - 14rem) !important;
        }

        #content-wrapper .navbar {
            left: 14rem !important;
            width: calc(100% - 14rem) !important;
        }
    }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.26.25/sweetalert2.all.min.js"></script>

    @stack('styles')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.inc.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
                           
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.inc.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layouts.inc.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset ('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Logout -->
    <script>
    function actionLogout(event) {
        event.preventDefault();

        Swal.fire({
            title: "Yakin ingin logout?",
            text: "Kamu harus login kembali untuk masuk.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Logout",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-logout').submit();
            }
        });
    }
    </script>

    <script>
    function toggleSidebar() {
        document.body.classList.toggle('sidebar-open');
    }

    window.addEventListener('resize', function () {
        if (window.innerWidth >= 768) {
            document.body.classList.remove('sidebar-open');

            const sidebar = document.getElementById('accordionSidebar');

            if (sidebar) {
                sidebar.classList.remove('toggled');
            }
        }
    });
    </script>

    @stack('scripts')
</body>

</html>