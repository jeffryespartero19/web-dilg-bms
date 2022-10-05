@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Card File Maintenance/Setup </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;bfas_card_file_maintenance</li>
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
                    <th>Company Name</th>
                    <th>Company TIN</th>
                    <th>Card Name</th>
                    <th style="width:20%">Contact #</th>
                    <th>Addresses </th>
                    <th>Location</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                    <tr>
                        <td class="sm_data_col txtCtr">{{$x->Company_Name}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Company_Tin}}</td>

                        <td class="sm_data_col txtCtr">{{$x->Last_Name}}, {{$x->First_Name}} {{$x->Middle_Name}}</td>

                        <td class="sm_data_col txtCtr">
                            <table>
                                <tr>
                                    <td><b>Phone:</b></td>
                                    <td>{{$x->Phone_No}}</td>
                                </tr>
                                <tr>
                                    <td><b>Contact 1:</b></td>
                                    <td>{{$x->Contact_No_1}}</td>
                                </tr>
                                <tr>
                                    <td><b>Contact 2:</b></td>
                                    <td>{{$x->Contact_No_2}}</td>
                                </tr>
                            </table>
                        </td>

                        <td class="sm_data_col txtCtr">
                            <table>
                                <tr>
                                    <td><b>Billing Address:</b></td>
                                    <td>{{$x->Billing_Address}}</td>
                                </tr>
                                <tr>
                                    <td><b>Delivery Address:</b></td>
                                    <td>{{$x->Delivery_Address}}</td>
                                </tr>
                                <tr>
                                    <td><b>Email Address:</b></td>
                                    <td>{{$x->Email_Address}}</td>
                                </tr>
                            </table>
                        </td>

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

                        <td class="sm_data_col txtCtr">
                            <button class="edit_XYZ" value="{{$x->Card_File_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
        <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_card_file') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Card Type:</b></span><br>
                        <select class="modal_input1 regionX" name="Card_TypeX">
                            <option value='' hidden selected>Select</option>
                            @foreach($card_type as $ct)
                                <option value='{{$ct->Card_Type_ID}}' >{{$ct->Card_Type}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Company Name:</b></span><br>
                        <input class="modal_input1" name="Company_Name">
                    </div>
                    <div class="up_marg5">
                        <span><b>Company Tin:</b></span><br>
                        <input class="modal_input1" name="Company_Tin">
                    </div>
                    
                    <div class="up_marg5">
                        <span><b>Last Name:</b></span><br>
                        <input class="modal_input1" name="Last_Name">
                    </div>
                    <div class="up_marg5">
                        <span><b>First Name:</b></span><br>
                        <input class="modal_input1" name="First_Name">
                    </div>
                    <div class="up_marg5">
                        <span><b>Middle Name:</b></span><br>
                        <input class="modal_input1" name="Middle_Name">
                    </div>

                    <div class="up_marg5">
                        <span><b>Phone No:</b></span><br>
                        <input class="modal_input1" name="Phone_No">
                    </div>
                    <div class="up_marg5">
                        <span><b>Contact 1:</b></span><br>
                        <input class="modal_input1" name="Contact_No_1">
                    </div>
                    <div class="up_marg5">
                        <span><b>Contact No 2:</b></span><br>
                        <input class="modal_input1" name="Contact_No_2">
                    </div>

                    <div class="up_marg5">
                        <span><b>Billing Address:</b></span><br>
                        <input class="modal_input1" name="Billing_Address">
                    </div>
                    <div class="up_marg5">
                        <span><b>Delivery Address:</b></span><br>
                        <input class="modal_input1" name="Delivery_Address">
                    </div>
                    <div class="up_marg5">
                        <span><b>Email Address:</b></span><br>
                        <input class="modal_input1" name="Email_Address">
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
        <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_card_file') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <input id="this_identifier" value=1 hidden>
            <input id="this_idX" value="" hidden name="IDx">
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Card Type:</b></span><br>
                        <select class="modal_input1 regionX" name="Card_TypeX2">
                            <option id="this_card_type" value='' hidden selected>Select</option>
                            @foreach($card_type as $ct)
                                <option value='{{$ct->Card_Type_ID}}' >{{$ct->Card_Type}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="up_marg5">
                        <span><b>Company Name:</b></span><br>
                        <input id="this_company_name" class="modal_input1" name="Company_Name2">
                    </div>
                    <div class="up_marg5">
                        <span><b>Company Tin:</b></span><br>
                        <input id="this_company_tin" class="modal_input1" name="Company_Tin2">
                    </div>
                    
                    <div class="up_marg5">
                        <span><b>Last Name:</b></span><br>
                        <input id="this_last_name" class="modal_input1" name="Last_Name2">
                    </div>
                    <div class="up_marg5">
                        <span><b>First Name:</b></span><br>
                        <input id="this_first_name" class="modal_input1" name="First_Name2">
                    </div>
                    <div class="up_marg5">
                        <span><b>Middle Name:</b></span><br>
                        <input id="this_middle_name" class="modal_input1" name="Middle_Name2">
                    </div>

                    <div class="up_marg5">
                        <span><b>Phone No:</b></span><br>
                        <input id="this_phone_no" class="modal_input1" name="Phone_No2">
                    </div>
                    <div class="up_marg5">
                        <span><b>Contact 1:</b></span><br>
                        <input id="this_contact_1" class="modal_input1" name="Contact_No_1_b">
                    </div>
                    <div class="up_marg5">
                        <span><b>Contact No 2:</b></span><br>
                        <input id="this_contact_2" class="modal_input1" name="Contact_No_2_b">
                    </div>

                    <div class="up_marg5">
                        <span><b>Billing Address:</b></span><br>
                        <input id="this_billing_address" class="modal_input1" name="Billing_Address2">
                    </div>
                    <div class="up_marg5">
                        <span><b>Delivery Address:</b></span><br>
                        <input id="this_delivery_address" class="modal_input1" name="Delivery_Address2">
                    </div>
                    <div class="up_marg5">
                        <span><b>Email Address:</b></span><br>
                        <input id="this_email_address" class="modal_input1" name="Email_Address2">
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
