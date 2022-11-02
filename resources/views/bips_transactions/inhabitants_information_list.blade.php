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
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="text-align: right;">
                            <div class="btn-group">
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-success" data-target="#createInhabitants_Info" style="width: 100px;">New</button></div>
                                <!-- <div class="txtRight" style="margin-left: 5px;"><a href="{{ url('view_Ordinance') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div> -->
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Print</button></div>
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div>
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12">
                                <div>
                                    <table id="example" class="table table-striped table-bordered" style="table-layout:fixed;">
                                        <thead>
                                            <tr>
                                                <th style="width: 300px;">Name</th>
                                                <th style="width: 200px;">Birthplace</th>
                                                <th style="width: 200px;">Birthdate</th>
                                                <th style="width: 200px;">Age</th>
                                                <th style="width: 200px;">Street</th>
                                                <th style="width: 200px;">Civil Status</th>
                                                <th style="width: 200px;">Mobile Number</th>
                                                <th style="width: 200px;">Landline Number</th>
                                                <th style="width: 200px;">Solo Parent</th>
                                                <th style="width: 200px;">Indigent</th>
                                                <th style="width: 200px;">4P's Beneficiary</th>
                                                <th style="width: 200px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($db_entries as $x)
                                            <tr>
                                                <td class="sm_data_col txtCtr">{{$x->Last_Name}}, {{$x->First_Name}} {{$x->Middle_Name}} {{$x->Name_Suffix}}</td>
                                                <td class="sm_data_col txtCtr">{{$x->Birthplace}}</td>
                                                <td class="sm_data_col txtCtr">{{$x->Birthdate}}</td>
                                                <td class="sm_data_col txtCtr">
                                                    <?php
                                                    $age = date_diff(date_create($x->Birthdate), date_create('now'))->y;
                                                    echo $age;
                                                    ?>
                                                </td>
                                                <td class="sm_data_col txtCtr">{{$x->Street}}</td>
                                                <td class="sm_data_col txtCtr">{{$x->Civil_Status}}</td>
                                                <td class="sm_data_col txtCtr">{{$x->Mobile_No}}</td>
                                                <td class="sm_data_col txtCtr">{{$x->Telephone_No}}</td>
                                                <td class="sm_data_col txtCtr">@if ($x->Solo_Parent==1) Yes @else No @endif</td>
                                                <td class="sm_data_col txtCtr">@if ($x->Indigent==1) Yes @else No @endif</td>
                                                <td class="sm_data_col txtCtr">@if ($x->Beneficiary==1) Yes @else No @endif</td>
                                                <td class="sm_data_col txtCtr">
                                                    <button class="edit_inhabitants" value="{{$x->Resident_ID}}" data-toggle="modal" data-target="#createInhabitants_Info">Edit</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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


<!-- Create Ihabitant Modal -->

