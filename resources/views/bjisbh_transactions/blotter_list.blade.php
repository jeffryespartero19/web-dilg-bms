@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blotter List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Blotter List</li>
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
                                @if (Auth::user()->User_Type_ID == 1)
                                <div style="padding: 2px;"><a href="{{ url('blotter_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                                @endif

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
                                            <th>Blotter Number</th>
                                            <th>Blotter Status</th>
                                            <th>Incident Date/Time</th>
                                            <th>Actions</th>
                                        </tr>
                                        <tr>
                                            <td><input class="form-control searchFilter searchFilter1" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td><input class="form-control searchFilter searchFilter2" style="min-width: 200px;" type="text" placeholder="search"></td>
                                            <td><input class="form-control searchFilter searchFilter3" style="min-width: 200px;" type="date" placeholder="search"></td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody id="ListData">
                                        @include('bjisbh_transactions.blotter_list_data')
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


<div class="modal fade" id="ViewInfo" tabindex="-1" role="dialog" aria-labelledby="ViewInfo" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Resolution Information</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <h4 id="VName"> </h4>
                    <div class="row">

                    </div>
                    <div class="col-12">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <tr>
                                <td style="width:300px"><strong>Blotter No.: </strong></td>
                                <td><span id="Blotter_Number"></span></td>
                            </tr>
                            <tr>
                                <td style="width:300px"><strong>Status: </strong></td>
                                <td><span id="Status"></span></td>
                            </tr>
                            <tr>
                                <td style="width:300px"><strong>Incident Date: </strong></td>
                                <td><span id="Incident_Date"></span></td>
                            </tr>
                            <tr>
                                <td style="width:300px"><strong>Case List: </strong></td>
                                <td><span id="Case"></span></td>
                            </tr>
                            <tr>
                                <td style="width:300px"><strong>Complaint Details: </strong></td>
                                <td><span id="Complaint"></span></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="form-group col-lg-12" style="padding:0 10px">
                        <label for="fileattach">File Attachments</label>
                        <ul class="list-group list-group-flush" id="ordinance_files2">

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

    $('.mySelect2').select2({
        dropdownParent: $('#createBlotter')
    });

    // Clone Case
    $("#AddCase").on("click", function() {
        $option = $('.CaseOptionHide').last();
        $optionNew = $option.clone();
        $option.attr('hidden', false);
        $option.after($optionNew);
    });

    // Option Case Remove
    $(".CasesList").on("click", ".caseRemove", function() {
        $(this).closest(".CaseOption").remove();
    });

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


    // Edit Button Display Modal
    $(document).on('click', ('.edit_blotter'), function(e) {

        var disID = $(this).val();
        $('#Modal_Title').text('Edit Blotter Information');
        $.ajax({
            url: "/get_blotter",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Blotter_ID').val(data['theEntry'][0]['Blotter_ID']);
                $('#Blotter_Number').val(data['theEntry'][0]['Blotter_Number']);
                $('#Blotter_Status_ID').val(data['theEntry'][0]['Blotter_Status_ID']);
                $('#Incident_Date_Time').val(data['theEntry'][0]['Incident_Date_Time']);
                $('#Address').val(data['theEntry'][0]['Address']);
                $('#Complaint_Details').val(data['theEntry'][0]['Complaint_Details']);
                var barangay =
                    " <option value='" + data['theEntry'][0]['Barangay_ID'] + "' selected>" + data['theEntry'][0]['Barangay_Name'] + "</option>";
                $('#Barangay_ID').append(barangay);

                var city =
                    " <option value='" + data['theEntry'][0]['City_Municipality_ID'] + "' selected>" + data['theEntry'][0]['City_Municipality_Name'] + "</option>";
                $('#City_Municipality_ID').append(city);

                var province =
                    " <option value='" + data['theEntry'][0]['Province_ID'] + "' selected>" + data['theEntry'][0]['Province_Name'] + "</option>";
                $('#Province_ID').append(province);
                $('#Region_ID').val(data['theEntry'][0]['Region_ID']);
            }
        });


        $.ajax({
            url: "/get_case_details",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('.CaseOption').remove();
                data.forEach(element => {
                    var option_case = '<div class="row CaseOption CaseOption' + element['Case_ID'] + '">' +
                        '<div class="col-sm-9">' +
                        '<select id="" class="form-control" name="Case_ID[]">' +
                        '@foreach($case as $cs)' +
                        '<option value="{{$cs->Case_ID}}">{{ $cs->Case_Name }}</option>' +
                        '@endforeach' +
                        '</select>' +
                        '</div>' +
                        '<div class="col-sm-3">' +
                        '<button type="button" class="btn btn-danger caseRemove">Remove</button>' +
                        '</div>' +
                        '</div>';
                    $('#CasesList').append(option_case);
                    $('.CaseOption' + element['Case_ID']).find('select').val(element['Case_ID']);
                });
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
            url: "/get_blotter_list/" + Barangay_ID,
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
                        element["Blotter_Number"],
                        element["Blotter_Status_Name"],
                        element["Incident_Date_Time"],
                        "<a class='btn btn-success' href='blotter_details/" + element["Blotter_ID"] + "'>Edit</a>",
                    ]).draw();
                });
            }
        });
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.Blotter').addClass('active');
        $('.justice_menu').addClass('active');
        $('.justice_main').addClass('menu-open');
    });

    // Delete Record
    $(document).on('click', ('.delete_blotter'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this blotter record?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_blotter",
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

    // View Info
    $(document).on('click', ('.view_info'), function(e) {

        var disID = $(this).val();

        // alert(disID);

        $.ajax({
            url: "/get_blotter_details",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Blotter_Number').text(data['theEntry'][0]['Blotter_Number']);
                $('#Status').text(data['theEntry'][0]['Blotter_Status_Name']);
                $('#Incident_Date').text(data['theEntry'][0]['Incident_Date_Time']);
                $('#Complaint').text(data['theEntry'][0]['Complaint_Details']);
            }
        });

        $.ajax({
            url: "/get_ordinance_attachments",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#ordinance_files2').empty();

                $i = 0;

                data.forEach(element => {
                    $i = $i + 1;
                    var file = '<li class="list-group-item">' + $i + '. ' + element['File_Name'] + '<a href="./files/uploads/ordinance_and_resolution/' + element['File_Name'] + '" target="_blank" style="color: blue; margin-left:10px; margin-right:10px;">View</a></li>';
                    $('#ordinance_files2').append(file);
                });


            }
        });

        $.ajax({
            url: "/get_ordinance_and_resolution_attester",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                // alert(data);

                var arr = new Array();
                // or var arr = [];
                $('#Attester_ID2').empty();
                data.forEach(element => {
                    $('#Attester_ID2').append(element['Last_Name'] + ', ' + element['First_Name'] + ' ' + element['Middle_Name'] + '<br>');
                });
            }
        });

        $.ajax({
            url: "/get_ordinance_and_resolution_pro",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                var data = JSON.parse(data);
                // alert(data);

                var arr = new Array();
                // or var arr = [];
                $('#Previous_Related_Ordinance_Resolution_ID2').empty();
                data.forEach(element => {
                    $('#Previous_Related_Ordinance_Resolution_ID2').append(element['Ordinance_Resolution_Title'] + '<br>');
                });
            }
        });

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
            url: "/search_blotter_list_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4,
            success: function(data) {
                $('#ListData').html('');
                $('#ListData').html(data);
            }
        });
    }
</script>

<style>
    .select2-selection {
        height: 34px !important;
        padding: 3px 8px;
        font: 14px;
    }
</style>

@endsection