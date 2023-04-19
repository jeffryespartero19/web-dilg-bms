@foreach($db_entries as $x)
<tr>
    <td class="sm_data_col txtCtr">{{$x->Blotter_Number}}</td>
    <td class="sm_data_col txtCtr">{{$x->Blotter_Status_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Incident_Date_Time}}</td>
    <td class="sm_data_col txtCtr" style="display: flex;">
        <button class="view_info btn btn-primary" value="{{$x->Blotter_ID}}" data-toggle="modal" data-target="#ViewInfo">View</button>&nbsp;
        <a class="btn btn-success" href="{{ url('blotter_details/'.$x->Blotter_ID) }}">Edit</a>&nbsp;
        <button class="delete_blotter btn btn-danger" value="{{$x->Blotter_ID}}">Delete</button>
    </td>
</tr>
@endforeach