@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ">Budget Appropriation/Setup </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;bfas_budget_appropriation</li>
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
                    <th style="width:15%">Location</th>
                    <th>Appropriation No</th>
                    <th>Budget Appropriation Status</th>
                    <th>Budget Year</th>
                    <th>Fund</th>
                    <th>Appropriation Date</th>
                    <th>Appropriation Type</th>
                    <th>Particulars</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                    <tr>
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
                        <td class="sm_data_col txtCtr">{{$x->Appropriation_No}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Budget_Appropriation_Status}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Budget_Year}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Fund_Type}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Appropriation_Date}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Appropriation_Type}}</td>
                
                        <td class="sm_data_col txtCtr">{{$x->Particulars}}</td>
                        <td class="sm_data_col txtCtr">
                            <button class="edit_XYZ" value="{{$x->Budget_Appropriation_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
        <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_budget_appropriation') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">

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

                    <div class="up_marg5">
                        <span><b>Appropriation No:</b></span><br>
                        <input class="modal_input1" name="Appropriation_No">
                    </div>

                    <div class="up_marg5">
                        <span><b>Appropriation Status:</b></span><br>
                        <select class="modal_input1" name="Budget_Appropriation_Status_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($bp_status as $bps)
                                <option value={{$bps->Budget_Appropriation_Status_ID}}>{{$bps->Budget_Appropriation_Status}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Budget Year:</b></span><br>
                        <select class="modal_input1" name="Budget_Year">
                            @for($i=2000;$i < 2022; $i++)
                                <option value={{$i}}>{{$i}}</option>
                            @endfor
                            <option value=2022 selected>2022</option>
                            @for($i=2023;$i < 2051; $i++)
                                <option value={{$i}}>{{$i}}</option>
                            @endfor
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
                        <span><b>Appropriation Date:</b></span><br>
                        <input type="date" class="modal_input1" name="Appropriation_Date">
                    </div>
                    <div class="up_marg5">
                        <span><b>Appropriation:</b></span><br>
                        <select class="modal_input1" name="Appropriation_Type_ID">
                            <option value='' hidden selected>Select</option>
                            @foreach($app_type as $apt)
                                <option value={{$apt->Appropriation_Type_ID}}>{{$apt->Appropriation_Type}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Particulars:</b></span><br>
                        <textarea class="modal_input1" name="Particulars"></textarea>
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
        <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_budget_appropriation') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <input id="this_identifier" value=10 hidden>
            <input id="this_idX" value="" hidden name="IDx">
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
    
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

                    <div class="up_marg5">
                        <span><b>Appropriation No:</b></span><br>
                        <input id="this_appropriation_no" class="modal_input1" name="Appropriation_No2">
                    </div>

                    <div class="up_marg5">
                        <span><b>Appropriation Status:</b></span><br>
                        <select class="modal_input1" name="Budget_Appropriation_Status_ID2">
                            <option id="this_appropriation_status" value='' hidden selected>Select</option>
                            @foreach($bp_status as $bps)
                                <option value={{$bps->Budget_Appropriation_Status_ID}}>{{$bps->Budget_Appropriation_Status}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Budget Year:</b></span><br>
                        <select class="modal_input1" name="Budget_Year2">
                            <option id="this_budget_year" value='' hidden selected></option>
                            @for($i=2000;$i < 2022; $i++)
                                <option value={{$i}}>{{$i}}</option>
                            @endfor
                            <option value=2022 >2022</option>
                            @for($i=2023;$i < 2051; $i++)
                                <option value={{$i}}>{{$i}}</option>
                            @endfor
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
                        <span><b>Appropriation Date:</b></span><br>
                        <input id="this_appropriation_date" type="date" class="modal_input1" name="Appropriation_Date2">
                    </div>
                    <div class="up_marg5">
                        <span><b>Appropriation:</b></span><br>
                        <select class="modal_input1" name="Appropriation_Type_ID2">
                            <option id="this_appropriation_type_id" value='' hidden selected>Select</option>
                            @foreach($app_type as $apt)
                                <option value={{$apt->Appropriation_Type_ID}}>{{$apt->Appropriation_Type}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Particulars:</b></span><br>
                        <textarea id="this_particulars" class="modal_input1" name="Particulars2"></textarea>
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
