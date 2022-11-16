<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\File;
use PDF;

class borisController extends Controller
{
    //Ordinance List
    public function ordinances_and_resolutions_list(Request $request)
    {
        $currDATE = Carbon::now();

        if (Auth::user()->User_Type_ID == 3) {
            $db_entries = DB::table('boris_brgy_ordinances_and_resolutions_information as a')
                ->leftjoin('maintenance_boris_status_of_ordinance_or_resolution as b', 'a.Status_of_Ordinance_or_Resolution_ID', '=', 'b.Status_of_Ordinance_or_Resolution_ID')
                ->select(
                    'a.Ordinance_Resolution_ID',
                    'a.Ordinance_or_Resolution',
                    'a.Ordinance_Resolution_No',
                    'a.Date_of_Approval',
                    'a.Date_of_Effectivity',
                    'a.Ordinance_Resolution_Title',
                    'a.Status_of_Ordinance_or_Resolution_ID',
                    'b.Name_of_Status'
                )
                ->where('a.Ordinance_or_Resolution', 0)
                ->where('a.Province_ID', Auth::user()->Province_ID)
                ->paginate(20, ['*'], 'db_entries');
        } elseif (Auth::user()->User_Type_ID == 1) {
            $db_entries = DB::table('boris_brgy_ordinances_and_resolutions_information as a')
                ->leftjoin('maintenance_boris_status_of_ordinance_or_resolution as b', 'a.Status_of_Ordinance_or_Resolution_ID', '=', 'b.Status_of_Ordinance_or_Resolution_ID')
                ->select(
                    'a.Ordinance_Resolution_ID',
                    'a.Ordinance_or_Resolution',
                    'a.Ordinance_Resolution_No',
                    'a.Date_of_Approval',
                    'a.Date_of_Effectivity',
                    'a.Ordinance_Resolution_Title',
                    'a.Status_of_Ordinance_or_Resolution_ID',
                    'b.Name_of_Status'

                )
                ->where('a.Ordinance_or_Resolution', 0)
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');
        }

        $city1 = DB::table('maintenance_city_municipality')
            ->where('Province_ID', Auth::user()->Province_ID)
            ->get();
        $region = DB::table('maintenance_region')->where('Active', 1)->get();
        $province = DB::table('maintenance_province')->where('Active', 1)->get();
        $city = DB::table('maintenance_city_municipality')->where('Active', 1)->get();
        $barangay = DB::table('maintenance_barangay')->where('Active', 1)->get();
        $status = DB::table('maintenance_boris_status_of_ordinance_or_resolution')->where('Active', 1)->get();
        $type = DB::table('maintenance_boris_type_of_ordinance_or_resolution')->where('Active', 1)->get();
        $category = DB::table('maintenance_boris_category_of_ordinance_or_resolution_id')->where('Active', 1)->get();
        $brgy_official = DB::table('bips_brgy_officials_and_staff as a')
            ->join('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->select(
                'a.Resident_ID',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
            )
            ->groupBy('a.Resident_ID', 'b.Last_Name', 'b.First_Name', 'b.Middle_Name')
            ->where('a.Active', 1)
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->get();

        return view('boris_transactions.ordinances_and_resolutions_list', compact(
            'db_entries',
            'currDATE',
            'region',
            'province',
            'city',
            'barangay',
            'city1',
            'status',
            'type',
            'category',
            'brgy_official'
        ));
    }

