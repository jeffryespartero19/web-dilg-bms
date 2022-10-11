<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="../../dist/img/pdea_logo.jpg" />

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


    <script src="{{ asset('/js/homeX.js') }}" defer></script>
    <link href="{{ asset('/css/homeX.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/general.css') }}" rel="stylesheet">
</head>

<body class="layout-top-nav layout-navbar-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <span class="brand-text font-weight-light"><b>DILG</b> Barangay Management System - {{$b_details[0]->Barangay_Name}}</span>
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
                <div class="row topBanner">
                </div>
                <div class="row bg-secondary" style="height: 50px;">

                </div>
            </div>
            <!-- /.content -->


            <br> <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">News Feed</h5>
                                </div>
                                @isset($posts)
                                @foreach ($posts as $p)
                                <div class="card-body">
                                    <div class="commentPoster borderSmoothen">
                                        <div class="flexer spacer_xxs_down padder10_all">
                                            <div>
                                                <div>
                                                    <div class="posterDate"> {{ ($p->Date_Stamp) }} </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="postContainer">
                                            <h4><u>{{$p->News_Title}}</u></h4>
                                            <br>
                                            <p>{{$p->News_Description}}</p>
                                        </div>
                                        <div class="Absolute-Center ">
                                            @if($uploads !=[])
                                            @foreach($uploads as $up)
                                            @if($up->File_Type == 'File' && $up->News_ID == $p->News_ID)
                                            <a href="{{ asset('/assets/uploads/FileX').'/'.$up->File_Name }}"> {{$up->File_Name}} </a>
                                            @endif
                                            @if($up->File_Type == 'Image' && $up->News_ID == $p->News_ID)
                                            <img src="{{ asset('/assets/uploads/imgX').'/'.$up->File_Name }}" class="maxDimensions">
                                            @endif
                                            @if($up->File_Type == 'Video' && $up->News_ID == $p->News_ID)
                                            <video width="70%" height="70%" controls class="Absolute-Center ">
                                                <source src="{{ asset('/assets/uploads/videoX').'/'.$up->File_Name }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                            @endif
                                            @if($up->File_Type == 'GIF' && $up->News_ID == $p->News_ID)
                                            <img width="70%" height="70%" src="{{ asset('/assets/uploads/gifX').'/'.$up->File_Name }}">
                                            @endif
                                            @endforeach
                                            @endif

                                        </div>

                                    </div>
                                </div>
                                <hr>
                                @endforeach
                                @endisset
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="col-lg-4">
                            <div class="card card-warning card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Events / Announcements</h5>
                                </div>

                                @isset($EV_AN)
                                @foreach($EV_AN as $ex)
                                <div class="card-body">
                                    <div class="flexer justifier EventContainer">
                                        <div class="E_Loop_container">
                                            <img src="{{ asset('/css/img/MegaPhone_PNG.png') }}" width="45" style="margin-left: -30px;">
                                        </div>
                                        <div class="EVtxtcontainer">
                                            <form method="GET" action="{{ route('viewAnnouncement') }}" autocomplete="off">
                                                <input name="thisAnnouncement" value="{{$ex->Announcement_ID}}" hidden>
                                                <button style="border: none; background-color:transparent; text-align:left;">
                                                    <div class="cardTitle EVtitle">
                                                        <h4>{{ $ex->Announcement_Title }}</h4>
                                                    </div>
                                                    <div class="EVtext">
                                                        <p>{{ $ex->Announcement_Description }}</p>
                                                    </div>
                                                </button>
                                            </form>
                                            <div class="moreInfo width100 txtCtr" style="margin-top:3px;"> Click for More Info</div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @endforeach
                                @endisset

                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    </div>
    {{-- <footer class="">
            <div>
                <span style="font-size: 11px;"> Wizzard Technologies, Inc. DILG-BIS</span>
            </div>
        </footer> --}}

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


    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>