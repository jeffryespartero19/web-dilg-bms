@foreach($db_entries as $x)
<tr>
    <td class="sm_data_col txtCtr">{{$x->Barangay_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->City_Municipality_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Province_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Region_Name}}</td>
    <td class="sm_data_col txtCtr"><button class='btn btn-success EnterLink' value='{{$x->Barangay_ID}}'>Visit</button></td>
</tr>
@endforeach
<tr>
    <td colspan="5">
        {!! $db_entries->links() !!}
    </td>
</tr>