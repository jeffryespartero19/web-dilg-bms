@extends('layouts.default')

@section('content')
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Inhabitants Incoming List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;Inhabitants Incoming List</li>
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
        <!-- <div class="twenty_split txtRight"><button data-toggle="modal" class="btn btn-success" data-target="#createInhabitants_Info" style="width: 100px;">New</button></div> -->
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Resident_ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Name Suffix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Resident_ID}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Last_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->First_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Middle_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Name_Suffix}}</td>
                    <td class="sm_data_col txtCtr">
                        <button class="approve_inhabitants btn btn-success" value="{{$x->Resident_ID}}">Approve</button>
                        <button class="disapprove_inhabitants  btn btn-danger" value="{{$x->Resident_ID}}">Disapprove</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div hidden>
        <form id="Approved_Inhabitant" method="POST" action="{{ route('approve_disapprove_inhabitants') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <input type="number" class="form-control" id="Resident_ID" name="Resident_ID">
            <input type="number" class="form-control" id="Status_ID" name="Status_ID">
        </form>
    </div>

</div>

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    // Approve Inhabitants
    $(document).on('click', ('.approve_inhabitants'), function(e) {

        var disID = $(this).val();
        $('#Resident_ID').val(disID);
        $('#Status_ID').val(1);

        $('#Approved_Inhabitant').submit();

    });

    // Disapprove Inhabitants
    $(document).on('click', ('.disapprove_inhabitants'), function(e) {

        var disID = $(this).val();
        $('#Resident_ID').val(disID);
        $('#Status_ID').val(2);

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