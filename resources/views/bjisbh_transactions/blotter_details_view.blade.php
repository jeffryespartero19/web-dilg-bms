@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blotter Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('blotter_list')}}">Blotter List</a></li>
                        <li class="breadcrumb-item active">Blotter Details</li>
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
                            <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
                            <br>
                            <div class="col-md-12">
                                <form id="newBlotter" method="POST" action="{{ route('create_blotter') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input type="number" class="form-control" id="Blotter_ID" name="Blotter_ID" hidden value="{{$blotter[0]->Blotter_ID}}">
                                        <div class="row">
                                            <div class="form-group col-lg-12" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Blotter Number</label>
                                                <input type="text" class="form-control" id="Blotter_Number" name="Blotter_Number" required value="{{$blotter[0]->Blotter_Number}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Blotter Status</label>
                                                <br>
                                                <select id="Blotter_Status_ID" class="form-control" name="Blotter_Status_ID" style="width: 100%;">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($blotter_status as $bs)
                                                    <option value="{{ $bs->Blotter_Status_ID }}" {{ $bs->Blotter_Status_ID  == $blotter[0]->Blotter_Status_ID  ? "selected" : "" }}>{{ $bs->Blotter_Status_Name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Incident Date</label>
                                                <input type="datetime-local" class="form-control" id="Incident_Date_Time" name="Incident_Date_Time" required value="{{$blotter[0]->Incident_Date_Time}}">
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Region</label>
                                                <select class="form-control" id="Region_ID" name="Region_ID" required>
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($region as $region)
                                                    <option value="{{ $region->Region_ID }}" {{ $region->Region_ID  == $blotter[0]->Region_ID  ? "selected" : "" }}>{{ $region->Region_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Province</label>
                                                <select class="form-control" id="Province_ID" name="Province_ID" required>
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($province as $province)
                                                    <option value="{{ $province->Province_ID }}" {{ $province->Province_ID  == $blotter[0]->Province_ID  ? "selected" : "" }}>{{ $province->Province_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="City_Municipality_ID">City/Municipality</label>
                                                <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID" required>
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($city_municipality as $city)
                                                    <option value="{{ $city->City_Municipality_ID }}" {{ $city->City_Municipality_ID  == $blotter[0]->City_Municipality_ID  ? "selected" : "" }}>{{ $city->City_Municipality_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="Barangay_ID">Barangay</label>
                                                <select class="form-control" id="Barangay_ID" name="Barangay_ID" required>
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($barangay as $barangay)
                                                    <option value="{{ $barangay->Barangay_ID }}" {{ $barangay->Barangay_ID  == $blotter[0]->Barangay_ID  ? "selected" : "" }}>{{ $barangay->Barangay_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div> -->
                                        <div class="row">
                                            <div class="form-group col-lg-12" style="padding:0 10px" id="CaseDetails">
                                                <h3>Case Details</h3>
                                                <table id="CaseTBL" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th hidden>Resident_ID</th>
                                                            <th>Case List</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="CSBody">
                                                        @if($case_details->count() > 0)
                                                        @foreach ($case_details as $cd)
                                                        <tr class="CSDetails">
                                                            <td hidden></td>
                                                            <td>
                                                                <select class="form-control js-example-basic-single mySelect2" name="Case_ID[]" style="width: 100%;">
                                                                    <option value='' disabled selected>Select Option</option>
                                                                    @foreach($case as $cs)
                                                                    <option value="{{ $cs->Case_ID }}" {{ $cs->Case_ID == $cd->Case_ID  ? "selected" : "" }}>{{ $cs->Case_Name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr class="CSDetails">
                                                            <td hidden></td>
                                                            <td>
                                                                <select class="form-control js-example-basic-single mySelect2" name="Case_ID[]" style="width: 100%;">
                                                                    <option value='' disabled selected>Select Option</option>
                                                                    @foreach($case as $cs)
                                                                    <option value="{{ $cs->Case_ID }}">{{ $cs->Case_Name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr>
                                            <div class="form-group col-lg-12" style="padding:0 10px;">
                                                <h3>Involved Parties</h3>
                                                <br>
                                                <div style="overflow-x:auto;" id="HouseholdDetails">

                                                    <table id="ResidentTBL" class="table table-striped table-bordered table-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th hidden>Resident_ID</th>
                                                                <th>Name</th>
                                                                <th>Type</th>
                                                                <th>Resident Status</th>
                                                                <th>Address</th>
                                                                <th>Birthdate</th>
                                                                <th>Phone No.</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="HSBody">
                                                            @if($involved_details->count() > 0)
                                                            @foreach ($involved_details as $id)
                                                            <tr class="HRDetails">
                                                                <td hidden></td>
                                                                <td>
                                                                    <select class="form-control js-example-basic-single Resident_Select2 mySelect2" name="Resident_ID[]" style="width: 350px;">
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
                                                                    <select class="form-control Type_of_Involved_Party_ID" name="Type_of_Involved_Party_ID[]" style="width: 200px;">
                                                                        <option value='' disabled selected>Select Option</option>
                                                                        @foreach($involved_party as $ip)
                                                                        <option value="{{ $ip->Type_of_Involved_Party_ID  }}" {{ $ip->Type_of_Involved_Party_ID == $id->Type_of_Involved_Party_ID  ? "selected" : "" }}>{{ $ip->Type_of_Involved_Party }}</option>
                                                                        @endforeach
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
                                                                    <input type="text" class="form-control" style="width: 350px;" name="Non_Resident_Address[]" value="{{$id->Non_Resident_Address}}">
                                                                </td>
                                                                <td>
                                                                    <input type="date" class="form-control" style="width: 200px;" name="Non_Resident_Birthdate[]" value="{{$id->Non_Resident_Birthdate}}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" style="width: 200px;" name="Phone_No[]" value="{{$id->Phone_No}}">
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
                                                                    <select class="form-control Type_of_Involved_Party_ID" name="Type_of_Involved_Party_ID[]" style="width: 200px;">
                                                                        <option value='' disabled selected>Select Option</option>
                                                                        @foreach($involved_party as $ip)
                                                                        <option value="{{ $ip->Type_of_Involved_Party_ID  }}">{{ $ip->Type_of_Involved_Party }}</option>
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
                                                                    <input type="text" class="form-control" style="width: 350px;" name="Non_Resident_Address[]">
                                                                </td>
                                                                <td>
                                                                    <input type="date" class="form-control" style="width: 200px;" name="Non_Resident_Birthdate[]">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" style="width: 200px;" name="Phone_No[]">
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="form-group col-lg-12" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Complaint Details</label>
                                                <textarea class="form-control" id="Complaint_Details" name="Complaint_Details" rows="5">{{$blotter[0]->Complaint_Details}}</textarea>
                                            </div>
                                            <div class="form-group col-lg-12" style="padding:0 10px">
                                                <label for="fileattach">File Attachments</label>
                                                <ul class="list-group list-group-flush" id="ordinance_files">
                                                    @foreach($file_attachment as $fa)
                                                    <li class="list-group-item">{{$fa->File_Name}}<a href="../files/uploads/bjisbh_transaction/blotter_file_attachments/{{$fa->File_Name}}" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a></li>
                                                    @endforeach
                                                    <br>
                                                    <div class="input-group my-3">
                                                        <div class="custom-file">
                                                            <input type="file" name="fileattach[]" id="fileattach" multiple onchange="javascript:updateList()" />
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>

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



<!-- Create Announcement_Status END -->

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
        $("#newBlotter :input").prop("disabled", true);
    });

    //Select2
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $(".Resident_Select2").select2({
            tags: true
        });
    });


    // Option Case Remove
    $(".CSBody").on("click", ".CSRemove", function() {
        $(this).closest(".CSDetails").remove();
    });


    // Option Case Remove
    $(".HSBody").on("click", ".HRRemove", function() {
        $(this).closest(".HRDetails").remove();
    });


    // Disable Form if DILG USER
    $(document).ready(function() {
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 3) {
            $("#newBlotter :input").prop("disabled", true);
        }
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.Blotter').addClass('active');
        $('.justice_menu').addClass('active');
        $('.justice_main').addClass('menu-open');
    });
</script>

<style>
    .select2-selection {
        height: 32px !important;
        padding: 3px 3px;
        font: 13px;
    }
</style>

@endsection