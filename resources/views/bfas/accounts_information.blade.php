@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/bfas2.js') }}" defer></script>
<link href="{{ asset('/css/bins.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chart of Accounts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">chart_of_accounts</li>
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
                                <div style="display: flex; width:100%;" >
                                    <form  method="GET" action="{{ route('bfas_accounts_information') }}" autocomplete="off" enctype="multipart/form-data">
                                        <input name="determiner" value='Asset' hidden>
                                        <button style="width:150px">Asset</button> 
                                    </form>
                                    <form  method="GET" action="{{ route('bfas_accounts_information') }}" autocomplete="off" enctype="multipart/form-data">
                                        <input name="determiner" value='Liability' hidden>
                                        <button  style="width:150px">Liability</button> 
                                    </form>
                                    <form  method="GET" action="{{ route('bfas_accounts_information') }}" autocomplete="off" enctype="multipart/form-data">
                                        <input name="determiner" value='Equity' hidden>
                                        <button style="width:150px">Equity</button> 
                                    </form>
                                    <form  method="GET" action="{{ route('bfas_accounts_information') }}" autocomplete="off" enctype="multipart/form-data">
                                        <input name="determiner" value='Income' hidden>
                                        <button style="width:150px">Income</button> 
                                    </form>
                                    <form  method="GET" action="{{ route('bfas_accounts_information') }}" autocomplete="off" enctype="multipart/form-data">
                                        <input name="determiner" value='Cost of Sales' hidden>
                                        <button style="width:150px">Cost of Sales</button> 
                                    </form>
                                    <form  method="GET" action="{{ route('bfas_accounts_information') }}" autocomplete="off" enctype="multipart/form-data">
                                        <input name="determiner" value='Expense' hidden>
                                        <button style="width:150px">Expense</button> 
                                    </form>
                                    <form  method="GET" action="{{ route('bfas_accounts_information') }}" autocomplete="off" enctype="multipart/form-data">
                                        <input name="determiner" value='Other Income' hidden>
                                        <button  style="width:150px">Other Income</button> 
                                    </form>
                                    <form  method="GET" action="{{ route('bfas_accounts_information') }}" autocomplete="off" enctype="multipart/form-data">
                                        <input name="determiner" value='Other Expense' hidden>
                                        <button style="width:150px">Other Expense</button> 
                                    </form>
                                </div>
                                <br>
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>ID</th>
                                            <th>Account Details</th>
                                            <th>Account Type</th>
                                            <th>Level</th>
                                            <th>Parent Account</th>
                                            
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Level_1 as $x)
                                                <tr style="background-color:rgb(184, 184, 238);">
                                                    <td hidden>{{$x->Accounts_Information_ID}}</td>
                                                    <td class="sm_data_col">
                                                        {{$x->Account_Number}} &nbsp; {{$x->Account_Name}}
                                                    </td>
                                                    <td class="sm_data_col">{{$x->Account_Type}}</td>
                                                    <td class="sm_data_col txtCtr">{{$x->Account_Level}}</td>
                                                    <td class="sm_data_col txtCtr"></td>

                                                    <td class="sm_data_col txtCtr">
                                                        <button class="edit_XYZ" value="{{$x->Accounts_Information_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
                                                    </td>
                                                </tr>
                                                @foreach($Level_2 as $x2)
                                                    @if($x2->Parent_Account == $x->Account_Number)
                                                    <tr style="background-color:rgb(202, 202, 247);">
                                                        <td hidden>{{$x->Accounts_Information_ID}}</td>
                                                        <td class="sm_data_col" >
                                                            <p style="margin-left: 3%;">{{$x2->Account_Number}} &nbsp; {{$x2->Account_Name}}</p>
                                                        </td>
                                                        <td class="sm_data_col">{{$x2->Account_Type}}</td>
                                                        <td class="sm_data_col txtCtr">{{$x2->Account_Level}}</td>
                                                        <td class="sm_data_col ">
                                                            {{$x2->Parent_Account}}
                                                        </td>
    
                                                        <td class="sm_data_col txtCtr">
                                                            <button class="edit_XYZ" value="{{$x2->Accounts_Information_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
                                                        </td>
                                                    </tr>
                                                    @foreach($Level_3 as $x3)
                                                        @if($x3->Parent_Account == $x2->Account_Number)
                                                        <tr style="background-color:rgb(225, 225, 248);">
                                                            <td hidden>{{$x->Accounts_Information_ID}}</td>
                                                            <td class="sm_data_col" >
                                                                <p style="margin-left: 6%;">{{$x3->Account_Number}} &nbsp; {{$x3->Account_Name}}</p>
                                                            </td>
                                                            <td class="sm_data_col">{{$x3->Account_Type}}</td>
                                                            <td class="sm_data_col txtCtr">{{$x3->Account_Level}}</td>
                                                            <td class="sm_data_col ">
                                                                {{$x3->Parent_Account}}
                                                            </td>
        
                                                            <td class="sm_data_col txtCtr">
                                                                <button class="edit_XYZ" value="{{$x3->Accounts_Information_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
                                                            </td>
                                                        </tr>
                                                            @foreach($Level_4 as $x4)
                                                                @if($x4->Parent_Account == $x3->Account_Number)
                                                                <tr style="background-color:rgb(239, 239, 252);">
                                                                    <td hidden>{{$x->Accounts_Information_ID}}</td>
                                                                    <td class="sm_data_col" >
                                                                        <p style="margin-left: 9%;">{{$x4->Account_Number}} &nbsp; {{$x4->Account_Name}}</p>
                                                                    </td>
                                                                    <td class="sm_data_col">{{$x4->Account_Type}}</td>
                                                                    <td class="sm_data_col txtCtr">{{$x4->Account_Level}}</td>
                                                                    
                                                                    <td class="sm_data_col ">
                                                                        {{$x4->Parent_Account}}
                                                                    </td>
                
                                                                    <td class="sm_data_col txtCtr">
                                                                        <button class="edit_XYZ" value="{{$x4->Accounts_Information_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
                                                                    </td>
                                                                </tr>
                                                                    @foreach($Level_5 as $x5)
                                                                        @if($x5->Parent_Account == $x4->Account_Number)
                                                                        <tr style="background-color:rgb(252, 252, 252);">
                                                                            <td hidden>{{$x->Accounts_Information_ID}}</td>
                                                                            <td class="sm_data_col" >
                                                                                <p style="margin-left: 12%;">{{$x5->Account_Number}} &nbsp; {{$x5->Account_Name}}</p>
                                                                            </td>
                                                                            <td class="sm_data_col">{{$x5->Account_Type}}</td>
                                                                            <td class="sm_data_col txtCtr">{{$x5->Account_Level}}</td>
                                                                            <td class="sm_data_col ">
                                                                                {{$x5->Parent_Account}}
                                                                            </td>
                        
                                                                            <td class="sm_data_col txtCtr">
                                                                                <button class="edit_XYZ" value="{{$x5->Accounts_Information_ID}}" data-toggle="modal" data-target="#updateXYZ">Edit</button>
                                                                            </td>
                                                                        </tr>
                                                                        @endif

                                                                    @endforeach
                                                                @endif

                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    @endif
                                                @endforeach
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
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create New Entry</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newEntryXYZ" method="POST" action="{{ route('create_bfas_accounts_information') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <div class="form-group">
                            <label for="Account_Type_ID">Account Type:</label>
                            <select class="modal_input1 form-control" name="Account_Type_ID">
                                <option value='' hidden selected>Select</option>
                                @foreach($acc_type as $act)
                                <option value={{$act->Account_Type_ID}}>{{$act->Account_Type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Account_Class">Account Class:</label>
                            <select class="modal_input1 form-control" name="Account_Class">
                                <option value='' hidden selected>Select</option>

                                <option value="Asset">Asset</option>
                                <option value="Liability">Liability</option>
                                <option value="Equity">Equity</option>
                                <option value="Income">Income</option>
                                <option value="Expense">Expense</option>
                                <option value="Cost of Sale">Cost of Sale</option>
                                <option value="Other Income">Other Income</option>
                                <option value="Other Expense">Other Expense</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Account_Name">Account Name:</label>
                            <input class="modal_input1 form-control" name="Account_Name">
                        </div>
                        <div class="form-group">
                            <label for="Account_Number">Account Number:</label>
                            <input class="modal_input1 form-control" name="Account_Number">
                        </div>

                        <div class="form-group">
                            <label for="Account_Level">Account Level:</label>
                            <select id="acc_lvl" class="modal_input1 form-control" name="Account_Level">
                                <option value=1 hidden selected>Select</option>
                                <option value=1>Level 1</option>
                                <option value=2>Level 2</option>
                                <option value=3>Level 3</option>
                                <option value=4>Level 4</option>
                                <option value=5>Level 5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Parent_Account">Parent Account:</label>
                            <select id="acc_parents" class="modal_input1 form-control" name="Parent_Account">
                                <option value=0 hidden selected>Select</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Beginning_Balance">Beginning Balance:</label>
                            <input id="this_begbal" type="number"  class="form-control" name="Beginning_Balance2" value="" min=".00" step=".01">
                        </div>

                        <div class="form-group">
                            <label for="ActiveX">Active:</label>
                            <select class="modal_input1 form-control" name="ActiveX">
                                <option value=1 hidden selected>Is Active?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
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
            <form id="updateEntryXYZ" method="POST" action="{{ route('update_bfas_accounts_information') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <input id="this_identifier" value=2 hidden>
                <input id="this_idX" value="" hidden name="IDx">
                <div class="modal-body Absolute-Center">
                    <div class="modal_input_container">
                        <div class="form-group">
                            <label>Account Type:</label>
                            <select class="form-control" name="Account_Type_ID2">
                                <option id="this_acc_type" value='' hidden selected>Select</option>
                                @foreach($acc_type as $act)
                                <option value={{$act->Account_Type_ID}}>{{$act->Account_Type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Account Class:</label>
                            <select class="form-control" name="Account_Class2">
                                <option id="this_acc_class" value='' hidden selected>Select</option>
                                
                                <option value="Asset">Asset</option>
                                <option value="Liability">Liability</option>
                                <option value="Equity">Equity</option>
                                <option value="Income">Income</option>
                                <option value="Expense">Expense</option>
                                <option value="Cost of Sale">Cost of Sale</option>
                                <option value="Other Income">Other Income</option>
                                <option value="Other Expense">Other Expense</option>
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Account Name:</label>
                            <input id="this_acc_name" class="form-control" name="Account_Name2">
                        </div>
                        <div class="form-group">
                            <label>Account Number:</label>
                            <input id="this_acc_no" class="form-control" name="Account_Number2">
                        </div>

                        <div class="form-group">
                            <label for="Account_Level2">Account Level:</label>
                            <select id="acc_lvl2" class="modal_input1 form-control" name="Account_Level2">
                                <option id="this_acc_lvl" value=1 hidden selected>Select</option>
                                <option value=1>Level 1</option>
                                <option value=2>Level 2</option>
                                <option value=3>Level 3</option>
                                <option value=4>Level 4</option>
                                <option value=5>Level 5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="ActiParent_Account2veX">Parent Account:</label>
                            <select id="acc_parents2" class="modal_input1 form-control" name="Parent_Account2">
                                <option id="this_acc_parent" value=0 hidden selected>Select</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Beginning_Balance2">Beginning Balance:</label>
                            <input id="this_begbal" type="number"  class="form-control" name="Beginning_Balance2" value="" min=".00" step=".01">
                        </div>

                        <div class="form-group">
                            <label>Active:</label>
                            <select class="form-control" name="ActiveX2">
                                <option id="this_active" value=1 hidden selected>Is Active?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
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
        $('#example2').DataTable();
        $('#example3').DataTable();
    });
</script>

@endsection