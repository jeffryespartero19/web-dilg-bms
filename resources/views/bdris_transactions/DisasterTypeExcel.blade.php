<table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
    <thead>
        <tr>
            @if($chk_Disaster_Type!=0) <th style="border:1px solid black;">Disaster Type</th> @endif
            @if($chk_Emergency_Evacuation_Site_Name!=0) <th style="border:1px solid black;">Emergency Evacuation Site</th> @endif
            @if($chk_Allocated_Fund_Name!=0) <th style="border:1px solid black;">Allocated Fund</th> @endif
            @if($chk_Emergency_Team_Name!=0) <th style="border:1px solid black;">Emergency Team</th> @endif
            @if($chk_Emergency_Equipment_Name!=0) <th style="border:1px solid black;">Emergency Equipment</th> @endif
            @if($chk_Active!=0) <th style="border:1px solid black;">is Active?</th> @endif
        </tr>
    </thead>
    <tbody>
        @foreach($details as $dtl)
        <tr>
            @if($chk_Disaster_Type!=0)<td style="border:1px solid black; text-align:center">{{ $dtl->Disaster_Type }}</td> @endif
            @if($chk_Emergency_Evacuation_Site_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Emergency_Evacuation_Site_Name }}</td> @endif
            @if($chk_Allocated_Fund_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Allocated_Fund_Name }}</td> @endif
            @if($chk_Emergency_Team_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Emergency_Team_Name }}</td> @endif
            @if($chk_Emergency_Equipment_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Emergency_Equipment_Name }}</td> @endif
            @if($chk_Active!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Active }}</td> @endif
        </tr>
        @endforeach
    </tbody>
</table>