@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Name Prefix Maintenance/Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BIPS</a></li>
                        <li class="breadcrumb-item active">Name Prefix Maintenance/Setup</li>
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
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-success" data-target="#createName_Prefix" style="width: 100px;">New</button></div>
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name Prefix ID </th>
                                            <th>Name Prefix</th>
                                            <th>Active</th>
                                            <th>Encoder ID</th>
                                            <th>Date Stamp</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr">{{$x->Name_Prefix_ID}}</td>
                                            <td>{{$x->Name_Prefix}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Encoder_ID}}</td>
                                            <td class="md_data_col txtCtr">{{$x->Date_Stamp}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_name_prefix btn btn-info" value="{{$x->Name_Prefix_ID}}" data-toggle="modal" data-target="#updateName_Prefix">Edit</button>
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

<!-- Create Name_Prefix Modal -->
<div class="modal fade" id="createName_Prefix" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create New Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newBRGY_Name_Prefix" method="POST" action="{{ route('create_name_prefix_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <div class="form-group">
                            <label>Name Prefix:</label>
                            <input class="form-control" name="Name_PrefixX">
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
                    <button type="button" class="btn postThis_Name_Prefix modal_sb_button">Create</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Create Name_Prefix END -->

<!-- Edit/Update Name_Prefix Modal -->
<div class="modal fade" id="updateName_Prefix" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Update Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="updateBRGY_Name_Prefix" method="POST" action="{{ route('update_name_prefix_maint') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <div class="form-group">
                            <label>Name Prefix:</label>
                            <input id="this_name_prefix_idX" class="form-control" name="Name_Prefix_idX" hidden>
                            <input id="this_name_prefixX" class="form-control" name="Name_PrefixX2">
                        </div>

                        <div class="form-group">
                            <label>Active:</label>
                            <select class="form-control" name="ActiveX2">
                                <option id="this_name_prefix_active" value=1 hidden selected>Is Active?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn updateThis_Name_Prefix modal_sb_button">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Edit/Update Name_Prefix END -->

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.mI4').addClass('active');
        $('.minhabitants_menu').addClass('active');
        $('.minhabitants_main').addClass('menu-open');
    });
</script>



@endsection