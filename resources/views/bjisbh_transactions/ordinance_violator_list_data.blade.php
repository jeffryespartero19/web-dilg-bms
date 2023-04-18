@foreach($db_entries as $x)
<tr>
    <td class="sm_data_col">{{$x->Last_Name}}, {{$x->First_Name}} {{$x->Middle_Name}}</td>
    <td class="sm_data_col">{{$x->Type_of_Penalties}}</td>
    <td class="sm_data_col txtCtr">{{$x->Violation_Status}}</td>
    <td class="sm_data_col txtCtr">{{$x->Vilotation_Date}}</td>
    <td class="sm_data_col txtCtr" style="display: flex;">
        <a class="btn btn-primary" href="{{ url('ordinance_violator_details_view/'.$x->Ordinance_Violators_ID) }}">View</a>&nbsp;
        <a class="btn btn-success" href="{{ url('ordinance_violator_details/'.$x->Ordinance_Violators_ID) }}">Edit</a>&nbsp;
        <button class="delete_ordinance_violator btn btn-danger" value="{{$x->Ordinance_Violators_ID}}">Delete</button>
    </td>
</tr>
@endforeach