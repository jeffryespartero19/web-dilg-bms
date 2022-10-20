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
            <td style="font-size: 10px; font-weight:700;">REPUBLIC OF THE PHILIPPINES</td>
        </tr>
        <tr style="text-align: center;">
            <td style="font-size: 10px; font-weight:700;">PROVINCE OF {{ $dtl->{"Province_Name"} }}</td>
        </tr>
        <tr style="text-align: center;">
            <td style="font-size: 10px; font-weight:700;">MUNICIPALITY OF {{ $dtl->{"City_Municipality_Name"} }}</td>
        </tr>
        <tr style="text-align: center;">
            <td style="font-size: 14px; font-weight:700;"><b>BARANGAY {{ $dtl->{"Barangay_Name"} }}</b></td>
        </tr>
        <tr style="text-align: center;">
            <td style="font-size: 20px; font-weight:700;"><b>OFFICE OF THE PUNONG BARANGAY</b></td>
        </tr>
        <tr style="text-align: center;">
            <hr>
        </tr>
        <br>
        <tr style="text-align: center;">
            <td style="font-size: 26px; font-weight:700;"><b>Certificate of Residency</b></td>
        </tr>
        </table>
    <br>
    <br>
    <table style="width:100%;">
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 14px; font-weight:700; "><b>{{ $dtl->{"Resident_Name"} }}</b></td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 14px; font-weight:700; "><b>{{ $dtl->{"Resident_Address"} }}</b></td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 13px; font-weight:700; "><b>Marital Status : {{ $dtl->{"Civil_Status"} }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Birthdate : {{ $dtl->{"Birthdate"} }}</b></td>
        </tr>
            
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 13px; font-weight:700; "><b>Sex &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;: {{ $dtl->{"Gender"} }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Age &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $dtl->{"Age"} }}</b></td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 13px; font-weight:700; "><b>Citizenship &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b></td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 13px; font-weight:700; "><b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date Issued: {{ $dtl->{"Request_Date"} }}</b></td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 13px; font-weight:700; ">To Whom it may Concern:</td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 13px; font-weight:700; "><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that as per record the person whose, picture and signature appearing herein is a bonafide resident of this barangay with the following detail/s.</p></td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 13px; font-weight:700; "><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This Certification is issued upon the request of the interested party for reference and whatever purposes it may serve.</p></td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 13px; font-weight:700; "><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--oOo-- --oOo--</p></td>
        </tr>
        <br>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 14px; font-weight:700; "><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>{{ $dtl->{"Resident_Name"} }}</u></b></td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature Over Printed Name of Claimant </td>
        </tr>
        <br>
        <br>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Attested by: </td>
        </tr>
        <br>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 14px; font-weight:700; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>HON. ERWIN L. PONAYO</u> </td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Punong Barangay </td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; "><b>Paid under the following:</b></td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; ">OR Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $dtl->{"OR_Date"} }} </td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; ">OR No: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $dtl->{"OR_No"} }} </td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; ">Amt. Paid: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $dtl->{"Cash_Tendered"} }} </td>
        </tr>
        <br>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; "><b>CTC Details: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $dtl->{"CTC_Details"} }}</b></td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; ">CTC Date Issued: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $dtl->{"CTC_Date_Issued"} }} </td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; ">CTC No.: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $dtl->{"CTC_No"} }} </td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; ">CTC Amt.: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $dtl->{"CTC_Amount"} }} </td>
        </tr>
        <tr>
            <td style="width:30%"></td>
            <td style="width:70%; font-size: 12px; font-weight:700; ">Place Issued.: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $dtl->{"Place_Issued"} }} </td>
        </tr>
    </table>
        

    
    @endforeach
</div>