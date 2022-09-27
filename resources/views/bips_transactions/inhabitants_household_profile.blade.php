@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Inhabitants Household List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;Inhabitants Household List</li>
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
        <div class="twenty_split txtRight"><a class="btn btn-success" href="{{ url('inhabitants_household_details/0') }}" style="width: 100px;">New</a></div>
        <div style="margin-left: 10px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Print</button></div>
        <div style="margin-left: 10px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Household Profile ID</th>
                    <th>Household Name</th>
                    <th>Monthly Income</th>
                    <th>Tenure of Lot</th>
                    <th>Housing Unit</th>
                    <th>Family Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Household_Profile_ID}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Household_Name}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Household_Monthly_Income}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Tenure_of_Lot}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Housing_Unit}}</td>
                    <td class="sm_data_col txtCtr">{{$x->Family_Type_Name}}</td>
                    <td class="sm_data_col txtCtr">
                        <a class="btn btn-success" href="{{ url('inhabitants_household_details/'.$x->Household_Profile_ID) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Announcement_Status Modal -->

<div class="modal fade" id="createHousehold_Info" tabindex="-1" role="dialog" aria-labelledby="createHousehold_Info" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier" id="Modal_Title">Create Household Profile</h4>
            </div>
            <div class="modal-body">
                <form id="newHousehold" method="POST" action="{{ route('create_household_information') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Household Information</h3>
                        <br>
                        <div class="row">
                            <input type="number" class="form-control" id="Household_Profile_ID" name="Household_Profile_ID" hidden>
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="Resident_ID">Inhabitant Name</label>
                                <select class="form-control" id="Resident_ID" name="Resident_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($resident as $rs)
                                    <option value="{{ $rs->Resident_ID }}">{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Household_Monthly_Income">Household Monthly Income</label>
                                <input type="number" class="form-control" id="Household_Monthly_Income" name="Household_Monthly_Income" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Family Position</label>
                                <select class="form-control" id="Family_Position_ID" name="Family_Position_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($family_position as $fp)
                                    <option value="{{ $fp->Family_Position_ID }}">{{ $fp->Family_Position }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Tenure of Lot</label>
                                <select class="form-control" id="Tenure_of_Lot_ID" name="Tenure_of_Lot_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($tenure_of_lot as $tol)
                                    <option value="{{ $tol->Tenure_of_Lot_ID }}">{{ $tol->Tenure_of_Lot }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Housing_Unit_ID">Housing Unit</label>
                                <select class="form-control" id="Housing_Unit_ID" name="Housing_Unit_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($housing_unit as $hu)
                                    <option value="{{ $hu->Housing_Unit_ID }}">{{ $hu->Housing_Unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Family_Type_ID">Family Type</label>
                                <select class="form-control" id="Family_Type_ID" name="Family_Type_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($family_type as $fm)
                                    <option value="{{ $fm->Family_Type_ID }}">{{ $fm->Family_Type_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Household_Name">Household Name</label>
                                <input type="text" class="form-control" id="Household_Name" name="Household_Name" required>
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



<div class="modal fade" id="print_filter" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier" id="Modal_Title">Filter</h4>
            </div>
            <div class="modal-body">
                <form id="print_report" method="POST" action="{{ route('view_Household') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <input type="checkbox" id="chk_Household_Name" name="chk_Household_Name">
                                <label for="chk_Household_Name">Household Name</label><br>
                                <input type="checkbox" id="chk_Household_Monthly_Income" name="chk_Household_Monthly_Income">
                                <label for="chk_Household_Monthly_Income">Household Monthly Income</label><br>
                                <input type="checkbox" id="chk_Family_Type_Name" name="chk_Family_Type_Name">
                                <label for="chk_Family_Type_Name">Family Type</label><br>
                                <input type="checkbox" id="chk_Tenure_of_Lot" name="chk_Tenure_of_Lot">
                                <label for="chk_Tenure_of_Lot">Tenure of Lot</label><br>
                                <input type="checkbox" id="chk_Housing_Unit" name="chk_Housing_Unit">
                                <label for="chk_Housing_Unit">Housing Unit</label><br>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <center>
                            <button type="submit" class="btn btn-primary" style="width: 200px;">Print</button>
                        </center>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="download_filter" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier" id="Modal_Title">Filter</h4>
            </div>
            <div class="modal-body">
                <form id="download_report" method="POST" action="{{ route('download_Household') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <input type="checkbox" id="1chk_Household_Name" name="chk_Household_Name">
                                <label for="1chk_Household_Name">Household Name</label><br>
                                <input type="checkbox" id="1chk_Household_Monthly_Income" name="chk_Household_Monthly_Income">
                                <label for="1chk_Household_Monthly_Income">Household Monthly Income</label><br>
                                <input type="checkbox" id="1chk_Family_Type_Name" name="chk_Family_Type_Name">
                                <label for="1chk_Family_Type_Name">Family Type</label><br>
                                <input type="checkbox" id="1chk_Tenure_of_Lot" name="chk_Tenure_of_Lot">
                                <label for="1chk_Tenure_of_Lot">Tenure of Lot</label><br>
                                <input type="checkbox" id="1chk_Housing_Unit" name="chk_Housing_Unit">
                                <label for="1chk_Housing_Unit">Housing Unit</label><br>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <center>
                            <button type="submit" class="btn btn-primary" style="width: 200px;">Download</button>
                        </center>

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
        $('#newHousehold').trigger("reset");
        $('#Modal_Title').text('Create Household Profile');
    });

    // Edit Button Display Modal
    $(document).on('click', ('.edit_household'), function(e) {

        var disID = $(this).val();
        $('#Modal_Title').text('Edit Household Profile');



        $.ajax({
            url: "/get_household_info",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Household_Profile_ID').val(data['theEntry'][0]['Household_Profile_ID']);
                $('#Resident_ID').val(data['theEntry'][0]['Resident_ID']);
                $('#Household_Monthly_Income').val(data['theEntry'][0]['Household_Monthly_Income']);
                $('#Household_Name').val(data['theEntry'][0]['Household_Name']);
                $('#Family_Position_ID').val(data['theEntry'][0]['Family_Position_ID']);
                $('#Tenure_of_Lot_ID').val(data['theEntry'][0]['Tenure_of_Lot_ID']);
                $('#Housing_Unit_ID').val(data['theEntry'][0]['Housing_Unit_ID']);
                $('#Family_Type_ID').val(data['theEntry'][0]['Family_Type_ID']);
            }
        });


    });
</script>

<style>
    /* table {
        display: block;
        overflow-x: scroll;
    } */
</style>

@endsection