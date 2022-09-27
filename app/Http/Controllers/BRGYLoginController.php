<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use DB;

class BRGYLoginController extends Controller
{
    public function index()
    {
        $Barangay_ID = $b_id;
        $barangay = DB::table('maintenance_barangay')->where('Barangay_ID', $Barangay_ID)->get();


        return view('auth.login', compact('Barangay_ID', 'barangay'));
    }

    public function registers()
    {
        $currDATE = Carbon::now();

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

        return view('auth.register', compact(
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
}
