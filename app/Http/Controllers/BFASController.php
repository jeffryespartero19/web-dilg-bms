<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;


class BFASController extends Controller
{
//BFAS Maintenance
    //Type of Fee
    public function bfas_type_of_fee_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bfas_type_of_fee')
            ->join('maintenance_barangay','maintenance_barangay.Barangay_ID','=','maintenance_bfas_type_of_fee.Barangay_ID')
            ->join('maintenance_city_municipality','maintenance_city_municipality.City_Municipality_ID','=','maintenance_bfas_type_of_fee.City_Municipality_ID')
            ->join('maintenance_province','maintenance_province.Province_ID','=','maintenance_bfas_type_of_fee.Province_ID')
            ->join('maintenance_region','maintenance_region.Region_ID','=','maintenance_bfas_type_of_fee.Region_ID')
            ->paginate(20,['*'], 'db_entries');
        
        $Account_InfoX=DB::table('bfas_accounts_information')->get();

        return view('maintenance.bfas_type_of_fee',compact('db_entries','currDATE','Account_InfoX'));
    }

    public function create_bfas_type_of_fee_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        $bgry_ID=Auth::user()->Barangay_ID;

        $theBrgy=DB::table('maintenance_barangay')->where('Barangay_ID',$bgry_ID)->get();
        $theCity=DB::table('maintenance_city_municipality')->where('City_Municipality_ID',$theBrgy[0]->City_Municipality_ID)->get();
        $theProv=DB::table('maintenance_province')->where('Province_ID',$theCity[0]->Province_ID)->get();
        $theRegion=DB::table('maintenance_region')->where('Region_ID',$theProv[0]->Region_ID)->get();

        DB::table('maintenance_bfas_type_of_fee')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX'],

                'Account_Information_ID' => (int)$data['Account_Information_IDX'],
                'Type_of_Fee'            => $data['type_of_fee_X'],
                'Amount'                 => (float)$data['Amount_X'],

                'Barangay_ID'            => $theBrgy[0]->Barangay_ID,
                'City_Municipality_ID'   => $theCity[0]->City_Municipality_ID,
                'Province_ID'            => $theProv[0]->Province_ID,
                'Region_ID'              => $theRegion[0]->Region_ID,
                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_type_of_fee_maint(Request $request)
    {
       $id=$_GET['id'];
       //$id=1;

        $theEntry=DB::table('maintenance_bfas_type_of_fee')->where('Type_of_Fee_ID',$id)->get();

        $Account_InfoX=DB::table('bfas_accounts_information')->where('Accounts_Information_ID',$theEntry[0]->Account_Information_ID)->get();

        return(compact('theEntry','Account_InfoX'));
    }
    public function update_bfas_type_of_fee_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        $bgry_ID=Auth::user()->Barangay_ID;

        $theBrgy=DB::table('maintenance_barangay')->where('Barangay_ID',$bgry_ID)->get();
        $theCity=DB::table('maintenance_city_municipality')->where('City_Municipality_ID',$theBrgy[0]->City_Municipality_ID)->get();
        $theProv=DB::table('maintenance_province')->where('Province_ID',$theCity[0]->Province_ID)->get();
        $theRegion=DB::table('maintenance_region')->where('Region_ID',$theProv[0]->Region_ID)->get();

        DB::table('maintenance_bfas_type_of_fee')->where('Type_of_Fee_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX2'],

                'Account_Information_ID' => (int)$data['Account_Information_IDX2'],
                'Type_of_Fee'            => $data['type_of_fee_X2'],
                'Amount'                 => (float)$data['Amount_X2'],

                'Barangay_ID'            => $theBrgy[0]->Barangay_ID,
                'City_Municipality_ID'   => $theCity[0]->City_Municipality_ID,
                'Province_ID'            => $theProv[0]->Province_ID,
                'Region_ID'              => $theRegion[0]->Region_ID,
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Card Type
    public function bfas_card_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bfas_card_type')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bfas_card_type',compact('db_entries','currDATE'));
    }

    public function create_bfas_card_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('maintenance_bfas_card_type')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX'],

                'Card_Type' => $data['Card_Type'],

                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_card_type_maint(Request $request)
    {
       $id=$_GET['id'];
       //$id=1;

        $theEntry=DB::table('maintenance_bfas_card_type')->where('Card_Type_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_bfas_card_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('maintenance_bfas_card_type')->where('Card_Type_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX2'],

                'Card_Type' => $data['Card_Type2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Account Type
    public function bfas_account_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bfas_account_type')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bfas_account_type',compact('db_entries','currDATE'));
    }

    public function create_bfas_account_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('maintenance_bfas_account_type')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX'],

                'Account_Type' => $data['Account_Type'],

                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_account_type_maint(Request $request)
    {
       $id=$_GET['id'];
       //$id=1;

        $theEntry=DB::table('maintenance_bfas_account_type')->where('Account_Type_ID',$id)->get();
        //dd($theEntry);
        return(compact('theEntry'));
    }
    public function update_bfas_account_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('maintenance_bfas_account_type')->where('Account_Type_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX2'],

                'Account_Type' => $data['Account_Type2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Fund Type
    public function bfas_fund_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bfas_fund_type')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bfas_fund_type',compact('db_entries','currDATE'));
    }

    public function create_bfas_fund_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('maintenance_bfas_fund_type')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX'],

                'Fund_Type' => $data['Fund_Type'],

                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_fund_type_maint(Request $request)
    {
       $id=$_GET['id'];
       //$id=1;

        $theEntry=DB::table('maintenance_bfas_fund_type')->where('Fund_Type_ID',$id)->get();
        //dd($theEntry);
        return(compact('theEntry'));
    }
    public function update_bfas_fund_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('maintenance_bfas_fund_type')->where('Fund_Type_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX2'],

                'Fund_Type' => $data['Fund_Type2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Bank Account
    public function bfas_bank_account_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bfas_bank_account')
            ->join('maintenance_barangay','maintenance_barangay.Barangay_ID','=','maintenance_bfas_bank_account.Barangay_ID')
            ->join('maintenance_city_municipality','maintenance_city_municipality.City_Municipality_ID','=','maintenance_bfas_bank_account.City_Municipality_ID')
            ->join('maintenance_province','maintenance_province.Province_ID','=','maintenance_bfas_bank_account.Province_ID')
            ->join('maintenance_region','maintenance_region.Region_ID','=','maintenance_bfas_bank_account.Region_ID')
            ->paginate(20,['*'], 'db_entries');
        
        $Account_InfoX=DB::table('bfas_accounts_information')->get();

        $regionX=DB::table('maintenance_region')->get();

        return view('maintenance.bfas_bank_account',compact('db_entries','currDATE','Account_InfoX','regionX'));
    }

    public function create_bfas_bank_account_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('maintenance_bfas_bank_account')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX'],

                'Accounts_Information_ID'     => 0,

                'Bank_Account_Code'      => $data['Bank_Account_Code'],
                'Bank_Account_No'        => $data['Bank_Account_No'],
                'Bank_Account_Name'      => $data['Bank_Account_Name'],

                'Check_Number_From'      => $data['Check_Number_From'],
                'Check_Number_To'        => $data['Check_Number_To'],

                'Barangay_ID'            => (int)$data['Barangay_IDX'],
                'City_Municipality_ID'   => (int)$data['City_Municipality_IDX'],
                'Province_ID'            => (int)$data['Province_IDX'],
                'Region_ID'              => (int)$data['Region_IDX'],
                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bfas_bank_account_maint(Request $request)
    {
       $id=$_GET['id'];
      //$id=1;

        $theEntry=DB::table('maintenance_bfas_bank_account')
            ->join('maintenance_barangay','maintenance_barangay.Barangay_ID','=','maintenance_bfas_bank_account.Barangay_ID')
            ->join('maintenance_city_municipality','maintenance_city_municipality.City_Municipality_ID','=','maintenance_bfas_bank_account.City_Municipality_ID')
            ->join('maintenance_province','maintenance_province.Province_ID','=','maintenance_bfas_bank_account.Province_ID')
            ->join('maintenance_region','maintenance_region.Region_ID','=','maintenance_bfas_bank_account.Region_ID')
            ->where('Bank_Account_ID',$id)
            ->get();

        $Account_InfoX=DB::table('bfas_accounts_information')->where('Accounts_Information_ID',$theEntry[0]->Accounts_Information_ID)->get();

        return(compact('theEntry','Account_InfoX'));
    }
    public function update_bfas_bank_account_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();


        DB::table('maintenance_bfas_bank_account')->where('Bank_Account_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Active'           => (int)$data['ActiveX2'],

                'Bank_Account_Code'      => $data['Bank_Account_Code2'],
                'Bank_Account_No'        => $data['Bank_Account_No2'],
                'Bank_Account_Name'      => $data['Bank_Account_Name2'],

                'Check_Number_From'      => $data['Check_Number_From2'],
                'Check_Number_To'        => $data['Check_Number_To2'],

                'Barangay_ID'            => (int)$data['Barangay_IDX2'],
                'City_Municipality_ID'   => (int)$data['City_Municipality_IDX2'],
                'Province_ID'            => (int)$data['Province_IDX2'],
                'Region_ID'              => (int)$data['Region_IDX2'],
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }


}