<table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
    <thead>
        <tr>
            @if($chk_Emergency_Evacuation_Site_Name!=0) <th style="border:1px solid black;">Emergency Evacuation Site</th> @endif
            @if($chk_Address!=0) <th style="border:1px solid black;">Address</th> @endif
            @if($chk_Capacity!=0) <th style="border:1px solid black;">Capacity</th> @endif
            @if($chk_Active!=0) <th style="border:1px solid black;">is Active?</th> @endif
        </tr>
    </thead>
    <tbody>
        @foreach($details as $dtl) 
        <tr>
            @if($chk_Emergency_Evacuation_Site_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Emergency_Evacuation_Site_Name }}</td> @endif
            @if($chk_Address!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Address }}</td> @endif
            @if($chk_Capacity!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Capacity }}</td> @endif
            @if($chk_Active!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Active }}</td> @endif
        </tr>
        @endforeach
    </tbody>
</table>