<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use DB;

class Public_LandingController extends Controller
{

    public function index()
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_barangay as a')
            ->leftjoin('maintenance_city_municipality as b', 'a.City_Municipality_ID', '=', 'b.City_Municipality_ID')
            ->leftjoin('maintenance_province as c', 'b.Province_ID', '=', 'c.Province_ID')
            ->leftjoin('maintenance_region as d', 'c.Region_ID', '=', 'd.Region_ID')
            ->select(
                'a.Barangay_ID',
                'a.Barangay_Name',
                'b.City_Municipality_Name',
                'c.Province_Name',
                'd.Region_Name',
            )
            ->paginate(20);

        return view('main_page', compact('currDATE', 'db_entries'));
    }

    public function main(Request $request)
    {
        $b_id = $request->Barangay_ID;
        $currDATE = Carbon::now();
        $posts = DB::table('brgy_website_news')->where('Barangay_ID', $b_id)->orderBy('Date_Stamp', 'DESC')->paginate(10);
        $EV_AN = DB::table('brgy_website_announcement')->where('Barangay_ID', $b_id)->paginate(10);
        $uploads = DB::table('brgy_website_file_attachement')->get();

        $posts_encoder_IDs = DB::table('brgy_website_news')->orderBy('Date_Stamp', 'DESC')->pluck('Encoder_ID');

        $usersX = DB::table('users')->whereIn('id', $posts_encoder_IDs)->get();
        $b_details = DB::table('maintenance_barangay')->where('Barangay_ID', $b_id)->get();
        $ordinance = DB::table('boris_brgy_ordinances_and_resolutions_information')
            ->where('Ordinance_or_Resolution', 0)
            ->where('Barangay_ID', $b_id)
            ->get();
        $resolution = DB::table('boris_brgy_ordinances_and_resolutions_information')
            ->where('Ordinance_or_Resolution', 1)
            ->where('Barangay_ID', $b_id)
            ->get();
        $disrelact = DB::table('bdris_disaster_related_activities')
            ->where('Barangay_ID', $b_id)
            ->get();
        $projmon = DB::table('bpms_brgy_projects_monitoring as a')
            ->leftjoin('bpms_contractor as b', 'a.Contractor_ID', '=', 'b.Contractor_ID')
            ->leftjoin('maintenance_bpms_project_type as c', 'a.Project_Type_ID', '=', 'c.Project_Type_ID')
            ->leftjoin('maintenance_bpms_project_status as d', 'a.Project_Status_ID', '=', 'd.Project_Status_ID')
            ->select(
                'a.Brgy_Projects_ID',
                'a.Project_Number',
                'a.Project_Name',
                'a.Total_Project_Cost',
                'a.Exact_Location',
                'a.Actual_Project_Start',
                'b.Contractor_Name',
                'c.Project_Type_Name',
                'd.Project_Status_Name',
            )
            ->where('a.Barangay_ID', $b_id)
            ->get();


        return view('welcome', compact('posts', 'uploads', 'currDATE', 'EV_AN', 'usersX', 'b_id', 'b_details', 'ordinance', 'resolution', 'disrelact', 'projmon'));
    }

    public function viewAnnouncement(Request $request)
    {
        $data = request()->all();
        $currDATE = Carbon::now();

        $announcement = DB::table('brgy_website_announcement')->where('Announcement_ID', $data['thisAnnouncement'])->get();
        $uploads = DB::table('brgy_website_file_attachement')->where('Announcement_ID', $data['thisAnnouncement'])->get();

        $thisAnnType = DB::table('maintenance_brgy_web_announcement_type')->where('Announcement_Type_ID', $announcement[0]->Announcement_Type)->get();
        $thisAnnStatus = DB::table('maintenance_brgy_web_announcement_status')->where('Announcement_Status_ID', $announcement[0]->Announcement_Status_ID)->get();

        $created_by = DB::table('users')->where('id', $announcement[0]->Encoder_ID)->get();

        $AnnouncementType_list = DB::table('maintenance_brgy_web_announcement_type')->get();
        $AnnouncementStatus_list = DB::table('maintenance_brgy_web_announcement_status')->get();


        //dd($announcement,$thisAnnType,$thisAnnStatus);

        return view('announcementX', compact(
            'announcement',
            'uploads',
            'currDATE',
            'created_by',
            'AnnouncementType_list',
            'AnnouncementStatus_list',
            'thisAnnType',
            'thisAnnStatus'
        ));
    }

    public function search_barangay_main(Request $request)
    {
        //ORIGINAL
        // $data = DB::table('maintenance_barangay as a')
        // ->leftjoin('maintenance_city_municipality as b', 'a.City_Municipality_ID', '=', 'b.City_Municipality_ID')
        // ->leftjoin('maintenance_province as c', 'b.Province_ID', '=', 'c.Province_ID')
        // ->leftjoin('maintenance_region as d', 'c.Region_ID', '=', 'd.Region_ID')
        // ->select(
        //     'a.Barangay_ID',
        //     'a.Barangay_Name',
        //     'b.City_Municipality_Name',
        //     'c.Province_Name',
        //     'd.Region_Name',
        // );
        //ORIGINAL

        // dd($param1);
        // $data = DB::table('maintenance_barangay as a')
        // ->innerjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        // ->innerjoin('maintenance_province as c', 'c.Province_ID', '=', 'a.Province_ID')
        // ->innerjoin('maintenance_city_municipality as d', 'd.City_Municipality_ID', '=', 'a.City_Municipality_ID')
        //     ->select(
        //         'a.Barangay_ID',
        //         'a.Barangay_Name',
        //         'd.City_Municipality_Name',
        //         'c.Province_Name',
        //         'b.Region_Name',
        //     );
         $data = DB::table('maintenance_barangay as a')
        ->leftjoin('maintenance_city_municipality as b', 'a.City_Municipality_ID', '=', 'b.City_Municipality_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_region as d', 'a.Region_ID', '=', 'd.Region_ID')
        ->select(
            'a.Barangay_ID',
            'a.Barangay_Name',
            'b.City_Municipality_Name',
            'c.Province_Name',
            'd.Region_Name',
            'd.Region_ID',
        );

        // $param1 = $request->get('param1');
        if ($request->get('param1') != null && $request->get('param1') != "") {
            $data->where(
                function ($query) use ($request) {
                    return $query
                        ->where('a.Barangay_Name', 'LIKE', '%' . $request->get('param1') . '%')
                        ->orWhere('b.City_Municipality_Name', 'LIKE', '%' . $request->get('param1') . '%')
                        ->orWhere('c.Province_Name', 'LIKE', '%' . $request->get('param1') . '%')
                        ->orWhere('d.Region_Name', 'LIKE', '%' . $request->get('param1') . '%');
                }
            );  
        }

        //ORIGINAL
        // $db_entries = $data->orderby('a.Barangay_Name', 'asc')->paginate(20);
        //ORIGINAL
        $db_entries = $data->orderby('d.Region_ID', 'asc')->orderby('c.Province_Name', 'asc')->orderby('b.City_Municipality_Name', 'asc')->orderby('a.Barangay_Name', 'asc')->paginate(20);

        return view('main_page_data', compact('db_entries'))->render();
    }
}
