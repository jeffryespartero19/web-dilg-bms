@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Brgy Document</h1>
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
                            <br>
                            <div class="col-md-12">
                                <form id="newBrgy_Document_Information" method="POST" action="{{ route('create_brgy_document_information') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input type="text" class="form-control" id="Document_ID" name="Document_ID" hidden>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Transaction_No">Transaction No</label>
                                                <input type="text" class="form-control" id="Transaction_No" name="Transaction_No" value="{{old('Transaction_No')}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Document_Type_ID">Document Type</label>
                                                <select class="form-control" id="Document_Type_ID" name="Document_Type_ID">
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Resident_ID">Resident</label>
                                                <select class="form-control" id="Resident_ID" name="Resident_ID">
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-2" style="padding:0 10px">
                                                <label for="Released">Released</label>
                                                <select class="form-control" style="width: 200px;" name="Released" id="Released">
                                                    <option value=1>Yes</option>
                                                    <option value=0>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Brgy_Cert_No">Barangay Cert. No.</label>
                                                <input type="text" class="form-control" id="Brgy_Cert_No" name="Brgy_Cert_No" value="{{old('Brgy_Cert_No')}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Purpose_of_Document_ID">Purpose of Document</label>
                                                <select class="form-control" id="Purpose_of_Document_ID" name="Purpose_of_Document_ID">
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Request_Date">Request Date</label>
                                                <input type="date" class="form-control" id="Request_Date" name="Request_Date" required>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Salutation_Name">Salutation Name</label>
                                                <input type="text" class="form-control" id="Salutation_Name" name="Salutation_Name" value="{{old('Salutation_Name')}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-12" style="padding:0 10px">
                                                <label for="Remarks">Remarks</label>
                                                <input type="text" class="form-control" id="Remarks" name="Remarks" value="{{old('Remarks')}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="SecondResident_Name">Other Resident Name</label>
                                                <input type="text" class="form-control" id="SecondResident_Name" name="SecondResident_Name" value="{{old('SecondResident_Name')}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Issued_On">Issued On</label>
                                                <input type="datetime-local" class="form-control" id="Issued_On" name="Issued_On" required>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Issued_At">Issued At</label>
                                                <input type="text" class="form-control" id="Issued_At" name="Issued_At" value="{{old('Issued_At')}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="OR_Date">OR Date</label>
                                                <input type="date" class="form-control" id="OR_Date" name="OR_Date" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="OR_No">OR No</label>
                                                <input type="text" class="form-control" id="OR_No" name="OR_No" value="{{old('OR_No')}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Cash_Tendered">Cash Tendered</label>
                                                <input type="text"  onkeypress="validate(event)" class="form-control fancyformat">
                                                <input type="number" min="1" step="any" class="form-control" id="Cash_Tendered" name="Cash_Tendered" value="{{old('Cash_Tendered')}}" hidden>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_Details">CTC Details</label>
                                                <input type="text" class="form-control" id="CTC_No" name="CTC_Details" value="{{old('CTC_Details')}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_Date_Issued">CTC Date Issued</label>
                                                <input type="date" class="form-control" id="CTC_Date_Issued" name="CTC_Date_Issued" required>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_No">CTC No</label>
                                                <input type="text" class="form-control" id="CTC_No" name="CTC_No" value="{{old('CTC_No')}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_Amount">CTC Amount</label>
                                                <input type="text"  onkeypress="validate(event)" class="form-control fancyformat">
                                                <input type="number" min="1" step="any" class="form-control" id="CTC_Amount" name="CTC_Amount" value="{{old('CTC_Amount')}}" hidden>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Place_Issued">Place Issued</label>
                                                <input type="text" class="form-control" id="Place_Issued" name="Place_Issued" value="{{old('Place_Issued')}}">
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

        $('.js-example-basic-single').select2();

        $(".Resident_Select2").select2({
            tags: true
        });

        $('.select2').select2();

        //Select2 Lazy Loading 
        $("#Document_Type_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_documenttype',
                dataType: "json",
            }
        });

        $("#Resident_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_documentresident',
                dataType: "json",
            }
        });

        $("#Purpose_of_Document_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_documentpurpose',
                dataType: "json",
            }
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

     // Side Bar Active
     $(document).ready(function() {
        $('.brgyDocument').addClass('active');
        $('.certification_menu').addClass('active');
        $('.certification_main').addClass('menu-open');
    });

    $(document).on("focusout",'.fancyformat', function(e) {
            var disVal=$(this).val(); 
            var num2 = parseFloat(disVal).toLocaleString();
            var num3 =  parseFloat(disVal);
            
            $(this).val(num2);
            $(this).next().val(num3);
            //alert(num2);
        });

        function validate(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode( key );
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
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