<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class InhabitantsExportView implements FromView
{
    protected $chk_Name, $chk_Birthplace, $chk_Birthdate, $chk_Age, $chk_Street, $chk_Civil_Status, $chk_Mobile, $chk_Landline, $chk_Resident_Status, $chk_Solo_Parent, $chk_Indigent, $chk_Beneficiary, $chk_Sex, $chk_House_No, $chk_Barangay, $chk_City_Municipality, $chk_Province, $chk_Region, $chk_Religion, $chk_Blood_Type, $chk_Weight, $chk_Height, $chk_Email, $chk_Philsys_Number, $chk_Voter, $chk_Year_Last_Voted, $chk_Resident_Voter;

    function __construct($chk_Name, $chk_Birthplace, $chk_Birthdate, $chk_Age, $chk_Street, $chk_Civil_Status, $chk_Mobile, $chk_Landline, $chk_Resident_Status, $chk_Solo_Parent, $chk_Indigent, $chk_Beneficiary, $chk_Sex, $chk_House_No, $chk_Barangay, $chk_City_Municipality, $chk_Province, $chk_Region, $chk_Religion, $chk_Blood_Type, $chk_Weight, $chk_Height, $chk_Email, $chk_Philsys_Number, $chk_Voter, $chk_Year_Last_Voted, $chk_Resident_Voter)
    {
        $this->chk_Name = $chk_Name;
        $this->chk_Birthplace = $chk_Birthplace;
        $this->chk_Birthdate = $chk_Birthdate;
        $this->chk_Age = $chk_Age;
        $this->chk_Street = $chk_Street;
        $this->chk_Civil_Status = $chk_Civil_Status;
        $this->chk_Mobile = $chk_Mobile;
        $this->chk_Landline = $chk_Landline;
        $this->chk_Resident_Status = $chk_Resident_Status;
        $this->chk_Solo_Parent = $chk_Solo_Parent;
        $this->chk_Indigent = $chk_Indigent;
        $this->chk_Beneficiary = $chk_Beneficiary;
        $this->chk_Sex = $chk_Sex;
        $this->chk_House_No = $chk_House_No;
        $this->chk_Barangay = $chk_Barangay;
        $this->chk_City_Municipality = $chk_City_Municipality;
        $this->chk_Province = $chk_Province;
        $this->chk_Region = $chk_Region;
        $this->chk_Religion = $chk_Religion;
        $this->chk_Blood_Type = $chk_Blood_Type;
        $this->chk_Weight = $chk_Weight;
        $this->chk_Height = $chk_Height;
        $this->chk_Email = $chk_Email;
        $this->chk_Philsys_Number = $chk_Philsys_Number;
        $this->chk_Voter = $chk_Voter;
        $this->chk_Year_Last_Voted = $chk_Year_Last_Voted;
        $this->chk_Resident_Voter = $chk_Resident_Voter;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $chk_Name = $this->chk_Name;
        $chk_Birthplace = $this->chk_Birthplace;
        $chk_Birthdate = $this->chk_Birthdate;
        $chk_Age = $this->chk_Age;
        $chk_Street = $this->chk_Street;
        $chk_Civil_Status = $this->chk_Civil_Status;
        $chk_Mobile = $this->chk_Mobile;
        $chk_Landline = $this->chk_Landline;
        $chk_Resident_Status = $this->chk_Resident_Status;
        $chk_Solo_Parent = $this->chk_Solo_Parent;
        $chk_Indigent = $this->chk_Indigent;
        $chk_Beneficiary = $this->chk_Beneficiary;
        $chk_Sex = $this->chk_Sex;
        $chk_House_No = $this->chk_House_No;
        $chk_Barangay = $this->chk_Barangay;
        $chk_City_Municipality = $this->chk_City_Municipality;
        $chk_Province = $this->chk_Province;
        $chk_Region = $this->chk_Region;
        $chk_Religion = $this->chk_Religion;
        $chk_Blood_Type = $this->chk_Blood_Type;
        $chk_Weight = $this->chk_Weight;
        $chk_Height = $this->chk_Height;
        $chk_Email = $this->chk_Email;
        $chk_Philsys_Number = $this->chk_Philsys_Number;
        $chk_Voter = $this->chk_Voter;
        $chk_Year_Last_Voted = $this->chk_Year_Last_Voted;
        $chk_Resident_Voter = $this->chk_Resident_Voter;

        $db_entries = DB::table('bips_brgy_inhabitants_information as a')
            ->leftjoin('maintenance_bips_name_prefix as b', 'a.Name_Prefix_ID', '=', 'b.Name_Prefix_ID')
            ->leftjoin('maintenance_bips_name_suffix as c', 'a.Name_Suffix_ID', '=', 'c.Name_Suffix_ID')
            ->leftjoin('maintenance_bips_civil_status as d', 'a.Civil_Status_ID', '=', 'd.Civil_Status_ID')
            ->leftjoin('bips_resident_profile as e', 'a.Resident_ID', '=', 'e.Resident_ID')
            ->leftjoin('maintenance_barangay as f', 'a.Barangay_ID', '=', 'f.Barangay_ID')
            ->leftjoin('maintenance_city_municipality as g', 'a.City_Municipality_ID', '=', 'g.City_Municipality_ID')
            ->leftjoin('maintenance_province as h', 'a.Province_ID', '=', 'h.Province_ID')
            ->leftjoin('maintenance_region as i', 'a.Region_ID', '=', 'i.Region_ID')
            ->leftjoin('maintenance_bips_religion as j', 'a.Religion_ID', '=', 'j.Religion_ID')
            ->leftjoin('maintenance_bips_blood_type as k', 'a.Blood_Type_ID', '=', 'k.Blood_Type_ID')
            ->select(
                'a.Resident_ID',
                'a.Name_Prefix_ID',
                'a.Last_Name',
                'a.First_Name',
                'a.Middle_Name',
                'a.Name_Suffix_ID',
                'a.Birthplace',
                'a.Weight',
                'a.Height',
                'a.Civil_Status_ID',
                'a.Birthdate',
                'a.Country_ID',
                'j.Religion',
                'k.Blood_Type',
                'a.Sex',
                'a.Mobile_No',
                'a.Telephone_No',
                'f.Barangay_Name',
                'g.City_Municipality_Name',
                'h.Province_Name',
                'i.Region_Name',
                'a.Street',
                'a.House_No',
                'a.Salary',
                'a.Email_Address',
                'a.PhilSys_Card_No',
                'a.Solo_Parent',
                'a.OFW',
                'a.Indigent',
                'a.4Ps_Beneficiary as Beneficiary',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'b.Name_Prefix',
                'c.Name_Suffix',
                'd.Civil_Status',
                'e.Resident_Status',
                'e.Voter_Status',
                'e.Election_Year_Last_Voted',
                'e.Resident_Voter'
            )
            // ->where('a.Application_Status', 1)
            ->get();

        return view('bips_transactions.BipsInhabitantExcel', compact(
            'chk_Name',
            'chk_Birthplace',
            'chk_Birthdate',
            'chk_Age',
            'chk_Street',
            'chk_Civil_Status',
            'chk_Mobile',
            'chk_Landline',
            'chk_Resident_Status',
            'chk_Solo_Parent',
            'chk_Indigent',
            'chk_Beneficiary',
            'chk_Sex',
            'chk_House_No',
            'chk_Street',
            'chk_Barangay',
            'chk_City_Municipality',
            'chk_Province',
            'chk_Region',
            'chk_Religion',
            'chk_Blood_Type',
            'chk_Weight',
            'chk_Height',
            'chk_Email',
            'chk_Philsys_Number',
            'chk_Voter',
            'chk_Year_Last_Voted',
            'chk_Resident_Voter',
            'db_entries',
        ));
    }
}
