@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brgy. Position Maintenance/Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BIPS</a></li>
                        <li class="breadcrumb-item active">Brgy. Position Maintenance/Setup</li>
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
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-success" data-target="#createBrgy_Position">New</button></div>
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">

                            <div class="col-md-12 table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Brgy. Position ID </th>
                                            <th>Brgy. Position</th>
                                            <th>Active</th>
                                            <th>Encoder ID</th>
                                            <th>Date Stamp</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td hidden class="sm_data_col txtCtr">{{$x->Brgy_Position_ID}}</td>
                                            <td>{{$x->Brgy_Position}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Encoder_ID}}</td>
                                            <td class="md_data_col txtCtr">{{$x->created_at}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_brgy_position btn btn-info" value="{{$x->Brgy_Position_ID}}" data-toggle="modal" data-target="#updateBrgy_Position">Edit</button>
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
<div class="modal fade" id="createBrgy_Position" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create Post</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newBRGY_Brgy_Position" method="POST" action="{{ route('create_brgy_position_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Brgy. Position:</label>
                            <input class="form-control" name="Brgy_PositionX">
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
                    <button type="submit" class="btn postThis_Brgy_Position modal_sb_button">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Create Document_Type END -->

<!-- Edit/Update Type_of_Ordinance Modal -->
<div class="modal fade" id="updateBrgy_Position" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create Post</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="updateBRGY_Brgy_Position" method="POST" action="{{ route('update_brgy_position_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Brgy. Position:</label>
                            <input id="this_brgy_position_idX" class="form-control" name="Brgy_Position_idX" hidden>
                            <input id="this_brgy_positionX" class="form-control" name="Brgy_PositionX2">
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Active:</label>
                            <select class="form-control" name="ActiveX2">
                                <option id="this_brgy_position_active" value=1 hidden selected>Is Active?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn updateThis_Brgy_Position modal_sb_button">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Create Document_Type END -->

<!-- Edit/Update Type_of_Ordinance Modal -->
<div class="modal fade" id="updateDocument_Type" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Update Post</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="update_Document_Type" method="POST" action="{{ route('update_document_type') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Brgy. Position:</label>
                            <input id="this_document_type_idX" class="form-control" name="Document_Type_idX" hidden>
                            <input id="this_document_type_NameX" class="form-control" name="Document_Type_NameX2">
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
                    <button type="submit" class="btn updateThis_Document_Type modal_sb_button">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Edit/Update Type_of_Ordinance END -->

<!-- Edit/Update Document_Type END -->
@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.mI13').addClass('active');
        $('.minhabitants_menu').addClass('active');
        $('.minhabitants_main').addClass('menu-open');
    });
</script>



@endsection
