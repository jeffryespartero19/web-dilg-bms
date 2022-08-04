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
        $db_entries = DB::table('bips_brgy_inhabitants_information')->paginate(20, ['*'], 'db_entries');
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

        return redirect()->back()->with('alert','New Entry Created');
    }

    // Display Inhabitants Details
    public function get_inhabitants_info(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('bips_brgy_inhabitants_information')->where('Resident_ID',$id)->get();

        return(compact('theEntry'));
    }
}