    //Ordinance List
    public function resolutions_list(Request $request)
    {
        $currDATE = Carbon::now();

        if (Auth::user()->User_Type_ID == 3) {
            $db_entries = DB::table('boris_brgy_ordinances_and_resolutions_information as a')
                ->leftjoin('maintenance_boris_status_of_ordinance_or_resolution as b', 'a.Status_of_Ordinance_or_Resolution_ID', '=', 'b.Status_of_Ordinance_or_Resolution_ID')
                ->select(
                    'a.Ordinance_Resolution_ID',
                    'a.Ordinance_or_Resolution',
                    'a.Ordinance_Resolution_No',
                    'a.Date_of_Approval',
                    'a.Date_of_Effectivity',
                    'a.Ordinance_Resolution_Title',
                    'a.Status_of_Ordinance_or_Resolution_ID',
                    'b.Name_of_Status'

                )
                ->where('a.Ordinance_or_Resolution', 1)
                ->where('a.Province_ID', Auth::user()->Province_ID)
                ->paginate(20, ['*'], 'db_entries');
        } elseif (Auth::user()->User_Type_ID == 1) {
            $db_entries = DB::table('boris_brgy_ordinances_and_resolutions_information as a')
                ->leftjoin('maintenance_boris_status_of_ordinance_or_resolution as b', 'a.Status_of_Ordinance_or_Resolution_ID', '=', 'b.Status_of_Ordinance_or_Resolution_ID')
                ->select(
                    'a.Ordinance_Resolution_ID',
                    'a.Ordinance_or_Resolution',
                    'a.Ordinance_Resolution_No',
                    'a.Date_of_Approval',
                    'a.Date_of_Effectivity',
                    'a.Ordinance_Resolution_Title',
                    'a.Status_of_Ordinance_or_Resolution_ID',
                    'b.Name_of_Status'

                )
                ->where('a.Ordinance_or_Resolution', 1)
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');
        }

        $city1 = DB::table('maintenance_city_municipality')
            ->where('Province_ID', Auth::user()->Province_ID)
            ->get();
        $region = DB::table('maintenance_region')->where('Active', 1)->get();
        $province = DB::table('maintenance_province')->where('Active', 1)->get();
        $city = DB::table('maintenance_city_municipality')->where('Active', 1)->get();
        $barangay = DB::table('maintenance_barangay')->where('Active', 1)->get();
        $status = DB::table('maintenance_boris_status_of_ordinance_or_resolution')->where('Active', 1)->get();
        $type = DB::table('maintenance_boris_type_of_ordinance_or_resolution')->where('Active', 1)->get();
        $category = DB::table('maintenance_boris_category_of_ordinance_or_resolution_id')->where('Active', 1)->get();
        $brgy_official = DB::table('bips_brgy_officials_and_staff as a')
            ->join('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->select(
                'a.Resident_ID',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
            )
            ->groupBy('a.Resident_ID', 'b.Last_Name', 'b.First_Name', 'b.Middle_Name')
            ->where('a.Active', 1)
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->get();

        return view('boris_transactions.resolutions_list', compact(
            'db_entries',
            'currDATE',
            'region',
            'province',
            'city',
            'barangay',
            'status',
            'type',
            'category',
            'city1',
            'brgy_official'
        ));
    }

