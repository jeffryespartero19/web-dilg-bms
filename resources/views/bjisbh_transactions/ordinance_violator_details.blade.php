@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Ordinance Violator Details </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;Ordinance Violator Details</li>
        </ol>
    </div>
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
<div class="tableX_row col-md-12 up_marg5">

    <br>
    <div class="col-md-12">
        <form id="newHousehold" method="POST" action="{{ route('create_ordinance_violator') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="number" class="form-control" id="Ordinance_Violators_ID" name="Ordinance_Violators_ID" value="0" hidden>
                <div class="row">
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="exampleInputEmail1">Name</label>
                        <br>
                        <select class="form-control js-example-basic-single Resident_Select2 mySelect2" name="Resident_ID" style="width: 100%;">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($resident as $rs)
                            <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="exampleInputEmail1">Ordinance</label>
                        <br>
                        <select id="Ordinance_ID" class="form-control" name="Ordinance_ID" style="width: 100%;">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($ordinance as $bs)
                            <option value="{{ $bs->Ordinance_Resolution_ID }}">{{ $bs->Ordinance_Resolution_Title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="exampleInputEmail1">Penalty</label>
                        <br>
                        <select id="Types_of_Penalties_ID" class="form-control" name="Types_of_Penalties_ID" style="width: 100%;">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($penalties as $pt)
                            <option value="{{ $pt->Types_of_Penalties_ID }}">{{ $pt->Type_of_Penalties }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="exampleInputEmail1">Violation Status</label>
                        <br>
                        <select id="Violation_Status_ID" class="form-control" name="Violation_Status_ID" style="width: 100%;">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($violation_status as $vs)
                            <option value="{{ $vs->Violation_Status_ID }}">{{ $vs->Violation_Status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="exampleInputEmail1">Violation Date</label>
                        <input type="datetime-local" class="form-control" id="Vilotation_Date" name="Vilotation_Date" required>
                    </div>
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="exampleInputEmail1">Compiled Date</label>
                        <input type="datetime-local" class="form-control" id="Complied_Date" name="Complied_Date" required>
                    </div>
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
        $('.js-example-basic-single').select2();

        // $(".Resident_Select2").select2({
        //     tags: true
        // });
    });

    function addrow() {
        var row = $("#CaseTBL tr:last");

        row.find(".js-example-basic-single").each(function(index) {
            $(this).select2('destroy');
        });

        var newrow = row.clone();

        $("#CaseTBL").append(newrow);

        $("select.js-example-basic-single").select2();


    }

    // Option Case Remove
    $(".CSBody").on("click", ".CSRemove", function() {
        $(this).closest(".CSDetails").remove();
    });

    function addResident() {
        var row = $("#ResidentTBL tr:last");

        row.find(".js-example-basic-single").each(function(index) {
            $(this).select2('destroy');
        });



        var newrow = row.clone();

        $("#ResidentTBL").append(newrow);

        $(newrow.find("td:eq(4) input")).val('');
        $(newrow.find("td:eq(5) input")).val('');

        $("select.js-example-basic-single").select2();

        $(".Resident_Select2").select2({
            tags: true
        });
    }

    // Option Case Remove
    $(".HSBody").on("click", ".HRRemove", function() {
        $(this).closest(".HRDetails").remove();
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

    // Resident Change
    $('#HouseholdDetails').on("change", ".Resident_Select2", function() {
        var Resident_Select2 = $(this).val();
        var Type = $.isNumeric(Resident_Select2);
        var disID = Resident_Select2;

        // alert(Type);
        $row = $(this).closest(".HRDetails");
        $($row.find('td:eq(5) input')).val('');
        $($row.find('td:eq(4) input')).val('');
        $($row.find('td:eq(6) input')).val('');
        $($row.find('td:eq(3) select')).val('');
        if (Type == true) {
            $($row.find('td:eq(3) select')).val(1);

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
                    $($row.find('td:eq(5) input')).val(data['theEntry'][0]['Birthdate']);
                    $($row.find('td:eq(4) input')).val(data['theEntry'][0]['Barangay_Name'] + ', ' + data['theEntry'][0]['City_Municipality_Name'] + ', ' + data['theEntry'][0]['Province_Name'] + ', ' + data['theEntry'][0]['Region_Name']);
                    $($row.find('td:eq(6) input')).val(data['theEntry'][0]['Mobile_No']);
                }
            });
        } else {
            $($row.find('td:eq(3) select')).val(0);
        }
    });

    // Show File Name
    updateList = function() {
        var input = document.getElementById('file');
        var output = document.getElementById('fileList');

        output.innerHTML = '<ul>';
        for (var i = 0; i < input.files.length; ++i) {
            output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
        }
        output.innerHTML += '</ul>';
    }
</script>

<style>
    .select2-selection {
        height: 32px !important;
        padding: 3px 3px;
        font: 13px;
    }
</style>

@endsection