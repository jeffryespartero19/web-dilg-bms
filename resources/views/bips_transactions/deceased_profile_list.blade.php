@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Deceased Profile List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Deceased Profile List</li>
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
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-success" data-target="#createDeceased_Profile" style="width: 100px;">New</button></div>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Deceased Type</th>
                                            <th>Cause of Death</th>
                                            <th>Date of Death</th>
                                            <th>Actions</th>
                                        </tr>
                                        <tr>
                                            <td><input class="form-control searchFilter searchFilter1" style="min-width: 200px;" type="text"></td>
                                            <td>
                                                <select class="form-control searchFilter searchFilter2" style="min-width: 200px;">
                                                    <option value="" disabled selected>Select Option</option>
                                                    @foreach($deceased_type as $dc)
                                                    <option value="{{ $dc->Deceased_Type_ID }}">{{ $dc->Deceased_Type }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input class="form-control searchFilter searchFilter3" style="min-width: 200px;" type="text"></td>
                                            <td><input class="form-control searchFilter searchFilter4" style="min-width: 200px;" type="date"></td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody id="ListData">
                                        @include('bips_transactions.deceased_profile_list_data')
                                    </tbody>
                                </table>
                                {!! $db_entries->links() !!}
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1">
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

<!-- Create Announcement_Status Modal  -->

<div class="modal fade" id="createDeceased_Profile" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create Deceased Profile</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newInhabitant" method="POST" action="{{ route('create_deceased_profile') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <h3>Resident Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Resident_ID" name="Resident_ID" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label class="required" for="Resident_ID">Name</label>
                                <select class="form-control" id="Resident_IDs" name="Resident_IDs" required>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label class="required" for="Deceased_Type_ID">Deceased Type</label>
                                <select class="form-control" id="Deceased_Type_ID" name="Deceased_Type_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($deceased_type as $bt1)
                                    <option value="{{ $bt1->Deceased_Type_ID }}">{{ $bt1->Deceased_Type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h3>Death Information</h3>
                        <br>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label class="required" for="Cause_of_Death">Cause of Death</label>
                                <input type="text" class="form-control" id="Cause_of_Death" name="Cause_of_Death" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label class="required" for="Date_of_Death">Date of Death</label>
                                <input type="date" class="form-control" id="Date_of_Death" name="Date_of_Death" required>
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


<!-- Create Announcement_Status END -->




<div class="modal fade" id="updateDeceased_Profile" role="dialog" aria-labelledby="Update_Deceased_Profile" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="DPTitle">Edit Deceased Profile</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newDeceased_Profile" method="POST" action="{{ route('update_deceased_profile') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <h3>Resident Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Resident_ID2" name="Resident_ID2" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label class="required" for="Resident_IDs2">Name</label>
                                <select class="form-control" id="Resident_IDs2" name="Resident_IDs2" required>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label class="required" for="Deceased_Type_ID2">Deceased Type</label>
                                <select class="form-control" id="Deceased_Type_ID2" name="Deceased_Type_ID2" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($deceased_type as $bt1)
                                    <option value="{{ $bt1->Deceased_Type_ID }}">{{ $bt1->Deceased_Type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h3>Death Information</h3>
                        <br>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label class="required" for="Cause_of_Death2">Cause of Death</label>
                                <input type="text" class="form-control" id="Cause_of_Death2" name="Cause_of_Death2" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label class="required" for="Date_of_Death2">Date of Death</label>
                                <input type="date" class="form-control" id="Date_of_Death2" name="Date_of_Death2" required>
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
                <h4 class="modal-title flexer justifier" id="Modal_Title">Ordinance Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <h4 id="VName"> </h4>
                    <div class="row">

                    </div>
                    <div class="col-12">
                        <table id="example2" class="table table-striped table-bordered" style="width:100%">
                            <tr>
                                <td style="width:300px"><strong>Name: </strong></td>
                                <td><span id="vName"></span></td>
                            </tr>
                            <tr>
                                <td style="width:300px"><strong>Deceased Type: </strong></td>
                                <td><span id="vDeceased_Type"></span></td>
                            </tr>
                            <tr>
                                <td style="width:300px"><strong>Cause of Death: </strong></td>
                                <td><span id="vCause_of_Death"></span></td>
                            </tr>
                            <tr>
                                <td style="width:300px"><strong>Date of Death: </strong></td>
                                <td><span id="vDate_of_Death"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    $(document).ready(function() {
        //Select2 Lazy Loading Resolution
        $("#Resident_IDs").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });

        $("#Resident_IDs2").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });
    });

    // Edit Button Display Modal
    $(document).on('click', ('.edit_deceased_profile'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_deceased_profile",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Resident_ID2').val(data['theEntry'][0]['Resident_ID']);
                // $('#Resident_IDs2').val(data['theEntry'][0]['Resident_ID']);
                $('#Cause_of_Death2').val(data['theEntry'][0]['Cause_of_Death']);
                $('#Deceased_Type_ID2').val(data['theEntry'][0]['Deceased_Type_ID']);
                $('#Date_of_Death2').val(data['theEntry'][0]['Date_of_Death']);
                var option = " <option value='" +
                    data['theEntry'][0]['Resident_ID'] +
                    "'>" +
                    data['theEntry'][0]['Last_Name'] + ", " + data['theEntry'][0]['First_Name'] + " " + data['theEntry'][0]['Middle_Name'] +
                    "</option>";
                $('#Resident_IDs2').append(option);
            }
        });


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
            url: "/get_deceased_list/" + Barangay_ID,
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

    // Disable Form if DILG USER
    $(document).ready(function() {
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 3) {
            $("#newDeceased_Profile :input").prop("disabled", true);
        }
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.deceased_profile').addClass('active');
        $('.inhabitants_menu').addClass('active');
        $('.inhabitants_main').addClass('menu-open');
    });

    $(document).on('click', ('.view_deceased_profile'), function() {
        $("#newDeceased_Profile :input").prop("disabled", true);
        $(".modal-close").prop("disabled", false);
        $(this).closest(".sm_data_col").find(".edit_deceased_profile").trigger('click');
        $("#DPTitle").text("View Deceased Profile");
    });

    $(document).on('click', '.modal-close', function(e) {
        $('#newDeceased_Profile').trigger("reset");
        $("#newDeceased_Profile :input").prop("disabled", false);
        $("#DPTitle").text("Edit Deceased Profile");
    });

    // Delete Record
    $(document).on('click', ('.delete_deceased_profile'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this deceased profile?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_deceased_profile",
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
                            text: "Record has been deleted.",
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
            url: "/get_deceased_info",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#vCause_of_Death').html(data['theEntry'][0]['Cause_of_Death']);
                $('#vDate_of_Death').html(data['theEntry'][0]['Date_of_Death']);
                $('#vDeceased_Type').html(data['theEntry'][0]['Deceased_Type']);
                $('#vName').html(data['theEntry'][0]['Last_Name'] + ', ' + data['theEntry'][0]['First_Name'] + ' ' + data['theEntry'][0]['Middle_Name']);
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
        var page = $('#hidden_page').val();

        $.ajax({
            url: "/search_deceased_profile_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4,
            success: function(data) {
                $('#ListData').html('');
                $('#ListData').html(data);
            }
        });
    }
</script>


@endsection