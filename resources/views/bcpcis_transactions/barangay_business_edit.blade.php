@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Barangay Business Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"> 
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('barangay_business_list')}}">Brgy Business Information List</a></li>
                        <li class="breadcrumb-item active">Barangay Business Information</li>
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
                        <div class="tableX_row col-md-12 up_marg5">
                            <br>
                            <div class="col-md-12">
                                <form id="newBarangay_Business" method="POST" action="{{ route('create_barangay_business') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
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