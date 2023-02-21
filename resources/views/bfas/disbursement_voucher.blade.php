@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Disbursement Voucher/Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Disbursement Voucher/Setup</li>
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
                                            <th>Reference</th>
                                            <th>Fund</th>
                                            <th>Purpose</th>
                                            <th style="width:15%">Tagged OBR</th>
                                            <th style="width:15%">Location</th>

                                            <th>Particulars</th>
                                            <th>Remarks</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td><b>Transaction No: </b></td>
                                                        <td>{{$x->Transaction_No}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Voucher No: </b></td>
                                                        <td>{{$x->Voucher_No}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Voucher Status: </b></td>
                                                        <td>{{$x->Voucher_Status}}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td><b>Appropriation Type: </b></td>
                                                        <td>{{$x->Appropriation_Type}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Fund Type: </b></td>
                                                        <td>{{$x->Fund_Type}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Voucher Status: </b></td>
                                                        <td>{{$x->Voucher_Status}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Tax Code: </b></td>
                                                        <td>{{$x->Description}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Payee: </b></td>
                                                        <td>{{$x->Last_Name}}, {{$x->First_Name}} {{$x->Middle_Name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Officer <br>in Charge: </b></td>
                                                        <td>{{$x->Last_Name2}}, {{$x->First_Name2}} {{$x->Middle_Name2}}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            
                                            <td class="sm_data_col txtCtr">
                                                @if($x->For_Liquidation==1) For Liquidation @endif
                                                @if($x->For_Payroll==1) For Payroll @endif
                                                @if($x->For_Cash_Advance==1) For Cash Advance @endif
                                                @if($x->Disbursement_Check==1) Check Disbursement @endif
                                                @if($x->Disbursement_Cash==1) Cash Disbursement @endif
                                            </td>

                                            
                                            <td class="sm_data_col txtCtr">
                                                <table>
                                                    <tr>
                                                        <th><b>OB Request</b></th>
                                                        <th><b>Amount</b></th>
                                                        <th><b></th>
                                                    </tr>

                                                    @foreach($accountsX as $acx)
                                                        @if($acx->Disbursement_Voucher_ID == $x->Disbursement_Voucher_ID)
                                                            
                                                        
                                                           
                                                        <tr>
                                                            <td>({{$acx->Obligation_Request_No}})</td>
                                                            <td>{{number_format((float)$acx->Amount, 2, '.', ',')}}</td>
                                                            <td><button class="delRec2" value="{{$acx->Multiple_OBR_ID}}" data-toggle="modal" data-target="#deleteFile2">Remove</button></b></td>
                                                        </tr>
                                                        @endif
                                                    @endforeach
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

                                            <td class="sm_data_col txtCtr">{{$x->Particulars}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Remarks}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_XYZ" value="{{$x->Disbursement_Voucher_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
                                                <button class="tag_XYZ" value="{{$x->Disbursement_Voucher_ID}}" data-toggle="modal" data-target="#tagXYZ">Tag</button>
                                                <button class="delRec" value="{{$x->Disbursement_Voucher_ID}}" data-toggle="modal" data-target="#deleteFile">Delete</button>
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
    <div class="modal-dialog modal-lg modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create New Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_disbursement_voucher') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container row">

                        <div class="form-group col-lg-6">
                            <label>Transaction No:</label>
                            <input class="form-control" name="Transaction_No">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Voucher No:</label>
                            <input class="form-control" name="Voucher_No">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Appropriation:</label>
                            <select class="form-control" name="Appropriation_Type_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($app_type as $apt)
                                <option value={{$apt->Appropriation_Type_ID}}>{{$apt->Appropriation_Type}}</option>
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
                            <label>Tax Code:</label>
                            <select class="form-control" name="Tax_Code_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($tax_code as $tc)
                                <option value={{$tc->Tax_Code_ID}}>{{$tc->Description}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Status:</label>
                            <select class="form-control" name="Disbursement_Voucher_Status_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($dv_status as $dvs)
                                <option value={{$dvs->Voucher_Status_ID}}>{{$dvs->Voucher_Status}}</option>
                                @endforeach
                            </select>
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
                            <label>Officer in Charge:</label>
                            <select class="form-control" name="Brgy_Officials_and_Staff_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($card_file as $cf)
                                <option value={{$cf->Card_File_ID}}>{{$cf->Last_Name}}, {{$cf->First_Name}} {{$cf->Middle_Name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Purpose:</label>
                            <select class="form-control" name="Purpose">
                                <option value='' hidden selected>Select</option>
                                <option value='1'>For Liquidation</option>
                                <option value='2'>For Payroll</option>
                                <option value='3'>For Cash Advance</option>
                                <option value='4'>Disbursement Check</option>
                                <option value='5'>Disbursement Cash</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Particulars:</label>
                            <textarea class="form-control" name="Particulars"></textarea>
                        </div>
                        <div class="form-group col-lg-12">
                            <label>Remarks:</label>
                            <textarea class="form-control" name="Remarks"></textarea>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Region:</label>
                            <select class="form-control regionX no_edit" name="Region_IDX">
                                <option value='' hidden selected>Select</option>
                                @foreach($regionX as $rx)
                                <option value='{{$rx->Region_ID}}' @if(Auth::user()->Region_ID==$rx->Region_ID) selected @endif>{{$rx->Region_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Province:</label>
                            <select class="form-control provX no_edit" name="Province_IDX">
                                <option value='@if($provX->isNotEmpty()){{$provX[0]->Province_ID}}@endif' hidden selected>@if($provX->isNotEmpty()){{$provX[0]->Province_Name}}@endif</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>City/Municipality:</label>
                            <select class="form-control cityX no_edit" name="City_Municipality_IDX">
                                <option value='@if($cityX->isNotEmpty()){{$cityX[0]->City_Municipality_ID}}@endif' hidden selected>@if($cityX->isNotEmpty()){{$cityX[0]->City_Municipality_Name}}@endif</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Barangay:</label>
                            <select class="form-control brgyX no_edit" name="Barangay_IDX">
                                <option value='@if($brgyX->isNotEmpty()){{$brgyX[0]->Barangay_ID}}@endif' hidden selected>@if($brgyX->isNotEmpty()){{$brgyX[0]->Barangay_Name}}@endif</option>
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
            <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_disbursement_voucher') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <input id="this_identifier" value=5 hidden>
                <input id="this_idX" value="" hidden name="IDx">
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container row">

                        <div class="form-group col-lg-6">
                            <label>Transaction No:</label>
                            <input id="this_transaction_no" class="form-control" name="Transaction_No2">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Voucher No:</label>
                            <input id="this_voucher_no" class="form-control" name="Voucher_No2">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Appropriation:</label>
                            <select class="form-control" name="Appropriation_Type_ID2">
                                <option id="this_appropriation_type_id" value='' hidden selected>Select</option>
                                @foreach($app_type as $apt)
                                <option value={{$apt->Appropriation_Type_ID}}>{{$apt->Appropriation_Type}}</option>
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
                            <label>Tax Code:</label>
                            <select class="form-control" name="Tax_Code_ID2">
                                <option id="this_tax_code_id" value='' hidden selected>Select</option>
                                @foreach($tax_code as $tc)
                                <option value={{$tc->Tax_Code_ID}}>{{$tc->Description}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Status:</label>
                            <select class="form-control" name="Disbursement_Voucher_Status_ID2">
                                <option id="this_voucher_status_id" value='' hidden selected>Select</option>
                                @foreach($dv_status as $dvs)
                                <option value={{$dvs->Voucher_Status_ID}}>{{$dvs->Voucher_Status}}</option>
                                @endforeach
                            </select>
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
                            <label>Officer in Charge:</label>
                            <select class="form-control" name="Brgy_Officials_and_Staff_ID2">
                                <option id="this_brgy_officials_and_staff_id" value='' hidden selected>Select</option>
                                @foreach($card_file as $cf)
                                <option value={{$cf->Card_File_ID}}>{{$cf->Last_Name}}, {{$cf->First_Name}} {{$cf->Middle_Name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Purpose:</label>
                            <select class="form-control" name="Purpose2">
                                <option id="this_purpose" value='' hidden selected>Select</option>
                                <option value='1'>For Liquidation</option>
                                <option value='2'>For Payroll</option>
                                <option value='3'>For Cash Advance</option>
                                <option value='4'>Disbursement Check</option>
                                <option value='5'>Disbursement Cash</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Particulars:</label>
                            <textarea id="this_particulars" class="form-control" name="Particulars2"></textarea>
                        </div>
                        <div class="form-group col-lg-12">
                            <label>Remarks:</label>
                            <textarea id="this_remarks" class="form-control" name="Remarks2"></textarea>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Region:</label>
                            <select class="form-control regionX2 no_edit" name="Region_IDX2">
                                <option id="this_region" value='' hidden selected>Select</option>
                                @foreach($regionX as $rx)
                                <option value='{{$rx->Region_ID}}'>{{$rx->Region_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Province:</label>
                            <select class="form-control provX2 no_edit" name="Province_IDX2">
                                <option id="this_province" value='' hidden selected>Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>City/Municipality:</label>
                            <select class="form-control cityX2 no_edit" name="City_Municipality_IDX2">
                                <option id="this_city" value='' hidden selected>Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Barangay:</label>
                            <select class="form-control brgyX2 no_edit" name="Barangay_IDX2">
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

<!-- Tagging  Modal -->
<div class="modal fade" id="tagXYZ" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Tag Entries</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="tagEntryXYZ" method="POST" action="{{ route('tag_bfas_disbursement_voucher') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <input id="this_B_IDx" value="" hidden name="B_IDx">
                <div class="modal-body Absolute-Center tagger">
                    <i class="fa fa-plus-square thisAdd" style="font-size: 25px"></i>
                    <div class="modal_input_container row dupli">
                        <div class="form-group col-lg-6">
                            <label>Obligation Request:</label>
                            <select class="form-control regionX2" name="tagObligation_Requests_ID[]">
                                <option id="this_region" value='' hidden selected>Select</option>
                                @foreach($obr as $o)
                                <option value='{{$o->Obligation_Request_ID}}'>{{$o->Obligation_Request_No}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn tagThis_XYZ modal_sb_button">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- End Tagging  Modal -->

<!-- Delete -->
<div id="deleteFile" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:30%;">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h5 style="color:salmon;">Are you sure you want to delete this Record ?</h5>
        </div>
        <div class="modal-footer">
            <form method="POST" action="{{ route('del_rec') }}"> @csrf

                <input id="del_ident" value="31" class="" name="del_ident" hidden>
                <input id="delFile" value="" class="" name="id_del" hidden>
                <button type="submit">Confirm</button>
            </form>
        </div>
      </div>
  
    </div>
</div>
<!-- End Delete -->

<!-- Delete2 -->
<div id="deleteFile2" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:30%;">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h5 style="color:salmon;">Are you sure you want to remove this Tagged Element ?</h5>
        </div>
        <div class="modal-footer">
            <form method="POST" action="{{ route('del_rec') }}"> @csrf

                <input id="del_ident2" value="41" class="" name="del_ident" hidden>
                <input id="delFile2" value="" class="" name="id_del" hidden>
                <button type="submit">Confirm</button>
            </form>
        </div>
      </div>
  
    </div>
</div>
<!-- End Delete2 -->

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

     // Side Bar Active
     $(document).ready(function() {
        $('.disbursementVoucher').addClass('active');
        $('.accounting_menu').addClass('active');
        $('.accounting_main').addClass('menu-open');
    });
</script>

@endsection