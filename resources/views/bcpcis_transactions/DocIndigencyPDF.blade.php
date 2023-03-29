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
            <td style="font-size: 13px; font-weight:700;">PROVINCE OF {{ $dtl->{"Province_Name"} }}</td>
        </tr>
        <tr style="text-align: center;">
            <td style="font-size: 12px; font-weight:700;">Municipality of {{ $dtl->{"City_Municipality_Name"} }}</td>
        </tr>
        <tr style="text-align: center;">
            <td style="font-size: 14px; font-weight:700;"><b><u>BARANGAY {{ $dtl->{"Barangay_Name"} }}</u></b></td>
        </tr>
        <br>
        <tr style="text-align: center;">
            <td style="font-size: 18x; font-weight:700;"><b>OFFICE OF THE PUNONG BARANGAY</b></td>
        </tr>
        <br>
        <tr style="text-align: center;">
            <td style="font-size: 24px; font-weight:700;"><b>CERTIFICATE OF INDIGENCY</b></td>
        </tr>
        

    </table>
    <br>
    <br>
    <table style="width:100%;">
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 15px; font-weight:700; "><b>TO WHOM IT MAY CONCERN:</b></td>
        </tr>
        <BR>
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 14px; font-weight:700; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;THIS IS TO CERTIFY that <u>{{ $dtl->{"Resident_Name"} }}, of legal age.</u> a resident of Barangay</td>
        </tr>
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 14px; font-weight:700;">{{ $dtl->{"Barangay_Name_pro"} }} {{ $dtl->{"City_Municipality_Name"} }} 
            {{ $dtl->{"Province_Name_pro"} }} belongs to low income individual whose income is not</td>
        </tr>
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 14px; font-weight:700;">sufficient to their
            daily basic needs, therefore can be considered as <b>"INDIGENT"</b>.</td>
        </tr>
        <BR>
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 14px; font-weight:700; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;This certification is issued upon request of the above-named individual for her medical</td>
        </tr>
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 14px; font-weight:700;">assistance.</td>
        </tr>
        <BR>
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 14px; font-weight:700; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;Issued this <u>{{ $dtl->{"Issued_Day"} }}{{ $dtl->{"OrdinalNumber"} }}</u> day of <u>{{ $dtl->{"MThName"} }} {{ $dtl->{"IssuedYear"} }}</u> at Barangay
            {{ $dtl->{"Barangay_Name_pro"} }} {{ $dtl->{"City_Municipality_Name"} }} {{ $dtl->{"Province_Name_pro"} }}.
            </td>
        </tr>
        <BR>
        <BR>
        <BR>
        <BR>
        @foreach($details2 as $dtl2)
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 14px; font-weight:700;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><b>HON. {{ $dtl2->{"Chairman_Name"} }}</b></u></td>
        </tr>
        @endforeach
        <tr>
            <td style="width:10%"></td>
            <td style="width:90%; font-size: 13px; font-weight:700;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Punong Barangay</td>
        </tr>
    </table>
    @endforeach
</div>