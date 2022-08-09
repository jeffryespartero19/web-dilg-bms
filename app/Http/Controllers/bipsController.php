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
    //Inhabitants Incoming List
    public function inhabitants_incoming_list(Request $request)
    {
        $currDATE = Carbon::now();
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

    
}