@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Payment Collection/Setup </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;bfas_payment_collection</li>
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
<!-- Create Modal -->
<div class="modal fade" id="createXYZ" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Create New Entry</h4>
            </div>
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_payment_collection') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <div class="up_marg5">
                            <span><b>Payment Collection Number:</b></span><br>
                            <input class="modal_input1" name="Payment_Collection_Number">
                        </div>

                        <div class="up_marg5">
                            <span><b>Account Name:</b></span><br>
                            <select class="modal_input1" name="Accounts_Information_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($account_info as $account)
                                <option value={{$account->Accounts_Information_ID}}>{{$account->Account_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="up_marg5">
                            <span><b>Type of Fee:</b></span><br>
                            <select class="modal_input1" name="Type_of_Fee_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($type_fee as $fee)
                                <option value={{$fee->Type_of_Fee_ID}}>{{$fee->Type_of_Fee}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="up_marg5">
                            <span><b>OR Number:</b></span><br>
                            <input class="modal_input1" name="OR_No"></input>
                        </div>
                        <div class="up_marg5">
                            <span><b>OR Date:</b></span><br>
                            <input class="modal_input1" name="OR_Date" type="date"></input>
                        </div>
                        <div class="up_marg5">
                            <span><b>Cash Tendered:</b></span><br>
                            <input class="modal_input1" name="Cash_Tendered"></input>
                        </div>
                        <div class="up_marg5">
                            <span><b>Remarks:</b></span><br>
                            <textarea class="modal_input1" name="Remarks"></textarea>
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
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Update Entry</h4>
        </div>
        <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_payment_collection') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <input id="this_identifier" value=9 hidden>
            <input id="this_idX" value="" hidden name="IDx">
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Payment Collection Number:</b></span><br>
                        <input id="this_payment_collection_number" class="modal_input1" name="Payment_Collection_Number2">
                    </div>

                    <div class="up_marg5">
                        <span><b>Account Name:</b></span><br>
                        <select class="modal_input1" name="Accounts_Information_ID2">
                            <option id="this_account_name" value='' hidden selected>Select</option>
                            @foreach($account_info as $account)
                                <option value={{$account->Accounts_Information_ID}}>{{$account->Account_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Type of Fee:</b></span><br>
                        <select class="modal_input1" name="Type_of_Fee_ID2">
                            <option id="this_type_of_fee" value='' hidden selected>Select</option>
                            @foreach($type_fee as $fee)
                                <option value={{$fee->Type_of_Fee_ID}}>{{$fee->Type_of_Fee}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>OR Number:</b></span><br>
                        <input id="this_or_number" class="modal_input1" name="OR_No2"></input>
                    </div>
                    <div class="up_marg5">
                        <span><b>OR Date:</b></span><br>
                        <input id="this_or_date" class="modal_input1" name="OR_Date2" type="date"></input>
                    </div>
                    <div class="up_marg5">
                        <span><b>Cash Tendered:</b></span><br>
                        <input id="this_cash_tendered" class="modal_input1" name="Cash_Tendered2"></input>
                    </div>
                    <div class="up_marg5">
                        <span><b>Remarks:</b></span><br>
                        <textarea id="this_remarks" class="modal_input1" name="Remarks2"></textarea>
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