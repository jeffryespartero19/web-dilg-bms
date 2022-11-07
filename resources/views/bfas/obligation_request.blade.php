@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Obligation Request /Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Obligation Request /Setup</li>
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
                                            <th>Request No</th>
                                            <th>Purchase Order No</th>
                                            <th>Payee</th>
                                            <th>Fund</th>
                                            <th>Request Date</th>
                                            <th>Request Status</th>
                                            <th>Budget Appropriation</th>

                                            <th>Officer <br>in Charge</th>
                                            <th style="width:15%">Location</th>

                                            <th>Particulars</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr">{{$x->Obligation_Request_No}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Purchase_Order_No}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Last_Name}}, {{$x->First_Name}} {{$x->Middle_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Fund_Type}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Obligation_Request_Date}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Obligation_Request_Status}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Appropriation_No}}</td>

                                            <td class="sm_data_col txtCtr">{{$x->Last_Name2}}, {{$x->First_Name2}} {{$x->Middle_Name2}}</td>

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

                                            <td class="sm_data_col txtCtr">{{$x->Remarks}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_XYZ" value="{{$x->Obligation_Request_ID }}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
    <div class="modal-dialog modal-lg ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create New Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_obligation_request') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container row">

                        <div class="form-group col-lg-6">
                            <label>Obligation Request No:</label>
                            <input class="form-control" name="Obligation_Request_No">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Purchase Order No:</label>
                            <input class="form-control" name="Purchase_Order_No">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Payee:</label>
                            <select class="form-control" name="Card_File_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($card_file as $cf)
                                <option value={{$cf->Card_File_ID}}>{{$cf->Last_Name}}, {{$cf->First_Name}} {{$cf->Middle_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Fund Type:</label>
                            <select class="form-control" name="Fund_Type_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($fund_type as $ft)
                                <option value={{$ft->Fund_Type_ID}}>{{$ft->Fund_Type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Obligation Request Date:</label>
                            <input type="date" class="form-control" name="Obligation_Request_Date">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Request Status:</label>
                            <select class="form-control" name="Obligation_Request_Status_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($obr_status as $obs)
                                <option value={{$obs->Obligation_Request_Status_ID}}>{{$obs->Obligation_Request_Status}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Budget Appropriation:</label>
                            <select class="form-control" name="Budget_Appropriation_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($b_app as $bp)
                                <option value={{$bp->Budget_Appropriation_ID}}>{{$bp->Appropriation_No}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Officer in Charge:</label>
                            <select class="form-control" name="Brgy_Officials_and_Staff_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($card_file as $cf)
                                <option value={{$cf->Card_File_ID}}>{{$cf->Last_Name}}, {{$cf->First_Name}} {{$cf->Middle_Name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Particulars:</label>
                            <textarea class="form-control" name="Remarks"></textarea>
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
            <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_obligation_request') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <input id="this_identifier" value=11 hidden>
                <input id="this_idX" value="" hidden name="IDx">
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container row">

                        <div class="form-group col-lg-6">
                            <label>Obligation Request No:</label>
                            <input id="this_OR_no" class="form-control" name="Obligation_Request_No2">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Purchase Order No:</label>
                            <input id="this_PO_no" class="form-control" name="Purchase_Order_No2">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Payee:</label>
                            <select class="form-control" name="Card_File_ID2">
                                <option id="this_card_file_id" value='' hidden selected>Select</option>
                                @foreach($card_file as $cf)
                                <option value={{$cf->Card_File_ID}}>{{$cf->Last_Name}}, {{$cf->First_Name}} {{$cf->Middle_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Fund Type:</label>
                            <select class="form-control" name="Fund_Type_ID2">
                                <option id="this_fund_type_id" value='' hidden selected>Select</option>
                                @foreach($fund_type as $ft)
                                <option value={{$ft->Fund_Type_ID}}>{{$ft->Fund_Type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Obligation Request Date:</label>
                            <input id="this_obr_date" type="date" class="form-control" name="Obligation_Request_Date2">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Request Status:</label>
                            <select class="form-control" name="Obligation_Request_Status_ID2">
                                <option id="this_obr_status" value='' hidden selected>Select</option>
                                @foreach($obr_status as $obs)
                                <option value={{$obs->Obligation_Request_Status_ID}}>{{$obs->Obligation_Request_Status}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Budget Appropriation:</label>
                            <select class="form-control" name="Budget_Appropriation_ID2">
                                <option id="this_ba" value='' hidden selected>Select</option>
                                @foreach($b_app as $bp)
                                <option value={{$bp->Budget_Appropriation_ID}}>{{$bp->Appropriation_No}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Officer in Charge:</label>
                            <select class="form-control" name="Brgy_Officials_and_Staff_ID2">
                                <option id="this_brgy_officials_and_staff_id" value='' hidden selected>Select</option>
                                @foreach($card_file as $cf)
                                <option value={{$cf->Card_File_ID}}>{{$cf->Last_Name}}, {{$cf->First_Name}} {{$cf->Middle_Name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group col-lg-12">
                            <label>Particular:</label>
                            <textarea id="this_remarks" class="form-control" name="Remarks2"></textarea>
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