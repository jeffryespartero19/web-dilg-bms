@extends('layouts.default')

@section('content')

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Justice Rating List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Justice Rating List</li>
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
                <form id="newRating" method="POST" action="{{ route('create_rating') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <input type="number" value="{{$blotter[0]->Blotter_ID}}" name="Blotter_ID" hidden>
                        <div class="card-body">
                            <div style="text-align: left;">
                                <strong>Blotter Number: {{$blotter[0]->Blotter_Number}}</strong><br>
                                <strong>Incident Date:</strong> {{$blotter[0]->Incident_Date_Time}}<br>
                                <strong>Address:</strong> {{$blotter[0]->Address}}<br>
                                <strong>Complaint Details:</strong> {{$blotter[0]->Complaint_Details}}<br>
                            </div>
                            <br>
                            <div class="tableX_row col-md-12 up_marg5">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Criteria</th>
                                                <th class="sm_data_col txtCtr">1</th>
                                                <th class="sm_data_col txtCtr">2</th>
                                                <th class="sm_data_col txtCtr">3</th>
                                                <th class="sm_data_col txtCtr">4</th>
                                                <th class="sm_data_col txtCtr">5</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Speed</th>
                                                <td class="sm_data_col txtCtr"><input type="radio" name="speed" value="1"></td>
                                                <td class="sm_data_col txtCtr"><input type="radio" name="speed" value="2"></td>
                                                <td class="sm_data_col txtCtr"><input type="radio" name="speed" value="3"></td>
                                                <td class="sm_data_col txtCtr"><input type="radio" name="speed" value="4"></td>
                                                <td class="sm_data_col txtCtr"><input type="radio" name="speed" value="5"></td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <th>Over-all Outcome</th>
                                                <td class="sm_data_col txtCtr"><input type="radio" name="outcome" value="1"></td>
                                                <td class="sm_data_col txtCtr"><input type="radio" name="outcome" value="2"></td>
                                                <td class="sm_data_col txtCtr"><input type="radio" name="outcome" value="3"></td>
                                                <td class="sm_data_col txtCtr"><input type="radio" name="outcome" value="4"></td>
                                                <td class="sm_data_col txtCtr"><input type="radio" name="outcome" value="5"></td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <th>Quality of Service</th>
                                                <td class="sm_data_col txtCtr"><input type="radio" name="quality" value="1"></td>
                                                <td class="sm_data_col txtCtr"><input type="radio" name="quality" value="2"></td>
                                                <td class="sm_data_col txtCtr"><input type="radio" name="quality" value="3"></td>
                                                <td class="sm_data_col txtCtr"><input type="radio" name="quality" value="4"></td>
                                                <td class="sm_data_col txtCtr"><input type="radio" name="quality" value="5"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <center>
                            <!-- <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button> -->
                            <button type="submit" class="btn btn-primary" style="width: 200px;">Submit</button>
                        </center>
                        <br>
                    </div>

                </form>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->




<!-- Create Announcement_Status END -->

@endsection

@section('scripts')

@endsection