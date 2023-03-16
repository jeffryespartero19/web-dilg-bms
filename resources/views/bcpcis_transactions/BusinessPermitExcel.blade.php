<table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
    <thead>
        <tr>
            @if($chk_Transaction_No!=0) <th style="border:1px solid black;">Transaction No.</th> @endif
            @if($chk_Business_Name!=0) <th style="border:1px solid black;">Business Name</th> @endif
            @if($chk_Resident_Name!=0) <th style="border:1px solid black;">Resident Name</th> @endif
            @if($chk_New_or_Renewal!=0) <th style="border:1px solid black;">New or Renewal</th> @endif
            @if($chk_Owned_or_Rented!=0) <th style="border:1px solid black;">Owned or Rented</th> @endif
            @if($chk_Occupation!=0) <th style="border:1px solid black;">Occupation</th> @endif
            @if($chk_CTC_No!=0) <th style="border:1px solid black;">CTC No.</th> @endif
            @if($chk_Barangay_Business_Permit_Expiration_Date!=0) <th style="border:1px solid black;">Business Permit Expiration Date</th> @endif
        </tr>
    </thead>
    <tbody>
        @foreach($details as $dtl)
        <tr>
            @if($chk_Transaction_No!=0)<td style="border:1px solid black; text-align:center">{{ $dtl->Transaction_No }}</td> @endif
            @if($chk_Business_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Business_Name }}</td> @endif
            @if($chk_Resident_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Resident_Name }}</td> @endif
            @if($chk_New_or_Renewal!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->New_or_Renewal }}</td> @endif
            @if($chk_Owned_or_Rented!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Owned_or_Rented }}</td> @endif
            @if($chk_Occupation!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Occupation }}</td> @endif
            @if($chk_CTC_No!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->CTC_No }}</td> @endif
            @if($chk_Barangay_Business_Permit_Expiration_Date!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Barangay_Business_Permit_Expiration_Date }}</td> @endif
        </tr>
        @endforeach
    </tbody>
</table>