<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $currDATE = Carbon::now();
        $inhabitants = DB::table('bips_brgy_inhabitants_information')->where('Barangay_ID', Auth::user()->Barangay_ID)->get()->count();


        if (Auth::user()->User_Type_ID == 3) {
            $inhabitants = DB::table('bips_brgy_inhabitants_information')
                ->where('Province_ID', Auth::user()->Province_ID)
                ->get()->count();
            $male = DB::table('bips_brgy_inhabitants_information')
                ->where('Province_ID', Auth::user()->Province_ID)
                ->where('Sex', 1)
                ->get()->count();
            $female = DB::table('bips_brgy_inhabitants_information')
                ->where('Province_ID', Auth::user()->Province_ID)
                ->where('Sex', 2)
                ->get()->count();
            $senior = DB::table('bips_brgy_inhabitants_information')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) > 59')
                ->get()->count();
            $d4ps = DB::table('bips_brgy_inhabitants_information')
                ->where('Province_ID', Auth::user()->Province_ID)
                ->where('4Ps_Beneficiary', 1)
                ->get()->count();
            $solo_parent = DB::table('bips_brgy_inhabitants_information')
                ->where('Province_ID', Auth::user()->Province_ID)
                ->where('Solo_Parent', 1)
                ->get()->count();
            $ofw = DB::table('bips_brgy_inhabitants_information')
                ->where('Province_ID', Auth::user()->Province_ID)
                ->where('OFW', 1)
                ->get()->count();
            $indigent = DB::table('bips_brgy_inhabitants_information')
                ->where('Province_ID', Auth::user()->Province_ID)
                ->where('Indigent', 1)
                ->get()->count();
            $resident_voter = DB::table('bips_brgy_inhabitants_information as a')
                ->leftjoin('bips_resident_profile as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->where('a.Province_ID', Auth::user()->Province_ID)
                ->where('b.Resident_Voter', 1)
                ->get()->count();
            $adult = DB::table('bips_brgy_inhabitants_information')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) > 19')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) < 60')
                ->where('a.Province_ID', Auth::user()->Province_ID)
                ->get()->count();
            $teen = DB::table('bips_brgy_inhabitants_information')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) > 12')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) < 20')
                ->where('a.Province_ID', Auth::user()->Province_ID)
                ->get()->count();
            $children = DB::table('bips_brgy_inhabitants_information')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) > 3')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) < 13')
                ->where('a.Province_ID', Auth::user()->Province_ID)
                ->get()->count();
            $infant = DB::table('bips_brgy_inhabitants_information')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) > 0')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) < 4')
                ->where('a.Province_ID', Auth::user()->Province_ID)
                ->get()->count();
            $blotter = DB::table('bjisbh_blotter')
                ->where('Province_ID', Auth::user()->Province_ID)
                ->get()->count();
        } elseif (Auth::user()->User_Type_ID == 1) {
            $inhabitants = DB::table('bips_brgy_inhabitants_information')
                ->where('Barangay_ID', Auth::user()->Barangay_ID)
                ->where('Application_Status', 1)
                ->get()->count();
            $male = DB::table('bips_brgy_inhabitants_information')
                ->where('Barangay_ID', Auth::user()->Barangay_ID)
                ->where('Sex', 1)
                ->where('Application_Status', 1)
                ->get()->count();
            $female = DB::table('bips_brgy_inhabitants_information')
                ->where('Barangay_ID', Auth::user()->Barangay_ID)
                ->where('Sex', 2)
                ->where('Application_Status', 1)
                ->get()->count();
            $senior = DB::table('bips_brgy_inhabitants_information')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) > 59')
                ->where('Barangay_ID', Auth::user()->Barangay_ID)
                ->where('Application_Status', 1)
                ->get()->count();
            $d4ps = DB::table('bips_brgy_inhabitants_information')
                ->where('Barangay_ID', Auth::user()->Barangay_ID)
                ->where('4Ps_Beneficiary', 1)
                ->where('Application_Status', 1)
                ->get()->count();
            $solo_parent = DB::table('bips_brgy_inhabitants_information')
                ->where('Barangay_ID', Auth::user()->Barangay_ID)
                ->where('Solo_Parent', 1)
                ->where('Application_Status', 1)
                ->get()->count();
            $ofw = DB::table('bips_brgy_inhabitants_information')
                ->where('Barangay_ID', Auth::user()->Barangay_ID)
                ->where('OFW', 1)
                ->where('Application_Status', 1)
                ->get()->count();
            $indigent = DB::table('bips_brgy_inhabitants_information')
                ->where('Barangay_ID', Auth::user()->Barangay_ID)
                ->where('Indigent', 1)
                ->where('Application_Status', 1)
                ->get()->count();
            $resident_voter = DB::table('bips_brgy_inhabitants_information as a')
                ->leftjoin('bips_resident_profile as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->where('b.Resident_Voter', 1)
                ->where('a.Application_Status', 1)
                ->get()->count();
            $adult = DB::table('bips_brgy_inhabitants_information')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) > 19')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) < 60')
                ->where('Barangay_ID', Auth::user()->Barangay_ID)
                ->where('Application_Status', 1)
                ->get()->count();
            $teen = DB::table('bips_brgy_inhabitants_information')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) > 12')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) < 20')
                ->where('Barangay_ID', Auth::user()->Barangay_ID)
                ->where('Application_Status', 1)
                ->get()->count();
            $children = DB::table('bips_brgy_inhabitants_information')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) > 3')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) < 13')
                ->where('Barangay_ID', Auth::user()->Barangay_ID)
                ->where('Application_Status', 1)
                ->get()->count();
            $infant = DB::table('bips_brgy_inhabitants_information')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) > 0')
                ->whereRaw('(DATEDIFF(current_date,Birthdate)/365) < 4')
                ->where('Barangay_ID', Auth::user()->Barangay_ID)
                ->where('Application_Status', 1)
                ->get()->count();
            $blotter = DB::table('bjisbh_blotter')
                ->where('Barangay_ID', Auth::user()->Barangay_ID)
                ->get()->count();
        } else {
            $inhabitants = 0;
            $male = 0;
            $female = 0;
            $senior = 0;
            $d4ps = 0;
            $solo_parent = 0;
            $ofw = 0;
            $indigent = 0;
            $resident_voter = 0;
            $adult = 0;
            $teen = 0;
            $children = 0;
            $infant = 0;
            $blotter = 0;
        }

        return view('dashboard', compact(
            'inhabitants',
            'male',
            'female',
            'senior',
            'd4ps',
            'solo_parent',
            'ofw',
            'indigent',
            'resident_voter',
            'adult',
            'teen',
            'children',
            'infant',
            'blotter'
        ));
    }

    public function barangay_web()
    {

        $currDATE = Carbon::now();
        $posts = DB::table('brgy_website_news')->orderBy('Date_Stamp', 'DESC')->paginate(10);
        $EV_AN = DB::table('brgy_website_announcement')->paginate(10);
        $uploads = DB::table('brgy_website_file_attachement')->get();

        $posts_encoder_IDs = DB::table('brgy_website_news')->orderBy('Date_Stamp', 'DESC')->pluck('Encoder_ID');

        $usersX = DB::table('users')->whereIn('id', $posts_encoder_IDs)->get();

        $NewsType_list = DB::table('maintenance_brgy_web_news_type')->get();
        $NewsStatus_list = DB::table('maintenance_brgy_web_news_status')->get();

        $AnnouncementType_list = DB::table('maintenance_brgy_web_announcement_type')->get();
        $AnnouncementStatus_list = DB::table('maintenance_brgy_web_announcement_status')->get();

        return view('home', compact(
            'posts',
            'uploads',
            'currDATE',
            'EV_AN',
            'usersX',
            'NewsType_list',
            'NewsStatus_list',
            'AnnouncementType_list',
            'AnnouncementStatus_list'
        ));
    }
}
