<table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
    <thead>
        <tr>
            @if($chk_Name != 0) <th style="border:1px solid black;">Name</th> @endif
            @if($chk_Birthplace != 0) <th style="border:1px solid black;">Birthplace</th> @endif
            @if($chk_Birthdate != 0) <th style="border:1px solid black;">Birthdate</th> @endif
            @if($chk_Age != 0) <th style="border:1px solid black;">Age</th> @endif
            @if($chk_Civil_Status != 0) <th style="border:1px solid black;">Civil Status</th> @endif
            @if($chk_Mobile != 0) <th style="border:1px solid black;">Mobile Number</th> @endif
            @if($chk_Landline != 0) <th style="border:1px solid black;">Landline Number</th> @endif
            @if($chk_Resident_Status != 0) <th style="border:1px solid black;">Resident Status</th> @endif
            @if($chk_Solo_Parent != 0) <th style="border:1px solid black;">Solo Parent</th> @endif
            @if($chk_Indigent != 0) <th style="border:1px solid black;">Indigent</th> @endif
            @if($chk_Beneficiary != 0) <th style="border:1px solid black;">4P's Beneficiary</th> @endif
            @if($chk_Sex != 0) <th style="border:1px solid black;">Sex</th> @endif
            @if($chk_House_No != 0) <th style="border:1px solid black;">House No</th> @endif
            @if($chk_Street != 0) <th style="border:1px solid black;">Street</th> @endif
            @if($chk_Barangay != 0) <th style="border:1px solid black;">Barangay</th> @endif
            @if($chk_City_Municipality != 0) <th style="border:1px solid black;">City/Municipality</th> @endif
            @if($chk_Province != 0) <th style="border:1px solid black;">Province</th> @endif
            @if($chk_Region != 0) <th style="border:1px solid black;">Region</th> @endif
            @if($chk_Religion != 0) <th style="border:1px solid black;">Religion</th> @endif
            @if($chk_Blood_Type != 0) <th style="border:1px solid black;">Blood Type</th> @endif
            @if($chk_Weight != 0) <th style="border:1px solid black;">Weight</th> @endif
            @if($chk_Height != 0) <th style="border:1px solid black;">Height</th> @endif
            @if($chk_Email != 0) <th style="border:1px solid black;">Email</th> @endif
            @if($chk_Philsys_Number != 0) <th style="border:1px solid black;">Philsys Number</th> @endif
            @if($chk_Voter != 0) <th style="border:1px solid black;">Voter</th> @endif
            @if($chk_Year_Last_Voted != 0) <th style="border:1px solid black;">Year Last Voted</th> @endif
            @if($chk_Resident_Voter != 0) <th style="border:1px solid black;">Resident Voter</th> @endif
        </tr>
    </thead>
    <tbody>
        @foreach($db_entries as $x)
        <tr>
            @if($chk_Name != 0) <td>{{$x->Last_Name}}, {{$x->First_Name}} {{$x->Middle_Name}} {{$x->Name_Suffix}}</td> @endif
            @if($chk_Birthplace != 0) <td>{{$x->Birthplace}}</td> @endif
            @if($chk_Birthdate != 0) <td>{{$x->Birthdate}}</td> @endif
            @if($chk_Age != 0) <td>
                <?php
                $age = date_diff(date_create($x->Birthdate), date_create('now'))->y;
                echo $age;
                ?>
            </td>
            @endif
            @if($chk_Civil_Status != 0) <td>{{$x->Civil_Status}}</td> @endif
            @if($chk_Mobile != 0) <td>{{$x->Mobile_No}}</td> @endif
            @if($chk_Landline != 0) <td>{{$x->Telephone_No}}</td> @endif
            @if($chk_Resident_Status != 0) <td>@if ($x->Solo_Parent==1) Yes @else No @endif</td> @endif
            @if($chk_Solo_Parent != 0) <td>@if ($x->Solo_Parent==1) Yes @else No @endif</td> @endif
            @if($chk_Indigent != 0) <td>@if ($x->Indigent==1) Yes @else No @endif</td> @endif
            @if($chk_Beneficiary != 0) <td>@if ($x->Beneficiary==1) Yes @else No @endif</td> @endif
            @if($chk_Sex != 0) <td>@if ($x->Sex==1) Male @else Female @endif</td> @endif
            @if($chk_House_No != 0) <td>{{$x->House_No}}</td> @endif
            @if($chk_Street != 0) <td>{{$x->Street}}</td> @endif
            @if($chk_Barangay != 0) <td>{{$x->Barangay_Name}}</td> @endif
            @if($chk_City_Municipality != 0) <td>{{$x->City_Municipality_Name}}</td> @endif
            @if($chk_Province != 0) <td>{{$x->Province_Name}}</td> @endif
            @if($chk_Region != 0) <td>{{$x->Region_Name}}</td> @endif
            @if($chk_Religion != 0) <td>{{$x->Religion}}</td> @endif
            @if($chk_Blood_Type != 0) <td>{{$x->Blood_Type}}</td> @endif
            @if($chk_Weight != 0) <td>{{$x->Weight}}</td> @endif
            @if($chk_Height != 0) <td>{{$x->Height}}</td> @endif
            @if($chk_Email != 0) <td>{{$x->Email_Address}}</td> @endif
            @if($chk_Philsys_Number != 0) <td>{{$x->PhilSys_Card_No}}</td> @endif
            @if($chk_Voter != 0) <td>@if ($x->Voter_Status==1) Yes @else No @endif</td> @endif
            @if($chk_Year_Last_Voted != 0) <td>{{$x->Election_Year_Last_Voted}}</td> @endif
            @if($chk_Resident_Voter != 0) <td>@if ($x->Resident_Voter==1) Yes @else No @endif</td> @endif
        </tr>
        @endforeach
    </tbody>
</table>