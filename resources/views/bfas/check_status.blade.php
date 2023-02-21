@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Check Status Cleared/Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Check Status Cleared/Setup</li>
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
                                <div style="padding: 2px;"><button class="btn btn-success" data-toggle="modal" data-target="#createXYZ">New</button></div>
                                <!-- <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Print</button></div>
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div> -->
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <table id="example" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            {{-- <th>Check Status Cleared <br>ID</th> --}}
                                            <th>Voucher No</th>
                                            <th>Cleared Date</th>
                                            <th>Remarks</th>
                                            <th>Encoder ID</th>
                                            <th>Date Stamp</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            {{-- <td class="sm_data_col txtCtr">{{$x->Check_Status_Cleared_ID}}</td> --}}
                                            <td class="sm_data_col txtCtr">{{$x->Voucher_No}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Cleared_Date}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Remarks}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Date_Stamp}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_XYZ" value="{{$x->Check_Status_Cleared_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
                                                <button class="delRec" value="{{$x->Check_Status_Cleared_ID}}" data-toggle="modal" data-target="#deleteFile">Delete</button>
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


<!-- Create Modal -->
<div class="modal fade" id="createXYZ" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create New Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_check_status') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">

                    <div class="modal_input_container row">
                        <div class="form-group col-lg-6">
                            <label>Voucher No :</label>
                            <select class="form-control" name="Check_Preparation_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($check_prep as $c_prep)
                                <option value={{$c_prep->Check_Preparation_ID}}>{{$c_prep->Voucher_No}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Cleared Date:</label>
                            <input type="datetime-local" class="form-control" name="Cleared_Date">
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Remarks:</label>
                            <textarea class="form-control" name="Remarks"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn postThis_XYZ modal_sb_button">Create</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Create  END -->

<!-- Edit/Update  Modal -->
<div class="modal fade" id="updateXYZ" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Update Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_check_status') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <input id="this_identifier" value=7 hidden>
                <input id="this_idX" value="" hidden name="IDx">
                <div class="modal-body Absolute-Center">

                    <div class="modal_input_container row">
                        <div class="form-group col-lg-6">
                            <label>Voucher No:</label>
                            <select class="form-control" name="Check_Preparation_ID2">
                                <option id="this_check_prep" value='' hidden selected>Select</option>
                                @foreach($check_prep as $c_prep)
                                <option value={{$c_prep->Check_Preparation_ID}}>{{$c_prep->Voucher_No}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Cleared Date:</label>
                            <input id="this_cleared_date" type="datetime-local" class="form-control" name="Cleared_Date2">
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Remarks:</label>
                            <textarea id="this_remarks" class="form-control" name="Remarks2"></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn updateThis_XYZ modal_sb_button">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Edit/Update END -->

<!-- Delete -->
<div id="deleteFile" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:30%;">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h5 style="color:salmon;">Are you sure you want to delete this Record ?</h5>
        </div>
        <div class="modal-footer">
            <form method="POST" action="{{ route('del_rec') }}"> @csrf

                <input id="del_ident" value="33" class="" name="del_ident" hidden>
                <input id="delFile" value="" class="" name="id_del" hidden>
                <button type="submit">Confirm</button>
            </form>
        </div>
      </div>
  
    </div>
</div>
<!-- End Delete -->

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.checkStatusClear').addClass('active');
        $('.accounting_menu').addClass('active');
        $('.accounting_main').addClass('menu-open');
    });
</script>

@endsection