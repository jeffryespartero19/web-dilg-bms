@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Status of Ordinance Maintenance/Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BORIS</a></li>
                        <li class="breadcrumb-item active">Status of Ordinance Maintenance/Setup</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
</div> 
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="text-align: right;">
                            <div class="btn-group">
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-success" data-target="#createStatus_of_Ordinance">New</button></div>
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">

                            <div class="col-md-12 table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Status of Ordinance ID </th>
                                            <th>Status of Ordinance Name</th>
                                            <th>Active</th>
                                            <th>Encoder ID</th>
                                            <th>Date Stamp</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr">{{$x->Status_of_Ordinance_or_Resolution_ID}}</td>
                                            <td>{{$x->Name_of_Status}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Encoder_ID}}</td>
                                            <td class="md_data_col txtCtr">{{$x->Date_Stamp}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_status_of_ordinance btn-info" value="{{$x->Status_of_Ordinance_or_Resolution_ID}}" data-toggle="modal" data-target="#updateStatus_of_Ordinance">Edit</button>
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

<!-- Create Document_Type Modal -->
<div class="modal fade" id="createStatus_of_Ordinance" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create Post</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newBRGY_Status_of_Ordinance" method="POST" action="{{ route('create_status_of_ordinance_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Status of Ordinance:</label>
                            <input class="form-control" name="Status_of_OrdinanceX">
                        </div>

                        <div class="form-group col-lg-12">
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
                    <button type="submit" class="btn postThis_Status_of_Ordinance modal_sb_button">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Create Status_of_Ordinance END -->

<!-- Create Document_Type END -->

<!-- Edit/Update Type_of_Ordinance Modal -->
<div class="modal fade" id="updateStatus_of_Ordinance" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Update Post</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="updateBRGY_Status_of_Ordinance" method="POST" action="{{ route('update_status_of_ordinance_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Status of Ordinance:</label>
                            <input id="this_status_of_ordinance_idX" class="form-control" name="Status_of_Ordinance_or_Resolution_IDX2" hidden>
                            <input id="this_status_of_ordinanceX" class="form-control" name="Status_of_OrdinanceX2">
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Active:</label>
                            <select class="form-control" name="ActiveX2">
                                <option id="this_document_type_active" value=1 hidden selected>Is Active?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn updateThis_Status_of_Ordinance modal_sb_button">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>


<!-- Edit/Update Status_of_Ordinance END -->

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.mboris2').addClass('active');
        $('.mboris_menu').addClass('active');
        $('.mboris_main').addClass('menu-open');
    });
</script>

@endsection