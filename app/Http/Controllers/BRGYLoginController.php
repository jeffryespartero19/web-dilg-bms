<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BRGYLoginController extends Controller
{
    public function index($b_id)
    {
        $Barangay_ID = $b_id;
        $barangay = DB::table('maintenance_barangay')->where('Barangay_ID', $Barangay_ID)->get();


        return view('auth.login', compact('Barangay_ID', 'barangay'));
    }
}

