@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Check Status Cleared/Setup </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;bfas_check_status</li>
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
                    <th>Obligation <br>Request</th>
                    <th>Fund</th>
                    <th>As of</th>
                    <th>Officer <br>in Charge</th>
                    <th>Account</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                    <tr>
                        <td class="sm_data_col txtCtr">{{$x->Obligation_Request_No}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Fund_Type}}</td>
                        <td class="sm_data_col txtCtr">{{$x->SAAODBA_As_of}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Last_Name2}}, {{$x->First_Name2}} {{$x->Middle_Name2}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Account_Name}}</td>
       
                        <td class="sm_data_col txtCtr">
                            <button class="edit_XYZ" value="{{$x->SAAODBA_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
        <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_SAAODBA') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
               
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Obligation Request:</b></span><br>
                        <select class="modal_input1" name="Obligation_Request_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($obr as $o)
                                <option value={{$o->Obligation_Request_ID}}>{{$o->Obligation_Request_No}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Fund:</b></span><br>
                        <select class="modal_input1" name="Fund_Type_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($fundX as $fx)
                                <option value={{$fx->Fund_Type_ID}}>{{$fx->Fund_Type}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>As of:</b></span><br>
                        <input type="date" class="modal_input1" name="SAAODBA_As_of">
                    </div>

                    <div class="up_marg5">
                        <span><b>Officer in Charge:</b></span><br>
                        <select class="modal_input1" name="Brgy_Officials_and_Staff_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($oic as $xz)
                                <option value={{$xz->Card_File_ID}}>{{$xz->Last_Name}}, {{$xz->First_Name}} {{$xz->Middle_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Accounts:</b></span><br>
                        <select class="modal_input1" name="Accounts_Information_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($accounts as $acc)
                                <option value={{$acc->Accounts_Information_ID}}>{{$acc->Account_Name}}</option>
                            @endforeach
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
        <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_SAAODBA') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <input id="this_identifier" value=12 hidden>
            <input id="this_idX" value="" hidden name="IDx">
            <div class="modal-body Absolute-Center">
                
                <div class="modal_input_container">
                
                    <div class="up_marg5">
                        <span><b>Obligation Request:</b></span><br>
                        <select class="modal_input1" name="Obligation_Request_ID2">
                            <option id="this_obr" value='' hidden selected>Select</option>
                            @foreach($obr as $o)
                                <option value={{$o->Obligation_Request_ID}}>{{$o->Obligation_Request_No}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Fund:</b></span><br>
                        <select class="modal_input1" name="Fund_Type_ID2">
                            <option id="this_fund_type_id" value='' hidden selected>Select</option>
                            @foreach($fundX as $fx)
                                <option value={{$fx->Fund_Type_ID}}>{{$fx->Fund_Type}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>As of:</b></span><br>
                        <input id="this_asof" type="date" class="modal_input1" name="SAAODBA_As_of2">
                    </div>

                    <div class="up_marg5">
                        <span><b>Officer in Charge:</b></span><br>
                        <select class="modal_input1" name="Brgy_Officials_and_Staff_ID2">
                            <option id="this_oic" value='' hidden selected>Select</option>
                            @foreach($oic as $xz)
                                <option value={{$xz->Card_File_ID}}>{{$xz->Last_Name}}, {{$xz->First_Name}} {{$xz->Middle_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Accounts:</b></span><br>
                        <select class="modal_input1" name="Accounts_Information_ID2">
                            <option id="this_account" value='' hidden selected>Select</option>
                            @foreach($accounts as $acc)
                                <option value={{$acc->Accounts_Information_ID}}>{{$acc->Account_Name}}</option>
                            @endforeach
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
