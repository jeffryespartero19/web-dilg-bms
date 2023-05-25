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
        @if (Auth::user()->User_Type_ID == 2)

        @else
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
                    <a href="{{route('inhabitants_information_list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                    <a href="{{route('inhabitants_information_list_male')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                    <a href="{{route('inhabitants_information_list_female')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3" style="padding: 10px;">
                <div class="bg-default card" style="height: 500px;">
                    <table class="table">
                        <tr>
                            <td>Senior</td>
                            <td style="text-align: right;">{{$senior}}</td>
                        </tr>
                        <tr>
                            <td>Adult</td>
                            <td style="text-align: right;">{{$adult}}</td>
                        </tr>
                        <tr>
                            <td>Teen</td>
                            <td style="text-align: right;">{{$teen}}</td>
                        </tr>
                        <tr>
                            <td>Children</td>
                            <td style="text-align: right;">{{$children}}</td>
                        </tr>
                        <tr>
                            <td>Infant/Toddlers</td>
                            <td style="text-align: right;">{{$infant}}</td>
                        </tr>
                        <tr>
                            <td>4P's Member</td>
                            <td style="text-align: right;">{{$d4ps}}</td>
                        </tr>
                        <tr>
                            <td>Solo Parent</td>
                            <td style="text-align: right;">{{$solo_parent}}</td>
                        </tr>
                        <tr>
                            <td>Indigent</td>
                            <td style="text-align: right;">{{$indigent}}</td>
                        </tr>
                        <tr>
                            <td>Resident Voter</td>
                            <td style="text-align: right;">{{$resident_voter}}</td>
                        </tr>
                        <tr>
                            <td>OFW</td>
                            <td style="text-align: right;">{{$ofw}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-3" style="padding: 10px;">
                <div class="bg-default card" style="height: 500px;">
                </div>
            </div>
            <div class="col-lg-3" style="padding: 10px;">
                <div class="bg-default card" style="height: 500px;">
                    <table class="table">
                        <thead>
                            <th>
                                Quick Links
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1. <a href="{{route('application_list')}}">Accept Inhabitants</a></td>
                            </tr>
                            <tr>
                                <td>2. <a href="{{route('document_request_pending_list')}}">Issue Certification</a></td>
                            </tr>
                            <tr>
                                <td>3. <a href="{{route('inhabitants_information_list')}}">Add Inhabitants</a></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="col-lg-3" style="padding: 10px;">
                <div class="bg-default card" style="height: 500px;">
                    <table class="table">
                        <thead>
                            <th>
                                Justice
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Total Barangay Case/Blotter</td>
                                <td style="text-align: right;">{{$blotter}}</td>
                            </tr>
                            <tr>
                                <td>Total Resolve</td>
                                <td style="text-align: right;">2</td>
                            </tr>
                            <tr>
                                <td>Total CFA</td>
                                <td style="text-align: right;">3</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
            <!-- ./col -->
        </div>
        @endif
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content-wrapper -->

@endsection