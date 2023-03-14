@extends('layouts.default')

@section('content')

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Resolutions List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Resolutions List</li>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (Auth::user()->User_Type_ID == 3)
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
                        @else
                        <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
                        @endif
                        <div class="row">
                            <div class="form-group col-4" style="margin: 0px;">
                                <div>
                                    <label for="">Search</label>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control SearchResolution" name="q" placeholder="Search Resolution">
                                </div>
                            </div>
                            <div class="form-group col-4" style="margin: 0px;">
                                <div>
                                    <label for="">Date From</label>
                                </div>
                                <div class="input-group mb-3">
                                    <input id="date_from" name="date_from" type="date" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group col-4" style="margin: 0px;">
                                <div>
                                    <label for="">Date To</label>
                                </div>
                                <div class="input-group mb-3">
                                    <input id="date_to" name="date_to" type="date" class="form-control" autocomplete="off">
                                </div>
                            </div>

                        </div>
                        <div style="padding: 2px; float:right"><button class="btn btn-success SearchResolutionBTN" style="width: 100px;">Search</button></div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="text-align: right;">
                            <div class="btn-group">
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-success" data-target="#createOrdinance_Info" style="width: 100px;">New</button></div>
                                <!-- <div class="txtRight" style="margin-left: 5px;"><a href="{{ url('view_Ordinance') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div> -->
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Export</button></div>
                                <!-- <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div> -->
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Resolution Number</th>
                                            <th>Title</th>
                                            <th>Date of Approval</th>
                                            <th>Date of Effectivity</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="resolution_list">
                                        @include('boris_transactions.resolution_data')
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




<!-- Create Announcement_Status Modal -->

