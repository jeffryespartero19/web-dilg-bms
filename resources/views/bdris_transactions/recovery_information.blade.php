@extends('layouts.default')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
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
                                <form id="newRecovery_Information" method="POST" action="{{ route('create_recovery_information') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input type="text" class="form-control" id="Disaster_Recovery_ID" name="Disaster_Recovery_ID" hidden>
                                        <div class="row">
                                            <input type="number" class="form-control" id="Disaster_Recovery_ID" name="Disaster_Recovery_ID" value="0" hidden>
                                            <div class="form-group col-lg-8" style="padding:0 10px">
                                                <label for="Disaster_Response_ID">Disaster Response</label>
                                                <select class="form-control" id="Disaster_Response_ID" name="Disaster_Response_ID">
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-12" style="padding:0 10px">
                                                <label for="fileattach">File Attachments</label>
                                                <ul class="list-group list-group-flush" id="response_files">

                                                </ul>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="fileattach" name="fileattach[]" multiple>
                                                    <label class="custom-file-label btn btn-info" for="fileattach">Choose file</label>
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12" style="padding:0 10px" id="AffectedDetails">
                                            <h3>Affected Household and Infrastructure</h3>
                                            <a onclick="addrow();" style="float: right; cursor:pointer" class="btn btn-default">+ Add</a>
                                            <div class="table-responsive">
                                                <table id="AffectedTBL" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th hidden>Affected_Household_ID</th>
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
                                                        <tr class="AffectedDetails">
                                                            <td hidden></td>
                                                            <td>
                                                                <!-- <select class="form-control myselect select2 Household_Profile_ID" id="Household_Profile_ID" name="Household_Profile_ID[]" style="width: 200px;">
                                                                </select> -->
                                                                
                                                                <select class="form-control" id="Household_Profile_ID" name="Household_Profile_ID[]" style="width: 200px;">
                                                                    <option value='' disabled selected>Select Option</option>
                                                                    @foreach($household_profile as $bt1)
                                                                    <option value="{{ $bt1->Household_Profile_ID }}">{{ $bt1->Household_Name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <!-- <select class="form-control myselect select2 Level_of_Damage_ID" id="Level_of_Damage_ID" name="Level_of_Damage_ID[]" style="width: 200px;"> 
                                                                </select> -->
                                                                <select class="form-control" id="Level_of_Damage_ID" name="Level_of_Damage_ID[]" style="width: 200px;">
                                                                    <option value='' disabled selected>Select Option</option>
                                                                    @foreach($level_of_damage as $bt1)
                                                                    <option value="{{ $bt1->Level_of_Damage_ID }}">{{ $bt1->Level_of_Damage }}</option>
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
                                                            <td style="text-align: center; width:10%">
                                                                <button type="button" class="btn btn-danger AffectedRemove">Remove</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <hr> 
                                        
                                        <div class="form-group col-lg-12" style="padding:0 10px" id="RecoveryDetails">
                                            <h3>Recovery Damage Loss</h3>
                                            <a onclick="addrow2();" style="float: right; cursor:pointer" class="btn btn-default">+ Add</a>
                                            <div class="table-responsive" id="RecoveryDamageDetails">
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
                                                        <tr class="RecoveryDetails">
                                                            <td hidden></td>
                                                            
                                                            <td class="sm_data_col txtCtr">
                                                                <input type="text"  onkeypress="validate(event)" class="form-control fancyformat" style="width: 250px;">
                                                                <input type="number" step="0.01" class="form-control fancyformat" name="Livestock_Loss_Estimated_Value[]" style="width: 250px;" hidden>
                                                            </td>
                                                            <td class="sm_data_col txtCtr">
                                                                <input type="text"  onkeypress="validate(event)" class="form-control fancyformat" style="width: 250px;">
                                                                <input type="number" step="0.01" class="form-control fancyformat" name="Poultry_Loss_Estimated_Value[]" style="width: 250px;" hidden>
                                                            </td>
                                                            <td class="sm_data_col txtCtr">
                                                                <input type="text"  onkeypress="validate(event)" class="form-control fancyformat" style="width: 250px;">
                                                                <input type="number" step="0.01" class="form-control fancyformat" name="Fisheries_Loss_Estimated_Value[]" style="width: 250px;" hidden>
                                                            </td>
                                                            <td class="sm_data_col txtCtr">
                                                                <input type="text"  onkeypress="validate(event)" class="form-control fancyformat" style="width: 250px;">
                                                                <input type="number" step="0.01" class="form-control fancyformat" name="Crops_Loss_Estimated_Value[]" style="width: 250px;" hidden>
                                                            </td>
                                                            <td style="text-align: center; width:10%">
                                                                <button type="button" class="btn btn-danger RecoveryRemove">Remove</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <hr>


                                        <div class="form-group col-lg-12" style="padding:0 10px;">
                                            <h3>Casualties and Injured</h3>
                                            <a onclick="addResident();" style="float: right; cursor:pointer" class="btn btn-default">+ Add</a>
                                            <br>
                                            <div class="table-responsive" id="CasualtiesDetails">
                                                <table id="ResidentTBL" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th hidden>Resident_ID</th>
                                                            <th>Name</th>
                                                            <th>Casualty Status</th>
                                                            <th>Resident Status</th>
                                                            <th>Address</th>
                                                            <th>Birthdate</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="HSBody"> 
                                                        <tr class="HRDetails">
                                                            <td hidden></td>
                                                            <td>
                                                                <!-- <select class="form-control myselect select2 Casualties_Resident" id="Casualties_Resident" name="Resident_ID[]" style="width: 300px;" >
                                                                </select>  -->
                                                                <select class="form-control js-example-basic-single Resident_Select2 mySelect2" name="Resident_ID[]" style="width: 350px;">
                                                                    <option value='' disabled selected>Select Option</option>
                                                                    @foreach($resident as $rs)
                                                                    <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-control" name="Casualty_Status_ID[]" style="width: 200px;">
                                                                    <option value='' disabled selected>Select Option</option>
                                                                    @foreach($casualty as $rs)
                                                                    <option value="{{ $rs->Casualty_Status_ID }}">{{ $rs->Casualty_Status }}</option>
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
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>



                                        <div class="form-group col-lg-12" style="padding:0 10px;">
                                            <h3>Missing</h3>
                                            <a onclick="addResident2();" style="float: right; cursor:pointer" class="btn btn-default">+ Add</a>
                                            <br>
                                            <div class="table-responsive" id="MissingDetails">

                                                <table id="Resident2TBL" class="table table-striped table-bordered">
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
                                                        <tr class="HR2Details">
                                                            <td hidden></td>
                                                            <td>
                                                                <!-- <select class="form-control myselect select2 Missing_Resident" id="Missing_Resident" name="Resident_Missing_ID[]" style="width: 300px;" >
                                                                </select> -->
                                                                <select class="form-control js-example-basic-single Resident_Select3 mySelect2" name="Resident_Missing_ID[]" style="width: 350px;">
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
                                                                    <option value=0>No</option>
                                                                    <option value=1>Yes</option>
                                                                    
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="date" class="form-control" style="width: 200px;" name="Date_Found[]">
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <button type="button" class="btn btn-danger HR2Remove">Remove</button>
                                                            </td>
                                                        </tr>
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
    });

    //Select2
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $(".Resident_Select2").select2({
            tags: true,
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });

             //Select2 Lazy Loading 
         $("#Disaster_Response_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_disasterresponse',
                dataType: "json",
            }
        });

        $(".Resident_Select3").select2({
            tags: true,
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });

    });

    


    function addrow() {
        var row = $("#AffectedTBL tr:last");

        row.find(".select2").each(function(index) {
            $("select.select2-hidden-accessible").select2('destroy');
        });

        var newrow = row.clone();

        newrow.find(".Household_Profile_ID").empty();
        newrow.find(".Level_of_Damage_ID").empty();

        $("#AffectedTBL").append(newrow);

       

        $(".Resident_Select3").select2({
            tags: true,
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });

        $(".Resident_Select2").select2({
            tags: true,
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });


        $("#Disaster_Response_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_disasterresponse',
                dataType: "json",
            }
        });


        $(newrow.find("td:eq(1) input")).val(0);
        $(newrow.find("td:eq(2) input")).val(0);
        $(newrow.find("td:eq(3) input")).val('');
        $(newrow.find("td:eq(4) input")).val('');
        $(newrow.find("td:eq(5) input")).val('');
        $(newrow.find("td:eq(5) input")).val('');
        $(newrow.find("td:eq(6) input")).val('');

    }

    function addResident2() {
        var row = $("#Resident2TBL tr:last");

        row.find(".Resident_Select3").each(function(index) {
            $("select.select2-hidden-accessible").select2('destroy');
        });

        var newrow = row.clone();

        newrow.find(".Resident_Select3").empty();

        $("#Resident2TBL").append(newrow);

        $(".Resident_Select3").select2({
            tags: true,
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });

        $(".Resident_Select2").select2({
            tags: true,
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });

        $("#Disaster_Response_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_disasterresponse',
                dataType: "json",
            }
        });

        $(newrow.find("td:eq(3) input")).val('');
        $(newrow.find("td:eq(4) input")).val('');
        $(newrow.find("td:eq(5) input")).val('');
        $(newrow.find("td:eq(6) input")).val('');

    }

    function addResident() {
        var row = $("#ResidentTBL tr:last");

        row.find(".Resident_Select2").each(function(index) {
            $("select.select2-hidden-accessible").select2('destroy');
        });

        var newrow = row.clone();

        newrow.find(".Resident_Select2").empty();

        $("#ResidentTBL").append(newrow);

        $(".Resident_Select2").select2({
            tags: true,
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });

        $(".Resident_Select3").select2({
            tags: true,
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });

        $("#Disaster_Response_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_disasterresponse',
                dataType: "json",
            }
        });

        $(newrow.find("td:eq(4) input")).val('');
        $(newrow.find("td:eq(5) input")).val('');

        
    }

