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
        <div class="twenty_split txtRight"><button data-toggle="modal" data-target="#createInhabitants_Info">New</button></div>
    </div>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
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
                    <td class="sm_data_col txtCtr"></td>
                    <td class="sm_data_col txtCtr"></td>
                    <td class="sm_data_col txtCtr"></td>
                    <td class="sm_data_col txtCtr"></td>
                    <td class="sm_data_col txtCtr"></td>
                    <td class="sm_data_col txtCtr"></td>
                    <td class="sm_data_col txtCtr"></td>
                    <td class="sm_data_col txtCtr">
                        <button class="edit_inhabitants" value="{{$x->Resident_ID}}" data-toggle="modal" data-target="#createInhabitants_Info">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Announcement_Status Modal -->
<div class="modal fade" id="createInhabitants_Info" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Create Inhabitant</h4>
            </div>
            <form id="newInhabitant" method="POST" action="{{ route('create_inhabitants_information') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body">
                    <h3>Name</h3>
                    <br>
                    <div class="row">
                        <input type="text" class="form-control" id="Resident_ID" name="Resident_ID" hidden>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Prefix</label>
                            <select class="form-control" id="Name_Prefix_ID" name="Name_Prefix_ID">
                                <option value='' disabled selected>Select Option</option>
                                @foreach($prefix as $bt)
                                <option value="{{ $bt->Name_Prefix_ID }}">{{ $bt->Name_Prefix }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" class="form-control" id="Last_Name" name="Last_Name" required>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="First_Name">First Name</label>
                            <input type="text" class="form-control" id="First_Name" name="First_Name" required>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="Middle_Name">Middle Name</label>
                            <input type="text" class="form-control" id="Middle_Name" name="Middle_Name" required>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="Name_Suffix_ID">Suffix</label>
                            <select class="form-control" id="Name_Suffix_ID" name="Name_Suffix_ID">
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
                            <input type="date" class="form-control" id="Birthdate" name="Birthdate" required>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Age</label>
                            <input type="number" class="form-control" id="Age" name="Age">
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="Birthplace">Birthplace</label>
                            <input type="text" class="form-control" id="Birthplace" name="Birthplace">
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
                            <select class="form-control" id="Sex" name="Sex" required>
                                <option value='' disabled selected>Select Option</option>
                                <option value='1'>Male</option>
                                <option value='2'>Female</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="Weight">Weight</label>
                            <input type="number" class="form-control" id="Weight" name="Weight" placeholder="kg">
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="Height">Height</label>
                            <input type="number" class="form-control" id="Height" name="Height" placeholder="cm">
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Civil Status</label>
                            <select class="form-control" id="Civil_Status_ID" name="Civil_Status_ID" required>
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
                            <input type="text" class="form-control" id="Salary" name="Salary">
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" id="Email_Address" name="Email_Address" required>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="PhilSys_Card_No">PhilSys_Card_No</label>
                            <input type="text" class="form-control" id="PhilSys_Card_No" name="PhilSys_Card_No">
                        </div>
                    </div>
                    <hr>
                    <h3>Address</h3>
                    <div class="row">
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Country</label>
                            <select class="form-control" id="Country_ID" name="Country_ID">
                                <option value='' disabled selected>Select Option</option>
                                @foreach($country as $countrys)
                                <option value="{{ $countrys->Country_ID }}">{{ $countrys->Country }}</option>
                                @endforeach
                            </select>
                        </div>
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
                            <label for="City_Municipality_ID">City/Municipality</label>
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
                    </div>
                    <hr>
                    <h3>Additional Information</h3>
                    <div class="row">
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Solo Parent</label>
                            <select class="form-control" id="Solo_Parent" name="Solo_Parent">
                                <option value='' disabled selected>Select Option</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">OFW</label>
                            <select class="form-control" id="OFW" name="OFW">
                                <option value='' disabled selected>Select Option</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">Indigent</label>
                            <select class="form-control" id="Indigent" name="Indigent">
                                <option value='' disabled selected>Select Option</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3" style="padding:0 10px">
                            <label for="exampleInputEmail1">4Ps Beneficiary</label>
                            <select class="form-control" id="4Ps_Beneficiary" name="4Ps_Beneficiary">
                                <option value='' disabled selected>Select Option</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                    </div>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn postThis_Inhabitant_Info modal_sb_button">Create</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Create Announcement_Status END -->

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
                    " <option value='' disabled selected>Select Option</option>";
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

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
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

    // Age Calculate
    // $(document).on("change", "#Birthdate", function() {
    //     var dob = $('#Birthdate').val();
    //     alert(dob);
    // });

    //post buttons
    $(document).on('click', '.postThis_Inhabitant_Info', function(e) {
        $('#newInhabitant').submit();
    });


    // Edit Button Display Modal
    $(document).on('click', ('.edit_inhabitants'), function(e) {

        var disID = $(this).val();
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
                $('#Prefix_ID').val(data['theEntry'][0]['Prefix_ID']);
                $('#Last_Name').val(data['theEntry'][0]['Last_Name']);
                $('#First_Name').val(data['theEntry'][0]['First_Name']);
                $('#Middle_Name').val(data['theEntry'][0]['Middle_Name']);
                $('#Birthdate').val(data['theEntry'][0]['Birthdate']);
                $('#Birthplace').val(data['theEntry'][0]['Birthplace']);
                $('#Religion_ID').val(data['theEntry'][0]['Religion_ID']);
                $('#Blood_Type_ID').val(data['theEntry'][0]['Blood_Type_ID']);
                $('#Sex').val(data['theEntry'][0]['Sex']);
                $('#Weight').val(data['theEntry'][0]['Weight']);
                $('#Height').val(data['theEntry'][0]['Height']);
                $('#Civil_Status_ID').val(data['theEntry'][0]['Civil_Status_ID']);
                $('#Mobile_No').val(data['theEntry'][0]['Mobile_No']);
                $('#Telephone_No').val(data['theEntry'][0]['Telephone_No']);
                $('#Salary').val(data['theEntry'][0]['Salary']);
                $('#Email_Address').val(data['theEntry'][0]['Email_Address']);
                $('#PhilSys_Card_No').val(data['theEntry'][0]['PhilSys_Card_No']);
                $('#Country_ID').val(data['theEntry'][0]['Country_ID']);
                $('#Region_ID').val(data['theEntry'][0]['Region_ID']);
                $('#Province_ID').val(data['theEntry'][0]['Province_ID']);
                $('#City_Municipality_ID').val(data['theEntry'][0]['City_Municipality_ID']);
                $('#Barangay_ID').val(data['theEntry'][0]['Barangay_ID']);
                $('#Solo_Parent').val(data['theEntry'][0]['Solo_Parent']);
                $('#OFW').val(data['theEntry'][0]['OFW']);
                $('#Indigent').val(data['theEntry'][0]['Indigent']);
                $('#4Ps_Beneficiary').val(data['theEntry'][0]['4Ps_Beneficiary']);
                if (data['theEntry'][0]['Active'] == 1) {
                    $('#this_ann_status_active').append('Yes');
                } else {
                    $('#this_ann_status_active').append('No');
                }

            }
        });


    });


    $('#createInhabitants_Info').on('hidden.bs.modal', function() {
        $(this).find('form').trigger('reset');
    });
</script>

<style>
    table {
        display: block;
        overflow-x: scroll;
    }
</style>

@endsection