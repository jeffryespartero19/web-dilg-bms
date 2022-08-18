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
    
}
