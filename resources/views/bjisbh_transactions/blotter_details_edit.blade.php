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
        <form id="newHousehold" method="POST" action="{{ route('create_blotter') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="number" class="form-control" id="Blotter_ID" name="Blotter_ID" hidden value="{{$blotter[0]->Blotter_ID}}">
                <div class="row">
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="exampleInputEmail1">Blotter Number</label>
                        <input type="text" class="form-control" id="Blotter_Number" name="Blotter_Number" required value="{{$blotter[0]->Blotter_Number}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="exampleInputEmail1">Blotter Status</label>
                        <br>
                        <select id="Blotter_Status_ID" class="form-control" name="Blotter_Status_ID" style="width: 100%;">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($blotter_status as $bs)
                            <option value="{{ $bs->Blotter_Status_ID }}" {{ $bs->Blotter_Status_ID  == $blotter[0]->Blotter_Status_ID  ? "selected" : "" }}>{{ $bs->Blotter_Status_Name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="exampleInputEmail1">Incident Date</label>
                        <input type="datetime-local" class="form-control" id="Incident_Date_Time" name="Incident_Date_Time" required value="{{$blotter[0]->Incident_Date_Time}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="exampleInputEmail1">Region</label>
                        <select class="form-control" id="Region_ID" name="Region_ID" required>
                            <option value='' disabled selected>Select Option</option>
                            @foreach($region as $region)
                            <option value="{{ $region->Region_ID }}" {{ $region->Region_ID  == $blotter[0]->Region_ID  ? "selected" : "" }}>{{ $region->Region_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="exampleInputEmail1">Province</label>
                        <select class="form-control" id="Province_ID" name="Province_ID" required>
                            <option value='' disabled selected>Select Option</option>
                            @foreach($province as $province)
                            <option value="{{ $province->Province_ID }}" {{ $province->Province_ID  == $blotter[0]->Province_ID  ? "selected" : "" }}>{{ $province->Province_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="City_Municipality_ID">City/Municipality</label>
                        <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID" required>
                            <option value='' disabled selected>Select Option</option>
                            @foreach($city_municipality as $city)
                            <option value="{{ $city->City_Municipality_ID }}" {{ $city->City_Municipality_ID  == $blotter[0]->City_Municipality_ID  ? "selected" : "" }}>{{ $city->City_Municipality_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="Barangay_ID">Barangay</label>
                        <select class="form-control" id="Barangay_ID" name="Barangay_ID" required>
                            <option value='' disabled selected>Select Option</option>
                            @foreach($barangay as $barangay)
                            <option value="{{ $barangay->Barangay_ID }}" {{ $barangay->Barangay_ID  == $blotter[0]->Barangay_ID  ? "selected" : "" }}>{{ $barangay->Barangay_Name }}</option>
                            @endforeach
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
                                @if($case_details->count() > 0)
                                @foreach ($case_details as $cd)
                                <tr class="CSDetails">
                                    <td hidden></td>
                                    <td>
                                        <select class="form-control js-example-basic-single mySelect2" name="Case_ID[]" style="width: 100%;">
                                            <option value='' disabled selected>Select Option</option>
                                            @foreach($case as $cs)
                                            <option value="{{ $cs->Case_ID }}" {{ $cs->Case_ID == $cd->Case_ID  ? "selected" : "" }}>{{ $cs->Case_Name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="text-align: center; width:10%">
                                        <button type="button" class="btn btn-danger CSRemove">Remove</button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
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
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="form-group col-lg-12" style="padding:0 10px;">
                        <h3>Involved Parties</h3>
                        <a onclick="addResident();" style="float: right; cursor:pointer">+ Add</a>
                        <br>
                        <div style="overflow-x:auto;" id="HouseholdDetails">

                            <table id="ResidentTBL" class="table table-striped table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th hidden>Resident_ID</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Resident Status</th>
                                        <th>Address</th>
                                        <th>Birthdate</th>
                                        <th>Phone No.</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="HSBody">
                                    @if($involved_details->count() > 0)
                                    @foreach ($involved_details as $id)
                                    <tr class="HRDetails">
                                        <td hidden></td>
                                        <td>
                                            <select class="form-control js-example-basic-single Resident_Select2 mySelect2" name="Resident_ID[]" style="width: 350px;">
                                                <option value='' disabled selected>Select Option</option>
                                                @if($id->Resident_ID == 0)
                                                <option value="{{ $id->Non_Resident_Name }}" selected>{{ $id->Non_Resident_Name }}</option>
                                                @foreach($resident as $rs)
                                                <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                                @endforeach
                                                @else
                                                @foreach($resident as $rs)
                                                <option value="{{ $rs->Resident_ID }}" {{ $rs->Resident_ID == $id->Resident_ID  ? "selected" : "" }}>{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control Type_of_Involved_Party_ID" name="Type_of_Involved_Party_ID[]" style="width: 200px;">
                                                <option value='' disabled selected>Select Option</option>
                                                @foreach($involved_party as $ip)
                                                <option value="{{ $ip->Type_of_Involved_Party_ID  }}" {{ $ip->Type_of_Involved_Party_ID == $id->Type_of_Involved_Party_ID  ? "selected" : "" }}>{{ $ip->Type_of_Involved_Party }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="width: 200px; pointer-events:none" name="Residency_Status[]">
                                                <option value='' disabled selected>Select Option</option>
                                                <option value=0 {{ 0 == $id->Residency_Status  ? "selected" : "" }}>Non-Resident</option>
                                                <option value=1 {{ 1 == $id->Residency_Status  ? "selected" : "" }}>Resident</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" style="width: 350px;" name="Non_Resident_Address[]" value="{{$id->Non_Resident_Address}}">
                                        </td>
                                        <td>
                                            <input type="date" class="form-control" style="width: 200px;" name="Non_Resident_Birthdate[]" value="{{$id->Non_Resident_Birthdate}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" style="width: 200px;" name="Phone_No[]" value="{{$id->Phone_No}}">
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-danger HRRemove">Remove</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="HRDetails">
                                        <td hidden></td>
                                        <td>
                                            <select class="form-control js-example-basic-single Resident_Select2 mySelect2" name="Resident_ID[]" style="width: 350px;">
                                                <option value='' disabled selected>Select Option</option>
                                                @foreach($resident as $rs)
                                                <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control Type_of_Involved_Party_ID" name="Type_of_Involved_Party_ID[]" style="width: 200px;">
                                                <option value='' disabled selected>Select Option</option>
                                                @foreach($involved_party as $ip)
                                                <option value="{{ $ip->Type_of_Involved_Party_ID  }}">{{ $ip->Type_of_Involved_Party }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="width: 200px; pointer-events:none" name="Residency_Status[]">
                                                <option value='' disabled selected>Select Option</option>
                                                <option value=0>Non-Resident</option>
                                                <option value=1>Resident</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" style="width: 350px;" name="Non_Resident_Address[]">
                                        </td>
                                        <td>
                                            <input type="date" class="form-control" style="width: 200px;" name="Non_Resident_Birthdate[]">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" style="width: 200px;" name="Phone_No[]">
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-danger HRRemove">Remove</button>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="form-group col-lg-12" style="padding:0 10px">
                        <label for="exampleInputEmail1">Complaint Details</label>
                        <textarea class="form-control" id="Complaint_Details" name="Complaint_Details" rows="5">{{$blotter[0]->Complaint_Details}}</textarea>
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

        $(newrow.find("td:eq(4) input")).val('');
        $(newrow.find("td:eq(5) input")).val('');

        $("select.js-example-basic-single").select2();

        $(".Resident_Select2").select2({
            tags: true
        });
    }

    // Option Case Remove
    $(".HSBody").on("click", ".HRRemove", function() {
        $(this).closest(".HRDetails").remove();
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

    // Resident Change
    $('#HouseholdDetails').on("change", ".Resident_Select2", function() {
        var Resident_Select2 = $(this).val();
        var Type = $.isNumeric(Resident_Select2);
        var disID = Resident_Select2;

        // alert(Type);
        $row = $(this).closest(".HRDetails");
        $($row.find('td:eq(5) input')).val('');
        $($row.find('td:eq(4) input')).val('');
        $($row.find('td:eq(6) input')).val('');
        $($row.find('td:eq(3) select')).val('');
        if (Type == true) {
            $($row.find('td:eq(3) select')).val(1);

            $.ajax({
                url: "/get_inhabitants_info",
                type: 'GET',
                data: {
                    id: disID
                },
                fail: function() {
                    alert('request failed');
                },
                success: function(data) {
                    $($row.find('td:eq(5) input')).val(data['theEntry'][0]['Birthdate']);
                    $($row.find('td:eq(4) input')).val(data['theEntry'][0]['Barangay_Name'] + ', ' + data['theEntry'][0]['City_Municipality_Name'] + ', ' + data['theEntry'][0]['Province_Name'] + ', ' + data['theEntry'][0]['Region_Name']);
                    $($row.find('td:eq(6) input')).val(data['theEntry'][0]['Mobile_No']);
                }
            });
        } else {
            $($row.find('td:eq(3) select')).val(0);
        }
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