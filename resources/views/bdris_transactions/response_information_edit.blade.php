@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Response Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('response_information_list')}}">Response Information List</a></li>
                        <li class="breadcrumb-item active">Response Information</li>
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
                                <form id="newResponse_Information" method="POST" action="{{ route('create_response_information') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input type="text" class="form-control" id="Disaster_Response_ID" name="Disaster_Response_ID" value="{{$response[0]->Disaster_Response_ID}}" hidden>
                                        <div class="row">
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Disaster_Name">Disaster Name</label>
                                                <input type="text" class="form-control" id="Disaster_Name" name="Disaster_Name" value="{{$response[0]->Disaster_Name}}">
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Disaster_Type_ID">Disaster Type</label>
                                                <select class="form-control" id="Disaster_Type_ID" name="Disaster_Type_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($disaster_type as $bt1)
                                                    <option value="{{ $bt1->Disaster_Type_ID }}" {{ $bt1->Disaster_Type_ID  == $response[0]->Disaster_Type_ID  ? "selected" : "" }}>{{ $bt1->Disaster_Type }}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Alert_Level_ID">Alert Level</label>
                                                <select class="form-control" id="Alert_Level_ID" name="Alert_Level_ID">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($alert_level as $bt1)
                                                    <option value="{{ $bt1->Alert_Level_ID }}" {{ $bt1->Alert_Level_ID  == $response[0]->Alert_Level_ID  ? "selected" : "" }}>{{ $bt1->Alert_Level }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Disaster_Date_Start">Disaster Date Start</label>
                                                <input type="datetime-local" class="form-control" id="Disaster_Date_Start" name="Disaster_Date_Start" value="{{$response[0]->Disaster_Date_Start}}" required>
                                                <input type="text" class="form-control" id="Disaster_Date_Start_Words" value="{{$response[0]->Disaster_Date_Start}}" hidden>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Disaster_Date_End">Disaster Date End</label>
                                                <input type="datetime-local" class="form-control" id="Disaster_Date_End" name="Disaster_Date_End" value="{{$response[0]->Disaster_Date_End}}" required>
                                                <input type="text" class="form-control" id="Disaster_Date_End_Words" value="{{$response[0]->Disaster_Date_End}}" hidden>
                                            </div>
                                            <!-- <div class="form-group col-lg-9" style="padding:0 10px">
                                                <label for="Damaged_Location">Damaged Location</label>
                                                <input type="text" class="form-control" id="Damaged_Location" name="Damaged_Location" value="{{$response[0]->Damaged_Location}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="GPS_Coordinates">GPS Coordinates</label>
                                                <input type="text" class="form-control" id="GPS_Coordinates" name="GPS_Coordinates" value="{{$response[0]->GPS_Coordinates}}">
                                            </div>
                                            <div class="form-group col-lg-12" style="padding:0 10px">
                                                <label for="Risk_Assesment">Risk Assesment</label>
                                                <input type="text" class="form-control" id="Risk_Assesment" name="Risk_Assesment" value="{{$response[0]->Risk_Assesment}}">
                                            </div>
                                            <div class="form-group col-lg-12" style="padding:0 10px">
                                                <label for="Action_Taken">Action Taken</label>
                                                <input type="text" class="form-control" id="Action_Taken" name="Action_Taken" value="{{$response[0]->Action_Taken}}">
                                            </div> -->
                                            <div class="col-lg-12" style="padding:0 10px;">
                                                <a onclick="addDamage();" style="float: right; cursor:pointer" class="btn btn-default">+ Add</a>
                                                <br><br>
                                                <div class="table-responsive" id="DamageDetails">
                                                    <table id="DamageTBL" class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th hidden>Damage_Location_ID</th>
                                                                <th>Damage Location</th>
                                                                <th>GPS Coordinates</th>
                                                                <th>Risk Assessment</th>
                                                                <th>Action Taken</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="DAMAGEBody">
                                                            @if($damage->count() > 0)
                                                            @foreach ($damage as $id)
                                                            <tr class="DAMAGEDetails">
                                                                <td hidden></td>
                                                                <td>
                                                                    <input type="text" class="form-control" style="width: 350px;" name="Damage_Location[]" value="{{$id->Damage_Location}}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" style="width: 350px;" name="GPS_Coordinates[]" value="{{$id->GPS_Coordinates}}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" style="width: 350px;" name="Risk_Assessment[]" value="{{$id->Risk_Assessment}}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" style="width: 350px;" name="Action_Taken[]" value="{{$id->Action_Taken}}">
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    <button type="button" class="btn btn-danger DamageRemove">Remove</button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @else
                                                            <tr class="DAMAGEDetails">
                                                                <td hidden></td>
                                                                <td>
                                                                    <input type="text" class="form-control" style="width: 350px;" name="Damage_Location[]">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" style="width: 350px;" name="GPS_Coordinates[]">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" style="width: 350px;" name="Risk_Assessment[]">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" style="width: 350px;" name="Action_Taken[]">
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    <button type="button" class="btn btn-danger DamageRemove">Remove</button>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-lg-12" style="padding:0 10px">
                                                <label for="Summary">Summary</label>
                                                <input type="text" class="form-control" id="Summary" name="Summary" value="{{$response[0]->Summary}}">
                                            </div>
                                            <div class="form-group col-lg-12" style="padding:0 10px">
                                                <label for="fileattach">File Attachments</label>
                                                <ul class="list-group list-group-flush" id="response_files">

                                                </ul>
                                                <div class="custom-file">
                                                    <input type="file" accept="image/*" class="custom-file-input" id="fileattach" name="fileattach[]" multiple>
                                                    <label class="custom-file-label btn btn-info" for="fileattach">Choose file</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12" style="padding:0 10px;">
                                                <h3>Evacuee Information</h3>
                                                <a onclick="addResident();" style="float: right; cursor:pointer" class="btn btn-default">+ Add</a>
                                                <br>
                                                <div class="table-responsive" id="CasualtiesDetails">

                                                    <table id="ResidentTBL" class="table table-striped table-bordered ">
                                                        <thead>
                                                            <tr>
                                                                <th hidden>Resident_ID</th>
                                                                <th>Name</th>
                                                                <th>Resident Status</th>
                                                                <th>Address</th>
                                                                <th>Birthdate</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="HSBody">
                                                            @if($evacuee->count() > 0)
                                                            @foreach ($evacuee as $id)
                                                            <tr class="HRDetails">
                                                                <td hidden></td>
                                                                <td style="width: 30%;">
                                                                    <!-- <select class="form-control Resident_Info" name="Resident_ID[]" >
                                                                        <option value='' disabled selected>Select Option</option>
                                                                        @if($id->Resident_ID == 0)
                                                                        <option value="{{ $id->Non_Resident_Name }}" selected>{{ $id->Non_Resident_Name }}</option>
                                                                        @foreach($resident as $rs)
                                                                        <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                                                        @endforeach
                                                                        @else
                                                                        @foreach($resident as $rs)
                                                                        <option value="{{ $rs->Resident_ID }}" {{ $rs->Resident_ID == $id->Resident_ID  ? "selected" : "" }}>{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select> -->
                                                                    <select class="form-control js-example-basic-single Resident_Select2 mySelect2" name="Resident_ID[]" style="width: 400px;">
                                                                        <option value='' disabled selected>Select Option</option>
                                                                        @if($id->Resident_ID == 0)
                                                                        <option value="{{ $id->Non_Resident_Name }}" selected>{{ $id->Non_Resident_Name }}</option>
                                                                        @foreach($resident as $rs)
                                                                        <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                                                        @endforeach
                                                                        @else
                                                                        @foreach($resident as $rs)
                                                                        <option value="{{ $rs->Resident_ID }}" {{ $rs->Resident_ID == $id->Resident_ID  ? "selected" : "" }}>{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 200px; pointer-events:none" name="Residency_Status[]">
                                                                        <option value='' disabled selected>Select Option</option>
                                                                        <option value=0 {{ 0 == $id->Residency_Status  ? "selected" : "" }}>Non-Resident</option>
                                                                        <option value=1 {{ 1 == $id->Residency_Status  ? "selected" : "" }}>Resident</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" style="width: 500px;" name="Non_Resident_Address[]" value="{{$id->Non_Resident_Address}}">
                                                                </td>
                                                                <td>
                                                                    <input type="date" class="form-control" style="width: 200px;" name="Non_Resident_Birthdate[]" value="{{$id->Non_Resident_Birthdate}}">
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    <button type="button" class="btn btn-danger HRRemove">Remove</button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @else
                                                            <tr class="HRDetails">
                                                                <td hidden></td>
                                                                <td>
                                                                    <select class="form-control js-example-basic-single Resident_Select2 mySelect2" name="Resident_ID[]" style="width: 350px;">
                                                                        <option value='' disabled selected>Select Option</option>
                                                                        @foreach($resident as $rs)
                                                                        <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
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
                                                                    <input type="text" class="form-control" style="width: 500px;" name="Non_Resident_Address[]">
                                                                </td>
                                                                <td>
                                                                    <input type="date" class="form-control" style="width: 200px;" name="Non_Resident_Birthdate[]">
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    <button type="button" class="btn btn-danger HRRemove">Remove</button>
                                                                </td>
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
     // Data Table
     $(document).ready(function() {
        $('#example').DataTable();

        var disvals=$('#Disaster_Date_Start').val();
        var disvalss=$('#Disaster_Date_End').val();

        $('#Disaster_Date_Start').attr('hidden', 'true');
        var now1 = new Date(disvals).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric",hour:"numeric",minute:"numeric"});
        $('#Disaster_Date_Start_Words').val(now1);
        $('#Disaster_Date_Start_Words').removeAttr('hidden');

        $('#Disaster_Date_End').attr('hidden', 'true');
        var now2 = new Date(disvalss).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric",hour:"numeric",minute:"numeric"});
        $('#Disaster_Date_End_Words').val(now2);
        $('#Disaster_Date_End_Words').removeAttr('hidden');
    });

    //Select2
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $("#Disaster_Type_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_disastertype',
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

        var disID = $('#Disaster_Response_ID').val();
        var User_Type_ID = $('#User_Type_ID').val();
        $.ajax({
            url: "/get_response_attachments",
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
                        var file = '<li class="list-group-item">' + $i + '. ' + element['File_Name'] + ' (' + (element['File_Size'] / 1000000).toFixed(2) + ' MB)<a href="/files/uploads/response_information/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a>|<button type="button" class="btn res_del" value="' + element['Attachment_ID'] + '" style="color: red; margin-left:2px;">Delete</button></li>';
                        $('#response_files').append(file);

                    });
                } else {
                    data.forEach(element => {
                        $i = $i + 1;
                        var file = '<li class="list-group-item">' + $i + '. ' + element['File_Name'] + '<a href="./files/uploads/response_information/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a></li>';
                        $('#response_files').append(file);
                    });
                }

            }
        });
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


    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    

    // Resident Casualties Change 
    $('#CasualtiesDetails').on("change", ".Resident_Select2", function() {
        var Resident_Select2 = $(this).val();
        var Type = $.isNumeric(Resident_Select2);
        var disID = Resident_Select2;

        // alert(Type);
        $row = $(this).closest(".HRDetails");
        $($row.find('td:eq(4) input')).val('');
        $($row.find('td:eq(3) input')).val('');
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

    // function addResident() {
    //     var row = $("#ResidentTBL tr:last");

    //     row.find(".select2").each(function(index) {
    //         $("select.select2-hidden-accessible").select2('destroy');
    //     });

    //     var newrow = row.clone();

    //     newrow.find(".Resident_Info").empty();

    //     $("#ResidentTBL").append(newrow);

    //     $(".Resident_Select2").select2({
    //         tags: true,
    //         minimumInputLength: 2,
    //         ajax: {
    //             url: '/search_inhabitants',
    //             dataType: "json",
    //         }
    //     });

    //     $(newrow.find("td:eq(1) input")).val('');
    //     $(newrow.find("td:eq(4) input")).val('');
    //     $(newrow.find("td:eq(3) input")).val('');

    //     // $("select.js-example-basic-single").select2();

    //     // $(".Resident_Select2").select2({
    //     //     tags: true
    //     // });
    // }

    function addResident() {
        var row = $("#ResidentTBL tr:last");

        row.find(".select2").each(function(index) {
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

        $(newrow.find("td:eq(4) input")).val('');
        $(newrow.find("td:eq(3) input")).val('');

       
    }

     // Disable Form if DILG USER
     $(document).ready(function() {
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 3 || User_Type_ID == 4) {
            $("#newResponse_Information :input").prop("disabled", true);
        }
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.responseInfo').addClass('active');
        $('.disaster_menu').addClass('active');
        $('.disaster_main').addClass('menu-open');
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
                    url: "/delete_response_attachments",
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

    $(".DAMAGEBody").on("click", ".DamageRemove", function() {
        $(this).closest(".DAMAGEDetails").remove();
    });

    function addDamage() {
        var row = $("#DamageTBL tr:last");

        // row.find(".select2").each(function(index) {
        //     $("select.select2-hidden-accessible").select2('destroy');
        // });

        var newrow = row.clone();

        // newrow.find(".Resident_Info").empty();

        $("#DamageTBL").append(newrow);


        $(newrow.find("td:eq(1) input")).val('');
        $(newrow.find("td:eq(2) input")).val('');
        $(newrow.find("td:eq(3) input")).val('');
    
        $(newrow.find("td:eq(4) input")).val('');
    

    
       
    }

    $(".GPSBody").on("click", ".GPSRemove", function() {
        $(this).closest(".GPSDetails").remove();
    });

    $(".RiskBody").on("click", ".RiskRemove", function() {
        $(this).closest(".RiskDetails").remove();
    });

    $(".ActionBody").on("click", ".ActionRemove", function() {
        $(this).closest(".ActionDetails").remove();
    });

    function addRisk() {
        var row = $("#RiskTBL tr:last");

        // row.find(".select2").each(function(index) {
        //     $("select.select2-hidden-accessible").select2('destroy');
        // });

        var newrow = row.clone();

        // newrow.find(".Resident_Info").empty();

        $("#RiskTBL").append(newrow);


        $(newrow.find("td:eq(1) input")).val('');
    }

    function addAction() {
        var row = $("#ActionTBL tr:last");

        // row.find(".select2").each(function(index) {
        //     $("select.select2-hidden-accessible").select2('destroy');
        // });

        var newrow = row.clone();

        // newrow.find(".Resident_Info").empty();

        $("#ActionTBL").append(newrow);


        $(newrow.find("td:eq(1) input")).val('');
    }

    function addGPS() {
        var row = $("#GPSTBL tr:last");

        // row.find(".select2").each(function(index) {
        //     $("select.select2-hidden-accessible").select2('destroy');
        // });

        var newrow = row.clone();

        // newrow.find(".Resident_Info").empty();

        $("#GPSTBL").append(newrow);


        $(newrow.find("td:eq(1) input")).val('');
    }


    $(document).on('change',('#Disaster_Date_Start'),function(e) {
        var disVal = $(this).val();

        $(this).attr('hidden', 'true');
        var now = new Date(disVal).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric",hour:"numeric",minute:"numeric"});

        $('#Disaster_Date_Start_Words').val(now);
        $('#Disaster_Date_Start_Words').removeAttr('hidden');

    });

    $(document).on('click',('#Disaster_Date_Start_Words'),function(e) {
        $(this).attr('hidden', 'true');
        $('#Disaster_Date_Start').removeAttr('hidden');
    });


    $(document).on('change',('#Disaster_Date_End'),function(e) {
        var disVal = $(this).val();

        $(this).attr('hidden', 'true');
        var now = new Date(disVal).toLocaleDateString('en-us', { year:"numeric", month:"long",day: "numeric",hour:"numeric",minute:"numeric"});

        $('#Disaster_Date_End_Words').val(now);
        $('#Disaster_Date_End_Words').removeAttr('hidden');

    });

    $(document).on('click',('#Disaster_Date_End_Words'),function(e) {
        $(this).attr('hidden', 'true');
        $('#Disaster_Date_End').removeAttr('hidden');
    });
</script>

<style>
    .select2-selection {
        height: 32px !important;
        padding: 3px 3px;
        font: 13px;
    }

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