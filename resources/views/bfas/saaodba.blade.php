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
                                            <th>Obligation Request</th>
                                            <th>Fund</th>
                                            <th>As of</th>
                                            <th>Officer in Charge</th>
                                            <th>Account</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr">{{$x->Obligation_Request_No}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Fund_Type}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->SAAODBA_As_of}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Last_Name2}}, {{$x->First_Name2}} {{$x->Middle_Name2}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Account_Name}}</td>

                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_XYZ" value="{{$x->SAAODBA_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
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
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_SAAODBA') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">

                    <div class="modal_input_container row">
                        <div class="form-group col-lg-6">
                            <label>Obligation Request:</label>
                            <select class="form-control" name="Obligation_Request_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($obr as $o)
                                <option value={{$o->Obligation_Request_ID}}>{{$o->Obligation_Request_No}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Fund:</label>
                            <select class="form-control" name="Fund_Type_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($fundX as $fx)
                                <option value={{$fx->Fund_Type_ID}}>{{$fx->Fund_Type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>As of:</label>
                            <input type="date" class="form-control" name="SAAODBA_As_of">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Officer in Charge:</label>
                            <select class="form-control" name="Brgy_Officials_and_Staff_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($oic as $xz)
                                <option value={{$xz->Card_File_ID}}>{{$xz->Last_Name}}, {{$xz->First_Name}} {{$xz->Middle_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Accounts:</label>
                            <select class="form-control" name="Accounts_Information_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($accounts as $acc)
                                <option value={{$acc->Accounts_Information_ID}}>{{$acc->Account_Name}}</option>
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
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title flexer justifier">Update Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_SAAODBA') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <input id="this_identifier" value=12 hidden>
                <input id="this_idX" value="" hidden name="IDx">
                <div class="modal-body Absolute-Center">

                    <div class="modal_input_container row">

                        <div class="form-group col-lg-6">
                            <label>Obligation Request:</label>
                            <select class="form-control" name="Obligation_Request_ID2">
                                <option id="this_obr" value='' hidden selected>Select</option>
                                @foreach($obr as $o)
                                <option value={{$o->Obligation_Request_ID}}>{{$o->Obligation_Request_No}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Fund:</label>
                            <select class="form-control" name="Fund_Type_ID2">
                                <option id="this_fund_type_id" value='' hidden selected>Select</option>
                                @foreach($fundX as $fx)
                                <option value={{$fx->Fund_Type_ID}}>{{$fx->Fund_Type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>As of:</label>
                            <input id="this_asof" type="date" class="form-control" name="SAAODBA_As_of2">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Officer in Charge:</label>
                            <select class="form-control" name="Brgy_Officials_and_Staff_ID2">
                                <option id="this_oic" value='' hidden selected>Select</option>
                                @foreach($oic as $xz)
                                <option value={{$xz->Card_File_ID}}>{{$xz->Last_Name}}, {{$xz->First_Name}} {{$xz->Middle_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Accounts:</label>
                            <select class="form-control" name="Accounts_Information_ID2">
                                <option id="this_account" value='' hidden selected>Select</option>
                                @foreach($accounts as $acc)
                                <option value={{$acc->Accounts_Information_ID}}>{{$acc->Account_Name}}</option>
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