@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Other Transaction List(BDRIS) </div> 
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BDRIS / </li>
            </a> 
            <li> &nbsp;Other Transaction List(BDRIS)</li>
        </ol> 
    </div>
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
    <br>
    <div class="flexer">
        <div class="eighty_split">{{$db_entries->appends(['db_entries' => $db_entries->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><a href="{{ url('disaster_type_details/0') }}" class="btn btn-success" style="width: 100px;">New </a></div>
    </div>
    <br>
    <div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <caption style="text-align:left; background-color:#e7ad52; color:white">&nbsp;&nbsp;Disaster Type List</caption>
            
            <thead>
                <tr>
                    <th hidden>Disaster Type ID</th>
                    <th >Disaster Type</th>
                    <th >Emergency Evacuation Site</th>
                    <th >Allocated Fund</th>
                    <th >Emergency Equipment</th>
                    <th >Emergency Team</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Disaster_Type_ID}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Disaster_Type}}</td>  
                    <td class="sm_data_col txtCtr" >{{$x->Emergency_Evacuation_Site_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Allocated_Fund_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Emergency_Equipment_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Emergency_Team_Name}}</td>
                    <td class="sm_data_col txtCtr"> 
                        <a class="btn btn-success" href="{{ url('disaster_type_details/'.$x->Disaster_Type_ID) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <div class="flexer">
        <div class="eighty_split">{{$db_entries2->appends(['db_entries2' => $db_entries2->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><a href="{{ url('emergency_evacuation_site_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
    </div>
    <br>
    <div>
        <table id="example2" class="table table-striped table-bordered" style="width:100%">
            <caption style="text-align:left; background-color:#198754; color:white">&nbsp;&nbsp;Emergency Evacuation Site List</caption>
            <thead>
                <tr>
                    <th hidden>Emergency_Evacuation_Site_ID </th>
                    <th >Emergency Evacuation_Site Name </th>
                    <th >Address </th>
                    <th >Capacity </th>
                    <th >Region </th>
                    <th >Province </th>
                    <th >City/Municipality </th>
                    <th >Barangay</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries2 as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Emergency_Evacuation_Site_ID}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Emergency_Evacuation_Site_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Address}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Capacity}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Region_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Province_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->City_Municipality_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Barangay_Name}}</td>
                    <td class="sm_data_col txtCtr"> 
                        <a class="btn btn-success" href="{{ url('emergency_evacuation_site_details/'.$x->Emergency_Evacuation_Site_ID) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <br>
    <div class="flexer">
        <div class="eighty_split">{{$db_entries3->appends(['db_entries3' => $db_entries3->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><a href="{{ url('allocated_fund_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
    </div>
    <br>
    <div>
        <table id="example3" class="table table-striped table-bordered" style="width:100%">
            <caption style="text-align:left; background-color:#9d02df; color:white">&nbsp;&nbsp;Allocated Fund List</caption>
            <thead>
                <tr>
                <th hidden>Allocated_Fund_ID  </th>
                    <th >Allocated Fund Name </th>
                    <th >Amount </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries3 as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Allocated_Fund_ID}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Allocated_Fund_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Amount}}</td>
                    <td class="sm_data_col txtCtr"> 
                        <a class="btn btn-success" href="{{ url('allocated_fund_details/'.$x->Allocated_Fund_ID) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <br>
    <div class="flexer">
        <div class="eighty_split">{{$db_entries4->appends(['db_entries4' => $db_entries4->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><a href="{{ url('disaster_supplies_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
    </div>
    <br>
    <div>
        <table id="example4" class="table table-striped table-bordered" style="width:100%">
            <caption style="text-align:left; background-color:#074ff4; color:white">&nbsp;&nbsp;Disaster Supplies List</caption>
            <thead>
                <tr>
                    <th hidden>Disaster_Supplies_ID </th>
                    <th >Disaster Name </th>
                    <th >Disaster Supplies Name </th>
                    <th >Disaster Supplies Quantity </th>
                    <th >Location </th>
                    <th >Remarks </th>
                    <th >Brgy Official Name </th>
                    <th >Region </th>
                    <th >Province </th>
                    <th >City/Municipality </th>
                    <th >Barangay</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries4 as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Disaster_Supplies_ID}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Disaster_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Disaster_Supplies_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Disaster_Supplies_Quantity}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Location}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Remarks}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Last_Name}} {{$x->First_Name}}, {{$x->Middle_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Region_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Province_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->City_Municipality_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Barangay_Name}}</td>
                    <td class="sm_data_col txtCtr"> 
                        <a class="btn btn-success" href="{{ url('disaster_supplies_details/'.$x->Disaster_Supplies_ID) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <br>
    <div class="flexer">
        <div class="eighty_split">{{$db_entries4->appends(['db_entries5' => $db_entries4->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><a href="{{ url('emergency_team_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
    </div>
    <br>
    <div>
        <table id="example5" class="table table-striped table-bordered" style="width:100%">
            <caption style="text-align:left; background-color:#af2b31; color:white">&nbsp;&nbsp;Emergency Team List</caption>
            <thead>
                <tr>
                    <th hidden>Emergency_Team_ID </th>
                    <th >Emergency Team Name </th>
                    <th >Emergency Team Hotline </th>
                    <th >Region </th>
                    <th >Province </th>
                    <th >City/Municipality </th>
                    <th >Barangay</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries5 as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Emergency_Team_ID}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Emergency_Team_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Emergency_Team_Hotline}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Region_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Province_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->City_Municipality_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Barangay_Name}}</td>
                    <td class="sm_data_col txtCtr"> 
                        <a class="btn btn-success" href="{{ url('emergency_team_details/'.$x->Emergency_Team_ID) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <br>
    <div class="flexer">
        <div class="eighty_split">{{$db_entries4->appends(['db_entries6' => $db_entries4->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><a href="{{ url('emergency_equipment_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
    </div>
    <br>
    <div>
        <table id="example6" class="table table-striped table-bordered" style="width:100%">
            <caption style="text-align:left; background-color:#435f57; color:white">&nbsp;&nbsp;Emergency Equipment List</caption>
            <thead>
                <tr>
                    <th hidden>Emergency_Equipment_ID </th>
                    <th >Emergency Equipment Name </th>
                    <th >Location </th>
                    <th >Region </th>
                    <th >Province </th>
                    <th >City/Municipality </th>
                    <th >Barangay</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries6 as $x)
                <tr>
                <td class="sm_data_col txtCtr" hidden>{{$x->Emergency_Equipment_ID}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Emergency_Equipment_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Location}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Region_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Province_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->City_Municipality_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Barangay_Name}}</td>
                    <td class="sm_data_col txtCtr"> 
                        <a class="btn btn-success" href="{{ url('emergency_equipment_details/'.$x->Emergency_Equipment_ID) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <br>
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
    
</script>

<style>
    table {
        display: block;
        overflow-x: scroll;
    }

   
</style>

@endsection