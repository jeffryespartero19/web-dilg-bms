@foreach($db_entries as $x)
<tr>

    <td style="width: 75%;" class="sm_data_col">{{$x->Blotter_Number}}</td>
    <td style="width: 25%;" class="sm_data_col txtCtr" style="display: flex;">
        <a class="btn btn-primary" href="{{ url('summon_details_view/'.$x->Summons_ID) }}">View</a>&nbsp;
        <a class="btn btn-success" href="{{ url('summon_details/'.$x->Summons_ID) }}">Edit</a>&nbsp;
        <button class="delete_summons btn btn-danger" value="{{$x->Summons_ID}}">Delete</button>
    </td>
</tr>
@endforeach