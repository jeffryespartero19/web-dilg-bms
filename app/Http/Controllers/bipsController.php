<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\File;
use PDF;
use Notification;
use App\Mail\ApprovedEmailNotif;
use App\Mail\DisapprovedEmailNotif;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InhabitantsExportView;

class bipsController extends Controller
{
    //BIPS TRANSACTIONS

    //Inhabitants Information List
    public function inhabitants_information_list(Request $request)
    {
        $currDATE = Carbon::now();

        if (Auth::user()->User_Type_ID == 3) {
            $db_entries = DB::table('bips_brgy_inhabitants_information as a')
                ->leftjoin('maintenance_bips_name_prefix as b', 'a.Name_Prefix_ID', '=', 'b.Name_Prefix_ID')
                ->leftjoin('maintenance_bips_name_suffix as c', 'a.Name_Suffix_ID', '=', 'c.Name_Suffix_ID')
                ->leftjoin('maintenance_bips_civil_status as d', 'a.Civil_Status_ID', '=', 'd.Civil_Status_ID')
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
                    'a.Religion_ID',
                    'a.Blood_Type_ID',
                    'a.Sex',
                    'a.Mobile_No',
                    'a.Telephone_No',
                    'a.Barangay_ID',
                    'a.City_Municipality_ID',
                    'a.Province_ID',
                    'a.Region_ID',
                    'a.Street',
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
                    'd.Civil_Status'
                )
                ->where('a.Application_Status', 1)
                ->where('a.Province_ID', Auth::user()->Province_ID)
                ->paginate(20, ['*'], 'db_entries');
        } elseif (Auth::user()->User_Type_ID == 1) {

            $db_entries = DB::table('bips_brgy_inhabitants_information as a')
                ->leftjoin('maintenance_bips_name_prefix as b', 'a.Name_Prefix_ID', '=', 'b.Name_Prefix_ID')
                ->leftjoin('maintenance_bips_name_suffix as c', 'a.Name_Suffix_ID', '=', 'c.Name_Suffix_ID')
                ->leftjoin('maintenance_bips_civil_status as d', 'a.Civil_Status_ID', '=', 'd.Civil_Status_ID')
                ->leftjoin('maintenance_region as e', 'a.Region_ID', '=', 'e.Region_ID')
                ->leftjoin('maintenance_province as f', 'a.Province_ID', '=', 'f.Province_ID')
                ->leftjoin('maintenance_city_municipality as g', 'a.City_Municipality_ID', '=', 'g.City_Municipality_ID')
                ->leftjoin('maintenance_barangay as h', 'a.Barangay_ID', '=', 'h.Barangay_ID')
                ->leftjoin('maintenance_bips_religion as i', 'a.Religion_ID', '=', 'i.Religion_ID')
                ->leftjoin('maintenance_bips_blood_type as j', 'a.Blood_Type_ID', '=', 'j.Blood_Type_ID')
                ->leftjoin('bips_resident_profile as k', 'a.Resident_ID', '=', 'k.Resident_ID')
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
                    'a.Religion_ID',
                    'a.Blood_Type_ID',
                    'a.Sex',
                    'a.Mobile_No',
                    'a.Telephone_No',
                    'a.Barangay_ID',
                    'a.City_Municipality_ID',
                    'a.Province_ID',
                    'a.Region_ID',
                    'a.Street',
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
                    'a.House_No',
                    'h.Barangay_Name',
                    'g.City_Municipality_Name',
                    'f.Province_Name',
                    'e.Region_Name',
                    'i.Religion',
                    'j.Blood_Type',
                    'k.Resident_Status',
                    'k.Voter_Status',
                    'k.Election_Year_Last_Voted',
                    'k.Resident_Voter',
                )
                ->where('a.Application_Status', 1)
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');
        }

        $religion = DB::table('maintenance_bips_religion')->where('Active', 1)->get();
        $blood_type = DB::table('maintenance_bips_blood_type')->where('Active', 1)->get();
        $civil_status = DB::table('maintenance_bips_civil_status')->where('Active', 1)->get();
        $name_prefix = DB::table('maintenance_bips_name_prefix')->where('Active', 1)->get();
        $suffix = DB::table('maintenance_bips_name_suffix')->where('Active', 1)->get();
        $region = DB::table('maintenance_region')->where('Active', 1)->where('Region_ID', Auth::user()->Region_ID)->get();
        $province = DB::table('maintenance_province')->where('Active', 1)->where('Province_ID', Auth::user()->Province_ID)->get();
        $city = DB::table('maintenance_city_municipality')->where('Active', 1)->where('City_Municipality_ID', Auth::user()->City_Municipality_ID)->get();
        $barangay = DB::table('maintenance_barangay')->where('Active', 1)->where('Barangay_ID', Auth::user()->Barangay_ID)->get();
        $country = DB::table('maintenance_country')->where('Active', 1)->get();
        $academic_level = DB::table('maintenance_bips_academic_level')->where('Active', 1)->get();
        $employment_type = DB::table('maintenance_bips_employment_type')->where('Active', 1)->get();
        $city1 = DB::table('maintenance_city_municipality')
            ->where('Province_ID', Auth::user()->Province_ID)
            ->get();

        return view('bips_transactions.inhabitants_information_list', compact(
            'db_entries',
            'currDATE',
            'religion',
            'blood_type',
            'civil_status',
            'name_prefix',
            'suffix',
            'region',
            'province',
            'city',
            'barangay',
            'country',
            'academic_level',
            'employment_type',
            'city1'
        ));
    }


    // Save Inhabitants Info
    public function create_inhabitants_information(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        if ($data['Resident_ID'] == 0 || $data['Resident_ID'] == null) {
            $Resident_ID = DB::table('bips_brgy_inhabitants_information')->insertGetId(
                array(
                    'Name_Prefix_ID' => $data['Name_Prefix_ID'],
                    'Last_Name' => $data['Last_Name'],
                    'First_Name' => $data['First_Name'],
                    'Middle_Name' => $data['Middle_Name'],
                    'Name_Suffix_ID' => $data['Name_Suffix_ID'],
                    'Birthplace' => $data['Birthplace'],
                    'Weight' => $data['Weight'],
                    'Height' => $data['Height'],
                    'Civil_Status_ID' => $data['Civil_Status_ID'],
                    'Birthdate' => $data['Birthdate'],
                    'Country_ID' => $data['Country_ID'],
                    'Religion_ID' => $data['Religion_ID'],
                    'Blood_Type_ID' => $data['Blood_Type_ID'],
                    'Sex' => $data['Sex'],
                    'Mobile_No' => $data['Mobile_No'],
                    'Telephone_No' => $data['Telephone_No'],
                    'Barangay_ID' => $data['Barangay_ID'],
                    'City_Municipality_ID' => $data['City_Municipality_ID'],
                    'Province_ID' => $data['Province_ID'],
                    'Region_ID' => $data['Region_ID'],
                    'Street' => $data['Street'],
                    'Salary' => $data['Salary'],
                    'Email_Address' => $data['Email_Address'],
                    'PhilSys_Card_No' => $data['PhilSys_Card_No'],
                    'Solo_Parent' => (int)$data['Solo_Parent'],
                    'OFW' => (int)$data['OFW'],
                    'Indigent' => (int)$data['Indigent'],
                    '4Ps_Beneficiary' => (int)$data['4Ps_Beneficiary'],
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now(),
                    'House_No' => $data['House_No'],
                    'PhilHealth' => $data['PhilHealth'],
                    'GSIS' => $data['GSIS'],
                    'SSS' => $data['SSS'],
                    'PagIbig' => $data['PagIbig'],
                    'Application_Status' => 1,
                )
            );

            $resident = [
                'Resident_ID' => $Resident_ID,
                'Resident_Status' => (int)$data['Resident_Status'],
                'Voter_Status' => (int)$data['Voter_Status'],
                'Election_Year_Last_Voted' => $data['Election_Year_Last_Voted'],
                'Resident_Voter' => (int)$data['Resident_Voter'],
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now()
            ];

            DB::table('bips_resident_profile')->insert($resident);

            DB::table('bips_education')->where('Resident_ID', $Resident_ID)->delete();

            if (isset($data['Academic_Level_ID'])) {
                $education = [];

                for ($i = 0; $i < count($data['Academic_Level_ID']); $i++) {
                    if ($data['Academic_Level_ID'][$i] != NULL) {

                        $id = 0 + DB::table('bips_education')->max('Education_ID');
                        $id += 1;

                        if ($data['Academic_Level_ID'][$i] != null) {
                            $education = [
                                'Resident_ID' => $Resident_ID,
                                'Academic_Level_ID' => $data['Academic_Level_ID'][$i],
                                'School_Name' => $data['School_Name'][$i],
                                'School_Year_Start' => $data['School_Year_Start'][$i],
                                'School_Year_End' => $data['School_Year_End'][$i],
                                'Course' => $data['Course'][$i],
                                'Year_Graduated' => $data['Year_Graduated'][$i],
                                'Encoder_ID'       => Auth::user()->id,
                                'Date_Stamp'       => Carbon::now()
                            ];
                        }

                        DB::table('bips_education')->updateOrInsert(['Education_ID' => $id], $education);
                    }
                }
            }

            DB::table('bips_employment_history')->where('Resident_ID', $Resident_ID)->delete();

            if (isset($data['Employment_Type_ID'])) {
                $employment = [];

                for ($i = 0; $i < count($data['Employment_Type_ID']); $i++) {
                    if ($data['Employment_Type_ID'][$i] != NULL) {

                        $id = 0 + DB::table('bips_employment_history')->max('Employment_ID');
                        $id += 1;

                        if ($data['Employment_Type_ID'][$i] != null) {
                            $employment = [
                                'Resident_ID' => $Resident_ID,
                                'Employment_Type_ID' => $data['Employment_Type_ID'][$i],
                                'Company_Name' => $data['Company_Name'][$i],
                                'Employer_Name' => $data['Employer_Name'][$i],
                                'Employer_Address' => $data['Employer_Address'][$i],
                                'Position' => $data['Position'][$i],
                                'Start_Date' => $data['Start_Date'][$i],
                                'End_Date' => $data['End_Date'][$i],
                                'Monthly_Salary' => $data['Monthly_Salary'][$i],
                                'Brief_Description' => $data['Brief_Description'][$i],
                                'Encoder_ID'       => Auth::user()->id,
                                'Date_Stamp'       => Carbon::now()
                            ];
                        }

                        DB::table('bips_employment_history')->updateOrInsert(['Employment_ID' => $id], $employment);
                    }
                }
            }
        } else {
            DB::table('bips_brgy_inhabitants_information')->where('Resident_ID', $data['Resident_ID'])->update(
                array(
                    'Name_Prefix_ID' => $data['Name_Prefix_ID'],
                    'Last_Name' => $data['Last_Name'],
                    'First_Name' => $data['First_Name'],
                    'Middle_Name' => $data['Middle_Name'],
                    'Name_Suffix_ID' => $data['Name_Suffix_ID'],
                    'Birthplace' => $data['Birthplace'],
                    'Weight' => $data['Weight'],
                    'Height' => $data['Height'],
                    'Civil_Status_ID' => $data['Civil_Status_ID'],
                    'Birthdate' => $data['Birthdate'],
                    'Country_ID' => $data['Country_ID'],
                    'Religion_ID' => $data['Religion_ID'],
                    'Blood_Type_ID' => $data['Blood_Type_ID'],
                    'Sex' => $data['Sex'],
                    'Mobile_No' => $data['Mobile_No'],
                    'Telephone_No' => $data['Telephone_No'],
                    'Barangay_ID' => $data['Barangay_ID'],
                    'City_Municipality_ID' => $data['City_Municipality_ID'],
                    'Province_ID' => $data['Province_ID'],
                    'Region_ID' => $data['Region_ID'],
                    'Street' => $data['Street'],
                    'Salary' => $data['Salary'],
                    'Email_Address' => $data['Email_Address'],
                    'PhilSys_Card_No' => $data['PhilSys_Card_No'],
                    'Solo_Parent' => (int)$data['Solo_Parent'],
                    'OFW' => (int)$data['OFW'],
                    'Indigent' => (int)$data['Indigent'],
                    '4Ps_Beneficiary' => (int)$data['4Ps_Beneficiary'],
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now(),
                    'House_No' => $data['House_No'],
                    'PhilHealth' => $data['PhilHealth'],
                    'GSIS' => $data['GSIS'],
                    'SSS' => $data['SSS'],
                    'PagIbig' => $data['PagIbig'],
                )
            );

            $resident = [
                'Resident_ID' => $data['Resident_ID'],
                'Resident_Status' => (int)$data['Resident_Status'],
                'Voter_Status' => (int)$data['Voter_Status'],
                'Election_Year_Last_Voted' => $data['Election_Year_Last_Voted'],
                'Resident_Voter' => (int)$data['Resident_Voter'],
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now()
            ];

            DB::table('bips_resident_profile')->updateOrInsert(['Resident_ID' => $data['Resident_ID']], $resident);

            DB::table('bips_education')->where('Resident_ID', $data['Resident_ID'])->delete();

            if (isset($data['Academic_Level_ID'])) {
                $education = [];

                for ($i = 0; $i < count($data['Academic_Level_ID']); $i++) {
                    if ($data['Academic_Level_ID'][$i] != NULL) {

                        $id = 0 + DB::table('bips_education')->max('Education_ID');
                        $id += 1;

                        if ($data['Academic_Level_ID'][$i] != null) {
                            $education = [
                                'Resident_ID' => $data['Resident_ID'],
                                'Academic_Level_ID' => $data['Academic_Level_ID'][$i],
                                'School_Name' => $data['School_Name'][$i],
                                'School_Year_Start' => $data['School_Year_Start'][$i],
                                'School_Year_End' => $data['School_Year_End'][$i],
                                'Course' => $data['Course'][$i],
                                'Year_Graduated' => $data['Year_Graduated'][$i],
                                'Encoder_ID'       => Auth::user()->id,
                                'Date_Stamp'       => Carbon::now()
                            ];
                        }

                        DB::table('bips_education')->updateOrInsert(['Education_ID' => $id], $education);
                    }
                }
            }

            DB::table('bips_employment_history')->where('Resident_ID', $data['Resident_ID'])->delete();

            if (isset($data['Employment_Type_ID'])) {
                $employment = [];

                for ($i = 0; $i < count($data['Employment_Type_ID']); $i++) {
                    if ($data['Employment_Type_ID'][$i] != NULL) {

                        $id = 0 + DB::table('bips_employment_history')->max('Employment_ID');
                        $id += 1;

                        if ($data['Employment_Type_ID'][$i] != null) {
                            $employment = [
                                'Resident_ID' => $data['Resident_ID'],
                                'Employment_Type_ID' => $data['Employment_Type_ID'][$i],
                                'Company_Name' => $data['Company_Name'][$i],
                                'Employer_Name' => $data['Employer_Name'][$i],
                                'Employer_Address' => $data['Employer_Address'][$i],
                                'Position' => $data['Position'][$i],
                                'Start_Date' => $data['Start_Date'][$i],
                                'End_Date' => $data['End_Date'][$i],
                                'Monthly_Salary' => $data['Monthly_Salary'][$i],
                                'Brief_Description' => $data['Brief_Description'][$i],
                                'Encoder_ID'       => Auth::user()->id,
                                'Date_Stamp'       => Carbon::now()
                            ];
                        }

                        DB::table('bips_employment_history')->updateOrInsert(['Employment_ID' => $id], $employment);
                    }
                }
            }
        }

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    // Display Inhabitants Details
    public function get_inhabitants_info(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bips_brgy_inhabitants_information as a')
            ->leftjoin('maintenance_province as b', 'a.Province_ID', '=', 'b.Province_ID')
            ->leftjoin('maintenance_city_municipality as c', 'a.City_Municipality_ID', '=', 'c.City_Municipality_ID')
            ->leftjoin('maintenance_barangay as d', 'a.Barangay_ID', '=', 'd.Barangay_ID')
            ->leftjoin('bips_resident_profile as e', 'a.Resident_ID', '=', 'e.Resident_ID')
            ->leftjoin('maintenance_region as f', 'a.Region_ID', '=', 'f.Region_ID')
            ->leftjoin('maintenance_bips_religion as g', 'a.Religion_ID', '=', 'g.Religion_ID')
            ->leftjoin('maintenance_bips_blood_type as h', 'a.Blood_Type_ID', '=', 'h.Blood_Type_ID')
            ->leftjoin('maintenance_bips_civil_status as i', 'a.Civil_Status_ID', '=', 'i.Civil_Status_ID')
            ->leftjoin('maintenance_bips_name_suffix as j', 'a.Name_Suffix_ID', '=', 'j.Name_Suffix_ID')
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
                'a.Religion_ID',
                'a.Blood_Type_ID',
                'a.Sex',
                'a.Mobile_No',
                'a.Telephone_No',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Province_ID',
                'a.Region_ID',
                'a.Salary',
                'a.Email_Address',
                'a.PhilSys_Card_No',
                'a.Solo_Parent',
                'a.OFW',
                'a.Indigent',
                'a.4Ps_Beneficiary',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'b.Province_Name',
                'c.City_Municipality_Name',
                'd.Barangay_Name',
                'e.Resident_Status',
                'e.Voter_Status',
                'e.Election_Year_Last_Voted',
                'e.Resident_Voter',
                'f.Region_Name',
                'a.Street',
                'a.House_No',
                'a.PhilHealth',
                'a.GSIS',
                'a.SSS',
                'a.PagIbig',
                'g.Religion',
                'h.Blood_Type',
                'i.Civil_Status',
                'j.Name_Suffix',
                DB::raw('floor(DATEDIFF(CURDATE(),a.Birthdate) /365) as Age')
            )
            ->where('a.Resident_ID', $id)->get();
        return (compact('theEntry'));
    }

    // Display Inhabitants Education
    public function get_inhabitants_edu_info(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bips_education')->where('Resident_ID', $id)->get();

        return json_encode($theEntry);
    }

    // Display Inhabitants Employment
    public function get_inhabitants_epm_info(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bips_employment_history')->where('Resident_ID', $id)->get();

        return json_encode($theEntry);
    }



    //Deceased Profile
    //Deceased Profile List
    public function deceased_profile_list(Request $request)
    {
        $currDATE = Carbon::now();
        if (Auth::user()->User_Type_ID == 3) {
            $db_entries = DB::table('bips_deceased_profile as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_bips_deceased_type as c', 'a.Deceased_Type_ID', '=', 'c.Deceased_Type_ID')
                ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
                ->select(
                    'a.Resident_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'a.Deceased_Type_ID',
                    'c.Deceased_Type',
                    'a.Cause_of_Death',
                    'a.Date_of_Death',
                )
                ->where('e.Province_ID', Auth::user()->Province_ID)
                ->paginate(20, ['*'], 'db_entries');
        } elseif (Auth::user()->User_Type_ID == 1) {
            $db_entries = DB::table('bips_deceased_profile as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_bips_deceased_type as c', 'a.Deceased_Type_ID', '=', 'c.Deceased_Type_ID')
                ->select(
                    'a.Resident_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'a.Deceased_Type_ID',
                    'c.Deceased_Type',
                    'a.Cause_of_Death',
                    'a.Date_of_Death',
                )
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');
        }

        $city1 = DB::table('maintenance_city_municipality')
            ->where('Province_ID', Auth::user()->Province_ID)
            ->get();
        $deceased_type = DB::table('maintenance_bips_deceased_type')->where('Active', 1)->get();

        return view('bips_transactions.deceased_profile_list', compact(
            'db_entries',
            'currDATE',
            'deceased_type',
            'city1'
        ));
    }


    // Save Deceased Profile
    public function create_deceased_profile(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bips_deceased_profile')->insert(
            array(
                'Resident_ID' => $data['Resident_IDs'],
                'Deceased_Type_ID' => $data['Deceased_Type_ID'],
                'Cause_of_Death' => $data['Cause_of_Death'],
                'Date_of_Death' => $data['Date_of_Death'],
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Barangay_ID'       => Auth::user()->Barangay_ID,
            )
        );
        return redirect()->back()->with('message', 'New Entry Created');
    }

    // Display Deceased Profile
    public function get_deceased_profile(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('bips_deceased_profile as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->select(
                'a.Resident_ID',
                'a.Deceased_Type_ID',
                'a.Cause_of_Death',
                'a.Date_of_Death',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
            )
            ->where('a.Resident_ID', $id)->get();

        return (compact('theEntry'));
    }
    //updating Deceased Profile
    public function update_deceased_profile(Request $request)

    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bips_deceased_profile')->where('Resident_ID', $data['Resident_ID2'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Deceased_Type_ID'  => $data['Deceased_Type_ID2'],
                'Cause_of_Death'  => $data['Cause_of_Death2'],
                'Date_of_Death'  => $data['Date_of_Death2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Inhabitants Transfer
    ///Inhabitants Transfer List
    public function inhabitants_transfer_list(Request $request)
    {
        $currDATE = Carbon::now();
        if (Auth::user()->User_Type_ID == 3) {
            $db_entries = DB::table('Inhabitants_Transfer as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_region as c', 'a.Region_ID', '=', 'c.Region_ID')
                ->leftjoin('maintenance_province as d', 'a.Province_ID', '=', 'd.Province_ID')
                ->leftjoin('maintenance_city_municipality as e', 'a.City_Municipality_ID', '=', 'e.City_Municipality_ID')
                ->leftjoin('maintenance_barangay as f', 'a.Barangay_ID', '=', 'f.Barangay_ID')
                ->leftjoin('maintenance_barangay as g', 'a.Main_Barangay_ID', '=', 'g.Barangay_ID')
                ->select(
                    'a.Inhabitants_Transfer_ID',
                    'a.Resident_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'a.Region_ID',
                    'c.Region_Name',
                    'a.Province_ID',
                    'd.Province_Name',
                    'a.City_Municipality_ID',
                    'e.City_Municipality_Name',
                    'a.Barangay_ID',
                    'f.Barangay_Name',
                )
                ->where('b.Application_Status', 1)
                ->where('g.Province_ID', Auth::user()->Province_ID)
                ->paginate(20, ['*'], 'db_entries');
        } elseif (Auth::user()->User_Type_ID == 1) {
            $db_entries = DB::table('Inhabitants_Transfer as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_region as c', 'a.Region_ID', '=', 'c.Region_ID')
                ->leftjoin('maintenance_province as d', 'a.Province_ID', '=', 'd.Province_ID')
                ->leftjoin('maintenance_city_municipality as e', 'a.City_Municipality_ID', '=', 'e.City_Municipality_ID')
                ->leftjoin('maintenance_barangay as f', 'a.Barangay_ID', '=', 'f.Barangay_ID')
                ->select(
                    'a.Inhabitants_Transfer_ID',
                    'a.Resident_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'a.Region_ID',
                    'c.Region_Name',
                    'a.Province_ID',
                    'd.Province_Name',
                    'a.City_Municipality_ID',
                    'e.City_Municipality_Name',
                    'a.Barangay_ID',
                    'f.Barangay_Name',
                )
                ->where('b.Application_Status', 1)
                ->where('a.Main_Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');
        }
        $city1 = DB::table('maintenance_city_municipality')
            ->where('Province_ID', Auth::user()->Province_ID)
            ->get();
        $name = DB::table('bips_brgy_inhabitants_information')->where('Application_Status', 1)->paginate(20, ['*'], 'name');
        $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
        $province = DB::table('maintenance_province')->paginate(20, ['*'], 'province');
        $barangay = DB::table('maintenance_barangay')->paginate(20, ['*'], 'barangay');
        $city = DB::table('maintenance_city_municipality')->paginate(20, ['*'], 'city');

        return view('bips_transactions.inhabitants_transfer_list', compact(
            'db_entries',
            'currDATE',
            'name',
            'region',
            'province',
            'barangay',
            'city',
            'city1'

        ));
    }

    // Save Inhabitants Transfer
    public function create_inhabitants_transfer(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        if ($data['Inhabitants_Transfer_ID'] == 0) {
            DB::table('Inhabitants_Transfer')->insert(
                array(
                    'Resident_ID'           => $data['Resident_ID'],
                    'Region_ID'             => $data['Region_ID'],
                    'Province_ID'           => $data['Province_ID'],
                    'City_Municipality_ID'  => $data['City_Municipality_ID'],
                    'Barangay_ID'           => $data['Barangay_ID'],
                    'Status_ID'             => 0,
                    'Encoder_ID'            => Auth::user()->id,
                    'Date_Stamp'            => Carbon::now(),
                    'Main_Barangay_ID'            => Auth::user()->Barangay_ID,
                )
            );
            return redirect()->back()->with('message', 'New Entry Created');
        } else {
            DB::table('Inhabitants_Transfer')->where('Inhabitants_Transfer_ID', $data['Inhabitants_Transfer_ID'])->update(
                array(
                    'Resident_ID'           => $data['Resident_ID'],
                    'Region_ID'             => $data['Region_ID'],
                    'Province_ID'           => $data['Province_ID'],
                    'City_Municipality_ID'  => $data['City_Municipality_ID'],
                    'Barangay_ID'           => $data['Barangay_ID'],
                    'Status_ID'             => 0,
                    'Encoder_ID'            => Auth::user()->id,
                    'Date_Stamp'            => Carbon::now()
                )
            );
            return redirect()->back()->with('message', 'Record Updated');
        }
    }


    // Display Inhabitants Transfer
    public function get_inhabitants_transfer(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('Inhabitants_Transfer as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_region as c', 'a.Region_ID', '=', 'c.Region_ID')
            ->leftjoin('maintenance_province as d', 'a.Province_ID', '=', 'd.Province_ID')
            ->leftjoin('maintenance_city_municipality as e', 'a.City_Municipality_ID', '=', 'e.City_Municipality_ID')
            ->leftjoin('maintenance_barangay as f', 'a.Barangay_ID', '=', 'f.Barangay_ID')
            ->select(
                'a.Inhabitants_Transfer_ID',
                'a.Resident_ID',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
                'a.Region_ID',
                'c.Region_Name',
                'a.Province_ID',
                'd.Province_Name',
                'a.City_Municipality_ID',
                'e.City_Municipality_Name',
                'a.Barangay_ID',
                'f.Barangay_Name',
            )
            ->where('b.Application_Status', 1)
            ->where('a.Inhabitants_Transfer_ID', $id)->get();

        return (compact('theEntry'));
    }

    //Inhabitants Incoming List
    public function inhabitants_incoming_list(Request $request)
    {
        $currDATE = Carbon::now();
        if (Auth::user()->User_Type_ID == 3) {
            $db_entries = DB::table('Inhabitants_Transfer as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_bips_name_suffix as c', 'b.Name_Suffix_ID', '=', 'c.Name_Suffix_ID')
                ->select(
                    'a.Resident_ID',
                    'a.Region_ID',
                    'a.Province_ID',
                    'a.City_Municipality_ID',
                    'a.Barangay_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'c.Name_Suffix'
                )
                ->where('a.Status_ID', 0)
                ->where('a.Province_ID', Auth::user()->Province_ID)
                ->paginate(20, ['*'], 'db_entries');
            $db_entries2 = DB::table('Inhabitants_Transfer as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_bips_name_suffix as c', 'b.Name_Suffix_ID', '=', 'c.Name_Suffix_ID')
                ->select(
                    'a.Resident_ID',
                    'a.Region_ID',
                    'a.Province_ID',
                    'a.City_Municipality_ID',
                    'a.Barangay_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'c.Name_Suffix'
                )
                ->where('a.Status_ID', 1)
                ->where('a.Province_ID', Auth::user()->Province_ID)
                ->paginate(20, ['*'], 'db_entries');
            $db_entries3 = DB::table('Inhabitants_Transfer as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_bips_name_suffix as c', 'b.Name_Suffix_ID', '=', 'c.Name_Suffix_ID')
                ->select(
                    'a.Resident_ID',
                    'a.Region_ID',
                    'a.Province_ID',
                    'a.City_Municipality_ID',
                    'a.Barangay_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'c.Name_Suffix'
                )
                ->where('a.Status_ID', 2)
                ->where('a.Province_ID', Auth::user()->Province_ID)
                ->paginate(20, ['*'], 'db_entries');
        } elseif (Auth::user()->User_Type_ID == 1) {
            $db_entries = DB::table('Inhabitants_Transfer as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_bips_name_suffix as c', 'b.Name_Suffix_ID', '=', 'c.Name_Suffix_ID')
                ->select(
                    'a.Resident_ID',
                    'a.Region_ID',
                    'a.Province_ID',
                    'a.City_Municipality_ID',
                    'a.Barangay_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'c.Name_Suffix'
                )
                ->where('a.Status_ID', 0)
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');
            $db_entries2 = DB::table('Inhabitants_Transfer as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_bips_name_suffix as c', 'b.Name_Suffix_ID', '=', 'c.Name_Suffix_ID')
                ->select(
                    'a.Resident_ID',
                    'a.Region_ID',
                    'a.Province_ID',
                    'a.City_Municipality_ID',
                    'a.Barangay_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'c.Name_Suffix'
                )
                ->where('a.Status_ID', 1)
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');
            $db_entries3 = DB::table('Inhabitants_Transfer as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_bips_name_suffix as c', 'b.Name_Suffix_ID', '=', 'c.Name_Suffix_ID')
                ->select(
                    'a.Resident_ID',
                    'a.Region_ID',
                    'a.Province_ID',
                    'a.City_Municipality_ID',
                    'a.Barangay_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'c.Name_Suffix'
                )
                ->where('a.Status_ID', 2)
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');
        }
        $city1 = DB::table('maintenance_city_municipality')
            ->where('Province_ID', Auth::user()->Province_ID)
            ->get();
        $suffix = DB::table('maintenance_bips_name_suffix')->where('Active', 1)->get();
        $region = DB::table('maintenance_region')->where('Active', 1)->get();
        $province = DB::table('maintenance_province')->where('Active', 1)->get();
        $city = DB::table('maintenance_city_municipality')->where('Active', 1)->get();
        $barangay = DB::table('maintenance_barangay')->where('Active', 1)->get();


        return view('bips_transactions.inhabitants_incoming_list', compact(
            'db_entries',
            'db_entries2',
            'db_entries3',
            'currDATE',
            'suffix',
            'region',
            'province',
            'city',
            'barangay',
            'city1'
        ));
    }

    // Approve Disapprove Inhabitants Transfer
    public function approve_disapprove_inhabitants(Request $request)
    {
        $data = request()->all();

        if ($data['Status_ID'] == 1) {
            $message = 'Approved';

            $resident = DB::table('inhabitants_transfer')->where('Resident_ID', $data['Resident_ID'])->get();

            DB::table('inhabitants_transfer')->where('Resident_ID', $data['Resident_ID'])->update(
                array(
                    'Status_ID' => $data['Status_ID'],
                )
            );

            DB::table('bips_brgy_inhabitants_information')->where('Resident_ID', $data['Resident_ID'])->update(
                array(
                    'Barangay_ID' => $resident[0]->Barangay_ID,
                    'City_Municipality_ID' => $resident[0]->City_Municipality_ID,
                    'Province_ID' => $resident[0]->Province_ID,
                    'Region_ID' => $resident[0]->Region_ID,
                )
            );
        } else {
            $message = 'Disapprove';

            DB::table('inhabitants_transfer')->where('Resident_ID', $data['Resident_ID'])->update(
                array(
                    'Status_ID' => $data['Status_ID'],
                )
            );
        }

        return redirect()->back()->with('message', 'Resident ' . $message);
    }

    //Inhabitants Household List
    public function inhabitants_household_profile(Request $request)
    {
        $currDATE = Carbon::now();

        if (Auth::user()->User_Type_ID == 3) {
            $db_entries = DB::table('bips_household_profile as a')
                ->leftjoin('maintenance_bips_family_type as b', 'a.Family_Type_ID', '=', 'b.Family_Type_ID')
                ->leftjoin('maintenance_bips_tenure_of_lot as c', 'a.Tenure_of_Lot_ID', '=', 'c.Tenure_of_Lot_ID')
                ->leftjoin('maintenance_bips_housing_unit as d', 'a.Housing_Unit_ID', '=', 'd.Housing_Unit_ID')
                ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
                ->select(
                    'a.Household_Profile_ID',
                    'a.Household_Name',
                    'a.Household_Monthly_Income',
                    'b.Family_Type_Name',
                    'c.Tenure_of_Lot',
                    'd.Housing_Unit',
                )
                ->where('e.Province_ID', Auth::user()->Province_ID)
                ->paginate(20, ['*'], 'db_entries');
        } elseif (Auth::user()->User_Type_ID == 1) {
            $db_entries = DB::table('bips_household_profile as a')
                ->leftjoin('maintenance_bips_family_type as b', 'a.Family_Type_ID', '=', 'b.Family_Type_ID')
                ->leftjoin('maintenance_bips_tenure_of_lot as c', 'a.Tenure_of_Lot_ID', '=', 'c.Tenure_of_Lot_ID')
                ->leftjoin('maintenance_bips_housing_unit as d', 'a.Housing_Unit_ID', '=', 'd.Housing_Unit_ID')
                ->select(
                    'a.Household_Profile_ID',
                    'a.Household_Name',
                    'a.Household_Monthly_Income',
                    'b.Family_Type_Name',
                    'c.Tenure_of_Lot',
                    'd.Housing_Unit',
                )
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');
        }
        $city1 = DB::table('maintenance_city_municipality')
            ->where('Province_ID', Auth::user()->Province_ID)
            ->get();
        $resident = DB::table('bips_brgy_inhabitants_information')->where('Application_Status', 1)->get();
        $family_position = DB::table('maintenance_bips_family_position')->where('Active', 1)->get();
        $blood_type = DB::table('maintenance_bips_blood_type')->where('Active', 1)->get();
        $tenure_of_lot = DB::table('maintenance_bips_tenure_of_lot')->where('Active', 1)->get();
        $housing_unit = DB::table('maintenance_bips_housing_unit')->where('Active', 1)->get();
        $family_type = DB::table('maintenance_bips_family_type')->where('Active', 1)->get();
        $suffix = DB::table('maintenance_bips_name_suffix')->where('Active', 1)->get();

        return view('bips_transactions.inhabitants_household_profile', compact(
            'db_entries',
            'currDATE',
            'family_position',
            'tenure_of_lot',
            'housing_unit',
            'family_type',
            'suffix',
            'resident',
            'city1'
        ));
    }

    //Inhabitants Information List
    public function inhabitants_household_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $resident = DB::table('bips_brgy_inhabitants_information')->where('Application_Status', 1)->get();
            $family_position = DB::table('maintenance_bips_family_position')->where('Active', 1)->get();
            $tenure_of_lot = DB::table('maintenance_bips_tenure_of_lot')->where('Active', 1)->get();
            $housing_unit = DB::table('maintenance_bips_housing_unit')->where('Active', 1)->get();
            $family_type = DB::table('maintenance_bips_family_type')->where('Active', 1)->get();

            return view('bips_transactions.inhabitants_household_profile_details', compact(
                'currDATE',
                'family_position',
                'tenure_of_lot',
                'housing_unit',
                'family_type',
                'resident',
            ));
        } else {
            $household = DB::table('bips_household_profile')->where('Household_Profile_ID', $id)->get();
            $resident = DB::table('bips_brgy_inhabitants_information')->where('Application_Status', 1)->get();
            $family_position = DB::table('maintenance_bips_family_position')->where('Active', 1)->get();
            $tenure_of_lot = DB::table('maintenance_bips_tenure_of_lot')->where('Active', 1)->get();
            $housing_unit = DB::table('maintenance_bips_housing_unit')->where('Active', 1)->get();
            $family_type = DB::table('maintenance_bips_family_type')->where('Active', 1)->get();
            $household_members = DB::table('bips_household_profile_members as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'b.Resident_ID', '=', 'a.Resident_ID')
                ->where('a.Household_Profile_ID', $id)
                ->get();

            return view('bips_transactions.inhabitants_household_profile_details_edit', compact(
                'currDATE',
                'family_position',
                'tenure_of_lot',
                'housing_unit',
                'family_type',
                'resident',
                'household',
                'household_members',
            ));
        }
    }


    // Save Inhabitants Household Info
    public function create_household_information(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        // dd($data);

        $validated = $request->validate([
            'Resident_ID' => 'required',
        ]);


        if ($data['Household_Profile_ID'] == null || $data['Household_Profile_ID'] == 0) {
            $Household_Profile_ID = DB::table('bips_household_profile')->insertGetId(
                array(
                    'Household_Monthly_Income' => $data['Household_Monthly_Income'],
                    'Tenure_of_Lot_ID' => $data['Tenure_of_Lot_ID'],
                    'Housing_Unit_ID' => $data['Housing_Unit_ID'],
                    'Family_Type_ID' => $data['Family_Type_ID'],
                    'Household_Name' => $data['Household_Name'],
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now(),
                    'Barangay_ID'       => Auth::user()->Barangay_ID,
                )
            );

            DB::table('bips_household_profile_members')->where('Household_Profile_ID', $Household_Profile_ID)->delete();

            if (isset($data['Resident_ID'])) {
                $members_details = [];

                for ($i = 0; $i < count($data['Resident_ID']); $i++) {
                    if ($data['Resident_ID'][$i] != NULL) {

                        $id = 0 + DB::table('bips_household_profile_members')->max('Household_Profile_Members_ID');
                        $id += 1;

                        if ($data['Resident_ID'][$i] != null) {
                            $members_details = [
                                'Household_Profile_ID'           => $Household_Profile_ID,
                                'Resident_ID'   => $data['Resident_ID'][$i],
                                'Family_Position_ID'   => $data['Family_Position_ID'][$i],
                                'Family_Head'   => (int)$data['Family_Head'][$i],
                                'Encoder_ID'                 => Auth::user()->id,
                                'Date_Stamp'                 => Carbon::now()
                            ];
                        }

                        DB::table('bips_household_profile_members')->updateOrInsert(['Household_Profile_Members_ID' => $id], $members_details);
                    }
                }
            }

            return redirect()->to('inhabitants_household_details/' . $Household_Profile_ID)->with('message', 'New Household Created');
        } else {
            DB::table('bips_household_profile')->where('Household_Profile_ID', $data['Household_Profile_ID'])->update(
                array(
                    'Household_Monthly_Income' => $data['Household_Monthly_Income'],
                    'Tenure_of_Lot_ID' => $data['Tenure_of_Lot_ID'],
                    'Housing_Unit_ID' => $data['Housing_Unit_ID'],
                    'Family_Type_ID' => $data['Family_Type_ID'],
                    'Household_Name' => $data['Household_Name'],
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now()
                )
            );

            DB::table('bips_household_profile_members')->where('Household_Profile_ID', $data['Household_Profile_ID'])->delete();

            if (isset($data['Resident_ID'])) {
                $members_details = [];

                for ($i = 0; $i < count($data['Resident_ID']); $i++) {
                    if ($data['Resident_ID'][$i] != NULL) {

                        $id = 0 + DB::table('bips_household_profile_members')->max('Household_Profile_Members_ID');
                        $id += 1;

                        if ($data['Resident_ID'][$i] != null) {
                            $members_details = [
                                'Household_Profile_ID'           => $data['Household_Profile_ID'],
                                'Resident_ID'   => $data['Resident_ID'][$i],
                                'Family_Position_ID'   => $data['Family_Position_ID'][$i],
                                'Family_Head'   => (int)$data['Family_Head'][$i],
                                'Encoder_ID'                 => Auth::user()->id,
                                'Date_Stamp'                 => Carbon::now()
                            ];
                        }

                        DB::table('bips_household_profile_members')->updateOrInsert(['Household_Profile_Members_ID' => $id], $members_details);
                    }
                }
            }

            return redirect()->to('inhabitants_household_details/' . $data['Household_Profile_ID'])->with('message', 'Household Info Updated');
        }
    }

    //Inhabitants Apllication
    ///Inhabitants Transfer List
    public function application_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bips_brgy_inhabitants_information as a')
            ->leftjoin('maintenance_region as c', 'a.Region_ID', '=', 'c.Region_ID')
            ->leftjoin('maintenance_province as d', 'a.Province_ID', '=', 'd.Province_ID')
            ->leftjoin('maintenance_city_municipality as e', 'a.City_Municipality_ID', '=', 'e.City_Municipality_ID')
            ->leftjoin('maintenance_barangay as f', 'a.Barangay_ID', '=', 'f.Barangay_ID')
            ->leftjoin('maintenance_bips_name_suffix as g', 'a.Name_Suffix_ID', '=', 'g.Name_Suffix_ID')
            ->select(
                'a.Resident_ID',
                'a.Last_Name',
                'a.First_Name',
                'a.Middle_Name',
                'a.Region_ID',
                'c.Region_Name',
                'a.Province_ID',
                'd.Province_Name',
                'a.City_Municipality_ID',
                'e.City_Municipality_Name',
                'a.Barangay_ID',
                'f.Barangay_Name',
                'g.Name_Suffix'
            )
            ->where('a.Application_Status', 0)
            ->paginate(20, ['*'], 'db_entries');

        $religion = DB::table('maintenance_bips_religion')->where('Active', 1)->get();
        $blood_type = DB::table('maintenance_bips_blood_type')->where('Active', 1)->get();
        $civil_status = DB::table('maintenance_bips_civil_status')->where('Active', 1)->get();
        $name_prefix = DB::table('maintenance_bips_name_prefix')->where('Active', 1)->get();
        $suffix = DB::table('maintenance_bips_name_suffix')->where('Active', 1)->get();
        $region = DB::table('maintenance_region')->where('Active', 1)->get();
        $province = DB::table('maintenance_province')->where('Active', 1)->get();
        $city = DB::table('maintenance_city_municipality')->where('Active', 1)->get();
        $barangay = DB::table('maintenance_barangay')->where('Active', 1)->get();
        $country = DB::table('maintenance_country')->where('Active', 1)->get();

        return view('bips_transactions.application_list', compact(
            'db_entries',
            'currDATE',
            'religion',
            'blood_type',
            'civil_status',
            'name_prefix',
            'suffix',
            'region',
            'province',
            'city',
            'barangay',
            'country',
        ));
    }

    // Approve Disapprove Inhabitants Transfer
    public function approve_disapprove_application(Request $request)
    {
        $data = request()->all();

        // dd($data);

        $user = DB::table('bips_brgy_inhabitants_information')
            ->where('Resident_ID', $data['Resident_ID'])
            ->get();

        // $email = $user[0]->Email_Address;
        // dd($user[0]->Email_Address);

        if ($data['Status_ID'] == 1) {
            $message = 'Approved';

            DB::table('bips_brgy_inhabitants_information')->where('Resident_ID', $data['Resident_ID'])->update(
                array(
                    'Application_Status' => 1
                )
            );

            DB::table('users')->where('Resident_ID', $data['Resident_ID'])->update(
                array(
                    'Login_Status' => 1
                )
            );
            Mail::to($user[0]->Email_Address)->send(new ApprovedEmailNotif());
        } else {
            $message = 'Disapprove';

            DB::table('bips_brgy_inhabitants_information')->where('Resident_ID', $data['Resident_ID'])->update(
                array(
                    'Application_Status' => 2,
                    'status_remarks' => $data['disapprove_remarks']
                )
            );

            Mail::to($user[0]->Email_Address)->send(new DisapprovedEmailNotif());
        }



        // Notification::send($user, new SendInhabitantsStatusEmailNotification($details));

        return redirect()->back()->with('message', 'Resident ' . $message);
    }

    public function downloadPDF(Request $request)
    {
        $data = request()->all();


        $chk_Name = isset($data['chk_Name']) ? 1 : 0;
        $chk_Birthplace = isset($data['chk_Birthplace']) ? 1 : 0;
        $chk_Birthdate = isset($data['chk_Birthdate']) ? 1 : 0;
        $chk_Age = isset($data['chk_Age']) ? 1 : 0;
        $chk_Street = isset($data['chk_Street']) ? 1 : 0;
        $chk_Civil_Status = isset($data['chk_Civil_Status']) ? 1 : 0;
        $chk_Mobile = isset($data['chk_Mobile']) ? 1 : 0;
        $chk_Landline = isset($data['chk_Landline']) ? 1 : 0;
        $chk_Resident_Status = isset($data['chk_Resident_Status']) ? 1 : 0;
        $chk_Solo_Parent = isset($data['chk_Solo_Parent']) ? 1 : 0;
        $chk_Indigent = isset($data['chk_Indigent']) ? 1 : 0;
        $chk_Beneficiary = isset($data['chk_Beneficiary']) ? 1 : 0;
        $chk_Sex = isset($data['chk_Sex']) ? 1 : 0;
        $chk_House_No = isset($data['chk_House_No']) ? 1 : 0;
        $chk_Street = isset($data['chk_Street']) ? 1 : 0;
        $chk_Barangay = isset($data['chk_Barangay']) ? 1 : 0;
        $chk_City_Municipality = isset($data['chk_City_Municipality']) ? 1 : 0;
        $chk_Province = isset($data['chk_Province']) ? 1 : 0;
        $chk_Region = isset($data['chk_Region']) ? 1 : 0;
        $chk_Religion = isset($data['chk_Religion']) ? 1 : 0;
        $chk_Blood_Type = isset($data['chk_Blood_Type']) ? 1 : 0;
        $chk_Weight = isset($data['chk_Weight']) ? 1 : 0;
        $chk_Height = isset($data['chk_Height']) ? 1 : 0;
        $chk_Email = isset($data['chk_Email']) ? 1 : 0;
        $chk_Philsys_Number = isset($data['chk_Philsys_Number']) ? 1 : 0;
        $chk_Voter = isset($data['chk_Voter']) ? 1 : 0;
        $chk_Year_Last_Voted = isset($data['chk_Year_Last_Voted']) ? 1 : 0;
        $chk_Resident_Voter = isset($data['chk_Resident_Voter']) ? 1 : 0;

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
            ->where('a.Application_Status', 1)
            ->paginate(20, ['*'], 'details');

        //dd($detail);

        $pdf = PDF::loadView('bips_transactions.Inhabitants_List_PDF', compact(
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
        ))->setPaper('a4', 'landscape');
        $daFileNeym = "Inhabitants_List.pdf";
        return $pdf->download($daFileNeym);
    }

    public function viewPDF(Request $request)
    {
        $data = request()->all();


        $chk_Name = isset($data['chk_Name']) ? 1 : 0;
        $chk_Birthplace = isset($data['chk_Birthplace']) ? 1 : 0;
        $chk_Birthdate = isset($data['chk_Birthdate']) ? 1 : 0;
        $chk_Age = isset($data['chk_Age']) ? 1 : 0;
        $chk_Street = isset($data['chk_Street']) ? 1 : 0;
        $chk_Civil_Status = isset($data['chk_Civil_Status']) ? 1 : 0;
        $chk_Mobile = isset($data['chk_Mobile']) ? 1 : 0;
        $chk_Landline = isset($data['chk_Landline']) ? 1 : 0;
        $chk_Resident_Status = isset($data['chk_Resident_Status']) ? 1 : 0;
        $chk_Solo_Parent = isset($data['chk_Solo_Parent']) ? 1 : 0;
        $chk_Indigent = isset($data['chk_Indigent']) ? 1 : 0;
        $chk_Beneficiary = isset($data['chk_Beneficiary']) ? 1 : 0;
        $chk_Sex = isset($data['chk_Sex']) ? 1 : 0;
        $chk_House_No = isset($data['chk_House_No']) ? 1 : 0;
        $chk_Street = isset($data['chk_Street']) ? 1 : 0;
        $chk_Barangay = isset($data['chk_Barangay']) ? 1 : 0;
        $chk_City_Municipality = isset($data['chk_City_Municipality']) ? 1 : 0;
        $chk_Province = isset($data['chk_Province']) ? 1 : 0;
        $chk_Region = isset($data['chk_Region']) ? 1 : 0;
        $chk_Religion = isset($data['chk_Religion']) ? 1 : 0;
        $chk_Blood_Type = isset($data['chk_Blood_Type']) ? 1 : 0;
        $chk_Weight = isset($data['chk_Weight']) ? 1 : 0;
        $chk_Height = isset($data['chk_Height']) ? 1 : 0;
        $chk_Email = isset($data['chk_Email']) ? 1 : 0;
        $chk_Philsys_Number = isset($data['chk_Philsys_Number']) ? 1 : 0;
        $chk_Voter = isset($data['chk_Voter']) ? 1 : 0;
        $chk_Year_Last_Voted = isset($data['chk_Year_Last_Voted']) ? 1 : 0;
        $chk_Resident_Voter = isset($data['chk_Resident_Voter']) ? 1 : 0;

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
            ->where('a.Application_Status', 1)
            ->paginate(20, ['*'], 'details');

        //dd($detail);

        $pdf = PDF::loadView('bips_transactions.Inhabitants_List_PDF', compact(
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
        ))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function download_householdPDF(Request $request)
    {
        $data = request()->all();

        $chk_Household_Name = isset($data['chk_Household_Name']) ? 1 : 0;
        $chk_Household_Monthly_Income = isset($data['chk_Household_Monthly_Income']) ? 1 : 0;
        $chk_Family_Type_Name = isset($data['chk_Family_Type_Name']) ? 1 : 0;
        $chk_Tenure_of_Lot = isset($data['chk_Tenure_of_Lot']) ? 1 : 0;
        $chk_Housing_Unit = isset($data['chk_Housing_Unit']) ? 1 : 0;

        $db_entries = DB::table('bips_household_profile as a')
            ->leftjoin('maintenance_bips_family_type as b', 'a.Family_Type_ID', '=', 'b.Family_Type_ID')
            ->leftjoin('maintenance_bips_tenure_of_lot as c', 'a.Tenure_of_Lot_ID', '=', 'c.Tenure_of_Lot_ID')
            ->leftjoin('maintenance_bips_housing_unit as d', 'a.Housing_Unit_ID', '=', 'd.Housing_Unit_ID')
            ->select(
                'a.Household_Profile_ID',
                'a.Household_Name',
                'a.Household_Monthly_Income',
                'b.Family_Type_Name',
                'c.Tenure_of_Lot',
                'd.Housing_Unit',
            )
            ->paginate(20, ['*'], 'db_entries');
        //dd($detail);

        $pdf = PDF::loadView('bips_transactions.Household_List_PDF', compact(
            'chk_Household_Name',
            'chk_Household_Monthly_Income',
            'chk_Family_Type_Name',
            'chk_Tenure_of_Lot',
            'chk_Housing_Unit',
            'db_entries'
        ));
        $daFileNeym = "Inhabitants_List.pdf";
        return $pdf->download($daFileNeym);
    }

    public function view_householdPDF(Request $request)
    {
        $data = request()->all();

        $chk_Household_Name = isset($data['chk_Household_Name']) ? 1 : 0;
        $chk_Household_Monthly_Income = isset($data['chk_Household_Monthly_Income']) ? 1 : 0;
        $chk_Family_Type_Name = isset($data['chk_Family_Type_Name']) ? 1 : 0;
        $chk_Tenure_of_Lot = isset($data['chk_Tenure_of_Lot']) ? 1 : 0;
        $chk_Housing_Unit = isset($data['chk_Housing_Unit']) ? 1 : 0;

        $db_entries = DB::table('bips_household_profile as a')
            ->leftjoin('maintenance_bips_family_type as b', 'a.Family_Type_ID', '=', 'b.Family_Type_ID')
            ->leftjoin('maintenance_bips_tenure_of_lot as c', 'a.Tenure_of_Lot_ID', '=', 'c.Tenure_of_Lot_ID')
            ->leftjoin('maintenance_bips_housing_unit as d', 'a.Housing_Unit_ID', '=', 'd.Housing_Unit_ID')
            ->select(
                'a.Household_Profile_ID',
                'a.Household_Name',
                'a.Household_Monthly_Income',
                'b.Family_Type_Name',
                'c.Tenure_of_Lot',
                'd.Housing_Unit',
            )
            ->paginate(20, ['*'], 'db_entries');

        //dd($detail);

        $pdf = PDF::loadView('bips_transactions.Household_List_PDF', compact(
            'chk_Household_Name',
            'chk_Household_Monthly_Income',
            'chk_Family_Type_Name',
            'chk_Tenure_of_Lot',
            'chk_Housing_Unit',
            'db_entries'
        ));
        return $pdf->stream();
    }

    public function get_inhabitant_list($Barangay_ID)
    {
        $data = DB::table('bips_brgy_inhabitants_information as a')
            ->leftjoin('maintenance_bips_name_prefix as b', 'a.Name_Prefix_ID', '=', 'b.Name_Prefix_ID')
            ->leftjoin('maintenance_bips_name_suffix as c', 'a.Name_Suffix_ID', '=', 'c.Name_Suffix_ID')
            ->leftjoin('maintenance_bips_civil_status as d', 'a.Civil_Status_ID', '=', 'd.Civil_Status_ID')
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
                'a.Religion_ID',
                'a.Blood_Type_ID',
                'a.Sex',
                'a.Mobile_No',
                'a.Telephone_No',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Province_ID',
                'a.Region_ID',
                'a.Street',
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
                'd.Civil_Status'
            )
            ->where('a.Application_Status', 1)
            ->where('a.Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }

    public function get_household_list($Barangay_ID)
    {
        $data = DB::table('bips_household_profile as a')
            ->leftjoin('maintenance_bips_family_type as b', 'a.Family_Type_ID', '=', 'b.Family_Type_ID')
            ->leftjoin('maintenance_bips_tenure_of_lot as c', 'a.Tenure_of_Lot_ID', '=', 'c.Tenure_of_Lot_ID')
            ->leftjoin('maintenance_bips_housing_unit as d', 'a.Housing_Unit_ID', '=', 'd.Housing_Unit_ID')
            ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
            ->select(
                'a.Household_Profile_ID',
                'a.Household_Name',
                'a.Household_Monthly_Income',
                'b.Family_Type_Name',
                'c.Tenure_of_Lot',
                'd.Housing_Unit',
            )
            ->where('a.Barangay_ID', $Barangay_ID)
            ->get();

        return json_encode($data);
    }

    public function get_deceased_list($Barangay_ID)
    {
        $data = DB::table('bips_deceased_profile as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_bips_deceased_type as c', 'a.Deceased_Type_ID', '=', 'c.Deceased_Type_ID')
            ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
            ->select(
                'a.Resident_ID',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
                'a.Deceased_Type_ID',
                'c.Deceased_Type',
                'a.Cause_of_Death',
                'a.Date_of_Death',
            )
            ->where('b.Application_Status', 1)
            ->where('a.Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }

    public function get_transfer_list($Barangay_ID)
    {
        $data = DB::table('Inhabitants_Transfer as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_region as c', 'a.Region_ID', '=', 'c.Region_ID')
            ->leftjoin('maintenance_province as d', 'a.Province_ID', '=', 'd.Province_ID')
            ->leftjoin('maintenance_city_municipality as e', 'a.City_Municipality_ID', '=', 'e.City_Municipality_ID')
            ->leftjoin('maintenance_barangay as f', 'a.Barangay_ID', '=', 'f.Barangay_ID')
            ->leftjoin('maintenance_barangay as g', 'a.Main_Barangay_ID', '=', 'g.Barangay_ID')
            ->select(
                'a.Inhabitants_Transfer_ID',
                'a.Resident_ID',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
                'a.Region_ID',
                'c.Region_Name',
                'a.Province_ID',
                'd.Province_Name',
                'a.City_Municipality_ID',
                'e.City_Municipality_Name',
                'a.Barangay_ID',
                'f.Barangay_Name',
            )
            ->where('b.Application_Status', 1)
            ->where('a.Main_Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }

    public function official_list(Request $request)
    {
        $currDATE = Carbon::now();
        if (Auth::user()->User_Type_ID == 3) {
            $db_entries = DB::table('Inhabitants_Transfer as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_region as c', 'a.Region_ID', '=', 'c.Region_ID')
                ->leftjoin('maintenance_province as d', 'a.Province_ID', '=', 'd.Province_ID')
                ->leftjoin('maintenance_city_municipality as e', 'a.City_Municipality_ID', '=', 'e.City_Municipality_ID')
                ->leftjoin('maintenance_barangay as f', 'a.Barangay_ID', '=', 'f.Barangay_ID')
                ->leftjoin('maintenance_barangay as g', 'a.Main_Barangay_ID', '=', 'g.Barangay_ID')
                ->select(
                    'a.Inhabitants_Transfer_ID',
                    'a.Resident_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'a.Region_ID',
                    'c.Region_Name',
                    'a.Province_ID',
                    'd.Province_Name',
                    'a.City_Municipality_ID',
                    'e.City_Municipality_Name',
                    'a.Barangay_ID',
                    'f.Barangay_Name',
                )
                ->where('b.Application_Status', 1)
                ->where('g.Province_ID', Auth::user()->Province_ID)
                ->paginate(20, ['*'], 'db_entries');
        } elseif (Auth::user()->User_Type_ID == 1) {
            $db_entries = DB::table('Inhabitants_Transfer as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_region as c', 'a.Region_ID', '=', 'c.Region_ID')
                ->leftjoin('maintenance_province as d', 'a.Province_ID', '=', 'd.Province_ID')
                ->leftjoin('maintenance_city_municipality as e', 'a.City_Municipality_ID', '=', 'e.City_Municipality_ID')
                ->leftjoin('maintenance_barangay as f', 'a.Barangay_ID', '=', 'f.Barangay_ID')
                ->select(
                    'a.Inhabitants_Transfer_ID',
                    'a.Resident_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'a.Region_ID',
                    'c.Region_Name',
                    'a.Province_ID',
                    'd.Province_Name',
                    'a.City_Municipality_ID',
                    'e.City_Municipality_Name',
                    'a.Barangay_ID',
                    'f.Barangay_Name',
                )
                ->where('b.Application_Status', 1)
                ->where('a.Main_Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');
        }
        $city1 = DB::table('maintenance_city_municipality')
            ->where('Province_ID', Auth::user()->Province_ID)
            ->get();
        $name = DB::table('bips_brgy_inhabitants_information')->where('Application_Status', 1)->paginate(20, ['*'], 'name');
        $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
        $province = DB::table('maintenance_province')->paginate(20, ['*'], 'province');
        $barangay = DB::table('maintenance_barangay')->paginate(20, ['*'], 'barangay');
        $city = DB::table('maintenance_city_municipality')->paginate(20, ['*'], 'city');

        return view('bips_transactions.inhabitants_transfer_list', compact(
            'db_entries',
            'currDATE',
            'name',
            'region',
            'province',
            'barangay',
            'city',
            'city1'

        ));
    }


    //Brgy Official
    //Brgy Official List
    public function brgy_official_list(Request $request)
    {
        $currDATE = Carbon::now();
        if (Auth::user()->User_Type_ID == 3) {
            $db_entries = DB::table('bips_brgy_officials_and_staff as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_bips_brgy_position as c', 'a.Barangay_Position_ID', '=', 'c.Brgy_Position_ID')
                ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
                ->select(
                    'a.Resident_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'a.Barangay_Position_ID',
                    'c.Brgy_Position',
                    'a.Brgy_Officials_and_Staff_ID',
                    'a.Term_From',
                    'a.Term_To',
                    'a.monthly_income',
                )
                ->where('b.Application_Status', 1)
                ->where('e.Province_ID', Auth::user()->Province_ID)
                ->paginate(20, ['*'], 'db_entries');
        } elseif (Auth::user()->User_Type_ID == 1) {
            $db_entries = DB::table('bips_brgy_officials_and_staff as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_bips_brgy_position as c', 'a.Barangay_Position_ID', '=', 'c.Brgy_Position_ID')
                ->select(
                    'a.Resident_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'a.Barangay_Position_ID',
                    'c.Brgy_Position',
                    'a.Brgy_Officials_and_Staff_ID',
                    'a.Term_From',
                    'a.Term_To',
                    'a.monthly_income',
                )
                ->where('b.Application_Status', 1)
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');
        }

        $city1 = DB::table('maintenance_city_municipality')
            ->where('Province_ID', Auth::user()->Province_ID)
            ->get();
        $name = DB::table('bips_brgy_inhabitants_information')->paginate(20, ['*'], 'name');
        $brgy_position = DB::table('maintenance_bips_brgy_position')->where('Active', 1)->get();

        return view('bips_transactions.brgy_official_list', compact(
            'db_entries',
            'currDATE',
            'name',
            'brgy_position',
            'city1'
        ));
    }


    // Save Brgy Official
    public function create_brgy_official(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        // dd($data);

        DB::table('bips_brgy_officials_and_staff')->insert(
            array(
                'Resident_ID' => $data['Resident_IDs'],
                'Barangay_Position_ID' => $data['Brgy_Position_ID'],
                'Term_From' => $data['Term_From'],
                'Term_To' => $data['Term_To'],
                'monthly_income' => $data['monthly_income'],
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Barangay_ID'       => Auth::user()->Barangay_ID,
                'Active'       => 1,
            )
        );
        return redirect()->back()->with('message', 'New Entry Created');
    }

    // Display Brgy Official
    public function get_brgy_official(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bips_brgy_officials_and_staff as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_bips_brgy_position as c', 'a.Barangay_Position_ID', '=', 'c.Brgy_Position_ID')
            ->select(
                'a.Brgy_Officials_and_Staff_ID',
                'a.Resident_ID',
                'a.Barangay_Position_ID',
                'a.Term_from',
                'a.Term_to',
                'a.monthly_income',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
                'c.Brgy_Position',
            )
            ->where('a.Brgy_Officials_and_Staff_ID', $id)->get();

        return (compact('theEntry'));
    }
    //updating Brgy Official
    public function update_brgy_official(Request $request)

    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bips_brgy_officials_and_staff')->where('Brgy_Officials_and_Staff_ID', $data['Brgy_Officials_and_Staff_ID'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'created_at'       => Carbon::now(),
                'Barangay_Position_ID' => $data['Brgy_Position_ID2'],
                'Term_From' => $data['Term_From2'],
                'Term_To' => $data['Term_To2'],
                'monthly_income' => $data['monthly_income2'],

            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Brgy Purok Leader
    //Brgy Purok Leader List
    public function brgy_purok_leader_list(Request $request)
    {
        $currDATE = Carbon::now();
        if (Auth::user()->User_Type_ID == 3) {
            $db_entries = DB::table('bips_brgy_purok_leader as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
                ->select(
                    'a.Resident_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'a.Brgy_Purok_Leader_ID',
                    'a.Term_From',
                    'a.Term_To',
                )
                ->where('b.Application_Status', 1)
                ->where('e.Province_ID', Auth::user()->Province_ID)
                ->paginate(20, ['*'], 'db_entries');
        } elseif (Auth::user()->User_Type_ID == 1) {
            $db_entries = DB::table('bips_brgy_purok_leader as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->select(
                    'a.Resident_ID',
                    'b.Last_Name',
                    'b.First_Name',
                    'b.Middle_Name',
                    'a.Brgy_Purok_Leader_ID',
                    'a.Term_From',
                    'a.Term_To',
                )
                // ->where('b.Application_Status', 1)
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');
        }

        $city1 = DB::table('maintenance_city_municipality')
            ->where('Province_ID', Auth::user()->Province_ID)
            ->get();
        $name = DB::table('bips_brgy_inhabitants_information')->paginate(20, ['*'], 'name');

        return view('bips_transactions.brgy_purok_leaders_list', compact(
            'db_entries',
            'currDATE',
            'name',
            'city1'
        ));
    }


    // Save Brgy Official
    public function create_brgy_purok_leader(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        // dd($data);

        DB::table('bips_brgy_purok_leader')->insert(
            array(
                'Resident_ID' => $data['Resident_IDs'],
                'Term_From' => $data['Term_From'],
                'Term_To' => $data['Term_To'],
                'Encoder_ID'       => Auth::user()->id,
                'created_at'       => Carbon::now(),
                'Barangay_ID'       => Auth::user()->Barangay_ID,
                'Active'       => 1,
            )
        );
        return redirect()->back()->with('message', 'New Entry Created');
    }

    // Display Brgy Official
    public function get_brgy_purok_leader(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bips_brgy_purok_leader as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->select(
                'a.Brgy_Purok_Leader_ID',
                'a.Resident_ID',
                'a.Term_From',
                'a.Term_To',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
            )
            ->where('Brgy_Purok_Leader_ID', $id)->get();

        return (compact('theEntry'));
    }
    //updating Brgy Official
    public function update_brgy_purok_leader(Request $request)

    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bips_brgy_purok_leader')->where('Brgy_Purok_Leader_ID', $data['Brgy_Purok_Leader_ID'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'created_at'       => Carbon::now(),
                'Term_From' => $data['Term_From2'],
                'Term_To' => $data['Term_To2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Processing Sched
    //Processing Sched List
    public function processing_sched(Request $request)
    {
        $currDATE = Carbon::now();

        $db_entries = DB::table('bips_processing_sched')
            ->where('Barangay_ID', Auth::user()->Barangay_ID)
            ->get();

        return view('bips_transactions.processing_sched', compact(
            'db_entries'
        ));
    }

    //updating Processing Sched
    public function update_processing_sched(Request $request)

    {
        $currDATE = Carbon::now();
        $data = request()->all();

        $sched = [
            'Barangay_ID' => Auth::user()->Barangay_ID,
            'days' => $data['days'],
            'Encoder_ID'       => Auth::user()->id,
            'updated_at'       => Carbon::now()
        ];

        DB::table('bips_processing_sched')->updateOrInsert(['Barangay_ID' => Auth::user()->Barangay_ID], $sched);

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Inhabitants Information List
    public function inhabitants_household_details_view($id)
    {
        $currDATE = Carbon::now();

        $household = DB::table('bips_household_profile')->where('Household_Profile_ID', $id)->get();
        $resident = DB::table('bips_brgy_inhabitants_information')->where('Application_Status', 1)->get();
        $family_position = DB::table('maintenance_bips_family_position')->where('Active', 1)->get();
        $tenure_of_lot = DB::table('maintenance_bips_tenure_of_lot')->where('Active', 1)->get();
        $housing_unit = DB::table('maintenance_bips_housing_unit')->where('Active', 1)->get();
        $family_type = DB::table('maintenance_bips_family_type')->where('Active', 1)->get();
        $household_members = DB::table('bips_household_profile_members as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'b.Resident_ID', '=', 'a.Resident_ID')
            ->where('a.Household_Profile_ID', $id)
            ->get();

        return view('bips_transactions.inhabitants_household_profile_details_view', compact(
            'currDATE',
            'family_position',
            'tenure_of_lot',
            'housing_unit',
            'family_type',
            'resident',
            'household',
            'household_members',
        ));
    }

    public function search_inhabitants(Request $request)
    {
        $currDATE = Carbon::now();
        $inhabitants = DB::table('bips_brgy_inhabitants_information')
            ->select(DB::raw('CONCAT(Last_Name, ", ", First_Name, " ", Middle_Name, ", Birthdate:", DATE_FORMAT(Birthdate, "%b-%d-%Y"),", Age:", TIMESTAMPDIFF(YEAR, DATE(Birthdate), current_date),", Sex:", (CASE WHEN Sex="1" THEN "Male" ELSE "Female" END)) AS text'), 'Resident_ID as id',)
            ->where('Barangay_ID', Auth::user()->Barangay_ID)
            ->where(
                function ($query) use ($request) {
                    return $query
                        ->where('Last_Name', 'LIKE', '%' . $request->input('term', '') . '%')
                        ->orWhere('First_Name', 'LIKE', '%' . $request->input('term', '') . '%')
                        ->orWhere('Middle_Name', 'LIKE', '%' . $request->input('term', '') . '%');
                }
            )
            ->get();

        // dd($inhabitants);

        return ['results' => $inhabitants];
    }


    public function delete_inhabitants(Request $request)
    {
        $id = $_GET['id'];

        DB::table('bips_brgy_inhabitants_information')->where('Resident_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function delete_household(Request $request)
    {
        $id = $_GET['id'];

        DB::table('bips_household_profile')->where('Household_Profile_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function delete_deceased_profile(Request $request)
    {
        $id = $_GET['id'];

        DB::table('bips_deceased_profile')->where('Resident_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function delete_brgy_official(Request $request)
    {
        $id = $_GET['id'];

        DB::table('bips_brgy_officials_and_staff')->where('Brgy_Officials_and_Staff_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function delete_brgy_purok_leader(Request $request)
    {
        $id = $_GET['id'];

        DB::table('bips_brgy_purok_leader')->where('Brgy_Purok_Leader_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    // Display Household Details
    public function get_household_info(Request $request)
    {
        $id = $_GET['id'];



        $theEntry = DB::table('bips_household_profile as a')
            ->leftjoin('maintenance_bips_family_type as b', 'a.Family_Type_ID', '=', 'b.Family_Type_ID')
            ->leftjoin('maintenance_bips_housing_unit as c', 'a.Housing_Unit_ID', '=', 'c.Housing_Unit_ID')
            ->leftjoin('maintenance_bips_tenure_of_lot as d', 'a.Tenure_of_Lot_ID', '=', 'd.Tenure_of_Lot_ID')
            ->select(
                'a.Household_Profile_ID',
                'a.Household_Monthly_Income',
                'a.Household_Name',
                'a.Barangay_ID',
                'a.Date_Stamp',
                'b.Family_Type_ID',
                'b.Family_Type_Name',
                'c.Housing_Unit_ID',
                'c.Housing_Unit',
                'd.Tenure_of_Lot_ID',
                'd.Tenure_of_Lot',

            )
            ->where('a.Household_Profile_ID', $id)->get();
        return (compact('theEntry'));
    }

    // Display Household Members
    public function get_houshold_members(Request $request)
    {
        $id = $_GET['id'];

        $data = DB::table('bips_household_profile_members as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_bips_family_position as c', 'a.Family_Position_ID', '=', 'c.Family_Position_ID')
            ->select(
                'a.Household_Profile_ID',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
                'c.Family_Position',
                'a.Family_Head'
            )
            ->where('a.Household_Profile_ID', $id)->get();
        return json_encode($data);
    }

    // Display Household Details
    public function get_deceased_info(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bips_deceased_profile as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_bips_deceased_type as c', 'a.Deceased_Type_ID', '=', 'c.Deceased_Type_ID')
            ->select(
                'a.Resident_ID',
                'a.Cause_of_Death',
                'a.Date_of_Death',
                'a.Barangay_ID',
                'a.Date_Stamp',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
                'c.Deceased_Type',
            )
            ->where('a.Resident_ID', $id)->get();
        return (compact('theEntry'));
    }

    public function inhabitants_export(Request $request)
    {
        $data = request()->all();

        $chk_Name = isset($data['chk_Name']) ? 1 : 0;
        $chk_Birthplace = isset($data['chk_Birthplace']) ? 1 : 0;
        $chk_Birthdate = isset($data['chk_Birthdate']) ? 1 : 0;
        $chk_Age = isset($data['chk_Age']) ? 1 : 0;
        $chk_Street = isset($data['chk_Street']) ? 1 : 0;
        $chk_Civil_Status = isset($data['chk_Civil_Status']) ? 1 : 0;
        $chk_Mobile = isset($data['chk_Mobile']) ? 1 : 0;
        $chk_Landline = isset($data['chk_Landline']) ? 1 : 0;
        $chk_Resident_Status = isset($data['chk_Resident_Status']) ? 1 : 0;
        $chk_Solo_Parent = isset($data['chk_Solo_Parent']) ? 1 : 0;
        $chk_Indigent = isset($data['chk_Indigent']) ? 1 : 0;
        $chk_Beneficiary = isset($data['chk_Beneficiary']) ? 1 : 0;
        $chk_Sex = isset($data['chk_Sex']) ? 1 : 0;
        $chk_House_No = isset($data['chk_House_No']) ? 1 : 0;
        $chk_Street = isset($data['chk_Street']) ? 1 : 0;
        $chk_Barangay = isset($data['chk_Barangay']) ? 1 : 0;
        $chk_City_Municipality = isset($data['chk_City_Municipality']) ? 1 : 0;
        $chk_Province = isset($data['chk_Province']) ? 1 : 0;
        $chk_Region = isset($data['chk_Region']) ? 1 : 0;
        $chk_Religion = isset($data['chk_Religion']) ? 1 : 0;
        $chk_Blood_Type = isset($data['chk_Blood_Type']) ? 1 : 0;
        $chk_Weight = isset($data['chk_Weight']) ? 1 : 0;
        $chk_Height = isset($data['chk_Height']) ? 1 : 0;
        $chk_Email = isset($data['chk_Email']) ? 1 : 0;
        $chk_Philsys_Number = isset($data['chk_Philsys_Number']) ? 1 : 0;
        $chk_Voter = isset($data['chk_Voter']) ? 1 : 0;
        $chk_Year_Last_Voted = isset($data['chk_Year_Last_Voted']) ? 1 : 0;
        $chk_Resident_Voter = isset($data['chk_Resident_Voter']) ? 1 : 0;

        $title = 'inhabitants.xlsx';

        return Excel::download(new InhabitantsExportView($chk_Name, $chk_Birthplace, $chk_Birthdate, $chk_Age, $chk_Street, $chk_Civil_Status, $chk_Mobile, $chk_Landline, $chk_Resident_Status, $chk_Solo_Parent, $chk_Indigent, $chk_Beneficiary, $chk_Sex, $chk_House_No, $chk_Barangay, $chk_City_Municipality, $chk_Province, $chk_Region, $chk_Religion, $chk_Blood_Type, $chk_Weight, $chk_Height, $chk_Email, $chk_Philsys_Number, $chk_Voter, $chk_Year_Last_Voted, $chk_Resident_Voter), $title);
    }
}
