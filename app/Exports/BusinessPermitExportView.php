<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class BusinessPermitExportView implements FromView
{
    protected $chk_Transaction_No, $chk_Business_Name, $chk_Resident_Name, $chk_New_or_Renewal, $chk_Owned_or_Rented, $chk_Occupation, $chk_CTC_No, $chk_Barangay_Business_Permit_Expiration_Date;

    function __construct($chk_Transaction_No, $chk_Business_Name, $chk_Resident_Name, $chk_New_or_Renewal, $chk_Owned_or_Rented, $chk_Occupation, $chk_CTC_No, $chk_Barangay_Business_Permit_Expiration_Date)
    {
        $this->chk_Transaction_No = $chk_Transaction_No;
        $this->chk_Business_Name = $chk_Business_Name;
        $this->chk_Resident_Name = $chk_Resident_Name;
        $this->chk_New_or_Renewal = $chk_New_or_Renewal;
        $this->chk_Owned_or_Rented = $chk_Owned_or_Rented;
        $this->chk_Occupation = $chk_Occupation;
        $this->chk_CTC_No = $chk_CTC_No;
        $this->chk_Barangay_Business_Permit_Expiration_Date = $chk_Barangay_Business_Permit_Expiration_Date;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        $chk_Transaction_No = $this->chk_Transaction_No;
        $chk_Business_Name = $this->chk_Business_Name;
        $chk_Resident_Name = $this->chk_Resident_Name;
        $chk_New_or_Renewal = $this->chk_New_or_Renewal;
        $chk_Owned_or_Rented = $this->chk_Owned_or_Rented;
        $chk_Occupation = $this->chk_Occupation;
        $chk_CTC_No = $this->chk_CTC_No;
        $chk_Barangay_Business_Permit_Expiration_Date = $this->chk_Barangay_Business_Permit_Expiration_Date;

        $details = DB::table('bcpcis_brgy_business_permits as a')
        ->leftjoin('bcpcis_brgy_payment_collected as b', 'a.Barangay_Permits_ID', '=', 'b.Barangay_Permits_ID')
        ->leftjoin('maintenance_bcpcis_barangay_business as f', 'a.Business_ID', '=', 'f.Business_ID')
        ->leftjoin('bips_brgy_inhabitants_information as g', 'a.Resident_ID', '=', 'g.Resident_ID')
       
            ->select(
                'a.Barangay_Permits_ID',
                'a.Transaction_No',
                'a.Occupation',
                'a.Barangay_Business_Permit_Expiration_Date',
                'b.CTC_No', 
                'f.Business_Name',
                DB::raw('CONCAT(g.First_Name, " ",LEFT(g.Middle_Name,1),". ",g.Last_Name) AS Resident_Name'),
                DB::raw('(CASE WHEN a.New_or_Renewal = false THEN "Renewal" ELSE "New" END) AS New_or_Renewal'),
                DB::raw('(CASE WHEN a.Owned_or_Rented = false THEN "Rented" ELSE "Owned" END) AS Owned_or_Rented'),
            
            )
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->get();

        return view('bcpcis_transactions.BusinessPermitExcel', compact(
            'chk_Transaction_No',
            'chk_Business_Name',
            'chk_Resident_Name',
            'chk_New_or_Renewal',
            'chk_Owned_or_Rented',
            'chk_Occupation',
            'chk_CTC_No',
            'chk_Barangay_Business_Permit_Expiration_Date',
            'details'
        ));
    }
}
