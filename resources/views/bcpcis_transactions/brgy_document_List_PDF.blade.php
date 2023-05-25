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

    .hidden {
        display: none;
    }

    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .pagenum:before {
        content: 'Page 'counter(page);
    }
</style>
<div class="page-border">
    <table style="width:100%;">
        <tr style="text-align: center;">
            <td style="font-size: 24px; font-weight:700;">Brgy Document List</td>
        </tr>
        <!-- <tr style="text-align: center;">
            <td style="font-size: 24px; font-weight:700;">Sample</td>
        </tr> -->
    </table>
    <br>
    <table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
        <thead>
            <tr>
                <th @if($chk_Transaction_No==0) class="hidden" @endif style="border:1px solid black;">Transaction No</th>
                <th @if($chk_Brgy_Cert_No==0) class="hidden" @endif style="border:1px solid black;">Brgy Cert No</th>
                <th @if($chk_Document_Type_Name==0) class="hidden" @endif style="border:1px solid black;">Document Type Name</th>
                <th @if($chk_Resident_Name==0) class="hidden" @endif style="border:1px solid black;">Resident Name</th>
                <th @if($chk_Request_Date==0) class="hidden" @endif style="border:1px solid black;">Request Date</th>
                <th @if($chk_Purpose_of_Document==0) class="hidden" @endif style="border:1px solid black;">Purpose of Document</th>
                <th @if($chk_Remarks==0) class="hidden" @endif style="border:1px solid black;">Remarks</th>
                <th @if($chk_Salutation_Name==0) class="hidden" @endif style="border:1px solid black;">Salutation Name</th>
                <th @if($chk_Issued_On==0) class="hidden" @endif style="border:1px solid black;">Issued On</th>
                <th @if($chk_SecondResident_Name==0) class="hidden" @endif style="border:1px solid black;">SecondResident Name</th>
                <th @if($chk_OR_No==0) class="hidden" @endif style="border:1px solid black;">OR No</th>
                <th @if($chk_Cash_Tendered==0) class="hidden" @endif style="border:1px solid black;">Cash Tendered</th>
                <th @if($chk_Released==0) class="hidden" @endif style="border:1px solid black;">is Released?</th>
            </tr>
        </thead>
        <tbody>
            @foreach($db_entries as $x)
            <tr>
                <td @if($chk_Transaction_No==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Transaction_No}}</td>
                <td @if($chk_Brgy_Cert_No==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Brgy_Cert_No}}</td>
                <td @if($chk_Document_Type_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Document_Type_Name}}</td>
                <td @if($chk_Resident_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Resident_Name}}</td>
                <td @if($chk_Request_Date==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Request_Date}}</td>
                <td @if($chk_Purpose_of_Document==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Purpose_of_Document}}</td>
                <td @if($chk_Remarks==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Remarks}}</td>
                <td @if($chk_Salutation_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Salutation_Name}}</td>
                <td @if($chk_Issued_On==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Issued_On}}</td>
                <td @if($chk_SecondResident_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->SecondResident_Name}}</td>
                <td @if($chk_OR_No==0) class="hidden" @else class="sm_data_col" @endif>{{$x->OR_No}}</td>
                <td @if($chk_Cash_Tendered==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Cash_Tendered}}</td>
                <td @if($chk_Released==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Released}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>