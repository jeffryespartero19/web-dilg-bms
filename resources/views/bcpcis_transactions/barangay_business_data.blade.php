@foreach($db_entries as $x)
    <tr>
        
        <td class="sm_data_col txtCtr" >{{$x->Business_Name}}</td>  
        <td class="sm_data_col txtCtr" >{{$x->Business_Type}}</td>  
        <td class="sm_data_col txtCtr" >{{$x->Business_Tin}}</td>  
        <td class="sm_data_col txtCtr" >{{$x->Business_Owner}}</td>  
        <td class="sm_data_col txtCtr" >{{$x->Business_Address}}</td>  
        <td class="sm_data_col txtCtr" >{{$x->Mobile_No}}</td>
        <td class="sm_data_col txtCtr" >{{$x->Active}}</td>
        <td class="sm_data_col txtCtr">
        @if (Auth::user()->User_Type_ID == 1)
            <a class="btn btn-info" href="{{ url('barangay_business_details/'.$x->Business_ID) }}">Edit</a>
            <!-- <a class="btn btn-primary" href="{{ url('view_barangay_business_details/'.$x->Business_ID) }}">View</a> -->
            <button class="view_brgybusiness btn btn-primary" value="{{$x->Business_ID}}" data-toggle="modal" data-target="#viewBrgyBusiness">View</button>
            <button class="delete_business btn btn-danger" value="{{$x->Business_ID}}">Delete</button>
        @endif
        @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
            <button class="view_brgybusiness btn btn-primary" value="{{$x->Business_ID}}" data-toggle="modal" data-target="#viewBrgyBusiness">View</button>
        @endif
        </td>
    </tr>
@endforeach