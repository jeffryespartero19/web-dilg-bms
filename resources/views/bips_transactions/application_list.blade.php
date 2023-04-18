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
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Resident_ID</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Name Suffix</th>
                                            <th>Actions</th>
                                        </tr>
                                        <tr>
                                            <td hidden></td>
                                            <td><input class="form-control searchFilter searchFilter1" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td><input class="form-control searchFilter searchFilter2" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td><input class="form-control searchFilter searchFilter3" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td><input class="form-control searchFilter searchFilter4" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody id="ListData">
                                        @include('bips_transactions.application_list_data')
                                    </tbody>
                                </table>
                                {!! $db_entries->links() !!}
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1">
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
                <h4 class="modal-title flexer justifier" id="Modal_Title">Applicant Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newInhabitant">@csrf
                <div class="modal-body">
                    <table class="table table-striped table-bordered" style="width:100%">
                        <tbody id="HHMembers">
                            <tr>
                                <td colspan="2" style="text-align: center; font-size:large">Details</td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Name: </strong></td>
                                <td><span id="Name"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Address: </strong></td>
                                <td><span id="Address"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Birthdate: </strong></td>
                                <td><span id="Birthdate"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Birthplace: </strong></td>
                                <td><span id="Birthplace"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Age: </strong></td>
                                <td><span id="Age"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Blood Type: </strong></td>
                                <td><span id="Blood_Type"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Sex: </strong></td>
                                <td><span id="Sex"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Weight: </strong></td>
                                <td><span id="Weight"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Height: </strong></td>
                                <td><span id="Height"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Civil Status: </strong></td>
                                <td><span id="Civil_Status"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Mobile Number: </strong></td>
                                <td><span id="Mobile_No"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Landline number: </strong></td>
                                <td><span id="Telephone_No"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Monthly Income: </strong></td>
                                <td><span id="Salary"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>PhilSys Card Number: </strong></td>
                                <td><span id="PhilSys_Card_No"></span></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center; font-size:large">Resident Information</td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Resident Status: </strong></td>
                                <td><span id="Resident_Status"></span></td>
                            </tr>

                            <tr>
                                <td style="width:30%"><strong>Voter Status: </strong></td>
                                <td><span id="Voter_Status"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Election Year Last Voted: </strong></td>
                                <td><span id="Election_Year_Last_Voted"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Resident Voter: </strong></td>
                                <td><span id="Resident_Voter"></span></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center; font-size:large">Additional Information</td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Solo Parent: </strong></td>
                                <td><span id="Solo_Parent"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>OFW: </strong></td>
                                <td><span id="OFW"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>Indigent: </strong></td>
                                <td><span id="Indigent"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>4Ps Beneficiary: </strong></td>
                                <td><span id="4Ps_Beneficiary"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>PhilHealth: </strong></td>
                                <td><span id="PhilHealth"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>GSIS: </strong></td>
                                <td><span id="GSIS"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>SSS: </strong></td>
                                <td><span id="SSS"></span></td>
                            </tr>
                            <tr>
                                <td style="width:30%"><strong>PagIbig: </strong></td>
                                <td><span id="PagIbig"></span></td>
                            </tr>

                        </tbody>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success approve_inhabitants btn-modal">Approve</button>
                    <button type="button" class="btn btn-danger btn-modal" data-toggle="modal" data-target="#disapproveApplication">Disapprove</button>
                    <!-- <button type="button" class="btn btn-danger disapprove_inhabitants btn-modal">Disapprove</button> -->
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
                    <button type="button" class="btn btn-success disapprove_inhabitants btn-modal">Submit</button>
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

    // View Info
    $(document).on('click', ('.view_info'), function(e) {

        var disID = $(this).val();
        // $('#Modal_Title').text('Edit Inhabitant Information');
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
                $('#Resident_ID').html(data['theEntry'][0]['Resident_ID']);
                $('#Name').html(data['theEntry'][0]['Last_Name'] + ', ' + data['theEntry'][0]['First_Name'] + ' ' + data['theEntry'][0]['Middle_Name'] + ' ' + data['theEntry'][0]['Name_Suffix']);

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

                $('#Address').html($HS + $SS + data['theEntry'][0]['Barangay_Name'] + ', ' + data['theEntry'][0]['City_Municipality_Name'] + ', ' + data['theEntry'][0]['Province_Name']);
                $('#Birthdate').html(data['theEntry'][0]['Birthdate']);
                $('#Age').html(data['theEntry'][0]['Age']);
                $('#Birthplace').html(data['theEntry'][0]['Birthplace']);
                $('#Religion').html(data['theEntry'][0]['Religion']);
                $('#Blood_Type').html(data['theEntry'][0]['Blood_Type']);

                if (data['theEntry'][0]['Sex'] == 1) {
                    $('#Sex').html('Male');
                } else {
                    $('#Sex').html('Female');
                }
                $('#Weight').html(data['theEntry'][0]['Weight'] + ' kg');
                $('#Height').html(data['theEntry'][0]['Height'] + ' meters');
                $('#Civil_Status').html(data['theEntry'][0]['Civil_Status']);
                $('#Mobile_No').html(data['theEntry'][0]['Mobile_No']);
                $('#Telephone_No').html(data['theEntry'][0]['Telephone_No']);
                $('#Salary').html(data['theEntry'][0]['Salary']);
                $('#Email_Address').html(data['theEntry'][0]['Email_Address']);
                $('#PhilSys_Card_No').html(data['theEntry'][0]['PhilSys_Card_No']);
                $('#Country_ID').html(data['theEntry'][0]['Country_ID']);
                $('#Region_ID').html(data['theEntry'][0]['Region_ID']);
                $('#Street').html(data['theEntry'][0]['Street']);
                $('#House_No').html(data['theEntry'][0]['House_No']);

                if (data['theEntry'][0]['Solo_Parent'] == 1) {
                    $('#Solo_Parent').html('Yes');
                } else {
                    $('#Solo_Parent').html('No');
                }
                if (data['theEntry'][0]['OFW'] == 1) {
                    $('#OFW').html('Yes');
                } else {
                    $('#OFW').html('No');
                }
                if (data['theEntry'][0]['Indigent'] == 1) {
                    $('#Indigent').html('Yes');
                } else {
                    $('#Indigent').html('No');
                }
                if (data['theEntry'][0]['4Ps_Beneficiary'] == 1) {
                    $('#4Ps_Beneficiary').html('Yes');
                } else {
                    $('#4Ps_Beneficiary').html('No');
                }

                if (data['theEntry'][0]['Resident_Status'] == 1) {
                    $('#Resident_Status').html('Yes');
                } else {
                    $('#Resident_Status').html('No');
                }
                if (data['theEntry'][0]['Voter_Status'] == 1) {
                    $('#Voter_Status').html('Yes');
                } else {
                    $('#Voter_Status').html('No');
                }
                if (data['theEntry'][0]['Resident_Voter'] == 1) {
                    $('#Resident_Voter').html('Yes');
                } else {
                    $('#Resident_Voter').html('No');
                }
                $('#Election_Year_Last_Voted').html(data['theEntry'][0]['Election_Year_Last_Voted']);
                $('#PhilHealth').html(data['theEntry'][0]['PhilHealth']);
                $('#GSIS').html(data['theEntry'][0]['GSIS']);
                $('#SSS').html(data['theEntry'][0]['SSS']);
                $('#PagIbig').html(data['theEntry'][0]['PagIbig']);


            }
        });
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.application_list').addClass('active');
        $('.inhabitants_menu').addClass('active');
        $('.inhabitants_main').addClass('menu-open');
    });

    $(".searchFilter").change(function() {
        SearchData();
    });

    function SearchData() {
        // alert('test');
        var param1 = $('.searchFilter1').val();
        var param2 = $('.searchFilter2').val();
        var param3 = $('.searchFilter3').val();
        var param4 = $('.searchFilter4').val();
        var page = $('#hidden_page').val();

        $.ajax({
            url: "/search_inhabitants_application_list_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4,
            success: function(data) {
                $('#ListData').html('');
                $('#ListData').html(data);
            }
        });
    }
</script>

<style>
    /* table {
        display: inline-block;
        overflow-x: scroll;
    } */
</style>

@endsection