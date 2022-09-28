@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Barangay Business Information</div> 
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BCPCIS / </li>
            </a> 
            <li> &nbsp;Barangay Business Information</li>
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
        <form id="newBarangay_Business" method="POST" action="{{ route('create_barangay_business') }}"  autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" class="form-control" id="Business_ID" name="Business_ID" value="{{$business[0]->Business_ID}}" hidden>
                <div class="row">
                    <div class="form-group col-lg-5" style="padding:0 10px">
                        <label for="Business_Name">Business Name</label>
                        <input type="text" class="form-control" id="Business_Name" name="Business_Name" value="{{$business[0]->Business_Name}}">
                    </div>
                    <div class="form-group col-lg-4" style="padding:0 10px">
                        <label for="Business_Type_ID">Business Type</label>
                        <select class="form-control" id="Business_Type_ID" name="Business_Type_ID">
                            <option value='' disabled selected>Select Option</option>
                                @foreach($business_type as $bt1)
                                <option value="{{ $bt1->Business_Type_ID }}" {{ $bt1->Business_Type_ID  == $business[0]->Business_Type_ID  ? "selected" : "" }}>{{ $bt1->Business_Type }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Business_Tin">Business Tin</label>
                        <input type="text" class="form-control" id="Business_Tin" name="Business_Tin" value="{{$business[0]->Business_Tin}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4" style="padding:0 10px">
                        <label for="Business_Owner">Business Owner</label>
                        <input type="text" class="form-control" id="Business_Owner" name="Business_Owner" value="{{$business[0]->Business_Owner}}">
                    </div>
                    <div class="form-group col-lg-8" style="padding:0 10px">
                        <label for="Business_Address">Business Address</label>
                        <input type="text" class="form-control" id="Business_Address" name="Business_Address" value="{{$business[0]->Business_Address}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4" style="padding:0 10px">
                        <label for="Mobile_No">Mobile No</label>
                        <input type="text" class="form-control" id="Mobile_No" name="Mobile_No" value="{{$business[0]->Mobile_No}}">
                    </div>
                    <div class="form-group col-lg-4" style="padding:0 10px">
                        <label for="Region_ID">Region</label>
                            <select class="form-control" id="Region_ID" name="Region_ID">
                                <option value=''  selected>Select Option</option>
                                @foreach($region as $bt1)
                                <option value="{{ $bt1->Region_ID }}" {{ $bt1->Region_ID  == $business[0]->Region_ID  ? "selected" : "" }}>{{ $bt1->Region_Name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group col-lg-4" style="padding:0 10px">
                        <label for="Province_ID">Province</label>
                            <select class="form-control" id="Province_ID" name="Province_ID">
                                <option value=''  selected>Select Option</option>
                                @foreach($province as $bt1)
                                <option value="{{ $bt1->Province_ID }}" {{ $bt1->Province_ID  == $business[0]->Province_ID  ? "selected" : "" }}>{{ $bt1->Province_Name }}</option>
                                @endforeach
                            </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4" style="padding:0 10px">
                        <label for="City_Municipality_ID">City_Municipality</label>
                            <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID">
                                <option value='' disabled selected>Select Option</option>
                                @foreach($city_municipality as $bt1)
                                <option value="{{ $bt1->City_Municipality_ID }}" {{ $bt1->City_Municipality_ID  == $business[0]->City_Municipality_ID  ? "selected" : "" }}>{{ $bt1->City_Municipality_Name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group col-lg-4" style="padding:0 10px">
                        <label for="Barangay_ID">Barangay</label>
                            <select class="form-control" id="Barangay_ID" name="Barangay_ID">
                                <option value='' disabled selected>Select Option</option>
                                @foreach($barangay as $bt1)
                                <option value="{{ $bt1->Barangay_ID }}" {{ $bt1->Barangay_ID  == $business[0]->Barangay_ID  ? "selected" : "" }}>{{ $bt1->Barangay_Name }}</option>
                                @endforeach                            
                            </select>
                    </div>
                    <div class="form-group col-lg-2" style="padding:0 10px">
                        <label for="Active">Active</label>
                        <select class="form-control" style="width: 200px;" name="Active" id="Active">
                            <option value=''  selected>Select Option</option>
                            <option value=0 {{ 0 == $business[0]->Active  ? "selected" : "" }}>No</option>
                            <option value=1 {{ 1 == $business[0]->Active  ? "selected" : "" }}>Yes</option>
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