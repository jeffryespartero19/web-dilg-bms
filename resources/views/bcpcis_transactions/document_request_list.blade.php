@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Document Request List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Document Request List</li>
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
                        <div style="text-align: right;">
                            <div class="btn-group">
                                <div style="padding: 2px;"><a href="{{ url('brgy_document_information_details_request') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <div>
                                    <table class="example11 table table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>Queue Ticket Number</th>
                                                <th>Document Type</th>
                                                <th>Purpose of Document</th>
                                                <th>Salutation Name</th>
                                                <th>Remarks</th>
                                                <th>Other Resident Name</th>
                                                <th>Requesting Date and Time</th>
                                                <th>Created Date</th>
                                                <th>Request Status</th>
                                                <th>Actions</th> 
                                            </tr>
                                            <tr>
                                                <td><input class="form-control searchFilter searchFilter1" style="min-width: 200px;" type="text"></td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter2" id="Document_Type_ID" name="Document_Type_ID" style="min-width: 300px;">
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter3" id="Purpose_of_Document_ID" name="Purpose_of_Document_ID" style="min-width: 300px;">
                                                    </select>
                                                </td>
                                                <td><input class="form-control searchFilter searchFilter4" style="min-width: 300px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter5" style="min-width: 300px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter6" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter7" style="min-width: 200px;" type="datetime-local"></td>
                                                <td><input class="form-control searchFilter searchFilter8" style="min-width: 200px;" type="date"></td>
                                                <td><input class="form-control searchFilter searchFilter9" style="min-width: 200px;" type="text"></td>
                                                <td style="min-width: 200px;"></td>
                                            </tr>
                                        </thead>
                                        <tbody id="ListData"> 
                                            @include('bcpcis_transactions.document_request_data')
                                        </tbody>
                                    </table>
                                    {!! $db_entries->links() !!}
                                    <input type="hidden" name="hidden_page" id="hidden_page" value="1">
                                </div>
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




<div class="modal fade" id="viewBusinessPermit" tabindex="-1" role="dialog" aria-labelledby="viewBusinessPermit" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="VName">Brgy Business Permit Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- <h4 id="VName"> </h4> -->

                <table class="table table-striped table-bordered" style="width:100%">
                    <tr>
                        <td colspan="2" style="text-align: center; font-size:large">Details</td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Transaction_No: </strong></td>
                        <td><span id="VTransaction_No"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Business Name: </strong></td>
                        <td><span id="VBusiness_Name"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Resident Name: </strong></td>
                        <td><span id="VResident_Name"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Occupation: </strong></td>
                        <td><span id="VOccupation"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>CTC No: </strong></td>
                        <td><span id="VCTC_No"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>New or Renewal: </strong></td>
                        <td><span id="VNew_or_Renewal"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Owned or Rented: </strong></td>
                        <td><span id="VOwned_or_Rented"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Business Permit Expiration Date: </strong></td>
                        <td><span id="VBarangay_Business_Permit_Expiration_Date"></span></td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')

<script>
     $(document).on('click', '.modal-close', function(e) {
        $('#viewBusinessPermit').trigger("reset");
    });
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();

       
    });

    $(document).ready(function() {
        $('#example').DataTable();

        $("#Document_Type_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_documenttype',
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

    // Side Bar Active
    $(document).ready(function() {
        // $('.businessPermit').addClass('active');
        // $('.certification_menu').addClass('active');
        // $('.certification_main').addClass('menu-open');
    });
    
    $(document).on('click', ('.view_businesspermit'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_businesspermit",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#VTransaction_No').html(data['theEntry'][0]['Transaction_No']);
                $('#VOccupation').html(data['theEntry'][0]['Occupation']);
                $('#VBarangay_Business_Permit_Expiration_Date').html(data['theEntry'][0]['Barangay_Business_Permit_Expiration_Date']);
                $('#VCTC_No').html(data['theEntry'][0]['CTC_No']);
                $('#VBusiness_Name').html(data['theEntry'][0]['Business_Name']);
                $('#VResident_Name').html(data['theEntry'][0]['Resident_Name']);
                $('#VNew_or_Renewal').html(data['theEntry'][0]['New_or_Renewal']);
                $('#VOwned_or_Rented').html(data['theEntry'][0]['Owned_or_Rented']);
            
            }
        });
    });

   
    $(".searchFilter").change(function() {
        SearchData2();
    });

    function SearchData2() {
        // alert('test');
        var param1 = $('.searchFilter1').val();
        var param2 = $('.searchFilter2').val();
        var param3 = $('.searchFilter3').val();
        var param4 = $('.searchFilter4').val();
        var param5 = $('.searchFilter5').val();
        var param6 = $('.searchFilter6').val();
        var param7 = $('.searchFilter7').val();
        var param8 = $('.searchFilter8').val();
        var param9 = $('.searchFilter9').val();
        var page = $('#hidden_page').val();

        $.ajax({
            url: "/search_documentrequest_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4 + "&param5=" + param5 + "&param6=" + param6 + "&param7=" + param7 + "&param8=" + param8 + "&param9=" + param9,
            success: function(data) {
                $('#ListData').html('');
                $('#ListData').html(data);
            }
        });
    }
</script>

<style>
    

    table {
        white-space: nowrap;
    }
</style>

@endsection