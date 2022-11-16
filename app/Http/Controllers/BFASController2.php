<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;


class BFASController2 extends Controller
{
//BFAS Transactions
    //Card File
    public function bfas_card_file(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bfas_card_file')
            ->join('maintenance_bfas_card_type','maintenance_bfas_card_type.Card_Type_ID','=','bfas_card_file.Card_Type_ID')
            ->join('maintenance_barangay','maintenance_barangay.Barangay_ID','=','bfas_card_file.Barangay_ID')
            ->join('maintenance_city_municipality','maintenance_city_municipality.City_Municipality_ID','=','bfas_card_file.City_Municipality_ID')
            ->join('maintenance_province','maintenance_province.Province_ID','=','bfas_card_file.Province_ID')
            ->join('maintenance_region','maintenance_region.Region_ID','=','bfas_card_file.Region_ID')
            ->get();

        $regionX=DB::table('maintenance_region')->get();
        $card_type=DB::table('maintenance_bfas_card_type')->get();

        return view('bfas.card_file',compact('db_entries','currDATE','regionX','card_type'));
    }

    public function create_bfas_card_file(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_card_file')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX'],

                'Card_Type_ID' => $data['Card_TypeX'],

                'Company_Name' => $data['Company_Name'],
                'Company_Tin'  => $data['Company_Tin'],

                'Last_Name'    => $data['Last_Name'],
                'First_Name'   => $data['First_Name'],
                'Middle_Name'  => $data['Middle_Name'],

                'Phone_No'     => $data['Phone_No'],
                'Contact_No_1' => $data['Contact_No_1'],
                'Contact_No_2' => $data['Contact_No_2'],

                'Billing_Address'  => $data['Billing_Address'],
                'Delivery_Address' => $data['Delivery_Address'],
                'Email_Address'    => $data['Email_Address'],

