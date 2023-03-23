@foreach($db_entries as $x)
<tr>
    <td class="sm_data_col txtCtr">{{$x->Transaction_No}}</td>
    <td class="sm_data_col txtCtr">{{$x->Business_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Resident_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->New_or_Renewal}}</td>
    <td class="sm_data_col txtCtr">{{$x->Owned_or_Rented}}</td>
    <td class="sm_data_col txtCtr">{{$x->Barangay_Business_Permit_Expiration_Date}}</td>
    <td class="sm_data_col txtCtr">
        @if (Auth::user()->User_Type_ID == 1)
        <a class="btn btn-info" href="{{ url('brgy_business_permit_details/'.$x->Barangay_Permits_ID) }}">Edit</a>
        <!-- <a class="btn btn-primary" href="{{ url('view_brgy_business_permit_details/'.$x->Barangay_Permits_ID) }}">View</a> -->
        <button class="view_businesspermit btn btn-primary" value="{{$x->Barangay_Permits_ID}}" data-toggle="modal" data-target="#viewBusinessPermit">View</button>
        <button class="delete_businesspermit btn btn-danger" value="{{$x->Barangay_Permits_ID}}">Delete</button>
        @endif
        @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
        <button class="view_businesspermit btn btn-primary" value="{{$x->Barangay_Permits_ID}}" data-toggle="modal" data-target="#viewBusinessPermit">View</button>
        @endif
    </td>
</tr>
@endforeach