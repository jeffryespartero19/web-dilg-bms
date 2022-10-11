@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Check Preparation/Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Check Preparation/Setup</li>
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
                                            <th>Check Preparation <br>ID</th>
                                            <th>Particulars</th>
                                            <th>Baranggay Officials <br>and Staff ID</th>
                                            <th>Disbursement Voucher <br>ID</th>
                                            <th>Voucher Status<br>ID</th>
                                            <th>Amount</th>
                                            <th>Bank Account <br>ID</th>
                                            <th>Baranggay <br>ID</th>
                                            <th>City Municipality <br>ID</th>
                                            <th>Province <br>ID</th>
                                            <th>Region <br>ID</th>
                                            <th>Encoder ID</th>
                                            <th>Date Stamp</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr">{{$x->Check_Preparation_ID }}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Particulars}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Brgy_Officials_and_Staff_ID }}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Disbursement_Voucher_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Voucher_Status_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Amount}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Bank_Account_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Barangay_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->City_Municipality_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Province_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Region_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Encoder_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Date_Stamp}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_XYZ" value="{{$x->Check_Preparation_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_check_preparation') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">

                    <div class="modal_input_container row">
                        {{-- <div class="up_marg5">
                        <label>Check Preparation ID:</label>
                        <input class="form-control" name="Check_Preparation_ID">
                    </div> --}}

                        <div class="form-group col-lg-12">
                            <label>Particulars:</label>
                            <textarea class="form-control" name="Particulars"></textarea>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Baranggay and Staff ID:</label>
                            <select class="form-control" name="Brgy_Officials_and_Staff_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($brgy_OS as $brgy_os)
                                <option value={{$brgy_os->Brgy_Officials_and_Staff_ID}}>{{$brgy_os->Brgy_Officials_and_Staff_ID}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group col-lg-6">
                            <label>Disbursement Voucher ID:</label>
                            <select class="form-control" name="Disbursement_Voucher_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($disbursement_voucher as $dv)
                                <option value={{$dv->Disbursement_Voucher_ID}}>{{$dv->Disbursement_Voucher_ID}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Voucher_Status_ID :</label>
                            <select class="form-control" name="Voucher_Status_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($voucher_status as $vs)
                                <option value={{$vs->Voucher_Status_ID}}>{{$vs->Voucher_Status_ID }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Amount:</label>
                            <input class="form-control" name="Amount">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Bank Account ID:</label>
                            <select class="form-control" name="Bank_Account_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($bank_acc as $bac)
                                <option value={{$bac->Bank_Account_ID}}>{{$bac->Bank_Account_Name}}-({{$bac->Bank_Account_No}})</option>
                                @endforeach
                            </select>
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


                        {{-- <div class="up_marg5">
                        <label>Active:</label>
                        <select class="form-control" name="ActiveX">
                            <option id="this_active"  value=1 hidden selected>Is Active?</option>
                            <option value=1>Yes</option>
                            <option value=0>No</option>
                        </select>
                    </div> --}}
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
            <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_check_preparation') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <input id="this_identifier" value=6 hidden>
                <input id="this_idX" value="" hidden name="IDx">
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container row">
                        {{-- <div class="up_marg5">
                        <label>Check Preparation ID:</label>
                        <input id="this_" class="form-control" name="Check_Preparation_ID">
                    </div> --}}

                        <div class="form-group col-lg-12">
                            <label>Particulars:</label>
                            <textarea id="this_particulars" class="form-control" name="Particulars2"></textarea>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Baranggay and Staff ID:</label>
                            <select class="form-control" name="Brgy_Officials_and_Staff_ID2">
                                <option id="this_brgy_OS" value='' hidden selected>Select</option>
                                @foreach($brgy_OS as $brgy_os)
                                <option value={{$brgy_os->Brgy_Officials_and_Staff_ID}}>{{$brgy_os->Brgy_Officials_and_Staff_ID}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group col-lg-6">
                            <label>Disbursement Voucher ID:</label>
                            <select class="form-control" name="Disbursement_Voucher_ID2">
                                <option id="this_disbursement_voucher" value='' hidden selected>Select</option>
                                @foreach($disbursement_voucher as $dv)
                                <option value={{$dv->Disbursement_Voucher_ID}}>{{$dv->Disbursement_Voucher_ID}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Voucher_Status_ID :</label>
                            <select class="form-control" name="Voucher_Status_ID2">
                                <option id="this_voucher_status" value='' hidden selected>Select</option>
                                @foreach($voucher_status as $vs)
                                <option value={{$vs->Voucher_Status_ID}}>{{$vs->Voucher_Status_ID }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Amount:</label>
                            <input id="this_amount" class="form-control" name="Amount2">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Bank Account ID:</label>
                            <select class="form-control" name="Bank_Account_ID2">
                                <option id="this_bank_account" value='' hidden selected>Select</option>
                                @foreach($bank_acc as $bac)
                                <option value={{$bac->Bank_Account_ID}}>{{$bac->Bank_Account_Name}}-({{$bac->Bank_Account_No}})</option>
                                @endforeach
                            </select>
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


                        {{-- <div class="up_marg5">
                        <label>Active:</label>
                        <select class="form-control" name="ActiveX">
                            <option id="this_active"  value=1 hidden selected>Is Active?</option>
                            <option value=1>Yes</option>
                            <option value=0>No</option>
                        </select>
                    </div> --}}
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