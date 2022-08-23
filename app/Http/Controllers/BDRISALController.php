<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;


class BDRISALController extends Controller
{
    //Emergency Evacuation Site List
    public function emergency_evacuation_site_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bdris_emergency_evacuation_site as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
            ->select(
                'a.Emergency_Evacuation_Site_ID',
                'a.Emergency_Evacuation_Site_Name',
                'a.Address',
                'a.Capacity',
                'a.Region_ID',
                'b.Region_Name',
                'a.Province_ID',
                'c.Province_Name',
                'a.Barangay_ID',
                'e.Barangay_Name',
                'a.City_Municipality_ID',
                'd.City_Municipality_Name',      

            )
            ->paginate(20, ['*'], 'db_entries');

            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            $province = DB::table('maintenance_province')->paginate(20, ['*'], 'province');
            $barangay = DB::table('maintenance_barangay')->paginate(20, ['*'], 'barangay');
            $city = DB::table('maintenance_city_municipality')->paginate(20, ['*'], 'city');


        return view('bdris_transactions.emergency_evacuation_site_list', compact(
            'db_entries',
            'currDATE',
            'region',
            'province',
            'barangay',
            'city',

        ));
    }

     // Save Emergency Evacuation Site
    public function create_emergency_evacuation_site(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Emergency_Evacuation_Site_ID'] == null || $data['Emergency_Evacuation_Site_ID'] == 0) {
            $Emergency_Evacuation_Site_ID = DB::table('bdris_emergency_evacuation_site')->insertGetId(
                array(
                    'Emergency_Evacuation_Site_Name'    => $data['Emergency_Evacuation_Site_Name'],
                    'Address'                           => $data['Address'],
                    'Capacity'                          => $data['Capacity'],
                    'Barangay_ID'                       => $data['Barangay_ID'],
                    'City_Municipality_ID'              => $data['City_Municipality_ID'],
                    'Province_ID'                       => $data['Province_ID'],
                    'Region_ID'                         => $data['Region_ID'],
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                    'Active'                            => (int)$data['Active']
                )
            );
 
            return redirect()->back()->with('message', 'New Entry Created');
        } else {
            DB::table('bdris_emergency_evacuation_site')->where('Emergency_Evacuation_Site_ID', $data['Emergency_Evacuation_Site_ID'])->update(
                array(
                    'Emergency_Evacuation_Site_Name'    => $data['Emergency_Evacuation_Site_Name'],
                    'Address'                           => $data['Address'],
                    'Capacity'                          => $data['Capacity'],
                    'Barangay_ID'                       => $data['Barangay_ID'],
                    'City_Municipality_ID'              => $data['City_Municipality_ID'],
                    'Province_ID'                       => $data['Province_ID'],
                    'Region_ID'                         => $data['Region_ID'],
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                    'Active'                            => (int)$data['Active']
                )
            );
         
            return redirect()->back()->with('message', 'Emergency Evacuation Site Info Updated');
        }
    }


    // Display Emergency Evacuation Site
    public function get_emergency_evacuation_site(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bdris_emergency_evacuation_site as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->select(
                'a.Emergency_Evacuation_Site_ID',
                'a.Emergency_Evacuation_Site_Name',
                'a.Address',
                'a.Capacity',
                'a.Region_ID',
                'b.Region_Name',
                'a.Province_ID',
                'c.Province_Name',
                'a.Barangay_ID',
                'e.Barangay_Name',
                'a.City_Municipality_ID',
                'd.City_Municipality_Name',  
                'a.Active',     
        )
            ->where('Emergency_Evacuation_Site_ID', $id)->get();

        return (compact('theEntry'));
    }

    //Allocated Fund Source List
    public function allocated_fund_source_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bdris_allocated_fund_source as a')
            ->paginate(20, ['*'], 'db_entries');

            

        return view('bdris_transactions.allocated_fund_source_list', compact(
            'db_entries',
            'currDATE',

        ));
    }

     // Save Allocated Fund Source
     public function create_allocated_fund_source(Request $request)
     {
         $currDATE = Carbon::now();
         $data = $data = request()->all();
 
         if ($data['Allocated_Fund_ID'] == null || $data['Allocated_Fund_ID'] == 0) {
             $Allocated_Fund_ID = DB::table('bdris_allocated_fund_source')->insertGetId(
                 array(
                     'Allocated_Fund_Name'  => $data['Allocated_Fund_Name'],
                     'Amount'               => $data['Amount'],
                     'Encoder_ID'           => Auth::user()->id,
                     'Date_Stamp'           => Carbon::now(),
                     'Active'               => (int)$data['Active']
                 )
             );
  
             return redirect()->back()->with('message', 'New Entry Created');
         } else {
             DB::table('bdris_allocated_fund_source')->where('Allocated_Fund_ID', $data['Allocated_Fund_ID'])->update(
                 array(
                     'Allocated_Fund_Name'  => $data['Allocated_Fund_Name'],
                     'Amount'               => $data['Amount'],
                     'Encoder_ID'           => Auth::user()->id,
                     'Date_Stamp'           => Carbon::now(),
                     'Active'               => (int)$data['Active']
                 )
             );
          
             return redirect()->back()->with('message', 'Allocated Fund Source info Updated');
         }
     }

     // Display Allocated Fund Source
    public function get_allocated_fund_source(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bdris_allocated_fund_source as a')
            ->where('Allocated_Fund_ID', $id)->get();

        return (compact('theEntry'));
    }

    //Emergency Evacuation equipment
    public function emergency_equipment_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bdris_emergency_equipment as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
            ->select(
                'a.Emergency_Equipment_ID',
                'a.Emergency_Equipment_Name',
                'a.Location',
                'a.Region_ID',
                'b.Region_Name',
                'a.Province_ID',
                'c.Province_Name',
                'a.Barangay_ID',
                'e.Barangay_Name',
                'a.City_Municipality_ID',
                'd.City_Municipality_Name',      

            )
            ->paginate(20, ['*'], 'db_entries');

            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            $province = DB::table('maintenance_province')->paginate(20, ['*'], 'province');
            $barangay = DB::table('maintenance_barangay')->paginate(20, ['*'], 'barangay');
            $city = DB::table('maintenance_city_municipality')->paginate(20, ['*'], 'city');


        return view('bdris_transactions.emergency_equipment_list', compact(
            'db_entries',
            'currDATE',
            'region',
            'province',
            'barangay',
            'city',

        ));
    }

     // Save Emergency Equipment
     public function create_emergency_equipment(Request $request)
     {
         $currDATE = Carbon::now();
         $data = $data = request()->all();
 
         if ($data['Emergency_Equipment_ID'] == null || $data['Emergency_Equipment_ID'] == 0) {
             $Emergency_Equipment_ID = DB::table('bdris_emergency_equipment')->insertGetId(
                 array(
                     'Emergency_Equipment_Name' => $data['Emergency_Equipment_Name'],
                     'Location'                 => $data['Location'],
                     'Barangay_ID'              => $data['Barangay_ID'],
                     'City_Municipality_ID'     => $data['City_Municipality_ID'],
                     'Province_ID'              => $data['Province_ID'],
                     'Region_ID'                => $data['Region_ID'],
                     'Encoder_ID'               => Auth::user()->id,
                     'Date_Stamp'               => Carbon::now(),
                     'Active'                   => (int)$data['Active']
                 )
             );
  
             return redirect()->back()->with('message', 'New Entry Created');
         } else {
             DB::table('bdris_emergency_equipment')->where('Emergency_Equipment_ID', $data['Emergency_Equipment_ID'])->update(
                 array(
                    'Emergency_Equipment_Name' => $data['Emergency_Equipment_Name'],
                    'Location'                 => $data['Location'],
                    'Barangay_ID'              => $data['Barangay_ID'],
                    'City_Municipality_ID'     => $data['City_Municipality_ID'],
                    'Province_ID'              => $data['Province_ID'],
                    'Region_ID'                => $data['Region_ID'],
                    'Encoder_ID'               => Auth::user()->id,
                    'Date_Stamp'               => Carbon::now(),
                    'Active'                   => (int)$data['Active']
                 )
             );
          
             return redirect()->back()->with('message', 'Emergency Equipment Info Updated');
         }
     }

     // Display Emergency Equipment
    public function get_emergency_equipment(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bdris_emergency_equipment as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->select(
            'a.Emergency_Equipment_ID',
            'a.Emergency_Equipment_Name',
            'a.Location',
            'a.Region_ID',
            'b.Region_Name',
            'a.Province_ID',
            'c.Province_Name',
            'a.Barangay_ID',
            'e.Barangay_Name',
            'a.City_Municipality_ID',
            'd.City_Municipality_Name',      
            'a.Active',     
        )
            ->where('Emergency_Equipment_ID', $id)->get();

        return (compact('theEntry'));
    }

    //Emergency Team
    public function emergency_team_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bdris_emergency_team as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
            ->select(
                'a.Emergency_Team_ID',
                'a.Emergency_Team_Name',
                'a.Emergency_Team_Hotline',
                'a.Region_ID',
                'b.Region_Name',
                'a.Province_ID',
                'c.Province_Name',
                'a.Barangay_ID',
                'e.Barangay_Name',
                'a.City_Municipality_ID',
                'd.City_Municipality_Name',      

            )
            ->paginate(20, ['*'], 'db_entries');

            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            $province = DB::table('maintenance_province')->paginate(20, ['*'], 'province');
            $barangay = DB::table('maintenance_barangay')->paginate(20, ['*'], 'barangay');
            $city = DB::table('maintenance_city_municipality')->paginate(20, ['*'], 'city');


        return view('bdris_transactions.emergency_team_list', compact(
            'db_entries',
            'currDATE',
            'region',
            'province',
            'barangay',
            'city',

        ));
    }

    // Save Emergency Evacuation Site
    public function create_emergency_team(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Emergency_Team_ID'] == null || $data['Emergency_Team_ID'] == 0) {
            $Emergency_Team_ID = DB::table('bdris_emergency_team')->insertGetId(
                array(
                    'Emergency_Team_Name'               => $data['Emergency_Team_Name'],
                    'Emergency_Team_Hotline'            => $data['Emergency_Team_Hotline'],
                    'Barangay_ID'                       => $data['Barangay_ID'],
                    'City_Municipality_ID'              => $data['City_Municipality_ID'],
                    'Province_ID'                       => $data['Province_ID'],
                    'Region_ID'                         => $data['Region_ID'],
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                    'Active'                            => (int)$data['Active']
                )
            );
 
            return redirect()->back()->with('message', 'New Entry Created');
        } else {
            DB::table('bdris_emergency_team')->where('Emergency_Team_ID', $data['Emergency_Team_ID'])->update(
                array(
                    'Emergency_Team_Name'               => $data['Emergency_Team_Name'],
                    'Emergency_Team_Hotline'            => $data['Emergency_Team_Hotline'],
                    'Barangay_ID'                       => $data['Barangay_ID'],
                    'City_Municipality_ID'              => $data['City_Municipality_ID'],
                    'Province_ID'                       => $data['Province_ID'],
                    'Region_ID'                         => $data['Region_ID'],
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                    'Active'                            => (int)$data['Active']
                )
            );
         
            return redirect()->back()->with('message', 'Emergency Team Info Updated');
        }
    }


    // Display Emergency Team
    public function get_emergency_team(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bdris_emergency_team as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->select(
                'a.Emergency_Team_ID',
                'a.Emergency_Team_Name',
                'a.Emergency_Team_Hotline',
                'a.Region_ID',
                'b.Region_Name',
                'a.Province_ID',
                'c.Province_Name',
                'a.Barangay_ID',
                'e.Barangay_Name',
                'a.City_Municipality_ID',
                'd.City_Municipality_Name',  
                'a.Active',     
        )
            ->where('Emergency_Team_ID', $id)->get();

        return (compact('theEntry'));
    }

    //Disaster Type
    public function disaster_type_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bdris_disaster_type as a')
        ->leftjoin('bdris_emergency_evacuation_site as b', 'a.Emergency_Evacuation_Site_ID', '=', 'b.Emergency_Evacuation_Site_ID')
        ->leftjoin('bdris_allocated_fund_source as c', 'a.Allocated_Fund_ID', '=', 'c.Allocated_Fund_ID')
        ->leftjoin('bdris_emergency_equipment as d', 'a.Emergency_Equipment_ID', '=', 'd.Emergency_Equipment_ID')
        ->leftjoin('bdris_emergency_team as e', 'a.Emergency_Team_ID', '=', 'e.Emergency_Team_ID')
            ->select(
                'a.Disaster_Type_ID',
                'a.Disaster_Type',
                'a.Emergency_Evacuation_Site_ID',
                'b.Emergency_Evacuation_Site_Name',
                'a.Allocated_Fund_ID',
                'c.Allocated_Fund_Name',
                'a.Emergency_Team_ID',
                'e.Emergency_Team_Name',
                'a.Emergency_Equipment_ID',
                'd.Emergency_Equipment_Name',      

            )
            ->paginate(20, ['*'], 'db_entries');

            $emergency_evacuation_site = DB::table('bdris_emergency_evacuation_site')->paginate(20, ['*'], 'Emergency_evacuation_site');
            $allocated_fund = DB::table('bdris_allocated_fund_source')->paginate(20, ['*'], 'allocated_fund');
            $emergency_equipment = DB::table('bdris_emergency_equipment')->paginate(20, ['*'], 'emergency_equipment');
            $emergency_team = DB::table('bdris_emergency_team')->paginate(20, ['*'], 'emergency_team');


        return view('bdris_transactions.disaster_type_list', compact(
            'db_entries',
            'currDATE',
            'emergency_evacuation_site',
            'allocated_fund',
            'emergency_equipment',
            'emergency_team',

        ));
    }

    // Save Disaster Type
    public function create_disaster_type(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Disaster_Type_ID'] == null || $data['Disaster_Type_ID'] == 0) {
            $Disaster_Type_ID = DB::table('maintenance_bdris_disaster_type')->insertGetId(
                array(
                    'Disaster_Type'                 => $data['Disaster_Type'],
                    'Emergency_Evacuation_Site_ID'  => $data['Emergency_Evacuation_Site_ID'],
                    'Allocated_Fund_ID'             => $data['Allocated_Fund_ID'],
                    'Emergency_Equipment_ID'        => $data['Emergency_Equipment_ID'],
                    'Emergency_Team_ID'             => $data['Emergency_Team_ID'],
                    'Encoder_ID'                    => Auth::user()->id,
                    'Date_Stamp'                    => Carbon::now(),
                    'Active'                        => (int)$data['Active']
                )
            );
 
            return redirect()->back()->with('message', 'New Entry Created');
        } else {
            DB::table('maintenance_bdris_disaster_type')->where('Disaster_Type_ID', $data['Disaster_Type_ID'])->update(
                array(
                    'Disaster_Type'                 => $data['Disaster_Type'],
                    'Emergency_Evacuation_Site_ID'  => $data['Emergency_Evacuation_Site_ID'],
                    'Allocated_Fund_ID'             => $data['Allocated_Fund_ID'],
                    'Emergency_Equipment_ID'        => $data['Emergency_Equipment_ID'],
                    'Emergency_Team_ID'             => $data['Emergency_Team_ID'],
                    'Encoder_ID'                    => Auth::user()->id,
                    'Date_Stamp'                    => Carbon::now(),
                    'Active'                        => (int)$data['Active']
                )
            );
         
            return redirect()->back()->with('message', 'Disaster Type Info Updated');
        }
    }

    // Display Emergency Team
    public function get_disaster_type(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bdris_disaster_type as a')
        ->leftjoin('bdris_emergency_evacuation_site as b', 'a.Emergency_Evacuation_Site_ID', '=', 'b.Emergency_Evacuation_Site_ID')
        ->leftjoin('bdris_allocated_fund_source as c', 'a.Allocated_Fund_ID', '=', 'c.Allocated_Fund_ID')
        ->leftjoin('bdris_emergency_equipment as d', 'a.Emergency_Equipment_ID', '=', 'd.Emergency_Equipment_ID')
        ->leftjoin('bdris_emergency_team as e', 'a.Emergency_Team_ID', '=', 'e.Emergency_Team_ID')
            ->select(
                'a.Disaster_Type_ID',
                'a.Disaster_Type',
                'a.Emergency_Evacuation_Site_ID',
                'b.Emergency_Evacuation_Site_Name',
                'a.Allocated_Fund_ID',
                'c.Allocated_Fund_Name',
                'a.Emergency_Team_ID',
                'e.Emergency_Team_Name',
                'a.Emergency_Equipment_ID',
                'd.Emergency_Equipment_Name',  
                'a.Active',

            )
            ->where('Disaster_Type_ID', $id)->get();

        return (compact('theEntry'));
    }

    //Response Information
    public function response_information_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bdris_response_information as a')
        ->leftjoin('maintenance_bdris_disaster_type as b', 'a.Disaster_Type_ID', '=', 'b.Disaster_Type_ID')
        ->leftjoin('maintenance_bdris_alert_level as c', 'a.Alert_Level_ID', '=', 'c.Alert_Level_ID')
        ->leftjoin('maintenance_region as d', 'a.Region_ID', '=', 'd.Region_ID')
        ->leftjoin('maintenance_province as e', 'a.Province_ID', '=', 'e.Province_ID')
        ->leftjoin('maintenance_city_municipality as f', 'a.City_Municipality_ID', '=', 'f.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as g', 'a.Barangay_ID', '=', 'g.Barangay_ID')
            ->select(
                'a.Disaster_Response_ID',
                'a.Disaster_Name',
                'a.Disaster_Type_ID',
                'a.Alert_Level_ID',
                'a.Damaged_Location',
                'a.Disaster_Date_Start',
                'a.Disaster_Date_End',
                'a.GPS_Coordinates',
                'a.Risk_Assesment',
                'a.Action_Taken',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Province_ID',
                'a.Region_ID',
                'b.Disaster_Type',
                'c.Alert_Level',
                'd.Region_Name',
                'e.Province_Name',
                'f.City_Municipality_Name',
                'g.Barangay_Name',

            )
            ->paginate(20, ['*'], 'db_entries');

            $disaster_type = DB::table('maintenance_bdris_disaster_type')->paginate(20, ['*'], 'disaster_type');
            $alert_level = DB::table('maintenance_bdris_alert_level')->paginate(20, ['*'], 'alert_level');
            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            $province = DB::table('maintenance_province')->paginate(20, ['*'], 'province');
            $barangay = DB::table('maintenance_barangay')->paginate(20, ['*'], 'barangay');
            $city = DB::table('maintenance_city_municipality')->paginate(20, ['*'], 'city');


        return view('bdris_transactions.response_information_list', compact(
            'db_entries',
            'currDATE',
            'region',
            'province',
            'barangay',
            'city',
            'disaster_type',
            'alert_level',

        ));
    }

    // Save Emergency Evacuation Site
    public function create_response_information(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Disaster_Response_ID'] == null || $data['Disaster_Response_ID'] == 0) {
            $Disaster_Response_ID = DB::table('bdris_response_information')->insertGetId(
                array(
                    'Disaster_Name'         => $data['Disaster_Name'],
                    'Disaster_Type_ID'      => $data['Disaster_Type_ID'],
                    'Alert_Level_ID'        => $data['Alert_Level_ID'],
                    'Damaged_Location'      => $data['Damaged_Location'],
                    'Disaster_Date_Start'   => $data['Disaster_Date_Start'],
                    'Disaster_Date_End'     => $data['Disaster_Date_End'],
                    'GPS_Coordinates'       => $data['GPS_Coordinates'],
                    'Risk_Assesment'        => $data['Risk_Assesment'],
                    'Action_Taken'          => $data['Action_Taken'],
                    'Barangay_ID'           => $data['Barangay_ID'],
                    'City_Municipality_ID'  => $data['City_Municipality_ID'],
                    'Province_ID'           => $data['Province_ID'],
                    'Region_ID'             => $data['Region_ID'],
                    'Encoder_ID'            => Auth::user()->id,
                    'Date_Stamp'            => Carbon::now(),

                )
            );
 
            return redirect()->back()->with('message', 'New Entry Created');
        } else {
            DB::table('bdris_response_information')->where('Disaster_Response_ID', $data['Disaster_Response_ID'])->update(
                array(
                    'Disaster_Name'         => $data['Disaster_Name'],
                    'Disaster_Type_ID'      => $data['Disaster_Type_ID'],
                    'Alert_Level_ID'        => $data['Alert_Level_ID'],
                    'Damaged_Location'      => $data['Damaged_Location'],
                    'Disaster_Date_Start'   => $data['Disaster_Date_Start'],
                    'Disaster_Date_End'     => $data['Disaster_Date_End'],
                    'GPS_Coordinates'       => $data['GPS_Coordinates'],
                    'Risk_Assesment'        => $data['Risk_Assesment'],
                    'Action_Taken'          => $data['Action_Taken'],
                    'Barangay_ID'           => $data['Barangay_ID'],
                    'City_Municipality_ID'  => $data['City_Municipality_ID'],
                    'Province_ID'           => $data['Province_ID'],
                    'Region_ID'             => $data['Region_ID'],
                    'Encoder_ID'            => Auth::user()->id,
                    'Date_Stamp'            => Carbon::now(),
                )
            );
         
            return redirect()->back()->with('message', 'Response Information Updated');
        }
    }

    // Display Response Information
    public function get_response_information(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bdris_response_information as a')
        ->leftjoin('maintenance_bdris_disaster_type as b', 'a.Disaster_Type_ID', '=', 'b.Disaster_Type_ID')
        ->leftjoin('maintenance_bdris_alert_level as c', 'a.Alert_Level_ID', '=', 'c.Alert_Level_ID')
        ->leftjoin('maintenance_region as d', 'a.Region_ID', '=', 'd.Region_ID')
        ->leftjoin('maintenance_province as e', 'a.Province_ID', '=', 'e.Province_ID')
        ->leftjoin('maintenance_city_municipality as f', 'a.City_Municipality_ID', '=', 'f.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as g', 'a.Barangay_ID', '=', 'g.Barangay_ID')
            ->select(
                'a.Disaster_Response_ID',
                'a.Disaster_Name',
                'a.Disaster_Type_ID',
                'a.Alert_Level_ID',
                'a.Damaged_Location',
                'a.Disaster_Date_Start',
                'a.Disaster_Date_End',
                'a.GPS_Coordinates',
                'a.Risk_Assesment',
                'a.Action_Taken',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Province_ID',
                'a.Region_ID',
                'b.Disaster_Type',
                'c.Alert_Level',
                'd.Region_Name',
                'e.Province_Name',
                'f.City_Municipality_Name',
                'g.Barangay_Name',

            )
            ->where('Disaster_Response_ID', $id)->get();

        return (compact('theEntry'));
    }

    //Recovery Information List
    public function recovery_information_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bdris_recovery_information as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('bdris_response_information as f', 'a.Disaster_Response_ID', '=', 'f.Disaster_Response_ID')
            ->select(
                'a.Disaster_Recovery_ID',
                'a.Disaster_Response_ID',
                'a.Region_ID',
                'b.Region_Name',
                'a.Province_ID',
                'c.Province_Name',
                'a.Barangay_ID',
                'e.Barangay_Name',
                'a.City_Municipality_ID',
                'd.City_Municipality_Name',    
                'f.Disaster_Name',  
            )
            ->paginate(20, ['*'], 'db_entries');

            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            $province = DB::table('maintenance_province')->paginate(20, ['*'], 'province');
            $barangay = DB::table('maintenance_barangay')->paginate(20, ['*'], 'barangay');
            $city = DB::table('maintenance_city_municipality')->paginate(20, ['*'], 'city');
            $response_information = DB::table('bdris_response_information')->paginate(20, ['*'], 'response_information');
            $household_profile = DB::table('bips_household_profile')->paginate(20, ['*'], 'household_profile');
            $level_of_damage = DB::table('maintenance_bdris_level_of_damage')->paginate(20, ['*'], 'level_of_damage');


        return view('bdris_transactions.recovery_information_list', compact(
            'db_entries',
            'currDATE',
            'region',
            'province',
            'barangay',
            'city',
            'response_information',
            'household_profile',
            'level_of_damage',

        ));
    }

    //Save Recovery Information
    public function create_recovery_information(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Disaster_Recovery_ID'] == null || $data['Disaster_Recovery_ID'] == 0) {
            $Disaster_Recovery_ID = DB::table('bdris_recovery_information')->insertGetId(
                array(
                    'Disaster_Response_ID'              => $data['Disaster_Response_ID'],
                    'Barangay_ID'                       => $data['Barangay_ID'],
                    'City_Municipality_ID'              => $data['City_Municipality_ID'],
                    'Province_ID'                       => $data['Province_ID'],
                    'Region_ID'                         => $data['Region_ID'],
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                )
            );

            DB::table('bdris_affected_household_and_infra')->where('Disaster_Recovery_ID', $Disaster_Recovery_ID)->delete();

            if (isset($data['Household_Profile_ID'])) {
                $affected_household = [];

                for ($i = 0; $i < count($data['Household_Profile_ID']); $i++) {
                    if ($data['Household_Profile_ID'][$i] != NULL) {

                        $id = 0 + DB::table('bdris_affected_household_and_infra')->max('Affected_Household_ID');
                        $id += 1;

                        if ($data['Household_Profile_ID'][$i] != null) {
                            $affected_household = [
                                'Disaster_Recovery_ID'          => $Disaster_Recovery_ID,
                                'Household_Profile_ID'          => $data['Household_Profile_ID'][$i],
                                'Level_of_Damage_ID'            => $data['Level_of_Damage_ID'][$i],
                                'Affected_Infrastructure_Name'  => $data['Affected_Infrastructure_Name'][$i],
                                'Address'                       => $data['Address'][$i],
                                'Estimated_Damage_Value'        => $data['Estimated_Damage_Value'][$i],
                                'Remarks'                       => $data['Remarks'][$i],
                                'Encoder_ID'                    => Auth::user()->id,
                                'Date_Stamp'                    => Carbon::now()
                            ];
                        }

                        DB::table('bdris_affected_household_and_infra')->updateOrInsert(['Affected_Household_ID' => $id], $affected_household);
                    }
                }
            }
 
            return redirect()->back()->with('message', 'New Entry Created');
        } else {
            DB::table('bdris_recovery_information')->where('Disaster_Recovery_ID', $data['Disaster_Recovery_ID'])->update(
                array(
                    'Disaster_Response_ID'              => $data['Disaster_Response_ID'],
                    'Barangay_ID'                       => $data['Barangay_ID'],
                    'City_Municipality_ID'              => $data['City_Municipality_ID'],
                    'Province_ID'                       => $data['Province_ID'],
                    'Region_ID'                         => $data['Region_ID'],
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                )
            );

            DB::table('bdris_affected_household_and_infra')->where('Disaster_Recovery_ID', $data['Disaster_Recovery_ID'])->delete();

            if (isset($data['Household_Profile_ID'])) {
                $affected_household = [];

                for ($i = 0; $i < count($data['Household_Profile_ID']); $i++) {
                    if ($data['Household_Profile_ID'][$i] != NULL) {

                        $id = 0 + DB::table('bdris_affected_household_and_infra')->max('Affected_Household_ID');
                        $id += 1;

                        if ($data['Household_Profile_ID'][$i] != null) {
                            $affected_household = [
                                'Disaster_Recovery_ID'          => $data['Disaster_Recovery_ID'],
                                'Household_Profile_ID'          => $data['Household_Profile_ID'][$i],
                                'Level_of_Damage_ID'            => $data['Level_of_Damage_ID'][$i],
                                'Affected_Infrastructure_Name'  => $data['Affected_Infrastructure_Name'][$i],
                                'Address'                       => $data['Address'][$i],
                                'Estimated_Damage_Value'        => $data['Estimated_Damage_Value'][$i],
                                'Remarks'                       => $data['Remarks'][$i],
                                'Encoder_ID'                    => Auth::user()->id,
                                'Date_Stamp'                    => Carbon::now()
                            ];
                        }

                        DB::table('bdris_affected_household_and_infra')->updateOrInsert(['Affected_Household_ID' => $id], $affected_household);
                    }
                }
            }
         
            return redirect()->back()->with('message', 'Recovery Information Info Updated');
        }
    }


    // Display Recovery Information
    public function get_recovery_information(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bdris_recovery_information as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('bdris_response_information as f', 'a.Disaster_Response_ID', '=', 'f.Disaster_Response_ID')
        ->select(
            'a.Disaster_Recovery_ID',
            'a.Disaster_Response_ID',
            'a.Region_ID',
            'b.Region_Name',
            'a.Province_ID',
            'c.Province_Name',
            'a.Barangay_ID',
            'e.Barangay_Name',
            'a.City_Municipality_ID',
            'd.City_Municipality_Name',    
            'f.Disaster_Name',  
        )
            ->where('Disaster_Recovery_ID', $id)->get();

        return (compact('theEntry'));
    }

    public function get_affected_household(Request $request)
    {
        $id = $_GET['id'];
        $Affected_Household = DB::table('bdris_affected_household_and_infra as a')
            ->leftjoin('bips_household_profile as b', 'a.Household_Profile_ID', '=', 'b.Household_Profile_ID')
            ->leftjoin('maintenance_bdris_level_of_damage as c', 'a.Level_of_Damage_ID', '=', 'c.Level_of_Damage_ID')
            ->select(
                'a.Affected_Household_ID',
                'a.Disaster_Recovery_ID',
                'a.Household_Profile_ID',
                'a.Level_of_Damage_ID',
                'a.Affected_Infrastructure_Name',
                'a.Address',
                'a.Estimated_Damage_Value',
                'a.Remarks',
                'b.Household_Name',
                'c.Level_of_Damage',
            )
            ->where('a.Disaster_Recovery_ID', $id)
            ->get();
        return json_encode($Affected_Household);
    }

    //Disaster Related Activities List
    public function disaster_related_activities_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bdris_disaster_related_activities as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('bips_brgy_officials_and_staff as f', 'a.Brgy_Officials_and_Staff_ID', '=', 'f.Brgy_Officials_and_Staff_ID')
        ->leftjoin('bips_brgy_inhabitants_information as g', 'g.Resident_ID', '=', 'f.Resident_ID')
            ->select(
                'a.Disaster_Related_Activities_ID',
                'a.Activity_Name',
                'a.Purpose',
                'a.Date_Start',
                'a.Date_End',
                'a.Number_of_Participants',
                'a.Region_ID',
                'b.Region_Name',
                'a.Province_ID',
                'c.Province_Name',
                'a.Barangay_ID',
                'e.Barangay_Name',
                'a.City_Municipality_ID',
                'd.City_Municipality_Name',    
                'g.Last_Name',
                'g.First_Name',
                'g.Middle_Name',
                  
            )
            ->paginate(20, ['*'], 'db_entries');

            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            $province = DB::table('maintenance_province')->paginate(20, ['*'], 'province');
            $barangay = DB::table('maintenance_barangay')->paginate(20, ['*'], 'barangay');
            $city = DB::table('maintenance_city_municipality')->paginate(20, ['*'], 'city');
            $brgy_officials_and_staff = DB::table('bips_brgy_officials_and_staff as aa')
            ->leftjoin('bips_brgy_inhabitants_information as bb', 'aa.Resident_ID', '=', 'bb.Resident_ID')
            ->select(   
                'aa.Resident_ID',
                'aa.Last_Name',
                'aa.First_Name',
                'aa.Middle_Name',
            )
            ->paginate(20, ['*'], 'brgy_officials_and_staff');

        return view('bdris_transactions.disaster_related_activities_list', compact(
            'db_entries',
            'currDATE',
            'region',
            'province',
            'barangay',
            'city',
            'brgy_officials_and_staff',

        ));
    }

    //Save Disaster Related Activities
    public function create_disaster_related_activities(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Disaster_Related_Activities_ID'] == null || $data['Disaster_Related_Activities_ID'] == 0) {
            $Disaster_Related_Activities_ID = DB::table('bdris_disaster_related_activities')->insertGetId(
                array(
                    'Activity_Name'                     => $data['Activity_Name'],
                    'Purpose'                           => $data['Purpose'],
                    'Date_Start'                        => $data['Date_Start'],
                    'Date_End'                          => $data['Date_End'],
                    'Number_of_Participants'            => $data['Number_of_Participants'],
                   
                    'Barangay_ID'                       => $data['Barangay_ID'],
                    'City_Municipality_ID'              => $data['City_Municipality_ID'],
                    'Province_ID'                       => $data['Province_ID'],
                    'Region_ID'                         => $data['Region_ID'],
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                )
            );
 
            return redirect()->back()->with('message', 'New Entry Created');
        } else {
            DB::table('bdris_disaster_related_activities')->where('Disaster_Related_Activities_ID', $data['Disaster_Related_Activities_ID'])->update(
                array(
                    'Activity_Name'                     => $data['Activity_Name'],
                    'Purpose'                           => $data['Purpose'],
                    'Date_Start'                        => $data['Date_Start'],
                    'Date_End'                          => $data['Date_End'],
                    'Number_of_Participants'            => $data['Number_of_Participants'],
                    
                    'Barangay_ID'                       => $data['Barangay_ID'],
                    'City_Municipality_ID'              => $data['City_Municipality_ID'],
                    'Province_ID'                       => $data['Province_ID'],
                    'Region_ID'                         => $data['Region_ID'],
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                )
            );
         
            return redirect()->back()->with('message', 'Disaster Related Activities Info Updated');
        }
    }

    // Display Disaster Related Activities
    public function get_disaster_related_activities(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bdris_disaster_related_activities as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('bips_brgy_officials_and_staff as f', 'a.Brgy_Officials_and_Staff_ID', '=', 'f.Brgy_Officials_and_Staff_ID')
        ->leftjoin('bips_brgy_inhabitants_information as g', 'g.Resident_ID', '=', 'f.Resident_ID')
            ->select(
                'a.Disaster_Related_Activities_ID',
                'a.Activity_Name',
                'a.Purpose',
                'a.Date_Start',
                'a.Date_End',
                'a.Number_of_Participants',
                'a.Region_ID',
                'b.Region_Name',
                'a.Province_ID',
                'c.Province_Name',
                'a.Barangay_ID',
                'e.Barangay_Name',
                'a.City_Municipality_ID',
                'd.City_Municipality_Name',    
                'g.Last_Name',
                'g.First_Name',
                'g.Middle_Name',
                  
            )
            ->where('Disaster_Related_Activities_ID', $id)->get();

        return (compact('theEntry'));
    }

    //Disaster Supplies List
    public function disaster_supplies_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bdris_disaster_supplies as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('bips_brgy_officials_and_staff as f', 'a.Brgy_Officials_and_Staff_ID', '=', 'f.Brgy_Officials_and_Staff_ID')
        ->leftjoin('bips_brgy_inhabitants_information as g', 'g.Resident_ID', '=', 'f.Resident_ID')
        ->leftjoin('bdris_response_information as h', 'h.Disaster_Response_ID', '=', 'a.Disaster_Response_ID')
            ->select(
                'a.Disaster_Supplies_ID',
                'a.Disaster_Response_ID',
                'a.Disaster_Supplies_Name',
                'a.Disaster_Supplies_Quantity',
                'a.Location',
                'a.Remarks',
                'a.Region_ID',
                'b.Region_Name',
                'a.Province_ID',
                'c.Province_Name',
                'a.Barangay_ID',
                'e.Barangay_Name',
                'a.City_Municipality_ID',
                'd.City_Municipality_Name',    
                'g.Last_Name',
                'g.First_Name',
                'g.Middle_Name',
                'h.Disaster_Name',
                  
            )
            ->paginate(20, ['*'], 'db_entries');

            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            $province = DB::table('maintenance_province')->paginate(20, ['*'], 'province');
            $barangay = DB::table('maintenance_barangay')->paginate(20, ['*'], 'barangay');
            $city = DB::table('maintenance_city_municipality')->paginate(20, ['*'], 'city');
            $disaster_response = DB::table('bdris_response_information')->paginate(20, ['*'], 'disaster_response');
            $brgy_officials_and_staff = DB::table('bips_brgy_officials_and_staff as aa')
            ->leftjoin('bips_brgy_inhabitants_information as bb', 'aa.Resident_ID', '=', 'bb.Resident_ID')
            ->select(   
                'aa.Resident_ID',
                'aa.Last_Name',
                'aa.First_Name',
                'aa.Middle_Name',
            )
            ->paginate(20, ['*'], 'brgy_officials_and_staff');

        return view('bdris_transactions.disaster_supplies_list', compact(
            'db_entries',
            'currDATE',
            'region',
            'province',
            'barangay',
            'city',
            'brgy_officials_and_staff',
            'disaster_response',

        ));
    }

    //Save Disaster Suuplies
    public function create_disaster_supplies(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Disaster_Supplies_ID'] == null || $data['Disaster_Supplies_ID'] == 0) {
            $Disaster_Supplies_ID = DB::table('bdris_disaster_supplies')->insertGetId(
                array(
                    'Disaster_Response_ID'              => $data['Disaster_Response_ID'],
                    'Disaster_Supplies_Name'            => $data['Disaster_Supplies_Name'],
                    'Disaster_Supplies_Quantity'        => $data['Disaster_Supplies_Quantity'],
                    'Location'                          => $data['Location'],
                    'Remarks'                           => $data['Remarks'],
                   
                    'Barangay_ID'                       => $data['Barangay_ID'],
                    'City_Municipality_ID'              => $data['City_Municipality_ID'],
                    'Province_ID'                       => $data['Province_ID'],
                    'Region_ID'                         => $data['Region_ID'],
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                    'Active'                            => (int)$data['Active']
                )
            );
 
            return redirect()->back()->with('message', 'New Entry Created');
        } else {
            DB::table('bdris_disaster_supplies')->where('Disaster_Supplies_ID', $data['Disaster_Supplies_ID'])->update(
                array(
                    'Disaster_Response_ID'              => $data['Disaster_Response_ID'],
                    'Disaster_Supplies_Name'            => $data['Disaster_Supplies_Name'],
                    'Disaster_Supplies_Quantity'        => $data['Disaster_Supplies_Quantity'],
                    'Location'                          => $data['Location'],
                    'Remarks'                           => $data['Remarks'],
                   
                    'Barangay_ID'                       => $data['Barangay_ID'],
                    'City_Municipality_ID'              => $data['City_Municipality_ID'],
                    'Province_ID'                       => $data['Province_ID'],
                    'Region_ID'                         => $data['Region_ID'],
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                    'Active'                            => (int)$data['Active']
                )
            );
         
            return redirect()->back()->with('message', 'Disaster Supplies Info Updated');
        }
    }

    // Display Disaster Supplies
    public function get_disaster_supplies(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bdris_disaster_supplies as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('bips_brgy_officials_and_staff as f', 'a.Brgy_Officials_and_Staff_ID', '=', 'f.Brgy_Officials_and_Staff_ID')
        ->leftjoin('bips_brgy_inhabitants_information as g', 'g.Resident_ID', '=', 'f.Resident_ID')
        ->leftjoin('bdris_response_information as h', 'h.Disaster_Response_ID', '=', 'a.Disaster_Response_ID')
            ->select(
                'a.Disaster_Supplies_ID',
                'a.Disaster_Response_ID',
                'a.Disaster_Supplies_Name',
                'a.Disaster_Supplies_Quantity',
                'a.Location',
                'a.Remarks',
                'a.Region_ID',
                'b.Region_Name',
                'a.Province_ID',
                'c.Province_Name',
                'a.Barangay_ID',
                'a.Active',
                'e.Barangay_Name',
                'a.City_Municipality_ID',
                'd.City_Municipality_Name',    
                'g.Last_Name',
                'g.First_Name',
                'g.Middle_Name',
                'h.Disaster_Name',
                 
            )
            ->where('Disaster_Supplies_ID', $id)->get();

        return (compact('theEntry'));
    }
    
}
