<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;


class maintenanceController extends Controller
{
//Barangay Web
    //Announcement Status Maintenance
    public function bweb_ann_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_brgy_web_announcement_status')->paginate(20,['*'], 'db_entries');

        return view('maintenance.barangay_web_announcement_status',compact('db_entries','currDATE'));
    }

    public function create_bweb_ann_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_brgy_web_announcement_status')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Announcement_Status'  => $data['Announcement_StatusX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bweb_ann_status_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_brgy_web_announcement_status')->where('Announcement_Status_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_bweb_ann_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_brgy_web_announcement_status')->where('Announcement_Status_ID',$data['Announcement_Status_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Announcement_Status'  => $data['Announcement_StatusX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }
}