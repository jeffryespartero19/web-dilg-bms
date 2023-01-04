@extends('layouts.default')

@section('content')

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Resolutions List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Resolutions List</li>
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
            @if (Auth::user()->User_Type_ID == 3)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
                            <div class="form-group col-lg-6">
                                <label for="CM_ID">City/Municipality</label>
                                <select class="form-control" id="CM_ID" name="CM_ID" required>
                                    <option value='' disabled selected>Select Option</option>

                                    @foreach($city1 as $city_municipality)
                                    <option value="{{ $city_municipality->City_Municipality_ID }}">{{ $city_municipality->City_Municipality_Name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="B_ID">Barangay</label>
                                <select class="form-control" id="B_ID" name="B_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div style="text-align: right;">
                            <div class="btn-group">
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-success" data-target="#createOrdinance_Info" style="width: 100px;">New</button></div>
                                <!-- <div class="txtRight" style="margin-left: 5px;"><a href="{{ url('view_Ordinance') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div> -->
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Print</button></div>
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div>
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Resolution Number</th>
                                            <th>Title</th>
                                            <th>Date of Approval</th>
                                            <th>Date of Effectivity</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr">{{$x->Ordinance_Resolution_No}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Ordinance_Resolution_Title}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Date_of_Approval}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Date_of_Effectivity}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Name_of_Status}}</td>
                                            <td class="sm_data_col txtCtr" style="display: flex;">
                                                <button class="view_ordinance btn btn-primary">View</button>&nbsp;
                                                <button class="edit_ordinance btn btn-info" value="{{$x->Ordinance_Resolution_ID}}" data-toggle="modal" data-target="#createOrdinance_Info">Edit</button>
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




<!-- Create Announcement_Status Modal -->

<div class="modal fade" id="createOrdinance_Info" role="dialog" aria-labelledby="Create_Ordinance" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Create Resolution</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>

            </div>
            <form id="newOrdinance" method="POST" action="{{ route('create_ordinance_and_resolution') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row">
                            <input type="text" class="form-control" id="Ordinance_Resolution_ID" name="Ordinance_Resolution_ID" value="" hidden>
                            <input type="text" class="form-control" id="Ordinance_or_Resolution" name="Ordinance_or_Resolution" hidden value=1>
                            <input type="text" class="form-control btn_action" id="btn_action" name="btn_action" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Resolution No</label>
                                <input type="text" class="form-control" id="Ordinance_Resolution_No" name="Ordinance_Resolution_No" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Date_of_Approval">Date of Approval</label>
                                <input type="date" class="form-control" id="Date_of_Approval" name="Date_of_Approval" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Date_of_Effectivity">Date of Effectivity</label>
                                <input type="date" class="form-control" id="Date_of_Effectivity" name="Date_of_Effectivity" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Ordinance_Resolution_Title">Resolution Title</label>
                                <input type="text" class="form-control" id="Ordinance_Resolution_Title" name="Ordinance_Resolution_Title" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Status_of_Ordinance_or_Resolution_ID">Status</label>
                                <select class="form-control" id="Status_of_Ordinance_or_Resolution_ID" name="Status_of_Ordinance_or_Resolution_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($status as $status)
                                    <option value="{{ $status->Status_of_Ordinance_or_Resolution_ID  }}">{{ $status->Name_of_Status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Previous_Related_Ordinance_Resolution_ID">Previous Related Resolution</label>
                                <select class="form-control" id="Previous_Related_Ordinance_Resolution_ID" name="Previous_Related_Ordinance_Resolution_ID">
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Approver_ID">Approver</label>
                                <select class="form-control" id="Approver_ID" name="Approver_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($brgy_official as $bo)
                                    <option value="{{ $bo->Resident_ID  }}">{{ $bo->Last_Name }}, {{$bo->First_Name}} {{$bo->Middle_Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Attester_ID">Attester</label>
                                <select class="form-control select2" id="Attester_ID" name="Attester_ID[]" multiple="multiple" required>
                                    @foreach($brgy_official as $bo)
                                    <option value="{{ $bo->Resident_ID  }}">{{ $bo->Last_Name }}, {{$bo->First_Name}} {{$bo->Middle_Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="fileattach">File Attachments</label>
                                <ul class="list-group list-group-flush" id="ordinance_files">

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
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal" id="CloseOrdinance">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="print_filter" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="print_report" method="POST" action="{{ route('view_Ordinance') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <input type="number" id="chk_Ordinance" name="chk_Ordinance" hidden value=1>
                                <input type="checkbox" id="chk_Ordinance_No" name="chk_Ordinance_No">
                                <label for="chk_Ordinance_No">Resolution No.</label><br>
                                <input type="checkbox" id="chk_Approval" name="chk_Approval">
                                <label for="chk_Approval">Date of Approval</label><br>
                                <input type="checkbox" id="chk_Effectivity" name="chk_Effectivity">
                                <label for="chk_Effectivity">Date of Effectivity</label><br>
                                <input type="checkbox" id="chk_Title" name="chk_Title">
                                <label for="chk_Title">Resolution Title</label><br>
                                <input type="checkbox" id="chk_Status" name="chk_Status">
                                <label for="chk_Status">Status</label><br>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <input type="checkbox" id="chk_Region" name="chk_Region">
                                <label for="chk_Region">Region</label><br>
                                <input type="checkbox" id="chk_Province" name="chk_Province">
                                <label for="chk_Province">Province</label><br>
                                <input type="checkbox" id="chk_City" name="chk_City">
                                <label for="chk_City">City/Municipality</label><br>
                                <input type="checkbox" id="chk_Barangay" name="chk_Barangay">
                                <label for="chk_Barangay">Barangay</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="download_filter" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="download_report" method="POST" action="{{ route('print_Ordinance') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <input type="number" id="1chk_Ordinance" name="chk_Ordinance" hidden value=1>
                                <input type="checkbox" id="1chk_Ordinance_No" name="chk_Ordinance_No">
                                <label for="1chk_Ordinance_No">Resolution No.</label><br>
                                <input type="checkbox" id="1chk_Approval" name="chk_Approval">
                                <label for="1chk_Approval">Date of Approval</label><br>
                                <input type="checkbox" id="1chk_Effectivity" name="chk_Effectivity">
                                <label for="1chk_Effectivity">Date of Effectivity</label><br>
                                <input type="checkbox" id="1chk_Title" name="chk_Title">
                                <label for="1chk_Title">Resolution Title</label><br>
                                <input type="checkbox" id="1chk_Status" name="chk_Status">
                                <label for="1chk_Status">Status</label><br>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <input type="checkbox" id="1chk_Region" name="chk_Region">
                                <label for="1chk_Region">Region</label><br>
                                <input type="checkbox" id="1chk_Province" name="chk_Province">
                                <label for="1chk_Province">Province</label><br>
                                <input type="checkbox" id="1chk_City" name="chk_City">
                                <label for="1chk_City">City/Municipality</label><br>
                                <input type="checkbox" id="1chk_Barangay" name="chk_Barangay">
                                <label for="1chk_Barangay">Barangay</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    $(document).ready(function() {
        $('.select2').select2();

        //Select2 Lazy Loading Resolution
        $("#Previous_Related_Ordinance_Resolution_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_resolution',
                dataType: "json",
            }
        });
    });

    $(document).ready(function() {
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 3) {
            $("#newOrdinance :input").prop("disabled", true);
        }
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

    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    $(document).on('click', '.modal-close', function(e) {
        $('#newOrdinance').trigger("reset");
        $('#Barangay_ID').empty();
        $('#City_Municipality_ID').empty();
        $('#Province_ID').empty();
        var option1 = "<option value='' disabled selected>Select Option</option>";
        $('#Barangay_ID').append(option1);
        $('#City_Municipality_ID').append(option1);
        $('#Province_ID').append(option1);
        $('#Modal_Title').text('Create Ordinance');
        $('#ordinance_files').empty();

    });

    // Edit Button Display Modal
    $(document).on('click', ('.edit_ordinance'), function(e) {

        var disID = $(this).val();
        var User_Type_ID = $('#User_Type_ID').val();
        var btn_action = $('#btn_action').val();
        $('#Modal_Title').text('Edit Ordinance Information');
        $.ajax({
            url: "/get_ordinance_and_resolution_info",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Ordinance_Resolution_ID').val(data['theEntry'][0]['Ordinance_Resolution_ID']);
                $('#Ordinance_or_Resolution').val(data['theEntry'][0]['Ordinance_or_Resolution']);
                $('#Ordinance_Resolution_No').val(data['theEntry'][0]['Ordinance_Resolution_No']);
                $('#Date_of_Approval').val(data['theEntry'][0]['Date_of_Approval']);
                $('#Date_of_Effectivity').val(data['theEntry'][0]['Date_of_Effectivity']);
                $('#Name_Suffix_ID').val(data['theEntry'][0]['Name_Suffix_ID']);
                $('#Ordinance_Resolution_Title').val(data['theEntry'][0]['Ordinance_Resolution_Title']);
                $('#Status_of_Ordinance_or_Resolution_ID').val(data['theEntry'][0]['Status_of_Ordinance_or_Resolution_ID']);
                $('#Previous_Related_Ordinance_Resolution_ID').val(data['theEntry'][0]['Previous_Related_Ordinance_Resolution_ID']);
                $('#Approver_ID').val(data['theEntry'][0]['Approver_ID']);
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

                var presolution_title =
                    " <option value='" + data['theEntry'][0]['Previous_Related_Ordinance_Resolution_ID'] + "' selected>" + data['theEntry'][0]['POrdinance_Title'] + "</option>";
                $('#Previous_Related_Ordinance_Resolution_ID').append(presolution_title);
            }
        });

        $.ajax({
            url: "/get_ordinance_attachments",
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
                if (User_Type_ID == 1 && btn_action != 1) {
                    data.forEach(element => {
                        $i = $i + 1;
                        var file = '<li class="list-group-item">' + $i + '. ' + element['File_Name'] + ' (' + (element['File_Size'] / 1048576).toFixed(2) + ' MB)<a href="./files/uploads/ordinance_and_resolution/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a>|<button type="button" class="btn ord_del" value="' + element['Attachment_ID'] + '" style="color: red; margin-left:2px;">Delete</button></li>';
                        $('#ordinance_files').append(file);
                    });
                } else {
                    data.forEach(element => {
                        $i = $i + 1;
                        var file = '<li class="list-group-item">' + $i + '. ' + element['File_Name'] + ' (' + (element['File_Size'] / 1048576).toFixed(2) + ' MB)<a href="./files/uploads/ordinance_and_resolution/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a></li>';
                        $('#ordinance_files').append(file);
                    });
                }

            }
        });

        $.ajax({
            url: "/get_ordinance_and_resolution_attester",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                // alert(data);

                var arr = new Array();
                // or var arr = [];

                data.forEach(element => {
                    arr.push(element['Resident_ID']);
                });

                $('#Attester_ID').val(arr).trigger('change')

                // alert(arr);

            }
        });
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
                    url: "/delete_ordinance_attachments",
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
                        $('#CloseOrdinance').click();
                    }
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
            url: "/get_resolution/" + Barangay_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                // alert(data);
                $('#example').dataTable().fnClearTable();
                $('#example').dataTable().fnDraw();
                $('#example').dataTable().fnDestroy();

                data.forEach(function(element) {

                    $('#example').DataTable().row.add([
                        element["Ordinance_Resolution_No"],
                        element["Ordinance_Resolution_Title"],
                        element["Date_of_Approval"],
                        element["Date_of_Effectivity"],
                        element["Name_of_Status"],
                        "<button class='edit_ordinance' value='" + element["Ordinance_Resolution_ID"] + "' data-toggle='modal' data-target='#createOrdinance_Info'>Edit</button>",
                    ]).draw();

                });
            }
        });
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.resolution').addClass('active');
        $('.boris_menu').addClass('active');
        $('.boris_main').addClass('menu-open');
    });

    $(document).on('click', ('.view_ordinance'), function() {
        $("#createOrdinance_Info :input").prop("disabled", true);
        $(".modal-close").prop("disabled", false);

        $(".btn_action").val(1);

        $(this).closest(".sm_data_col").find(".edit_ordinance").trigger('click');
    });

    $(document).on('click', '.modal-close', function(e) {
        $('#createOrdinance_Info').trigger("reset");
        $("#createOrdinance_Info :input").prop("disabled", false);
        $(".btn_action").val(0);
        $("#Previous_Related_Ordinance_Resolution_ID ").empty();
        $("#Attester_ID").val([]).change();
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