    // Save Inhabitants Household Info
    public function create_ordinance_and_resolution(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        if ($data['Ordinance_Resolution_ID'] == null || $data['Ordinance_Resolution_ID'] == 0) {
            $Ordinance_Resolution_ID =  DB::table('boris_brgy_ordinances_and_resolutions_information')->insertGetID(
                array(
                    'Ordinance_or_Resolution' => (int)$data['Ordinance_or_Resolution'],
                    'Ordinance_Resolution_No' => $data['Ordinance_Resolution_No'],
                    'Date_of_Approval' => $data['Date_of_Approval'],
                    'Date_of_Effectivity' => $data['Date_of_Effectivity'],
                    'Ordinance_Resolution_Title' => $data['Ordinance_Resolution_Title'],
                    'Status_of_Ordinance_or_Resolution_ID' => $data['Status_of_Ordinance_or_Resolution_ID'],
                    'Previous_Related_Ordinance_Resolution_ID' => $data['Previous_Related_Ordinance_Resolution_ID'],
                    'Barangay_ID' => Auth::user()->Barangay_ID,
                    'City_Municipality_ID' => Auth::user()->City_Municipality_ID,
                    'Province_ID' => Auth::user()->Province_ID,
                    'Region_ID' => Auth::user()->Region_ID,
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now(),
                    'Approver_ID' => $data['Approver_ID'],

                )
            );

            if ($request->hasfile('fileattach')) {
                foreach ($request->file('fileattach') as $file) {
                    $filename = $file->getClientOriginalName();
                    // $filename = pathinfo($fileinfo, PATHINFO_FILENAME);
                    $filePath = public_path() . '/files/uploads/ordinance_and_resolution/';
                    $file->move($filePath, $filename);

                    $file_data = array(
                        'Ordinance_Resolution_ID' => $Ordinance_Resolution_ID,
                        'File_Name' => $filename,
                        'File_Location' => $filePath,
                        'Encoder_ID'       => Auth::user()->id,
                        'Date_Stamp'       => Carbon::now()
                    );
                    DB::table('boris_file_attachment')->insert($file_data);
                }
            }

            if (isset($data['Attester_ID'])) {
                $attester = [];

                for ($i = 0; $i < count($data['Attester_ID']); $i++) {
                    if ($data['Attester_ID'][$i] != NULL) {

                        $id = 0 + DB::table('boris_attester')->max('id');
                        $id += 1;

                        $attester = [
                            'Ordinance_Resolution_ID' => $Ordinance_Resolution_ID,
                            'Resident_ID' => $data['Attester_ID'][$i],
                            'created_at'       => Carbon::now()
                        ];

                        DB::table('boris_attester')->updateOrInsert(['id' => $id], $attester);
                    }
                }
            }

            return redirect()->back()->with('message', 'New Record Created');
        } else {
            DB::table('boris_brgy_ordinances_and_resolutions_information')->where('Ordinance_Resolution_ID', $data['Ordinance_Resolution_ID'])->update(
                array(
                    'Ordinance_or_Resolution' => (int)$data['Ordinance_or_Resolution'],
                    'Ordinance_Resolution_No' => $data['Ordinance_Resolution_No'],
                    'Date_of_Approval' => $data['Date_of_Approval'],
                    'Date_of_Effectivity' => $data['Date_of_Effectivity'],
                    'Ordinance_Resolution_Title' => $data['Ordinance_Resolution_Title'],
                    'Status_of_Ordinance_or_Resolution_ID' => $data['Status_of_Ordinance_or_Resolution_ID'],
                    'Previous_Related_Ordinance_Resolution_ID' => $data['Previous_Related_Ordinance_Resolution_ID'],
                    'Barangay_ID' => Auth::user()->Barangay_ID,
                    'City_Municipality_ID' => Auth::user()->City_Municipality_ID,
                    'Province_ID' => Auth::user()->Province_ID,
                    'Region_ID' => Auth::user()->Region_ID,
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now(),
                    'Approver_ID' => $data['Approver_ID'],
                )
            );

            if ($request->hasfile('fileattach')) {
                foreach ($request->file('fileattach') as $file) {
                    $filename = $file->getClientOriginalName();
                    // $filename = pathinfo($fileinfo, PATHINFO_FILENAME);
                    $filePath = public_path() . '/files/uploads/ordinance_and_resolution/';
                    $file->move($filePath, $filename);

                    $file_data = array(
                        'Ordinance_Resolution_ID' => $data['Ordinance_Resolution_ID'],
                        'File_Name' => $filename,
                        'File_Location' => $filePath,
                        'Encoder_ID'       => Auth::user()->id,
                        'Date_Stamp'       => Carbon::now()
                    );
                    DB::table('boris_file_attachment')->insert($file_data);
                }
            }

            if (isset($data['Attester_ID'])) {
                $attester = [];

                DB::table('boris_attester')
                    ->where('Ordinance_Resolution_ID', $data['Ordinance_Resolution_ID'])
                    ->delete();

                for ($i = 0; $i < count($data['Attester_ID']); $i++) {
                    if ($data['Attester_ID'][$i] != NULL) {

                        $id = 0 + DB::table('boris_attester')->max('id');
                        $id += 1;

                        $attester = [
                            'Ordinance_Resolution_ID' => $data['Ordinance_Resolution_ID'],
                            'Resident_ID' => $data['Attester_ID'][$i],
                            'created_at'       => Carbon::now()
                        ];

                        DB::table('boris_attester')->updateOrInsert(['id' => $id], $attester);
                    }
                }
            }

            return redirect()->back()->with('message', 'Record Updated');
        }
    }

