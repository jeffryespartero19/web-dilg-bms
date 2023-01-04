<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

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

        $cityX = DB::table('maintenance_city_municipality')->where('City_Municipality_ID', $City_Municipality_ID)->get();

        $cityPSGC = $cityX->pluck('PSGC_code');
        $cityIDs = $cityX->pluck('City_Municipality_ID');
        $provIDs = $cityX->pluck('Province_ID');
        $regionIDs = $cityX->pluck('Region_ID');

        $provPSGC = DB::table('maintenance_province')->whereIn('Province_ID', $provIDs)->pluck('PSGC_code');
        $regionPSGC = DB::table('maintenance_region')->whereIn('Region_ID', $regionIDs)->pluck('PSGC_code');



        // dd($cityPSGC,$provIDs,$regionPSGC,$cityIDs);
        $countX = count($cityIDs);
        $data = [];

        for ($i = 0; $i < $countX; $i++) {
            $dataX = DB::table('maintenance_barangay as a')
                ->leftjoin('maintenance_city_municipality as b', 'b.City_Municipality_ID', '=', DB::raw($cityIDs[$i]))
                ->leftjoin('maintenance_province as c', 'c.Province_ID', '=', DB::raw($provIDs[$i]))
                ->leftjoin('maintenance_region as d', 'd.Region_ID', '=', DB::raw($regionIDs[$i]))
                ->select('a.Barangay_Name', 'b.City_Municipality_Name', 'c.Province_Name', 'd.Region_Name', 'a.Barangay_ID')
                ->where('a.Region_ID', $regionPSGC[$i])
                ->where('a.Province_ID', $provPSGC[$i])
                ->where('a.City_Municipality_ID', $cityPSGC[$i])
                ->get();

            $dx_count = count($dataX);

            for ($z = 0; $z < $dx_count; $z++) {
                array_push($data, $dataX[$z]);
            }
        }

        // dd($cityIDs);


        //dd($data);
        // return json_encode($data);

        // dd($data);

        return json_encode($data);
    }

    // Search Barangay
    public function searchBarangay($text)
    {
        //$text='Morong';
        $cityX = DB::table('maintenance_city_municipality')->where('City_Municipality_Name', 'LIKE', '%' . $text . '%')->get();

        $cityPSGC = $cityX->pluck('PSGC_code');
        $cityIDs = $cityX->pluck('City_Municipality_ID');
        $provIDs = $cityX->pluck('Province_ID');
        $regionIDs = $cityX->pluck('Region_ID');

        $provPSGC = DB::table('maintenance_province')->whereIn('Province_ID', $provIDs)->pluck('PSGC_code');
        $regionPSGC = DB::table('maintenance_region')->whereIn('Region_ID', $regionIDs)->pluck('PSGC_code');



        // dd($cityPSGC,$provIDs,$regionPSGC,$cityIDs);
        $countX = count($cityIDs);
        $data = [];

        for ($i = 0; $i < $countX; $i++) {
            $dataX = DB::table('maintenance_barangay as a')
                ->leftjoin('maintenance_city_municipality as b', 'b.City_Municipality_ID', '=', DB::raw($cityIDs[$i]))
                ->leftjoin('maintenance_province as c', 'c.Province_ID', '=', DB::raw($provIDs[$i]))
                ->leftjoin('maintenance_region as d', 'd.Region_ID', '=', DB::raw($regionIDs[$i]))
                ->select('a.Barangay_Name', 'b.City_Municipality_Name', 'c.Province_Name', 'd.Region_Name', 'a.Barangay_ID')
                ->where('a.Region_ID', $regionPSGC[$i])
                ->where('a.Province_ID', $provPSGC[$i])
                ->where('a.City_Municipality_ID', $cityPSGC[$i])
                ->get();

            $dx_count = count($dataX);

            for ($z = 0; $z < $dx_count; $z++) {
                array_push($data, $dataX[$z]);
            }
        }

        // dd($cityIDs);


        //dd($data);
        return json_encode($data);
    }

    public function search_ordinance(Request $request)
    {
        $ordinance = DB::table('boris_brgy_ordinances_and_resolutions_information')
            ->where('Ordinance_Resolution_Title', 'LIKE', '%' . $request->input('term', '') . '%')
            ->get(['Ordinance_Resolution_ID as id', 'Ordinance_Resolution_Title as text']);

        return ['results' => $ordinance];
    }
}
