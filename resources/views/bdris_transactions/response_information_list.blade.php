@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Response Information List </div> 
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BDRIS / </li>
            </a> 
            <li> &nbsp;Response Information List</li>
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
        <div class="twenty_split txtRight"><a href="{{ url('response_information_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
        <div class="txtRight" style="margin-left: 5px;"><a href="{{ url('viewResponse_InformationPDF') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Disaster Response ID</th>
                    <th >Disaster Name</th>
                    <th >Disaster Type</th>
                    <th >Alert Level</th>
                    <th >Damaged Location</th>
                    <th >Disaster Date Start</th>
                    <th >Disaster Date End</th>
                    <th >GPS Coordinates</th>
                    <th >Risk Assesment</th>
                    <th >Action Taken</th>
                    <th >Region </th>
                    <th >Province </th>
                    <th >City/Municipality </th>
                    <th >Barangay</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Disaster_Response_ID}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Disaster_Name}}</td>  
                    <td class="sm_data_col txtCtr" >{{$x->Disaster_Type}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Alert_Level}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Damaged_Location}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Disaster_Date_Start}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Disaster_Date_End}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->GPS_Coordinates}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Risk_Assesment}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Action_Taken}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Region_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Province_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->City_Municipality_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Barangay_Name}}</td>
                    <td class="sm_data_col txtCtr">
                        <a class="btn btn-success" href="{{ url('response_information_details/'.$x->Disaster_Response_ID) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();

    });
    
</script>

<style>
    table {
        display: block;
        overflow-x: scroll;
    }

   
</style>

@endsection