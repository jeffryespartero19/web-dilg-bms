@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Business Type Maintenance/Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BCPIS</a></li>
                        <li class="breadcrumb-item active">Business Type Maintenance/Setup</li>
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
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-success" data-target="#createBusiness_Type">New</button></div>
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">

                            <div class="col-md-12 table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>Business Type ID </th>
                                            <th>Business Type</th>
                                            <th>Active</th>
                                            <th hidden>Encoder ID</th>
                                            <th>Date Stamp</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr" hidden>{{$x->Business_Type_ID}}</td>
                                            <td>{{$x->Business_Type}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                                            <td class="sm_data_col txtCtr" hidden>{{$x->Encoder_ID}}</td>
                                            <td class="md_data_col txtCtr">{{$x->Date_Stamp}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_business_type btn btn-info" value="{{$x->Business_Type_ID}}" data-toggle="modal" data-target="#updateBusiness_Type">Edit</button>
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

<!-- Create Business_Type Modal -->
<div class="modal fade" id="createBusiness_Type" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create Post</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="new_Business_Type" method="POST" action="{{ route('create_business_type') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Business Type:</label>
                            <input class="form-control" name="Business_TypeX">
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
                    <button type="submit" class="btn postThis_Business_Type modal_sb_button">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>


<!-- Create Document_Type END -->

<!-- Edit/Update Type_of_Ordinance Modal -->
<div class="modal fade" id="updateBusiness_Type" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Update Post</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="update_Business_Type" method="POST" action="{{ route('update_business_type') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Business Type:</label>
                            <input id="this_business_type_idX" class="form-control" name="Business_Type_idX" hidden>
                            <input id="this_business_typeX" class="form-control" name="Business_TypeX2">
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Active:</label>
                            <select class="form-control" name="ActiveX2">
                                <option id="this_business_type_active" value=1 hidden selected>Is Active?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn updateThis_Business_Type modal_sb_button">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<!-- Edit/Update Document_Type END -->
<script>
    $(document).on('click', '.postThis_Business_Type', function (e) {
    $('#new_Business_Type').submit();
});

$(document).on('click', ('.edit_business_type'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_business_type",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_business_type_idX').val(data['theEntry'][0]['Business_Type_ID']);
            $('#this_business_typeX').val(data['theEntry'][0]['Business_Type']);

            $('#this_business_type_active').empty();
            $('#this_business_type_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_business_type_active').append('Yes');
            } else {
                $('#this_business_type_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Business_Type', function (e) {
    $('#update_Business_Type').submit();
});

    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.mC2').addClass('active');
        $('.mCert_menu').addClass('active');
        $('.mCert_main').addClass('menu-open');
    });
</script>
@endsection

