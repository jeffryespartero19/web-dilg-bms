@foreach($db_entries as $x)
<tr>
    <td class="sm_data_col txtCtr">{{$x->Household_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Household_Monthly_Income}}</td>
    <td class="sm_data_col txtCtr">{{$x->Tenure_of_Lot}}</td>
    <td class="sm_data_col txtCtr">{{$x->Housing_Unit}}</td>
    <td class="sm_data_col txtCtr">{{$x->Family_Type_Name}}</td>
    <td class="sm_data_col txtCtr" style="display: flex;">
        <button class="view_info btn btn-primary" value="{{$x->Household_Profile_ID}}" data-toggle="modal" data-target="#ViewInfo">View</button>&nbsp;
        <a class="btn btn-info" href="{{ url('inhabitants_household_details/'.$x->Household_Profile_ID) }}">Edit</a>&nbsp;
        <button class="delete_household btn btn-danger" value="{{$x->Household_Profile_ID}}">Delete</button>
    </td>
</tr>
@endforeach