    // Display Household Details
    public function get_ordinance_and_resolution_info(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('boris_brgy_ordinances_and_resolutions_information as a')
            ->leftjoin('maintenance_barangay as b', 'a.Barangay_ID', '=', 'b.Barangay_ID')
            ->leftjoin('maintenance_city_municipality as c', 'a.City_Municipality_ID', '=', 'c.City_Municipality_ID')
            ->leftjoin('maintenance_province as d', 'a.Province_ID', '=', 'd.Province_ID')
            ->select(
                'a.Ordinance_Resolution_ID',
                'a.Ordinance_or_Resolution',
                'a.Ordinance_Resolution_No',
                'a.Date_of_Approval',
                'a.Date_of_Effectivity',
                'a.Ordinance_Resolution_Title',
                'a.Status_of_Ordinance_or_Resolution_ID',
                'a.Previous_Related_Ordinance_Resolution_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Province_ID',
                'a.Region_ID',
                'b.Barangay_Name',
                'c.City_Municipality_Name',
                'd.Province_Name',
                'a.Approver_ID'
            )
            ->where('a.Ordinance_Resolution_ID', $id)
            ->get();

        return (compact('theEntry'));
    }

    public function get_ordinance_attachments(Request $request)
    {
        $id = $_GET['id'];
        $Ordinance_Attach = DB::table('boris_file_attachment')
            ->where('Ordinance_Resolution_ID', $id)
            ->get();
        return json_encode($Ordinance_Attach);
    }

    public function delete_ordinance_attachments(Request $request)
    {
        $id = $_GET['id'];

        $fileinfo = DB::table('boris_file_attachment')->where('Attachment_ID', $id)->get();
        if (File::exists('./files/uploads/ordinance_and_resolution/' . $fileinfo[0]->File_Name)) {
            unlink(public_path('./files/uploads/ordinance_and_resolution/' . $fileinfo[0]->File_Name));
        }
        DB::table('boris_file_attachment')->where('Attachment_ID', $id)->delete();

        return response()->json(array('success' => true));
    }


    public function downloadPDF(Request $request)
    {
        $data = request()->all();

        $chk_Ordinance = $data['chk_Ordinance'];
        $chk_Ordinance_No = isset($data['chk_Ordinance_No']) ? 1 : 0;
        $chk_Approval = isset($data['chk_Approval']) ? 1 : 0;
        $chk_Effectivity = isset($data['chk_Effectivity']) ? 1 : 0;
        $chk_Title = isset($data['chk_Title']) ? 1 : 0;
        $chk_Status = isset($data['chk_Status']) ? 1 : 0;
        $chk_Region = isset($data['chk_Region']) ? 1 : 0;
        $chk_Province = isset($data['chk_Province']) ? 1 : 0;
        $chk_City = isset($data['chk_City']) ? 1 : 0;
        $chk_Barangay = isset($data['chk_Barangay']) ? 1 : 0;

        $details = DB::table('boris_brgy_ordinances_and_resolutions_information as a')
            ->leftjoin('maintenance_boris_status_of_ordinance_or_resolution as b', 'a.Status_of_Ordinance_or_Resolution_ID', '=', 'b.Status_of_Ordinance_or_Resolution_ID')
            ->select(
                'a.Ordinance_Resolution_ID',
                'a.Ordinance_or_Resolution',
                'a.Ordinance_Resolution_No',
                'a.Date_of_Approval',
                'a.Date_of_Effectivity',
                'a.Ordinance_Resolution_Title',
                'a.Status_of_Ordinance_or_Resolution_ID',
                'b.Name_of_Status'

            )
            ->where('a.Ordinance_or_Resolution', $chk_Ordinance)
            ->paginate(20, ['*'], 'details');
        //dd($detail);

        $pdf = PDF::loadView('boris_transactions.BorisPDF', compact(
            'chk_Ordinance',
            'chk_Ordinance_No',
            'chk_Approval',
            'chk_Effectivity',
            'chk_Title',
            'chk_Status',
            'chk_Region',
            'chk_Province',
            'chk_City',
            'chk_Barangay',
            'details'
        ));
        $daFileNeym = "Ordinance_&_Resolution.pdf";
        return $pdf->download($daFileNeym);
    }

