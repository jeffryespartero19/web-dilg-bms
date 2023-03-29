@foreach($db_entries3 as $x)
    <tr>
        <td class="sm_data_col txtCtr">{{$x->Allocated_Fund_Name}}</td>
        <td class="sm_data_col txtCtr">{{$x->Amount}}</td>
        <td class="sm_data_col txtCtr">{{$x->Active}}</td>
        <td class="sm_data_col txtCtr">
            @if (Auth::user()->User_Type_ID == 1)
            <a class="btn btn-info" href="{{ url('allocated_fund_details/'.$x->Allocated_Fund_ID) }}">Edit</a>
            <button class="view_allofund btn btn-primary" value="{{$x->Allocated_Fund_ID}}" data-toggle="modal" data-target="#viewAlloFund">View</button>
            <!-- <a class="btn btn-primary" href="{{ url('view_allocated_fund_details/'.$x->Allocated_Fund_ID) }}">View</a> -->
            <button class="delete_allocated btn btn-danger" value="{{$x->Allocated_Fund_ID}}">Delete</button>
            @endif
            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
            <button class="view_allofund btn btn-primary" value="{{$x->Allocated_Fund_ID}}" data-toggle="modal" data-target="#viewAlloFund">View</button>
            @endif
        </td>
    </tr>
@endforeach