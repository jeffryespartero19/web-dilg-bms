@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Purpose of Document Maintenance/Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BCPIS</a></li>
                        <li class="breadcrumb-item active">Purpose of Document Maintenance/Setup</li>
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
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-success" data-target="#createPurpose_of_Document">New</button></div>
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">

                            <div class="col-md-12 table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Purpose of Document ID </th>
                                            <th>Purpose of Document</th>
                                            <th>Active</th>
                                            <th hidden>Encoder ID</th>
                                            <th>Date Stamp</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr" hidden>{{$x->Purpose_of_Document_ID}}</td>
                                            <td>{{$x->Purpose_of_Document}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                                            <td class="sm_data_col txtCtr" hidden>{{$x->Encoder_ID}}</td>
                                            <td class="md_data_col txtCtr">{{$x->Date_Stamp}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_purpose_of_document btn btn-info" value="{{$x->Purpose_of_Document_ID}}" data-toggle="modal" data-target="#updatePurpose_of_Document">Edit</button>
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
<div class="modal fade" id="createPurpose_of_Document" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create Post</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="new_Purpose_of_Document" method="POST" action="{{ route('create_purpose_document') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Purpose of Document:</label>
                            <input class="form-control" name="Purpose_of_DocumentX">
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
                    <button type="submit" class="btn postThis_Purpose_of_Document modal_sb_button">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Create Document_Type END -->

<!-- Edit/Update Type_of_Ordinance Modal -->
<div class="modal fade" id="updatePurpose_of_Document" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Update Post</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="update_Purpose_of_Document" method="POST" action="{{ route('update_purpose_document') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Purpose of Document:</label>
                            <input id="this_purpose_of_document_idX" class="form-control" name="Purpose_of_Document_idX" hidden>
                            <input id="this_purpose_of_documentX" class="form-control" name="Purpose_of_DocumentX2">
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Active:</label>
                            <select class="form-control" name="ActiveX2">
                                <option id="this_purpose_of_document_active" value=1 hidden selected>Is Active?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn updateThis_Purpose_of_Document modal_sb_button">Save</button>
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
    $(document).ready(function() {
        $('#example').DataTable();
    });

    $(document).on('click', '.postThis_Purpose_of_Document', function(e) {
        $('#new_Purpose_of_Document').submit();
    });

    $(document).on('click', ('.edit_purpose_of_document'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_purpose_document",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#this_purpose_of_document_idX').val(data['theEntry'][0]['Purpose_of_Document_ID']);
                $('#this_purpose_of_documentX').val(data['theEntry'][0]['Purpose_of_Document']);

                $('#this_purpose_of_document_active').empty();
                $('#this_purpose_of_document_active').val(data['theEntry'][0]['Active']);
                if (data['theEntry'][0]['Active'] == 1) {
                    $('#this_purpose_of_document_active').append('Yes');
                } else {
                    $('#this_purpose_of_document_active').append('No');
                }

            }
        });


    });

    $(document).on('click', '.updateThis_Purpose_of_Document', function(e) {
        $('#update_Purpose_of_Document').submit();
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.mC1').addClass('active');
        $('.mCert_menu').addClass('active');
        $('.mCert_main').addClass('menu-open');
    });
</script>
@endsection