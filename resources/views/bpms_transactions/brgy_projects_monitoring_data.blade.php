@foreach($db_entries as $x)
    <tr>
        <td class="sm_data_col txtCtr">{{$x->Project_Number}}</td>
        <td class="sm_data_col txtCtr">{{$x->Project_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Total_Project_Cost}}</td>
        <td class="sm_data_col txtCtr">{{$x->Exact_Location}}</td>
        <td class="sm_data_col txtCtr">{{$x->Actual_Project_Start}}</td>
        <td class="sm_data_col txtCtr">{{$x->Contractor_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Project_Type_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Project_Status_Name}}</td>
        <td class="sm_data_col txtCtr">
            @if (Auth::user()->User_Type_ID == 1)
            <a class="btn btn-info" href="{{ url('brgy_project_monitoring_details/'.$x->Brgy_Projects_ID) }}">Edit</a>
            <a class="btn btn-primary" href="{{ url('brgy_project_monitoring_details_viewing/'.$x->Brgy_Projects_ID) }}">View</a>
            <button class="delete_projects btn btn-danger" value="{{$x->Brgy_Projects_ID}}">Delete</button>
            @endif
            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
            <a class="btn btn-primary" href="{{ url('brgy_project_monitoring_details_viewing/'.$x->Brgy_Projects_ID) }}">View</a>
            @endif
        </td>
    </tr>
@endforeach