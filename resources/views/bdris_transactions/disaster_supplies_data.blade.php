@foreach($db_entries4 as $x)
    <tr>
        <td class="sm_data_col txtCtr">{{$x->Disaster_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Disaster_Supplies_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Disaster_Supplies_Quantity}}</td>
        <td class="sm_data_col txtCtr">{{$x->Location}}</td>
        <td class="sm_data_col txtCtr">{{$x->Remarks}}</td>
        <td class="sm_data_col txtCtr">{{$x->Active}}</td>
        <td class="sm_data_col txtCtr">
            @if (Auth::user()->User_Type_ID == 1)
            <a class="btn btn-info" href="{{ url('disaster_supplies_details/'.$x->Disaster_Supplies_ID) }}">Edit</a>
            <button class="view_dissupp btn btn-primary" value="{{$x->Disaster_Supplies_ID}}" data-toggle="modal" data-target="#viewDisSupp">View</button>
            <!-- <a class="btn btn-primary" href="{{ url('view_disaster_supplies_details/'.$x->Disaster_Supplies_ID) }}">View</a> -->
            <button class="delete_disastersupp btn btn-danger" value="{{$x->Disaster_Supplies_ID}}">Delete</button>
            @endif
            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
            <button class="view_dissupp btn btn-primary" value="{{$x->Disaster_Supplies_ID}}" data-toggle="modal" data-target="#viewDisSupp">View</button>
            @endif
        </td>
    </tr>
@endforeach