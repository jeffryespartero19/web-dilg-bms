<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\File;
use PDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //Deceased Profile
    //Deceased Profile List
    public function user_list(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('users as a')
            ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
            ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
            ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
            ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
            ->select(
                'a.id',
                'a.name',
                'a.email',
                'a.photo',
                'a.User_Type_ID',
                'a.Active',
                'b.Region_Name',
                'c.Province_Name',
                'd.City_Municipality_Name',
                'e.Barangay_Name',
            )
            ->paginate(20, ['*'], 'db_entries');

        $region = DB::table('maintenance_region')->get();
        $regions = DB::table('maintenance_region')->get();

        return view('users.user_list', compact(
            'db_entries',
            'currDATE',
            'region',
            'regions'
        ));
    }


    // Save Deceased Profile
    public function create_user(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|unique:users',
        ]);

        DB::table('users')->insert(
            array(
                'name' => $data['name'],
                'email' => $data['email'],
                'User_Type_ID' => $data['User_Type_ID'],
                'Region_ID' => $data['Region_ID'],
                'Province_ID' => $data['Province_ID'],
                'City_Municipality_ID' => $data['City_Municipality_ID'],
                'Barangay_ID'       => $data['Barangay_ID'],
                'Active'       => 1,
                'password' => Hash::make($data['email']),
            )
        );
        return redirect()->back()->with('message', 'New User Created');
    }

    // Display Deceased Profile
    public function get_user(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('users as a')
            ->leftjoin('maintenance_region as b', 'a.Region_ID', '=', 'b.Region_ID')
            ->leftjoin('maintenance_province as c', 'a.Province_ID', '=', 'c.Province_ID')
            ->leftjoin('maintenance_city_municipality as d', 'a.City_Municipality_ID', '=', 'd.City_Municipality_ID')
            ->leftjoin('maintenance_barangay as e', 'a.Barangay_ID', '=', 'e.Barangay_ID')
            ->select(
                'a.id',
                'a.name',
                'a.email',
                'a.photo',
                'a.User_Type_ID',
                'a.Active',
                'a.Region_ID',
                'a.Province_ID',
                'a.City_Municipality_ID',
                'a.Barangay_ID',
                'b.Region_Name',
                'c.Province_Name',
                'd.City_Municipality_Name',
                'e.Barangay_Name',
            )
            ->where('a.id', $id)->get();


        return (compact(
            'theEntry'
        ));
    }
    //updating Deceased Profile
    public function update_user(Request $request)

    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('users')->where('id', $data['user_id2'])->update(
            array(
                'User_Type_ID' => $data['User_Type_ID2'],
                'Region_ID' => $data['Region_ID2'],
                'Province_ID' => $data['Province_ID2'],
                'City_Municipality_ID' => $data['City_Municipality_ID2'],
                'Barangay_ID'       => $data['Barangay_ID2'],
                'Active'       => $data['Active2'],

            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }
}
