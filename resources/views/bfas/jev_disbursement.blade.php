@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> JEV Disbursement/Setup </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;bfas_jev_disbursement</li>
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
                    <th>Journal <br>Number</th>
                    <th style="width:20%">Bank <br>Account</th>
                    <th>Journal <br>Type</th>
                    <th>Fund <br>Type</th>
                    <th style="width:25%">Location</th>

                    <th>Particulars</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                    <tr>
                        <td class="sm_data_col txtCtr">{{$x->Journal_Number}}</td>
                        <td>
                            <table>
                                <tr>
                                    <td><b>Name:</b></td>
                                    <td>{{$x->Bank_Account_Name}}</td>
                                </tr>
                                <tr>
                                    <td><b>No.</b></td>
                                    <td>{{$x->Bank_Account_No}}</td>
                                </tr>
                            </table>
                        </td>
                        <td class="sm_data_col txtCtr">{{$x->Journal_Type}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Fund_Type}}</td>
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
                        <td class="sm_data_col txtCtr">
                            <button class="edit_XYZ" value="{{$x->JEV_Disbursement_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
        <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_jev_disbursement') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">

                    <div class="up_marg5">
                        <div class="up_marg5">
                            <span><b>Journal Number:</b></span><br>
                            <input class="modal_input1" name="Journal_Number">
                        </div>
                    </div>
                    <div class="up_marg5">
                    <span><b>Bank Account:</b></span><br>
                        <select class="modal_input1" name="Bank_Account_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($bank_acc as $bac)
                                <option value={{$bac->Bank_Account_ID}}>{{$bac->Bank_Account_Name}}-({{$bac->Bank_Account_No}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Journal Type:</b></span><br>
                        <select class="modal_input1" name="Journal_Type_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($journal_type as $jt)
                                <option value={{$jt->Journal_Type_ID}}>{{$jt->Journal_Type}}</option>
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
                        <span><b>Particulars:</b></span><br>
                        <textarea class="modal_input1" name="Particulars"></textarea>
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
                    
                    <div class="up_marg5">
                        <span><b>Active:</b></span><br>
                        <select class="modal_input1" name="ActiveX">
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
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Update Entry</h4>
        </div>
        <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_jev_disbursement') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <input id="this_identifier" value=4 hidden>
            <input id="this_idX" value="" hidden name="IDx">
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Journal Number:</b></span><br>
                        <input id="this_journal_number" class="modal_input1" name="Journal_Number2">
                    </div>

                    <div class="up_marg5">
                        <span><b>Bank Account:</b></span><br>
                        <select class="modal_input1" name="Bank_Account_ID2">
                            <option id="this_bank_account" value='' hidden selected>Select</option>
                            @foreach($bank_acc as $bac)
                                <option value={{$bac->Bank_Account_ID}}>{{$bac->Bank_Account_Name}}-({{$bac->Bank_Account_No}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Journal Type:</b></span><br>
                        <select class="modal_input1" name="Journal_Type_ID2">
                            <option id="this_journal_Type" value='' hidden selected>Select</option>
                            @foreach($journal_type as $jt)
                                <option value={{$jt->Journal_Type_ID}}>{{$jt->Journal_Type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Fund Type:</b></span><br>
                        <select class="modal_input1" name="Fund_Type_ID2">
                            <option id="this_fund_Type" value='' hidden selected>Select</option>
                            @foreach($fund_type as $ft)
                                <option value={{$ft->Fund_Type_ID}}>{{$ft->Fund_Type}}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="up_marg5">
                        <span><b>Particulars:</b></span><br>
                        <textarea id="this_particulars" class="modal_input1" name="Particulars2"></textarea>
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
    
                    <div class="up_marg5">
                        <span><b>Active:</b></span><br>
                        <select class="modal_input1" name="ActiveX2">
                            <option id="this_active"  value=1 hidden selected>Is Active?</option>
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
