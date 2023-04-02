@foreach($db_entries as $x)
    <tr>
        <td class="sm_data_col txtCtr">{{$x->Contractor_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Contact_Person}}</td>
        <td class="sm_data_col txtCtr">{{$x->Contact_No}}</td>
        <td class="sm_data_col txtCtr">{{$x->Contractor_Address}}</td>
        <td class="sm_data_col txtCtr">{{$x->Contractor_TIN}}</td>
        <td class="sm_data_col txtCtr">{{$x->Remarks}}</td>
        <td class="sm_data_col txtCtr">
            @if (Auth::user()->User_Type_ID == 1)
            <button class="edit_contractor btn btn-info" value="{{$x->Contractor_ID}}" data-toggle="modal" data-target="#updateContractor">Edit</button>
            <button class="view_contractor btn btn-primary" value="{{$x->Contractor_ID}}" data-toggle="modal" data-target="#viewContractor">View</button>
            <button class="delete_contractor btn btn-danger" value="{{$x->Contractor_ID}}">Delete</button>
            @endif
            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
            <button class="view_contractor" value="{{$x->Contractor_ID}}" data-toggle="modal" data-target="#viewContractor">View</button>
            @endif
        </td>
    </tr>
@endforeach