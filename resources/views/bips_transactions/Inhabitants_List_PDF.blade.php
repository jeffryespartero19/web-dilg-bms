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
            <td style="font-size: 24px; font-weight:700;">Inhabitants List</td>
        </tr>
        <!-- <tr style="text-align: center;">
            <td style="font-size: 24px; font-weight:700;">Sample</td>
        </tr> -->
    </table>
    <br>
    <table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
        <thead>
            <tr>
                <th @if($chk_Name==0) class="hidden" @endif style="border:1px solid black;">Name</th>
                <th @if($chk_Birthplace==0) class="hidden" @endif style="border:1px solid black;">Birthplace</th>
                <th @if($chk_Birthdate==0) class="hidden" @endif style="border:1px solid black;">Birthdate</th>
                <th @if($chk_Age==0) class="hidden" @endif style="border:1px solid black;">Age</th>
                <th @if($chk_Street==0) class="hidden" @endif style="border:1px solid black;">Street</th>
                <th @if($chk_Civil_Status==0) class="hidden" @endif style="border:1px solid black;">Civil Status</th>
                <th @if($chk_Mobile==0) class="hidden" @endif style="border:1px solid black;">Mobile Number</th>
                <th @if($chk_Landline==0) class="hidden" @endif style="border:1px solid black;">Landline Number</th>
                <th @if($chk_Resident_Status==0) class="hidden" @endif style="border:1px solid black;">Resident Status</th>
                <th @if($chk_Solo_Parent==0) class="hidden" @endif style="border:1px solid black;">Solo Parent</th>
                <th @if($chk_Indigent==0) class="hidden" @endif style="border:1px solid black;">Indigent</th>
                <th @if($chk_Beneficiary==0) class="hidden" @endif style="border:1px solid black;">4P's Beneficiary</th>
            </tr>
        </thead>
        <tbody>
            @foreach($db_entries as $x)
            <tr>
                <td @if($chk_Name==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Last_Name}}, {{$x->First_Name}} {{$x->Middle_Name}} {{$x->Name_Suffix}}</td>
                <td @if($chk_Birthplace==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Birthplace}}</td>
                <td @if($chk_Birthdate==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Birthdate}}</td>
                <td @if($chk_Age==0) class="hidden" @else class="sm_data_col" @endif>
                    <?php
                    $age = date_diff(date_create($x->Birthdate), date_create('now'))->y;
                    echo $age;
                    ?>
                </td>
                <td @if($chk_Street==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Street}}</td>
                <td @if($chk_Civil_Status==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Civil_Status}}</td>
                <td @if($chk_Mobile==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Mobile_No}}</td>
                <td @if($chk_Landline==0) class="hidden" @else class="sm_data_col" @endif>{{$x->Telephone_No}}</td>
                <td @if($chk_Resident_Status==0) class="hidden" @else class="sm_data_col" @endif>@if ($x->Solo_Parent==1) Yes @else No @endif</td>
                <td @if($chk_Solo_Parent==0) class="hidden" @else class="sm_data_col" @endif>@if ($x->Solo_Parent==1) Yes @else No @endif</td>
                <td @if($chk_Indigent==0) class="hidden" @else class="sm_data_col" @endif>@if ($x->Indigent==1) Yes @else No @endif</td>
                <td @if($chk_Beneficiary==0) class="hidden" @else class="sm_data_col" @endif>@if ($x->Beneficiary==1) Yes @else No @endif</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>