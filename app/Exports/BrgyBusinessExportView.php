<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class BrgyBusinessExportView implements FromView
{
    protected $chk_Active,$chk_Mobile_No,$chk_Business_Address,$chk_Business_Owner,$chk_Business_Tin,$chk_Business_Type,$chk_Business_Name;

    function __construct($chk_Active,$chk_Mobile_No,$chk_Business_Address,$chk_Business_Owner,$chk_Business_Tin,$chk_Business_Type,$chk_Business_Name)
    {
        $this->chk_Active = $chk_Active;
        $this->chk_Mobile_No = $chk_Mobile_No;
        $this->chk_Business_Address = $chk_Business_Address;
        $this->chk_Business_Owner = $chk_Business_Owner;
        $this->chk_Business_Tin = $chk_Business_Tin;
        $this->chk_Business_Type = $chk_Business_Type;
        $this->chk_Business_Name = $chk_Business_Name;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        $chk_Active = $this->chk_Active;
        $chk_Mobile_No = $this->chk_Mobile_No;
        $chk_Business_Address = $this->chk_Business_Address;
        $chk_Business_Owner = $this->chk_Business_Owner;
        $chk_Business_Tin = $this->chk_Business_Tin;
        $chk_Business_Type = $this->chk_Business_Type;
        $chk_Business_Name = $this->chk_Business_Name;

        $details = DB::table('maintenance_bcpcis_barangay_business as a')
        ->leftjoin('maintenance_bcpcis_business_type as b', 'a.Business_Type_ID', '=', 'b.Business_Type_ID')
            ->select(
                'a.Business_ID',
                'a.Business_Name',
                'a.Business_Tin',
                'a.Business_Owner',
                'a.Business_Address',
                'a.Mobile_No',    
                'b.Business_Type',
                DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active')

            )
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->get();

        return view('bcpcis_transactions.BrgyBusinessExcel', compact(
            'chk_Active',
            'chk_Mobile_No',
            'chk_Business_Address',
            'chk_Business_Owner',
            'chk_Business_Tin',
            'chk_Business_Type',
            'chk_Business_Name',
            'details'
        ));
    }
}
