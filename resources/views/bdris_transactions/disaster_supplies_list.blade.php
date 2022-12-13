@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Disaster Supplies List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BDRIS / </li>
            </a>
            <li> &nbsp;Disaster Supplies List</li>
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
        <div class="twenty_split txtRight"><button data-toggle="modal" class="btn btn-success" data-target="#createDisaster_Supplies" style="width: 100px;">New</button></div>
        <div class="txtRight" style="margin-left: 5px;"><a href="{{ url('viewDisaster_SuppliesPDF') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Disaster_Supplies_ID </th>
                    <th>Disaster Name </th>
                    <th>Disaster Supplies Name </th>
                    <th>Disaster Supplies Quantity </th>
                    <th>Location </th>
                    <th>Remarks </th>
                    <th>Brgy Official Name </th>
                    <th>Region </th>
                    <th>Province </th>
                    <th>City/Municipality </th>
                    <th>Barangay</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Disaster_Supplies_ID}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Disaster_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Disaster_Supplies_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Disaster_Supplies_Quantity}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Location}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Remarks}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Last_Name}} {{$x->First_Name}}, {{$x->Middle_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Region_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Province_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->City_Municipality_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Barangay_Name}}</td>
                    <td class="sm_data_col txtCtr">
                        <button class="edit_disaster_supplies" value="{{$x->Disaster_Supplies_ID}}" data-toggle="modal" data-target="#createDisaster_Supplies">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Announcement_Status Modal  -->

<div class="modal fade" id="createDisaster_Supplies" tabindex="-1" role="dialog" aria-labelledby="Create_Disaster_Supplies" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Disaster Supplies Profile</h4>
            </div>
            <div class="modal-body">
                <form id="newDisaster_Supplies" method="POST" action="{{ route('create_disaster_supplies') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Disaster Supplies Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Disaster_Supplies_ID" name="Disaster_Supplies_ID" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Disaster_Response_ID">Disaster Response</label>
                                <select class="form-control" id="Disaster_Response_ID" name="Disaster_Response_ID">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($disaster_response as $bt1)
                                    <option value="{{ $bt1->Disaster_Response_ID }}">{{ $bt1->Disaster_Name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Disaster_Supplies_Name">Disaster Supplies Name</label>
                                <input type="text" class="form-control" id="Disaster_Supplies_Name" name="Disaster_Supplies_Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Disaster_Supplies_Quantity">Disaster Supplies Quantity</label>
                                <input type="number" class="form-control" id="Disaster_Supplies_Quantity" name="Disaster_Supplies_Quantity">
                            </div>
                            <div class="form-group col-lg-9" style="padding:0 10px">
                                <label for="Location">Location</label>
                                <input type="text" class="form-control" id="Location" name="Location">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="Remarks">Remarks</label>
                                <input type="text" class="form-control" id="Remarks" name="Remarks">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="Brgy_Officials_and_Staff_ID">Brgy Official Name</label>
                                <select class="form-control" id="Brgy_Officials_and_Staff_ID" name="Brgy_Officials_and_Staff_ID">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($brgy_officials_and_staff as $bt1)
                                    <option value="{{ $bt1->Resident_ID }}">{{ $bt1->Last_Name }} {{ $bt1->First_Name }}, {{ $bt1->Middle_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="Region_ID">Region</label>
                                <select class="form-control" id="Region_ID" name="Region_ID">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($region as $bt1)
                                    <option value="{{ $bt1->Region_ID }}">{{ $bt1->Region_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="Province_ID">Province</label>
                                <select class="form-control" id="Province_ID" name="Province_ID">
                                    <option value='' disabled selected>Select Option</option>


                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="City_Municipality_ID">City_Municipality</label>
                                <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID">
                                    <option value='' disabled selected>Select Option</option>


                                </select>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <label for="Barangay_ID">Barangay</label>
                                <select class="form-control" id="Barangay_ID" name="Barangay_ID">
                                    <option value='' disabled selected>Select Option</option>

                                </select>
                            </div>
                            <div class="form-group col-lg-4" style="padding:0 10px">
                                <span><b>Active:</b></span><br>
                                <select class="modal_input1" name="Active" id="Active">
                                    <option hidden selected>Is Active?</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="width: 200px;">Save</button>
                    </div>
                </form>
            </div>

        </div>
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

    $(document).on('click', '.modal-close', function(e) {
        $('#newDisaster_Supplies').trigger("reset");
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
    $(document).on('click', ('.edit_disaster_supplies'), function(e) {
        $('#Modal_Title').text('Edit Disaster Supplies');
        var disID = $(this).val();
        $.ajax({
            url: "/get_disaster_supplies",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Disaster_Supplies_ID').val(data['theEntry'][0]['Disaster_Supplies_ID']);
                $('#Disaster_Response_ID').val(data['theEntry'][0]['Disaster_Response_ID']);
                $('#Disaster_Supplies_Name').val(data['theEntry'][0]['Disaster_Supplies_Name']);
                $('#Disaster_Supplies_Quantity').val(data['theEntry'][0]['Disaster_Supplies_Quantity']);
                $('#Location').val(data['theEntry'][0]['Location']);
                $('#Remarks').val(data['theEntry'][0]['Remarks']);
                $('#Region_ID').val(data['theEntry'][0]['Region_ID']);
                $('#Active').val(data['theEntry'][0]['Active']);

                var barangay =
                    " <option value='" + data['theEntry'][0]['Barangay_ID'] + "' selected>" + data['theEntry'][0]['Barangay_Name'] + "</option>";
                $('#Barangay_ID').append(barangay);

                var city =
                    " <option value='" + data['theEntry'][0]['City_Municipality_ID'] + "' selected>" + data['theEntry'][0]['City_Municipality_Name'] + "</option>";
                $('#City_Municipality_ID').append(city);

                var province =
                    " <option value='" + data['theEntry'][0]['Province_ID'] + "' selected>" + data['theEntry'][0]['Province_Name'] + "</option>";
                $('#Province_ID').append(province);



            }
        });
    });


    $(document).on('click', '.modal-close', function(e) {
        $('#newBrgy_Projects_Monitoring').trigger("reset");
        $('#Barangay_ID').empty();
        $('#City_Municipality_ID').empty();
        $('#Province_ID').empty();
        var option1 = "<option value='' disabled selected>Select Option</option>";
        $('#Barangay_ID').append(option1);
        $('#City_Municipality_ID').append(option1);
        $('#Province_ID').append(option1);

        $('#Modal_Title').text('Create Disaster Supplies');


    });

    // Side Bar Active
    $(document).ready(function() {
        $('.otherTrans').addClass('active');
        $('.disaster_menu').addClass('active');
        $('.disaster_main').addClass('menu-open');
    });
</script>

<style>
    table {
        display: block;
        overflow-x: scroll;
    }
</style>

@endsection