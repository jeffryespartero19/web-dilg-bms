@foreach($db_entries as $x)
    <tr>

        <td class="sm_data_col txtCtr">{{$x->Activity_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Purpose}}</td>
        <td class="sm_data_col txtCtr">{{$x->Date_Start}}</td>
        <td class="sm_data_col txtCtr">{{$x->Date_End}}</td>
        <td class="sm_data_col txtCtr">{{$x->Number_of_Participants}}</td>
        <td class="sm_data_col txtCtr">
            @if (Auth::user()->User_Type_ID == 1)
            <button class="edit_disaster_related_activities btn btn-info" value="{{$x->Disaster_Related_Activities_ID}}" data-toggle="modal" data-target="#createDisaster_Related_Activities">Edit</button>
            <button class="viewing_disrelact btn btn-primary" value="{{$x->Disaster_Related_Activities_ID}}" data-toggle="modal" data-target="#viewDisRelAct">View</button>
            <!-- <button class="edit_disaster_related_activities btn btn-primary" value="{{$x->Disaster_Related_Activities_ID}}" data-toggle="modal" data-target="#viewDisaster_Related_Activities">View</button> -->
            <button class="delete_disasterrelated btn btn-danger" value="{{$x->Disaster_Related_Activities_ID}}">Delete</button>
            @endif
            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
            <button class="view_disrelact btn btn-primary" value="{{$x->Disaster_Related_Activities_ID}}" data-toggle="modal" data-target="#viewDisRelAct">View</button>
            @endif
        </td>
    </tr>
@endforeach