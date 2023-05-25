<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.head')
</head>

<body class="hold-transition sidebar-mini text-sm layout-fixed layout-navbar-fixed">
    @if (Auth::check())
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav id="app" class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item">
                    <div class="image">
                        <img src="data:image/jpeg;base64,{{ Auth::user()->photo ?? '' }}" onerror=this.src="../../dist/img/profile.png" class="img-circle elevation-2 mt-1" width="30px" height="30px" alt="User Image">
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <!-- <a class="dropdown-item" href="#" onclick="removeCokie();"><i class="fa fa-user pr-2"></i> My Account</a>
                        <hr class="p-0 m-0"> -->
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();removeCokie();"><i class="fas fa-sign-out-alt pr-2"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> -->
            </ul>
        </nav>
        <!-- /.navbar -->

        @include('includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <footer class="main-footer">
            <!-- <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div> -->
            <strong>Copyright &copy; 2023 All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <!-- <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script> -->
    <!-- <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> -->
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>

    


    <!-- Page specific script -->
    @yield('scripts')
    <!-- DOM jquery to upload User Profile Photos -->
    <script>
        //set preview of image to upload
        $('#photo').on('change', function() {
            var file = this.files[0];
            var imagefile = file.type;
            var imageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (imageTypes.indexOf(imagefile) == -1) {
                //display error
                return false;
                $(this).empty();
            } else {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.empty-text').html(
                        '<img class="profile-user-img img-fluid" style="height: 200px; width:200px;" alt="User profile picture" src="' +
                        e.target.result +
                        '" onerror=this.src="../../dist/img/profile.png"/>'
                    );
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
    <!-- Collopse and set menus to active
    <script>
        function setCookie(key, value, expiry) {
            var expires = new Date();
            expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
            document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
        }

        function getCookie(key) {
            var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
            return keyValue ? keyValue[2] : null;
        }

        function eraseCookie(key) {
            var keyValue = getCookie(key);
            setCookie(key, keyValue, '-1');
        }

        function setactive(modulename, menu) {
            setCookie("modulename", modulename);
            setCookie("menu", menu);
        }

        function removeCokie() {
            eraseCookie('modulename');
            eraseCookie('menu');
        }

        $(document).ready(function() {

            if (getCookie('modulename') == '') {
                eraseCookie('modulename');

                $("#" + getCookie('menu')).removeClass('active');
                $("#" + getCookie('menu')).addClass('active');
            } else {

                $("#" + getCookie('modulename')).removeClass('menu-open');
                $("#" + getCookie('modulename')).addClass('menu-open');

                $("#" + getCookie('menu')).removeClass('active');
                $("#" + getCookie('menu')).addClass('active');

            }

            var hrm_checked = $("#customCheckbox3").prop('checked');
            var hrt_checked = $("#customCheckbox4").prop('checked');
            var hrp_checked = $("#customCheckbox5").prop('checked');
            var cpm_checked = $("#customCheckbox6").prop('checked');

            if (hrm_checked == false) {
                $("#hrm_table tbody tr td:first-child input:checkbox").removeAttr('checked');
                $("#hrm_table tbody tr td:first-child input:checkbox").attr('disabled', 'true');
            }

            if (hrt_checked == false) {
                $("#hrt_table tbody tr td:first-child input:checkbox").removeAttr('checked');
                $("#hrt_table tbody tr td:first-child input:checkbox").attr('disabled', 'true');
            }

            if (hrp_checked == false) {
                $("#hrp_table tbody tr td:first-child input:checkbox").removeAttr('checked');
                $("#hrp_table tbody tr td:first-child input:checkbox").attr('disabled', 'true');
            }

            if (cpm_checked == false) {
                $("#cpm_table tbody tr td:first-child input:checkbox").removeAttr('checked');
                $("#cpm_table tbody tr td:first-child input:checkbox").attr('disabled', 'true');
            }

        });
    </script> -->


    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        // $(function() {
        //     $("#example1").DataTable({
        //         "responsive": false,
        //         "lengthChange": false,
        //         "autoWidth": false,
        //         "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        // });
    </script>


    <!-- Set menu to active -->
    <script>
        $('#menu_sample > ul.nav li a').click(function(e) {
            var $this = $(this);
            $this.parent().siblings().removeClass('active').end().addClass('active');
            e.preventDefault();
        });
    </script>

    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>

    <style>
        .disabled_field {
            pointer-events: none;
            background-color: #e9ecef;
        }
    </style>

    <style>
        .select2-results__options {
            font-size: 16px !important;
        }

        .select2-selection__rendered {
            line-height: 28px !important;
        }

        .select2-container .select2-selection--single {
            height: 37px !important;
            font-size: 16px !important;
            padding: 9px 5px 0px 20px !important;
        }

        .select2-selection__arrow {
            height: 34px !important;
        }

        @media screen and (max-width: 600px) {
            .pc-view {
                display: none;
            }

            .card-body {
                padding: 2px;
            }

        }

        @media screen and (min-width: 601px) {
            .mobile-view {
                display: none;
            }
        }

        .required:after {
        content: " *";
        color: red;
    }
        
    </style>


    @endif
</body>

</html>