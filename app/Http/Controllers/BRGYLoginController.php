<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BRGYLoginController extends Controller
{
    public function index($b_id)
    {
        $Barangay_ID = $b_id;
        
        return view('auth.login', compact('Barangay_ID'));
    }
}
