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
<section class="content frontX">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body"> 
                        <div class="tableX_row col-md-12 up_marg5">
                            <br>
                            <div class="col-md-12">  
                                <form id="newBrgy_Document_Information" method="POST" action="{{ route('create_brgy_document_information_request') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input type="text" class="form-control" id="Document_ID" name="Document_ID" hidden>
                                        <div class="row">
                                            <h6 style="color: red" for="Note">Note: Select the Document Type and Purpose of Document you want to request </h6>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Document_Type_ID">Document Type<label style="color: red">*</label></label>
                                                <select class="form-control fancyformat" id="Document_Type_ID" name="Document_Type_ID" >
                                                    <option value=''  selected>Select Option</option>
                                                        @foreach($document_type as $bt1)
                                                        <option value="{{ $bt1->Document_Type_ID }}" @isset($for_modal) @if($data['Document_Type_ID'] == $bt1->Document_Type_ID) selected @endif @endisset>{{ $bt1->Document_Type_Name }}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Purpose_of_Document_ID">Purpose of Document<label style="color: red">*</label></label>
                                                <select class="form-control fancyformat1" id="Purpose_of_Document_ID" name="Purpose_of_Document_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                        @foreach($purpose as $bt1)
                                                        <option value="{{ $bt1->Purpose_of_Document_ID }}"@isset($for_modal) @if($data['Purpose_of_Document_ID'] == $bt1->Purpose_of_Document_ID) selected @endif @endisset>{{ $bt1->Purpose_of_Document }}</option>
                                                        @endforeach 
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Salutation_Name">Salutation Name</label>
                                                <input type="text" class="form-control" id="Salutation_Name" name="Salutation_Name" value="@isset($for_modal) {{$data['Salutation_Name']}} @endisset">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-8" style="padding:0 10px">
                                                <label for="Remarks">Remarks</label>
                                                <input type="text" class="form-control" id="Remarks" name="Remarks" value="@isset($for_modal) {{$data['Remarks']}} @endisset">
                                            </div>
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="SecondResident_Name">Other Resident Name</label>
                                                <input type="text" class="form-control" id="SecondResident_Name" name="SecondResident_Name" value="@isset($for_modal) {{$data['SecondResident_Name']}} @endisset">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Requested_Date_and_Time">Requesting Date and Time to Pickup</label>
                                                <!-- <input id="Requested_Date_and_Time" name="Requested_Date_and_Time" type="text" /> -->
                                                <input type="datetime-local" step="any" min="{{$min}}" class="form-control" id="Requested_Date_and_Time" name="Requested_Date_and_Time"  required>
                                                <input type="text" class="form-control" id="Requested_Date_and_Time_Words" hidden>
                                            </div>
                                            <!-- <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Date_Stamp">Created Date</label>
                                                <input type="date" class="form-control" id="Date_Stamp" name="Date_Stamp" disabled>
                                            </div> -->
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Date_Stamp_Words">Created Date</label>
                                                <input type="text" class="form-control" id="Date_Stamp_Words" name="Date_Stamp_Words" disabled>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="VDocument_Type" name="VDocument_Type" hidden>
                                        <input type="text" class="form-control" id="VPurpose_Document" name="VPurpose_Document" hidden>
                                        
                                    </div>
                                    <div class="col-lg-12" style="margin-bottom: 100px;">
                                        <center>
                                            <!-- <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button> -->
                                            <button type="submit" class="btn btn-primary" id="btnallaround" style="width: 200px;">Save</button>
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

<div class="modal backX" id="createTicket" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close createTicket_Close" data-dismiss="modal">&times;</button>
                    
                </div>
                <form id="newTicket" method="POST" action="{{ route('create_file_attachment') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body Absolute-Center">
                        <div class="modal_input_container">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <div class="row">
                                    <div class="form-group col-lg-12" style="padding:0 10px">
                                        <label for="Salutation_Name">Ticket Number:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12" style="padding:0 10px">
                                        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@isset($for_modal) {{$Queue_Ticket_Number}} @endisset</h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12" style="padding:0 10px">
                                        <label for="Name">Name: @isset($for_modal) {{$Name}} @endisset</label>
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="form-group col-lg-12" style="padding:0 10px">
                                        <label for="Document Type">Document Type: @isset($for_modal) {{$Document_Type_Name}} @endisset</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12" style="padding:0 10px">
                                        <label for="Document Type">Purpose of Document: @isset($for_modal) {{$Purpose_Document_Name}} @endisset</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12" style="padding:0 10px">
                                        <label for="Requested_Date_and_Time">Requested Date and Time: @isset($for_modal) {{date('d-m-Y h:i:s A', strtotime($Requested_Date_and_Time))}} @endisset</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="Note">Note : Please take a picture/screenshot of your ticket number and your appointment date/time</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

<script>



     $(document).ready(function(){
        // document.getElementById('Date_Stamp').valueAsDate = new Date();
        var now = new Date().toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric"});
        $('#Date_Stamp_Words').val(now);

        $(document).on('click',('.createTicket_Close'),function(e) {
            //alert('here');
            $('#createTicket').addClass('backX');
            $('#createTicket').fadeOut();
            window.location.replace('document_request_list');
        });

       
    });


    $(document).on("focusout",'.fancyformat', function(e) {
            var disVal=$(this).val();
            // var num2 = parseFloat(disVal).toLocaleString();
            // var num3 =  parseFloat(disVal);
            
            // $(this).val(num2);
            // $(this).next().val(num3);
            $.ajax({
            url: "/get_documenttype",
            type: 'GET',
            data: {
                id: disVal
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#VDocument_Type').val(data['theEntry'][0]['Document_Type_Name']);
                
            }
        });
           
        });

        // $(document).on("focusout",'.fancydate', function(e) {
        //     var disVal=$(this).val();
          
        //    var newDate = new Date(disVal.toDateString());
        //    alert(newDate);
        // });

        $(document).on("focusout",'.fancyformat1', function(e) {
            var disVal=$(this).val();
            // var num2 = parseFloat(disVal).toLocaleString();
            // var num3 =  parseFloat(disVal);
            
            // $(this).val(num2);
            // $(this).next().val(num3);
            $.ajax({
            url: "/get_purposedocument",
            type: 'GET',
            data: {
                id: disVal
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#VPurpose_Document').val(data['theEntry'][0]['Purpose_of_Document']);
                
            }
        });
           
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
@isset($for_modal)
    @if($for_modal==1)
        <script>
            $(document).ready(function(){
                $('#createTicket').removeClass('backX');
                $('#createTicket').fadeIn();
            });
        </script>
    @endif
@endisset

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


    // Side Bar Active
    $(document).ready(function() {
        $('.brgyDocument').addClass('active');
        $('.certification_menu').addClass('active');
        $('.certification_main').addClass('menu-open');
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