@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Brgy Business Permit Information</div> 
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BCPCIS / </li>
            </a> 
            <li> &nbsp;Brgy Business Permit Information</li>
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
        <form id="newBrgy_Document_Information" method="POST" action="{{ route('create_barangay_business_permit') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" class="form-control" id="Barangay_Permits_ID" name="Barangay_Permits_ID" hidden>
                <div class="row">
                    <div class="form-group col-lg-4" style="padding:0 10px">
                        <label for="Business_ID">Business</label>
                        <select class="form-control" id="Business_ID" name="Business_ID">
                            <option value='' disabled selected>Select Option</option>
                                @foreach($business as $bt1)
                                <option value="{{ $bt1->Business_ID }}">{{ $bt1->Business_Name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-4" style="padding:0 10px">
                        <label for="Transaction_No">Transaction No</label>
                        <input type="text" class="form-control" id="Transaction_No" name="Transaction_No">
                    </div>
                    <div class="form-group col-lg-4" style="padding:0 10px">
                        <label for="Resident_ID">Resident</label>
                        <select class="form-control js-example-basic-single Resident_Select2 mySelect2" name="Resident_ID" style="width: 350px;">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($resident as $rs)
                            <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-2" style="padding:0 10px">
                        <label for="New_or_Renewal">New or Renewal</label>
                        <select class="form-control" style="width: 200px;" name="New_or_Renewal" id="New_or_Renewal">
                            <option value='' selected>Select Option</option>
                            <option value=1>New</option>
                            <option value=0>Renewal</option>
                        </select>
                    </div>  
                    <div class="form-group col-lg-2" style="padding:0 10px">
                        <label for="Owned_or_Rented">Owned or Rented</label>
                        <select class="form-control" style="width: 200px;" name="Owned_or_Rented" id="Owned_or_Rented">
                            <option value='' selected>Select Option</option>
                            <option value=1>Owned</option>
                            <option value=0>Rented</option>
                        </select>
                    </div>  
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Barangay_Business_Permit_Expiration_Date">Expiration Date</label>
                        <input type="date" class="form-control" id="Barangay_Business_Permit_Expiration_Date" name="Barangay_Business_Permit_Expiration_Date" required>
                    </div>
                    <div class="form-group col-lg-5" style="padding:0 10px">
                        <label for="CTC_No">CTC No</label>
                        <input type="text" class="form-control" id="CTC_No" name="CTC_No">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Region_ID">Region</label>
                            <select class="form-control" id="Region_ID" name="Region_ID">
                                <option value=''  selected>Select Option</option>
                                @foreach($region as $bt1)
                                <option value="{{ $bt1->Region_ID }}">{{ $bt1->Region_Name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Province_ID">Province</label>
                            <select class="form-control" id="Province_ID" name="Province_ID">
                                <option value=''  selected>Select Option</option>
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

    .select2-selection {
        height: 32px !important;
        padding: 3px 3px;
        font: 13px;
    }
</style>

@endsection