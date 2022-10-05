@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Brgy Business Permit List </div> 
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BCPCIS / </li>
            </a> 
            <li> &nbsp;Brgy Business Permit List</li>
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
        <div class="twenty_split txtRight"><a href="{{ url('brgy_business_permit_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Barangay Permits ID</th>
                    <th >Transaction No</th>
                    <th >Business Name</th>
                    <th >Resident Name</th>
                    <th >New or Renewal</th>
                    <th >Owned or Rented</th>
                    <th >Expiration Date</th>
                    <th >CTC No</th>
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
                    <td class="sm_data_col txtCtr" hidden>{{$x->Barangay_Permits_ID}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Transaction_No}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Business_Name}}</td>  
                    <td class="sm_data_col txtCtr" >{{$x->Resident_Name}}</td>  
                    <td class="sm_data_col txtCtr" >{{$x->New_or_Renewal}}</td>  
                    <td class="sm_data_col txtCtr" >{{$x->Owned_or_Rented}}</td>  
                    <td class="sm_data_col txtCtr" >{{$x->Barangay_Business_Permit_Expiration_Date}}</td>  
                    <td class="sm_data_col txtCtr" >{{$x->CTC_No}}</td>  
                    <td class="sm_data_col txtCtr" >{{$x->Region_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Province_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->City_Municipality_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Barangay_Name}}</td>
                    <td class="sm_data_col txtCtr">
                        <a class="btn btn-success" href="{{ url('brgy_business_permit_details/'.$x->Barangay_Permits_ID) }}">Edit</a>
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