@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Disaster Related Activities List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Disaster Related Activities List</li>
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
            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
                            <div class="form-group col-lg-3">
                                <label for="R_ID">Region</label>
                                <select class="form-control" id="R_ID" name="R_ID" required>
                                    <option value='' disabled selected>Select Option</option>

                                    @foreach($region1 as $region)
                                    <option value="{{ $region->Region_ID }}">{{ $region->Region_Name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="P_ID">Province</label>
                                <select class="form-control" id="P_ID" name="P_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="CM_ID">City/Municipality</label>
                                <select class="form-control" id="CM_ID" name="CM_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="B_ID">Barangay</label>
                                <select class="form-control" id="B_ID" name="B_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="text-align: right;">
                            <div class="btn-group">
                                @if (Auth::user()->User_Type_ID == 1)
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-success" data-target="#createDisaster_Related_Activities" style="width: 100px;">New</button></div>

                                <div style="padding: 2px;"><a href="{{ url('viewDisaster_Related_ActivitiesPDF') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <div>
                                    <table id="example11" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Activity Name </th>
                                                <th>Purpose </th>
                                                <th>Date Start </th>
                                                <th>Date End </th>
                                                <th>Number of Participants </th>
                                                <th>Actions</th>
                                            </tr>
                                            <tr>
                                                <td><input class="form-control searchFilter searchFilter1" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter2" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter3" style="min-width: 200px;" type="date"></td>
                                                <td><input class="form-control searchFilter searchFilter4" style="min-width: 200px;" type="date"></td>
                                                <td><input class="form-control searchFilter searchFilter5" style="min-width: 200px;" type="number"></td>
                                                <td style="min-width: 200px;"></td>
                                            </tr>
                                        </thead>
                                        <tbody id="ListData"> 
                                            @include('bdris_transactions.disaster_related_activities_data')
                                        </tbody>
                                    </table>
                                    {!! $db_entries->links() !!}
                                    <input type="hidden" name="hidden_page" id="hidden_page" value="1">
                                </div>
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

<!-- Create Announcement_Status Modal  -->

<div class="modal fade" id="createDisaster_Related_Activities" tabindex="-1" role="dialog" aria-labelledby="Create_Disaster_Related_Activities" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" >Disaster Related Activities</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newDisaster_Related_Activities" method="POST" action="{{ route('create_disaster_related_activities') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body">

                    <div class="modal-body">
                        
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Disaster_Related_Activities_ID" name="Disaster_Related_Activities_ID" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Activity_Name">Activity Name</label>
                                <input type="text" class="form-control" id="Activity_Name" name="Activity_Name">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Purpose">Purpose</label>
                                <input type="text" class="form-control" id="Purpose" name="Purpose">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Date_Start">Date Start</label>
                                <input type="date" class="form-control" id="Date_Start" name="Date_Start" required>
                                <input type="text" class="form-control" id="Date_Start_Words" hidden>
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Date_End">Date End</label>
                                <input type="date" class="form-control" id="Date_End" name="Date_End" required>
                                <input type="text" class="form-control" id="Date_End_Words" hidden>
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Number_of_Participants">Number of Participants</label>
                                <input type="number" class="form-control" id="Number_of_Participants" name="Number_of_Participants">
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Brgy_Officials_and_Staff_ID">Brgy Official Name</label>
                                <select class="form-control" id="Brgy_Officials_and_Staff_ID" name="Brgy_Officials_and_Staff_ID">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($brgy_officials_and_staff as $bt1)
                                    <option value="{{ $bt1->Resident_ID }}">{{ $bt1->Last_Name }} {{ $bt1->First_Name }}, {{ $bt1->Middle_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="fileattach">File Attachments</label>
                                <ul class="list-group list-group-flush" id="disaster_related_activities_files">

                                </ul>
                                <div class="custom-file">
                                    <input type="file" accept="image/*" class="custom-file-input" id="fileattach" name="fileattach[]" multiple>
                                    <label class="custom-file-label btn btn-info" for="fileattach">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="CloseDisaster_Related_Activities" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="viewDisRelAct" tabindex="-1" role="dialog" aria-labelledby="viewDisRelAct" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="VName">Disaster Related Activities Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- <h4 id="VName"> </h4> -->

                <table class="table table-striped table-bordered" style="width:100%">
                    <tr>
                        <td colspan="2" style="text-align: center; font-size:large">Details</td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Activity Name: </strong></td>
                        <td><span id="VActivity_Name"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Purpose: </strong></td>
                        <td><span id="VPurpose"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Date Start: </strong></td>
                        <td><span id="VDate_Start"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Date End: </strong></td>
                        <td><span id="VNumber_of_Participants"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Brgy Official: </strong></td>
                        <td><span id="VBrgy_Official_Name"></span></td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="form-group col-lg-12" style="padding:0 10px">
                <label for="fileattach">File Attachments</label>
                <ul class="list-group list-group-flush" id="disaster_related_activities_files1">

                </ul>
            </div>
        </div>
    </div>
</div>




@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    $(document).on('click', '.modal-close', function(e) {
        $('#newDisaster_Related_Activities').trigger("reset");
        $('#disaster_related_activities_files').empty();
        $('#disaster_related_activities_files1').empty();
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
    $(document).on('click', ('.edit_disaster_related_activities'), function(e) {
        // alert('awdawdwd');
        $('#Modal_Title').text('Edit Disaster Related Activities');
        var disID = $(this).val();
        $.ajax({
            url: "/get_disaster_related_activities",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Disaster_Related_Activities_ID').val(data['theEntry'][0]['Disaster_Related_Activities_ID']);
                $('#Activity_Name').val(data['theEntry'][0]['Activity_Name']);
                $('#Purpose').val(data['theEntry'][0]['Purpose']);
                $('#Date_Start').val(data['theEntry'][0]['Date_Start']);
                $('#Date_End').val(data['theEntry'][0]['Date_End']);
                $('#Number_of_Participants').val(data['theEntry'][0]['Number_of_Participants']);
                $('#Brgy_Officials_and_Staff_ID').val(data['theEntry'][0]['Brgy_Officials_and_Staff_ID']);
                $('#Region_ID').val(data['theEntry'][0]['Region_ID']);
                

                $('#Disaster_Related_Activities_ID1').val(data['theEntry'][0]['Disaster_Related_Activities_ID']);
                $('#Activity_Name1').val(data['theEntry'][0]['Activity_Name']);
                $('#Purpose1').val(data['theEntry'][0]['Purpose']);
                $('#Date_Start1').val(data['theEntry'][0]['Date_Start']);
                $('#Date_End1').val(data['theEntry'][0]['Date_End']);
                $('#Number_of_Participants1').val(data['theEntry'][0]['Number_of_Participants']);
                $('#Region_ID1').val(data['theEntry'][0]['Region_ID']);

                var disvals=$('#Date_Start').val();
                var disvalss=$('#Date_End').val();

                $('#Date_Start').attr('hidden', 'true');
                var now1 = new Date(disvals).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric"});
                $('#Date_Start_Words').val(now1);
                $('#Date_Start_Words').removeAttr('hidden');

                $('#Date_End').attr('hidden', 'true');
                var now2 = new Date(disvalss).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric"});
                $('#Date_End_Words').val(now2);
                $('#Date_End_Words').removeAttr('hidden');

            }
        });

        $.ajax({
            url: "/get_disaster_related_activities_attachments",
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
                    var file = '<li class="list-group-item">' + element['File_Name'] + '<a href="./files/uploads/disaster_related_activities/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a>|<button type="button" class="btn ord_del" value="' + element['Attachment_ID'] + '" style="color: red; margin-left:2px;">Delete</button></li>';
                    $('#disaster_related_activities_files').append(file);
                });
            }
        });

        
    });

// aldren
    $(document).on('click', ('.viewing_disrelact'), function(e) {
        // alert('awdawdwd');
        var disID = $(this).val();

        $.ajax({
            url: "/get_disaster_related_activities_view",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#VActivity_Name').html(data['theEntry'][0]['Activity_Name']);
                $('#VPurpose').html(data['theEntry'][0]['Purpose']);
                $('#VDate_Start').html(data['theEntry'][0]['Date_Start']);
                $('#VDate_End').html(data['theEntry'][0]['Date_End']);
                $('#VNumber_of_Participants').html(data['theEntry'][0]['Number_of_Participants']);
                $('#VBrgy_Official_Name').html(data['theEntry'][0]['Brgy_Official_Name']);
            
            
            }
        });


        
        $.ajax({
            url: "/get_disaster_related_activities_attachments",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                // $('#disaster_related_activities_files1').empty();
                // $i = 0;
                data.forEach(element => {
                    // $i = $i + 1;
                    var file = '<li class="list-group-item">' + element['File_Name'] + '<a href="./files/uploads/disaster_related_activities/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a></li>';
                    $('#disaster_related_activities_files1').append(file);
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

        // var Disaster_Related_Activities_ID = $('#Disaster_Related_Activities_ID').val(); //aldren
        // if  (Disaster_Related_Activities_ID==1){
        //     $('#Modal_Title').text('Create Disaster Related Activities')
        // }else{
        //     $('#Modal_Title').text('Edit Disaster Related Activities')
        // }
        // $('#Modal_Title').text('Create Disaster Related Activities');
        $('#disaster_related_activities_files').empty();
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
                    url: "/delete_disaster_related_activities_attachments",
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
                        $('#CloseDisaster_Related_Activities').click();
                    }
                });

            }
        });

    });

    $(document).on("change", "#R_ID", function() {

        var Region_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_province/" + Region_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#P_ID').empty();
                $('#CM_ID').empty();
                $('#B_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#P_ID').append(option1);
                $('#CM_ID').append(option1);
                $('#B_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["Province_ID"] +
                        "'>" +
                        element["Province_Name"] +
                        "</option>";
                    $('#P_ID').append(option);
                });
            }
        });
    });

    $(document).on("change", "#P_ID", function() {
        var Province_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_city/" + Province_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#CM_ID').empty();
                $('#B_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#CM_ID').append(option1);
                $('#B_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["City_Municipality_ID"] +
                        "'>" +
                        element["City_Municipality_Name"] +
                        "</option>";
                    $('#CM_ID').append(option);
                });
            }
        });
    });

    $(document).on("change", "#CM_ID", function() {
        var City_Municipality_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_barangay/" + City_Municipality_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#B_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#B_ID').append(option1);

                data.forEach(element => {

                    var option = " <option value='" +
                        element["Barangay_ID"] +
                        "'>" +
                        element["Barangay_Name"] +
                        "</option>";
                    $('#B_ID').append(option);
                });
            }
        });
    });


    $(document).on("change", "#B_ID", function() {
        var Barangay_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_disaster_related_activities_list/" + Barangay_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#example').dataTable().fnClearTable();
                $('#example').dataTable().fnDraw();
                $('#example').dataTable().fnDestroy();

                data.forEach(element => {

                    $('#example').DataTable().row.add([
                        element["Activity_Name"],
                        element["Purpose"],
                        element["Date_Start"],
                        element["Date_End"],
                        element["Number_of_Participants"],
                        "<button class='edit_disaster_related_activities' value='" + element["Disaster_Related_Activities_ID"] + "' data-toggle='modal' data-target='#createDisaster_Related_Activities'>View</button>",
                    ]).draw();
                });
            }
        });
    });

    // Disable Form if DILG USER
    $(document).ready(function() {
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 3 || User_Type_ID == 4) {
            $("#newDisaster_Related_Activities :input").prop("disabled", true);
        }
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.disasterActivities').addClass('active');
        $('.disaster_menu').addClass('active');
        $('.disaster_main').addClass('menu-open');
    });


    // Delete Contractor
    $(document).on('click', ('.delete_disasterrelated'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this disaster related activities?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_disasterrelated",
                    type: 'GET',
                    data: {
                        id: disID
                    },
                    fail: function() {
                        alert('request failed');
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Deleted',
                            text: "Disaster Related Activities has been deleted.",
                            icon: 'success',
                            showConfirmButton: false,
                        });
                        location.reload();
                    }
                });

            }
        });
    });

    $(document).on('click', ('.view_disrelact'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_disaster_related_activities_view",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#VActivity_Name').html(data['theEntry'][0]['Activity_Name']);
                $('#VPurpose').html(data['theEntry'][0]['Purpose']);
                $('#VDate_Start').html(data['theEntry'][0]['Date_Start']);
                $('#VDate_End').html(data['theEntry'][0]['Date_End']);
                $('#VNumber_of_Participants').html(data['theEntry'][0]['Number_of_Participants']);
                $('#VBrgy_Official_Name').html(data['theEntry'][0]['Brgy_Official_Name']);
            
            
            }
        });

    });

    $(".searchFilter").change(function() {
        Search();
        // alert('test');
        
    });

    function Search() {
        // alert('test');
       
        var param1 = $('.searchFilter1').val();
        var param2 = $('.searchFilter2').val();
        var param3 = $('.searchFilter3').val();
        var param4 = $('.searchFilter4').val();
        var param5 = $('.searchFilter5').val();
        // var param2 = $('.searchFilter2').val();
        // var param3 = $('.searchFilter3').val();
        // var param4 = $('.searchFilter4').val();
        // var param5 = $('.searchpFilter5').val();
        var page = $('#hidden_page').val();

        $.ajax({
            url: "/search_disaster_related_activities_fields?page=" + page + "& param1=" + param1 + "& param2=" + param2 + "& param3=" + param3 + "& param4=" + param4 + "& param5=" + param5,
            // url: "/search_disaster_related_activities_fields?page=" + page + "& param1=" + param1 + "&param2=" + param2 + "& param3=" + param3 + "& param4=" + param4 + "& param5=" + param5,
            success: function(data) {
                $('#ListData').html('');
                $('#ListData').html(data);
            }
        });
    }


    $(document).on('change',('#Date_Start'),function(e) {
        var disVal = $(this).val();

        $(this).attr('hidden', 'true');
        var now = new Date(disVal).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric"});

        $('#Date_Start_Words').val(now);
        $('#Date_Start_Words').removeAttr('hidden');

    });

    $(document).on('click',('#Date_Start_Words'),function(e) {
        $(this).attr('hidden', 'true');
        $('#Date_Start').removeAttr('hidden');
    });

    $(document).on('change',('#Date_End'),function(e) {
        var disVal = $(this).val();

        $(this).attr('hidden', 'true');
        var now = new Date(disVal).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric"});

        $('#Date_End_Words').val(now);
        $('#Date_End_Words').removeAttr('hidden');

    });

    $(document).on('click',('#Date_End_Words'),function(e) {
        $(this).attr('hidden', 'true');
        $('#Date_End').removeAttr('hidden');
    });
</script>

<style>
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