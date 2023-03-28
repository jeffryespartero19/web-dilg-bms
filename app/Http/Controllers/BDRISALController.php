<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\File;
use PDF;
use App\Exports\DisasterTypeExportView;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmergencyEvacuationSiteExportView;
use App\Exports\AllocatedFundExportView;
use App\Exports\DisasterSuppliesExportView;
use App\Exports\EmergencyTeamExportView;
use App\Exports\EmergencyEquipmentExportView;

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

    //Emergency Evacuation Site PDF
    public function viewEmergency_Evacuation_SitePDF(Request $request)
    {
        $details = DB::table('bdris_emergency_evacuation_site as a')
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
            ->paginate(20, ['*'], 'details');

        $pdf = PDF::loadView('bdris_transactions.emergency_evacuation_sitePDF', compact('details'))->setPaper('a4', 'landscape');
        return $pdf->stream();
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



    // Display Allocated Fund Source
    public function get_allocated_fund_source(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bdris_allocated_fund_source as a')
            ->where('Allocated_Fund_ID', $id)->get();

        return (compact('theEntry'));
    }

    //Allocated Fund Source PDF
    public function viewAllocated_FundPDF(Request $request)
    {
        $details = DB::table('bdris_allocated_fund_source as a')

            ->paginate(20, ['*'], 'details');

        $pdf = PDF::loadView('bdris_transactions.allocated_fundPDF', compact('details'));
        return $pdf->stream();
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

    //Emergency Equipment PDF
    public function viewEmergency_EquipmentPDF(Request $request)
    {
        $details = DB::table('bdris_emergency_equipment as a')
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
            ->paginate(20, ['*'], 'details');

        $pdf = PDF::loadView('bdris_transactions.emergency_equipmentPDF', compact('details'));
        return $pdf->stream();
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

    //Emergency Team PDF
    public function viewEmergency_TeamPDF(Request $request)
    {
        $details = DB::table('bdris_emergency_team as a')
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
            ->paginate(20, ['*'], 'details');

        $pdf = PDF::loadView('bdris_transactions.emergency_teamPDF', compact('details'));
        return $pdf->stream();
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



    //Disaster Type PDF
    public function viewDisaster_TypePDF(Request $request)
    {
        $details = DB::table('maintenance_bdris_disaster_type as a')
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
            ->paginate(20, ['*'], 'details');

        $pdf = PDF::loadView('bdris_transactions.disaster_typePDF', compact('details'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    // Display Disaster Type
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

    //Response Information List
    public function response_information_list(Request $request)
    {
        $currDATE = Carbon::now();

        if (Auth::user()->User_Type_ID == 1) {
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
                    'a.Summary',
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
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');

            return view('bdris_transactions.response_information_list', compact(
                'db_entries',
                'currDATE'

            ));
        } elseif (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4) {

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
                ->where('a.Region_ID', Auth::user()->Region_ID)
                ->paginate(20, ['*'], 'db_entries');

            $region1 = DB::table('maintenance_region')->where('Active', 1)->get();
            return view('bdris_transactions.response_information_list', compact(
                'db_entries',
                'currDATE',
                'region1',

            ));
        }
    }

    //Response Infomation Details
    public function response_information_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $disaster_type = DB::table('maintenance_bdris_disaster_type')->paginate(20, ['*'], 'disaster_type');
            $alert_level = DB::table('maintenance_bdris_alert_level')->paginate(20, ['*'], 'alert_level');
            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
            $evacuee = DB::table('bdris_evacuee_information as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_city_municipality as c', 'b.City_Municipality_ID', '=', 'c.City_Municipality_ID')
                ->leftjoin('maintenance_province as d', 'b.Province_ID', '=', 'd.Province_ID')
                ->leftjoin('maintenance_region as e', 'b.Region_ID', '=', 'e.Region_ID')
                ->leftjoin('maintenance_barangay as f', 'b.Barangay_ID', '=', 'f.Barangay_ID')
                ->select(
                    'a.Evacuee_ID',
                    'a.Resident_ID',
                    'a.Residency_Status',
                    'a.Disaster_Response_ID',
                    'a.Non_Resident_Name',
                    DB::raw('(CASE WHEN A.Resident_ID = 0 THEN a.Non_Resident_Birthdate ELSE b.Birthdate END) AS Non_Resident_Birthdate'),
                    DB::raw('(CASE WHEN A.Resident_ID = 0 THEN a.Non_Resident_Address ELSE concat(f.Barangay_Name, " ",c.City_Municipality_Name," ",d.Province_Name," ",e.Region_Name) END) AS Non_Resident_Address')
                )
                ->where('a.Disaster_Response_ID', 0)->get();

            return view('bdris_transactions.response_information', compact(
                'currDATE',
                'disaster_type',
                'alert_level',
                'region',
                'resident',
                'evacuee',
            ));
        } else {
            $response = DB::table('bdris_response_information')->where('Disaster_Response_ID', $id)->get();
            $disaster_type = DB::table('maintenance_bdris_disaster_type')->paginate(20, ['*'], 'disaster_type');
            $alert_level = DB::table('maintenance_bdris_alert_level')->paginate(20, ['*'], 'alert_level');
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $response[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $response[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $response[0]->City_Municipality_ID)->get();
            $attachment = DB::table('bdris_file_attachment')->where('Disaster_Response_ID', $id)->get();
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
            $damage = DB::table('bdris_disaster_response_otherinfo')->where('Disaster_Response_ID', $id)->get();
            // $gps = DB::table('bdris_Disaster_Response_GPS_Coordinates')->where('Disaster_Response_ID', $id)->get();
            // $risk = DB::table('bdris_Disaster_Response_Risk_Assessment')->where('Disaster_Response_ID', $id)->get();
            // $action = DB::table('bdris_Disaster_Response_Action_Taken')->where('Disaster_Response_ID', $id)->get();
            $evacuee = DB::table('bdris_evacuee_information as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_city_municipality as c', 'b.City_Municipality_ID', '=', 'c.City_Municipality_ID')
                ->leftjoin('maintenance_province as d', 'b.Province_ID', '=', 'd.Province_ID')
                ->leftjoin('maintenance_region as e', 'b.Region_ID', '=', 'e.Region_ID')
                ->leftjoin('maintenance_barangay as f', 'b.Barangay_ID', '=', 'f.Barangay_ID')
                ->select(
                    'a.Evacuee_ID',
                    'a.Resident_ID',
                    'a.Residency_Status',
                    'a.Disaster_Response_ID',
                    'a.Non_Resident_Name',
                    DB::raw('(CASE WHEN A.Resident_ID = 0 THEN a.Non_Resident_Birthdate ELSE b.Birthdate END) AS Non_Resident_Birthdate'),
                    DB::raw('(CASE WHEN A.Resident_ID = 0 THEN a.Non_Resident_Address ELSE concat(f.Barangay_Name, " ",c.City_Municipality_Name," ",d.Province_Name," ",e.Region_Name) END) AS Non_Resident_Address')
                )
                ->where('a.Disaster_Response_ID', $id)->get();


            return view('bdris_transactions.response_information_edit', compact(
                'currDATE',
                'disaster_type',
                'alert_level',
                'region',
                'province',
                'barangay',
                'response',
                'attachment',
                'city_municipality',
                'resident',
                'evacuee',
                'damage',
            ));
        }
    }
    
    public function get_responseinfo(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('bdris_response_information as a')
            ->leftjoin('maintenance_bdris_disaster_type as b', 'a.Disaster_Type_ID', '=', 'b.Disaster_Type_ID')
            ->leftjoin('maintenance_bdris_alert_level as c', 'a.Alert_Level_ID', '=', 'c.Alert_Level_ID')
            ->select(
                'a.Disaster_Response_ID',
                'a.Disaster_Name',
                'a.Damaged_Location',
                'a.Disaster_Date_Start',
                'a.Disaster_Date_End',
                'a.GPS_Coordinates',
                'a.Risk_Assesment',
                'a.Action_Taken',
                'a.Summary',
                'b.Disaster_Type',
                'c.Alert_Level',
            )
            ->where('a.Disaster_Response_ID', $id)->get();

        return (compact('theEntry'));
    }

    public function view_response_information_details($id)
    {
        $currDATE = Carbon::now();


        $response = DB::table('bdris_response_information')->where('Disaster_Response_ID', $id)->get();
        $disaster_type = DB::table('maintenance_bdris_disaster_type')->paginate(20, ['*'], 'disaster_type');
        $alert_level = DB::table('maintenance_bdris_alert_level')->paginate(20, ['*'], 'alert_level');
        $region = DB::table('maintenance_region')->where('Active', 1)->get();
        $province = DB::table('maintenance_province')->where('Region_ID', $response[0]->Region_ID)->get();
        $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $response[0]->Province_ID)->get();
        $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $response[0]->City_Municipality_ID)->get();
        $attachment = DB::table('bdris_file_attachment')->where('Disaster_Response_ID', $id)->get();
        $resident = DB::table('bips_brgy_inhabitants_information')->get();
        $evacuee = DB::table('bdris_evacuee_information as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_city_municipality as c', 'b.City_Municipality_ID', '=', 'c.City_Municipality_ID')
            ->leftjoin('maintenance_province as d', 'b.Province_ID', '=', 'd.Province_ID')
            ->leftjoin('maintenance_region as e', 'b.Region_ID', '=', 'e.Region_ID')
            ->leftjoin('maintenance_barangay as f', 'b.Barangay_ID', '=', 'f.Barangay_ID')
            ->select(
                'a.Evacuee_ID',
                'a.Resident_ID',
                'a.Residency_Status',
                'a.Disaster_Response_ID',
                'a.Non_Resident_Name',
                DB::raw('(CASE WHEN A.Resident_ID = 0 THEN a.Non_Resident_Birthdate ELSE b.Birthdate END) AS Non_Resident_Birthdate'),
                DB::raw('(CASE WHEN A.Resident_ID = 0 THEN a.Non_Resident_Address ELSE concat(f.Barangay_Name, " ",c.City_Municipality_Name," ",d.Province_Name," ",e.Region_Name) END) AS Non_Resident_Address')
            )
            ->where('a.Disaster_Response_ID', $id)->get();


        return view('bdris_transactions.response_information_view', compact(
            'currDATE',
            'disaster_type',
            'alert_level',
            'region',
            'province',
            'barangay',
            'response',
            'attachment',
            'city_municipality',
            'resident',
            'evacuee'
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
                    'Disaster_Date_Start'   => $data['Disaster_Date_Start'],
                    'Disaster_Date_End'     => $data['Disaster_Date_End'],
                    'Summary'               => $data['Summary'],
                    // 'Damaged_Location'      => $data['Damaged_Location'],
                    // 'GPS_Coordinates'       => $data['GPS_Coordinates'],
                    // 'Risk_Assesment'        => $data['Risk_Assesment'],
                    // 'Action_Taken'          => $data['Action_Taken'],
                    'Barangay_ID'           => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'  => Auth::user()->City_Municipality_ID,
                    'Province_ID'           => Auth::user()->Province_ID,
                    'Region_ID'             => Auth::user()->Region_ID,
                    'Encoder_ID'            => Auth::user()->id,
                    'Date_Stamp'            => Carbon::now(),

                )
            );

            DB::table('bdris_evacuee_information')->where('Disaster_Response_ID', $Disaster_Response_ID)->delete();
            DB::table('bdris_Disaster_Response_OtherInfo')->where('Disaster_Response_ID', $Disaster_Response_ID)->delete();
            // DB::table('bdris_Disaster_Response_GPS_Coordinates')->where('Disaster_Response_ID', $Disaster_Response_ID)->delete();
            // DB::table('bdris_Disaster_Response_Risk_Assessment')->where('Disaster_Response_ID', $Disaster_Response_ID)->delete();
            // DB::table('bdris_Disaster_Response_Action_Taken')->where('Disaster_Response_ID', $Disaster_Response_ID)->delete();

            if ($request->hasfile('fileattach')) {
                foreach ($request->file('fileattach') as $file) {
                    $filename = $file->getClientOriginalName();
                    $fileType = $file->getClientOriginalExtension();
                    $fileSize = $file->getSize();
                    $filePath = public_path() . '/files/uploads/response_information/';
                    $file->move($filePath, $filename);

                    $file_data = array(
                        'Disaster_Response_ID' => $Disaster_Response_ID,
                        'File_Name' => $filename,
                        'File_Location' => $filePath,
                        'File_Type' => $fileType,
                        'File_Size' => $fileSize,
                        'Encoder_ID'       => Auth::user()->id,
                        'Date_Stamp'       => Carbon::now()
                    );
                    DB::table('bdris_file_attachment')->insert($file_data);
                }
            }

            if (isset($data['Resident_ID'])) { //aldren
                $resident_details = [];

                for ($i = 0; $i < count($data['Resident_ID']); $i++) {
                    if ($data['Resident_ID'][$i] != NULL) {
                        if (is_int($data['Resident_ID'][$i]) || ctype_digit($data['Resident_ID'][$i])) {
                            $id = 0 + DB::table('bdris_evacuee_information')->max('Evacuee_ID');
                            $id += 1;

                            $resident_details = [
                                'Disaster_Response_ID' => $Disaster_Response_ID,
                                'Resident_ID' => $data['Resident_ID'][$i],
                                'Residency_Status' => (int)$data['Residency_Status'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        } else {
                            $id = 0 + DB::table('bdris_evacuee_information')->max('Evacuee_ID');
                            $id += 1;

                            $resident_details = [
                                'Disaster_Response_ID' => $Disaster_Response_ID,
                                'Resident_ID' => 0,
                                'Residency_Status' => (int)$data['Residency_Status'][$i],
                                'Non_Resident_Name' => $data['Resident_ID'][$i],
                                'Non_Resident_Address' => $data['Non_Resident_Address'][$i],
                                'Non_Resident_Birthdate' => $data['Non_Resident_Birthdate'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        }
                        DB::table('bdris_evacuee_information')->insert($resident_details);
                    }
                }
            }

            if (isset($data['Damage_Location'])) {
                $damage_location = [];

                for ($i = 0; $i < count($data['Damage_Location']); $i++) {
                    if ($data['Damage_Location'][$i] != NULL) {

                        $id = 0 + DB::table('bdris_Disaster_Response_OtherInfo')->max('Disaster_Response_OtherInfo_ID');
                        $id += 1;

                        if ($data['Damage_Location'][$i] != null) {
                            $damage_location = [
                                'Disaster_Response_ID' => $Disaster_Response_ID,
                                'Damage_Location' => $data['Damage_Location'][$i],
                                'GPS_Coordinates' => $data['GPS_Coordinates'][$i],
                                'Risk_Assessment' => $data['Risk_Assessment'][$i],
                                'Action_Taken' => $data['Action_Taken'][$i],
                            ];
                        }

                        DB::table('bdris_Disaster_Response_OtherInfo')->updateOrInsert(['Disaster_Response_OtherInfo_ID' => $id], $damage_location);
                    }
                }
            }

            // if (isset($data['GPS_Coordinates'])) {
            //     $GPS_coordinates = [];

            //     for ($i = 0; $i < count($data['GPS_Coordinates']); $i++) {
            //         if ($data['GPS_Coordinates'][$i] != NULL) {

            //             $id = 0 + DB::table('bdris_Disaster_Response_GPS_Coordinates')->max('GPS_Coordinates_ID');
            //             $id += 1;

            //             if ($data['GPS_Coordinates'][$i] != null) {
            //                 $GPS_coordinates = [
            //                     'Disaster_Response_ID' => $Disaster_Response_ID,
            //                     'GPS_Coordinates' => $data['GPS_Coordinates'][$i],
            //                 ];
            //             }

            //             DB::table('bdris_Disaster_Response_GPS_Coordinates')->updateOrInsert(['GPS_Coordinates_ID' => $id], $GPS_coordinates);
            //         }
            //     }
            // }

            // if (isset($data['Risk_Assessment'])) {
            //     $risk_assessment = [];

            //     for ($i = 0; $i < count($data['Risk_Assessment']); $i++) {
            //         if ($data['Risk_Assessment'][$i] != NULL) {

            //             $id = 0 + DB::table('bdris_Disaster_Response_Risk_Assessment')->max('Risk_Assessment_ID');
            //             $id += 1;

            //             if ($data['Risk_Assessment'][$i] != null) {
            //                 $risk_assessment = [
            //                     'Disaster_Response_ID' => $Disaster_Response_ID,
            //                     'Risk_Assessment' => $data['Risk_Assessment'][$i],
            //                 ];
            //             }

            //             DB::table('bdris_Disaster_Response_Risk_Assessment')->updateOrInsert(['Risk_Assessment_ID' => $id], $risk_assessment);
            //         }
            //     }
            // }

            // if (isset($data['Action_Taken'])) {
            //     $action_taken = [];

            //     for ($i = 0; $i < count($data['Action_Taken']); $i++) {
            //         if ($data['Action_Taken'][$i] != NULL) {

            //             $id = 0 + DB::table('bdris_Disaster_Response_Action_Taken')->max('Action_Taken_ID');
            //             $id += 1;

            //             if ($data['Action_Taken'][$i] != null) {
            //                 $action_taken = [
            //                     'Disaster_Response_ID' => $Disaster_Response_ID,
            //                     'Action_Taken' => $data['Action_Taken'][$i],
            //                 ];
            //             }

            //             DB::table('bdris_Disaster_Response_Action_Taken')->updateOrInsert(['Action_Taken_ID' => $id], $action_taken);
            //         }
            //     }
            // }

            return redirect()->to('response_information_details/' . $Disaster_Response_ID)->with('message', 'New Recovery Information Created');
        } else {
            DB::table('bdris_response_information')->where('Disaster_Response_ID', $data['Disaster_Response_ID'])->update(
                array(
                    'Disaster_Name'         => $data['Disaster_Name'],
                    'Disaster_Type_ID'      => $data['Disaster_Type_ID'],
                    'Alert_Level_ID'        => $data['Alert_Level_ID'],
                    'Disaster_Date_Start'   => $data['Disaster_Date_Start'],
                    'Disaster_Date_End'     => $data['Disaster_Date_End'],
                    'Summary'               => $data['Summary'],
                    // 'Damaged_Location'      => $data['Damaged_Location'],
                    // 'GPS_Coordinates'       => $data['GPS_Coordinates'],
                    // 'Risk_Assesment'        => $data['Risk_Assesment'],
                    // 'Action_Taken'          => $data['Action_Taken'],
                    'Barangay_ID'           => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'  => Auth::user()->City_Municipality_ID,
                    'Province_ID'           => Auth::user()->Province_ID,
                    'Region_ID'             => Auth::user()->Region_ID,
                    'Encoder_ID'            => Auth::user()->id,
                    'Date_Stamp'            => Carbon::now(),
                )
            );

            DB::table('bdris_evacuee_information')->where('Disaster_Response_ID', $data['Disaster_Response_ID'])->delete();
            DB::table('bdris_Disaster_Response_OtherInfo')->where('Disaster_Response_ID', $data['Disaster_Response_ID'])->delete();
            // DB::table('bdris_Disaster_Response_GPS_Coordinates')->where('Disaster_Response_ID', $data['Disaster_Response_ID'])->delete();
            // DB::table('bdris_Disaster_Response_Risk_Assessment')->where('Disaster_Response_ID', $data['Disaster_Response_ID'])->delete();
            // DB::table('bdris_Disaster_Response_Action_Taken')->where('Disaster_Response_ID', $data['Disaster_Response_ID'])->delete();

            if ($request->hasfile('fileattach')) {
                foreach ($request->file('fileattach') as $file) {

                    // dd($file->getSize());

                    $filename = $file->getClientOriginalName();
                    $fileType = $file->getClientOriginalExtension();
                    $fileSize = $file->getSize();
                    // $filename = pathinfo($fileinfo, PATHINFO_FILENAME);
                    $filePath = public_path() . '/files/uploads/response_information/';
                    $file->move($filePath, $filename);

                    $file_data = array(
                        'Disaster_Response_ID' => $data['Disaster_Response_ID'],
                        'File_Name' => $filename,
                        'File_Location' => $filePath,
                        'File_Type' => $fileType,
                        'File_Size' => $fileSize,
                        'Encoder_ID'       => Auth::user()->id,
                        'Date_Stamp'       => Carbon::now()
                    );
                    DB::table('bdris_file_attachment')->insert($file_data);
                }
            }

            if (isset($data['Resident_ID'])) {
                $resident_details = [];

                for ($i = 0; $i < count($data['Resident_ID']); $i++) {
                    if ($data['Resident_ID'][$i] != NULL) {
                        if (is_int($data['Resident_ID'][$i]) || ctype_digit($data['Resident_ID'][$i])) {
                            $id = 0 + DB::table('bdris_evacuee_information')->max('Evacuee_ID');
                            $id += 1;

                            $resident_details = [
                                'Disaster_Response_ID' => $data['Disaster_Response_ID'],
                                'Resident_ID' => $data['Resident_ID'][$i],
                                'Residency_Status' => (int)$data['Residency_Status'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        } else {
                            $id = 0 + DB::table('bdris_evacuee_information')->max('Evacuee_ID');
                            $id += 1;

                            $resident_details = [
                                'Disaster_Response_ID' => $data['Disaster_Response_ID'],
                                'Resident_ID' => 0,
                                'Residency_Status' => (int)$data['Residency_Status'][$i],
                                'Non_Resident_Name' => $data['Resident_ID'][$i],
                                'Non_Resident_Address' => $data['Non_Resident_Address'][$i],
                                'Non_Resident_Birthdate' => $data['Non_Resident_Birthdate'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        }
                        DB::table('bdris_evacuee_information')->insert($resident_details);
                    }
                }
            }


            if (isset($data['Damage_Location'])) {
                $damage_location = [];

                for ($i = 0; $i < count($data['Damage_Location']); $i++) {
                    if ($data['Damage_Location'][$i] != NULL) {

                        $id = 0 + DB::table('bdris_Disaster_Response_OtherInfo')->max('Disaster_Response_OtherInfo_ID');
                        $id += 1;

                        if ($data['Damage_Location'][$i] != null) {
                            $damage_location = [
                                'Disaster_Response_ID'  => $data['Disaster_Response_ID'],
                                'Damage_Location'       => $data['Damage_Location'][$i],
                                'GPS_Coordinates'       => $data['GPS_Coordinates'][$i],
                                'Risk_Assessment'       => $data['Risk_Assessment'][$i],
                                'Action_Taken'       => $data['Action_Taken'][$i],
                            ];
                        }

                        DB::table('bdris_Disaster_Response_OtherInfo')->updateOrInsert(['Disaster_Response_OtherInfo_ID' => $id], $damage_location);
                    }
                }
            }

            // if (isset($data['GPS_Coordinates'])) {
            //     $GPS_coordinates = [];

            //     for ($i = 0; $i < count($data['GPS_Coordinates']); $i++) {
            //         if ($data['GPS_Coordinates'][$i] != NULL) {

            //             $id = 0 + DB::table('bdris_Disaster_Response_GPS_Coordinates')->max('GPS_Coordinates_ID');
            //             $id += 1;

            //             if ($data['GPS_Coordinates'][$i] != null) {
            //                 $GPS_coordinates = [
            //                     'Disaster_Response_ID'  => $data['Disaster_Response_ID'],
            //                     'GPS_Coordinates'       => $data['GPS_Coordinates'][$i],
            //                 ];
            //             }

            //             DB::table('bdris_Disaster_Response_GPS_Coordinates')->updateOrInsert(['GPS_Coordinates_ID' => $id], $GPS_coordinates);
            //         }
            //     }
            // }

            // if (isset($data['Risk_Assessment'])) {
            //     $risk_assessment = [];

            //     for ($i = 0; $i < count($data['Risk_Assessment']); $i++) {
            //         if ($data['Risk_Assessment'][$i] != NULL) {

            //             $id = 0 + DB::table('bdris_Disaster_Response_Risk_Assessment')->max('Risk_Assessment_ID');
            //             $id += 1;

            //             if ($data['GPS_Coordinates'][$i] != null) {
            //                 $risk_assessment = [
            //                     'Disaster_Response_ID'  => $data['Disaster_Response_ID'],
            //                     'Risk_Assessment'       => $data['Risk_Assessment'][$i],
            //                 ];
            //             }

            //             DB::table('bdris_Disaster_Response_Risk_Assessment')->updateOrInsert(['Risk_Assessment_ID' => $id], $risk_assessment);
            //         }
            //     }
            // }

            // if (isset($data['Action_Taken'])) {
            //     $action_taken = [];

            //     for ($i = 0; $i < count($data['Action_Taken']); $i++) {
            //         if ($data['Action_Taken'][$i] != NULL) {

            //             $id = 0 + DB::table('bdris_Disaster_Response_Action_Taken')->max('Action_Taken_ID');
            //             $id += 1;

            //             if ($data['GPS_Coordinates'][$i] != null) {
            //                 $action_taken = [
            //                     'Disaster_Response_ID'  => $data['Disaster_Response_ID'],
            //                     'Action_Taken'       => $data['Action_Taken'][$i],
            //                 ];
            //             }

            //             DB::table('bdris_Disaster_Response_Action_Taken')->updateOrInsert(['Action_Taken_ID' => $id], $action_taken);
            //         }
            //     }
            // }

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

    //Response Information PDF
    public function viewResponse_InformationPDF(Request $request)
    {
        $details = DB::table('bdris_response_information as a')
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
            ->paginate(20, ['*'], 'details');

        $pdf = PDF::loadView('bdris_transactions.response_informationPDF', compact('details'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    //Display Response Information Attachment
    public function get_response_information_attachments(Request $request)
    {
        $id = $_GET['id'];
        $Disaster_Response = DB::table('bdris_file_attachment')
            ->where('Disaster_Response_ID', $id)
            ->get();
        return json_encode($Disaster_Response);
    }

    //Delete Response Information Attachment
    public function delete_response_information_attachments(Request $request)
    {
        $id = $_GET['id'];

        $fileinfo = DB::table('bdris_file_attachment')->where('Attachment_ID', $id)->get();
        if (File::exists('./files/uploads/response_information/' . $fileinfo[0]->File_Name)) {
            unlink(public_path('./files/uploads/response_information/' . $fileinfo[0]->File_Name));
        }
        DB::table('bdris_file_attachment')->where('Attachment_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    //Recovery Information List
    public function recovery_information_list(Request $request)
    {
        $currDATE = Carbon::now();

        if (Auth::user()->User_Type_ID == 1) {
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
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');


            return view('bdris_transactions.recovery_information_list', compact(
                'db_entries',
                'currDATE',

            ));
        } elseif (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4) {

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
                ->where('a.Region_ID', Auth::user()->Region_ID)
                ->paginate(20, ['*'], 'db_entries');
            $region1 = DB::table('maintenance_region')->where('Active', 1)->get();

            return view('bdris_transactions.recovery_information_list', compact(
                'db_entries',
                'currDATE',
                'region1',
            ));
        }
    }

    //Recovery Infomation Details
    public function recovery_information_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $response_information = DB::table('bdris_response_information')->paginate(20, ['*'], 'response_information');
            $household_profile = DB::table('bips_household_profile')->paginate(20, ['*'], 'household_profile');
            $level_of_damage = DB::table('maintenance_bdris_level_of_damage')->where('Active', 1)->get();
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
            $resident2 = DB::table('bips_brgy_inhabitants_information')->get();
            $casualty = DB::table('maintenance_bdris_casualty_status')->where('Active', 1)->get();

            return view('bdris_transactions.recovery_information', compact(
                'currDATE',
                'level_of_damage',
                'household_profile',
                'response_information',
                'resident',
                'casualty',
                'resident2',
                'region'
            ));
        } else {
            $recovery = DB::table('bdris_recovery_information')->where('Disaster_Recovery_ID', $id)->get();
            $attachment = DB::table('bdris_file_attachment')->where('Disaster_Recovery_ID', $id)->get();
            $affected = DB::table('bdris_affected_household_and_infra')->where('Disaster_Recovery_ID', $id)->get();
            $damage = DB::table('bdris_recovery_damage_loss')->where('Disaster_Recovery_ID', $id)->get();
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $recovery[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $recovery[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $recovery[0]->City_Municipality_ID)->get();
            $response_information = DB::table('bdris_response_information')->paginate(20, ['*'], 'response_information');
            $household_profile = DB::table('bips_household_profile')->paginate(20, ['*'], 'household_profile');
            $level_of_damage = DB::table('maintenance_bdris_level_of_damage')->where('Active', 1)->get();
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
            $resident2 = DB::table('bips_brgy_inhabitants_information')->get();
            $missing = DB::table('bdris_missing')->where('Disaster_Recovery_ID', $id)->get();
            $casualty = DB::table('maintenance_bdris_casualty_status')->where('Active', 1)->get();
            $injured = DB::table('bdris_casualties_and_injured as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_city_municipality as c', 'b.City_Municipality_ID', '=', 'c.City_Municipality_ID')
                ->leftjoin('maintenance_province as d', 'b.Province_ID', '=', 'd.Province_ID')
                ->leftjoin('maintenance_region as e', 'b.Region_ID', '=', 'e.Region_ID')
                ->leftjoin('maintenance_barangay as f', 'b.Barangay_ID', '=', 'f.Barangay_ID')
                ->select(
                    'a.Casualties_ID',
                    'a.Resident_ID',
                    'a.Residency_Status',
                    'a.Casualty_Status_ID',
                    'a.Disaster_Recovery_ID',
                    'a.Non_Resident_Name',
                    DB::raw('(CASE WHEN A.Resident_ID = 0 THEN a.Non_Resident_Birthdate ELSE b.Birthdate END) AS Non_Resident_Birthdate'),
                    DB::raw('(CASE WHEN A.Resident_ID = 0 THEN a.Non_Resident_Address ELSE concat(f.Barangay_Name, " ",c.City_Municipality_Name," ",d.Province_Name," ",e.Region_Name) END) AS Non_Resident_Address')
                )
                ->where('a.Disaster_Recovery_ID', $id)->get();
            $missing = DB::table('bdris_missing as a')
                ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
                ->leftjoin('maintenance_city_municipality as c', 'b.City_Municipality_ID', '=', 'c.City_Municipality_ID')
                ->leftjoin('maintenance_province as d', 'b.Province_ID', '=', 'd.Province_ID')
                ->leftjoin('maintenance_region as e', 'b.Region_ID', '=', 'e.Region_ID')
                ->leftjoin('maintenance_barangay as f', 'b.Barangay_ID', '=', 'f.Barangay_ID')
                ->select(
                    'a.Missing_ID',
                    'a.Resident_ID',
                    'a.Residency_Status',
                    'a.Disaster_Recovery_ID',
                    'a.Individual_Found',
                    'a.Date_Found',
                    'a.Non_Resident_Name',
                    DB::raw('(CASE WHEN A.Resident_ID = 0 THEN a.Non_Resident_Birthdate ELSE b.Birthdate END) AS Non_Resident_Birthdate'),
                    DB::raw('(CASE WHEN A.Resident_ID = 0 THEN a.Non_Resident_Address ELSE concat(f.Barangay_Name, " ",c.City_Municipality_Name," ",d.Province_Name," ",e.Region_Name) END) AS Non_Resident_Address')
                )
                ->where('a.Disaster_Recovery_ID', $id)->get();

            return view('bdris_transactions.recovery_information_edit', compact(
                'currDATE',
                'recovery',
                'attachment',
                'affected',
                'damage',
                'level_of_damage',
                'household_profile',
                'response_information',
                'region',
                'province',
                'city_municipality',
                'resident',
                'casualty',
                'injured',
                'resident2',
                'missing',
                'barangay'
            ));
        }
    }

    public function view_recovery_information_details($id)
    {
        $currDATE = Carbon::now();


        $recovery = DB::table('bdris_recovery_information')->where('Disaster_Recovery_ID', $id)->get();
        $attachment = DB::table('bdris_file_attachment')->where('Disaster_Recovery_ID', $id)->get();
        $affected = DB::table('bdris_affected_household_and_infra')->where('Disaster_Recovery_ID', $id)->get();
        $damage = DB::table('bdris_recovery_damage_loss')->where('Disaster_Recovery_ID', $id)->get();
        $region = DB::table('maintenance_region')->where('Active', 1)->get();
        $province = DB::table('maintenance_province')->where('Region_ID', $recovery[0]->Region_ID)->get();
        $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $recovery[0]->Province_ID)->get();
        $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $recovery[0]->City_Municipality_ID)->get();
        $response_information = DB::table('bdris_response_information')->paginate(20, ['*'], 'response_information');
        $household_profile = DB::table('bips_household_profile')->paginate(20, ['*'], 'household_profile');
        $level_of_damage = DB::table('maintenance_bdris_level_of_damage')->where('Active', 1)->get();
        $resident = DB::table('bips_brgy_inhabitants_information')->get();
        $resident2 = DB::table('bips_brgy_inhabitants_information')->get();
        // $missing = DB::table('bdris_missing')->where('Disaster_Recovery_ID', $id)->get();
        $casualty = DB::table('maintenance_bdris_casualty_status')->where('Active', 1)->get();
        $injured = DB::table('bdris_casualties_and_injured as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_city_municipality as c', 'b.City_Municipality_ID', '=', 'c.City_Municipality_ID')
            ->leftjoin('maintenance_province as d', 'b.Province_ID', '=', 'd.Province_ID')
            ->leftjoin('maintenance_region as e', 'b.Region_ID', '=', 'e.Region_ID')
            ->leftjoin('maintenance_barangay as f', 'b.Barangay_ID', '=', 'f.Barangay_ID')
            ->select(
                'a.Casualties_ID',
                'a.Resident_ID',
                'a.Residency_Status',
                'a.Casualty_Status_ID',
                'a.Disaster_Recovery_ID',
                'a.Non_Resident_Name',
                DB::raw('(CASE WHEN A.Resident_ID = 0 THEN a.Non_Resident_Birthdate ELSE b.Birthdate END) AS Non_Resident_Birthdate'),
                DB::raw('(CASE WHEN A.Resident_ID = 0 THEN a.Non_Resident_Address ELSE concat(f.Barangay_Name, " ",c.City_Municipality_Name," ",d.Province_Name," ",e.Region_Name) END) AS Non_Resident_Address')
            )
            ->where('a.Disaster_Recovery_ID', $id)->get();
        $missing = DB::table('bdris_missing as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_city_municipality as c', 'b.City_Municipality_ID', '=', 'c.City_Municipality_ID')
            ->leftjoin('maintenance_province as d', 'b.Province_ID', '=', 'd.Province_ID')
            ->leftjoin('maintenance_region as e', 'b.Region_ID', '=', 'e.Region_ID')
            ->leftjoin('maintenance_barangay as f', 'b.Barangay_ID', '=', 'f.Barangay_ID')
            ->select(
                'a.Missing_ID',
                'a.Resident_ID',
                'a.Residency_Status',
                'a.Disaster_Recovery_ID',
                'a.Individual_Found',
                'a.Date_Found',
                'a.Non_Resident_Name',
                DB::raw('(CASE WHEN A.Resident_ID = 0 THEN a.Non_Resident_Birthdate ELSE b.Birthdate END) AS Non_Resident_Birthdate'),
                DB::raw('(CASE WHEN A.Resident_ID = 0 THEN a.Non_Resident_Address ELSE concat(f.Barangay_Name, " ",c.City_Municipality_Name," ",d.Province_Name," ",e.Region_Name) END) AS Non_Resident_Address')
            )
            ->where('a.Disaster_Recovery_ID', $id)->get();

        return view('bdris_transactions.recovery_information_view', compact(
            'currDATE',
            'recovery',
            'attachment',
            'affected',
            'damage',
            'level_of_damage',
            'household_profile',
            'response_information',
            'region',
            'province',
            'city_municipality',
            'resident',
            'casualty',
            'injured',
            'resident2',
            'missing',
            'barangay'
        ));
    }

    //Save Recovery Information
    public function create_recovery_information(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        // dd($data);

        if ($data['Disaster_Recovery_ID'] == null || $data['Disaster_Recovery_ID'] == 0) {
            $Disaster_Recovery_ID = DB::table('bdris_recovery_information')->insertGetId(
                array(
                    'Disaster_Response_ID'              => $data['Disaster_Response_ID'],
                    'Barangay_ID'                       => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'              => Auth::user()->City_Municipality_ID,
                    'Province_ID'                       => Auth::user()->Province_ID,
                    'Region_ID'                         => Auth::user()->Region_ID,
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                )
            );

            DB::table('bdris_affected_household_and_infra')->where('Disaster_Recovery_ID', $Disaster_Recovery_ID)->delete();
            DB::table('bdris_recovery_damage_loss')->where('Disaster_Recovery_ID', $Disaster_Recovery_ID)->delete();
            DB::table('bdris_casualties_and_injured')->where('Disaster_Recovery_ID', $Disaster_Recovery_ID)->delete();
            DB::table('bdris_missing')->where('Disaster_Recovery_ID', $Disaster_Recovery_ID)->delete();

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


            if (isset($data['Livestock_Loss_Estimated_Value'])) {
                $recovery_damage_loss = [];

                for ($i = 0; $i < count($data['Livestock_Loss_Estimated_Value']); $i++) {
                    if ($data['Livestock_Loss_Estimated_Value'][$i] != NULL) {

                        $id = 0 + DB::table('bdris_recovery_damage_loss')->max('Recovery_Damage_Loss_ID');
                        $id += 1;

                        if ($data['Livestock_Loss_Estimated_Value'][$i] != null) {
                            $recovery_damage_loss = [
                                'Disaster_Recovery_ID'          => $Disaster_Recovery_ID,
                                'Livestock_Loss_Estimated_Value' => $data['Livestock_Loss_Estimated_Value'][$i],
                                'Poultry_Loss_Estimated_Value'  => $data['Poultry_Loss_Estimated_Value'][$i],
                                'Fisheries_Loss_Estimated_Value' => $data['Fisheries_Loss_Estimated_Value'][$i],
                                'Crops_Loss_Estimated_Value'    => $data['Crops_Loss_Estimated_Value'][$i],
                                'Encoder_ID'                    => Auth::user()->id,
                                'Date_Stamp'                    => Carbon::now()
                            ];
                        }

                        DB::table('bdris_recovery_damage_loss')->updateOrInsert(['Recovery_Damage_Loss_ID' => $id], $recovery_damage_loss);
                    }
                }
            }


            if (isset($data['Resident_ID'])) { //buban
                $resident_details = [];

                for ($i = 0; $i < count($data['Resident_ID']); $i++) {
                    if ($data['Resident_ID'][$i] != NULL) {
                        if (is_int($data['Resident_ID'][$i]) || ctype_digit($data['Resident_ID'][$i])) {
                            $id = 0 + DB::table('bdris_casualties_and_injured')->max('Casualties_ID');
                            $id += 1;

                            $resident_details = [
                                'Disaster_Recovery_ID' => $Disaster_Recovery_ID,
                                'Resident_ID' => $data['Resident_ID'][$i],
                                'Casualty_Status_ID' => $data['Casualty_Status_ID'][$i],
                                'Residency_Status' => (int)$data['Residency_Status'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        } else {
                            $id = 0 + DB::table('bdris_casualties_and_injured')->max('Casualties_ID');
                            $id += 1;

                            $resident_details = [
                                'Disaster_Recovery_ID' => $Disaster_Recovery_ID,
                                'Resident_ID' => 0,
                                'Casualty_Status_ID' => $data['Casualty_Status_ID'][$i],
                                'Residency_Status' => (int)$data['Residency_Status'][$i],
                                'Non_Resident_Name' => $data['Resident_ID'][$i],
                                'Non_Resident_Address' => $data['Non_Resident_Address'][$i],
                                'Non_Resident_Birthdate' => $data['Non_Resident_Birthdate'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        }
                        DB::table('bdris_casualties_and_injured')->insert($resident_details);
                    }
                }
            }


            if (isset($data['Resident_Missing_ID'])) {
                $resident_details2 = [];

                for ($i = 0; $i < count($data['Resident_Missing_ID']); $i++) {
                    if ($data['Resident_Missing_ID'][$i] != NULL) {
                        if (is_int($data['Resident_Missing_ID'][$i]) || ctype_digit($data['Resident_Missing_ID'][$i])) {
                            $id = 0 + DB::table('bdris_missing')->max('Missing_ID');
                            $id += 1;

                            $resident_details2 = [
                                'Disaster_Recovery_ID' => $Disaster_Recovery_ID,
                                'Resident_ID' => $data['Resident_Missing_ID'][$i],
                                'Residency_Status' => (int)$data['Residency_Missing_Status'][$i],
                                'Individual_Found' => (int)$data['Individual_Found'][$i],
                                'Date_Found' => $data['Date_Found'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        } else {
                            $id = 0 + DB::table('bdris_missing')->max('Missing_ID');
                            $id += 1;

                            $resident_details2 = [
                                'Disaster_Recovery_ID' => $Disaster_Recovery_ID,
                                'Resident_ID' => 0,
                                'Residency_Status' => (int)$data['Residency_Missing_Status'][$i],
                                'Non_Resident_Name' => $data['Resident_Missing_ID'][$i],
                                'Non_Resident_Address' => $data['Non_Resident_Missing_Address'][$i],
                                'Non_Resident_Birthdate' => $data['Non_Resident_Missing_Birthdate'][$i],
                                'Individual_Found' => (int)$data['Individual_Found'][$i],
                                'Date_Found' => $data['Date_Found'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        }
                        DB::table('bdris_missing')->insert($resident_details2);
                    }
                }
            }

            if ($request->hasfile('fileattach')) {
                foreach ($request->file('fileattach') as $file) {
                    $filename = $file->getClientOriginalName();
                    // $filename = pathinfo($fileinfo, PATHINFO_FILENAME);
                    $filePath = public_path() . '/files/uploads/recovery_information/';
                    $file->move($filePath, $filename);

                    $file_data = array(
                        'Disaster_Recovery_ID'  => $Disaster_Recovery_ID,
                        'File_Name'             => $filename,
                        'File_Location'         => $filePath,
                        'Encoder_ID'            => Auth::user()->id,
                        'Date_Stamp'            => Carbon::now()
                    );
                    DB::table('bdris_file_attachment')->insert($file_data);
                }
            }



            return redirect()->to('recovery_information_details/' . $Disaster_Recovery_ID)->with('message', 'New Recovery Information Created');
        } else {
            DB::table('bdris_recovery_information')->where('Disaster_Recovery_ID', $data['Disaster_Recovery_ID'])->update(
                array(
                    'Disaster_Response_ID'              => $data['Disaster_Response_ID'],
                    'Barangay_ID'                       => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'              => Auth::user()->City_Municipality_ID,
                    'Province_ID'                       => Auth::user()->Province_ID,
                    'Region_ID'                         => Auth::user()->Region_ID,
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                )
            );

            DB::table('bdris_affected_household_and_infra')->where('Disaster_Recovery_ID', $data['Disaster_Recovery_ID'])->delete();
            DB::table('bdris_recovery_damage_loss')->where('Disaster_Recovery_ID', $data['Disaster_Recovery_ID'])->delete();
            DB::table('bdris_casualties_and_injured')->where('Disaster_Recovery_ID', $data['Disaster_Recovery_ID'])->delete();
            DB::table('bdris_missing')->where('Disaster_Recovery_ID', $data['Disaster_Recovery_ID'])->delete();

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

            if (isset($data['Livestock_Loss_Estimated_Value'])) {
                $recovery_damage_loss = [];

                for ($i = 0; $i < count($data['Livestock_Loss_Estimated_Value']); $i++) {
                    if ($data['Livestock_Loss_Estimated_Value'][$i] != NULL) {

                        $id = 0 + DB::table('bdris_recovery_damage_loss')->max('Recovery_Damage_Loss_ID');
                        $id += 1;

                        if ($data['Livestock_Loss_Estimated_Value'][$i] != null) {
                            $recovery_damage_loss = [
                                'Disaster_Recovery_ID'          => $data['Disaster_Recovery_ID'],
                                'Livestock_Loss_Estimated_Value' => $data['Livestock_Loss_Estimated_Value'][$i],
                                'Poultry_Loss_Estimated_Value'  => $data['Poultry_Loss_Estimated_Value'][$i],
                                'Fisheries_Loss_Estimated_Value' => $data['Fisheries_Loss_Estimated_Value'][$i],
                                'Crops_Loss_Estimated_Value'    => $data['Crops_Loss_Estimated_Value'][$i],
                                'Encoder_ID'                    => Auth::user()->id,
                                'Date_Stamp'                    => Carbon::now()
                            ];
                        }

                        DB::table('bdris_recovery_damage_loss')->updateOrInsert(['Recovery_Damage_Loss_ID' => $id], $recovery_damage_loss);
                    }
                }
            }



            if (isset($data['Resident_ID'])) {
                $resident_details = [];

                for ($i = 0; $i < count($data['Resident_ID']); $i++) {
                    if ($data['Resident_ID'][$i] != NULL) {
                        if (is_int($data['Resident_ID'][$i]) || ctype_digit($data['Resident_ID'][$i])) {
                            $id = 0 + DB::table('bdris_casualties_and_injured')->max('Casualties_ID');
                            $id += 1;

                            $resident_details = [
                                'Disaster_Recovery_ID' => $data['Disaster_Recovery_ID'],
                                'Resident_ID' => $data['Resident_ID'][$i],
                                'Casualty_Status_ID' => $data['Casualty_Status_ID'][$i],
                                'Residency_Status' => (int)$data['Residency_Status'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        } else {
                            $id = 0 + DB::table('bdris_casualties_and_injured')->max('Casualties_ID');
                            $id += 1;

                            $resident_details = [
                                'Disaster_Recovery_ID' => $data['Disaster_Recovery_ID'],
                                'Resident_ID' => 0,
                                'Casualty_Status_ID' => $data['Casualty_Status_ID'][$i],
                                'Residency_Status' => (int)$data['Residency_Status'][$i],
                                'Non_Resident_Name' => $data['Resident_ID'][$i],
                                'Non_Resident_Address' => $data['Non_Resident_Address'][$i],
                                'Non_Resident_Birthdate' => $data['Non_Resident_Birthdate'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        }
                        DB::table('bdris_casualties_and_injured')->insert($resident_details);
                    }
                }
            }

            if (isset($data['Resident_Missing_ID'])) {
                $resident_details2 = [];

                for ($i = 0; $i < count($data['Resident_Missing_ID']); $i++) {
                    if ($data['Resident_Missing_ID'][$i] != NULL) {
                        if (is_int($data['Resident_Missing_ID'][$i]) || ctype_digit($data['Resident_Missing_ID'][$i])) {
                            $id = 0 + DB::table('bdris_missing')->max('Missing_ID');
                            $id += 1;

                            $resident_details2 = [
                                'Disaster_Recovery_ID' => $data['Disaster_Recovery_ID'],
                                'Resident_ID' => $data['Resident_Missing_ID'][$i],
                                'Residency_Status' => (int)$data['Residency_Missing_Status'][$i],
                                'Individual_Found' => (int)$data['Individual_Found'][$i],
                                'Date_Found' => $data['Date_Found'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        } else {
                            $id = 0 + DB::table('bdris_missing')->max('Missing_ID');
                            $id += 1;

                            $resident_details2 = [
                                'Disaster_Recovery_ID' => $data['Disaster_Recovery_ID'],
                                'Resident_ID' => 0,
                                'Residency_Status' => (int)$data['Residency_Missing_Status'][$i],
                                'Non_Resident_Name' => $data['Resident_Missing_ID'][$i],
                                'Non_Resident_Address' => $data['Non_Resident_Missing_Address'][$i],
                                'Non_Resident_Birthdate' => $data['Non_Resident_Missing_Birthdate'][$i],
                                'Individual_Found' => (int)$data['Individual_Found'][$i],
                                'Date_Found' => $data['Date_Found'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        }
                        DB::table('bdris_missing')->insert($resident_details2);
                    }
                }
            }

            if ($request->hasfile('fileattach')) {
                foreach ($request->file('fileattach') as $file) {
                    $filename = $file->getClientOriginalName();
                    // $filename = pathinfo($fileinfo, PATHINFO_FILENAME);
                    $filePath = public_path() . '/files/uploads/recovery_information/';
                    $file->move($filePath, $filename);

                    $file_data = array(
                        'Disaster_Recovery_ID'  => $data['Disaster_Recovery_ID'],
                        'File_Name'             => $filename,
                        'File_Location'         => $filePath,
                        'Encoder_ID'            => Auth::user()->id,
                        'Date_Stamp'            => Carbon::now()
                    );
                    DB::table('bdris_file_attachment')->insert($file_data);
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

    public function get_recovery_damage_loss(Request $request)
    {
        $id = $_GET['id'];
        $Recovery_Damage_Loss = DB::table('bdris_recovery_damage_loss as a')
            ->select(
                'a.Recovery_Damage_Loss_ID',
                'a.Disaster_Recovery_ID',
                'a.Livestock_Loss_Estimated_Value',
                'a.Poultry_Loss_Estimated_Value',
                'a.Fisheries_Loss_Estimated_Value',
                'a.Crops_Loss_Estimated_Value',
            )
            ->where('a.Disaster_Recovery_ID', $id)
            ->get();
        return json_encode($Recovery_Damage_Loss);
    }

    //Display Response Information Attachment
    public function get_recovery_information_attachments(Request $request)
    {
        $id = $_GET['id'];
        $Disaster_Recovery = DB::table('bdris_file_attachment')
            ->where('Disaster_Recovery_ID', $id)
            ->get();
        return json_encode($Disaster_Recovery);
    }

    //Delete Response Information Attachment
    public function delete_recovery_information_attachments(Request $request)
    {
        $id = $_GET['id'];

        $fileinfo = DB::table('bdris_file_attachment')->where('Attachment_ID', $id)->get();
        if (File::exists('./files/uploads/recovery_information/' . $fileinfo[0]->File_Name)) {
            unlink(public_path('./files/uploads/recovery_information/' . $fileinfo[0]->File_Name));
        }
        DB::table('bdris_file_attachment')->where('Attachment_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    //Disaster Related Activities List
    public function disaster_related_activities_list(Request $request)
    {
        $currDATE = Carbon::now();

        if (Auth::user()->User_Type_ID == 1) {
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
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');

            $brgy_officials_and_staff = DB::table('bips_brgy_officials_and_staff as aa')
                ->leftjoin('bips_brgy_inhabitants_information as bb', 'aa.Resident_ID', '=', 'bb.Resident_ID')
                ->select(
                    'aa.Resident_ID',
                    'bb.Last_Name',
                    'bb.First_Name',
                    'bb.Middle_Name',
                )
                ->paginate(20, ['*'], 'brgy_officials_and_staff');

            return view('bdris_transactions.disaster_related_activities_list', compact(
                'db_entries',
                'currDATE',
                'brgy_officials_and_staff',

            ));
        } elseif (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4) {

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
                ->where('a.Region_ID', Auth::user()->Region_ID)
                ->paginate(20, ['*'], 'db_entries');

            $region1 = DB::table('maintenance_region')->where('Active', 1)->get();
            $brgy_officials_and_staff = DB::table('bips_brgy_officials_and_staff as aa')
                ->leftjoin('bips_brgy_inhabitants_information as bb', 'aa.Resident_ID', '=', 'bb.Resident_ID')
                ->select(
                    'aa.Resident_ID',
                    'bb.Last_Name',
                    'bb.First_Name',
                    'bb.Middle_Name',
                )
                ->paginate(20, ['*'], 'brgy_officials_and_staff');

            return view('bdris_transactions.disaster_related_activities_list', compact(
                'db_entries',
                'currDATE',
                'brgy_officials_and_staff',
                'region1',

            ));
        }
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

                    'Barangay_ID'                       => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'              => Auth::user()->City_Municipality_ID,
                    'Province_ID'                       => Auth::user()->Province_ID,
                    'Region_ID'                         => Auth::user()->Region_ID,

                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                )
            );

            if ($request->hasfile('fileattach')) {
                foreach ($request->file('fileattach') as $file) {
                    $filename = $file->getClientOriginalName();
                    // $filename = pathinfo($fileinfo, PATHINFO_FILENAME);
                    $filePath = public_path() . '/files/uploads/disaster_related_activities/';
                    $file->move($filePath, $filename);

                    $file_data = array(
                        'Disaster_Related_Activities_ID' => $Disaster_Related_Activities_ID,
                        'File_Name'                     => $filename,
                        'File_Location'                 => $filePath,
                        'Encoder_ID'                    => Auth::user()->id,
                        'Date_Stamp'                    => Carbon::now()
                    );
                    DB::table('bdris_file_attachment')->insert($file_data);
                }
            }

            return redirect()->back()->with('message', 'New Entry Created');
        } else {
            DB::table('bdris_disaster_related_activities')->where('Disaster_Related_Activities_ID', $data['Disaster_Related_Activities_ID'])->update(
                array(
                    'Activity_Name'                     => $data['Activity_Name'],
                    'Purpose'                           => $data['Purpose'],
                    'Date_Start'                        => $data['Date_Start'],
                    'Date_End'                          => $data['Date_End'],
                    'Number_of_Participants'            => $data['Number_of_Participants'],

                    'Barangay_ID'                       => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'              => Auth::user()->City_Municipality_ID,
                    'Province_ID'                       => Auth::user()->Province_ID,
                    'Region_ID'                         => Auth::user()->Region_ID,
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                )
            );

            if ($request->hasfile('fileattach')) {
                foreach ($request->file('fileattach') as $file) {
                    $filename = $file->getClientOriginalName();
                    // $filename = pathinfo($fileinfo, PATHINFO_FILENAME);
                    $filePath = public_path() . '/files/uploads/disaster_related_activities/';
                    $file->move($filePath, $filename);

                    $file_data = array(
                        'Disaster_Related_Activities_ID'    => $data['Disaster_Related_Activities_ID'],
                        'File_Name'                         => $filename,
                        'File_Location'                     => $filePath,
                        'Encoder_ID'                        => Auth::user()->id,
                        'Date_Stamp'                        => Carbon::now()
                    );
                    DB::table('bdris_file_attachment')->insert($file_data);
                }
            }

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

    //Display Disaster Related Activities Attachment
    public function get_disaster_related_activities_attachments(Request $request)
    {
        $id = $_GET['id'];
        $Disaster_Related_Activties = DB::table('bdris_file_attachment')
            ->where('Disaster_Related_Activities_ID', $id)
            ->get();
        return json_encode($Disaster_Related_Activties);
    }

    //Delete Disaster Related Activities Attachment
    public function delete_disaster_related_activities_attachments(Request $request)
    {
        $id = $_GET['id'];

        $fileinfo = DB::table('bdris_file_attachment')->where('Attachment_ID', $id)->get();
        if (File::exists('./files/uploads/disaster_related_activities/' . $fileinfo[0]->File_Name)) {
            unlink(public_path('./files/uploads/disaster_related_activities/' . $fileinfo[0]->File_Name));
        }
        DB::table('bdris_file_attachment')->where('Attachment_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    //Disaster Related Activities PDF
    public function viewDisaster_Related_ActivitiesPDF(Request $request)
    {
        $details = DB::table('bdris_disaster_related_activities as a')
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
            ->paginate(20, ['*'], 'details');

        $pdf = PDF::loadView('bdris_transactions.disaster_related_activitiesPDF', compact('details'))->setPaper('a4', 'landscape');
        return $pdf->stream();
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
                'bb.Last_Name',
                'bb.First_Name',
                'bb.Middle_Name',
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

    //Disaster Supplies PDF
    public function viewDisaster_SuppliesPDF(Request $request)
    {
        $details = DB::table('bdris_disaster_supplies as a')
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
            ->paginate(20, ['*'], 'details');

        $pdf = PDF::loadView('bdris_transactions.disaster_suppliesPDF', compact('details'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function get_disastertype(Request $request)
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
                'b.Emergency_Evacuation_Site_Name',
                'c.Allocated_Fund_Name',
                'e.Emergency_Team_Name',
                'd.Emergency_Equipment_Name',
                DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

            )
            ->where('Disaster_Type_ID', $id)->get();

        return (compact('theEntry'));
    }

    public function disastertype_downloadPDF(Request $request)
    {
        // $id = $_GET['id'];
        $data = request()->all();


        $chk_Disaster_Type = isset($data['chk_Disaster_Type']) ? 1 : 0;
        $chk_Emergency_Evacuation_Site_Name = isset($data['chk_Emergency_Evacuation_Site_Name']) ? 1 : 0;
        $chk_Allocated_Fund_Name = isset($data['chk_Allocated_Fund_Name']) ? 1 : 0;
        $chk_Emergency_Team_Name = isset($data['chk_Emergency_Team_Name']) ? 1 : 0;
        $chk_Emergency_Equipment_Name = isset($data['chk_Emergency_Equipment_Name']) ? 1 : 0;
        $chk_Active = isset($data['chk_Active']) ? 1 : 0;

        $db_entries = DB::table('maintenance_bdris_disaster_type as a')
            ->leftjoin('bdris_emergency_evacuation_site as b', 'a.Emergency_Evacuation_Site_ID', '=', 'b.Emergency_Evacuation_Site_ID')
            ->leftjoin('bdris_allocated_fund_source as c', 'a.Allocated_Fund_ID', '=', 'c.Allocated_Fund_ID')
            ->leftjoin('bdris_emergency_equipment as d', 'a.Emergency_Equipment_ID', '=', 'd.Emergency_Equipment_ID')
            ->leftjoin('bdris_emergency_team as e', 'a.Emergency_Team_ID', '=', 'e.Emergency_Team_ID')
            ->select(
                'a.Disaster_Type_ID',
                'a.Disaster_Type',
                'b.Emergency_Evacuation_Site_Name',
                'c.Allocated_Fund_Name',
                'e.Emergency_Team_Name',
                'd.Emergency_Equipment_Name',
                DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

            )
            // ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->paginate(20, ['*'], 'details');

        //dd($detail);

        $pdf = PDF::loadView('bdris_transactions.disaster_type_List_PDF', compact(
            'chk_Disaster_Type',
            'chk_Emergency_Evacuation_Site_Name',
            'chk_Allocated_Fund_Name',
            'chk_Emergency_Team_Name',
            'chk_Emergency_Equipment_Name',
            'chk_Active',
            'db_entries',
        ))->setPaper('a4', 'landscape');
        $daFileNeym = "Disaster_Type_List.pdf";
        return $pdf->download($daFileNeym);
    }

    public function get_emerevacsite(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('bdris_emergency_evacuation_site as a')
            ->select(
                'a.Emergency_Evacuation_Site_ID',
                'a.Emergency_Evacuation_Site_Name',
                'a.Address',
                'a.Capacity',
                DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

            )
            ->where('Emergency_Evacuation_Site_ID', $id)->get();

        return (compact('theEntry'));
    }

    public function emerevac_downloadPDF(Request $request)
    {
        // $id = $_GET['id'];
        $data = request()->all();


        $chk_Emergency_Evacuation_Site_Name = isset($data['chk_Emergency_Evacuation_Site_Name']) ? 1 : 0;
        $chk_Address = isset($data['chk_Address']) ? 1 : 0;
        $chk_Capacity = isset($data['chk_Capacity']) ? 1 : 0;
        $chk_Active = isset($data['chk_Active']) ? 1 : 0;

        $db_entries = DB::table('bdris_emergency_evacuation_site as a')
            ->select(
                'a.Emergency_Evacuation_Site_ID',
                'a.Emergency_Evacuation_Site_Name',
                'a.Address',
                'a.Capacity',
                DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

            )
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->paginate(20, ['*'], 'details');

        //dd($detail);

        $pdf = PDF::loadView('bdris_transactions.emerevac_List_PDF', compact(
            'chk_Emergency_Evacuation_Site_Name',
            'chk_Address',
            'chk_Capacity',
            'chk_Active',
            'db_entries',
        ))->setPaper('a4', 'landscape');
        $daFileNeym = "Emergency_Evacuation_Site_List.pdf";
        return $pdf->download($daFileNeym);
    }

    public function get_allofund(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('bdris_allocated_fund_source as a')
            ->select(
                'a.Allocated_Fund_ID',
                'a.Allocated_Fund_Name',
                'a.Amount',
                DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

            )
            ->where('Allocated_Fund_ID', $id)->get();

        return (compact('theEntry'));
    }

    public function allofund_downloadPDF(Request $request)
    {
        // $id = $_GET['id'];
        $data = request()->all();


        $chk_Allocated_Fund_Name = isset($data['chk_Allocated_Fund_Name']) ? 1 : 0;
        $chk_Amount = isset($data['chk_Amount']) ? 1 : 0;
        $chk_Active = isset($data['chk_Active']) ? 1 : 0;

        $db_entries = DB::table('bdris_allocated_fund_source as a')
            ->select(
                'a.Allocated_Fund_ID',
                'a.Allocated_Fund_Name',
                'a.Amount',
                DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

            )
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->paginate(20, ['*'], 'details');

        //dd($detail);

        $pdf = PDF::loadView('bdris_transactions.allofund_List_PDF', compact(
            'chk_Allocated_Fund_Name',
            'chk_Amount',
            'chk_Active',
            'db_entries',
        ))->setPaper('a4', 'landscape');
        $daFileNeym = "Allocated_Fund_List.pdf";
        return $pdf->download($daFileNeym);
    }


    public function get_dissupp(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('bdris_disaster_supplies as a')
            ->leftjoin('bips_brgy_officials_and_staff as f', 'a.Brgy_Officials_and_Staff_ID', '=', 'f.Brgy_Officials_and_Staff_ID')
            ->leftjoin('bips_brgy_inhabitants_information as g', 'g.Resident_ID', '=', 'f.Resident_ID')
            ->leftjoin('bdris_response_information as h', 'h.Disaster_Response_ID', '=', 'a.Disaster_Response_ID')
            ->select(
                'a.Disaster_Supplies_ID',
                'a.Disaster_Supplies_Name',
                'a.Disaster_Supplies_Quantity',
                'a.Location',
                'a.Remarks',
                'h.Disaster_Name',
                DB::raw('CONCAT(g.First_Name, " ",LEFT(g.Middle_Name,1),". ",g.Last_Name) AS Resident_Name'),
                DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),

            )
            ->where('Disaster_Supplies_ID', $id)->get();

        return (compact('theEntry'));
    }

    public function dissupp_downloadPDF(Request $request)
    {
        // $id = $_GET['id'];
        $data = request()->all();

        $chk_Disaster_Supplies_Name = isset($data['chk_Disaster_Supplies_Name']) ? 1 : 0;
        $chk_Disaster_Supplies_Quantity = isset($data['chk_Disaster_Supplies_Quantity']) ? 1 : 0;
        $chk_Location = isset($data['chk_Location']) ? 1 : 0;
        $chk_Remarks = isset($data['chk_Remarks']) ? 1 : 0;
        $chk_Disaster_Name = isset($data['chk_Disaster_Name']) ? 1 : 0;
        $chk_Resident_Name = isset($data['chk_Resident_Name']) ? 1 : 0;
        $chk_Active = isset($data['chk_Active']) ? 1 : 0;

        $db_entries = DB::table('bdris_disaster_supplies as a')
            ->leftjoin('bips_brgy_officials_and_staff as f', 'a.Brgy_Officials_and_Staff_ID', '=', 'f.Brgy_Officials_and_Staff_ID')
            ->leftjoin('bips_brgy_inhabitants_information as g', 'g.Resident_ID', '=', 'f.Resident_ID')
            ->leftjoin('bdris_response_information as h', 'h.Disaster_Response_ID', '=', 'a.Disaster_Response_ID')
            ->select(
                'a.Disaster_Supplies_ID',
                'a.Disaster_Supplies_Name',
                'a.Disaster_Supplies_Quantity',
                'a.Location',
                'a.Remarks',
                'h.Disaster_Name',
                DB::raw('CONCAT(g.First_Name, " ",LEFT(g.Middle_Name,1),". ",g.Last_Name) AS Resident_Name'),
                DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),

            )
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->paginate(20, ['*'], 'details');

        //dd($detail);

        $pdf = PDF::loadView('bdris_transactions.dissupp_List_PDF', compact(
            'chk_Disaster_Supplies_Name',
            'chk_Disaster_Supplies_Quantity',
            'chk_Location',
            'chk_Remarks',
            'chk_Disaster_Name',
            'chk_Resident_Name',
            'chk_Active',
            'db_entries',
        ))->setPaper('a4', 'landscape');
        $daFileNeym = "Disaster_Supplies_List.pdf";
        return $pdf->download($daFileNeym);
    }


    public function get_emerteam(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('bdris_emergency_team as a')
            ->select(
                'a.Emergency_Team_ID',
                'a.Emergency_Team_Name',
                'a.Emergency_Team_Hotline',
                DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

            )
            ->where('Emergency_Team_ID', $id)->get();

        return (compact('theEntry'));
    }

    public function emerteam_downloadPDF(Request $request)
    {
        // $id = $_GET['id'];
        $data = request()->all();


        $chk_Emergency_Team_Name = isset($data['chk_Emergency_Team_Name']) ? 1 : 0;
        $chk_Emergency_Team_Hotline = isset($data['chk_Emergency_Team_Hotline']) ? 1 : 0;
        $chk_Active = isset($data['chk_Active']) ? 1 : 0;

        $db_entries = DB::table('bdris_emergency_team as a')
            ->select(
                'a.Emergency_Team_ID',
                'a.Emergency_Team_Name',
                'a.Emergency_Team_Hotline',
                DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

            )
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->paginate(20, ['*'], 'details');

        //dd($detail);

        $pdf = PDF::loadView('bdris_transactions.emerteam_List_PDF', compact(
            'chk_Emergency_Team_Name',
            'chk_Emergency_Team_Hotline',
            'chk_Active',
            'db_entries',
        ))->setPaper('a4', 'landscape');
        $daFileNeym = "Emergency_Team_List.pdf";
        return $pdf->download($daFileNeym);
    }


    public function get_emerequip(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('bdris_emergency_equipment as a')
            ->select(
                'a.Emergency_Equipment_ID',
                'a.Emergency_Equipment_Name',
                'a.Location',
                DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

            )
            ->where('Emergency_Equipment_ID', $id)->get();

        return (compact('theEntry'));
    }

    public function emerequip_downloadPDF(Request $request)
    {
        // $id = $_GET['id'];
        $data = request()->all();

        $chk_Emergency_Equipment_Name = isset($data['chk_Emergency_Equipment_Name']) ? 1 : 0;
        $chk_Location = isset($data['chk_Location']) ? 1 : 0;
        $chk_Active = isset($data['chk_Active']) ? 1 : 0;

        $db_entries = DB::table('bdris_emergency_equipment as a')
            ->select(
                'a.Emergency_Equipment_ID',
                'a.Emergency_Equipment_Name',
                'a.Location',
                DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

            )
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->paginate(20, ['*'], 'details');

        //dd($detail);

        $pdf = PDF::loadView('bdris_transactions.emerequip_List_PDF', compact(
            'chk_Emergency_Equipment_Name',
            'chk_Location',
            'chk_Active',
            'db_entries',
        ))->setPaper('a4', 'landscape');
        $daFileNeym = "Emergency_Equipment_List.pdf";
        return $pdf->download($daFileNeym);
    }

    //OTHER TRANSACTION 
    public function other_transaction_list(Request $request)
    {
        $currDATE = Carbon::now();
        //DISASTER TYPE
        if (Auth::user()->User_Type_ID == 1) {
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
                    DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

                )
                ->paginate(20, ['*'], 'db_entries');
            //DISASTER TYPE

            //EMERGENCY EVACUATION SITE
            $db_entries2 = DB::table('bdris_emergency_evacuation_site as a')
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
                    DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

                )
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries2');
            //EMERGENCY EVACUATION SITE

            //ALLOCATED FUND
            $db_entries3 = DB::table('bdris_allocated_fund_source as a')
                ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
                ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
                ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
                ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
                ->select(
                    'a.Allocated_Fund_ID',
                    'a.Allocated_Fund_Name',
                    'a.Amount',
                    'a.Region_ID',
                    'b.Region_Name',
                    'a.Province_ID',
                    'c.Province_Name',
                    'a.Barangay_ID',
                    'e.Barangay_Name',
                    'a.City_Municipality_ID',
                    'd.City_Municipality_Name',
                    DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

                )
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');
            //ALLOCATED FUND        

            //Disaster SUpplies
            $db_entries4 = DB::table('bdris_disaster_supplies as a')
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
                    DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

                )
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries4');
            //Disaster SUpplies

            //EMERGENCY TEAM
            $db_entries5 = DB::table('bdris_emergency_team as a')
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
                    DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

                )
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries5');
            //EMERGENCY TEAM

            //EMERGENCY EQUIPMENT
            $db_entries6 = DB::table('bdris_emergency_equipment as a')
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
                    DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

                )
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries6');
            //EMERGENCY EQUIPMENT



            return view('bdris_transactions.other_transaction_list', compact(
                'db_entries',
                'db_entries2',
                'db_entries3',
                'db_entries4',
                'db_entries5',
                'db_entries6',
                'currDATE',

            ));
        } elseif (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4) {

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
                    DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),

                )
                ->paginate(20, ['*'], 'db_entries');
            //DISASTER TYPE

            //EMERGENCY EVACUATION SITE
            $db_entries2 = DB::table('bdris_emergency_evacuation_site as a')
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
                    DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),

                )
                ->where('a.Region_ID', Auth::user()->Region_ID)
                ->paginate(20, ['*'], 'db_entries2');
            //EMERGENCY EVACUATION SITE

            //ALLOCATED FUND
            $db_entries3 = DB::table('bdris_allocated_fund_source as a')
                ->select(
                    'a.Allocated_Fund_ID',
                    'a.Allocated_Fund_Name',
                    'a.Amount',
                    'a.Region_ID',
                    'b.Region_Name',
                    'a.Province_ID',
                    'c.Province_Name',
                    'a.Barangay_ID',
                    'e.Barangay_Name',
                    'a.City_Municipality_ID',
                    'd.City_Municipality_Name',
                    DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),

                )
                ->where('a.Region_ID', Auth::user()->Region_ID)
                ->paginate(20, ['*'], 'db_entries');
            //ALLOCATED FUND        

            //Disaster SUpplies
            $db_entries4 = DB::table('bdris_disaster_supplies as a')
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
                    DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),

                )
                ->where('a.Region_ID', Auth::user()->Region_ID)
                ->paginate(20, ['*'], 'db_entries4');
            //Disaster SUpplies

            //EMERGENCY TEAM
            $db_entries5 = DB::table('bdris_emergency_team as a')
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
                    DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),

                )
                ->where('a.Region_ID', Auth::user()->Region_ID)
                ->paginate(20, ['*'], 'db_entries5');
            //EMERGENCY TEAM

            //EMERGENCY EQUIPMENT
            $db_entries6 = DB::table('bdris_emergency_equipment as a')
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
                    DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),

                )
                ->where('a.Region_ID', Auth::user()->Region_ID)
                ->paginate(20, ['*'], 'db_entries6');
            //EMERGENCY EQUIPMENT

            $region1 = DB::table('maintenance_region')->where('Active', 1)->get();

            return view('bdris_transactions.other_transaction_list', compact(
                'db_entries',
                'db_entries2',
                'db_entries3',
                'db_entries4',
                'db_entries5',
                'db_entries6',
                'currDATE',
                'region1',

            ));
        }
    }

    //OTHER TRANSACTION DISASTER TYPE LIST
    //DISASTER TYPE
    public function disaster_type_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $emergency_evacuation_site = DB::table('bdris_emergency_evacuation_site')->paginate(20, ['*'], 'Emergency_evacuation_site');
            $allocated_fund = DB::table('bdris_allocated_fund_source')->paginate(20, ['*'], 'allocated_fund');
            $emergency_equipment = DB::table('bdris_emergency_equipment')->paginate(20, ['*'], 'emergency_equipment');
            $emergency_team = DB::table('bdris_emergency_team')->paginate(20, ['*'], 'emergency_team');


            return view('bdris_transactions.disaster_type', compact(
                'currDATE',
                'emergency_evacuation_site',
                'allocated_fund',
                'emergency_equipment',
                'emergency_team',

            ));
        } else {
            $disaster_type = DB::table('maintenance_bdris_disaster_type')->where('Disaster_Type_ID', $id)->get();
            $emergency_evacuation_site = DB::table('bdris_emergency_evacuation_site')->paginate(20, ['*'], 'Emergency_evacuation_site');
            $allocated_fund = DB::table('bdris_allocated_fund_source')->paginate(20, ['*'], 'allocated_fund');
            $emergency_equipment = DB::table('bdris_emergency_equipment')->paginate(20, ['*'], 'emergency_equipment');
            $emergency_team = DB::table('bdris_emergency_team')->paginate(20, ['*'], 'emergency_team');
            return view('bdris_transactions.disaster_type_edit', compact(
                'currDATE',
                'disaster_type',
                'emergency_evacuation_site',
                'allocated_fund',
                'emergency_equipment',
                'emergency_team',

            ));
        }
    }

    //DISASTER TYPE VIEW
    public function view_disaster_type_details($id)
    {
        $currDATE = Carbon::now();


        $disaster_type = DB::table('maintenance_bdris_disaster_type')->where('Disaster_Type_ID', $id)->get();
        $emergency_evacuation_site = DB::table('bdris_emergency_evacuation_site')->paginate(20, ['*'], 'Emergency_evacuation_site');
        $allocated_fund = DB::table('bdris_allocated_fund_source')->paginate(20, ['*'], 'allocated_fund');
        $emergency_equipment = DB::table('bdris_emergency_equipment')->paginate(20, ['*'], 'emergency_equipment');
        $emergency_team = DB::table('bdris_emergency_team')->paginate(20, ['*'], 'emergency_team');
        return view('bdris_transactions.disaster_type_view', compact(
            'currDATE',
            'disaster_type',
            'emergency_evacuation_site',
            'allocated_fund',
            'emergency_equipment',
            'emergency_team',

        ));
    }
    //DISASTER TYPE
    //EVACUATION SITE
    public function emergency_evacuation_site_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            return view('bdris_transactions.emergency_evacuation_site', compact(
                'currDATE',
                'region',


            ));
        } else {
            $emergency_evacuation = DB::table('bdris_emergency_evacuation_site')->where('Emergency_Evacuation_Site_ID', $id)->get();
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $emergency_evacuation[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $emergency_evacuation[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $emergency_evacuation[0]->City_Municipality_ID)->get();
            return view('bdris_transactions.emergency_evacuation_site_edit', compact(
                'currDATE',
                'emergency_evacuation',
                'region',
                'province',
                'city_municipality',
                'barangay',

            ));
        }
    }

    public function view_emergency_evacuation_site_details($id)
    {
        $currDATE = Carbon::now();


        $emergency_evacuation = DB::table('bdris_emergency_evacuation_site')->where('Emergency_Evacuation_Site_ID', $id)->get();
        $region = DB::table('maintenance_region')->where('Active', 1)->get();
        $province = DB::table('maintenance_province')->where('Region_ID', $emergency_evacuation[0]->Region_ID)->get();
        $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $emergency_evacuation[0]->Province_ID)->get();
        $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $emergency_evacuation[0]->City_Municipality_ID)->get();
        return view('bdris_transactions.emergency_evacuation_site_view', compact(
            'currDATE',
            'emergency_evacuation',
            'region',
            'province',
            'city_municipality',
            'barangay',

        ));
    }
    //EVACUATION SITE

    //ALLOCATED FUND
    public function allocated_fund_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {

            return view('bdris_transactions.allocated_fund', compact(
                'currDATE',

            ));
        } else {
            $allocated_fund = DB::table('bdris_allocated_fund_source')->where('Allocated_Fund_ID', $id)->get();

            return view('bdris_transactions.allocated_fund_edit', compact(
                'currDATE',
                'allocated_fund',


            ));
        }
    }

    public function view_allocated_fund_details($id)
    {
        $currDATE = Carbon::now();


        $allocated_fund = DB::table('bdris_allocated_fund_source')->where('Allocated_Fund_ID', $id)->get();

        return view('bdris_transactions.allocated_fund_edit', compact(
            'currDATE',
            'allocated_fund',


        ));
    }
    //ALLOCATED FUND

    //Disaster Supplies
    public function disaster_supplies_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            $disaster_response = DB::table('bdris_response_information')->paginate(20, ['*'], 'disaster_response');
            $brgy_officials_and_staff = DB::table('bips_brgy_officials_and_staff as aa')
                ->leftjoin('bips_brgy_inhabitants_information as bb', 'aa.Resident_ID', '=', 'bb.Resident_ID')
                ->select(
                    'aa.Resident_ID',
                    'bb.Last_Name',
                    'bb.First_Name',
                    'bb.Middle_Name',
                )
                ->paginate(20, ['*'], 'brgy_officials_and_staff');

            return view('bdris_transactions.disaster_supplies', compact(
                'region',
                'disaster_response',
                'brgy_officials_and_staff',
                'currDATE',

            ));
        } else {
            $disaster_supplies = DB::table('bdris_disaster_supplies')->where('Disaster_Supplies_ID', $id)->get();
            $disaster_response = DB::table('bdris_response_information')->paginate(20, ['*'], 'disaster_response');
            $brgy_officials_and_staff = DB::table('bips_brgy_officials_and_staff as aa')
                ->leftjoin('bips_brgy_inhabitants_information as bb', 'aa.Resident_ID', '=', 'bb.Resident_ID')
                ->select(
                    'aa.Resident_ID',
                    'bb.Last_Name',
                    'bb.First_Name',
                    'bb.Middle_Name',
                )
                ->paginate(20, ['*'], 'brgy_officials_and_staff');
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $disaster_supplies[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $disaster_supplies[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $disaster_supplies[0]->City_Municipality_ID)->get();

            return view('bdris_transactions.disaster_supplies_edit', compact(
                'currDATE',
                'disaster_supplies',
                'disaster_response',
                'brgy_officials_and_staff',
                'region',
                'province',
                'city_municipality',
                'barangay',


            ));
        }
    }

    public function view_disaster_supplies_details($id)
    {
        $currDATE = Carbon::now();


        $disaster_supplies = DB::table('bdris_disaster_supplies')->where('Disaster_Supplies_ID', $id)->get();
        $disaster_response = DB::table('bdris_response_information')->paginate(20, ['*'], 'disaster_response');
        $brgy_officials_and_staff = DB::table('bips_brgy_officials_and_staff as aa')
            ->leftjoin('bips_brgy_inhabitants_information as bb', 'aa.Resident_ID', '=', 'bb.Resident_ID')
            ->select(
                'aa.Resident_ID',
                'bb.Last_Name',
                'bb.First_Name',
                'bb.Middle_Name',
            )
            ->paginate(20, ['*'], 'brgy_officials_and_staff');
        $region = DB::table('maintenance_region')->where('Active', 1)->get();
        $province = DB::table('maintenance_province')->where('Region_ID', $disaster_supplies[0]->Region_ID)->get();
        $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $disaster_supplies[0]->Province_ID)->get();
        $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $disaster_supplies[0]->City_Municipality_ID)->get();

        return view('bdris_transactions.disaster_supplies_view', compact(
            'currDATE',
            'disaster_supplies',
            'disaster_response',
            'brgy_officials_and_staff',
            'region',
            'province',
            'city_municipality',
            'barangay',


        ));
    }
    //Disaster Supplies

    //EMERGENCY TEAM
    public function emergency_team_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            return view('bdris_transactions.emergency_team', compact(
                'currDATE',
                'region',


            ));
        } else {
            $emergency_team = DB::table('bdris_emergency_team')->where('Emergency_Team_ID', $id)->get();
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $emergency_team[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $emergency_team[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $emergency_team[0]->City_Municipality_ID)->get();
            return view('bdris_transactions.emergency_team_edit', compact(
                'currDATE',
                'emergency_team',
                'region',
                'province',
                'city_municipality',
                'barangay',

            ));
        }
    }

    public function view_emergency_team_details($id)
    {
        $currDATE = Carbon::now();


        $emergency_team = DB::table('bdris_emergency_team')->where('Emergency_Team_ID', $id)->get();
        $region = DB::table('maintenance_region')->where('Active', 1)->get();
        $province = DB::table('maintenance_province')->where('Region_ID', $emergency_team[0]->Region_ID)->get();
        $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $emergency_team[0]->Province_ID)->get();
        $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $emergency_team[0]->City_Municipality_ID)->get();
        return view('bdris_transactions.emergency_team_view', compact(
            'currDATE',
            'emergency_team',
            'region',
            'province',
            'city_municipality',
            'barangay',

        ));
    }
    //EMERGENCY TEAM

    //EMERGENCY EQUIPMENT
    public function emergency_equipment_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            return view('bdris_transactions.emergency_equipment', compact(
                'currDATE',
                'region',


            ));
        } else {
            $emergency_equipment = DB::table('bdris_emergency_equipment')->where('Emergency_Equipment_ID', $id)->get();
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $emergency_equipment[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $emergency_equipment[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $emergency_equipment[0]->City_Municipality_ID)->get();
            return view('bdris_transactions.emergency_equipment_edit', compact(
                'currDATE',
                'emergency_equipment',
                'region',
                'province',
                'city_municipality',
                'barangay',

            ));
        }
    }

    public function view_emergency_equipment_details($id)
    {
        $currDATE = Carbon::now();


        $emergency_equipment = DB::table('bdris_emergency_equipment')->where('Emergency_Equipment_ID', $id)->get();
        $region = DB::table('maintenance_region')->where('Active', 1)->get();
        $province = DB::table('maintenance_province')->where('Region_ID', $emergency_equipment[0]->Region_ID)->get();
        $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $emergency_equipment[0]->Province_ID)->get();
        $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $emergency_equipment[0]->City_Municipality_ID)->get();
        return view('bdris_transactions.emergency_equipment_view', compact(
            'currDATE',
            'emergency_equipment',
            'region',
            'province',
            'city_municipality',
            'barangay',

        ));
    }
    //EMERGENCY EQUIPMENT



    //OTHER TRANSACTION SAVING
    //DISASTER TYPE
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

            return redirect()->to('disaster_type_details/' . $Disaster_Type_ID)->with('message', 'New Recovery Information Created');
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



            return redirect()->back()->with('message', 'Response Information Updated');
        }
    }
    //DISASTER TYPE
    // Emergency Evacuation Site
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
                    'Barangay_ID'                       => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'              => Auth::user()->City_Municipality_ID,
                    'Province_ID'                       => Auth::user()->Province_ID,
                    'Region_ID'                         => Auth::user()->Region_ID,

                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                    'Active'                            => (int)$data['Active']
                )
            );

            return redirect()->to('emergency_evacuation_site_details/' . $Emergency_Evacuation_Site_ID)->with('message', 'Emergency Evacuation Site Created');
        } else {
            DB::table('bdris_emergency_evacuation_site')->where('Emergency_Evacuation_Site_ID', $data['Emergency_Evacuation_Site_ID'])->update(
                array(
                    'Emergency_Evacuation_Site_Name'    => $data['Emergency_Evacuation_Site_Name'],
                    'Address'                           => $data['Address'],
                    'Capacity'                          => $data['Capacity'],
                    'Barangay_ID'                       => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'              => Auth::user()->City_Municipality_ID,
                    'Province_ID'                       => Auth::user()->Province_ID,
                    'Region_ID'                         => Auth::user()->Region_ID,
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                    'Active'                            => (int)$data['Active']
                )
            );

            return redirect()->back()->with('message', 'Emergency Evacuation Site Info Updated');
        }
    }
    // Emergency Evacuation Site

    //  Allocated Fund Source
    public function create_allocated_fund_source(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Allocated_Fund_ID'] == null || $data['Allocated_Fund_ID'] == 0) {
            $Allocated_Fund_ID = DB::table('bdris_allocated_fund_source')->insertGetId(
                array(
                    'Allocated_Fund_Name'  => $data['Allocated_Fund_Name'],
                    'Amount'               => $data['Amount'],
                    'Barangay_ID'           => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'  => Auth::user()->City_Municipality_ID,
                    'Province_ID'           => Auth::user()->Province_ID,
                    'Region_ID'             => Auth::user()->Region_ID,
                    'Encoder_ID'           => Auth::user()->id,
                    'Date_Stamp'           => Carbon::now(),
                    'Active'               => (int)$data['Active']
                )
            );

            return redirect()->to('allocated_fund_details/' . $Allocated_Fund_ID)->with('message', 'New Recovery Information Created');
        } else {
            DB::table('bdris_allocated_fund_source')->where('Allocated_Fund_ID', $data['Allocated_Fund_ID'])->update(
                array(
                    'Allocated_Fund_Name'  => $data['Allocated_Fund_Name'],
                    'Amount'               => $data['Amount'],
                    'Barangay_ID'           => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'  => Auth::user()->City_Municipality_ID,
                    'Province_ID'           => Auth::user()->Province_ID,
                    'Region_ID'             => Auth::user()->Region_ID,
                    'Encoder_ID'           => Auth::user()->id,
                    'Date_Stamp'           => Carbon::now(),
                    'Active'               => (int)$data['Active']
                )
            );

            return redirect()->back()->with('message', 'Allocated Fund Source info Updated');
        }
    }
    //  Allocated Fund Source

    // Disaster Suuplies
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
                    'Brgy_Officials_and_Staff_ID'       => $data['Brgy_Officials_and_Staff_ID'],
                    'Barangay_ID'                       => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'              => Auth::user()->City_Municipality_ID,
                    'Province_ID'                       => Auth::user()->Province_ID,
                    'Region_ID'                         => Auth::user()->Region_ID,
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                    'Active'                            => (int)$data['Active']
                )
            );

            return redirect()->to('disaster_supplies_details/' . $Disaster_Supplies_ID)->with('message', 'New Disaster Supplies Information Created');
        } else {
            DB::table('bdris_disaster_supplies')->where('Disaster_Supplies_ID', $data['Disaster_Supplies_ID'])->update(
                array(
                    'Disaster_Response_ID'              => $data['Disaster_Response_ID'],
                    'Disaster_Supplies_Name'            => $data['Disaster_Supplies_Name'],
                    'Disaster_Supplies_Quantity'        => $data['Disaster_Supplies_Quantity'],
                    'Location'                          => $data['Location'],
                    'Remarks'                           => $data['Remarks'],
                    'Brgy_Officials_and_Staff_ID'       => $data['Brgy_Officials_and_Staff_ID'],
                    'Barangay_ID'                       => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'              => Auth::user()->City_Municipality_ID,
                    'Province_ID'                       => Auth::user()->Province_ID,
                    'Region_ID'                         => Auth::user()->Region_ID,
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                    'Active'                            => (int)$data['Active']
                )
            );

            return redirect()->back()->with('message', 'Disaster Supplies Info Updated');
        }
    }
    // Disaster Suuplies

    // Emergency Team
    public function create_emergency_team(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Emergency_Team_ID'] == null || $data['Emergency_Team_ID'] == 0) {
            $Emergency_Team_ID = DB::table('bdris_emergency_team')->insertGetId(
                array(
                    'Emergency_Team_Name'               => $data['Emergency_Team_Name'],
                    'Emergency_Team_Hotline'            => $data['Emergency_Team_Hotline'],
                    'Barangay_ID'                       => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'              => Auth::user()->City_Municipality_ID,
                    'Province_ID'                       => Auth::user()->Province_ID,
                    'Region_ID'                         => Auth::user()->Region_ID,
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                    'Active'                            => (int)$data['Active']
                )
            );

            return redirect()->to('emergency_team_details/' . $Emergency_Team_ID)->with('message', 'New Emergency Team Information Created');
        } else {
            DB::table('bdris_emergency_team')->where('Emergency_Team_ID', $data['Emergency_Team_ID'])->update(
                array(
                    'Emergency_Team_Name'               => $data['Emergency_Team_Name'],
                    'Emergency_Team_Hotline'            => $data['Emergency_Team_Hotline'],
                    'Barangay_ID'                       => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'              => Auth::user()->City_Municipality_ID,
                    'Province_ID'                       => Auth::user()->Province_ID,
                    'Region_ID'                         => Auth::user()->Region_ID,
                    'Encoder_ID'                        => Auth::user()->id,
                    'Date_Stamp'                        => Carbon::now(),
                    'Active'                            => (int)$data['Active']
                )
            );

            return redirect()->back()->with('message', 'Emergency Team Info Updated');
        }
    }
    // Emergency Team

    // Emergency Equipment
    public function create_emergency_equipment(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Emergency_Equipment_ID'] == null || $data['Emergency_Equipment_ID'] == 0) {
            $Emergency_Equipment_ID = DB::table('bdris_emergency_equipment')->insertGetId(
                array(
                    'Emergency_Equipment_Name'  => $data['Emergency_Equipment_Name'],
                    'Location'                  => $data['Location'],
                    'Barangay_ID'               => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'      => Auth::user()->City_Municipality_ID,
                    'Province_ID'               => Auth::user()->Province_ID,
                    'Region_ID'                 => Auth::user()->Region_ID,
                    'Encoder_ID'                => Auth::user()->id,
                    'Date_Stamp'                => Carbon::now(),
                    'Active'                    => (int)$data['Active']
                )
            );

            return redirect()->to('emergency_equipment_details/' . $Emergency_Equipment_ID)->with('message', 'New Emergency Equipment Information Created');
        } else {
            DB::table('bdris_emergency_equipment')->where('Emergency_Equipment_ID', $data['Emergency_Equipment_ID'])->update(
                array(
                    'Emergency_Equipment_Name' => $data['Emergency_Equipment_Name'],
                    'Location'                 => $data['Location'],
                    'Barangay_ID'               => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'      => Auth::user()->City_Municipality_ID,
                    'Province_ID'               => Auth::user()->Province_ID,
                    'Region_ID'                 => Auth::user()->Region_ID,
                    'Encoder_ID'               => Auth::user()->id,
                    'Date_Stamp'               => Carbon::now(),
                    'Active'                   => (int)$data['Active']
                )
            );

            return redirect()->back()->with('message', 'Emergency Equipment Info Updated');
        }
    }

    public function get_recovery_information_list($Barangay_ID)
    {
        $data = DB::table('bdris_recovery_information as a')
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

            ->where('a.Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }

    public function get_response_information_list($Barangay_ID)
    {
        $data = DB::table('bdris_response_information as a')
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
            ->where('a.Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }

    public function get_disaster_related_activities_list($Barangay_ID)
    {
        $data = DB::table('bdris_disaster_related_activities as a')
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
            ->where('a.Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }


    public function get_disaster_related_activities_view(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('bdris_disaster_related_activities as a')
            ->leftjoin('bips_brgy_officials_and_staff as f', 'a.Brgy_Officials_and_Staff_ID', '=', 'f.Brgy_Officials_and_Staff_ID')
            ->leftjoin('bips_brgy_inhabitants_information as g', 'g.Resident_ID', '=', 'f.Resident_ID')
            ->select(
                'a.Disaster_Related_Activities_ID',
                'a.Activity_Name',
                'a.Purpose',
                'a.Date_Start',
                'a.Date_End',
                'a.Number_of_Participants',
                DB::raw('CONCAT(g.First_Name, " ",LEFT(g.Middle_Name,1),". ",g.Last_Name) AS Brgy_Official_Name'),

            )
            ->where('a.Disaster_Related_Activities_ID', $id)->get();

        return (compact('theEntry'));
    }

    public function get_emergency_evacuation_site_list($Barangay_ID)
    {
        $data = DB::table('bdris_emergency_evacuation_site as a')
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
            ->where('a.Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }

    public function get_allocated_fund_list($Barangay_ID)
    {
        $data = DB::table('bdris_allocated_fund_source as a')
            ->where('a.Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }

    public function get_disaster_supplies_list($Barangay_ID)
    {
        $data = DB::table('bdris_disaster_supplies as a')
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
            ->where('a.Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }

    public function get_emergency_team_list($Barangay_ID)
    {
        $data = DB::table('bdris_emergency_team as a')
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
            ->where('a.Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }

    public function get_emergency_equipment_list($Barangay_ID)
    {
        $data = DB::table('bdris_emergency_equipment as a')
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
            ->where('a.Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }

    public function delete_disaster(Request $request)
    {
        $id = $_GET['id'];

        DB::table('maintenance_bdris_disaster_type')->where('Disaster_Type_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function delete_emereva(Request $request)
    {
        $id = $_GET['id'];

        DB::table('bdris_emergency_evacuation_site')->where('Emergency_Evacuation_Site_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function delete_allocated(Request $request)
    {
        $id = $_GET['id'];

        DB::table('bdris_allocated_fund_source')->where('Allocated_Fund_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function delete_disastersupp(Request $request)
    {
        $id = $_GET['id'];

        DB::table('bdris_disaster_supplies')->where('Disaster_Supplies_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function delete_emerteam(Request $request)
    {
        $id = $_GET['id'];

        DB::table('bdris_emergency_team')->where('Emergency_Team_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function delete_emerequip(Request $request)
    {
        $id = $_GET['id'];

        DB::table('bdris_emergency_equipment')->where('Emergency_Equipment_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function delete_disasterrelated(Request $request)
    {
        $id = $_GET['id'];

        DB::table('bdris_disaster_related_activities')->where('Disaster_Related_Activities_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function delete_response(Request $request)
    {
        $id = $_GET['id'];

        DB::table('bdris_response_information')->where('Disaster_Response_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function delete_recovery(Request $request)
    {
        $id = $_GET['id'];

        DB::table('bdris_recovery_information')->where('Disaster_Recovery_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function search_emereva(Request $request)
    {
        $purpose = DB::table('bdris_emergency_evacuation_site')
            ->where('Active', 1)
            ->get(['Emergency_Evacuation_Site_ID as id', 'Emergency_Evacuation_Site_Name as text']);

        return ['results' => $purpose];
    }

    public function search_allocated(Request $request)
    {
        $purpose = DB::table('bdris_allocated_fund_source')
            ->where('Active', 1)
            ->get(['Allocated_Fund_ID as id', 'Allocated_Fund_Name as text']);

        return ['results' => $purpose];
    }

    public function search_emerequip(Request $request)
    {
        $purpose = DB::table('bdris_emergency_equipment')
            ->where('Active', 1)
            ->get(['Emergency_Equipment_ID as id', 'Emergency_Equipment_Name as text']);

        return ['results' => $purpose];
    }

    public function search_emerteam(Request $request)
    {
        $purpose = DB::table('bdris_emergency_team')
            ->where('Active', 1)
            ->get(['Emergency_Team_ID as id', 'Emergency_Team_Name as text']);

        return ['results' => $purpose];
    }

    public function search_disastertype(Request $request)
    {
        $disastertype = DB::table('maintenance_bdris_disaster_type')
            ->where('Active', 1)
            ->get(['Disaster_Type_ID as id', 'Disaster_Type as text']);

        return ['results' => $disastertype];
    }

    public function search_alertlevel(Request $request)
    {
        $alertlevel = DB::table('maintenance_bdris_alert_level')
            ->where('Active', 1)
            ->get(['Alert_Level_ID as id', 'Alert_Level as text']);

        return ['results' => $alertlevel];
    }

    public function search_disasterresponse(Request $request)
    {
        $disaster = DB::table('bdris_response_information')
            // ->where('Active', 1)
            ->get(['Disaster_Response_ID as id', 'Disaster_Name as text']);

        return ['results' => $disaster];
    }

    public function search_household(Request $request)
    {
        $household = DB::table('bips_household_profile')
            ->where('Barangay_ID', Auth::user()->Barangay_ID)
            ->get(['Household_Profile_ID as id', 'Household_Name as text']);

        return ['results' => $household];
    }

    public function search_leveldamage(Request $request)
    {
        $leveldamage = DB::table('maintenance_bdris_level_of_damage')
            ->where('Active', 1)
            ->get(['Level_of_Damage_ID as id', 'Level_of_Damage as text']);

        return ['results' => $leveldamage];
    }

    public function get_response_attachments(Request $request)
    {

        $id = $_GET['id'];
        $Reponse_Attach = DB::table('bdris_file_attachment')
            ->where('Disaster_Response_ID', $id)
            ->get();
        return json_encode($Reponse_Attach);
    }

    public function delete_response_attachments(Request $request)
    {
        $id = $_GET['id'];

        $fileinfo = DB::table('bdris_file_attachment')->where('Attachment_ID', $id)->get();
        if (File::exists('./files/uploads/response_information/' . $fileinfo[0]->File_Name)) {
            unlink(public_path('./files/uploads/response_information/' . $fileinfo[0]->File_Name));
        }
        DB::table('bdris_file_attachment')->where('Attachment_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function get_recovery_attachments(Request $request)
    {

        $id = $_GET['id'];
        $Reponse_Attach = DB::table('bdris_file_attachment')
            ->where('Disaster_Recovery_ID', $id)
            ->get();
        return json_encode($Reponse_Attach);
    }

    public function delete_recovery_attachments(Request $request)
    {
        $id = $_GET['id'];

        $fileinfo = DB::table('bdris_file_attachment')->where('Attachment_ID', $id)->get();
        if (File::exists('./files/uploads/recovery_information/' . $fileinfo[0]->File_Name)) {
            unlink(public_path('./files/uploads/recovery_information/' . $fileinfo[0]->File_Name));
        }
        DB::table('bdris_file_attachment')->where('Attachment_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function disty_export(Request $request)
    {
        $data = request()->all();
        
        $chk_Disaster_Type = isset($data['chk_Disaster_Type']) ? 1 : 0;
        $chk_Emergency_Evacuation_Site_Name = isset($data['chk_Emergency_Evacuation_Site_Name']) ? 1 : 0;
        $chk_Allocated_Fund_Name = isset($data['chk_Allocated_Fund_Name']) ? 1 : 0;
        $chk_Emergency_Team_Name = isset($data['chk_Emergency_Team_Name']) ? 1 : 0;
        $chk_Emergency_Equipment_Name = isset($data['chk_Emergency_Equipment_Name']) ? 1 : 0;
        $chk_Active = isset($data['chk_Active']) ? 1 : 0;

        return Excel::download(new DisasterTypeExportView($chk_Active,$chk_Emergency_Equipment_Name,$chk_Emergency_Team_Name,$chk_Allocated_Fund_Name,$chk_Emergency_Evacuation_Site_Name,$chk_Disaster_Type,), 'disastertype.xlsx');
    }

    public function emerevac_export(Request $request)
    {
        $data = request()->all();
        
        $chk_Emergency_Evacuation_Site_Name = isset($data['chk_Emergency_Evacuation_Site_Name']) ? 1 : 0;
        $chk_Address = isset($data['chk_Address']) ? 1 : 0;
        $chk_Capacity = isset($data['chk_Capacity']) ? 1 : 0;
        $chk_Active = isset($data['chk_Active']) ? 1 : 0;

        return Excel::download(new EmergencyEvacuationSiteExportView($chk_Active,$chk_Emergency_Evacuation_Site_Name,$chk_Address,$chk_Capacity,), 'emergencyevacuationsite.xlsx');
    }

    public function allofund_export(Request $request)
    {
        $data = request()->all();
        
        $chk_Allocated_Fund_Name = isset($data['chk_Allocated_Fund_Name']) ? 1 : 0;
        $chk_Amount = isset($data['chk_Amount']) ? 1 : 0;
        $chk_Active = isset($data['chk_Active']) ? 1 : 0;

        return Excel::download(new AllocatedFundExportView($chk_Active,$chk_Allocated_Fund_Name,$chk_Amount,), 'allocatedfund.xlsx');
    }

    public function dissupp_export(Request $request)
    {
        $data = request()->all();
        
        $chk_Disaster_Supplies_Name = isset($data['chk_Disaster_Supplies_Name']) ? 1 : 0;
        $chk_Disaster_Supplies_Quantity = isset($data['chk_Disaster_Supplies_Quantity']) ? 1 : 0;
        $chk_Location = isset($data['chk_Location']) ? 1 : 0;
        $chk_Remarks = isset($data['chk_Remarks']) ? 1 : 0;
        $chk_Disaster_Name = isset($data['chk_Disaster_Name']) ? 1 : 0;
        $chk_Resident_Name = isset($data['chk_Resident_Name']) ? 1 : 0;
        $chk_Active = isset($data['chk_Active']) ? 1 : 0;

        return Excel::download(new DisasterSuppliesExportView($chk_Active,$chk_Disaster_Supplies_Name,$chk_Disaster_Supplies_Quantity,$chk_Location,$chk_Remarks,$chk_Disaster_Name,$chk_Resident_Name,), 'emergencyteam.xlsx');
    }

    public function emerteam_export(Request $request)
    {
        $data = request()->all();
        
        $chk_Emergency_Team_Name = isset($data['chk_Emergency_Team_Name']) ? 1 : 0;
        $chk_Emergency_Team_Hotline = isset($data['chk_Emergency_Team_Hotline']) ? 1 : 0;
        $chk_Active = isset($data['chk_Active']) ? 1 : 0;

        return Excel::download(new EmergencyTeamExportView($chk_Active,$chk_Emergency_Team_Name,$chk_Emergency_Team_Hotline,), 'emergencyteam.xlsx');
    }

    public function emerequip_export(Request $request)
    {
        $data = request()->all();
        
        $chk_Emergency_Equipment_Name = isset($data['chk_Emergency_Equipment_Name']) ? 1 : 0;
        $chk_Location = isset($data['chk_Location']) ? 1 : 0;
        $chk_Active = isset($data['chk_Active']) ? 1 : 0;

        return Excel::download(new EmergencyEquipmentExportView($chk_Active,$chk_Emergency_Equipment_Name,$chk_Location,), 'emergencyequipment.xlsx');
    }

    public function search_disty_fields(Request $request)
    {
        // dd(request()->all());
        $currDATE = Carbon::now();

        
        $data = DB::table('maintenance_bdris_disaster_type as a')
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
            DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

        );
        $distyparam1 = $request->get('distyparam1');
        $distyparam2 = $request->get('distyparam2');
        $distyparam3 = $request->get('distyparam3');
        $distyparam4 = $request->get('distyparam4');
        $distyparam5 = $request->get('distyparam5');
        $distyparam6 = $request->get('distyparam6');

        if ($distyparam1 != null && $distyparam1 != "" && $distyparam1 != "null") {
            $data->where('a.Disaster_Type', $distyparam1);
        }
        if ($distyparam2 != null && $distyparam2 != "" && $distyparam2 != "null") {
            $data->where('a.Emergency_Evacuation_Site_ID', $distyparam2);
        }
        if ($distyparam3 != null && $distyparam3 != "" && $distyparam3 != "null") {
            $data->where('a.Allocated_Fund_ID', $distyparam3);
        }
        if ($distyparam4 != null && $distyparam4 != "" && $distyparam4 != "null") {
            $data->where('a.Emergency_Equipment_ID', $distyparam4);
        }
        if ($distyparam5 != null && $distyparam5 != "" && $distyparam5 != "null") {
            $data->where('a.Emergency_Team_ID', $distyparam5);
        }
        if ($distyparam6 != null && $distyparam6 != "" && $distyparam6 != "null") {
            $data->where('a.Active', $distyparam6);
        }
        
       
        $db_entries = $data->orderby('a.Disaster_Type', 'desc')->paginate(20);

        // dd($db_entries);

        return view('bdris_transactions.disaster_type_data', compact('db_entries'))->render();
    }

    public function search_emerevac_fields(Request $request)
    {
        // dd(request()->all());
        $currDATE = Carbon::now();

        
        $data = DB::table('bdris_emergency_evacuation_site as a')
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
            DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

        );
        $emerevacparam1 = $request->get('emerevacparam1');
        $emerevacparam2 = $request->get('emerevacparam2');
        $emerevacparam3 = $request->get('emerevacparam3');
        $emerevacparam4 = $request->get('emerevacparam4');

        if ($emerevacparam1 != null && $emerevacparam1 != "") {
            $data->where(function ($query) use ($emerevacparam1) {
                $query->where('a.Emergency_Evacuation_Site_Name', 'LIKE', '%' . $emerevacparam1 . '%');
            });
        }
        if ($emerevacparam2 != null && $emerevacparam2 != "" && $emerevacparam2 != "null") {
            $data->where('a.Address', $emerevacparam2);
        }
        if ($emerevacparam3 != null && $emerevacparam3 != "" && $emerevacparam3 != "null") {
            $data->where('a.Capacity', $emerevacparam3);
        }
        if ($emerevacparam4 != null && $emerevacparam4 != "" && $emerevacparam4 != "null") {
            $data->where('a.Active', $emerevacparam4);
        }

        if (Auth::user()->User_Type_ID == 3) {
            $data->where('a.Province_ID', Auth::user()->Province_ID);
        } elseif (Auth::user()->User_Type_ID == 1) {
            $data->where('a.Barangay_ID', Auth::user()->Barangay_ID);
        }
        
       
        $db_entries2 = $data->orderby('a.Emergency_Evacuation_Site_Name', 'desc')->paginate(20);

        // dd($db_entries);

        return view('bdris_transactions.emergency_evacuation_site_data', compact('db_entries2'))->render();
    }

    public function search_allofund_fields(Request $request)
    {
        // dd(request()->all());
        $currDATE = Carbon::now();

        
        $data = DB::table('bdris_allocated_fund_source as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->select(
            'a.Allocated_Fund_ID',
            'a.Allocated_Fund_Name',
            'a.Amount',
            'a.Region_ID',
            'b.Region_Name',
            'a.Province_ID',
            'c.Province_Name',
            'a.Barangay_ID',
            'e.Barangay_Name',
            'a.City_Municipality_ID',
            'd.City_Municipality_Name',
            DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

        );
        $allofundparam1 = $request->get('allofundparam1');
        $allofundparam2 = $request->get('allofundparam2');
        $allofundparam3 = $request->get('allofundparam3');

        if ($allofundparam1 != null && $allofundparam1 != "") {
            $data->where(function ($query) use ($allofundparam1) {
                $query->where('a.Allocated_Fund_Name', 'LIKE', '%' . $allofundparam1 . '%');
            });
        }
        if ($allofundparam2 != null && $allofundparam2 != "" && $allofundparam2 != "null") {
            $data->where('a.Amount', $allofundparam2);
        }
        if ($allofundparam3!= null && $allofundparam3 != "" && $allofundparam3 != "null") {
            $data->where('a.Active', $allofundparam3);
        }

        if (Auth::user()->User_Type_ID == 3) {
            $data->where('a.Province_ID', Auth::user()->Province_ID);
        } elseif (Auth::user()->User_Type_ID == 1) {
            $data->where('a.Barangay_ID', Auth::user()->Barangay_ID);
        }
        
       
        $db_entries3 = $data->orderby('a.Allocated_Fund_Name', 'desc')->paginate(20);

        // dd($db_entries);

        return view('bdris_transactions.allocated_fund_data', compact('db_entries3'))->render();
    }

    public function search_dissupp_fields(Request $request)
    {
        // dd(request()->all());
        $currDATE = Carbon::now();

        
        $data = DB::table('bdris_disaster_supplies as a')
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
            DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

        );
        $dissuppparam1 = $request->get('dissuppparam1');
        $dissuppparam2 = $request->get('dissuppparam2');
        $dissuppparam3 = $request->get('dissuppparam3');
        $dissuppparam4 = $request->get('dissuppparam4');
        $dissuppparam5 = $request->get('dissuppparam5');
        $dissuppparam6 = $request->get('dissuppparam6');

        // if ($dissuppparam1 != null && $dissuppparam1 != "") {
        //     $data->where(function ($query) use ($dissuppparam1) {
        //         $query->where('a.Emergency_Evacuation_Site_Name', 'LIKE', '%' . $dissuppparam1 . '%');
        //     });
        // }
        if ($dissuppparam1 != null && $dissuppparam1 != "" && $dissuppparam1 != "null") {
            $data->where('a.Disaster_Response_ID', $dissuppparam1);
        }
        if ($dissuppparam2 != null && $dissuppparam2 != "" && $dissuppparam2 != "null") {
            $data->where('a.Disaster_Supplies_Name', $dissuppparam2);
        }
        if ($dissuppparam3 != null && $dissuppparam3 != "" && $dissuppparam3 != "null") {
            $data->where('a.Disaster_Supplies_Quantity', $dissuppparam3);
        }
        if ($dissuppparam4 != null && $dissuppparam4 != "" && $dissuppparam4 != "null") {
            $data->where('a.Location', $dissuppparam4);
        }
        if ($dissuppparam5 != null && $dissuppparam5 != "" && $dissuppparam5 != "null") {
            $data->where('a.Remarks', $dissuppparam5);
        }
        if ($dissuppparam6 != null && $dissuppparam6 != "" && $dissuppparam6 != "null") {
            $data->where('a.Active', $dissuppparam6);
        }

        if (Auth::user()->User_Type_ID == 3) {
            $data->where('a.Province_ID', Auth::user()->Province_ID);
        } elseif (Auth::user()->User_Type_ID == 1) {
            $data->where('a.Barangay_ID', Auth::user()->Barangay_ID);
        }
        
       
        $db_entries4 = $data->orderby('a.Disaster_Supplies_Name', 'desc')->paginate(20);

        // dd($db_entries);

        return view('bdris_transactions.disaster_supplies_data', compact('db_entries4'))->render();
    }

    public function search_emerteam_fields(Request $request)
    {
        // dd(request()->all());
        $currDATE = Carbon::now();

        
        $data = DB::table('bdris_emergency_team as a')
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
            DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

        );
        $emerteamparam1 = $request->get('emerteamparam1');
        $emerteamparam2 = $request->get('emerteamparam2');
        $emerteamparam3 = $request->get('emerteamparam3');

        if ($emerteamparam1 != null && $emerteamparam1 != "") {
            $data->where(function ($query) use ($emerteamparam1) {
                $query->where('a.Emergency_Team_Name', 'LIKE', '%' . $emerteamparam1 . '%');
            });
        }
        if ($emerteamparam2 != null && $emerteamparam2 != "" && $emerteamparam2 != "null") {
            $data->where('a.Emergency_Team_Hotline', $emerteamparam2);
        }
        if ($emerteamparam3!= null && $emerteamparam3 != "" && $emerteamparam3 != "null") {
            $data->where('a.Active', $emerteamparam3);
        }

        if (Auth::user()->User_Type_ID == 3) {
            $data->where('a.Province_ID', Auth::user()->Province_ID);
        } elseif (Auth::user()->User_Type_ID == 1) {
            $data->where('a.Barangay_ID', Auth::user()->Barangay_ID);
        }
        
       
        $db_entries5 = $data->orderby('a.Emergency_Team_Name', 'desc')->paginate(20);

        // dd($db_entries);

        return view('bdris_transactions.emergency_team_data', compact('db_entries5'))->render();
    }

    public function search_emerequip_fields(Request $request)
    {
        // dd(request()->all());
        $currDATE = Carbon::now();

        
        $data = DB::table('bdris_emergency_equipment as a')
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
            DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

        );
        $emerequipparam1 = $request->get('emerequipparam1');
        $emerequipparam2 = $request->get('emerequipparam2');
        $emerequipparam3 = $request->get('emerequipparam3');

        if ($emerequipparam1 != null && $emerequipparam1 != "") {
            $data->where(function ($query) use ($emerequipparam1) {
                $query->where('a.Emergency_Equipment_Name', 'LIKE', '%' . $emerequipparam1 . '%');
            });
        }
        if ($emerequipparam2 != null && $emerequipparam2 != "" && $emerequipparam2 != "null") {
            $data->where('a.Location', $emerequipparam2);
        }
        if ($emerequipparam3!= null && $emerequipparam3 != "" && $emerequipparam3 != "null") {
            $data->where('a.Active', $emerequipparam3);
        }

        if (Auth::user()->User_Type_ID == 3) {
            $data->where('a.Province_ID', Auth::user()->Province_ID);
        } elseif (Auth::user()->User_Type_ID == 1) {
            $data->where('a.Barangay_ID', Auth::user()->Barangay_ID);
        }
        
       
        $db_entries6 = $data->orderby('a.Emergency_Equipment_Name', 'desc')->paginate(20);

        // dd($db_entries);

        return view('bdris_transactions.emergency_equip_data', compact('db_entries6'))->render();
    }
}
