<style>
    @page {
        margin: 10px;
    }

    .page-border {
        position: fixed;
        left: 10px;
        top: 10px;
        bottom: 10px;
        right: 10px;
        border: 2px dotted black;
    }

    .pagenum:before {
        content: 'Page 'counter(page);
    }
</style>
<div class="page-border">
    <br>
    <br>
    <table style="width:100%;">
        @foreach($details as $dtl)
        <tr style="text-align: center;">
            <td style="font-size: 12px; font-weight:700;">Republic of the Philippines</td>
        </tr>
        <tr style="text-align: center;">
            <td style="font-size: 12px; font-weight:700;">Province of {{ $dtl->{"Province_Name"} }}</td>
        </tr>
        <tr style="text-align: center;">
            <td style="font-size: 12px; font-weight:700;">City of {{ $dtl->{"City_Municipality_Name"} }}</td>
        </tr>
        <tr style="text-align: center;">
            <td style="font-size: 16px; font-weight:700;"><b>BARANGAAY {{ $dtl->{"Barangay_Name"} }}</b></td>
        </tr>
        <tr style="text-align: center;">
            <td style="font-size: 16px; font-weight:700;"><b>Office of The Sangguniang Barangay</b></td>
        </tr>
        <tr style="text-align: center;">
            <hr>
        </tr>
        <br>
        
    </table>
    <br>
    <br>
    <table style="width:100%;">
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 26px; font-weight:700; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>BRGY. CERTIFICATION</b></td>
        </tr>
        <br>
        <br>
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 14px; font-weight:700;  "><b>To Whom It May Concern:</b></td>
        </tr>
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 14px; font-weight:700; line-height: 1.5;"><p align="justify">This is to certify that <u>{{ $dtl->{"Resident_Name"} }}</u>
            is {{ $dtl->{"Civil_Status"} }} married to <u>{{ $dtl->{"SecondResident_Name"} }} </u>,<u>{{ $dtl->{"Age"} }}</u> years old, Filipino is a resident of the Barangay
            with postal address at <u>{{ $dtl->{"Resident_Address"} }}</u>.</p></td>
        </tr>
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 14px; font-weight:700; line-height: 1.5;"><p align="justify">       He/She is personally known to me to be a law abiding citizen and has a good moral character.
            Records of this barangay has shown that he/she has not commited nor been involved in ant kind on unlawful activitites in this barangay.
            </p></td>
        </tr>
        <br>
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 14px; font-weight:700; ">This certificate is issued upon request for <u>{{ $dtl->{"Purpose_of_Document"} }}</u>.</td>
        </tr>
        <br>
        <br>
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 14px; font-weight:700; ">Issued this <u>{{ $dtl->{"Issued_Day"} }}{{ $dtl->{"OrdinalNumber"} }}</u> day of <u>{{ $dtl->{"MThName"} }}
                ,{{ $dtl->{"IssuedYear"} }}
            </u></td>
        </tr>
        <br>
        <br>
        <br>
        <br>
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 14px; font-weight:700; ">_______________________________</td>
        </tr>
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 14px; font-weight:700; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SPECIMEN SIGNATURE</td>
        </tr>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 11px; font-weight:700; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            ___________________________________</td>
        </tr>
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 11px; font-weight:700; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Punong Barangay</i></td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; ">Brgy. Cert No. &nbsp;&nbsp;{{ $dtl->{"Brgy_Cert_No"} }}</td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; ">Cert Fee &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $dtl->{"Cash_Tendered"} }}</td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; ">Res. Cert No. &nbsp;&nbsp;&nbsp;&nbsp;_________</td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; ">Issued At &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $dtl->{"Issued_At"} }}</td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; ">Issued On &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $dtl->{"Issued_On"} }}</td>
        </tr>
    </table>
    @endforeach
</div>