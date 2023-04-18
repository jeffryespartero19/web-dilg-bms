@foreach($db_entries as $x)
<tr>
    <td class="sm_data_col txtCtr">{{$x->Last_Name}} {{$x->First_Name}}, {{$x->Middle_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Deceased_Type}}</td>
    <td class="sm_data_col txtCtr">{{$x->Cause_of_Death}}</td>
    <td class="sm_data_col txtCtr">{{$x->Date_of_Death}}</td>
    <td class="sm_data_col txtCtr" style="display: flex;">
        <button class="view_info btn btn-primary" value="{{$x->Resident_ID}}" data-toggle="modal" data-target="#ViewInfo">View</button>&nbsp;
        <button class="edit_deceased_profile btn btn-info" value="{{$x->Resident_ID}}" data-toggle="modal" data-target="#updateDeceased_Profile">Edit</button>&nbsp;
        <button class="delete_deceased_profile btn btn-danger" value="{{$x->Resident_ID}}">Delete</button>
    </td>
</tr>
@endforeach