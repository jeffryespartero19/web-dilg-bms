@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brgy Business Permit List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Brgy Business Permit List</li>
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
                                <div style="padding: 2px;"><a href="{{ url('brgy_business_permit_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
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
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            
                                            <th>Transaction No</th>
                                            <th>Business Name</th>
                                            <th>Resident Name</th>
                                            <th>New or Renewal</th>
                                            <th>Owned or Rented</th>
                                            <th>Expiration Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            
                                            <td class="sm_data_col txtCtr">{{$x->Transaction_No}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Business_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Resident_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->New_or_Renewal}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Owned_or_Rented}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Barangay_Business_Permit_Expiration_Date}}</td>
                                            <td class="sm_data_col txtCtr">
                                                @if (Auth::user()->User_Type_ID == 1)
                                                <a class="btn btn-info" href="{{ url('brgy_business_permit_details/'.$x->Barangay_Permits_ID) }}">Edit</a>
                                                <!-- <a class="btn btn-primary" href="{{ url('view_brgy_business_permit_details/'.$x->Barangay_Permits_ID) }}">View</a> -->
                                                <button class="view_businesspermit btn btn-primary" value="{{$x->Barangay_Permits_ID}}" data-toggle="modal" data-target="#viewBusinessPermit">View</button>
                                                <button class="delete_businesspermit btn btn-danger" value="{{$x->Barangay_Permits_ID}}">Delete</button>
                                                @endif
                                                @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
                                                <button class="view_businesspermit btn btn-primary" value="{{$x->Barangay_Permits_ID}}" data-toggle="modal" data-target="#viewBusinessPermit">View</button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                <h4 class="modal-title flexer justifier" id="Modal_Title">Brgy Business Permit Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-6">
                            <strong>Transaction_No: </strong><span id="VTransaction_No"></span><br>
                            <strong>Business_Name: </strong><span id="VBusiness_Name"></span><br>
                            <strong>Resident_Name: </strong><span id="VResident_Name"></span><br>
                            <strong>Occupation: </strong><span id="VOccupation"></span><br>
                            <strong>CTC No: </strong><span id="VCTC_No"></span><br>
                            <strong>New or Renewal: </strong><span id="VNew_or_Renewal"></span><br>
                            <strong>Owned or Rented: </strong><span id="VOwned_or_Rented"></span><br>
                            <strong>Barangay Business Permit Expiration Date: </strong><span id="VBarangay_Business_Permit_Expiration_Date"></span><br>
                            <!-- <h1>Contractor Name: </h1><h1 id="VContractor_Name"></h1> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
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
            <form id="download_report" method="POST" action="{{ route('businesspermit_downloadPDF') }}" autocomplete="off" enctype="multipart/form-data">
            <!-- <form id="download_report" method="POST"  autocomplete="off" enctype="multipart/form-data"> -->
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-4" style="padding:0 0px">
                                <input type="checkbox" id="chk_Transaction_No" name="chk_Transaction_No">
                                <label for="chk_Transaction_No">Transaction_No</label><br>
                                <input type="checkbox" id="chk_Business_Name" name="chk_Business_Name">
                                <label for="chk_Business_Name">Business Name</label><br>
                                <input type="checkbox" id="chk_Resident_Name" name="chk_Resident_Name">
                                <label for="chk_Resident_Name">Resident Name</label><br>
                                <input type="checkbox" id="chk_New_or_Renewal" name="chk_New_or_Renewal">
                                <label for="chk_New_or_Renewal">New or Renewal</label><br>
                                <input type="checkbox" id="chk_Owned_or_Rented" name="chk_Owned_or_Rented">
                                <label for="chk_Owned_or_Rented">Owned or Rented</label><br>
                                <input type="checkbox" id="chk_Occupation" name="chk_Occupation">
                                <label for="chk_Occupation">Occupation</label><br>
                                <input type="checkbox" id="chk_CTC_No" name="chk_CTC_No">
                                <label for="chk_CTC_No">CTC No</label><br>
                                <input type="checkbox" id="chk_Barangay_Business_Permit_Expiration_Date" name="chk_Barangay_Business_Permit_Expiration_Date">
                                <label for="chk_Barangay_Business_Permit_Expiration_Date">Business Permit Expiration Date</label><br>
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
            <form id="print_report" method="GET" action="{{ route('businesspermit_export') }}" autocomplete="off" enctype="multipart/form-data">
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
                                <input type="checkbox" class="ChkBOX1" id="chk_Business_Name" name="chk_Business_Name">
                                <label for="chk_Business_Name">Business Name</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Resident_Name" name="chk_Resident_Name">
                                <label for="chk_Resident_Name">Resident Name</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_New_or_Renewal" name="chk_New_or_Renewal">
                                <label for="chk_New_or_Renewal">New or Renewal</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Owned_or_Rented" name="chk_Owned_or_Rented">
                                <label for="chk_Owned_or_Rented">Owned or Rented</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Occupation" name="chk_Occupation">
                                <label for="chk_Occupation">Occupation</label><br>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <input type="checkbox" class="ChkBOX1" id="chk_CTC_No" name="chk_CTC_No">
                                <label for="chk_CTC_No">CTC No.</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Barangay_Business_Permit_Expiration_Date" name="chk_Barangay_Business_Permit_Expiration_Date">
                                <label for="chk_Barangay_Business_Permit_Expiration_Date">Expiration Date</label><br>
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
        $('#viewBusinessPermit').trigger("reset");
    });
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();

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
            url: "/get_businsess_permit_list/" + Barangay_ID,
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
                        element["Business_Name"],
                        element["Resident_Name"],
                        element["New_or_Renewal"],
                        element["Owned_or_Rented"],
                        element["Barangay_Business_Permit_Expiration_Date"],
                        "<a class='btn btn-success' href='brgy_business_permit_details/" + element["Barangay_Permits_ID"] + "'>View</a>",
                    ]).draw();
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


    // Delete Contractor
    $(document).on('click', ('.delete_businesspermit'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this business permit?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_businesspermit",
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
                            text: "Business permit has been deleted.",
                            icon: 'success',
                            showConfirmButton: false,
                        });
                        location.reload();
                    }
                });

            }
        });
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

    $(document).on('click', '#SelectAll', function(e) {
        $('.ChkBOX1').prop('checked', this.checked);
    });
</script>

@endsection