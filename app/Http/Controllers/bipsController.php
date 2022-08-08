<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;

class bipsController extends Controller
{
    //BIPS TRANSACTIONS

    //Inhabitants Information List
    public function inhabitants_information_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bips_brgy_inhabitants_information')->paginate(20, ['*'], 'db_entries');
        $religion = DB::table('maintenance_bips_religion')->where('Active', 1)->get();
        $blood_type = DB::table('maintenance_bips_blood_type')->where('Active', 1)->get();
        $civil_status = DB::table('maintenance_bips_civil_status')->where('Active', 1)->get();
        $name_prefix = DB::table('maintenance_bips_name_prefix')->where('Active', 1)->get();
        $suffix = DB::table('maintenance_bips_name_suffix')->where('Active', 1)->get();
        $region = DB::table('maintenance_region')->where('Active', 1)->get();
        $province = DB::table('maintenance_province')->where('Active', 1)->get();
        $city = DB::table('maintenance_city_municipality')->where('Active', 1)->get();
        $barangay = DB::table('maintenance_barangay')->where('Active', 1)->get();
        $country = DB::table('maintenance_country')->where('Active', 1)->get();

        return view('bips_transactions.inhabitants_information_list', compact(
            'db_entries',
            'currDATE',
            'religion',
            'blood_type',
            'civil_status',
            'name_prefix',
            'suffix',
            'region',
            'province',
            'city',
            'barangay',
            'country',
        ));
    }

    // Save Inhabitants Info
    public function create_inhabitants_information(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('bips_brgy_inhabitants_information')->insert(
            array(
                'Name_Prefix_ID' => $data['Name_Prefix_ID'],
                'Last_Name' => $data['Last_Name'],
                'First_Name' => $data['First_Name'],
                'Middle_Name' => $data['Middle_Name'],
                'Name_Suffix_ID' => $data['Name_Suffix_ID'],
                'Birthplace' => $data['Birthplace'],
                'Weight' => $data['Weight'],
                'Height' => $data['Height'],
                'Civil_Status_ID' => $data['Civil_Status_ID'],
                'Birthdate' => $data['Birthdate'],
                'Country_ID' => $data['Country_ID'],
                'Religion_ID' => $data['Religion_ID'],
                'Blood_Type_ID' => $data['Blood_Type_ID'],
                'Sex' => $data['Sex'],
                'Mobile_No' => $data['Mobile_No'],
                'Telephone_No' => $data['Telephone_No'],
                'Barangay_ID' => $data['Barangay_ID'],
                'City_Municipality_ID' => $data['City_Municipality_ID'],
                'Province_ID' => $data['Province_ID'],
                'Region_ID' => $data['Region_ID'],
                'Salary' => $data['Salary'],
                'Email_Address' => $data['Email_Address'],
                'PhilSys_Card_No' => $data['PhilSys_Card_No'],
                'Solo_Parent' => (int)$data['Solo_Parent'],
                'OFW' => (int)$data['OFW'],
                'Indigent' => (int)$data['Indigent'],
                '4Ps_Beneficiary' => (int)$data['4Ps_Beneficiary'],
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now()
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    // Display Inhabitants Details
    public function get_inhabitants_info(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bips_brgy_inhabitants_information')->where('Resident_ID', $id)->get();

        return (compact('theEntry'));
    }


    //Deceased Profile
    //Deceased Profile List
    public function deceased_profile_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bips_deceased_profile as a')
            ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
            ->leftjoin('maintenance_bips_deceased_type as c', 'a.Deceased_Type_ID', '=', 'c.Deceased_Type_ID')
            ->select(
                'a.Resident_ID',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
                'a.Deceased_Type_ID',
                'c.Deceased_Type',
                'a.Cause_of_Death',
                'a.Date_of_Death',
            )
            ->paginate(20, ['*'], 'db_entries');



        $name = DB::table('bips_brgy_inhabitants_information')->paginate(20, ['*'], 'name');
        $deceased_type = DB::table('maintenance_bips_deceased_type')->where('Active', 1)->get();

        return view('bips_transactions.deceased_profile_list', compact(
            'db_entries',
            'currDATE',
            'name',
            'deceased_type',
        ));
    }


    // Save Deceased Profile
    public function create_deceased_profile(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('bips_deceased_profile')->insert(
            array(
                'Resident_ID' => $data['Resident_ID'],
                'Deceased_Type_ID' => $data['Deceased_Type_ID'],
                'Cause_of_Death' => $data['Cause_of_Death'],
                'Date_of_Death' => $data['Date_of_Death'],
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now()
            )
        );
        return redirect()->back()->with('message', 'New Entry Created');
    }

    // Display Deceased Profile
    public function get_deceased_profile(Request $request)
    {
        $id = $_GET['id'];

       
        $theEntry = DB::table('bips_deceased_profile as a')
             ->select(
                'a.Resident_ID',
                'a.Deceased_Type_ID',
                'a.Cause_of_Death',
                'a.Date_of_Death',)
        ->where('Resident_ID', $id)->get();

        return (compact('theEntry'));
    }
    //updating Deceased Profile
    public function update_deceased_profile(Request $request)

    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('bips_deceased_profile')->where('Resident_ID',$data['Resident_ID2'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Deceased_Type_ID'  => $data['Deceased_Type_ID2'],
                'Cause_of_Death'  => $data['Cause_of_Death2'],
                'Date_of_Death'  => $data['Date_of_Death2'],
                
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

     //Inhabitants Transfer
    ///Inhabitants Transfer List
    public function inhabitants_transfer_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bips_inhabitants_transfer as a')
        ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
        ->leftjoin('maintenance_region as c', 'a.Region_ID', '=', 'c.Region_ID')
        ->leftjoin('maintenance_province as d', 'a.Province_ID', '=', 'd.Province_ID')
        ->leftjoin('maintenance_city_municipality as e', 'a.City_Municipality_ID', '=', 'e.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as f', 'a.Barangay_ID', '=', 'f.Barangay_ID')
        ->select(
                'a.Inhabitants_Transfer_ID',
                'a.Resident_ID',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
                'a.Region_ID',
                'c.Region_Name',
                'a.Province_ID',
                'd.Province_Name',
                'a.City_Municipality_ID',
                'e.City_Municipality_Name',
                'a.Barangay_ID',
                'f.Barangay_Name',
            )
            ->paginate(20, ['*'], 'db_entries');

        $name = DB::table('bips_brgy_inhabitants_information')->paginate(20, ['*'], 'name');
        $region = DB::table('maintenance_region')->paginate(20, ['*'], 'region');
        $province = DB::table('maintenance_province')->paginate(20, ['*'], 'province');
        $barangay = DB::table('maintenance_barangay')->paginate(20, ['*'], 'barangay');
        $city = DB::table('maintenance_city_municipality')->paginate(20, ['*'], 'city');
       
          

        return view('bips_transactions.inhabitants_transfer_list', compact(
            'db_entries',
            'currDATE',
            'name',
            'region',
            'province',
            'barangay',
            'city',
            
        ));
    }

   // Save Inhabitants Transfer
   public function create_inhabitants_transfer(Request $request)
   {
       $currDATE = Carbon::now();
       $data = $data = request()->all();

       DB::table('bips_inhabitants_transfer')->insert(
           array(
               'Resident_ID'           => $data['Resident_ID'],
               'Region_ID'             => $data['Region_ID'],
               'Province_ID'           => $data['Province_ID'],
               'City_Municipality_ID'  => $data['City_Municipality_ID'],
               'Barangay_ID'           => $data['Barangay_ID'],
               'Status_ID'             => 0,
               'Encoder_ID'            => Auth::user()->id,
               'Date_Stamp'            => Carbon::now()
           )
       );
       return redirect()->back()->with('message', 'New Entry Created');
   }


    // Display Inhabitants Transfer
    public function get_inhabitants_transfer(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('bips_inhabitants_transfer as a')
        ->leftjoin('bips_brgy_inhabitants_information as b', 'a.Resident_ID', '=', 'b.Resident_ID')
        ->leftjoin('maintenance_region as c', 'a.Region_ID', '=', 'c.Region_ID')
        ->leftjoin('maintenance_province as d', 'a.Province_ID', '=', 'd.Province_ID')
        ->leftjoin('maintenance_city_municipality as e', 'a.City_Municipality_ID', '=', 'e.City_Municipality_ID')
        ->leftjoin('maintenance_barangay as f', 'a.Barangay_ID', '=', 'f.Barangay_ID')
        ->select(
                'a.Inhabitants_Transfer_ID',
                'a.Resident_ID',
                'b.Last_Name',
                'b.First_Name',
                'b.Middle_Name',
                'a.Region_ID',
                'c.Region_Name',
                'a.Province_ID',
                'd.Province_Name',
                'a.City_Municipality_ID',
                'e.City_Municipality_Name',
                'a.Barangay_ID',
                'f.Barangay_Name',
            )
            ->where('Inhabitants_Transfer_ID', $id)->get();

        return (compact('theEntry'));
    }
   
    //updating Inhabitants Transfer
    public function update_inhabitants_transfer(Request $request)

    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('bips_inhabitants_transfer')->where('Inhabitants_Transfer_ID',$data['Inhabitants_Transfer_ID1'])->update(
            array(
                'Encoder_ID'           => Auth::user()->id,
                'Date_Stamp'           => Carbon::now(),
                'Resident_ID'          => $data['Resident_ID1'],
                'Region_ID'            => $data['Region_ID1'],
                'Province_ID'          => $data['Province_ID1'],
                'City_Municipality_ID' => $data['City_Municipality_ID1'],
                'Barangay_ID'          => $data['Barangay_ID1'],
                
                
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }
}
