<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    @include('includes.head')
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
            <div class="container">
                <a href="../../index3.html" class="navbar-brand">
                    <span class="brand-text font-weight-light"><b>DILG</b> Barangay Management System</span>
                </a>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
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
                                <input class="form-control" id="search" type="search" placeholder="Search Barangay" aria-label="Search" style="font-size: 40px; height:60px; width:600px">
                            </div>
                        </center>
                    </div>
                </div>
                <div class="row bg-secondary" style="height: 50px; margin-bottom:50px">

                </div>
                <div class="container">
                    <h1>hello</h1>
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
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>

    <script>
        $("#search").keyup(function() {

            var text = $(this).val();
            alert(text);
            $.ajax({
                type: "GET",
                url: "/search_barangay/" + text,
                fail: function() {
                    alert("request failed");
                },
                success: function(data) {
                    var data = JSON.parse(data);
                    $('#Province_ID').empty();
                    $('#City_Municipality_ID').empty();
                    $('#Barangay_ID').empty();

                    data.forEach(element => {
                        var option = " <option value='" +
                            element["Province_ID"] +
                            "'>" +
                            element["Province_Name"] +
                            "</option>";
                        $('#Province_ID').append(option);
                    });
                }
            });
        });
    </script>
</body>

</html>