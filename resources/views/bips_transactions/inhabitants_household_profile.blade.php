@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inhabitants Household List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Inhabitants Household List</li>
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
                    <div class="card-body">
                        <div style="text-align: right;">
                            <div class="btn-group">
                                @if (Auth::user()->User_Type_ID == 1)
                                <div style="padding: 2px;"><a class="btn btn-success" href="{{ url('inhabitants_household_details/0') }}" style="width: 100px;">New</a></div>
                                @endif
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Print</button></div>
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div>
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Household Name</th>
                                                <th>Monthly Income</th>
                                                <th>Tenure of Lot</th>
                                                <th>Housing Unit</th>
                                                <th>Family Type</th>
                                                <th>Actions</th>
                                            </tr>
                                            <tr>
                                                <td><input class="form-control searchFilter searchFilter1" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter2" style="min-width: 200px;" type="number"></td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter3" style="min-width: 200px;">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach($tenure_of_lot as $tol)
                                                        <option value="{{ $tol->Tenure_of_Lot_ID }}">{{ $tol->Tenure_of_Lot }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter4" style="min-width: 200px;">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach($housing_unit as $hu)
                                                        <option value="{{ $hu->Housing_Unit_ID }}">{{ $hu->Housing_Unit }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter5" style="min-width: 200px;">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach($family_type as $ft)
                                                        <option value="{{ $ft->Family_Type_ID }}">{{ $ft->Family_Type_Name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody id="ListData">   
                                            @include('bips_transactions.inhabitants_household_profile_data')
                                        </tbody>
                                    </table>
                                    {!! $db_entries->links() !!}
                                    <input type="hidden" name="hidden_page" id="hidden_page" value="1">
                                </div>

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


<div class="modal fade" id="print_filter" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="print_report" method="POST" action="{{ route('view_Household') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <input type="checkbox" id="chk_Household_Name" name="chk_Household_Name">
                                <label for="chk_Household_Name">Household Name</label><br>
                                <input type="checkbox" id="chk_Household_Monthly_Income" name="chk_Household_Monthly_Income">
                                <label for="chk_Household_Monthly_Income">Household Monthly Income</label><br>
                                <input type="checkbox" id="chk_Family_Type_Name" name="chk_Family_Type_Name">
                                <label for="chk_Family_Type_Name">Family Type</label><br>
                                <input type="checkbox" id="chk_Tenure_of_Lot" name="chk_Tenure_of_Lot">
                                <label for="chk_Tenure_of_Lot">Tenure of Lot</label><br>
                                <input type="checkbox" id="chk_Housing_Unit" name="chk_Housing_Unit">
                                <label for="chk_Housing_Unit">Housing Unit</label><br>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="download_filter" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="download_report" method="POST" action="{{ route('download_Household') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <input type="checkbox" id="1chk_Household_Name" name="chk_Household_Name">
                                <label for="1chk_Household_Name">Household Name</label><br>
                                <input type="checkbox" id="1chk_Household_Monthly_Income" name="chk_Household_Monthly_Income">
                                <label for="1chk_Household_Monthly_Income">Household Monthly Income</label><br>
                                <input type="checkbox" id="1chk_Family_Type_Name" name="chk_Family_Type_Name">
                                <label for="1chk_Family_Type_Name">Family Type</label><br>
                                <input type="checkbox" id="1chk_Tenure_of_Lot" name="chk_Tenure_of_Lot">
                                <label for="1chk_Tenure_of_Lot">Tenure of Lot</label><br>
                                <input type="checkbox" id="1chk_Housing_Unit" name="chk_Housing_Unit">
                                <label for="1chk_Housing_Unit">Housing Unit</label><br>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ViewInfo" tabindex="-1" role="dialog" aria-labelledby="ViewInfo" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="VName">Household Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- <h4 id="VName"> </h4> -->

                <table class="table table-striped table-bordered" style="width:100%">
                    <tbody id="HHMembers">
                        <tr>
                            <td colspan="3" style="text-align: center; font-size:large">Details</td>
                        </tr>
                        <tr>
                            <td style="width:30%"><strong>Household Name: </strong></td>
                            <td colspan="2"><span id="vHousehold_Name"></span></td>
                        </tr>
                        <tr>
                            <td style="width:30%"><strong>Family Type: </strong></td>
                            <td colspan="2"><span id="vFamily_Type_Name"></span></td>
                        </tr>
                        <tr>
                            <td style="width:30%"><strong>Monthly Income: </strong></td>
                            <td colspan="2"><span id="vHousehold_Monthly_Income"></span></td>
                        </tr>
                        <tr>
                            <td style="width:30%"><strong>Tenure of Lot: </strong></td>
                            <td colspan="2"><span id="vTenure_of_Lot"></span></td>
                        </tr>
                        <tr>
                            <td style="width:30%"><strong>Housing Unit: </strong></td>
                            <td colspan="2"><span id="vHousing_Unit"></span></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: center; font-size:large">Members</td>
                        </tr>
                        <tr>
                            <th style="width:30%"><strong>Name</strong></th>
                            <th style="width:30%"><strong>Position</strong></th>
                            <th style="width:30%"><strong>Head</strong></th>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>



<!-- Create Announcement_Status END -->

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    $(document).on('click', '.modal-close', function(e) {
        $('#newHousehold').trigger("reset");
        $('#Modal_Title').text('Create Household Profile');
        $('.HHM').remove();
    });

    // Edit Button Display Modal
    $(document).on('click', ('.edit_household'), function(e) {

        var disID = $(this).val();
        $('#Modal_Title').text('Edit Household Profile');



        $.ajax({
            url: "/get_household_info",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Household_Profile_ID').val(data['theEntry'][0]['Household_Profile_ID']);
                $('#Resident_ID').val(data['theEntry'][0]['Resident_ID']);
                $('#Household_Monthly_Income').val(data['theEntry'][0]['Household_Monthly_Income']);
                $('#Household_Name').val(data['theEntry'][0]['Household_Name']);
                $('#Family_Position_ID').val(data['theEntry'][0]['Family_Position_ID']);
                $('#Tenure_of_Lot_ID').val(data['theEntry'][0]['Tenure_of_Lot_ID']);
                $('#Housing_Unit_ID').val(data['theEntry'][0]['Housing_Unit_ID']);
                $('#Family_Type_ID').val(data['theEntry'][0]['Family_Type_ID']);
            }
        });


    });

    $(document).on("change", "#CM_ID", function() {

        var City_Municipality_ID = $(this).val();

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
            url: "/get_household_list/" + Barangay_ID,
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
                        element["Household_Name"],
                        element["Household_Monthly_Income"],
                        element["Tenure_of_Lot"],
                        element["Housing_Unit"],
                        element["Family_Type_Name"],
                        "<a class='btn btn-success' href='inhabitants_household_details/" + element["Household_Profile_ID"] + "'>Edit</a>",
                    ]).draw();
                });
            }
        });
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.household').addClass('active');
        $('.inhabitants_menu').addClass('active');
        $('.inhabitants_main').addClass('menu-open');
    });

    // Delete Household
    $(document).on('click', ('.delete_household'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this household?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_household",
                    type: 'GET',
                    data: {
                        id: disID
                    },
                    fail: function() {
                        alert('request failed');
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Deleted',
                            text: "Household has been deleted.",
                            icon: 'success',
                            showConfirmButton: false,
                        });
                        location.reload();
                    }
                });

            }
        });
    });

    // View Details
    $(document).on('click', ('.view_info'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_household_info",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#vHousehold_Name').html(data['theEntry'][0]['Household_Name']);
                $('#vHousehold_Monthly_Income').html(data['theEntry'][0]['Household_Monthly_Income']);
                $('#vFamily_Type_Name').html(data['theEntry'][0]['Family_Type_Name']);
                $('#vHousing_Unit').html(data['theEntry'][0]['Housing_Unit']);
                $('#vTenure_of_Lot').html(data['theEntry'][0]['Tenure_of_Lot']);

                $.ajax({
                    url: "/get_houshold_members",
                    type: 'GET',
                    data: {
                        id: disID
                    },
                    fail: function() {
                        alert('request failed');
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        data.forEach(element => {
                            if (element['Family_Head'] == 1) {
                                $head = 'Yes';
                            } else {
                                $head = 'No';
                            }
                            var list = '<tr class="HHM">' +
                                '<td>' + element['Last_Name'] + ', ' + element['First_Name'] + ' ' + element['Middle_Name'] + '</td>' +
                                '<td>' + element['Family_Position'] + '</td>' +
                                '<td>' + $head + '</td></tr>';
                            $('#HHMembers').append(list);
                        });
                    }
                });
            }
        });


    });

    $(".searchFilter").change(function() {
        SearchData2();
    });

    function SearchData2() {
        // alert('test');
        var param1 = $('.searchFilter1').val();
        var param2 = $('.searchFilter2').val();
        var param3 = $('.searchFilter3').val();
        var param4 = $('.searchFilter4').val();
        var param5 = $('.searchFilter5').val();
        var page = $('#hidden_page').val();

        $.ajax({
            url: "/search_household_profile_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4 + "&param5=" + param5,
            success: function(data) {
                $('#ListData').html('');
                $('#ListData').html(data);
            }
        });
    }
</script>

<style>
    .required span:before {
        content: "*"
    }
</style>

@endsection