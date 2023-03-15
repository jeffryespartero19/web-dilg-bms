<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class EmergencyEvacuationSiteExportView implements FromView
{ 
    protected $chk_Active,$chk_Emergency_Evacuation_Site_Name,$chk_Address,$chk_Capacity;

    function __construct($chk_Active,$chk_Emergency_Evacuation_Site_Name,$chk_Address,$chk_Capacity)
    {
        $this->chk_Active = $chk_Active;
        $this->chk_Emergency_Evacuation_Site_Name = $chk_Emergency_Evacuation_Site_Name;
        $this->chk_Address = $chk_Address;
        $this->chk_Capacity = $chk_Capacity;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        $chk_Active = $this->chk_Active;
        $chk_Emergency_Evacuation_Site_Name = $this->chk_Emergency_Evacuation_Site_Name;
        $chk_Address = $this->chk_Address;
        $chk_Capacity = $this->chk_Capacity;;

        $details = DB::table('bdris_emergency_evacuation_site as a')
        ->select(
            'a.Emergency_Evacuation_Site_ID',
            'a.Emergency_Evacuation_Site_Name',
            'a.Address',
            'a.Capacity',
            DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

        )
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->get();

        return view('bdris_transactions.EmergencyEvacuationSiteExcel', compact(
            'chk_Active',
            'chk_Emergency_Evacuation_Site_Name',
            'chk_Address',
            'chk_Capacity',
            'details'
        ));
    }
}
