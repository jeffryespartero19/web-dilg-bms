@foreach($db_entries6 as $x)
    <tr>
        <td class="sm_data_col txtCtr">{{$x->Emergency_Equipment_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Location}}</td>
        <td class="sm_data_col txtCtr">{{$x->Active}}</td>
        <td class="sm_data_col txtCtr">
            @if (Auth::user()->User_Type_ID == 1)
            <a class="btn btn-info" href="{{ url('emergency_equipment_details/'.$x->Emergency_Equipment_ID) }}">Edit</a>
            <button class="view_emerequip btn btn-primary" value="{{$x->Emergency_Equipment_ID}}" data-toggle="modal" data-target="#viewEmerEquip">View</button>
            <!-- <a class="btn btn-primary" href="{{ url('view_emergency_equipment_details/'.$x->Emergency_Equipment_ID) }}">View</a> -->
            <button class="delete_emerequip btn btn-danger" value="{{$x->Emergency_Equipment_ID}}">Delete</button>
            @endif
            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
            <button class="view_emerequip btn btn-primary" value="{{$x->Emergency_Equipment_ID}}" data-toggle="modal" data-target="#viewEmerEquip">View</button>
            @endif
        </td>
    </tr>
@endforeach