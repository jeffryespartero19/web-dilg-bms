@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Proceeding List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Proceeding List</li>
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
                                <div style="padding: 2px;"><a href="{{ url('proceeding_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                                @endif

                                <!-- <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Print</button></div>
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div> -->
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Blotter Number</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td style="width: 75%;" class="sm_data_col">{{$x->Blotter_Number}}</td>
                                            <td style="width: 25%;" class="sm_data_col txtCtr">
                                                <a class="btn btn-success" href="{{ url('proceeding_details/'.$x->Blotter_ID) }}">Edit</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();

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
            url: "/get_proceeding_list/" + Barangay_ID,
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
                        "<a class='btn btn-success' href='proceeding_details/" + element["Blotter_ID"] + "'>Edit</a>",
                    ]).draw();
                });
            }
        });
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.Proceedings').addClass('active');
        $('.justice_menu').addClass('active');
        $('.justice_main').addClass('menu-open');
    });
</script>


<style>
    .select2-selection {
        height: 34px !important;
        padding: 3px 8px;
        font: 14px;
    }
</style>

@endsection