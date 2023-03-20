<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class EmergencyTeamExportView implements FromView
{
    protected $chk_Active,$chk_Emergency_Team_Name,$chk_Emergency_Team_Hotline;

    function __construct($chk_Active,$chk_Emergency_Team_Name,$chk_Emergency_Team_Hotline)
    {
        $this->chk_Active = $chk_Active;
        $this->chk_Emergency_Team_Name = $chk_Emergency_Team_Name;
        $this->chk_Emergency_Team_Hotline = $chk_Emergency_Team_Hotline;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        $chk_Active = $this->chk_Active;
        $chk_Emergency_Team_Name = $this->chk_Emergency_Team_Name;
        $chk_Emergency_Team_Hotline = $this->chk_Emergency_Team_Hotline;

        $details = DB::table('bdris_emergency_team as a')
        ->select(
            'a.Emergency_Team_ID',
            'a.Emergency_Team_Name',
            'a.Emergency_Team_Hotline',
            DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

        )
        ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->get();

        return view('bdris_transactions.EmergencyTeamExcel', compact(
            'chk_Active',
            'chk_Emergency_Team_Name',
            'chk_Emergency_Team_Hotline',
            'details'
        ));
    }
}
