@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Purpose of Document Maintenance/Setup </div>
    <div class="col-md-6 breadcrumbXZ"> 
        <ol class="breadcrumb">
            <a href="{{route('home')}}"><li>DILG_BMS / </li></a>
            <li> &nbsp;purpose of document</li>
        </ol> 
    </div>
</div> 
<div class="tableX_row col-md-12 up_marg5">
    <div class="flexer"> 
        <div class="eighty_split">{{$db_entries->appends(['db_entries' => $db_entries->currentPage()])->links()}}</div>
        <div class="twenty_split txtRight"><button data-toggle="modal" data-target="#createPurpose_of_Document">New</button></div>
    </div>
    <div class="col-md-12">
        <table class="table-bordered table_gen up_marg5">
            <thead>
                <tr>
                    <th>Purpose of Document ID </th>
                    <th>Purpose of Document</th>
                    <th>Active</th>
                    <th>Encoder ID</th>
                    <th>Date Stamp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($db_entries as $x)
                    <tr>
                        <td class="sm_data_col txtCtr">{{$x->Purpose_of_Document_ID}}</td>
                        <td>{{$x->Purpose_of_Document}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Active}}</td>
                        <td class="sm_data_col txtCtr">{{$x->Encoder_ID}}</td>
                        <td class="md_data_col txtCtr">{{$x->Date_Stamp}}</td>
                        <td class="sm_data_col txtCtr">
                            <button class="edit_purpose_of_document" value="{{$x->Purpose_of_Document_ID}}" data-toggle="modal" data-target="#updatePurpose_of_Document">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Purpose_of_Document Modal -->
<div class="modal fade" id="createPurpose_of_Document" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Create Post</h4>
        </div>
        <form id="new_Purpose_of_Document" method="POST" action="{{ route('create_purpose_document') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Purpose of Document:</b></span><br>
                        <input class="modal_input1" name="Purpose_of_DocumentX">
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
                <button type="button" class="btn postThis_Purpose_of_Document modal_sb_button">Save</button>
            </div>
        </form>
      </div>
      
    </div>
</div>

<!-- Create Purpose_of_Document END -->

<!-- Edit/Update Purpose_of_Document Modal -->
<div class="modal fade" id="updatePurpose_of_Document" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Create Post</h4>
        </div>
        <form id="update_Purpose_of_Document" method="POST" action="{{ route('update_purpose_document') }}" autocomplete="off" enctype="multipart/form-data">@csrf
            <div class="modal-body Absolute-Center">
                <div class="modal_input_container">
                    <div class="up_marg5">
                        <span><b>Purpose of Document:</b></span><br>
                        <input id="this_purpose_of_document_idX" class="modal_input1" name="Purpose_of_Document_idX" hidden>
                        <input id="this_purpose_of_documentX" class="modal_input1" name="Purpose_of_DocumentX2">
                    </div>

                    <div class="up_marg5">
                        <span><b>Active:</b></span><br>
                        <select class="modal_input1" name="ActiveX2">
                            <option id="this_purpose_of_document_active" value=1 hidden selected>Is Active?</option>
                            <option value=1>Yes</option>
                            <option value=0>No</option>
                        </select>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn updateThis_Purpose_of_Document modal_sb_button">Save</button>
            </div>
        </form>
      </div>
      
    </div>
</div>

<!-- Edit/Update Purpose_of_Document END -->
<script>
    $(document).on('click', '.postThis_Purpose_of_Document', function (e) {
    $('#new_Purpose_of_Document').submit();
});

$(document).on('click', ('.edit_purpose_of_document'), function (e) {

    var disID = $(this).val();
    $.ajax({
        url: "/get_purpose_document",
        type: 'GET',
        data: { id: disID },
        fail: function () {
            alert('request failed');
        },
        success: function (data) {
            $('#this_purpose_of_document_idX').val(data['theEntry'][0]['Purpose_of_Document_ID']);
            $('#this_purpose_of_documentX').val(data['theEntry'][0]['Purpose_of_Document']);

            $('#this_purpose_of_document_active').empty();
            $('#this_purpose_of_document_active').val(data['theEntry'][0]['Active']);
            if (data['theEntry'][0]['Active'] == 1) {
                $('#this_purpose_of_document_active').append('Yes');
            } else {
                $('#this_purpose_of_document_active').append('No');
            }

        }
    });


});

$(document).on('click', '.updateThis_Purpose_of_Document', function (e) {
    $('#update_Purpose_of_Document').submit();
});
</script>
@endsection

