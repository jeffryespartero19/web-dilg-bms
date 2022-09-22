@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Ordinance Violator List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;Ordinance Violator List</li>
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
        <div class="twenty_split txtRight"><a href="{{ url('ordinance_violator_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Ordinance_Violators_ID</th>
                    <th>Name</th>
                    <th>Penalty</th>
                    <th>Status</th>
                    <th>Date/Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col" hidden>{{$x->Ordinance_Violators_ID}}</td>
                    <td class="sm_data_col">{{$x->Last_Name}}, {{$x->First_Name}} {{$x->Middle_Name}}</td>
                    <td class="sm_data_col">{{$x->Type_of_Penalties}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Violation_Status}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Vilotation_Date}}</td>
                    <td class="sm_data_col txtCtr">
                        <a class="btn btn-success" href="{{ url('ordinance_violator_details/'.$x->Ordinance_Violators_ID) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

    $('.mySelect2').select2({
        dropdownParent: $('#createBlotter')
    });

    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();

    });
</script>

<style>
    .select2-selection {
        height: 34px !important;
        padding: 3px 8px;
        font: 14px;
    }
</style>

@endsection