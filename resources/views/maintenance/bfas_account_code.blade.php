@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Account Code Maintenance/Setup </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;bfas_account_code_maintenance</li>
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
                    <th>Account <br>Code ID </th>
                    <th>Expenditure <br>Type</th>
                    <th>Account Code</th>
                    <th>Active</th>
                    <th>Encoder ID</th>
                    <th>Date Stamp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                    <tr>
                        <td class="sm_data_col txtCtr">{{$x->Account_Code_ID}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Expenditure_Type}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Account_Code}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Encoder_ID}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Date_Stamp}}</td>
                        <td class="sm_data_col txtCtr">
                            <button class="edit_XYZ" value="{{$x->Account_Code_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
        <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_account_code_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Account Code:</b></span><br>
                        <input class="modal_input1" name="Account_Code">
                    </div>

                    <div class="up_marg5">
                        <span><b>Expenditure Type:</b></span><br>
                        <select class="modal_input1 regionX" name="Expenditure_Type_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($expenditure_type_list as $etl)
                                <option value='{{$etl->Expenditure_Type_ID}}' >{{$etl->Expenditure_Type}}</option>
                            @endforeach
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
        <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_account_code_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <input id="this_identifier" value=12 hidden>
            <input id="this_idX" value="" hidden name="IDx">
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Account Code:</b></span><br>
                        <input id="this_account_code" class="modal_input1" name="Account_Code2">
                    </div>

                    <div class="up_marg5">
                        <span><b>Expenditure Type:</b></span><br>
                        <select class="modal_input1 regionX" name="Expenditure_Type_ID2">
                            <option id="this_expenditure_type" value='' hidden selected>Select</option>
                            @foreach($expenditure_type_list as $etl)
                                <option value='{{$etl->Expenditure_Type_ID}}'>{{$etl->Expenditure_Type}}</option>
                            @endforeach
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
