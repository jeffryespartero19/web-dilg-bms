@foreach($db_entries as $x)
<tr>
    <td class="sm_data_col txtCtr">{{$x->Last_Name}} {{$x->First_Name}}, {{$x->Middle_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Region_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Province_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->City_Municipality_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Barangay_Name}}</td>
    <td class="sm_data_col txtCtr" style="display: flex;">
        <button class="view_inhabitants_transfer btn btn-primary">View</button>&nbsp;
        <button class="edit_inhabitants_transfer btn btn-info" value="{{$x->Inhabitants_Transfer_ID}}" data-toggle="modal" data-target="#updateInhabitants_Transfer">Edit</button>
    </td>
</tr>
@endforeach