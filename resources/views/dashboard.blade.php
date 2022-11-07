@extends('layouts.default')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$inhabitants}}</h3>

                        <p>Inhabitants</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-people"></i>

                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$male}}</h3>

                        <p>Male</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-male"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$female}}</h3>

                        <p>Female</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-female"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3>{{$senior}}</h3>

                        <p>Senior Citizen</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-glasses-outline"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3>{{$d4ps}}</h3>

                        <p>4Ps Member</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-social-dropbox"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-lightblue">
                    <div class="inner">
                        <h3>{{$solo_parent}}</h3>

                        <p>Solo Parent</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-gray">
                    <div class="inner">
                        <h3>{{$indigent}}</h3>

                        <p>Indigent</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3>{{$resident_voter}}</h3>

                        <p>Resident Voter</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-home"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>{{$ofw}}</h3>

                        <p>OFW</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-earth"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <!-- 
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h3>Barangay Officials</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Term Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Some Product
                                    </td>
                                    <td>$13 USD</td>
                                    <td>
                                        12,000 Sold
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Another Product
                                    </td>
                                    <td>$29 USD</td>
                                    <td>
                                        123,234 Sold
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Amazing Product
                                    </td>
                                    <td>$1,230 USD</td>
                                    <td>
                                        198 Sold
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Perfect Item
                                    </td>
                                    <td>$199 USD</td>
                                    <td>
                                        87 Sold
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content-wrapper -->

@endsection