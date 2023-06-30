@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Inhabitants </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('inhabitants_information_list')}}">Inhabitants Information List</a></li>
                        <li class="breadcrumb-item active">Inhabitants Information</li>
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
                                <form id="newInhabitant" method="POST" action="{{ route('create_inhabitants_information') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <h3>Name</h3>
                                        <input type="text" class="form-control" id="Resident_ID" name="Resident_ID" value="0" hidden>
                                        <input type="text" class="form-control" id="Application_Status" name="Application_Status" value="1" hidden>
                                        <div class="row">
                                            <div class="form-group col-lg-1.5" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Prefix</label>
                                                <select class="form-control" id="Name_Prefix_ID" name="Name_Prefix_ID">
                                                    <option value='' selected>Select Option</option>
                                                    @foreach($name_prefix as $bt)
                                                    <option value="{{ $bt->Name_Prefix_ID }}">{{ $bt->Name_Prefix }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="exampleInputEmail1">Last Name</label>
                                                <input type="text" class="form-control" id="Last_Name" name="Last_Name" required>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="First_Name">First Name</label>
                                                <input type="text" class="form-control" id="First_Name" name="First_Name" required>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="Middle_Name">Middle Name</label>
                                                <input type="text" class="form-control" id="Middle_Name" name="Middle_Name" required>
                                            </div>
                                            <div class="form-group col-lg-1.5" style="padding:0 10px">
                                                <label for="Name_Suffix_ID">Suffix</label>
                                                <select class="form-control" id="Name_Suffix_ID" name="Name_Suffix_ID">
                                                    <option value='' selected>Select Option</option>
                                                    @foreach($suffix as $bt)
                                                    <option value="{{ $bt->Name_Suffix_ID }}">{{ $bt->Name_Suffix }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>Address</h3>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="exampleInputEmail1">Country</label>
                                                <select class="form-control" id="Country_ID" name="Country_ID" required disabled>
                                                    <!-- <option value='' selected>Select Option</option> -->
                                                    @foreach($country as $countrys)
                                                    <option value="{{ $countrys->Country_ID }}" selected>{{ $countrys->Country }}</option >
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="exampleInputEmail1">Region</label>
                                                <select class="form-control" id="Region_ID" name="Region_ID" required disabled>
                                                    @foreach($region as $region)
                                                    <option value="{{ $region->Region_ID }}" selected>{{ $region->Region_Name }}</option >
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="exampleInputEmail1">Province</label>
                                                <select class="form-control" id="Province_ID" name="Province_ID" required disabled>
                                                    @foreach($province as $province)
                                                    <option value="{{ $province->Province_ID }}" selected>{{ $province->Province_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="City_Municipality_ID">City/Municipality</label>
                                                <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID" required disabled>
                                                    @foreach($city as $city)
                                                    <option value="{{ $city->City_Municipality_ID }}" selected>{{ $city->City_Municipality_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="Barangay_ID">Barangay</label>
                                                <select class="form-control" id="Barangay_ID" name="Barangay_ID" required disabled>
                                                    @foreach($barangay as $barangay)
                                                    <option value="{{ $barangay->Barangay_ID }}" selected>{{ $barangay->Barangay_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="Street">Street</label>
                                                <input type="text" class="form-control" id="Street" name="Street" required>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="House_No">House Number</label>
                                                <input type="text" class="form-control" id="House_No" name="House_No">
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>Personal Information</h3>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="exampleInputEmail1">Birthdate</label>
                                                <input type="date" class="form-control  " id="Birthdate" name="Birthdate" required>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Age</label>
                                                <input type="number" class="form-control" id="Age" name="Age" readonly>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Birthplace">Birthplace</label>
                                                <input type="text" class="form-control" id="Birthplace" name="Birthplace">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="Religion_ID">Religion</label>
                                                <select class="form-control  " id="Religion_ID" name="Religion_ID" required>
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($religion as $religions)
                                                    <option value="{{ $religions->Religion_ID }}">{{ $religions->Religion }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="exampleInputEmail1">Blood Type</label>
                                                <select class="form-control  " id="Blood_Type_ID" name="Blood_Type_ID" required>
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($blood_type as $bt)
                                                    <option value="{{ $bt->Blood_Type_ID }}">{{ $bt->Blood_Type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="exampleInputEmail1">Sex</label>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="Sex" value="1" name="Sex" required>
                                                    <label for="Sex" class="custom-control-label">Male</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="Sex2" value="2" name="Sex" required>
                                                    <label for="Sex2" class="custom-control-label">Female</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Weight">Weight</label>
                                                <input type="number" step="any" class="form-control" id="Weight" name="Weight" placeholder="kilo">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Height">Height</label>
                                                <input type="number" step="any" class="form-control" id="Height" name="Height" placeholder="meter">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="exampleInputEmail1">Civil Status</label>
                                                <select class="form-control  " id="Civil_Status_ID" name="Civil_Status_ID" required>
                                                    <option value='0' selected>Select Option</option>
                                                    @foreach($civil_status as $cs)
                                                    <option value="{{ $cs->Civil_Status_ID }}">{{ $cs->Civil_Status }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Mobile Number</label>
                                                <input type="number" class="form-control" id="Mobile_No" name="Mobile_No" type="number" onKeyDown="if(this.value.length>=11 && event.keyCode!=8) return false;">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Landline Number</label>
                                                <input type="text" class="form-control" id="Telephone_No" name="Telephone_No">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Salary">Monthly Income</label>
                                                <!-- <input type="text" step="any" class="form-control" id="Salary" name="Salary"> -->
                                                <input type="text"  onkeypress="validate(event)" class="form-control fancyformat">
                                                <input type="number" step="0.01" class="form-control fancyformat" id="Salary" name="Salary" hidden>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="Email">Email</label>
                                                <input type="email" class="form-control  " id="Email_Address" name="Email_Address" required>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="PhilSys_Card_No">PhilSys Card Number</label>
                                                <input type="text" class="form-control" id="PhilSys_Card_No" name="PhilSys_Card_No" maxlength="16" required>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>Resident Information</h3>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Resident_Status">Resident Status</label>
                                                <select class="form-control" id="Resident_Status" name="Resident_Status">
                                                    <option value='' selected>Select Option</option>
                                                    <option value=1>Yes</option>
                                                    <option value=0>No</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Voter_Status">Voter Status</label>
                                                <select class="form-control" id="Voter_Status" name="Voter_Status">
                                                    <option value='' selected>Select Option</option>
                                                    <option value=1>Yes</option>
                                                    <option value=0>No</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Election_Year_Last_Voted">Election Year Last Voted</label>
                                                <input type="date" class="form-control" id="Election_Year_Last_Voted" name="Election_Year_Last_Voted">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Resident_Voter">Resident Voter</label>
                                                <select class="form-control" id="Resident_Voter" name="Resident_Voter">
                                                    <option value='' selected>Select Option</option>
                                                    <option value=1>Yes</option>
                                                    <option value=0>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>Additional Information</h3>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Solo Parent</label>
                                                <select class="form-control" id="Solo_Parent" name="Solo_Parent">
                                                    <option value='' selected>Select Option</option>
                                                    <option value=1>Yes</option>
                                                    <option value=0>No</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">OFW</label>
                                                <select class="form-control" id="OFW" name="OFW">
                                                    <option value='' selected>Select Option</option>
                                                    <option value=1>Yes</option>
                                                    <option value=0>No</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Indigent</label>
                                                <select class="form-control" id="Indigent" name="Indigent">
                                                    <option value='' selected>Select Option</option>
                                                    <option value=1>Yes</option>
                                                    <option value=0>No</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">4Ps Beneficiary</label>
                                                <select class="form-control" id="4Ps_Beneficiary" name="4Ps_Beneficiary">
                                                    <option value='' selected>Select Option</option>
                                                    <option value=1>Yes</option>
                                                    <option value=0>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="PhilHealth">PhilHealth</label>
                                                <input type="text" class="form-control" id="PhilHealth" name="PhilHealth">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="GSIS">GSIS</label>
                                                <input type="text" class="form-control" id="GSIS" name="GSIS" maxlength="11" required>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="SSS">SSS</label>
                                                <input type="text" class="form-control" id="SSS" name="SSS">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="PagIbig">PagIbig</label>
                                                <input type="text" class="form-control" id="PagIbig" name="PagIbig" maxlength="12" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label class="required" for="Tin">Tin No.</label>
                                                <input type="text" class="form-control" id="Tin" name="Tin" maxlength="12" required>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>Educational Information</h3>
                                        <button type="button" class="btn btn-info" style="width: 100px;" id="btnAddEduc">Add</button>
                                        <div class="tableX_row row up_marg5">
                                            <div class="col-md-12 table-responsive">
                                                <table id="Education" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Academic Level</th>
                                                            <th>School Name</th>
                                                            <th>Year Start</th>
                                                            <th>Year End</th>
                                                            <th>Course</th>
                                                            <th>Year Graduated</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="EducTBLD">
                                                        <tr>
                                                            <td class="sm_data_col txtCtr">
                                                                <select class="form-control" name="Academic_Level_ID[]" style="width: 200px;">
                                                                    <option value='' disabled selected>Select Option</option>
                                                                    @foreach($academic_level as $al)
                                                                    <option value="{{ $al->Academic_Level_ID  }}">{{ $al->Academic_Level }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td class="sm_data_col txtCtr">
                                                                <input type="text" class="form-control" name="School_Name[]" style="width: 250px;">
                                                            </td>
                                                            <td class="sm_data_col txtCtr">
                                                                <input type="date" class="form-control" name="School_Year_Start[]" style="width: 200px;">
                                                            </td>
                                                            <td class="sm_data_col txtCtr">
                                                                <input type="date" class="form-control" name="School_Year_End[]" style="width: 200px;">
                                                            </td>
                                                            <td class="sm_data_col txtCtr">
                                                                <input type="text" class="form-control" name="Course[]" style="width: 200px;">
                                                            </td>
                                                            <td class="sm_data_col txtCtr" s>
                                                                <input type="date" class="form-control" name="Year_Graduated[]" style="width: 200px;">
                                                            </td>
                                                            <td class="sm_data_col txtCtr">
                                                                <button class="removeRow btn btn-danger">Remove</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>Employment History</h3>
                                        <button type="button" class="btn btn-info" style="width: 100px;" id="btnAddEmployment">Add</button>
                                        <div class="tableX_row row up_marg5">
                                            <div class="col-md-12 table-responsive">
                                                <table id="Employment" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Employment Type</th>
                                                            <th>Company Name</th>
                                                            <th>Employer Name</th>
                                                            <th>Employer Address</th>
                                                            <th>Position</th>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>
                                                            <th>Monthly Salary</th>
                                                            <th>Brief Description</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="EmpTBLD">
                                                        <tr>
                                                            <td class="sm_data_col txtCtr">
                                                                <select class="form-control" name="Employment_Type_ID[]" style="width: 200px;">
                                                                    <option value='' disabled selected>Select Option</option>
                                                                    @foreach($employment_type as $et)
                                                                    <option value="{{ $et->Employment_Type_ID }}">{{ $et->Employment_Type }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td class="sm_data_col txtCtr">
                                                                <input type="text" class="form-control" name="Company_Name[]" style="width: 250px;">
                                                            </td>
                                                            <td class="sm_data_col txtCtr">
                                                                <input type="text" class="form-control" name="Employer_Name[]" style="width: 200px;">
                                                            </td>
                                                            <td class="sm_data_col txtCtr">
                                                                <input type="text" class="form-control" name="Employer_Address[]" style="width: 200px;">
                                                            </td>
                                                            <td class="sm_data_col txtCtr">
                                                                <input type="text" class="form-control" name="Position[]" style="width: 200px;">
                                                            </td>
                                                            <td class="sm_data_col txtCtr" s>
                                                                <input type="date" class="form-control" name="Start_Date[]" style="width: 200px;">
                                                            </td>
                                                            <td class="sm_data_col txtCtr" s>
                                                                <input type="date" class="form-control" name="End_Date[]" style="width: 200px;">
                                                            </td>
                                                            <td class="sm_data_col txtCtr" s>
                                                                <input type="number" class="form-control" step="any" name="Monthly_Salary[]" style="width: 200px;">
                                                            </td>
                                                            <td class="sm_data_col txtCtr" s>
                                                                <input type="text" class="form-control" name="Brief_Description[]" style="width: 200px;">
                                                            </td>
                                                            <td class="sm_data_col txtCtr">
                                                                <button class="removeRow btn btn-danger">Remove</button>
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
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();

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

     // Side Bar Active
     $(document).ready(function() {
        $('.inhabitants').addClass('active');
        $('.inhabitants_menu').addClass('active');
        $('.inhabitants_main').addClass('menu-open');
    });

    //Birth Date On change Event
    $(document).ready(function() {
        $('#Birthdate').on('change', function() {

            // alert('test');

            if (new Date($(this).val()) > new Date()) {
                alert('Invalid Birthdate')
            } else {
                var today = new Date();
                var birthDate = new Date($(this).val());
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                if (age < 0) {
                    alert('Please select Invalid Birthdate')
                } else {
                    $('#Age').val(age);
                }
            }

        });
    });

     // Clone Education TR
     $("#btnAddEduc").on("click", function() {

        var $tableBody = $('#Education').find("tbody"),
            $trLast = $tableBody.find("tr:last"),
            $trNew = $trLast.clone().find("input, select").val("").removeAttr('selected').end();

        $trLast.after($trNew);
    });

    // Remove Education TR
    $("#Education").on("click", ".removeRow", function() {
        $(this).closest("tr").remove();
    });

    // Clone Employment TR
    $("#btnAddEmployment").on("click", function() {

        var $tableBody = $('#Employment').find("tbody"),
            $trLast = $tableBody.find("tr:last"),
            $trNew = $trLast.clone();

        $trLast.after($trNew);
    });

    // Remove Employment TR
    $("#Employment").on("click", ".removeRow", function() {
        $(this).closest("tr").remove();
    });


    $(document).on("focusout",'.fancyformat', function(e) {
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