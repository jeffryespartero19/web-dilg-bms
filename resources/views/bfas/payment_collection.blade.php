@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payment Collection/Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Payment Collection/Setup</li>
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
                                            <th>Payment Collection<br>Number</th>
                                            <th>Account<br>Name</th>
                                            <th>Type of<br>Fee</th>
                                            <th>OR<br>Date</th>
                                            <th>OR<br>Number</th>
                                            <th>Cash<br>Tendered</th>
                                            <th>Remarks</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr">{{$x->Payment_Collection_Number}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Accounts_Information_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Type_of_Fee_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->OR_Date}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->OR_No}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Cash_Tendered}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Remarks}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_XYZ" value="{{$x->Payment_Collection_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_payment_collection') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Payment Collection Number:</label>
                            <input class="form-control" name="Payment_Collection_Number">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Account Name:</label>
                            <select class="form-control" name="Accounts_Information_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($account_info as $account)
                                <option value={{$account->Accounts_Information_ID}}>{{$account->Account_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Type of Fee:</label>
                            <select class="form-control" name="Type_of_Fee_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($type_fee as $fee)
                                <option value={{$fee->Type_of_Fee_ID}}>{{$fee->Type_of_Fee}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>OR Number:</label>
                            <input class="form-control" name="OR_No"></input>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>OR Date:</label>
                            <input class="form-control" name="OR_Date" type="date"></input>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Cash Tendered:</label>
                            <input class="form-control" name="Cash_Tendered"></input>
                        </div>
                        <div class="form-group col-lg-12">
                            <label>Remarks:</label>
                            <textarea class="form-control" name="Remarks"></textarea>
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

<!-- Edit/Update  Modal -->
<div class="modal fade" id="updateXYZ" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Update Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_payment_collection') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <input id="this_identifier" value=9 hidden>
                <input id="this_idX" value="" hidden name="IDx">
                <div class="modal-body Absolute-Center">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Payment Collection Number:</label>
                            <input id="this_payment_collection_number" class="form-control" name="Payment_Collection_Number2">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Account Name:</label>
                            <select class="form-control" name="Accounts_Information_ID2">
                                <option id="this_account_name" value='' hidden selected>Select</option>
                                @foreach($account_info as $account)
                                <option value={{$account->Accounts_Information_ID}}>{{$account->Account_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Type of Fee:</label>
                            <select class="form-control" name="Type_of_Fee_ID2">
                                <option id="this_type_of_fee" value='' hidden selected>Select</option>
                                @foreach($type_fee as $fee)
                                <option value={{$fee->Type_of_Fee_ID}}>{{$fee->Type_of_Fee}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>OR Number:</label>
                            <input id="this_or_number" class="form-control" name="OR_No2"></input>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>OR Date:</label>
                            <input id="this_or_date" class="form-control" name="OR_Date2" type="date"></input>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Cash Tendered:</label>
                            <input id="this_cash_tendered" class="form-control" name="Cash_Tendered2"></input>
                        </div>
                        <div class="form-group col-lg-12">
                            <label>Remarks:</label>
                            <textarea id="this_remarks" class="form-control" name="Remarks2"></textarea>
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
</script>

@endsection