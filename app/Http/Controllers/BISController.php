<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\File;
use PDF;

class BISController extends Controller
{
    //BIPS TRANSACTIONS

    //Inhabitants Information List
    public function cms_list(Request $request)
    {
        $currDATE = Carbon::now();
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

        return view('bis_transactions.cms_list', compact(
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


    //CMS Details
    public function cms_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $Barangay_Profile = collect([
                (object) [
                    'CMS_Barangay_Profile_ID' => '0',
                    'Title' => '',
                    'Description' => '',
                    'Date_Updated' => '',
                    'Frequency_ID' => '',
                    'Status' => '',
                    'Categories_ID' => '',
                    'Barangay_ID' => '',
                    'City_Municipality_ID' => '',
                    'Province_ID' => '',
                    'Region_ID' => '',
                ],
            ]);
            $categories = DB::table('maintenance_bis_categories')->where('Active', 1)->get();
            $frequency = DB::table('maintenance_bis_frequency')->where('Active', 1)->get();
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->get();
            $city_municipality = DB::table('maintenance_city_municipality')->get();
            $barangay = DB::table('maintenance_barangay')->get();
            $bp_categories = collect([
                (object) [
                    'Categories_ID' => '0'
                ],
            ]);
            return view('bis_transactions.cms_details', compact(
                'currDATE',
                'frequency',
                'categories',
                'region',
                'province',
                'city_municipality',
                'barangay',
                'Barangay_Profile',
                'bp_categories'
            ));
        } else {
            $Barangay_Profile = DB::table('bis_cms_barangay_profile')->where('CMS_Barangay_Profile_ID', $id)->get();
            $categories = DB::table('maintenance_bis_categories')->where('Active', 1)->get();
            $frequency = DB::table('maintenance_bis_frequency')->where('Active', 1)->get();
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->get();
            $city_municipality = DB::table('maintenance_city_municipality')->get();
            $barangay = DB::table('maintenance_barangay')->get();
            $bp_categories = DB::table('bis_cms_barangay_profile_categories as a')
                ->leftjoin('maintenance_bis_categories as b', 'a.Categories_ID', '=', 'b.Categories_ID')
                ->select('a.Categories_ID', 'b.Categories')
                ->where('a.CMS_Barangay_Profile_ID', $id)
                ->get();
            return view('bis_transactions.cms_details', compact(
                'currDATE',
                'frequency',
                'categories',
                'region',
                'province',
                'city_municipality',
                'barangay',
                'Barangay_Profile',
                'bp_categories'
            ));
        }
    }

    // Save CMS Info
    public function create_cms(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        if ($data['CMS_Barangay_Profile_ID'] == 0 || $data['CMS_Barangay_Profile_ID'] == null) {
            $CMS_Barangay_Profile_ID = DB::table('bis_cms_barangay_profile')->insertGetId(
                array(
                    'Title' => $data['Title'],
                    'Description' => $data['Description'],
                    'Date_Updated' => $data['Date_Updated'],
                    'Frequency_ID' => $data['Frequency_ID'],
                    'Status' => $data['Status'],
                    'Barangay_ID' => $data['Barangay_ID'],
                    'City_Municipality_ID' => $data['City_Municipality_ID'],
                    'Province_ID' => $data['Province_ID'],
                    'Region_ID' => $data['Region_ID'],
                    'Encoder_ID' => Auth::user()->id,
                    'Date_Stamp' => Carbon::now()
                )
            );

            if (isset($data['Categories_ID'])) {
                $categories = [];

                for ($i = 0; $i < count($data['Categories_ID']); $i++) {
                    if ($data['Categories_ID'][$i] != NULL) {

                        $id = 0 + DB::table('bis_cms_barangay_profile_categories')->max('Barangay_Profile_Categories_ID');
                        $id += 1;

                        $categories = [
                            'CMS_Barangay_Profile_ID' => $CMS_Barangay_Profile_ID,
                            'Categories_ID' => $data['Categories_ID'][$i],
                            'Encoder_ID'       => Auth::user()->id,
                            'Date_Stamp'       => Carbon::now()
                        ];

                        DB::table('bis_cms_barangay_profile_categories')->updateOrInsert(['Barangay_Profile_Categories_ID' => $id], $categories);
                    }
                }
            }

            return redirect()->to('cms_details/' . $CMS_Barangay_Profile_ID)->with('message', 'New Barangay Profile Created');
        } else {
            DB::table('bis_cms_barangay_profile')->where('CMS_Barangay_Profile_ID', $data['CMS_Barangay_Profile_ID'])->update(
                array(
                    'Title' => $data['Title'],
                    'Description' => $data['Description'],
                    'Date_Updated' => $data['Date_Updated'],
                    'Frequency_ID' => $data['Frequency_ID'],
                    'Status' => $data['Status'],
                    'Categories_ID' => $data['Categories_ID'],
                    'Barangay_ID' => $data['Barangay_ID'],
                    'City_Municipality_ID' => $data['City_Municipality_ID'],
                    'Province_ID' => $data['Province_ID'],
                    'Region_ID' => $data['Region_ID'],
                    'Encoder_ID' => Auth::user()->id,
                    'Date_Stamp' => Carbon::now()
                )
            );

            return redirect()->to('cms_details/' . $data['CMS_Barangay_Profile_ID'])->with('message', 'Barangay Profile Updated');
        }
    }

    //CMS Details
    public function cms_indicator($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $Barangay_Profile = collect([
                (object) [
                    'CMS_Barangay_Profile_ID' => '0',
                    'Title' => '',
                    'Description' => '',
                    'Date_Updated' => '',
                    'Frequency_ID' => '',
                    'Status' => '',
                    'Categories_ID' => '',
                    'Barangay_ID' => '',
                    'City_Municipality_ID' => '',
                    'Province_ID' => '',
                    'Region_ID' => '',
                ],
            ]);
            $categories = DB::table('maintenance_bis_categories')->where('Active', 1)->get();
            $frequency = DB::table('maintenance_bis_frequency')->where('Active', 1)->get();
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->get();
            $city_municipality = DB::table('maintenance_city_municipality')->get();
            $barangay = DB::table('maintenance_barangay')->get();
            $bp_categories = collect([
                (object) [
                    'Categories_ID' => '0'
                ],
            ]);
            return view('bis_transactions.cms_indicator', compact(
                'currDATE',
                'frequency',
                'categories',
                'region',
                'province',
                'city_municipality',
                'barangay',
                'Barangay_Profile',
                'bp_categories'
            ));
        } else {
            $Barangay_Profile = DB::table('bis_cms_barangay_profile')->where('CMS_Barangay_Profile_ID', $id)->get();
            $categories = DB::table('maintenance_bis_categories')->where('Active', 1)->get();
            $frequency = DB::table('maintenance_bis_frequency')->where('Active', 1)->get();
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->get();
            $city_municipality = DB::table('maintenance_city_municipality')->get();
            $barangay = DB::table('maintenance_barangay')->get();
            $bp_categories = DB::table('bis_cms_barangay_profile_categories as a')
                ->leftjoin('maintenance_bis_categories as b', 'a.Categories_ID', '=', 'b.Categories_ID')
                ->select('a.Categories_ID', 'b.Categories')
                ->where('CMS_Barangay_Profile_ID', $id)->get();
            return view('bis_transactions.cms_indicator', compact(
                'currDATE',
                'frequency',
                'categories',
                'region',
                'province',
                'city_municipality',
                'barangay',
                'Barangay_Profile',
                'bp_categories'
            ));
        }
    }
}
