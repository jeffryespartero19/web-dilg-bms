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
            <td style="font-size: 24px; font-weight:700;">Brgy Business Permit List</td>
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
                <th @if($chk_Business_Name==0) class="hidden" @endif style="border:1px solid black;">Business Name</th>
                <th @if($chk_Resident_Name==0) class="hidden" @endif style="border:1px solid black;">Resident Name</th>
                <th @if($chk_New_or_Renewal==0) class="hidden" @endif style="border:1px solid black;">New or Renewal</th>
                <th @if($chk_Owned_or_Rented==0) class="hidden" @endif style="border:1px solid black;">Owned or Rented</th>
                <th @if($chk_Occupation==0) class="hidden" @endif style="border:1px solid black;">Occupation</th>
                <th @if($chk_CTC_No==0) class="hidden" @endif style="border:1px solid black;">CTC No</th>
                <th @if($chk_Barangay_Business_Permit_Expiration_Date==0) class="hidden" @endif style="border:1px solid black;">Brgy Business Permit Expiration Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($db_entries as $x)
            <tr>
                <td @if($chk_Transaction_No==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Transaction_No}}</td>
                <td @if($chk_Business_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Business_Name}}</td>
                <td @if($chk_Resident_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Resident_Name}}</td>
                <td @if($chk_New_or_Renewal==0) class="hidden" @else class="sm_data_col" @endif>{{$x->New_or_Renewal}}</td>
                <td @if($chk_Owned_or_Rented==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Owned_or_Rented}}</td>
                <td @if($chk_Occupation==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Occupation}}</td>
                <td @if($chk_CTC_No==0) class="hidden" @else class="sm_data_col" @endif>{{$x->CTC_No}}</td>
                <td @if($chk_Barangay_Business_Permit_Expiration_Date==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Barangay_Business_Permit_Expiration_Date}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>