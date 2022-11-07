@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Response Information List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Response Information List</li>
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
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="text-align: right;">
                            <div class="btn-group">
                                <div style="padding: 2px;"><a href="{{ url('response_information_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                                <div style="padding: 2px;"><a href="{{ url('viewResponse_InformationPDF') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div>
                                <!-- <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div> -->
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Disaster Response ID</th>
                                            <th>Disaster Name</th>
                                            <th>Disaster Type</th>
                                            <th>Alert Level</th>
                                            <th>Damaged Location</th>
                                            <th>Disaster Date Start</th>
                                            <th>Disaster Date End</th>
                                            <th>GPS Coordinates</th>
                                            <th>Risk Assesment</th>
                                            <th>Action Taken</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr" hidden>{{$x->Disaster_Response_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Disaster_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Disaster_Type}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Alert_Level}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Damaged_Location}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Disaster_Date_Start}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Disaster_Date_End}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->GPS_Coordinates}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Risk_Assesment}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Action_Taken}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <a class="btn btn-success" href="{{ url('response_information_details/'.$x->Disaster_Response_ID) }}">Edit</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->



@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();

    });
</script>

@endsection