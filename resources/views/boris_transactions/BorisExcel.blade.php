<table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
    <thead>
        <tr>
            @if($chk_Ordinance_No!=0) <th style="border:1px solid black;">
                @if($chk_Ordinance == 0)
                Ordinance
                @else
                Resolution
                @endif Number</th>
            @endif
            @if($chk_Title!=0) <th style="border:1px solid black;">Title</th> @endif
            @if($chk_Ordinance_No!=0) <th style="border:1px solid black;">Type</th> @endif
            @if($chk_Approval!=0) <th style="border:1px solid black;">Date of Approval</th> @endif
            @if($chk_Effectivity!=0) <th style="border:1px solid black;">Date of Effectivity</th> @endif
            @if($chk_Status!=0) <th style="border:1px solid black;">Status</th> @endif
            @if($chk_PROrdinance!=0) <th style="border:1px solid black;">Previous Related Ordinance</th> @endif
            @if($chk_Approver!=0) <th style="border:1px solid black;">Approver</th> @endif
            @if($chk_Barangay!=0) <th style="border:1px solid black;">Barangay</th> @endif
            @if($chk_City!=0) <th style="border:1px solid black;">City/Municipality</th> @endif
            @if($chk_Province!=0) <th style="border:1px solid black;">Province</th> @endif
            @if($chk_Region!=0) <th style="border:1px solid black;">Region</th> @endif
            @if($chk_Attester!=0) <th style="border:1px solid black;">Attester</th> @endif
        </tr>
    </thead>
    <tbody>
        @foreach($details as $dtl)
        <tr>
            @if($chk_Ordinance_No!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Ordinance_Resolution_No }}</td> @endif
            @if($chk_Title!=0)<td style="border:1px solid black; text-align:center">{{ $dtl->Ordinance_Resolution_Title }}</td> @endif
            @if($chk_Ordinance_No!=0)
            <td style="border:1px solid black; text-align:center">@if($dtl->Ordinance_or_Resolution == 0)
                Ordinance
                @else
                Resolution
                @endif</td>
            @endif

            @if($chk_Approval!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Date_of_Approval }}</td> @endif
            @if($chk_Effectivity!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Date_of_Effectivity }}</td> @endif
            @if($chk_Status!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Name_of_Status }}</td> @endif
            @if($chk_PROrdinance!=0)
            <td style="border:1px solid black; text-align:center">
                @foreach($pro as $pros)
                @if($pros->Ordinance_Resolution_ID == $dtl->Ordinance_Resolution_ID)
                <span>{{ $pros->Ordinance_Resolution_No }}</span><br>
                @endif
                @endforeach
            </td>
            @endif
            @if($chk_Approver!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Last_Name }}, {{ $dtl->First_Name }} {{ $dtl->Middle_Name }}</td> @endif
            @if($chk_Barangay!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Barangay_Name }}</td> @endif
            @if($chk_City!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->City_Municipality_Name }}</td> @endif
            @if($chk_Province!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Province_Name }}</td> @endif
            @if($chk_Region!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Region_Name }}</td> @endif
            @if($chk_Attester!=0)
            <td style="border:1px solid black; text-align:center">
                @foreach($attester as $att)
                @if($att->Ordinance_Resolution_ID == $dtl->Ordinance_Resolution_ID)
                <span>{{ $att->Last_Name }}, {{ $att->First_Name }} {{ $att->Middle_Name }}</span><br>
                @endif
                @endforeach
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>