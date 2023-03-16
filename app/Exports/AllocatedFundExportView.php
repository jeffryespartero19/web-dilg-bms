<?php

namespace App\Exports;
 
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;


class AllocatedFundExportView implements FromView
{
    protected $chk_Active,$chk_Allocated_Fund_Name,$chk_Amount;

    function __construct($chk_Active,$chk_Allocated_Fund_Name,$chk_Amount)
    {
        $this->chk_Active = $chk_Active;
        $this->chk_Allocated_Fund_Name = $chk_Allocated_Fund_Name;
        $this->chk_Amount = $chk_Amount;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        $chk_Active = $this->chk_Active;
        $chk_Allocated_Fund_Name = $this->chk_Allocated_Fund_Name;
        $chk_Amount = $this->chk_Amount;

        $details = DB::table('bdris_allocated_fund_source as a')
        ->select(
            'a.Allocated_Fund_ID',
            'a.Allocated_Fund_Name',
            'a.Amount',
            DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

        )
        ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->get();

        return view('bdris_transactions.AllocatedFundExcel', compact(
            'chk_Active',
            'chk_Allocated_Fund_Name',
            'chk_Amount',
            'details'
        ));
    }
}
