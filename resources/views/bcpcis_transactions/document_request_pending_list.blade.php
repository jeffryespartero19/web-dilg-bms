@extends('layouts.default')

@section('content')
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Document Request Pending List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Document Request Pending List</li>
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
                    <div class="card-header" style="background-color:#e7ad52; color:white">
                        <h3 class="card-title">Pending</h3>
                    </div>
                    <div class="card-body">
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Document_ID</th>
                                            <th>Queue Ticket Number</th>
                                            <th>Requested Date and Time</th>
                                            <th>Resident Name</th>
                                            <th>Document Type Name</th>
                                            <th>Purpose of Document</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr" hidden>{{$x->Document_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Queue_Ticket_Number}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Requested_Date_and_Time}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Resident_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Document_Type_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Purpose_of_Document}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <a class="btn btn-success" href="{{ url('document_request_details/'.$x->Document_ID) }}">Approve</a>
                                                <button class="disapprove_inhabitants  btn btn-danger" value="{{$x->Document_ID}}">Disapprove</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>
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
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color:#198754; color:white">
                        <h3 class="card-title">Approved</h3>
                    </div>
                    <div class="card-body">
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="table-responsive">
                                <table id="example2" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Document_ID</th>
                                            <th>Queue Ticket Number</th>
                                            <th>Requested Date and Time</th>
                                            <th>Resident Name</th>
                                            <th>Document Type Name</th>
                                            <th>Purpose of Document</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries2 as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr" hidden>{{$x->Document_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Queue_Ticket_Number}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Requested_Date_and_Time}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Resident_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Document_Type_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Purpose_of_Document}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <a class="btn btn-success" href="{{ url('document_request_approved_details/'.$x->Document_ID) }}">Edit</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>
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
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color:#ed5170; color:white">
                        <h3 class="card-title">Disapproved</h3>
                    </div>
                    <div class="card-body">
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="table-responsive">
                                <table id="example3" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Document_ID</th>
                                            <th>Queue Ticket Number</th>
                                            <th>Requested Date and Time</th>
                                            <th>Resident Name</th>
                                            <th>Document Type Name</th>
                                            <th>Purpose of Document</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries3 as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr" hidden>{{$x->Document_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Queue_Ticket_Number}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Requested_Date_and_Time}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Resident_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Document_Type_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Purpose_of_Document}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div hidden>
                                <form id="Approved_Inhabitant" method="POST" action="{{ route('approve_disapprove_document_request_pending') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                                    <input type="number" class="form-control" id="Document_ID" name="Document_ID">
                                    <input type="number" class="form-control" id="Request_Status_ID" name="Request_Status_ID">
                                </form>
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
        $('#example2').DataTable();
        $('#example3').DataTable();
    });

    // Approve Inhabitants
    $(document).on('click', ('.approve_inhabitants'), function(e) {

        var disID = $(this).val();
        $('#Document_ID').val(disID);
        $('#Request_Status_ID').val(1);

        $('#Approved_Inhabitant').submit();

    });

    // Disapprove Inhabitants
    $(document).on('click', ('.disapprove_inhabitants'), function(e) {

        var disID = $(this).val();
        $('#Document_ID').val(disID);
        $('#Request_Status_ID').val(2);

        $('#Approved_Inhabitant').submit();
    });

   
</script>

<style>
    /* table {
        display: inline-block;
        overflow-x: scroll;
    } */
</style>

@endsection