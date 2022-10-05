@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ">Obligation Request /Setup </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;bfas_obligation_request </li>
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
                    <th>Request No</th>
                    <th>Purchase Order No</th>
                    <th>Payee</th>
                    <th>Fund</th>
                    <th>Request Date</th>
                    <th>Request Status</th>
                    <th>Budget Appropriation</th>
                    
                    <th>Officer <br>in Charge</th>
                    <th style="width:15%">Location</th>

                    <th>Remarks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                    <tr>
                        <td class="sm_data_col txtCtr">{{$x->Obligation_Request_No}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Purchase_Order_No}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Last_Name}}, {{$x->First_Name}} {{$x->Middle_Name}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Fund_Type}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Obligation_Request_Date}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Obligation_Request_Status}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Budget_Appropriation_ID}}</td>
                        
                        <td class="sm_data_col txtCtr">{{$x->Last_Name2}}, {{$x->First_Name2}} {{$x->Middle_Name2}}</td>
                        
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

                        <td class="sm_data_col txtCtr">{{$x->Remarks}}</td>
                        <td class="sm_data_col txtCtr">
                            <button class="edit_XYZ" value="{{$x->Obligation_Request_ID }}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
        <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_obligation_request') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <div class="up_marg5">
                            <span><b>Obligation Request No:</b></span><br>
                            <input class="modal_input1" name="Obligation_Request_No">
                        </div>
                        <div class="up_marg5">
                            <span><b>Purchase Order No:</b></span><br>
                            <input class="modal_input1" name="Purchase_Order_No">
                        </div>
                    </div>
                    <div class="up_marg5">
                        <span><b>Payee:</b></span><br>
                        <select class="modal_input1" name="Card_File_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($card_file as $cf)
                                <option value={{$cf->Card_File_ID}}>{{$cf->Last_Name}}, {{$cf->First_Name}} {{$cf->Middle_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Fund Type:</b></span><br>
                        <select class="modal_input1" name="Fund_Type_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($fund_type as $ft)
                                <option value={{$ft->Fund_Type_ID}}>{{$ft->Fund_Type}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Obligation Request Date:</b></span><br>
                        <input type="date" class="modal_input1" name="Obligation_Request_Date">
                    </div>
                    <div class="up_marg5">
                        <span><b>Request Status:</b></span><br>
                        <select class="modal_input1" name="Obligation_Request_Status_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($obr_status as $obs)
                                <option value={{$obs->Obligation_Request_Status_ID}}>{{$obs->Obligation_Request_Status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Budget Appropriation:</b></span><br>
                        <select class="modal_input1" name="Budget_Appropriation_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($b_app as $bp)
                                <option value={{$bp->Budget_Appropriation_ID}}>{{$bp->Appropriation_No}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="up_marg5">
                        <span><b>Officer in Charge:</b></span><br>
                        <select class="modal_input1" name="Brgy_Officials_and_Staff_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($card_file as $cf)
                                <option value={{$cf->Card_File_ID}}>{{$cf->Last_Name}}, {{$cf->First_Name}} {{$cf->Middle_Name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Remarks:</b></span><br>
                        <textarea class="modal_input1" name="Remarks"></textarea>
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
        <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_obligation_request') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <input id="this_identifier" value=11 hidden>
            <input id="this_idX" value="" hidden name="IDx">
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                
                    <div class="up_marg5">
                        <span><b>Obligation Request No:</b></span><br>
                        <input id="this_OR_no" class="modal_input1" name="Obligation_Request_No2">
                    </div>
                    <div class="up_marg5">
                        <span><b>Purchase Order No:</b></span><br>
                        <input id="this_PO_no" class="modal_input1" name="Purchase_Order_No2">
                    </div>

                    <div class="up_marg5">
                        <span><b>Payee:</b></span><br>
                        <select class="modal_input1" name="Card_File_ID2">
                            <option id="this_card_file_id" value='' hidden selected>Select</option>
                            @foreach($card_file as $cf)
                                <option value={{$cf->Card_File_ID}}>{{$cf->Last_Name}}, {{$cf->First_Name}} {{$cf->Middle_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Fund Type:</b></span><br>
                        <select class="modal_input1" name="Fund_Type_ID2">
                            <option id="this_fund_type_id" value='' hidden selected>Select</option>
                            @foreach($fund_type as $ft)
                                <option value={{$ft->Fund_Type_ID}}>{{$ft->Fund_Type}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="up_marg5">
                        <span><b>Obligation Request Date:</b></span><br>
                        <input id="this_obr_date" type="date" class="modal_input1" name="Obligation_Request_Date2">
                    </div>
                    <div class="up_marg5">
                        <span><b>Request Status:</b></span><br>
                        <select class="modal_input1" name="Obligation_Request_Status_ID2">
                            <option id="this_obr_status" value='' hidden selected>Select</option>
                            @foreach($obr_status as $obs)
                                <option value={{$obs->Obligation_Request_Status_ID}}>{{$obs->Obligation_Request_Status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="up_marg5">
                        <span><b>Budget Appropriation:</b></span><br>
                        <select class="modal_input1" name="Budget_Appropriation_ID2">
                            <option id="this_ba"value='' hidden selected>Select</option>
                            @foreach($b_app as $bp)
                                <option value={{$bp->Budget_Appropriation_ID}}>{{$bp->Appropriation_No}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="up_marg5">
                        <span><b>Officer in Charge:</b></span><br>
                        <select class="modal_input1" name="Brgy_Officials_and_Staff_ID2">
                            <option id="this_brgy_officials_and_staff_id" value='' hidden selected>Select</option>
                            @foreach($card_file as $cf)
                                <option value={{$cf->Card_File_ID}}>{{$cf->Last_Name}}, {{$cf->First_Name}} {{$cf->Middle_Name}}</option>
                            @endforeach
                        </select>
                    </div>

    
                    <div class="up_marg5">
                        <span><b>Remarks:</b></span><br>
                        <textarea id="this_remarks" class="modal_input1" name="Remarks2"></textarea>
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