                'Region_ID'            => $data['Region_IDX'],
                'Province_ID'          => $data['Province_IDX'],
                'City_Municipality_ID' => $data['City_Municipality_IDX'],
                'Barangay_ID'          => $data['Barangay_IDX'],

                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_card_file(Request $request)
    {
       $id=$_GET['id'];
       //$id=1;

        $theEntry=DB::table('bfas_card_file')
            ->join('maintenance_bfas_card_type','maintenance_bfas_card_type.Card_Type_ID','=','bfas_card_file.Card_Type_ID')
            ->join('maintenance_barangay','maintenance_barangay.Barangay_ID','=','bfas_card_file.Barangay_ID')
            ->join('maintenance_city_municipality','maintenance_city_municipality.City_Municipality_ID','=','bfas_card_file.City_Municipality_ID')
            ->join('maintenance_province','maintenance_province.Province_ID','=','bfas_card_file.Province_ID')
            ->join('maintenance_region','maintenance_region.Region_ID','=','bfas_card_file.Region_ID')
            ->where('Card_File_ID',$id)
            ->get();

        return(compact('theEntry'));
    }
    public function update_bfas_card_file(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_card_file')->where('Card_File_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX2'],

                'Card_Type_ID' => $data['Card_TypeX2'],

                'Company_Name' => $data['Company_Name2'],
                'Company_Tin'  => $data['Company_Tin2'],

                'Last_Name'    => $data['Last_Name2'],
                'First_Name'   => $data['First_Name2'],
                'Middle_Name'  => $data['Middle_Name2'],

                'Phone_No'     => $data['Phone_No2'],
                'Contact_No_1' => $data['Contact_No_1_b'],
                'Contact_No_2' => $data['Contact_No_2_b'],

                'Billing_Address'  => $data['Billing_Address2'],
                'Delivery_Address' => $data['Delivery_Address2'],
                'Email_Address'    => $data['Email_Address2'],

                'Region_ID'            => $data['Region_IDX2'],
                'Province_ID'          => $data['Province_IDX2'],
                'City_Municipality_ID' => $data['City_Municipality_IDX2'],
                'Barangay_ID'          => $data['Barangay_IDX2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Account Information
    public function bfas_accounts_information(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bfas_accounts_information as a')
            ->leftjoin('maintenance_bfas_account_type as b','b.Account_Type_ID','=','a.Account_Type_ID')
            ->leftjoin('maintenance_bfas_account_code as c','c.Account_Code_ID','=','a.Account_Code_ID')
            ->select(
                'a.Accounts_Information_ID',
                'a.Account_Level',
                'a.Parent_Account',
                'b.Account_Type_ID',
                'b.Account_Type',
                'c.Account_Code_ID',
                'c.Account_Code',
                'a.Account_Name',
                'a.Account_Number',
                'a.Active',
                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            
            ->get();

            $determiner=1;
            if($request->has('determiner')){$data = request()->all(); $determiner=$data['determiner'];}else{$determiner=1;}

            $Level_1 = DB::table('bfas_accounts_information as a')
            ->leftjoin('maintenance_bfas_account_type as b','b.Account_Type_ID','=','a.Account_Type_ID')
            ->leftjoin('maintenance_bfas_account_code as c','c.Account_Code_ID','=','a.Account_Code_ID')
            ->select(
                'a.Accounts_Information_ID',
                'a.Account_Level',
                'a.Parent_Account',
                'b.Account_Type_ID',
                'b.Account_Type',
                'c.Account_Code_ID',
                'c.Account_Code',
                'a.Account_Name',
                'a.Account_Number',
                'a.Active',
                'a.Encoder_ID',
                'a.Date_Stamp'
            )
            ->where('a.Account_Level',1)
            ->where('a.Accounts_Information_ID',$determiner)
            ->get();

            $Level_2 = DB::table('bfas_accounts_information as a')
            ->leftjoin('maintenance_bfas_account_type as b','b.Account_Type_ID','=','a.Account_Type_ID')
            ->leftjoin('maintenance_bfas_account_code as c','c.Account_Code_ID','=','a.Account_Code_ID')
            ->select(
                'a.Accounts_Information_ID',
                'a.Account_Level',
                'a.Parent_Account',
                'b.Account_Type_ID',
                'b.Account_Type',
                'c.Account_Code_ID',
                'c.Account_Code',
                'a.Account_Name',
                'a.Account_Number',
                'a.Active',
                'a.Encoder_ID',
                'a.Date_Stamp'
            )
            ->where('a.Account_Level',2)
            ->get();

            $Level_3 = DB::table('bfas_accounts_information as a')
            ->leftjoin('maintenance_bfas_account_type as b','b.Account_Type_ID','=','a.Account_Type_ID')
            ->leftjoin('maintenance_bfas_account_code as c','c.Account_Code_ID','=','a.Account_Code_ID')
            ->select(
                'a.Accounts_Information_ID',
                'a.Account_Level',
                'a.Parent_Account',
                'b.Account_Type_ID',
                'b.Account_Type',
                'c.Account_Code_ID',
                'c.Account_Code',
                'a.Account_Name',
                'a.Account_Number',
                'a.Active',
                'a.Encoder_ID',
                'a.Date_Stamp'
            )
            ->where('a.Account_Level',3)
            ->get();

            $Level_4 = DB::table('bfas_accounts_information as a')
            ->leftjoin('maintenance_bfas_account_type as b','b.Account_Type_ID','=','a.Account_Type_ID')
            ->leftjoin('maintenance_bfas_account_code as c','c.Account_Code_ID','=','a.Account_Code_ID')
            ->select(
                'a.Accounts_Information_ID',
                'a.Account_Level',
                'a.Parent_Account',
                'b.Account_Type_ID',
                'b.Account_Type',
                'c.Account_Code_ID',
                'c.Account_Code',
                'a.Account_Name',
                'a.Account_Number',
                'a.Active',
                'a.Encoder_ID',
                'a.Date_Stamp'
            )
            ->where('a.Account_Level',4)
            ->get();

            $Level_5 = DB::table('bfas_accounts_information as a')
            ->leftjoin('maintenance_bfas_account_type as b','b.Account_Type_ID','=','a.Account_Type_ID')
            ->leftjoin('maintenance_bfas_account_code as c','c.Account_Code_ID','=','a.Account_Code_ID')
            ->select(
                'a.Accounts_Information_ID',
                'a.Account_Level',
                'a.Parent_Account',
                'b.Account_Type_ID',
                'b.Account_Type',
                'c.Account_Code_ID',
                'c.Account_Code',
                'a.Account_Name',
                'a.Account_Number',
                'a.Active',
                'a.Encoder_ID',
                'a.Date_Stamp'
            )
            ->where('a.Account_Level',5)
            ->get();

//dd($Level_4);
        $acc_type=DB::table('maintenance_bfas_account_type')->get();
        $acc_code=DB::table('maintenance_bfas_account_code')->get();

        return view('bfas.accounts_information',compact('db_entries','currDATE','acc_type','acc_code','Level_1','Level_2','Level_3','Level_4','Level_5'));
    }

    public function create_bfas_accounts_information(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_accounts_information')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX'],

                'Account_Type_ID'  => $data['Account_Type_ID'],
                'Account_Code_ID'  => $data['Account_Code_ID'],
                'Account_Name'     => $data['Account_Name'],
                'Account_Number'   => $data['Account_Number'],

                'Account_Level'    => $data['Account_Level'],
                'Parent_Account'   => $data['Parent_Account'],

                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_accounts_information(Request $request)
    {
        $id=$_GET['id'];
        //$id=1;

        $theEntry=DB::table('bfas_accounts_information as a')
            ->join('maintenance_bfas_account_type as b','b.Account_Type_ID','=','a.Account_Type_ID')
            ->join('maintenance_bfas_account_code as c','c.Account_Code_ID','=','a.Account_Code_ID')
            ->select(
                'a.Accounts_Information_ID',
                'b.Account_Type_ID',
                'b.Account_Type',
                'c.Account_Code_ID',
                'c.Account_Code',
                'a.Account_Name',
                'a.Account_Number',
                'a.Account_Level',
                'a.Active',
                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            ->where('a.Accounts_Information_ID',$id)
            ->get();
        //dd($theEntry);
        return(compact('theEntry'));
    }
    public function update_bfas_accounts_information(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_accounts_information')->where('Accounts_Information_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX2'],

                'Account_Type_ID'  => $data['Account_Type_ID2'],
                'Account_Code_ID'  => $data['Account_Code_ID2'],
                'Account_Name'     => $data['Account_Name2'],
                'Account_Number'   => $data['Account_Number2'],

                'Account_Level'    => $data['Account_Level2'],
                'Parent_Account'   => $data['Parent_Account2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //JEV Collection
    public function bfas_jev_collection(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bfas_jev_collection as a')
            ->join('maintenance_bfas_bank_account as b','b.Bank_Account_ID','=','a.Bank_Account_ID')
            ->join('maintenance_bfas_journal_type as c','c.Journal_Type_ID','=','a.Journal_Type_ID')
            ->join('maintenance_bfas_fund_type as d','d.Fund_Type_ID','=','a.Fund_Type_ID')

            ->join('maintenance_barangay as brgy','brgy.Barangay_ID','=','a.Barangay_ID')
            ->join('maintenance_city_municipality as city','city.City_Municipality_ID','=','a.City_Municipality_ID')
            ->join('maintenance_province as prov','prov.Province_ID','=','a.Province_ID')
            ->join('maintenance_region as reg','reg.Region_ID','=','a.Region_ID')

            ->select(
                'a.JEV_Collection_ID',
                'b.Bank_Account_ID',
                'b.Bank_Account_Name',
                'b.Bank_Account_No',
                'c.Journal_Type_ID',
                'c.Journal_Type',
                'd.Fund_Type_ID',
                'd.Fund_Type',
                'a.Journal_Number',
                'a.Particulars',

                'brgy.Barangay_ID',
                'brgy.Barangay_Name',
                'city.City_Municipality_ID',
                'city.City_Municipality_Name',
                'prov.Province_ID',
                'prov.Province_Name',
                'reg.Region_ID',
                'reg.Region_Name',

                'a.Active',
                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            ->get();
        
        $regionX=DB::table('maintenance_region')->get();
        $bank_acc=DB::table('maintenance_bfas_bank_account')->get();
        $journal_type=DB::table('maintenance_bfas_journal_type')->get();
        $fund_type=DB::table('maintenance_bfas_fund_type')->get();

        return view('bfas.jev_collection',compact('db_entries','currDATE','regionX','bank_acc','journal_type','fund_type'));
    }

    public function create_bfas_jev_collection(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_jev_collection')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX'],

                'Journal_Number'   => $data['Journal_Number'],
                'Bank_Account_ID'  => $data['Bank_Account_ID'],
                'Journal_Type_ID'  => $data['Journal_Type_ID'],
                'Fund_Type_ID'     => $data['Fund_Type_ID'],

                'Particulars'      => $data['Particulars'],

                'Region_ID'            => $data['Region_IDX'],
                'Province_ID'          => $data['Province_IDX'],
                'City_Municipality_ID' => $data['City_Municipality_IDX'],
                'Barangay_ID'          => $data['Barangay_IDX'],
                

                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_jev_collection(Request $request)
    {
        $id=$_GET['id'];
        //$id=1;

        $theEntry=DB::table('bfas_jev_collection as a')
            ->join('maintenance_bfas_bank_account as b','b.Bank_Account_ID','=','a.Bank_Account_ID')
            ->join('maintenance_bfas_journal_type as c','c.Journal_Type_ID','=','a.Journal_Type_ID')
            ->join('maintenance_bfas_fund_type as d','d.Fund_Type_ID','=','a.Fund_Type_ID')

            ->join('maintenance_barangay as brgy','brgy.Barangay_ID','=','a.Barangay_ID')
            ->join('maintenance_city_municipality as city','city.City_Municipality_ID','=','a.City_Municipality_ID')
            ->join('maintenance_province as prov','prov.Province_ID','=','a.Province_ID')
            ->join('maintenance_region as reg','reg.Region_ID','=','a.Region_ID')

            ->select(
                'a.JEV_Collection_ID',
                'b.Bank_Account_ID',
                'b.Bank_Account_Name',
                'b.Bank_Account_No',
                'c.Journal_Type_ID',
                'c.Journal_Type',
                'd.Fund_Type_ID',
                'd.Fund_Type',
                'a.Journal_Number',
                'a.Particulars',

                'brgy.Barangay_ID',
                'brgy.Barangay_Name',
                'city.City_Municipality_ID',
                'city.City_Municipality_Name',
                'prov.Province_ID',
                'prov.Province_Name',
                'reg.Region_ID',
                'reg.Region_Name',

                'a.Active',
                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            ->where('a.JEV_Collection_ID',$id)
            ->get();
        //dd($theEntry);
        return(compact('theEntry'));
    }
    public function update_bfas_jev_collection(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_jev_collection')->where('JEV_Collection_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX2'],

                'Journal_Number'   => $data['Journal_Number2'],
                'Bank_Account_ID'  => $data['Bank_Account_ID2'],
                'Journal_Type_ID'  => $data['Journal_Type_ID2'],
                'Fund_Type_ID'     => $data['Fund_Type_ID2'],

                'Particulars'      => $data['Particulars2'],

                'Region_ID'            => $data['Region_IDX2'],
                'Province_ID'          => $data['Province_IDX2'],
                'City_Municipality_ID' => $data['City_Municipality_IDX2'],
                'Barangay_ID'          => $data['Barangay_IDX2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //JEV Disbursement
    public function bfas_jev_disbursement(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bfas_jev_disbursement as a')
            ->join('maintenance_bfas_bank_account as b','b.Bank_Account_ID','=','a.Bank_Account_ID')
            ->join('maintenance_bfas_journal_type as c','c.Journal_Type_ID','=','a.Journal_Type_ID')
            ->join('maintenance_bfas_fund_type as d','d.Fund_Type_ID','=','a.Fund_Type_ID')

            ->join('maintenance_barangay as brgy','brgy.Barangay_ID','=','a.Barangay_ID')
            ->join('maintenance_city_municipality as city','city.City_Municipality_ID','=','a.City_Municipality_ID')
            ->join('maintenance_province as prov','prov.Province_ID','=','a.Province_ID')
            ->join('maintenance_region as reg','reg.Region_ID','=','a.Region_ID')

            ->select(
                'a.JEV_Disbursement_ID',
                'b.Bank_Account_ID',
                'b.Bank_Account_Name',
                'b.Bank_Account_No',
                'c.Journal_Type_ID',
                'c.Journal_Type',
                'd.Fund_Type_ID',
                'd.Fund_Type',
                'a.Journal_Number',
                'a.Particulars',

                'brgy.Barangay_ID',
                'brgy.Barangay_Name',
                'city.City_Municipality_ID',
                'city.City_Municipality_Name',
                'prov.Province_ID',
                'prov.Province_Name',
                'reg.Region_ID',
                'reg.Region_Name',

                'a.Active',
                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            ->get();
        
        $regionX=DB::table('maintenance_region')->get();
        $bank_acc=DB::table('maintenance_bfas_bank_account')->get();
        $journal_type=DB::table('maintenance_bfas_journal_type')->get();
        $fund_type=DB::table('maintenance_bfas_fund_type')->get();

        return view('bfas.jev_disbursement',compact('db_entries','currDATE','regionX','bank_acc','journal_type','fund_type'));
    }

    public function create_bfas_jev_disbursement(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_jev_disbursement')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX'],

                'Journal_Number'   => $data['Journal_Number'],
                'Bank_Account_ID'  => $data['Bank_Account_ID'],
                'Journal_Type_ID'  => $data['Journal_Type_ID'],
                'Fund_Type_ID'     => $data['Fund_Type_ID'],

                'Particulars'      => $data['Particulars'],

                'Region_ID'            => $data['Region_IDX'],
                'Province_ID'          => $data['Province_IDX'],
                'City_Municipality_ID' => $data['City_Municipality_IDX'],
                'Barangay_ID'          => $data['Barangay_IDX'],
                

                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_jev_disbursement(Request $request)
    {
        $id=$_GET['id'];
        //$id=1;

        $theEntry=DB::table('bfas_jev_disbursement as a')
            ->join('maintenance_bfas_bank_account as b','b.Bank_Account_ID','=','a.Bank_Account_ID')
            ->join('maintenance_bfas_journal_type as c','c.Journal_Type_ID','=','a.Journal_Type_ID')
            ->join('maintenance_bfas_fund_type as d','d.Fund_Type_ID','=','a.Fund_Type_ID')

            ->join('maintenance_barangay as brgy','brgy.Barangay_ID','=','a.Barangay_ID')
            ->join('maintenance_city_municipality as city','city.City_Municipality_ID','=','a.City_Municipality_ID')
            ->join('maintenance_province as prov','prov.Province_ID','=','a.Province_ID')
            ->join('maintenance_region as reg','reg.Region_ID','=','a.Region_ID')

            ->select(
                'a.JEV_Disbursement_ID',
                'b.Bank_Account_ID',
                'b.Bank_Account_Name',
                'b.Bank_Account_No',
                'c.Journal_Type_ID',
                'c.Journal_Type',
                'd.Fund_Type_ID',
                'd.Fund_Type',
                'a.Journal_Number',
                'a.Particulars',

                'brgy.Barangay_ID',
                'brgy.Barangay_Name',
                'city.City_Municipality_ID',
                'city.City_Municipality_Name',
                'prov.Province_ID',
                'prov.Province_Name',
                'reg.Region_ID',
                'reg.Region_Name',

                'a.Active',
                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            ->where('a.JEV_Disbursement_ID',$id)
            ->get();
        //dd($theEntry);
        return(compact('theEntry'));
    }
    public function update_bfas_jev_disbursement(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_jev_disbursement')->where('JEV_Disbursement_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX2'],

                'Journal_Number'   => $data['Journal_Number2'],
                'Bank_Account_ID'  => $data['Bank_Account_ID2'],
                'Journal_Type_ID'  => $data['Journal_Type_ID2'],
                'Fund_Type_ID'     => $data['Fund_Type_ID2'],

                'Particulars'      => $data['Particulars2'],

                'Region_ID'            => $data['Region_IDX2'],
                'Province_ID'          => $data['Province_IDX2'],
                'City_Municipality_ID' => $data['City_Municipality_IDX2'],
                'Barangay_ID'          => $data['Barangay_IDX2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Disbursement Voucher
    public function bfas_disbursement_voucher(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bfas_disbursement_voucher as a')
            ->join('maintenance_bfas_appropriation_type as b','b.Appropriation_Type_ID','=','a.Appropriation_Type_ID')
            ->join('maintenance_bfas_fund_type as c','c.Fund_Type_ID','=','a.Fund_Type_ID')
            ->join('bfas_card_file as d','d.Card_File_ID','=','a.Card_File_ID')
            ->join('maintenance_bfas_voucher_status as e','e.Voucher_Status_ID','=','a.Disbursement_Voucher_Status_ID')
            ->join('maintenance_bfas_tax_code as f','f.Tax_Code_ID','=','a.Tax_Code_ID')
            ->join('bfas_card_file as g','g.Card_File_ID','=','a.Brgy_Officials_and_Staff_ID')
            ->leftjoin('bfas_dv_obligation_request as h','h.Disbursement_Voucher_ID','=','a.Disbursement_Voucher_ID')
            ->leftjoin('bfas_obligation_request as i','i.Obligation_Request_ID','=','h.Obligation_Request_ID')
            ->leftjoin('bfas_obr_accounts as j','j.Obligation_Request_ID','=','i.Obligation_Request_ID')

            ->join('maintenance_barangay as brgy','brgy.Barangay_ID','=','a.Barangay_ID')
            ->join('maintenance_city_municipality as city','city.City_Municipality_ID','=','a.City_Municipality_ID')
            ->join('maintenance_province as prov','prov.Province_ID','=','a.Province_ID')
            ->join('maintenance_region as reg','reg.Region_ID','=','a.Region_ID')

            ->select(
                'a.Disbursement_Voucher_ID',
                'a.Transaction_No',
                'a.Voucher_No',
                'b.Appropriation_Type_ID',
                'b.Appropriation_Type',
                'c.Fund_Type_ID',
                'c.Fund_Type',
                'd.Card_File_ID',
                'd.Last_Name','d.First_Name','d.Middle_Name',
                'e.Voucher_Status_ID',
                'e.Voucher_Status',
                'a.Particulars',
                'a.For_Liquidation',
                'a.For_Payroll',
                'a.For_Cash_Advance',
                'a.Disbursement_Check',
                'a.Disbursement_Cash',
                'a.Remarks',
                'f.Tax_Code_ID',
                'f.Description',
                'g.Card_File_ID',
                'g.Last_Name as Last_Name2','g.First_Name as First_Name2','g.Middle_Name as Middle_Name2',

                'h.Multiple_OBR_ID',

                'i.Obligation_Request_No',
                
                'j.Amount',

                'brgy.Barangay_ID',
                'brgy.Barangay_Name',
                'city.City_Municipality_ID',
                'city.City_Municipality_Name',
                'prov.Province_ID',
                'prov.Province_Name',
                'reg.Region_ID',
                'reg.Region_Name',

                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            ->get();
       /// dd($db_entries);
        $regionX=DB::table('maintenance_region')->get();

        $app_type=DB::table('maintenance_bfas_appropriation_type')->get();
        $fund_type=DB::table('maintenance_bfas_fund_type')->get();
        $card_file=DB::table('bfas_card_file')->get();
        $dv_status=DB::table('maintenance_bfas_voucher_status')->get();
        $tax_code=DB::table('maintenance_bfas_tax_code')->get();
        $obr=DB::table('bfas_obligation_request')->get();

        return view('bfas.disbursement_voucher',compact('db_entries','currDATE','regionX','app_type','fund_type','card_file','dv_status','tax_code','obr'));
    }

    public function create_bfas_disbursement_voucher(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        if($data['Purpose']==1){
            $FL= 1;
            $FP= NULL;
            $FCA= NULL;
            $DCS= NULL;
            $DCC= NULL;
        }
        if($data['Purpose']==2){
            $FL= NULL;
            $FP= 1;
            $FCA= NULL;
            $DCS= NULL;
            $DCC= NULL;
        }
        if($data['Purpose']==3){
            $FL= NULL;
            $FP= NULL;
            $FCA= 1;
            $DCS= NULL;
            $DCC= NULL;
        }
        if($data['Purpose']==4){
            $FL= NULL;
            $FP= NULL;
            $FCA= NULL;
            $DCS= 1;
            $DCC= NULL;
        }
        if($data['Purpose']==5){
            $FL= NULL;
            $FP= NULL;
            $FCA= NULL;
            $DCS= NULL;
            $DCC= 1;
        }

        DB::table('bfas_disbursement_voucher')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),

                'Transaction_No'   => $data['Transaction_No'],
                'Voucher_No'       => $data['Voucher_No'],

                'Appropriation_Type_ID'  => $data['Appropriation_Type_ID'],
                'Fund_Type_ID'           => $data['Fund_Type_ID'],
                'Tax_Code_ID'           => $data['Tax_Code_ID'],
                'Card_File_ID'           => $data['Card_File_ID'],
                'Brgy_Officials_and_Staff_ID'     => $data['Brgy_Officials_and_Staff_ID'],
                'Disbursement_Voucher_Status_ID'  => $data['Disbursement_Voucher_Status_ID'],

                'Particulars'      => $data['Particulars'],
                'Remarks'          => $data['Remarks'],

                'For_Liquidation'    => $FL,
                'For_Payroll'        => $FP,
                'For_Cash_Advance'   => $FCA,
                'Disbursement_Check' => $DCC,
                'Disbursement_Cash'  => $DCS,

                'Region_ID'            => $data['Region_IDX'],
                'Province_ID'          => $data['Province_IDX'],
                'City_Municipality_ID' => $data['City_Municipality_IDX'],
                'Barangay_ID'          => $data['Barangay_IDX'],
                
                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_disbursement_voucher(Request $request)
    {
        $id=$_GET['id'];
        //$id=1;

        $theEntry = DB::table('bfas_disbursement_voucher as a')
            ->join('maintenance_bfas_appropriation_type as b','b.Appropriation_Type_ID','=','a.Appropriation_Type_ID')
            ->join('maintenance_bfas_fund_type as c','c.Fund_Type_ID','=','a.Fund_Type_ID')
            ->join('bfas_card_file as d','d.Card_File_ID','=','a.Card_File_ID')
            ->join('maintenance_bfas_voucher_status as e','e.Voucher_Status_ID','=','a.Disbursement_Voucher_Status_ID')
            ->join('maintenance_bfas_tax_code as f','f.Tax_Code_ID','=','a.Tax_Code_ID')
            ->join('bfas_card_file as g','g.Card_File_ID','=','a.Brgy_Officials_and_Staff_ID')

            ->join('maintenance_barangay as brgy','brgy.Barangay_ID','=','a.Barangay_ID')
            ->join('maintenance_city_municipality as city','city.City_Municipality_ID','=','a.City_Municipality_ID')
            ->join('maintenance_province as prov','prov.Province_ID','=','a.Province_ID')
            ->join('maintenance_region as reg','reg.Region_ID','=','a.Region_ID')

            ->select(
                'a.Disbursement_Voucher_ID',
                'a.Transaction_No',
                'a.Voucher_No',
                'b.Appropriation_Type_ID',
                'b.Appropriation_Type',
                'c.Fund_Type_ID',
                'c.Fund_Type',
                'd.Card_File_ID',
                'd.Last_Name','d.First_Name','d.Middle_Name',
                'e.Voucher_Status_ID',
                'e.Voucher_Status',
                'a.Particulars',
                'a.For_Liquidation',
                'a.For_Payroll',
                'a.For_Cash_Advance',
                'a.Disbursement_Check',
                'a.Disbursement_Cash',
                'a.Remarks',
                'f.Tax_Code_ID',
                'f.Description',
                'g.Card_File_ID',
                'g.Last_Name as Last_Name2','g.First_Name as First_Name2','g.Middle_Name as Middle_Name2',

                'brgy.Barangay_ID',
                'brgy.Barangay_Name',
                'city.City_Municipality_ID',
                'city.City_Municipality_Name',
                'prov.Province_ID',
                'prov.Province_Name',
                'reg.Region_ID',
                'reg.Region_Name',

                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            ->where('a.Disbursement_Voucher_ID',$id)
            ->get();

        //dd($theEntry);
        return(compact('theEntry'));
    }
    public function update_bfas_disbursement_voucher(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        if($data['Purpose2']==1){
            $FL= 1;
            $FP= NULL;
            $FCA= NULL;
            $DCS= NULL;
            $DCC= NULL;
        }
        if($data['Purpose2']==2){
            $FL= NULL;
            $FP= 1;
            $FCA= NULL;
            $DCS= NULL;
            $DCC= NULL;
        }
        if($data['Purpose2']==3){
            $FL= NULL;
            $FP= NULL;
            $FCA= 1;
            $DCS= NULL;
            $DCC= NULL;
        }
        if($data['Purpose2']==4){
            $FL= NULL;
            $FP= NULL;
            $FCA= NULL;
            $DCS= 1;
            $DCC= NULL;
        }
        if($data['Purpose2']==5){
            $FL= NULL;
            $FP= NULL;
            $FCA= NULL;
            $DCS= NULL;
            $DCC= 1;
        }

        DB::table('bfas_disbursement_voucher')->where('Disbursement_Voucher_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),

                'Transaction_No'   => $data['Transaction_No2'],
                'Voucher_No'       => $data['Voucher_No2'],

                'Appropriation_Type_ID'  => $data['Appropriation_Type_ID2'],
                'Fund_Type_ID'           => $data['Fund_Type_ID2'],
                'Tax_Code_ID'           => $data['Tax_Code_ID2'],
                'Card_File_ID'           => $data['Card_File_ID2'],
                'Brgy_Officials_and_Staff_ID'     => $data['Brgy_Officials_and_Staff_ID2'],
                'Disbursement_Voucher_Status_ID'  => $data['Disbursement_Voucher_Status_ID2'],

                'Particulars'      => $data['Particulars2'],
                'Remarks'          => $data['Remarks2'],

                'For_Liquidation'    => $FL,
                'For_Payroll'        => $FP,
                'For_Cash_Advance'   => $FCA,
                'Disbursement_Check' => $DCC,
                'Disbursement_Cash'  => $DCS,

                'Region_ID'            => $data['Region_IDX2'],
                'Province_ID'          => $data['Province_IDX2'],
                'City_Municipality_ID' => $data['City_Municipality_IDX2'],
                'Barangay_ID'          => $data['Barangay_IDX2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    
    // Check Preparation
    public function bfas_check_preparation(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bfas_check_preparation as a')
        ->join('maintenance_bfas_bank_account as b','b.Bank_Account_ID','=','a.Bank_Account_ID')

        ->join('maintenance_barangay as brgy','brgy.Barangay_ID','=','a.Barangay_ID')
        ->join('maintenance_city_municipality as city','city.City_Municipality_ID','=','a.City_Municipality_ID')
        ->join('maintenance_province as prov','prov.Province_ID','=','a.Province_ID')
        ->join('maintenance_region as reg','reg.Region_ID','=','a.Region_ID')
        
        ->join('bfas_disbursement_voucher as dv','dv.Disbursement_Voucher_ID','=','a.Disbursement_Voucher_ID')
        ->join('bips_brgy_officials_and_staff as brgy_OS','brgy_OS.Brgy_Officials_and_Staff_ID','=','a.Brgy_Officials_and_Staff_ID')
        ->join('maintenance_bfas_voucher_status as vs','vs.Voucher_Status_ID','=','a.Voucher_Status_ID')

        ->select(
            'a.Check_Preparation_ID',
            'b.Bank_Account_ID',
            'b.Bank_Account_Name',
            'b.Bank_Account_No',
            'a.Particulars',
            'a.Amount',
            
            'brgy.Barangay_ID',
            'city.City_Municipality_ID',
            'city.City_Municipality_Name',
            'prov.Province_ID',
            'prov.Province_Name',
            'reg.Region_ID',
            'reg.Region_Name',
            'dv.Disbursement_Voucher_ID',
            'brgy_OS.Brgy_Officials_and_Staff_ID',
            'vs.Voucher_Status_ID',

            'a.Encoder_ID',
            'a.Date_Stamp'

        )
        ->get();
        
        $regionX=DB::table('maintenance_region')->get();
        $bank_acc=DB::table('maintenance_bfas_bank_account')->get();
        $disbursement_voucher=DB::table('bfas_disbursement_voucher')->get();
        $voucher_status=DB::table('maintenance_bfas_voucher_status')->get();
        $brgy_OS=DB::table('bips_brgy_officials_and_staff')->get();

        return view('bfas.check_preparation',compact('db_entries','currDATE','regionX','bank_acc','disbursement_voucher','voucher_status','brgy_OS'));
    }

    public function create_bfas_check_preparation(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        // dd($data);

        DB::table('bfas_check_preparation')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),

                'Particulars'                   => $data['Particulars'],
                'Brgy_Officials_and_Staff_ID'   => $data['Brgy_Officials_and_Staff_ID'],
                'Disbursement_Voucher_ID'       => $data['Disbursement_Voucher_ID'],
                'Voucher_Status_ID'             => $data['Voucher_Status_ID'],
                'Amount'                        => $data['Amount'],
                'Bank_Account_ID'               => $data['Bank_Account_ID'],


                'Region_ID'            => $data['Region_IDX'],
                'Province_ID'          => $data['Province_IDX'],
                'City_Municipality_ID' => $data['City_Municipality_IDX'],
                'Barangay_ID'          => $data['Barangay_IDX'],
                

                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_check_preparation(Request $request)
    {
        $id=$_GET['id'];
        // $id=1;

        $theEntry=DB::table('bfas_check_preparation as a')
            ->join('maintenance_bfas_bank_account as b','b.Bank_Account_ID','=','a.Bank_Account_ID')

            ->join('maintenance_barangay as brgy','brgy.Barangay_ID','=','a.Barangay_ID')
            ->join('maintenance_city_municipality as city','city.City_Municipality_ID','=','a.City_Municipality_ID')
            ->join('maintenance_province as prov','prov.Province_ID','=','a.Province_ID')
            ->join('maintenance_region as reg','reg.Region_ID','=','a.Region_ID')
            
            ->join('bfas_disbursement_voucher as dv','dv.Disbursement_Voucher_ID','=','a.Disbursement_Voucher_ID')
            ->join('bips_brgy_officials_and_staff as brgy_OS','brgy_OS.Brgy_Officials_and_Staff_ID','=','a.Brgy_Officials_and_Staff_ID')
            ->join('maintenance_bfas_voucher_status as vs','vs.Voucher_Status_ID','=','a.Voucher_Status_ID')

            ->select(
                'a.Check_Preparation_ID',
                'b.Bank_Account_ID',
                'b.Bank_Account_Name',
                'b.Bank_Account_No',
                'a.Particulars',
                'a.Amount',

                'brgy.Barangay_ID',
                'city.City_Municipality_ID',
                'city.City_Municipality_Name',
                'prov.Province_ID',
                'prov.Province_Name',
                'reg.Region_ID',
                'reg.Region_Name',
                'dv.Disbursement_Voucher_ID',
                'brgy_OS.Brgy_Officials_and_Staff_ID',
                'vs.Voucher_Status_ID',

                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            ->where('a.Check_Preparation_ID',$id)
            ->get();
        //dd($theEntry);
        return(compact('theEntry'));
    }
    public function update_bfas_check_preparation(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_check_preparation')->where('Check_Preparation_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),

                'Particulars'                   => $data['Particulars2'],
                'Brgy_Officials_and_Staff_ID'   => $data['Brgy_Officials_and_Staff_ID2'],
                'Disbursement_Voucher_ID'       => $data['Disbursement_Voucher_ID2'],
                'Voucher_Status_ID'             => $data['Voucher_Status_ID2'],
                'Amount'                        => $data['Amount2'],
                'Bank_Account_ID'               => $data['Bank_Account_ID2'],


                'Region_ID'            => $data['Region_IDX2'],
                'Province_ID'          => $data['Province_IDX2'],
                'City_Municipality_ID' => $data['City_Municipality_IDX2'],
                'Barangay_ID'          => $data['Barangay_IDX2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    
    //Check Status Cleared
    public function bfas_check_status(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bfas_check_status_cleared as a')
            ->join('bfas_check_preparation as b','b.Check_Preparation_ID','=','a.Check_Preparation_ID')
            ->select(
                'a.Check_Status_Cleared_ID',
                'a.Check_Preparation_ID',
                'a.Cleared_Date',
                'a.Remarks',
                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            ->get();
        
        $check_prep=DB::table('bfas_check_preparation')->get();

        return view('bfas.check_status',compact('db_entries','currDATE','check_prep',));
    }

    public function create_bfas_check_status(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_check_status_cleared')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),

                'Check_Preparation_ID'  => $data['Check_Preparation_ID'],
                'Cleared_Date'  => $data['Cleared_Date'],
                'Remarks'  => $data['Remarks'],

                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    
    public function get_bfas_check_status(Request $request)
    {
        $id=$_GET['id'];
        // $id=1;

        $theEntry=DB::table('bfas_check_status_cleared as a')
        ->join('bfas_check_preparation as b','b.Check_Preparation_ID','=','a.Check_Preparation_ID')
        ->select(
            'a.Check_Preparation_ID',
            'a.Check_Status_Cleared_ID',
            'a.Cleared_Date',
            'a.Remarks',
            'a.Encoder_ID',
            'a.Date_Stamp'

            )
            ->where('a.Check_Status_Cleared_ID',$id)
            ->get();
        //dd($theEntry);
        return(compact('theEntry'));
    }
    public function update_bfas_check_status(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();


        DB::table('bfas_check_status_cleared')->where('Check_Status_Cleared_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),

                'Check_Preparation_ID'  => $data['Check_Preparation_ID2'],
                'Cleared_Date'  => $data['Cleared_Date2'],
                'Remarks'  => $data['Remarks2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Check Status Released
    public function bfas_check_status_released(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bfas_check_status_released as a')
            ->leftjoin('bfas_check_preparation as b','b.Check_Preparation_ID','=','a.Check_Preparation_ID')

            ->select(
                'a.Check_Preparation_ID',
                'a.Check_Status_Released_ID',
                'a.Encoder_ID',
                'a.Date_Stamp',
                'a.ID_Presented',
                'a.ID_Number',
                'a.Received_by',
                'a.Released_Date'


            )
            ->get();
        
        $check_prep=DB::table('bfas_check_preparation')->get();

        return view('bfas.check_status_released',compact('db_entries','currDATE', 'check_prep'));
    }

    public function create_bfas_check_status_released(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_check_status_released')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),

                'Check_Preparation_ID'   => $data['Check_Preparation_ID'],
                'Released_Date'  => $data['Released_Date'],
                'Received_by'  => $data['Received_by'],
                'ID_Presented'     => $data['ID_Presented'],

                'ID_Number'      => $data['ID_Number'],
                
            )
        );
        
        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_check_status_released(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('bfas_check_status_released as a')
            ->join('bfas_check_preparation as b','b.Check_Preparation_ID','=','a.Check_Preparation_ID')

            ->select(
                'a.Check_Status_Released_ID',
                'a.Check_Preparation_ID',
                'a.ID_Presented',
                'a.ID_Number',
                'a.Received_by',
                'a.Released_Date',
                'a.Encoder_ID',
                'a.Date_Stamp'
            )
            ->where('a.Check_Status_Released_ID',$id)
            ->get();
        //dd($theEntry);
        return(compact('theEntry'));
    }
    public function update_bfas_check_status_released(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();
        DB::table('bfas_check_status_released')->where('Check_Status_Released_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),

                'Check_Preparation_ID'   => $data['Check_Preparation_ID2'],

                'Released_Date'  => $data['Released_Date2'],
                'Received_by'  => $data['Received_by2'],
                'ID_Presented'     => $data['ID_Presented2'],

                'ID_Number'      => $data['ID_Number2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }
    //Payment Collection
    public function bfas_payment_collection(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bfas_payment_collection as a')
            ->leftjoin('bfas_accounts_information as b','b.Accounts_Information_ID','=','a.Accounts_Information_ID')
            ->leftjoin('maintenance_bfas_type_of_fee as c','c.Type_of_Fee_ID','=','a.Type_of_Fee_ID')
            ->select(
                'a.Payment_Collection_ID',
                'a.Payment_Collection_Number',
                'b.Accounts_Information_ID',
                'b.Account_Name',
                'c.Type_of_Fee_ID',
                'c.Type_of_Fee',
                'a.OR_Date',
                'a.OR_No',
                'a.Cash_Tendered',
                'a.Remarks',
                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            ->get();
        
        $account_info=DB::table('bfas_accounts_information')->get();
        $type_fee=DB::table('maintenance_bfas_type_of_fee')->get();

        return view('bfas.payment_collection',compact('db_entries','currDATE', 'account_info', 'type_fee'));
    }
    public function create_bfas_payment_collection(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_payment_collection')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),

                'Payment_Collection_Number'   => $data['Payment_Collection_Number'],
                'Accounts_Information_ID'  => $data['Accounts_Information_ID'],
                'Type_of_Fee_ID'  => $data['Type_of_Fee_ID'],
                'OR_Date'     => $data['OR_Date'],
                'OR_No'      => $data['OR_No'],
                'Cash_Tendered'      => $data['Cash_Tendered'],
                'Remarks'      => $data['Remarks'],
                
            )
        );
        
        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_payment_collection(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('bfas_payment_collection as a')
        ->leftjoin('bfas_accounts_information as b','b.Accounts_Information_ID','=','a.Accounts_Information_ID')
        ->leftjoin('maintenance_bfas_type_of_fee as c','c.Type_of_Fee_ID','=','a.Type_of_Fee_ID')
        ->select(
            'a.Payment_Collection_ID',
            'a.Payment_Collection_Number',
            'b.Accounts_Information_ID',
            'b.Account_Name',
            'c.Type_of_Fee_ID',
            'c.Type_of_Fee',
            'a.OR_Date',
            'a.OR_No',
            'a.Cash_Tendered',
            'a.Remarks',
            'a.Encoder_ID',
            'a.Date_Stamp'

        )
            ->where('a.Payment_Collection_ID',$id)
            ->get();
        //dd($theEntry);
        return(compact('theEntry'));
    }
    public function update_bfas_payment_collection(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();
        DB::table('bfas_payment_collection')->where('Payment_Collection_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),

                'Payment_Collection_Number'   => $data['Payment_Collection_Number2'],
                'Accounts_Information_ID'  => $data['Accounts_Information_ID2'],
                'Type_of_Fee_ID'  => $data['Type_of_Fee_ID2'],
                'OR_Date'     => $data['OR_Date2'],
                'OR_No'      => $data['OR_No2'],
                'Cash_Tendered'      => $data['Cash_Tendered2'],
                'Remarks'      => $data['Remarks2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Budget Appropriation
    public function bfas_budget_appropriation(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bfas_budget_appropriation as a')
            ->join('maintenance_bfas_budget_appropriation_status as b','b.Budget_Appropriation_Status_ID','=','a.Budget_Appropriation_Status_ID')
            ->join('maintenance_bfas_fund_type as c','c.Fund_Type_ID','=','a.Fund_Type_ID')
            ->join('maintenance_bfas_appropriation_type as d','d.Appropriation_Type_ID','=','a.Appropriation_Type_ID')
            ->leftjoin('bfas_budget_appropriation_accounts as e','e.Budget_Appropriation_ID','=','a.Budget_Appropriation_ID')
            ->leftjoin('bfas_accounts_information as f','f.Accounts_Information_ID','=','e.Accounts_Information_ID')

            ->join('maintenance_barangay as brgy','brgy.Barangay_ID','=','a.Barangay_ID')
            ->join('maintenance_city_municipality as city','city.City_Municipality_ID','=','a.City_Municipality_ID')
            ->join('maintenance_province as prov','prov.Province_ID','=','a.Province_ID')
            ->join('maintenance_region as reg','reg.Region_ID','=','a.Region_ID')

            ->select(
                'a.Budget_Appropriation_ID',
                'a.Appropriation_No',
                'a.Appropriation_Date',
                'a.Budget_Year',
                // 'a.Amount',
                'b.Budget_Appropriation_Status_ID',
                'b.Budget_Appropriation_Status',
                'c.Fund_Type_ID',
                'c.Fund_Type',
                'd.Appropriation_Type_ID',
                'd.Appropriation_Type',
                'a.Particulars',
    

                'brgy.Barangay_ID',
                'brgy.Barangay_Name',
                'city.City_Municipality_ID',
                'city.City_Municipality_Name',
                'prov.Province_ID',
                'prov.Province_Name',
                'reg.Region_ID',
                'reg.Region_Name',

                'e.Accounts_Information_ID',
                'e.Appropriation_Amount',

                'f.Account_Name',
                'f.Account_Number',

                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            ->get();
        
        $regionX=DB::table('maintenance_region')->get();

        $app_type=DB::table('maintenance_bfas_appropriation_type')->get();
        $fund_type=DB::table('maintenance_bfas_fund_type')->get();
        $bp_status=DB::table('maintenance_bfas_budget_appropriation_status')->get();
        $accounts=DB::table('bfas_accounts_information')->get();
        

        return view('bfas.budget_appropriation',compact('db_entries','currDATE','regionX','app_type','fund_type','bp_status','accounts'));
    }

    public function create_bfas_budget_appropriation(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_budget_appropriation')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),

                'Appropriation_No'                => $data['Appropriation_No'],
                'Budget_Appropriation_Status_ID'  => $data['Budget_Appropriation_Status_ID'],

                'Budget_Year'            => $data['Budget_Year'],

                'Fund_Type_ID'           => $data['Fund_Type_ID'],
                'Appropriation_Date'     => $data['Appropriation_Date'],
                'Appropriation_Type_ID'  => $data['Appropriation_Type_ID'],

                'Particulars'      => $data['Particulars'],

                'Region_ID'            => $data['Region_IDX'],
                'Province_ID'          => $data['Province_IDX'],
                'City_Municipality_ID' => $data['City_Municipality_IDX'],
                'Barangay_ID'          => $data['Barangay_IDX'],
                
                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_budget_appropriation(Request $request)
    {
        $id=$_GET['id'];
        //$id=1;

        $theEntry = DB::table('bfas_budget_appropriation as a')
            ->join('maintenance_bfas_budget_appropriation_status as b','b.Budget_Appropriation_Status_ID','=','a.Budget_Appropriation_Status_ID')
            ->join('maintenance_bfas_fund_type as c','c.Fund_Type_ID','=','a.Fund_Type_ID')
            ->join('maintenance_bfas_appropriation_type as d','d.Appropriation_Type_ID','=','a.Appropriation_Type_ID')

            ->join('maintenance_barangay as brgy','brgy.Barangay_ID','=','a.Barangay_ID')
            ->join('maintenance_city_municipality as city','city.City_Municipality_ID','=','a.City_Municipality_ID')
            ->join('maintenance_province as prov','prov.Province_ID','=','a.Province_ID')
            ->join('maintenance_region as reg','reg.Region_ID','=','a.Region_ID')

            ->select(
                'a.Budget_Appropriation_ID',
                'a.Appropriation_No',
                'a.Appropriation_Date',
                'a.Budget_Year',
                // 'a.Amount',
                'b.Budget_Appropriation_Status_ID',
                'b.Budget_Appropriation_Status',
                'c.Fund_Type_ID',
                'c.Fund_Type',
                'd.Appropriation_Type_ID',
                'd.Appropriation_Type',
                'a.Particulars',
    

                'brgy.Barangay_ID',
                'brgy.Barangay_Name',
                'city.City_Municipality_ID',
                'city.City_Municipality_Name',
                'prov.Province_ID',
                'prov.Province_Name',
                'reg.Region_ID',
                'reg.Region_Name',

                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            ->where('a.Budget_Appropriation_ID',$id)
            ->get();

        //dd($theEntry);
        return(compact('theEntry'));
    }
    public function update_bfas_budget_appropriation(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_budget_appropriation')->where('Budget_Appropriation_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                
                'Appropriation_No'                => $data['Appropriation_No2'],
                'Budget_Appropriation_Status_ID'  => $data['Budget_Appropriation_Status_ID2'],

                'Budget_Year'            => $data['Budget_Year2'],

                'Fund_Type_ID'           => $data['Fund_Type_ID2'],
                'Appropriation_Date'     => $data['Appropriation_Date2'],
                'Appropriation_Type_ID'  => $data['Appropriation_Type_ID2'],

                'Particulars'      => $data['Particulars2'],

                'Region_ID'            => $data['Region_IDX2'],
                'Province_ID'          => $data['Province_IDX2'],
                'City_Municipality_ID' => $data['City_Municipality_IDX2'],
                'Barangay_ID'          => $data['Barangay_IDX2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Obligation Request
    public function bfas_obligation_request(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bfas_obligation_request as a')
            ->join('maintenance_bfas_fund_type as c','c.Fund_Type_ID','=','a.Fund_Type_ID')
            ->join('bfas_card_file as d','d.Card_File_ID','=','a.Card_File_ID')
            ->join('maintenance_bfas_obligation_request_status as e','e.Obligation_Request_Status_ID','=','a.Obligation_Request_Status_ID')
            ->join('bfas_budget_appropriation as f','f.Budget_Appropriation_ID','=','a.Budget_Appropriation_ID')
            ->join('bfas_card_file as g','g.Card_File_ID','=','a.Brgy_Officials_and_Staff_ID')
            ->leftjoin('bfas_obr_accounts as h','h.Obligation_Request_ID','=','a.Obligation_Request_ID')
            ->leftjoin('bfas_accounts_information as i','i.Accounts_Information_ID','=','h.Accounts_Information_ID')

            ->join('maintenance_barangay as brgy','brgy.Barangay_ID','=','a.Barangay_ID')
            ->join('maintenance_city_municipality as city','city.City_Municipality_ID','=','a.City_Municipality_ID')
            ->join('maintenance_province as prov','prov.Province_ID','=','a.Province_ID')
            ->join('maintenance_region as reg','reg.Region_ID','=','a.Region_ID')

            ->select(
                'a.Obligation_Request_ID',
                'a.Obligation_Request_No',
                'a.Purchase_Order_No',
                'c.Fund_Type_ID',
                'c.Fund_Type',
                'd.Card_File_ID',
                'd.Last_Name','d.First_Name','d.Middle_Name',
                'e.Obligation_Request_Status_ID',
                'e.Obligation_Request_Status',
                'a.Obligation_Request_Date',
                'a.Remarks',
                'f.Budget_Appropriation_ID',
                'f.Appropriation_No',
                'g.Card_File_ID',
                'g.Last_Name as Last_Name2','g.First_Name as First_Name2','g.Middle_Name as Middle_Name2',
                'h.Accounts_Information_ID',
                'h.Amount',
                'h.Adjustment_Amount',
                'i.Account_Number',
                'i.Account_Name',

                'brgy.Barangay_ID',
                'brgy.Barangay_Name',
                'city.City_Municipality_ID',
                'city.City_Municipality_Name',
                'prov.Province_ID',
                'prov.Province_Name',
                'reg.Region_ID',
                'reg.Region_Name',

                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            ->get();
        
        $regionX=DB::table('maintenance_region')->get();

        $fund_type=DB::table('maintenance_bfas_fund_type')->get();
        $card_file=DB::table('bfas_card_file')->get();

        $obr_status=DB::table('maintenance_bfas_obligation_request_status')->get();
        $b_app=DB::table('bfas_budget_appropriation')->get();
        $tax_type=DB::table('maintenance_bfas_tax_type')->get();
        $accounts=DB::table('bfas_accounts_information')->get();

        return view('bfas.obligation_request',compact('db_entries','currDATE','regionX','fund_type','card_file','obr_status','b_app','tax_type','accounts'));
    }

    public function create_bfas_obligation_request(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_obligation_request')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),

                'Obligation_Request_No'         => $data['Obligation_Request_No'],
                'Purchase_Order_No'             => $data['Purchase_Order_No'],
                'Obligation_Request_Date'       => $data['Obligation_Request_Date'],
                'Obligation_Request_Status_ID'  => $data['Obligation_Request_Status_ID'],

                'Fund_Type_ID'                  => $data['Fund_Type_ID'],
                'Budget_Appropriation_ID'       => $data['Budget_Appropriation_ID'],
                'Card_File_ID'           => $data['Card_File_ID'],
                'Brgy_Officials_and_Staff_ID'     => $data['Brgy_Officials_and_Staff_ID'],

                'Remarks'          => $data['Remarks'],

                'Region_ID'            => $data['Region_IDX'],
                'Province_ID'          => $data['Province_IDX'],
                'City_Municipality_ID' => $data['City_Municipality_IDX'],
                'Barangay_ID'          => $data['Barangay_IDX'],
                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_obligation_request(Request $request)
    {
        $id=$_GET['id'];
        //$id=1;

        $theEntry = DB::table('bfas_obligation_request as a')
            ->join('maintenance_bfas_fund_type as c','c.Fund_Type_ID','=','a.Fund_Type_ID')
            ->join('bfas_card_file as d','d.Card_File_ID','=','a.Card_File_ID')
            ->join('maintenance_bfas_obligation_request_status as e','e.Obligation_Request_Status_ID','=','a.Obligation_Request_Status_ID')
            ->join('bfas_budget_appropriation as f','f.Budget_Appropriation_ID','=','a.Budget_Appropriation_ID')
            ->join('bfas_card_file as g','g.Card_File_ID','=','a.Brgy_Officials_and_Staff_ID')

            ->join('maintenance_barangay as brgy','brgy.Barangay_ID','=','a.Barangay_ID')
            ->join('maintenance_city_municipality as city','city.City_Municipality_ID','=','a.City_Municipality_ID')
            ->join('maintenance_province as prov','prov.Province_ID','=','a.Province_ID')
            ->join('maintenance_region as reg','reg.Region_ID','=','a.Region_ID')

            ->select(
                'a.Obligation_Request_ID',
                'a.Obligation_Request_No',
                'a.Purchase_Order_No',
                'c.Fund_Type_ID',
                'c.Fund_Type',
                'd.Card_File_ID',
                'd.Last_Name','d.First_Name','d.Middle_Name',
                'e.Obligation_Request_Status_ID',
                'e.Obligation_Request_Status',
                'a.Obligation_Request_Date',
                'a.Remarks',
                'f.Budget_Appropriation_ID',
                'f.Appropriation_No',
                'g.Card_File_ID',
                'g.Last_Name as Last_Name2','g.First_Name as First_Name2','g.Middle_Name as Middle_Name2',

                'brgy.Barangay_ID',
                'brgy.Barangay_Name',
                'city.City_Municipality_ID',
                'city.City_Municipality_Name',
                'prov.Province_ID',
                'prov.Province_Name',
                'reg.Region_ID',
                'reg.Region_Name',

                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            ->where('a.Obligation_Request_ID',$id)
            ->get();

        //dd($theEntry);
        return(compact('theEntry'));
    }
    public function update_bfas_obligation_request(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

 

        DB::table('bfas_obligation_request')->where('Obligation_Request_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),

                'Obligation_Request_No'         => $data['Obligation_Request_No2'],
                'Purchase_Order_No'             => $data['Purchase_Order_No2'],
                'Obligation_Request_Date'       => $data['Obligation_Request_Date2'],
                'Obligation_Request_Status_ID'  => $data['Obligation_Request_Status_ID2'],

                'Fund_Type_ID'                  => $data['Fund_Type_ID2'],
                'Budget_Appropriation_ID'       => $data['Budget_Appropriation_ID2'],
                'Card_File_ID'           => $data['Card_File_ID2'],
                'Brgy_Officials_and_Staff_ID'     => $data['Brgy_Officials_and_Staff_ID2'],

                'Remarks'          => $data['Remarks2'],

                'Region_ID'            => $data['Region_IDX2'],
                'Province_ID'          => $data['Province_IDX2'],
                'City_Municipality_ID' => $data['City_Municipality_IDX2'],
                'Barangay_ID'          => $data['Barangay_IDX2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //SAAODBA
    public function bfas_SAAODBA(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bfas_SAAODBA as a')
            ->join('bfas_obligation_request as b','b.Obligation_Request_ID','=','a.Obligation_Request_ID')
            ->join('maintenance_bfas_fund_type as c','c.Fund_Type_ID','=','a.Fund_Type_ID')
            ->join('bfas_card_file as d','d.Card_File_ID','=','a.Brgy_Officials_and_Staff_ID')
            ->join('bfas_accounts_information as e','e.Accounts_Information_ID','=','a.Accounts_Information_ID')

            ->select(
                'a.SAAODBA_ID',
                'b.Obligation_Request_ID',
                'b.Obligation_Request_No',
                'c.Fund_Type_ID',
                'c.Fund_Type',
                'a.SAAODBA_As_of',
                'd.Card_File_ID',
                'd.Last_Name as Last_Name2','d.First_Name as First_Name2','d.Middle_Name as Middle_Name2',
                'e.Accounts_Information_ID',
                'e.Account_Name'


            )
            ->get();
        
        $obr=DB::table('bfas_obligation_request')->get();
        $fundX=DB::table('maintenance_bfas_fund_type')->get();
        $oic=DB::table('bfas_card_file')->get();
        $accounts=DB::table('bfas_accounts_information')->get();

        return view('bfas.SAAODBA',compact('db_entries','currDATE', 'obr', 'fundX', 'oic', 'accounts'));
    }

    public function create_bfas_SAAODBA(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bfas_SAAODBA')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),

                'Obligation_Request_ID'   => $data['Obligation_Request_ID'],
                'Fund_Type_ID'            => $data['Fund_Type_ID'],
                'SAAODBA_As_of'           => $data['SAAODBA_As_of'],
                'Brgy_Officials_and_Staff_ID' => $data['Brgy_Officials_and_Staff_ID'],
                'Accounts_Information_ID'     => $data['Accounts_Information_ID'],
                
            )
        );
        
        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_SAAODBA(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('bfas_SAAODBA as a')
            ->join('bfas_obligation_request as b','b.Obligation_Request_ID','=','a.Obligation_Request_ID')
            ->join('maintenance_bfas_fund_type as c','c.Fund_Type_ID','=','a.Fund_Type_ID')
            ->join('bfas_card_file as d','d.Card_File_ID','=','a.Brgy_Officials_and_Staff_ID')
            ->join('bfas_accounts_information as e','e.Accounts_Information_ID','=','a.Accounts_Information_ID')

            ->select(
                'a.SAAODBA_ID',
                'b.Obligation_Request_ID',
                'b.Obligation_Request_No',
                'c.Fund_Type_ID',
                'c.Fund_Type',
                'a.SAAODBA_As_of',
                'd.Card_File_ID',
                'd.Last_Name as Last_Name2','d.First_Name as First_Name2','d.Middle_Name as Middle_Name2',
                'e.Accounts_Information_ID',
                'e.Account_Name'

            )
            ->where('a.SAAODBA_ID',$id)
            ->get();
        //dd($theEntry);
        return(compact('theEntry'));
    }
    public function update_bfas_SAAODBA(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();
        DB::table('bfas_SAAODBA')->where('SAAODBA_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),

                'Obligation_Request_ID'   => $data['Obligation_Request_ID2'],
                'Fund_Type_ID'            => $data['Fund_Type_ID2'],
                'SAAODBA_As_of'           => $data['SAAODBA_As_of2'],
                'Brgy_Officials_and_Staff_ID' => $data['Brgy_Officials_and_Staff_ID2'],
                'Accounts_Information_ID'     => $data['Accounts_Information_ID2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    public function tag_bfas_budget_appropriation(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();
        $itemLen= count($data['tagAccounts_Information_ID']);

        for ($i = 0; $i < $itemLen; $i++) {
            DB::table('bfas_budget_appropriation_accounts')->insert(
                array(
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now(),
    
                    'Accounts_Information_ID'   => $data['tagAccounts_Information_ID'][$i],
                    'Budget_Appropriation_ID'   => $data['B_IDx'],
                    'Appropriation_Amount'      => $data['Appropriation_Amount'][$i],
                )
            );
        }
       

        return redirect()->back()->with('alert', 'Entry Tagged');
    }

    public function tag_bfas_obligation_request(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();
        $itemLen= count($data['tagAccounts_Information_ID']);

        for ($i = 0; $i < $itemLen; $i++) {
            DB::table('bfas_obr_accounts')->insert(
                array(
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now(),
    
                    'Tax_Type_ID'               => $data['Tax_Type_ID'][$i],
                    'Accounts_Information_ID'   => $data['tagAccounts_Information_ID'][$i],
                    'Obligation_Request_ID'     => $data['B_IDx'],
                    'Adjustment_Amount'         => $data['Adjustment_Amount'][$i],
                    'Amount' => $data['Amount'][$i],
                )
            );
        }
       

        return redirect()->back()->with('alert', 'Entry Tagged');
    }

    public function tag_bfas_disbursement_voucher(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();
        $itemLen= count($data['tagObligation_Requests_ID']);

        for ($i = 0; $i < $itemLen; $i++) {
            DB::table('bfas_dv_obligation_request')->insert(
                array(
                    'Encoder_ID'       => Auth::user()->id,
                    'Date_Stamp'       => Carbon::now(),

                    'Obligation_Request_ID'   => $data['tagObligation_Requests_ID'][$i],
                    'Disbursement_Voucher_ID'     => $data['B_IDx'],
                )
            );
        }
       

        return redirect()->back()->with('alert', 'Entry Tagged');
    }

    public function get_acc_parents(Request $request)
    {
        $id=$_GET['id'];
       // $id=4;
        $theEntry = DB::table('bfas_accounts_information')
                        ->where('Account_Level',$id-1)
                        ->get();
        
        return(compact('theEntry'));
    }

}