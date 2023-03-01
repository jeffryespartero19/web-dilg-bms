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
        content: 'Page ' counter(page);
    }

    .hidden {
        display: none;
    }

    td,
    th,
    tr {
        font-size: 10px;
    }
</style>
<div class="page-border">
    <table style="width:100%;">
        <tr style="text-align: center;">
            <td style="font-size: 24px; font-weight:700;">List of @if($chk_Ordinance == 0)
                Ordinances
                @else
                Resolutions
                @endif</td>
        </tr>
        <tr style="text-align: center;">
            <td style="font-size: 24px; font-weight:700;">Sample</td>
        </tr>
    </table>
    <br>
    <table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
        <thead>
            <tr>
                <th @if($chk_Ordinance_No==0) class="hidden" @endif style="border:1px solid black;">@if($chk_Ordinance == 1)
                    Ordinance
                    @else
                    Resolution
                    @endif Number</th>
                <th @if($chk_Title==0) class="hidden" @endif style="border:1px solid black;">Title</th>
                <th @if($chk_Ordinance_No==0) class="hidden" @endif style="border:1px solid black;">Type</th>
                <th @if($chk_Approval==0) class="hidden" @endif style="border:1px solid black;">Date of Approval</th>
                <th @if($chk_Effectivity==0) class="hidden" @endif style="border:1px solid black;">Date of Effectivity</th>
                <th @if($chk_Status==0) class="hidden" @endif style="border:1px solid black;">Status</th>
                <th @if($chk_PROrdinance==0) class="hidden" @endif style="border:1px solid black;">Previous Related Ordinance</th>
                <th @if($chk_Approver==0) class="hidden" @endif style="border:1px solid black;">Approver</th>
                <th @if($chk_Barangay==0) class="hidden" @endif style="border:1px solid black;">Barangay</th>
                <th @if($chk_City==0) class="hidden" @endif style="border:1px solid black;">City/Municipality</th>
                <th @if($chk_Province==0) class="hidden" @endif style="border:1px solid black;">Province</th>
                <th @if($chk_Region==0) class="hidden" @endif style="border:1px solid black;">Region</th>
                <th @if($chk_Attester==0) class="hidden" @endif style="border:1px solid black;">Attester</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $dtl)
            <tr>
                <td @if($chk_Ordinance_No==0) class="hidden" @endif style="border:1px solid black; text-align:center">{{ $dtl->Ordinance_Resolution_No }}</td>
                <td @if($chk_Title==0) class="hidden" @endif style="border:1px solid black; text-align:center">{{ $dtl->Ordinance_Resolution_Title }}</td>
                <td @if($chk_Ordinance_No==0) class="hidden" @endif style="border:1px solid black; text-align:center">@if($dtl->Ordinance_or_Resolution == 0)
                    Ordinance
                    @else
                    Resolution
                    @endif</td>

                <td @if($chk_Approval==0) class="hidden" @endif style="border:1px solid black; text-align:center">{{ $dtl->Date_of_Approval }}</td>
                <td @if($chk_Effectivity==0) class="hidden" @endif style="border:1px solid black; text-align:center">{{ $dtl->Date_of_Effectivity }}</td>
                <td @if($chk_Status==0) class="hidden" @endif style="border:1px solid black; text-align:center">{{ $dtl->Name_of_Status }}</td>
                <td @if($chk_PROrdinance==0) class="hidden" @endif style="border:1px solid black; text-align:center">
                    @foreach($pro as $pros)
                    @if($pros->Ordinance_Resolution_ID == $dtl->Ordinance_Resolution_ID)
                    <span>{{ $pros->Ordinance_Resolution_No }}</span><br>
                    @endif
                    @endforeach
                </td>
                <td @if($chk_Approver==0) class="hidden" @endif style="border:1px solid black; text-align:center">{{ $dtl->Last_Name }}, {{ $dtl->First_Name }} {{ $dtl->Middle_Name }}</td>
                <td @if($chk_Barangay==0) class="hidden" @endif style="border:1px solid black; text-align:center">{{ $dtl->Barangay_Name }}</td>
                <td @if($chk_City==0) class="hidden" @endif style="border:1px solid black; text-align:center">{{ $dtl->City_Municipality_Name }}</td>
                <td @if($chk_Province==0) class="hidden" @endif style="border:1px solid black; text-align:center">{{ $dtl->Province_Name }}</td>
                <td @if($chk_Region==0) class="hidden" @endif style="border:1px solid black; text-align:center">{{ $dtl->Region_Name }}</td>
                <td @if($chk_Attester==0) class="hidden" @endif style="border:1px solid black; text-align:center">
                    @foreach($attester as $att)
                    @if($att->Ordinance_Resolution_ID == $dtl->Ordinance_Resolution_ID)
                    <span>{{ $att->Last_Name }}, {{ $att->First_Name }} {{ $att->Middle_Name }}</span><br>
                    @endif
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>