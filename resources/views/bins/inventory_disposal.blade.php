@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bins.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inventory Disposal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Inventory Disposal</li>
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
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-success" data-target="#createXYZ" style="width: 100px;">New</button></div>
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            {{-- <th>Disposal Inventory ID</th> --}}
                                            <th>Serial</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Date Disposed</th>
                                            <th>Item Status</th>
                                            <th>Remarks</th>
                                            <th>Disposed By</th>
                                            <th>Encoder</th>
                                            <th>Date Stamp</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            {{-- <td class="sm_data_col txtCtr">{{$x->Disposal_Inventory_ID}}</td> --}}
                                            <td class="sm_data_col txtCtr">{{$x->Stock_No}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Inventory_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Quantity_Disposed}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Date_Disposed}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Item_Status}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Remarks}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->name}}</td>
                                            <td class="md_data_col txtCtr">{{$x->Date_Stamp}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_XYZ" value="{{$x->Disposal_Inventory_ID }}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
                                                <button class="delRec" value="{{$x->Disposal_Inventory_ID}}" data-toggle="modal" data-target="#deleteFile">Delete</button>
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

<!-- Create  Modal -->
<div class="modal fade" id="createXYZ" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create New Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bins_inv_disposal') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <div class="form-group">
                            <i class="fa fa-plus-square thisAdd" style="font-size: 25px"></i>
                            
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Inventory Item</th>
                                        <th>Quantity Disposed</th>
                                    </tr>
                                </thead>
                                <tbody class="multiX">
                                    <tr>
                                        <td>
                                            <select class="form-control" name="item_ID[]">
                                                <option value=1 hidden selected>Select</option>
                                                @foreach($inventory_list as $inv)
                                                <option value="{{$inv->Inventory_ID}}">({{$inv->Stock_No}}) {{$inv->Inventory_Name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="Quantity_Disposed[]">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="form-group">
                            <label>Item Status:</label>
                            <select class="form-control" name="item_status_ID">
                                <option value=1 hidden selected>Select</option>
                                @foreach($item_status_list as $isl)
                                <option value="{{$isl->Item_Status_ID}}">{{$isl->Item_Status}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Date Disposed:</label>
                            <input type="date" class="form-control" name="Date_Disposed">
                        </div>

                        <div class="form-group">
                            <label>Remarks:</label>
                            <textarea name="remarks" style="width:100%"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Disposed By:</label>
                            <select class="form-control" name="oic">
                                <option value=1 hidden selected>Select</option>
                                @foreach($staff_list as $sl)
                                <option value="{{$sl->Brgy_Officials_and_Staff_ID}}">Sample</option>
                                @endforeach
                            </select>
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
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Update Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="updateEntryXYZ" method="POST" action="{{ route('update_bins_inv_disposal') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <input id="this_identifier" value="10" hidden>
                        <input id="this_inv_disposal_IdX" class="form-control" name="Disposal_ID" hidden>
                        <div class="form-group">
                            <label>Inventory Item:</label>
                            <select class="form-control" name="item_ID2">
                                <option id="this_item_idX" value=1 hidden selected>Select</option>
                                @foreach($inventory_list as $inv)
                                <option value="{{$inv->Inventory_ID}}">({{$inv->Stock_No}}) {{$inv->Inventory_Name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Quantity Disposed:</label>
                            <input id="this_quantity_disposed" type="number" class="form-control" name="Quantity_Disposed2">
                        </div>

                        <div class="form-group">
                            <label>Item Status:</label>
                            <select class="form-control" name="item_status_ID2">
                                <option id="this_item_status_idX" value=1 hidden selected>Select</option>
                                @foreach($item_status_list as $isl)
                                <option value="{{$isl->Item_Status_ID}}">{{$isl->Item_Status}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Date Disposed:</label>
                            <input id="this_date_disposed" class="form-control" name="Date_Disposed2" onfocus="(this.type='date')">
                        </div>

                        <div class="form-group">
                            <label>Remarks:</label>
                            <textarea id="this_remarks" name="remarks2" style="width:100%"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Disposed By:</label>
                            <select class="form-control" name="oic2">
                                <option id="this_oic" value=1 hidden selected>Select</option>
                                @foreach($staff_list as $sl)
                                <option value="{{$sl->Brgy_Officials_and_Staff_ID}}">Sample</option>
                                @endforeach
                            </select>
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

<!-- Edit/Update  END -->

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

                <input id="del_ident" value="10" class="" name="del_ident" hidden>
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
        $('.inventoryDispo').addClass('active');
        $('.inventory_menu').addClass('active');
        $('.inventory_main').addClass('menu-open');
    });
</script>
@endsection