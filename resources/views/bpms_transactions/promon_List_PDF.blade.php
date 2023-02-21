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
            <td style="font-size: 24px; font-weight:700;">Project Monitoring List</td>
        </tr>
        <!-- <tr style="text-align: center;">
            <td style="font-size: 24px; font-weight:700;">Sample</td>
        </tr> -->
    </table>
    <br>
    <table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
        <thead>
            <tr>
                <th @if($chk_Project_Number==0) class="hidden" @endif style="border:1px solid black;">Project Number</th>
                <th @if($chk_Project_Name==0) class="hidden" @endif style="border:1px solid black;">Project Name</th>
                <th @if($chk_Total_Project_Cost==0) class="hidden" @endif style="border:1px solid black;">Total Project Cost</th>
                <th @if($chk_Exact_Location==0) class="hidden" @endif style="border:1px solid black;">Exact Location</th>
                <th @if($chk_Actual_Project_Start==0) class="hidden" @endif style="border:1px solid black;">Actual Project Start</th>
                <th @if($chk_Contractor_Name==0) class="hidden" @endif style="border:1px solid black;">Contractor Name</th>
                <th @if($chk_Project_Type_Name==0) class="hidden" @endif style="border:1px solid black;">Project Type Name</th>
                <th @if($chk_Project_Status_Name==0) class="hidden" @endif style="border:1px solid black;">Project Status Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($db_entries as $x)
            <tr>
                <td @if($chk_Project_Number==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Project_Number}}</td>
                <td @if($chk_Project_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Project_Name}}</td>
                <td @if($chk_Total_Project_Cost==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Total_Project_Cost}}</td>
                <td @if($chk_Exact_Location==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Exact_Location}}</td>
                <td @if($chk_Actual_Project_Start==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Actual_Project_Start}}</td>
                <td @if($chk_Contractor_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Contractor_Name}}</td>
                <td @if($chk_Project_Type_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Project_Type_Name}}</td>
                <td @if($chk_Project_Status_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Project_Status_Name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>