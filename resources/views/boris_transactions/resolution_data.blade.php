@foreach($db_entries as $x)
<tr>
    <td class="sm_data_col txtCtr">{{$x->Ordinance_Resolution_No}}</td>
    <td class="sm_data_col txtCtr">{{$x->Ordinance_Resolution_Title}}</td>
    <td class="sm_data_col txtCtr">{{$x->Date_of_Approval}}</td>
    <td class="sm_data_col txtCtr">{{$x->Date_of_Effectivity}}</td>
    <td class="sm_data_col txtCtr">{{$x->Name_of_Status}}</td>
    <td class="sm_data_col txtCtr" style="display: flex;">
        <button class="view_ordinance btn btn-primary" value="{{$x->Ordinance_Resolution_ID}}" data-toggle="modal" data-target="#ViewInfo">View</button>&nbsp;
        <button class="edit_ordinance btn btn-info" value="{{$x->Ordinance_Resolution_ID}}" data-toggle="modal" data-target="#createOrdinance_Info">Edit</button>&nbsp;
        <button class="delete_ordinance btn btn-danger" value="{{$x->Ordinance_Resolution_ID}}">Delete</button>
    </td>
</tr>
@endforeach
<tr>
    <td colspan="6" align="center">
        {!! $db_entries->links() !!}
    </td>
</tr>