<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;

class BCPISMTController extends Controller
{
    //start Business Type
    public function business_type_list(Request $request)
    {
        $currDATE = Carbon::now();
        // $db_entries = DB::table('maintenance_bcpcis_business_type')->paginate(20, ['*'], 'db_entries');
        $db_entries = DB::table('maintenance_bcpcis_business_type as a')
        ->select(
            'a.Business_Type_ID',
            'a.Business_Type',
            DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),
            'a.Encoder_ID',
            'a.Date_Stamp',

        )
        ->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bcpcis_business_type', compact('db_entries', 'currDATE'));
    }

    public function create_business_type(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bcpcis_business_type')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Business_Type'      => $data['Business_TypeX'],
                'Active'           => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_business_type(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bcpcis_business_type')->where('Business_Type_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_business_type(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bcpcis_business_type')->where('Business_Type_ID', $data['Business_Type_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Business_Type'  => $data['Business_TypeX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }
    //end Business Type
    //start Purpose of Document
    public function purpose_document_list(Request $request) 
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bcpcis_purpose_of_document as a')
        ->select(
            'a.Purpose_of_Document_ID',
            'a.Purpose_of_Document',
            DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),
            'a.Encoder_ID',
            'a.Date_Stamp',

        )
        ->paginate(20, ['*'], 'db_entries');

        // $db_entries = DB::table('maintenance_bcpcis_purpose_of_document')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bcpcis_purpose_document', compact('db_entries', 'currDATE'));
    }

    public function create_purpose_document(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bcpcis_purpose_of_document')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Purpose_of_Document'      => $data['Purpose_of_DocumentX'],
                'Active'           => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_purpose_document(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bcpcis_purpose_of_document')->where('Purpose_of_Document_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_purpose_document(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bcpcis_purpose_of_document')->where('Purpose_of_Document_ID', $data['Purpose_of_Document_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Purpose_of_Document'  => $data['Purpose_of_DocumentX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }
    //end Purpose of Document
    //start Document Type
    public function document_type_list(Request $request)
    {
        $currDATE = Carbon::now();
        // $db_entries = DB::table('maintenance_bcpcis_document_type')->paginate(20, ['*'], 'db_entries');
        $db_entries = DB::table('maintenance_bcpcis_document_type as a')
        ->select(
            'a.Document_Type_ID',
            'a.Document_Type_Name',
            DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),
            'a.Encoder_ID',
            'a.Date_Stamp',

        )
        ->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bcpcis_document_type', compact('db_entries', 'currDATE'));
    }

    public function create_document_type(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bcpcis_document_type')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Document_Type_Name'      => $data['Document_Type_NameX'],
                'Active'           => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_document_type(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bcpcis_document_type')->where('Document_Type_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_document_type(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bcpcis_document_type')->where('Document_Type_ID', $data['Document_Type_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Document_Type_Name'  => $data['Document_Type_NameX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }
    //end Business Type
}
