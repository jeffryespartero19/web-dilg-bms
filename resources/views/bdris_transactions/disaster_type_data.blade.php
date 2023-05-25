@foreach($db_entries as $x)
    <tr>
        <td class="sm_data_col txtCtr">{{$x->Disaster_Type}}</td>
        <td class="sm_data_col txtCtr">{{$x->Emergency_Evacuation_Site_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Allocated_Fund_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Emergency_Equipment_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Emergency_Team_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Active}}</td>
        <td class="sm_data_col txtCtr">
            <a class="btn btn-info" href="{{ url('disaster_type_details/'.$x->Disaster_Type_ID) }}">Edit</a>
            <!-- <a class="btn btn-primary" href="{{ url('view_disaster_type_details/'.$x->Disaster_Type_ID) }}">View</a> -->
            <button class="view_disastertype btn btn-primary" value="{{$x->Disaster_Type_ID}}" data-toggle="modal" data-target="#viewDisasterType">View</button>
            <button class="delete_disaster btn btn-danger" value="{{$x->Disaster_Type_ID}}">Delete</button>
        </td>
    </tr>
@endforeach