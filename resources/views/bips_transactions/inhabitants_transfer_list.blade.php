@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Inhabitants Trnasfer List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;Inhabitants Transfer List</li>
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
        <div class="twenty_split txtRight"><button data-toggle="modal" class="btn btn-success" data-target="#createInhabitants_Transfer" style="width: 100px;">New</button></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Inhabitants_Transfer_ID</th>
                    <th hidden>Resident_ID</th>
                    <th >Name</th>
                    <th >Region</th>
                    <th >Province</th>
                    <th >City / Municipality</th>
                    <th >Barangay</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Inhabitants_Transfer_ID}}</td>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Resident_ID}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Last_Name}} {{$x->First_Name}}, {{$x->Middle_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Region_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Province_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->City_Municipality_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Barangay_Name}}</td>
                    <td class="sm_data_col txtCtr"> 
                        <button class="edit_inhabitants_transfer" value="{{$x->Inhabitants_Transfer_ID}}" data-toggle="modal" data-target="#updateInhabitants_Transfer">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Announcement_Status Modal  -->

<div class="modal fade" id="createInhabitants_Transfer" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Create Transfer Inhabitants</h4>
            </div>
            <div class="modal-body">
                <form id="newInhabitant" method="POST" action="{{ route('create_inhabitants_transfer') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Resident Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Inhabitants_Transfer_ID" name="Inhabitants_Transfer_ID" hidden>
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="Resident_ID">Name</label>
                                <select class="form-control" id="Resident_ID" name="Resident_ID">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($name as $bt)
                                    <option value="{{ $bt->Resident_ID }}">{{ $bt->Last_Name }} {{ $bt->First_Name }}, {{ $bt->Middle_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h3>Barangay Information(Transfer to)</h3>
                        <br>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Region_ID">Region</label>
                                <select class="form-control" id="Region_ID" name="Region_ID">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($region as $bt1)
                                    <option value="{{ $bt1->Region_ID }}">{{ $bt1->Region_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Province_ID">Province</label>
                                <select class="form-control" id="Province_ID" name="Province_ID">
                                    <option value='' disabled selected>Select Option</option>
                                    
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="City_Municipality_ID">City_Municipality</label>
                                <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID">
                                    <option value='' disabled selected>Select Option</option>
                                  
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Barangay_ID">Barangay</label>
                                <select class="form-control" id="Barangay_ID" name="Barangay_ID">
                                    <option value='' disabled selected>Select Option</option>
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="width: 200px;">Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- Create Announcement_Status END -->



 
<div class="modal fade" id="updateInhabitants_Transfer" tabindex="-1" role="dialog" aria-labelledby="Update_Inhabitants_Transfer" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Update Inhabitants Transfer</h4>
            </div>
            <div class="modal-body">
                <form id="newInhabitants_Transfer" method="POST" action="{{ route('update_inhabitants_transfer') }}"  autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                    <div class="modal-body">
                        <h3>Resident Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Inhabitants_Transfer_ID1" name="Inhabitants_Transfer_ID1" hidden>
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="Resident_ID1">Name</label>
                                <select class="form-control" id="Resident_ID1" name="Resident_ID1">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($name as $bt)
                                    <option value="{{ $bt->Resident_ID }}">{{ $bt->Last_Name }} {{ $bt->First_Name }}, {{ $bt->Middle_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h3>Barangay Information(Transfer to)</h3>
                        <br>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Region_ID1">Region</label>
                                <select class="form-control" id="Region_ID1" name="Region_ID1">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($region as $bt1)
                                    <option value="{{ $bt1->Region_ID }}">{{ $bt1->Region_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                            <label for="Province_ID1">Province</label>
                                <select class="form-control" id="Province_ID1" name="Province_ID1">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($province as $bt1)
                                    <option value="{{ $bt1->Province_ID }}">{{ $bt1->Province_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="City_Municipality_ID1">City_Municipality</label>
                                <select class="form-control" id="City_Municipality_ID1" name="City_Municipality_ID1">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($city as $bt1)
                                    <option value="{{ $bt1->City_Municipality_ID }}">{{ $bt1->City_Municipality_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                            <label for="Barangay_ID1">Barangay</label>
                                <select class="form-control" id="Barangay_ID1" name="Barangay_ID1">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($barangay as $bt1)
                                    <option value="{{ $bt1->Barangay_ID }}">{{ $bt1->Barangay_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="width: 200px;">Update</button>
                    </div>
                </form>
            </div>

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
                $('#Resident_ID1').val(data['theEntry'][0]['Resident_ID']);
                $('#Region_ID1').val(data['theEntry'][0]['Region_ID']);
                $('#Province_ID1').val(data['theEntry'][0]['Province_ID']);
                $('#Barangay_ID1').val(data['theEntry'][0]['Barangay_ID']);
                $('#City_Municipality_ID1').val(data['theEntry'][0]['City_Municipality_ID']);
                
            }
        });


    });







     

     
</script>



<style>
    table {
        display: block;
        overflow-x: scroll;
    }
</style>

@endsection