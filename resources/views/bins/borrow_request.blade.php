@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bins.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Borrow Request</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Borrow Request</li>
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
                                            {{-- <th>Borrowed Equipment ID</th> --}}
                                            {{-- <th>Equipment Request ID</th> --}}
                                            <th>Series</th>
                                            <th>Item</th>
                                            <th>Quantity Borrowed</th>
                                            <th>Borrowed By</th>
                                            <th>Borrowed Equipmnet Status</th>
                                            <th>Encoder</th>
                                            <th>Date Stamp</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            {{-- <td class="sm_data_col txtCtr">{{$x->Borrowed_Equipment_ID }}</td> --}}
                                            {{-- <td class="sm_data_col txtCtr">{{$x->Equipment_Request_ID}}</td> --}}
                                            <td class="sm_data_col txtCtr">{{$x->Stock_No}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Inventory_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Quantity_Borrowed}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Last_Name}}, {{$x->First_Name}} {{$x->Middle_Name}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <table>
                                                    <tr>
                                                        <td>Date Borrowed</td>
                                                        <td>Est. Return Date</td>
                                                        <td>Item Status</td>
                                                        <td>Date Returned</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{$x->Date_Borrowed}}</td>
                                                        <td>{{$x->Expected_Return_Date}}</td>
                                                        <td>{{$x->Item_Status}}</td>
                                                        <td>{{$x->Date_Returned}}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="sm_data_col txtCtr">{{$x->name}}</td>
                                            <td class="md_data_col txtCtr">{{$x->Date_Stamp}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_XYZ" value="{{$x->Borrowed_Equipment_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
                                                <button class="delRec" value="{{$x->Borrowed_Equipment_ID}}" data-toggle="modal" data-target="#deleteFile">Delete</button>
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
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bins_borrow') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <div class="form-group">
                            <i class="fa fa-plus-square thisAdd" style="font-size: 25px"></i>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Item to Borrow</th>
                                        <th>Quantity</th>
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
                                            <input name="Quantity_Borrowed[]" type="number" style="width:100%" class="form-control">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
                            <label>Resident:</label>
                            <select class="form-control" name="Resident_ID">
                                <option value=1 hidden selected>Select</option>
                                @foreach($resident_list as $rl)
                                <option value="{{$rl->Resident_ID}}">{{$rl->Last_Name}}, {{$rl->First_Name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Purpose:</label>
                            <textarea name="Purpose" style="width:100%"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Remarks:</label>
                            <textarea name="Remarks" style="width:100%"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Item Status:</label>
                            <select class="form-control" name="item_Status_ID">
                                <option value=1 hidden selected>Select</option>
                                @foreach($item_status_list as $isl)
                                <option value="{{$isl->Item_Status_ID}}">{{$isl->Item_Status}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Date Borrowed:</label>
                            <input name="Date_Borrowed" type="date" style="width:100%">
                        </div>
                        <div class="form-group">
                            <label>Expected Return Date:</label>
                            <input name="Expected_Return_Date" type="date" style="width:100%">
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
            <form id="updateEntryXYZ" method="POST" action="{{ route('update_bins_borrow') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <input id="this_identifier" value="11" hidden>
                        <input id="this_borrow_IdX" class="form-control" name="Equipment_Request_ID" value="" hidden>
                        <div class="form-group">
                            <label>Item to Borrow:</label>
                            <select class="form-control" name="item_ID2">
                                <option id="this_item_idX" value="" hidden selected></option>
                                @foreach($inventory_list as $inv)
                                    <option value="{{$inv->Inventory_ID}}">{{$inv->Inventory_Name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Quantity:</label>
                            <input id="this_qty_borrowed" name="Quantity_Borrowed2" type="number" style="width:100%">
                        </div>

                        <div class="form-group">
                            <label>Resident:</label>
                            <select class="form-control" name="Resident_ID2">
                                <option id="this_ResidentX" value="" hidden selected>Select</option>
                                @foreach($resident_list as $rl)
                                <option value="{{$rl->Resident_ID}}">{{$rl->Last_Name}}, {{$rl->First_Name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Purpose:</label>
                            <textarea id="this_pupose" name="Purpose2" style="width:100%"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Remarks:</label>
                            <textarea id="this_remarks" name="Remarks2" style="width:100%"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Item Status:</label>
                            <select class="form-control" name="item_Status_ID2">
                                <option id="this_item_status_idX" value=1 hidden selected>Select</option>
                                @foreach($item_status_list as $isl)
                                <option value="{{$isl->Item_Status_ID}}">{{$isl->Item_Status}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Date Borrowed:</label>
                            <input id="thisBorrowDate" class="dateX_input" name="Date_Borrowed2" style="width:100%" onfocus="(this.type='date')">
                        </div>
                        <div class="form-group">
                            <label>Expected Return Date:</label>
                            <input id="thisEstReturnDate" class="dateX_input" name="Expected_Return_Date2" style="width:100%" onfocus="(this.type='date')">
                        </div>
                        <div class="form-group">
                            <label>Date Returned:</label>
                            <input id="thisDateReturned" class="dateX_input" name="Date_Returned2" style="width:100%" onfocus="(this.type='date')">
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

                <input id="del_ident" value="11" class="" name="del_ident" hidden>
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
        $('.EquipBorrow').addClass('active');
        $('.inventory_menu').addClass('active');
        $('.inventory_main').addClass('menu-open');
    });
</script>
@endsection