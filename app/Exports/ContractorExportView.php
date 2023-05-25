<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class ContractorExportView implements FromView
{
    protected $chk_Contractor_Name,$chk_Contact_Person,$chk_Contact_No,$chk_Contractor_Address,$chk_Contractor_TIN,$chk_Remarks;

    function __construct($chk_Contractor_Name,$chk_Contact_Person,$chk_Contact_No,$chk_Contractor_Address,$chk_Contractor_TIN,$chk_Remarks)
    {
        $this->chk_Contractor_Name = $chk_Contractor_Name;
        $this->chk_Contact_Person = $chk_Contact_Person;
        $this->chk_Contact_No = $chk_Contact_No;
        $this->chk_Contractor_Address = $chk_Contractor_Address;
        $this->chk_Contractor_TIN = $chk_Contractor_TIN;
        $this->chk_Remarks = $chk_Remarks;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    { 

        $chk_Contractor_Name = $this->chk_Contractor_Name;
        $chk_Contact_Person = $this->chk_Contact_Person;
        $chk_Contact_No = $this->chk_Contact_No;
        $chk_Contractor_Address= $this->chk_Contractor_Address;
        $chk_Contractor_TIN=$this->chk_Contractor_TIN ;
        $chk_Remarks= $this->chk_Remarks;

        $details =DB::table('bpms_contractor as a')
        ->select(
            'a.Contractor_ID',
            'a.Contractor_Name',
            'a.Contact_Person',
            'a.Contact_No',
            'a.Contractor_Address',
            'a.Contractor_TIN',
            'a.Remarks',
        )
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->get();

        return view('bpms_transactions.ContractorExcel', compact(
            'chk_Contractor_Name',
            'chk_Contact_Person',
            'chk_Contact_No',
            'chk_Contractor_Address',
            'chk_Contractor_TIN',
            'chk_Remarks',
            'details'
        ));
    }
}
