@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Allocated Fund Source List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BDRIS / </li>
            </a> 
            <li> &nbsp;Allocated Fund Source List</li> 
        </ol> 
    </div>
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
<div class="tableX_row col-md-12 up_marg5">
    <br>
    <div class="flexer">
        <div class="eighty_split">{{$db_entries->appends(['db_entries' => $db_entries->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><button data-toggle="modal" class="btn btn-success" data-target="#createAllocated_Fund_Source" style="width: 100px;">New</button></div>
        <div class="txtRight" style="margin-left: 5px;"><a href="{{ url('viewAllocated_FundPDF') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Allocated_Fund_ID  </th>
                    <th >Allocated Fund Name </th>
                    <th >Amount </th>
                    
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Allocated_Fund_ID}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Allocated_Fund_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Amount}}</td>
                    <td class="sm_data_col txtCtr"> 
                        <button class="edit_allocated_fund_source" value="{{$x->Allocated_Fund_ID}}" data-toggle="modal" data-target="#createAllocated_Fund_Source">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Announcement_Status Modal  -->

<div class="modal fade" id="createAllocated_Fund_Source" tabindex="-1" role="dialog" aria-labelledby="Create_Allocated_Fund_Source" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Allocated Fund Source Profile</h4>
            </div>
            <div class="modal-body">
                <form id="newAllocated_Fund_Source" method="POST" action="{{ route('create_allocated_fund_source') }}"  autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Allocated Fund Source Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Allocated_Fund_ID" name="Allocated_Fund_ID" hidden>
                            <div class="form-group col-lg-8" style="padding:0 10px">
                                <label for="Allocated_Fund_Name">Allocated Fund Name</label>
                                <input type="text" class="form-control" id="Allocated_Fund_Name" name="Allocated_Fund_Name">
                            </div>
                            <div class="form-group col-lg-2" style="padding:0 10px">
                                <label for="Amount">Amount</label>
                                <input type="number" class="form-control" id="Amount" name="Amount">
                            </div>
                            <div class="form-group col-lg-2" style="padding:0 10px">
                                <span><b>Active:</b></span><br>
                                <select class="modal_input1" name="Active" id="Active">
                                <option hidden selected>Is Active?</option>
                                <option value=1>Yes</option>
                                <option value=0>No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="width: 200px;">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- Create Announcement_Status END -->







@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    $(document).on('click', '.modal-close', function(e) {
        $('#newAllocated_Fund_Source').trigger("reset");
        $('#Modal_Title').text('Create Allocated Fund Source');
    });

    // Edit Button Display Modal
    $(document).on('click', ('.edit_allocated_fund_source'), function(e) {
        $('#Modal_Title').text('Edit Allocated Fund Source');
        var disID = $(this).val();
        $.ajax({
            url: "/get_allocated_fund_source",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Allocated_Fund_ID').val(data['theEntry'][0]['Allocated_Fund_ID']);
                $('#Allocated_Fund_Name').val(data['theEntry'][0]['Allocated_Fund_Name']);
                $('#Amount').val(data['theEntry'][0]['Amount']);
                $('#Active').val(data['theEntry'][0]['Active']);
            }
        });
    });

    
    // Side Bar Active
    $(document).ready(function() {
        $('.otherTrans').addClass('active');
        $('.disaster_menu').addClass('active');
        $('.disaster_main').addClass('menu-open');
    });
</script>

<style>
    table {
        display: block;
        overflow-x: scroll;
    }
</style>

@endsection