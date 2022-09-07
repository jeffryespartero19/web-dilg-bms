<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\File;
use PDF;

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

    //Blotter Details
    public function blotter_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $case = DB::table('maintenance_bjisbh_case')->where('Active', 1)->get();
            $blotter_status = DB::table('maintenance_bjisbh_blotter_status')->where('Active', 1)->get();
            $proceedings_status = DB::table('maintenance_bjisbh_proceedings_status')->where('Active', 1)->get();
            $service_rating = DB::table('maintenance_bjisbh_service_rating')->where('Active', 1)->get();
            $summons_status = DB::table('maintenance_bjisbh_summons_status')->where('Active', 1)->get();
            $penalties = DB::table('maintenance_bjisbh_types_of_penalties')->where('Active', 1)->get();
            $action = DB::table('maintenance_bjisbh_type_of_action')->where('Active', 1)->get();
            $involved_party = DB::table('maintenance_bjisbh_type_of_involved_party')->where('Active', 1)->get();
            $violation_status = DB::table('maintenance_bjisbh_violation_status')->where('Active', 1)->get();
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
            $region = DB::table('maintenance_region')->where('Active', 1)->get();

            return view('bjisbh_transactions.blotter_details', compact(
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
        } else {
            $blotter = DB::table('bjisbh_blotter')->where('Blotter_ID', $id)->get();
            $case_details = DB::table('bjisbh_case_details')->where('Blotter_ID', $id)->get();
            $involved_details = DB::table('bjisbh_blotter_involved_parties')->where('Blotter_ID', $id)->get();
            $file_attachment = DB::table('bjisbh_blotter_file_attachment')->where('Blotter_ID', $id)->get();

            $case = DB::table('maintenance_bjisbh_case')->where('Active', 1)->get();
            $blotter_status = DB::table('maintenance_bjisbh_blotter_status')->where('Active', 1)->get();
            // $proceedings_status = DB::table('maintenance_bjisbh_proceedings_status')->where('Active', 1)->get();
            // $service_rating = DB::table('maintenance_bjisbh_service_rating')->where('Active', 1)->get();
            // $summons_status = DB::table('maintenance_bjisbh_summons_status')->where('Active', 1)->get();
            // $penalties = DB::table('maintenance_bjisbh_types_of_penalties')->where('Active', 1)->get();
            // $action = DB::table('maintenance_bjisbh_type_of_action')->where('Active', 1)->get();
            $involved_party = DB::table('maintenance_bjisbh_type_of_involved_party')->where('Active', 1)->get();
            // $violation_status = DB::table('maintenance_bjisbh_violation_status')->where('Active', 1)->get();
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $blotter[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $blotter[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $blotter[0]->City_Municipality_ID)->get();

            return view('bjisbh_transactions.blotter_details_edit', compact(
                'currDATE',
                'blotter',
                'case_details',
                'involved_details',
                'case',
                'blotter_status',
                'involved_party',
                'resident',
                'region',
                'province',
                'city_municipality',
                'barangay',
                'file_attachment'
            ));
        }
    }

    // Save Inhabitants Info
    public function create_blotter(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Blotter_ID'] == 0) {
            $Blotter_ID = DB::table('bjisbh_blotter')->insertGetId(
                array(
                    'Blotter_Number' => $data['Blotter_Number'],
                    'Blotter_Status_ID' => $data['Blotter_Status_ID'],
                    'Incident_Date_Time' => $data['Incident_Date_Time'],
                    'Complaint_Details' => $data['Complaint_Details'],
                    'Barangay_ID' => $data['Barangay_ID'],
                    'City_Municipality_ID' => $data['City_Municipality_ID'],
                    'Province_ID' => $data['Province_ID'],
                    'Region_ID' => $data['Region_ID'],
                    'Encoder_ID' => Auth::user()->id,
                    'Date_Stamp' => Carbon::now()
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

            DB::table('bjisbh_blotter_involved_parties')->where('Blotter_ID', $Blotter_ID)->delete();

            if (isset($data['Resident_ID'])) {
                $resident_details = [];

                for ($i = 0; $i < count($data['Resident_ID']); $i++) {
                    if ($data['Resident_ID'][$i] != NULL) {
                        if (is_int($data['Resident_ID'][$i]) || ctype_digit($data['Resident_ID'][$i])) {
                            $id = 0 + DB::table('bjisbh_blotter_involved_parties')->max('Blotter_Involved_ID');
                            $id += 1;

                            $resident_details = [
                                'Blotter_ID' => $Blotter_ID,
                                'Resident_ID' => $data['Resident_ID'][$i],
                                'Type_of_Involved_Party_ID' => $data['Type_of_Involved_Party_ID'][$i],
                                'Residency_Status' => (int)$data['Residency_Status'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        } else {
                            $id = 0 + DB::table('bjisbh_blotter_involved_parties')->max('Blotter_Involved_ID');
                            $id += 1;

                            $resident_details = [
                                'Blotter_ID' => $Blotter_ID,
                                'Resident_ID' => 0,
                                'Type_of_Involved_Party_ID' => $data['Type_of_Involved_Party_ID'][$i],
                                'Residency_Status' => (int)$data['Residency_Status'][$i],
                                'Non_Resident_Name' => $data['Resident_ID'][$i],
                                'Non_Resident_Address' => $data['Non_Resident_Address'][$i],
                                'Non_Resident_Birthdate' => $data['Non_Resident_Birthdate'][$i],
                                'Phone_No' => $data['Phone_No'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        }
                        DB::table('bjisbh_blotter_involved_parties')->insert($resident_details);
                    }
                }
            }

            if ($request->hasfile('fileattach')) {
                foreach ($request->file('fileattach') as $file) {
                    $filename = $file->getClientOriginalName();
                    // $filename = pathinfo($fileinfo, PATHINFO_FILENAME);
                    $filePath = public_path() . '/files/uploads/bjisbh_transaction/blotter_file_attachments/';
                    $file->move($filePath, $filename);


                    $file_data = array(
                        'Blotter_ID' => $Blotter_ID,
                        'File_Name' => $filename,
                        'File_Location' => $filePath,
                        'Encoder_ID'       => Auth::user()->id,
                        'Date_Stamp'       => Carbon::now()
                    );
                    DB::table('bjisbh_blotter_file_attachment')->insert($file_data);
                }
            }


            return redirect()->to('blotter_details/' . $Blotter_ID)->with('message', 'New Blotter Created');
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

            DB::table('bjisbh_blotter_involved_parties')->where('Blotter_ID', $data['Blotter_ID'])->delete();

            if (isset($data['Resident_ID'])) {
                $resident_details = [];

                for ($i = 0; $i < count($data['Resident_ID']); $i++) {
                    if ($data['Resident_ID'][$i] != NULL) {
                        if (is_int($data['Resident_ID'][$i]) || ctype_digit($data['Resident_ID'][$i])) {
                            $id = 0 + DB::table('bjisbh_blotter_involved_parties')->max('Blotter_Involved_ID');
                            $id += 1;

                            $resident_details = [
                                'Blotter_ID' => $data['Blotter_ID'],
                                'Resident_ID' => $data['Resident_ID'][$i],
                                'Type_of_Involved_Party_ID' => $data['Type_of_Involved_Party_ID'][$i],
                                'Residency_Status' => (int)$data['Residency_Status'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        } else {
                            $id = 0 + DB::table('bjisbh_blotter_involved_parties')->max('Blotter_Involved_ID');
                            $id += 1;

                            $resident_details = [
                                'Blotter_ID' => $data['Blotter_ID'],
                                'Resident_ID' => 0,
                                'Type_of_Involved_Party_ID' => $data['Type_of_Involved_Party_ID'][$i],
                                'Residency_Status' => (int)$data['Residency_Status'][$i],
                                'Non_Resident_Name' => $data['Resident_ID'][$i],
                                'Non_Resident_Address' => $data['Non_Resident_Address'][$i],
                                'Non_Resident_Birthdate' => $data['Non_Resident_Birthdate'][$i],
                                'Phone_No' => $data['Phone_No'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            ];
                        }
                        DB::table('bjisbh_blotter_involved_parties')->insert($resident_details);
                    }
                }
            }

            if ($request->hasfile('fileattach')) {
                foreach ($request->file('fileattach') as $file) {
                    $filename = $file->getClientOriginalName();
                    // $filename = pathinfo($fileinfo, PATHINFO_FILENAME);
                    $filePath = public_path() . '/files/uploads/bjisbh_transaction/blotter_file_attachments/';
                    $file->move($filePath, $filename);


                    $file_data = array(
                        'Blotter_ID' => $data['Blotter_ID'],
                        'File_Name' => $filename,
                        'File_Location' => $filePath,
                        'Encoder_ID'       => Auth::user()->id,
                        'Date_Stamp'       => Carbon::now()
                    );
                    DB::table('bjisbh_blotter_file_attachment')->insert($file_data);
                }
            }

            return redirect()->to('blotter_details/' . $data['Blotter_ID'])->with('message', 'Blotter Updated');
        }
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

    public function delete_blotter_attachments(Request $request)
    {
        $id = $_GET['id'];

        $fileinfo = DB::table('bjisbh_blotter_file_attachment')->where('Attachment_ID', $id)->get();
        if (File::exists('./files/uploads/bjisbh_transaction/blotter_file_attachments/' . $fileinfo[0]->File_Name)) {
            unlink(public_path('./files/uploads/bjisbh_transaction/blotter_file_attachments/' . $fileinfo[0]->File_Name));
        }
        DB::table('bjisbh_blotter_file_attachment')->where('Attachment_ID', $id)->delete();

        return response()->json(array('success' => true));
    }
}
