@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Brgy Document Information</div> 
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BCPCIS / </li>
            </a> 
            <li> &nbsp;Brgy Document Information</li>
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
        <form id="newBrgy_Document_Information" method="POST" action="{{ route('create_brgy_document_information') }}"  autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" class="form-control" id="Document_ID" name="Document_ID" value="{{$document[0]->Document_ID}}" hidden>
                <div class="row">
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Transaction_No">Transaction No</label>
                        <input type="text" class="form-control" id="Transaction_No" name="Transaction_No" value="{{$document[0]->Transaction_No}}">
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Request_Date">Request_Date</label>
                        <input type="date" class="form-control" id="Request_Date" name="Request_Date" value="{{$document[0]->Request_Date}}" required>
                    </div>
                    <div class="form-group col-lg-4" style="padding:0 10px">
                        <label for="Purpose_of_Document_ID">Purpose of Document</label>
                        <select class="form-control" id="Purpose_of_Document_ID" name="Purpose_of_Document_ID">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($purpose as $bt1)
                            <option value="{{ $bt1->Purpose_of_Document_ID }}" {{ $bt1->Purpose_of_Document_ID  == $document[0]->Purpose_of_Document_ID  ? "selected" : "" }}>{{ $bt1->Purpose_of_Document }}</option>
                            @endforeach  
                        </select>
                    </div>
                    <div class="form-group col-lg-1" style="padding:0 10px">
                        <label for="Released">Released</label>
                        <select class="form-control" style="width: 200px;" name="Released" id="Released">
                            

                            <option value=0 {{ 0 == $document[0]->Released  ? "selected" : "" }}>No</option>
                            <option value=1 {{ 1 == $document[0]->Released  ? "selected" : "" }}>Yes</option>
                        </select>
                    </div>  
                </div>
                <div class="row">
                    <div class="form-group col-lg-12" style="padding:0 10px">
                        <label for="Remarks">Remarks</label>
                        <input type="text" class="form-control" id="Remarks" name="Remarks" value="{{$document[0]->Remarks}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="Salutation_Name">Salutation Name</label>
                        <input type="text" class="form-control" id="Salutation_Name" name="Salutation_Name" value="{{$document[0]->Salutation_Name}}">
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="CTC_No">CTC No</label>
                        <input type="text" class="form-control" id="CTC_No" name="CTC_No" value="{{$document[0]->CTC_No}}">
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Issued_On">Issued On</label>
                        <input type="datetime-local" class="form-control" id="Issued_On" name="Issued_On" value="{{$document[0]->Issued_On}}"required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="Issued_At">Issued At</label>
                        <input type="text" class="form-control" id="Issued_At" name="Issued_At" value="{{$document[0]->Issued_At}}">
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Document_Type_ID">Document Type</label>
                        <select class="form-control" id="Document_Type_ID" name="Document_Type_ID">
                            <option value=''  selected>Select Option</option>
                                @foreach($document_type as $bt1)
                                <option value="{{ $bt1->Document_Type_ID }}" {{ $bt1->Document_Type_ID  == $document[0]->Document_Type_ID  ? "selected" : "" }}>{{ $bt1->Document_Type_Name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Resident_ID">Resident</label>
                        <select class="form-control js-example-basic-single Resident_Select2 mySelect2" name="Resident_ID" style="width: 350px;">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($resident as $rs)
                            <option value="{{ $rs->Resident_ID }}" {{ $rs->Resident_ID  == $document[0]->Resident_ID  ? "selected" : "" }}>{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="SecondResident_Name">Other Resident Name</label>
                        <input type="text" class="form-control" id="SecondResident_Name" name="SecondResident_Name" value="{{$document[0]->SecondResident_Name}}">
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Region_ID">Region</label>
                            <select class="form-control" id="Region_ID" name="Region_ID">
                                <option value=''  selected>Select Option</option>
                                @foreach($region as $bt1)
                                <option value="{{ $bt1->Region_ID }}" {{ $bt1->Region_ID  == $document[0]->Region_ID  ? "selected" : "" }}>{{ $bt1->Region_Name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group col-lg-3" style="padding:0 10px">
                        <label for="Province_ID">Province</label>
                            <select class="form-control" id="Province_ID" name="Province_ID">
                                <option value='' disabled selected>Select Option</option>
                                @foreach($province as $bt1)
                                <option value="{{ $bt1->Province_ID }}" {{ $bt1->Province_ID  == $document[0]->Province_ID  ? "selected" : "" }}>{{ $bt1->Province_Name }}</option>
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
                                <option value="{{ $bt1->City_Municipality_ID }}" {{ $bt1->City_Municipality_ID  == $document[0]->City_Municipality_ID  ? "selected" : "" }}>{{ $bt1->City_Municipality_Name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group col-lg-4" style="padding:0 10px">
                        <label for="Barangay_ID">Barangay</label>
                            <select class="form-control" id="Barangay_ID" name="Barangay_ID">
                                <option value='' disabled selected>Select Option</option>
                                @foreach($barangay as $bt1)
                                <option value="{{ $bt1->Barangay_ID }}" {{ $bt1->Barangay_ID  == $document[0]->Barangay_ID  ? "selected" : "" }}>{{ $bt1->Barangay_Name }}</option>
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