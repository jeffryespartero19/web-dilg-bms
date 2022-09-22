@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Disaster Type List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BDRIS / </li>
            </a> 
            <li> &nbsp;Disaster Type List</li>
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
        <div class="twenty_split txtRight"><button data-toggle="modal" class="btn btn-success" data-target="#createDisaster_Type" style="width: 100px;">New</button></div>
        <div class="txtRight" style="margin-left: 5px;"><a href="{{ url('viewDisaster_TypePDF') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
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
                        <button class="edit_disaster_type" value="{{$x->Disaster_Type_ID}}" data-toggle="modal" data-target="#createDisaster_Type">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Announcement_Status Modal  -->

<div class="modal fade" id="createDisaster_Type" tabindex="-1" role="dialog" aria-labelledby="Create_Disaster_Type" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Disaster Type Profile</h4>
            </div>
            <div class="modal-body">
                <form id="newDisaster_Type" method="POST" action="{{ route('create_disaster_type') }}"  autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Disaster Type Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Disaster_Type_ID" name="Disaster_Type_ID" hidden>
                            <div class="form-group col-lg-9" style="padding:0 10px">
                                <label for="Disaster_Type">Disaster Type</label>
                                <input type="text" class="form-control" id="Disaster_Type" name="Disaster_Type">
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <span><b>Active:</b></span><br>
                                <select class="modal_input1" name="Active" id="Active">
                                <option hidden selected>Is Active?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Emergency_Evacuation_Site_ID">Emergency Evacuation Site</label>
                                <select class="form-control" id="Emergency_Evacuation_Site_ID" name="Emergency_Evacuation_Site_ID">
                                    <option value='' disabled selected>Select Option</option>
                                        @foreach($emergency_evacuation_site as $bt1)
                                        <option value="{{ $bt1->Emergency_Evacuation_Site_ID }}">{{ $bt1->Emergency_Evacuation_Site_Name }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Allocated_Fund_ID">Allocated Fund</label>
                                <select class="form-control" id="Allocated_Fund_ID" name="Allocated_Fund_ID">
                                    <option value='' disabled selected>Select Option</option>
                                        @foreach($allocated_fund as $bt1)
                                        <option value="{{ $bt1->Allocated_Fund_ID }}">{{ $bt1->Allocated_Fund_Name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Emergency_Equipment_ID">Emergency Equipment</label>
                                <select class="form-control" id="Emergency_Equipment_ID" name="Emergency_Equipment_ID">
                                    <option value='' disabled selected>Select Option</option>
                                        @foreach($emergency_equipment as $bt1)
                                        <option value="{{ $bt1->Emergency_Equipment_ID }}">{{ $bt1->Emergency_Equipment_Name }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Emergency_Team_ID">Emergency Team</label>
                                <select class="form-control" id="Emergency_Team_ID" name="Emergency_Team_ID">
                                    <option value='' disabled selected>Select Option</option>
                                        @foreach($emergency_team as $bt1)
                                        <option value="{{ $bt1->Emergency_Team_ID }}">{{ $bt1->Emergency_Team_Name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="width: 200px;">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


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