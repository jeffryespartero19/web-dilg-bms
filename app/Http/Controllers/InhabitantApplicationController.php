<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class InhabitantApplicationController extends Controller
{
    //BIPS TRANSACTIONS

    //Inhabitants Information List
    public function inhabitant_application(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bips_brgy_inhabitants_information')
            ->select(
                'Resident_ID',
                'Name_Prefix_ID',
                'Last_Name',
                'First_Name',
                'Middle_Name',
                'Name_Suffix_ID',
                'Birthplace',
                'Weight',
                'Height',
                'Civil_Status_ID',
                'Birthdate',
                'Country_ID',
                'Religion_ID',
                'Blood_Type_ID',
                'Sex',
                'Mobile_No',
                'Telephone_No',
                'Barangay_ID',
                'City_Municipality_ID',
                'Province_ID',
                'Region_ID',
                'Salary',
                'Email_Address',
                'PhilSys_Card_No',
                'Solo_Parent',
                'OFW',
                'Indigent',
                '4Ps_Beneficiary as Beneficiary',
                'Encoder_ID',
                'Date_Stamp',
                'Application_Status',
            )
            ->where('Encoder_ID', Auth::user()->id)
            ->get();

        if ($db_entries->isEmpty()) {
            $province = DB::table('maintenance_province')->where('Active', 1)->get();
            $city = DB::table('maintenance_city_municipality')->where('Active', 1)->get();
            $barangay = DB::table('maintenance_barangay')->where('Active', 1)->get();
            $religion = DB::table('maintenance_bips_religion')->get();
            $blood_type = DB::table('maintenance_bips_blood_type')->where('Active', 1)->get();
            $civil_status = DB::table('maintenance_bips_civil_status')->where('Active', 1)->get();
            $name_prefix = DB::table('maintenance_bips_name_prefix')->where('Active', 1)->get();
            $suffix = DB::table('maintenance_bips_name_suffix')->where('Active', 1)->get();
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $country = DB::table('maintenance_country')->where('Active', 1)->get();
            $academic_level = DB::table('maintenance_bips_academic_level')->where('Active', 1)->get();
            $employment_type = DB::table('maintenance_bips_employment_type')->where('Active', 1)->get();

            return view('bips_transactions.inhabitant_application', compact(
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
                'db_entries'
            ));
        } else {
            $province = DB::table('maintenance_province')->where('Active', 1)->where('Region_ID', $db_entries[0]->Region_ID)->get();
            $city = DB::table('maintenance_city_municipality')->where('Active', 1)->where('Province_ID', $db_entries[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('Active', 1)->where('City_Municipality_ID', $db_entries[0]->City_Municipality_ID)->get();
            $religion = DB::table('maintenance_bips_religion')->get();
            $blood_type = DB::table('maintenance_bips_blood_type')->where('Active', 1)->get();
            $civil_status = DB::table('maintenance_bips_civil_status')->where('Active', 1)->get();
            $name_prefix = DB::table('maintenance_bips_name_prefix')->where('Active', 1)->get();
            $suffix = DB::table('maintenance_bips_name_suffix')->where('Active', 1)->get();
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $country = DB::table('maintenance_country')->where('Active', 1)->get();
            $academic_level = DB::table('maintenance_bips_academic_level')->where('Active', 1)->get();
            $employment_type = DB::table('maintenance_bips_employment_type')->where('Active', 1)->get();

            return view('bips_transactions.inhabitant_application_edit', compact(
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
                'db_entries'
            ));
        }
    }


    // Save Inhabitants Info
    public function create_inhabitants_information(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        // dd($data);

        $name = $data['First_Name'] . ' ' . $data['Middle_Name'] . ' ' . $data['Last_Name'];

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
                'Email_Address' => $data['email'],
                'PhilSys_Card_No' => $data['PhilSys_Card_No'],
                'Solo_Parent' => (int)$data['Solo_Parent'],
                'OFW' => (int)$data['OFW'],
                'Indigent' => (int)$data['Indigent'],
                '4Ps_Beneficiary' => (int)$data['4Ps_Beneficiary'],
                'Encoder_ID'       => 0,
                'Date_Stamp'       => Carbon::now()
            )
        );

        User::create([
            'name' => $name,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'User_Type_ID' => 2,
            'Barangay_ID' => $data['Barangay_ID'],
        ]);

        return redirect()->back()->with('success', 'Application Submitted');
    }
}
