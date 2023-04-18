<table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
    <thead>
        <tr>
            @if($chk_Transaction_No!=0) <th style="border:1px solid black;">Transaction No.</th> @endif
            @if($chk_Request_Date!=0) <th style="border:1px solid black;">Request Date</th> @endif
            @if($chk_Resident_Name!=0) <th style="border:1px solid black;">Resident Name</th> @endif
            @if($chk_Released!=0) <th style="border:1px solid black;">Released</th> @endif
            @if($chk_Remarks!=0) <th style="border:1px solid black;">Remarks</th> @endif
            @if($chk_Purpose_of_Document!=0) <th style="border:1px solid black;">Purpose of Document</th> @endif
            @if($chk_Salutation_Name!=0) <th style="border:1px solid black;">Salutation Name</th> @endif
            @if($chk_Issued_On!=0) <th style="border:1px solid black;">Issued On</th> @endif
            @if($chk_Brgy_Cert_No!=0) <th style="border:1px solid black;">Cert No</th> @endif
            @if($chk_Document_Type_Name!=0) <th style="border:1px solid black;">Document Type</th> @endif
            @if($chk_SecondResident_Name!=0) <th style="border:1px solid black;">Second Resident Name</th> @endif
            @if($chk_OR_No!=0) <th style="border:1px solid black;">OR No</th> @endif
            @if($chk_Cash_Tendered!=0) <th style="border:1px solid black;">Cash Tendered</th> @endif
        </tr>
    </thead>
    <tbody>
        @foreach($details as $dtl)
        <tr>
            @if($chk_Transaction_No!=0)<td style="border:1px solid black; text-align:center">{{ $dtl->Transaction_No }}</td> @endif
            @if($chk_Request_Date!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Request_Date }}</td> @endif
            @if($chk_Resident_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Resident_Name }}</td> @endif
            @if($chk_Released!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Released }}</td> @endif
            @if($chk_Remarks!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Remarks }}</td> @endif
            @if($chk_Purpose_of_Document!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Purpose_of_Document }}</td> @endif
            @if($chk_Salutation_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Salutation_Name }}</td> @endif
            @if($chk_Issued_On!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Issued_On }}</td> @endif
            @if($chk_Brgy_Cert_No!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Brgy_Cert_No }}</td> @endif
            @if($chk_Document_Type_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Document_Type_Name }}</td> @endif
            @if($chk_SecondResident_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->SecondResident_Name }}</td> @endif
            @if($chk_OR_No!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->OR_No }}</td> @endif
            @if($chk_Cash_Tendered!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Cash_Tendered }}</td> @endif
        </tr>
        @endforeach
    </tbody>
</table>