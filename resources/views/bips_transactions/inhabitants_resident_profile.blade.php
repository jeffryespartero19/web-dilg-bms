@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Resident List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;Resident List</li>
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
        <div class="twenty_split txtRight"><button data-toggle="modal" class="btn btn-success" data-target="#createResident_Info" style="width: 100px;">New</button></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Resident_ID</th>
                    <th>Name</th>
                    <th>Resident Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Resident_ID}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Last_Name}}, {{$x->First_Name}} {{$x->Middle_Name}} {{$x->Name_Suffix}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Resident_Name}}</td>
                    <td class="sm_data_col txtCtr">
                        <button class="edit_household" value="{{$x->Resident_Profile_ID}}" data-toggle="modal" data-target="#createResident_Info">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Announcement_Status Modal -->

<div class="modal fade" id="createResident_Info" tabindex="-1" role="dialog" aria-labelledby="createResident_Info" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier" id="Modal_Title">Create Resident Profile</h4>
            </div>
            <div class="modal-body">
                <form id="newResident" method="POST" action="{{ route('create_household_information') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Resident Information</h3>
                        <br>
                        <div class="row">
                            <input type="number" class="form-control" id="Resident_Profile_ID" name="Resident_Profile_ID" hidden>
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="Resident_ID">Inhabitant Name</label>
                                <select class="form-control" id="Resident_ID" name="Resident_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($resident as $rs)
                                    <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Resident_Monthly_Income">Resident Monthly Income</label>
                                <input type="number" class="form-control" id="Resident_Monthly_Income" name="Resident_Monthly_Income" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Family Position</label>
                                <select class="form-control" id="Family_Position_ID" name="Family_Position_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($family_position as $fp)
                                    <option value="{{ $fp->Family_Position_ID }}">{{ $fp->Family_Position }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Tenure of Lot</label>
                                <select class="form-control" id="Tenure_of_Lot_ID" name="Tenure_of_Lot_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($tenure_of_lot as $tol)
                                    <option value="{{ $tol->Tenure_of_Lot_ID }}">{{ $tol->Tenure_of_Lot }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Housing_Unit_ID">Housing Unit</label>
                                <select class="form-control" id="Housing_Unit_ID" name="Housing_Unit_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($housing_unit as $hu)
                                    <option value="{{ $hu->Housing_Unit_ID }}">{{ $hu->Housing_Unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Family_Type_ID">Family Type</label>
                                <select class="form-control" id="Family_Type_ID" name="Family_Type_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($family_type as $fm)
                                    <option value="{{ $fm->Family_Type_ID }}">{{ $fm->Family_Type_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Resident_Name">Resident Name</label>
                                <input type="text" class="form-control" id="Resident_Name" name="Resident_Name" required>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="width: 200px;">Create</button>
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
        $('#newResident').trigger("reset");
        $('#Modal_Title').text('Create Resident Profile');
    });

    // Edit Button Display Modal
    $(document).on('click', ('.edit_household'), function(e) {

        var disID = $(this).val();
        $('#Modal_Title').text('Edit Resident Profile');



        $.ajax({
            url: "/get_household_info",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Resident_Profile_ID').val(data['theEntry'][0]['Resident_Profile_ID']);
                $('#Resident_ID').val(data['theEntry'][0]['Resident_ID']);
                $('#Resident_Monthly_Income').val(data['theEntry'][0]['Resident_Monthly_Income']);
                $('#Resident_Name').val(data['theEntry'][0]['Resident_Name']);
                $('#Family_Position_ID').val(data['theEntry'][0]['Family_Position_ID']);
                $('#Tenure_of_Lot_ID').val(data['theEntry'][0]['Tenure_of_Lot_ID']);
                $('#Housing_Unit_ID').val(data['theEntry'][0]['Housing_Unit_ID']);
                $('#Family_Type_ID').val(data['theEntry'][0]['Family_Type_ID']);
            }
        });


    });
</script>

<style>
    /* table {
        display: block;
        overflow-x: scroll;
    } */
</style>

@endsection