@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Other Transaction List(BDRIS)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Other Transaction List(BDRIS)</li>
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

<div class="tableX_row col-md-12 up_marg5">
    @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
                    <div class="form-group col-lg-3">
                        <label for="R_ID">Region</label>
                        <select class="form-control" id="R_ID" name="R_ID" required>
                            <option value='' disabled selected>Select Option</option>

                            @foreach($region1 as $region)
                            <option value="{{ $region->Region_ID }}">{{ $region->Region_Name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="P_ID">Province</label>
                        <select class="form-control" id="P_ID" name="P_ID" required>
                            <option value='' disabled selected>Select Option</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="CM_ID">City/Municipality</label>
                        <select class="form-control" id="CM_ID" name="CM_ID" required>
                            <option value='' disabled selected>Select Option</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-3">
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
    @if (Auth::user()->User_Type_ID == 1)
    <div class="card">
        <div class="card-header" style="background-color:#e7ad52; color:white">
            <h3 class="card-title">Disaster Type List</h3>
        </div>
        <div class="card-body">
            <div class="flexer">
                <div class="eighty_split">{{$db_entries->appends(['db_entries' => $db_entries->currentPage()])->links()}}</div>

                <div class="twenty_split txtRight"><a href="{{ url('disaster_type_details/0') }}" class="btn btn-success" style="width: 100px;">New </a></div>

            </div>
            <br>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th>Disaster Type</th>
                            <th>Emergency Evacuation Site</th>
                            <th>Allocated Fund</th>
                            <th>Emergency Equipment</th>
                            <th>Emergency Team</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($db_entries as $x)
                        <tr>

                            <td class="sm_data_col txtCtr">{{$x->Disaster_Type}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Emergency_Evacuation_Site_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Allocated_Fund_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Emergency_Equipment_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Emergency_Team_Name}}</td>
                            <td class="sm_data_col txtCtr">
                                <a class="btn btn-success" href="{{ url('disaster_type_details/'.$x->Disaster_Type_ID) }}">Edit</a>
                                <a class="btn btn-success" href="{{ url('view_disaster_type_details/'.$x->Disaster_Type_ID) }}">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    @endif
    <!-- /.card-body -->
    <div class="card">
        <div class="card-header" style="background-color:#198754; color:white">
            <h3 class="card-title">Emergency Evacuation Site List</h3>
        </div>
        <div class="card-body">
            <div class="flexer">
                <div class="eighty_split">{{$db_entries2->appends(['db_entries2' => $db_entries2->currentPage()])->links()}}</div>
                @if (Auth::user()->User_Type_ID == 1)
                <div class="twenty_split txtRight"><a href="{{ url('emergency_evacuation_site_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                @endif
            </div>
            <br>
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th>Emergency Evacuation_Site Name </th>
                            <th>Address </th>
                            <th>Capacity </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($db_entries2 as $x)
                        <tr>

                            <td class="sm_data_col txtCtr">{{$x->Emergency_Evacuation_Site_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Address}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Capacity}}</td>
                            <td class="sm_data_col txtCtr">
                                @if (Auth::user()->User_Type_ID == 1)
                                <a class="btn btn-success" href="{{ url('emergency_evacuation_site_details/'.$x->Emergency_Evacuation_Site_ID) }}">Edit</a>
                                <a class="btn btn-success" href="{{ url('view_emergency_evacuation_site_details/'.$x->Emergency_Evacuation_Site_ID) }}">View</a>
                                @endif
                                @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
                                <a class="btn btn-success" href="{{ url('emergency_evacuation_site_details/'.$x->Emergency_Evacuation_Site_ID) }}">View</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" style="background-color:#9d02df; color:white">
            <h3 class="card-title">Allocated Fund List</h3>
        </div>
        <div class="card-body">
            <br>
            <div class="flexer">
                <div class="eighty_split">{{$db_entries3->appends(['db_entries3' => $db_entries3->currentPage()])->links()}}</div>
                @if (Auth::user()->User_Type_ID == 1)
                <div class="twenty_split txtRight"><a href="{{ url('allocated_fund_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                @endif
            </div>
            <br>
            <div class="table-responsive">
                <table id="example3" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th>Allocated Fund Name </th>
                            <th>Amount </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($db_entries3 as $x)
                        <tr>

                            <td class="sm_data_col txtCtr">{{$x->Allocated_Fund_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Amount}}</td>
                            <td class="sm_data_col txtCtr">
                                @if (Auth::user()->User_Type_ID == 1)
                                <a class="btn btn-success" href="{{ url('allocated_fund_details/'.$x->Allocated_Fund_ID) }}">Edit</a>
                                <a class="btn btn-success" href="{{ url('view_allocated_fund_details/'.$x->Allocated_Fund_ID) }}">View</a>
                                @endif
                                @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
                                <a class="btn btn-success" href="{{ url('allocated_fund_details/'.$x->Allocated_Fund_ID) }}">View</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" style="background-color:#074ff4; color:white">
            <h3 class="card-title">Disaster Supplies List</h3>
        </div>
        <div class="card-body">
            <div class="flexer">
                <div class="eighty_split">{{$db_entries4->appends(['db_entries4' => $db_entries4->currentPage()])->links()}}</div>
                @if (Auth::user()->User_Type_ID == 1)
                <div class="twenty_split txtRight"><a href="{{ url('disaster_supplies_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                @endif
            </div>
            <br>
            <div class="table-responsive">
                <table id="example4" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th>Disaster Name </th>
                            <th>Disaster Supplies Name </th>
                            <th>Disaster Supplies Quantity </th>
                            <th>Location </th>
                            <th>Remarks </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($db_entries4 as $x)
                        <tr>

                            <td class="sm_data_col txtCtr">{{$x->Disaster_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Disaster_Supplies_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Disaster_Supplies_Quantity}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Location}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Remarks}}</td>
                            <td class="sm_data_col txtCtr">
                                @if (Auth::user()->User_Type_ID == 1)
                                <a class="btn btn-success" href="{{ url('disaster_supplies_details/'.$x->Disaster_Supplies_ID) }}">Edit</a>
                                <a class="btn btn-success" href="{{ url('view_disaster_supplies_details/'.$x->Disaster_Supplies_ID) }}">View</a>
                                @endif
                                @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
                                <a class="btn btn-success" href="{{ url('disaster_supplies_details/'.$x->Disaster_Supplies_ID) }}">View</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" style="background-color:#af2b31; color:white">
            <h3 class="card-title">Emergency Team List</h3>
        </div>
        <div class="card-body">
            <div class="flexer">
                <div class="eighty_split">{{$db_entries4->appends(['db_entries5' => $db_entries4->currentPage()])->links()}}</div>
                @if (Auth::user()->User_Type_ID == 1)
                <div class="twenty_split txtRight"><a href="{{ url('emergency_team_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                @endif
            </div>
            <br>
            <div class="table-responsive">
                <table id="example5" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th>Emergency Team Name </th>
                            <th>Emergency Team Hotline </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($db_entries5 as $x)
                        <tr>

                            <td class="sm_data_col txtCtr">{{$x->Emergency_Team_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Emergency_Team_Hotline}}</td>
                            <td class="sm_data_col txtCtr">
                                @if (Auth::user()->User_Type_ID == 1)
                                <a class="btn btn-success" href="{{ url('emergency_team_details/'.$x->Emergency_Team_ID) }}">Edit</a>
                                <a class="btn btn-success" href="{{ url('view_emergency_team_details/'.$x->Emergency_Team_ID) }}">View</a>
                                @endif
                                @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
                                <a class="btn btn-success" href="{{ url('emergency_team_details/'.$x->Emergency_Team_ID) }}">View</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" style="background-color:#435f57; color:white">
            <h3 class="card-title">Emergency Equipment List</h3>
        </div>
        <div class="card-body">
            <div class="flexer">
                <div class="eighty_split">{{$db_entries4->appends(['db_entries6' => $db_entries4->currentPage()])->links()}}</div>
                @if (Auth::user()->User_Type_ID == 1)
                <div class="twenty_split txtRight"><a href="{{ url('emergency_equipment_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                @endif
            </div>
            <br>
            <div class="table-responsive">
                <table id="example6" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th>Emergency Equipment Name </th>
                            <th>Location </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($db_entries6 as $x)
                        <tr>

                            <td class="sm_data_col txtCtr">{{$x->Emergency_Equipment_Name}}</td>
                            <td class="sm_data_col txtCtr">{{$x->Location}}</td>
                            <td class="sm_data_col txtCtr">
                                @if (Auth::user()->User_Type_ID == 1)
                                <a class="btn btn-success" href="{{ url('emergency_equipment_details/'.$x->Emergency_Equipment_ID) }}">Edit</a>
                                <a class="btn btn-success" href="{{ url('view_emergency_equipment_details/'.$x->Emergency_Equipment_ID) }}">View</a>
                                @endif
                                @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
                                <a class="btn btn-success" href="{{ url('emergency_equipment_details/'.$x->Emergency_Equipment_ID) }}">View</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <br>
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
        $('#example4').DataTable();
        $('#example5').DataTable();
        $('#example6').DataTable();

    });

    $(document).on("change", "#R_ID", function() {

        var Region_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_province/" + Region_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#P_ID').empty();
                $('#CM_ID').empty();
                $('#B_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#P_ID').append(option1);
                $('#CM_ID').append(option1);
                $('#B_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["Province_ID"] +
                        "'>" +
                        element["Province_Name"] +
                        "</option>";
                    $('#P_ID').append(option);
                });
            }
        });
    });

    $(document).on("change", "#P_ID", function() {
        var Province_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_city/" + Province_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#CM_ID').empty();
                $('#B_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#CM_ID').append(option1);
                $('#B_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["City_Municipality_ID"] +
                        "'>" +
                        element["City_Municipality_Name"] +
                        "</option>";
                    $('#CM_ID').append(option);
                });
            }
        });
    });

    $(document).on("change", "#CM_ID", function() {
        var City_Municipality_ID = $(this).val();

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
            url: "/get_emergency_evacuation_site_list/" + Barangay_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#example2').dataTable().fnClearTable();
                $('#example2').dataTable().fnDraw();
                $('#example2').dataTable().fnDestroy();

                data.forEach(element => {

                    $('#example2').DataTable().row.add([
                        element["Emergency_Evacuation_Site_Name"],
                        element["Address"],
                        element["Capacity"],
                        "<a class='btn btn-success' href='emergency_evacuation_site_details/" + element["Emergency_Evacuation_Site_ID"] + "'>View</a>",
                    ]).draw();
                });
            }
        });

        $.ajax({
            type: "GET",
            url: "/get_allocated_fund_list/" + Barangay_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#example3').dataTable().fnClearTable();
                $('#example3').dataTable().fnDraw();
                $('#example3').dataTable().fnDestroy();

                data.forEach(element => {

                    $('#example3').DataTable().row.add([
                        element["Allocated_Fund_Name"],
                        element["Amount"],
                        "<a class='btn btn-success' href='allocated_fund_details/" + element["Allocated_Fund_ID"] + "'>View</a>",
                    ]).draw();
                });
            }
        });

        $.ajax({
            type: "GET",
            url: "/get_disaster_supplies_list/" + Barangay_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#example4').dataTable().fnClearTable();
                $('#example4').dataTable().fnDraw();
                $('#example4').dataTable().fnDestroy();

                data.forEach(element => {

                    $('#example4').DataTable().row.add([
                        element["Disaster_Name"],
                        element["Disaster_Supplies_Name"],
                        element["Disaster_Supplies_Quantity"],
                        element["Location"],
                        element["Remarks"],
                        "<a class='btn btn-success' href='disaster_supplies_details/" + element["Disaster_Supplies_ID"] + "'>View</a>",
                    ]).draw();
                });
            }
        });

        $.ajax({
            type: "GET",
            url: "/get_emergency_team_list/" + Barangay_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#example5').dataTable().fnClearTable();
                $('#example5').dataTable().fnDraw();
                $('#example5').dataTable().fnDestroy();

                data.forEach(element => {

                    $('#example5').DataTable().row.add([
                        element["Emergency_Team_Name"],
                        element["Emergency_Team_Hotline"],
                        "<a class='btn btn-success' href='emergency_team_details/" + element["Emergency_Team_ID"] + "'>View</a>",
                    ]).draw();
                });
            }
        });

        $.ajax({
            type: "GET",
            url: "/get_emergency_equipment_list/" + Barangay_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);

                $('#example6').dataTable().fnClearTable();
                $('#example6').dataTable().fnDraw();
                $('#example6').dataTable().fnDestroy();

                data.forEach(element => {

                    $('#example6').DataTable().row.add([
                        element["Emergency_Equipment_Name"],
                        element["Location"],
                        "<a class='btn btn-success' href='emergency_equipment_details/" + element["Emergency_Equipment_ID"] + "'>View</a>",
                    ]).draw();
                });
            }
        });
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.otherTrans').addClass('active');
        $('.disaster_menu').addClass('active');
        $('.disaster_main').addClass('menu-open');
    });
</script>


@endsection