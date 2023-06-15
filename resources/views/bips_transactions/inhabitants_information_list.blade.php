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
            @if (Auth::user()->User_Type_ID == 3 )
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
                                @if (Auth::user()->User_Type_ID == 1)
                                <div style="padding: 2px;"><a href="{{ url('inhabitants_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                                @endif
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Export</button></div>
                                <!-- <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div> -->
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12">
                                <div>
                                    <table class="example11 table table-striped table-bordered" style="table-layout:fixed;">
                                        <thead>
                                            <tr>
                                                <th style="width: 300px;">Name</th>
                                                <th style="width: 200px;">Birthdate</th>
                                                <th style="width: 200px;">Age</th>
                                                <th style="width: 200px;">Sex</th>
                                                <th style="width: 200px;">Civil Status</th>
                                                <th style="width: 200px;">Street</th>
                                                <th style="width: 200px;">Resident Status</th>
                                                <th style="width: 200px;">Voter</th>
                                                <th style="width: 200px;">Resident Voter</th>
                                                <th style="width: 200px;">Solo Parent</th>
                                                <th style="width: 200px;">Indigent</th>
                                                <th style="width: 200px;">4P's Beneficiary</th>
                                                <th style="width: 200px;">OFW</th>
                                                <th style="width: 200px;">Actions</th>
                                            </tr>
                                            <tr>
                                                <td><input class="form-control searchFilter searchFilter1" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter2" style="min-width: 200px;" type="date"></td>
                                                <td>
                                                    <input class="form-control searchFilter searchFilter3" style="min-width: 100px;" type="number" placeholder="From">
                                                    <input class="form-control searchFilter searchFilter31" style="min-width: 100px;" type="number" placeholder="To">
                                                </td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter4" style="min-width: 200px;">
                                                        <option value="" disabled selected>Select Option</option>
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter5" style="min-width: 200px;">
                                                        <option value="" disabled selected>Select Option</option>
                                                        @foreach($civil_status as $cs)
                                                        <option value="{{ $cs->Civil_Status_ID }}">{{ $cs->Civil_Status }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input class="form-control searchFilter searchFilter6" style="min-width: 200px;" type="text"></td>

                                                <td>
                                                    <select class="form-control searchFilter searchFilter7" style="min-width: 200px;">
                                                        <option value="" disabled selected>Select Option</option>
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>

                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter8" style="min-width: 200px;">
                                                        <option value="" disabled selected>Select Option</option>
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>

                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter9" style="min-width: 200px;">
                                                        <option value="" disabled selected>Select Option</option>
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>

                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter10" style="min-width: 200px;">
                                                        <option value="" disabled selected>Select Option</option>
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>

                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter11" style="min-width: 200px;">
                                                        <option value="" disabled selected>Select Option</option>
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>

                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter12" style="min-width: 200px;">
                                                        <option value="" disabled selected>Select Option</option>
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>

                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter13" style="min-width: 200px;">
                                                        <option value="" disabled selected>Select Option</option>
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>

                                                    </select>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody id="ListData">
                                            @include('bips_transactions.inhabitants_information_data')
                                        </tbody>
                                    </table>
                                    {!! $db_entries->links() !!}
                                    <input type="hidden" name="hidden_page" id="hidden_page" value="1">
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



<div class="modal fade" id="print_filter" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="print_report" method="GET" action="{{ route('inhabitants.export') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <input type="checkbox" id="SelectAll" name="SelectAll">
                                <label for="SelectAll">Select All</label><br>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <input type="checkbox" class="ChkBOX1" id="1chk_Name" name="chk_Name">
                                <label for="1chk_Name">Name</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Birthplace" name="chk_Birthplace">
                                <label for="1chk_Birthplace">Birthplace</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Birthdate" name="chk_Birthdate">
                                <label for="1chk_Birthdate">Birthdate</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Age" name="chk_Age">
                                <label for="1chk_Age">Age</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Sex" name="chk_Sex">
                                <label for="1chk_Sex">Sex</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Civil_Status" name="chk_Civil_Status">
                                <label for="1chk_Civil_Status">Civil Status</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Mobile" name="chk_Mobile">
                                <label for="1chk_Mobile">Mobile Number</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Landline" name="chk_Landline">
                                <label for="1chk_Landline">Landline Number</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_House_No" name="chk_House_No">
                                <label for="1chk_House_No">House Number</label><br>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <input type="checkbox" class="ChkBOX1" id="1chk_Street" name="chk_Street">
                                <label for="1chk_Street">Street</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Barangay" name="chk_Barangay">
                                <label for="1chk_Barangay">Barangay</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_City_Municipality" name="chk_City_Municipality">
                                <label for="1chk_City_Municipality">City/Municipality</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Province" name="chk_Province">
                                <label for="1chk_Province">Province</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Region" name="chk_Region">
                                <label for="1chk_Region">Region</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Religion" name="chk_Religion">
                                <label for="1chk_Religion">Religion</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Blood_Type" name="chk_Blood_Type">
                                <label for="1chk_Blood_Type">Blood Type</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Weight" name="chk_Weight">
                                <label for="1chk_Weight">Weight</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Height" name="chk_Height">
                                <label for="1chk_Height">Height</label><br>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <input type="checkbox" class="ChkBOX1" id="1chk_Email" name="chk_Email">
                                <label for="1chk_Email">Email</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Philsys_Number" name="chk_Philsys_Number">
                                <label for="1chk_Philsys_Number">Philsys_Number</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Resident_Status" name="chk_Resident_Status">
                                <label for="1chk_Resident_Status">Resident Status</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Voter" name="chk_Voter">
                                <label for="1chk_Voter">Voter</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Year_Last_Voted" name="chk_Year_Last_Voted">
                                <label for="1chk_Year_Last_Voted">Year Last Voted</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Resident_Voter" name="chk_Resident_Voter">
                                <label for="1chk_Resident_Voter">Resident Voter</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Solo_Parent" name="chk_Solo_Parent">
                                <label for="1chk_Solo_Parent">Solo Parent</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Indigent" name="chk_Indigent">
                                <label for="1chk_Indigent">Indigent</label><br>
                                <input type="checkbox" class="ChkBOX1" id="1chk_Beneficiary" name="chk_Beneficiary">
                                <label for="1chk_Beneficiary">4P's Beneficiary</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary postThis_Inhabitant_Info">Download</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="download_filter" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
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
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <input type="checkbox" id="chk_Name" name="chk_Name">
                                <label for="chk_Name">Name</label><br>
                                <input type="checkbox" id="chk_Birthplace" name="chk_Birthplace">
                                <label for="chk_Birthplace">Birthplace</label><br>
                                <input type="checkbox" id="chk_Birthdate" name="chk_Birthdate">
                                <label for="chk_Birthdate">Birthdate</label><br>
                                <input type="checkbox" id="chk_Age" name="chk_Age">
                                <label for="chk_Age">Age</label><br>
                                <input type="checkbox" id="chk_Sex" name="chk_Sex">
                                <label for="chk_Sex">Sex</label><br>
                                <input type="checkbox" id="chk_Civil_Status" name="chk_Civil_Status">
                                <label for="chk_Civil_Status">Civil Status</label><br>
                                <input type="checkbox" id="chk_Mobile" name="chk_Mobile">
                                <label for="chk_Mobile">Mobile Number</label><br>
                                <input type="checkbox" id="chk_Landline" name="chk_Landline">
                                <label for="chk_Landline">Landline Number</label><br>
                                <input type="checkbox" id="chk_House_No" name="chk_House_No">
                                <label for="chk_House_No">House Number</label><br>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <input type="checkbox" id="chk_Street" name="chk_Street">
                                <label for="chk_Street">Street</label><br>
                                <input type="checkbox" id="chk_Barangay" name="chk_Barangay">
                                <label for="chk_Barangay">Barangay</label><br>
                                <input type="checkbox" id="chk_City_Municipality" name="chk_City_Municipality">
                                <label for="chk_City_Municipality">City/Municipality</label><br>
                                <input type="checkbox" id="chk_Province" name="chk_Province">
                                <label for="chk_Province">Province</label><br>
                                <input type="checkbox" id="chk_Region" name="chk_Region">
                                <label for="chk_Region">Region</label><br>
                                <input type="checkbox" id="chk_Religion" name="chk_Religion">
                                <label for="chk_Religion">Religion</label><br>
                                <input type="checkbox" id="chk_Blood_Type" name="chk_Blood_Type">
                                <label for="chk_Blood_Type">Blood Type</label><br>
                                <input type="checkbox" id="chk_Weight" name="chk_Weight">
                                <label for="chk_Weight">Weight</label><br>
                                <input type="checkbox" id="chk_Height" name="chk_Height">
                                <label for="chk_Height">Height</label><br>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <input type="checkbox" id="chk_Email" name="chk_Email">
                                <label for="chk_Email">Email</label><br>
                                <input type="checkbox" id="chk_Philsys_Number" name="chk_Philsys_Number">
                                <label for="chk_Philsys_Number">Philsys_Number</label><br>
                                <input type="checkbox" id="chk_Resident_Status" name="chk_Resident_Status">
                                <label for="chk_Resident_Status">Resident Status</label><br>
                                <input type="checkbox" id="chk_Voter" name="chk_Voter">
                                <label for="chk_Voter">Voter</label><br>
                                <input type="checkbox" id="chk_Year_Last_Voted" name="chk_Year_Last_Voted">
                                <label for="chk_Year_Last_Voted">Year Last Voted</label><br>
                                <input type="checkbox" id="chk_Resident_Voter" name="chk_Resident_Voter">
                                <label for="chk_Resident_Voter">Resident Voter</label><br>
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


<div class="modal fade" id="ViewInfo" tabindex="-1" role="dialog" aria-labelledby="ViewInfo" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="VName">Ordinance Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- <h4 id="VName"> </h4> -->

                <table class="table table-striped table-bordered" style="width:100%">
                    <tr>
                        <td colspan="2" style="text-align: center; font-size:large">Details</td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Address: </strong></td>
                        <td><span id="VAddress"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Birthdate: </strong></td>
                        <td><span id="VBirthdate"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Birthplace: </strong></td>
                        <td><span id="VBirthplace"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Religion: </strong></td>
                        <td><span id="VReligion"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Blood Type: </strong></td>
                        <td><span id="VBloodType"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Sex: </strong></td>
                        <td><span id="VSex"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Weight: </strong></td>
                        <td><span id="VWeight"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Height: </strong></td>
                        <td><span id="VHeight"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Civil Status: </strong></td>
                        <td><span id="VCivilStatus"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Mobile Number: </strong></td>
                        <td><span id="VMobile_No"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Landline Number: </strong></td>
                        <td><span id="VLandline"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Monthly Income: </strong></td>
                        <td><span id="VSalary"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Email: </strong></td>
                        <td><span id="VEmail_Address"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>PhilSys Card Number: </strong></td>
                        <td><span id="VPhilSys_Card_No"></span></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center; font-size:large">Resident Information</td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Resident Status: </strong></td>
                        <td><span id="VResident_Status"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Voter Status: </strong></td>
                        <td><span id="VVoter_Status"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Election Year Last Voted: </strong></td>
                        <td><span id="VElection_Year_Last_Voted"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Resident Voter: </strong></td>
                        <td><span id="VResident_Voter"></span></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center; font-size:large">Additional Information</td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Solo Parent: </strong></td>
                        <td><span id="VSolo_Parent"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>OFW: </strong></td>
                        <td><span id="VOFW"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Indigent: </strong></td>
                        <td><span id="VIndigent"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>4Ps Beneficiary: </strong></td>
                        <td><span id="V4Ps_Beneficiary"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>PhilHealth: </strong></td>
                        <td><span id="VPhilHealth"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>GSIS: </strong></td>
                        <td><span id="VGSIS"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>SSS: </strong></td>
                        <td><span id="VSSS"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>PagIbig: </strong></td>
                        <td><span id="VPagIbig"></span></td>
                    </tr>
                    <tr>
                        <td style="width:30%"><strong>Tin No: </strong></td>
                        <td><span id="VTin"></span></td>
                    </tr>
                </table>
                <table class="table table-striped table-bordered" style="width:100%; margin-bottom:0px">
                    <tr>
                        <td style="text-align: center; font-size:large">Educational Information</td>
                    </tr>
                </table>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered EducList example11" style="width:100%">
                        <tr>
                            <th>Academic Level</th>
                            <th>School Name</th>
                            <th>Year Start</th>
                            <th>Year End</th>
                            <th>Course</th>
                            <th>Year Graduated</th>
                        </tr>
                    </table>
                </div>
                <table class="table table-striped table-bordered" style="width:100%; margin-bottom:0px">
                    <tr>
                        <td style="text-align: center; font-size:large">Employment Information</td>
                    </tr>
                </table>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered EmpList example11" style="width:100%">
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
                        </tr>
                    </table>
                </div>


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
        $('#example').DataTable({
            autoWidth: false
        });
    });

    $(document).on('click', '.create_new', function() {
        $('#Modal_Title').text('Create Inhabitant');
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


    // Disable Form if DILG USER
    $(document).ready(function() {
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 3) {
            $("#newInhabitant :input").prop("disabled", true);
        }
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.inhabitants').addClass('active');
        $('.inhabitants_menu').addClass('active');
        $('.inhabitants_main').addClass('menu-open');
    });


    // View Details
    $(document).on('click', ('.view_inhabitants'), function(e) {

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
                $('#VName').html(data['theEntry'][0]['Last_Name'] + ', ' + data['theEntry'][0]['First_Name'] + ' ' + data['theEntry'][0]['Middle_Name']);
                if (data['theEntry'][0]['House_No'] != null && data['theEntry'][0]['House_No'] != "") {
                    $HS = data['theEntry'][0]['House_No'] + ' ';
                } else {
                    $HS = ' ';
                }

                if (data['theEntry'][0]['Street'] != null && data['theEntry'][0]['Street'] != "") {
                    $SS = data['theEntry'][0]['Street'] + ', ';
                } else {
                    $SS = ' ';
                }
                $('#VAddress').html($HS + $SS + data['theEntry'][0]['Barangay_Name'] + ', ' + data['theEntry'][0]['City_Municipality_Name'] + ', ' + data['theEntry'][0]['Province_Name']);
                $('#VBirthdate').html(data['theEntry'][0]['Birthdate']);
                $('#VBirthplace').html(data['theEntry'][0]['Birthplace']);
                $('#VAge').html(data['theEntry'][0]['Religion_ID']);
                $('#VCivilStatus').html(data['theEntry'][0]['Civil_Status']);
                $('#VMobile').html(data['theEntry'][0]['Height']);
                $('#VLandline').html(data['theEntry'][0]['Telephone_No']);
                $('#VMobile_No').text(data['theEntry'][0]['Mobile_No']);
                $('#VTelephone_No').text(data['theEntry'][0]['Telephone_No']);
                $('#VSalary').text(data['theEntry'][0]['Salary']);
                $('#VEmail_Address').text(data['theEntry'][0]['Email_Address']);
                $('#VPhilSys_Card_No').text(data['theEntry'][0]['PhilSys_Card_No']);
                $('#VCountry_ID').text(data['theEntry'][0]['Country_ID']);
                $('#VRegion_ID').text(data['theEntry'][0]['Region_ID']);
                $('#VStreet').text(data['theEntry'][0]['Street']);
                $('#VHouse_No').text(data['theEntry'][0]['House_No']);
                $('#VReligion').text(data['theEntry'][0]['Religion']);
                $('#VBloodType').text(data['theEntry'][0]['Blood_Type']);
                if (data['theEntry'][0]['Sex'] == 1) {
                    $('#VSex').text('Male');
                } else {
                    $('#VSex').text('Female');
                }
                $('#VWeight').text(data['theEntry'][0]['Weight']);
                $('#VHeight').text(data['theEntry'][0]['Height']);

                if (data['theEntry'][0]['Solo_Parent'] == 1) {
                    $('#VSolo_Parent').html('Yes');
                } else {
                    $('#VSolo_Parent').html('No');
                }
                if (data['theEntry'][0]['OFW'] == 1) {
                    $('#VOFW').html('Yes');
                } else {
                    $('#VOFW').html('No');
                }
                if (data['theEntry'][0]['Indigent'] == 1) {
                    $('#VIndigent').html('Yes');
                } else {
                    $('#VIndigent').html('No');
                }
                if (data['theEntry'][0]['4Ps_Beneficiary'] == 1) {
                    $('#V4Ps_Beneficiary').html('Yes');
                } else {
                    $('#V4Ps_Beneficiary').html('No');
                }

                if (data['theEntry'][0]['Resident_Status'] == 1) {
                    $('#VResident_Status').html('Yes');
                } else {
                    $('#VResident_Status').html('No');
                }
                if (data['theEntry'][0]['Voter_Status'] == 1) {
                    $('#VVoter_Status').html('Yes');
                } else {
                    $('#VVoter_Status').html('No');
                }
                if (data['theEntry'][0]['Resident_Voter'] == 1) {
                    $('#VResident_Voter').html('Yes');
                } else {
                    $('#VResident_Voter').html('No');
                }
                $('#VElection_Year_Last_Voted').html(data['theEntry'][0]['Election_Year_Last_Voted']);
                $('#VPhilHealth').html(data['theEntry'][0]['PhilHealth']);
                $('#VGSIS').html(data['theEntry'][0]['GSIS']);
                $('#VSSS').html(data['theEntry'][0]['SSS']);
                $('#VPagIbig').html(data['theEntry'][0]['PagIbig']);
                $('#VTin').html(data['theEntry'][0]['Tin_No']);
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
                // $('#EducList').empty();
                data.forEach(element => {
                    var option = '<tr class="EducData">' +
                        '<td style="min-width: 200px;">' + element['Academic_Level'] + '</td>' +
                        '<td style="min-width: 200px;">' + element['School_Name'] + '</td>' +
                        '<td style="min-width: 200px;">' + element['School_Year_Start'] + '</td>' +
                        '<td style="min-width: 200px;">' + element['School_Year_End'] + '</td>' +
                        '<td style="min-width: 200px;">' + element['Course'] + '</td>' +
                        '<td>' + element['Year_Graduated'] + '</td>' +
                        '</tr>';
                    $('.EducList').append(option);
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
                    var option = '<tr class="EmpData">' +
                        '<td style="min-width: 200px;">' + element['Employment_Type'] + '</td>' +
                        '<td style="min-width: 200px;">' + element['Company_Name'] + '</td>' +
                        '<td style="min-width: 200px;">' + element['Employer_Name'] + '</td>' +
                        '<td style="min-width: 200px;">' + element['Employer_Address'] + '</td>' +
                        '<td style="min-width: 200px;">' + element['Position'] + '</td>' +
                        '<td style="min-width: 200px;">' + element['Start_Date'] + '</td>' +
                        '<td style="min-width: 200px;">' + element['End_Date'] + '</td>' +
                        '<td style="min-width: 200px;">' + element['Monthly_Salary'] + '</td>' +
                        '<td style="min-width: 200px;">' + element['Brief_Description'] + '</td>' +
                        '</tr>';
                    $('.EmpList').append(option);
                });
            }
        });


    });

    // Delete Inhabitants
    $(document).on('click', ('.delete_inhabitants'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this inhabitant?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_inhabitants",
                    type: 'GET',
                    data: {
                        id: disID
                    },
                    fail: function() {
                        alert('request failed');
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Deleted',
                            text: "Record has been deleted.",
                            icon: 'success',
                            showConfirmButton: false,
                        });
                        location.reload();
                    }
                });

            }
        });
    });

    $(document).on('click', '#SelectAll', function(e) {
        $('.ChkBOX1').prop('checked', this.checked);
    });



    $(".searchFilter").change(function() {
        SearchData2();
    });

    function SearchData2() {
        // alert('test');
        var param1 = $('.searchFilter1').val();
        var param2 = $('.searchFilter2').val();
        var param3 = $('.searchFilter3').val();
        var param31 = $('.searchFilter31').val();
        var param4 = $('.searchFilter4').val();
        var param5 = $('.searchFilter5').val();
        var param6 = $('.searchFilter6').val();
        var param7 = $('.searchFilter7').val();
        var param8 = $('.searchFilter8').val();
        var param9 = $('.searchFilter9').val();
        var param10 = $('.searchFilter10').val();
        var param11 = $('.searchFilter11').val();
        var param12 = $('.searchFilter12').val();
        var param13 = $('.searchFilter13').val();
        var page = $('#hidden_page').val();

        $.ajax({
            url: "/search_inhabitants_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4 + "&param5=" + param5 + "&param6=" + param6 + "&param7=" + param7 + "&param8=" + param8 + "&param9=" + param9 + "&param10=" + param10 + "&param11=" + param11 + "&param12=" + param12 + "&param13=" + param13 + "&param31=" + param31,
            success: function(data) {
                $('#ListData').html('');
                $('#ListData').html(data);
            }
        });
    }

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
    .example11 {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    
</style>
@endsection