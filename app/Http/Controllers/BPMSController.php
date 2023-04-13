<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\File;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContractorExportView;
use App\Exports\ProjectMonitoringExportView;

class BPMSController extends Controller
{
    //Contractor Information List
    public function contractor_list(Request $request)
    {
      

        $currDATE = Carbon::now();
        if (Auth::user()->User_Type_ID == 1) {
            $db_entries = DB::table('bpms_contractor')
                ->where('Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');

                return view('bpms_transactions.contractor_list', compact(
                    'db_entries',
                    'currDATE',
        
                ));
        }elseif (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4) {
            $db_entries = DB::table('bpms_contractor')
            ->where('Barangay_ID', Auth::user()->Barangay_ID)
            ->paginate(20, ['*'], 'db_entries');
        $region1 = DB::table('maintenance_region')->where('Active', 1)->get();        

        return view('bpms_transactions.contractor_list', compact(
            'db_entries',
            'currDATE',
            'region1',
            
        ));
        }
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
                'Contractor_TIN'        => $data['Contractor_TIN'],
                'Remarks'               => $data['Remarks'],
                'Barangay_ID'           => Auth::user()->Barangay_ID,
                'City_Municipality_ID'  => Auth::user()->City_Municipality_ID,
                'Province_ID'           => Auth::user()->Province_ID,
                'Region_ID'             => Auth::user()->Region_ID,

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

    public function contractor_downloadPDF(Request $request)
    {   
        // $id = $_GET['id'];
        $data = request()->all();

        $chk_Contractor_Name = isset($data['chk_Contractor_Name']) ? 1 : 0;
        $chk_Contact_Person = isset($data['chk_Contact_Person']) ? 1 : 0;
        $chk_Contact_No = isset($data['chk_Contact_No']) ? 1 : 0;
        $chk_Contractor_Address = isset($data['chk_Contractor_Address']) ? 1 : 0;
        $chk_Contractor_TIN = isset($data['chk_Contractor_TIN']) ? 1 : 0;
        $chk_Remarks = isset($data['chk_Remarks']) ? 1 : 0;

        $db_entries =DB::table('bpms_contractor as a')
        ->select(
            'a.Contractor_ID',
            'a.Contractor_Name',
            'a.Contact_Person',
            'a.Contact_No',
            'a.Contractor_Address',
            'a.Contractor_TIN',
            'a.Remarks',
        )
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->paginate(20, ['*'], 'details');

        //dd($detail);

        $pdf = PDF::loadView('bpms_transactions.contractor_List_PDF', compact(
            'chk_Contractor_Name',
            'chk_Contact_Person',
            'chk_Contact_No',
            'chk_Contractor_Address',
            'chk_Contractor_TIN',
            'chk_Remarks',
            'db_entries',
        ))->setPaper('a4', 'landscape');
        $daFileNeym = "Contractor_List.pdf";
        return $pdf->download($daFileNeym);
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
                'Barangay_ID'           => Auth::user()->Barangay_ID,
                'City_Municipality_ID'  => Auth::user()->City_Municipality_ID,
                'Province_ID'           => Auth::user()->Province_ID,
                'Region_ID'             => Auth::user()->Region_ID,

            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Brgy Projects Monitoring Information List
    public function brgy_projects_monitoring_list(Request $request)
    {
        $currDATE = Carbon::now();

        if (Auth::user()->User_Type_ID == 1) {
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

        $contractor = DB::table('bpms_contractor')->paginate(20, ['*'], 'contractor');
        $project_type = DB::table('maintenance_bpms_project_type')->paginate(20, ['*'], 'project_type');
        $project_status = DB::table('maintenance_bpms_project_status')->paginate(20, ['*'], 'project_status');
        $accomplishment = DB::table('maintenance_bpms_accomplishment_status')->paginate(20, ['*'], 'accomplishment');
        $milestone = DB::table('bpms_milestone_status')->paginate(20, ['*'], 'milestone');


        return view('bpms_transactions.brgy_projects_monitoring_list', compact(
            'db_entries',
            'currDATE',
            'contractor',
            'project_type',
            'project_status',
            'accomplishment',
            'milestone',


        ));
    }elseif (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4) {
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

        $contractor = DB::table('bpms_contractor')->paginate(20, ['*'], 'contractor');
        $project_type = DB::table('maintenance_bpms_project_type')->paginate(20, ['*'], 'project_type');
        $project_status = DB::table('maintenance_bpms_project_status')->paginate(20, ['*'], 'project_status');
        $accomplishment = DB::table('maintenance_bpms_accomplishment_status')->paginate(20, ['*'], 'accomplishment');
        $milestone = DB::table('bpms_milestone_status')->paginate(20, ['*'], 'milestone');
        $region1 = DB::table('maintenance_region')->where('Active', 1)->get();  


        return view('bpms_transactions.brgy_projects_monitoring_list', compact(
            'db_entries',
            'currDATE',
            'contractor',
            'project_type',
            'project_status',
            'accomplishment',
            'milestone',
            'region1',


        ));
    }
    }

    
    //Brgy Project Monitoring Details buban
    public function brgy_project_monitoring_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $contractor = DB::table('bpms_contractor')->paginate(20, ['*'], 'contractor');
            $project_type = DB::table('maintenance_bpms_project_type')->paginate(20, ['*'], 'project_type');
            $project_status = DB::table('maintenance_bpms_project_status')->paginate(20, ['*'], 'project_status');
            $accomplishment = DB::table('maintenance_bpms_accomplishment_status')->paginate(20, ['*'], 'accomplishment');
            return view('bpms_transactions.brgy_projects_monitoring', compact(
                'currDATE',
                'contractor',
                'project_type',
                'project_status',
                'accomplishment',
               
            ));
        } else {
            $project = DB::table('bpms_brgy_projects_monitoring')->where('Brgy_Projects_ID', $id)->get();
            $contractor = DB::table('bpms_contractor')->paginate(20, ['*'], 'contractor');
            $project_type = DB::table('maintenance_bpms_project_type')->paginate(20, ['*'], 'project_type');
            $project_status = DB::table('maintenance_bpms_project_status')->paginate(20, ['*'], 'project_status');
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $project[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $project[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $project[0]->City_Municipality_ID)->get();
            $accomplishment = DB::table('maintenance_bpms_accomplishment_status')->paginate(20, ['*'], 'accomplishment');
            $milestone = DB::table('bpms_milestone_status as a')
            ->leftjoin('maintenance_bpms_accomplishment_status as b', 'a.Accomplishment_Status_ID', '=', 'b.Accomplishment_Status_ID')
            ->select(
                'a.Milestone_Status_ID',
                'b.Accomplishment_Status_ID',
                'b.Accomplishment_Status_Name',
                'a.Brgy_Projects_ID',
                'a.Milestone_Title',
                'a.Milestone_Description',
                'a.Milestone_Date',
                'a.Milestone_Status',
                'a.Milestone_Percentage',
                'a.Obligation_Amount',
                'a.Disbursement_Amount',
                'a.Male_Employed',
                'a.Female_Employed',
            )
            ->where('a.Brgy_Projects_ID', $id)
            ->get();
           // dd($milestone);
            return view('bpms_transactions.brgy_projects_monitoring_edit', compact(
                'currDATE',
                'project',
                'contractor',
                'project_type',
                'project_status',
                'region',
                'province',
                'barangay',
                'city_municipality',
                'accomplishment',
                'milestone',
            ));
        }
    }

    public function brgy_project_monitoring_details_viewing($id)
    {
        $currDATE = Carbon::now();

        $project = DB::table('bpms_brgy_projects_monitoring')->where('Brgy_Projects_ID', $id)->get();
            $contractor = DB::table('bpms_contractor')->paginate(20, ['*'], 'contractor');
            $project_type = DB::table('maintenance_bpms_project_type')->paginate(20, ['*'], 'project_type');
            $project_status = DB::table('maintenance_bpms_project_status')->paginate(20, ['*'], 'project_status');
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $project[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $project[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $project[0]->City_Municipality_ID)->get();
            $accomplishment = DB::table('maintenance_bpms_accomplishment_status')->paginate(20, ['*'], 'accomplishment');
            $milestone = DB::table('bpms_milestone_status as a')
            ->leftjoin('maintenance_bpms_accomplishment_status as b', 'a.Accomplishment_Status_ID', '=', 'b.Accomplishment_Status_ID')
            ->select(
                'a.Milestone_Status_ID',
                'b.Accomplishment_Status_ID',
                'b.Accomplishment_Status_Name',
                'a.Brgy_Projects_ID',
                'a.Milestone_Title',
                'a.Milestone_Description',
                'a.Milestone_Date',
                'a.Milestone_Status',
                'a.Milestone_Percentage',
                'a.Obligation_Amount',
                'a.Disbursement_Amount',
                'a.Male_Employed',
                'a.Female_Employed',
            )
            ->where('a.Brgy_Projects_ID', $id)
            ->get();
            return view('bpms_transactions.brgy_projects_monitoring_viewing', compact(
                'currDATE',
                'project',
                'contractor',
                'project_type',
                'project_status',
                'region',
                'province',
                'barangay',
                'city_municipality',
                'accomplishment',
                'milestone',
            ));
            
        
    }

    public function get_brgyprojects(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('bpms_brgy_projects_monitoring as a')
        ->leftjoin('bpms_contractor as b', 'a.Contractor_ID', '=', 'b.Contractor_ID')
        ->leftjoin('maintenance_bpms_project_type as c', 'a.Project_Type_ID', '=', 'c.Project_Type_ID')
        ->leftjoin('maintenance_bpms_project_status as d', 'a.Project_Status_ID', '=', 'd.Project_Status_ID')
            ->select(
                'a.Brgy_Projects_ID',
                'a.Project_Number',
                'a.Project_Name',
                'a.Description',
                'a.Estimated_Start_Date',
                'a.Estimated_End_Date',
                'a.Total_Project_Cost',
                'a.Brgy_Projects_ID',
                'a.Funding_Year',
                'a.Exact_Location',
                'a.Type_of_Beneficiary',
                'a.Number_of_Beneficiaries',
                'a.Actual_Project_Start',
                'a.Project_Completion_Date',
                'b.Contractor_Name',
                'c.Project_Type_Name',
                
            )
            ->where('a.Brgy_Projects_ID', $id)->get();

        return (compact('theEntry'));
    }

    public function get_brgyprojects_projcount(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('bpms_brgy_projects_monitoring as a')
        ->select(
            DB::raw('COUNT(a.Project_Number) AS Project_Count'),
            // 'Project_Number'
        )
            ->where('a.Project_Number', $id)->get();

        return (compact('theEntry'));
    }

    //aldren
    


    //Save Brgy Projects Monitoring
    public function create_brgy_projects_monitoring(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();
        $Contractor_ID='';
        if($request->has('Contractor_ID')){
            $Contractor_ID=$data['Contractor_ID'];
        }else{
            $Contractor_ID=0;
        }


        if ($data['Brgy_Projects_ID'] == null || $data['Brgy_Projects_ID'] == 0) {
            $Brgy_Projects_ID = DB::table('bpms_brgy_projects_monitoring')->insertGetId(
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
                    // 'Contractor_ID'             => $data['Contractor_ID'],
                    'Contractor_ID'             => $Contractor_ID,
                    'Project_Type_ID'           => $data['Project_Type_ID'],
                    'Project_Status_ID'         => $data['Project_Status_ID'],
                    'Barangay_ID'               => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'      => Auth::user()->City_Municipality_ID,
                    'Province_ID'               => Auth::user()->Province_ID,
                    'Region_ID'                 => Auth::user()->Region_ID,
                    'Encoder_ID'                => Auth::user()->id,
                    'Date_Stamp'                => Carbon::now()
                )
            );

            DB::table('bpms_milestone_status')->where('Brgy_Projects_ID', $Brgy_Projects_ID)->delete();

            if (isset($data['Accomplishment_Status_ID'])) {
                $milestone = [];

                for ($i = 0; $i < count($data['Accomplishment_Status_ID']); $i++) {
                    if ($data['Accomplishment_Status_ID'][$i] != NULL) {

                        $id = 0 + DB::table('bpms_milestone_status')->max('Milestone_Status_ID');
                        $id += 1;

                        if ($data['Accomplishment_Status_ID'][$i] != null) {
                            $milestone = [
                                'Brgy_Projects_ID'           => $Brgy_Projects_ID,
                                'Accomplishment_Status_ID'   => $data['Accomplishment_Status_ID'][$i],
                                'Milestone_Title'            => $data['Milestone_Title'][$i],
                                'Milestone_Description'      => $data['Milestone_Description'][$i],
                                'Milestone_Date'             => $data['Milestone_Date'][$i],
                                'Milestone_Status'           => $data['Milestone_Status'][$i],
                                'Milestone_Percentage'       => $data['Milestone_Percentage'][$i],
                                'Obligation_Amount'          => $data['Obligation_Amount'][$i],
                                'Disbursement_Amount'        => $data['Disbursement_Amount'][$i],
                                'Male_Employed'              => $data['Male_Employed'][$i],
                                'Female_Employed'            => $data['Female_Employed'][$i],
                                'Encoder_ID'                 => Auth::user()->id,
                                'Date_Stamp'                 => Carbon::now()
                            ];
                        }

                        DB::table('bpms_milestone_status')->updateOrInsert(['Milestone_Status_ID' => $id], $milestone);
                    }
                }
            } 
                
            return redirect()->to('brgy_project_monitoring_details/' . $Brgy_Projects_ID)->with('message', 'New Brgy Projects Monitoring Created');
            
        } else {
            DB::table('bpms_brgy_projects_monitoring')->where('Brgy_Projects_ID', $data['Brgy_Projects_ID'])->update(
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
                    'Contractor_ID'             => $Contractor_ID,
                    'Project_Type_ID'           => $data['Project_Type_ID'],
                    'Project_Status_ID'         => $data['Project_Status_ID'],
                    'Barangay_ID'               => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'      => Auth::user()->City_Municipality_ID,
                    'Province_ID'               => Auth::user()->Province_ID,
                    'Region_ID'                 => Auth::user()->Region_ID,
                    'Encoder_ID'                => Auth::user()->id,
                    'Date_Stamp'                => Carbon::now()
                )
            );


            DB::table('bpms_milestone_status')->where('Brgy_Projects_ID', $data['Brgy_Projects_ID'])->delete();

            if (isset($data['Accomplishment_Status_ID'])) {
                $milestone = [];

                for ($i = 0; $i < count($data['Accomplishment_Status_ID']); $i++) {
                    if ($data['Accomplishment_Status_ID'][$i] != NULL) {

                        $id = 0 + DB::table('bpms_milestone_status')->max('Milestone_Status_ID');
                        $id += 1;

                        if ($data['Accomplishment_Status_ID'][$i] != null) {
                            $milestone = [
                                'Brgy_Projects_ID'           => $data['Brgy_Projects_ID'],
                                'Accomplishment_Status_ID'   => $data['Accomplishment_Status_ID'][$i],
                                'Milestone_Title'            => $data['Milestone_Title'][$i],
                                'Milestone_Description'      => $data['Milestone_Description'][$i],
                                'Milestone_Date'             => $data['Milestone_Date'][$i],
                                'Milestone_Status'           => $data['Milestone_Status'][$i],
                                'Milestone_Percentage'       => $data['Milestone_Percentage'][$i],
                                'Obligation_Amount'          => $data['Obligation_Amount'][$i],
                                'Disbursement_Amount'        => $data['Disbursement_Amount'][$i],
                                'Male_Employed'              => $data['Male_Employed'][$i],
                                'Female_Employed'            => $data['Female_Employed'][$i],
                                'Encoder_ID'                 => Auth::user()->id,
                                'Date_Stamp'                 => Carbon::now()
                            ];
                        }

                        DB::table('bpms_milestone_status')->updateOrInsert(['Milestone_Status_ID' => $id], $milestone);
                    }
                }
            }

            return redirect()->back()->with('message', 'Information Updated');
        }
    }

   


