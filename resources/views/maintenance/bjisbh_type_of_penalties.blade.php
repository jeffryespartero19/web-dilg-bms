@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Type Of Penalties Maintenance/Setup </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;Type Of Penalties</li>
        </ol> 
    </div>
</div>
<div class="tableX_row col-md-12 up_marg5">
    <div class="flexer"> 
        <div class="eighty_split">{{$db_entries->appends(['db_entries' => $db_entries->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><button data-toggle="modal" data-target="#createType_of_Penalties">New</button></div>
    </div>
    <div class="col-md-12">
        <table class="table-bordered table_gen up_marg5">
            <thead>
                <tr>
                    <th>Types_of_Penalties_ID </th>
                    <th>Type_of_Penalties</th>
                    <th>Active</th>
                    <th>Encoder_ID</th>
                    <th>Date_Stamp</th>
                    <th>Penaltiess</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                    <tr>
                        <td class="sm_data_col txtCtr">{{$x->Types_of_Penalties_ID}}</td>
                        <td>{{$x->Type_of_Penalties}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Encoder_ID}}</td>
                        <td class="md_data_col txtCtr">{{$x->Date_Stamp}}</td>
                        <td class="sm_data_col txtCtr">
                            <button class="edit_type_of_penalties" value="{{$x->Types_of_Penalties_ID}}" data-toggle="modal" data-target="#updateType_of_Penalties">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Type_of_Penalties Modal -->
<div class="modal fade" id="createType_of_Penalties" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Create Post</h4>
        </div>
        <form id="newBRGY_Type_of_Penalties" method="POST" action="{{ route('create_type_of_penalties_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Type_of_Penalties:</b></span><br>
                        <input class="modal_input1" name="Type_of_PenaltiesX">
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
                <button type="button" class="btn postThis_Type_of_Penalties modal_sb_button">Create</button>
            </div>
        </form>
      </div>
      
    </div>
</div>

<!-- Create Type_of_Penalties END -->

<!-- Edit/Update Type_of_Penalties Modal -->
<div class="modal fade" id="updateType_of_Penalties" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Create Post</h4>
        </div>
        <form id="updateBRGY_Type_of_Penalties" method="POST" action="{{ route('update_type_of_penalties_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Type_of_Penalties:</b></span><br>
                        <input id="this_type_of_penalties_idX" class="modal_input1" name="Types_of_Penalties_idX" hidden>
                        <input id="this_type_of_penaltiesX" class="modal_input1" name="Type_of_PenaltiesX2">
                    </div>

                    <div class="up_marg5">
                        <span><b>Active:</b></span><br>
                        <select class="modal_input1" name="ActiveX2">
                            <option id="this_type_of_penalties_active" value=1 hidden selected>Is Active?</option>
                            <option value=1>Yes</option>
                            <option value=0>No</option>
                        </select>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn updateThis_Type_of_Penalties modal_sb_button">Save</button>
            </div>
        </form>
      </div>
      
    </div>
</div>

<!-- Edit/Update Type_of_Penalties END -->

@endsection