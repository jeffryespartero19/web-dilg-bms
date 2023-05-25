@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Barangay Projects Monitoring</h1>
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
                            <br>
                            <div class="col-md-12">
                                <form id="newBrgy_Document_Information" method="POST" action="{{ route('create_brgy_projects_monitoring') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input type="text" class="form-control" id="Brgy_Projects_ID" name="Brgy_Projects_ID" hidden>
                                        <div class="row">
                                           
                                            <strong hidden>Project Number:</strong><span id="VProject_Number" name="VProject_Number" hidden></span><br>
                                            
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Project_Number">Project Number<label style="color: red">*</label></label>
                                                <input type="text" class="form-control valpronum" id="Project_Number" name="Project_Number" required>
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Project_Name">Project Name<label style="color: red">*</label></label>
                                                <input type="text" class="form-control" id="Project_Name" name="Project_Name" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-8" style="padding:0 10px">
                                                <label for="Description">Description</label>
                                                <input type="text" class="form-control" id="Description" name="Description">
                                            </div>
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Contractor_ID">Contractor</label>
                                                <select class="form-control" id="Contractor_ID" name="Contractor_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                </select>
                                                <!-- <label for="Contractor_ID">Contractor</label>
                                                <select class="form-control" id="Contractor_ID" name="Contractor_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($contractor as $bt1)
                                                    <option value="{{ $bt1->Contractor_ID }}">{{ $bt1->Contractor_Name }}</option>
                                                    @endforeach
                                                </select> -->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Estimated_Start_Date">Estimated Start Date<label style="color: red">*</label></label>
                                                <input type="date" class="form-control fancyformat" id="Estimated_Start_Date" name="Estimated_Start_Date" required>
                                                <input type="text" class="form-control" id="Start_Date_Words" hidden>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Estimated_End_Date">Estimated End Date<label style="color: red">*</label></label>
                                                <input type="date" class="form-control" id="Estimated_End_Date" name="Estimated_End_Date" required>
                                                <input type="text" class="form-control" id="End_Date_Words" hidden>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Total_Project_Cost">Total Project Cost<label style="color: red">*</label></label>
                                                <input type="text"  onkeypress="validate(event)" class="form-control fancyformat1" required>
                                                <input type="number" step="0.01" class="form-control fancyformat1" id="Total_Project_Cost" name="Total_Project_Cost" hidden>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Funding_Year">Funding Year<label style="color: red">*</label></label>
                                                <input type="text" class="form-control" id="Funding_Year" name="Funding_Year" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-12" style="padding:0 10px">
                                                <label for="Exact_Location">Exact Location<label style="color: red">*</label></label>
                                                <input type="text" class="form-control" id="Exact_Location" name="Exact_Location" required>
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
                                                <input type="date" class="form-control" id="Actual_Project_Start" name="Actual_Project_Start">
                                                <input type="text" class="form-control" id="Actual_Project_Start_Words" hidden>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Project_Completion_Date">Actual Project Completion Date</label>
                                                <input type="date" class="form-control" id="Project_Completion_Date" name="Project_Completion_Date">
                                                <input type="text" class="form-control" id="Project_Completion_Date_Words" hidden>
                                            </div>
                                        </div>
                                        <div class="row">
                                            
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Project_Type_ID">Project Type<label style="color: red">*</label></label>
                                                <select class="form-control" id="Project_Type_ID" name="Project_Type_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($project_type as $bt1)
                                                    <option value="{{ $bt1->Project_Type_ID }}">{{ $bt1->Project_Type_Name }}</option>
                                                    @endforeach
                                                </select>
                                                <!-- <select class="form-control" id="Project_Type_ID" name="Project_Type_ID" required>
                                                </select> -->
                                            </div>
                                            <div class="form-group col-lg-4" style="padding:0 10px">
                                                <label for="Project_Status_ID">Project Status<label style="color: red">*</label></label>
                                                <select class="form-control" id="Project_Status_ID" name="Project_Status_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($project_status as $bt1)
                                                    <option value="{{ $bt1->Project_Status_ID }}">{{ $bt1->Project_Status_Name }}</option>
                                                    @endforeach
                                                </select>
                                                <!-- <select class="form-control" id="Project_Status_ID" name="Project_Status_ID" required>
                                                </select> -->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12" style="padding:0 10px;">
                                                <h3>Milestone Information</h3>
                                                <a onclick="addMilestones();" style="float: right; cursor:pointer" class="btn btn-default">+ Add</a>
                                                <br>
                                                <div class="table-responsive" id="MilestonesDetails">
                                                    <table id="MilestonesTBL" class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Accomplishment Status<label style="color: red">*</label></th>
                                                                <th>Milestone Title<label style="color: red">*</label></th>
                                                                <th>Milestone Description</th>
                                                                <th>Milestone Date<label style="color: red">*</label></th>
                                                                <th>Milestone Status<label style="color: red">*</label></th>
                                                                <th>Milestone Percentage<label style="color: red">*</label></th>
                                                                <th>Obligation Amount<label style="color: red">*</label></th>
                                                                <th>Disbursement Amount<label style="color: red">*</label></th>
                                                                <th>Male Employed</th>
                                                                <th>Female Employed</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="HSBody">
                                                            <tr class="HRDetails">
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
                                                                    <input type="date" class="form-control this_MDate" style="width: 200px;" name="Milestone_Date[]" min="" max="">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" style="width: 200px;" name="Milestone_Status[]">
                                                                </td>
                                                                <td>
                                                                    <input type="number" min="0" max="100" class="form-control fancyformat" style="width: 200px;" name="Milestone_Percentage[]">
                                                                </td>
                                                                <td>
                                                                    <input type="text"  onkeypress="validate(event)" class="form-control fancyformat1" style="width: 200px;">
                                                                    <input type="number" step="0.01" class="form-control fancyformat1" style="width: 200px;" name="Obligation_Amount[]" hidden>
                                                                </td>
                                                                <td>
                                                                    <input type="text"  onkeypress="validate(event)" class="form-control fancyformat1" style="width: 200px;">
                                                                    <input type="number" step="0.01" class="form-control fancyformat1" style="width: 200px;" name="Disbursement_Amount[]" hidden>
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control" style="width: 200px;" name="Male_Employed[]">
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control" style="width: 200px;" name="Female_Employed[]">
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="removeRow btn btn-danger">Remove</button>
                                                                </td> 
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
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



