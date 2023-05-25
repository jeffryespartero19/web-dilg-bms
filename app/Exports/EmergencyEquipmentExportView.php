<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class EmergencyEquipmentExportView implements FromView
{
    protected $chk_Active,$chk_Emergency_Equipment_Name,$chk_Location;

    function __construct($chk_Active,$chk_Emergency_Equipment_Name,$chk_Location)
    {
        $this->chk_Active = $chk_Active;
        $this->chk_Emergency_Equipment_Name = $chk_Emergency_Equipment_Name;
        $this->chk_Location = $chk_Location;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        $chk_Active = $this->chk_Active;
        $chk_Emergency_Equipment_Name = $this->chk_Emergency_Equipment_Name;
        $chk_Location = $this->chk_Location;

        $details = DB::table('bdris_emergency_equipment as a')
        ->select(
            'a.Emergency_Equipment_ID',
            'a.Emergency_Equipment_Name',
            'a.Location',
            DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

        )
        ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->get();

        return view('bdris_transactions.EmergencyEquipmentExcel', compact(
            'chk_Active',
            'chk_Emergency_Equipment_Name',
            'chk_Location',
            'details'
        ));
    }
}