    public function viewPDF(Request $request)
    {
        $data = request()->all();


        $chk_Ordinance = $data['chk_Ordinance'];
        $chk_Ordinance_No = isset($data['chk_Ordinance_No']) ? 1 : 0;
        $chk_Approval = isset($data['chk_Approval']) ? 1 : 0;
        $chk_Effectivity = isset($data['chk_Effectivity']) ? 1 : 0;
        $chk_Title = isset($data['chk_Title']) ? 1 : 0;
        $chk_Status = isset($data['chk_Status']) ? 1 : 0;
        $chk_Region = isset($data['chk_Region']) ? 1 : 0;
        $chk_Province = isset($data['chk_Province']) ? 1 : 0;
        $chk_City = isset($data['chk_City']) ? 1 : 0;
        $chk_Barangay = isset($data['chk_Barangay']) ? 1 : 0;



        $details = DB::table('boris_brgy_ordinances_and_resolutions_information as a')
            ->leftjoin('maintenance_boris_status_of_ordinance_or_resolution as b', 'a.Status_of_Ordinance_or_Resolution_ID', '=', 'b.Status_of_Ordinance_or_Resolution_ID')
            ->select(
                'a.Ordinance_Resolution_ID',
                'a.Ordinance_or_Resolution',
                'a.Ordinance_Resolution_No',
                'a.Date_of_Approval',
                'a.Date_of_Effectivity',
                'a.Ordinance_Resolution_Title',
                'a.Status_of_Ordinance_or_Resolution_ID',
                'b.Name_of_Status'

            )
            ->where('a.Ordinance_or_Resolution', $chk_Ordinance)
            ->paginate(20, ['*'], 'details');

        $pdf = PDF::loadView('boris_transactions.BorisPDF', compact(
            'chk_Ordinance',
            'chk_Ordinance_No',
            'chk_Approval',
            'chk_Effectivity',
            'chk_Title',
            'chk_Status',
            'chk_Region',
            'chk_Province',
            'chk_City',
            'chk_Barangay',
            'details'
        ));
        return $pdf->stream();
    }

    public function get_ordinance($Barangay_ID)
    {
        $data = DB::table('boris_brgy_ordinances_and_resolutions_information as a')
            ->leftjoin('maintenance_boris_status_of_ordinance_or_resolution as b', 'a.Status_of_Ordinance_or_Resolution_ID', '=', 'b.Status_of_Ordinance_or_Resolution_ID')
            ->select(
                'a.Ordinance_Resolution_ID',
                'a.Ordinance_or_Resolution',
                'a.Ordinance_Resolution_No',
                'a.Date_of_Approval',
                'a.Date_of_Effectivity',
                'a.Ordinance_Resolution_Title',
                'a.Status_of_Ordinance_or_Resolution_ID',
                'b.Name_of_Status'

            )
            ->where('a.Barangay_ID', $Barangay_ID)
            ->where('a.Ordinance_or_Resolution', 0)
            ->get();
        return json_encode($data);
    }

    public function get_resolution($Barangay_ID)
    {
        $data = DB::table('boris_brgy_ordinances_and_resolutions_information as a')
            ->leftjoin('maintenance_boris_status_of_ordinance_or_resolution as b', 'a.Status_of_Ordinance_or_Resolution_ID', '=', 'b.Status_of_Ordinance_or_Resolution_ID')
            ->select(
                'a.Ordinance_Resolution_ID',
                'a.Ordinance_or_Resolution',
                'a.Ordinance_Resolution_No',
                'a.Date_of_Approval',
                'a.Date_of_Effectivity',
                'a.Ordinance_Resolution_Title',
                'a.Status_of_Ordinance_or_Resolution_ID',
                'b.Name_of_Status'

            )
            ->where('a.Barangay_ID', $Barangay_ID)
            ->where('a.Ordinance_or_Resolution', 1)
            ->get();
        return json_encode($data);
    }

    public function get_ordinance_and_resolution_attester(Request $request)
    {
        $id = $_GET['id'];

        $data = DB::table('boris_attester')
            ->where('Ordinance_Resolution_ID', $id)
            ->get();

        return json_encode($data);
    }
}
