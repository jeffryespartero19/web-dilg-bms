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
    <td class="sm_data_col txtCtr">{{$x->Mobile_No}}</td>
    <td class="sm_data_col txtCtr">{{$x->Telephone_No}}</td>
    <td class="sm_data_col txtCtr">{{$x->House_No}}</td>
    <td class="sm_data_col txtCtr">{{$x->Street}}</td>
    <td class="sm_data_col txtCtr">{{$x->Barangay_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->City_Municipality_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Province_Name}}</td>
    <td class="sm_data_col txtCtr">{{$x->Region_Name}}</td>
    <!-- <td class="sm_data_col txtCtr">{{$x->Religion}}</td>
                                                <td class="sm_data_col txtCtr">{{$x->Blood_Type}}</td>
                                                <td class="sm_data_col txtCtr">{{$x->Weight}}</td>
                                                <td class="sm_data_col txtCtr">{{$x->Height}}</td>
                                                <td class="sm_data_col txtCtr">{{$x->Email_Address}}</td>
                                                <td class="sm_data_col txtCtr">{{$x->Election_Year_Last_Voted}}</td>
                                                <td class="sm_data_col txtCtr">@if($x->Resident_Status == 1) Yes @else No @endif</td>
                                                <td class="sm_data_col txtCtr">@if($x->Voter_Status == 1) Yes @else No @endif</td>
                                                <td class="sm_data_col txtCtr">{{$x->Election_Year_Last_Voted}}</td>
                                                <td class="sm_data_col txtCtr">@if($x->Resident_Voter == 1) Yes @else No @endif</td>
                                                <td class="sm_data_col txtCtr">@if ($x->Solo_Parent==1) Yes @else No @endif</td>
                                                <td class="sm_data_col txtCtr">@if ($x->Indigent==1) Yes @else No @endif</td>
                                                <td class="sm_data_col txtCtr">@if ($x->Beneficiary==1) Yes @else No @endif</td> -->
    <td class="sm_data_col txtCtr" style="display: flex;">
        <button class="view_inhabitants btn btn-primary" value="{{$x->Resident_ID}}" data-toggle="modal" data-target="#ViewInfo">View</button>&nbsp;
        <button class="edit_inhabitants btn btn-info" value="{{$x->Resident_ID}}" data-toggle="modal" data-target="#createInhabitants_Info">Edit</button>&nbsp;
        <button class="delete_inhabitants btn btn-danger" value="{{$x->Resident_ID}}">Delete</button>
    </td>
</tr>
@endforeach