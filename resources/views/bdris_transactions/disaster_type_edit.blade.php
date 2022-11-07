@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Disaster Type List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('other_transaction_list')}}">Other Transaction List(BDRIS)</a></li>
                        <li class="breadcrumb-item active">Disaster Type List</li>
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
                        <div class="tableX_row col-md-12 up_marg5">
                            <br>
                            <div class="col-md-12">
                                <form id="newBrgy_Document_Information" method="POST" action="{{ route('create_disaster_type') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="text" class="form-control" id="Disaster_Type_ID" name="Disaster_Type_ID" value="{{$disaster_type[0]->Disaster_Type_ID}}" hidden>
                                        <div class="row">
                                            <div class="form-group col-lg-9" style="padding:0 10px">
                                                <label for="Disaster_Type">Disaster Type</label>
                                                <input type="text" class="form-control" id="Disaster_Type" name="Disaster_Type" value="{{$disaster_type[0]->Disaster_Type}}">
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Emergency_Evacuation_Site_ID">Emergency Evacuation Site</label>
                                                <select class="form-control" id="Emergency_Evacuation_Site_ID" name="Emergency_Evacuation_Site_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($emergency_evacuation_site as $bt1)
                                                    <option value="{{ $bt1->Emergency_Evacuation_Site_ID }}" {{ $bt1->Emergency_Evacuation_Site_ID  == $disaster_type[0]->Emergency_Evacuation_Site_ID  ? "selected" : "" }}>{{ $bt1->Emergency_Evacuation_Site_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Allocated_Fund_ID">Allocated Fund</label>
                                                <select class="form-control" id="Allocated_Fund_ID" name="Allocated_Fund_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($allocated_fund as $bt1)
                                                    <option value="{{ $bt1->Allocated_Fund_ID }}" {{ $bt1->Allocated_Fund_ID  == $disaster_type[0]->Allocated_Fund_ID  ? "selected" : "" }}>{{ $bt1->Allocated_Fund_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Emergency_Equipment_ID">Emergency Equipment</label>
                                                <select class="form-control" id="Emergency_Equipment_ID" name="Emergency_Equipment_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($emergency_equipment as $bt1)
                                                    <option value="{{ $bt1->Emergency_Equipment_ID }}" {{ $bt1->Emergency_Equipment_ID  == $disaster_type[0]->Emergency_Equipment_ID  ? "selected" : "" }}>{{ $bt1->Emergency_Equipment_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Emergency_Team_ID">Emergency Team</label>
                                                <select class="form-control" id="Emergency_Team_ID" name="Emergency_Team_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($emergency_team as $bt1)
                                                    <option value="{{ $bt1->Emergency_Team_ID }}" {{ $bt1->Emergency_Team_ID  == $disaster_type[0]->Emergency_Team_ID  ? "selected" : "" }}>{{ $bt1->Emergency_Team_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <span><b>Active:</b></span><br>
                                                <select class="form-control modal_input1" name="Active" id="Active">
                                                    <option hidden selected>Is Active?</option>
                                                    <option value=0 {{ 0 == $disaster_type[0]->Active  ? "selected" : "" }}>No</option>
                                                    <option value=1 {{ 1 == $disaster_type[0]->Active  ? "selected" : "" }}>Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" style="margin-bottom: 100px;">
                                        <center>
                                            <!-- <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button> -->
                                            <button type="submit" class="btn btn-primary" style="width: 200px;">Save</button>
                                        </center>
                                    </div>
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


<!-- Create Announcement_Status END -->







@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    $(document).on('click', '.modal-close', function(e) {
        $('#newDisaster_Type').trigger("reset");
        $('#Modal_Title').text('Create Disaster Type');
    });

    // Edit Button Display Modal
    $(document).on('click', ('.edit_disaster_type'), function(e) {
        $('#Modal_Title').text('Edit Disaster Type');
        var disID = $(this).val();
        $.ajax({
            url: "/get_disaster_type",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Disaster_Type_ID').val(data['theEntry'][0]['Disaster_Type_ID']);
                $('#Disaster_Type').val(data['theEntry'][0]['Disaster_Type']);
                $('#Emergency_Evacuation_Site_ID').val(data['theEntry'][0]['Emergency_Evacuation_Site_ID']);
                $('#Allocated_Fund_ID').val(data['theEntry'][0]['Allocated_Fund_ID']);
                $('#Emergency_Team_ID').val(data['theEntry'][0]['Emergency_Team_ID']);
                $('#Emergency_Equipment_ID').val(data['theEntry'][0]['Emergency_Equipment_ID']);
                $('#Active').val(data['theEntry'][0]['Active']);
            }
        });
    });
</script>

<style>
    table {
        display: block;
        overflow-x: scroll;
    }
</style>

@endsection