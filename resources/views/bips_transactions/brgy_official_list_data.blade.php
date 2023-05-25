@foreach($db_entries as $x)
<tr>
    <td class="sm_data_col txtCtr">{{$x->Last_Name}} {{$x->First_Name}}, {{$x->Middle_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Brgy_Position}}</td>
    <td class="sm_data_col txtCtr">{{$x->Term_From}}</td>
    <td class="sm_data_col txtCtr">{{$x->Term_To}}</td>
    <td class="sm_data_col txtCtr" style="display: flex;">
        <button class="view_info  btn btn-primary" value="{{$x->Brgy_Officials_and_Staff_ID}}" data-toggle="modal" data-target="#createInhabitants_Info">View</button>&nbsp;
        <button class="edit_brgy_official btn btn-info" value="{{$x->Brgy_Officials_and_Staff_ID}}" data-toggle="modal" data-target="#updateBrgy_Official">Edit</button>&nbsp;
        <button class="delete_brgy_official btn btn-danger" value="{{$x->Brgy_Officials_and_Staff_ID}}">Delete</button>
    </td>
</tr>
@endforeach