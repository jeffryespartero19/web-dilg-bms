@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Emergency Team </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BDRIS / </li>
            </a> 
            <li> &nbsp;Emergency Team</li>
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
        <form id="newBrgy_Document_Information" method="POST" action="{{ route('create_emergency_team') }}"  autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" class="form-control" id="Emergency_Team_ID" name="Emergency_Team_ID" value="{{$emergency_team[0]->Emergency_Team_ID}}" hidden>
                <div class="row">
                    <div class="form-group col-lg-7" style="padding:0 10px">
                        <label for="Emergency_Team_Name">Emergency Team Name</label>
                        <input type="text" class="form-control" id="Emergency_Team_Name" name="Emergency_Team_Name" value="{{$emergency_team[0]->Emergency_Team_Name}}">
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Emergency_Team_Hotline">Emergency Team Hotline</label>
                        <input type="text" class="form-control" id="Emergency_Team_Hotline" name="Emergency_Team_Hotline" value="{{$emergency_team[0]->Emergency_Team_Hotline}}">
                    </div>
                    <div class="form-group col-lg-2" style="padding:0 10px">
                        <span><b>Active:</b></span><br>
                        <select class="modal_input1" name="Active" id="Active">
                            <option hidden selected>Is Active?</option>
                            <option value=0 {{ 0 == $emergency_team[0]->Active  ? "selected" : "" }}>No</option>
                            <option value=1 {{ 1 == $emergency_team[0]->Active  ? "selected" : "" }}>Yes</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Region_ID">Region</label>
                        <select class="form-control" id="Region_ID" name="Region_ID">
                            <option value='' disabled selected>Select Option</option>
                                @foreach($region as $bt1)
                                <option value="{{ $bt1->Region_ID }}" {{ $bt1->Region_ID  == $emergency_team[0]->Region_ID  ? "selected" : "" }}>{{ $bt1->Region_Name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Province_ID">Province</label>
                        <select class="form-control" id="Province_ID" name="Province_ID">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($province as $bt1)
                            <option value="{{ $bt1->Province_ID }}" {{ $bt1->Province_ID  == $emergency_team[0]->Province_ID  ? "selected" : "" }}>{{ $bt1->Province_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="City_Municipality_ID">City_Municipality</label>
                        <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($city_municipality as $bt1)
                            <option value="{{ $bt1->City_Municipality_ID }}" {{ $bt1->City_Municipality_ID  == $emergency_team[0]->City_Municipality_ID  ? "selected" : "" }}>{{ $bt1->City_Municipality_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Barangay_ID">Barangay</label>
                        <select class="form-control" id="Barangay_ID" name="Barangay_ID">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($barangay as $bt1)
                            <option value="{{ $bt1->Barangay_ID }}" {{ $bt1->Barangay_ID  == $emergency_team[0]->Barangay_ID  ? "selected" : "" }}>{{ $bt1->Barangay_Name }}</option>
                            @endforeach
                        </select>
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


<!-- Create Announcement_Status END -->







@endsection

@section('scripts')

<script>
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
  
</script>

<style>
    table {
        display: block;
        overflow-x: scroll;
    }
</style>

@endsection