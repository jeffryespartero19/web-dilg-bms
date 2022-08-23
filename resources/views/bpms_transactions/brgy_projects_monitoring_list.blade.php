@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Barangay Projects Monitoring List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BPMS / </li>
            </a>
            <li> &nbsp;Barangay Projects Monitoring List</li>
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
        <div class="twenty_split txtRight"><button data-toggle="modal" class="btn btn-success" data-target="#createBrgy_Projects_Monitoring" style="width: 100px;">New</button></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>BrgyProjects_ID</th>
                    <th>Project Number</th>
                    <th>Project Name</th>
                    <th>Total Project Cost</th>
                    <th>Exact Location</th>
                    <th>Actual Project Start</th>
                    <th>Contractor Name</th>
                    <th>Project Type</th>
                    <th>Project Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Brgy_Projects_ID}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Project_Number}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Project_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Total_Project_Cost}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Exact_Location}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Actual_Project_Start}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Contractor_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Project_Type_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Project_Status_Name}}</td>
                    <td class="sm_data_col txtCtr">
                        <button class="edit_brgy_projects_monitoring" value="{{$x->Brgy_Projects_ID}}" data-toggle="modal" data-target="#createBrgy_Projects_Monitoring">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Announcement_Status Modal  -->


<div class="modal fade" id="createBrgy_Projects_Monitoring" tabindex="-1" role="dialog" aria-labelledby="Create_Brgy_Projects_Monitoring" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier" id="Modal_Title">Create Brgy Projects Monitoring</h4>
            </div>
            <div class="modal-body">
                <form id="newBrgy_Projects_Monitoring" method="POST" action="{{ route('create_brgy_projects_monitoring') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Brgy Projects Monitoring Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Brgy_Projects_ID" name="Brgy_Projects_ID" hidden>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Project_Number">Project Number</label>
                                <input type="text" class="form-control" id="Project_Number" name="Project_Number">
                            </div>
                            <div class="form-group col-lg-9" style="padding:0 10px">
                                <label for="Project_Name">Project Name</label>
                                <input type="text" class="form-control" id="Project_Name" name="Project_Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="Description">Description</label>
                                <input type="text" class="form-control" id="Description" name="Description">
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Estimated_Start_Date">Estimated Start Date</label>
                                <input type="date" class="form-control" id="Estimated_Start_Date" name="Estimated_Start_Date" required>
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Estimated_End_Date">Estimated End Date</label>
                                <input type="date" class="form-control" id="Estimated_End_Date" name="Estimated_End_Date" required>
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Total_Project_Cost">Total Project Cost</label>
                                <input type="number" class="form-control" id="Total_Project_Cost" name="Total_Project_Cost">
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Funding_Year">Funding Year</label>
                                <input type="text" class="form-control" id="Funding_Year" name="Funding_Year">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="Exact_Location">Exact Location</label>
                                <input type="text" class="form-control" id="Exact_Location" name="Exact_Location">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Type_of_Beneficiary">Type of Beneficiary</label>
                                <input type="text" class="form-control" id="Type_of_Beneficiary" name="Type_of_Beneficiary">
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Number_of_Beneficiaries">Number of Beneficiaries</label>
                                <input type="number" class="form-control" id="Number_of_Beneficiaries" name="Number_of_Beneficiaries">
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Actual_Project_Start">Actual Project Start</label>
                                <input type="date" class="form-control" id="Actual_Project_Start" name="Actual_Project_Start" required>
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Project_Completion_Date">Project Completion Date</label>
                                <input type="date" class="form-control" id="Project_Completion_Date" name="Project_Completion_Date" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="Contractor_ID">Contractor</label>
                                <select class="form-control" id="Contractor_ID" name="Contractor_ID">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($contractor as $bt1)
                                    <option value="{{ $bt1->Contractor_ID }}">{{ $bt1->Contractor_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="Project_Type_ID">Project Type</label>
                                <select class="form-control" id="Project_Type_ID" name="Project_Type_ID">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($project_type as $bt1)
                                    <option value="{{ $bt1->Project_Type_ID }}">{{ $bt1->Project_Type_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="Project_Status_ID">Project Status</label>
                                <select class="form-control" id="Project_Status_ID" name="Project_Status_ID">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($project_status as $bt1)
                                    <option value="{{ $bt1->Project_Status_ID }}">{{ $bt1->Project_Status_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Region_ID">Region</label>
                                <select class="form-control" id="Region_ID" name="Region_ID">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($region as $bt1)
                                    <option value="{{ $bt1->Region_ID }}">{{ $bt1->Region_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Province_ID">Province</label>
                                <select class="form-control" id="Province_ID" name="Province_ID">
                                    <option value='' disabled selected>Select Option</option>


                                </select>
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="City_Municipality_ID">City_Municipality</label>
                                <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID">
                                    <option value='' disabled selected>Select Option</option>


                                </select>
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Barangay_ID">Barangay</label>
                                <select class="form-control" id="Barangay_ID" name="Barangay_ID">
                                    <option value='' disabled selected>Select Option</option>

                                </select>
                            </div>
                        </div>
                        <hr>
                        <h3>Milestone</h3>
                        <button type="button" class="btn btn-info" style="width: 100px;" id="btnAddMilestone">Add</button>
                        <div class="tableX_row row up_marg5">
                            <div class="col-md-12">
                                <table id="Milestone" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Accomplishment Status</th>
                                            <th>Milestone Title</th>
                                            <th>Milestone Description</th>
                                            <th>Milestone Date</th>
                                            <th>Milestone Status</th>
                                            <th>Milestone Percentage</th>
                                            <th>Obligation Amount</th>
                                            <th>Disbursement Amount</th>
                                            <th>Male Employed</th>
                                            <th>Female Employed</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="MilestoneTBLD">
                                        <tr>
                                            <td class="sm_data_col txtCtr">
                                                <select class="form-control" name="Accomplishment_Status_ID[]" style="width: 200px;">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($accomplishment as $et)
                                                    <option value="{{ $et->Accomplishment_Status_ID }}">{{ $et->Accomplishment_Status_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="sm_data_col txtCtr">
                                                <input type="text" class="form-control" name="Milestone_Title[]" style="width: 200px;">
                                            </td>
                                            <td class="sm_data_col txtCtr">
                                                <input type="text" class="form-control" name="Milestone_Description[]" style="width: 200px;">
                                            </td>
                                            <td class="sm_data_col txtCtr">
                                                <input type="date" class="form-control" name="Milestone_Date[]" style="width: 250px;">
                                            </td>
                                            <td class="sm_data_col txtCtr">
                                                <input type="text" class="form-control" name="Milestone_Status[]" style="width: 200px;">
                                            </td>
                                            <td class="sm_data_col txtCtr">
                                                <input type="text" class="form-control" name="Milestone_Percentage[]" style="width: 200px;">
                                            </td>
                                            <td class="sm_data_col txtCtr">
                                                <input type="number" class="form-control" name="Obligation_Amount[]" style="width: 200px;">
                                            </td>
                                            <td class="sm_data_col txtCtr" s>
                                                <input type="number" class="form-control" name="Disbursement_Amount[]" style="width: 200px;">
                                            </td>
                                            <td class="sm_data_col txtCtr" s>
                                                <input type="number" class="form-control" name="Male_Employed[]" style="width: 200px;">
                                            </td>
                                            <td class="sm_data_col txtCtr" s>
                                                <input type="number" class="form-control" name="Female_Employed[]" style="width: 200px;">
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
                        <button type="submit" class="btn btn-primary" style="width: 200px;">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="createFile_Attachment" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close createFile_Attachment_Close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">File Attachments</h4>
            </div>
            <form id="newFile_Attachment" method="POST" action="{{ route('create_file_attachment') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <div class="form-group col-lg-12" style="padding:0 10px">
                            <ul class="list-group list-group-flush" id="milestone_files">

                            </ul>
                            <hr>
                            <div class="custom-file">
                                <input type="text" class="form-control" id="Milestone_Status_ID" name="Milestone_Status_ID" hidden>
                                <input type="file" class="custom-file-input" id="fileattach" name="fileattach[]" multiple>
                                <label class="custom-file-label btn btn-info" for="fileattach">Add file</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn postThis_File_Attachment modal_sb_button">Submit</button>
                </div>
            </form>
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
        $('#newInhabitant').trigger("reset");
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
    $(document).on('click', ('.edit_brgy_projects_monitoring'), function(e) {
        $('#Modal_Title').text('Edit Brgy Projects Monitoring Information');
        var disID = $(this).val();
        $.ajax({
            url: "/get_brgy_projects_monitoring",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Brgy_Projects_ID').val(data['theEntry'][0]['Brgy_Projects_ID']);
                $('#Project_Number').val(data['theEntry'][0]['Project_Number']);
                $('#Project_Name').val(data['theEntry'][0]['Project_Name']);
                $('#Description').val(data['theEntry'][0]['Description']);
                $('#Estimated_Start_Date').val(data['theEntry'][0]['Estimated_Start_Date']);
                $('#Estimated_End_Date').val(data['theEntry'][0]['Estimated_End_Date']);
                $('#Total_Project_Cost').val(data['theEntry'][0]['Total_Project_Cost']);
                $('#Funding_Year').val(data['theEntry'][0]['Funding_Year']);
                $('#Exact_Location').val(data['theEntry'][0]['Exact_Location']);
                $('#Type_of_Beneficiary').val(data['theEntry'][0]['Type_of_Beneficiary']);
                $('#Number_of_Beneficiaries').val(data['theEntry'][0]['Number_of_Beneficiaries']);
                $('#Actual_Project_Start').val(data['theEntry'][0]['Actual_Project_Start']);
                $('#Project_Completion_Date').val(data['theEntry'][0]['Project_Completion_Date']);
                $('#Project_Completion_Date').val(data['theEntry'][0]['Project_Completion_Date']);
                $('#Project_Type_ID').val(data['theEntry'][0]['Project_Type_ID']);
                $('#Project_Status_ID').val(data['theEntry'][0]['Project_Status_ID']);
                $('#Region_ID').val(data['theEntry'][0]['Region_ID']);
                $('#Contractor_ID').val(data['theEntry'][0]['Contractor_ID']);

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
            url: "/get_milestone",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#MilestoneTBLD').empty();
                data.forEach(element => {
                    var option =
                        '<tr>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<select class="form-control" name="Accomplishment_Status_ID[]" style="width: 200px;">' +
                        '<option value="" disabled selected>Select Option</option>' +
                        '@foreach($accomplishment as $et)' +
                        '<option value="{{ $et->Accomplishment_Status_ID}}" {{ $et->Accomplishment_Status_ID  = "' + element['Accomplishment_Status_ID'] + '" ? "selected" : "" }}>{{ $et->Accomplishment_Status_Name}}</option>' +
                        '@endforeach' +
                        '</select>' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="text" class="form-control" name="Milestone_Title[]" style="width: 250px;"  value="' + element['Milestone_Title'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="text" class="form-control" name="Milestone_Description[]" style="width: 250px;"  value="' + element['Milestone_Description'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="date" class="form-control" name="Milestone_Date[]" style="width: 250px;"  value="' + element['Milestone_Date'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="text" class="form-control" name="Milestone_Status[]" style="width: 250px;"  value="' + element['Milestone_Status'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="text" class="form-control" name="Milestone_Percentage[]" style="width: 250px;"  value="' + element['Milestone_Percentage'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="number" class="form-control" name="Obligation_Amount[]" style="width: 250px;"  value="' + element['Obligation_Amount'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr" >' +
                        '<input type="number" class="form-control" name="Disbursement_Amount[]" style="width: 250px;"  value="' + element['Disbursement_Amount'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr" >' +
                        '<input type="number" class="form-control" name="Male_Employed[]" style="width: 250px;"  value="' + element['Male_Employed'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr" >' +
                        '<input type="number" class="form-control" name="Female_Employed[]" style="width: 250px;"  value="' + element['Female_Employed'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<button type="button" class="btn btn-success fileAttBTN" data-toggle="modal" data-target="#createFile_Attachment"  value="' + element['Milestone_Status_ID'] + '">File Attachment</button>' +
                        '<button type="button" class="removeRow btn btn-danger" >Remove</button>' +
                        '</td>' +
                        '</tr>';
                    $('#MilestoneTBLD').append(option);
                });
            }
        });



    });

    // File Submit Form
    // $("#newFile_Attachment").submit(function() {
    //     var fd = new FormData(this);
    //     $.ajax({
    //         url: "/create_file_attachment",
    //         type: "POST", // required
    //         processData: false, // required
    //         contentType: false, // required
    //         data: fd,
    //         success: function(data) {
    //             console.log("Uploaded.", arguments)
    //             $("#result").html(data) // do whatever you want
    //         },
    //         error: function() {
    //             console.log("Error Uploading.", arguments)
    //         }
    //     })
    //     return false
    // });

    // File Attachments Modal
    $(document).on('click', ('.fileAttBTN'), function(e) {
        var disID = $(this).val();
        $('#Milestone_Status_ID').val(disID);
        $('#milestone_files').empty();
        $.ajax({
            url: "/get_milestone_attachments",
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
                    var file = '<li class="list-group-item">' + element['File_Name'] + '<a href="./files/uploads/brgy_projects_monitoring_milestone/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a>|<button type="button" class="btn att_del" value="' + element['Attachment_ID'] + '" style="color: red; margin-left:2px;">Delete</button></li>';
                    $('#milestone_files').append(file);
                });
            }
        });
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
                    url: "/delete_milestone_attachments",
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
                        $('.createFile_Attachment_Close').click();
                    }
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

        $('#Modal_Title').text('Create Brgy Projects Monitoring');

        // Reset Education Table
        $('#MilestoneTBLD').empty();
        var option =
            '<tr>' +
            '<td class="sm_data_col txtCtr">' +
            '<select class="form-control" name="Accomplishment_Status_ID[]" style="width: 200px;">' +
            '<option value="" disabled selected>Select Option</option>' +
            '@foreach($accomplishment as $et)' +
            '<option value="{{ $et->Accomplishment_Status_ID }}">{{ $et->Accomplishment_Status_Name }}</option>' +
            '@endforeach' +
            '</select>' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="text" class="form-control" name="Milestone_Title[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="text" class="form-control" name="Milestone_Description[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="date" class="form-control" name="Milestone_Date[]" style="width: 250px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="text" class="form-control" name="Milestone_Status[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="text" class="form-control" name="Milestone_Percentage[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="number" class="form-control" name="Obligation_Amount[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="number" class="form-control" name="Disbursement_Amount[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="number" class="form-control" name="Male_Employed[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="number" class="form-control" name="Female_Employed[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<button type="button" class="removeRow btn btn-danger">Remove</button>' +
            '</td>' +
            '</tr>';
        $('#MilestoneTBLD').append(option);
    });


    // Clone Education TR
    $("#btnAddMilestone").on("click", function() {

        var $tableBody = $('#Milestone').find("tbody"),
            $trLast = $tableBody.find("tr:last"),
            $trNew = $trLast.clone().find("input, select").val("").removeAttr('selected').end();

        $trLast.after($trNew);
    });
    // Clone File Attachment TR
    $("#btnAddFile_Attachment").on("click", function() {

        var $tableBody = $('#File_Attachment').find("tbody"),
            $trLast = $tableBody.find("tr:last"),
            $trNew = $trLast.clone().find("input, select").val("").removeAttr('selected').end();

        $trLast.after($trNew);
    });

    // Remove Milestone TR
    $("#Milestone").on("click", ".removeRow", function() {
        $(this).closest("tr").remove();
    });

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<style>
    table {
        display: block;
        overflow-x: scroll;
    }
</style>

@endsection