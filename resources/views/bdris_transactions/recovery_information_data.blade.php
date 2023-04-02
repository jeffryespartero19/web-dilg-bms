@foreach($db_entries as $x)
    <tr>

        <td class="sm_data_col txtCtr">{{$x->Disaster_Name}}</td>
        <td class="sm_data_col txtCtr">
            @if (Auth::user()->User_Type_ID == 1)
            <a class="btn btn-info" href="{{ url('recovery_information_details/'.$x->Disaster_Recovery_ID) }}">Edit</a>
            <a class="btn btn-primary" href="{{ url('view_recovery_information_details/'.$x->Disaster_Recovery_ID) }}">View</a>
            <button class="delete_recovery btn btn-danger" value="{{$x->Disaster_Recovery_ID}}">Delete</button>
            @endif
            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
            <a class="btn btn-primary" href="{{ url('recovery_information_details/'.$x->Disaster_Recovery_ID) }}">View</a>
            @endif
        </td>
    </tr>
@endforeach