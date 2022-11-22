<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use App\User;

class JusticeRatingController extends Controller
{
    //Blotter List
    public function justice_rating_inhabitants(Request $request)
    {
        $currDATE = Carbon::now();
        if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 1) {
            $db_entries = DB::table('bjisbh_blotter as a')
                ->leftjoin('bjisbh_blotter_involved_parties as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
                ->leftjoin('maintenance_bjisbh_blotter_status as f', 'a.Blotter_Status_ID', '=', 'f.Blotter_Status_ID')
                ->select(
                    'a.Blotter_ID',
                    'a.Blotter_Number',
                    'a.Blotter_Status_ID',
                    'a.Incident_Date_Time',
                    'a.Address',
                    'a.Complaint_Details',
                    'a.Barangay_ID',
                    'a.Date_Stamp',
                    'e.Barangay_Name',
                    'f.Blotter_Status_Name'
                )
                ->where('a.Province_ID', Auth::user()->Province_ID)
                ->paginate(20, ['*'], 'db_entries');
        } elseif (Auth::user()->User_Type_ID == 2) {
            $db_entries = DB::table('bjisbh_blotter as a')
                ->leftjoin('bjisbh_blotter_involved_parties as b', 'a.Blotter_ID', '=', 'b.Blotter_ID')
                ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
                ->leftjoin('maintenance_bjisbh_blotter_status as f', 'a.Blotter_Status_ID', '=', 'f.Blotter_Status_ID')
                ->select(
                    'a.Blotter_ID',
                    'a.Blotter_Number',
                    'a.Blotter_Status_ID',
                    'a.Incident_Date_Time',
                    'a.Address',
                    'a.Complaint_Details',
                    'a.Barangay_ID',
                    'a.Date_Stamp',
                    'e.Barangay_Name',
                    'f.Blotter_Status_Name'
                )
                ->where('b.Resident_ID', Auth::user()->Resident_ID)
                ->whereNotIn('a.Blotter_ID', function ($q) {
                    $q->select('Blotter_ID')->from('justice_rating');
                })
                ->paginate(20, ['*'], 'db_entries');
        }

        return view('justice_rating.justice_rating_inhabitants', compact(
            'db_entries',
            'currDATE',
        ));
    }

    public function rating_page($id)
    {
        $currDATE = Carbon::now();
        $blotter = DB::table('bjisbh_blotter')->where('Blotter_ID', $id)->get();

        return view('justice_rating.rating_page', compact('currDATE', 'blotter'));
    }

    public function create_rating(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        // dd($data);

        DB::table('justice_rating')
            ->where('Blotter_ID', $data['Blotter_ID'])
            ->where('Resident_ID', Auth::user()->Resident_ID)
            ->delete();

        DB::table('justice_rating')->insert(
            array(
                'Blotter_ID' => $data['Blotter_ID'],
                'speed' => $data['speed'],
                'outcome' => $data['outcome'],
                'quality' => $data['quality'],
                'Resident_ID'       => Auth::user()->id,
                'created_at'       => Carbon::now(),
            )
        );

        return redirect()->back()->with('message', 'Rating Saved');
    }

    public function justice_rating_staff(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('justice_rating as a')
            ->leftjoin('bjisbh_blotter as b', 'a.Blotter_ID', '=', 'b.Blotter_ID')
            ->select(
                'a.Blotter_ID',
                'a.speed',
                'a.outcome',
                'a.quality',
            )
            ->where('b.Barangay_ID', Auth::user()->Barangay_ID)
            ->get();

        return view('justice_rating.justice_rating_staff', compact(
            'db_entries',
            'currDATE',
        ));
    }
}
