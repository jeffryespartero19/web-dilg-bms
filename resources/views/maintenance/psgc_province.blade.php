@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Province Maintenance/Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Province Maintenance/Setup</li>
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
                                <div style="padding: 2px;"><button class="btn btn-success" data-toggle="modal" data-target="#createFrequency">New</button></div>
                                <!-- <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Print</button></div>
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div> -->
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Province ID </th>
                                            <th>Province</th>
                                            <th>Active</th>
                                            <th>Encoder ID</th>
                                            <th>Date Stamp</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr">{{$x->Province_ID}}</td>
                                            <td>{{$x->Province_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Encoder_ID}}</td>
                                            <td class="md_data_col txtCtr">{{$x->Date_Stamp}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_province btn btn-info" value="{{$x->Province_ID}}" data-toggle="modal" data-target="#updateFrequency">Edit</button>
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

<!-- Create Frequency Modal -->
<div class="modal fade" id="createFrequency" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create New Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newBRGY_Frequency" method="POST" action="{{ route('create_province_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <div class="form-group">
                            <label>PSGC Code:</label>
                            <input class="form-control" name="PSGC_CodeX">
                        </div>
                        <div class="form-group">
                            <label >Region</label>
                            <select class="form-control" name="Region_IDX" required>
                                <option value='' disabled selected>Select Option</option>

                                @foreach($region as $region)
                                <option value="{{ $region->Region_ID }}">{{ $region->Region_Name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Province:</label>
                            <input class="form-control" name="ProvinceX">
                        </div>
                        

                        <div class="form-group">
                            <label>Active:</label>
                            <select class="form-control" name="ActiveX">
                                <option value=1 hidden selected>Is Active?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn postThis_Frequency modal_sb_button">Create</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Create Frequency END -->

<!-- Edit/Update Frequency Modal -->
<div class="modal fade" id="updateFrequency" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Update Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="updateBRGY_Frequency" method="POST" action="{{ route('update_province_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <input id="this_province_idX" class="form-control" name="Province_idX" hidden>
                    <div class="modal_input_container">
                        <div class="form-group">
                            <label>Country Code:</label>
                            <input id="this_psgc_codeX" class="form-control" name="PSGC_CodeX2">
                        </div>
                    
                        <div class="form-group">
                            <label>Region:</label>
                            <select class="form-control" id="region_update_select" name="Region_IDX2">
                                <option id="this_region_idX" value='' hidden selected>Select</option>
                               
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Province:</label>
                            <input id="this_provinceX" class="form-control" name="ProvinceX2">
                        </div>
                        

                        <div class="form-group">
                            <label>Active:</label>
                            <select class="form-control" name="ActiveX2">
                                <option id="this_province_active" value=1 hidden selected>Is Active?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn updateThis_Frequency modal_sb_button">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Edit/Update Frequency END -->

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
        $('#example2').DataTable();
        $('#example3').DataTable();
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.psgc3').addClass('active');
        $('.psgc_menu').addClass('active');
        $('.psgc_main').addClass('menu-open');
    });
</script>

@endsection