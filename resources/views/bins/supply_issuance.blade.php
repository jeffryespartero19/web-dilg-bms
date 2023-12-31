@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bins.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Supply Issuance</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Supply Issuance</li>
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
                                {{-- <div class="eighty_split">{{$db_entries->appends(['db_entries' => $db_entries->currentPage()])->links()}}</div> --}}
                                <div class="twenty_split txtRight"><button data-toggle="modal" data-target="#createXYZ">New</button></div>
                            </div> -->
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            {{-- <th>Supply Issuance ID </th> --}}
                                            <th hidden>Item ID</th>
                                            <th>Item Name</th>
                                            <th>Item Status ID</th>
                                            <th>Donation</th>
                                            <th>Brgy Official / Staff ID</th>
                                            <th>Received Quantity</th>
                                            <th>Date Received</th>
                                            <th>Encoder ID</th>
                                            <th>Date Stamp</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            {{-- <td class="sm_data_col txtCtr">{{$x->Received_Item_ID }}</td> --}}
                                            <td class="sm_data_col txtCtr" hidden>{{$x->Inventory_ID }}</td>
                                            <td></td>
                                            <td class="sm_data_col txtCtr">{{$x->Item_Status_ID}}</td>
                                            <td class="sm_data_col txtCtr">@if($x->Donation==1)Yes @else No @endif</td>
                                            <td class="sm_data_col txtCtr">{{$x->Brgy_Officials_and_Staff_ID}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Received_Quantity}}</td>
                                            <td class="md_data_col txtCtr">{{$x->Date_Received}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Encoder_ID}}</td>
                                            <td class="md_data_col txtCtr">{{$x->Date_Stamp}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_XYZ" value="{{$x->Received_Item_ID  }}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bins_received_item') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <div class="form-group">
                            <label>Item:</label>
                            <select class="form-control" name="item_ID">
                                <option value=1 hidden selected>Select</option>
                                @foreach($inventory_list as $invl)
                                <option value="{{$invl->Inventory_ID}}">Sample</option>
                                @endforeach
                            </select>
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
                            <label>Donation:</label>
                            <select class="form-control" name="donationX">
                                <option value=0 hidden selected>Is Donation?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Recieved By:</label>
                            <select class="form-control" name="rc_by">
                                <option value=1 hidden selected>Select</option>
                                @foreach($staff_list as $sl)
                                <option value="{{$sl->Brgy_Officials_and_Staff_ID}}">Sample</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Received_Quantity:</label>
                            <input class="form-control" name="received_qty" type="number">
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
            <form id="updateEntryXYZ" method="POST" action="{{ route('update_bins_received_item') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <input id="this_identifier" value="8" hidden>
                        <input id="this_received_item_IdX" class="form-control" name="Received_Item_ID" hidden>
                        <div class="form-group">
                            <label>Item:</label>
                            <select class="form-control" name="item_ID2">
                                <option id="this_item_idX" value="" hidden selected>Select</option>
                                @foreach($inventory_list as $invl)
                                <option value="{{$invl->Inventory_ID}}">Sample</option>
                                @endforeach
                            </select>
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
                            <label>Donation:</label>
                            <select class="form-control" name="donationX2">
                                <option id="this_donationX" value=0 hidden selected>Is Donation?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Recieved By:</label>
                            <select class="form-control" name="rc_by2">
                                <option id="this_rc_byX" value=1 hidden selected>Select</option>
                                @foreach($staff_list as $sl)
                                <option value="{{$sl->Brgy_Officials_and_Staff_ID}}">Sample</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Received_Quantity:</label>
                            <input id="this_received_qtyX" class="form-control" name="received_qty2" type="number">
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

     // Side Bar Active
     $(document).ready(function() {
        $('.receivedItem').addClass('active');
        $('.inventory_menu').addClass('active');
        $('.inventory_main').addClass('menu-open');
    });
</script>
@endsection