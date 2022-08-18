@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Contractor List </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BPMS / </li>
            </a> 
            <li> &nbsp;Contractor List</li>
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
        <div class="twenty_split txtRight"><button data-toggle="modal" class="btn btn-success" data-target="#createContractor" style="width: 100px;">New</button></div>
    </div>
    <br>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Contractor_ID</th>
                    <th >Contractor_Name</th>
                    <th >Contact_Person</th>
                    <th >Contact_No</th>
                    <th >Contractor_Address</th>
                    <th >Contractor_Tin</th>
                    <th >Remarks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                <tr>
                    <td class="sm_data_col txtCtr" hidden>{{$x->Contractor_ID}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Contractor_Name}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Contact_Person}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Contact_No}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Contractor_Address}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Contractor_TIN}}</td>
                    <td class="sm_data_col txtCtr" >{{$x->Remarks}}</td>
                    <td class="sm_data_col txtCtr"> 
                        <button class="edit_contractor" value="{{$x->Contractor_ID}}" data-toggle="modal" data-target="#updateContractor">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Announcement_Status Modal  -->

<div class="modal fade" id="createContractor" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Create Contractor Profile</h4>
            </div>
            <div class="modal-body">
                <form id="newInhabitant" method="POST" action="{{ route('create_contractor') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Contractor Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Contractor_ID" name="Contractor_ID" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Contractor_Name">Contractor Name</label>
                                <input type="text" class="form-control" id="Contractor_Name" name="Contractor_Name">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Contact_Person">Contact Person</label>
                                <input type="text" class="form-control" id="Contact_Person" name="Contact_Person">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Contact_No">Contact No.</label>
                                <input type="text" class="form-control" id="Contact_No" name="Contact_No">
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Contractor_TIN">Contractor Tin</label>
                                <input type="text" class="form-control" id="Contractor_TIN" name="Contractor_TIN">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Remarks">Remarks</label>
                                <input type="text" class="form-control" id="Remarks" name="Remarks">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="Contractor_Address">Contractor Address</label>
                                <input type="text" class="form-control" id="Contractor_Address" name="Contractor_Address">
                            </div>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="width: 200px;">Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- Create Announcement_Status END -->

<div class="modal fade" id="updateContractor" tabindex="-1" role="dialog" aria-labelledby="Update_Contractor" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Updating Contractor Profile</h4>
            </div>
            <div class="modal-body">
                <form id="newContrator" method="POST"  action="{{ route('update_contractor') }}"  autocomplete="off" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <h3>Contractor Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Contractor_ID1" name="Contractor_ID1" hidden>
                            <input type="text" class="form-control" id="Contractor_ID" name="Contractor_ID" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Contractor_Name1">Contractor Name</label>
                                <input type="text" class="form-control" id="Contractor_Name1" name="Contractor_Name1">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Contact_Person1">Contact Person</label>
                                <input type="text" class="form-control" id="Contact_Person1" name="Contact_Person1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Contact_No1">Contact No.</label>
                                <input type="text" class="form-control" id="Contact_No1" name="Contact_No1">
                            </div>
                            <div class="form-group col-lg-3" style="padding:0 10px">
                                <label for="Contractor_TIN1">Contractor Tin</label>
                                <input type="text" class="form-control" id="Contractor_TIN1" name="Contractor_TIN1">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Remarks1">Remarks</label>
                                <input type="text" class="form-control" id="Remarks1" name="Remarks1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <label for="Contractor_Address1">Contractor Address</label>
                                <input type="text" class="form-control" id="Contractor_Address1" name="Contractor_Address1">
                            </div>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="width: 200px;">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>





@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    $(document).on('click', '.modal-close', function(e) {
        $('#newInhabitant').trigger("reset");
    });




    // Edit Button Display Modal
    $(document).on('click', ('.edit_contractor'), function(e) {

        var disID = $(this).val();
        $.ajax({
            url: "/get_contractor",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {
                $('#Contractor_ID1').val(data['theEntry'][0]['Contractor_ID']);
                $('#Contractor_Name1').val(data['theEntry'][0]['Contractor_Name']);
                $('#Contact_Person1').val(data['theEntry'][0]['Contact_Person']);
                $('#Contact_No1').val(data['theEntry'][0]['Contact_No']);
                $('#Contractor_Address1').val(data['theEntry'][0]['Contractor_Address']);
                $('#Contractor_TIN1').val(data['theEntry'][0]['Contractor_TIN']);
                $('#Remarks1').val(data['theEntry'][0]['Remarks']);
            }
        });


    });
</script>

<style>
    table {
        display: block;
        overflow-x: scroll;
    }
</style>

@endsection