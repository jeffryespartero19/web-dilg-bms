<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;

class bipsController extends Controller
{
    //BIPS TRANSACTIONS

    //Inhabitants Information List
    public function inhabitants_information_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bips_brgy_inhabitants_information as a')
            ->leftjoin('maintenance_bips_name_prefix as b', 'a.Name_Prefix_ID', '=', 'b.Name_Prefix_ID')
            ->leftjoin('maintenance_bips_name_suffix as c', 'a.Name_Suffix_ID', '=', 'c.Name_Suffix_ID')
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
                'b.Name_Prefix',
                'c.Name_Suffix'
            )
            ->paginate(20, ['*'], 'db_entries');
        $religion = DB::table('maintenance_bips_religion')->where('Active', 1)->get();
        $blood_type = DB::table('maintenance_bips_blood_type')->where('Active', 1)->get();
        $civil_status = DB::table('maintenance_bips_civil_status')->where('Active', 1)->get();
        $prefix = DB::table('maintenance_bips_name_prefix')->where('Active', 1)->get();
        $suffix = DB::table('maintenance_bips_name_suffix')->where('Active', 1)->get();
        $region = DB::table('maintenance_region')->where('Active', 1)->get();
        $province = DB::table('maintenance_province')->where('Active', 1)->get();
        $city = DB::table('maintenance_city_municipality')->where('Active', 1)->get();
        $barangay = DB::table('maintenance_barangay')->where('Active', 1)->get();
        $country = DB::table('maintenance_country')->where('Active', 1)->get();
        $academic_level = DB::table('maintenance_bips_academic_level')->where('Active', 1)->get();
        $employment_type = DB::table('maintenance_bips_employment_type')->where('Active', 1)->get();

        return view('bips_transactions.inhabitants_information_list', compact(
            'db_entries',
            'currDATE',
            'religion',
            'blood_type',
            'civil_status',
            'prefix',
            'suffix',
            'region',
            'province',
            'city',
            'barangay',
            'country',
            'academic_level',
            'employment_type'
        ));
    }

    // Save Inhabitants Info
    public function create_inhabitants_information(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        $validated = $request->validate([
            'Last_Name' => 'required',
            'First_Name' => 'required',
            'Middle_Name' => 'required',
            'Birthdate' => 'required',
            'Sex' => 'required',
            'Barangay_ID' => 'required',
            'City_Municipality_ID' => 'required',
            'Province_ID' => 'required',
            'Region_ID' => 'required',
            'Email_Address' => 'required|email',
        ]);


        // dd($data);

        if ($data['Resident_ID'] == null || $data['Resident_ID'] == 0) {
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
                    'Salary' => $data['Salary'],
                    'Email_Address' => $data['Email_Address'],
                    'PhilSys_Card_No' => $data['PhilSys_Card_No'],
                    'Solo_Parent' => (int)$data['Solo_Parent'],
                    'OFW' => (int)$data['OFW'],
                    'Indigent' => (int)$data['Indigent'],
                    '4Ps_Beneficiary' => (int)$data['4Ps_Beneficiary'],
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now()
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

            return redirect()->back()->with('message', 'New Entry Created');
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
                    'Salary' => $data['Salary'],
                    'Email_Address' => $data['Email_Address'],
                    'PhilSys_Card_No' => $data['PhilSys_Card_No'],
                    'Solo_Parent' => (int)$data['Solo_Parent'],
                    'OFW' => (int)$data['OFW'],
                    'Indigent' => (int)$data['Indigent'],
                    '4Ps_Beneficiary' => (int)$data['4Ps_Beneficiary'],
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now()
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
            return redirect()->back()->with('message', 'Inhabitant Info Updated');
        }
    }

    // Display Inhabitants Details
    public function get_inhabitants_info(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bips_brgy_inhabitants_information as a')
            ->leftjoin('maintenance_barangay as b', 'a.Barangay_ID', '=', 'b.Barangay_ID')
            ->leftjoin('maintenance_city_municipality as c', 'a.City_Municipality_ID', '=', 'c.City_Municipality_ID')
            ->leftjoin('maintenance_province as d', 'a.Province_ID', '=', 'd.Province_ID')
            ->leftjoin('bips_resident_profile as e', 'a.Resident_ID', '=', 'e.Resident_ID')
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
                'b.Barangay_Name',
                'c.City_Municipality_Name',
                'd.Province_Name',
                'e.Resident_Status',
                'e.Voter_Status',
                'e.Election_Year_Last_Voted',
                'e.Resident_Voter',
            )
            ->where('a.Resident_ID', $id)
            ->get();

        return (compact('theEntry'));
    }

    public function get_inhabitants_edu_info(Request $request)
    {
        $id = $_GET['id'];
        $Education = DB::table('bips_education as a')
            ->leftjoin('maintenance_bips_academic_level as b', 'a.Academic_Level_ID', '=', 'b.Academic_Level_ID')
            ->select(
                'a.Education_ID',
                'a.Academic_Level_ID',
                'b.Academic_Level',
                'a.School_Name',
                'a.School_Year_Start',
                'a.School_Year_End',
                'a.Course',
                'a.Year_Graduated',
            )
            ->where('a.Resident_ID', $id)
            ->get();
        return json_encode($Education);
    }

    public function get_inhabitants_epm_info(Request $request)
    {
        $id = $_GET['id'];
        $Employment = DB::table('bips_employment_history as a')
            ->leftjoin('maintenance_bips_employment_type as b', 'a.Employment_Type_ID', '=', 'b.Employment_Type_ID')
            ->select(
                'a.Resident_ID',
                'a.Employment_Type_ID',
                'a.Company_Name',
                'a.Employer_Name',
                'a.Employer_Address',
                'a.Position',
                'a.Start_Date',
                'a.End_Date',
                'a.Monthly_Salary',
                'a.Brief_Description',
                'b.Employment_Type',
            )
            ->where('a.Resident_ID', $id)
            ->get();
        return json_encode($Employment);
    }

    //Inhabitants Household List
    public function inhabitants_household_profile(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bips_household_profile as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_bips_name_prefix as c', 'b.Name_Prefix_ID', '=', 'c.Name_Prefix_ID')
            ->leftjoin('maintenance_bips_name_suffix as d', 'b.Name_Suffix_ID', '=', 'd.Name_Suffix_ID')
            ->select(
                'a.Household_Profile_ID',
                'a.Resident_ID',
                'a.Family_Position_ID',
                'a.Tenure_of_Lot_ID',
                'a.Housing_Unit_ID',
                'a.Household_Monthly_Income',
                'a.Household_Name',
                'a.Family_Type_ID',
                'c.Name_Prefix',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
                'd.Name_Suffix',
            )
            ->paginate(20, ['*'], 'db_entries');
        $resident = DB::table('bips_brgy_inhabitants_information')->get();
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
        ));
    }

    // Save Inhabitants Household Info
    public function create_household_information(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        $validated = $request->validate([
            'Resident_ID' => 'required',
        ]);


        // dd($data);

        if ($data['Household_Profile_ID'] == null || $data['Household_Profile_ID'] == 0) {
            DB::table('bips_household_profile')->insert(
                array(
                    'Resident_ID' => $data['Resident_ID'],
                    'Household_Monthly_Income' => $data['Household_Monthly_Income'],
                    'Family_Position_ID' => $data['Family_Position_ID'],
                    'Tenure_of_Lot_ID' => $data['Tenure_of_Lot_ID'],
                    'Housing_Unit_ID' => $data['Housing_Unit_ID'],
                    'Family_Type_ID' => $data['Family_Type_ID'],
                    'Household_Name' => $data['Household_Name'],
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now()
                )
            );

            return redirect()->back()->with('message', 'New Household Created');
        } else {
            DB::table('bips_household_profile')->where('Resident_ID', $data['Resident_ID'])->update(
                array(
                    'Resident_ID' => $data['Resident_ID'],
                    'Household_Monthly_Income' => $data['Household_Monthly_Income'],
                    'Family_Position_ID' => $data['Family_Position_ID'],
                    'Tenure_of_Lot_ID' => $data['Tenure_of_Lot_ID'],
                    'Housing_Unit_ID' => $data['Housing_Unit_ID'],
                    'Family_Type_ID' => $data['Family_Type_ID'],
                    'Household_Name' => $data['Household_Name'],
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now()
                )
            );

            return redirect()->back()->with('message', 'Household Info Updated');
        }
    }

    // Display Household Details
    public function get_household_info(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bips_household_profile as a')
            ->join('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->select(
                'a.Household_Profile_ID',
                'a.Resident_ID',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
                'b.Name_Suffix_ID',
                'a.Family_Type_ID',
                'a.Family_Position_ID',
                'a.Tenure_of_Lot_ID',
                'a.Housing_Unit_ID',
                'a.Household_Monthly_Income',
                'a.Household_Name',

            )
            ->where('a.Household_Profile_ID', $id)
            ->get();

        return (compact('theEntry'));
    }

    //Inhabitants Resident List
    public function inhabitants_resident_profile(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bips_resident_profile as a')
            ->join('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_bips_name_suffix as c', 'b.Name_Suffix_ID', '=', 'c.Name_Suffix_ID')
            ->select(
                'a.Resident_ID',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
                'c.Name_Suffix',
                'a.Resident_Status',
                'a.Voter_Status',
                'a.Resident_Voter',
            )
            ->paginate(20, ['*'], 'db_entries');
        $resident = DB::table('bips_brgy_inhabitants_information')
            ->whereNotIn('Resident_ID', function ($q) {
                $q->select('Resident_ID')->from('bips_resident_profile');
            })
            ->get();

        return view('bips_transactions.inhabitants_resident_profile', compact(
            'db_entries',
            'currDATE',
            'resident',
        ));
    }

    // Save Inhabitants Resident Info
    public function create_resident_information(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        $validated = $request->validate([
            'Resident_ID' => 'required',
        ]);

        // dd($data);

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

        return redirect()->back()->with('message', 'Resident Saved');
    }

    // Display Resident Details
    public function get_resident_info(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bips_resident_profile as a')
            ->join('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_bips_name_suffix as c', 'b.Name_Suffix_ID', '=', 'c.Name_Suffix_ID')
            ->select(
                'a.Resident_ID',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
                'c.Name_Suffix',
                'a.Resident_Status',
                'a.Voter_Status',
                'a.Election_Year_Last_Voted',
                'a.Resident_Voter',
            )
            ->where('a.Resident_ID', $id)
            ->get();

        return (compact('theEntry'));
    }
}
