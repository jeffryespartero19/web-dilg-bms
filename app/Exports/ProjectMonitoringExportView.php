<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class ProjectMonitoringExportView implements FromView
{
    protected $chk_Project_Number,$chk_Project_Name,$chk_Total_Project_Cost,$chk_Exact_Location,$chk_Actual_Project_Start,$chk_Contractor_Name,$chk_Project_Type_Name,$chk_Project_Status_Name;

    function __construct($chk_Project_Number,$chk_Project_Name,$chk_Total_Project_Cost,$chk_Exact_Location,$chk_Actual_Project_Start,$chk_Contractor_Name,$chk_Project_Type_Name,$chk_Project_Status_Name)
    {
        $this->chk_Project_Number = $chk_Project_Number;
        $this->chk_Project_Name = $chk_Project_Name;
        $this->chk_Total_Project_Cost = $chk_Total_Project_Cost;
        $this->chk_Exact_Location = $chk_Exact_Location;
        $this->chk_Actual_Project_Start = $chk_Actual_Project_Start;
        $this->chk_Contractor_Name = $chk_Contractor_Name;
        $this->chk_Project_Type_Name = $chk_Project_Type_Name;
        $this->chk_Project_Status_Name = $chk_Project_Status_Name;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    { 

        $chk_Project_Number = $this->chk_Project_Number;
        $chk_Project_Name = $this->chk_Project_Name;
        $chk_Total_Project_Cost = $this->chk_Total_Project_Cost;
        $chk_Exact_Location= $this->chk_Exact_Location;
        $chk_Actual_Project_Start=$this->chk_Actual_Project_Start ;
        $chk_Contractor_Name= $this->chk_Contractor_Name;
        $chk_Project_Type_Name= $this->chk_Project_Type_Name;
        $chk_Project_Status_Name= $this->chk_Project_Status_Name;

        $details = DB::table('bpms_brgy_projects_monitoring as a')
        ->leftjoin('bpms_contractor as b', 'a.Contractor_ID', '=', 'b.Contractor_ID')
        ->leftjoin('maintenance_bpms_project_type as c', 'a.Project_Type_ID', '=', 'c.Project_Type_ID')
        ->leftjoin('maintenance_bpms_project_status as d', 'a.Project_Status_ID', '=', 'd.Project_Status_ID')
        ->select(
            'a.Brgy_Projects_ID',
            'a.Project_Number',
            'a.Project_Name',
            'a.Total_Project_Cost',
            'a.Exact_Location',
            'a.Actual_Project_Start',
            'b.Contractor_Name',
            'c.Project_Type_Name',
            'd.Project_Status_Name',

        ) 
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->get();

        return view('bpms_transactions.ProjectMonitoringExcel', compact(
            'chk_Project_Number',
            'chk_Project_Name',
            'chk_Total_Project_Cost',
            'chk_Exact_Location',
            'chk_Actual_Project_Start',
            'chk_Contractor_Name',
            'chk_Project_Type_Name',
            'chk_Project_Status_Name',
            'details'
        ));
    }
}
