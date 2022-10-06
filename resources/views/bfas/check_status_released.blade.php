@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Check Status Released/Setup </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;bfas_jev_collection</li>
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
                    <th>Released <br>Date</th>
                    <th>Received <br>By</th>
                    <th>ID <br> Presented</th>
                    <th>ID <br> Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr">{{$x->Check_Preparation_ID}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Released_Date}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Received_by}}</td>


                    <td class="sm_data_col txtCtr">{{$x->ID_Presented}}</td>
                    <td class="sm_data_col txtCtr">{{$x->ID_Number}}</td>
                    <td class="sm_data_col txtCtr">
                        <button class="edit_XYZ" value="{{$x->Check_Status_Released_ID }}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_check_status_released') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">

                    <div class="up_marg5">
                            <span><b>Check Preparation ID:</b></span><br>
                            <select class="modal_input1" name="Check_Preparation_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($check_prep as $check)
                                <option value={{$check->Check_Preparation_ID}}>{{$check->Check_Preparation_ID}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="up_marg5">
                            <span><b>Released Date:</b></span><br>
                            <input class="modal_input1" name="Released_Date" type="date"></input>
                        </div>
                        <div class="up_marg5">
                            <span><b>Received By:</b></span><br>
                            <input class="modal_input1" name="Received_by">
                        </div>
                        <div class="up_marg5">
                            <span><b>ID Presented:</b></span><br>
                            <input class="modal_input1" name="ID_Presented">
                        </div>
                        <div class="up_marg5">
                            <span><b>ID Number:</b></span><br>
                            <input class="modal_input1" name="ID_Number">
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
        <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_check_status_released') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <input id="this_identifier" value=8 hidden>
            <input id="this_idX" value="" hidden name="IDx">
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                            <span><b>Check Preparation ID:</b></span><br>


                            <select class="modal_input1" name="Check_Preparation_ID2">
                            <option id="this_check_preparation_id" value='' hidden selected>Select</option>
                            @foreach($check_prep as $check)
                                <option value={{$check->Check_Preparation_ID}}>{{$check->Check_Preparation_ID}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="up_marg5">
                            <span><b>Released Date:</b></span><br>
                            <input id="this_released_date" class="modal_input1" name="Released_Date2" type="date"></input>
                        </div>

                        <div class="up_marg5">
                            <span><b>Received By:</b></span><br>
                            <input id="this_received_by" class="modal_input1" name="Received_by2">
                        </div>
                        <div class="up_marg5">
                            <span><b>ID Presented:</b></span><br>
                            <input id="this_id_presented" class="modal_input1" name="ID_Presented2">
                        </div>
                        <div class="up_marg5">
                            <span><b>ID Number:</b></span><br>
                            <input id="this_id_number" class="modal_input1" name="ID_Number2">
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