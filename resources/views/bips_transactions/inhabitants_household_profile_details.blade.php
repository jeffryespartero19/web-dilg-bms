@extends('layouts.default')

@section('content')

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inhabitants Household Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('inhabitants_household_profile')}}">Inhabitants Household List</a></li>
                        <li class="breadcrumb-item active">Inhabitants Household Details</li>
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

                            <br>
                            <div class="col-md-12">
                                <form id="newHousehold" method="POST" action="{{ route('create_household_information') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <h3>Household Information</h3>
                                    <br>
                                    <div class="row">
                                        <input type="number" class="form-control" id="Household_Profile_ID" name="Household_Profile_ID" hidden>
                                        <div class="form-group col-lg-6" style="padding:0 10px">
                                            <label class="required" for="Household_Name">Household Name</label>
                                            <input type="text" class="form-control" id="Household_Name" name="Household_Name" required>
                                        </div>
                                        <div class="form-group col-lg-6" style="padding:0 10px">
                                            <label class="required" for="Family_Type_ID">Family Type</label>
                                            <select class="form-control" id="Family_Type_ID" name="Family_Type_ID" required>
                                                <option value='' disabled selected>Select Option</option>
                                                @foreach($family_type as $fm)
                                                <option value="{{ $fm->Family_Type_ID }}">{{ $fm->Family_Type_Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-12 table-responsive" style="padding:0 10px" id="HouseholdDetails">
                                            <a onclick="addrow();" style="float: right; cursor:pointer" class="btn btn-default">+ Add</a>
                                            <table id="ResidentTBL" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th hidden>Resident_ID</th>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Head</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="HSBody">
                                                    <tr class="HRDetails">
                                                        <td hidden></td>
                                                        <td style="width: 30%;">
                                                            <select class="form-control myselect select2 Resident_Info" name="Resident_ID[]">
                                                            </select>
                                                        </td>
                                                        <td style="width: 30%;">
                                                            <select class="form-control Family_Position_ID" name="Family_Position_ID[]">
                                                                <option value='' disabled selected>Select Option</option>
                                                                @foreach($family_position as $fp)
                                                                <option value="{{ $fp->Family_Position_ID }}">{{ $fp->Family_Position }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td style="width: 30%;">
                                                            <select class="form-control" name="Family_Head[]">
                                                                <option value=0>No</option>
                                                                <option value=1>Yes</option>
                                                            </select>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <button type="button" class="btn btn-danger HRRemove">Remove</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="form-group col-lg-6" style="padding:0 10px">
                                            <label class="required" for="Household_Monthly_Income">Household Monthly Income</label>
                                            <input type="number" class="form-control" id="Household_Monthly_Income" name="Household_Monthly_Income" required>
                                        </div>

                                        <div class="form-group col-lg-6" style="padding:0 10px">
                                            <label class="required" for="exampleInputEmail1">Tenure of Lot</label>
                                            <select class="form-control" id="Tenure_of_Lot_ID" name="Tenure_of_Lot_ID" required>
                                                <option value='' disabled selected>Select Option</option>
                                                @foreach($tenure_of_lot as $tol)
                                                <option value="{{ $tol->Tenure_of_Lot_ID }}">{{ $tol->Tenure_of_Lot }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6" style="padding:0 10px">
                                            <label class="required" for="Housing_Unit_ID">Housing Unit</label>
                                            <select class="form-control" id="Housing_Unit_ID" name="Housing_Unit_ID" required>
                                                <option value='' disabled selected>Select Option</option>
                                                @foreach($housing_unit as $hu)
                                                <option value="{{ $hu->Housing_Unit_ID }}">{{ $hu->Housing_Unit }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12" style="margin-bottom: 100px;">
                                        <center>
                                            <!-- <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button> -->
                                            <button type="submit" class="btn btn-primary" style="width: 200px;">Create</button>
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



<!-- Create Announcement_Status END -->

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    //Select2
    $(document).ready(function() {
        $('.select2').select2();

        //Select2 Lazy Loading Ordinance
        $(".Resident_Info").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });
    });



    function addrow() {
        var row = $("#ResidentTBL tr:last");

        row.find(".select2").each(function(index) {
            $("select.select2-hidden-accessible").select2('destroy');
        });

        var newrow = row.clone();

        newrow.find(".Resident_Info").empty();

        $("#ResidentTBL").append(newrow);

        $(".Resident_Info").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });
    }

    // Option Case Remove
    $(".HSBody").on("click", ".HRRemove", function() {
        $(this).closest(".HRDetails").remove();
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.household').addClass('active');
        $('.inhabitants_menu').addClass('active');
        $('.inhabitants_main').addClass('menu-open');
    });
</script>


<style>
    .form-control {
        min-width: 200px;
    }

    .required span:before {
        content: "*"
    }
</style>



@endsection