@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Barangay Projects Monitoring Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('brgy_projects_monitoring_list')}}">Barangay Projects Monitoring List</a></li>
                        <li class="breadcrumb-item active">Barangay Projects Monitoring Information</li>
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
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">  
                        <div class="tableX_row col-md-12 up_marg5">
                        <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
                            <br>
                            <div class="col-md-12">
                                <form id="newBrgy_Document_Information" method="POST" action="{{ route('create_brgy_projects_monitoring') }}" autocomplete="off" enctype="multipart/form-data">
                                    
                                @csrf
                                    <div>
                                        <input type="text" class="form-control" id="Brgy_Projects_ID" name="Brgy_Projects_ID" value="{{$project[0]->Brgy_Projects_ID}}" hidden>
                                        
                                        <div class="row">
                                            <div class="col-6">
                                                <strong>Project Number: </strong><span id="VProject_Number"></span><br>
                                                <strong>Project Name: </strong><span id="VProject_Name"></span><br>
                                                <strong>Description: </strong><span id="VDescription"></span><br>
                                                <strong>Estimated Start Date: </strong><span id="VEstimated_Start_Date"></span><br>
                                                <strong>Estimated End Date: </strong><span id="VEstimated_End_Date"></span><br>
                                                <strong>Total Project Cost: </strong><span id="VTotal_Project_Cost"></span><br>
                                                <strong>Funding Year: </strong><span id="VFunding_Year"></span><br>
                                                <strong>Exact Location: </strong><span id="VExact_Location"></span><br>
                                                <strong>Type of Beneficiary: </strong><span id="VType_of_Beneficiary"></span><br>
                                                <strong>Number of Beneficiaries: </strong><span id="VNumber_of_Beneficiaries"></span><br>
                                                <strong>Actual Project Start: </strong><span id="VActual_Project_Start"></span><br>
                                                <strong>Project Completion Date: </strong><span id="VProject_Completion_Date"></span><br>
                                                <strong>Contractor Name: </strong><span id="VContractor_Name"></span><br>
                                                <strong>Project Type Name: </strong><span id="VProject_Type_Name"></span><br>
                                                <!-- buban -->
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-12" style="padding:0 10px;">
                                                <h3>Milestone Information</h3>
                                                <!-- <a onclick="addMilestones();" style="float: right; cursor:pointer" class="btn btn-default">+ Add</a> -->
                                                <br>
                                                <div class="table-responsive" id="MilestonesDetails">
                                                    <table id="MilestonesTBL" class="table table-striped table-bordered">
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
                                                                <!-- <th>Actions</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody class="HSBody">
                                                        @if($milestone->count() > 0)
                                                        @foreach ($milestone as $cd)
                                                        <tr class="HRDetails">
                                                            <!-- <td>
                                                                <input type="text" class="form-control" style="width: 200px;" name="Milestone_Status_ID[]" value="{{$cd->Milestone_Status_ID}}" hidden>
                                                            </td> -->
                                                            <td>
                                                                <select class="form-control myselect select2 Accomplishment_Status_ID" style="width: 350px;" id="Accomplishment_Status_ID" name="Accomplishment_Status_ID[]">
                                                                    <option value='' disabled selected>Select Option</option>
                                                                    @foreach($accomplishment as $bt1)
                                                                    <option value="{{ $bt1->Accomplishment_Status_ID }}" {{ $bt1->Accomplishment_Status_ID == $cd->Accomplishment_Status_ID  ? "selected" : "" }}>{{ $bt1->Accomplishment_Status_Name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" style="width: 200px;" name="Milestone_Title[]" value="{{$cd->Milestone_Title}}">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" style="width: 200px;" name="Milestone_Description[]" value="{{$cd->Milestone_Description}}">
                                                            </td>
                                                            <td>
                                                                <input type="date" class="form-control" style="width: 200px;" name="Milestone_Date[]" value="{{$cd->Milestone_Date}}">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" style="width: 200px;" name="Milestone_Status[]" value="{{$cd->Milestone_Status}}">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" style="width: 200px;" name="Milestone_Percentage[]" value="{{$cd->Milestone_Percentage}}">
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" style="width: 200px;" name="Obligation_Amount[]" value="{{$cd->Obligation_Amount}}">
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" style="width: 200px;" name="Disbursement_Amount[]" value="{{$cd->Disbursement_Amount}}">
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" style="width: 200px;" name="Male_Employed[]" value="{{$cd->Male_Employed}}">
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" style="width: 200px;" name="Female_Employed[]" value="{{$cd->Female_Employed}}">
                                                            </td>
                                                            <!-- <td style="text-align: center;">
                                                                <button style="width: 100px;" type="button" class="btn btn-success fileAttBTN" data-toggle="modal" data-target="#createFile_Attachment" value="{{$cd->Milestone_Status_ID}}">Attachment</button>
                                                                <button style="width: 100px;" type="button" class="btn btn-danger removeRow">Remove</button>
                                                            </td> -->
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr class="HRDetails">
                                                            <!-- <td>
                                                                <input type="text" class="form-control" style="width: 200px;" name="Milestone_Status_ID[]"  hidden>
                                                            </td> -->
                                                            <td>
                                                                <select class="form-control myselect select2 Accomplishment_Status_ID" style="width: 350px;" id="Accomplishment_Status_ID" name="Accomplishment_Status_ID[]">
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" style="width: 200px;" name="Milestone_Title[]">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" style="width: 200px;" name="Milestone_Description[]">
                                                            </td>
                                                            <td>
                                                                <input type="date" class="form-control" style="width: 200px;" name="Milestone_Date[]">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" style="width: 200px;" name="Milestone_Status[]">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" style="width: 200px;" name="Milestone_Percentage[]">
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" style="width: 200px;" name="Obligation_Amount[]">
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" style="width: 200px;" name="Disbursement_Amount[]">
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" style="width: 200px;" name="Male_Employed[]">
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" style="width: 200px;" name="Female_Employed[]">
                                                            </td>
                                                            <!-- <td style="text-align: center; width:10%">
                                                                <button type="button" class="btn btn-danger removeRow">Remove</button>
                                                            </td> -->
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-12" style="margin-bottom: 100px;">
                                        <center>
                                            <!-- <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button> -->
                                            <a class="btn btn-info" href="{{route('brgy_projects_monitoring_list')}}" id="btnback">Back</a>
                                            <!-- <button href="{{route('brgy_projects_monitoring_list')}}" type="button" class="btn btn-primary" style="width: 200px;" id="btnback">Back</button> -->
                                        </center>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->


<div class="modal fade" id="createFile_Attachment" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">File Attachments</h4>
                <button type="button" class="close createFile_Attachment_Close" data-dismiss="modal">&times;</button>
                
            </div>
            <form id="newFile_Attachment" method="POST" action="{{ route('create_file_attachment') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                    <!-- <label for="fileattach">File Attachments</label> -->
                        <div class="form-group col-lg-12" style="padding:0 10px">
                            
                            <ul class="list-group list-group-flush" id="project_files">

                            </ul>
                            <div class="custom-file">
                                @csrf
                                <input type="text" class="form-control" id="Milestone_Status_ID" name="Milestone_Status_ID" value="{{$cd->Milestone_Status_ID}}" hidden>
                                <input type="file" class="custom-file-input" id="fileattach" name="fileattach[]" multiple>
                                <label class="custom-file-label btn btn-info" for="fileattach">Choose file</label>
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



@endsection

@section('scripts')
<!-- $(this).removeData('modal'); -->
<script>

    


    // Disable Form if DILG USER
    $(document).ready(function() {
        // var User_Type_ID = $('#User_Type_ID').val();
        // if (User_Type_ID == 3 || User_Type_ID == 4) {
            $("#newBrgy_Document_Information :input").prop("disabled", true);
            $("#btnback").prop("disabled", false);
        // } aldren
        $('#example').DataTable();
        
        var disID = $('#Brgy_Projects_ID').val();
        $.ajax({
            url: "/get_brgyprojects",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#VProject_Number').html(data['theEntry'][0]['Project_Number']);
                $('#VProject_Name').html(data['theEntry'][0]['Project_Name']);
                $('#VDescription').html(data['theEntry'][0]['Description']);
                $('#VEstimated_Start_Date').html(data['theEntry'][0]['Estimated_Start_Date']);
                $('#VEstimated_End_Date').html(data['theEntry'][0]['Estimated_End_Date']);
                $('#VTotal_Project_Cost').html(data['theEntry'][0]['Total_Project_Cost']);
                $('#VBrgy_Projects_ID').html(data['theEntry'][0]['Brgy_Projects_ID']);
                $('#VFunding_Year').html(data['theEntry'][0]['Funding_Year']);
                $('#VExact_Location').html(data['theEntry'][0]['Exact_Location']);
                $('#VType_of_Beneficiary').html(data['theEntry'][0]['Type_of_Beneficiary']);
                $('#VNumber_of_Beneficiaries').html(data['theEntry'][0]['Number_of_Beneficiaries']);
                $('#VActual_Project_Start').html(data['theEntry'][0]['Actual_Project_Start']);
                $('#VProject_Completion_Date').html(data['theEntry'][0]['Project_Completion_Date']);
                $('#VContractor_Name').html(data['theEntry'][0]['Contractor_Name']);
                $('#VProject_Type_Name').html(data['theEntry'][0]['Project_Type_Name']);
                
            }
        });
        $("#btnback").prop("disabled", false);
    });

    function addMilestones() {
        var row = $("#MilestonesTBL tr:last");

        row.find(".select2").each(function(index) {
            $("select.select2-hidden-accessible").select2('destroy');
        });

        var newrow = row.clone();

        newrow.find(".Accomplishment_Status_ID").empty();

        $("#MilestonesTBL").append(newrow);

        $(".Accomplishment_Status_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_accomplishment',
                dataType: "json",
            }
        });
        $(newrow.find("td:eq(1) input")).val('');
        $(newrow.find("td:eq(2) input")).val('');
        $(newrow.find("td:eq(3) input")).val('');
        $(newrow.find("td:eq(4) input")).val('');
        $(newrow.find("td:eq(5) input")).val('');
        $(newrow.find("td:eq(6) input")).val('');
        $(newrow.find("td:eq(7) input")).val('');
        $(newrow.find("td:eq(8) input")).val('');
        $(newrow.find("td:eq(9) input")).val('');
        $(newrow.find("td:eq(10) input")).val('');

       
    }

    // Remove Milestone TR
    $("#MilestonesTBL").on("click", ".removeRow", function() {
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


    $(document).on('click', ('.fileAttBTN'), function(e) {
        $(this).removeData('newFile_Attachment');
        var disID = $(this).val();
        var User_Type_ID = $('#User_Type_ID').val();
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
                $i = 0;
                if (User_Type_ID == 1) {

                    data.forEach(element => {
                        $i = $i + 1;
                        var file = '<li class="list-group-item">' + $i + '. ' + element['File_Name'] + ' (' + (element['File_Size'] / 1000000).toFixed(2) + ' MB)<a href="/files/uploads/brgy_projects_monitoring_milestone/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a>|<button type="button" class="btn res_del" value="' + element['Attachment_ID'] + '" style="color: red; margin-left:2px;">Delete</button></li>';
                        $('#project_files').append(file);

                    });
                } else {
                    data.forEach(element => {
                        $i = $i + 1;
                        var file = '<li class="list-group-item">' + $i + '. ' + element['File_Name'] + '<a href="/files/uploads/brgy_projects_monitoring_milestone/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a></li>';
                        $('#project_files').append(file);
                    });
                }

            }
        });
    });

    $(document).on('click', ('.res_del'), function(e) {
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
                        location.reload();
                    }
                });

            }
        });

    });


    $(document).on('click', '.createFile_Attachment_Close', function(e) {
        // $('#newFile_Attachment').trigger("reset");
        $('#project_files').empty();
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

    .inputfile-box {
        position: relative;
    }

    .inputfile {
        display: none;
    }

    .container {
        display: inline-block;
        width: 100%;
    }

    .file-box {
        display: inline-block;
        width: 100%;
        border: 1px solid;
        padding: 5px 0px 5px 5px;
        box-sizing: border-box;
        height: calc(2rem - 2px);
    }

    .file-button {
        background: red;
        padding: 5px;
        position: absolute;
        border: 1px solid;
        top: 0px;
        right: 0px;
    }
</style>

@endsection