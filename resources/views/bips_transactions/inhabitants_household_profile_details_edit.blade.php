@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Inhabitants Household Profile </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <a href="{{route('inhabitants_household_profile')}}">
                <li>&nbsp;Inhabitants Household List / </li>
            </a>
            <li> &nbsp;Inhabitants Household Profile</li>
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
    <div class="col-md-12">
        <form id="newHousehold" method="POST" action="{{ route('create_household_information') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <h3>Household Information</h3>
            <br>
            <div class="row">
                <input type="number" class="form-control" id="Household_Profile_ID" name="Household_Profile_ID" hidden value="{{$household[0]->Household_Profile_ID}}">
                <div class="form-group col-lg-6" style="padding:0 10px">
                    <label for="Household_Name">Household Name</label>
                    <input type="text" class="form-control" id="Household_Name" name="Household_Name" required value="{{$household[0]->Household_Name}}">
                </div>
                <div class="form-group col-lg-6" style="padding:0 10px">
                    <label for="Family_Type_ID">Family Type</label>
                    <select class="form-control" id="Family_Type_ID" name="Family_Type_ID" required>
                        <option value='' disabled selected>Select Option</option>
                        @foreach($family_type as $fm)
                        <option value="{{ $fm->Family_Type_ID }}" {{ $fm->Family_Type_ID  == $household[0]->Family_Type_ID  ? "selected" : "" }}>{{ $fm->Family_Type_Name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-12" style="padding:0 10px" id="HouseholdDetails">
                    <a onclick="addrow();" style="float: right; cursor:pointer">+ Add</a>
                    <table id="ResidentTBL" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th hidden>Resident_ID</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Head</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="HSBody">
                            @if($household_members->count() > 0)
                            @foreach ($household_members as $hm)
                            <tr class="HRDetails">
                                <td hidden></td>
                                <td>
                                    <select class="form-control js-example-basic-single mySelect2" name="Resident_ID[]" style="width: 100%;">
                                        <option value='' disabled selected>Select Option</option>
                                        @foreach($resident as $rs)
                                        <option value="{{ $rs->Resident_ID }}" {{ $rs->Resident_ID  == $hm->Resident_ID  ? "selected" : "" }}>{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control Family_Position_ID" name="Family_Position_ID[]">
                                        <option value='' disabled selected>Select Option</option>
                                        @foreach($family_position as $fp)
                                        <option value="{{ $fp->Family_Position_ID }}" {{ $fp->Family_Position_ID  == $hm->Family_Position_ID  ? "selected" : "" }}>{{ $fp->Family_Position }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="Family_Head[]">
                                        <option value=0 {{ 0  == $hm->Family_Head  ? "selected" : "" }}>No</option>
                                        <option value=1 {{ 1  == $hm->Family_Head  ? "selected" : "" }}>Yes</option>
                                    </select>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" class="btn btn-danger HRRemove">Remove</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr class="HRDetails">
                                <td hidden></td>
                                <td>
                                    <select class="form-control js-example-basic-single mySelect2" name="Resident_ID[]" style="width: 100%;">
                                        <option value='' disabled selected>Select Option</option>
                                        @foreach($resident as $rs)
                                        <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control Family_Position_ID" name="Family_Position_ID[]">
                                        <option value='' disabled selected>Select Option</option>
                                        @foreach($family_position as $fp)
                                        <option value="{{ $fp->Family_Position_ID }}">{{ $fp->Family_Position }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="Family_Head[]">
                                        <option value=0>No</option>
                                        <option value=1>Yes</option>
                                    </select>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" class="btn btn-danger HRRemove">Remove</button>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="form-group col-lg-6" style="padding:0 10px">
                    <label for="Household_Monthly_Income">Household Monthly Income</label>
                    <input type="number" class="form-control" id="Household_Monthly_Income" name="Household_Monthly_Income" required value="{{$household[0]->Household_Monthly_Income}}">
                </div>

                <div class="form-group col-lg-6" style="padding:0 10px">
                    <label for="exampleInputEmail1">Tenure of Lot</label>
                    <select class="form-control" id="Tenure_of_Lot_ID" name="Tenure_of_Lot_ID" required>
                        <option value='' disabled selected>Select Option</option>
                        @foreach($tenure_of_lot as $tol)
                        <option value="{{ $tol->Tenure_of_Lot_ID }}" {{ $tol->Tenure_of_Lot_ID  == $household[0]->Tenure_of_Lot_ID  ? "selected" : "" }}>{{ $tol->Tenure_of_Lot }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-6" style="padding:0 10px">
                    <label for="Housing_Unit_ID">Housing Unit</label>
                    <select class="form-control" id="Housing_Unit_ID" name="Housing_Unit_ID" required>
                        <option value='' disabled selected>Select Option</option>
                        @foreach($housing_unit as $hu)
                        <option value="{{ $hu->Housing_Unit_ID }}" {{ $hu->Housing_Unit_ID  == $household[0]->Housing_Unit_ID  ? "selected" : "" }}>{{ $hu->Housing_Unit }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <hr>
            <div class="col-lg-12">
                <center>
                    <!-- <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-primary" style="width: 200px;">Create</button>
                </center>
            </div>


        </form>

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

    //Select2
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

    function addrow() {
        var row = $("#ResidentTBL tr:last");

        row.find(".js-example-basic-single").each(function(index) {
            $(this).select2('destroy');
        });

        var newrow = row.clone();

        $("#ResidentTBL").append(newrow);

        $("select.js-example-basic-single").select2();
    }

    // Option Case Remove
    $(".HSBody").on("click", ".HRRemove", function() {
        $(this).closest(".HRDetails").remove();
    });
</script>

<style>
    .select2-selection {
        height: 32px !important;
        padding: 3px 3px;
        font: 13px;
    }
</style>

@endsection