@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Deceased Profile List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;Deceased Profile List</li>
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
        <div class="twenty_split txtRight"><button data-toggle="modal" class="btn btn-success" data-target="#createDeceased_Profile" style="width: 100px;">New</button></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Resident_ID</th>
                    <th>Name</th>
                    <th>Deceased Type</th>
                    <th>Cause of Death</th>
                    <th>Date of Death</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Resident_ID}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Last_Name}} {{$x->First_Name}}, {{$x->Middle_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Deceased_Type}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Cause_of_Death}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Date_of_Death}}</td>
                    <td class="sm_data_col txtCtr"> 
                        <button class="edit_deceased_profile" value="{{$x->Resident_ID}}" data-toggle="modal" data-target="#updateDeceased_Profile">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Announcement_Status Modal  -->

<div class="modal fade" id="createDeceased_Profile" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Create Deceased Profile</h4>
            </div>
            <div class="modal-body">
                <form id="newInhabitant" method="POST" action="{{ route('create_deceased_profile') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Resident Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Resident_ID" name="Resident_ID" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Resident_ID">Name</label>
                                <select class="form-control" id="Resident_IDs" name="Resident_IDs">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($name as $bt)
                                    <option value="{{ $bt->Resident_ID }}">{{ $bt->Last_Name }} {{ $bt->First_Name }}, {{ $bt->Middle_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Deceased_Type_ID">Deceased Type</label>
                                <select class="form-control" id="Deceased_Type_ID" name="Deceased_Type_ID">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($deceased_type as $bt1)
                                    <option value="{{ $bt1->Deceased_Type_ID }}">{{ $bt1->Deceased_Type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h3>Death Information</h3>
                        <br>
                        <div class="row">
                            <div class="form-group col-lg-9" style="padding:0 10px">
                                <label for="Cause_of_Death">Cause of Death</label>
                                <input type="text" class="form-control" id="Cause_of_Death" name="Cause_of_Death">
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Date_of_Death">Date of Death</label>
                                <input type="date" class="form-control" id="Date_of_Death" name="Date_of_Death" required>
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




<div class="modal fade" id="updateDeceased_Profile" tabindex="-1" role="dialog" aria-labelledby="Update_Deceased_Profile" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Create Deceased Profile</h4>
            </div>
            <div class="modal-body">
                <form id="newDeceased_Profile" method="POST" action="{{ route('update_deceased_profile') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Resident Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Resident_ID2" name="Resident_ID2" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Resident_IDs2">Name</label>
                                <select class="form-control" id="Resident_IDs2" name="Resident_IDs2">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($name as $bt)
                                    <option value="{{ $bt->Resident_ID }}">{{ $bt->Last_Name }} {{ $bt->First_Name }}, {{ $bt->Middle_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Deceased_Type_ID2">Deceased Type</label>
                                <select class="form-control" id="Deceased_Type_ID2" name="Deceased_Type_ID2">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($deceased_type as $bt1)
                                    <option value="{{ $bt1->Deceased_Type_ID }}">{{ $bt1->Deceased_Type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h3>Death Information</h3>
                        <br>
                        <div class="row">
                            <div class="form-group col-lg-9" style="padding:0 10px">
                                <label for="Cause_of_Death2">Cause of Death</label>
                                <input type="text" class="form-control" id="Cause_of_Death2" name="Cause_of_Death2">
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Date_of_Death2">Date of Death</label>
                                <input type="date" class="form-control" id="Date_of_Death2" name="Date_of_Death2" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="width: 200px;">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    $(document).on('click', '.modal-close', function(e) {
        $('#newInhabitant').trigger("reset");
    });




    // Edit Button Display Modal
    $(document).on('click', ('.edit_deceased_profile'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_deceased_profile",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Resident_ID2').val(data['theEntry'][0]['Resident_ID']);
                $('#Resident_IDs2').val(data['theEntry'][0]['Resident_ID']);
                $('#Cause_of_Death2').val(data['theEntry'][0]['Cause_of_Death']);
                $('#Deceased_Type_ID2').val(data['theEntry'][0]['Deceased_Type_ID']);
                $('#Date_of_Death2').val(data['theEntry'][0]['Date_of_Death']);
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