    // Display Brgy Projects Monitoring
    public function get_brgy_projects_monitoring(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bpms_brgy_projects_monitoring as a')
            ->leftjoin('bpms_contractor as b', 'a.Contractor_ID', '=', 'b.Contractor_ID')
            ->leftjoin('maintenance_bpms_project_type as c', 'a.Project_Type_ID', '=', 'c.Project_Type_ID')
            ->leftjoin('maintenance_bpms_project_status as d', 'a.Project_Status_ID', '=', 'd.Project_Status_ID')
            ->leftjoin('maintenance_region as e', 'a.Region_ID', '=', 'e.Region_ID')
            ->leftjoin('maintenance_province as f', 'a.Province_ID', '=', 'f.Province_ID')
            ->leftjoin('maintenance_city_municipality as g', 'a.City_Municipality_ID', '=', 'g.City_Municipality_ID')
            ->leftjoin('maintenance_barangay as h', 'a.Barangay_ID', '=', 'h.Barangay_ID')
            ->select(
                'a.Brgy_Projects_ID',
                'a.Project_Number',
                'a.Project_Name',
                'a.Description',
                'a.Estimated_Start_Date',
                'a.Estimated_End_Date',
                'a.Total_Project_Cost',
                'a.Funding_Year',
                'a.Exact_Location',
                'a.Type_of_Beneficiary',
                'a.Number_of_Beneficiaries',
                'a.Actual_Project_Start',
                'a.Project_Completion_Date',
                'a.Contractor_ID',
                'a.Project_Completion_Date',
                'b.Contractor_Name',
                'a.Project_Type_ID',
                'c.Project_Type_Name',
                'a.Project_Status_ID',
                'd.Project_Status_Name',
                'a.Region_ID',
                'e.Region_Name',
                'a.Province_ID',
                'f.Province_Name',
                'a.Barangay_ID',
                'h.Barangay_Name',
                'a.City_Municipality_ID',
                'g.City_Municipality_Name',
            )
            ->where('Brgy_Projects_ID', $id)->get();
            

        return (compact('theEntry'));
    }

