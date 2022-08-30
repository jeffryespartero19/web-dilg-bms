@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Response Information List </div> 
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BDRIS / </li>
            </a> 
            <li> &nbsp;Response Information List</li>
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
        <div class="twenty_split txtRight"><button data-toggle="modal" class="btn btn-success" data-target="#createResponse_Information" style="width: 100px;">New</button></div>
        <div class="txtRight" style="margin-left: 5px;"><a href="{{ url('viewResponse_InformationPDF') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Disaster_Response_ID</th>
                    <th >Disaster_Name</th>
                    <th >Disaster_Type</th>
                    <th >Alert_Level</th>
                    <th >Damaged_Location</th>
                    <th >Disaster_Date_Start</th>
                    <th >Disaster_Date_End</th>
                    <th >GPS_Coordinates</th>
                    <th >Risk_Assesment</th>
                    <th >Action_Taken</th>
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
                    <td class="sm_data_col txtCtr" hidden>{{$x->Disaster_Response_ID}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Disaster_Name}}</td>  
                    <td class="sm_data_col txtCtr" >{{$x->Disaster_Type}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Alert_Level}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Damaged_Location}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Disaster_Date_Start}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Disaster_Date_End}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->GPS_Coordinates}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Risk_Assesment}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Action_Taken}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Region_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Province_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->City_Municipality_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Barangay_Name}}</td>
                    <td class="sm_data_col txtCtr"> 
                        <button class="edit_response_information" value="{{$x->Disaster_Response_ID}}" data-toggle="modal" data-target="#createResponse_Information">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Announcement_Status Modal  -->

<div class="modal fade" id="createResponse_Information" tabindex="-1" role="dialog" aria-labelledby="Create_Response_Information" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Response Information Profile</h4>
            </div>
            <div class="modal-body">
                <form id="newResponse_Information" method="POST" action="{{ route('create_response_information') }}"  autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Response Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Disaster_Response_ID" name="Disaster_Response_ID" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Disaster_Name">Disaster Name</label>
                                <input type="text" class="form-control" id="Disaster_Name" name="Disaster_Name">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Disaster_Type_ID">Disaster Type</label>
                                <select class="form-control" id="Disaster_Type_ID" name="Disaster_Type_ID">
                                    <option value='' disabled selected>Select Option</option>
                                        @foreach($disaster_type as $bt1)
                                        <option value="{{ $bt1->Disaster_Type_ID }}">{{ $bt1->Disaster_Type }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Alert_Level_ID">Alert Level</label>
                                <select class="form-control" id="Alert_Level_ID" name="Alert_Level_ID">
                                    <option value='' disabled selected>Select Option</option>
                                        @foreach($alert_level as $bt1)
                                        <option value="{{ $bt1->Alert_Level_ID }}">{{ $bt1->Alert_Level }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Disaster_Date_Start">Disaster Date Start</label>
                                <input type="datetime-local" class="form-control" id="Disaster_Date_Start" name="Disaster_Date_Start" required>
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Disaster_Date_End">Disaster Date End</label>
                                <input type="datetime-local" class="form-control" id="Disaster_Date_End" name="Disaster_Date_End" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-9" style="padding:0 10px">
                                <label for="Damaged_Location">Damaged Location</label>
                                <input type="text" class="form-control" id="Damaged_Location" name="Damaged_Location">
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="GPS_Coordinates">GPS Coordinates</label>
                                <input type="text" class="form-control" id="GPS_Coordinates" name="GPS_Coordinates">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="Risk_Assesment">Risk Assesment</label>
                                <input type="text" class="form-control" id="Risk_Assesment" name="Risk_Assesment">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="Action_Taken">Action Taken</label>
                                <input type="text" class="form-control" id="Action_Taken" name="Action_Taken">
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
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="fileattach">File Attachments</label>
                                <ul class="list-group list-group-flush" id="response_information_files">

                                </ul>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fileattach" name="fileattach[]" multiple>
                                    <label class="custom-file-label btn btn-info" for="fileattach">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="CloseResponse_Information" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button>
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
        $('#newResponse_Information').trigger("reset");
        $('#Modal_Title').text('Create Response Information');
        $('#response_information_files').empty();
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
    $(document).on('click', ('.edit_response_information'), function(e) {
        $('#Modal_Title').text('Edit Response Information');
        var disID = $(this).val();
        $.ajax({
            url: "/get_response_information",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Disaster_Response_ID').val(data['theEntry'][0]['Disaster_Response_ID']);
                $('#Disaster_Name').val(data['theEntry'][0]['Disaster_Name']);
                $('#Disaster_Type_ID').val(data['theEntry'][0]['Disaster_Type_ID']);   
                $('#Alert_Level_ID').val(data['theEntry'][0]['Alert_Level_ID']); 
                $('#Damaged_Location').val(data['theEntry'][0]['Damaged_Location']); 
                $('#Disaster_Date_Start').val(data['theEntry'][0]['Disaster_Date_Start']); 
                $('#Disaster_Date_End').val(data['theEntry'][0]['Disaster_Date_End']); 
                $('#GPS_Coordinates').val(data['theEntry'][0]['GPS_Coordinates']); 
                $('#Risk_Assesment').val(data['theEntry'][0]['Risk_Assesment']); 
                $('#Action_Taken').val(data['theEntry'][0]['Action_Taken']);                 
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
            url: "/get_response_information_attachments",
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
                    var file = '<li class="list-group-item">' + element['File_Name'] + '<a href="./files/uploads/response_information/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a>|<button type="button" class="btn ord_del" value="' + element['Attachment_ID'] + '" style="color: red; margin-left:2px;">Delete</button></li>';
                    $('#response_information_files').append(file);
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
                    url: "/delete_response_information_attachments",
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
                        $('#CloseResponse_Information').click();
                    }
                });

            }
        });

    });
</script>

<style>
    table {
        display: block;
        overflow-x: scroll;
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