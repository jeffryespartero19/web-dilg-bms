@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bins.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Physical Count </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;bins_physical_count</li>
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
                    <th>Physical Count ID </th>
                    <th>Item Category ID</th>
                    <th>Physical Count Inventory ID</th>
                    <th>Transaction No</th>
                    <th>Particulars</th>
                    <th>Brgy Official / Staff ID</th>
                    <th>Encoder ID</th>
                    <th>Date Stamp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                    <tr>
                        <td class="sm_data_col txtCtr">{{$x->Physical_Count_ID}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Item_Category_ID}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Physical_Count_Inventory_ID}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Transaction_No}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Particulars}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Brgy_Officials_and_Staff_ID}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Encoder_ID}}</td>
                        <td class="md_data_col txtCtr">{{$x->Date_Stamp}}</td>
                        <td class="sm_data_col txtCtr">
                            <button class="edit_XYZ" value="{{$x->Physical_Count_ID  }}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
        <form id="newEntryXYZ" method="POST" action="{{ route('create_bins_physical_count') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Physical Count Inventory:</b></span><br>
                        <select class="modal_input1" name="P_item_ID">
                            <option value=1 hidden selected>Select</option>
                            @foreach($P_inventory_list as $P_inv)
                                <option value="{{$P_inv->Physical_Count_Inventory_ID}}">Sample</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Item Category:</b></span><br>
                        <select class="modal_input1" name="item_category_ID">
                            <option value=1 hidden selected>Select</option>
                            @foreach($item_category_list as $icl)
                                <option value="{{$icl->Item_Category_ID}}">{{$icl->Item_Category_Name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Particulars:</b></span><br>
                        <textarea name="particulars" style="width:100%"></textarea>
                    </div>

                    <div class="up_marg5">
                        <span><b>Officer in Charge:</b></span><br>
                        <select class="modal_input1" name="oic">
                            <option value=1 hidden selected>Select</option>
                            @foreach($staff_list as $sl)
                                <option value="{{$sl->Brgy_Officials_and_Staff_ID}}">Sample</option>
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
        <form id="updateEntryXYZ" method="POST" action="{{ route('update_bins_physical_count') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <input id="this_identifier" value="9" hidden>
                    <input id="this_physical_count_IdX" class="modal_input1" name="Physical_Count_ID" hidden>
                    <div class="up_marg5">
                        <span><b>Physical Count Inventory:</b></span><br>
                        <select class="modal_input1" name="P_item_ID2">
                            <option id="this_p_inv" value=1 hidden selected>Select</option>
                            @foreach($P_inventory_list as $P_inv)
                                <option value="{{$P_inv->Physical_Count_Inventory_ID}}">Sample</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Item Category:</b></span><br>
                        <select class="modal_input1" name="item_category_ID2">
                            <option id="this_item_category" value=1 hidden selected>Select</option>
                            @foreach($item_category_list as $icl)
                                <option value="{{$icl->Item_Category_ID}}">{{$icl->Item_Category_Name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Particulars:</b></span><br>
                        <textarea id="this_particulars" name="particulars2" style="width:100%"></textarea>
                    </div>

                    <div class="up_marg5">
                        <span><b>Officer in Charge:</b></span><br>
                        <select class="modal_input1" name="oic2">
                            <option id="this_oic" value=1 hidden selected>Select</option>
                            @foreach($staff_list as $sl)
                                <option value="{{$sl->Brgy_Officials_and_Staff_ID}}">Sample</option>
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