<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class DisasterTypeExportView implements FromView
{
    protected $chk_Active,$chk_Emergency_Equipment_Name,$chk_Emergency_Team_Name,$chk_Allocated_Fund_Name,$chk_Emergency_Evacuation_Site_Name,$chk_Disaster_Type;

    function __construct($chk_Active,$chk_Emergency_Equipment_Name,$chk_Emergency_Team_Name,$chk_Allocated_Fund_Name,$chk_Emergency_Evacuation_Site_Name,$chk_Disaster_Type)
    {
        $this->chk_Active = $chk_Active;
        $this->chk_Emergency_Equipment_Name = $chk_Emergency_Equipment_Name;
        $this->chk_Emergency_Team_Name = $chk_Emergency_Team_Name;
        $this->chk_Allocated_Fund_Name = $chk_Allocated_Fund_Name;
        $this->chk_Emergency_Evacuation_Site_Name = $chk_Emergency_Evacuation_Site_Name;
        $this->chk_Disaster_Type = $chk_Disaster_Type;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        $chk_Active = $this->chk_Active;
        $chk_Emergency_Equipment_Name = $this->chk_Emergency_Equipment_Name;
        $chk_Emergency_Team_Name = $this->chk_Emergency_Team_Name;
        $chk_Allocated_Fund_Name = $this->chk_Allocated_Fund_Name;
        $chk_Emergency_Evacuation_Site_Name = $this->chk_Emergency_Evacuation_Site_Name;
        $chk_Disaster_Type = $this->chk_Disaster_Type;

        $details = DB::table('maintenance_bdris_disaster_type as a')
        ->leftjoin('bdris_emergency_evacuation_site as b', 'a.Emergency_Evacuation_Site_ID', '=', 'b.Emergency_Evacuation_Site_ID')
        ->leftjoin('bdris_allocated_fund_source as c', 'a.Allocated_Fund_ID', '=', 'c.Allocated_Fund_ID')
        ->leftjoin('bdris_emergency_equipment as d', 'a.Emergency_Equipment_ID', '=', 'd.Emergency_Equipment_ID')
        ->leftjoin('bdris_emergency_team as e', 'a.Emergency_Team_ID', '=', 'e.Emergency_Team_ID')
        ->select(
            'a.Disaster_Type_ID',
            'a.Disaster_Type',
            'b.Emergency_Evacuation_Site_Name',
            'c.Allocated_Fund_Name',
            'e.Emergency_Team_Name',
            'd.Emergency_Equipment_Name',
            DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),
            )
            ->get();

        return view('bdris_transactions.DisasterTypeExcel', compact(
            'chk_Active',
            'chk_Emergency_Equipment_Name',
            'chk_Emergency_Team_Name',
            'chk_Allocated_Fund_Name',
            'chk_Emergency_Evacuation_Site_Name',
            'chk_Disaster_Type',
            'details'
        ));
    }
}
