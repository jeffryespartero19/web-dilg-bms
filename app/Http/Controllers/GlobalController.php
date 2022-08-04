<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class GlobalController extends Controller
{
    // Get Province
    public function getProvince($REGION_ID)
    {
        $data = DB::table('maintenance_province')
            ->where(['REGION_ID' => $REGION_ID])
            ->get();

        return json_encode($data);
    }

    // Get City
    public function getCity($PROVINCE_ID)
    {
        $data = DB::table('maintenance_city_municipality')
            ->where(['PROVINCE_ID' => $PROVINCE_ID])
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
