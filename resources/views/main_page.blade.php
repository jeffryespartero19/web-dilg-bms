<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="../../css/logos/DILG_logo.png" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Other styles -->
    <link rel="stylesheet" href="{{ asset('css/c_gl.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/fontawesome.min.css') }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <span class="brand-text font-weight-light"><b>DILG</b> Barangay Management System</span>
                </a>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('registers') }}" class="nav-link">Register</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content" style="height: 150px;">
                <div class="container">
                    <div class="row " style="padding-top: 20px;">
                        <img src="{{ asset('/dist/img/logo-dilg-new.png') }}">
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="row bg-warning" style="height: 250px; padding-top:100px">
                    <div class="col-12">
                        <center>
                            <div class="input-group" style="width: 50%;">
                                <input class="form-control" id="search" type="search" placeholder="Search" aria-label="Search" style="font-size: 40px; height:60px; width:600px">
                            </div>
                        </center>
                    </div>
                </div>
                <div class="row bg-secondary" style="height: 50px; margin-bottom:50px">

                </div>
                <div class="container">
                    <div class="BRGY_list">
                        @include('main_page_data')
                    </div>
                    {!! $db_entries->links() !!}
                </div>

            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2023 <a href="#">DILG BMS</a>.</strong> All rights reserved.
        </footer>
    </div>

    <div class="modal fade" id="login">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Login</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" placeholder="Enter email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="Enter password" value="{{ old('password') }}" required autocomplete="current-password" autofocus>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>

                        <div class="form-group">
                            @if (Route::has('password.request'))
                            <label for="exampleInputEmail1">
                                <a href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </label>
                            @endif

                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <form id="BRGYFilter" action="{{ route('main') }}" hidden>
        @csrf
        <input type="text" id="Barangay_ID" name="Barangay_ID">
    </form>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

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
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    <script>
        // Data Table
        $(document).ready(function() {
            $('#example').DataTable();
        });

        $("#search").keydown(function(event) {
            if (event.which == 13) {
                event.preventDefault();
                BrgyFilter();
            }
        });

        $(document).on("click", ".EnterLink", function() {
            var Barangay_ID = $(this).val();

            $('#Barangay_ID').val(Barangay_ID);
            $('#BRGYFilter').submit();

        });

        $(document).on('click', ".pagination a", function(event) {
            event.preventDefault();

            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);

            BrgyFilter();
        });

        function BrgyFilter() {
            var page = $('#hidden_page').val();
            var text = $('#search').val();

            $.ajax({
                url: "/search_barangay_main?page=" + page + "&param1=" + text,
                success: function(data) {
                    $('.BRGY_list').html('');
                    $('.BRGY_list').html(data);
                }
            });
        }
    </script>

    @error('email')
    <script>
        alert('Login Credentials Incorrect');
    </script>
    @enderror

</body>

</html>