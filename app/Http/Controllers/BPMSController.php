<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;

class BPMSController extends Controller
{
    //Contractor Information List
    public function contractor_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bpms_contractor')->paginate(20, ['*'], 'db_entries');


        return view('bpms_transactions.contractor_list', compact(
            'db_entries',
            'currDATE',

        ));
    }

    // Save Contractor
    public function create_contractor(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('bpms_contractor')->insert(
            array(
                'Contractor_ID'         => $data['Contractor_ID'],
                'Contractor_Name'       => $data['Contractor_Name'],
                'Contact_Person'        => $data['Contact_Person'],
                'Contact_No'            => $data['Contact_No'],
                'Contractor_Address'    => $data['Contractor_Address'],
                'Contractor_TIN'       => $data['Contractor_TIN'],
                'Remarks'           => $data['Remarks'],
                'Encoder_ID'            => Auth::user()->id,
                'Date_Stamp'            => Carbon::now()
            )
        );
        return redirect()->back()->with('message', 'New Entry Created');
    }

    // Display Contractor
    public function get_contractor(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('bpms_contractor as a')
            ->select(
                'a.Contractor_ID',
                'a.Contractor_Name',
                'a.Contact_Person',
                'a.Contact_No',
                'a.Contractor_Address',
                'a.Contractor_TIN',
                'a.Remarks',
            )
            ->where('Contractor_ID', $id)->get();

        return (compact('theEntry'));
    }

    //updating Contractor
    public function update_contractor(Request $request)

    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('bpms_contractor')->where('Contractor_ID', $data['Contractor_ID1'])->update(
            array(
                'Encoder_ID'        => Auth::user()->id,
                'Date_Stamp'        => Carbon::now(),
                'Contractor_Name'   => $data['Contractor_Name1'],
                'Contact_Person'    => $data['Contact_Person1'],
                'Contact_No'        => $data['Contact_No1'],
                'Contractor_Address' => $data['Contractor_Address1'],
                'Contractor_TIN'    => $data['Contractor_TIN1'],
                'Remarks'           => $data['Remarks1'],

            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Brgy Projects Monitoring Information List
    public function brgy_projects_monitoring_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bpms_brgy_projects_monitoring as a')
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
            ->paginate(20, ['*'], 'db_entries');

        $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
        $province = DB::table('maintenance_province')->paginate(20, ['*'], 'province');
        $barangay = DB::table('maintenance_barangay')->paginate(20, ['*'], 'barangay');
        $city = DB::table('maintenance_city_municipality')->paginate(20, ['*'], 'city');
        $contractor = DB::table('bpms_contractor')->paginate(20, ['*'], 'contractor');
        $project_type = DB::table('maintenance_bpms_project_type')->paginate(20, ['*'], 'project_type');
        $project_status = DB::table('maintenance_bpms_project_status')->paginate(20, ['*'], 'project_status');

        return view('bpms_transactions.brgy_projects_monitoring_list', compact(
            'db_entries',
            'currDATE',
            'region',
            'province',
            'barangay',
            'city',
            'contractor',
            'project_type',
            'project_status',

        ));
    }


    // Save Brgy Projects Monitoring
    public function create_brgy_projects_monitoring(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('bpms_brgy_projects_monitoring')->insert(
            array(
                'Project_Number'            => $data['Project_Number'],
                'Project_Name'              => $data['Project_Name'],
                'Description'               => $data['Description'],
                'Estimated_Start_Date'      => $data['Estimated_Start_Date'],
                'Estimated_End_Date'        => $data['Estimated_End_Date'],
                'Total_Project_Cost'        => $data['Total_Project_Cost'],
                'Funding_Year'              => $data['Funding_Year'],
                'Exact_Location'            => $data['Exact_Location'],
                'Type_of_Beneficiary'       => $data['Type_of_Beneficiary'],
                'Number_of_Beneficiaries'   => $data['Number_of_Beneficiaries'],
                'Actual_Project_Start'      => $data['Actual_Project_Start'],
                'Project_Completion_Date'   => $data['Project_Completion_Date'],
                'Contractor_ID'             => $data['Contractor_ID'],
                'Project_Type_ID'           => $data['Project_Type_ID'],
                'Project_Status_ID'         => $data['Project_Status_ID'],
                'Barangay_ID'               => $data['Barangay_ID'],
                'City_Municipality_ID'      => $data['City_Municipality_ID'],
                'Province_ID'               => $data['Province_ID'],
                'Region_ID'                 => $data['Region_ID'],
                'Encoder_ID'                => Auth::user()->id,
                'Date_Stamp'                => Carbon::now()
            )
        );
        return redirect()->back()->with('message', 'New Entry Created');
    }
}
