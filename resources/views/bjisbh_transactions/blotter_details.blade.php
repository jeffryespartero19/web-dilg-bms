@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Blotter Details </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;Blotter Details</li>
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
    <div class="col-md-12">
        <form id="newHousehold" method="POST" action="{{ route('create_household_information') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
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
                <div class="row">
                    <div class="form-group col-lg-12" style="padding:0 10px" id="CaseDetails">
                        <h3>Case Details</h3>
                        <a onclick="addrow();" style="float: right; cursor:pointer">+ Add</a>
                        <table id="CaseTBL" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th hidden>Resident_ID</th>
                                    <th>Case List</th>
                                </tr>
                            </thead>
                            <tbody class="CSBody">
                                <tr class="CSDetails">
                                    <td hidden></td>
                                    <td>
                                        <select class="form-control js-example-basic-single mySelect2" name="Case_ID[]" style="width: 100%;">
                                            <option value='' disabled selected>Select Option</option>
                                            @foreach($case as $cs)
                                            <option value="{{ $cs->Case_ID }}">{{ $cs->Case_Name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="text-align: center; width:10%">
                                        <button type="button" class="btn btn-danger CSRemove">Remove</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="form-group col-lg-12" style="padding:0 10px" id="HouseholdDetails">
                        <h3>Involved Parties</h3>
                        <a onclick="addResident();" style="float: right; cursor:pointer">+ Add</a>
                        <table id="ResidentTBL" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th hidden>Resident_ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Head</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="HSBody">
                                <tr class="HRDetails">
                                    <td hidden></td>
                                    <td>
                                        <select class="form-control js-example-basic-single Resident_Select2 mySelect2" name="Resident_ID[]" style="width: 100%;">
                                            <option value='' disabled selected>Select Option</option>
                                            @foreach($resident as $rs)
                                            <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control Type_of_Involved_Party_ID" name="Type_of_Involved_Party_ID[]">
                                            <option value='' disabled selected>Select Option</option>
                                            @foreach($involved_party as $rs)
                                            <option value="{{ $rs->Type_of_Involved_Party_ID  }}">{{ $rs->Type_of_Involved_Party }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="Family_Head[]">
                                            <option value=0>No</option>
                                            <option value=1>Yes</option>
                                        </select>
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-danger HRRemove">Remove</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group col-lg-12" style="padding:0 10px">
                        <label for="exampleInputEmail1">Complaint Details</label>
                        <textarea class="form-control" id="Complaint_Details" name="Complaint_Details" rows="5"></textarea>
                    </div>
                </div>

            </div>

            <div class="col-lg-12" style="margin-bottom: 100px;">
                <center>
                    <!-- <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-primary" style="width: 200px;">Create</button>
                </center>
            </div>

        </form>

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

    //Select2
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $(".Resident_Select2").select2({
            tags: true
        });
    });

    function addrow() {
        var row = $("#CaseTBL tr:last");

        row.find(".js-example-basic-single").each(function(index) {
            $(this).select2('destroy');
        });

        var newrow = row.clone();

        $("#CaseTBL").append(newrow);

        $("select.js-example-basic-single").select2();


    }

    // Option Case Remove
    $(".CSBody").on("click", ".CSRemove", function() {
        $(this).closest(".CSDetails").remove();
    });

    function addResident() {
        var row = $("#ResidentTBL tr:last");

        row.find(".js-example-basic-single").each(function(index) {
            $(this).select2('destroy');
        });

        var newrow = row.clone();

        $("#ResidentTBL").append(newrow);

        $("select.js-example-basic-single").select2();

        $(".Resident_Select2").select2({
            tags: true
        });
    }

    // Option Case Remove
    $(".HSBody").on("click", ".HRRemove", function() {
        $(this).closest(".HRDetails").remove();
    });
</script>

<style>
    .select2-selection {
        height: 32px !important;
        padding: 3px 3px;
        font: 13px;
    }
</style>

@endsection