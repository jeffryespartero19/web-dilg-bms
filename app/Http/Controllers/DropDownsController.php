<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;


class DropDownsController extends Controller
{
    //Province
    public function list_province(Request $request)
    {
        $id=$_GET['id'];
        // $id=13;
        
        $provinceX=DB::table('maintenance_province')->where('Region_ID',$id)->get();

        return(compact('provinceX'));
    }

    //City-Municipality
    public function list_city(Request $request)
    {
        $id=$_GET['id'];

        $cityX=DB::table('maintenance_city_municipality')->where('Province_ID', $id)->get();

        return(compact('cityX'));
    }

    //Barangay
    public function list_brgy(Request $request)
    {
       $id=$_GET['id'];

        //$id=1231;

        $cityX=DB::table('maintenance_city_municipality')->where('City_Municipality_ID', $id)->get();

        $cityPSGC=$cityX[0]->PSGC_code;
        $provPSGC=DB::table('maintenance_province')->where('Province_ID',$cityX[0]->Province_ID)->pluck('PSGC_code');
        $regionPSGC=DB::table('maintenance_region')->where('Region_ID',$cityX[0]->Region_ID)->pluck('PSGC_code');

        

        $brgyX=DB::table('maintenance_barangay')
                ->where('Region_ID', $regionPSGC)
                ->where('Province_ID', $provPSGC)
                ->where('City_Municipality_ID', $cityPSGC)
                ->get();

        return(compact('brgyX'));
    }
}