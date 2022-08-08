<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; use Carbon\Carbon; use DB;

class Public_LandingController extends Controller
{
    public function index()
    {
        $currDATE = Carbon::now();
        $posts = DB::table('brgy_website_news')->orderBy('Date_Stamp','DESC')->paginate(10);
        $EV_AN = DB::table('brgy_website_announcement')->paginate(10);
        $uploads = DB::table('brgy_website_file_attachement')->get();

        $posts_encoder_IDs=DB::table('brgy_website_news')->orderBy('Date_Stamp','DESC')->pluck('Encoder_ID');

        $usersX=DB::table('users')->whereIn('id',$posts_encoder_IDs)->get();

        return view('welcome',compact('posts','uploads','currDATE','EV_AN','usersX'));
    }
    public function viewAnnouncement(Request $request)
    {
        $data = request()->all();
        $currDATE = Carbon::now();

        $announcement = DB::table('brgy_website_announcement')->where('Announcement_ID',$data['thisAnnouncement'])->get();
        $uploads = DB::table('brgy_website_file_attachement')->where('Announcement_ID',$data['thisAnnouncement'])->get();

        $thisAnnType=DB::table('maintenance_brgy_web_announcement_type')->where('Announcement_Type_ID',$announcement[0]->Announcement_Type)->get();
        $thisAnnStatus=DB::table('maintenance_brgy_web_announcement_status')->where('Announcement_Status_ID',$announcement[0]->Announcement_Status_ID)->get();

        $created_by=DB::table('users')->where('id',$announcement[0]->Encoder_ID)->get();

        $AnnouncementType_list=DB::table('maintenance_brgy_web_announcement_type')->get();
        $AnnouncementStatus_list=DB::table('maintenance_brgy_web_announcement_status')->get();


        //dd($announcement,$thisAnnType,$thisAnnStatus);
        
        return view('announcementX',compact('announcement','uploads','currDATE','created_by','AnnouncementType_list',
                    'AnnouncementStatus_list','thisAnnType','thisAnnStatus'));
    }
}