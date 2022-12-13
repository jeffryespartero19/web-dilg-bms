@extends('layouts.default')

@section('content')
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inhabitants Incoming List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Inhabitants Incoming List</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if (Auth::user()->User_Type_ID == 3)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
                            <div class="form-group col-lg-6">
                                <label for="CM_ID">City/Municipality</label>
                                <select class="form-control" id="CM_ID" name="CM_ID" required>
                                    <option value='' disabled selected>Select Option</option>

                                    @foreach($city1 as $city_municipality)
                                    <option value="{{ $city_municipality->City_Municipality_ID }}">{{ $city_municipality->City_Municipality_Name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="B_ID">Barangay</label>
                                <select class="form-control" id="B_ID" name="B_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color:#e7ad52; color:white">
                        <h3 class="card-title">Pending</h3>
                    </div>
                    <div class="card-body">
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Resident_ID</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Name Suffix</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr" hidden>{{$x->Resident_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Last_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->First_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Middle_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Name_Suffix}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="approve_inhabitants btn btn-success" value="{{$x->Resident_ID}}">Approve</button>
                                                <button class="disapprove_inhabitants  btn btn-danger" value="{{$x->Resident_ID}}">Disapprove</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color:#198754; color:white">
                        <h3 class="card-title">Approved</h3>
                    </div>
                    <div class="card-body">
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="table-responsive">
                                <table id="example2" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Resident_ID</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Name Suffix</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries2 as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr" hidden>{{$x->Resident_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Last_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->First_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Middle_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Name_Suffix}}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color:#ed5170; color:white">
                        <h3 class="card-title">Disapproved</h3>
                    </div>
                    <div class="card-body">
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="table-responsive">
                                <table id="example3" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Resident_ID</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Name Suffix</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries3 as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr" hidden>{{$x->Resident_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Last_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->First_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Middle_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Name_Suffix}}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div hidden>
                                <form id="Approved_Inhabitant" method="POST" action="{{ route('approve_disapprove_inhabitants') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                                    <input type="number" class="form-control" id="Resident_ID" name="Resident_ID">
                                    <input type="number" class="form-control" id="Status_ID" name="Status_ID">
                                </form>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
        $('#example2').DataTable();
        $('#example3').DataTable();
    });

    // Approve Inhabitants
    $(document).on('click', ('.approve_inhabitants'), function(e) {

        var disID = $(this).val();
        $('#Resident_ID').val(disID);
        $('#Status_ID').val(1);

        $('#Approved_Inhabitant').submit();

    });

    // Disapprove Inhabitants
    $(document).on('click', ('.disapprove_inhabitants'), function(e) {

        var disID = $(this).val();
        $('#Resident_ID').val(disID);
        $('#Status_ID').val(2);

        $('#Approved_Inhabitant').submit();
    });

    $(document).on("change", "#CM_ID", function() {

        // var City_Municipality_ID = $(this).val();
        var City_Municipality_ID = '01';

        $.ajax({
            type: "GET",
            url: "/get_barangay/" + City_Municipality_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#B_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#B_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["Barangay_ID"] +
                        "'>" +
                        element["Barangay_Name"] +
                        "</option>";
                    $('#B_ID').append(option);
                });
            }
        });
    });

    $(document).on("change", "#B_ID", function() {

        var Barangay_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_incoming_list/" + Barangay_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                // alert(data);
                $('#example').dataTable().fnClearTable();
                $('#example').dataTable().fnDraw();
                $('#example').dataTable().fnDestroy();

                data.forEach(function(element) {

                    $('#example').DataTable().row.add([
                        element["Last_Name"] + ', ' + element["First_Name"] + ' ' + element["Middle_Name"],
                        element["Deceased_Type"],
                        element["Cause_of_Death"],
                        element["Date_of_Death"],
                        "<button class='edit_deceased_profile' value='" + element["Resident_ID"] + "' data-toggle='modal' data-target='#updateDeceased_Profile'>Edit</button>",
                    ]).draw();
                });
            }
        });
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.incoming').addClass('active');
        $('.inhabitants_menu').addClass('active');
        $('.inhabitants_main').addClass('menu-open');
    });
</script>

<style>
    /* table {
        display: inline-block;
        overflow-x: scroll;
    } */
</style>

@endsection