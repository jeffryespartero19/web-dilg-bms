<table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
    <thead>
        <tr>
            @if($chk_Disaster_Supplies_Name!=0) <th style="border:1px solid black;">Disaster Supplies</th> @endif
            @if($chk_Disaster_Supplies_Quantity!=0) <th style="border:1px solid black;">Quantity</th> @endif
            @if($chk_Location!=0) <th style="border:1px solid black;">Location</th> @endif
            @if($chk_Remarks!=0) <th style="border:1px solid black;">Remarks</th> @endif
            @if($chk_Disaster_Name!=0) <th style="border:1px solid black;">Disaster Name</th> @endif
            @if($chk_Resident_Name!=0) <th style="border:1px solid black;">Brgy Official</th> @endif
            @if($chk_Active!=0) <th style="border:1px solid black;">is Active?</th> @endif
        </tr>
    </thead>
    <tbody>
        @foreach($details as $dtl) 
        <tr>
            @if($chk_Disaster_Supplies_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Disaster_Supplies_Name }}</td> @endif
            @if($chk_Disaster_Supplies_Quantity!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Disaster_Supplies_Quantity }}</td> @endif
            @if($chk_Location!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Location }}</td> @endif
            @if($chk_Remarks!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Remarks }}</td> @endif
            @if($chk_Disaster_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Disaster_Name }}</td> @endif
            @if($chk_Resident_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Resident_Name }}</td> @endif
            @if($chk_Active!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Active }}</td> @endif
        </tr>
        @endforeach
    </tbody>
</table>