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
            <td style="font-size: 24px; font-weight:700;">Barangay Business List</td>
        </tr>
        <!-- <tr style="text-align: center;">
            <td style="font-size: 24px; font-weight:700;">Sample</td>
        </tr> -->
    </table>
    <br>
    <table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
        <thead>
            <tr>
                <th @if($chk_Business_Name==0) class="hidden" @endif style="border:1px solid black;">Business Name</th>
                <th @if($chk_Business_Type==0) class="hidden" @endif style="border:1px solid black;">Business Type</th>
                <th @if($chk_Business_Tin==0) class="hidden" @endif style="border:1px solid black;">Business Tin</th>
                <th @if($chk_Business_Owner==0) class="hidden" @endif style="border:1px solid black;">Business Owner</th>
                <th @if($chk_Business_Address==0) class="hidden" @endif style="border:1px solid black;">Business Address</th>
                <th @if($chk_Mobile_No==0) class="hidden" @endif style="border:1px solid black;">Mobile No</th>
                <th @if($chk_Active==0) class="hidden" @endif style="border:1px solid black;">is Active?</th>
            </tr>
        </thead>
        <tbody>
            @foreach($db_entries as $x)
            <tr>
                <td @if($chk_Business_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Business_Name}}</td>
                <td @if($chk_Business_Type==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Business_Type}}</td>
                <td @if($chk_Business_Tin==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Business_Tin}}</td>
                <td @if($chk_Business_Owner==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Business_Owner}}</td>
                <td @if($chk_Business_Address==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Business_Address}}</td>
                <td @if($chk_Mobile_No==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Mobile_No}}</td>
                <td @if($chk_Active==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Active}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>