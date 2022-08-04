@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Accomplishment Status Maintenance/Setup </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;accomplishment status</li>
        </ol> 
    </div>
</div>
<div class="tableX_row col-md-12 up_marg5">
    <div class="flexer"> 
        <div class="eighty_split">{{$db_entries->appends(['db_entries' => $db_entries->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><button data-toggle="modal" data-target="#createAccomplishment_Status">New</button></div>
    </div>
    <div class="col-md-12">
        <table class="table-bordered table_gen up_marg5">
            <thead>
                <tr>
                    <th>Accomplishment_Status_ID </th>
                    <th>Accomplishment_Status_Name</th>
                    <th>Active</th>
                    <th>Encoder_ID</th>
                    <th>Date_Stamp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                    <tr>
                        <td class="sm_data_col txtCtr">{{$x->Accomplishment_Status_ID}}</td>
                        <td>{{$x->Accomplishment_Status_Name}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Encoder_ID}}</td>
                        <td class="md_data_col txtCtr">{{$x->Date_Stamp}}</td>
                        <td class="sm_data_col txtCtr">
                            <button class="edit_accomplishment_status" value="{{$x->Accomplishment_Status_ID}}" data-toggle="modal" data-target="#updateAccomplishment_Status">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Accomplishment_Status Modal -->
<div class="modal fade" id="createAccomplishment_Status" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Create Post</h4>
        </div>
        <form id="newBRGY_Accomplishment_Status" method="POST" action="{{ route('create_accomplishment_status_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Accomplishment_Status:</b></span><br>
                        <input class="modal_input1" name="Accomplishment_StatusX">
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
                <button type="button" class="btn postThis_Accomplishment_Status modal_sb_button">Create</button>
            </div>
        </form>
      </div>
      
    </div>
</div>

<!-- Create Accomplishment_Status END -->

<!-- Edit/Update Accomplishment_Status Modal -->
<div class="modal fade" id="updateAccomplishment_Status" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Create Post</h4>
        </div>
        <form id="updateBRGY_Accomplishment_Status" method="POST" action="{{ route('update_accomplishment_status_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Accomplishment_Status:</b></span><br>
                        <input id="this_accomplishment_status_idX" class="modal_input1" name="Accomplishment_Status_idX" hidden>
                        <input id="this_accomplishment_statusX" class="modal_input1" name="Accomplishment_StatusX2">
                    </div>

                    <div class="up_marg5">
                        <span><b>Active:</b></span><br>
                        <select class="modal_input1" name="ActiveX2">
                            <option id="this_accomplishment_status_active" value=1 hidden selected>Is Active?</option>
                            <option value=1>Yes</option>
                            <option value=0>No</option>
                        </select>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn updateThis_Accomplishment_Status modal_sb_button">Save</button>
            </div>
        </form>
      </div>
      
    </div>
</div>

<!-- Edit/Update Accomplishment_Status END -->

@endsection