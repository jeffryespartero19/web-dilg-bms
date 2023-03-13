@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Other Transaction List(BDRIS)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Other Transaction List(BDRIS)</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<div class="tableX_row col-md-12 up_marg5">
    @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
                    <div class="form-group col-lg-3">
                        <label for="R_ID">Region</label>
                        <select class="form-control" id="R_ID" name="R_ID" required>
                            <option value='' disabled selected>Select Option</option>

                            @foreach($region1 as $region)
                            <option value="{{ $region->Region_ID }}">{{ $region->Region_Name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="P_ID">Province</label>
                        <select class="form-control" id="P_ID" name="P_ID" required>
                            <option value='' disabled selected>Select Option</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="CM_ID">City/Municipality</label>
                        <select class="form-control" id="CM_ID" name="CM_ID" required>
                            <option value='' disabled selected>Select Option</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="B_ID">Barangay</label>
                        <select class="form-control" id="B_ID" name="B_ID" required>
                            <option value='' disabled selected>Select Option</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (Auth::user()->User_Type_ID == 1)
    <div class="card">
        <div class="card-header" style="background-color:#e7ad52; color:white">
            <h3 class="card-title">Disaster Type List</h3>
        </div>
        <div class="card-body">
            <div class="flexer">
                <div class="eighty_split">{{$db_entries->appends(['db_entries' => $db_entries->currentPage()])->links()}}</div>

                <div class="twenty_split txtRight"><a href="{{ url('disaster_type_details/0') }}" class="btn btn-success" style="width: 100px;">New </a></div>
                &nbsp;&nbsp;&nbsp;<div><button data-toggle="modal" class="btn btn-info" data-target="#download_disty_filter" style="width: 100px;">Download</button></div>

            </div>
            <br>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th>Disaster Type</th>
                            <th>Emergency Evacuation Site</th>
                            <th>Allocated Fund</th>
                            <th>Emergency Equipment</th>
                            <th>Emergency Team</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($db_entries as $x)
                        <tr>

                            <td class="sm_data_col txtCtr">{{$x->Disaster_Type}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Emergency_Evacuation_Site_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Allocated_Fund_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Emergency_Equipment_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Emergency_Team_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                            <td class="sm_data_col txtCtr">
                                <a class="btn btn-info" href="{{ url('disaster_type_details/'.$x->Disaster_Type_ID) }}">Edit</a>
                                <!-- <a class="btn btn-primary" href="{{ url('view_disaster_type_details/'.$x->Disaster_Type_ID) }}">View</a> -->
                                <button class="view_disastertype btn btn-primary" value="{{$x->Disaster_Type_ID}}" data-toggle="modal" data-target="#viewDisasterType">View</button>
                                <button class="delete_disaster btn btn-danger" value="{{$x->Disaster_Type_ID}}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    @endif
    <!-- /.card-body -->
    <div class="card">
        <div class="card-header" style="background-color:#198754; color:white">
            <h3 class="card-title">Emergency Evacuation Site List</h3>
        </div>
        <div class="card-body">
            <div class="flexer">
                <div class="eighty_split">{{$db_entries2->appends(['db_entries2' => $db_entries2->currentPage()])->links()}}</div>
                @if (Auth::user()->User_Type_ID == 1)
                <div class="twenty_split txtRight"><a href="{{ url('emergency_evacuation_site_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                @endif
                &nbsp;&nbsp;&nbsp;<div><button data-toggle="modal" class="btn btn-info" data-target="#download_emerevac_filter" style="width: 100px;">Download</button></div>
            </div>
            <br>
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th>Emergency Evacuation Site Name </th>
                            <th>Address </th>
                            <th>Capacity </th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($db_entries2 as $x)
                        <tr>

                            <td class="sm_data_col txtCtr">{{$x->Emergency_Evacuation_Site_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Address}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Capacity}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                            <td class="sm_data_col txtCtr">
                                @if (Auth::user()->User_Type_ID == 1)
                                <a class="btn btn-info" href="{{ url('emergency_evacuation_site_details/'.$x->Emergency_Evacuation_Site_ID) }}">Edit</a>
                                <button class="view_emerevacsite btn btn-primary" value="{{$x->Emergency_Evacuation_Site_ID}}" data-toggle="modal" data-target="#viewEmerEvacSite">View</button>
                                <!-- <a class="btn btn-primary" href="{{ url('view_emergency_evacuation_site_details/'.$x->Emergency_Evacuation_Site_ID) }}">View</a> -->
                                <button class="delete_emereva btn btn-danger" value="{{$x->Emergency_Evacuation_Site_ID}}">Delete</button>
                                @endif
                                @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
                                <button class="view_emerevacsite btn btn-primary" value="{{$x->Emergency_Evacuation_Site_ID}}" data-toggle="modal" data-target="#viewEmerEvacSite">View</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" style="background-color:#9d02df; color:white">
            <h3 class="card-title">Allocated Fund List</h3>
        </div>
        <div class="card-body">
            <br>
            <div class="flexer">
                <div class="eighty_split">{{$db_entries3->appends(['db_entries3' => $db_entries3->currentPage()])->links()}}</div>
                @if (Auth::user()->User_Type_ID == 1)
                <div class="twenty_split txtRight"><a href="{{ url('allocated_fund_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                @endif
                &nbsp;&nbsp;&nbsp;<div><button data-toggle="modal" class="btn btn-info" data-target="#download_allofund_filter" style="width: 100px;">Download</button></div>
            </div>
            <br>
            <div class="table-responsive">
                <table id="example3" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th>Allocated Fund Name </th>
                            <th>Amount </th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($db_entries3 as $x)
                        <tr>

                            <td class="sm_data_col txtCtr">{{$x->Allocated_Fund_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Amount}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                            <td class="sm_data_col txtCtr">
                                @if (Auth::user()->User_Type_ID == 1)
                                <a class="btn btn-info" href="{{ url('allocated_fund_details/'.$x->Allocated_Fund_ID) }}">Edit</a>
                                <button class="view_allofund btn btn-primary" value="{{$x->Allocated_Fund_ID}}" data-toggle="modal" data-target="#viewAlloFund">View</button>
                                <!-- <a class="btn btn-primary" href="{{ url('view_allocated_fund_details/'.$x->Allocated_Fund_ID) }}">View</a> -->
                                <button class="delete_allocated btn btn-danger" value="{{$x->Allocated_Fund_ID}}">Delete</button>
                                @endif
                                @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
                                <button class="view_allofund btn btn-primary" value="{{$x->Allocated_Fund_ID}}" data-toggle="modal" data-target="#viewAlloFund">View</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" style="background-color:#074ff4; color:white">
            <h3 class="card-title">Disaster Supplies List</h3>
        </div>
        <div class="card-body">
            <div class="flexer">
                <div class="eighty_split">{{$db_entries4->appends(['db_entries4' => $db_entries4->currentPage()])->links()}}</div>
                @if (Auth::user()->User_Type_ID == 1)
                <div class="twenty_split txtRight"><a href="{{ url('disaster_supplies_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                @endif
                &nbsp;&nbsp;&nbsp;<div><button data-toggle="modal" class="btn btn-info" data-target="#download_dissupp_filter" style="width: 100px;">Download</button></div>
            </div>
            <br>
            <div class="table-responsive">
                <table id="example4" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th>Disaster Name </th>
                            <th>Disaster Supplies Name </th>
                            <th>Disaster Supplies Quantity </th>
                            <th>Location </th>
                            <th>Remarks </th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($db_entries4 as $x)
                        <tr>

                            <td class="sm_data_col txtCtr">{{$x->Disaster_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Disaster_Supplies_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Disaster_Supplies_Quantity}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Location}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Remarks}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                            <td class="sm_data_col txtCtr">
                                @if (Auth::user()->User_Type_ID == 1)
                                <a class="btn btn-info" href="{{ url('disaster_supplies_details/'.$x->Disaster_Supplies_ID) }}">Edit</a>
                                <button class="view_dissupp btn btn-primary" value="{{$x->Disaster_Supplies_ID}}" data-toggle="modal" data-target="#viewDisSupp">View</button>
                                <!-- <a class="btn btn-primary" href="{{ url('view_disaster_supplies_details/'.$x->Disaster_Supplies_ID) }}">View</a> -->
                                <button class="delete_disastersupp btn btn-danger" value="{{$x->Disaster_Supplies_ID}}">Delete</button>
                                @endif
                                @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
                                <button class="view_dissupp btn btn-primary" value="{{$x->Disaster_Supplies_ID}}" data-toggle="modal" data-target="#viewDisSupp">View</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" style="background-color:#af2b31; color:white">
            <h3 class="card-title">Emergency Team List</h3>
        </div>
        <div class="card-body">
            <div class="flexer">
                <div class="eighty_split">{{$db_entries4->appends(['db_entries5' => $db_entries4->currentPage()])->links()}}</div>
                @if (Auth::user()->User_Type_ID == 1)
                <div class="twenty_split txtRight"><a href="{{ url('emergency_team_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                @endif
                &nbsp;&nbsp;&nbsp;<div><button data-toggle="modal" class="btn btn-info" data-target="#download_emerteam_filter" style="width: 100px;">Download</button></div>
            </div>
            <br>
            <div class="table-responsive">
                <table id="example5" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th>Emergency Team Name </th>
                            <th>Emergency Team Hotline </th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($db_entries5 as $x)
                        <tr>

                            <td class="sm_data_col txtCtr">{{$x->Emergency_Team_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Emergency_Team_Hotline}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                            <td class="sm_data_col txtCtr">
                                @if (Auth::user()->User_Type_ID == 1)
                                <a class="btn btn-info" href="{{ url('emergency_team_details/'.$x->Emergency_Team_ID) }}">Edit</a>
                                <button class="view_emerteam btn btn-primary" value="{{$x->Emergency_Team_ID}}" data-toggle="modal" data-target="#viewEmerTeam">View</button>
                                <!-- <a class="btn btn-primary" href="{{ url('view_emergency_team_details/'.$x->Emergency_Team_ID) }}">View</a> -->
                                <button class="delete_emerteam btn btn-danger" value="{{$x->Emergency_Team_ID}}">Delete</button>
                                @endif
                                @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
                                <button class="view_emerteam btn btn-primary" value="{{$x->Emergency_Team_ID}}" data-toggle="modal" data-target="#viewEmerTeam">View</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" style="background-color:#435f57; color:white">
            <h3 class="card-title">Emergency Equipment List</h3>
        </div>
        <div class="card-body">
            <div class="flexer">
                <div class="eighty_split">{{$db_entries4->appends(['db_entries6' => $db_entries4->currentPage()])->links()}}</div>
                @if (Auth::user()->User_Type_ID == 1)
                <div class="twenty_split txtRight"><a href="{{ url('emergency_equipment_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                @endif
                &nbsp;&nbsp;&nbsp;<div><button data-toggle="modal" class="btn btn-info" data-target="#download_emerequip_filter" style="width: 100px;">Download</button></div>
            </div>
            <br>
            <div class="table-responsive">
                <table id="example6" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th>Emergency Equipment Name </th>
                            <th>Location </th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($db_entries6 as $x)
                        <tr>

                            <td class="sm_data_col txtCtr">{{$x->Emergency_Equipment_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Location}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                            <td class="sm_data_col txtCtr">
                                @if (Auth::user()->User_Type_ID == 1)
                                <a class="btn btn-info" href="{{ url('emergency_equipment_details/'.$x->Emergency_Equipment_ID) }}">Edit</a>
                                <button class="view_emerequip btn btn-primary" value="{{$x->Emergency_Equipment_ID}}" data-toggle="modal" data-target="#viewEmerEquip">View</button>
                                <!-- <a class="btn btn-primary" href="{{ url('view_emergency_equipment_details/'.$x->Emergency_Equipment_ID) }}">View</a> -->
                                <button class="delete_emerequip btn btn-danger" value="{{$x->Emergency_Equipment_ID}}">Delete</button>
                                @endif
                                @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
                                <button class="view_emerequip btn btn-primary" value="{{$x->Emergency_Equipment_ID}}" data-toggle="modal" data-target="#viewEmerEquip">View</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <br>
        </div>
    </div>
</div>



<div class="modal fade" id="viewDisasterType" tabindex="-1" role="dialog" aria-labelledby="viewDisasterType" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Disaster Type Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-6">
                            <strong>Disaster Type: </strong><span id="VDisaster_Type"></span><br>
                            <strong>Emergency Evacuation Site Name: </strong><span id="VEmergency_Evacuation_Site_Name"></span><br>
                            <strong>Allocated Fund Name: </strong><span id="VAllocated_Fund_Name"></span><br>
                            <strong>Emergency Team Name: </strong><span id="VEmergency_Team_Name"></span><br>
                            <strong>Emergency Equipment Name: </strong><span id="VEmergency_Equipment_Name"></span><br>
                            <strong>is Active?: </strong><span id="VActive"></span><br>
                            <!-- <h1>Contractor Name: </h1><h1 id="VContractor_Name"></h1> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewEmerEvacSite" tabindex="-1" role="dialog" aria-labelledby="viewEmerEvacSite" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Emergency Evacuation Site Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-6">
                            <strong>Emergency Evacuation Site Name: </strong><span id="V2Emergency_Evacuation_Site_Name"></span><br>
                            <strong>Address: </strong><span id="VAddress"></span><br>
                            <strong>Capacity: </strong><span id="VCapacity"></span><br>
                            <strong>is Active?: </strong><span id="V2Active"></span><br>
                            <!-- <h1>Contractor Name: </h1><h1 id="VContractor_Name"></h1> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewAlloFund" tabindex="-1" role="dialog" aria-labelledby="viewAlloFund" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Allocated Fund Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-6">
                            <strong>Allocated Fund Name: </strong><span id="V2Allocated_Fund_Name"></span><br>
                            <strong>Amount: </strong><span id="VAmount"></span><br>
                            <strong>is Active?: </strong><span id="V3Active"></span><br>
                            <!-- <h1>Contractor Name: </h1><h1 id="VContractor_Name"></h1> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewDisSupp" tabindex="-1" role="dialog" aria-labelledby="viewDisSupp" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Disaster Supplies Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-6">
                            <strong>Disaster Supplies Name: </strong><span id="VDisaster_Supplies_Name"></span><br>
                            <strong>Disaster Supplies Quantity: </strong><span id="VDisaster_Supplies_Quantity"></span><br>
                            <strong>Location: </strong><span id="VLocation"></span><br>
                            <strong>Remarks: </strong><span id="VRemarks"></span><br>
                            <strong>Disaster Name: </strong><span id="V3Disaster_Name"></span><br>
                            <strong>Brgy Official Name: </strong><span id="V3Resident_Name"></span><br>
                            <strong>is Active?: </strong><span id="V4Active"></span><br>
                            <!-- <h1>Contractor Name: </h1><h1 id="VContractor_Name"></h1> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewEmerTeam" tabindex="-1" role="dialog" aria-labelledby="viewEmerTeam" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Emergency Team Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-6">
                            <strong>Emergency Team Name: </strong><span id="V2Emergency_Team_Name"></span><br>
                            <strong>Emergency Team Hotline: </strong><span id="VEmergency_Team_Hotline"></span><br>
                            <strong>is Active?: </strong><span id="V5Active"></span><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewEmerEquip" tabindex="-1" role="dialog" aria-labelledby="viewEmerEquip" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Emergency Equip Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-6">
                            <strong>Emergency Equipment Name: </strong><span id="V3Emergency_Equipment_Name"></span><br>
                            <strong>Location: </strong><span id="V2Location"></span><br>
                            <strong>is Active?: </strong><span id="V6Active"></span><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- buban -->
<div class="modal fade" id="download_disty_filter" tabindex="-1" role="dialog" aria-labelledby="Create_BrgyBusinessPermit" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="download_report" method="POST" action="{{ route('disastertype_downloadPDF') }}" autocomplete="off" enctype="multipart/form-data">
            <!-- <form id="download_report" method="POST"  autocomplete="off" enctype="multipart/form-data"> -->
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-4" style="padding:0 0px">
                                <input type="checkbox" id="chk_Disaster_Type" name="chk_Disaster_Type">
                                <label for="chk_Disaster_Type">Disaster Type</label><br>
                                <input type="checkbox" id="chk_Emergency_Evacuation_Site_Name" name="chk_Emergency_Evacuation_Site_Name">
                                <label for="chk_Emergency_Evacuation_Site_Name">Emergency Evacuation Site Name</label><br>
                                <input type="checkbox" id="chk_Allocated_Fund_Name" name="chk_Allocated_Fund_Name">
                                <label for="chk_Allocated_Fund_Name">Allocated Fund Name</label><br>
                                <input type="checkbox" id="chk_Emergency_Team_Name" name="chk_Emergency_Team_Name">
                                <label for="chk_Emergency_Team_Name">Emergency Team Name</label><br>
                                <input type="checkbox" id="chk_Emergency_Equipment_Name" name="chk_Emergency_Equipment_Name">
                                <label for="chk_Emergency_Equipment_Name">Emergency Equipment Name</label><br>
                                <input type="checkbox" id="chk_Active" name="chk_Active">
                                <label for="chk_Active">Active</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary postThis_Inhabitant_Info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="download_emerevac_filter" tabindex="-1" role="dialog" aria-labelledby="Create_BrgyBusinessPermit" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="download_report" method="POST" action="{{ route('emerevac_downloadPDF') }}" autocomplete="off" enctype="multipart/form-data">
            <!-- <form id="download_report" method="POST"  autocomplete="off" enctype="multipart/form-data"> -->
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-4" style="padding:0 0px">
                                <input type="checkbox" id="chk_Emergency_Evacuation_Site_Name" name="chk_Emergency_Evacuation_Site_Name">
                                <label for="chk_Emergency_Evacuation_Site_Name">Emergency Evacuation Site Name</label><br>
                                <input type="checkbox" id="chk_Address" name="chk_Address">
                                <label for="chk_Address">Address</label><br>
                                <input type="checkbox" id="chk_Capacity" name="chk_Capacity">
                                <label for="chk_Capacity">Capacity</label><br>
                                <input type="checkbox" id="chk_Active" name="chk_Active">
                                <label for="chk_Active">Active</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary postThis_Inhabitant_Info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="download_allofund_filter" tabindex="-1" role="dialog" aria-labelledby="Create_BrgyBusinessPermit" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="download_report" method="POST" action="{{ route('allofund_downloadPDF') }}" autocomplete="off" enctype="multipart/form-data">
            <!-- <form id="download_report" method="POST"  autocomplete="off" enctype="multipart/form-data"> -->
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-4" style="padding:0 0px">
                                <input type="checkbox" id="chk_Allocated_Fund_Name" name="chk_Allocated_Fund_Name">
                                <label for="chk_Allocated_Fund_Name">Allocated Fund Name</label><br>
                                <input type="checkbox" id="chk_Amount" name="chk_Amount">
                                <label for="chk_Amount">Amount</label><br>
                                <input type="checkbox" id="chk_Active" name="chk_Active">
                                <label for="chk_Active">Active</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary postThis_Inhabitant_Info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="download_dissupp_filter" tabindex="-1" role="dialog" aria-labelledby="Create_BrgyBusinessPermit" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="download_report" method="POST" action="{{ route('dissupp_downloadPDF') }}" autocomplete="off" enctype="multipart/form-data">
            <!-- <form id="download_report" method="POST"  autocomplete="off" enctype="multipart/form-data"> -->
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-4" style="padding:0 0px">
                                <input type="checkbox" id="chk_Disaster_Supplies_Name" name="chk_Disaster_Supplies_Name">
                                <label for="chk_Disaster_Supplies_Name">Disaster Supplies Name</label><br>
                                <input type="checkbox" id="chk_Disaster_Supplies_Quantity" name="chk_Disaster_Supplies_Quantity">
                                <label for="chk_Disaster_Supplies_Quantity">Disaster Supplies Quantity</label><br>
                                <input type="checkbox" id="chk_Location" name="chk_Location">
                                <label for="chk_Location">Location</label><br>
                                <input type="checkbox" id="chk_Remarks" name="chk_Remarks">
                                <label for="chk_Remarks">Remarks</label><br>
                                <input type="checkbox" id="chk_Disaster_Name" name="chk_Disaster_Name">
                                <label for="chk_Disaster_Name">Disaster Name</label><br>
                                <input type="checkbox" id="chk_Resident_Name" name="chk_Resident_Name">
                                <label for="chk_Resident_Name">Brgy Offiicial</label><br>
                                <input type="checkbox" id="chk_Active" name="chk_Active">
                                <label for="chk_Active">Active</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary postThis_Inhabitant_Info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="download_emerteam_filter" tabindex="-1" role="dialog" aria-labelledby="Create_BrgyBusinessPermit" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="download_report" method="POST" action="{{ route('emerteam_downloadPDF') }}" autocomplete="off" enctype="multipart/form-data">
            <!-- <form id="download_report" method="POST"  autocomplete="off" enctype="multipart/form-data"> -->
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-4" style="padding:0 0px">
                                <input type="checkbox" id="chk_Emergency_Team_Name" name="chk_Emergency_Team_Name">
                                <label for="chk_Emergency_Team_Name">Emergency Team Name</label><br>
                                <input type="checkbox" id="chk_Emergency_Team_Hotline" name="chk_Emergency_Team_Hotline">
                                <label for="chk_Emergency_Team_Hotline">Emergency Team Hotline</label><br>
                                <input type="checkbox" id="chk_Active" name="chk_Active">
                                <label for="chk_Active">Active</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary postThis_Inhabitant_Info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="download_emerequip_filter" tabindex="-1" role="dialog" aria-labelledby="Create_BrgyBusinessPermit" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="download_report" method="POST" action="{{ route('emerequip_downloadPDF') }}" autocomplete="off" enctype="multipart/form-data">
            <!-- <form id="download_report" method="POST"  autocomplete="off" enctype="multipart/form-data"> -->
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-4" style="padding:0 0px">
                                <input type="checkbox" id="chk_Emergency_Equipment_Name" name="chk_Emergency_Equipment_Name">
                                <label for="chk_Emergency_Equipment_Name">Emergency Equipment Name</label><br>
                                <input type="checkbox" id="chk_Location" name="chk_Location">
                                <label for="chk_Location">Location</label><br>
                                <input type="checkbox" id="chk_Active" name="chk_Active">
                                <label for="chk_Active">Active</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary postThis_Inhabitant_Info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
        $('#example2').DataTable();
        $('#example3').DataTable();
        $('#example4').DataTable();
        $('#example5').DataTable();
        $('#example6').DataTable();

    });

    $(document).on("change", "#R_ID", function() {

        var Region_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_province/" + Region_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#P_ID').empty();
                $('#CM_ID').empty();
                $('#B_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#P_ID').append(option1);
                $('#CM_ID').append(option1);
                $('#B_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["Province_ID"] +
                        "'>" +
                        element["Province_Name"] +
                        "</option>";
                    $('#P_ID').append(option);
                });
            }
        });
    });

    $(document).on("change", "#P_ID", function() {
        var Province_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_city/" + Province_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#CM_ID').empty();
                $('#B_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#CM_ID').append(option1);
                $('#B_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["City_Municipality_ID"] +
                        "'>" +
                        element["City_Municipality_Name"] +
                        "</option>";
                    $('#CM_ID').append(option);
                });
            }
        });
    });

    $(document).on("change", "#CM_ID", function() {
        var City_Municipality_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_barangay/" + City_Municipality_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#B_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#B_ID').append(option1);

                data.forEach(element => {

                    var option = " <option value='" +
                        element["Barangay_ID"] +
                        "'>" +
                        element["Barangay_Name"] +
                        "</option>";
                    $('#B_ID').append(option);
                });
            }
        });
    });


    $(document).on("change", "#B_ID", function() {
        var Barangay_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_emergency_evacuation_site_list/" + Barangay_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#example2').dataTable().fnClearTable();
                $('#example2').dataTable().fnDraw();
                $('#example2').dataTable().fnDestroy();

                data.forEach(element => {

                    $('#example2').DataTable().row.add([
                        element["Emergency_Evacuation_Site_Name"],
                        element["Address"],
                        element["Capacity"],
                        "<a class='btn btn-success' href='emergency_evacuation_site_details/" + element["Emergency_Evacuation_Site_ID"] + "'>View</a>",
                    ]).draw();
                });
            }
        });

        $.ajax({
            type: "GET",
            url: "/get_allocated_fund_list/" + Barangay_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#example3').dataTable().fnClearTable();
                $('#example3').dataTable().fnDraw();
                $('#example3').dataTable().fnDestroy();

                data.forEach(element => {

                    $('#example3').DataTable().row.add([
                        element["Allocated_Fund_Name"],
                        element["Amount"],
                        "<a class='btn btn-success' href='allocated_fund_details/" + element["Allocated_Fund_ID"] + "'>View</a>",
                    ]).draw();
                });
            }
        });

        $.ajax({
            type: "GET",
            url: "/get_disaster_supplies_list/" + Barangay_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#example4').dataTable().fnClearTable();
                $('#example4').dataTable().fnDraw();
                $('#example4').dataTable().fnDestroy();

                data.forEach(element => {

                    $('#example4').DataTable().row.add([
                        element["Disaster_Name"],
                        element["Disaster_Supplies_Name"],
                        element["Disaster_Supplies_Quantity"],
                        element["Location"],
                        element["Remarks"],
                        "<a class='btn btn-success' href='disaster_supplies_details/" + element["Disaster_Supplies_ID"] + "'>View</a>",
                    ]).draw();
                });
            }
        });

        $.ajax({
            type: "GET",
            url: "/get_emergency_team_list/" + Barangay_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#example5').dataTable().fnClearTable();
                $('#example5').dataTable().fnDraw();
                $('#example5').dataTable().fnDestroy();

                data.forEach(element => {

                    $('#example5').DataTable().row.add([
                        element["Emergency_Team_Name"],
                        element["Emergency_Team_Hotline"],
                        "<a class='btn btn-success' href='emergency_team_details/" + element["Emergency_Team_ID"] + "'>View</a>",
                    ]).draw();
                });
            }
        });

        $.ajax({
            type: "GET",
            url: "/get_emergency_equipment_list/" + Barangay_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#example6').dataTable().fnClearTable();
                $('#example6').dataTable().fnDraw();
                $('#example6').dataTable().fnDestroy();

                data.forEach(element => {

                    $('#example6').DataTable().row.add([
                        element["Emergency_Equipment_Name"],
                        element["Location"],
                        "<a class='btn btn-success' href='emergency_equipment_details/" + element["Emergency_Equipment_ID"] + "'>View</a>",
                    ]).draw();
                });
            }
        });
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.otherTrans').addClass('active');
        $('.disaster_menu').addClass('active');
        $('.disaster_main').addClass('menu-open');
    });

    // Delete Contractor
    $(document).on('click', ('.delete_disaster'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this disater type?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_disaster",
                    type: 'GET',
                    data: {
                        id: disID
                    },
                    fail: function() {
                        alert('request failed');
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Deleted',
                            text: "Disaster Type has been deleted.",
                            icon: 'success',
                            showConfirmButton: false,
                        });
                        location.reload();
                    }
                });

            }
        });
    });

    // Delete Contractor
    $(document).on('click', ('.delete_emereva'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this emergency evacuation site?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_emereva",
                    type: 'GET',
                    data: {
                        id: disID
                    },
                    fail: function() {
                        alert('request failed');
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Deleted',
                            text: "Emergency Evacuation Site has been deleted.",
                            icon: 'success',
                            showConfirmButton: false,
                        });
                        location.reload();
                    }
                });

            }
        });
    });

    // Delete Allocated
    $(document).on('click', ('.delete_allocated'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this allocated fund?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_allocated",
                    type: 'GET',
                    data: {
                        id: disID
                    },
                    fail: function() {
                        alert('request failed');
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Deleted',
                            text: "Allocated Fund has been deleted.",
                            icon: 'success',
                            showConfirmButton: false,
                        });
                        location.reload();
                    }
                });

            }
        });
    });


    // Delete Disaster Supplies
    $(document).on('click', ('.delete_disastersupp'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this disaster supplies?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_disastersupp",
                    type: 'GET',
                    data: {
                        id: disID
                    },
                    fail: function() {
                        alert('request failed');
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Deleted',
                            text: "Disaster Supplies has been deleted.",
                            icon: 'success',
                            showConfirmButton: false,
                        });
                        location.reload();
                    }
                });

            }
        });
    });


    // Delete Disaster Supplies
    $(document).on('click', ('.delete_emerteam'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this emergency team?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_emerteam",
                    type: 'GET',
                    data: {
                        id: disID
                    },
                    fail: function() {
                        alert('request failed');
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Deleted',
                            text: "Emergency Team has been deleted.",
                            icon: 'success',
                            showConfirmButton: false,
                        });
                        location.reload();
                    }
                });

            }
        });
    });

    // Delete Emergency Equipment
    $(document).on('click', ('.delete_emerequip'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this emergency equipment?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_emerequip",
                    type: 'GET',
                    data: {
                        id: disID
                    },
                    fail: function() {
                        alert('request failed');
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Deleted',
                            text: "Emergency Equipment has been deleted.",
                            icon: 'success',
                            showConfirmButton: false,
                        });
                        location.reload();
                    }
                });

            }
        });
    });

    
    $(document).on('click', '.modal-close', function(e) {
        $('#viewDisasterType').trigger("reset");
        $('#viewEmerEvacSite').trigger("reset");
        $('#viewAlloFund').trigger("reset");
        $('#viewDisSupp').trigger("reset");
        $('#viewEmerTeam').trigger("reset");
        $('#viewEmerEquip').trigger("reset");
    });
