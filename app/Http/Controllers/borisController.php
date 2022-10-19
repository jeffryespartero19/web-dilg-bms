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
            ->paginate(20, ['*'], 'db_entries');

        $region = DB::table('maintenance_region')->where('Active', 1)->get();
        $province = DB::table('maintenance_province')->where('Active', 1)->get();
        $city = DB::table('maintenance_city_municipality')->where('Active', 1)->get();
        $barangay = DB::table('maintenance_barangay')->where('Active', 1)->get();
        $status = DB::table('maintenance_boris_status_of_ordinance_or_resolution')->where('Active', 1)->get();
        $type = DB::table('maintenance_boris_type_of_ordinance_or_resolution')->where('Active', 1)->get();
        $category = DB::table('maintenance_boris_category_of_ordinance_or_resolution_id')->where('Active', 1)->get();

        return view('boris_transactions.ordinances_and_resolutions_list', compact(
            'db_entries',
            'currDATE',
            'region',
            'province',
            'city',
            'barangay',
            'status',
            'type',
            'category',
        ));
    }

    //Ordinance List
    public function resolutions_list(Request $request)
    {
        $currDATE = Carbon::now();
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
            ->paginate(20, ['*'], 'db_entries');

        $region = DB::table('maintenance_region')->where('Active', 1)->get();
        $province = DB::table('maintenance_province')->where('Active', 1)->get();
        $city = DB::table('maintenance_city_municipality')->where('Active', 1)->get();
        $barangay = DB::table('maintenance_barangay')->where('Active', 1)->get();
        $status = DB::table('maintenance_boris_status_of_ordinance_or_resolution')->where('Active', 1)->get();
        $type = DB::table('maintenance_boris_type_of_ordinance_or_resolution')->where('Active', 1)->get();
        $category = DB::table('maintenance_boris_category_of_ordinance_or_resolution_id')->where('Active', 1)->get();

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
                    'Barangay_ID' => $data['Barangay_ID'],
                    'City_Municipality_ID' => $data['City_Municipality_ID'],
                    'Province_ID' => $data['Province_ID'],
                    'Region_ID' => $data['Region_ID'],
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now()
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
                    'Barangay_ID' => $data['Barangay_ID'],
                    'City_Municipality_ID' => $data['City_Municipality_ID'],
                    'Province_ID' => $data['Province_ID'],
                    'Region_ID' => $data['Region_ID'],
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now()
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
}
