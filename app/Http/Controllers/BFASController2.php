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
}