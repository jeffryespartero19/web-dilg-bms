@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Inhabitants Information List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;Inhabitants Information List</li>
        </ol>
    </div>
</div>
<div class="tableX_row col-md-12 up_marg5">
    <div class="flexer">
        <div class="eighty_split">{{$db_entries->appends(['db_entries' => $db_entries->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><button data-toggle="modal" data-target="#createAnn_Status">New</button></div>
    </div>
    <div class="col-md-12">
        <table class="table-bordered table_gen up_marg5">
            <thead>
                <tr>
                    <th hidden>Resident_ID</th>
                    <th>Name Prefix</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Name Suffix</th>
                    <th>Birthdate</th>
                    <th>Age</th>
                    <th>Resident Status</th>
                    <th>Voter Status</th>
                    <th>Resident Voter</th>
                    <th>Religion</th>
                    <th>Blood Type</th>
                    <th>Complete Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Resident_ID}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Name_Prefix_ID}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Last_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->First_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Middle_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Name_Suffix_ID}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Birthdate}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Age}}</td>
                    <td class="sm_data_col txtCtr"></td>
                    <td class="sm_data_col txtCtr"></td>
                    <td class="sm_data_col txtCtr"></td>
                    <td class="sm_data_col txtCtr"></td>
                    <td class="sm_data_col txtCtr"></td>
                    <td class="sm_data_col txtCtr"></td>
                    <td class="sm_data_col txtCtr">
                        <button class="edit_ann_status" value="{{$x->Announcement_Status_ID}}" data-toggle="modal" data-target="#updateAnn_Status">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Announcement_Status Modal -->
<div class="modal fade" id="createAnn_Status" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Create Inhabitant</h4>
            </div>
            <form id="newInhabitant" method="POST" action="{{ route('create_bweb_ann_status_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body">
                    <h3>Name</h3>
                    <br>
                    <div class="row">
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Prefix</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option value='' disabled selected>Select Option</option>
                                @foreach($prefix as $bt)
                                <option value="{{ $bt->Name_Prefix_ID }}">{{ $bt->Name_Prefix }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" class="form-control" name="Last_Name" required>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" class="form-control" name="First_Name" required>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Middle Name</label>
                            <input type="text" class="form-control" name="Middle_Name" required>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Suffix</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option value='' disabled selected>Select Option</option>
                                @foreach($suffix as $bt)
                                <option value="{{ $bt->Name_Suffix_ID }}">{{ $bt->Name_Suffix }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <h3>Personal Information</h3>
                    <br>
                    <div class="row">
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Birthdate</label>
                            <input type="date" class="form-control" name="Birthdate" required>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Age</label>
                            <input type="number" class="form-control" name="Age">
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="Birthplace">Birthplace</label>
                            <input type="text" class="form-control" name="Birthplace">
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="Religion_ID">Religion</label>
                            <select class="form-control" id="Religion_ID" name="Religion_ID">
                                <option value='' disabled selected>Select Option</option>
                                @foreach($religion as $religions)
                                <option value="{{ $religions->Religion_ID }}">{{ $religions->Religion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Blood Type</label>
                            <select class="form-control" id="Blood_Type_ID" name="Blood_Type_ID">
                                <option value='' disabled selected>Select Option</option>
                                @foreach($blood_type as $bt)
                                <option value="{{ $bt->Blood_Type_ID }}">{{ $bt->Blood_Type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Sex</label>
                            <select class="form-control" id="Sex" name="Sex">
                                <option value='' disabled selected>Select Option</option>
                                <option value='Male'>Male</option>
                                <option value='Female'>Female</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Civil Status</label>
                            <select class="form-control" id="Civil_Status_ID" name="Civil_Status_ID">
                                <option value='' disabled selected>Select Option</option>
                                @foreach($civil_status as $cs)
                                <option value="{{ $cs->Civil_Status_ID }}">{{ $cs->Civil_Status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Mobile No</label>
                            <input type="text" class="form-control" id="Mobile_No" name="Mobile_No">
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Telephone No</label>
                            <input type="text" class="form-control" id="Telephone_No" name="Telephone_No">
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="Salary">Salary</label>
                            <input type="text" class="form-control" name="Salary">
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="Email">
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="PhilSys_Card_No">PhilSys_Card_No</label>
                            <input type="text" class="form-control" name="PhilSys_Card_No">
                        </div>
                    </div>
                    <hr>
                    <h3>Address</h3>
                    <div class="row">

                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Region</label>
                            <select class="form-control" id="Region_ID" name="Region_ID">
                                <option value='' disabled selected>Select Option</option>
                                @foreach($region as $region)
                                <option value="{{ $region->Region_ID }}">{{ $region->Region_Name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Province</label>
                            <select class="form-control" id="Province_ID" name="Province_ID">
                                <option value='' disabled selected>Select Option</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">City/Municipality</label>
                            <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID">
                                <option value='' disabled selected>Select Option</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Barangay</label>
                            <select class="form-control" id="Barangay_ID" name="Barangay_ID">
                                <option value='' disabled selected>Select Option</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <h3>Additional Information</h3>
                    <div class="row">
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Solo Parent</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option value='' disabled selected>Select Option</option>
                                <option value='Yes'>Yes</option>
                                <option value='No'>No</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">OFW</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option value='' disabled selected>Select Option</option>
                                <option value='Yes'>Yes</option>
                                <option value='No'>No</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Indigent</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option value='' disabled selected>Select Option</option>
                                <option value='Yes'>Yes</option>
                                <option value='No'>No</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">4Ps Benefeciary</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option value='' disabled selected>Select Option</option>
                                <option value='Yes'>Yes</option>
                                <option value='No'>No</option>
                            </select>
                        </div>
                    </div>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn postThis_Ann_Status modal_sb_button">Create</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Create Announcement_Status END -->

<!-- Edit/Update Announcement_Status Modal -->
<div class="modal fade" id="updateAnn_Status" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Create Post</h4>
            </div>
            <form id="updateBRGY_Ann_Status" method="POST" action="{{ route('update_bweb_ann_status_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <div class="up_marg5">
                            <span><b>Announcement_Status:</b></span><br>
                            <input id="this_ann_status_idX" class="modal_input1" name="Announcement_Status_idX" hidden>
                            <input id="this_ann_statusX" class="modal_input1" name="Announcement_StatusX2">
                        </div>

                        <div class="up_marg5">
                            <span><b>Active:</b></span><br>
                            <select class="modal_input1" name="ActiveX2">
                                <option id="this_ann_status_active" value=1 hidden selected>Is Active?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn updateThis_Ann_Status modal_sb_button">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Edit/Update Announcement_Status END -->

@endsection

@section('scripts')

<script>
    // Populate Province
    $(document).on("change", "#Region_ID", function() {
        alert('test');
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

                var option1 =
                    " <option value='' selected>None</option>";
                $('#Province_ID').append(option1);

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
    $(document).on("change", " Province_ID", function() {
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

                var option1 =
                    " <option value='' selected>None</option>";
                $('#City_Municipality_ID').append(option1);

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
                    " <option value='' selected>None</option>";
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
</script>

@endsection