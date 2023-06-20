<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\File;
use PDF;
use App\Exports\BusinessPermitExportView;
use App\Exports\DocumentInformationExportView;
use App\Exports\BrgyBusinessExportView;
use Maatwebsite\Excel\Facades\Excel;

class BCPISController extends Controller
{
        public function get_brgydocument(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('bcpcis_brgy_document_information as a')
        ->leftjoin('bcpcis_brgy_payment_collected as b', 'a.Document_ID', '=', 'b.Document_ID')
        ->leftjoin('maintenance_bcpcis_purpose_of_document as c', 'a.Purpose_of_Document_ID', '=', 'c.Purpose_of_Document_ID')
        ->leftjoin('maintenance_bcpcis_document_type as d', 'a.Document_Type_ID', '=', 'd.Document_Type_ID')
        ->leftjoin('bips_brgy_inhabitants_information as e', 'a.Resident_ID', '=', 'e.Resident_ID')
            ->select(
                'a.Document_ID',
                'a.Transaction_No',
                'a.Brgy_Cert_No', 
                'd.Document_Type_Name',
                'c.Purpose_of_Document',  
                DB::raw('CONCAT(e.First_Name, " ",LEFT(e.Middle_Name,1),". ",e.Last_Name) AS Resident_Name'),
                'a.Request_Date',
                'a.Remarks',
                'a.Salutation_Name',
                'a.SecondResident_Name', 
                 DB::raw('(CASE WHEN a.Released = false THEN "No" ELSE "Yes" END) AS Released'),
                'a.Issued_On',
                'a.Issued_At',
                'b.OR_Date',
                'b.OR_No',
                'b.Cash_Tendered',
                'b.CTC_No',
                'b.CTC_Details',
                'b.CTC_Date_Issued',
                'b.CTC_Amount',
                'b.Place_Issued',
            )
            ->where('a.Document_ID', $id)->get();

        return (compact('theEntry'));
    }


   
    public function brgydocument_downloadPDF(Request $request)
    {   
        
        $data = request()->all();


        $chk_Transaction_No = isset($data['chk_Transaction_No']) ? 1 : 0;
        $chk_Request_Date = isset($data['chk_Request_Date']) ? 1 : 0;
        $chk_Resident_Name = isset($data['chk_Resident_Name']) ? 1 : 0;
        $chk_Released = isset($data['chk_Released']) ? 1 : 0;
        $chk_Remarks = isset($data['chk_Remarks']) ? 1 : 0;
        $chk_Purpose_of_Document = isset($data['chk_Purpose_of_Document']) ? 1 : 0;
        $chk_Salutation_Name = isset($data['chk_Salutation_Name']) ? 1 : 0;
        $chk_Issued_On = isset($data['chk_Issued_On']) ? 1 : 0;
        // $chk_Issued_At = isset($data['chk_Issued_At']) ? 1 : 0;
        $chk_Brgy_Cert_No = isset($data['chk_Brgy_Cert_No']) ? 1 : 0;
        $chk_Document_Type_Name = isset($data['chk_Document_Type_Name']) ? 1 : 0;
        $chk_SecondResident_Name = isset($data['chk_SecondResident_Name']) ? 1 : 0;
        $chk_OR_No = isset($data['chk_OR_No']) ? 1 : 0;
        $chk_Cash_Tendered = isset($data['chk_Cash_Tendered']) ? 1 : 0;

        $db_entries = DB::table('bcpcis_brgy_document_information as a')
        ->leftjoin('bcpcis_brgy_payment_collected as b', 'a.Document_ID', '=', 'b.Document_ID')
        ->leftjoin('maintenance_bcpcis_purpose_of_document as c', 'a.Purpose_of_Document_ID', '=', 'c.Purpose_of_Document_ID')
        ->leftjoin('maintenance_bcpcis_document_type as d', 'a.Document_Type_ID', '=', 'd.Document_Type_ID')
        ->leftjoin('bips_brgy_inhabitants_information as e', 'a.Resident_ID', '=', 'e.Resident_ID')
            ->select(
                'a.Document_ID',
                'a.Transaction_No',
                'a.Brgy_Cert_No', 
                'd.Document_Type_Name',
                'c.Purpose_of_Document',  
                DB::raw('CONCAT(e.First_Name, " ",LEFT(e.Middle_Name,1),". ",e.Last_Name) AS Resident_Name'),
                'a.Request_Date',
                'a.Remarks',
                'a.Salutation_Name',
                'a.SecondResident_Name', 
                 DB::raw('(CASE WHEN a.Released = false THEN "No" ELSE "Yes" END) AS Released'),
                'a.Issued_On',
                'a.Issued_At',
                'b.OR_Date',
                'b.OR_No',
                'b.Cash_Tendered',
            )
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->paginate(20, ['*'], 'details');

        //dd($detail);

        $pdf = PDF::loadView('bcpcis_transactions.brgy_document_List_PDF', compact(
            'chk_Transaction_No',
            'chk_Request_Date',
            'chk_Resident_Name',
            'chk_Released',
            'chk_Remarks',
            'chk_Purpose_of_Document',
            'chk_Salutation_Name',
            'chk_Issued_On',
            'chk_Brgy_Cert_No',
            'chk_Document_Type_Name',
            'chk_SecondResident_Name',
            'chk_OR_No',
            'chk_Cash_Tendered',
            'db_entries',
        ))->setPaper('a4', 'landscape');
        $daFileNeym = "Brgy_Document_List.pdf";
        return $pdf->download($daFileNeym);
    }

    //Brgy Document Information List 
    public function brgy_document_information_list(Request $request)
    {
        $currDATE = Carbon::now();

        if (Auth::user()->User_Type_ID == 1) {
         $db_entries = DB::table('bcpcis_brgy_document_information as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('maintenance_bcpcis_purpose_of_document as g', 'a.Purpose_of_Document_ID', '=', 'g.Purpose_of_Document_ID')
        ->leftjoin('maintenance_bcpcis_document_type as h', 'a.Document_Type_ID', '=', 'h.Document_Type_ID') 
        ->leftjoin('bips_brgy_inhabitants_information as i', 'a.Resident_ID', '=', 'i.Resident_ID')
        ->leftjoin('bcpcis_brgy_payment_collected as j', 'j.Document_ID', '=', 'a.Document_ID')
            ->select(
                'a.Document_ID',
                'a.Transaction_No',
                'a.Request_Date',
                DB::raw('(CASE WHEN a.Released = false THEN "No" ELSE "Yes" END) AS Released'),
                'a.Remarks',
                'a.Purpose_of_Document_ID',
                'a.Salutation_Name',
                'a.Picture',
                'j.CTC_No',
                'a.Issued_On',
                'a.Issued_At',
                'a.Document_Type_ID',
                'a.Resident_ID',
                'a.SecondResident_Name',
                'a.Region_ID',
                'a.Province_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'a.Request_Status_ID',
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'g.Purpose_of_Document',  
                'h.Document_Type_Name',
                DB::raw('CONCAT(i.First_Name, " ",LEFT(i.Middle_Name,1),". ",i.Last_Name) AS Resident_Name'),

            )
            ->where([['a.Request_Status_ID', 3],['a.Barangay_ID', Auth::user()->Barangay_ID]])
            ->paginate(20, ['*'], 'db_entries');


        return view('bcpcis_transactions.brgy_document_information_list', compact(
            'db_entries',
            'currDATE',
            
        ));
        }elseif (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4) {
        $db_entries = DB::table('bcpcis_brgy_document_information as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('maintenance_bcpcis_purpose_of_document as g', 'a.Purpose_of_Document_ID', '=', 'g.Purpose_of_Document_ID')
        ->leftjoin('maintenance_bcpcis_document_type as h', 'a.Document_Type_ID', '=', 'h.Document_Type_ID')
        ->leftjoin('bips_brgy_inhabitants_information as i', 'a.Resident_ID', '=', 'i.Resident_ID')
            ->select(
                'a.Document_ID',
                'a.Transaction_No',
                'a.Request_Date',
                'a.Released',
                'a.Remarks',
                'a.Purpose_of_Document_ID',
                'a.Salutation_Name',
                'a.Picture',
                'a.CTC_No',
                'a.Issued_On',
                'a.Issued_At',
                'a.Document_Type_ID',
                'a.Resident_ID',
                'a.SecondResident_Name',
                'a.Region_ID',
                'a.Province_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'a.Request_Status_ID',
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'g.Purpose_of_Document',  
                'h.Document_Type_Name',
                DB::raw('CONCAT(i.First_Name, " ",LEFT(i.Middle_Name,1),". ",i.Last_Name) AS Resident_Name'),

            )
            ->where([['a.Request_Status_ID', 3],['a.Barangay_ID', Auth::user()->Barangay_ID]])
            ->paginate(20, ['*'], 'db_entries');
        $region1 = DB::table('maintenance_region')->where('Active', 1)->get();        

        return view('bcpcis_transactions.brgy_document_information_list', compact(
            'db_entries',
            'currDATE',
            'region1',
            
        ));
        }
    }

    //Brgy Document Infomation Details
    public function brgy_document_information_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $purpose = DB::table('maintenance_bcpcis_purpose_of_document')->paginate(20, ['*'], 'purpose');
            $document_type = DB::table('maintenance_bcpcis_document_type')->paginate(20, ['*'], 'document_type');
            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
            return view('bcpcis_transactions.brgy_document_information', compact(
                'currDATE',
                'purpose',
                'document_type',
                'resident',
                'region',
               
            ));
        } else {
            $document = DB::table('bcpcis_brgy_document_information')->where('Document_ID', $id)->get();
            $purpose = DB::table('maintenance_bcpcis_purpose_of_document')->paginate(20, ['*'], 'purpose');
            $document_type = DB::table('maintenance_bcpcis_document_type')->paginate(20, ['*'], 'document_type');
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $document[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $document[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $document[0]->City_Municipality_ID)->get();
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
            $payment_docu = DB::table('bcpcis_brgy_payment_collected')->where('Document_ID', $id)->get();
            return view('bcpcis_transactions.brgy_document_information_edit', compact(
                'currDATE',
                'document',
                'region',
                'province',
                'barangay',
                'purpose',
                'document_type',
                'resident',
                'city_municipality',
                'payment_docu',
            ));
        }
    }

    public function view_brgy_document_information_details($id)
    {
        $currDATE = Carbon::now();

        
            $document = DB::table('bcpcis_brgy_document_information')->where('Document_ID', $id)->get();
            $purpose = DB::table('maintenance_bcpcis_purpose_of_document')->paginate(20, ['*'], 'purpose');
            $document_type = DB::table('maintenance_bcpcis_document_type')->paginate(20, ['*'], 'document_type');
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $document[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $document[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $document[0]->City_Municipality_ID)->get();
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
            $payment_docu = DB::table('bcpcis_brgy_payment_collected')->where('Document_ID', $id)->get();
            return view('bcpcis_transactions.brgy_document_information_view', compact(
                'currDATE',
                'document',
                'region',
                'province',
                'barangay',
                'purpose',
                'document_type',
                'resident',
                'city_municipality',
                'payment_docu',
            ));
        
    }

    // Save Brgy Document Information 
    public function create_brgy_document_information(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        $month=Carbon::now()->format('m');
        $day=Carbon::now()->format('d');
        $year=Carbon::now()->format('Y');
        $today= $currDATE->toDateString();

        $File_No = DB::table('bcpcis_brgy_document_information as a')
            ->select(
                DB::raw('MAX(a.File_No) AS File_No')
                )
            ->where([['a.Barangay_ID', Auth::user()->Barangay_ID],[DB::raw('CAST(a.Date_Stamp as date)'), $today]])->get();
            
            // ->where(DB::raw('CAST(a.Date_Stamp as date)'), $today)->get();
        $File_No_Static = $File_No[0]->File_No + 1;
        $File_No_Add = $File_No[0]->File_No + 1;

        $stringLength = strlen($File_No_Add);

        if ($stringLength ==1){
            $File_No_Final='0'. '' .'0'. '' .'0'. '' . $File_No_Add;
        };
        if ($stringLength ==2){
            $File_No_Final='0'. '' .'0'. '' . $File_No_Add;
        };
        if ($stringLength ==3){
            $File_No_Final='0'. '' . $File_No_Add;
        };
        if ($stringLength ==4){
            $File_No_Final=$File_No_Add;
        };



        if ($data['Document_Type_ID'] == 1){
            $validated = $request->validate([
                'OR_No' => 'required',
                'Cash_Tendered' => 'required',
                'CTC_No' => 'required',
                'CTC_Amount' => 'required',
                'Place_Issued' => 'required',
                
            ]);
        }

        if ($data['Document_ID'] == null || $data['Document_ID'] == 0) {
            $Document_ID = DB::table('bcpcis_brgy_document_information')->insertGetId(
                array(
                    'Transaction_No'        => $month. '' .$day. '' .$year. '-' .$File_No_Final,
                    // 'Transaction_No'        => $File_No[0]->File_No,
                    'File_No'               => $File_No_Static,
                    'Request_Date'          => $data['Request_Date'],
                    'Remarks'               => $data['Remarks'],
                    'Released'              => (int)$data['Released'],
                    'Purpose_of_Document_ID'=> $data['Purpose_of_Document_ID'],
                    'Salutation_Name'       => $data['Salutation_Name'],
                    'Issued_On'             => $data['Issued_On'],
                    // 'Issued_At'             => $data['Issued_At'],
                    'Brgy_Cert_No'          => $data['Brgy_Cert_No'],
                    'Document_Type_ID'      => $data['Document_Type_ID'],
                    'Resident_ID'           => $data['Resident_ID'],
                    'SecondResident_Name'   => $data['SecondResident_Name'],
                    'Request_Status_ID'     => 3,
                    'Barangay_ID'           => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'  => Auth::user()->City_Municipality_ID,
                    'Province_ID'           => Auth::user()->Province_ID,
                    'Region_ID'             => Auth::user()->Region_ID,
                    'Encoder_ID'            => Auth::user()->id,
                    'Date_Stamp'            => Carbon::now(),

                )

            );

            DB::table('bcpcis_brgy_payment_collected')->insertGetId(
                array(
                    'Document_ID'                               => $Document_ID,
                    'OR_Date'                                   => $data['OR_Date'],
                    'OR_No'                                     => $data['OR_No'],
                    'Cash_Tendered'                             => $data['Cash_Tendered'],
                    'CTC_Details'                               => $data['CTC_Details'],
                    'CTC_Date_Issued'                           => $data['CTC_Date_Issued'],
                    'CTC_No'                                    => $data['CTC_No'],
                    'CTC_Amount'                                => $data['CTC_Amount'],
                    'Place_Issued'                              => $data['Place_Issued'],
                    'Barangay_ID'                               => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'                      => Auth::user()->City_Municipality_ID,
                    'Province_ID'                               => Auth::user()->Province_ID,
                    'Region_ID'                                 => Auth::user()->Region_ID,
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),

                )
            );


            


            
            return redirect()->to('brgy_document_information_details/' . $Document_ID)->with('message', 'New Document Information Created');
        } else {
            DB::table('bcpcis_brgy_document_information')->where('Document_ID', $data['Document_ID'])->update(
                array(
                    // 'Transaction_No'        => $data['Transaction_No'],
                    'Request_Date'          => $data['Request_Date'],
                    'Remarks'               => $data['Remarks'],
                    'Released'              => (int)$data['Released'],
                    'Purpose_of_Document_ID'=> $data['Purpose_of_Document_ID'],
                    'Salutation_Name'       => $data['Salutation_Name'],
                    'Issued_On'             => $data['Issued_On'],
                    // 'Issued_At'             => $data['Issued_At'],
                    'Brgy_Cert_No'          => $data['Brgy_Cert_No'],
                    'Document_Type_ID'      => $data['Document_Type_ID'],
                    'Resident_ID'           => $data['Resident_ID'],
                    'SecondResident_Name'   => $data['SecondResident_Name'],
                    'Barangay_ID'           => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'  => Auth::user()->City_Municipality_ID,
                    'Province_ID'           => Auth::user()->Province_ID,
                    'Region_ID'             => Auth::user()->Region_ID,
                    'Encoder_ID'            => Auth::user()->id,
                    'Date_Stamp'            => Carbon::now(),
                )

                
            );

            DB::table('bcpcis_brgy_payment_collected')->where('Document_ID', $data['Document_ID'])->update(
                array(
                    'OR_Date'                                   => $data['OR_Date'],
                    'OR_No'                                     => $data['OR_No'],
                    'Cash_Tendered'                             => $data['Cash_Tendered'],
                    'CTC_Details'                               => $data['CTC_Details'],
                    'CTC_Date_Issued'                           => $data['CTC_Date_Issued'],
                    'CTC_No'                                    => $data['CTC_No'],
                    'CTC_Amount'                                => $data['CTC_Amount'],
                    'Place_Issued'                              => $data['Place_Issued'],
                    'Barangay_ID'                               => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'                      => Auth::user()->City_Municipality_ID,
                    'Province_ID'                               => Auth::user()->Province_ID,
                    'Region_ID'                                 => Auth::user()->Region_ID,
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),
                )

            );

            
         
            return redirect()->back()->with('message', 'Information Updated');
        }
    }

    
    public function get_brgybusiness(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('maintenance_bcpcis_barangay_business as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('maintenance_bcpcis_business_type as f', 'a.Business_Type_ID', '=', 'f.Business_Type_ID')
            ->select(
                'a.Business_ID',
                'a.Business_Name',
                'a.Business_Type_ID',
                'a.Business_Tin',
                'a.Business_Owner',
                'a.Business_Address',
                'a.Mobile_No',
                'a.Region_ID',
                'a.Province_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'f.Business_Type',
                DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active')

            )
            ->where('Business_ID', $id)->get();

        return (compact('theEntry'));
    }
    
    public function brgybusiness_downloadPDF(Request $request)
    {   
        // $id = $_GET['id'];
        $data = request()->all();

        $chk_Business_Name = isset($data['chk_Business_Name']) ? 1 : 0;
        $chk_Business_Type = isset($data['chk_Business_Type']) ? 1 : 0;
        $chk_Business_Tin = isset($data['chk_Business_Tin']) ? 1 : 0;
        $chk_Business_Owner = isset($data['chk_Business_Owner']) ? 1 : 0;
        $chk_Business_Address = isset($data['chk_Business_Address']) ? 1 : 0;
        $chk_Mobile_No = isset($data['chk_Mobile_No']) ? 1 : 0;
        $chk_Active = isset($data['chk_Active']) ? 1 : 0;

        $db_entries = DB::table('maintenance_bcpcis_barangay_business as a')
        ->leftjoin('maintenance_bcpcis_business_type as b', 'a.Business_Type_ID', '=', 'b.Business_Type_ID')
            ->select(
                'a.Business_ID',
                'a.Business_Name',
                'a.Business_Tin',
                'a.Business_Owner',
                'a.Business_Address',
                'a.Mobile_No',    
                'b.Business_Type',
                DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active')

            )
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->paginate(20, ['*'], 'details');

        //dd($detail);

        $pdf = PDF::loadView('bcpcis_transactions.brgy_business_List_PDF', compact(
            'chk_Business_Type',
            'chk_Business_Name',
            'chk_Business_Tin',
            'chk_Business_Owner',
            'chk_Business_Address',
            'chk_Mobile_No',
            'chk_Active',
            'db_entries',
        ))->setPaper('a4', 'landscape');
        $daFileNeym = "Brgy_Business_List.pdf";
        return $pdf->download($daFileNeym);
    }

    //Barangay Business List
    public function barangay_business_list(Request $request)
    {
        $currDATE = Carbon::now();
        if (Auth::user()->User_Type_ID == 1) {
            $db_entries = DB::table('maintenance_bcpcis_barangay_business as a')
            ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
            ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
            ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
            ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
            ->leftjoin('maintenance_bcpcis_business_type as f', 'a.Business_Type_ID', '=', 'f.Business_Type_ID')
                ->select(
                    'a.Business_ID',
                    'a.Business_Name',
                    'a.Business_Type_ID',
                    'a.Business_Tin',
                    'a.Business_Owner',
                    'a.Business_Address',
                    'a.Mobile_No',
                    
                    'a.Region_ID',
                    'a.Province_ID',
                    'a.Barangay_ID',
                    'a.City_Municipality_ID',
                    'a.Encoder_ID',
                    'a.Date_Stamp',
                    'b.Region_Name',
                    'c.Province_Name',
                    'e.Barangay_Name',
                    'd.City_Municipality_Name',    
                    'f.Business_Type',
                    DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),
    
                )
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');

        return view('bcpcis_transactions.barangay_business_list', compact(
            'db_entries',
            'currDATE',
            
        ));
        }elseif (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4) {
            $db_entries = DB::table('maintenance_bcpcis_barangay_business as a')
            ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
            ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
            ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
            ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
            ->leftjoin('maintenance_bcpcis_business_type as f', 'a.Business_Type_ID', '=', 'f.Business_Type_ID')
                ->select(
                    'a.Business_ID',
                    'a.Business_Name',
                    'a.Business_Type_ID',
                    'a.Business_Tin',
                    'a.Business_Owner',
                    'a.Business_Address',
                    'a.Mobile_No',
                    'a.Active',
                    'a.Region_ID',
                    'a.Province_ID',
                    'a.Barangay_ID',
                    'a.City_Municipality_ID',
                    'a.Encoder_ID',
                    'a.Date_Stamp',
                    'b.Region_Name',
                    'c.Province_Name',
                    'e.Barangay_Name',
                    'd.City_Municipality_Name',    
                    'f.Business_Type',
    
                )
                ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');
        $region1 = DB::table('maintenance_region')->where('Active', 1)->get();        

        return view('bcpcis_transactions.barangay_business_list', compact(
            'db_entries',
            'currDATE',
            'region1',
            
        ));
        }
    }

