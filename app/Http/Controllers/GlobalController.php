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

}
