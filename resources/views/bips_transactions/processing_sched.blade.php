@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Processing Schedule</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Processing Schedule</li>
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
@if(session()->has('alert'))
<div class="alert alert-success">
    {{ session()->get('alert') }}
</div>
@endif

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- @if (Auth::user()->User_Type_ID == 3)
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
            @endif -->
            <div class="col-12">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title flexer justifier">Edit Schedule</h4>
                        </div>
                        <form id="newProcessingSched" method="POST" action="{{ route('update_processing_sched') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                            <div class="modal-body">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-lg-12" style="padding:0 10px">
                                            <label for="days">Number of Days</label>
                                            <input type="text" class="form-control" id="days" name="days" value="@if(isset($db_entries[0]->days)) {{$db_entries[0]->days}} @endif">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
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

    $(document).on('click', '.modal-close', function(e) {
        $('#newInhabitant').trigger("reset");
    });




    // Edit Button Display Modal
    $(document).on('click', ('.edit_deceased_profile'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_deceased_profile",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Resident_ID2').val(data['theEntry'][0]['Resident_ID']);
                $('#Resident_IDs2').val(data['theEntry'][0]['Resident_ID']);
                $('#Cause_of_Death2').val(data['theEntry'][0]['Cause_of_Death']);
                $('#Deceased_Type_ID2').val(data['theEntry'][0]['Deceased_Type_ID']);
                $('#Date_of_Death2').val(data['theEntry'][0]['Date_of_Death']);
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
            url: "/get_deceased_list/" + Barangay_ID,
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
                        element["Deceased_Type"],
                        element["Cause_of_Death"],
                        element["Date_of_Death"],
                        "<button class='edit_deceased_profile' value='" + element["Resident_ID"] + "' data-toggle='modal' data-target='#updateDeceased_Profile'>Edit</button>",
                    ]).draw();
                });
            }
        });
    });

    // Disable Form if DILG USER
    $(document).ready(function() {
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 3) {
            $("#newDeceased_Profile :input").prop("disabled", true);
        }
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.processingsched').addClass('active');
        $('.inhabitants_menu').addClass('active');
        $('.inhabitants_main').addClass('menu-open');
    });
</script>


@endsection