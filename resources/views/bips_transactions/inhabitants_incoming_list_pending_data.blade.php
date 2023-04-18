@foreach($db_entries as $x)
<tr>
    <td class="sm_data_col txtCtr" hidden>{{$x->Resident_ID}}</td>
    <td class="sm_data_col txtCtr">{{$x->Last_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->First_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Middle_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Name_Suffix}}</td>
    <td class="sm_data_col txtCtr">
        <button class="approve_inhabitants btn btn-success" value="{{$x->Resident_ID}}">Approve</button>
        <button class="disapprove_inhabitants  btn btn-danger" value="{{$x->Resident_ID}}">Disapprove</button>
    </td>
</tr>
@endforeach