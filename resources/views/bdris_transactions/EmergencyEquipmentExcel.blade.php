<table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
    <thead>
        <tr>
            @if($chk_Emergency_Equipment_Name!=0) <th style="border:1px solid black;">Emergency Equipment</th> @endif
            @if($chk_Location!=0) <th style="border:1px solid black;">Location</th> @endif
            @if($chk_Active!=0) <th style="border:1px solid black;">is Active?</th> @endif
        </tr>
    </thead>
    <tbody>
        @foreach($details as $dtl) 
        <tr>
            @if($chk_Emergency_Equipment_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Emergency_Equipment_Name }}</td> @endif
            @if($chk_Location!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Location }}</td> @endif
            @if($chk_Active!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Active }}</td> @endif
        </tr>
        @endforeach
    </tbody>
</table>