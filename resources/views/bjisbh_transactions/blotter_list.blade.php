@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Blotter List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;Blotter List</li>
        </ol>
    </div>
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
<div class="tableX_row col-md-12 up_marg5">
    <br>
    <div class="flexer">
        <div class="eighty_split">{{$db_entries->appends(['db_entries' => $db_entries->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><a href="{{ url('blotter_details/0') }}"  class="btn btn-success" style="width: 100px;">New</a></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Blotter_ID</th>
                    <th>Blotter Number</th>
                    <th>Blotter Status</th>
                    <th>Incident Date/Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Blotter_ID}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Blotter_Number}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Blotter_Status_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Incident_Date_Time}}</td>
                    <td class="sm_data_col txtCtr">
                        <button class="edit_blotter" value="{{$x->Blotter_ID}}" data-toggle="modal" data-target="#createBlotter">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Announcement_Status Modal -->

<div class="modal fade" id="createBlotter" role="dialog" aria-labelledby="Create_Blotter" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier" id="Modal_Title">Create Blotter</h4>
            </div>
            <div class="modal-body">
                <form id="newBlotter" method="POST" action="{{ route('create_blotter') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <!-- <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="exampleInputEmail1">Suspect Name</label>
                                <br>
                                <select id="Resident_ID" class="form-control js-example-basic-single mySelect2" name="state" style="width: 100%;">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($resident as $rs)
                                    <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> -->
                        <input type="number" class="form-control" id="Blotter_ID" name="Blotter_ID" value="0" hidden>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Blotter Number</label>
                                <input type="text" class="form-control" id="Blotter_Number" name="Blotter_Number" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Blotter Status</label>
                                <br>
                                <select id="Blotter_Status_ID" class="form-control" name="Blotter_Status_ID" style="width: 100%;">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($blotter_status as $bs)
                                    <option value="{{ $bs->Blotter_Status_ID }}">{{ $bs->Blotter_Status_Name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Incident Date</label>
                                <input type="datetime-local" class="form-control" id="Incident_Date_Time" name="Incident_Date_Time" required>
                            </div>
                        </div>
                        <div class="row">
                            <div id="CasesList" class="form-group col-lg-6 CasesList" style="padding:0 10px">
                                <label for="exampleInputEmail1">Case</label>
                                <a id="AddCase" style="float: right; cursor:pointer">+ Add</a>
                                <br>
                                <div class="row CaseOption">
                                    <div class="col-sm-9">
                                        <select class="form-control" name="Case_ID[]">
                                            <option value='' disabled selected>Select Option</option>
                                            @foreach($case as $cs)
                                            <option value="{{ $cs->Case_ID }}">{{ $cs->Case_Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-danger caseRemove">Remove</button>
                                    </div>
                                </div>
                                <div class="row CaseOptionHide" hidden>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="Case_ID[]">
                                            <option value='' disabled selected>Select Option</option>
                                            @foreach($case as $cs)
                                            <option value="{{ $cs->Case_ID }}">{{ $cs->Case_Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-danger caseRemove">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Complaint Details</label>
                                <textarea class="form-control" id="Complaint_Details" name="Complaint_Details" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Region</label>
                                <select class="form-control" id="Region_ID" name="Region_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($region as $region)
                                    <option value="{{ $region->Region_ID }}">{{ $region->Region_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Province</label>
                                <select class="form-control" id="Province_ID" name="Province_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="City_Municipality_ID">City/Municipality</label>
                                <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Barangay_ID">Barangay</label>
                                <select class="form-control" id="Barangay_ID" name="Barangay_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>

                        </div>
                        <hr>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary postThis_Blotter_Info" style="width: 200px;">Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- Create Announcement_Status END -->

@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

    $('.mySelect2').select2({
        dropdownParent: $('#createBlotter')
    });

    // Clone Case
    $("#AddCase").on("click", function() {
        $option = $('.CaseOptionHide').last();
        $optionNew = $option.clone();
        $option.attr('hidden', false);
        $option.after($optionNew);
    });

    // Option Case Remove
    $(".CasesList").on("click", ".caseRemove", function() {
        $(this).closest(".CaseOption").remove();
    });

    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
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


    // Edit Button Display Modal
    $(document).on('click', ('.edit_blotter'), function(e) {

        var disID = $(this).val();
        $('#Modal_Title').text('Edit Blotter Information');
        $.ajax({
            url: "/get_blotter",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Blotter_ID').val(data['theEntry'][0]['Blotter_ID']);
                $('#Blotter_Number').val(data['theEntry'][0]['Blotter_Number']);
                $('#Blotter_Status_ID').val(data['theEntry'][0]['Blotter_Status_ID']);
                $('#Incident_Date_Time').val(data['theEntry'][0]['Incident_Date_Time']);
                $('#Address').val(data['theEntry'][0]['Address']);
                $('#Complaint_Details').val(data['theEntry'][0]['Complaint_Details']);
                var barangay =
                    " <option value='" + data['theEntry'][0]['Barangay_ID'] + "' selected>" + data['theEntry'][0]['Barangay_Name'] + "</option>";
                $('#Barangay_ID').append(barangay);

                var city =
                    " <option value='" + data['theEntry'][0]['City_Municipality_ID'] + "' selected>" + data['theEntry'][0]['City_Municipality_Name'] + "</option>";
                $('#City_Municipality_ID').append(city);

                var province =
                    " <option value='" + data['theEntry'][0]['Province_ID'] + "' selected>" + data['theEntry'][0]['Province_Name'] + "</option>";
                $('#Province_ID').append(province);
                $('#Region_ID').val(data['theEntry'][0]['Region_ID']);
            }
        });


        $.ajax({
            url: "/get_case_details",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('.CaseOption').remove();
                data.forEach(element => {
                    var option_case = '<div class="row CaseOption CaseOption' + element['Case_ID'] + '">' +
                        '<div class="col-sm-9">' +
                        '<select id="" class="form-control" name="Case_ID[]">' +
                        '@foreach($case as $cs)' +
                        '<option value="{{$cs->Case_ID}}">{{ $cs->Case_Name }}</option>' +
                        '@endforeach' +
                        '</select>' +
                        '</div>' +
                        '<div class="col-sm-3">' +
                        '<button type="button" class="btn btn-danger caseRemove">Remove</button>' +
                        '</div>' +
                        '</div>';
                    $('#CasesList').append(option_case);
                    $('.CaseOption' + element['Case_ID']).find('select').val(element['Case_ID']);
                });
            }
        });


    });
</script>

<style>
    table {
        display: inline-block;
        overflow-x: scroll;
    }

    .select2-selection {
        height: 34px !important;
        padding: 3px 8px;
        font: 14px;
    }
</style>

@endsection