    public function get_milestone(Request $request)
    {
        $id = $_GET['id'];
        $Milestone = DB::table('bpms_milestone_status as a')
            ->leftjoin('maintenance_bpms_accomplishment_status as b', 'a.Accomplishment_Status_ID', '=', 'b.Accomplishment_Status_ID')
            ->select(
                'a.Milestone_Status_ID',
                'b.Accomplishment_Status_ID',
                'b.Accomplishment_Status_Name',
                'a.Brgy_Projects_ID',
                'a.Milestone_Title',
                'a.Milestone_Description',
                'a.Milestone_Date',
                'a.Milestone_Status',
                'a.Milestone_Percentage',
                'a.Obligation_Amount',
                'a.Disbursement_Amount',
                'a.Male_Employed',
                'a.Female_Employed',
            )
            ->where('a.Brgy_Projects_ID', $id)
            ->get();
        return json_encode($Milestone);
    }

    public function get_milestone_attachments(Request $request)
    {
        $id = $_GET['id'];
        $Milestone_Attach = DB::table('bpms_file_attachment')
            ->where('Milestone_Status_ID', $id)
            ->get();
        return json_encode($Milestone_Attach);
    }


    public function create_file_attachment(Request $request)

    {
        $currDATE = Carbon::now();
        $data = request()->all();

        if ($request->hasfile('fileattach')) {
            foreach ($request->file('fileattach') as $file) {
                $filename = $file->getClientOriginalName();
                $fileType = $file->getClientOriginalExtension();
                $fileSize = $file->getSize();
                $filePath = public_path() . '/files/uploads/brgy_projects_monitoring_milestone/';
                $file->move($filePath, $filename);

                $file_data = array(
                    'Milestone_Status_ID' => $data['Milestone_Status_ID'],
                    'File_Name' => $filename,
                    'File_Location' => $filePath,
                    'File_Type' => $fileType,
                    'File_Size' => $fileSize,
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now()
                );
                DB::table('bpms_file_attachment')->insert($file_data);
            }
        }
        

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    public function delete_milestone_attachments(Request $request)
    {
        $id = $_GET['id'];

        $fileinfo = DB::table('bpms_file_attachment')->where('Attachment_ID', $id)->get();
        if (File::exists('./files/uploads/brgy_projects_monitoring_milestone/' . $fileinfo[0]->File_Name)) {
            unlink(public_path('./files/uploads/brgy_projects_monitoring_milestone/' . $fileinfo[0]->File_Name));
        }
        DB::table('bpms_file_attachment')->where('Attachment_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function downloadPDF(Request $request)
    {
        $details = DB::table('bpms_brgy_projects_monitoring as a')
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
            ->paginate(20, ['*'], 'details');

        $pdf = PDF::loadView('bpms_transactions.bpmsPDF', compact('details'));
        $daFileNeym = "Brgy_Projects.pdf";
        return $pdf->download($daFileNeym);
    }

    public function viewPDF(Request $request)
    {
        $details = DB::table('bpms_brgy_projects_monitoring as a')
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
            ->paginate(20, ['*'], 'details');

        $pdf = PDF::loadView('bpms_transactions.bpmsPDF', compact('details'));
        return $pdf->stream();
    }

    public function viewContractorPDF(Request $request)
    {
        $details = DB::table('bpms_contractor as a')
            ->select(
                'a.Contractor_ID',
                'a.Contractor_Name',
                'a.Contact_No',
                'a.Contact_Person',
                'a.Contractor_Address',
                'a.Contractor_TIN',
                'a.Remarks',
                
            )
            ->paginate(20, ['*'], 'details');

        $pdf = PDF::loadView('bpms_transactions.contractorPDF', compact('details'));
        return $pdf->stream();
    }

    public function get_contractor_list($Barangay_ID)
    {   
        $data = DB::table('bpms_contractor')
            ->where('Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }   
     
    public function get_brgy_projects_monitoring_list($Barangay_ID)
    {   
        $data = DB::table('bpms_brgy_projects_monitoring as a')
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
                'a.Barangay_ID'

            )
            ->where('a.Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }    

    public function delete_contractor(Request $request)
    {
        $id = $_GET['id'];
        
        DB::table('bpms_contractor')->where('Contractor_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function delete_projects(Request $request)
    {
        $id = $_GET['id'];

        DB::table('bpms_brgy_projects_monitoring')->where('Brgy_Projects_ID', $id)->delete();
        DB::table('bpms_milestone_status')->where('Brgy_Projects_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function search_contractor(Request $request)
    {
        $contractor = DB::table('bpms_contractor')
            ->where('Barangay_ID', Auth::user()->Barangay_ID)
            ->get(['Contractor_ID as id', 'Contractor_Name as text']);

        return ['results' => $contractor];
    }

    public function search_projecttype(Request $request)
    {
        $projecttype = DB::table('maintenance_bpms_project_type')
            ->where('Active', 1)
            ->get(['Project_Type_ID as id', 'Project_Type_Name as text']);

        return ['results' => $projecttype];
    }

    public function search_projectstatus(Request $request)
    {
        $projectstatus = DB::table('maintenance_bpms_project_status')
            ->where('Active', 1)
            ->get(['Project_Status_ID as id', 'Project_Status_Name as text']);

        return ['results' => $projectstatus];
    }

    public function get_project_monitoring_list($Barangay_ID)
    {

        $data = DB::table('bpms_brgy_projects_monitoring as a')
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
            ->where('a.Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }

    public function promon_downloadPDF(Request $request)
    {   
        // $id = $_GET['id'];
        $data = request()->all();


        $chk_Project_Number = isset($data['chk_Project_Number']) ? 1 : 0;
        $chk_Project_Name = isset($data['chk_Project_Name']) ? 1 : 0;
        $chk_Total_Project_Cost = isset($data['chk_Total_Project_Cost']) ? 1 : 0;
        $chk_Exact_Location = isset($data['chk_Exact_Location']) ? 1 : 0;
        $chk_Actual_Project_Start = isset($data['chk_Actual_Project_Start']) ? 1 : 0;
        $chk_Contractor_Name = isset($data['chk_Contractor_Name']) ? 1 : 0;
        $chk_Project_Type_Name = isset($data['chk_Project_Type_Name']) ? 1 : 0;
        $chk_Project_Status_Name = isset($data['chk_Project_Status_Name']) ? 1 : 0;

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
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->paginate(20, ['*'], 'details');

        //dd($detail);

        $pdf = PDF::loadView('bpms_transactions.promon_List_PDF', compact(
            'chk_Project_Number',
            'chk_Project_Name',
            'chk_Total_Project_Cost',
            'chk_Exact_Location',
            'chk_Actual_Project_Start',
            'chk_Contractor_Name',
            'chk_Project_Type_Name',
            'chk_Project_Status_Name',
            'db_entries',
        ))->setPaper('a4', 'landscape');
        $daFileNeym = "Project_Monitoring_List.pdf";
        return $pdf->download($daFileNeym);
    }


    public function search_accomplishment(Request $request)
    {
        $accomplishment = DB::table('maintenance_bpms_accomplishment_status')
            ->where('Active', 1)
            ->get(['Accomplishment_Status_ID as id', 'Accomplishment_Status_Name as text']);

        return ['results' => $accomplishment];
    }

    public function contractor_export(Request $request)
    {
        $data = request()->all();
        
        $chk_Contractor_Name = isset($data['chk_Contractor_Name']) ? 1 : 0;
        $chk_Contact_Person = isset($data['chk_Contact_Person']) ? 1 : 0;
        $chk_Contact_No = isset($data['chk_Contact_No']) ? 1 : 0;
        $chk_Contractor_Address = isset($data['chk_Contractor_Address']) ? 1 : 0;
        $chk_Contractor_TIN = isset($data['chk_Contractor_TIN']) ? 1 : 0;
        $chk_Remarks = isset($data['chk_Remarks']) ? 1 : 0;

        return Excel::download(new ContractorExportView($chk_Contractor_Name,$chk_Contact_Person,$chk_Contact_No,$chk_Contractor_Address,$chk_Contractor_TIN,$chk_Remarks,), 'contractor.xlsx');
    }

    public function projectmonitoring_export(Request $request)
    {
        $data = request()->all();

        $chk_Project_Number = isset($data['chk_Project_Number']) ? 1 : 0;
        $chk_Project_Name = isset($data['chk_Project_Name']) ? 1 : 0;
        $chk_Total_Project_Cost = isset($data['chk_Total_Project_Cost']) ? 1 : 0;
        $chk_Exact_Location = isset($data['chk_Exact_Location']) ? 1 : 0;
        $chk_Actual_Project_Start = isset($data['chk_Actual_Project_Start']) ? 1 : 0;
        $chk_Contractor_Name = isset($data['chk_Contractor_Name']) ? 1 : 0;
        $chk_Project_Type_Name = isset($data['chk_Project_Type_Name']) ? 1 : 0;
        $chk_Project_Status_Name = isset($data['chk_Project_Status_Name']) ? 1 : 0;

        return Excel::download(new ProjectMonitoringExportView($chk_Project_Number,$chk_Project_Name,$chk_Total_Project_Cost,$chk_Exact_Location,$chk_Actual_Project_Start,$chk_Contractor_Name,$chk_Project_Type_Name,$chk_Project_Status_Name,), 'projectmonitoring.xlsx');
    }

    public function search_contractor_fields(Request $request)
    {
        // dd(request()->all());
        $currDATE = Carbon::now();

        
        $data = DB::table('bpms_contractor');

        $param1 = $request->get('param1');
        $param2 = $request->get('param2');
        $param3 = $request->get('param3');
        $param4 = $request->get('param4');
        $param5 = $request->get('param5');
        $param6 = $request->get('param6');

        if ($param1 != null && $param1 != "") {
            $data->where(function ($query) use ($param1) {
                $query->where('Contractor_Name', 'LIKE', '%' . $param1 . '%');
            });
        }
        if ($param2 != null && $param2 != "") {
            $data->where(function ($query) use ($param2) {
                $query->where('Contact_Person', 'LIKE', '%' . $param2 . '%');
            });
        }
        if ($param3 != null && $param3 != "") {
            $data->where(function ($query) use ($param3) {
                $query->where('Contact_No', 'LIKE', '%' . $param3 . '%');
            });
        }
        if ($param4 != null && $param4 != "") {
            $data->where(function ($query) use ($param4) {
                $query->where('Contractor_Address', 'LIKE', '%' . $param4 . '%');
            });
        }
        if ($param5 != null && $param5 != "") {
            $data->where(function ($query) use ($param5) {
                $query->where('Contractor_TIN', 'LIKE', '%' . $param5 . '%');
            });
        }
        if ($param6 != null && $param6 != "") {
            $data->where(function ($query) use ($param6) {
                $query->where('Remarks', 'LIKE', '%' . $param6 . '%');
            });
        }
       
       

        if (Auth::user()->User_Type_ID == 3) {
            $data->where('Province_ID', Auth::user()->Province_ID);
        } elseif (Auth::user()->User_Type_ID == 1) {
            $data->where('Barangay_ID', Auth::user()->Barangay_ID);
        }
        
       
        $db_entries = $data->orderby('Contractor_Name', 'desc')->paginate(20);

        // dd($db_entries);

        return view('bpms_transactions.contractor_data', compact('db_entries'))->render();
    }

    public function search_projects_monitoring_fields(Request $request)
    {
        // dd(request()->all());
        $currDATE = Carbon::now();

        
        $data= DB::table('bpms_brgy_projects_monitoring as a')
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
            'a.Contractor_ID',
            'a.Project_Type_ID',
            'a.Project_Status_ID',
            'b.Contractor_Name',
            'c.Project_Type_Name',
            'd.Project_Status_Name',

        );

        $param1 = $request->get('param1');
        $param2 = $request->get('param2');
        $param3 = $request->get('param3');
        $param4 = $request->get('param4');
        $param5 = $request->get('param5');
        $param6 = $request->get('param6');
        $param7 = $request->get('param7');
        $param8 = $request->get('param8');

        if ($param1 != null && $param1 != "") {
            $data->where(function ($query) use ($param1) {
                $query->where('a.Project_Number', 'LIKE', '%' . $param1 . '%');
            });
        }
        if ($param2 != null && $param2 != "") {
            $data->where(function ($query) use ($param2) {
                $query->where('a.Project_Name', 'LIKE', '%' . $param2 . '%');
            });
        }
        if ($param3 != null && $param3 != "") {
            $data->where(function ($query) use ($param3) {
                $query->where('a.Total_Project_Cost', 'LIKE', '%' . $param3 . '%');
            });
        }
        if ($param4 != null && $param4 != "") {
            $data->where(function ($query) use ($param4) {
                $query->where('a.Exact_Location', 'LIKE', '%' . $param4 . '%');
            });
        }
        if ($param5 != null && $param5 != "") {
            $data->where( DB::raw('CAST(a.Actual_Project_Start as date)'), $param5);
        }
        if ($param6 != null && $param6 != "" && $param6 != "null") {
            $data->where('a.Contractor_ID', $param6);
        }
        if ($param7 != null && $param7 != "" && $param7 != "null") {
            $data->where('a.Project_Type_ID', $param7);
        }
        if ($param8 != null && $param8 != "" && $param8 != "null") {
            $data->where('a.Project_Status_ID', $param8);
        }
        // if (Auth::user()->User_Type_ID == 3) {
        //     $data->where('a.Province_ID', Auth::user()->Province_ID);
        // } elseif (Auth::user()->User_Type_ID == 1) {
        //     $data->where('a.Barangay_ID', Auth::user()->Barangay_ID);
        // }
        $db_entries = $data->orderby('a.Brgy_Projects_ID', 'desc')->paginate(20);

        // dd($db_entries);

        return view('bpms_transactions.brgy_projects_monitoring_data', compact('db_entries'))->render();
    }    
    // public function delete_milestone_attachments(Request $request)
    // {
    //     $id = $_GET['id'];

    //     $fileinfo = DB::table('bdris_file_attachment')->where('Attachment_ID', $id)->get();
    //     if (File::exists('./files/uploads/recovery_information/' . $fileinfo[0]->File_Name)) {
    //         unlink(public_path('./files/uploads/recovery_information/' . $fileinfo[0]->File_Name));
    //     }
    //     DB::table('bdris_file_attachment')->where('Attachment_ID', $id)->delete();

    //     return response()->json(array('success' => true));
    // }

}