//aldren
    $(document).on('click', ('.view_disastertype'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_disastertype",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#VDisaster_Type').html(data['theEntry'][0]['Disaster_Type']);
                $('#VEmergency_Evacuation_Site_Name').html(data['theEntry'][0]['Emergency_Evacuation_Site_Name']);
                $('#VAllocated_Fund_Name').html(data['theEntry'][0]['Allocated_Fund_Name']);
                $('#VEmergency_Team_Name').html(data['theEntry'][0]['Emergency_Team_Name']);
                $('#VEmergency_Equipment_Name').html(data['theEntry'][0]['Emergency_Equipment_Name']);
                $('#VActive').html(data['theEntry'][0]['Active']);
            }
        });

    });

    $(document).on('click', ('.view_emerevacsite'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_emerevacsite",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#V2Emergency_Evacuation_Site_Name').html(data['theEntry'][0]['Emergency_Evacuation_Site_Name']);
                $('#VAddress').html(data['theEntry'][0]['Address']);
                $('#VCapacity').html(data['theEntry'][0]['Capacity']);
                $('#V2Active').html(data['theEntry'][0]['Active']);
            }
        });

    });

    $(document).on('click', ('.view_allofund'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_allofund",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#V2Allocated_Fund_Name').html(data['theEntry'][0]['Allocated_Fund_Name']);
                $('#VAmount').html(data['theEntry'][0]['Amount']);
                $('#V3Active').html(data['theEntry'][0]['Active']);
            }
        });

    });

    $(document).on('click', ('.view_dissupp'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_dissupp",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#VDisaster_Supplies_Name').html(data['theEntry'][0]['Disaster_Supplies_Name']);
                $('#VDisaster_Supplies_Quantity').html(data['theEntry'][0]['Disaster_Supplies_Quantity']);
                $('#VLocation').html(data['theEntry'][0]['Location']);
                $('#VRemarks').html(data['theEntry'][0]['Remarks']);
                $('#V3Disaster_Name').html(data['theEntry'][0]['Disaster_Name']);
                $('#V3Resident_Name').html(data['theEntry'][0]['Resident_Name']);
                $('#V4Active').html(data['theEntry'][0]['Active']);
            }
        });
    });

    $(document).on('click', ('.view_emerteam'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_emerteam",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#V2Emergency_Team_Name').html(data['theEntry'][0]['Emergency_Team_Name']);
                $('#VEmergency_Team_Hotline').html(data['theEntry'][0]['Emergency_Team_Hotline']);
                $('#V5Active').html(data['theEntry'][0]['Active']);
            }
        });

    });

    $(document).on('click', ('.view_emerequip'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_emerequip",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#V3Emergency_Equipment_Name').html(data['theEntry'][0]['Emergency_Equipment_Name']);
                $('#V2Location').html(data['theEntry'][0]['Location']);
                $('#V6Active').html(data['theEntry'][0]['Active']);
            }
        });

    });
</script>


@endsection