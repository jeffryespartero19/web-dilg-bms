@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brgy Document Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"> 
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('brgy_document_information_list')}}">Brgy Document Information List</a></li>
                        <li class="breadcrumb-item active">Brgy Document Information</li>
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
                        <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
                        @if (Auth::user()->User_Type_ID == 1)
                        <div style="margin-left: 5px;"><button type="submit" class="btn btn-warning" style="width: 100px;" id="Print_Certification" class="Print_Certification">Print</button></div>
                        @endif
                        <br>
                            <div class="col-md-12">
                                <form id="newBrgy_Document_Information" method="POST" action="{{ route('create_brgy_document_information') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input type="text" class="form-control" id="Document_ID" name="Document_ID" value="{{$document[0]->Document_ID}}" hidden>
                                        <input type="text" class="form-control" id="Payment_Collected_ID" name="Payment_Collected_ID" value="{{$payment_docu[0]->Payment_Collected_ID}}" hidden>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Transaction_No">Transaction No</label>
                                                <input type="text" class="form-control" id="Transaction_No" name="Transaction_No" value="{{$document[0]->Transaction_No}}">
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
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Resident_ID">Resident</label>
                                                <select class="form-control js-example-basic-single Resident_Select2 mySelect2" name="Resident_ID" >
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($resident as $rs)
                                                    <option value="{{ $rs->Resident_ID }}" {{ $rs->Resident_ID  == $document[0]->Resident_ID  ? "selected" : "" }}>{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
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
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Brgy_Cert_No">Barangay Cert. No.</label>
                                                <input type="text" class="form-control" id="Brgy_Cert_No" name="Brgy_Cert_No" value="{{$document[0]->Brgy_Cert_No}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Purpose_of_Document_ID">Purpose of Document</label>
                                                <select class="form-control" id="Purpose_of_Document_ID" name="Purpose_of_Document_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($purpose as $bt1)
                                                    <option value="{{ $bt1->Purpose_of_Document_ID }}" {{ $bt1->Purpose_of_Document_ID  == $document[0]->Purpose_of_Document_ID  ? "selected" : "" }}>{{ $bt1->Purpose_of_Document }}</option>
                                                    @endforeach  
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Request_Date">Request_Date</label>
                                                <input type="date" class="form-control" id="Request_Date" name="Request_Date" value="{{$document[0]->Request_Date}}" required>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Salutation_Name">Salutation Name</label>
                                                <input type="text" class="form-control" id="Salutation_Name" name="Salutation_Name" value="{{$document[0]->Salutation_Name}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-12" style="padding:0 10px">
                                                <label for="Remarks">Remarks</label>
                                                <input type="text" class="form-control" id="Remarks" name="Remarks" value="{{$document[0]->Remarks}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="SecondResident_Name">Other Resident Name</label>
                                                <input type="text" class="form-control" id="SecondResident_Name" name="SecondResident_Name" value="{{$document[0]->SecondResident_Name}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Issued_On">Issued On</label>
                                                <input type="datetime-local" class="form-control" id="Issued_On" name="Issued_On" value="{{$document[0]->Issued_On}}"required>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Issued_At">Issued At</label>
                                                <input type="text" class="form-control" id="Issued_At" name="Issued_At" value="{{$document[0]->Issued_At}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="OR_Date">OR Date</label>
                                                <input type="date" class="form-control" id="OR_Date" name="OR_Date" value="{{$payment_docu[0]->OR_Date}}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="OR_No">OR No</label>
                                                <input type="text" class="form-control" id="OR_No" name="OR_No" value="{{$payment_docu[0]->OR_No}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Cash_Tendered">Cash Tendered</label>
                                                <input type="number" min="1" step="any" class="form-control" id="Cash_Tendered" name="Cash_Tendered" value="{{$payment_docu[0]->Cash_Tendered}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_Details">CTC_Details</label>
                                                <input type="text" class="form-control" id="CTC_No" name="CTC_Details" value="{{$payment_docu[0]->CTC_Details}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_Date_Issued">CTC Date Issued</label>
                                                <input type="date" class="form-control" id="CTC_Date_Issued" name="CTC_Date_Issued" required value="{{$payment_docu[0]->CTC_Date_Issued}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_No">CTC No</label>
                                                <input type="text" class="form-control" id="CTC_No" name="CTC_No"  value="{{$payment_docu[0]->CTC_No}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_Amount">CTC Amount</label>
                                                <input type="number" min="1" step="any" class="form-control" id="CTC_Amount" name="CTC_Amount" value="{{$payment_docu[0]->CTC_Amount}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Place_Issued">Place Issued</label>
                                                <input type="text" class="form-control" id="Place_Issued" name="Place_Issued" value="{{$payment_docu[0]->Place_Issued}}">
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

<form id="Print" method="GET" action="{{ url('viewBrgyDocPDF') }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <input type="text" class="form-control" id="doc_id" name="doc_id" value="{{$document[0]->Document_Type_ID}}" hidden>
    <input type="text" class="form-control" id="Document_IDx" name="Document_IDx" value="{{$document[0]->Document_ID}}" hidden>
</form>



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

    $(document).on('change', ('#Document_Type_ID'), function(e) {
        var Docment_Type_ID = $(this).val();

        var id = Docment_Type_ID;
        $('#doc_id').val(id);
    });

    $(document).on('click', ('#Print_Certification'), function(e) {
        $('#Print').submit();

        
    });

    // Disable Form if DILG USER
    $(document).ready(function() {
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 3 || User_Type_ID == 4) {
            $("#newBrgy_Document_Information :input").prop("disabled", true);
        }
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