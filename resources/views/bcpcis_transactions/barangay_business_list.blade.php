@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">
 
<div class="page_title_row col-md-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Barangay Business Information List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Barangay Business Information List</li>
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
            @if (Auth::user()->User_Type_ID == 3  || Auth::user()->User_Type_ID == 4)
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
                                <div style="padding: 2px;"><a href="{{ url('barangay_business_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                                @endif
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Export</button></div>
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div>
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <div>
                                    <table id="example11" class="table table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                
                                                <th >Business Name</th>
                                                <th >Business Type</th>
                                                <th >Business Tin</th>
                                                <th >Business Owner</th>
                                                <th >Business Address</th>
                                                <th >Mobile No</th>
                                                <th >is Active?</th>
                                                <th>Actions</th>
                                            </tr>
                                            <tr>
                                                <td><input class="form-control searchFilter searchFilter1" style="min-width: 300px;" type="text"></td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter2" id="Business_Type_ID" name="Business_Type_ID" style="min-width: 300px;">
                                                    </select>
                                                </td>
                                                <td><input class="form-control searchFilter searchFilter3" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter4" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter5" style="min-width: 300px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter6" style="min-width: 200px;" type="text"></td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter7" style="min-width: 150px;">
                                                        <option value='' selected>Select Option</option>
                                                        <option value=1>Yes</option>
                                                        <option value=0>No</option>
                                                    </select>
                                                </td>
                                                <td style="min-width: 200px;"></td>
                                            </tr>
                                        </thead>
                                        <tbody id="ListData"> 
                                            @include('bcpcis_transactions.barangay_business_data')
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


<div class="modal fade" id="viewBrgyBusiness" tabindex="-1" role="dialog" aria-labelledby="viewBrgyBusiness" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="VName">Brgy Business Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- <h4 id="VName"> </h4> -->

                <table class="table table-striped table-bordered" style="width:100%">
                    <tr>
                        <td colspan="2" style="text-align: center; font-size:large">Details</td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Business Name: </strong></td>
                        <td><span id="VBusiness_Name"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Business Type: </strong></td>
                        <td><span id="VBusiness_Type"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Business Tin: </strong></td>
                        <td><span id="VBusiness_Tin"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Business Owner: </strong></td>
                        <td><span id="VBusiness_Owner"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Business Address: </strong></td>
                        <td><span id="VBusiness_Address"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Mobile No: </strong></td>
                        <td><span id="VMobile_No"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>is Active?: </strong></td>
                        <td><span id="VActive"></span></td>
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
            <form id="download_report" method="POST" action="{{ route('brgybusiness_downloadPDF') }}" autocomplete="off" enctype="multipart/form-data">
            <!-- <form id="download_report" method="POST"  autocomplete="off" enctype="multipart/form-data"> -->
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-4" style="padding:0 0px">
                                <input type="checkbox" id="chk_Business_Name" name="chk_Business_Name">
                                <label for="chk_Business_Name">Business Name</label><br>
                                <input type="checkbox" id="chk_Business_Type" name="chk_Business_Type">
                                <label for="chk_Business_Type">Business Type</label><br>
                                <input type="checkbox" id="chk_Business_Tin" name="chk_Business_Tin">
                                <label for="chk_Business_Tin">Business Tin</label><br>
                                <input type="checkbox" id="chk_Business_Owner" name="chk_Business_Owner">
                                <label for="chk_Business_Owner">Business Owner</label><br>
                                <input type="checkbox" id="chk_Business_Address" name="chk_Business_Address">
                                <label for="chk_Business_Address">Business Address</label><br>
                                <input type="checkbox" id="chk_Mobile_No" name="chk_Mobile_No">
                                <label for="chk_Mobile_No">Mobile No</label><br>
                                <input type="checkbox" id="chk_Active" name="chk_Active">
                                <label for="chk_Active">Active</label><br>
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
            <form id="print_report" method="GET" action="{{ route('brgybusiness_export') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <input type="checkbox" id="SelectAll" name="SelectAll">
                                <label for="SelectAll">Select All</label><br>
                            </div>
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <input type="checkbox" class="ChkBOX1" id="chk_Business_Name" name="chk_Business_Name">
                                <label for="chk_Business_Name">Business Name</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Business_Type" name="chk_Business_Type">
                                <label for="chk_Business_Type">Business Type</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Business_Tin" name="chk_Business_Tin">
                                <label for="chk_Business_Tin">Business Tin</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Business_Owner" name="chk_Business_Owner">
                                <label for="chk_Business_Owner">Business Owner</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Business_Address" name="chk_Business_Address">
                                <label for="chk_Business_Address">Business Address</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Mobile_No" name="chk_Mobile_No">
                                <label for="chk_Mobile_No">Mobile No.</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Active" name="chk_Active">
                                <label for="chk_Active">Active</label><br>
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
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();

        $("#Business_Type_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_businesstype',
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
    url: "/get_brgy_business_list/" + Barangay_ID,
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
                element["Business_Name"],
                element["Business_Type"],
                element["Business_Tin"],
                element["Business_Owner"],
                element["Business_Address"],
                element["Mobile_No"],
                "<a class='btn btn-success' href='barangay_business_details/" + element["Business_ID"] + "'>View</a>",
            ]).draw();
        });
    }
});
});
    
    // Delete Brgy Business
    $(document).on('click', ('.delete_business'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this brgy business?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_business",
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
                            text: "Brgy Business has been deleted.",
                            icon: 'success',
                            showConfirmButton: false,
                        });
                        location.reload();
                    }
                });

            }
        });
    });

    $(document).on('click', '.modal-close', function(e) {
        $('#newInhabitant').trigger("reset");
        $('#viewBrgyBusiness').trigger("reset");
    });

    $(document).on('click', ('.view_brgybusiness'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_brgybusiness",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#VBusiness_Name').html(data['theEntry'][0]['Business_Name']);
                $('#VBusiness_Tin').html(data['theEntry'][0]['Business_Tin']);
                $('#VBusiness_Owner').html(data['theEntry'][0]['Business_Owner']);
                $('#VBusiness_Address').html(data['theEntry'][0]['Business_Address']);
                $('#VMobile_No').html(data['theEntry'][0]['Mobile_No']);
                $('#VBusiness_Type').html(data['theEntry'][0]['Business_Type']);
                $('#VActive').html(data['theEntry'][0]['Active']);
            
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
        var page = $('#hidden_page').val();

        $.ajax({
            url: "/search_barangaybusiness_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4 + "&param5=" + param5 + "&param6=" + param6 + "&param7=" + param7,
            // url: "/search_barangaybusiness_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4 + "&param5=" + param5,
            success: function(data) {
                $('#ListData').html('');
                $('#ListData').html(data);
            }
        });
    }
</script>

<style>
 

   
</style>

@endsection