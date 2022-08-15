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
        $name_prefix = DB::table('maintenance_bips_name_prefix')->where('Active', 1)->get();
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
            'name_prefix',
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

        DB::table('bips_brgy_inhabitants_information')->insert(
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

            return redirect()->back()->with('alert', 'New Entry Created');
        }
    }

    // Display Inhabitants Details
    public function get_inhabitants_info(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bips_brgy_inhabitants_information')->where('Resident_ID', $id)->get();

        return (compact('theEntry'));
    }


    //Deceased Profile
    //Deceased Profile List
    public function deceased_profile_list(Request $request)
    {
        $currDATE = Carbon::now();
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
            ->paginate(20, ['*'], 'db_entries');



        $name = DB::table('bips_brgy_inhabitants_information')->paginate(20, ['*'], 'name');
        $deceased_type = DB::table('maintenance_bips_deceased_type')->where('Active', 1)->get();

        return view('bips_transactions.deceased_profile_list', compact(
            'db_entries',
            'currDATE',
            'name',
            'deceased_type',
        ));
    }


    // Save Deceased Profile
    public function create_deceased_profile(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('bips_deceased_profile')->insert(
            array(
                'Resident_ID' => $data['Resident_ID'],
                'Deceased_Type_ID' => $data['Deceased_Type_ID'],
                'Cause_of_Death' => $data['Cause_of_Death'],
                'Date_of_Death' => $data['Date_of_Death'],
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now()
            )
        );
        return redirect()->back()->with('message', 'New Entry Created');
    }

    // Display Deceased Profile
    public function get_deceased_profile(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('bips_deceased_profile as a')
            ->select(
                'a.Resident_ID',
                'a.Deceased_Type_ID',
                'a.Cause_of_Death',
                'a.Date_of_Death',
            )
            ->where('Resident_ID', $id)->get();

        return (compact('theEntry'));
    }
    //updating Deceased Profile
    public function update_deceased_profile(Request $request)

    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

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
        $db_entries = DB::table('bips_inhabitants_transfer as a')
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
            ->paginate(20, ['*'], 'db_entries');

        $name = DB::table('bips_brgy_inhabitants_information')->paginate(20, ['*'], 'name');
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

        ));
    }

    // Save Inhabitants Transfer
    public function create_inhabitants_transfer(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('bips_inhabitants_transfer')->insert(
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
        return redirect()->back()->with('message', 'New Entry Created');
    }


    // Display Inhabitants Transfer
    public function get_inhabitants_transfer(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bips_inhabitants_transfer as a')
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
            ->where('Inhabitants_Transfer_ID', $id)->get();

        return (compact('theEntry'));
    }

    //Inhabitants Incoming List
    public function inhabitants_incoming_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bips_inhabitants_transfer as a')
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
            ->paginate(20, ['*'], 'db_entries');
        $db_entries2 = DB::table('bips_inhabitants_transfer as a')
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
            ->paginate(20, ['*'], 'db_entries');
        $db_entries3 = DB::table('bips_inhabitants_transfer as a')
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
            ->paginate(20, ['*'], 'db_entries');
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
            'barangay'
        ));
    }

    // Approve Disapprove Inhabitants Transfer
    public function approve_disapprove_inhabitants(Request $request)
    {
        $data = $data = request()->all();

        if ($data['Status_ID'] == 1) {
            $message = 'Approved';

            $resident = DB::table('bips_inhabitants_transfer')->where('Resident_ID', $data['Resident_ID'])->get();

            DB::table('bips_inhabitants_transfer')->where('Resident_ID', $data['Resident_ID'])->update(
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

            DB::table('bips_inhabitants_transfer')->where('Resident_ID', $data['Resident_ID'])->update(
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
}