<div class="modal fade" id="createInhabitants_Info" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Create Inhabitant</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newInhabitant" method="POST" action="{{ route('create_inhabitants_information') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <h3>Name</h3>
                        <div class="row">
                            <input type="text" class="form-control" id="Resident_ID" name="Resident_ID" value="0" hidden>
                            <input type="text" class="form-control" id="Application_Status" name="Application_Status" value="1" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Prefix</label>
                                <select class="form-control" id="Name_Prefix_ID" name="Name_Prefix_ID">
                                    <option value='' selected>Select Option</option>
                                    @foreach($name_prefix as $bt)
                                    <option value="{{ $bt->Name_Prefix_ID }}">{{ $bt->Name_Prefix }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" class="form-control" id="Last_Name" name="Last_Name" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="First_Name">First Name</label>
                                <input type="text" class="form-control" id="First_Name" name="First_Name" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Middle_Name">Middle Name</label>
                                <input type="text" class="form-control" id="Middle_Name" name="Middle_Name" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
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
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Country</label>
                                <select class="form-control" id="Country_ID" name="Country_ID" required>
                                    <option value='' selected>Select Option</option>
                                    @foreach($country as $countrys)
                                    <option value="{{ $countrys->Country_ID }}">{{ $countrys->Country }}</option>
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
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Street">Street</label>
                                <input type="text" class="form-control" id="Street" name="Street" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="House_No">House Number</label>
                                <input type="text" class="form-control" id="House_No" name="House_No">
                            </div>
                        </div>
                        <hr>
                        <h3>Personal Information</h3>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Birthdate</label>
                                <input type="date" class="form-control" id="Birthdate" name="Birthdate" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Age</label>
                                <input type="number" class="form-control" id="Age" name="Age">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Birthplace">Birthplace</label>
                                <input type="text" class="form-control" id="Birthplace" name="Birthplace">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Religion_ID">Religion</label>
                                <select class="form-control" id="Religion_ID" name="Religion_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($religion as $religions)
                                    <option value="{{ $religions->Religion_ID }}">{{ $religions->Religion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Blood Type</label>
                                <select class="form-control" id="Blood_Type_ID" name="Blood_Type_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($blood_type as $bt)
                                    <option value="{{ $bt->Blood_Type_ID }}">{{ $bt->Blood_Type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Sex</label>
                                <select class="form-control" id="Sex" name="Sex" required>
                                    <option value='' disabled selected>Select Option</option>
                                    <option value='1'>Male</option>
                                    <option value='2'>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Weight">Weight</label>
                                <input type="number" class="form-control" id="Weight" name="Weight" placeholder="kilo">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Height">Height</label>
                                <input type="number" class="form-control" id="Height" name="Height" placeholder="meter">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Civil Status</label>
                                <select class="form-control" id="Civil_Status_ID" name="Civil_Status_ID" required>
                                    <option value='0' selected>Select Option</option>
                                    @foreach($civil_status as $cs)
                                    <option value="{{ $cs->Civil_Status_ID }}">{{ $cs->Civil_Status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Mobile Number</label>
                                <input type="text" class="form-control" id="Mobile_No" name="Mobile_No">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Landline Number</label>
                                <input type="text" class="form-control" id="Telephone_No" name="Telephone_No">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Salary">Monthly Income</label>
                                <input type="text" class="form-control" id="Salary" name="Salary">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Email">Email</label>
                                <input type="email" class="form-control" id="Email_Address" name="Email_Address" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="PhilSys_Card_No">PhilSys Card Number</label>
                                <input type="text" class="form-control" id="PhilSys_Card_No" name="PhilSys_Card_No">
                            </div>
                        </div>
                        <hr>
                        <h3>Resident Information</h3>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Resident_Status">Resident Status</label>
                                <select class="form-control" id="Resident_Status" name="Resident_Status">
                                    <option value='' selected>Select Option</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Voter_Status">Voter Status</label>
                                <select class="form-control" id="Voter_Status" name="Voter_Status">
                                    <option value='' selected>Select Option</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Election_Year_Last_Voted">Election Year Last Voted</label>
                                <input type="date" class="form-control" id="Election_Year_Last_Voted" name="Election_Year_Last_Voted">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
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
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Solo Parent</label>
                                <select class="form-control" id="Solo_Parent" name="Solo_Parent">
                                    <option value='' selected>Select Option</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">OFW</label>
                                <select class="form-control" id="OFW" name="OFW">
                                    <option value='' selected>Select Option</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Indigent</label>
                                <select class="form-control" id="Indigent" name="Indigent">
                                    <option value='' selected>Select Option</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">4Ps Beneficiary</label>
                                <select class="form-control" id="4Ps_Beneficiary" name="4Ps_Beneficiary">
                                    <option value='' selected>Select Option</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="PhilHealth">PhilHealth</label>
                                <input type="text" class="form-control" id="PhilHealth" name="PhilHealth">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="GSIS">GSIS</label>
                                <input type="text" class="form-control" id="GSIS" name="GSIS">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="SSS">SSS</label>
                                <input type="text" class="form-control" id="SSS" name="SSS">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="PagIbig">PagIbig</label>
                                <input type="text" class="form-control" id="PagIbig" name="PagIbig">
                            </div>
                        </div>
                        <hr>
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
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary postThis_Inhabitant_Info">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>


<div class="modal fade" id="print_filter" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="print_report" method="POST" action="{{ route('view_Inhabitants') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <input type="checkbox" id="1chk_Name" name="chk_Name">
                                <label for="1chk_Name">Name</label><br>
                                <input type="checkbox" id="1chk_Birthplace" name="chk_Birthplace">
                                <label for="1chk_Birthplace">Birthplace</label><br>
                                <input type="checkbox" id="1chk_Birthdate" name="chk_Birthdate">
                                <label for="1chk_Birthdate">Birthdate</label><br>
                                <input type="checkbox" id="1chk_Age" name="chk_Age">
                                <label for="1chk_Age">Age</label><br>
                                <input type="checkbox" id="1chk_Street" name="chk_Street">
                                <label for="1chk_Street">Street</label><br>
                                <input type="checkbox" id="1chk_Civil_Status" name="chk_Civil_Status">
                                <label for="1chk_Civil_Status">Civil Status</label><br>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <input type="checkbox" id="1chk_Mobile" name="chk_Mobile">
                                <label for="1chk_Mobile">Mobile Number</label><br>
                                <input type="checkbox" id="1chk_Landline" name="chk_Landline">
                                <label for="1chk_Landline">Landline Number</label><br>
                                <input type="checkbox" id="1chk_Resident_Status" name="chk_Resident_Status">
                                <label for="1chk_Resident_Status">Resident Status</label><br>
                                <input type="checkbox" id="1chk_Solo_Parent" name="chk_Solo_Parent">
                                <label for="1chk_Solo_Parent">Solo Parent</label><br>
                                <input type="checkbox" id="1chk_Indigent" name="chk_Indigent">
                                <label for="1chk_Indigent">Indigent</label><br>
                                <input type="checkbox" id="1chk_Beneficiary" name="chk_Beneficiary">
                                <label for="1chk_Beneficiary">4P's Beneficiary</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary postThis_Inhabitant_Info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="download_filter" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="download_report" method="POST" action="{{ route('download_Inhabitants') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <input type="checkbox" id="chk_Name" name="chk_Name">
                                <label for="chk_Name">Name</label><br>
                                <input type="checkbox" id="chk_Birthplace" name="chk_Birthplace">
                                <label for="chk_Birthplace">Birthplace</label><br>
                                <input type="checkbox" id="chk_Birthdate" name="chk_Birthdate">
                                <label for="chk_Birthdate">Birthdate</label><br>
                                <input type="checkbox" id="chk_Age" name="chk_Age">
                                <label for="chk_Age">Age</label><br>
                                <input type="checkbox" id="chk_Street" name="chk_Street">
                                <label for="chk_Street">Street</label><br>
                                <input type="checkbox" id="chk_Civil_Status" name="chk_Civil_Status">
                                <label for="chk_Civil_Status">Civil Status</label><br>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <input type="checkbox" id="chk_Mobile" name="chk_Mobile">
                                <label for="chk_Mobile">Mobile Number</label><br>
                                <input type="checkbox" id="chk_Landline" name="chk_Landline">
                                <label for="chk_Landline">Landline Number</label><br>
                                <input type="checkbox" id="chk_Resident_Status" name="chk_Resident_Status">
                                <label for="chk_Resident_Status">Resident Status</label><br>
                                <input type="checkbox" id="chk_Solo_Parent" name="chk_Solo_Parent">
                                <label for="chk_Solo_Parent">Solo Parent</label><br>
                                <input type="checkbox" id="chk_Indigent" name="chk_Indigent">
                                <label for="chk_Indigent">Indigent</label><br>
                                <input type="checkbox" id="chk_Beneficiary" name="chk_Beneficiary">
                                <label for="chk_Beneficiary">4P's Beneficiary</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary postThis_Inhabitant_Info">Submit</button>
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
        $('#example').DataTable({
            autoWidth: false
        });
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

    $(document).on("change", "#CM_ID", function() {

        var City_Municipality_ID = '01';

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
            url: "/get_inhabitant_list/" + Barangay_ID,
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

                    var dob = element["Birthdate"];
                    if (dob != '') {
                        var str = dob.split('-');
                        var firstdate = new Date(str[0], str[1], str[2]);
                        var today = new Date();
                        var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);
                        var age = parseInt(dayDiff);
                    }

                    $Solo_Parent = element["Solo_Parent"];
                    if ($Solo_Parent == 1) {
                        $Solo_Parent = 'Yes';
                    } else {
                        $Solo_Parent = 'No';
                    }

                    $Indigent = element["Indigent"];
                    if ($Indigent == 1) {
                        $Indigent = 'Yes';
                    } else {
                        $Indigent = 'No';
                    }

                    $Beneficiary = element["Beneficiary"];
                    if ($Beneficiary == 1) {
                        $Beneficiary = 'Yes';
                    } else {
                        $Beneficiary = 'No';
                    }


                    $('#example').DataTable().row.add([
                        element["Last_Name"] + ', ' + element["First_Name"] + ' ' + element["Middle_Name"] + ' ' + element["Name_Suffix"],
                        element["Birthplace"],
                        element["Birthdate"],
                        age,
                        element["Street"],
                        element["Civil_Status"],
                        element["Mobile_No"],
                        element["Telephone_No"],
                        $Solo_Parent,
                        $Indigent,
                        $Beneficiary,
                        "<button class='edit_inhabitants' value='" + element["Resident_ID"] + "' data-toggle='modal' data-target='#createInhabitants_Info'>Edit</button>",
                    ]).draw();

                });
            }
        });
    });
</script>

<style>
    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
</style>
@endsection