    //Barangay Business Details
    public function barangay_business_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $business_type = DB::table('maintenance_bcpcis_business_type')->paginate(20, ['*'], 'business_type');
            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            return view('bcpcis_transactions.barangay_business', compact(
                'currDATE',
                'business_type',
                'region',
               
            ));
        } else {
            $business_type = DB::table('maintenance_bcpcis_business_type')->paginate(20, ['*'], 'business_type');
            $business = DB::table('maintenance_bcpcis_barangay_business')->where('Business_ID', $id)->get();
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $business[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $business[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $business[0]->City_Municipality_ID)->get();
            return view('bcpcis_transactions.barangay_business_edit', compact(
                'currDATE',
                'business',
                'region',
                'province',
                'barangay',
                'business_type',
                'city_municipality',
            ));
        }
    }

    public function view_barangay_business_details($id)
    {
        $currDATE = Carbon::now();

        
            $business_type = DB::table('maintenance_bcpcis_business_type')->paginate(20, ['*'], 'business_type');
            $business = DB::table('maintenance_bcpcis_barangay_business')->where('Business_ID', $id)->get();
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $business[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $business[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $business[0]->City_Municipality_ID)->get();
            return view('bcpcis_transactions.barangay_business_view', compact(
                'currDATE',
                'business',
                'region',
                'province',
                'barangay',
                'business_type',
                'city_municipality',
            ));
       
    }

    // Save Barangay Business
    public function create_barangay_business(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Business_ID'] == null || $data['Business_ID'] == 0) {
            $Business_ID = DB::table('maintenance_bcpcis_barangay_business')->insertGetId(
                array(
                    'Business_Name'         => $data['Business_Name'],
                    'Business_Type_ID'      => $data['Business_Type_ID'],
                    'Business_Tin'          => $data['Business_Tin'],
                    'Business_Owner'        => $data['Business_Owner'],
                    'Business_Address'      => $data['Business_Address'],
                    'Mobile_No'             => $data['Mobile_No'],
                    'Barangay_ID'           => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'  => Auth::user()->City_Municipality_ID,
                    'Province_ID'           => Auth::user()->Province_ID,
                    'Region_ID'             => Auth::user()->Region_ID,
                    'Active'                => (int)$data['Active'],
                    'Encoder_ID'            => Auth::user()->id,
                    'Date_Stamp'            => Carbon::now(),

                )
            );

            return redirect()->to('barangay_business_details/' . $Business_ID)->with('message', 'New Barangay Business Created');
        } else {
            DB::table('maintenance_bcpcis_barangay_business')->where('Business_ID', $data['Business_ID'])->update(
                array(
                    'Business_Name'         => $data['Business_Name'],
                    'Business_Type_ID'      => $data['Business_Type_ID'],
                    'Business_Tin'          => $data['Business_Tin'],
                    'Business_Owner'        => $data['Business_Owner'],
                    'Business_Address'      => $data['Business_Address'],
                    'Mobile_No'             => $data['Mobile_No'],
                    'Barangay_ID'           => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'  => Auth::user()->City_Municipality_ID,
                    'Province_ID'           => Auth::user()->Province_ID,
                    'Region_ID'             => Auth::user()->Region_ID,
                    'Active'                => (int)$data['Active'],
                    'Encoder_ID'            => Auth::user()->id,
                    'Date_Stamp'            => Carbon::now(),
                )
            );

            
         
            return redirect()->back()->with('message', 'Information Updated');
        }
    }

    // Display Contractor buban
    public function get_businesspermit(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('bcpcis_brgy_business_permits as a')
            ->leftjoin('bcpcis_brgy_payment_collected as b', 'a.Barangay_Permits_ID', '=', 'b.Barangay_Permits_ID')
            ->leftjoin('maintenance_bcpcis_barangay_business as f', 'a.Business_ID', '=', 'f.Business_ID')
            ->leftjoin('bips_brgy_inhabitants_information as g', 'a.Resident_ID', '=', 'g.Resident_ID')
           
                ->select(
                    'a.Barangay_Permits_ID',
                    'a.Transaction_No',
                    'a.Occupation',
                    'a.Barangay_Business_Permit_Expiration_Date',
                    'b.CTC_No', 
                    'f.Business_Name',
                    DB::raw('CONCAT(g.First_Name, " ",LEFT(g.Middle_Name,1),". ",g.Last_Name) AS Resident_Name'),
                    DB::raw('(CASE WHEN a.New_or_Renewal = false THEN "Renewal" ELSE "New" END) AS New_or_Renewal'),
                    DB::raw('(CASE WHEN a.Owned_or_Rented = false THEN "Rented" ELSE "Owned" END) AS Owned_or_Rented'),
                    
    
                )
            ->where('a.Barangay_Permits_ID', $id)->get();

        return (compact('theEntry'));
    }
    
   
    public function businesspermit_downloadPDF(Request $request)
    {   
        // $id = $_GET['id'];
        $data = request()->all();


        $chk_Transaction_No = isset($data['chk_Transaction_No']) ? 1 : 0;
        $chk_Business_Name = isset($data['chk_Business_Name']) ? 1 : 0;
        $chk_Resident_Name = isset($data['chk_Resident_Name']) ? 1 : 0;
        $chk_New_or_Renewal = isset($data['chk_New_or_Renewal']) ? 1 : 0;
        $chk_Owned_or_Rented = isset($data['chk_Owned_or_Rented']) ? 1 : 0;
        $chk_Occupation = isset($data['chk_Occupation']) ? 1 : 0;
        $chk_CTC_No = isset($data['chk_CTC_No']) ? 1 : 0;
        $chk_Barangay_Business_Permit_Expiration_Date = isset($data['chk_Barangay_Business_Permit_Expiration_Date']) ? 1 : 0;

        $db_entries = DB::table('bcpcis_brgy_business_permits as a')
        ->leftjoin('bcpcis_brgy_payment_collected as b', 'a.Barangay_Permits_ID', '=', 'b.Barangay_Permits_ID')
        ->leftjoin('maintenance_bcpcis_barangay_business as f', 'a.Business_ID', '=', 'f.Business_ID')
        ->leftjoin('bips_brgy_inhabitants_information as g', 'a.Resident_ID', '=', 'g.Resident_ID')
       
            ->select(
                'a.Barangay_Permits_ID',
                'a.Transaction_No',
                'a.Occupation',
                'a.Barangay_Business_Permit_Expiration_Date',
                'b.CTC_No', 
                'f.Business_Name',
                DB::raw('CONCAT(g.First_Name, " ",LEFT(g.Middle_Name,1),". ",g.Last_Name) AS Resident_Name'),
                DB::raw('(CASE WHEN a.New_or_Renewal = false THEN "Renewal" ELSE "New" END) AS New_or_Renewal'),
                DB::raw('(CASE WHEN a.Owned_or_Rented = false THEN "Rented" ELSE "Owned" END) AS Owned_or_Rented'),
            
            )
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->paginate(20, ['*'], 'details');

        //dd($detail);

        $pdf = PDF::loadView('bcpcis_transactions.brgy_business_permit_List_PDF', compact(
            'chk_Transaction_No',
            'chk_Business_Name',
            'chk_Resident_Name',
            'chk_New_or_Renewal',
            'chk_Owned_or_Rented',
            'chk_Occupation',
            'chk_CTC_No',
            'chk_Barangay_Business_Permit_Expiration_Date',
            'db_entries',
        ))->setPaper('a4', 'landscape');
        $daFileNeym = "Brgy_Business_Permit_List.pdf";
        return $pdf->download($daFileNeym);
    }

    //Brgy Business Permit List
    public function brgy_business_permit_list(Request $request)
    {
        $currDATE = Carbon::now();
        if (Auth::user()->User_Type_ID == 1) {
        $db_entries = DB::table('bcpcis_brgy_business_permits as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('maintenance_bcpcis_barangay_business as f', 'a.Business_ID', '=', 'f.Business_ID')
        ->leftjoin('bips_brgy_inhabitants_information as g', 'a.Resident_ID', '=', 'g.Resident_ID')
            ->select(
                'a.Barangay_Permits_ID',
                'a.Business_ID',
                'a.Resident_ID',
                'a.Transaction_No',
                'a.Barangay_Business_Permit_Expiration_Date',
                'a.CTC_No',
                'a.Region_ID',
                'a.Province_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'f.Business_Name',
                DB::raw('CONCAT(g.First_Name, " ",LEFT(g.Middle_Name,1),". ",g.Last_Name) AS Resident_Name'),
                DB::raw('(CASE WHEN a.New_or_Renewal = false THEN "Renewal" ELSE "New" END) AS New_or_Renewal'),
                DB::raw('(CASE WHEN a.Owned_or_Rented = false THEN "Rented" ELSE "Owned" END) AS Owned_or_Rented'),

            )
            
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->paginate(20, ['*'], 'db_entries');


        return view('bcpcis_transactions.brgy_business_permit_list', compact(
            'db_entries',
            'currDATE',
            
        ));
        }elseif (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4) {
        $db_entries = DB::table('bcpcis_brgy_business_permits as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('maintenance_bcpcis_barangay_business as f', 'a.Business_ID', '=', 'f.Business_ID')
        ->leftjoin('bips_brgy_inhabitants_information as g', 'a.Resident_ID', '=', 'g.Resident_ID')
            ->select(
                'a.Barangay_Permits_ID',
                'a.Business_ID',
                'a.Resident_ID',
                'a.Transaction_No',
                'a.Barangay_Business_Permit_Expiration_Date',
                'a.CTC_No',
                'a.Region_ID',
                'a.Province_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'f.Business_Name',
                DB::raw('CONCAT(g.First_Name, " ",LEFT(g.Middle_Name,1),". ",g.Last_Name) AS Resident_Name'),
                DB::raw('(CASE WHEN a.New_or_Renewal = false THEN "Renewal" ELSE "New" END) AS New_or_Renewal'),
                DB::raw('(CASE WHEN a.Owned_or_Rented = false THEN "Rented" ELSE "Owned" END) AS Owned_or_Rented'),

            )
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->paginate(20, ['*'], 'db_entries');
        $region1 = DB::table('maintenance_region')->where('Active', 1)->get();        

        return view('bcpcis_transactions.brgy_business_permit_list', compact(
            'db_entries',
            'currDATE',
            'region1',
            
        ));
        }
    }

    //Brgy Business Permit Details
    public function brgy_business_permit_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $business = DB::table('maintenance_bcpcis_barangay_business')->paginate(20, ['*'], 'business');
            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
            return view('bcpcis_transactions.brgy_business_permit', compact(
                'currDATE',
                'business',
                'resident',
                'region',
               
            ));
        } else {
            $permit = DB::table('bcpcis_brgy_business_permits')->where('Barangay_Permits_ID', $id)->get();
            $business = DB::table('maintenance_bcpcis_barangay_business')->paginate(20, ['*'], 'business');
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $permit[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $permit[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $permit[0]->City_Municipality_ID)->get();
            $resident = DB::table('bips_brgy_inhabitants_information')->where('Resident_ID', $permit[0]->Resident_ID)->get();
            $payment_docu = DB::table('bcpcis_brgy_payment_collected')->where('Barangay_Permits_ID', $id)->get();
            return view('bcpcis_transactions.brgy_business_permit_edit', compact(
                'currDATE',
                'permit',
                'region',
                'province',
                'barangay',
                'business',
                'resident',
                'city_municipality',
                'payment_docu',
            ));
        }
    }

    public function view_brgy_business_permit_details($id)
    {
        $currDATE = Carbon::now();

        
            $permit = DB::table('bcpcis_brgy_business_permits')->where('Barangay_Permits_ID', $id)->get();
            $business = DB::table('maintenance_bcpcis_barangay_business')->paginate(20, ['*'], 'business');
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $permit[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $permit[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $permit[0]->City_Municipality_ID)->get();
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
            $payment_docu = DB::table('bcpcis_brgy_payment_collected')->where('Barangay_Permits_ID', $id)->get();
            return view('bcpcis_transactions.brgy_business_permit_view', compact(
                'currDATE',
                'permit',
                'region',
                'province',
                'barangay',
                'business',
                'resident',
                'city_municipality',
                'payment_docu',
            ));
      
    }

    // Save Barangay Business Permit
    public function create_barangay_business_permit(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Barangay_Permits_ID'] == null || $data['Barangay_Permits_ID'] == 0) {
            $Barangay_Permits_ID = DB::table('bcpcis_brgy_business_permits')->insertGetId(
                array(
                    'Business_ID'                               => $data['Business_ID'],
                    'Resident_ID'                               => $data['Resident_ID'],
                    'Transaction_No'                            => $data['Transaction_No'],
                    'New_or_Renewal'                            => (int)$data['New_or_Renewal'],
                    'Owned_or_Rented'                           => (int)$data['Owned_or_Rented'],
                    'Barangay_Business_Permit_Expiration_Date'  => $data['Barangay_Business_Permit_Expiration_Date'],
                    'Occupation'                                => $data['Occupation'],
                    'Barangay_ID'                               => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'                      => Auth::user()->City_Municipality_ID,
                    'Province_ID'                               => Auth::user()->Province_ID,
                    'Region_ID'                                 => Auth::user()->Region_ID,
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),

                )
            );

            DB::table('bcpcis_brgy_payment_collected')->insertGetId(
                array(
                    'Barangay_Permits_ID'                       => $Barangay_Permits_ID,
                    'OR_Date'                                   => $data['OR_Date'],
                    'OR_No'                                     => $data['OR_No'],
                    'Cash_Tendered'                             => $data['Cash_Tendered'],
                    'CTC_Details'                               => $data['CTC_Details'],
                    'CTC_Date_Issued'                           => $data['CTC_Date_Issued'],
                    'CTC_No'                                    => $data['CTC_No'],
                    'CTC_Amount'                                => $data['CTC_Amount'],
                    'Place_Issued'                              => $data['Place_Issued'],
                    'Barangay_ID'                               => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'                      => Auth::user()->City_Municipality_ID,
                    'Province_ID'                               => Auth::user()->Province_ID,
                    'Region_ID'                                 => Auth::user()->Region_ID,
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),

                )
            );


            return redirect()->to('brgy_business_permit_details/' . $Barangay_Permits_ID)->with('message', 'New Business Permits Created');
        } else {
            DB::table('bcpcis_brgy_business_permits')->where('Barangay_Permits_ID', $data['Barangay_Permits_ID'])->update(
                array(
                    'Business_ID'                               => $data['Business_ID'],
                    'Resident_ID'                               => $data['Resident_ID'],
                    'Transaction_No'                            => $data['Transaction_No'],
                    'New_or_Renewal'                            => (int)$data['New_or_Renewal'],
                    'Owned_or_Rented'                           => (int)$data['Owned_or_Rented'],
                    'Barangay_Business_Permit_Expiration_Date'  => $data['Barangay_Business_Permit_Expiration_Date'],
                    'Occupation'                                => $data['Occupation'],
                    'Barangay_ID'                               => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'                      => Auth::user()->City_Municipality_ID,
                    'Province_ID'                               => Auth::user()->Province_ID,
                    'Region_ID'                                 => Auth::user()->Region_ID,
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),
                )
            );

            DB::table('bcpcis_brgy_payment_collected')->where('Barangay_Permits_ID', $data['Barangay_Permits_ID'])->update(
                array(
                    'OR_Date'                                   => $data['OR_Date'],
                    'OR_No'                                     => $data['OR_No'],
                    'Cash_Tendered'                             => $data['Cash_Tendered'],
                    'CTC_Details'                               => $data['CTC_Details'],
                    'CTC_Date_Issued'                           => $data['CTC_Date_Issued'],
                    'CTC_No'                                    => $data['CTC_No'],
                    'CTC_Amount'                                => $data['CTC_Amount'],
                    'Place_Issued'                              => $data['Place_Issued'],
                    'Barangay_ID'                               => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'                      => Auth::user()->City_Municipality_ID,
                    'Province_ID'                               => Auth::user()->Province_ID,
                    'Region_ID'                                 => Auth::user()->Region_ID,
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),
                )

            );
         
            return redirect()->back()->with('message', 'Information Updated');
        }
    }

    //Brgy Payment Collected Docu List
    public function brgy_payment_collected_docu_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bcpcis_brgy_payment_collected as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('bcpcis_brgy_document_information as f', 'a.Document_ID', '=', 'f.Document_ID')
            ->select(
                'a.Payment_Collected_ID',
                'a.Document_ID',
                'a.OR_Date',
                'a.OR_No',
                'a.Cash_Tendered',
                'a.Region_ID',
                'a.Province_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'f.Transaction_No',

            )
            ->where('a.Document_ID','!=', 0)
            ->paginate(20, ['*'], 'db_entries');


        return view('bcpcis_transactions.brgy_payment_collected_document_list', compact(
            'db_entries',
            'currDATE',
            
        ));
    }

    //Brgy Payment Collected Docu Details
    public function brgy_payment_collected_docu_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $document_info = DB::table('bcpcis_brgy_document_information')->paginate(20, ['*'], 'document_info');
            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            return view('bcpcis_transactions.brgy_payment_collected_document', compact(
                'currDATE',
                'document_info',
                'region',
               
            ));
        } else {
            $payment_docu = DB::table('bcpcis_brgy_payment_collected')->where('Payment_Collected_ID', $id)->get();
            $document_info = DB::table('bcpcis_brgy_document_information')->paginate(20, ['*'], 'business');
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $payment_docu[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $payment_docu[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $payment_docu[0]->City_Municipality_ID)->get();
            return view('bcpcis_transactions.brgy_payment_collected_document_edit', compact(
                'currDATE',
                'payment_docu',
                'region',
                'province',
                'barangay',
                'document_info',
                'city_municipality',
            ));
        }
    }

    // Save Barangay Payment Collected Docu
    public function create_barangay_payment_collected_docu(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Payment_Collected_ID'] == null || $data['Payment_Collected_ID'] == 0) {
            $Payment_Collected_ID = DB::table('bcpcis_brgy_payment_collected')->insertGetId(
                array(
                    'Document_ID'                               => $data['Document_ID'],
                    'OR_Date'                                   => $data['OR_Date'],
                    'OR_No'                                     => $data['OR_No'],
                    'Cash_Tendered'                             => $data['Cash_Tendered'],
                    'Barangay_ID'                               => $data['Barangay_ID'],
                    'City_Municipality_ID'                      => $data['City_Municipality_ID'],
                    'Province_ID'                               => $data['Province_ID'],
                    'Region_ID'                                 => $data['Region_ID'],
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),

                )
            );

            return redirect()->to('brgy_payment_collected_docu_details/' . $Payment_Collected_ID)->with('message', 'New Payment Collected Created');
        } else {
            DB::table('bcpcis_brgy_payment_collected')->where('Payment_Collected_ID', $data['Payment_Collected_ID'])->update(
                array(
                    'Document_ID'                               => $data['Document_ID'],
                    'OR_Date'                                   => $data['OR_Date'],
                    'OR_No'                                     => $data['OR_No'],
                    'Cash_Tendered'                             => $data['Cash_Tendered'],
                    'Barangay_ID'                               => $data['Barangay_ID'],
                    'City_Municipality_ID'                      => $data['City_Municipality_ID'],
                    'Province_ID'                               => $data['Province_ID'],
                    'Region_ID'                                 => $data['Region_ID'],
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),
                )
            );

            
         
            return redirect()->back()->with('message', 'Information Updated');
        }
    }

    //Brgy Payment Collected Business List
    public function brgy_payment_collected_business_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bcpcis_brgy_payment_collected as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('bcpcis_brgy_business_permits as f', 'a.Barangay_Permits_ID', '=', 'f.Barangay_Permits_ID')
            ->select(
                'a.Payment_Collected_ID',
                'a.Barangay_Permits_ID',
                'a.OR_Date',
                'a.OR_No',
                'a.Cash_Tendered',
                'a.Region_ID',
                'a.Province_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'f.Transaction_No',

            )
            ->where('a.Barangay_Permits_ID','!=', 0)
            ->paginate(20, ['*'], 'db_entries');


        return view('bcpcis_transactions.brgy_payment_collected_business_list', compact(
            'db_entries',
            'currDATE',
            
        ));
    }

    //Brgy Payment Collected Business Details
    public function brgy_payment_collected_business_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $business_permit = DB::table('bcpcis_brgy_business_permits')->paginate(20, ['*'], 'business_permit');
            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            return view('bcpcis_transactions.brgy_payment_collected_business', compact(
                'currDATE',
                'business_permit',
                'region',
               
            ));
        } else {
            $payment_business = DB::table('bcpcis_brgy_payment_collected')->where('Payment_Collected_ID', $id)->get();
            $business_permit = DB::table('bcpcis_brgy_business_permits')->paginate(20, ['*'], 'business_permit');
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $payment_business[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $payment_business[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $payment_business[0]->City_Municipality_ID)->get();
            return view('bcpcis_transactions.brgy_payment_collected_business_edit', compact(
                'currDATE',
                'payment_business',
                'region',
                'province',
                'barangay',
                'business_permit',
                'city_municipality',
            ));
        }
    }

    // Save Barangay Payment Collected Business
    public function create_barangay_payment_collected_business(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Payment_Collected_ID'] == null || $data['Payment_Collected_ID'] == 0) {
            $Payment_Collected_ID = DB::table('bcpcis_brgy_payment_collected')->insertGetId(
                array(
                    'Barangay_Permits_ID'                       => $data['Barangay_Permits_ID'],
                    'OR_Date'                                   => $data['OR_Date'],
                    'OR_No'                                     => $data['OR_No'],
                    'Cash_Tendered'                             => $data['Cash_Tendered'],
                    'Barangay_ID'                               => $data['Barangay_ID'],
                    'City_Municipality_ID'                      => $data['City_Municipality_ID'],
                    'Province_ID'                               => $data['Province_ID'],
                    'Region_ID'                                 => $data['Region_ID'],
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),

                )
            );

            return redirect()->to('brgy_payment_collected_business_details/' . $Payment_Collected_ID)->with('message', 'New Payment Collected Created');
        } else {
            DB::table('bcpcis_brgy_payment_collected')->where('Payment_Collected_ID', $data['Payment_Collected_ID'])->update(
                array(
                    'Barangay_Permits_ID'                       => $data['Barangay_Permits_ID'],
                    'OR_Date'                                   => $data['OR_Date'],
                    'OR_No'                                     => $data['OR_No'],
                    'Cash_Tendered'                             => $data['Cash_Tendered'],
                    'Barangay_ID'                               => $data['Barangay_ID'],
                    'City_Municipality_ID'                      => $data['City_Municipality_ID'],
                    'Province_ID'                               => $data['Province_ID'],
                    'Region_ID'                                 => $data['Region_ID'],
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),
                )
            );

            
         
            return redirect()->back()->with('message', 'Information Updated');
        }
    }

    //Brgy Document Claim Business List
    public function brgy_document_claim_business_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bcpcis_brgy_document_claim_schedule as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('bcpcis_brgy_business_permits as f', 'a.Barangay_Permits_ID', '=', 'f.Barangay_Permits_ID')
        ->leftjoin('bips_brgy_inhabitants_information as g', 'a.Resident_ID', '=', 'g.Resident_ID')
            ->select(
                'a.Claim_Schedule_ID',
                'a.Barangay_Permits_ID',
                'a.Resident_ID',
                'a.Requested_Date_and_Time',
                'a.Queue_Ticket_Number',
                'a.Region_ID',
                'a.Province_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'f.Transaction_No',
                DB::raw('CONCAT(g.First_Name, " ",LEFT(g.Middle_Name,1),". ",g.Last_Name) AS Resident_Name'),

            )
           
            ->where([['a.Barangay_Permits_ID', '!=', 0],['a.Barangay_ID', Auth::user()->Barangay_ID]])
            ->paginate(20, ['*'], 'db_entries');


        return view('bcpcis_transactions.brgy_document_claim_business_list', compact(
            'db_entries',
            'currDATE',
            
        ));
    }

    //Brgy Document Claim Business Details
    public function brgy_document_claim_business_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $business_permit = DB::table('bcpcis_brgy_business_permits')->paginate(20, ['*'], 'business_permit');
            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
            return view('bcpcis_transactions.brgy_document_claim_business', compact(
                'currDATE',
                'business_permit',
                'resident',
                'region',
               
            ));
        } else {
            $claim_business = DB::table('bcpcis_brgy_document_claim_schedule')->where('Claim_Schedule_ID', $id)->get();
            $business_permit = DB::table('bcpcis_brgy_business_permits')->paginate(20, ['*'], 'business_permit');
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $claim_business[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $claim_business[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $claim_business[0]->City_Municipality_ID)->get();
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
            return view('bcpcis_transactions.brgy_document_claim_business_edit', compact(
                'currDATE',
                'claim_business',
                'region',
                'province',
                'barangay',
                'business_permit',
                'resident',
                'city_municipality',
            ));
        }
    }

    // Save Barangay Document Claim Business
    public function create_barangay_document_claim_business(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Claim_Schedule_ID'] == null || $data['Claim_Schedule_ID'] == 0) {
            $Claim_Schedule_ID = DB::table('bcpcis_brgy_document_claim_schedule')->insertGetId(
                array(
                    'Barangay_Permits_ID'                       => $data['Barangay_Permits_ID'],
                    'Resident_ID'                               => $data['Resident_ID'],
                    'Requested_Date_and_Time'                   => $data['Requested_Date_and_Time'],
                    'Queue_Ticket_Number'                       => $data['Queue_Ticket_Number'],
                    'Barangay_ID'                               => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'                      => Auth::user()->City_Municipality_ID,
                    'Province_ID'                               => Auth::user()->Province_ID,
                    'Region_ID'                                 => Auth::user()->Region_ID,
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),

                )
            );

            return redirect()->to('brgy_document_claim_business_details/' . $Claim_Schedule_ID)->with('message', 'New Claim Schedule Created');
        } else {
            DB::table('bcpcis_brgy_document_claim_schedule')->where('Claim_Schedule_ID', $data['Claim_Schedule_ID'])->update(
                array(
                    'Barangay_Permits_ID'                       => $data['Barangay_Permits_ID'],
                    'Resident_ID'                               => $data['Resident_ID'],
                    'Requested_Date_and_Time'                   => $data['Requested_Date_and_Time'],
                    'Queue_Ticket_Number'                       => $data['Queue_Ticket_Number'],
                    'Barangay_ID'                               => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'                      => Auth::user()->City_Municipality_ID,
                    'Province_ID'                               => Auth::user()->Province_ID,
                    'Region_ID'                                 => Auth::user()->Region_ID,
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),
                )
            );

            
         
            return redirect()->back()->with('message', 'Information Updated');
        }
    }

    //Brgy Document Claim Docu List
    public function brgy_document_claim_docu_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bcpcis_brgy_document_claim_schedule as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('bcpcis_brgy_document_information as f', 'a.Document_ID', '=', 'f.Document_ID')
        ->leftjoin('bips_brgy_inhabitants_information as g', 'a.Resident_ID', '=', 'g.Resident_ID')
            ->select(
                'a.Claim_Schedule_ID',
                'a.Document_ID',
                'a.Resident_ID',
                'a.Requested_Date_and_Time',
                'a.Queue_Ticket_Number',
                'a.Region_ID',
                'a.Province_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'f.Transaction_No',
                DB::raw('CONCAT(g.First_Name, " ",LEFT(g.Middle_Name,1),". ",g.Last_Name) AS Resident_Name'),

            )
            ->where([['a.Document_ID', '!=', 0],['a.Barangay_ID', Auth::user()->Barangay_ID]])
            ->paginate(20, ['*'], 'db_entries');


        return view('bcpcis_transactions.brgy_document_claim_document_list', compact(
            'db_entries',
            'currDATE',
            
        ));
    }

    //Brgy Document Claim Docu Details
    public function brgy_document_claim_docu_details($id)
    {
        $currDATE = Carbon::now();

        if ($id == 0) {
            $document_info = DB::table('bcpcis_brgy_document_information')->paginate(20, ['*'], 'document_info');
            $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
            return view('bcpcis_transactions.brgy_document_claim_document', compact(
                'currDATE',
                'document_info',
                'resident',
                'region',
               
            ));
        } else {
            $claim_business = DB::table('bcpcis_brgy_document_claim_schedule')->where('Claim_Schedule_ID', $id)->get();
            $document_info = DB::table('bcpcis_brgy_document_information')->paginate(20, ['*'], 'document_info');
            $region = DB::table('maintenance_region')->where('Active', 1)->get();
            $province = DB::table('maintenance_province')->where('Region_ID', $claim_business[0]->Region_ID)->get();
            $city_municipality = DB::table('maintenance_city_municipality')->where('Province_ID', $claim_business[0]->Province_ID)->get();
            $barangay = DB::table('maintenance_barangay')->where('City_Municipality_ID', $claim_business[0]->City_Municipality_ID)->get();
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
            return view('bcpcis_transactions.brgy_document_claim_document_edit', compact(
                'currDATE',
                'claim_business',
                'region',
                'province',
                'barangay',
                'document_info',
                'resident',
                'city_municipality',
            ));
        }
    }

    // Save Barangay Document Claim Document
    public function create_barangay_document_claim_docu(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Claim_Schedule_ID'] == null || $data['Claim_Schedule_ID'] == 0) {
            $Claim_Schedule_ID = DB::table('bcpcis_brgy_document_claim_schedule')->insertGetId(
                array(
                    'Document_ID'                               => $data['Document_ID'],
                    'Resident_ID'                               => $data['Resident_ID'],
                    'Requested_Date_and_Time'                   => $data['Requested_Date_and_Time'],
                    'Queue_Ticket_Number'                       => $data['Queue_Ticket_Number'],
                    'Barangay_ID'                               => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'                      => Auth::user()->City_Municipality_ID,
                    'Province_ID'                               => Auth::user()->Province_ID,
                    'Region_ID'                                 => Auth::user()->Region_ID,
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),

                )
            );

            return redirect()->to('brgy_document_claim_docu_details/' . $Claim_Schedule_ID)->with('message', 'New Claim Schedule Created');
        } else {
            DB::table('bcpcis_brgy_document_claim_schedule')->where('Claim_Schedule_ID', $data['Claim_Schedule_ID'])->update(
                array(
                    'Document_ID'                               => $data['Document_ID'],
                    'Resident_ID'                               => $data['Resident_ID'],
                    'Requested_Date_and_Time'                   => $data['Requested_Date_and_Time'],
                    'Queue_Ticket_Number'                       => $data['Queue_Ticket_Number'],
                    'Barangay_ID'                               => Auth::user()->Barangay_ID,
                    'City_Municipality_ID'                      => Auth::user()->City_Municipality_ID,
                    'Province_ID'                               => Auth::user()->Province_ID,
                    'Region_ID'                                 => Auth::user()->Region_ID,
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),
                )
            );

            
         
            return redirect()->back()->with('message', 'Information Updated');
        }
    }

    public function viewBrgyDocPDF(Request $request)
    {

        $data = request()->all();

        if($data['doc_id'] == 1 ) {
            $details = DB::table('bcpcis_brgy_document_information as a')
            ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
            ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
            ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
            ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
            ->leftjoin('maintenance_bcpcis_purpose_of_document as f', 'a.Purpose_of_Document_ID', '=', 'f.Purpose_of_Document_ID')
            ->leftjoin('maintenance_bcpcis_document_type as g', 'a.Document_Type_ID', '=', 'g.Document_Type_ID')
            ->leftjoin('bcpcis_brgy_payment_collected as h', 'a.Document_ID', '=', 'h.Document_ID')
            ->leftjoin('bips_brgy_inhabitants_information as i', 'a.Resident_ID', '=', 'i.Resident_ID')
            ->leftjoin('maintenance_bips_civil_status as j', 'i.Civil_Status_ID', '=', 'j.Civil_Status_ID')
            
                ->select(
                    DB::raw('UPPER(c.Province_Name) as Province_Name')
                    ,DB::raw('UPPER(d.City_Municipality_Name) as City_Municipality_Name')
                    ,DB::raw('UPPER(e.Barangay_Name) as Barangay_Name')
                    ,DB::raw('CONCAT(UPPER(i.First_Name), " ",UPPER(i.Middle_Name)," ",UPPER(i.Last_Name)) AS Resident_Name')
                    ,DB::raw('CONCAT(UPPER(e.Barangay_Name), ", ",UPPER(d.City_Municipality_Name),", ",UPPER(c.Province_Name)) AS Resident_Address')
                    ,DB::raw('UPPER(j.Civil_Status) as Civil_Status')
                    ,DB::raw('UPPER((CASE WHEN i.Sex = 2 THEN "F" ELSE "M" END)) AS Gender')
                    ,'i.Birthdate'
                    ,DB::raw('TIMESTAMPDIFF(YEAR, i.Birthdate, CURDATE()) AS Age')
                    ,'a.Request_Date'
                    ,'h.OR_Date'
                    ,'h.OR_No'
                    ,'h.Cash_Tendered'
                    ,'h.CTC_Date_Issued'
                    ,'h.CTC_No'
                    ,'h.CTC_Amount'
                    ,'h.Place_Issued'
                    ,'h.CTC_Details'
                   
                )
            ->where('a.Document_ID', $data['Document_IDx'])
            ->paginate(20, ['*'], 'details');

            $details2 = DB::table('bips_brgy_officials_and_staff as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_bips_brgy_position as c', 'a.Barangay_Position_ID', '=', 'c.Brgy_Position_ID')
                ->select(
                    DB::raw('CONCAT(UPPER(b.First_Name), " ",LEFT(UPPER(b.Middle_Name),1) ,". ",UPPER(b.Last_Name)) AS Chairman_Name')
                )
            ->where([['a.Barangay_ID', Auth::user()->Barangay_ID],['a.Barangay_Position_ID', 3],['a.Active', true]])
            ->paginate(20, ['*'], 'details2');

        $pdf = PDF::loadView('bcpcis_transactions.DocResidencyPDF', compact('details','details2'));
        }

        if($data['doc_id'] == 2 ) {
            $details = DB::table('bcpcis_brgy_document_information as a')
            ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
            ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
            ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
            ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
            ->leftjoin('maintenance_bcpcis_purpose_of_document as f', 'a.Purpose_of_Document_ID', '=', 'f.Purpose_of_Document_ID')
            ->leftjoin('maintenance_bcpcis_document_type as g', 'a.Document_Type_ID', '=', 'g.Document_Type_ID')
            ->leftjoin('bcpcis_brgy_payment_collected as h', 'a.Document_ID', '=', 'h.Document_ID')
            ->leftjoin('bips_brgy_inhabitants_information as i', 'a.Resident_ID', '=', 'i.Resident_ID')
            ->leftjoin('maintenance_bips_civil_status as j', 'i.Civil_Status_ID', '=', 'j.Civil_Status_ID')
            
                ->select(
                    DB::raw('UPPER(c.Province_Name) as Province_Name')
                    ,'d.City_Municipality_Name'
                    ,DB::raw('UPPER(e.Barangay_Name) as Barangay_Name')
                    ,DB::raw('CONCAT(UPPER(i.First_Name), " ",UPPER(i.Middle_Name)," ",UPPER(i.Last_Name)) AS Resident_Name')
                    ,DB::raw('CONCAT(UPPER(e.Barangay_Name), ", ",UPPER(d.City_Municipality_Name),", ",UPPER(c.Province_Name)) AS Resident_Address')
                    ,DB::raw('UPPER(j.Civil_Status) as Civil_Status')
                    ,DB::raw('UPPER((CASE WHEN i.Sex = 2 THEN "F" ELSE "M" END)) AS Gender')
                    ,'i.Birthdate'
                    ,DB::raw('TIMESTAMPDIFF(YEAR, i.Birthdate, CURDATE()) AS Age')
                    ,'a.Request_Date'
                    ,'h.OR_Date'
                    ,'h.OR_No'
                    ,'h.Cash_Tendered'
                    ,'h.CTC_Date_Issued'
                    ,'h.CTC_No'
                    ,'h.CTC_Amount'
                    ,'h.Place_Issued'
                    ,'h.CTC_Details'
                    ,DB::raw('DAY(a.Issued_On) AS Issued_Day')
                    ,DB::raw('CASE WHEN DAY(Issued_On) % 100 IN (11,12,13) THEN  "th" WHEN DAY(Issued_On) % 10 = 1 THEN "st" WHEN DAY(Issued_On) % 10 = 2 THEN "nd" WHEN DAY(Issued_On) % 10 = 3 THEN "rd" ELSE "th" END AS OrdinalNumber')
                    ,DB::raw('MONTHNAME(a.Issued_On) AS MThName')
                    ,DB::raw('YEAR(a.Issued_On) AS IssuedYear')
                    ,DB::raw('e.Barangay_Name as Barangay_Name_pro')
                    ,DB::raw('c.Province_Name as Province_Name_pro')
                   
                )
            ->where('a.Document_ID', $data['Document_IDx'])
            ->paginate(20, ['*'], 'details');

            $details2 = DB::table('bips_brgy_officials_and_staff as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_bips_brgy_position as c', 'a.Barangay_Position_ID', '=', 'c.Brgy_Position_ID')
                ->select(
                    DB::raw('CONCAT(UPPER(b.First_Name), " ",LEFT(UPPER(b.Middle_Name),1) ,". ",UPPER(b.Last_Name)) AS Chairman_Name')
                )
            ->where([['a.Barangay_ID', Auth::user()->Barangay_ID],['a.Barangay_Position_ID', 3],['a.Active', true]])
            ->paginate(20, ['*'], 'details2');

        $pdf = PDF::loadView('bcpcis_transactions.DocIndigencyPDF', compact('details','details2'));
        }


        if($data['doc_id'] == 3) {
            $details = DB::table('bcpcis_brgy_document_information as a')
            ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
            ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
            ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
            ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
            ->leftjoin('maintenance_bcpcis_purpose_of_document as f', 'a.Purpose_of_Document_ID', '=', 'f.Purpose_of_Document_ID')
            ->leftjoin('maintenance_bcpcis_document_type as g', 'a.Document_Type_ID', '=', 'g.Document_Type_ID')
            ->leftjoin('bcpcis_brgy_payment_collected as h', 'a.Document_ID', '=', 'h.Document_ID')
            ->leftjoin('bips_brgy_inhabitants_information as i', 'a.Resident_ID', '=', 'i.Resident_ID')
            ->leftjoin('maintenance_bips_civil_status as j', 'i.Civil_Status_ID', '=', 'j.Civil_Status_ID')
            
                ->select(
                    DB::raw('UPPER(c.Province_Name) as Province_Name')
                    ,'d.City_Municipality_Name'
                    ,DB::raw('UPPER(e.Barangay_Name) as Barangay_Name')
                    ,DB::raw('CONCAT(UPPER(i.First_Name), " ",UPPER(i.Middle_Name)," ",UPPER(i.Last_Name)) AS Resident_Name')
                    ,DB::raw('CONCAT(UPPER(e.Barangay_Name), ", ",UPPER(d.City_Municipality_Name),", ",UPPER(c.Province_Name)) AS Resident_Address')
                    ,'j.Civil_Status'
                    ,DB::raw('UPPER((CASE WHEN i.Sex = 2 THEN "F" ELSE "M" END)) AS Gender')
                    ,'i.Birthdate'
                    ,DB::raw('TIMESTAMPDIFF(YEAR, i.Birthdate, CURDATE()) AS Age')
                    ,'a.Request_Date'
                    ,'h.OR_Date'
                    ,'h.OR_No'
                    ,'h.Cash_Tendered'
                    ,'h.CTC_Date_Issued'
                    ,'h.CTC_No'
                    ,'h.CTC_Amount'
                    ,'h.Place_Issued'
                    ,'h.CTC_Details'
                    ,DB::raw('DAY(a.Issued_On) AS Issued_Day')
                    ,DB::raw('CASE WHEN DAY(Issued_On) % 100 IN (11,12,13) THEN  "th" WHEN DAY(Issued_On) % 10 = 1 THEN "st" WHEN DAY(Issued_On) % 10 = 2 THEN "nd" WHEN DAY(Issued_On) % 10 = 3 THEN "rd" ELSE "th" END AS OrdinalNumber')
                    ,DB::raw('MONTHNAME(a.Issued_On) AS MThName')
                    ,DB::raw('YEAR(a.Issued_On) AS IssuedYear')
                    ,DB::raw('e.Barangay_Name as Barangay_Name_pro')
                    ,DB::raw('c.Province_Name as Province_Name_pro')
                    ,'a.SecondResident_Name'
                    ,'f.Purpose_of_Document'
                    ,'a.Brgy_Cert_No'
                    ,'a.Issued_At'
                    ,'a.Issued_On'
                   
                )
            ->where('a.Document_ID', $data['Document_IDx'])
            ->paginate(20, ['*'], 'details');

            $details2 = DB::table('bips_brgy_officials_and_staff as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_bips_brgy_position as c', 'a.Barangay_Position_ID', '=', 'c.Brgy_Position_ID')
                ->select(
                    DB::raw('CONCAT(UPPER(b.First_Name), " ",LEFT(UPPER(b.Middle_Name),1) ,". ",UPPER(b.Last_Name)) AS Chairman_Name')
                )
            ->where([['a.Barangay_ID', Auth::user()->Barangay_ID],['a.Barangay_Position_ID', 3],['a.Active', true]])
            ->paginate(20, ['*'], 'details2');

        $pdf = PDF::loadView('bcpcis_transactions.DocTravelPDF', compact('details','details2'));
        }
       

        if($data['doc_id'] == 4) {
            $details = DB::table('bcpcis_brgy_document_information as a')
            ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
            ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
            ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
            ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
            ->leftjoin('maintenance_bcpcis_purpose_of_document as f', 'a.Purpose_of_Document_ID', '=', 'f.Purpose_of_Document_ID')
            ->leftjoin('maintenance_bcpcis_document_type as g', 'a.Document_Type_ID', '=', 'g.Document_Type_ID')
            ->leftjoin('bcpcis_brgy_payment_collected as h', 'a.Document_ID', '=', 'h.Document_ID')
            ->leftjoin('bips_brgy_inhabitants_information as i', 'a.Resident_ID', '=', 'i.Resident_ID')
            ->leftjoin('maintenance_bips_civil_status as j', 'i.Civil_Status_ID', '=', 'j.Civil_Status_ID')
            
                ->select(
                    DB::raw('UPPER(c.Province_Name) as Province_Name')
                    ,'d.City_Municipality_Name'
                    ,DB::raw('UPPER(e.Barangay_Name) as Barangay_Name')
                    ,DB::raw('CONCAT(UPPER(i.First_Name), " ",UPPER(i.Middle_Name)," ",UPPER(i.Last_Name)) AS Resident_Name')
                    ,DB::raw('CONCAT(UPPER(e.Barangay_Name), ", ",UPPER(d.City_Municipality_Name),", ",UPPER(c.Province_Name)) AS Resident_Address')
                    ,'j.Civil_Status'
                    ,DB::raw('UPPER((CASE WHEN i.Sex = 2 THEN "F" ELSE "M" END)) AS Gender')
                    ,'i.Birthdate'
                    ,DB::raw('TIMESTAMPDIFF(YEAR, i.Birthdate, CURDATE()) AS Age')
                    ,'a.Request_Date'
                    ,'h.OR_Date'
                    ,'h.OR_No'
                    ,'h.Cash_Tendered'
                    ,'h.CTC_Date_Issued'
                    ,'h.CTC_No'
                    ,'h.CTC_Amount'
                    ,'h.Place_Issued'
                    ,'h.CTC_Details'
                    ,DB::raw('DAY(a.Issued_On) AS Issued_Day')
                    ,DB::raw('CASE WHEN DAY(Issued_On) % 100 IN (11,12,13) THEN  "th" WHEN DAY(Issued_On) % 10 = 1 THEN "st" WHEN DAY(Issued_On) % 10 = 2 THEN "nd" WHEN DAY(Issued_On) % 10 = 3 THEN "rd" ELSE "th" END AS OrdinalNumber')
                    ,DB::raw('MONTHNAME(a.Issued_On) AS MThName')
                    ,DB::raw('YEAR(a.Issued_On) AS IssuedYear')
                    ,DB::raw('e.Barangay_Name as Barangay_Name_pro')
                    ,DB::raw('c.Province_Name as Province_Name_pro')
                    ,'a.SecondResident_Name'
                    ,'f.Purpose_of_Document'
                    ,'a.Brgy_Cert_No'
                    ,'a.Issued_At'
                    ,'a.Issued_On'
                   
                )
            ->where('a.Document_ID', $data['Document_IDx'])
            ->paginate(20, ['*'], 'details');

            $details2 = DB::table('bips_brgy_officials_and_staff as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_bips_brgy_position as c', 'a.Barangay_Position_ID', '=', 'c.Brgy_Position_ID')
                ->select(
                    DB::raw('CONCAT(UPPER(b.First_Name), " ",LEFT(UPPER(b.Middle_Name),1) ,". ",UPPER(b.Last_Name)) AS Chairman_Name')
                )
            ->where([['a.Barangay_ID', Auth::user()->Barangay_ID],['a.Barangay_Position_ID', 3],['a.Active', true]])
            ->paginate(20, ['*'], 'details2');

        $pdf = PDF::loadView('bcpcis_transactions.DocTravelPDF', compact('details','details2'));
        }

        return $pdf->stream();
        

        
    }

    public function viewBrgyBusinessPDF(Request $request)
    {

        $data = request()->all();

        
            $details = DB::table('bcpcis_brgy_business_permits as a')
            ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
            ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
            ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
            ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
            ->leftjoin('maintenance_bcpcis_barangay_business as f', 'a.Business_ID', '=', 'f.Business_ID')
            ->leftjoin('bcpcis_brgy_payment_collected as h', 'a.Barangay_Permits_ID', '=', 'h.Barangay_Permits_ID')
            ->leftjoin('bips_brgy_inhabitants_information as i', 'a.Resident_ID', '=', 'i.Resident_ID')
            ->leftjoin('maintenance_bips_civil_status as j', 'i.Civil_Status_ID', '=', 'j.Civil_Status_ID')
            
                ->select(
                    DB::raw('UPPER(c.Province_Name) as Province_Name')
                    ,'d.City_Municipality_Name'
                    ,DB::raw('UPPER(e.Barangay_Name) as Barangay_Name')
                    ,DB::raw('CONCAT(UPPER(i.Last_Name), ", ",UPPER(i.First_Name), ", ",UPPER(i.Middle_Name), ", ") AS Resident_Name')
                    ,'a.Occupation'
                    ,DB::raw('CONCAT(UPPER(e.Barangay_Name), ", ",UPPER(d.City_Municipality_Name),", ",UPPER(c.Province_Name)) AS Resident_Address')
                    ,DB::raw('YEAR(a.Date_Stamp) AS IssuedYear')
                    ,'f.Mobile_No'
                    ,'j.Civil_Status'
                    ,DB::raw('(CASE WHEN a.New_or_Renewal = 0 THEN "Renewal" ELSE "New" END) AS New_or_Renewal')
                    ,'f.Business_Name'
                    ,'f.Business_Address'
                    ,'h.OR_Date'
                    ,'h.OR_No'
                    ,'h.Cash_Tendered'
                    ,'h.CTC_Date_Issued'
                    ,'h.CTC_No'
                    ,'h.CTC_Amount'
                    ,'h.Place_Issued'
                    ,'h.CTC_Details'
                )
            ->where('a.Barangay_Permits_ID', $data['permit_id'])
            ->paginate(20, ['*'], 'details');

        $pdf = PDF::loadView('bcpcis_transactions.DocBusinessPDF', compact('details'));
       
         
               

        return $pdf->stream();
        

        
    }

    //Brgy Document Infomation Details Request
    public function brgy_document_information_details_request()
    {
        $currDATE = Carbon::now();


            $sched = DB::table('bips_processing_sched')->where('Barangay_ID', Auth::user()->Barangay_ID)->get();
            $purpose = DB::table('maintenance_bcpcis_purpose_of_document')->paginate(20, ['*'], 'purpose');
            $document_type = DB::table('maintenance_bcpcis_document_type')->paginate(20, ['*'], 'document_type');

            $min = Carbon::now()->addDays($sched[0]->days);
            
            //dd($min,$max);
            return view('bcpcis_transactions.brgy_document_information_request', compact(
                'currDATE',
                'purpose',
                'document_type',
                'sched',
                'min',
            
               
            ));
         
    }

     // Save Brgy Document Information Request 
     public function create_brgy_document_information_request(Request $request)
     {
         $currDATE = Carbon::now();
        
         $data = request()->all();
         $randomNumber = random_int(1, 9999);

         $sched = DB::table('bips_processing_sched')->where('Barangay_ID', Auth::user()->Barangay_ID)->get();
         $min = Carbon::now()->addDays($sched[0]->days);
 
 
         if ($data['Document_ID'] == null || $data['Document_ID'] == 0) {
             $Document_ID = DB::table('bcpcis_brgy_document_information')->insertGetId(
                 array(
                     'Request_Date'             => Carbon::now(),
                     'Remarks'                  => $data['Remarks'],
                     'Purpose_of_Document_ID'   => $data['Purpose_of_Document_ID'],
                     'Salutation_Name'          => $data['Salutation_Name'],
                     'Document_Type_ID'         => $data['Document_Type_ID'],
                     'Resident_ID'              => Auth::user()->Resident_ID,
                     'SecondResident_Name'      => $data['SecondResident_Name'],
                     'Request_Status_ID'        => 0,
                     'Barangay_ID'              => Auth::user()->Barangay_ID,
                     'City_Municipality_ID'     => Auth::user()->City_Municipality_ID,
                     'Province_ID'              => Auth::user()->Province_ID,
                     'Region_ID'                => Auth::user()->Region_ID,
                     'Encoder_ID'               => Auth::user()->id,
                     'Date_Stamp'               => Carbon::now(),
 
                 )
 
             );
 
             DB::table('bcpcis_brgy_document_claim_schedule')->insertGetId(
                 array(
                     'Document_ID'                                  => $Document_ID,
                     'Resident_ID'                                  => Auth::user()->Resident_ID,
                     'Queue_Ticket_Number'                          => $randomNumber,
                     'Requested_Date_and_Time'                      => $data['Requested_Date_and_Time'],
                     'Barangay_ID'                                  => Auth::user()->Barangay_ID,
                     'City_Municipality_ID'                         => Auth::user()->City_Municipality_ID,
                     'Province_ID'                                  => Auth::user()->Province_ID,
                     'Region_ID'                                    => Auth::user()->Region_ID,
                     'Encoder_ID'                                   => Auth::user()->id,
                     'Date_Stamp'                                   => Carbon::now(),
 
                 )
             );
           
            $for_modal=1;
            $Queue_Ticket_Number=$randomNumber;
            $Requested_Date_and_Time= $data['Requested_Date_and_Time'];
            $Name= Auth::user()->name;

            $purpose = DB::table('maintenance_bcpcis_purpose_of_document')->paginate(20, ['*'], 'purpose');
            $document_type = DB::table('maintenance_bcpcis_document_type')->paginate(20, ['*'], 'document_type');
            $Document_Type_Name=$data['VDocument_Type'];
            $Purpose_Document_Name=$data['VPurpose_Document'];
            // $document_type_name = DB::table('maintenance_bcpcis_document_type')
            // ->select(
            //     'Document_Type_Name',
            // )
            // ->where('Document_Type_ID', $data['Document_Type_ID'])->get();
            // $document_type_name_answer=$document_type_name;
//dd($data['Document_Type_ID']);
             return view('bcpcis_transactions.brgy_document_information_request', compact(
                'Queue_Ticket_Number',
                'Requested_Date_and_Time',
                'for_modal','purpose','document_type','data','Name','Document_Type_Name','Purpose_Document_Name','min'
            ));
            
         } 
     }

     public function document_request_pending_list(Request $request)
    {
        $currDATE = Carbon::now();

    $db_entries = DB::table('bcpcis_brgy_document_information as a') 
        ->leftjoin('bcpcis_brgy_document_claim_schedule as b', 'a.Document_ID', '=', 'b.Document_ID')
        ->leftjoin('bips_brgy_inhabitants_information as c', 'a.Resident_ID', '=', 'c.Resident_ID')
        ->leftjoin('maintenance_bcpcis_document_type as d', 'a.Document_Type_ID', '=', 'd.Document_Type_ID')
        ->leftjoin('maintenance_bcpcis_purpose_of_document as e', 'a.Purpose_of_Document_ID', '=', 'e.Purpose_of_Document_ID')
        ->select(
            'a.Document_ID',
            'b.Queue_Ticket_Number',
            'b.Requested_Date_and_Time',
            DB::raw('CONCAT(c.First_Name, " ",LEFT(c.Middle_Name,1),". ",c.Last_Name) AS Resident_Name'),
            'd.Document_Type_Name',
            'e.Purpose_of_Document',

           
        )
        ->where('a.Request_Status_ID', 0)
        ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
        ->paginate(20, ['*'], 'db_entries');
    $db_entries2 = DB::table('bcpcis_brgy_document_information as a') 
        ->leftjoin('bcpcis_brgy_document_claim_schedule as b', 'a.Document_ID', '=', 'b.Document_ID')
        ->leftjoin('bips_brgy_inhabitants_information as c', 'a.Resident_ID', '=', 'c.Resident_ID')
        ->leftjoin('maintenance_bcpcis_document_type as d', 'a.Document_Type_ID', '=', 'd.Document_Type_ID')
        ->leftjoin('maintenance_bcpcis_purpose_of_document as e', 'a.Purpose_of_Document_ID', '=', 'e.Purpose_of_Document_ID')
        ->select(
            'a.Document_ID',
            'b.Queue_Ticket_Number',
            'b.Requested_Date_and_Time',
            DB::raw('CONCAT(c.First_Name, " ",LEFT(c.Middle_Name,1),". ",c.Last_Name) AS Resident_Name'),
            'd.Document_Type_Name',
            'e.Purpose_of_Document',

           
        )
        ->where('a.Request_Status_ID', 1)
        ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
        ->paginate(20, ['*'], 'db_entries');
    $db_entries3 = DB::table('bcpcis_brgy_document_information as a') 
        ->leftjoin('bcpcis_brgy_document_claim_schedule as b', 'a.Document_ID', '=', 'b.Document_ID')
        ->leftjoin('bips_brgy_inhabitants_information as c', 'a.Resident_ID', '=', 'c.Resident_ID')
        ->leftjoin('maintenance_bcpcis_document_type as d', 'a.Document_Type_ID', '=', 'd.Document_Type_ID')
        ->leftjoin('maintenance_bcpcis_purpose_of_document as e', 'a.Purpose_of_Document_ID', '=', 'e.Purpose_of_Document_ID')
        ->select(
            'a.Document_ID',
            'b.Queue_Ticket_Number',
            'b.Requested_Date_and_Time',
            DB::raw('CONCAT(c.First_Name, " ",LEFT(c.Middle_Name,1),". ",c.Last_Name) AS Resident_Name'),
            'd.Document_Type_Name',
            'e.Purpose_of_Document',

           
        )
        ->where('a.Request_Status_ID', 2)
        ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
        ->paginate(20, ['*'], 'db_entries');



        return view('bcpcis_transactions.document_request_pending_list', compact(
            'db_entries',
            'db_entries2',
            'db_entries3',
            'currDATE',
        ));
           

    }


    // Approve Disapprove Document Request Pending
    public function approve_disapprove_document_request_pending(Request $request)
    {
        $data = request()->all();
        
        $message = 'Disapprove';

        DB::table('bcpcis_brgy_document_information')->where('Document_ID', $data['Document_ID'])->update(
            array(
                'Request_Status_ID' => $data['Request_Status_ID'],
            )
        );

        return redirect()->back()->with('message', 'Document Request is ' . $message);
    }

    // Approve Document Request Update 
    public function update_document_request_approve_information(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        $month=Carbon::now()->format('m');
        $day=Carbon::now()->format('d');
        $year=Carbon::now()->format('Y');
        $today= $currDATE->toDateString();

        $File_No = DB::table('bcpcis_brgy_document_information as a')
            ->select(
                DB::raw('MAX(a.File_No) AS File_No')
                )
            ->where([['a.Barangay_ID', Auth::user()->Barangay_ID],[DB::raw('CAST(a.Date_Stamp as date)'), $today]])->get();
            
            // ->where(DB::raw('CAST(a.Date_Stamp as date)'), $today)->get();
        $File_No_Static = $File_No[0]->File_No + 1;
        $File_No_Add = $File_No[0]->File_No + 1;

        $stringLength = strlen($File_No_Add);

        if ($stringLength ==1){
            $File_No_Final='0'. '' .'0'. '' .'0'. '' . $File_No_Add;
        };
        if ($stringLength ==2){
            $File_No_Final='0'. '' .'0'. '' . $File_No_Add;
        };
        if ($stringLength ==3){
            $File_No_Final='0'. '' . $File_No_Add;
        };
        if ($stringLength ==4){
            $File_No_Final=$File_No_Add;
        };

        if ($data['Document_Type_ID'] == 1){
            $validated = $request->validate([
                'OR_No' => 'required',
                'Cash_Tendered' => 'required',
                'CTC_No' => 'required',
                'CTC_Amount' => 'required',
                // 'Place_Issued' => 'required',
                
            ]);
        }

        DB::table('bcpcis_brgy_document_information')->where('Document_ID', $data['Document_ID'])->update(
            array(
                'Transaction_No'        => $month. '' .$day. '' .$year. '-' .$File_No_Final,
                'File_No'               => $File_No_Static,
                'Request_Date'          => $data['Request_Date'],
                'Remarks'               => $data['Remarks'],
                'Released'              => (int)$data['Released'],
                'Purpose_of_Document_ID'=> $data['Purpose_of_Document_ID'],
                'Salutation_Name'       => $data['Salutation_Name'],
                'Issued_On'             => $data['Issued_On'],
                // 'Issued_At'             => $data['Issued_At'],
                'Brgy_Cert_No'          => $data['Brgy_Cert_No'],
                'Document_Type_ID'      => $data['Document_Type_ID'],
                'Resident_ID'           => $data['Resident_ID'],
                'SecondResident_Name'   => $data['SecondResident_Name'],
                'Request_Status_ID'     => 1,
                'Barangay_ID'           => Auth::user()->Barangay_ID,
                'City_Municipality_ID'  => Auth::user()->City_Municipality_ID,
                'Province_ID'           => Auth::user()->Province_ID,
                'Region_ID'             => Auth::user()->Region_ID,
                'Encoder_ID'            => Auth::user()->id,
                'Date_Stamp'            => Carbon::now(),
            )

            
        );

        DB::table('bcpcis_brgy_payment_collected')->insertGetId(
            array(
                'Document_ID'                               => $data['Document_ID'],
                'OR_Date'                                   => $data['OR_Date'],
                'OR_No'                                     => $data['OR_No'],
                'Cash_Tendered'                             => $data['Cash_Tendered'],
                'CTC_Details'                               => $data['CTC_Details'],
                'CTC_Date_Issued'                           => $data['CTC_Date_Issued'],
                'CTC_No'                                    => $data['CTC_No'],
                'CTC_Amount'                                => $data['CTC_Amount'],
                'Place_Issued'                              => $data['Place_Issued'],
                'Barangay_ID'                               => Auth::user()->Barangay_ID,
                'City_Municipality_ID'                      => Auth::user()->City_Municipality_ID,
                'Province_ID'                               => Auth::user()->Province_ID,
                'Region_ID'                                 => Auth::user()->Region_ID,
                'Encoder_ID'                                => Auth::user()->id,
                'Date_Stamp'                                => Carbon::now(),

            )
        );

        if ($request->hasfile('fileattach')) {
            foreach ($request->file('fileattach') as $file) {
                $filename = $file->getClientOriginalName();
                $fileType = $file->getClientOriginalExtension();
                $fileSize = $file->getSize();
                $filePath = public_path() . '/files/uploads/brgy_documents_request/';
                $file->move($filePath, $filename);

                $file_data = array(
                    'Document_ID' => $data['Document_ID'],
                    'File_Name' => $filename,
                    'File_Location' => $filePath,
                    'File_Type' => $fileType,
                    'File_Size' => $fileSize,
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now()
                );
                DB::table('bcpcis_brgy_document_file_attachment')->insert($file_data);
            }
        }


        return redirect()->to('document_request_approved_details/' . $data['Document_ID'])->with('message', 'The Document resquest has been saved and approved');
    }

    public function get_brgy_document_request_attachments(Request $request)
    {

        $id = $_GET['id'];
        $Reponse_Attach = DB::table('bcpcis_brgy_document_file_attachment')
            ->where('Document_ID', $id)
            ->get();
        return json_encode($Reponse_Attach);
    }

    public function delete_brgy_document_request_attachments(Request $request)
    {
        $id = $_GET['id'];

        $fileinfo = DB::table('bcpcis_brgy_document_file_attachment')->where('Attachment_ID', $id)->get();
        if (File::exists('./files/uploads/brgy_documents_request/' . $fileinfo[0]->File_Name)) {
            unlink(public_path('./files/uploads/brgy_documents_request/' . $fileinfo[0]->File_Name));
        }
        DB::table('bcpcis_brgy_document_file_attachment')->where('Attachment_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    //Document request Approved details
    public function document_request_approved_details($id)
    {
        $currDATE = Carbon::now();

       
        $document = DB::table('bcpcis_brgy_document_information as a')
        ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
        ->select(
            'a.*',
            DB::raw('CONCAT(b.First_Name, " ",LEFT(b.Middle_Name,1),". ",b.Last_Name) AS Resident_Name'), 
        )
        ->where('Document_ID', $id)
        ->paginate(20, ['*'], 'document');
            $purpose = DB::table('maintenance_bcpcis_purpose_of_document')->paginate(20, ['*'], 'purpose');
            $document_type = DB::table('maintenance_bcpcis_document_type')->paginate(20, ['*'], 'document_type');
            $payment_docu = DB::table('bcpcis_brgy_payment_collected')->where('Document_ID', $id)->get();
            return view('bcpcis_transactions.document_request_approved_edit', compact(
                'currDATE',
                'document',
                'purpose',
                'document_type',
                'payment_docu',
            ));
        
    }

    // Approve Document Request EDIT Update
    public function update_document_request_approve_edit_information(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        if ($data['Document_Type_ID'] == 1){
            $validated = $request->validate([
                'OR_No' => 'required',
                'Cash_Tendered' => 'required',
                'CTC_No' => 'required',
                'CTC_Amount' => 'required',
                'Place_Issued' => 'required',
                
            ]);
        }

        DB::table('bcpcis_brgy_document_file_attachment')->where('Document_ID', $data['Document_ID'])->delete();

        DB::table('bcpcis_brgy_document_information')->where('Document_ID', $data['Document_ID'])->update(
            array(
                // 'Transaction_No'        => $data['Transaction_No'],
                'Request_Date'          => $data['Request_Date'],
                'Remarks'               => $data['Remarks'],
                'Released'              => (int)$data['Released'],
                'Purpose_of_Document_ID'=> $data['Purpose_of_Document_ID'],
                'Salutation_Name'       => $data['Salutation_Name'],
                'Issued_On'             => $data['Issued_On'],
                'Issued_At'             => $data['Issued_At'],
                'Brgy_Cert_No'          => $data['Brgy_Cert_No'],
                'Document_Type_ID'      => $data['Document_Type_ID'],
                'Resident_ID'           => $data['Resident_ID'],
                'SecondResident_Name'   => $data['SecondResident_Name'],
                'Barangay_ID'           => Auth::user()->Barangay_ID,
                'City_Municipality_ID'  => Auth::user()->City_Municipality_ID,
                'Province_ID'           => Auth::user()->Province_ID,
                'Region_ID'             => Auth::user()->Region_ID,
                'Encoder_ID'            => Auth::user()->id,
                'Date_Stamp'            => Carbon::now(),
            )

            
        );

        DB::table('bcpcis_brgy_payment_collected')->where('Document_ID', $data['Document_ID'])->update(
            array(
                'OR_Date'                                   => $data['OR_Date'],
                'OR_No'                                     => $data['OR_No'],
                'Cash_Tendered'                             => $data['Cash_Tendered'],
                'CTC_Details'                               => $data['CTC_Details'],
                'CTC_Date_Issued'                           => $data['CTC_Date_Issued'],
                'CTC_No'                                    => $data['CTC_No'],
                'CTC_Amount'                                => $data['CTC_Amount'],
                'Place_Issued'                              => $data['Place_Issued'],
                'Barangay_ID'                               => Auth::user()->Barangay_ID,
                'City_Municipality_ID'                      => Auth::user()->City_Municipality_ID,
                'Province_ID'                               => Auth::user()->Province_ID,
                'Region_ID'                                 => Auth::user()->Region_ID,
                'Encoder_ID'                                => Auth::user()->id,
                'Date_Stamp'                                => Carbon::now(),
            )

        );

        
        if ($request->hasfile('fileattach')) {
            foreach ($request->file('fileattach') as $file) {
                $filename = $file->getClientOriginalName();
                $fileType = $file->getClientOriginalExtension();
                $fileSize = $file->getSize();
                $filePath = public_path() . '/files/uploads/brgy_documents_request/';
                $file->move($filePath, $filename);

                $file_data = array(
                    'Document_ID' => $data['Document_ID'],
                    'File_Name' => $filename,
                    'File_Location' => $filePath,
                    'File_Type' => $fileType,
                    'File_Size' => $fileSize,
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now()
                );
                DB::table('bcpcis_brgy_document_file_attachment')->insert($file_data);
            }
        }

        
     
        return redirect()->back()->with('message', 'Information Updated');
    }

    //Document request Ticket Number Details
    public function document_request_ticket_number_details($id)
    {
        $currDATE = Carbon::now();

       
        $document = DB::table('bcpcis_brgy_document_information as a')
        ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
        ->leftjoin('bcpcis_brgy_document_claim_schedule as c', 'a.Document_ID', '=', 'c.Document_ID')
        ->select(
            'a.Document_ID',
            'c.Queue_Ticket_Number',
            'c.Requested_Date_and_Time',

            
        )
        ->where('a.Document_ID', $id)
        ->paginate(20, ['*'], 'document');
           
            return view('bcpcis_transactions.brgy_document_information_request_ticket', compact(
                'currDATE',
                'document',
            ));
        
    }

    public function get_businsess_permit_list($Barangay_ID)
    {
        $data = DB::table('bcpcis_brgy_business_permits as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('maintenance_bcpcis_barangay_business as f', 'a.Business_ID', '=', 'f.Business_ID')
        ->leftjoin('bips_brgy_inhabitants_information as g', 'a.Resident_ID', '=', 'g.Resident_ID')
            ->select(
                'a.Barangay_Permits_ID',
                'a.Business_ID',
                'a.Resident_ID',
                'a.Transaction_No',
                'a.Barangay_Business_Permit_Expiration_Date',
                'a.CTC_No',
                'a.Region_ID',
                'a.Province_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'f.Business_Name',
                DB::raw('CONCAT(g.First_Name, " ",LEFT(g.Middle_Name,1),". ",g.Last_Name) AS Resident_Name'),
                DB::raw('(CASE WHEN a.New_or_Renewal = false THEN "Renewal" ELSE "New" END) AS New_or_Renewal'),
                DB::raw('(CASE WHEN a.Owned_or_Rented = false THEN "Rented" ELSE "Owned" END) AS Owned_or_Rented'),

            )
             
            ->where('a.Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }

    public function get_brgy_document_information_list($Barangay_ID)
    {   
        $data = DB::table('bcpcis_brgy_document_information as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('maintenance_bcpcis_purpose_of_document as g', 'a.Purpose_of_Document_ID', '=', 'g.Purpose_of_Document_ID')
        ->leftjoin('maintenance_bcpcis_document_type as h', 'a.Document_Type_ID', '=', 'h.Document_Type_ID')
        ->leftjoin('bips_brgy_inhabitants_information as i', 'a.Resident_ID', '=', 'i.Resident_ID')
            ->select(
                'a.Document_ID',
                'a.Transaction_No',
                'a.Request_Date',
                'a.Released',
                'a.Remarks',
                'a.Purpose_of_Document_ID',
                'a.Salutation_Name',
                'a.Picture',
                'a.CTC_No',
                'a.Issued_On',
                'a.Issued_At',
                'a.Document_Type_ID',
                'a.Resident_ID',
                'a.SecondResident_Name',
                'a.Region_ID',
                'a.Province_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'a.Request_Status_ID',
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'g.Purpose_of_Document',  
                'h.Document_Type_Name',
                DB::raw('CONCAT(i.First_Name, " ",LEFT(i.Middle_Name,1),". ",i.Last_Name) AS Resident_Name'),

            )
            
            ->where([['a.Request_Status_ID', 3],['a.Barangay_ID', $Barangay_ID]])
            ->get();
        return json_encode($data);
    }

    

    public function get_brgy_business_list($Barangay_ID)
    {   
        $data = DB::table('maintenance_bcpcis_barangay_business as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('maintenance_bcpcis_business_type as f', 'a.Business_Type_ID', '=', 'f.Business_Type_ID')
            ->select(
                'a.Business_ID',
                'a.Business_Name',
                'a.Business_Type_ID',
                'a.Business_Tin',
                'a.Business_Owner',
                'a.Business_Address',
                'a.Mobile_No',
                'a.Active',
                'a.Region_ID',
                'a.Province_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'f.Business_Type',

            )
            ->where('a.Barangay_ID', $Barangay_ID)
            ->get();
        return json_encode($data);
    }

    public function delete_businesspermit(Request $request)
    {
        $id = $_GET['id'];

        DB::table('bcpcis_brgy_business_permits')->where('Barangay_Permits_ID', $id)->delete();

        return response()->json(array('success' => true));
    }


    public function delete_document(Request $request)
    {
        $id = $_GET['id'];
        
        DB::table('bcpcis_brgy_document_information')->where('Document_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function delete_business(Request $request)
    {
        $id = $_GET['id'];
        
        DB::table('maintenance_bcpcis_barangay_business')->where('Business_ID', $id)->delete();

        return response()->json(array('success' => true));
    }

    public function search_businesstype(Request $request)
    {
        $business_type = DB::table('maintenance_bcpcis_business_type')
            ->where('Active', 1)
            ->where(
                function ($query) use ($request) {
                    return $query
                        ->where('Business_Type', 'LIKE', '%' . $request->input('term', '') . '%');
                }
            )
            ->get(['Business_Type_ID as id', 'Business_Type as text']);

        return ['results' => $business_type];
    }
    // aldren
    public function search_business(Request $request)
    {
        $business = DB::table('maintenance_bcpcis_barangay_business')
        ->where([['Active', 1],['Barangay_ID', Auth::user()->Barangay_ID]])
        ->where(
            function ($query) use ($request) {
                return $query
                    ->where('Business_Name', 'LIKE', '%' . $request->input('term', '') . '%');
            }
        )
        ->get(['Business_ID as id', 'Business_Name as text']);
        
        return ['results' => $business];
    }

    public function search_businessresident(Request $request)
    {
        $inhabitants = DB::table('bips_brgy_inhabitants_information')
            ->select(DB::raw('CONCAT(Last_Name, ", ", First_Name, " ", Middle_Name) AS text'), 'Resident_ID as id',)
            ->where('Barangay_ID', Auth::user()->Barangay_ID)
            ->where(
                function ($query) use ($request) {
                    return $query
                        ->where('Last_Name', 'LIKE', '%' . $request->input('term', '') . '%')
                        ->orWhere('First_Name', 'LIKE', '%' . $request->input('term', '') . '%')
                        ->orWhere('Middle_Name', 'LIKE', '%' . $request->input('term', '') . '%');
                }
            )
            ->get();

        // dd($inhabitants);

        return ['results' => $inhabitants];
    }

    public function search_documentresident(Request $request)
    {
        $inhabitants = DB::table('bips_brgy_inhabitants_information')
            ->select(DB::raw('CONCAT(Last_Name, ", ", First_Name, " ", Middle_Name) AS text'), 'Resident_ID as id',)
            ->where('Barangay_ID', Auth::user()->Barangay_ID)
            ->where(
                function ($query) use ($request) {
                    return $query
                        ->where('Last_Name', 'LIKE', '%' . $request->input('term', '') . '%')
                        ->orWhere('First_Name', 'LIKE', '%' . $request->input('term', '') . '%')
                        ->orWhere('Middle_Name', 'LIKE', '%' . $request->input('term', '') . '%');
                }
            )
            ->get();

        // dd($inhabitants);

        return ['results' => $inhabitants];
    }

    public function search_documenttype(Request $request)
    {
        $document = DB::table('maintenance_bcpcis_document_type')
            ->where('Active', 1)
            ->where(
                function ($query) use ($request) {
                    return $query
                        ->where('Document_Type_Name', 'LIKE', '%' . $request->input('term', '') . '%');
                }
            )
            ->get(['Document_Type_ID as id', 'Document_Type_Name as text']);
            

        return ['results' => $document];
    }

    public function search_documentpurpose(Request $request)
    {
        $purpose = DB::table('maintenance_bcpcis_purpose_of_document')
            ->where('Active', 1)
            ->where(
                function ($query) use ($request) {
                    return $query
                        ->where('Purpose_of_Document', 'LIKE', '%' . $request->input('term', '') . '%');
                }
            )
            ->get(['Purpose_of_Document_ID as id', 'Purpose_of_Document as text']);

        return ['results' => $purpose];
    }

    public function businesspermit_export(Request $request)
    {
        $data = request()->all();
        
        $chk_Transaction_No = isset($data['chk_Transaction_No']) ? 1 : 0;
        $chk_Business_Name = isset($data['chk_Business_Name']) ? 1 : 0;
        $chk_Resident_Name = isset($data['chk_Resident_Name']) ? 1 : 0;
        $chk_New_or_Renewal = isset($data['chk_New_or_Renewal']) ? 1 : 0;
        $chk_Owned_or_Rented = isset($data['chk_Owned_or_Rented']) ? 1 : 0;
        $chk_Occupation = isset($data['chk_Occupation']) ? 1 : 0;
        $chk_CTC_No = isset($data['chk_CTC_No']) ? 1 : 0;
        $chk_Barangay_Business_Permit_Expiration_Date = isset($data['chk_Barangay_Business_Permit_Expiration_Date']) ? 1 : 0;

        return Excel::download(new BusinessPermitExportView($chk_Transaction_No, $chk_Business_Name, $chk_Resident_Name, $chk_New_or_Renewal, $chk_Owned_or_Rented, $chk_Occupation, $chk_CTC_No, $chk_Barangay_Business_Permit_Expiration_Date,), 'businesspermit.xlsx');
    }

    public function documentinformation_export(Request $request)
    {
        $data = request()->all();
        
        $chk_Transaction_No = isset($data['chk_Transaction_No']) ? 1 : 0;
        $chk_Request_Date = isset($data['chk_Request_Date']) ? 1 : 0;
        $chk_Resident_Name = isset($data['chk_Resident_Name']) ? 1 : 0;
        $chk_Released = isset($data['chk_Released']) ? 1 : 0;
        $chk_Remarks = isset($data['chk_Remarks']) ? 1 : 0;
        $chk_Purpose_of_Document = isset($data['chk_Purpose_of_Document']) ? 1 : 0;
        $chk_Salutation_Name = isset($data['chk_Salutation_Name']) ? 1 : 0;
        $chk_Issued_On = isset($data['chk_Issued_On']) ? 1 : 0;
        // $chk_Issued_At = isset($data['chk_Issued_At']) ? 1 : 0;
        $chk_Brgy_Cert_No = isset($data['chk_Brgy_Cert_No']) ? 1 : 0;
        $chk_Document_Type_Name = isset($data['chk_Document_Type_Name']) ? 1 : 0;
        $chk_SecondResident_Name = isset($data['chk_SecondResident_Name']) ? 1 : 0;
        $chk_OR_No = isset($data['chk_OR_No']) ? 1 : 0;
        $chk_Cash_Tendered = isset($data['chk_Cash_Tendered']) ? 1 : 0;

        return Excel::download(new DocumentInformationExportView($chk_Cash_Tendered,$chk_OR_No,$chk_SecondResident_Name,$chk_Document_Type_Name,$chk_Brgy_Cert_No,$chk_Issued_On,$chk_Salutation_Name,$chk_Purpose_of_Document,$chk_Remarks,$chk_Released,$chk_Resident_Name,$chk_Request_Date,$chk_Transaction_No,), 'documentinformation.xlsx');
    }

    public function brgybusiness_export(Request $request)
    {
        $data = request()->all();
        
        $chk_Business_Name = isset($data['chk_Business_Name']) ? 1 : 0;
        $chk_Business_Type = isset($data['chk_Business_Type']) ? 1 : 0;
        $chk_Business_Tin = isset($data['chk_Business_Tin']) ? 1 : 0;
        $chk_Business_Owner = isset($data['chk_Business_Owner']) ? 1 : 0;
        $chk_Business_Address = isset($data['chk_Business_Address']) ? 1 : 0;
        $chk_Mobile_No = isset($data['chk_Mobile_No']) ? 1 : 0;
        $chk_Active = isset($data['chk_Active']) ? 1 : 0;

        return Excel::download(new BrgyBusinessExportView($chk_Active,$chk_Mobile_No,$chk_Business_Address,$chk_Business_Owner,$chk_Business_Tin,$chk_Business_Type,$chk_Business_Name,), 'brgybusinessinfo.xlsx');
    }

    public function get_documenttype(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('maintenance_bcpcis_document_type as a')
        ->select(
           'a.Document_Type_Name',
        )
            ->where('a.Document_Type_ID', $id)->get();

        return (compact('theEntry'));
    }

    public function get_purposedocument(Request $request)
    {
        $id = $_GET['id'];


        $theEntry = DB::table('maintenance_bcpcis_purpose_of_document as a')
        ->select(
           'a.Purpose_of_Document',
        )
            ->where('a.Purpose_of_Document_ID', $id)->get();

        return (compact('theEntry'));
    }

    public function search_brgybusinesspermit_fields(Request $request)
    {
        // dd(request()->all());
        $currDATE = Carbon::now();
        $data = DB::table('bcpcis_brgy_business_permits as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('maintenance_bcpcis_barangay_business as f', 'a.Business_ID', '=', 'f.Business_ID')
        ->leftjoin('bips_brgy_inhabitants_information as g', 'a.Resident_ID', '=', 'g.Resident_ID')
            ->select(
                'a.Barangay_Permits_ID',
                'a.Business_ID',
                'a.Resident_ID',
                'a.Transaction_No',
                'a.Barangay_Business_Permit_Expiration_Date',
                'a.CTC_No',
                'a.Region_ID',
                'a.Province_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'f.Business_Name',
                DB::raw('CONCAT(g.First_Name, " ",LEFT(g.Middle_Name,1),". ",g.Last_Name) AS Resident_Name'),
                DB::raw('(CASE WHEN a.New_or_Renewal = false THEN "Renewal" ELSE "New" END) AS New_or_Renewal'),
                DB::raw('(CASE WHEN a.Owned_or_Rented = false THEN "Rented" ELSE "Owned" END) AS Owned_or_Rented'),

            );

        $param1 = $request->get('param1');
        $param2 = $request->get('param2');
        $param3 = $request->get('param3');
        $param4 = $request->get('param4');
        $param5 = $request->get('param5');
        $param6 = $request->get('param6');

        // if ($param1 != null && $param1 != "" && $param1 != "null") {
        //     $data->where('a.Transaction_No', $param1);
        // }
        if ($param1 != null && $param1 != "") {
            $data->where(function ($query) use ($param1) {
                $query->where('a.Transaction_No', 'LIKE', '%' . $param1 . '%');
            });
        }
        if ($param2 != null && $param2 != "") {
            $data->where(function ($query) use ($param2) {
                $query->where('f.Business_Name', 'LIKE', '%' . $param2 . '%');
            });
        }
        // if ($param2 != null && $param2 != "" && $param2 != "null") {
        //     $data->where('f.Business_Name', $param2);
        // }
        if ($param3 != null && $param3 != "") {
            $data->where(function ($query) use ($param3) {
                $query->where('g.Last_Name', 'LIKE', '%' . $param3 . '%')
                    ->orWhere('g.First_Name', 'LIKE', '%' . $param3 . '%')
                    ->orWhere('g.Middle_Name', 'LIKE', '%' . $param3 . '%');
            });
        }
        if ($param4 != null && $param4 != "" && $param4 != "null") {
            $data->where('a.New_or_Renewal', $param4);
        }
        if ($param5 != null && $param5 != "" && $param5 != "null") {
            $data->where('a.Owned_or_Rented', $param5);
        }
        if ($param6 != null && $param6 != "") {
            $data->where('a.Barangay_Business_Permit_Expiration_Date', $param6);
        }
        if (Auth::user()->User_Type_ID == 3) {
            $data->where('a.Province_ID', Auth::user()->Province_ID);
        } elseif (Auth::user()->User_Type_ID == 1) {
            $data->where('a.Barangay_ID', Auth::user()->Barangay_ID);
        }
        
        $db_entries = $data->orderby('a.Transaction_No', 'desc')->paginate(20);

        // dd($db_entries);

        return view('bcpcis_transactions.brgy_business_permit_data', compact('db_entries'))->render();
    }

    public function search_brgydocument_fields(Request $request)
    {
        // dd(request()->all());
        $currDATE = Carbon::now();

        
        $data = DB::table('bcpcis_brgy_document_information as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('maintenance_bcpcis_purpose_of_document as g', 'a.Purpose_of_Document_ID', '=', 'g.Purpose_of_Document_ID')
        ->leftjoin('maintenance_bcpcis_document_type as h', 'a.Document_Type_ID', '=', 'h.Document_Type_ID') 
        ->leftjoin('bips_brgy_inhabitants_information as i', 'a.Resident_ID', '=', 'i.Resident_ID')
        ->leftjoin('bcpcis_brgy_payment_collected as j', 'j.Document_ID', '=', 'a.Document_ID')
            ->select(
                'a.Document_ID',
                'a.Transaction_No',
                'a.Request_Date',
                DB::raw('(CASE WHEN a.Released = false THEN "No" ELSE "Yes" END) AS Released'),
                'a.Remarks',
                'a.Purpose_of_Document_ID',
                'a.Salutation_Name',
                'a.Picture',
                'j.CTC_No',
                'a.Issued_On',
                'a.Issued_At',
                'a.Document_Type_ID',
                'a.Resident_ID',
                'a.SecondResident_Name',
                'a.Region_ID',
                'a.Province_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'a.Request_Status_ID',
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'g.Purpose_of_Document',  
                'h.Document_Type_Name',
                DB::raw('CONCAT(i.First_Name, " ",LEFT(i.Middle_Name,1),". ",i.Last_Name) AS Resident_Name'),

            )
            ->where('a.Request_Status_ID', 3);
        $param1 = $request->get('param1');
        $param2 = $request->get('param2');
        $param3 = $request->get('param3');
        $param4 = $request->get('param4');
        $param5 = $request->get('param5');
        $param6 = $request->get('param6');
        $param7 = $request->get('param7');
        $param8 = $request->get('param8');
        $param9 = $request->get('param9');
        $param10 = $request->get('param10');
        $param11 = $request->get('param11');
            
        if ($param1 != null && $param1 != "") {
            $data->where(function ($query) use ($param1) {
                $query->where('a.Transaction_No', 'LIKE', '%' . $param1 . '%');
            });
        }
        if ($param2 != null && $param2 != "") {
            $data->where('a.Request_Date', $param2);
        }
        if ($param3 != null && $param3 != "" && $param3 != "null") {
            $data->where('a.Released', $param3);
        }
        if ($param4 != null && $param4 != "") {
            $data->where(function ($query) use ($param4) {
                $query->where('a.Remarks', 'LIKE', '%' . $param4 . '%');
            });
        }
        if ($param5 != null && $param5 != "") {
            $data->where(function ($query) use ($param5) {
                $query->where('a.Salutation_Name', 'LIKE', '%' . $param5 . '%');
            });
        }
        if ($param6 != null && $param6 != "") {
            $data->where(function ($query) use ($param6) {
                $query->where('j.CTC_No', 'LIKE', '%' . $param6 . '%');
            });
        }
        if ($param7 != null && $param7 != "") {
            $data->where('a.Issued_On', $param7);
        }
        if ($param8 != null && $param8 != "") {
            $data->where(function ($query) use ($param8) {
                $query->where('i.Last_Name', 'LIKE', '%' . $param8 . '%')
                    ->orWhere('i.First_Name', 'LIKE', '%' . $param8 . '%')
                    ->orWhere('i.Middle_Name', 'LIKE', '%' . $param8 . '%');
            });
        }
        if ($param9 != null && $param9 != "") {
            $data->where(function ($query) use ($param9) {
                $query->where('a.SecondResident_Name', 'LIKE', '%' . $param9 . '%');
            });
        }
        if ($param10 != null && $param10 != "" && $param10 != "null") {
            $data->where('a.Document_Type_ID', $param10);
        }
        if ($param11 != null && $param11 != "" && $param11 != "null") {
            $data->where('a.Purpose_of_Document_ID', $param11);
        }
        if (Auth::user()->User_Type_ID == 3) {
            $data->where('a.Province_ID', Auth::user()->Province_ID);
        } elseif (Auth::user()->User_Type_ID == 1) {
            $data->where('a.Barangay_ID', Auth::user()->Barangay_ID);
        }
        $db_entries = $data->orderby('a.Transaction_No', 'desc')->paginate(20);

        // dd($db_entries);

        return view('bcpcis_transactions.brgy_document_information_data', compact('db_entries'))->render();
    }


    public function search_barangaybusiness_fields(Request $request)
    {
        // dd(request()->all());
        $currDATE = Carbon::now();
        $data = DB::table('maintenance_bcpcis_barangay_business as a')
        ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
        ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
        ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
        ->leftjoin('maintenance_bcpcis_business_type as f', 'a.Business_Type_ID', '=', 'f.Business_Type_ID')
            ->select(
                'a.Business_ID',
                'a.Business_Name',
                'a.Business_Type_ID',
                'a.Business_Tin',
                'a.Business_Owner',
                'a.Business_Address',
                'a.Mobile_No',
                
                'a.Region_ID',
                'a.Province_ID',
                'a.Barangay_ID',
                'a.City_Municipality_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'f.Business_Type',
                DB::raw('(CASE WHEN a.Active = false THEN "No" ELSE "Yes" END) AS Active'),

            );

        $param1 = $request->get('param1');
        $param2 = $request->get('param2');
        $param3 = $request->get('param3');
        $param4 = $request->get('param4');
        $param5 = $request->get('param5');
        $param6 = $request->get('param6');
        $param7 = $request->get('param7');

        // if ($param1 != null && $param1 != "" && $param1 != "null") {
        //     $data->where('a.Business_Name', $param1);
        // }
        if ($param1 != null && $param1 != "") {
            $data->where(function ($query) use ($param1) {
                $query->where('a.Business_Name', 'LIKE', '%' . $param1 . '%');
            });
        }
        if ($param2 != null && $param2 != "" && $param2 != "null") {
            $data->where('a.Business_Type_ID', $param2);
        }
        if ($param3 != null && $param3 != "") {
            $data->where(function ($query) use ($param3) {
                $query->where('a.Business_Tin', 'LIKE', '%' . $param3 . '%');
            });
        }
        if ($param4 != null && $param4 != "") {
            $data->where(function ($query) use ($param4) {
                $query->where('a.Business_Owner', 'LIKE', '%' . $param4 . '%');
            });
        }
        if ($param5 != null && $param5 != "") {
            $data->where(function ($query) use ($param5) {
                $query->where('a.Business_Address', 'LIKE', '%' . $param5 . '%');
            });
        }
        if ($param6 != null && $param6 != "") {
            $data->where(function ($query) use ($param6) {
                $query->where('a.Mobile_No', 'LIKE', '%' . $param6 . '%');
            });
        }
        if ($param7 != null && $param7 != "" && $param7 != "null") {
            $data->where('a.Active', $param7);
        }
        if (Auth::user()->User_Type_ID == 3) {
            $data->where('a.Province_ID', Auth::user()->Province_ID);
        } elseif (Auth::user()->User_Type_ID == 1) {
            $data->where('a.Barangay_ID', Auth::user()->Barangay_ID);
        }
        
        $db_entries = $data->orderby('a.Business_ID', 'desc')->paginate(20);

        // dd($db_entries);

        return view('bcpcis_transactions.barangay_business_data', compact('db_entries'))->render();
    }

    public function search_documentrequestpending_fields(Request $request)
    {
        // dd(request()->all());
        $currDATE = Carbon::now();

        
        $data = DB::table('bcpcis_brgy_document_information as a') 
        ->leftjoin('bcpcis_brgy_document_claim_schedule as b', 'a.Document_ID', '=', 'b.Document_ID')
        ->leftjoin('bips_brgy_inhabitants_information as c', 'a.Resident_ID', '=', 'c.Resident_ID')
        ->leftjoin('maintenance_bcpcis_document_type as d', 'a.Document_Type_ID', '=', 'd.Document_Type_ID')
        ->leftjoin('maintenance_bcpcis_purpose_of_document as e', 'a.Purpose_of_Document_ID', '=', 'e.Purpose_of_Document_ID')
        ->select(
            'a.Document_ID',
            'b.Queue_Ticket_Number',
            'b.Requested_Date_and_Time',
            DB::raw('CONCAT(c.First_Name, " ",LEFT(c.Middle_Name,1),". ",c.Last_Name) AS Resident_Name'),
            'd.Document_Type_Name',
            'e.Purpose_of_Document',
            'a.Document_Type_ID',
            'a.Purpose_of_Document_ID'
           
        )
        ->where('a.Request_Status_ID', 0);
        $param1 = $request->get('param1');
        $param2 = $request->get('param2');
        $param3 = $request->get('param3');
        $param4 = $request->get('param4');
        $param5 = $request->get('param5');

        if ($param1 != null && $param1 != "" && $param1 != "null") {
            $data->where('b.Queue_Ticket_Number', $param1);
        }
        if ($param2 != null && $param2 != "") {
            $data->where('b.Requested_Date_and_Time', $param2);
        }
        if ($param3 != null && $param3 != "") {
            $data->where(function ($query) use ($param3) {
                $query->where('c.Last_Name', 'LIKE', '%' . $param3 . '%')
                    ->orWhere('c.First_Name', 'LIKE', '%' . $param3 . '%')
                    ->orWhere('c.Middle_Name', 'LIKE', '%' . $param3 . '%');
            });
        }
        if ($param4 != null && $param4 != "" && $param4 != "null") {
            $data->where('a.Document_Type_ID', $param4);
        }
        if ($param5 != null && $param5 != "" && $param5 != "null") {
            $data->where('a.Purpose_of_Document_ID', $param5);
        }
        
        if (Auth::user()->User_Type_ID == 3) {
            $data->where('a.Province_ID', Auth::user()->Province_ID);
        } elseif (Auth::user()->User_Type_ID == 1) {
            $data->where('a.Barangay_ID', Auth::user()->Barangay_ID);
        }
        $db_entries = $data->orderby('b.Queue_Ticket_Number', 'desc')->paginate(20);

        // dd($db_entries);

        return view('bcpcis_transactions.document_request_pending_data', compact('db_entries'))->render();
    }

    public function document_request_list(Request $request)
    {
        $currDATE = Carbon::now();

        
        $db_entries = DB::table('bcpcis_brgy_document_information as a')
        ->leftjoin('bcpcis_brgy_document_claim_schedule as b', 'a.Document_ID', '=', 'b.Document_ID')
        ->leftjoin('maintenance_bcpcis_purpose_of_document as c', 'a.Purpose_of_Document_ID', '=', 'c.Purpose_of_Document_ID') 
        ->leftjoin('maintenance_bcpcis_document_type as d', 'a.Document_Type_ID', '=', 'd.Document_Type_ID')
            ->select(
                'a.Document_ID',
                'a.Transaction_No',
                'a.Request_Date',
                'a.Remarks',
                'a.Purpose_of_Document_ID',
                'a.Salutation_Name',
                'a.Document_Type_ID',
                'a.Resident_ID',
                'a.SecondResident_Name',
                'a.Encoder_ID',
               
                'a.Request_Status_ID',   
                'b.Queue_Ticket_Number',
                'b.Requested_Date_and_Time',
                'c.Purpose_of_Document',  
                'd.Document_Type_Name', 
                DB::raw('CAST(a.Date_Stamp as date) AS Date_Stamp'),
                DB::raw('(CASE WHEN a.Request_Status_ID = 0 THEN "Pending" WHEN a.Request_Status_ID = 1 THEN "Approved" ELSE "Disapproved" END) AS Request_Status')
            )
            ->where([['a.Request_Status_ID','<>', 3],['a.Resident_ID', Auth::user()->Resident_ID]])
            ->paginate(20, ['*'], 'db_entries');


        return view('bcpcis_transactions.document_request_list', compact(
            'db_entries',
            'currDATE',
            
        ));
    }


    public function search_documentrequest_fields(Request $request)
    {
        // dd(request()->all());
        $currDATE = Carbon::now();

        
        $data = DB::table('bcpcis_brgy_document_information as a')
        ->leftjoin('bcpcis_brgy_document_claim_schedule as b', 'a.Document_ID', '=', 'b.Document_ID')
        ->leftjoin('maintenance_bcpcis_purpose_of_document as c', 'a.Purpose_of_Document_ID', '=', 'c.Purpose_of_Document_ID') 
        ->leftjoin('maintenance_bcpcis_document_type as d', 'a.Document_Type_ID', '=', 'd.Document_Type_ID')
            ->select(
                'a.Document_ID',
                'a.Transaction_No',
                'a.Request_Date',
                'a.Remarks',
                'a.Purpose_of_Document_ID',
                'a.Salutation_Name',
                'a.Document_Type_ID',
                'a.Resident_ID',
                'a.SecondResident_Name',
                'a.Encoder_ID',
               
                'a.Request_Status_ID',   
                'b.Queue_Ticket_Number',
                'b.Requested_Date_and_Time',
                'c.Purpose_of_Document',  
                'd.Document_Type_Name', 
                DB::raw('CAST(a.Date_Stamp as date) AS Date_Stamp'),
                DB::raw('(CASE WHEN a.Request_Status_ID = 0 THEN "Pending" WHEN a.Request_Status_ID = 1 THEN "Approved" ELSE "Disapproved" END) AS Request_Status')
            )
            ->where([['a.Request_Status_ID','<>', 3],['a.Resident_ID', Auth::user()->Resident_ID]]);
        $param1 = $request->get('param1');
        $param2 = $request->get('param2');
        $param3 = $request->get('param3');
        $param4 = $request->get('param4');
        $param5 = $request->get('param5');
        $param6 = $request->get('param6');
        $param7 = $request->get('param7');
        $param8 = $request->get('param8');
        $param9 = $request->get('param9');

        if ($param1 != null && $param1 != "" && $param1 != "null") {
            $data->where('b.Queue_Ticket_Number', $param1);
        }
        if ($param2 != null && $param2 != "" && $param2 != "null") {
            $data->where('a.Document_Type_ID', $param2);
        }
        if ($param3 != null && $param3 != "" && $param3 != "null") {
            $data->where('a.Purpose_of_Document_ID', $param3);
        }
        if ($param4 != null && $param4 != "" && $param4 != "null") {
            $data->where('a.Salutation_Name', $param4);
        }
        if ($param5 != null && $param5 != "" && $param5 != "null") {
            $data->where('a.Remarks', $param5);
        }
        if ($param6 != null && $param6 != "" && $param6 != "null") {
            $data->where('a.SecondResident_Name', $param6);
        }
        if ($param7 != null && $param7 != "") {
            $data->where('b.Requested_Date_and_Time', $param7);
        }
        if ($param8 != null && $param8 != "") {
            $data->where( DB::raw('CAST(a.Date_Stamp as date)'), $param8);
        }
        if ($param9 != null && $param9 != "" && $param9 != "null") {
            $data->where(DB::raw('(CASE WHEN a.Request_Status_ID = 0 THEN "Pending" WHEN a.Request_Status_ID = 1 THEN "Approved" ELSE "Disapproved" END)'), $param9);
        }
        
    
        $db_entries = $data->orderby('b.Queue_Ticket_Number', 'desc')->paginate(20);

        // dd($db_entries);

        return view('bcpcis_transactions.document_request_data', compact('db_entries'))->render();
    }

    public function document_request_details($id)
    {
        $currDATE = Carbon::now();

        
        $document = DB::table('bcpcis_brgy_document_information as a')
         ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
         ->select(
             'a.Document_ID',
             'a.Resident_ID',
             'a.Document_Type_ID',
             'a.Purpose_of_Document_ID',
             'a.Request_Date',
             'a.Salutation_Name',
             'a.Remarks',
             'a.SecondResident_Name',
             DB::raw('CONCAT(b.First_Name, " ",LEFT(b.Middle_Name,1),". ",b.Last_Name) AS Resident_Name'), 
         )
         ->where('Document_ID', $id)
         ->paginate(20, ['*'], 'document');
         $claim = DB::table('bcpcis_brgy_document_claim_schedule')->where('Document_ID', $id)->get();
         $purpose = DB::table('maintenance_bcpcis_purpose_of_document')->paginate(20, ['*'], 'purpose');
         $document_type = DB::table('maintenance_bcpcis_document_type')->paginate(20, ['*'], 'document_type');
             return view('bcpcis_transactions.document_request_approve', compact(
                 'currDATE',
                 'document',
                 'claim',
                 'purpose',
                 'document_type'
             ));
         
            
    }

    public function document_request_edit($id)
    {
        $currDATE = Carbon::now();
        
       
            $document = DB::table('bcpcis_brgy_document_information')->where('Document_ID', $id)->get();
            $claim = DB::table('bcpcis_brgy_document_claim_schedule')->where('Document_ID', $document[0]->Document_ID)->get();
            $purpose = DB::table('maintenance_bcpcis_purpose_of_document')->paginate(20, ['*'], 'purpose');
            $document_type = DB::table('maintenance_bcpcis_document_type')->paginate(20, ['*'], 'document_type');
            return view('bcpcis_transactions.brgy_document_information_request_edit', compact(
                'currDATE',
                'document',
                'claim',
                'purpose',
                'document_type',
            ));
      
    }

    public function create_brgy_document_information_request_update(Request $request)
     {

        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bcpcis_brgy_document_information')->where('Document_ID', $data['Document_ID'])->update(
            array(
                'Remarks'                  => $data['Remarks'],
                'Purpose_of_Document_ID'   => $data['Purpose_of_Document_ID'],
                'Salutation_Name'          => $data['Salutation_Name'],
                'Document_Type_ID'         => $data['Document_Type_ID'],
                'SecondResident_Name'      => $data['SecondResident_Name'],
                'Date_Stamp'               => Carbon::now(),
            )
        );

        DB::table('bcpcis_brgy_document_claim_schedule')->where('Document_ID', $data['Document_ID'])->update(
            array(
                
                'Requested_Date_and_Time'                      => $data['Requested_Date_and_Time'],
                'Date_Stamp'                                   => Carbon::now(),
            )

        );
     
        return redirect()->back()->with('message', 'Information Updated');
     }


     public function search_documentrequestapproved_fields(Request $request)
    {
        // dd(request()->all());
        $currDATE = Carbon::now();

        
        $data = DB::table('bcpcis_brgy_document_information as a') 
        ->leftjoin('bcpcis_brgy_document_claim_schedule as b', 'a.Document_ID', '=', 'b.Document_ID')
        ->leftjoin('bips_brgy_inhabitants_information as c', 'a.Resident_ID', '=', 'c.Resident_ID')
        ->leftjoin('maintenance_bcpcis_document_type as d', 'a.Document_Type_ID', '=', 'd.Document_Type_ID')
        ->leftjoin('maintenance_bcpcis_purpose_of_document as e', 'a.Purpose_of_Document_ID', '=', 'e.Purpose_of_Document_ID')
        ->select(
            'a.Document_ID',
            'b.Queue_Ticket_Number',
            'b.Requested_Date_and_Time',
            DB::raw('CONCAT(c.First_Name, " ",LEFT(c.Middle_Name,1),". ",c.Last_Name) AS Resident_Name'),
            'd.Document_Type_Name',
            'e.Purpose_of_Document',
            'a.Document_Type_ID',
            'a.Purpose_of_Document_ID'
           
        )
        ->where('a.Request_Status_ID', 1);
        $param1 = $request->get('param1');
        $param2 = $request->get('param2');
        $param3 = $request->get('param3');
        $param4 = $request->get('param4');
        $param5 = $request->get('param5');

        if ($param1 != null && $param1 != "" && $param1 != "null") {
            $data->where('b.Queue_Ticket_Number', $param1);
        }
        if ($param2 != null && $param2 != "") {
            $data->where('b.Requested_Date_and_Time', $param2);
        }
        if ($param3 != null && $param3 != "") {
            $data->where(function ($query) use ($param3) {
                $query->where('c.Last_Name', 'LIKE', '%' . $param3 . '%')
                    ->orWhere('c.First_Name', 'LIKE', '%' . $param3 . '%')
                    ->orWhere('c.Middle_Name', 'LIKE', '%' . $param3 . '%');
            });
        }
        if ($param4 != null && $param4 != "" && $param4 != "null") {
            $data->where('a.Document_Type_ID', $param4);
        }
        if ($param5 != null && $param5 != "" && $param5 != "null") {
            $data->where('a.Purpose_of_Document_ID', $param5);
        }
        
        if (Auth::user()->User_Type_ID == 3) {
            $data->where('a.Province_ID', Auth::user()->Province_ID);
        } elseif (Auth::user()->User_Type_ID == 1) {
            $data->where('a.Barangay_ID', Auth::user()->Barangay_ID);
        }
        $db_entries2 = $data->orderby('b.Queue_Ticket_Number', 'desc')->paginate(20);

        // dd($db_entries);

        return view('bcpcis_transactions.document_request_approved_data', compact('db_entries2'))->render();
    }

    public function search_documentrequestdisapproved_fields(Request $request)
    {
        // dd(request()->all());
        $currDATE = Carbon::now();

        
        $data = DB::table('bcpcis_brgy_document_information as a') 
        ->leftjoin('bcpcis_brgy_document_claim_schedule as b', 'a.Document_ID', '=', 'b.Document_ID')
        ->leftjoin('bips_brgy_inhabitants_information as c', 'a.Resident_ID', '=', 'c.Resident_ID')
        ->leftjoin('maintenance_bcpcis_document_type as d', 'a.Document_Type_ID', '=', 'd.Document_Type_ID')
        ->leftjoin('maintenance_bcpcis_purpose_of_document as e', 'a.Purpose_of_Document_ID', '=', 'e.Purpose_of_Document_ID')
        ->select(
            'a.Document_ID',
            'b.Queue_Ticket_Number',
            'b.Requested_Date_and_Time',
            DB::raw('CONCAT(c.First_Name, " ",LEFT(c.Middle_Name,1),". ",c.Last_Name) AS Resident_Name'),
            'd.Document_Type_Name',
            'e.Purpose_of_Document',
            'a.Document_Type_ID',
            'a.Purpose_of_Document_ID'
           
        )
        ->where('a.Request_Status_ID', 2);
        $param1 = $request->get('param1');
        $param2 = $request->get('param2');
        $param3 = $request->get('param3');
        $param4 = $request->get('param4');
        $param5 = $request->get('param5');

        if ($param1 != null && $param1 != "" && $param1 != "null") {
            $data->where('b.Queue_Ticket_Number', $param1);
        }
        if ($param2 != null && $param2 != "") {
            $data->where('b.Requested_Date_and_Time', $param2);
        }
        if ($param3 != null && $param3 != "") {
            $data->where(function ($query) use ($param3) {
                $query->where('c.Last_Name', 'LIKE', '%' . $param3 . '%')
                    ->orWhere('c.First_Name', 'LIKE', '%' . $param3 . '%')
                    ->orWhere('c.Middle_Name', 'LIKE', '%' . $param3 . '%');
            });
        }
        if ($param4 != null && $param4 != "" && $param4 != "null") {
            $data->where('a.Document_Type_ID', $param4);
        }
        if ($param5 != null && $param5 != "" && $param5 != "null") {
            $data->where('a.Purpose_of_Document_ID', $param5);
        }
        
        if (Auth::user()->User_Type_ID == 3) {
            $data->where('a.Province_ID', Auth::user()->Province_ID);
        } elseif (Auth::user()->User_Type_ID == 1) {
            $data->where('a.Barangay_ID', Auth::user()->Barangay_ID);
        }
        $db_entries3 = $data->orderby('b.Queue_Ticket_Number', 'desc')->paginate(20);

        // dd($db_entries);

        return view('bcpcis_transactions.document_request_disapproved_data', compact('db_entries3'))->render();
    }

}
