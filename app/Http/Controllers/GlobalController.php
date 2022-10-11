<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class GlobalController extends Controller
{
    // Get Province
    public function getProvince($Region_ID)
    {
        $data = DB::table('maintenance_province')
            ->where(['Region_ID' => $Region_ID])
            ->get();

        return json_encode($data);
    }

    // Get City
    public function getCity($Province_ID)
    {
        $data = DB::table('maintenance_city_municipality')
            ->where(['Province_ID' => $Province_ID])
            ->get();

        return json_encode($data);
    }

    // Get Barangay
    public function getBarangay($City_Municipality_ID)
    {
        $data = DB::table('maintenance_barangay')
            ->where(['City_Municipality_ID' => $City_Municipality_ID])
            ->get();

        return json_encode($data);
    }

    // Search Barangay
    public function searchBarangay($text)
    {
        $data = DB::table('maintenance_barangay as a')
            ->leftjoin('maintenance_city_municipality as b', 'b.City_Municipality_ID', '=', 'a.City_Municipality_ID')
            ->leftjoin('maintenance_province as c', 'c.Province_ID', '=', 'b.Province_ID')
            ->leftjoin('maintenance_region as d', 'd.Region_ID', '=', 'c.Region_ID')
            ->select('a.Barangay_Name', 'b.City_Municipality_Name', 'c.Province_Name', 'd.Region_Name', 'a.Barangay_ID')
            ->where('b.City_Municipality_Name', 'LIKE', '%' . $text . '%')
            ->get();

        return json_encode($data);
    }
}
