@foreach($db_entries2 as $x)
    <tr>
        <td class="sm_data_col txtCtr">{{$x->Queue_Ticket_Number}}</td>
        <td class="sm_data_col txtCtr">{{$x->Requested_Date_and_Time}}</td>
        <td class="sm_data_col txtCtr">{{$x->Resident_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Document_Type_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Purpose_of_Document}}</td>
        <td class="sm_data_col txtCtr">
        <a class="btn btn-success" href="{{ url('document_request_approved_details/'.$x->Document_ID) }}">Edit</a>
        </td>
    </tr>
@endforeach