@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brgy Document Information List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BCPIS</a></li>
                        <li class="breadcrumb-item active">Brgy Document Information List</li>
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
            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
                            <div class="form-group col-lg-3">
                                <label for="R_ID">Region</label>
                                <select class="form-control" id="R_ID" name="R_ID" required>
                                    <option value='' disabled selected>Select Option</option>

                                    @foreach($region1 as $region)
                                    <option value="{{ $region->Region_ID }}">{{ $region->Region_Name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="P_ID">Province</label>
                                <select class="form-control" id="P_ID" name="P_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="CM_ID">City/Municipality</label>
                                <select class="form-control" id="CM_ID" name="CM_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="B_ID">Barangay</label>
                                <select class="form-control" id="B_ID" name="B_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="text-align: right;">
                            <div class="btn-group">
                                @if (Auth::user()->User_Type_ID == 1)
                                <div style="padding: 2px;"><a href="{{ url('brgy_document_information_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                                
                                @endif
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Export</button></div>
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div>
                                <!-- <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Print</button></div>
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div> -->
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <div>
                                    <table class="example11 table table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>Transaction No</th>
                                                <th>Request Date</th>
                                                <th>Released</th>
                                                <th>Remarks</th>
                                                <th>Salutation Name</th>
                                                <th>CTC No</th>
                                                <th>Issued On</th>
                                                <th>Issued At</th>
                                                <th>Resident Name</th>
                                                <th>SecondResident Name</th>
                                                <th>Document Type Name</th>
                                                <th>Purpose of Document</th>
                                                <th>Actions</th>
                                            </tr>
                                            <tr>
                                                <td><input class="form-control searchFilter searchFilter1" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter2" style="min-width: 200px;" type="date"></td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter3" style="min-width: 150px;" >
                                                        <option value='' selected>Select Option</option>
                                                        <option value=1>Yes</option>
                                                        <option value=0>No</option>
                                                    </select>
                                                </td>
                                                <td><input class="form-control searchFilter searchFilter4" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter5" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter6" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter7" style="min-width: 200px;" type="date"></td>
                                                <td><input class="form-control searchFilter searchFilter8" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter9" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter10" style="min-width: 200px;" type="text"></td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter11" id="Document_Type_ID" name="Document_Type_ID" style="min-width: 300px;">
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter12" id="Purpose_of_Document_ID" name="Purpose_of_Document_ID" style="min-width: 300px;">
                                                    </select>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody id="ListData"> 
                                            @include('bcpcis_transactions.brgy_document_information_data')
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



<div class="modal fade" id="viewBrgyDocument" tabindex="-1" role="dialog" aria-labelledby="viewBrgyDocument" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="VName">Brgy Document Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- <h4 id="VName"> </h4> -->

                <table class="table table-striped table-bordered" style="width:100%">
                    <tr>
                        <td colspan="2" style="text-align: center; font-size:large">Details</td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Transaction No: </strong></td>
                        <td><span id="VTransaction_No"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Brgy Cert No: </strong></td>
                        <td><span id="VBrgy_Cert_No"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Document Type: </strong></td>
                        <td><span id="VDocument_Type_Name"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Purpose of Document: </strong></td>
                        <td><span id="VPurpose_of_Document"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Resident Name: </strong></td>
                        <td><span id="VResident_Name"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Request Date: </strong></td>
                        <td><span id="VRequest_Date"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Remarks: </strong></td>
                        <td><span id="VRemarks"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Salutation Name: </strong></td>
                        <td><span id="VSalutation_Name"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>SecondResident Name: </strong></td>
                        <td><span id="VSecondResident_Name"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>is Released?: </strong></td>
                        <td><span id="VReleased"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Issued On: </strong></td>
                        <td><span id="VIssued_On"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Issued At: </strong></td>
                        <td><span id="VIssued_At"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>OR Date: </strong></td>
                        <td><span id="VOR_Date"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>OR No: </strong></td>
                        <td><span id="VOR_No"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Cash Tendered: </strong></td>
                        <td><span id="VCash_Tendered"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>CTC No: </strong></td>
                        <td><span id="VCTC_No"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>CTC Details: </strong></td>
                        <td><span id="VCTC_Details"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>CTC Date Issued: </strong></td>
                        <td><span id="VCTC_Date_Issued"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>CTC Amount: </strong></td>
                        <td><span id="VCTC_Amount"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Place Issued: </strong></td>
                        <td><span id="VPlace_Issued"></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="download_filter" tabindex="-1" role="dialog" aria-labelledby="Create_BrgyBusinessPermit" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="download_report" method="POST" action="{{ route('brgydocument_downloadPDF') }}" autocomplete="off" enctype="multipart/form-data">
            <!-- <form id="download_report" method="POST"  autocomplete="off" enctype="multipart/form-data"> -->
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-4" style="padding:0 0px">
                                <input type="checkbox" id="chk_Transaction_No" name="chk_Transaction_No">
                                <label for="chk_Transaction_No">Transaction_No</label><br>
                                <input type="checkbox" id="chk_Request_Date" name="chk_Request_Date">
                                <label for="chk_Request_Date">Request Date</label><br>
                                <input type="checkbox" id="chk_Resident_Name" name="chk_Resident_Name">
                                <label for="chk_Resident_Name">Resident Name</label><br>
                                <input type="checkbox" id="chk_Released" name="chk_Released">
                                <label for="chk_Released">Released</label><br>
                                <input type="checkbox" id="chk_Remarks" name="chk_Remarks">
                                <label for="chk_Remarks">Remarks</label><br>
                                <input type="checkbox" id="chk_Purpose_of_Document" name="chk_Purpose_of_Document">
                                <label for="chk_Purpose_of_Document">Purpose of Document</label><br>
                                <input type="checkbox" id="chk_Salutation_Name" name="chk_Salutation_Name">
                                <label for="chk_Salutation_Name">Salutation Name</label><br>
                                <input type="checkbox" id="chk_Issued_On" name="chk_Issued_On">
                                <label for="chk_Issued_On">Issued On</label><br>
                                <input type="checkbox" id="chk_Issued_At" name="chk_Issued_At">
                                <label for="chk_Issued_At">Issued At</label><br>
                                <input type="checkbox" id="chk_Brgy_Cert_No" name="chk_Brgy_Cert_No">
                                <label for="chk_Brgy_Cert_No">Brgy Cert No</label><br>
                                <input type="checkbox" id="chk_Document_Type_Name" name="chk_Document_Type_Name">
                                <label for="chk_Document_Type_Name">Document Type Name</label><br>
                                <input type="checkbox" id="chk_SecondResident_Name" name="chk_SecondResident_Name">
                                <label for="chk_SecondResident_Name">SecondResident Name</label><br>
                                <input type="checkbox" id="chk_OR_No" name="chk_OR_No">
                                <label for="chk_OR_No">OR No</label><br>
                                <input type="checkbox" id="chk_Cash_Tendered" name="chk_Cash_Tendered">
                                <label for="chk_Cash_Tendered">Cash Tendered</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary postThis_Inhabitant_Info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="print_filter" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="print_report" method="GET" action="{{ route('documentinformation_export') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <input type="checkbox" id="SelectAll" name="SelectAll">
                                <label for="SelectAll">Select All</label><br>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <input type="checkbox" class="ChkBOX1" id="chk_Transaction_No" name="chk_Transaction_No">
                                <label for="chk_Transaction_No">Transaction No.</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Request_Date" name="chk_Request_Date">
                                <label for="chk_Request_Date">Request Date</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Resident_Name" name="chk_Resident_Name">
                                <label for="chk_Resident_Name">Resident Name</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Released" name="chk_Released">
                                <label for="chk_Released">Released</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Remarks" name="chk_Remarks">
                                <label for="chk_Remarks">Remarks</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Purpose_of_Document" name="chk_Purpose_of_Document">
                                <label for="chk_Purpose_of_Document">Purpose of Document</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Salutation_Name" name="chk_Salutation_Name">
                                <label for="chk_Salutation_Name">Salutation Name</label><br>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <input type="checkbox" class="ChkBOX1" id="chk_Issued_On" name="chk_Issued_On">
                                <label for="chk_Issued_On">Issued On</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Issued_At" name="chk_Issued_At">
                                <label for="chk_Issued_At">Issued At</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Brgy_Cert_No" name="chk_Brgy_Cert_No">
                                <label for="chk_Brgy_Cert_No">Cert No.</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Document_Type_Name" name="chk_Document_Type_Name">
                                <label for="chk_Document_Type_Name">Document Type Name</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_SecondResident_Name" name="chk_SecondResident_Name">
                                <label for="chk_SecondResident_Name">Second Resident Name</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_OR_No" name="chk_OR_No">
                                <label for="chk_OR_No">Or No</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Cash_Tendered" name="chk_Cash_Tendered">
                                <label for="chk_Cash_Tendered">Cash Tendered</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Export</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('scripts')

<script>

$(document).on('click', '.modal-close', function(e) {
        $('#viewBrgyDocument').trigger("reset");
    });
    // Data Table
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

    $(document).on("change", "#R_ID", function() {

        var Region_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_province/" + Region_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#P_ID').empty();
                $('#CM_ID').empty();
                $('#B_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#P_ID').append(option1);
                $('#CM_ID').append(option1);
                $('#B_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["Province_ID"] +
                        "'>" +
                        element["Province_Name"] +
                        "</option>";
                    $('#P_ID').append(option);
                });
            }
        });
    });

    $(document).on("change", "#P_ID", function() {
        var Province_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_city/" + Province_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#CM_ID').empty();
                $('#B_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#CM_ID').append(option1);
                $('#B_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["City_Municipality_ID"] +
                        "'>" +
                        element["City_Municipality_Name"] +
                        "</option>";
                    $('#CM_ID').append(option);
                });
            }
        });
    });

    $(document).on("change", "#CM_ID", function() {
        var City_Municipality_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_barangay/" + City_Municipality_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#B_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#B_ID').append(option1);

                data.forEach(element => {

                    var option = " <option value='" +
                        element["Barangay_ID"] +
                        "'>" +
                        element["Barangay_Name"] +
                        "</option>";
                    $('#B_ID').append(option);
                });
            }
        });
    });


    $(document).on("change", "#B_ID", function() {
        var Barangay_ID = $(this).val();


        $.ajax({
            type: "GET",
            url: "/get_brgy_document_information_list/" + Barangay_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#example').dataTable().fnClearTable();
                $('#example').dataTable().fnDraw();
                $('#example').dataTable().fnDestroy();

                data.forEach(element => {

                    $('#example').DataTable().row.add([
                        element["Transaction_No"],
                        element["Request_Date"],
                        element["Released"],
                        element["Remarks"],
                        element["Salutation_Name"],
                        element["CTC_No"],
                        element["Issued_On"],
                        element["Issued_At"],
                        element["Resident_Name"],
                        element["SecondResident_Name"],
                        element["Purpose_of_Document"],
                        element["Document_Type_Name"],
                        "<a class='btn btn-success' href='brgy_document_information_details/" + element["Document_ID"] + "'>View</a>",
                    ]).draw();
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


    // Delete Contractor
    $(document).on('click', ('.delete_document'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this brgy document?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_document",
                    type: 'GET',
                    data: {
                        id: disID
                    },
                    fail: function() {
                        alert('request failed');
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Deleted',
                            text: "Brgy Document has been deleted.",
                            icon: 'success',
                            showConfirmButton: false,
                        });
                        location.reload();
                    }
                });

            }
        });
    });

    $(document).on('click', ('.view_brgydocument'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_brgydocument",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#VTransaction_No').html(data['theEntry'][0]['Transaction_No']);
                $('#VBrgy_Cert_No').html(data['theEntry'][0]['Brgy_Cert_No']);
                $('#VDocument_Type_Name').html(data['theEntry'][0]['Document_Type_Name']);
                $('#VPurpose_of_Document').html(data['theEntry'][0]['Purpose_of_Document']);
                $('#VResident_Name').html(data['theEntry'][0]['Resident_Name']);
                $('#VRequest_Date').html(data['theEntry'][0]['Request_Date']);
                $('#VRemarks').html(data['theEntry'][0]['Remarks']);
                $('#VSalutation_Name').html(data['theEntry'][0]['Salutation_Name']);
                $('#VSecondResident_Name').html(data['theEntry'][0]['SecondResident_Name']);
                $('#VReleased').html(data['theEntry'][0]['Released']);
                $('#VIssued_On').html(data['theEntry'][0]['Issued_On']);
                $('#VIssued_At').html(data['theEntry'][0]['Issued_At']);
                $('#VOR_Date').html(data['theEntry'][0]['OR_Date']);
                $('#VOR_No').html(data['theEntry'][0]['OR_No']);
                $('#VCash_Tendered').html(data['theEntry'][0]['Cash_Tendered']);
                $('#VCTC_No').html(data['theEntry'][0]['CTC_No']);
                $('#VCTC_Details').html(data['theEntry'][0]['CTC_Details']);
                $('#VCTC_Date_Issued').html(data['theEntry'][0]['CTC_Date_Issued']);
                $('#VCTC_Amount').html(data['theEntry'][0]['CTC_Amount']);
                $('#VPlace_Issued').html(data['theEntry'][0]['Place_Issued']);
            }
        });

    });

    $(document).on('click', '#SelectAll', function(e) {
        $('.ChkBOX1').prop('checked', this.checked);
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
        var param10 = $('.searchFilter10').val();
        var param11 = $('.searchFilter11').val();
        var param12 = $('.searchFilter12').val();
        var page = $('#hidden_page').val();

        $.ajax({
            url: "/search_brgydocument_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4 + "&param5=" + param5 + "&param6=" + param6 + "&param7=" + param7 + "&param8=" + param8 + "&param9=" + param9 + "&param10=" + param10 + "&param11=" + param11 + "&param12=" + param12,
            // url: "/search_brgydocument_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4 + "&param5=" + param5 + "&param6=" + param6 + "&param7=" + param7 + "&param8=" + param8 + "&param9=" + param9 + "&param10=" + param10 + "&param11=" + param11 + "&param12=" + param12, 
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