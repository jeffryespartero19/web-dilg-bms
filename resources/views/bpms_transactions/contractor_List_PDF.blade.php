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
            <td style="font-size: 24px; font-weight:700;">Contrator List</td>
        </tr>
        <!-- <tr style="text-align: center;">
            <td style="font-size: 24px; font-weight:700;">Sample</td>
        </tr> -->
    </table>
    <br>
    <table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
        <thead>
            <tr>
                <th @if($chk_Contractor_Name==0) class="hidden" @endif style="border:1px solid black;">Contractor Name</th>
                <th @if($chk_Contact_Person==0) class="hidden" @endif style="border:1px solid black;">Contact Person</th>
                <th @if($chk_Contact_No==0) class="hidden" @endif style="border:1px solid black;">Contact No</th>
                <th @if($chk_Contractor_Address==0) class="hidden" @endif style="border:1px solid black;">Contractor Address</th>
                <th @if($chk_Contractor_TIN==0) class="hidden" @endif style="border:1px solid black;">Contractor TIN</th>
                <th @if($chk_Remarks==0) class="hidden" @endif style="border:1px solid black;">Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($db_entries as $x)
            <tr>
                <td @if($chk_Contractor_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Contractor_Name}}</td>
                <td @if($chk_Contact_Person==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Contact_Person}}</td>
                <td @if($chk_Contact_No==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Contact_No}}</td>
                <td @if($chk_Contractor_Address==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Contractor_Address}}</td>
                <td @if($chk_Contractor_TIN==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Contractor_TIN}}</td>
                <td @if($chk_Remarks==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Remarks}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>