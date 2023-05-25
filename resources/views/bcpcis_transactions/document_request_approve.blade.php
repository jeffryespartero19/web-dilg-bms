@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Document Request Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"> 
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('document_request_pending_list')}}">Document Request Pending List</a></li>
                        <li class="breadcrumb-item active">Document Request Information</li>
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
                                <form id="newBrgy_Document_Information" method="POST" action="{{ route('update_document_request_approve_information') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input type="text" class="form-control" id="Document_ID" name="Document_ID" value="{{$document[0]->Document_ID}}" hidden>
                                        <input type="text" class="form-control" id="Resident_ID" name="Resident_ID" value="{{$document[0]->Resident_ID}}" hidden>
                                        <div class="row">
                                            <!-- <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Transaction_No">Transaction No</label>
                                                <input type="text" class="form-control" id="Transaction_No" name="Transaction_No">
                                            </div> -->
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
                                                <label for="Resident">Resident</label>
                                                <input type="text" class="form-control" id="Resident" name="Resident" value="{{$document[0]->Resident_Name}}" disabled>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Brgy_Cert_No">Barangay Cert. No.</label>
                                                <input type="text" class="form-control" id="Brgy_Cert_No" name="Brgy_Cert_No">
                                            </div> 
                                            <div class="form-group col-lg-1" style="padding:0 10px">
                                                <label for="Released">Released</label>
                                                <select class="form-control" style="width: 200px;" name="Released" id="Released">
                                                    <option value=1>Yes</option>
                                                    <option value=0>No</option>
                                                </select>
                                            </div> 
                                            
                                        </div>
                                        <div class="row">
                                            
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
                                                <label for="Request_Date">Request Date</label>
                                                <input type="date" class="form-control" id="Request_Date" name="Request_Date" value="{{$document[0]->Request_Date}}" required>
                                                <input type="text" class="form-control" id="Request_Date_Words" value="{{$document[0]->Request_Date}}" hidden>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Salutation_Name">Salutation Name</label>
                                                <input type="text" class="form-control" id="Salutation_Name" name="Salutation_Name" value="{{$document[0]->Salutation_Name}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="SecondResident_Name">Other Resident Name</label>
                                                <input type="text" class="form-control" id="SecondResident_Name" name="SecondResident_Name" value="{{$document[0]->SecondResident_Name}}">
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
                                                <label for="Issued_On">Issued On</label>
                                                <input type="datetime-local" class="form-control" id="Issued_On" name="Issued_On" required>
                                                <input type="text" class="form-control" id="Issued_On_Words" hidden>
                                            </div>
                                            <!-- <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Issued_At">Issued At</label>
                                                <input type="text" class="form-control" id="Issued_At" name="Issued_At" >
                                            </div> -->
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="OR_Date">OR Date</label>
                                                <input type="date" class="form-control" id="OR_Date" name="OR_Date"  required>
                                                <input type="text" class="form-control" id="OR_Date_Words" hidden>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="OR_No">OR No</label>
                                                <input type="text" class="form-control" id="OR_No" name="OR_No" >
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Cash_Tendered">Cash Tendered</label>
                                                <input type="number" min="1" step="any" class="form-control" id="Cash_Tendered" name="Cash_Tendered" >
                                            </div>
                                        </div>
                                        <div class="row">
                                            
                                            
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_Details">CTC Details</label>
                                                <input type="text" class="form-control" id="CTC_No" name="CTC_Details" >
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_Date_Issued">CTC Date Issued</label>
                                                <input type="date" class="form-control" id="CTC_Date_Issued" name="CTC_Date_Issued" required >
                                                <input type="text" class="form-control" id="CTC_Date_Issued_Words" hidden>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_No">CTC No</label>
                                                <input type="text" class="form-control" id="CTC_No" name="CTC_No"  >
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_Amount">CTC Amount</label>
                                                <input type="number" min="1" step="any" class="form-control" id="CTC_Amount" name="CTC_Amount" >
                                            </div>
                                        </div>
                                        <div class="row">
                                           
                                            
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Place_Issued">Place Issued</label>
                                                <input type="text" class="form-control" id="Place_Issued" name="Place_Issued" >
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

        var disvals=$('#Request_Date').val();

        $('#Request_Date').attr('hidden', 'true');
        var now1 = new Date(disvals).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric"});
        $('#Request_Date_Words').val(now1);
        $('#Request_Date_Words').removeAttr('hidden');
    });


    
    $(document).on('change', ('#Document_Type_ID'), function(e) {
        var Docment_Type_ID = $(this).val();

        var id = Docment_Type_ID;
        $('#doc_id').val(id);
    });

    $(document).on('click', ('#Print_Certification'), function(e) {
        $('#Print').submit();

        
    });

     // Side Bar Active
     $(document).ready(function() {
        $('.documentRequest').addClass('active');
        $('.certification_menu').addClass('active');
        $('.certification_main').addClass('menu-open');
    });


    $(document).on('change',('#OR_Date'),function(e) {
        var disVal = $(this).val();

        $(this).attr('hidden', 'true');
        var now = new Date(disVal).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric"});

        $('#OR_Date_Words').val(now);
        $('#OR_Date_Words').removeAttr('hidden');

    });

    $(document).on('click',('#OR_Date_Words'),function(e) {
        $(this).attr('hidden', 'true');
        $('#OR_Date').removeAttr('hidden');
    });


    $(document).on('change',('#Request_Date'),function(e) {
        var disVal = $(this).val();

        $(this).attr('hidden', 'true');
        var now = new Date(disVal).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric"});

        $('#Request_Date_Words').val(now);
        $('#Request_Date_Words').removeAttr('hidden');

    });

    $(document).on('click',('#Request_Date_Words'),function(e) {
        $(this).attr('hidden', 'true');
        $('#Request_Date').removeAttr('hidden');
    });


    $(document).on('change',('#CTC_Date_Issued'),function(e) {
        var disVal = $(this).val();

        $(this).attr('hidden', 'true');
        var now = new Date(disVal).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric"});

        $('#CTC_Date_Issued_Words').val(now);
        $('#CTC_Date_Issued_Words').removeAttr('hidden');

    });

    $(document).on('click',('#CTC_Date_Issued_Words'),function(e) {
        $(this).attr('hidden', 'true');
        $('#CTC_Date_Issued').removeAttr('hidden');
    });

    $(document).on('change',('#Issued_On'),function(e) {
        var disVal = $(this).val();

        $(this).attr('hidden', 'true');
        var now = new Date(disVal).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric",hour:"numeric",minute:"numeric"});

        $('#Issued_On_Words').val(now);
        $('#Issued_On_Words').removeAttr('hidden');

    });

    $(document).on('click',('#Issued_On_Words'),function(e) {
        $(this).attr('hidden', 'true');
        $('#Issued_On').removeAttr('hidden');
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