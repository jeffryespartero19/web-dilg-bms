@foreach($db_entries5 as $x)
    <tr>
        <td class="sm_data_col txtCtr">{{$x->Emergency_Team_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Emergency_Team_Hotline}}</td>
        <td class="sm_data_col txtCtr">{{$x->Active}}</td>
        <td class="sm_data_col txtCtr">
            @if (Auth::user()->User_Type_ID == 1)
            <a class="btn btn-info" href="{{ url('emergency_team_details/'.$x->Emergency_Team_ID) }}">Edit</a>
            <button class="view_emerteam btn btn-primary" value="{{$x->Emergency_Team_ID}}" data-toggle="modal" data-target="#viewEmerTeam">View</button>
            <!-- <a class="btn btn-primary" href="{{ url('view_emergency_team_details/'.$x->Emergency_Team_ID) }}">View</a> -->
            <button class="delete_emerteam btn btn-danger" value="{{$x->Emergency_Team_ID}}">Delete</button>
            @endif
            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
            <button class="view_emerteam btn btn-primary" value="{{$x->Emergency_Team_ID}}" data-toggle="modal" data-target="#viewEmerTeam">View</button>
            @endif
        </td>
    </tr>
@endforeach