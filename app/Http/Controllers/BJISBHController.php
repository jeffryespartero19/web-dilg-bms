<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;

class BJISBHController extends Controller
{
    //Inhabitants Information List
    public function blotter_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bjisbh_blotter as a')
            ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
            ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
            ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
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
                'a.City_Municipality_ID',
                'a.Province_ID',
                'a.Region_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'e.Barangay_Name',
                'd.City_Municipality_Name',
                'c.Province_Name',
                'b.Region_Name',
                'f.Blotter_Status_Name'
            )
            ->paginate(20, ['*'], 'db_entries');

        $case = DB::table('maintenance_bjisbh_case')->where('Active', 1)->get();
        $blotter_status = DB::table('maintenance_bjisbh_blotter_status')->where('Active', 1)->get();
        $proceedings_status = DB::table('maintenance_bjisbh_proceedings_status')->where('Active', 1)->get();
        $service_rating = DB::table('maintenance_bjisbh_service_rating')->where('Active', 1)->get();
        $summons_status = DB::table('maintenance_bjisbh_summons_status')->where('Active', 1)->get();
        $penalties = DB::table('maintenance_bjisbh_types_of_penalties')->where('Active', 1)->get();
        $action = DB::table('maintenance_bjisbh_type_of_action')->where('Active', 1)->get();
        $involved_party = DB::table('maintenance_bjisbh_type_of_involved_party')->where('Active', 1)->get();
        $violation_status = DB::table('maintenance_bjisbh_violation_status')->where('Active', 1)->get();
        $resident = DB::table('bips_brgy_inhabitants_information')->where('Barangay_ID', Auth::user()->Barangay_ID)->get();
        $region = DB::table('maintenance_region')->where('Active', 1)->get();

        return view('bjisbh_transactions.blotter_list', compact(
            'db_entries',
            'currDATE',
            'case',
            'blotter_status',
            'proceedings_status',
            'service_rating',
            'summons_status',
            'penalties',
            'action',
            'involved_party',
            'violation_status',
            'resident',
            'region'
        ));
    }

    // Save Inhabitants Info
    public function create_blotter(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Blotter_ID'] == 0) {
            $Blotter_ID = DB::table('bjisbh_blotter')->insertGetId(
                array(
                    'Blotter_Number'            => $data['Blotter_Number'],
                    'Blotter_Status_ID'              => $data['Blotter_Status_ID'],
                    'Incident_Date_Time'               => $data['Incident_Date_Time'],
                    'Complaint_Details'      => $data['Complaint_Details'],
                    'Barangay_ID'        => $data['Barangay_ID'],
                    'City_Municipality_ID'        => $data['City_Municipality_ID'],
                    'Province_ID'              => $data['Province_ID'],
                    'Region_ID'            => $data['Region_ID'],
                    'Encoder_ID'                => Auth::user()->id,
                    'Date_Stamp'                => Carbon::now()
                )
            );

            DB::table('bjisbh_case_details')->where('Blotter_ID', $Blotter_ID)->delete();

            if (isset($data['Case_ID'])) {
                $case_details = [];

                for ($i = 0; $i < count($data['Case_ID']); $i++) {
                    if ($data['Case_ID'][$i] != NULL) {

                        $id = 0 + DB::table('bjisbh_case_details')->max('Case_Details_ID');
                        $id += 1;

                        if ($data['Case_ID'][$i] != null) {
                            $case_details = [
                                'Blotter_ID'           => $Blotter_ID,
                                'Case_ID'   => $data['Case_ID'][$i],
                                'Encoder_ID'                 => Auth::user()->id,
                                'Date_Stamp'                 => Carbon::now()
                            ];
                        }

                        DB::table('bjisbh_case_details')->updateOrInsert(['Case_Details_ID' => $id], $case_details);
                    }
                }
            }


            return redirect()->back()->with('message', 'New Entry Created');
        } else {
            DB::table('bjisbh_blotter')->where('Blotter_ID', $data['Blotter_ID'])->update(
                array(
                    'Blotter_Number'            => $data['Blotter_Number'],
                    'Blotter_Status_ID'              => $data['Blotter_Status_ID'],
                    'Incident_Date_Time'               => $data['Incident_Date_Time'],
                    'Complaint_Details'      => $data['Complaint_Details'],
                    'Barangay_ID'        => $data['Barangay_ID'],
                    'City_Municipality_ID'        => $data['City_Municipality_ID'],
                    'Province_ID'              => $data['Province_ID'],
                    'Region_ID'            => $data['Region_ID'],
                    'Encoder_ID'                => Auth::user()->id,
                    'Date_Stamp'                => Carbon::now()
                )
            );

            DB::table('bjisbh_case_details')->where('Blotter_ID', $data['Blotter_ID'])->delete();

            if (isset($data['Case_ID'])) {
                $case_details = [];

                for ($i = 0; $i < count($data['Case_ID']); $i++) {
                    if ($data['Case_ID'][$i] != NULL) {

                        if ($data['Case_ID'][$i] != null) {
                            $case_details = [
                                'Blotter_ID'           => $data['Blotter_ID'],
                                'Case_ID'   => $data['Case_ID'][$i],
                                'Encoder_ID'                 => Auth::user()->id,
                                'Date_Stamp'                 => Carbon::now()
                            ];
                        }
                        DB::table('bjisbh_case_details')->Insert($case_details);
                    }
                }
            }

            return redirect()->back()->with('message', 'Brgy Projects Monitoring Info Updated');
        }
        return redirect()->back()->with('alert', 'New Entry Created');
    }

    // Display Inhabitants Details
    public function get_blotter(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bjisbh_blotter as a')
            ->leftjoin('maintenance_province as b', 'a.Province_ID', '=', 'b.Province_ID')
            ->leftjoin('maintenance_city_municipality as c', 'a.City_Municipality_ID', '=', 'c.City_Municipality_ID')
            ->leftjoin('maintenance_barangay as d', 'a.Barangay_ID', '=', 'd.Barangay_ID')
            ->select(
                'a.Blotter_ID',
                'a.Blotter_Number',
                'a.Blotter_Status_ID',
                'a.Incident_Date_Time',
                'a.Address',
                'a.Complaint_Details',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Province_ID',
                'a.Region_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'd.Barangay_Name',
                'c.City_Municipality_Name',
                'b.Province_Name',
            )
            ->where('a.Blotter_ID', $id)->get();
        return (compact('theEntry'));
    }

    // Display Inhabitants Details
    public function get_case_details(Request $request)
    {
        $id = $_GET['id'];

        $data = DB::table('bjisbh_case_details')->where('Blotter_ID', $id)->get();
        return json_encode($data);
    }
}
