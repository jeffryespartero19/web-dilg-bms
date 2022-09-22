@extends('layouts.default')

@section('content')

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Ordinances and Resolutions List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;Ordinances and Resolutions List</li>
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
        <div class="twenty_split txtRight"><button data-toggle="modal" class="btn btn-success" data-target="#createOrdinance_Info" style="width: 100px;">New</button></div>
        <div class="txtRight" style="margin-left: 5px;"><a href="{{ url('view_Ordinance') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div>
        <div class="txtRight" style="margin-left: 5px;"><a href="{{ url('print_Ordinance') }}" target="_blank" class="btn btn-info" style="width: 100px;">Download</a></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Ordinance_Resolution_ID</th>
                    <th>Ordinance_or_Resolution</th>
                    <th>Ordinance_Resolution_No</th>
                    <th>Date_of_Approval</th>
                    <th>Date_of_Effectivity</th>
                    <th>Ordinance_Resolution_Title</th>
                    <th>Status_of_Ordinance_or_Resolution_ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Ordinance_Resolution_ID}}</td>
                    <td class="sm_data_col txtCtr">@if($x->Ordinance_or_Resolution == 1) Resolution @else Ordinance @endif</td>
                    <td class="sm_data_col txtCtr">{{$x->Ordinance_Resolution_No}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Date_of_Approval}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Date_of_Effectivity}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Ordinance_Resolution_Title}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Name_of_Status}}</td>
                    <td class="sm_data_col txtCtr">
                        <button class="edit_ordinance" value="{{$x->Ordinance_Resolution_ID}}" data-toggle="modal" data-target="#createOrdinance_Info">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- Create Announcement_Status Modal -->

<div class="modal fade" id="createOrdinance_Info" tabindex="-1" role="dialog" aria-labelledby="Create_Ordinance" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Create Ordinance and Resolution</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <form id="newOrdinance" method="POST" action="{{ route('create_ordinance_and_resolution') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Name</h3>
                        <div class="row">
                            <input type="text" class="form-control" id="Ordinance_Resolution_ID" name="Ordinance_Resolution_ID" value="" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Type</label>
                                <select class="form-control" id="Ordinance_or_Resolution" name="Ordinance_or_Resolution" required>
                                    <option value='' disabled selected>Select Option</option>
                                    <option value=0>Ordinance</option>
                                    <option value=1>Resolution</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Ordinance Resolution No</label>
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
                                <label for="Ordinance_Resolution_Title">Ordinance Resolution Title</label>
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
                                <label for="Abstract_Content">Abstract Content</label>
                                <input type="text" class="form-control" id="Abstract_Content" name="Abstract_Content" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Previous_Related_Ordinance_Resolution_ID">Previous Related Ordinance Resolution</label>
                                <select class="form-control" id="Previous_Related_Ordinance_Resolution_ID" name="Previous_Related_Ordinance_Resolution_ID">
                                    <option value='' selected>Select Option</option>
                                    @foreach($db_entries as $de)
                                    <option value="{{ $de->Ordinance_Resolution_ID   }}">{{ $de->Ordinance_Resolution_Title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Region</label>
                                <select class="form-control" id="Region_ID" name="Region_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($region as $region)
                                    <option value="{{ $region->Region_ID }}">{{ $region->Region_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Province</label>
                                <select class="form-control" id="Province_ID" name="Province_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="City_Municipality_ID">City/Municipality</label>
                                <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Barangay_ID">Barangay</label>
                                <select class="form-control" id="Barangay_ID" name="Barangay_ID" required>
                                    <option value='' disabled selected>Select Option</option>
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
                    <div class="modal-footer">
                        <button type="button" id="CloseOrdinance" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="width: 200px;">Create</button>
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
                $('#Abstract_Content').val(data['theEntry'][0]['Abstract_Content']);
                $('#Previous_Related_Ordinance_Resolution_ID').val(data['theEntry'][0]['Previous_Related_Ordinance_Resolution_ID']);
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
                data.forEach(element => {
                    var file = '<li class="list-group-item">' + element['File_Name'] + '<a href="./files/uploads/ordinance_and_resolution/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a>|<button type="button" class="btn ord_del" value="' + element['Attachment_ID'] + '" style="color: red; margin-left:2px;">Delete</button></li>';
                    $('#ordinance_files').append(file);
                });
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

    table {
        display: block;
        overflow-x: scroll;
    }
</style>

@endsection