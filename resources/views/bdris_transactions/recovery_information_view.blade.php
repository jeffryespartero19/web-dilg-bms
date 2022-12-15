@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Recovery Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BDRIS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('recovery_information_list')}}">Recovery Information List</a></li>
                        <li class="breadcrumb-item active">Recovery Information</li>
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
<div class="tableX_row col-md-12 up_marg5">
<input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
    <br>
    <div class="col-md-12">
        <form id="newRecovery_Information" method="POST" action="{{ route('create_recovery_information') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                
                <input type="text" class="form-control" id="Disaster_Recovery_ID" name="Disaster_Recovery_ID" value="{{$recovery[0]->Disaster_Recovery_ID}}" hidden>
                <div class="row">

                    <div class="form-group col-lg-8" style="padding:0 10px">
                        <label for="Disaster_Response_ID">Disaster Response</label>
                        <select class="form-control" id="Disaster_Response_ID" name="Disaster_Response_ID">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($response_information as $bt1)
                            <option value="{{ $bt1->Disaster_Response_ID }}" {{ $bt1->Disaster_Response_ID  == $response_information[0]->Disaster_Response_ID  ? "selected" : "" }}>{{ $bt1->Disaster_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-12" style="padding:0 10px">
                        <label for="fileattach">File Attachments</label>
                        <ul class="list-group list-group-flush" id="recovery_information_files">
                            @foreach($attachment as $fa)
                            <li class="list-group-item">{{$fa->File_Name}}<a href="../files/uploads/recovery_information/{{$fa->File_Name}}" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a>|<button type="button" class="btn att_del" value="{{$fa->Attachment_ID }}" style="color: red; margin-left:2px;">Delete</button></li>
                            @endforeach
                            <br>
                            <div class="input-group my-3">
                                <div class="custom-file">
                                    <input type="file" name="fileattach[]" id="fileattach" multiple onchange="javascript:updateList()" />
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-lg-12" style="padding:0 10px" id="AffectedDetails">
                    <h3>Affected Household and Infrastructure</h3>
                    <a onclick="addrow();" style="float: right; cursor:pointer">+ Add</a>
                    <table id="AffectedTBL" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th hidden>Resident_ID</th>
                                <th>Household Name</th>
                                <th>Level of Damage</th>
                                <th>Affected Infrastructure Name</th>
                                <th>Address</th>
                                <th>Estimated Damage Value</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="AffectedBody">
                            @if($affected->count() > 0)
                            @foreach ($affected as $cd)
                            <tr class="AffectedDetails">
                                <td hidden></td>
                                <td>
                                    <select class="form-control js-example-basic-single mySelect2" name="Household_Profile_ID[]" style="width: 250px;">
                                        <option value='' disabled selected>Select Option</option>
                                        @foreach($household_profile as $bt1)
                                        <option value="{{ $bt1->Household_Profile_ID }}" {{ $bt1->Household_Profile_ID == $cd->Household_Profile_ID  ? "selected" : "" }}>{{ $bt1->Household_Name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control js-example-basic-single mySelect2" name="Level_of_Damage_ID[]" style="width: 250px;">
                                        <option value='' disabled selected>Select Option</option>
                                        @foreach($level_of_damage as $bt1)
                                        <option value="{{ $bt1->Level_of_Damage_ID }}" {{ $bt1->Level_of_Damage_ID == $cd->Level_of_Damage_ID  ? "selected" : "" }}>{{ $bt1->Level_of_Damage }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="sm_data_col txtCtr">
                                    <input type="text" class="form-control" name="Affected_Infrastructure_Name[]" value="{{$affected[0]->Affected_Infrastructure_Name}}" style="width: 250px;">
                                </td>
                                <td class="sm_data_col txtCtr">
                                    <input type="text" class="form-control" name="Address[]" value="{{$affected[0]->Address}}" style="width: 300px;">
                                </td>
                                <td class="sm_data_col txtCtr">
                                    <input type="number" class="form-control" name="Estimated_Damage_Value[]" value="{{$affected[0]->Estimated_Damage_Value}}" style="width: 200px;">
                                </td>
                                <td class="sm_data_col txtCtr">
                                    <input type="text" class="form-control" name="Remarks[]" value="{{$affected[0]->Remarks}}" style="width: 300px;">
                                </td>
                                <td style="text-align: center; width:10%">
                                    <button type="button" class="btn btn-danger AffectedRemove">Remove</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr class="AffectedDetails">
                                <td hidden></td>
                                <td>
                                    <select class="form-control js-example-basic-single mySelect2" name="Household_Profile_ID[]" style="width: 250px;">
                                        <option value=0 disabled selected>Select Option</option>
                                        @foreach($household_profile as $bt1)
                                        <option value="{{ $bt1->Household_Profile_ID }}">{{ $bt1->Household_Name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control js-example-basic-single mySelect2" name="Level_of_Damage_ID[]" style="width: 250px;">
                                        <option value=0 disabled selected>Select Option</option>
                                        @foreach($level_of_damage as $bt1)
                                        <option value="{{ $bt1->Level_of_Damage_ID }}">{{ $bt1->Level_of_Damage }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="sm_data_col txtCtr">
                                    <input type="text" class="form-control" name="Affected_Infrastructure_Name[]" value="{{$affected[0]->Affected_Infrastructure_Name}}" style="width: 250px;">
                                </td>
                                <td class="sm_data_col txtCtr">
                                    <input type="text" class="form-control" name="Address[]" value="{{$affected[0]->Address}}" style="width: 300px;">
                                </td>
                                <td class="sm_data_col txtCtr">
                                    <input type="number" class="form-control" name="Estimated_Damage_Value[]" value="{{$affected[0]->Estimated_Damage_Value}}" style="width: 200px;">
                                </td>
                                <td class="sm_data_col txtCtr">
                                    <input type="text" class="form-control" name="Remarks[]" value="{{$affected[0]->Remarks}}" style="width: 300px;">
                                </td>
                                <td style="text-align: center; width:10%">
                                    <button type="button" class="btn btn-danger AffectedRemove">Remove</button>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="form-group col-lg-12" style="padding:0 10px" id="RecoveryDetails">
                    <h3>Recovery Damage Loss</h3>
                    <a onclick="addrow2();" style="float: right; cursor:pointer">+ Add</a>
                    <table id="RecoveryTBL" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th hidden>Resident_ID</th>
                                <th>Livestock Loss Estimated Value</th>
                                <th>Poultry Loss Estimated Value</th>
                                <th>Fisheries Loss Estimated Value</th>
                                <th>Crops Loss Estimated Value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="RecoveryBody">
                            @if($damage->count() > 0)
                            @foreach ($damage as $cd)
                            <tr class="RecoveryDetails">
                                <td hidden></td>
                                <td class="sm_data_col txtCtr">
                                    <input type="number" class="form-control" name="Livestock_Loss_Estimated_Value[]" value="{{$cd->Livestock_Loss_Estimated_Value}}" style="width: 250px;">
                                </td>
                                <td class="sm_data_col txtCtr">
                                    <input type="number" class="form-control" name="Poultry_Loss_Estimated_Value[]" value="{{$cd->Poultry_Loss_Estimated_Value}}" style="width: 250px;">
                                </td>
                                <td class="sm_data_col txtCtr">
                                    <input type="number" class="form-control" name="Fisheries_Loss_Estimated_Value[]" value="{{$cd->Fisheries_Loss_Estimated_Value}}" style="width: 250px;">
                                </td>
                                <td class="sm_data_col txtCtr">
                                    <input type="number" class="form-control" name="Crops_Loss_Estimated_Value[]" value="{{$cd->Crops_Loss_Estimated_Value}}" style="width: 250px;">
                                </td>
                                <td style="text-align: center; width:10%">
                                    <button type="button" class="btn btn-danger RecoveryRemove">Remove</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr class="RecoveryDetails">
                                <td hidden></td>
                                <td class="sm_data_col txtCtr">
                                    <input type="number" class="form-control" name="Livestock_Loss_Estimated_Value[]" value="{{$cd->Livestock_Loss_Estimated_Value}}" style="width: 250px;">
                                </td>
                                <td class="sm_data_col txtCtr">
                                    <input type="number" class="form-control" name="Poultry_Loss_Estimated_Value[]" value="{{$cd->Poultry_Loss_Estimated_Value}}" style="width: 250px;">
                                </td>
                                <td class="sm_data_col txtCtr">
                                    <input type="number" class="form-control" name="Fisheries_Loss_Estimated_Value[]" value="{{$cd->Fisheries_Loss_Estimated_Value}}" style="width: 250px;">
                                </td>
                                <td class="sm_data_col txtCtr">
                                    <input type="number" class="form-control" name="Crops_Loss_Estimated_Value[]" value="{{$cd->Crops_Loss_Estimated_Value}}" style="width: 250px;">
                                </td>
                                <td style="text-align: center; width:10%">
                                    <button type="button" class="btn btn-danger RecoveryRemove">Remove</button>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <hr>


                <div class="form-group col-lg-12" style="padding:0 10px;">
                    <h3>Casualties and Injured</h3>
                    <a onclick="addResident();" style="float: right; cursor:pointer">+ Add</a>
                    <br>
                    <div style="overflow-x:auto;" id="CasualtiesDetails">

                        <table id="ResidentTBL" class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th hidden>Resident_ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Resident Status</th>
                                    <th>Address</th>
                                    <th>Birthdate</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="HSBody">
                                @if($injured->count() > 0)
                                @foreach ($injured as $id)
                                <tr class="HRDetails">
                                    <td hidden></td>
                                    <td>
                                        <select class="form-control js-example-basic-single Resident_Select2 mySelect2" name="Resident_ID[]" style="width: 350px;">
                                            <option value='' disabled selected>Select Option</option>
                                            @if($id->Resident_ID == 0)
                                            <option value="{{ $id->Non_Resident_Name }}" selected>{{ $id->Non_Resident_Name }}</option>
                                            @foreach($resident as $rs)
                                            <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                            @endforeach
                                            @else
                                            @foreach($resident as $rs)
                                            <option value="{{ $rs->Resident_ID }}" {{ $rs->Resident_ID == $id->Resident_ID  ? "selected" : "" }}>{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control Casualty_Status_ID" name="Casualty_Status_ID[]" style="width: 200px;">
                                            <option value='' disabled selected>Select Option</option>
                                            @foreach($casualty as $ip)
                                            <option value="{{ $ip->Casualty_Status_ID  }}" {{ $ip->Casualty_Status_ID == $id->Casualty_Status_ID  ? "selected" : "" }}>{{ $ip->Casualty_Status }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" style="width: 200px; pointer-events:none" name="Residency_Status[]">
                                            <option value='' disabled selected>Select Option</option>
                                            <option value=0 {{ 0 == $id->Residency_Status  ? "selected" : "" }}>Non-Resident</option>
                                            <option value=1 {{ 1 == $id->Residency_Status  ? "selected" : "" }}>Resident</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" style="width: 350px;" name="Non_Resident_Address[]" value="{{$id->Non_Resident_Address}}">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" style="width: 200px;" name="Non_Resident_Birthdate[]" value="{{$id->Non_Resident_Birthdate}}">
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
                                        <select class="form-control js-example-basic-single Resident_Select2 mySelect2" name="Resident_ID[]" style="width: 350px;">
                                            <option value='' disabled selected>Select Option</option>
                                            @foreach($resident as $rs)
                                            <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control Casualty_Status_ID" name="Casualty_Status_ID[]" style="width: 200px;">
                                            <option value='' disabled selected>Select Option</option>
                                            @foreach($casualty as $ip)
                                            <option value="{{ $ip->Casualty_Status_ID  }}">{{ $ip->Casualty_Status }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" style="width: 200px; pointer-events:none" name="Residency_Status[]">
                                            <option value='' disabled selected>Select Option</option>
                                            <option value=0>Non-Resident</option>
                                            <option value=1>Resident</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" style="width: 350px;" name="Non_Resident_Address[]">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" style="width: 200px;" name="Non_Resident_Birthdate[]">
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-danger HRRemove">Remove</button>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="form-group col-lg-12" style="padding:0 10px;">
                    <h3>Missing</h3>
                    <a onclick="addResident2();" style="float: right; cursor:pointer">+ Add</a>
                    <br>
                    <div style="overflow-x:auto;" id="MissingDetails">

                        <table id="Resident2TBL" class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th hidden>Resident_ID</th>
                                    <th>Name</th>
                                    <th>Resident Status</th>
                                    <th>Address</th>
                                    <th>Birthdate</th>
                                    <th>Individual Found</th>
                                    <th>Date Found</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="HS2Body">
                                @if($missing->count() > 0)
                                @foreach ($missing as $id)
                                <tr class="HR2Details">
                                    <td hidden></td>
                                    <td>
                                        <select class="form-control js-example-basic-single Resident_Select3 mySelect3" name="Resident_Missing_ID[]" style="width: 350px;">
                                            <option value='' disabled selected>Select Option</option>
                                            @if($id->Resident_ID == 0)
                                            <option value="{{ $id->Non_Resident_Name }}" selected>{{ $id->Non_Resident_Name }}</option>
                                            @foreach($resident2 as $rs)
                                            <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                            @endforeach
                                            @else
                                            @foreach($resident2 as $rs)
                                            <option value="{{ $rs->Resident_ID }}" {{ $rs->Resident_ID == $id->Resident_ID  ? "selected" : "" }}>{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" style="width: 200px; pointer-events:none" name="Residency_Missing_Status[]">
                                            <option value='' disabled selected>Select Option</option>
                                            <option value=0 {{ 0 == $id->Residency_Status  ? "selected" : "" }}>Non-Resident</option>
                                            <option value=1 {{ 1 == $id->Residency_Status  ? "selected" : "" }}>Resident</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" style="width: 350px;" name="Non_Resident_Missing_Address[]" value="{{$id->Non_Resident_Address}}">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" style="width: 200px;" name="Non_Resident_Missing_Birthdate[]" value="{{$id->Non_Resident_Birthdate}}">
                                    </td>
                                    <td>
                                        <select class="form-control" style="width: 200px; " name="Individual_Found[]">
                                            <option value='' selected>Select Option</option>
                                            <option value=0 {{ 0 == $id->Individual_Found  ? "selected" : "" }}>No</option>
                                            <option value=1 {{ 1 == $id->Individual_Found  ? "selected" : "" }}>Yes</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" style="width: 200px;" name="Date_Found[]" value="{{$id->Date_Found}}">
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-danger HR2Remove">Remove</button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr class="HR2Details">
                                    <td hidden></td>
                                    <td>
                                        <select class="form-control js-example-basic-single Resident_Select3 mySelect3" name="Resident_Missing_ID[]" style="width: 350px;">
                                            <option value='' disabled selected>Select Option</option>
                                            @foreach($resident2 as $rs)
                                            <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" style="width: 200px; pointer-events:none" name="Residency_Missing_Status[]">
                                            <option value='' disabled selected>Select Option</option>
                                            <option value=0>Non-Resident</option>
                                            <option value=1>Resident</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" style="width: 350px;" name="Non_Resident_Missing_Address[]">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" style="width: 200px;" name="Non_Resident_Missing_Birthdate[]">
                                    </td>
                                    <td>
                                        <select class="form-control" style="width: 200px;" name="Individual_Found[]">
                                            <option value=1>Yes</option>
                                            <option value=0>No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" style="width: 200px;" name="Date_Found[]">
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-danger HR2Remove">Remove</button>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
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


@endsection

@section('scripts')

<script>
    
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

       
    });

    function addResident2() {
        var row = $("#Resident2TBL tr:last");

        row.find(".js-example-basic-single").each(function(index) {
            $(this).select2('destroy');
        });

        var newrow = row.clone();

        $("#Resident2TBL").append(newrow);
        $(newrow.find("td:eq(1) input")).val('');
        $(newrow.find("td:eq(2) input")).val('');
        $(newrow.find("td:eq(3) input")).val('');
        $(newrow.find("td:eq(4) input")).val('');
        $(newrow.find("td:eq(5) input")).val('');
        $(newrow.find("td:eq(6) input")).val('');

        $("select.js-example-basic-single").select2();

       
    }

    function addResident() {
        var row = $("#ResidentTBL tr:last");

        row.find(".js-example-basic-single").each(function(index) {
            $(this).select2('destroy');
        });

        var newrow = row.clone();

        $("#ResidentTBL").append(newrow);

        $(newrow.find("td:eq(4) input")).val('');
        $(newrow.find("td:eq(5) input")).val('');

        $("select.js-example-basic-single").select2();

        $(".Resident_Select2").select2({
            tags: true
        });
    }

    function addrow() {
        var row = $("#AffectedTBL tr:last");

        row.find(".js-example-basic-single").each(function(index) {
            $(this).select2('destroy');
        });

        var newrow = row.clone();

        $("#AffectedTBL").append(newrow);
        
        $(newrow.find("td:eq(1) input")).val(0);
        $(newrow.find("td:eq(2) input")).val(0);
        $(newrow.find("td:eq(3) input")).val('');
        $(newrow.find("td:eq(4) input")).val('');
        $(newrow.find("td:eq(5) input")).val('');
        $(newrow.find("td:eq(6) input")).val('');

        $("select.js-example-basic-single").select2();

    }

    function addrow2() {
        var row = $("#RecoveryTBL tr:last");

        row.find(".js-example-basic-single").each(function(index) {
            $(this).select2('destroy');
        });

        var newrow = row.clone();

        $("#RecoveryTBL").append(newrow);

        $(newrow.find("td:eq(1) input")).val('');
        $(newrow.find("td:eq(2) input")).val('');
        $(newrow.find("td:eq(3) input")).val('');
        $(newrow.find("td:eq(4) input")).val('');

        $("select.js-example-basic-single").select2();
    }

    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
        var disID = $(this).val();
        $.ajax({
            url: "/get_recovery_information_attachments",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                data.forEach(element => {
                    var file = '<li class="list-group-item">' + element['File_Name'] + '<a href="./files/uploads/recovery_information/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a>|<button type="button" class="btn ord_del" value="' + element['Attachment_ID'] + '" style="color: red; margin-left:2px;">Delete</button></li>';
                    $('#recovery_information_files').append(file);
                });
            }
        });
    });

    $(document).on('click', '.modal-close', function(e) {
        $('#newRecovery_Information').trigger("reset");
    });

    // Populate Province
    $(document).on("change", "#Region_ID", function() {
        // alert('test');
        var Region_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_province/" + Region_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#Province_ID').empty();
                $('#City_Municipality_ID').empty();
                $('#Barangay_ID').empty();


                var option1 =
                    "<option value='' disabled selected>Select Option</option>";
                $('#Province_ID').append(option1);
                $('#City_Municipality_ID').append(option1);
                $('#Barangay_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["Province_ID"] +
                        "'>" +
                        element["Province_Name"] +
                        "</option>";
                    $('#Province_ID').append(option);
                });
            }
        });


    });

    // Populate City
    $(document).on("change", "#Province_ID", function() {
        var Province_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_city/" + Province_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#City_Municipality_ID').empty();
                $('#Barangay_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#City_Municipality_ID').append(option1);
                $('#Barangay_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["City_Municipality_ID"] +
                        "'>" +
                        element["City_Municipality_Name"] +
                        "</option>";
                    $('#City_Municipality_ID').append(option);
                });
            }
        });
    });

    // Populate Barangay
    $(document).on("change", "#City_Municipality_ID", function() {
        var City_Municipality_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_barangay/" + City_Municipality_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#Barangay_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#Barangay_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["Barangay_ID"] +
                        "'>" +
                        element["Barangay_Name"] +
                        "</option>";
                    $('#Barangay_ID').append(option);
                });
            }
        });
    });


    // Edit Button Display Modal
    $(document).on('click', ('.edit_recovery_information'), function(e) {
        $('#Modal_Title').text('Edit Recovery Information');
        var disID = $(this).val();
        $.ajax({
            url: "/get_recovery_information",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Disaster_Recovery_ID').val(data['theEntry'][0]['Disaster_Recovery_ID']);
                $('#Disaster_Response_ID').val(data['theEntry'][0]['Disaster_Response_ID']);
                $('#Region_ID').val(data['theEntry'][0]['Region_ID']);


                var barangay =
                    " <option value='" + data['theEntry'][0]['Barangay_ID'] + "' selected>" + data['theEntry'][0]['Barangay_Name'] + "</option>";
                $('#Barangay_ID').append(barangay);

                var city =
                    " <option value='" + data['theEntry'][0]['City_Municipality_ID'] + "' selected>" + data['theEntry'][0]['City_Municipality_Name'] + "</option>";
                $('#City_Municipality_ID').append(city);

                var province =
                    " <option value='" + data['theEntry'][0]['Province_ID'] + "' selected>" + data['theEntry'][0]['Province_Name'] + "</option>";
                $('#Province_ID').append(province);



            }
        });

    });


    $(document).on('click', '.modal-close', function(e) {
        $('#newBrgy_Projects_Monitoring').trigger("reset");
        $('#Barangay_ID').empty();
        $('#City_Municipality_ID').empty();
        $('#Province_ID').empty();
        var option1 = "<option value='' disabled selected>Select Option</option>";
        $('#Barangay_ID').append(option1);
        $('#City_Municipality_ID').append(option1);
        $('#Province_ID').append(option1);
        $('#recovery_information_files').empty();
        $('#Modal_Title').text('Create Recovery Information');

    });

    // Clone Affected Household TR
    $("#btnAddAffected_Household").on("click", function() {

        var $tableBody = $('#Affected_Household').find("tbody"),
            $trLast = $tableBody.find("tr:last"),
            $trNew = $trLast.clone().find("input, select").val("").removeAttr('selected').end();

        $trLast.after($trNew);
    });

    // Clone Recovery Damage Loss TR
    $("#btnAddRecovery_Damage_Loss").on("click", function() {

        var $tableBody = $('#Recovery_Damage_Loss').find("tbody"),
            $trLast = $tableBody.find("tr:last"),
            $trNew = $trLast.clone().find("input, select").val("").removeAttr('selected').end();

        $trLast.after($trNew);
    });


    // Remove Affected Household TR
    $("#Affected_Household").on("click", ".removeRow", function() {
        $(this).closest("tr").remove();
    });

    // Remove Recovery Damage Loss TR
    $("#Recovery_Damage_Loss").on("click", ".removeRowRec", function() {
        $(this).closest("tr").remove();

        var $tableBody = $('#Recovery_Damage_Loss').find("tbody"),
            $trLast = $tableBody.find("tr:last"),
            $trNew = $trLast.clone().find("input, select").val("").removeAttr('selected').end();

        $trLast.after($trNew);
    });

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    // File Attachments Modal
    $(document).on('click', ('.att_del'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_recovery_information_attachments",
                    type: 'GET',
                    data: {
                        id: disID
                    },
                    fail: function() {
                        alert('request failed');
                    },
                    success: function(data) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        location.reload();
                    }
                });

            }
        });

    });

    // Option Affected Remove
    $(".AffectedBody").on("click", ".AffectedRemove", function() {
        $(this).closest(".AffectedDetails").remove();
    });
    // Option Recovery Damage loss Remove
    $(".RecoveryBody").on("click", ".RecoveryRemove", function() {
        $(this).closest(".RecoveryDetails").remove();
    });

    // Option Resident Remove
    $(".HSBody").on("click", ".HRRemove", function() {
        $(this).closest(".HRDetails").remove();
    });
    // Option Resident Missing Remove
    $(".HS2Body").on("click", ".HR2Remove", function() {
        $(this).closest(".HR2Details").remove();
    });

    // Resident Casualties Change 
    $('#CasualtiesDetails').on("change", ".Resident_Select2", function() {
        var Resident_Select2 = $(this).val();
        var Type = $.isNumeric(Resident_Select2);
        var disID = Resident_Select2;

        // alert(Type);
        $row = $(this).closest(".HRDetails");
        $($row.find('td:eq(5) input')).val('');
        $($row.find('td:eq(4) input')).val('');
        $($row.find('td:eq(3) select')).val('');
        if (Type == true) {
            $($row.find('td:eq(3) select')).val(1);

            $.ajax({
                url: "/get_inhabitants_info",
                type: 'GET',
                data: {
                    id: disID
                },
                fail: function() {
                    alert('request failed');
                },
                success: function(data) {
                    $($row.find('td:eq(5) input')).val(data['theEntry'][0]['Birthdate']);
                    $($row.find('td:eq(4) input')).val(data['theEntry'][0]['Barangay_Name'] + ', ' + data['theEntry'][0]['City_Municipality_Name'] + ', ' + data['theEntry'][0]['Province_Name'] + ', ' + data['theEntry'][0]['Region_Name']);
                }
            });
        } else {
            $($row.find('td:eq(3) select')).val(0);
        }
    });

    // Resident Missing Change
    $('#MissingDetails').on("change", ".Resident_Select3", function() {
        var Resident_Select3 = $(this).val();
        var Type = $.isNumeric(Resident_Select3);
        var disID = Resident_Select3;

        // alert(Type);
        $row = $(this).closest(".HR2Details");
        $($row.find('td:eq(5) input')).val('');
        $($row.find('td:eq(3) input')).val('');
        $($row.find('td:eq(4) input')).val('');
        $($row.find('td:eq(6) input')).val('');
        $($row.find('td:eq(2) select')).val('');
        if (Type == true) {
            $($row.find('td:eq(2) select')).val(1);

            $.ajax({
                url: "/get_inhabitants_info",
                type: 'GET',
                data: {
                    id: disID
                },
                fail: function() {
                    alert('request failed');
                },
                success: function(data) {
                    $($row.find('td:eq(4) input')).val(data['theEntry'][0]['Birthdate']);
                    $($row.find('td:eq(3) input')).val(data['theEntry'][0]['Barangay_Name'] + ', ' + data['theEntry'][0]['City_Municipality_Name'] + ', ' + data['theEntry'][0]['Province_Name'] + ', ' + data['theEntry'][0]['Region_Name']);
                }
            });
        } else {
            $($row.find('td:eq(2) select')).val(0);
        }
    });

     // Disable Form if DILG USER
     $(document).ready(function() {
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 1) {
            $("#newRecovery_Information :input").prop("disabled", true);
        }
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.recoveryInfo').addClass('active');
        $('.disaster_menu').addClass('active');
        $('.disaster_main').addClass('menu-open');
    });
</script>

<style>
    table {
        display: block;
        overflow-x: scroll;
    }

    .select2-selection {
        height: 32px !important;
        padding: 3px 3px;
        font: 13px;
    }

    .select3-selection {
        height: 32px !important;
        padding: 3px 3px;
        font: 13px;
    }
</style>

@endsection