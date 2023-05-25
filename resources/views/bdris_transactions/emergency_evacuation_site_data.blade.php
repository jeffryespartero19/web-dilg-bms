@foreach($db_entries2 as $x)
    <tr>
        <td class="sm_data_col txtCtr">{{$x->Emergency_Evacuation_Site_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Address}}</td>
        <td class="sm_data_col txtCtr">{{$x->Capacity}}</td>
        <td class="sm_data_col txtCtr">{{$x->Active}}</td>
        <td class="sm_data_col txtCtr">
            @if (Auth::user()->User_Type_ID == 1)
            <a class="btn btn-info" href="{{ url('emergency_evacuation_site_details/'.$x->Emergency_Evacuation_Site_ID) }}">Edit</a>
            <button class="view_emerevacsite btn btn-primary" value="{{$x->Emergency_Evacuation_Site_ID}}" data-toggle="modal" data-target="#viewEmerEvacSite">View</button>
            <!-- <a class="btn btn-primary" href="{{ url('view_emergency_evacuation_site_details/'.$x->Emergency_Evacuation_Site_ID) }}">View</a> -->
            <button class="delete_emereva btn btn-danger" value="{{$x->Emergency_Evacuation_Site_ID}}">Delete</button>
            @endif
            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
            <button class="view_emerevacsite btn btn-primary" value="{{$x->Emergency_Evacuation_Site_ID}}" data-toggle="modal" data-target="#viewEmerEvacSite">View</button>
            @endif
        </td>
    </tr>
@endforeach