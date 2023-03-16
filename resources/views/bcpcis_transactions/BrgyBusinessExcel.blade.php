<table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
    <thead>
        <tr>
            @if($chk_Business_Name!=0) <th style="border:1px solid black;">Business Name</th> @endif
            @if($chk_Business_Type!=0) <th style="border:1px solid black;">Business Type</th> @endif
            @if($chk_Business_Tin!=0) <th style="border:1px solid black;">Business TIN</th> @endif
            @if($chk_Business_Owner!=0) <th style="border:1px solid black;">Business Owner</th> @endif
            @if($chk_Business_Address!=0) <th style="border:1px solid black;">Business Address</th> @endif
            @if($chk_Mobile_No!=0) <th style="border:1px solid black;">Mobile No.</th> @endif
            @if($chk_Active!=0) <th style="border:1px solid black;">is Active?</th> @endif
        </tr>
    </thead>
    <tbody>
        @foreach($details as $dtl)
        <tr>
            @if($chk_Business_Name!=0)<td style="border:1px solid black; text-align:center">{{ $dtl->Business_Name }}</td> @endif
            @if($chk_Business_Type!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Business_Type }}</td> @endif
            @if($chk_Business_Tin!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Business_Tin }}</td> @endif
            @if($chk_Business_Owner!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Business_Owner }}</td> @endif
            @if($chk_Business_Address!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Business_Address }}</td> @endif
            @if($chk_Mobile_No!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Mobile_No }}</td> @endif
            @if($chk_Active!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Active }}</td> @endif
        </tr>
        @endforeach
    </tbody>
</table>