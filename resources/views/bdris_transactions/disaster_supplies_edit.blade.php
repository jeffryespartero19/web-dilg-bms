@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Disaster Supplies</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BDRIS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('other_transaction_list')}}">Other Transaction List(BDRIS)</a></li>
                        <li class="breadcrumb-item active">Disaster Supplies</li>
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
                                <form id="newBrgy_Document_Information" method="POST" action="{{ route('create_disaster_supplies') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="text" class="form-control" id="Disaster_Supplies_ID" name="Disaster_Supplies_ID" value="{{$disaster_supplies[0]->Disaster_Supplies_ID}}" hidden>
                                        <div class="row">
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Disaster_Response_ID">Disaster Response</label>
                                                <select class="form-control" id="Disaster_Response_ID" name="Disaster_Response_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($disaster_response as $bt1)
                                                    <option value="{{ $bt1->Disaster_Response_ID }}" {{ $bt1->Disaster_Response_ID  == $disaster_supplies[0]->Disaster_Response_ID  ? "selected" : "" }}>{{ $bt1->Disaster_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Disaster_Supplies_Name">Disaster Supplies Name</label>
                                                <input type="text" class="form-control" id="Disaster_Supplies_Name" name="Disaster_Supplies_Name" value="{{$disaster_supplies[0]->Disaster_Supplies_Name}}">
                                            </div>

                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Disaster_Supplies_Quantity">Disaster Supplies Quantity</label>
                                                <input type="number" class="form-control" id="Disaster_Supplies_Quantity" name="Disaster_Supplies_Quantity" value="{{$disaster_supplies[0]->Disaster_Supplies_Quantity}}">
                                            </div>
                                            <div class="form-group col-lg-9" style="padding:0 10px">
                                                <label for="Location">Location</label>
                                                <input type="text" class="form-control" id="Location" name="Location" value="{{$disaster_supplies[0]->Location}}">
                                            </div>

                                            <div class="form-group col-lg-12" style="padding:0 10px">
                                                <label for="Remarks">Remarks</label>
                                                <input type="text" class="form-control" id="Remarks" name="Remarks" value="{{$disaster_supplies[0]->Remarks}}">
                                            </div>
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Brgy_Officials_and_Staff_ID">Brgy Official Name</label>
                                                <select class="form-control" id="Brgy_Officials_and_Staff_ID" name="Brgy_Officials_and_Staff_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($brgy_officials_and_staff as $bt1)
                                                    <option value="{{ $bt1->Resident_ID }}" {{ $bt1->Resident_ID  == $disaster_supplies[0]->Resident_ID  ? "selected" : "" }}>{{ $bt1->Last_Name }} {{ $bt1->First_Name }}, {{ $bt1->Middle_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Region_ID">Region</label>
                                                <select class="form-control" id="Region_ID" name="Region_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($region as $bt1)
                                                    <option value="{{ $bt1->Region_ID }}" {{ $bt1->Region_ID  == $disaster_supplies[0]->Region_ID  ? "selected" : "" }}>{{ $bt1->Region_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Province_ID">Province</label>
                                                <select class="form-control" id="Province_ID" name="Province_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($province as $bt1)
                                                    <option value="{{ $bt1->Province_ID }}" {{ $bt1->Province_ID  == $disaster_supplies[0]->Province_ID  ? "selected" : "" }}>{{ $bt1->Province_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="City_Municipality_ID">City Municipality</label>
                                                <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($city_municipality as $bt1)
                                                    <option value="{{ $bt1->City_Municipality_ID }}" {{ $bt1->City_Municipality_ID  == $disaster_supplies[0]->City_Municipality_ID  ? "selected" : "" }}>{{ $bt1->City_Municipality_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Barangay_ID">Barangay</label>
                                                <select class="form-control" id="Barangay_ID" name="Barangay_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($barangay as $bt1)
                                                    <option value="{{ $bt1->Barangay_ID }}" {{ $bt1->Barangay_ID  == $disaster_supplies[0]->Barangay_ID  ? "selected" : "" }}>{{ $bt1->Barangay_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Barangay_ID">Active:</label>
                                                <select class="modal_input1 form-control" name="Active" id="Active">
                                                    <option hidden selected>Is Active?</option>
                                                    <option value=0 {{ 0 == $disaster_supplies[0]->Active  ? "selected" : "" }}>No</option>
                                                    <option value=1 {{ 1 == $disaster_supplies[0]->Active  ? "selected" : "" }}>Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
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