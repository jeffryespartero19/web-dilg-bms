@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bins.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Item Inspection </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;bins_item_inspection</li>
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
                    <th>Item Inspection ID </th>
                    <th>Received Item ID</th>
                    <th>Item Name</th>
                    <th>Markings</th>
                    <th>Serial No</th>
                    <th>Item Status ID</th>
                    <th>Inspection Date</th>
                    <th>Encoder ID</th>
                    <th>Date Stamp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                    <tr>
                        <td class="sm_data_col txtCtr">{{$x->Item_Inspection_ID }}</td>
                        <td class="sm_data_col txtCtr">{{$x->Received_Item_ID}}</td>
                        <td></td>
                        <td class="sm_data_col txtCtr">{{$x->Markings}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Serial_No}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Item_Status_ID}}</td>
                        <td class="md_data_col txtCtr">{{$x->Inspection_Date}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Encoder_ID}}</td>
                        <td class="md_data_col txtCtr">{{$x->Date_Stamp}}</td>
                        <td class="sm_data_col txtCtr">
                            <button class="edit_XYZ" value="{{$x->Item_Inspection_ID }}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create  Modal -->
<div class="modal fade" id="createXYZ" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Create New Entry</h4>
        </div>
        <form id="newEntryXYZ" method="POST" action="{{ route('create_bins_item_inspection') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Received Item:</b></span><br>
                        <select class="modal_input1" name="item_rc_ID">
                            <option value=1 hidden selected>Select</option>
                            @foreach($RC_item_list as $ril)
                                <option value="{{$ril->Received_Item_ID}}">Sample</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Markings:</b></span><br>
                        <input class="modal_input1" name="markingsX">
                    </div>

                    <div class="up_marg5">
                        <span><b>Serial No:</b></span><br>
                        <input class="modal_input1" name="serialNoX">
                    </div>

                    <div class="up_marg5">
                        <span><b>Item Status:</b></span><br>
                        <select class="modal_input1" name="item_status_ID">
                            <option value=1 hidden selected>Select</option>
                            @foreach($item_status_list as $isl)
                                <option value="{{$isl->Item_Status_ID}}">{{$isl->Item_Status}}</option>
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
        <form id="updateEntryXYZ" method="POST" action="{{ route('update_bins_item_inspection') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <input id="this_identifier" value="7" hidden>
                    <input id="this_item_inspection_IdX" class="modal_input1" name="Item_Inspection_ID" hidden>
                    <div class="up_marg5">
                        <span><b>Received Item:</b></span><br>
                        <select class="modal_input1" name="item_rc_ID2">
                            <option id="this_rci_idX" value="" hidden selected>Select</option>
                            @foreach($RC_item_list as $ril)
                                <option value="{{$ril->Received_Item_ID}}">Sample</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Markings:</b></span><br>
                        <input id="this_markingsX" class="modal_input1" name="markingsX2">
                    </div>

                    <div class="up_marg5">
                        <span><b>Serial No:</b></span><br>
                        <input id="this_serial_noX" class="modal_input1" name="serialNoX2">
                    </div>

                    <div class="up_marg5">
                        <span><b>Item Status:</b></span><br>
                        <select class="modal_input1" name="item_status_ID2">
                            <option id="this_item_statusX" value="" hidden selected>Select</option>
                            @foreach($item_status_list as $isl)
                                <option value="{{$isl->Item_Status_ID}}">{{$isl->Item_Status}}</option>
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

<!-- Edit/Update  END -->

@endsection