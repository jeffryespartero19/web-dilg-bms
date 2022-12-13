@extends('layouts.default')

@section('content')
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Application List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Application List</li>
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
                    <div class="card-header" style="background-color:#e7ad52; color:white">
                        <h3 class="card-title">Pending</h3>
                    </div>
                    <div class="card-body">
                        <div class="tableX_row col-md-12 up_marg5">
                            <br>
                            <div class="flexer">
                                <div class="eighty_split">{{$db_entries->appends(['db_entries' => $db_entries->currentPage()])->links()}}</div>
                                <!-- <div class="twenty_split txtRight"><button data-toggle="modal" class="btn btn-success" data-target="#createInhabitants_Info" style="width: 100px;">New</button></div> -->
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Resident_ID</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Name Suffix</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr" hidden>{{$x->Resident_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Last_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->First_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Middle_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Name_Suffix}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <!-- <button class="approve_inhabitants btn btn-success" value="{{$x->Resident_ID}}">Approve</button>
                                                <button class="disapprove_inhabitants  btn btn-danger" value="{{$x->Resident_ID}}">Disapprove</button> -->
                                                <button class="edit_inhabitants" value="{{$x->Resident_ID}}" data-toggle="modal" data-target="#createInhabitants_Info">View</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>

                            <div hidden>
                                <form id="Approved_Inhabitant" method="POST" action="{{ route('approve_disapprove_application') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                                    <input type="number" class="form-control" id="Resident_ID" name="Resident_ID">
                                    <input type="number" class="form-control" id="Status_ID" name="Status_ID">
                                    <input type="text" class="form-control" id="disapprove_remarks" name="disapprove_remarks">
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

<div class="modal fade" id="createInhabitants_Info" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Create Inhabitant</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newInhabitant">@csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <h3>Name</h3>
                        <div class="row">

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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success approve_inhabitants btn-modal" value="{{$x->Resident_ID}}">Approve</button>
                    <button type="button" class="btn btn-danger btn-modal" value="{{$x->Resident_ID}}" data-toggle="modal" data-target="#disapproveApplication">Disapprove</button>
                    <!-- <button type="button" class="btn btn-danger disapprove_inhabitants btn-modal" value="{{$x->Resident_ID}}">Disapprove</button> -->
                    <button type="button" class="btn btn-default modal-close btn-modal" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="disapproveApplication" role="dialog" aria-labelledby="disapproveApplication" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Disapprove Remarks</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="disapproveRemarks">@csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <!-- <input type="text" class="form-control" id="remarks" name="remarks" required> -->
                                <textarea class="form-control" name="remarks" id="remarks" rows="5" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success disapprove_inhabitants btn-modal" value="{{$x->Resident_ID}}">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
        $('#example2').DataTable();
        $('#example3').DataTable();
    });

    // Disable Form if DILG USER
    $(document).ready(function() {
        $("#newInhabitant :input").prop("disabled", true);
        $("#newInhabitant .btn-modal").prop("disabled", false);
    });

    // Approve Inhabitants
    $(document).on('click', ('.approve_inhabitants'), function(e) {
        var disID = $(this).val();
        $('#Resident_ID').val(disID);
        $('#Status_ID').val(1);

        $('#Approved_Inhabitant').submit();

    });

    // Disapprove Inhabitants
    $(document).on('click', ('.disapprove_inhabitants'), function(e) {
        var disID = $(this).val();
        $('#Resident_ID').val(disID);
        $('#Status_ID').val(2);
        $('#disapprove_remarks').val($('#remarks').val());

        $('#Approved_Inhabitant').submit();
    });

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

    });

    // Side Bar Active
    $(document).ready(function() {
        $('.application_list').addClass('active');
        $('.inhabitants_menu').addClass('active');
        $('.inhabitants_main').addClass('menu-open');
    });
</script>

<style>
    /* table {
        display: inline-block;
        overflow-x: scroll;
    } */
</style>

@endsection