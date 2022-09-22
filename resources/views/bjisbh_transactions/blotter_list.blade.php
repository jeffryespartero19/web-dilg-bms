@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Blotter List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;Blotter List</li>
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
    <div class="flexer">
        <div class="eighty_split">{{$db_entries->appends(['db_entries' => $db_entries->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><a href="{{ url('blotter_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Blotter_ID</th>
                    <th>Blotter Number</th>
                    <th>Blotter Status</th>
                    <th>Incident Date/Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Blotter_ID}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Blotter_Number}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Blotter_Status_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Incident_Date_Time}}</td>
                    <td class="sm_data_col txtCtr">
                        <a class="btn btn-success" href="{{ url('blotter_details/'.$x->Blotter_ID) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
</script>

<style>
    table {
        display: inline-block;
        overflow-x: scroll;
    }

    .select2-selection {
        height: 34px !important;
        padding: 3px 8px;
        font: 14px;
    }
</style>

@endsection