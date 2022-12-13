@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brgy Document Claim List(Brgy Document Information) </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Brgy Document Claim List(Brgy Document Information) </li>
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
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="text-align: right;">
                            <div class="btn-group">
                                <div style="padding: 2px;"><a href="{{ url('brgy_document_claim_docu_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                                <!-- <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Print</button></div>
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div> -->
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Claim_Schedule_ID</th>
                                            <th >Transaction No(Document Info.)</th>
                                            <th >Resident Name</th>
                                            <th >Requested Date and Time</th>
                                            <th >Queue Ticket Number</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr" hidden>{{$x->Claim_Schedule_ID}}</td>
                                            <td class="sm_data_col txtCtr" >{{$x->Transaction_No}}</td>
                                            <td class="sm_data_col txtCtr" >{{$x->Resident_Name}}</td>  
                                            <td class="sm_data_col txtCtr" >{{$x->Requested_Date_and_Time}}</td>  
                                            <td class="sm_data_col txtCtr" >{{$x->Queue_Ticket_Number}}</td> 
                                            <td class="sm_data_col txtCtr">
                                                <a class="btn btn-success" href="{{ url('brgy_document_claim_docu_details/'.$x->Claim_Schedule_ID) }}">Edit</a>
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
    
    // Side Bar Active
    $(document).ready(function() {
        $('.brgyDocument').addClass('active');
        $('.certification_menu').addClass('active');
        $('.certification_main').addClass('menu-open');
    });
</script>

<style>


   
</style>

@endsection