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
            <td style="font-size: 24px; font-weight:700;">List of Barangay Projects</td>
        </tr>
        <tr style="text-align: center;">
            <td style="font-size: 24px; font-weight:700;">Sample</td>
        </tr>
    </table>
    <br>
    <table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border:1px solid black;">Project Number</th>
                <th style="border:1px solid black;">Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $dtl)
            <tr>
            <td style="border:1px solid black; text-align:center">{{ $dtl->{"Project_Number"} }}</td>
                <td style="border:1px solid black; text-align:center">{{ $dtl->{"Project_Name"} }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>