//aldren
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

        $(".Resident_Select3").select2({
            tags: true,
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });

        $(".Resident_Select2").select2({
            tags: true,
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });

        $("#Disaster_Response_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_disasterresponse',
                dataType: "json",
            }
        });

    }

   

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

    // Clone Recovery Damage Loss TR
    $("#btnAddRecovery_Damage_Loss").on("click", function() {

        var $tableBody = $('#Recovery_Damage_Loss').find("tbody"),
            $trLast = $tableBody.find("tr:last"),
            $trNew = $trLast.clone().find("input, select").val("").removeAttr('selected').end();

        $trLast.after($trNew);
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
    $(document).on('click', ('.ord_del'), function(e) {
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
                        $('#CloseRecovery_Information').click();
                    }
                });

            }
        });

    });

    // Show File Name
    updateList = function() {
        var input = document.getElementById('file');
        var output = document.getElementById('fileList');

        output.innerHTML = '<ul>';
        for (var i = 0; i < input.files.length; ++i) {
            output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
        }
        output.innerHTML += '</ul>';
    }

    // Option Affected Remove
    $(".AffectedBody").on("click", ".AffectedRemove", function() {
        $(this).closest(".AffectedDetails").remove();
    });

    // Option Recovery Damage loss Remove
    $(".RecoveryBody").on("click", ".RecoveryRemove", function() {
        $(this).closest(".RecoveryDetails").remove();
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


    // Option Resident Remove
    $(".HSBody").on("click", ".HRRemove", function() {
        $(this).closest(".HRDetails").remove();
    });
    // Option Resident Missing Remove
    $(".HS2Body").on("click", ".HR2Remove", function() {
        $(this).closest(".HR2Details").remove();
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.recoveryInfo').addClass('active');
        $('.disaster_menu').addClass('active');
        $('.disaster_main').addClass('menu-open');
    });

    //buban

        $(document).on("focusout",'.fancyformat', function(e) {
            var disVal=$(this).val(); 
            var num2 = parseFloat(disVal).toLocaleString();
            var num3 =  parseFloat(disVal);
            
            $(this).val(num2);
            $(this).next().val(num3);
            //alert(num2);
        });
     

    // $(".fancyformat3").on("focusout", function(e) {
    //     var disVal=$(this).val();
    //     var num2 = parseFloat(disVal).toLocaleString();
    //     var num3 =  parseFloat(disVal);
        
    //     $(".fancyformat3").val(num2);
    //     $(".fancyformat4").val(num3);
    //     //alert(num2);
    // })


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
</script>

<style>
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