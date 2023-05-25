@foreach($db_entries as $x)
<tr>
    <td style="width: 75%;" class="sm_data_col">{{$x->Blotter_Number}}</td>
    <td style="width: 25%;" class="sm_data_col txtCtr" style="display: flex;">
        <a class="btn btn-primary" href="{{ url('proceeding_details_view/'.$x->Blotter_ID) }}">View</a>&nbsp;
        <a class="btn btn-success" href="{{ url('proceeding_details/'.$x->Blotter_ID) }}">Edit</a>&nbsp;
        <button class="delete_proceedings btn btn-danger" value="{{$x->Blotter_ID}}">Delete</button>
    </td>
</tr>
@endforeach