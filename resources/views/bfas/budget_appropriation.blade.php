@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Budget Appropriation/Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Budget Appropriation/Setup</li>
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
                                            <th style="width:20%">Location</th>
                                            <th style="width:20%">Details</th>
                                            <th style="width:20%">Tagged Accounts</th>
                                            <th>Particulars</th>
                                            <th style="width:10%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td><b>Barangay: </b></td>
                                                        <td>{{$x->Barangay_Name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>City/Municipaltiy: </b></td>
                                                        <td>{{$x->City_Municipality_Name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Province: </b></td>
                                                        <td>{{$x->Province_Name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Region: </b></td>
                                                        <td>{{$x->Region_Name}}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td><b>App No: </b></td>
                                                        <td>{{$x->Appropriation_No}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Status: </b></td>
                                                        <td>{{$x->Budget_Appropriation_Status}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Budget Year: </b></td>
                                                        <td>{{$x->Budget_Year}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Fund Type: </b></td>
                                                        <td>{{$x->Fund_Type}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>App Date: </b></td>
                                                        <td>{{$x->Appropriation_Date}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>APP Type: </b></td>
                                                        <td>{{$x->Appropriation_Type}}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="sm_data_col txtCtr">
                                                <table>
                                                    <tr>
                                                        <th><b>Account</b></th>
                                                        <th><b>Amount</b></th>
                                                    </tr>
                                                    <tr>
                                                        <td>({{$x->Account_Number}})-{{$x->Account_Name}}</td>
                                                        <td>{{number_format((float)$x->Appropriation_Amount, 2, '.', ',')}}</td>
                                                    </tr>
                                                </table>
                                            </td>

                                            <td class="sm_data_col txtCtr">{{$x->Particulars}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_XYZ" value="{{$x->Budget_Appropriation_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
                                                <button class="tag_XYZ" value="{{$x->Budget_Appropriation_ID}}" data-toggle="modal" data-target="#tagXYZ">Tag</button>
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
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_budget_appropriation') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container row">

                        <div class="form-group col-lg-6">
                            <label>Region:</label>
                            <select class="form-control regionX" name="Region_IDX">
                                <option value='' hidden selected>Select</option>
                                @foreach($regionX as $rx)
                                <option value='{{$rx->Region_ID}}'>{{$rx->Region_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Province:</label>
                            <select class="form-control provX" name="Province_IDX">
                                <option value='' hidden selected>Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>City/Municipality:</label>
                            <select class="form-control cityX" name="City_Municipality_IDX">
                                <option value='' hidden selected>Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Barangay:</label>
                            <select class="form-control brgyX" name="Barangay_IDX">
                                <option value='' hidden selected>Select</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Appropriation No:</label>
                            <input class="form-control" name="Appropriation_No">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Appropriation Status:</label>
                            <select class="form-control" name="Budget_Appropriation_Status_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($bp_status as $bps)
                                <option value={{$bps->Budget_Appropriation_Status_ID}}>{{$bps->Budget_Appropriation_Status}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Budget Year:</label>
                            <select class="form-control" name="Budget_Year">
                                @for($i=2000;$i < 2022; $i++) <option value={{$i}}>{{$i}}</option>
                                    @endfor
                                    <option value=2022 selected>2022</option>
                                    @for($i=2023;$i < 2051; $i++) <option value={{$i}}>{{$i}}</option>
                                        @endfor
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Fund Type:</label>
                            <select class="form-control" name="Fund_Type_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($fund_type as $ft)
                                <option value={{$ft->Fund_Type_ID}}>{{$ft->Fund_Type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Appropriation Date:</label>
                            <input type="date" class="form-control" name="Appropriation_Date">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Appropriation:</label>
                            <select class="form-control" name="Appropriation_Type_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($app_type as $apt)
                                <option value={{$apt->Appropriation_Type_ID}}>{{$apt->Appropriation_Type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Particulars:</label>
                            <textarea class="form-control" name="Particulars"></textarea>
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
            <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_budget_appropriation') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <input id="this_identifier" value=10 hidden>
                <input id="this_idX" value="" hidden name="IDx">
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container row">

                        <div class="form-group col-lg-6">
                            <label>Region:</label>
                            <select class="form-control regionX2" name="Region_IDX2">
                                <option id="this_region" value='' hidden selected>Select</option>
                                @foreach($regionX as $rx)
                                <option value='{{$rx->Region_ID}}'>{{$rx->Region_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Province:</label>
                            <select class="form-control provX2" name="Province_IDX2">
                                <option id="this_province" value='' hidden selected>Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>City/Municipality:</label>
                            <select class="form-control cityX2" name="City_Municipality_IDX2">
                                <option id="this_city" value='' hidden selected>Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Barangay:</label>
                            <select class="form-control brgyX2" name="Barangay_IDX2">
                                <option id="this_barangay" value='' hidden selected>Select</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Appropriation No:</label>
                            <input id="this_appropriation_no" class="form-control" name="Appropriation_No2">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Appropriation Status:</label>
                            <select class="form-control" name="Budget_Appropriation_Status_ID2">
                                <option id="this_appropriation_status" value='' hidden selected>Select</option>
                                @foreach($bp_status as $bps)
                                <option value={{$bps->Budget_Appropriation_Status_ID}}>{{$bps->Budget_Appropriation_Status}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Budget Year:</label>
                            <select class="form-control" name="Budget_Year2">
                                <option id="this_budget_year" value='' hidden selected></option>
                                @for($i=2000;$i < 2022; $i++) <option value={{$i}}>{{$i}}</option>
                                    @endfor
                                    <option value=2022>2022</option>
                                    @for($i=2023;$i < 2051; $i++) <option value={{$i}}>{{$i}}</option>
                                        @endfor
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Fund Type:</label>
                            <select class="form-control" name="Fund_Type_ID2">
                                <option id="this_fund_type_id" value='' hidden selected>Select</option>
                                @foreach($fund_type as $ft)
                                <option value={{$ft->Fund_Type_ID}}>{{$ft->Fund_Type}}</option>
                                @endforeach
                            </select>
                        </div>
                        

                        <div class="form-group col-lg-6">
                            <label>Appropriation Date:</label>
                            <input id="this_appropriation_date" type="date" class="form-control" name="Appropriation_Date2">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Appropriation:</label>
                            <select class="form-control" name="Appropriation_Type_ID2">
                                <option id="this_appropriation_type_id" value='' hidden selected>Select</option>
                                @foreach($app_type as $apt)
                                <option value={{$apt->Appropriation_Type_ID}}>{{$apt->Appropriation_Type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-12">
                            <label>Particulars:</label>
                            <textarea id="this_particulars" class="form-control" name="Particulars2"></textarea>
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

<!-- Tagging  Modal -->
<div class="modal fade" id="tagXYZ" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Tag Entries</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="tagEntryXYZ" method="POST" action="{{ route('tag_bfas_budget_appropriation') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <input id="this_B_IDx" value="" hidden name="B_IDx">
                <div class="modal-body Absolute-Center tagger">
                    <i class="fa fa-plus-square thisAdd" style="font-size: 25px"></i>
                    <div class="modal_input_container row dupli">
                        <div class="form-group col-lg-6">
                            <label>Account:</label>
                            <select class="form-control regionX2" name="tagAccounts_Information_ID[]">
                                <option id="this_region" value='' hidden selected>Select</option>
                                @foreach($accounts as $ac)
                                <option value='{{$ac->Accounts_Information_ID }}'>({{$ac->Account_Number}})-{{$ac->Account_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Amount:</label>
                            <input type="number" class="form-control" name="Appropriation_Amount[]" min="0" step=".01">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn tagThis_XYZ modal_sb_button">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- End Tagging  Modal -->

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.budgetApprop').addClass('active');
        $('.accounting_menu').addClass('active');
        $('.accounting_main').addClass('menu-open');
    });
</script>

@endsection