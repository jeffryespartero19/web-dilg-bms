@foreach($db_entries as $x)
<tr>
    <td class="sm_data_col txtCtr">{{$x->Last_Name}} {{$x->First_Name}}, {{$x->Middle_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Term_From}}</td>
    <td class="sm_data_col txtCtr">{{$x->Term_To}}</td>
    <td class="sm_data_col txtCtr" style="display: flex;">
        <button class="view_info  btn btn-primary" value="{{$x->Brgy_Purok_Leader_ID}}" data-toggle="modal" data-target="#createInhabitants_Info">View</button>&nbsp;
        <button class="edit_brgy_purok_leader btn btn-info" value="{{$x->Brgy_Purok_Leader_ID}}" data-toggle="modal" data-target="#Update_Brgy_Purok_Leader">Edit</button>&nbsp;
        <button class="delete_brgy_purok_leader btn btn-danger" value="{{$x->Brgy_Purok_Leader_ID}}">Delete</button>
    </td>
</tr>
@endforeach