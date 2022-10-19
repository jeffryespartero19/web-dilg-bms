@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bins.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inventory</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Inventory</li>
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
                                            <th style="width:10%;">Inventory <br>ID</th>
                                            <th>Stock No.</th>
                                            <th style="width:10%;">Name</th>
                                            <th>Item <br>Category</th>
                                            <th>Unit of <br>Measure</th>
                                            <th>Item <br>Status</th>
                                            <th>Date <br>Recieved</th>
                                            <th>Remarks</th>
                                            <th>Location</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr">{{$x->Inventory_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Stock_No}}</td>
                                            <td>{{$x->Inventory_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Item_Category_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Unit_of_Measure}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Item_Status}}</td>
                                            <td class="md_data_col txtCtr">{{$x->Date_Received}}</td>
                                            <td class="md_data_col txtCtr">{{$x->Remarks}}</td>
                                            <td class="md_data_col txtCtr">
                                                {{$x->Barangay_Name}}, {{$x->City_Municipality_Name}} {{$x->Province_Name}} {{$x->Region_Name}}
                                            </td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_XYZ" value="{{$x->Inventory_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bins_inventory') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">

                        <div class="form-group">
                            <label>Stock No. :</label>
                            <input class="form-control" name="Stock_No">
                        </div>

                        <div class="form-group">
                            <label>Name:</label>
                            <input class="form-control" name="Inventory_Name">
                        </div>


                        <div class="form-group">
                            <label>Card File:</label>
                            <select class="form-control" name="Card_File_ID">
                                <option value=0 hidden>Select</option>
                                @foreach($card_file as $cf)
                                <option value="{{$cf->Card_File_ID}}">{{$cf->Last_Name}}, {{$cf->First_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Item Category:</label>
                            <select class="form-control" name="Item_Category_ID">
                                <option value=0 hidden>Select</option>
                                @foreach($item_category_list as $icl)
                                <option value="{{$icl->Item_Category_ID}}">{{$icl->Item_Category_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Unit of Measure:</label>
                            <select class="form-control" name="Unit_of_Measure_ID">
                                <option value=0 hidden>Select</option>
                                @foreach($uom_list as $uom)
                                <option value="{{$uom->Unit_of_Measure_ID}}">{{$uom->Unit_of_Measure}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Item Status:</label>
                            <select class="form-control" name="Item_Status_ID">
                                <option value=0 hidden>Select</option>
                                @foreach($item_status_list as $isl)
                                <option value="{{$isl->Item_Status_ID}}">{{$isl->Item_Status}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Date Recieved:</label>
                            <input class="form-control" name="Date_Received" type="date">
                        </div>
                        <div class="form-group">
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
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Update Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="updateEntryXYZ" method="POST" action="{{ route('update_bins_inventory') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <input id="this_identifier" value=12 hidden>
                <input id="this_idX" value="" hidden name="IDx">
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <div class="form-group">
                            <label>Stock No. :</label>
                            <input id="this_stock_no" class="form-control" name="Stock_No2">
                        </div>

                        <div class="form-group">
                            <label>Name:</label>
                            <input id="this_inventory_name" class="form-control" name="Inventory_Name2">
                        </div>


                        <div class="form-group">
                            <label>Card File:</label>
                            <select class="form-control" name="Card_File_ID2">
                                <option id="this_card_file" value=0 hidden>Select</option>
                                @foreach($card_file as $cf)
                                <option value="{{$cf->Card_File_ID}}">{{$cf->Last_Name}}, {{$cf->First_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Item Category:</label>
                            <select class="form-control" name="Item_Category_ID2">
                                <option id="this_item_cartegory" value=0 hidden>Select</option>
                                @foreach($item_category_list as $icl)
                                <option value="{{$icl->Item_Category_ID}}">{{$icl->Item_Category_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Unit of Measure:</label>
                            <select class="form-control" name="Unit_of_Measure_ID2">
                                <option id="this_uom" value=0 hidden>Select</option>
                                @foreach($uom_list as $uom)
                                <option value="{{$uom->Unit_of_Measure_ID}}">{{$uom->Unit_of_Measure}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Item Status:</label>
                            <select class="form-control" name="Item_Status_ID2">
                                <option id="this_item_status" value=0 hidden>Select</option>
                                @foreach($item_status_list as $isl)
                                <option value="{{$isl->Item_Status_ID}}">{{$isl->Item_Status}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Date Recieved:</label>
                            <input id="this_date_recieved" class="form-control" name="Date_Received2" onfocus="(this.type='date')">
                        </div>
                        <div class="form-group">
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

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection