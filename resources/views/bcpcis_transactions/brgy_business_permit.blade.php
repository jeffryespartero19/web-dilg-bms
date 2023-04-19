@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Brgy Business Permit </h1>
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
                            <br>
                            <div class="col-md-12">
                                <form id="newBrgy_Document_Information" method="POST" action="{{ route('create_barangay_business_permit') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input type="text" class="form-control" id="Barangay_Permits_ID" name="Barangay_Permits_ID" hidden>
                                        <div class="row">
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Business_ID">Business</label>
                                                <select class="form-control" id="Business_ID" name="Business_ID">
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Transaction_No">Transaction No</label>
                                                <input type="text" class="form-control" id="Transaction_No" name="Transaction_No">
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Resident_ID">Resident</label>
                                                <select class="form-control" id="Resident_ID" name="Resident_ID">
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="New_or_Renewal">New or Renewal</label>
                                                <select class="form-control" name="New_or_Renewal" id="New_or_Renewal">
                                                    <option value='' selected>Select Option</option>
                                                    <option value=1>New</option>
                                                    <option value=0>Renewal</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Owned_or_Rented">Owned or Rented</label>
                                                <select class="form-control" name="Owned_or_Rented" id="Owned_or_Rented">
                                                    <option value='' selected>Select Option</option>
                                                    <option value=1>Owned</option>
                                                    <option value=0>Rented</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Barangay_Business_Permit_Expiration_Date">Expiration Date</label>
                                                <input type="date" class="form-control" id="Barangay_Business_Permit_Expiration_Date" name="Barangay_Business_Permit_Expiration_Date" required>
                                                <input type="text" class="form-control" id="Barangay_Business_Permit_Expiration_Date_Words" hidden>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="OR_Date">OR Date</label>
                                                <input type="date" class="form-control" id="OR_Date" name="OR_Date" required>
                                                <input type="text" class="form-control" id="OR_Date_Words" hidden>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="OR_No">OR No</label>
                                                <input type="text" class="form-control" id="OR_No" name="OR_No" value="{{old('OR_No')}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Cash_Tendered">Cash Tendered</label>
                                                <input type="text"  onkeypress="validate(event)" class="form-control fancyformat">
                                                <input type="number" step="0.01" class="form-control fancyformat" id="Cash_Tendered" name="Cash_Tendered" value="{{old('Cash_Tendered')}}" hidden>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_Details">CTC Details</label>
                                                <input type="text" class="form-control" id="CTC_No" name="CTC_Details" value="{{old('CTC_Details')}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_Date_Issued">CTC Date Issued</label>
                                                <input type="date" class="form-control" id="CTC_Date_Issued" name="CTC_Date_Issued" required>
                                                <input type="text" class="form-control" id="CTC_Date_Issued_Words" hidden>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_No">CTC No</label>
                                                <input type="text" class="form-control" id="CTC_No" name="CTC_No" value="{{old('CTC_No')}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="CTC_Amount">CTC Amount</label>
                                                <input type="text"  onkeypress="validate(event)" class="form-control fancyformat">
                                                <input type="number" step="0.01" class="form-control fancyformat" id="CTC_Amount" name="CTC_Amount" value="{{old('CTC_Amount')}}" hidden>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Place_Issued">Place Issued</label>
                                                <input type="text" class="form-control" id="Place_Issued" name="Place_Issued" value="{{old('Place_Issued')}}">
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Occupation">Occupation</label>
                                                <input type="text" class="form-control" id="Occupation" name="Occupation" value="{{old('Occupation')}}">
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

    $(document).on('change',('#Barangay_Business_Permit_Expiration_Date'),function(e) {
        var disVal = $(this).val();

        $(this).attr('hidden', 'true');
        var now = new Date(disVal).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric"});

        $('#Barangay_Business_Permit_Expiration_Date_Words').val(now);
        $('#Barangay_Business_Permit_Expiration_Date_Words').removeAttr('hidden');

    });

    $(document).on('click',('#Barangay_Business_Permit_Expiration_Date_Words'),function(e) {
        $(this).attr('hidden', 'true');
        $('#Barangay_Business_Permit_Expiration_Date').removeAttr('hidden');
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