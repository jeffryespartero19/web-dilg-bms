<table style="width:100%; border-top:1px solid black; border-bottom:1px solid black;border-collapse: collapse;">
    <thead>
        <tr>
            @if($chk_Project_Number!=0) <th style="border:1px solid black;">Project Number</th> @endif
            @if($chk_Project_Name!=0) <th style="border:1px solid black;">Project Name</th> @endif
            @if($chk_Total_Project_Cost!=0) <th style="border:1px solid black;">Project Cost</th> @endif
            @if($chk_Exact_Location!=0) <th style="border:1px solid black;">Exact Location</th> @endif
            @if($chk_Actual_Project_Start!=0) <th style="border:1px solid black;">Actual Project Start</th> @endif
            @if($chk_Contractor_Name!=0) <th style="border:1px solid black;">Contractor Name</th> @endif
            @if($chk_Project_Type_Name!=0) <th style="border:1px solid black;">Project Type</th> @endif
            @if($chk_Project_Status_Name!=0) <th style="border:1px solid black;">Project Status</th> @endif
        </tr>
    </thead>
    <tbody>
        @foreach($details as $dtl) 
        <tr>
            @if($chk_Project_Number!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Project_Number }}</td> @endif
            @if($chk_Project_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Project_Name }}</td> @endif
            @if($chk_Total_Project_Cost!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Total_Project_Cost }}</td> @endif
            @if($chk_Exact_Location!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Exact_Location }}</td> @endif
            @if($chk_Actual_Project_Start!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Actual_Project_Start }}</td> @endif
            @if($chk_Contractor_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Contractor_Name }}</td> @endif
            @if($chk_Project_Type_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Project_Type_Name }}</td> @endif
            @if($chk_Project_Status_Name!=0) <td style="border:1px solid black; text-align:center">{{ $dtl->Project_Status_Name }}</td> @endif
        </tr>
        @endforeach
    </tbody>
</table>