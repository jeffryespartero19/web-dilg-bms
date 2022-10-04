@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ">Disbursement_Voucher/Setup </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;bfas_disbursement_voucher</li>
        </ol> 
    </div>
</div>
<div class="tableX_row col-md-12 up_marg5">
    <div class="flexer"> 
        <div class="eighty_split">{{$db_entries->appends(['db_entries' => $db_entries->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><button data-toggle="modal" data-target="#createXYZ">New</button></div>
    </div>
    <div class="col-md-12">
        <table class="table-bordered table_gen up_marg5">
            <thead>
                <tr>
                    <th>Transaction No</th>
                    <th>Voucher No</th>
                    <th>Appropriation</th>
                    <th>Fund</th>
                    <th>Tax Code</th>
                    <th>Payee</th>
                    <th>Officer <br>in Charge</th>
                    <th>Status</th>
                    <th>Purpose</th>
                    <th style="width:15%">Location</th>

                    <th>Particulars</th>
                    <th>Remarks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                    <tr>
                        <td class="sm_data_col txtCtr">{{$x->Transaction_No}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Voucher_No}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Appropriation_Type}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Fund_Type}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Description}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Last_Name}}, {{$x->First_Name}} {{$x->Middle_Name}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Last_Name2}}, {{$x->First_Name2}} {{$x->Middle_Name2}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Voucher_Status}}</td>
                        <td class="sm_data_col txtCtr">
                            @if($x->For_Liquidation==1) For Liquidation @endif
                            @if($x->For_Payroll==1)  For Payroll @endif
                            @if($x->For_Cash_Advance==1)  For Cash Advance @endif
                            @if($x->Disbursement_Check==1)  Check Disbursement @endif
                            @if($x->Disbursement_Cash==1)  Cash Disbursement @endif
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createXYZ" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Create New Entry</h4>
        </div>
        <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_disbursement_voucher') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">

                    <div class="up_marg5">
                        <div class="up_marg5">
                            <span><b>Transaction No:</b></span><br>
                            <input class="modal_input1" name="Transaction_No">
                        </div>
                        <div class="up_marg5">
                            <span><b>Voucher No:</b></span><br>
                            <input class="modal_input1" name="Voucher_No">
                        </div>
                    </div>
                    <div class="up_marg5">
                        <span><b>Appropriation:</b></span><br>
                        <select class="modal_input1" name="Appropriation_Type_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($app_type as $apt)
                                <option value={{$apt->Appropriation_Type_ID}}>{{$apt->Appropriation_Type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Fund Type:</b></span><br>
                        <select class="modal_input1" name="Fund_Type_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($fund_type as $ft)
                                <option value={{$ft->Fund_Type_ID}}>{{$ft->Fund_Type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Tax Code:</b></span><br>
                        <select class="modal_input1" name="Tax_Code_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($tax_code as $tc)
                                <option value={{$tc->Tax_Code_ID}}>{{$tc->Description}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Status:</b></span><br>
                        <select class="modal_input1" name="Disbursement_Voucher_Status_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($dv_status as $dvs)
                                <option value={{$dvs->Voucher_Status_ID}}>{{$dvs->Voucher_Status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Payee:</b></span><br>
                        <select class="modal_input1" name="Card_File_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($card_file as $cf)
                                <option value={{$cf->Card_File_ID}}>{{$cf->Last_Name}}, {{$cf->First_Name}} {{$cf->Middle_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Officer in Charge:</b></span><br>
                        <select class="modal_input1" name="Brgy_Officials_and_Staff_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($card_file as $cf)
                                <option value={{$cf->Card_File_ID}}>{{$cf->Last_Name}}, {{$cf->First_Name}} {{$cf->Middle_Name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Purpose:</b></span><br>
                        <select class="modal_input1" name="Purpose">
                            <option value='' hidden selected>Select</option>
                            <option value='1'>For Liquidation</option>
                            <option value='2'>For Payroll</option>
                            <option value='3'>For Cash Advance</option>
                            <option value='4'>Disbursement Check</option>
                            <option value='5'>Disbursement Cash</option>
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Particulars:</b></span><br>
                        <textarea class="modal_input1" name="Particulars"></textarea>
                    </div>
                    <div class="up_marg5">
                        <span><b>Remarks:</b></span><br>
                        <textarea class="modal_input1" name="Remarks"></textarea>
                    </div>

                    <div class="up_marg5">
                        <span><b>Region:</b></span><br>
                        <select class="modal_input1 regionX" name="Region_IDX">
                            <option value='' hidden selected>Select</option>
                            @foreach($regionX as $rx)
                                <option value='{{$rx->Region_ID}}' >{{$rx->Region_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Province:</b></span><br>
                        <select class="modal_input1 provX" name="Province_IDX">
                            <option value='' hidden selected>Select</option>
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>City/Municipality:</b></span><br>
                        <select class="modal_input1 cityX" name="City_Municipality_IDX">
                            <option value='' hidden selected>Select</option>
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Barangay:</b></span><br>
                        <select class="modal_input1 brgyX" name="Barangay_IDX">
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
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Update Entry</h4>
        </div>
        <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_disbursement_voucher') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <input id="this_identifier" value=5 hidden>
            <input id="this_idX" value="" hidden name="IDx">
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <<div class="up_marg5">
                        <div class="up_marg5">
                            <span><b>Transaction No:</b></span><br>
                            <input id="this_transaction_no" class="modal_input1" name="Transaction_No2">
                        </div>
                        <div class="up_marg5">
                            <span><b>Voucher No:</b></span><br>
                            <input id="this_voucher_no" class="modal_input1" name="Voucher_No2">
                        </div>
                    </div>
                    <div class="up_marg5">
                        <span><b>Appropriation:</b></span><br>
                        <select class="modal_input1" name="Appropriation_Type_ID2">
                            <option id="this_appropriation_type_id" value='' hidden selected>Select</option>
                            @foreach($app_type as $apt)
                                <option value={{$apt->Appropriation_Type_ID}}>{{$apt->Appropriation_Type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Fund Type:</b></span><br>
                        <select class="modal_input1" name="Fund_Type_ID2">
                            <option id="this_fund_type_id" value='' hidden selected>Select</option>
                            @foreach($fund_type as $ft)
                                <option value={{$ft->Fund_Type_ID}}>{{$ft->Fund_Type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Tax Code:</b></span><br>
                        <select class="modal_input1" name="Tax_Code_ID2">
                            <option id="this_tax_code_id" value='' hidden selected>Select</option>
                            @foreach($tax_code as $tc)
                                <option value={{$tc->Tax_Code_ID}}>{{$tc->Description}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Status:</b></span><br>
                        <select class="modal_input1" name="Disbursement_Voucher_Status_ID2">
                            <option id="this_voucher_status_id" value='' hidden selected>Select</option>
                            @foreach($dv_status as $dvs)
                                <option value={{$dvs->Voucher_Status_ID}}>{{$dvs->Voucher_Status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Payee:</b></span><br>
                        <select class="modal_input1" name="Card_File_ID2">
                            <option id="this_card_file_id" value='' hidden selected>Select</option>
                            @foreach($card_file as $cf)
                                <option value={{$cf->Card_File_ID}}>{{$cf->Last_Name}}, {{$cf->First_Name}} {{$cf->Middle_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Officer in Charge:</b></span><br>
                        <select class="modal_input1" name="Brgy_Officials_and_Staff_ID2">
                            <option id="this_brgy_officials_and_staff_id" value='' hidden selected>Select</option>
                            @foreach($card_file as $cf)
                                <option value={{$cf->Card_File_ID}}>{{$cf->Last_Name}}, {{$cf->First_Name}} {{$cf->Middle_Name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Purpose:</b></span><br>
                        <select class="modal_input1" name="Purpose2">
                            <option id="this_purpose" value='' hidden selected>Select</option>
                            <option value='1'>For Liquidation</option>
                            <option value='2'>For Payroll</option>
                            <option value='3'>For Cash Advance</option>
                            <option value='4'>Disbursement Check</option>
                            <option value='5'>Disbursement Cash</option>
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Particulars:</b></span><br>
                        <textarea id="this_particulars" class="modal_input1" name="Particulars2"></textarea>
                    </div>
                    <div class="up_marg5">
                        <span><b>Remarks:</b></span><br>
                        <textarea id="this_remarks" class="modal_input1" name="Remarks2"></textarea>
                    </div>
    
                    <div class="up_marg5">
                        <span><b>Region:</b></span><br>
                        <select class="modal_input1 regionX2" name="Region_IDX2">
                            <option id="this_region" value='' hidden selected>Select</option>
                            @foreach($regionX as $rx)
                                <option value='{{$rx->Region_ID}}' >{{$rx->Region_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Province:</b></span><br>
                        <select class="modal_input1 provX2" name="Province_IDX2">
                            <option id="this_province" value='' hidden selected>Select</option>
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>City/Municipality:</b></span><br>
                        <select class="modal_input1 cityX2" name="City_Municipality_IDX2">
                            <option id="this_city" value='' hidden selected>Select</option>
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Barangay:</b></span><br>
                        <select class="modal_input1 brgyX2" name="Barangay_IDX2">
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
