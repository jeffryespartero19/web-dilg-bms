@foreach($db_entries as $x)
    <tr>
        <!-- <td class="sm_data_col txtCtr" hidden>{{$x->Document_ID}}</td> -->
        <td class="sm_data_col txtCtr">{{$x->Queue_Ticket_Number}}</td>
        <td class="sm_data_col txtCtr">{{$x->Requested_Date_and_Time}}</td>
        <td class="sm_data_col txtCtr">{{$x->Resident_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Document_Type_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Purpose_of_Document}}</td>
        <td class="sm_data_col txtCtr">
        <a class="btn btn-success" href="{{ url('document_request_details/'.$x->Document_ID) }}">Approve</a>
        <button class="disapprove_inhabitants  btn btn-danger" value="{{$x->Document_ID}}">Disapprove</button>
        </td>
    </tr>
@endforeach