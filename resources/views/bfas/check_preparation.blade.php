@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Check Preparation/Setup </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;bfas_check_preparation</li>
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
                        <td class="sm_data_col txtCtr">{{$x->Check_Preparation_ID	}}</td>
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

<!-- Create Modal -->
<div class="modal fade" id="createXYZ" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Create New Entry</h4>
        </div>
        <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_check_preparation') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
               
                <div class="modal_input_container">
                    {{-- <div class="up_marg5">
                        <span><b>Check Preparation ID:</b></span><br>
                        <input class="modal_input1" name="Check_Preparation_ID">
                    </div> --}}
    
                    <div class="up_marg5">
                        <span><b>Particulars:</b></span><br>
                        <textarea  class="modal_input1" name="Particulars"></textarea>
                    </div>
    
                    <div class="up_marg5">
                        <span><b>Baranggay and Staff ID:</b></span><br>
                        <select class="modal_input1" name="Brgy_Officials_and_Staff_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($brgy_OS as $brgy_os)
                                <option value={{$brgy_os->Brgy_Officials_and_Staff_ID}}>{{$brgy_os->Brgy_Officials_and_Staff_ID}}</option>
                            @endforeach
                        </select>
                    </div>
    
    
                    <div class="up_marg5">
                        <span><b>Disbursement Voucher ID:</b></span><br>
                        <select class="modal_input1" name="Disbursement_Voucher_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($disbursement_voucher as $dv)
                                <option value={{$dv->Disbursement_Voucher_ID}}>{{$dv->Disbursement_Voucher_ID}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="up_marg5">
                        <span><b>Voucher_Status_ID	:</b></span><br>
                        <select class="modal_input1" name="Voucher_Status_ID">
                            <option  value='' hidden selected>Select</option>
                            @foreach($voucher_status as $vs)
                                <option value={{$vs->Voucher_Status_ID}}>{{$vs->Voucher_Status_ID	}}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="up_marg5">
                        <span><b>Amount:</b></span><br>
                        <input class="modal_input1" name="Amount">
                    </div>
    
                    <div class="up_marg5">
                        <span><b>Bank Account ID:</b></span><br>
                        <select class="modal_input1" name="Bank_Account_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($bank_acc as $bac)
                                <option value={{$bac->Bank_Account_ID}}>{{$bac->Bank_Account_Name}}-({{$bac->Bank_Account_No}})</option>
                            @endforeach
                        </select>
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
    
    
                    {{-- <div class="up_marg5">
                        <span><b>Active:</b></span><br>
                        <select class="modal_input1" name="ActiveX">
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
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Update Entry</h4>
        </div>
        <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_check_preparation') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <input id="this_identifier" value=6 hidden>
            <input id="this_idX" value="" hidden name="IDx">
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    {{-- <div class="up_marg5">
                        <span><b>Check Preparation ID:</b></span><br>
                        <input id="this_" class="modal_input1" name="Check_Preparation_ID">
                    </div> --}}
    
                    <div class="up_marg5">
                        <span><b>Particulars:</b></span><br>
                        <textarea id="this_particulars" class="modal_input1" name="Particulars2"></textarea>
                    </div>
    
                    <div class="up_marg5">
                        <span><b>Baranggay and Staff ID:</b></span><br>
                        <select class="modal_input1" name="Brgy_Officials_and_Staff_ID2">
                            <option id="this_brgy_OS" value='' hidden selected>Select</option>
                            @foreach($brgy_OS as $brgy_os)
                                <option value={{$brgy_os->Brgy_Officials_and_Staff_ID}}>{{$brgy_os->Brgy_Officials_and_Staff_ID}}</option>
                            @endforeach
                        </select>
                    </div>
    
    
                    <div class="up_marg5">
                        <span><b>Disbursement Voucher ID:</b></span><br>
                        <select class="modal_input1" name="Disbursement_Voucher_ID2">
                            <option id="this_disbursement_voucher" value='' hidden selected>Select</option>
                            @foreach($disbursement_voucher as $dv)
                                <option value={{$dv->Disbursement_Voucher_ID}}>{{$dv->Disbursement_Voucher_ID}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="up_marg5">
                        <span><b>Voucher_Status_ID	:</b></span><br>
                        <select class="modal_input1" name="Voucher_Status_ID2">
                            <option id="this_voucher_status" value='' hidden selected>Select</option>
                            @foreach($voucher_status as $vs)
                                <option value={{$vs->Voucher_Status_ID}}>{{$vs->Voucher_Status_ID	}}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="up_marg5">
                        <span><b>Amount:</b></span><br>
                        <input id="this_amount" class="modal_input1" name="Amount2">
                    </div>
    
                    <div class="up_marg5">
                        <span><b>Bank Account ID:</b></span><br>
                        <select class="modal_input1" name="Bank_Account_ID2">
                            <option id="this_bank_account" value='' hidden selected>Select</option>
                            @foreach($bank_acc as $bac)
                                <option value={{$bac->Bank_Account_ID}}>{{$bac->Bank_Account_Name}}-({{$bac->Bank_Account_No}})</option>
                            @endforeach
                        </select>
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
    
    
                    {{-- <div class="up_marg5">
                        <span><b>Active:</b></span><br>
                        <select class="modal_input1" name="ActiveX">
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
