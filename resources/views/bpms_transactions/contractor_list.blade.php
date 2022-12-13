@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contractor List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BPMS</a></li>
                        <li class="breadcrumb-item active">Contractor List</li>
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
            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
                            <div class="form-group col-lg-3">
                                <label for="R_ID">Region</label>
                                <select class="form-control" id="R_ID" name="R_ID" required>
                                    <option value='' disabled selected>Select Option</option>

                                    @foreach($region1 as $region)
                                    <option value="{{ $region->Region_ID }}">{{ $region->Region_Name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="P_ID">Province</label>
                                <select class="form-control" id="P_ID" name="P_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="CM_ID">City/Municipality</label>
                                <select class="form-control" id="CM_ID" name="CM_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
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
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-success" data-target="#createContractor">New</button></div>
                                <div class="txtRight" style="margin-left: 5px;"><a href="{{ url('viewContractorPDF') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>Contractor Name</th>
                                            <th>Contact Person</th>
                                            <th>Contact No</th>
                                            <th>Contractor Address</th>
                                            <th>Contractor Tin</th>
                                            <th>Remarks</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>

                                            <td class="sm_data_col txtCtr">{{$x->Contractor_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Contact_Person}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Contact_No}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Contractor_Address}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Contractor_TIN}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Remarks}}</td>
                                            <td class="sm_data_col txtCtr">
                                                @if (Auth::user()->User_Type_ID == 1)
                                                <button class="edit_contractor" value="{{$x->Contractor_ID}}" data-toggle="modal" data-target="#updateContractor">Edit</button>
                                                @endif
                                                @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
                                                <button class="edit_contractor" value="{{$x->Contractor_ID}}" data-toggle="modal" data-target="#updateContractor">View</button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

<div class="modal fade" id="createContractor" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create Contractor Profile</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="newInhabitant" method="POST" action="{{ route('create_contractor') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Contractor Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Contractor_ID" name="Contractor_ID" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Contractor_Name">Contractor Name</label>
                                <input type="text" class="form-control" id="Contractor_Name" name="Contractor_Name">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Contact_Person">Contact Person</label>
                                <input type="text" class="form-control" id="Contact_Person" name="Contact_Person">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Contact_No">Contact No.</label>
                                <input type="text" class="form-control" id="Contact_No" name="Contact_No">
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Contractor_TIN">Contractor Tin</label>
                                <input type="text" class="form-control" id="Contractor_TIN" name="Contractor_TIN">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Remarks">Remarks</label>
                                <input type="text" class="form-control" id="Remarks" name="Remarks">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="Contractor_Address">Contractor Address</label>
                                <input type="text" class="form-control" id="Contractor_Address" name="Contractor_Address">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="width: 200px;">Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- Create Announcement_Status END -->

<div class="modal fade" id="updateContractor" tabindex="-1" role="dialog" aria-labelledby="Update_Contractor" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title flexer justifier">Updating Contractor Profile</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="newContrator" method="POST" action="{{ route('update_contractor') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Contractor Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Contractor_ID1" name="Contractor_ID1" hidden>
                            <input type="text" class="form-control" id="Contractor_ID" name="Contractor_ID" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Contractor_Name1">Contractor Name</label>
                                <input type="text" class="form-control" id="Contractor_Name1" name="Contractor_Name1">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Contact_Person1">Contact Person</label>
                                <input type="text" class="form-control" id="Contact_Person1" name="Contact_Person1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Contact_No1">Contact No.</label>
                                <input type="text" class="form-control" id="Contact_No1" name="Contact_No1">
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Contractor_TIN1">Contractor Tin</label>
                                <input type="text" class="form-control" id="Contractor_TIN1" name="Contractor_TIN1">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Remarks1">Remarks</label>
                                <input type="text" class="form-control" id="Remarks1" name="Remarks1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="Contractor_Address1">Contractor Address</label>
                                <input type="text" class="form-control" id="Contractor_Address1" name="Contractor_Address1">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="width: 200px;">Update</button>
                    </div>
                </form>
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

    $(document).on('click', '.modal-close', function(e) {
        $('#newInhabitant').trigger("reset");
    });




    // Edit Button Display Modal
    $(document).on('click', ('.edit_contractor'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_contractor",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Contractor_ID1').val(data['theEntry'][0]['Contractor_ID']);
                $('#Contractor_Name1').val(data['theEntry'][0]['Contractor_Name']);
                $('#Contact_Person1').val(data['theEntry'][0]['Contact_Person']);
                $('#Contact_No1').val(data['theEntry'][0]['Contact_No']);
                $('#Contractor_Address1').val(data['theEntry'][0]['Contractor_Address']);
                $('#Contractor_TIN1').val(data['theEntry'][0]['Contractor_TIN']);
                $('#Remarks1').val(data['theEntry'][0]['Remarks']);
            }
        });


    });

    $(document).on("change", "#R_ID", function() {

        var Region_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_province/" + Region_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#P_ID').empty();
                $('#CM_ID').empty();
                $('#B_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#P_ID').append(option1);
                $('#CM_ID').append(option1);
                $('#B_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["Province_ID"] +
                        "'>" +
                        element["Province_Name"] +
                        "</option>";
                    $('#P_ID').append(option);
                });
            }
        });
    });

    $(document).on("change", "#P_ID", function() {
        var Province_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_city/" + Province_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#CM_ID').empty();
                $('#B_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#CM_ID').append(option1);
                $('#B_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["City_Municipality_ID"] +
                        "'>" +
                        element["City_Municipality_Name"] +
                        "</option>";
                    $('#CM_ID').append(option);
                });
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
            url: "/get_contractor_list/" + Barangay_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#example').dataTable().fnClearTable();
                $('#example').dataTable().fnDraw();
                $('#example').dataTable().fnDestroy();

                data.forEach(element => {

                    $('#example').DataTable().row.add([
                        element["Contractor_Name"],
                        element["Contact_Person"],
                        element["Contact_No"],
                        element["Contractor_Address"],
                        element["Contractor_TIN"],
                        element["Remarks"],
                        "<button class='edit_contractor' value='" + element["Contractor_ID"] + "' data-toggle='modal' data-target='#updateContractor'>View</button>",
                    ]).draw();
                });
            }
        });
    });

    // Disable Form if DILG USER
    $(document).ready(function() {
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 3 || User_Type_ID == 4) {
            $("#newContrator :input").prop("disabled", true);
        }
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.projectcContractor').addClass('active');
        $('.project_menu').addClass('active');
        $('.project_main').addClass('menu-open');
    });
</script>

<style>

</style>

@endsection