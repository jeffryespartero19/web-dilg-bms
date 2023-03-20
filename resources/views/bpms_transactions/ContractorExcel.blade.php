<table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
    <thead>
        <tr>
            @if($chk_Contractor_Name!=0) <th style="border:1px solid black;">Contractor</th> @endif
            @if($chk_Contact_Person!=0) <th style="border:1px solid black;">Contact Person</th> @endif
            @if($chk_Contact_No!=0) <th style="border:1px solid black;">Contact No</th> @endif
            @if($chk_Contractor_Address!=0) <th style="border:1px solid black;">Contractor Address</th> @endif
            @if($chk_Contractor_TIN!=0) <th style="border:1px solid black;">Contractor TIN</th> @endif
            @if($chk_Remarks!=0) <th style="border:1px solid black;">Remarks</th> @endif
        </tr>
    </thead>
    <tbody>
        @foreach($details as $dtl) 
        <tr>
            @if($chk_Contractor_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Contractor_Name }}</td> @endif
            @if($chk_Contact_Person!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Contact_Person }}</td> @endif
            @if($chk_Contact_No!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Contact_No }}</td> @endif
            @if($chk_Contractor_Address!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Contractor_Address }}</td> @endif
            @if($chk_Contractor_TIN!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Contractor_TIN }}</td> @endif
            @if($chk_Remarks!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Remarks }}</td> @endif
        </tr>
        @endforeach
    </tbody>
</table>