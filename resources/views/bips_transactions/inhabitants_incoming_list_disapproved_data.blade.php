@foreach($db_entries3 as $x)
<tr>
    <td class="sm_data_col txtCtr" hidden>{{$x->Resident_ID}}</td>
    <td class="sm_data_col txtCtr">{{$x->Last_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->First_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Middle_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Name_Suffix}}</td>

</tr>
@endforeach