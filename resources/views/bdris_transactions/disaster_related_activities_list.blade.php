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
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BDRIS</a></li>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="text-align: right;">
                            <div class="btn-group">
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-success" data-target="#createDisaster_Related_Activities" style="width: 100px;">New</button></div>
                                <!-- <div class="txtRight" style="margin-left: 5px;"><a href="{{ url('view_Ordinance') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div> -->
                                <div style="padding: 2px;"><a href="{{ url('viewDisaster_Related_ActivitiesPDF') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div>
                                <!-- <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div> -->
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Disaster_Related_Activities_ID </th>
                                            <th>Activity_Name </th>
                                            <th>Purpose </th>
                                            <th>Date_Start </th>
                                            <th>Date_End </th>
                                            <th>Number_of_Participants </th>
                                            <th>Brgy Official Name </th>
                                            <th>Region </th>
                                            <th>Province </th>
                                            <th>City/Municipality </th>
                                            <th>Barangay</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr" hidden>{{$x->Disaster_Related_Activities_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Activity_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Purpose}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Date_Start}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Date_End}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Number_of_Participants}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Last_Name}} {{$x->First_Name}}, {{$x->Middle_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Region_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Province_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->City_Municipality_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Barangay_Name}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_disaster_related_activities" value="{{$x->Disaster_Related_Activities_ID}}" data-toggle="modal" data-target="#createDisaster_Related_Activities">Edit</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                <h4 class="modal-title flexer justifier">Disaster Related Activities Profile</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newDisaster_Related_Activities" method="POST" action="{{ route('create_disaster_related_activities') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <h3>Disaster Related Activities Information</h3>
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
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="Date_Start">Date Start</label>
                                <input type="date" class="form-control" id="Date_Start" name="Date_Start" required>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="Date_End">Date End</label>
                                <input type="date" class="form-control" id="Date_End" name="Date_End" required>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="Number_of_Participants">Number of Participants</label>
                                <input type="number" class="form-control" id="Number_of_Participants" name="Number_of_Participants">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="Brgy_Officials_and_Staff_ID">Brgy Official Name</label>
                                <select class="form-control" id="Brgy_Officials_and_Staff_ID" name="Brgy_Officials_and_Staff_ID">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($brgy_officials_and_staff as $bt1)
                                    <option value="{{ $bt1->Resident_ID }}">{{ $bt1->Last_Name }} {{ $bt1->First_Name }}, {{ $bt1->Middle_Name }}</option>
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
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="Province_ID">Province</label>
                                <select class="form-control" id="Province_ID" name="Province_ID">
                                    <option value='' disabled selected>Select Option</option>


                                </select>
                            </div>
                        </div>
                        <div class="row">
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
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="fileattach">File Attachments</label>
                                <ul class="list-group list-group-flush" id="disaster_related_activities_files">

                                </ul>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fileattach" name="fileattach[]" multiple>
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


<!-- Create Announcement_Status END -->







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


    $(document).on('click', '.modal-close', function(e) {
        $('#newBrgy_Projects_Monitoring').trigger("reset");
        $('#Barangay_ID').empty();
        $('#City_Municipality_ID').empty();
        $('#Province_ID').empty();
        var option1 = "<option value='' disabled selected>Select Option</option>";
        $('#Barangay_ID').append(option1);
        $('#City_Municipality_ID').append(option1);
        $('#Province_ID').append(option1);

        $('#Modal_Title').text('Create Disaster Related Activities');
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