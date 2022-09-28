@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Document Type Maintenance/Setup </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;document type</li>
        </ol> 
    </div>
</div> 
<div class="tableX_row col-md-12 up_marg5">
    <div class="flexer"> 
        <div class="eighty_split">{{$db_entries->appends(['db_entries' => $db_entries->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><button data-toggle="modal" data-target="#createDocument_Type">New</button></div>
    </div>
    <div class="col-md-12">
        <table class="table-bordered table_gen up_marg5">
            <thead>
                <tr>
                    <th>Document Type ID </th>
                    <th>Document Type</th>
                    <th>Active</th>
                    <th>Encoder ID</th>
                    <th>Date Stamp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                    <tr>
                        <td class="sm_data_col txtCtr">{{$x->Document_Type_ID}}</td>
                        <td>{{$x->Document_Type_Name}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Encoder_ID}}</td>
                        <td class="md_data_col txtCtr">{{$x->Date_Stamp}}</td>
                        <td class="sm_data_col txtCtr">
                            <button class="edit_document_type" value="{{$x->Document_Type_ID}}" data-toggle="modal" data-target="#updateDocument_Type">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Document_Type Modal -->
<div class="modal fade" id="createDocument_Type" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Create Post</h4>
        </div>
        <form id="new_Document_Type" method="POST" action="{{ route('create_document_type') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Document Type:</b></span><br>
                        <input class="modal_input1" name="Document_Type_NameX">
                    </div>

                    <div class="up_marg5">
                        <span><b>Active:</b></span><br>
                        <select class="modal_input1" name="ActiveX">
                            <option value=1 hidden selected>Is Active?</option>
                            <option value=1>Yes</option>
                            <option value=0>No</option>
                        </select>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn postThis_Document_Type modal_sb_button">Save</button>
            </div>
        </form>
      </div>
      
    </div>
</div>

<!-- Create Document_Type END -->

<!-- Edit/Update Document_Type Modal -->
<div class="modal fade" id="updateDocument_Type" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Create Post</h4>
        </div>
        <form id="update_Document_Type" method="POST" action="{{ route('update_document_type') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Document_Type:</b></span><br>
                        <input id="this_document_type_idX" class="modal_input1" name="Document_Type_idX" hidden>
                        <input id="this_document_type_NameX" class="modal_input1" name="Document_Type_NameX2">
                    </div>

                    <div class="up_marg5">
                        <span><b>Active:</b></span><br>
                        <select class="modal_input1" name="ActiveX2">
                            <option id="this_document_type_active" value=1 hidden selected>Is Active?</option>
                            <option value=1>Yes</option>
                            <option value=0>No</option>
                        </select>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn updateThis_Document_Type modal_sb_button">Save</button>
            </div>
        </form>
      </div>
      
    </div>
</div>

<!-- Edit/Update Document_Type END -->
<script>
    $(document).on('click', '.postThis_Document_Type', function (e) {
    $('#new_Document_Type').submit();
});

$(document).on('click', ('.edit_document_type'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_document_type",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_document_type_idX').val(data['theEntry'][0]['Document_Type_ID']);
            $('#this_document_type_NameX').val(data['theEntry'][0]['Document_Type_Name']);

            $('#this_document_type_active').empty();
            $('#this_document_type_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_document_type_active').append('Yes');
            } else {
                $('#this_document_type_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Document_Type', function (e) {
    $('#update_Document_Type').submit();
});
</script>
@endsection

