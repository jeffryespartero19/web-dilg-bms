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


    ////////////////  Start of BINS Transactions  ///////////////
    

    //Beginning Balance

    public function bins_begbal(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bins_inventory_begbal')->paginate(20,['*'], 'db_entries');

        $inventoryX=DB::table('bins_brgy_inventory')->get();

        return view('bins.begining_balance',compact('db_entries','currDATE','inventoryX'));
    }

    public function create_bins_begbal(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('bins_inventory_begbal')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Inventory_ID'     => $data['item_inv_ID'],
                'Unit_Cost'        => $data['item_unit_cost'],
                'Quantity'         => $data['item_qty']
                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bins_begbal(Request $request)
    {
        $id=$_GET['id']; 

        $theEntry=DB::table('bins_inventory_begbal')->where('Inventory_BegBal_ID',$id)->get();

        $theEntry_inventoryX=DB::table('bins_brgy_inventory')->where('Inventory_ID',$theEntry[0]->Inventory_ID)->get();

        return(compact('theEntry','theEntry_inventoryX'));
    }
    public function update_bins_begbal(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('bins_inventory_begbal')->where('Item_Category_ID',$data['item_category_ID'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Inventory_ID'     => $data['item_inv_ID2'],
                'Unit_Cost'        => $data['item_unit_cost2'],
                'Quantity'         => $data['item_qty2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Item Inspection

    public function bins_item_inspection(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bins_item_inspection')->paginate(20,['*'], 'db_entries');

        $RC_item_list=DB::table('bins_received_item')->get();
        $item_status_list=DB::table('maintenance_bins_item_status')->get();

        return view('bins.item_inspection',compact('db_entries','currDATE','RC_item_list','item_status_list'));
    }

    public function create_bins_item_inspection(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('bins_item_inspection')->insert(
            array(
                'Encoder_ID'         => Auth::user()->id,
                'Date_Stamp'         => Carbon::now(),
                'Received_Item_ID'   => $data['item_rc_ID'],
                'Inspection_Date'    => Carbon::now(),
                'Markings'           => $data['markingsX'],
                'Serial_No'          => $data['serialNoX'],
                'Item_Status_ID'     => $data['item_status_ID']
                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bins_item_inspection(Request $request)
    {
        $id=$_GET['id']; 
        //$id=1; 

        $theEntry=DB::table('bins_item_inspection')->where('Item_Inspection_ID',$id)->get();

        $theRC_item=DB::table('bins_received_item')->where('Received_Item_ID',$theEntry[0]->Received_Item_ID)->get();
        $theitem_status=DB::table('maintenance_bins_item_status')->where('Item_Status_ID',$theEntry[0]->Item_Status_ID)->get();

        // dd($theEntry,$theRC_item,$theitem_status);

        return(compact('theEntry','theRC_item','theitem_status'));
    }
    public function update_bins_item_inspection(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('bins_item_inspection')->where('Item_Inspection_ID',$data['Item_Inspection_ID'])->update(
            array(
                'Encoder_ID'         => Auth::user()->id,
                'Date_Stamp'         => Carbon::now(),
                'Received_Item_ID'   => $data['item_rc_ID2'],
                'Inspection_Date'    => Carbon::now(),
                'Markings'           => $data['markingsX2'],
                'Serial_No'          => $data['serialNoX2'],
                'Item_Status_ID'     => $data['item_status_ID2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

}