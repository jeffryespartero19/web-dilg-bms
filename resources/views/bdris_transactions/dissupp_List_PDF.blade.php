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
            <td style="font-size: 24px; font-weight:700;">Disaster Supplies List</td>
        </tr>
        <!-- <tr style="text-align: center;">
            <td style="font-size: 24px; font-weight:700;">Sample</td>
        </tr> -->
    </table>
    <br>
    <table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
        <thead>
            <tr>
                <th @if($chk_Disaster_Supplies_Name==0) class="hidden" @endif style="border:1px solid black;">Disaster Supplies Name</th>
                <th @if($chk_Disaster_Supplies_Quantity==0) class="hidden" @endif style="border:1px solid black;">Disaster Supplies Quantity</th>
                <th @if($chk_Location==0) class="hidden" @endif style="border:1px solid black;">Location</th>
                <th @if($chk_Remarks==0) class="hidden" @endif style="border:1px solid black;">Remarks</th>
                <th @if($chk_Disaster_Name==0) class="hidden" @endif style="border:1px solid black;">Disaster Name</th>
                <th @if($chk_Resident_Name==0) class="hidden" @endif style="border:1px solid black;">Brgy Official</th>
                <th @if($chk_Active==0) class="hidden" @endif style="border:1px solid black;">is Active?</th>
            </tr>
        </thead>
        <tbody>
            @foreach($db_entries as $x)
            <tr>
                <td @if($chk_Disaster_Supplies_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Disaster_Supplies_Name}}</td>
                <td @if($chk_Disaster_Supplies_Quantity==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Disaster_Supplies_Quantity}}</td>
                <td @if($chk_Location==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Location}}</td>
                <td @if($chk_Remarks==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Remarks}}</td>
                <td @if($chk_Disaster_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Disaster_Name}}</td>
                <td @if($chk_Resident_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Resident_Name}}</td>
                <td @if($chk_Active==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Active}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>