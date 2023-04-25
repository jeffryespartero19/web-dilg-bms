@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                    <h1>Document Request</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"> 
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('document_request_list')}}">Document Request List</a></li>
                        <li class="breadcrumb-item active">Document Request</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
<!-- @if ($errors->any())
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
@endif -->
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
                                <form id="newBrgy_Document_Information" method="POST" action="{{ route('create_brgy_document_information_request_update') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input type="text" class="form-control" id="Document_ID" name="Document_ID" value="{{$document[0]->Document_ID}}" hidden>
                                        <div class="row">
                                            <h6 style="color: red" for="Note">Note: Select the Document Type and Purpose of Document you want to request </h6>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Document_Type_ID">Document Type<label style="color: red">*</label></label>
                                                <select class="form-control fancyformat" id="Document_Type_ID" name="Document_Type_ID" >
                                                    <option value=''  selected>Select Option</option>
                                                        @foreach($document_type as $bt1)
                                                        <option value="{{ $bt1->Document_Type_ID }}" {{ $bt1->Document_Type_ID  == $document[0]->Document_Type_ID  ? "selected" : "" }}>{{ $bt1->Document_Type_Name }}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Purpose_of_Document_ID">Purpose of Document<label style="color: red">*</label></label>
                                                <select class="form-control fancyformat1" id="Purpose_of_Document_ID" name="Purpose_of_Document_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                        @foreach($purpose as $bt1)
                                                        <option value="{{ $bt1->Purpose_of_Document_ID }}" {{ $bt1->Purpose_of_Document_ID  == $document[0]->Purpose_of_Document_ID  ? "selected" : "" }}>{{ $bt1->Purpose_of_Document }}</option>
                                                        @endforeach 
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Salutation_Name">Salutation Name</label>
                                                <input type="text" class="form-control" id="Salutation_Name" name="Salutation_Name" value="{{$document[0]->Salutation_Name}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-8" style="padding:0 10px">
                                                <label for="Remarks">Remarks</label>
                                                <input type="text" class="form-control" id="Remarks" name="Remarks" value="{{$document[0]->Remarks}}">
                                            </div>
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="SecondResident_Name">Other Resident Name</label>
                                                <input type="text" class="form-control" id="SecondResident_Name" name="SecondResident_Name" value="{{$document[0]->SecondResident_Name}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Requested_Date_and_Time">Requesting Date and Time to Pickup</label>
                                                <input type="datetime-local" class="form-control" id="Requested_Date_and_Time" name="Requested_Date_and_Time" value="{{$claim[0]->Requested_Date_and_Time}}">
                                                <input type="text" class="form-control" id="Requested_Date_and_Time_Words" value="{{$claim[0]->Requested_Date_and_Time}}" hidden>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Date_Stamp">Created Date</label>
                                                <input type="datetime-local" class="form-control" id="Date_Stamp" name="Date_Stamp" value="{{$document[0]->Date_Stamp}}" disabled>
                                                <input type="text" class="form-control" id="Date_Stamp_Words" value="{{$document[0]->Date_Stamp}}" hidden disabled>
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

    $(document).on('change', ('#Barangay_Permits_ID'), function(e) {
        var Barangay_Permits_ID = $(this).val();

        var id = Barangay_Permits_ID;
        $('#permit_id').val(id);
    });

    $(document).on('click', ('#Print_Certification'), function(e) {
        $('#Print').submit();

        
    });
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
        
        $('.js-example-basic-single').select2();

        var disVal = $('#Requested_Date_and_Time').val();
        var disVals = $('#Date_Stamp').val();
        
        $('#Requested_Date_and_Time').attr('hidden', 'true');
        var now = new Date(disVal).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric",hour:"numeric",minute:"numeric"});
        $('#Requested_Date_and_Time_Words').val(now);
        $('#Requested_Date_and_Time_Words').removeAttr('hidden');


        $('#Date_Stamp').attr('hidden', 'true');
        var now1 = new Date(disVals).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric",hour:"numeric",minute:"numeric"});
        $('#Date_Stamp_Words').val(now1);
        $('#Date_Stamp_Words').removeAttr('hidden');

    
    
    });


    $(document).on('change',('#Requested_Date_and_Time'),function(e) {
        var disVal = $(this).val();
        
        $(this).attr('hidden', 'true');
        var now = new Date(disVal).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric",hour:"numeric",minute:"numeric"});

        $('#Requested_Date_and_Time_Words').val(now);
        $('#Requested_Date_and_Time_Words').removeAttr('hidden');

    });

    $(document).on('click',('#Requested_Date_and_Time_Words'),function(e) {
        $(this).attr('hidden', 'true');
        $('#Requested_Date_and_Time').removeAttr('hidden');
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