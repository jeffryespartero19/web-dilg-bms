@foreach($db_entries as $x)
<tr>
    <td class="sm_data_col txtCtr">{{$x->Queue_Ticket_Number}}</td>
    <td class="sm_data_col txtCtr">{{$x->Document_Type_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Purpose_of_Document}}</td>
    <td class="sm_data_col txtCtr">{{$x->Salutation_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Remarks}}</td>
    <td class="sm_data_col txtCtr">{{$x->SecondResident_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Requested_Date_and_Time}}</td>
    <td class="sm_data_col txtCtr">{{$x->Date_Stamp}}</td>
    <td class="sm_data_col txtCtr">
        <a class="btn btn-info" href="{{ url('document_request_edit/'.$x->Document_ID) }}">Edit</a>
    </td>
</tr>
@endforeach