@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $('#example').DataTable();

        $('.js-example-basic-single').select2();

        $('.select2').select2();
         //Select2 Lazy Loading Business Type
         $("#Contractor_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_contractor',
                dataType: "json",
            }
        });
        
        // $("#Project_Type_ID").select2({
        //     minimumInputLength: 2,
        //     ajax: {
        //         url: '/search_projecttype',
        //         dataType: "json",
        //     }
        // });

        // $("#Project_Status_ID").select2({
        //     minimumInputLength: 2,
        //     ajax: {
        //         url: '/search_projectstatus',
        //         dataType: "json",
        //     }
        // });

        $("#Accomplishment_Status_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_accomplishment',
                dataType: "json",
            }
        });
    });

    // Remove Milestone TR
    $("#MilestonesTBL").on("click", ".removeRow", function() {
        $(this).closest("tr").remove();
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

        $("#Project_Status_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_projectstatus',
                dataType: "json",
            }
        });

        $("#Project_Type_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_projecttype',
                dataType: "json",
            }
        });

        $("#Contractor_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_contractor',
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

        
    }

    $(document).on("focusout",'.fancyformat', function(e) {
            var disVal=$(this).val();
            // var num2 = parseFloat(disVal).toLocaleString();
            // var num3 =  parseFloat(disVal);
            
            // $(this).val(num2);
            // $(this).next().val(num3);
            //alert(num2);
            if (disVal > 100){
                alert("Please input a number between 0-100 only");
                $(this).val(0);
            }
        });

        $(document).on("focusout",'.valpronum', function(e) {
            var disVal=$(this).val(); 
            var num=0
            
            // alert(disVal);
            
            // var num2 = parseFloat(disVal).toLocaleString();
            // var num3 =  parseFloat(disVal);
            
            // $(this).val(num2);
            // $(this).next().val(num3);
            //alert(num2);

            $.ajax({
            url: "/get_brgyprojects_projcount",
            type: 'GET',
            data: {
                id: disVal
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#VProject_Number').html(data['theEntry'][0]['Project_Count']);
                // var num=data['theEntry'][0]['Project_Count'];
              
                // alert(num);

                if (data['theEntry'][0]['Project_Count'] >= 1){
                    alert("This Project Number has already in the database, try another project number.");
                    $('#Project_Number').val('');
                    document.getElementById("Project_Number").focus();
                }
            }
        });
            
        });

        $(document).on("focusout",'.fancyformat1', function(e) {
            var disVal=$(this).val(); 
            var num2 = parseFloat(disVal).toLocaleString();
            var num3 =  parseFloat(disVal);
            
            $(this).val(num2);
            $(this).next().val(num3);
            //alert(num2);
        });

        function validate(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode( key );
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }

    $(document).on('change',('#Estimated_Start_Date'),function(e) {
        var disVal = $(this).val();

        $('.this_MDate').removeAttr('min');
        $('.this_MDate').attr('min', disVal);

        $(this).attr('hidden', 'true');
        var now = new Date(disVal).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric"});

        $('#Start_Date_Words').val(now);
        $('#Start_Date_Words').removeAttr('hidden');

    });
    $(document).on('change',('#Estimated_End_Date'),function(e) {
        var disVal = $(this).val();

        $('.this_MDate').removeAttr('max');
        $('.this_MDate').attr('max', disVal);
    });

    $(document).on('click',('#Start_Date_Words'),function(e) {
        $(this).attr('hidden', 'true');
        $('#Estimated_Start_Date').removeAttr('hidden');
    });


    $(document).on('change',('#Estimated_End_Date'),function(e) {
        var disVal = $(this).val();

        $(this).attr('hidden', 'true');
        var now = new Date(disVal).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric"});

        $('#End_Date_Words').val(now);
        $('#End_Date_Words').removeAttr('hidden');

    });
    $(document).on('click',('#End_Date_Words'),function(e) {
        $(this).attr('hidden', 'true');
        $('#Estimated_End_Date').removeAttr('hidden');
    });


    $(document).on('change',('#Actual_Project_Start'),function(e) {
        var disVal = $(this).val();

        $(this).attr('hidden', 'true');
        var now = new Date(disVal).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric"});

        $('#Actual_Project_Start_Words').val(now);
        $('#Actual_Project_Start_Words').removeAttr('hidden');

    });
    $(document).on('click',('#Actual_Project_Start_Words'),function(e) {
        $(this).attr('hidden', 'true');
        $('#Actual_Project_Start').removeAttr('hidden');
    });


    $(document).on('change',('#Project_Completion_Date'),function(e) {
        var disVal = $(this).val();

        $(this).attr('hidden', 'true');
        var now = new Date(disVal).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric"});

        $('#Project_Completion_Date_Words').val(now);
        $('#Project_Completion_Date_Words').removeAttr('hidden');

    });
    $(document).on('click',('#Project_Completion_Date_Words'),function(e) {
        $(this).attr('hidden', 'true');
        $('#Project_Completion_Date').removeAttr('hidden');
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
</style>

@endsection