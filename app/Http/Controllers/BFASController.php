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


}