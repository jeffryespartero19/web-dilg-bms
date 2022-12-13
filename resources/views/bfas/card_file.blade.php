@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Card File Maintenance/Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Card File Maintenance/Setup</li>
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
                                <div style="padding: 2px;"><button class="btn btn-success" data-toggle="modal" data-target="#createXYZ">New</button></div>
                                <!-- <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Print</button></div>
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div> -->
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <table id="example" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Company TIN</th>
                                            <th>Card Name</th>
                                            <th style="width:20%">Contact #</th>
                                            <th>Addresses </th>
                                            <th>Location</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr">{{$x->Company_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Company_Tin}}</td>

                                            <td class="sm_data_col txtCtr">{{$x->Last_Name}}, {{$x->First_Name}} {{$x->Middle_Name}}</td>

                                            <td class="sm_data_col txtCtr">
                                                <table>
                                                    <tr>
                                                        <td><b>Phone:</b></td>
                                                        <td>{{$x->Phone_No}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Contact 1:</b></td>
                                                        <td>{{$x->Contact_No_1}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Contact 2:</b></td>
                                                        <td>{{$x->Contact_No_2}}</td>
                                                    </tr>
                                                </table>
                                            </td>

                                            <td class="sm_data_col txtCtr">
                                                <table>
                                                    <tr>
                                                        <td><b>Billing Address:</b></td>
                                                        <td>{{$x->Billing_Address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Delivery Address:</b></td>
                                                        <td>{{$x->Delivery_Address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Email Address:</b></td>
                                                        <td>{{$x->Email_Address}}</td>
                                                    </tr>
                                                </table>
                                            </td>

                                            <td>
                                                <table>
                                                    <tr>
                                                        <td><b>Barangay: </b></td>
                                                        <td>{{$x->Barangay_Name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>City/Municipaltiy: </b></td>
                                                        <td>{{$x->City_Municipality_Name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Province: </b></td>
                                                        <td>{{$x->Province_Name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Region: </b></td>
                                                        <td>{{$x->Region_Name}}</td>
                                                    </tr>
                                                </table>
                                            </td>

                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_XYZ" value="{{$x->Card_File_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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

<!-- Create Modal -->
<div class="modal fade" id="createXYZ" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create New Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_card_file') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Card Type:</label>
                            <select class="form-control regionX" name="Card_TypeX">
                                <option value='' hidden selected>Select</option>
                                @foreach($card_type as $ct)
                                <option value='{{$ct->Card_Type_ID}}'>{{$ct->Card_Type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Company Name:</label>
                            <input class="form-control" name="Company_Name">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Company Tin:</label>
                            <input class="form-control" name="Company_Tin">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Last Name:</label>
                            <input class="form-control" name="Last_Name">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>First Name:</label>
                            <input class="form-control" name="First_Name">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Middle Name:</label>
                            <input class="form-control" name="Middle_Name">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Phone No:</label>
                            <input class="form-control" name="Phone_No">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Contact 1:</label>
                            <input class="form-control" name="Contact_No_1">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Contact No 2:</label>
                            <input class="form-control" name="Contact_No_2">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Billing Address:</label>
                            <input class="form-control" name="Billing_Address">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Delivery Address:</label>
                            <input class="form-control" name="Delivery_Address">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Email Address:</label>
                            <input class="form-control" name="Email_Address">
                        </div>


                        <div class="form-group col-lg-6">
                            <label>Region:</label>
                            <select class="form-control regionX" name="Region_IDX">
                                <option value='' hidden selected>Select</option>
                                @foreach($regionX as $rx)
                                <option value='{{$rx->Region_ID}}'>{{$rx->Region_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Province:</label>
                            <select class="form-control provX" name="Province_IDX">
                                <option value='' hidden selected>Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>City/Municipality:</label>
                            <select class="form-control cityX" name="City_Municipality_IDX">
                                <option value='' hidden selected>Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Barangay:</label>
                            <select class="form-control brgyX" name="Barangay_IDX">
                                <option value='' hidden selected>Select</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Active:</label>
                            <select class="form-control" name="ActiveX">
                                <option value=1 hidden selected>Is Active?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn postThis_XYZ modal_sb_button">Create</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Create  END -->

<!-- Edit/Update  Modal -->
<div class="modal fade" id="updateXYZ" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title flexer justifier">Update Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_card_file') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <input id="this_identifier" value=1 hidden>
                <input id="this_idX" value="" hidden name="IDx">
                <div class="modal-body Absolute-Center">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Card Type:</label>
                            <select class="form-control regionX" name="Card_TypeX2">
                                <option id="this_card_type" value='' hidden selected>Select</option>
                                @foreach($card_type as $ct)
                                <option value='{{$ct->Card_Type_ID}}'>{{$ct->Card_Type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Company Name:</label>
                            <input id="this_company_name" class="form-control" name="Company_Name2">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Company Tin:</label>
                            <input id="this_company_tin" class="form-control" name="Company_Tin2">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Last Name:</label>
                            <input id="this_last_name" class="form-control" name="Last_Name2">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>First Name:</label>
                            <input id="this_first_name" class="form-control" name="First_Name2">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Middle Name:</label>
                            <input id="this_middle_name" class="form-control" name="Middle_Name2">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Phone No:</label>
                            <input id="this_phone_no" class="form-control" name="Phone_No2">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Contact 1:</label>
                            <input id="this_contact_1" class="form-control" name="Contact_No_1_b">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Contact No 2:</label>
                            <input id="this_contact_2" class="form-control" name="Contact_No_2_b">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Billing Address:</label>
                            <input id="this_billing_address" class="form-control" name="Billing_Address2">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Delivery Address:</label>
                            <input id="this_delivery_address" class="form-control" name="Delivery_Address2">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Email Address:</label>
                            <input id="this_email_address" class="form-control" name="Email_Address2">
                        </div>


                        <div class="form-group col-lg-6">
                            <label>Region:</label>
                            <select class="form-control regionX2" name="Region_IDX2">
                                <option id="this_region" value='' hidden selected>Select</option>
                                @foreach($regionX as $rx)
                                <option value='{{$rx->Region_ID}}'>{{$rx->Region_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Province:</label>
                            <select class="form-control provX2" name="Province_IDX2">
                                <option id="this_province" value='' hidden selected>Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>City/Municipality:</label>
                            <select class="form-control cityX2" name="City_Municipality_IDX2">
                                <option id="this_city" value='' hidden selected>Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Barangay:</label>
                            <select class="form-control brgyX2" name="Barangay_IDX2">
                                <option id="this_barangay" value='' hidden selected>Select</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Active:</label>
                            <select class="form-control" name="ActiveX2">
                                <option id="this_active" value=1 hidden selected>Is Active?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn updateThis_XYZ modal_sb_button">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Edit/Update END -->

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.CardFile').addClass('active');
        $('.accounting_menu').addClass('active');
        $('.accounting_main').addClass('menu-open');
    });
</script>

@endsection