@foreach($db_entries as $x)
    <tr>

        <td class="sm_data_col txtCtr">{{$x->Transaction_No}}</td>
        <td class="sm_data_col txtCtr">{{$x->Request_Date}}</td>
        <td class="sm_data_col txtCtr">{{$x->Released}}</td>
        <td class="sm_data_col txtCtr">{{$x->Remarks}}</td>
        <td class="sm_data_col txtCtr">{{$x->Salutation_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->CTC_No}}</td>
        <td class="sm_data_col txtCtr">{{$x->Issued_On}}</td>
        <td class="sm_data_col txtCtr" hidden>{{$x->Issued_At}}</td>
        <td class="sm_data_col txtCtr">{{$x->Resident_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->SecondResident_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Document_Type_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Purpose_of_Document}}</td>
        <td class="sm_data_col txtCtr">
            @if (Auth::user()->User_Type_ID == 1)
            <a class="btn btn-info" href="{{ url('brgy_document_information_details/'.$x->Document_ID) }}">Edit</a>
            <button class="view_brgydocument btn btn-primary" value="{{$x->Document_ID}}" data-toggle="modal" data-target="#viewBrgyDocument">View</button>
            <!-- <a class="btn btn-primary" href="{{ url('view_brgy_document_information_details/'.$x->Document_ID) }}">View</a> -->
            <button class="delete_document btn btn-danger" value="{{$x->Document_ID}}">Delete</button>
            @endif
            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
            <button class="view_brgydocument btn btn-primary" value="{{$x->Document_ID}}" data-toggle="modal" data-target="#viewBrgyDocument">View</button>
            @endif
        </td>
    </tr>
@endforeach