@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inhabitants Transfer List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Inhabitants Transfer List</li>
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
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-success" data-target="#createInhabitants_Transfer" style="width: 100px;">New</button></div>
                                <!-- <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Print</button></div>
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div> -->
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Region</th>
                                            <th>Province</th>
                                            <th>City / Municipality</th>
                                            <th>Barangay</th>
                                            <th>Actions</th>
                                        </tr>
                                        <tr>
                                            <td><input class="form-control searchFilter searchFilter1" style="min-width: 200px;" type="text"></td>
                                            <td><input class="form-control searchFilter searchFilter2" style="min-width: 200px;" type="text"></td>
                                            <td><input class="form-control searchFilter searchFilter3" style="min-width: 200px;" type="text"></td>
                                            <td><input class="form-control searchFilter searchFilter4" style="min-width: 200px;" type="text"></td>
                                            <td><input class="form-control searchFilter searchFilter5" style="min-width: 200px;" type="text"></td>
                                            <td></td>
                                        </tr>
                                    </thead>

                                    <tbody id="ListData">
                                        @include('bips_transactions.inhabitants_transfer_list_data')
                                    </tbody>
                                </table>
                                {!! $db_entries->links() !!}
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1">
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

<!-- Create Announcement_Status Modal  -->

<div class="modal fade" id="createInhabitants_Transfer" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create Transfer Inhabitants</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newInhabitant" method="POST" action="{{ route('create_inhabitants_transfer') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <h3>Resident Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Inhabitants_Transfer_ID" name="Inhabitants_Transfer_ID" hidden>
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label class="required" for="Resident_ID">Name</label>
                                <select class="form-control" id="Resident_ID" name="Resident_ID" required>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h3>Barangay Information(Transfer to)</h3>
                        <br>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label class="required" for="Region_ID">Region</label>
                                <select class="form-control" id="Region_ID" name="Region_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($region as $bt1)
                                    <option value="{{ $bt1->Region_ID }}">{{ $bt1->Region_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label class="required" for="Province_ID">Province</label>
                                <select class="form-control" id="Province_ID" name="Province_ID" required>
                                    <option value='' disabled selected>Select Option</option>

                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label class="required" for="City_Municipality_ID">City_Municipality</label>
                                <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID" required>
                                    <option value='' disabled selected>Select Option</option>

                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label class="required" for="Barangay_ID">Barangay</label>
                                <select class="form-control" id="Barangay_ID" name="Barangay_ID" required>
                                    <option value='' disabled selected>Select Option</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Create Announcement_Status END -->




<div class="modal fade" id="updateInhabitants_Transfer" role="dialog" aria-labelledby="Update_Inhabitants_Transfer" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Mtitle">Edit Transfer Inhabitants</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newInhabitants_Transfer" method="POST" action="{{ route('create_inhabitants_transfer') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="modal-body">
                            <h3>Resident Information</h3>
                            <br>
                            <div class="row">
                                <input type="text" class="form-control" id="Inhabitants_Transfer_ID1" name="Inhabitants_Transfer_ID" hidden>
                                <div class="form-group col-lg-12" style="padding:0 10px">
                                    <label class="required" for="Resident_ID1">Name</label>
                                    <select class="form-control" id="Resident_ID1" name="Resident_ID" required>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <h3>Barangay Information(Transfer to)</h3>
                            <br>
                            <div class="row">
                                <div class="form-group col-lg-6" style="padding:0 10px">
                                    <label class="required" for="Region_ID1">Region</label>
                                    <select class="form-control" id="Region_ID1" name="Region_ID" required>
                                        <option value='' disabled selected>Select Option</option>
                                        @foreach($region as $bt1)
                                        <option value="{{ $bt1->Region_ID }}">{{ $bt1->Region_Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-6" style="padding:0 10px">
                                    <label class="required" for="Province_ID1">Province</label>
                                    <select class="form-control" id="Province_ID1" name="Province_ID" required>
                                        <option value='' disabled selected>Select Option</option>
                                        @foreach($province as $bt1)
                                        <option value="{{ $bt1->Province_ID }}">{{ $bt1->Province_Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-6" style="padding:0 10px">
                                    <label class="required" for="City_Municipality_ID1">City_Municipality</label>
                                    <select class="form-control" id="City_Municipality_ID1" name="City_Municipality_ID" required>
                                        <option value='' disabled selected>Select Option</option>
                                        @foreach($city as $bt1)
                                        <option value="{{ $bt1->City_Municipality_ID }}">{{ $bt1->City_Municipality_Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-6" style="padding:0 10px">
                                    <label class="required" for="Barangay_ID1">Barangay</label>
                                    <select class="form-control" id="Barangay_ID1" name="Barangay_ID" required>
                                        <option value='' disabled selected>Select Option</option>
                                        @foreach($barangay as $bt1)
                                        <option value="{{ $bt1->Barangay_ID }}">{{ $bt1->Barangay_Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
    </div>
</div>

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


    // Populate Province test
    $(document).on("change", "#Region_ID1", function() {
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
                $('#Province_ID1').empty();
                $('#City_Municipality_ID1').empty();
                $('#Barangay_ID1').empty();


                var option1 =
                    "<option value='' disabled selected>Select Option</option>";
                $('#Province_ID1').append(option1);
                $('#City_Municipality_ID1').append(option1);
                $('#Barangay_ID1').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["Province_ID"] +
                        "'>" +
                        element["Province_Name"] +
                        "</option>";
                    $('#Province_ID1').append(option);
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

    // Populate City test
    $(document).on("change", "#Province_ID1", function() {
        var Province_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_city/" + Province_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#City_Municipality_ID1').empty();
                $('#Barangay_ID1').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#City_Municipality_ID1').append(option1);
                $('#Barangay_ID1').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["City_Municipality_ID"] +
                        "'>" +
                        element["City_Municipality_Name"] +
                        "</option>";
                    $('#City_Municipality_ID1').append(option);
                });
            }
        });
    });


    // Populate Barangay
    $(document).on("change", "#City_Municipality_ID", function() {
        var City_Municipality_ID = $(this).val();
        // var City_Municipality_ID = '01';

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


    // Populate Barangay test
    $(document).on("change", "#City_Municipality_ID1", function() {
        var City_Municipality_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_barangay/" + City_Municipality_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#Barangay_ID1').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#Barangay_ID1').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["Barangay_ID"] +
                        "'>" +
                        element["Barangay_Name"] +
                        "</option>";
                    $('#Barangay_ID1').append(option);
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
    });




    // Edit Button Display Modal
    $(document).on('click', ('.edit_inhabitants_transfer'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_inhabitants_transfer",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Inhabitants_Transfer_ID1').val(data['theEntry'][0]['Inhabitants_Transfer_ID']);
                // $('#Resident_ID1').val(data['theEntry'][0]['Resident_ID']);
                $('#Region_ID1').val(data['theEntry'][0]['Region_ID']);
                $('#Province_ID1').val(data['theEntry'][0]['Province_ID']);
                $('#Barangay_ID1').val(data['theEntry'][0]['Barangay_ID']);
                $('#City_Municipality_ID1').val(data['theEntry'][0]['City_Municipality_ID']);
                var option = " <option value='" +
                    data['theEntry'][0]['Resident_ID'] +
                    "'>" +
                    data['theEntry'][0]['Last_Name'] + ", " + data['theEntry'][0]['First_Name'] + " " + data['theEntry'][0]['Middle_Name'] +
                    "</option>";
                $('#Resident_ID1').append(option);

            }
        });


    });

    $(document).on("change", "#CM_ID", function() {

        // var City_Municipality_ID = $(this).val();
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
            url: "/get_transfer_list/" + Barangay_ID,
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

                    $('#example').DataTable().row.add([
                        element["Last_Name"] + ', ' + element["First_Name"] + ' ' + element["Middle_Name"],
                        element["Region_Name"],
                        element["Province_Name"],
                        element["City_Municipality_Name"],
                        element["Barangay_Name"],
                        "<button class='edit_inhabitants_transfer' value='" + element["Inhabitants_Transfer_ID"] + "' data-toggle='modal' data-target='#updateInhabitants_Transfer'>Edit</button>",
                    ]).draw();
                });
            }
        });
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.transfer').addClass('active');
        $('.inhabitants_menu').addClass('active');
        $('.inhabitants_main').addClass('menu-open');
    });

    $(document).on('click', ('.view_inhabitants_transfer'), function() {
        $("#newInhabitants_Transfer :input").prop("disabled", true);
        $(".modal-close").prop("disabled", false);
        $(this).closest(".sm_data_col").find(".edit_inhabitants_transfer").trigger('click');
        $("#Mtitle").text("View");
    });

    $(document).on('click', '.modal-close', function(e) {
        $('#newInhabitants_Transfer').trigger("reset");
        $("#newInhabitants_Transfer :input").prop("disabled", false);
        $("#Mtitle").text("Edit");
    });

    $(document).ready(function() {
        //Select2 Lazy Loading Inhabitants
        $("#Resident_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });

        $("#Resident_ID1").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_inhabitants',
                dataType: "json",
            }
        });
    });

    $(".searchFilter").change(function() {
        SearchData2();
    });

    function SearchData2() {
        // alert('test');
        var param1 = $('.searchFilter1').val();
        var param2 = $('.searchFilter2').val();
        var param3 = $('.searchFilter3').val();
        var param4 = $('.searchFilter4').val();
        var param5 = $('.searchFilter5').val();
        var page = $('#hidden_page').val();

        $.ajax({
            url: "/search_inhabitant_transfer_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4 + "&param5=" + param5,
            success: function(data) {
                $('#ListData').html('');
                $('#ListData').html(data);
            }
        });
    }
</script>

@endsection