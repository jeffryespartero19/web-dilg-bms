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
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Resident_ID</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Name Suffix</th>
                                            <th>Actions</th>
                                        </tr>
                                        <tr>
                                            <td hidden></td>
                                            <td><input class="form-control searchFilter1 searchFilter11" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td><input class="form-control searchFilter1 searchFilter12" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td><input class="form-control searchFilter1 searchFilter13" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td><input class="form-control searchFilter1 searchFilter14" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody id="ListData_1">
                                        @include('bips_transactions.inhabitants_incoming_list_pending_data')
                                    </tbody>
                                </table>
                                {!! $db_entries->links() !!}
                                <input type="hidden" name="hidden_page_1" id="hidden_page_1" value="1">
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
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Resident_ID</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Name Suffix</th>
                                        </tr>
                                        <tr>
                                            <td hidden></td>
                                            <td><input class="form-control searchFilter2 searchFilter21" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td><input class="form-control searchFilter2 searchFilter22" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td><input class="form-control searchFilter2 searchFilter23" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td><input class="form-control searchFilter2 searchFilter24" style="min-width: 200px;" type="text" placeholder="search"></td>
                                        </tr>
                                    </thead>
                                    <tbody id="ListData_2">
                                        @include('bips_transactions.inhabitants_incoming_list_approved_data')
                                    </tbody>
                                </table>
                                {!! $db_entries2->links() !!}
                                <input type="hidden" name="hidden_page_2" id="hidden_page_2" value="1">
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
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Resident_ID</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Name Suffix</th>
                                        </tr>
                                        <tr>
                                            <td hidden></td>
                                            <td><input class="form-control searchFilter3 searchFilter31" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td><input class="form-control searchFilter3 searchFilter32" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td><input class="form-control searchFilter3 searchFilter33" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td><input class="form-control searchFilter3 searchFilter34" style="min-width: 200px;" type="text" placeholder="search"></td>
                                        </tr>
                                    </thead>
                                    <tbody id="ListData_3">
                                        @include('bips_transactions.inhabitants_incoming_list_disapproved_data')
                                    </tbody>
                                </table>
                                {!! $db_entries3->links() !!}
                                <input type="hidden" name="hidden_page_3" id="hidden_page_3" value="1">
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

    $(".searchFilter1").change(function() {
        SearchData1();
    });

    function SearchData1() {
        // alert('test');
        var param1 = $('.searchFilter11').val();
        var param2 = $('.searchFilter12').val();
        var param3 = $('.searchFilter13').val();
        var param4 = $('.searchFilter14').val();
        var page = $('#hidden_page_1').val();

        $.ajax({
            url: "/search_inhabitants_incoming_pending_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4,
            success: function(data) {
                $('#ListData_1').html('');
                $('#ListData_1').html(data);
            }
        });
    }

    $(".searchFilter2").change(function() {
        SearchData2();
    });

    function SearchData2() {
        // alert('test');
        var param1 = $('.searchFilter21').val();
        var param2 = $('.searchFilter22').val();
        var param3 = $('.searchFilter23').val();
        var param4 = $('.searchFilter24').val();
        var page = $('#hidden_page_2').val();

        $.ajax({
            url: "/search_inhabitants_incoming_approved_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4,
            success: function(data) {
                $('#ListData_2').html('');
                $('#ListData_2').html(data);
            }
        });
    }

    $(".searchFilter3").change(function() {
        SearchData3();
    });

    function SearchData3() {
        // alert('test');
        var param1 = $('.searchFilter31').val();
        var param2 = $('.searchFilter32').val();
        var param3 = $('.searchFilter33').val();
        var param4 = $('.searchFilter34').val();
        var page = $('#hidden_page_3').val();

        $.ajax({
            url: "/search_inhabitants_incoming_disapproved_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4,
            success: function(data) {
                $('#ListData_3').html('');
                $('#ListData_3').html(data);
            }
        });
    }
</script>

<style>
    /* table {
        display: inline-block;
        overflow-x: scroll;
    } */
</style>

@endsection