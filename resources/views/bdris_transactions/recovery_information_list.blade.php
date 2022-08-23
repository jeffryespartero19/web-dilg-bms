@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Recovery Information List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}"> 
                <li>DILG_BDRIS / </li>
            </a> 
            <li> &nbsp;Recovery Information List</li>
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
        <div class="twenty_split txtRight"><button data-toggle="modal" class="btn btn-success" data-target="#createRecovery_Information" style="width: 100px;">New</button></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Disaster Recovery</th>
                    <th >Disaster Name</th>
                    <th >Region </th>
                    <th >Province </th>
                    <th >City/Municipality </th>
                    <th >Barangay</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Disaster_Recovery_ID}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Disaster_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Region_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Province_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->City_Municipality_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Barangay_Name}}</td>
                    <td class="sm_data_col txtCtr"> 
                        <button class="edit_recovery_information" value="{{$x->Disaster_Recovery_ID}}" data-toggle="modal" data-target="#createRecovery_Information">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Announcement_Status Modal  -->

<div class="modal fade" id="createRecovery_Information" tabindex="-1" role="dialog" aria-labelledby="Create_Recovery_Information" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Recovery Information Profile</h4>
            </div>
            <div class="modal-body">
                <form id="newRecovery_Information" method="POST" action="{{ route('create_recovery_information') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body">
                        <h3>Recovery Information Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Disaster_Recovery_ID" name="Disaster_Recovery_ID" hidden>
                            <div class="form-group col-lg-8" style="padding:0 10px">
                                <label for="Disaster_Response_ID">Disaster Response</label>
                                <select class="form-control" id="Disaster_Response_ID" name="Disaster_Response_ID">
                                    <option value='' disabled selected>Select Option</option>
                                        @foreach($response_information as $bt1)
                                        <option value="{{ $bt1->Disaster_Response_ID }}">{{ $bt1->Disaster_Name }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="Region_ID">Region</label>
                                <select class="form-control" id="Region_ID" name="Region_ID">
                                    <option value='' disabled selected>Select Option</option>
                                        @foreach($region as $bt1)
                                        <option value="{{ $bt1->Region_ID }}">{{ $bt1->Region_Name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="Province_ID">Province</label>
                                <select class="form-control" id="Province_ID" name="Province_ID">
                                    <option value='' disabled selected>Select Option</option>
                                    

                                </select>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="City_Municipality_ID">City_Municipality</label>
                                <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID">
                                    <option value='' disabled selected>Select Option</option>
                                  

                                </select>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="Barangay_ID">Barangay</label>
                                <select class="form-control" id="Barangay_ID" name="Barangay_ID">
                                    <option value='' disabled selected>Select Option</option>
                                   
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h3>Affected Household and Infrastructure</h3>
                        <button type="button" class="btn btn-info" style="width: 100px;" id="btnAddAffected_Household">Add</button>
                        <div class="tableX_row row up_marg5">
                            <div class="col-md-12">
                                <table id="Affected_Household" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Household Name</th>
                                            <th>Level of Damage</th>
                                            <th>Affected Infrastructure Name</th>
                                            <th>Address</th>
                                            <th>Estimated_Damage_Value</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="Affected_HouseholdTBLD">
                                        <tr>
                                            <td class="sm_data_col txtCtr">
                                                <select class="form-control" name="Household_Profile_ID[]" style="width: 200px;">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($household_profile as $et)
                                                    <option value="{{ $et->Household_Profile_ID }}">{{ $et->Household_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="sm_data_col txtCtr">
                                                <select class="form-control" name="Level_of_Damage_ID[]" style="width: 200px;">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($level_of_damage as $et)
                                                    <option value="{{ $et->Level_of_Damage_ID }}">{{ $et->Level_of_Damage }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="sm_data_col txtCtr">
                                                <input type="text" class="form-control" name="Affected_Infrastructure_Name[]" style="width: 250px;">
                                            </td>
                                            <td class="sm_data_col txtCtr">
                                                <input type="text" class="form-control" name="Address[]" style="width: 300px;">
                                            </td>
                                            <td class="sm_data_col txtCtr">
                                                <input type="number" class="form-control" name="Estimated_Damage_Value[]" style="width: 200px;">
                                            </td>
                                            <td class="sm_data_col txtCtr">
                                                <input type="text" class="form-control" name="Remarks[]" style="width: 300px;">
                                            </td>
                                            <td class="sm_data_col txtCtr">
                                                <button type="button" class="removeRow btn btn-danger">Remove</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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

        $.ajax({
            url: "/get_affected_household",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#Affected_HouseholdTBLD').empty();
                data.forEach(element => {
                    var option =
                    '<tr>' +
                    '<td class="sm_data_col txtCtr">' +
                    '<select class="form-control" name="Household_Profile_ID[]" style="width: 200px;">' +
                    '<option value="" disabled selected>Select Option</option>' +
                    '@foreach($household_profile as $et)' +
                    '<option value="{{ $et->Household_Profile_ID}}" {{ $et->Household_Profile_ID  = "' + element['Household_Profile_ID'] + '" ? "selected" : "" }}>{{ $et->Household_Name}}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</td>' +
                    '<td class="sm_data_col txtCtr">' +
                    '<select class="form-control" name="Level_of_Damage_ID[]" style="width: 200px;">' +
                    '<option value="" disabled selected>Select Option</option>' +
                    '@foreach($level_of_damage as $et)' +
                    '<option value="{{ $et->Level_of_Damage_ID}}" {{ $et->Level_of_Damage_ID  = "' + element['Level_of_Damage_ID'] + '" ? "selected" : "" }}>{{ $et->Level_of_Damage}}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</td>' +
                    '<td class="sm_data_col txtCtr">' +
                    '<input type="text" class="form-control" name="Affected_Infrastructure_Name[]" style="width: 250px;"  value="' + element['Affected_Infrastructure_Name'] + '">' +
                    '</td>' +
                    '<td class="sm_data_col txtCtr">' +
                    '<input type="text" class="form-control" name="Address[]" style="width: 250px;"  value="' + element['Address'] + '">' +
                    '</td>' +
                    '<td class="sm_data_col txtCtr">' +
                    '<input type="number" class="form-control" name="Estimated_Damage_Value[]" style="width: 250px;"  value="' + element['Estimated_Damage_Value'] + '">' +
                    '</td>' +
                    '<td class="sm_data_col txtCtr">' +
                    '<input type="text" class="form-control" name="Remarks[]" style="width: 300px;"  value="' + element['Remarks'] + '">' +
                    '</td>' +
                    '<td class="sm_data_col txtCtr">' +
                    '<button type="button" class="removeRow btn btn-danger">Remove</button>' +
                    '</td>' +
                    '</tr>';
                    $('#Affected_HouseholdTBLD').append(option);
                });
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
       
        $('#Modal_Title').text('Create Recovery Information');

         // Reset Affected Household Table
         $('#Affected_HouseholdTBLD').empty();
        var option =
        '<tr>' +
        '<td class="sm_data_col txtCtr">' +
        '<select class="form-control" name="Household_Profile_ID[]" style="width: 200px;">' +
        '<option value="" disabled selected>Select Option</option>' +
        '@foreach($household_profile as $et)' +
        '<option value="{{ $et->Household_Profile_ID }}">{{ $et->Household_Name }}</option>' +
        '@endforeach' +
        '</select>' +
        '</td>' +
        '<td class="sm_data_col txtCtr">' +
        '<select class="form-control" name="Level_of_Damage_ID[]" style="width: 200px;">' +
        '<option value="" disabled selected>Select Option</option>' +
        '@foreach($level_of_damage as $et)' +
        '<option value="{{ $et->Level_of_Damage_ID }}">{{ $et->Level_of_Damage }}</option>' +
        '@endforeach' +
        '</select>' +
        '</td>' +
        '<td class="sm_data_col txtCtr">' +
        '<input type="text" class="form-control" name="Affected_Infrastructure_Name[]" style="width: 250px;">' +
        '</td>' +
        '<td class="sm_data_col txtCtr">' +
        '<input type="text" class="form-control" name="Address[]" style="width: 300px;">' +
        '</td>' +
        '<td class="sm_data_col txtCtr">' +
        '<input type="number" class="form-control" name="Estimated_Damage_Value[]" style="width: 200px;">' +
        '</td>' +
        '<td class="sm_data_col txtCtr">' +
        '<input type="text" class="form-control" name="Remarks[]" style="width: 300px;">' +
        '</td>' +
        '<td class="sm_data_col txtCtr">' +
        '<button type="button" class="removeRow btn btn-danger">Remove</button>' +
        '</td>' +
        '</tr>';
        $('#Affected_HouseholdTBLD').append(option);
        
    });

     // Clone Education TR
     $("#btnAddAffected_Household").on("click", function() {

        var $tableBody = $('#Affected_Household').find("tbody"),
        $trLast = $tableBody.find("tr:last"),
        $trNew = $trLast.clone().find("input, select").val("").removeAttr('selected').end();

        $trLast.after($trNew);
    });

    // Remove Milestone TR
    $("#Affected_Household").on("click", ".removeRow", function() {
        $(this).closest("tr").remove();
    });
</script>

<style>
    table {
        display: block;
        overflow-x: scroll;
    }
</style>

@endsection