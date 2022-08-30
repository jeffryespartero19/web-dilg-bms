<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\File;
use PDF;

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
                'Contractor_TIN'        => $data['Contractor_TIN'],
                'Remarks'               => $data['Remarks'],
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
        $accomplishment = DB::table('maintenance_bpms_accomplishment_status')->paginate(20, ['*'], 'accomplishment');
        $milestone = DB::table('bpms_milestone_status')->paginate(20, ['*'], 'milestone');


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
            'accomplishment',
            'milestone',


        ));
    }


    //Save Brgy Projects Monitoring
    public function create_brgy_projects_monitoring(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

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


            return redirect()->back()->with('message', 'New Entry Created');
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

            return redirect()->back()->with('message', 'Brgy Projects Monitoring Info Updated');
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
                // $filename = pathinfo($fileinfo, PATHINFO_FILENAME);
                $filePath = public_path() . '/files/uploads/brgy_projects_monitoring_milestone/';
                $file->move($filePath, $filename);

                $file_data = array(
                    'Milestone_Status_ID' => $data['Milestone_Status_ID'],
                    'File_Name' => $filename,
                    'File_Location' => $filePath,
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
}
