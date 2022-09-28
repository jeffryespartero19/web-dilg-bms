@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Response Information</div> 
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BDRIS / </li>
            </a> 
            <li> &nbsp;Response Information</li>
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
        <form id="newResponse_Information" method="POST" action="{{ route('create_response_information') }}"  autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" class="form-control" id="Disaster_Response_ID" name="Disaster_Response_ID" hidden>
                <div class="row">
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="Disaster_Name">Disaster Name</label>
                        <input type="text" class="form-control" id="Disaster_Name" name="Disaster_Name">
                    </div>
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="Disaster_Type_ID">Disaster Type</label>
                        <select class="form-control" id="Disaster_Type_ID" name="Disaster_Type_ID">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($disaster_type as $bt1)
                            <option value="{{ $bt1->Disaster_Type_ID }}">{{ $bt1->Disaster_Type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="Alert_Level_ID">Alert Level</label>
                        <select class="form-control" id="Alert_Level_ID" name="Alert_Level_ID">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($alert_level as $bt1)
                            <option value="{{ $bt1->Alert_Level_ID }}">{{ $bt1->Alert_Level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Disaster_Date_Start">Disaster Date Start</label>
                        <input type="datetime-local" class="form-control" id="Disaster_Date_Start" name="Disaster_Date_Start" required>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Disaster_Date_End">Disaster Date End</label>
                        <input type="datetime-local" class="form-control" id="Disaster_Date_End" name="Disaster_Date_End" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-9" style="padding:0 10px">
                        <label for="Damaged_Location">Damaged Location</label>
                        <input type="text" class="form-control" id="Damaged_Location" name="Damaged_Location">
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="GPS_Coordinates">GPS Coordinates</label>
                        <input type="text" class="form-control" id="GPS_Coordinates" name="GPS_Coordinates">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12" style="padding:0 10px">
                        <label for="Risk_Assesment">Risk Assesment</label>
                        <input type="text" class="form-control" id="Risk_Assesment" name="Risk_Assesment">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12" style="padding:0 10px">
                        <label for="Action_Taken">Action Taken</label>
                        <input type="text" class="form-control" id="Action_Taken" name="Action_Taken">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Region_ID">Region</label>
                        <select class="form-control" id="Region_ID" name="Region_ID">
                            <option value='' disabled selected>Select Option</option>
                                @foreach($region as $bt1)
                                <option value="{{ $bt1->Region_ID }}">{{ $bt1->Region_Name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Province_ID">Province</label>
                        <select class="form-control" id="Province_ID" name="Province_ID">
                            <option value='' disabled selected>Select Option</option>
                                    
                        </select>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="City_Municipality_ID">City_Municipality</label>
                        <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID">
                            <option value='' disabled selected>Select Option</option>
                                  
                        </select>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Barangay_ID">Barangay</label>
                        <select class="form-control" id="Barangay_ID" name="Barangay_ID">
                            <option value='' disabled selected>Select Option</option>
                                   
                        </select>
                    </div>
                    <div class="form-group col-lg-12" style="padding:0 10px">
                        <div class="input-group my-3">
                            <div class="custom-file">
                                <input type="file" name="fileattach[]" id="fileattach" multiple onchange="javascript:updateList()" />
                                <br />Selected files:
                                <div id="fileList"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12" style="padding:0 10px;">
                        <h3>Evacuee Information</h3>
                        <a onclick="addResident();" style="float: right; cursor:pointer">+ Add</a>
                        <br>
                        <div style="overflow-x:auto;" id="CasualtiesDetails">

                            <table id="ResidentTBL" class="table table-striped table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th hidden>Resident_ID</th>
                                        <th>Name</th>
                                        <th>Resident Status</th>
                                        <th>Address</th>
                                        <th>Birthdate</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="HSBody">
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
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-danger HRRemove">Remove</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-12" style="margin-bottom: 100px;">
                <center>
                    <!-- <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-primary" style="width: 200px;">Save</button>
                </center>
            </div>
        </form>    
    </div>
</div>



@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();

        $('.js-example-basic-single').select2();

        $(".Resident_Select2").select2({
            tags: true
        });
    });

    // Show File Name
    updateList = function() {
        var input = document.getElementById('file');
        var output = document.getElementById('fileList');

        output.innerHTML = '<ul>';
        for (var i = 0; i < input.files.length; ++i) {
            output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
        }
        output.innerHTML += '</ul>';
    }
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


    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    function addResident() {
        var row = $("#ResidentTBL tr:last");

        row.find(".js-example-basic-single").each(function(index) {
            $(this).select2('destroy');
        });

        var newrow = row.clone();

        $("#ResidentTBL").append(newrow);

        $(newrow.find("td:eq(4) input")).val('');
        $(newrow.find("td:eq(3) input")).val('');

        $("select.js-example-basic-single").select2();

        $(".Resident_Select2").select2({
            tags: true
        });
    }
   

    // Resident Casualties Change 
    $('#CasualtiesDetails').on("change", ".Resident_Select2", function() {
        var Resident_Select2 = $(this).val();
        var Type = $.isNumeric(Resident_Select2);
        var disID = Resident_Select2;

        // alert(Type);
        $row = $(this).closest(".HRDetails");
        $($row.find('td:eq(4) input')).val('');
        $($row.find('td:eq(3) input')).val('');
        $($row.find('td:eq(2) select')).val('');
        if (Type == true) {
            $($row.find('td:eq(2) select')).val(1);

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
                    $($row.find('td:eq(4) input')).val(data['theEntry'][0]['Birthdate']);
                    $($row.find('td:eq(3) input')).val(data['theEntry'][0]['Barangay_Name'] + ', ' + data['theEntry'][0]['City_Municipality_Name'] + ', ' + data['theEntry'][0]['Province_Name'] + ', ' + data['theEntry'][0]['Region_Name']);
                }
            });
        } else {
            $($row.find('td:eq(2) select')).val(0);
        }
    });

    // Option Resident Remove
    $(".HSBody").on("click", ".HRRemove", function() {
        $(this).closest(".HRDetails").remove();
    });

   
</script>

<style>
   table {
        display: block;
        overflow-x: scroll;
    }

    .select2-selection {
        height: 32px !important;
        padding: 3px 3px;
        font: 13px;
    }
</style>

@endsection