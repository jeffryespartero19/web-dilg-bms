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
            ->paginate(20,['*'], 'db_entries');

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
                'a.Active',
                'a.Encoder_ID',
                'a.Date_Stamp'

            )
            ->paginate(20,['*'], 'db_entries');
        
        $acc_type=DB::table('maintenance_bfas_account_type')->get();
        $acc_code=DB::table('maintenance_bfas_account_code')->get();

        return view('bfas.accounts_information',compact('db_entries','currDATE','acc_type','acc_code'));
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

                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_accounts_information(Request $request)
    {
        //$id=$_GET['id'];
        $id=1;

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
            ->paginate(20,['*'], 'db_entries');
        
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
        dd($data);
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
            ->paginate(20,['*'], 'db_entries');
        
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
            ->paginate(20,['*'], 'db_entries');
        
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
}