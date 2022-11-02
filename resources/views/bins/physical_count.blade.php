@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bins.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Physical Count</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Physical Count</li>
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
                            <!-- <div class="flexer">
        <div class="eighty_split">{{$db_entries->appends(['db_entries' => $db_entries->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><button data-toggle="modal" data-target="#createXYZ">New</button></div>
    </div> -->
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Physical Count ID </th>
                                            <th>Item Category ID</th>
                                            <th>Physical Count Inventory ID</th>
                                            <th>Transaction No</th>
                                            <th>Particulars</th>
                                            <th>Brgy Official / Staff ID</th>
                                            <th>Encoder ID</th>
                                            <th>Date Stamp</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr">{{$x->Physical_Count_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Item_Category_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Physical_Count_Inventory_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Transaction_No}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Particulars}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Brgy_Officials_and_Staff_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Encoder_ID}}</td>
                                            <td class="md_data_col txtCtr">{{$x->Date_Stamp}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_XYZ" value="{{$x->Physical_Count_ID  }}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bins_physical_count') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <div class="form-group">
                            <label>Physical Count Inventory:</label>
                            <select class="form-control" name="P_item_ID">
                                <option value=1 hidden selected>Select</option>
                                @foreach($P_inventory_list as $P_inv)
                                <option value="{{$P_inv->Physical_Count_Inventory_ID}}">Sample</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Item Category:</label>
                            <select class="form-control" name="item_category_ID">
                                <option value=1 hidden selected>Select</option>
                                @foreach($item_category_list as $icl)
                                <option value="{{$icl->Item_Category_ID}}">{{$icl->Item_Category_Name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Particulars:</label>
                            <textarea name="particulars" style="width:100%"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Officer in Charge:</label>
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
            <form id="updateEntryXYZ" method="POST" action="{{ route('update_bins_physical_count') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <input id="this_identifier" value="9" hidden>
                        <input id="this_physical_count_IdX" class="form-control" name="Physical_Count_ID" hidden>
                        <div class="form-group">
                            <label>Physical Count Inventory:</label>
                            <select class="form-control" name="P_item_ID2">
                                <option id="this_p_inv" value=1 hidden selected>Select</option>
                                @foreach($P_inventory_list as $P_inv)
                                <option value="{{$P_inv->Physical_Count_Inventory_ID}}">Sample</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Item Category:</label>
                            <select class="form-control" name="item_category_ID2">
                                <option id="this_item_category" value=1 hidden selected>Select</option>
                                @foreach($item_category_list as $icl)
                                <option value="{{$icl->Item_Category_ID}}">{{$icl->Item_Category_Name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Particulars:</label>
                            <textarea id="this_particulars" name="particulars2" style="width:100%"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Officer in Charge:</label>
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

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection