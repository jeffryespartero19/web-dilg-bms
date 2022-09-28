@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bins.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Inventory </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;bins_inventory</li>
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
                    <th style="width:10%;">Inventory <br>ID</th>
                    <th>Stock No.</th>
                    <th style="width:10%;">Name</th>
                    <th>Item <br>Category</th>
                    <th>Unit of <br>Measure</th>
                    <th>Item <br>Status</th>
                    <th>Date <br>Recieved</th>
                    <th>Remarks</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                    <tr>
                        <td class="sm_data_col txtCtr">{{$x->Inventory_ID}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Stock_No}}</td>
                        <td>{{$x->Inventory_Name}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Item_Category_Name}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Unit_of_Measure}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Item_Status}}</td>
                        <td class="md_data_col txtCtr">{{$x->Date_Received}}</td>
                        <td class="md_data_col txtCtr">{{$x->Remarks}}</td>
                        <td class="md_data_col txtCtr">
                            {{$x->Barangay_Name}}, {{$x->City_Municipality_Name}} {{$x->Province_Name}} {{$x->Region_Name}}
                        </td>
                        <td class="sm_data_col txtCtr">
                            <button class="edit_XYZ" value="{{$x->Inventory_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
        <form id="newEntryXYZ" method="POST" action="{{ route('create_bins_inventory') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">

                    <div class="up_marg5">
                        <span><b>Stock No. :</b></span><br>
                        <input class="modal_input1" name="Stock_No" >
                    </div>

                    <div class="up_marg5">
                        <span><b>Name:</b></span><br>
                        <input class="modal_input1" name="Inventory_Name">
                    </div>

        
                    <div class="up_marg5">
                        <span><b>Card File:</b></span><br>
                        <select class="modal_input1" name="Card_File_ID">
                            <option value=0 hidden >Select</option>
                            @foreach($card_file as $cf)
                                <option value="{{$cf->Card_File_ID}}">{{$cf->Last_Name}}, {{$cf->First_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Item Category:</b></span><br>
                        <select class="modal_input1" name="Item_Category_ID">
                            <option value=0 hidden >Select</option>
                            @foreach($item_category_list as $icl)
                                <option value="{{$icl->Item_Category_ID}}">{{$icl->Item_Category_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Unit of Measure:</b></span><br>
                        <select class="modal_input1" name="Unit_of_Measure_ID">
                            <option value=0 hidden >Select</option>
                            @foreach($uom_list as $uom)
                                <option value="{{$uom->Unit_of_Measure_ID}}">{{$uom->Unit_of_Measure}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Item Status:</b></span><br>
                        <select class="modal_input1" name="Item_Status_ID">
                            <option value=0 hidden >Select</option>
                            @foreach($item_status_list as $isl)
                                <option value="{{$isl->Item_Status_ID}}">{{$isl->Item_Status}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Date Recieved:</b></span><br>
                        <input class="modal_input1" name="Date_Received" type="date" >
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
        <form id="updateEntryXYZ" method="POST" action="{{ route('update_bins_inventory') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <input id="this_identifier" value=12 hidden>
            <input id="this_idX" value="" hidden name="IDx">
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Stock No. :</b></span><br>
                        <input id="this_stock_no" class="modal_input1" name="Stock_No2" >
                    </div>

                    <div class="up_marg5">
                        <span><b>Name:</b></span><br>
                        <input id="this_inventory_name" class="modal_input1" name="Inventory_Name2">
                    </div>

        
                    <div class="up_marg5">
                        <span><b>Card File:</b></span><br>
                        <select class="modal_input1" name="Card_File_ID2">
                            <option id="this_card_file" value=0 hidden >Select</option>
                            @foreach($card_file as $cf)
                                <option value="{{$cf->Card_File_ID}}">{{$cf->Last_Name}}, {{$cf->First_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Item Category:</b></span><br>
                        <select class="modal_input1" name="Item_Category_ID2">
                            <option id="this_item_cartegory" value=0 hidden >Select</option>
                            @foreach($item_category_list as $icl)
                                <option value="{{$icl->Item_Category_ID}}">{{$icl->Item_Category_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Unit of Measure:</b></span><br>
                        <select class="modal_input1" name="Unit_of_Measure_ID2">
                            <option id="this_uom" value=0 hidden >Select</option>
                            @foreach($uom_list as $uom)
                                <option value="{{$uom->Unit_of_Measure_ID}}">{{$uom->Unit_of_Measure}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Item Status:</b></span><br>
                        <select class="modal_input1" name="Item_Status_ID2">
                            <option id="this_item_status" value=0 hidden >Select</option>
                            @foreach($item_status_list as $isl)
                                <option value="{{$isl->Item_Status_ID}}">{{$isl->Item_Status}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Date Recieved:</b></span><br>
                        <input id="this_date_recieved" class="modal_input1" name="Date_Received2" onfocus="(this.type='date')">
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