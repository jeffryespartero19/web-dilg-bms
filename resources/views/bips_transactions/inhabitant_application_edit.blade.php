@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inhabitants Information List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Inhabitants Information List</li>
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
@if ($db_entries[0]->Application_Status == 2)
<div class="alert alert-danger">
    <ul>
        <li>Your Application was disapproved</li>
        <li>Remarks: {{$db_entries[0]->status_remarks}}</li>
    </ul>
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
                                <form id="newInhabitant" method="POST" action="{{ route('update_inhabitants_application_info') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                                    <div class="modal-body">
                                        <h3>Name</h3>
                                        <div class="row">
                                            <input type="text" class="form-control" id="Resident_ID" name="Resident_ID" @if($db_entries[0]->Resident_ID != null) value="{{$db_entries[0]->Resident_ID}}" @else value="applicant" @endif hidden>
                                            <input type="text" class="form-control" id="Application_Status" name="Application_Status" @if($db_entries[0]->Application_Status != 0) value="{{$db_entries[0]->Resident_ID}}" @else value="0" @endif hidden>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Prefix</label>
                                                <select class="form-control" id="Name_Prefix_ID" name="Name_Prefix_ID" required disabled>
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($name_prefix as $bt)
                                                    <option value="{{ $bt->Name_Prefix_ID }}" {{ $bt->Name_Prefix_ID  == $db_entries[0]->Name_Prefix_ID  ? "selected" : "" }}>{{ $bt->Name_Prefix }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Last Name</label>
                                                <input type="text" class="form-control" id="Last_Name" name="Last_Name" required value="{{$db_entries[0]->Last_Name}}" disabled>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="First_Name">First Name</label>
                                                <input type="text" class="form-control" id="First_Name" name="First_Name" required value="{{$db_entries[0]->First_Name}}" disabled>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Middle_Name">Middle Name</label>
                                                <input type="text" class="form-control" id="Middle_Name" name="Middle_Name" required value="{{$db_entries[0]->Middle_Name}}" disabled>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Name_Suffix_ID">Suffix</label>
                                                <select class="form-control" id="Name_Suffix_ID" name="Name_Suffix_ID" disabled>
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($suffix as $bt)
                                                    <option value="{{ $bt->Name_Suffix_ID }}" {{ $bt->Name_Suffix_ID  == $db_entries[0]->Name_Suffix_ID  ? "selected" : "" }}>{{ $bt->Name_Suffix }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>Address</h3>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Country</label>
                                                <select class="form-control" id="Country_ID" name="Country_ID" required disabled>
                                                    <option value='' selected>Select Option</option>
                                                    @foreach($country as $countrys)
                                                    <option value="{{ $countrys->Country_ID }}" {{ $countrys->Country_ID  == $db_entries[0]->Country_ID  ? "selected" : "" }}>{{ $countrys->Country }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Region</label>
                                                <select class="form-control" id="Region_ID" name="Region_ID" required disabled>
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($region as $region)
                                                    <option value="{{ $region->Region_ID }}" {{ $region->Region_ID  == $db_entries[0]->Region_ID  ? "selected" : "" }}>{{ $region->Region_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Province</label>
                                                <select class="form-control" id="Province_ID" name="Province_ID" required disabled>
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($province as $province)
                                                    <option value="{{ $province->Province_ID }}" {{ $province->Province_ID  == $db_entries[0]->Province_ID  ? "selected" : "" }}>{{ $province->Province_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="City_Municipality_ID">City/Municipality</label>
                                                <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID" required disabled>
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($city as $city)
                                                    <option value="{{ $city->City_Municipality_ID }}" {{ $city->City_Municipality_ID  == $db_entries[0]->City_Municipality_ID  ? "selected" : "" }}>{{ $city->City_Municipality_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="text" class="form-control" id="Barangay_ID2" name="Barangay_ID2" value="{{$db_entries[0]->Barangay_ID}}" hidden>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Barangay_ID">Barangay</label>
                                                <select class="form-control" id="Barangay_ID" name="Barangay_ID" required disabled>
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($barangay as $barangay)
                                                    <option value="{{ $barangay->Barangay_ID }}" {{ $barangay->Barangay_ID  == $db_entries[0]->Barangay_ID  ? "selected" : "" }}>{{ $barangay->Barangay_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>Personal Information</h3>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Birthdate</label>
                                                <input type="date" class="form-control" id="Birthdate" name="Birthdate" required value="{{$db_entries[0]->Birthdate}}" disabled>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Age</label>
                                                <input type="number" class="form-control" id="Age" name="Age" disabled>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Birthplace">Birthplace</label>
                                                <input type="text" class="form-control" id="Birthplace" name="Birthplace" value="{{$db_entries[0]->Birthplace}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Religion_ID">Religion</label>
                                                <select class="form-control" id="Religion_ID" name="Religion_ID" required>
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($religion as $religions)
                                                    <option value="{{ $religions->Religion_ID }}" {{ $religions->Religion_ID  == $db_entries[0]->Religion_ID  ? "selected" : "" }}>{{ $religions->Religion }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Blood Type</label>
                                                <select class="form-control" id="Blood_Type_ID" name="Blood_Type_ID" required disabled>
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($blood_type as $bt)
                                                    <option value="{{ $bt->Blood_Type_ID }}" {{ $bt->Blood_Type_ID  == $db_entries[0]->Blood_Type_ID  ? "selected" : "" }}>{{ $bt->Blood_Type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Sex</label>
                                                <select class="form-control" id="Sex" name="Sex" required disabled>
                                                    <option value='' disabled selected>Select Option</option>
                                                    <option value='1' {{ 1  == $db_entries[0]->Sex  ? "selected" : "" }}>Male</option>
                                                    <option value='2' {{ 2  == $db_entries[0]->Sex  ? "selected" : "" }}>Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Weight">Weight</label>
                                                <input type="number" class="form-control" id="Weight" name="Weight" placeholder="kg" value="{{$db_entries[0]->Weight}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Height">Height</label>
                                                <input type="number" class="form-control" id="Height" name="Height" placeholder="cm" value="{{$db_entries[0]->Height}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Civil Status</label>
                                                <select class="form-control" id="Civil_Status_ID" name="Civil_Status_ID" required>
                                                    <option value='0' selected>Select Option</option>
                                                    @foreach($civil_status as $cs)
                                                    <option value="{{ $cs->Civil_Status_ID }}" {{ $cs->Civil_Status_ID  == $db_entries[0]->Civil_Status_ID  ? "selected" : "" }}>{{ $cs->Civil_Status }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Mobile No</label>
                                                <input type="text" class="form-control" id="Mobile_No" name="Mobile_No" value="{{$db_entries[0]->Mobile_No}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Landline Number</label>
                                                <input type="text" class="form-control" id="Telephone_No" name="Telephone_No" value="{{$db_entries[0]->Telephone_No}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Salary">Monthly Income</label>
                                                <input type="text" class="form-control" id="Salary" name="Salary" value="{{$db_entries[0]->Salary}}">
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Email">Email</label>
                                                <input type="email" class="form-control" id="Email_Address" name="Email_Address" required value="{{$db_entries[0]->Email_Address}}" disabled>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="PhilSys_Card_No">PhilSys Card Number</label>
                                                <input type="text" class="form-control" id="PhilSys_Card_No" name="PhilSys_Card_No" value="{{$db_entries[0]->PhilSys_Card_No}}">
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>Additional Information</h3>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Solo Parent</label>
                                                <select class="form-control" id="Solo_Parent" name="Solo_Parent" required disabled>
                                                    <option value='' disabled selected>Select Option</option>
                                                    <option value=1 {{ 1  == $db_entries[0]->Solo_Parent ? "selected" : "" }}>Yes</option>
                                                    <option value=0 {{ 0  == $db_entries[0]->Solo_Parent ? "selected" : "" }}>No</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">OFW</label>
                                                <select class="form-control" id="OFW" name="OFW" required disabled>
                                                    <option value='' disabled selected>Select Option</option>
                                                    <option value=1 {{ 1  == $db_entries[0]->OFW ? "selected" : "" }}>Yes</option>
                                                    <option value=0 {{ 0  == $db_entries[0]->OFW ? "selected" : "" }}>No</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Indigent</label>
                                                <select class="form-control" id="Indigent" name="Indigent" required disabled>
                                                    <option value='' disabled selected>Select Option</option>
                                                    <option value=1 {{ 1  == $db_entries[0]->Indigent ? "selected" : "" }}>Yes</option>
                                                    <option value=0 {{ 0  == $db_entries[0]->Indigent ? "selected" : "" }}>No</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="exampleInputEmail1">4Ps Beneficiary</label>
                                                <select class="form-control" id="4Ps_Beneficiary" name="4Ps_Beneficiary" required disabled>
                                                    <option value='' disabled selected>Select Option</option>
                                                    <option value=1 {{ 1  == $db_entries[0]->Beneficiary ? "selected" : "" }}>Yes</option>
                                                    <option value=0 {{ 0  == $db_entries[0]->Beneficiary ? "selected" : "" }}>No</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="PhilHealth">PhilHealth</label>
                                                <input type="text" class="form-control" id="PhilHealth" name="PhilHealth" value="{{$db_entries[0]->PhilHealth}}" disabled>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="GSIS">GSIS</label>
                                                <input type="text" class="form-control" id="GSIS" name="GSIS" value="{{$db_entries[0]->GSIS}}" disabled>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="SSS">SSS</label>
                                                <input type="text" class="form-control" id="SSS" name="SSS" value="{{$db_entries[0]->SSS}}" disabled>
                                            </div>
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="PagIbig">PagIbig</label>
                                                <input type="text" class="form-control" id="PagIbig" name="PagIbig" value="{{$db_entries[0]->PagIbig}}" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-12" style="padding:0 10px">
                                                <label for="fileattach">File Attachments</label>
                                                <ul class="list-group list-group-flush" id="inhabitants_files">

                                                </ul>
                                                <div class="custom-file">
                                                    <input type="file" accept="image/*" class="custom-file-input" id="fileattach" name="fileattach[]" >
                                                    <label class="custom-file-label btn btn-info" for="fileattach">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <hr>
                <h3>Educational Information</h3>
                <button type="button" class="btn btn-info" style="width: 100px;" id="btnAddEduc">Add</button>
                <div class="tableX_row row up_marg5">
                    <div class="col-md-12">
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
                    <div class="col-md-12">
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
                                        <input type="number" class="form-control" name="Monthly_Salary[]" style="width: 200px;">
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
                </div> -->
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary postThis_Inhabitant_Info" style="width: 200px;">Update</button>
                                    </div>
                                </form>
                                <br>
                                <br>
                                <br>

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
    // Disable Form if DILG USER
    // $(document).ready(function() {
    //     $("#newInhabitant :input").prop("disabled", true);
    // });

    // Populate Province
        // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var files = Array.from(this.files)
        var fileName = files.map(f => {
            return f.name
        }).join(", ")
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
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
        $('#newInhabitant').trigger("reset");
        $('#Barangay_ID').empty();
        $('#City_Municipality_ID').empty();
        $('#Province_ID').empty();
        var option1 = "<option value='' disabled selected>Select Option</option>";
        $('#Barangay_ID').append(option1);
        $('#City_Municipality_ID').append(option1);
        $('#Province_ID').append(option1);
        $('#Modal_Title').text('Create Inhabitant');

        // Reset Education Table
        $('#EducTBLD').empty();
        var option = '<tr>' +
            '<td class="sm_data_col txtCtr">' +
            '<select class="form-control" name="Academic_Level_ID[]" style="width: 200px;">' +
            '<option value="" disabled selected>Select Option</option>' +
            '@foreach($academic_level as $al)' +
            '<option value="{{ $al->Academic_Level_ID  }}">{{ $al->Academic_Level }}</option>' +
            '@endforeach' +
            '</select>' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="text" class="form-control" name="School_Name[]" style="width: 250px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="date" class="form-control" name="School_Year_Start[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="date" class="form-control" name="School_Year_End[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="text" class="form-control" name="Course[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="date" class="form-control" name="Year_Graduated[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<button class="removeRow btn btn-danger">Remove</button>' +
            '</td>' +
            '</tr>';
        $('#EducTBLD').append(option);

        // Reset Employment Table
        $('#EmpTBLD').empty();
        var option_emp = '<tr>' +
            '<tr>' +
            '<td class="sm_data_col txtCtr">' +
            '<select class="form-control" name="Employment_Type_ID[]" style="width: 200px;">' +
            '<option value="" disabled selected>Select Option</option>' +
            '@foreach($employment_type as $et)' +
            '<option value="{{ $et->Employment_Type_ID }}">{{ $et->Employment_Type }}</option>' +
            '@endforeach' +
            '</select>' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="text" class="form-control" name="Company_Name[]" style="width: 250px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="text" class="form-control" name="Employer_Name[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="text" class="form-control" name="Employer_Address[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="text" class="form-control" name="Position[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="date" class="form-control" name="Start_Date[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="date" class="form-control" name="End_Date[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="number" class="form-control" name="Monthly_Salary[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<input type="text" class="form-control" name="Brief_Description[]" style="width: 200px;">' +
            '</td>' +
            '<td class="sm_data_col txtCtr">' +
            '<button class="removeRow btn btn-danger">Remove</button>' +
            '</td>' +
            '</tr>';
        $('#EmpTBLD').append(option_emp);
    });

    //post buttons
    // $(document).on('click', '.postThis_Inhabitant_Info', function(e) {
    //     $('#newInhabitant').submit();
    // });


    // Edit Button Display Modal
    $(document).on('click', ('.edit_inhabitants'), function(e) {

        var disID = $(this).val();
        $('#Modal_Title').text('Edit Inhabitant Information');
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
                $('#Resident_ID').val(data['theEntry'][0]['Resident_ID']);
                $('#Name_Prefix_ID').val(data['theEntry'][0]['Name_Prefix_ID']);
                $('#Last_Name').val(data['theEntry'][0]['Last_Name']);
                $('#First_Name').val(data['theEntry'][0]['First_Name']);
                $('#Middle_Name').val(data['theEntry'][0]['Middle_Name']);
                $('#Name_Suffix_ID').val(data['theEntry'][0]['Name_Suffix_ID']);
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
                $('#Street').val(data['theEntry'][0]['Street']);
                $('#House_No').val(data['theEntry'][0]['House_No']);

                var barangay =
                    " <option value='" + data['theEntry'][0]['Barangay_ID'] + "' selected>" + data['theEntry'][0]['Barangay_Name'] + "</option>";
                $('#Barangay_ID').append(barangay);

                var city =
                    " <option value='" + data['theEntry'][0]['City_Municipality_ID'] + "' selected>" + data['theEntry'][0]['City_Municipality_Name'] + "</option>";
                $('#City_Municipality_ID').append(city);

                var province =
                    " <option value='" + data['theEntry'][0]['Province_ID'] + "' selected>" + data['theEntry'][0]['Province_Name'] + "</option>";
                $('#Province_ID').append(province);
                $('#Solo_Parent').val(data['theEntry'][0]['Solo_Parent']);
                $('#OFW').val(data['theEntry'][0]['OFW']);
                $('#Indigent').val(data['theEntry'][0]['Indigent']);
                $('#4Ps_Beneficiary').val(data['theEntry'][0]['4Ps_Beneficiary']);
                $('#Resident_Status').val(data['theEntry'][0]['Resident_Status']);
                $('#Voter_Status').val(data['theEntry'][0]['Voter_Status']);
                $('#Resident_Voter').val(data['theEntry'][0]['Resident_Voter']);
                $('#Election_Year_Last_Voted').val(data['theEntry'][0]['Election_Year_Last_Voted']);
                $('#PhilHealth').val(data['theEntry'][0]['PhilHealth']);
                $('#GSIS').val(data['theEntry'][0]['GSIS']);
                $('#SSS').val(data['theEntry'][0]['SSS']);
                $('#PagIbig').val(data['theEntry'][0]['PagIbig']);
            }
        });

        $.ajax({
            url: "/get_inhabitants_edu_info",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#EducTBLD').empty();
                data.forEach(element => {
                    var option = '<tr>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<select class="form-control" name="Academic_Level_ID[]" style="width: 200px;">' +
                        '@foreach($academic_level as $al)' +
                        '<option value="{{ $al->Academic_Level_ID  }}" {{ $al->Academic_Level_ID == "' + element['Academic_Level_ID'] + '" ? "selected" : "" }}>{{ $al->Academic_Level }}</option>' +
                        '@endforeach' +
                        '</select>' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="text" class="form-control" name="School_Name[]" style="width: 250px;"  value="' + element['School_Name'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="date" class="form-control" name="School_Year_Start[]" style="width: 200px;"  value="' + element['School_Year_Start'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="date" class="form-control" name="School_Year_End[]" style="width: 200px;"  value="' + element['School_Year_End'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="text" class="form-control" name="Course[]" style="width: 200px;"  value="' + element['Course'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="date" class="form-control" name="Year_Graduated[]" style="width: 200px;"  value="' + element['Year_Graduated'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<button class="removeRow btn btn-danger">Remove</button>' +
                        '</td>' +
                        '</tr>';
                    $('#EducTBLD').append(option);
                });
            }
        });

        $.ajax({
            url: "/get_inhabitants_epm_info",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#EmpTBLD').empty();
                data.forEach(element => {
                    var option_emp = '<tr>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<select class="form-control" name="Employment_Type_ID[]" style="width: 200px;">' +
                        '@foreach($employment_type as $et)' +
                        '<option value="{{ $et->Employment_Type_ID }}" {{ $et->Employment_Type_ID == "' + element['Employment_Type_ID'] + '" ? "selected" : "" }}>{{ $et->Employment_Type }}</option>' +
                        '@endforeach' +
                        '</select>' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="text" class="form-control" name="Company_Name[]" style="width: 250px;" value="' + element['Company_Name'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="text" class="form-control" name="Employer_Name[]" style="width: 200px;" value="' + element['Employer_Name'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="text" class="form-control" name="Employer_Address[]" style="width: 200px;" value="' + element['Employer_Address'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="text" class="form-control" name="Position[]" style="width: 200px;" value="' + element['Position'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="date" class="form-control" name="Start_Date[]" style="width: 200px;" value="' + element['Start_Date'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="date" class="form-control" name="End_Date[]" style="width: 200px;" value="' + element['End_Date'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="number" class="form-control" name="Monthly_Salary[]" style="width: 200px;" value="' + element['Monthly_Salary'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<input type="text" class="form-control" name="Brief_Description[]" style="width: 200px;" value="' + element['Brief_Description'] + '">' +
                        '</td>' +
                        '<td class="sm_data_col txtCtr">' +
                        '<button class="removeRow btn btn-danger">Remove</button>' +
                        '</td>' +
                        '</tr>';
                    $('#EmpTBLD').append(option_emp);
                });
            }
        });


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


        var disID = $('#Resident_ID').val();
        var User_Type_ID = $('#User_Type_ID').val();
        $.ajax({
            url: "/get_inhabitants_voting_status_proof_attachments",
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
                        var file = '<li class="list-group-item">' + $i + '. ' + element['File_Name'] + ' (' + (element['File_Size'] / 1000000).toFixed(2) + ' MB)<a href="/files/uploads/inhabitants_voting_status_proof/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a>|<button type="button" class="btn res_del" value="' + element['Attachment_ID'] + '" style="color: red; margin-left:2px;">Delete</button></li>';
                        $('#inhabitants_files').append(file);

                    });
                } else {
                    data.forEach(element => {
                        $i = $i + 1;
                        var file = '<li class="list-group-item">' + $i + '. ' + element['File_Name'] + ' (' + (element['File_Size'] / 1000000).toFixed(2) + ' MB)<a href="/files/uploads/inhabitants_voting_status_proof/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a>|<button type="button" class="btn res_del" value="' + element['Attachment_ID'] + '" style="color: red; margin-left:2px;">Delete</button></li>';
                        $('#inhabitants_files').append(file);
                    });
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
                    url: "/delete_inhabitants_voting_status_proof_attachments",
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
</script>

<style>
    table {
        display: inline-block;
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