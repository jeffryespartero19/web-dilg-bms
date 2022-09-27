@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Brgy Payment Collected (Business Permit)</div> 
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BCPCIS / </li>
            </a> 
            <li> &nbsp;Brgy Payment Collected (Business Permit)</li>
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
        <form id="newBrgy_Document_Information" method="POST"  action="{{ route('create_barangay_payment_collected_business') }}"  autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" class="form-control" id="Payment_Collected_ID" name="Payment_Collected_ID" value="{{$payment_business[0]->Payment_Collected_ID}}" hidden>
                <div class="row">
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Barangay_Permits_ID">Barangay Permits</label>
                        <select class="form-control" id="Barangay_Permits_ID" name="Barangay_Permits_ID">
                            <option value='' disabled selected>Select Option</option>
                                @foreach($business_permit as $bt1)
                                <option value="{{ $bt1->Barangay_Permits_ID }}" {{ $bt1->Barangay_Permits_ID  == $payment_business[0]->Barangay_Permits_ID  ? "selected" : "" }}>{{ $bt1->Transaction_No }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="OR_Date">OR Date</label>
                        <input type="date" class="form-control" id="OR_Date" name="OR_Date" value="{{$payment_business[0]->OR_Date}}" required>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="OR_No">OR No</label>
                        <input type="text" class="form-control" id="OR_No" name="OR_No" value="{{$payment_business[0]->OR_No}}">
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Cash_Tendered">Cash Tendered</label>
                        <input type="number" min="1" step="any" class="form-control" id="Cash_Tendered" name="Cash_Tendered" value="{{$payment_business[0]->Cash_Tendered}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Region_ID">Region</label>
                            <select class="form-control" id="Region_ID" name="Region_ID">
                                <option value=''  selected>Select Option</option>
                                @foreach($region as $bt1)
                                <option value="{{ $bt1->Region_ID }}" {{ $bt1->Region_ID  == $payment_business[0]->Region_ID  ? "selected" : "" }}>{{ $bt1->Region_Name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Province_ID">Province</label>
                            <select class="form-control" id="Province_ID" name="Province_ID">
                                <option value=''  selected>Select Option</option>
                                @foreach($province as $bt1)
                                <option value="{{ $bt1->Province_ID }}" {{ $bt1->Province_ID  == $payment_business[0]->Province_ID  ? "selected" : "" }}>{{ $bt1->Province_Name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="City_Municipality_ID">City_Municipality</label>
                            <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID">
                                <option value='' disabled selected>Select Option</option>
                                @foreach($city_municipality as $bt1)
                                <option value="{{ $bt1->City_Municipality_ID }}" {{ $bt1->City_Municipality_ID  == $payment_business[0]->City_Municipality_ID  ? "selected" : "" }}>{{ $bt1->City_Municipality_Name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Barangay_ID">Barangay</label>
                            <select class="form-control" id="Barangay_ID" name="Barangay_ID">
                                <option value='' disabled selected>Select Option</option>
                                @foreach($barangay as $bt1)
                                <option value="{{ $bt1->Barangay_ID }}" {{ $bt1->Barangay_ID  == $payment_business[0]->Barangay_ID  ? "selected" : "" }}>{{ $bt1->Barangay_Name }}</option>
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