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
    <table style="width:100%;">
        <tr style="text-align: center;">
            <td style="font-size: 24px; font-weight:700;">List of Allocated Fund</td>
        </tr>
        
    </table>
    <br>
    <table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border:1px solid black;">Disaster Name</th>
                <th style="border:1px solid black;">Alert Level</th>
                <th style="border:1px solid black;">Damaged Location</th>
                <th style="border:1px solid black;">Disaster Date Start</th>
                <th style="border:1px solid black;">Disaster Date End</th>
                <th style="border:1px solid black;">GPS Coordinates </th>
                <th style="border:1px solid black;">Risk Assesment</th>
                <th style="border:1px solid black;">Action Taken</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $dtl)
            <tr>
                <td style="border:1px solid black; text-align:center">{{ $dtl->{"Disaster_Name"} }}</td>
                <td style="border:1px solid black; text-align:center">{{ $dtl->{"Alert_Level"} }}</td>
                <td style="border:1px solid black; text-align:center">{{ $dtl->{"Damaged_Location"} }}</td>
                <td style="border:1px solid black; text-align:center">{{ $dtl->{"Disaster_Date_Start"} }}</td>
                <td style="border:1px solid black; text-align:center">{{ $dtl->{"Disaster_Date_End"} }}</td>
                <td style="border:1px solid black; text-align:center">{{ $dtl->{"GPS_Coordinates"} }}</td>
                <td style="border:1px solid black; text-align:center">{{ $dtl->{"Risk_Assesment"} }}</td>
                <td style="border:1px solid black; text-align:center">{{ $dtl->{"Action_Taken"} }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>