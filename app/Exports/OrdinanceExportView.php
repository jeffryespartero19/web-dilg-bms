<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class OrdinanceExportView implements FromView
{



    protected $chk_Ordinance, $chk_Ordinance_No, $chk_Approval, $chk_Effectivity, $chk_Title, $chk_Status, $chk_Region, $chk_Province, $chk_City, $chk_Barangay, $chk_Approver, $chk_Attester, $chk_PROrdinance;

    function __construct($chk_Ordinance, $chk_Ordinance_No, $chk_Approval, $chk_Effectivity, $chk_Title, $chk_Status, $chk_Region, $chk_Province, $chk_City, $chk_Barangay, $chk_Approver, $chk_Attester, $chk_PROrdinance)
    {
        $this->chk_Ordinance = $chk_Ordinance;
        $this->chk_Ordinance_No = $chk_Ordinance_No;
        $this->chk_Approval = $chk_Approval;
        $this->chk_Effectivity = $chk_Effectivity;
        $this->chk_Title = $chk_Title;
        $this->chk_Status = $chk_Status;
        $this->chk_Region = $chk_Region;
        $this->chk_Province = $chk_Province;
        $this->chk_City = $chk_City;
        $this->chk_Barangay = $chk_Barangay;
        $this->chk_Approver = $chk_Approver;
        $this->chk_Attester = $chk_Attester;
        $this->chk_PROrdinance = $chk_PROrdinance;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        $chk_Ordinance = $this->chk_Ordinance;
        $chk_Ordinance_No = $this->chk_Ordinance_No;
        $chk_Approval = $this->chk_Approval;
        $chk_Effectivity = $this->chk_Effectivity;
        $chk_Title = $this->chk_Title;
        $chk_Status = $this->chk_Status;
        $chk_Region = $this->chk_Region;
        $chk_Province = $this->chk_Province;
        $chk_City = $this->chk_City;
        $chk_Barangay = $this->chk_Barangay;
        $chk_Approver = $this->chk_Approver;
        $chk_Attester = $this->chk_Attester;
        $chk_PROrdinance = $this->chk_PROrdinance;

        $details = DB::table('boris_brgy_ordinances_and_resolutions_information as a')
            ->leftjoin('maintenance_boris_status_of_ordinance_or_resolution as b', 'a.Status_of_Ordinance_or_Resolution_ID', '=', 'b.Status_of_Ordinance_or_Resolution_ID')
            ->leftjoin('bips_brgy_inhabitants_information as g', 'a.Approver_ID', '=', 'g.Resident_ID')
            ->leftjoin('maintenance_barangay as ab', 'a.Barangay_ID', '=', 'ab.Barangay_ID')
            ->leftjoin('maintenance_city_municipality as ac', 'a.City_Municipality_ID', '=', 'ac.City_Municipality_ID')
            ->leftjoin('maintenance_province as ap', 'a.Province_ID', '=', 'ap.Province_ID')
            ->leftjoin('maintenance_region as ar', 'a.Region_ID', '=', 'ar.Region_ID')
            ->select(
                'a.Ordinance_Resolution_ID',
                'a.Ordinance_or_Resolution',
                'a.Ordinance_Resolution_No',
                DB::raw('DATE_FORMAT(a.Date_of_Approval,  "%M %d,%Y") as Date_of_Approval'),
                DB::raw('DATE_FORMAT(a.Date_of_Effectivity, "%M %d,%Y") as Date_of_Effectivity'),
                'a.Ordinance_Resolution_Title',
                'a.Status_of_Ordinance_or_Resolution_ID',
                'b.Name_of_Status',
                'g.Last_Name',
                'g.First_Name',
                'g.Middle_Name',
                'ab.Barangay_Name',
                'ac.City_Municipality_Name',
                'ap.Province_Name',
                'ar.Region_Name',

            )
            ->where('a.Ordinance_or_Resolution', $this->chk_Ordinance)
            ->get();

        $attester = DB::table('boris_attester as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->select(
                'b.Last_Name',
                'b.Middle_Name',
                'b.First_Name',
                'a.Ordinance_Resolution_ID'
            )
            ->get();

        $pro = DB::table('boris_pr_ordinance as a')
            ->leftjoin('boris_brgy_ordinances_and_resolutions_information as b', 'a.Previous_Related_Ordinance_Resolution_ID', '=', 'b.Ordinance_Resolution_ID')
            ->select(
                'a.Ordinance_Resolution_ID',
                'a.Previous_Related_Ordinance_Resolution_ID',
                'b.Ordinance_Resolution_No',
                'b.Ordinance_Resolution_Title'
            )
            ->get();

        return view('boris_transactions.BorisExcel', compact(
            'chk_Ordinance',
            'chk_Ordinance_No',
            'chk_Approval',
            'chk_Effectivity',
            'chk_Title',
            'chk_Status',
            'chk_Region',
            'chk_Province',
            'chk_City',
            'chk_Barangay',
            'details',
            'chk_Approver',
            'chk_Attester',
            'attester',
            'pro',
            'chk_PROrdinance'
        ));
    }
}
