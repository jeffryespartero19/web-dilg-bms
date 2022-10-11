@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inhabitants Household List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Inhabitants Household List</li>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="text-align: right;">
                            <div class="btn-group">
                                <div style="padding: 2px;"><a class="btn btn-success" href="{{ url('inhabitants_household_details/0') }}" style="width: 100px;">New</a></div>
                                <!-- <div class="txtRight" style="margin-left: 5px;"><a href="{{ url('view_Ordinance') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div> -->
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Print</button></div>
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div>
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12">
                                <div class="table-responsive">
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


<div class="modal fade" id="print_filter" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="print_report" method="POST" action="{{ route('view_Household') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

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

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="download_filter" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="download_report" method="POST" action="{{ route('download_Household') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

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