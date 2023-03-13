@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Brgy Business Permit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('brgy_business_permit_list')}}">Brgy Business Permit List</a></li>
                        <li class="breadcrumb-item active">Brgy Business Permit Information</li>
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
                                <form id="newBrgy_Document_Information" method="POST" action="{{ route('create_barangay_business_permit') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input type="text" class="form-control" id="Barangay_Permits_ID" name="Barangay_Permits_ID" value="{{$permit[0]->Barangay_Permits_ID}}" hidden>
                                        <div class="row">
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Business_ID">Business</label>
                                                <select class="form-control" id="Business_ID" name="Business_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($business as $bt1)
                                                    <option value="{{ $bt1->Business_ID }}" {{ $bt1->Business_ID  == $permit[0]->Business_ID  ? "selected" : "" }}>{{ $bt1->Business_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Transaction_No">Transaction No</label>
                                                <input type="text" class="form-control" id="Transaction_No" name="Transaction_No" value="{{$permit[0]->Transaction_No}}">
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Resident_ID">Resident</label>
                                                <select class="form-control" id="Resident_ID" name="Resident_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($resident as $rs)
                                                    <option value="{{ $rs->Resident_ID }}" {{ $rs->Resident_ID  == $permit[0]->Resident_ID  ? "selected" : "" }}>{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="New_or_Renewal">New or Renewal</label>
                                                <select class="form-control" name="New_or_Renewal" id="New_or_Renewal">
                                                    <option value='' selected>Select Option</option>
                                                    <option value=0 {{ 0 == $permit[0]->New_or_Renewal  ? "selected" : "" }}>Renewal</option>
                                                    <option value=1 {{ 1 == $permit[0]->New_or_Renewal  ? "selected" : "" }}>New</option>
                                                </select>
                                            </div> 
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Owned_or_Rented">Owned or Rented</label>
                                                <select class="form-control" name="Owned_or_Rented" id="Owned_or_Rented">
                                                    <option value='' selected>Select Option</option>
                                                    <option value=0 {{ 0 == $permit[0]->Owned_or_Rented  ? "selected" : "" }}>Rented</option>
                                                    <option value=1 {{ 1 == $permit[0]->Owned_or_Rented  ? "selected" : "" }}>Owned</option>
                                                </select>
                                            </div>
 
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Barangay_Business_Permit_Expiration_Date">Expiration Date</label>
                                                <input type="date" class="form-control" id="Barangay_Business_Permit_Expiration_Date" name="Barangay_Business_Permit_Expiration_Date" value="{{$permit[0]->Barangay_Business_Permit_Expiration_Date}}" required>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="OR_Date">OR Date</label>
                                                <input type="date" class="form-control" id="OR_Date" name="OR_Date" value="{{$payment_docu[0]->OR_Date}}" required>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="OR_No">OR No</label>
                                                <input type="text" class="form-control" id="OR_No" name="OR_No" value="{{$payment_docu[0]->OR_No}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Cash_Tendered">Cash Tendered</label>
                                                <input type="text"  onkeypress="validate(event)" class="form-control fancyformat" value="{{number_format((float)$payment_docu[0]->Cash_Tendered, 2, '.', ',')}}">
                                                <input type="number" step="0.01" class="form-control fancyformat" id="Cash_Tendered" name="Cash_Tendered" value="{{$payment_docu[0]->Cash_Tendered}}" hidden>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_Details">CTC Details</label>
                                                <input type="text" class="form-control" id="CTC_No" name="CTC_Details" value="{{$payment_docu[0]->CTC_Details}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_Date_Issued">CTC Date Issued</label>
                                                <input type="date" class="form-control" id="CTC_Date_Issued" name="CTC_Date_Issued" required value="{{$payment_docu[0]->CTC_Date_Issued}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_No">CTC No</label>
                                                <input type="text" class="form-control" id="CTC_No" name="CTC_No"  value="{{$payment_docu[0]->CTC_No}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_Amount">CTC Amount</label>
                                                <input type="text"  onkeypress="validate(event)" class="form-control fancyformat" value="{{number_format((float)$payment_docu[0]->CTC_Amount, 2, '.', ',')}}">
                                                <input type="number" step="0.01" class="form-control fancyformat" id="CTC_Amount" name="CTC_Amount" value="{{$payment_docu[0]->CTC_Amount}}" hidden>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Place_Issued">Place Issued</label>
                                                <input type="text" class="form-control" id="Place_Issued" name="Place_Issued" value="{{$payment_docu[0]->Place_Issued}}">
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Occupation">Occupation</label>
                                                <input type="text" class="form-control" id="Occupation" name="Occupation" value="{{$permit[0]->Occupation}}">
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

<form id="Print" method="GET" action="{{ url('viewBrgyBusinessPDF') }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <input type="text" class="form-control" id="permit_id" name="permit_id" value="{{$permit[0]->Barangay_Permits_ID}}" hidden>
</form>

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

        $(".Resident_Select2").select2({
            tags: true
        });

        

        $('.select2').select2();
         //Select2 Lazy Loading Business Type
         $("#Business_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_business',
                dataType: "json",
            } 
        });

        $("#Resident_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_businessresident',
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

    // Disable Form if DILG USER
    $(document).ready(function() {
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 3 || User_Type_ID == 4) {
            $("#newBrgy_Document_Information :input").prop("disabled", true);
        }
    });

     // Side Bar Active
     $(document).ready(function() {
        $('.businessPermit').addClass('active');
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