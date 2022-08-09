<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;


class BINSController extends Controller
{
//BINS Maintenance

    //UOM Unit of Measure
    public function bins_uom_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bins_unit_of_measure')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bins_unit_of_measure',compact('db_entries','currDATE'));
    }

    public function create_bins_uom_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bins_unit_of_measure')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Unit_of_Measure'  => $data['UOM_X'],
                'Active'           => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bins_uom_maint(Request $request)
    {
       $id=$_GET['id'];
        //$id=1;

        $theEntry=DB::table('maintenance_bins_unit_of_measure')->where('Unit_of_Measure_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_bins_uom_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bins_unit_of_measure')->where('Unit_of_Measure_ID',$data['UOM_ID'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Unit_of_Measure'  => $data['UOM_X2'],
                'Active'           => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //BES Borrowed Equipment Status

    public function bins_bes_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bins_borrowed_equipment_status')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bins_borrowed_equipment_status',compact('db_entries','currDATE'));
    }

    public function create_bins_bes_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bins_borrowed_equipment_status')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Equipment_Status'  => $data['BES_X'],
                'Active'           => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bins_bes_maint(Request $request)
    {
        $id=$_GET['id'];
        //$id=1;

        $theEntry=DB::table('maintenance_bins_borrowed_equipment_status')->where('Borrowed_Equipment_Status_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_bins_bes_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bins_borrowed_equipment_status')->where('Borrowed_Equipment_Status_ID',$data['BES_ID'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Equipment_Status'  => $data['BES_X2'],
                'Active'           => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Item Class

    public function bins_item_class_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bins_item_classification')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bins_item_classification',compact('db_entries','currDATE'));
    }

    public function create_bins_item_class_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bins_item_classification')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Item_Classification'  => $data['item_class_X'],
                'Active'           => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bins_item_class_maint(Request $request)
    {
        $id=$_GET['id']; 

        $theEntry=DB::table('maintenance_bins_item_classification')->where('Item_Classification_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_bins_item_class_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bins_item_classification')->where('Item_Classification_ID',$data['item_class_ID'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Item_Classification'  => $data['item_class_X2'],
                'Active'           => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Item Status

    public function bins_item_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bins_item_status')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bins_item_status',compact('db_entries','currDATE'));
    }

    public function create_bins_item_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bins_item_status')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Item_Status'      => $data['item_status_X'],
                'Active'           => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bins_item_status_maint(Request $request)
    {
        $id=$_GET['id']; 

        $theEntry=DB::table('maintenance_bins_item_status')->where('Item_Status_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_bins_item_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bins_item_status')->where('Item_Status_ID',$data['item_status_ID'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Item_Status'      => $data['item_status_X2'],
                'Active'           => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Item Category

    public function bins_item_category_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bins_item_category')->paginate(20,['*'], 'db_entries');

        $item_class_list=DB::table('maintenance_bins_item_classification')->get();

        return view('maintenance.bins_item_category',compact('db_entries','currDATE','item_class_list'));
    }

    public function create_bins_item_category_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bins_item_category')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Item_Category_Name'      => $data['item_category_X'],
                'Item_Classification_ID'      => $data['item_classification_IDX'],
                'Active'           => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bins_item_category_maint(Request $request)
    {
        $id=$_GET['id']; 

        $theEntry=DB::table('maintenance_bins_item_category')->where('Item_Category_ID',$id)->get();

        $thisEntry_item_class=DB::table('maintenance_bins_item_classification')->where('Item_Classification_ID',$theEntry[0]->Item_Classification_ID)->get();

        return(compact('theEntry','thisEntry_item_class'));
    }
    public function update_bins_item_category_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bins_item_category')->where('Item_Category_ID',$data['item_category_ID'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Item_Category_Name'      => $data['item_category_X2'],
                'Item_Classification_ID'      => $data['item_classification_IDX2'],
                'Active'           => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

}