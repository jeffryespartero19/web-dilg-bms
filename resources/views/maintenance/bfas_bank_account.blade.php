@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Bank Account Maintenance/Setup </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;bfas_bank_account_maintenance</li>
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

<!-- Create Modal -->
<div class="modal fade" id="createXYZ" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Create New Entry</h4>
        </div>
        <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_bank_account_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Bank Account Code:</b></span><br>
                        <input class="modal_input1" name="Bank_Account_Code">
                    </div>
                    <div class="up_marg5">
                        <span><b>Bank Account No</b></span><br>
                        <input class="modal_input1" name="Bank_Account_No">
                    </div>
                    <div class="up_marg5">
                        <span><b>Bank Account Name:</b></span><br>
                        <input class="modal_input1" name="Bank_Account_Name">
                    </div>

                    <div class="up_marg5">
                        <span><b>Check Number From:</b></span><br>
                        <input class="modal_input1" name="Check_Number_From">
                    </div>
                    <div class="up_marg5">
                        <span><b>Check Number To:</b></span><br>
                        <input class="modal_input1" name="Check_Number_To">
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
        <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_bank_account_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <input id="this_identifier" value=5 hidden>
            <input id="this_idX" value="" hidden name="IDx">
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Bank Account Code:</b></span><br>
                        <input id="this_bcode" class="modal_input1" name="Bank_Account_Code2">
                    </div>
                    <div class="up_marg5">
                        <span><b>Bank Account No</b></span><br>
                        <input id="this_bno" class="modal_input1" name="Bank_Account_No2">
                    </div>
                    <div class="up_marg5">
                        <span><b>Bank Account Name:</b></span><br>
                        <input id="this_bname" class="modal_input1" name="Bank_Account_Name2">
                    </div>

                    <div class="up_marg5">
                        <span><b>Check Number From:</b></span><br>
                        <input id="this_cn_from"class="modal_input1" name="Check_Number_From2">
                    </div>
                    <div class="up_marg5">
                        <span><b>Check Number To:</b></span><br>
                        <input id="this_cn_to" class="modal_input1" name="Check_Number_To2">
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
