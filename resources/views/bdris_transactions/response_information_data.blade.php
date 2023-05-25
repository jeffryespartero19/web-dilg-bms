@foreach($db_entries as $x)
    <tr>
        <td class="sm_data_col txtCtr">{{$x->Disaster_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Disaster_Type}}</td>
        <td class="sm_data_col txtCtr">{{$x->Alert_Level}}</td>
        <td class="sm_data_col txtCtr">{{$x->Disaster_Date_Start}}</td>
        <td class="sm_data_col txtCtr">{{$x->Disaster_Date_End}}</td>
        <td class="sm_data_col txtCtr">{{$x->Summary}}</td>
        <td class="sm_data_col txtCtr">
            @if (Auth::user()->User_Type_ID == 1)
            <a class="btn btn-info" href="{{ url('response_information_details/'.$x->Disaster_Response_ID) }}">Edit</a>
            <a class="btn btn-primary" href="{{ url('view_response_information_details/'.$x->Disaster_Response_ID) }}">View</a>
            <button class="delete_response btn btn-danger" value="{{$x->Disaster_Response_ID}}">Delete</button>
            @endif
            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
            <a class="btn btn-primary" href="{{ url('response_information_details/'.$x->Disaster_Response_ID) }}">View</a>
            @endif
        </td>
    </tr>
@endforeach