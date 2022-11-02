<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\File;
use PDF;

class BCPISController extends Controller
{
    //Brgy Document Information List
    public function brgy_document_information_list(Request $request)
    {
        $currDATE = Carbon::now();
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
                'b.Region_Name',
                'c.Province_Name',
                'e.Barangay_Name',
                'd.City_Municipality_Name',    
                'g.Purpose_of_Document',  
                'h.Document_Type_Name',
                DB::raw('CONCAT(i.First_Name, " ",LEFT(i.Middle_Name,1),". ",i.Last_Name) AS Resident_Name'),

            )
            ->paginate(20, ['*'], 'db_entries');


        return view('bcpcis_transactions.brgy_document_information_list', compact(
            'db_entries',
            'currDATE',
            
        ));
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

    // Save Brgy Document Information
    public function create_brgy_document_information(Request $request)
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

        if ($data['Document_ID'] == null || $data['Document_ID'] == 0) {
            $Document_ID = DB::table('bcpcis_brgy_document_information')->insertGetId(
                array(
                    'Transaction_No'        => $data['Transaction_No'],
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
                    'Barangay_ID'           => $data['Barangay_ID'],
                    'City_Municipality_ID'  => $data['City_Municipality_ID'],
                    'Province_ID'           => $data['Province_ID'],
                    'Region_ID'             => $data['Region_ID'],
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
                    'Barangay_ID'                               => $data['Barangay_ID'],
                    'City_Municipality_ID'                      => $data['City_Municipality_ID'],
                    'Province_ID'                               => $data['Province_ID'],
                    'Region_ID'                                 => $data['Region_ID'],
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),

                )
            );


            


            
            return redirect()->to('brgy_document_information_details/' . $Document_ID)->with('message', 'New Document Information Created');
        } else {
            DB::table('bcpcis_brgy_document_information')->where('Document_ID', $data['Document_ID'])->update(
                array(
                    'Transaction_No'        => $data['Transaction_No'],
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
                    'Barangay_ID'           => $data['Barangay_ID'],
                    'City_Municipality_ID'  => $data['City_Municipality_ID'],
                    'Province_ID'           => $data['Province_ID'],
                    'Region_ID'             => $data['Region_ID'],
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
                    'Barangay_ID'                               => $data['Barangay_ID'],
                    'City_Municipality_ID'                      => $data['City_Municipality_ID'],
                    'Province_ID'                               => $data['Province_ID'],
                    'Region_ID'                                 => $data['Region_ID'],
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),
                )

            );

            
         
            return redirect()->back()->with('message', 'Response Information Updated');
        }
    }

    //Barangay Business List
    public function barangay_business_list(Request $request)
    {
        $currDATE = Carbon::now();
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
            ->paginate(20, ['*'], 'db_entries');


        return view('bcpcis_transactions.barangay_business_list', compact(
            'db_entries',
            'currDATE',
            
        ));
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
                    'Barangay_ID'           => $data['Barangay_ID'],
                    'City_Municipality_ID'  => $data['City_Municipality_ID'],
                    'Province_ID'           => $data['Province_ID'],
                    'Region_ID'             => $data['Region_ID'],
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
                    'Barangay_ID'           => $data['Barangay_ID'],
                    'City_Municipality_ID'  => $data['City_Municipality_ID'],
                    'Province_ID'           => $data['Province_ID'],
                    'Region_ID'             => $data['Region_ID'],
                    'Active'                => (int)$data['Active'],
                    'Encoder_ID'            => Auth::user()->id,
                    'Date_Stamp'            => Carbon::now(),
                )
            );

            
         
            return redirect()->back()->with('message', 'Response Information Updated');
        }
    }

    //Brgy Business Permit List
    public function brgy_business_permit_list(Request $request)
    {
        $currDATE = Carbon::now();
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
            ->paginate(20, ['*'], 'db_entries');


        return view('bcpcis_transactions.brgy_business_permit_list', compact(
            'db_entries',
            'currDATE',
            
        ));
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
            $resident = DB::table('bips_brgy_inhabitants_information')->get();
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
                    'Barangay_ID'                               => $data['Barangay_ID'],
                    'City_Municipality_ID'                      => $data['City_Municipality_ID'],
                    'Province_ID'                               => $data['Province_ID'],
                    'Region_ID'                                 => $data['Region_ID'],
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
                    'Barangay_ID'                               => $data['Barangay_ID'],
                    'City_Municipality_ID'                      => $data['City_Municipality_ID'],
                    'Province_ID'                               => $data['Province_ID'],
                    'Region_ID'                                 => $data['Region_ID'],
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
                    'Barangay_ID'                               => $data['Barangay_ID'],
                    'City_Municipality_ID'                      => $data['City_Municipality_ID'],
                    'Province_ID'                               => $data['Province_ID'],
                    'Region_ID'                                 => $data['Region_ID'],
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
                    'Barangay_ID'                               => $data['Barangay_ID'],
                    'City_Municipality_ID'                      => $data['City_Municipality_ID'],
                    'Province_ID'                               => $data['Province_ID'],
                    'Region_ID'                                 => $data['Region_ID'],
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),
                )

            );
         
            return redirect()->back()->with('message', 'Response Information Updated');
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

            
         
            return redirect()->back()->with('message', 'Response Information Updated');
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

            
         
            return redirect()->back()->with('message', 'Response Information Updated');
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
            ->where('a.Barangay_Permits_ID','!=', 0)
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
                    'Barangay_ID'                               => $data['Barangay_ID'],
                    'City_Municipality_ID'                      => $data['City_Municipality_ID'],
                    'Province_ID'                               => $data['Province_ID'],
                    'Region_ID'                                 => $data['Region_ID'],
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
                    'Barangay_ID'                               => $data['Barangay_ID'],
                    'City_Municipality_ID'                      => $data['City_Municipality_ID'],
                    'Province_ID'                               => $data['Province_ID'],
                    'Region_ID'                                 => $data['Region_ID'],
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),
                )
            );

            
         
            return redirect()->back()->with('message', 'Response Information Updated');
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
            ->where('a.Document_ID','!=', 0)
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
                    'Barangay_ID'                               => $data['Barangay_ID'],
                    'City_Municipality_ID'                      => $data['City_Municipality_ID'],
                    'Province_ID'                               => $data['Province_ID'],
                    'Region_ID'                                 => $data['Region_ID'],
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
                    'Barangay_ID'                               => $data['Barangay_ID'],
                    'City_Municipality_ID'                      => $data['City_Municipality_ID'],
                    'Province_ID'                               => $data['Province_ID'],
                    'Region_ID'                                 => $data['Region_ID'],
                    'Encoder_ID'                                => Auth::user()->id,
                    'Date_Stamp'                                => Carbon::now(),
                )
            );

            
         
            return redirect()->back()->with('message', 'Response Information Updated');
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

        $pdf = PDF::loadView('bcpcis_transactions.DocResidencyPDF', compact('details'));
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

        $pdf = PDF::loadView('bcpcis_transactions.DocIndigencyPDF', compact('details'));
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

        $pdf = PDF::loadView('bcpcis_transactions.DocTravelPDF', compact('details'));
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

        $pdf = PDF::loadView('bcpcis_transactions.DocTravelPDF', compact('details'));
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
}
