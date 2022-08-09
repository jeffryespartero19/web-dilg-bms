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
                    <th>Resident Status</th>
                    <th>Voter Status</th>
                    <th>Resident Voter</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Resident_ID}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Last_Name}}, {{$x->First_Name}} {{$x->Middle_Name}} {{$x->Name_Suffix}}</td>
                    <td class="sm_data_col txtCtr">@if($x->Resident_Status == 1) Yes @else No @endif</td>
                    <td class="sm_data_col txtCtr">@if($x->Voter_Status == 1) Yes @else No @endif</td>
                    <td class="sm_data_col txtCtr">@if($x->Resident_Voter == 1) Yes @else No @endif</td>
                    <td class="sm_data_col txtCtr">
                        <button class="edit_resident" value="{{$x->Resident_ID}}" data-toggle="modal" data-target="#createResident_Info">Edit</button>
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
                <form id="newResident" method="POST" action="{{ route('create_resident_information') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Resident Information</h3>
                        <br>
                        <div class="row">
                            <input type="number" class="form-control" id="Resident_Profile_ID" name="Resident_Profile_ID" hidden>
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="Resident_ID">Name</label>
                                <select class="form-control" id="Resident_ID" name="Resident_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($resident as $rs)
                                    <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Resident_Status">Resident Status</label>
                                <select class="form-control" id="Resident_Status" name="Resident_Status" required>
                                    <option value='' disabled selected>Select Option</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Voter_Status">Voter Status</label>
                                <select class="form-control" id="Voter_Status" name="Voter_Status" required>
                                    <option value='' disabled selected>Select Option</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Election_Year_Last_Voted">Election Year Last Voted</label>
                                <input type="date" class="form-control" id="Election_Year_Last_Voted" name="Election_Year_Last_Voted" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Resident_Voter">Resident Voter</label>
                                <select class="form-control" id="Resident_Voter" name="Resident_Voter" required>
                                    <option value='' disabled selected>Select Option</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select>
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
        $('#Resident_ID').empty();
        var resident =
            '<option value="" disabled selected>Select Option</option>@foreach($resident as $rs)<option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>@endforeach';
        $('#Resident_ID').append(resident);
    });

    // Edit Button Display Modal
    $(document).on('click', ('.edit_resident'), function(e) {

        var disID = $(this).val();
        $('#Modal_Title').text('Edit Resident Profile');

        $.ajax({
            url: "/get_resident_info",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Resident_Status').val(data['theEntry'][0]['Resident_Status']);
                $('#Voter_Status').val(data['theEntry'][0]['Voter_Status']);
                $('#Resident_Voter').val(data['theEntry'][0]['Resident_Voter']);
                $('#Election_Year_Last_Voted').val(data['theEntry'][0]['Election_Year_Last_Voted']);
                $('#Resident_ID').empty();
                var resident =
                    " <option value='" + data['theEntry'][0]['Resident_ID'] + "' selected>" + data['theEntry'][0]['Last_Name'] + ", " + data['theEntry'][0]['First_Name'] + " " + data['theEntry'][0]['Middle_Name'] + " " + data['theEntry'][0]['Name_Suffix'] + "</option>";
                $('#Resident_ID').append(resident);

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