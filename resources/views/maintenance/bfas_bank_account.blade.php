@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bank Account Maintenance/Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Bank Account Maintenance/Setup</li>
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
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Bank <br>Account ID </th>
                                            <th>Accounts <br>Information ID </th>
                                            <th style="width:25%">Bank <br>Account Details</th>
                                            <th>Check <br>Number</th>
                                            <th style="width:25%">Location</th>
                                            <th>Active</th>
                                            <th>Encoder ID</th>
                                            <th>Date Stamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr">{{$x->Bank_Account_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Accounts_Information_ID}}</td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td><b>Code: </b></td>
                                                        <td>{{$x->Bank_Account_Code}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>No: </b></td>
                                                        <td>{{$x->Bank_Account_No}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Name: </b></td>
                                                        <td>{{$x->Bank_Account_Name}}</td>
                                                    </tr>
                                                </table>
                                            </td>

                                            <td>
                                                <table>
                                                    <tr>
                                                        <td><b>To: </b></td>
                                                        <td>{{$x->Check_Number_From}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>From: </b></td>
                                                        <td>{{$x->Check_Number_To}}</td>
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
                                            <td class="sm_data_col txtCtr">{{$x->Encoder_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Date_Stamp}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_XYZ" value="{{$x->Bank_Account_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create New Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_bank_account_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <div class="form-group">
                            <label>Bank Account Code:</label>
                            <input class="form-control" name="Bank_Account_Code">
                        </div>
                        <div class="form-group">
                            <label>Bank Account No</label>
                            <input class="form-control" name="Bank_Account_No">
                        </div>
                        <div class="form-group">
                            <label>Bank Account Name:</label>
                            <input class="form-control" name="Bank_Account_Name">
                        </div>

                        <div class="form-group">
                            <label>Check Number From:</label>
                            <input class="form-control" name="Check_Number_From">
                        </div>
                        <div class="form-group">
                            <label>Check Number To:</label>
                            <input class="form-control" name="Check_Number_To">
                        </div>

                        <div class="form-group">
                            <label>Region:</label>
                            <select class="form-control regionX" name="Region_IDX">
                                <option value='' hidden selected>Select</option>
                                @foreach($regionX as $rx)
                                <option value='{{$rx->Region_ID}}'>{{$rx->Region_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Province:</label>
                            <select class="form-control provX" name="Province_IDX">
                                <option value='' hidden selected>Select</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>City/Municipality:</label>
                            <select class="form-control cityX" name="City_Municipality_IDX">
                                <option value='' hidden selected>Select</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Barangay:</label>
                            <select class="form-control brgyX" name="Barangay_IDX">
                                <option value='' hidden selected>Select</option>
                            </select>
                        </div>


                        <div class="form-group">
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
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Update Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_bank_account_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <input id="this_identifier" value=5 hidden>
                <input id="this_idX" value="" hidden name="IDx">
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <div class="form-group">
                            <label>Bank Account Code:</label>
                            <input id="this_bcode" class="form-control" name="Bank_Account_Code2">
                        </div>
                        <div class="form-group">
                            <label>Bank Account No</label>
                            <input id="this_bno" class="form-control" name="Bank_Account_No2">
                        </div>
                        <div class="form-group">
                            <label>Bank Account Name:</label>
                            <input id="this_bname" class="form-control" name="Bank_Account_Name2">
                        </div>

                        <div class="form-group">
                            <label>Check Number From:</label>
                            <input id="this_cn_from" class="form-control" name="Check_Number_From2">
                        </div>
                        <div class="form-group">
                            <label>Check Number To:</label>
                            <input id="this_cn_to" class="form-control" name="Check_Number_To2">
                        </div>

                        <div class="form-group">
                            <label>Region:</label>
                            <select class="form-control regionX2 no_edit" name="Region_IDX2">
                                <option id="this_region" value='' hidden selected>Select</option>
                                @foreach($regionX as $rx)
                                <option value='{{$rx->Region_ID}}'>{{$rx->Region_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Province:</label>
                            <select class="form-control provX2 no_edit" name="Province_IDX2">
                                <option id="this_province" value='' hidden selected>Select</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>City/Municipality:</label>
                            <select class="form-control cityX2 no_edit" name="City_Municipality_IDX2">
                                <option id="this_city" value='' hidden selected>Select</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Barangay:</label>
                            <select class="form-control brgyX2 no_edit" name="Barangay_IDX2">
                                <option id="this_barangay" value='' hidden selected>Select</option>
                            </select>
                        </div>

                        <div class="form-group">
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
        $('.mAc5').addClass('active');
        $('.mAccount_menu').addClass('active');
        $('.mAccount_main').addClass('menu-open');
    });
</script>

@endsection