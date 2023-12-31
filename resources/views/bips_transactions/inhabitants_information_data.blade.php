@foreach($db_entries as $x)
<tr>
    <td class="sm_data_col txtCtr">{{$x->Last_Name}}, {{$x->First_Name}} {{$x->Middle_Name}} {{$x->Name_Suffix}}</td>
    <td class="sm_data_col txtCtr">{{$x->Birthdate}}</td>
    <!-- <td class="sm_data_col txtCtr">{{$x->Birthplace}}</td> -->
    <td class="sm_data_col txtCtr">
        <?php
        $age = date_diff(date_create($x->Birthdate), date_create('now'))->y;
        echo $age;
        ?>
    </td>
    <td class="sm_data_col txtCtr">@if($x->Sex == 1) Male @else Female @endif</td>
    <td class="sm_data_col txtCtr">{{$x->Civil_Status}}</td>
    <td class="sm_data_col txtCtr">{{$x->Street}}</td>
    <td class="sm_data_col txtCtr">@if($x->Resident_Status == 1) Yes @else No @endif</td>
    <td class="sm_data_col txtCtr">@if($x->Voter_Status == 1) Yes @else No @endif</td>
    <td class="sm_data_col txtCtr">@if($x->Resident_Voter == 1) Yes @else No @endif</td>
    <td class="sm_data_col txtCtr">@if ($x->Solo_Parent==1) Yes @else No @endif</td>
    <td class="sm_data_col txtCtr">@if ($x->Indigent==1) Yes @else No @endif</td>
    <td class="sm_data_col txtCtr">@if ($x->Beneficiary==1) Yes @else No @endif</td>
    <td class="sm_data_col txtCtr">@if ($x->OFW==1) Yes @else No @endif</td>
    <td class="sm_data_col txtCtr" style="display: flex;">
        <button class="view_inhabitants btn btn-primary" value="{{$x->Resident_ID}}" data-toggle="modal" data-target="#ViewInfo">View</button>&nbsp;
        <a class="btn btn-info" href="{{ url('inhabitants_details/'.$x->Resident_ID) }}">Edit</a>
        <button class="delete_inhabitants btn btn-danger" value="{{$x->Resident_ID}}">Delete</button>
    </td>
</tr>
@endforeach