<div class="modal fade" id="createOrdinance_Info" role="dialog" aria-labelledby="Create_Ordinance" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Create Resolution</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>

            </div>
            <form id="newOrdinance" method="POST" action="{{ route('create_ordinance_and_resolution') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row">
                            <input type="text" class="form-control" id="Ordinance_Resolution_ID" name="Ordinance_Resolution_ID" value="" hidden>
                            <input type="text" class="form-control" id="Ordinance_or_Resolution" name="Ordinance_or_Resolution" hidden value=1>
                            <input type="text" class="form-control btn_action" id="btn_action" name="btn_action" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Resolution No</label>
                                <input type="text" class="form-control" id="Ordinance_Resolution_No" name="Ordinance_Resolution_No" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Date_of_Approval">Date of Approval</label>
                                <input type="date" class="form-control" id="Date_of_Approval" name="Date_of_Approval" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Date_of_Effectivity">Date of Effectivity</label>
                                <input type="date" class="form-control" id="Date_of_Effectivity" name="Date_of_Effectivity" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Ordinance_Resolution_Title">Resolution Title</label>
                                <input type="text" class="form-control" id="Ordinance_Resolution_Title" name="Ordinance_Resolution_Title" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Status_of_Ordinance_or_Resolution_ID">Status</label>
                                <select class="form-control" id="Status_of_Ordinance_or_Resolution_ID" name="Status_of_Ordinance_or_Resolution_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($status as $status)
                                    <option value="{{ $status->Status_of_Ordinance_or_Resolution_ID  }}">{{ $status->Name_of_Status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Approver_ID">Approver</label>
                                <select class="form-control" id="Approver_ID" name="Approver_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($brgy_official as $bo)
                                    <option value="{{ $bo->Resident_ID  }}">{{ $bo->Last_Name }}, {{$bo->First_Name}} {{$bo->Middle_Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Attester_ID">Attester</label>
                                <select class="form-control select2" id="Attester_ID" name="Attester_ID[]" multiple="multiple" required>
                                    @foreach($brgy_official as $bo)
                                    <option value="{{ $bo->Resident_ID  }}">{{ $bo->Last_Name }}, {{$bo->First_Name}} {{$bo->Middle_Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label>Previous Related Ordinance</label>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <select class="form-control Previous_Related_Ordinance_Resolution_ID">
                                        </select>
                                    </div>
                                </div>
                                <div class="div  table-responsive">
                                    <table class=" table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th hidden>ID</th>
                                                <th style='white-space: nowrap;'>Resolution Number</th>
                                                <th style='white-space: nowrap;'>Title</th>
                                                <th style='white-space: nowrap;'>Date of Approval</th>
                                                <th style='white-space: nowrap;'>Date of Effectivity</th>
                                                <th style='white-space: nowrap;'>Status</th>
                                                <th style='white-space: nowrap;'>File Attachments</th>
                                                <th style='white-space: nowrap;'>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="PROlist">
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <br>
                            </div>
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="fileattach">File Attachments</label>
                                <ul class="list-group list-group-flush" id="ordinance_files">

                                </ul>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fileattach" name="fileattach[]" multiple>
                                    <label class="custom-file-label btn btn-info" for="fileattach">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal" id="CloseOrdinance">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="print_filter" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="print_report" method="GET" action="{{ route('ordinance.export') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row">
                            <!-- <div class="form-group col-lg-12"><input type="date" name="DateFilter"></div> -->
                            <div class="col-12">
                                <input type="checkbox" id="SelectAll" name="SelectAll">
                                <label for="SelectAll">Select All</label><br>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <input type="number" id="chk_Ordinance" name="chk_Ordinance" hidden value=1>
                                <input type="checkbox" class="ChkBOX1" id="chk_Ordinance_No" name="chk_Ordinance_No">
                                <label for="chk_Ordinance_No">Resolution No.</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Approval" name="chk_Approval">
                                <label for="chk_Approval">Date of Approval</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Effectivity" name="chk_Effectivity">
                                <label for="chk_Effectivity">Date of Effectivity</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Title" name="chk_Title">
                                <label for="chk_Title">Resolution Title</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Status" name="chk_Status">
                                <label for="chk_Status">Status</label><br>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <input type="checkbox" class="ChkBOX1" id="chk_Region" name="chk_Region">
                                <label for="chk_Region">Region</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Province" name="chk_Province">
                                <label for="chk_Province">Province</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_City" name="chk_City">
                                <label for="chk_City">City/Municipality</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Barangay" name="chk_Barangay">
                                <label for="chk_Barangay">Barangay</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                <h4 class="modal-title flexer justifier" id="Modal_Title">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="download_report" method="POST" action="{{ route('print_Ordinance') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-12"><input type="date" name="DateFilter2"></div>
                            <div class="col-12">
                                <input type="checkbox" id="SelectAll2" name="SelectAll2">
                                <label for="SelectAll2">Select All</label><br>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <input type="number" id="1chk_Ordinance" name="chk_Ordinance" hidden value=1>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Ordinance_No" name="chk_Ordinance_No">
                                <label for="1chk_Ordinance_No">Resolution No.</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Approval" name="chk_Approval">
                                <label for="1chk_Approval">Date of Approval</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Effectivity" name="chk_Effectivity">
                                <label for="1chk_Effectivity">Date of Effectivity</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Title" name="chk_Title">
                                <label for="1chk_Title">Resolution Title</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Status" name="chk_Status">
                                <label for="1chk_Status">Status</label><br>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <input type="checkbox" class="ChkBOX1" id="1chk_Region" name="chk_Region">
                                <label for="1chk_Region">Region</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Province" name="chk_Province">
                                <label for="1chk_Province">Province</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_City" name="chk_City">
                                <label for="1chk_City">City/Municipality</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Barangay" name="chk_Barangay">
                                <label for="1chk_Barangay">Barangay</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                <h4 class="modal-title flexer justifier" id="Modal_Title">Resolution Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <h4 id="VName"> </h4>
                    <div class="row">

                    </div>
                    <div class="col-12">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <tr>
                                <td style="width:300px"><strong>Resolution No.: </strong></td>
                                <td><span id="Ordinance_Resolution_No2"></span></td>
                            </tr>
                            <tr>
                                <td style="width:300px"><strong>Title: </strong></td>
                                <td><span id="Ordinance_Resolution_Title2"></span></td>
                            </tr>
                            <tr>
                                <td style="width:300px"><strong>Date Approval: </strong></td>
                                <td><span id="Date_of_Approval2"></span></td>
                            </tr>
                            <tr>
                                <td style="width:300px"><strong>Date of Effectivity: </strong></td>
                                <td><span id="Date_of_Effectivity2"></span></td>
                            </tr>
                            <tr>
                                <td style="width:300px"><strong>Status: </strong></td>
                                <td><span id="Status_of_Ordinance_or_Resolution_ID2"></span></td>
                            </tr>
                            <tr>
                                <td style="width:300px"><strong>Previous Related Resolution: </strong></td>
                                <td><span id="Previous_Related_Ordinance_Resolution_ID2"></span></td>
                            </tr>
                            <tr>
                                <td style="width:300px"><strong>Approver: </strong></td>
                                <td><span id="Approver_ID2"></span></td>
                            </tr>
                            <tr>
                                <td style="width:300px"><strong>Attester: </strong></td>
                                <td><span id="Attester_ID2"></span></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="form-group col-lg-12" style="padding:0 10px">
                        <label for="fileattach">File Attachments</label>
                        <ul class="list-group list-group-flush" id="ordinance_files2">

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Create Announcement_Status END -->

@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $('.select2').select2();

        //Select2 Lazy Loading Resolution
        $(".Previous_Related_Ordinance_Resolution_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_resolution',
                dataType: "json",
            }
        });
    });

    $(document).ready(function() {
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 3) {
            $("#newOrdinance :input").prop("disabled", true);
        }
    });

    // Populate Province
    $(document).on("change", "#Region_ID", function() {
        // alert('test');
        var Region_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_province/" + Region_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#Province_ID').empty();
                $('#City_Municipality_ID').empty();
                $('#Barangay_ID').empty();


                var option1 =
                    "<option value='' disabled selected>Select Option</option>";
                $('#Province_ID').append(option1);
                $('#City_Municipality_ID').append(option1);
                $('#Barangay_ID').append(option1);

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

    // Populate City
    $(document).on("change", "#Province_ID", function() {
        var Province_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_city/" + Province_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#City_Municipality_ID').empty();
                $('#Barangay_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#City_Municipality_ID').append(option1);
                $('#Barangay_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["City_Municipality_ID"] +
                        "'>" +
                        element["City_Municipality_Name"] +
                        "</option>";
                    $('#City_Municipality_ID').append(option);
                });
            }
        });
    });


    // Populate Barangay
    $(document).on("change", "#City_Municipality_ID", function() {
        var City_Municipality_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_barangay/" + City_Municipality_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#Barangay_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#Barangay_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["Barangay_ID"] +
                        "'>" +
                        element["Barangay_Name"] +
                        "</option>";
                    $('#Barangay_ID').append(option);
                });
            }
        });
    });

    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    $(document).on('click', '.modal-close', function(e) {
        $('#newOrdinance').trigger("reset");
        $('#Barangay_ID').empty();
        $('#City_Municipality_ID').empty();
        $('#Province_ID').empty();
        var option1 = "<option value='' disabled selected>Select Option</option>";
        $('#Barangay_ID').append(option1);
        $('#City_Municipality_ID').append(option1);
        $('#Province_ID').append(option1);
        $('#Modal_Title').text('Create Resolution');
        $('#ordinance_files').empty();
        $('#createOrdinance_Info').trigger("reset");
        $("#createOrdinance_Info :input").prop("disabled", false);
        $(".btn_action").val(0);
        $("#Previous_Related_Ordinance_Resolution_ID ").empty();
        $("#Attester_ID").val([]).change();
        $('#PROlist').empty();

    });

    // Edit Button Display Modal
    $(document).on('click', ('.edit_ordinance'), function(e) {

        var disID = $(this).val();
        var User_Type_ID = $('#User_Type_ID').val();
        var btn_action = $('#btn_action').val();
        $('#Modal_Title').text('Edit Resolution Information');
        $.ajax({
            url: "/get_ordinance_and_resolution_info",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Ordinance_Resolution_ID').val(data['theEntry'][0]['Ordinance_Resolution_ID']);
                $('#Ordinance_or_Resolution').val(data['theEntry'][0]['Ordinance_or_Resolution']);
                $('#Ordinance_Resolution_No').val(data['theEntry'][0]['Ordinance_Resolution_No']);
                $('#Date_of_Approval').val(data['theEntry'][0]['Date_of_Approval']);
                $('#Date_of_Effectivity').val(data['theEntry'][0]['Date_of_Effectivity']);
                $('#Name_Suffix_ID').val(data['theEntry'][0]['Name_Suffix_ID']);
                $('#Ordinance_Resolution_Title').val(data['theEntry'][0]['Ordinance_Resolution_Title']);
                $('#Status_of_Ordinance_or_Resolution_ID').val(data['theEntry'][0]['Status_of_Ordinance_or_Resolution_ID']);
                $('#Approver_ID').val(data['theEntry'][0]['Approver_ID']);
                $('#Region_ID').val(data['theEntry'][0]['Region_ID']);

                var barangay =
                    " <option value='" + data['theEntry'][0]['Barangay_ID'] + "' selected>" + data['theEntry'][0]['Barangay_Name'] + "</option>";
                $('#Barangay_ID').append(barangay);

                var city =
                    " <option value='" + data['theEntry'][0]['City_Municipality_ID'] + "' selected>" + data['theEntry'][0]['City_Municipality_Name'] + "</option>";
                $('#City_Municipality_ID').append(city);

                var province =
                    " <option value='" + data['theEntry'][0]['Province_ID'] + "' selected>" + data['theEntry'][0]['Province_Name'] + "</option>";
                $('#Province_ID').append(province);
            }
        });

        $.ajax({
            url: "/get_ordinance_attachments",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);

                $i = 0;
                if (User_Type_ID == 1 && btn_action != 1) {
                    data.forEach(element => {
                        $i = $i + 1;
                        var file = '<li class="list-group-item">' + $i + '. ' + element['File_Name'] + ' (' + (element['File_Size'] / 1048576).toFixed(2) + ' MB)<a href="./files/uploads/ordinance_and_resolution/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a>|<button type="button" class="btn ord_del" value="' + element['Attachment_ID'] + '" style="color: red; margin-left:2px;">Delete</button></li>';
                        $('#ordinance_files').append(file);
                    });
                } else {
                    data.forEach(element => {
                        $i = $i + 1;
                        var file = '<li class="list-group-item">' + $i + '. ' + element['File_Name'] + ' (' + (element['File_Size'] / 1048576).toFixed(2) + ' MB)<a href="./files/uploads/ordinance_and_resolution/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a></li>';
                        $('#ordinance_files').append(file);
                    });
                }

            }
        });

        $.ajax({
            url: "/get_ordinance_and_resolution_pro",
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

                    var or_id = element["Ordinance_Resolution_ID"];

                    var row = "<tr>" +
                        "<td hidden><input name='Previous_Related_Ordinance_Resolution_ID[]' value='" + element["Ordinance_Resolution_ID"] + "'></td>" +
                        "<td style='white-space: nowrap;'>" + element["Ordinance_Resolution_No"] + "</td>" +
                        "<td style='white-space: nowrap;'>" + element["Ordinance_Resolution_Title"] + "</td>" +
                        "<td style='white-space: nowrap;'>" + element["Date_of_Approval"] + "</td>" +
                        "<td style='white-space: nowrap;'>" + element["Date_of_Effectivity"] + "</td>" +
                        "<td style='white-space: nowrap;'>" + element["Status_of_Ordinance_Name"] + "</td>" +
                        "<td style='white-space: nowrap;' class='PRO" + element["Ordinance_Resolution_ID"] + "'></td>" +
                        "<td><button class='btn-danger pro_remove'>Remove</button></td>"
                    "</tr>";
                    $('#PROlist').append(row);

                    $.ajax({
                        url: "/get_ordinance_attachments",
                        type: 'GET',
                        data: {
                            id: or_id
                        },
                        fail: function() {
                            alert('request failed');
                        },
                        success: function(data) {
                            var data = JSON.parse(data);
                            $i = 0;
                            if (data.length > 1) {
                                data.forEach(element => {
                                    var file = '<span><a href="./files/uploads/ordinance_and_resolution/' + element['File_Name'] + '" target="_blank" style="color: blue;">' + element['File_Name'] + '</a>, </span>';
                                    $('.PRO' + or_id).append(file);
                                });
                            } else if (data.length = 1) {
                                data.forEach(element => {
                                    var file = '<span><a href="./files/uploads/ordinance_and_resolution/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">' + element['File_Name'] + '</a></span>';
                                    $('.PRO' + or_id).append(file);
                                });
                            }

                        }
                    });

                });
            }
        });


        $.ajax({
            url: "/get_ordinance_and_resolution_attester",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                // alert(data);

                var arr = new Array();
                // or var arr = [];

                data.forEach(element => {
                    arr.push(element['Resident_ID']);
                });

                $('#Attester_ID').val(arr).trigger('change')

                // alert(arr);

            }
        });
    });

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    // File Attachments Modal
    $(document).on('click', ('.ord_del'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_ordinance_attachments",
                    type: 'GET',
                    data: {
                        id: disID
                    },
                    fail: function() {
                        alert('request failed');
                    },
                    success: function(data) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        $('#CloseOrdinance').click();
                    }
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
            url: "/get_resolution/" + Barangay_ID,
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
                        element["Ordinance_Resolution_No"],
                        element["Ordinance_Resolution_Title"],
                        element["Date_of_Approval"],
                        element["Date_of_Effectivity"],
                        element["Name_of_Status"],
                        "<button class='edit_ordinance' value='" + element["Ordinance_Resolution_ID"] + "' data-toggle='modal' data-target='#createOrdinance_Info'>Edit</button>",
                    ]).draw();

                });
            }
        });
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.resolution').addClass('active');
        $('.boris_menu').addClass('active');
        $('.boris_main').addClass('menu-open');
    });

    // Delete Ordinance
    $(document).on('click', ('.delete_ordinance'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this resolution?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_ordinance",
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
                            text: "Resolution has been deleted.",
                            icon: 'success',
                            showConfirmButton: false,
                        });
                        location.reload();
                    }
                });

            }
        });
    });

    // View Info
    $(document).on('click', ('.view_ordinance'), function(e) {

        var disID = $(this).val();
        var User_Type_ID = $('#User_Type_ID').val();
        $.ajax({
            url: "/get_ordinance_and_resolution_info",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Ordinance_Resolution_ID2').text(data['theEntry'][0]['Ordinance_Resolution_ID']);
                $('#Ordinance_or_Resolution2').text(data['theEntry'][0]['Ordinance_or_Resolution']);
                $('#Ordinance_Resolution_No2').text(data['theEntry'][0]['Ordinance_Resolution_No']);
                $('#Date_of_Approval2').text(data['theEntry'][0]['Date_of_Approval']);
                $('#Date_of_Effectivity2').text(data['theEntry'][0]['Date_of_Effectivity']);
                $('#Ordinance_Resolution_Title2').text(data['theEntry'][0]['Ordinance_Resolution_Title']);
                $('#Status_of_Ordinance_or_Resolution_ID2').text(data['theEntry'][0]['Name_of_Status']);
                if (data['theEntry'][0]['Approver_ID'] != null && data['theEntry'][0]['Approver_ID'] != 0) {
                    $('#Approver_ID2').text(data['theEntry'][0]['Last_Name'] + ', ' + data['theEntry'][0]['First_Name'] + ' ' + data['theEntry'][0]['Middle_Name']);
                } else {
                    $('#Approver_ID2').text('');
                }
            }
        });

        $.ajax({
            url: "/get_ordinance_attachments",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#ordinance_files2').empty();

                $i = 0;

                data.forEach(element => {
                    $i = $i + 1;
                    var file = '<li class="list-group-item">' + $i + '. ' + element['File_Name'] + '<a href="./files/uploads/ordinance_and_resolution/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a></li>';
                    $('#ordinance_files2').append(file);
                });


            }
        });

        $.ajax({
            url: "/get_ordinance_and_resolution_attester",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                // alert(data);

                var arr = new Array();
                // or var arr = [];
                $('#Attester_ID2').empty();
                data.forEach(element => {
                    $('#Attester_ID2').append(element['Last_Name'] + ', ' + element['First_Name'] + ' ' + element['Middle_Name'] + '<br>');
                });
            }
        });

        $.ajax({
            url: "/get_ordinance_and_resolution_pro",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                // alert(data);

                var arr = new Array();
                // or var arr = [];
                $('#Previous_Related_Ordinance_Resolution_ID2').empty();
                data.forEach(element => {
                    $('#Previous_Related_Ordinance_Resolution_ID2').append(element['Ordinance_Resolution_Title'] + '<br>');
                });
            }
        });

    });

    $(".SearchResolutionBTN").on("click", function() {
        SearchResolution();
    });

    function SearchResolution() {
        // alert('test');
        var param = $('.SearchResolution').val();
        var date_from = $('#date_from').val();
        var date_to = $('#date_to').val();
        var page = $('#hidden_page').val();
        if (date_from == '' || date_from == null) {
            date_from = 0;
        }
        if (date_to == '' || date_to == null) {
            date_to = 0;
        }
        $.ajax({
            url: "/search_resolutions?page=" + page + "&param=" + param + "&date_from=" + date_from + "&date_to=" + date_to,
            success: function(data) {
                $('#resolution_list').html('');
                $('#resolution_list').html(data);
            }
        });
    }

    // Populate PRO
    $(document).on("change", ".Previous_Related_Ordinance_Resolution_ID", function() {
        // alert('test');

        var Ordinance_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_ordinance_info/" + Ordinance_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                data.forEach(element => {

                    var disID = element["Ordinance_Resolution_ID"];

                    var row = "<tr>" +
                        "<td hidden><input name='Previous_Related_Ordinance_Resolution_ID[]' value='" + element["Ordinance_Resolution_ID"] + "'></td>" +
                        "<td style='white-space: nowrap;'>" + element["Ordinance_Resolution_No"] + "</td>" +
                        "<td style='white-space: nowrap;'>" + element["Ordinance_Resolution_Title"] + "</td>" +
                        "<td style='white-space: nowrap;'>" + element["Date_of_Approval"] + "</td>" +
                        "<td style='white-space: nowrap;'>" + element["Date_of_Effectivity"] + "</td>" +
                        "<td style='white-space: nowrap;'>" + element["Status_of_Ordinance_Name"] + "</td>" +
                        "<td style='white-space: nowrap;' class='PRO" + element["Ordinance_Resolution_ID"] + "'></td>" +
                        "<td><button class='btn-danger pro_remove'>Remove</button></td>"
                    "</tr>";
                    $('#PROlist').append(row);

                    var disID = element["Ordinance_Resolution_ID"];

                    $.ajax({
                        url: "/get_ordinance_attachments",
                        type: 'GET',
                        data: {
                            id: disID
                        },
                        fail: function() {
                            alert('request failed');
                        },
                        success: function(data) {
                            var data = JSON.parse(data);
                            $i = 0;
                            if (data.length > 1) {
                                data.forEach(element => {
                                    var file = '<span><a href="./files/uploads/ordinance_and_resolution/' + element['File_Name'] + '" target="_blank" style="color: blue;">' + element['File_Name'] + '</a>, </span>';
                                    $('.PRO' + disID).append(file);
                                });
                            } else if (data.length = 1) {
                                data.forEach(element => {
                                    var file = '<span><a href="./files/uploads/ordinance_and_resolution/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">' + element['File_Name'] + '</a></span>';
                                    $('.PRO' + disID).append(file);
                                });
                            }

                        }
                    });

                });
            }
        });

        $('#Previous_Related_Ordinance_Resolution_ID').empty();
    });

    //Remove PRO
    $(document).on('click', '.pro_remove', function() {
        $(this).closest("tr").remove();
    });

    $(document).on('click', '#SelectAll', function(e) {
        $('.ChkBOX1').prop('checked', this.checked);
    });

    $(document).on('click', '#SelectAll2', function(e) {
        $('.ChkBOX2').prop('checked', this.checked);
    });
</script>



<style>
    .inputfile-box {
        position: relative;
    }

    .inputfile {
        display: none;
    }

    .container {
        display: inline-block;
        width: 100%;
    }

    .file-box {
        display: inline-block;
        width: 100%;
        border: 1px solid;
        padding: 5px 0px 5px 5px;
        box-sizing: border-box;
        height: calc(2rem - 2px);
    }

    .file-button {
        background: red;
        padding: 5px;
        position: absolute;
        border: 1px solid;
        top: 0px;
        right: 0px;
    }
</style>

@endsection