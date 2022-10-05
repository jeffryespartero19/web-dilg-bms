@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Emergency Evacuation Site </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BDRIS / </li>
            </a> 
            <li> &nbsp;Emergency Evacuation Site</li>
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
        <form id="newBrgy_Document_Information" method="POST" action="{{ route('create_emergency_evacuation_site') }}"  autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" class="form-control" id="Emergency_Evacuation_Site_ID" name="Emergency_Evacuation_Site_ID" hidden>
                <div class="row">
                    <div class="form-group col-lg-8" style="padding:0 10px">
                        <label for="Emergency_Evacuation_Site_Name">Emergency Evacuation Site Name</label>
                        <input type="text" class="form-control" id="Emergency_Evacuation_Site_Name" name="Emergency_Evacuation_Site_Name">
                    </div>
                    <div class="form-group col-lg-2" style="padding:0 10px">
                        <label for="Capacity">Capacity</label>
                        <input type="number" class="form-control" id="Capacity" name="Capacity">
                    </div>
                    <div class="form-group col-lg-2" style="padding:0 10px">
                        <span><b>Active:</b></span><br>
                        <select class="modal_input1" name="Active" id="Active">
                        <option hidden selected>Is Active?</option>
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12" style="padding:0 10px">
                        <label for="Address">Address</label>
                        <input type="text" class="form-control" id="Address" name="Address">
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