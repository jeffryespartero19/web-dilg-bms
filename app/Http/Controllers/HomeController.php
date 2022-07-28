<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; use Carbon\Carbon; use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $currDATE = Carbon::now();
        $posts = DB::table('brgy_website_news')->orderBy('Date_Stamp','DESC')->paginate(10);
        $EV_AN = DB::table('brgy_website_announcement')->paginate(10);
        $uploads = DB::table('brgy_website_file_attachement')->get();

        $posts_encoder_IDs=DB::table('brgy_website_news')->orderBy('Date_Stamp','DESC')->pluck('Encoder_ID');

        $usersX=DB::table('users')->whereIn('id',$posts_encoder_IDs)->get();

        return view('home',compact('posts','uploads','currDATE','EV_AN','usersX'));
    }
}
