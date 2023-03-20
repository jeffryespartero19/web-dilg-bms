<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class DisasterSuppliesExportView implements FromView
{
    protected $chk_Active,$chk_Disaster_Supplies_Name,$chk_Disaster_Supplies_Quantity,$chk_Location,$chk_Remarks,$chk_Disaster_Name,$chk_Resident_Name;

    function __construct($chk_Active,$chk_Disaster_Supplies_Name,$chk_Disaster_Supplies_Quantity,$chk_Location,$chk_Remarks,$chk_Disaster_Name,$chk_Resident_Name)
    {
        $this->chk_Active = $chk_Active;
        $this->chk_Disaster_Supplies_Name = $chk_Disaster_Supplies_Name;
        $this->chk_Disaster_Supplies_Quantity = $chk_Disaster_Supplies_Quantity;
        $this->chk_Location = $chk_Location;
        $this->chk_Remarks = $chk_Remarks;
        $this->chk_Disaster_Name = $chk_Disaster_Name;
        $this->chk_Resident_Name = $chk_Resident_Name;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        $chk_Active = $this->chk_Active;
        $chk_Disaster_Supplies_Name = $this->chk_Disaster_Supplies_Name;
        $chk_Disaster_Supplies_Quantity = $this->chk_Disaster_Supplies_Quantity;
        $chk_Location= $this->chk_Location;
        $chk_Remarks=$this->chk_Remarks ;
        $chk_Disaster_Name= $this->chk_Disaster_Name;
        $chk_Resident_Name=$this->chk_Resident_Name ;

        $details = DB::table('bdris_disaster_supplies as a')
        ->leftjoin('bips_brgy_officials_and_staff as f', 'a.Brgy_Officials_and_Staff_ID', '=', 'f.Brgy_Officials_and_Staff_ID')
        ->leftjoin('bips_brgy_inhabitants_information as g', 'g.Resident_ID', '=', 'f.Resident_ID')
        ->leftjoin('bdris_response_information as h', 'h.Disaster_Response_ID', '=', 'a.Disaster_Response_ID')
        ->select(
            'a.Disaster_Supplies_ID',
            'a.Disaster_Supplies_Name',
            'a.Disaster_Supplies_Quantity',
            'a.Location',
            'a.Remarks',
            'h.Disaster_Name',
            DB::raw('CONCAT(g.First_Name, " ",LEFT(g.Middle_Name,1),". ",g.Last_Name) AS Resident_Name'),
            DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),

        )
        ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->get();

        return view('bdris_transactions.DisasterSuppliesExcel', compact(
            'chk_Active',
            'chk_Disaster_Supplies_Name',
            'chk_Disaster_Supplies_Quantity',
            'chk_Location',
            'chk_Remarks',
            'chk_Disaster_Name',
            'chk_Resident_Name',
            'details'
        ));
    }
}
