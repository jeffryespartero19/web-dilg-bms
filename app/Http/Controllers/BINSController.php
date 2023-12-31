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
        $db_entries = DB::table('maintenance_bins_unit_of_measure as a')
            ->join('users as b','b.id','=','a.Encoder_ID')
            ->get();

        return view('maintenance.bins_unit_of_measure',compact('db_entries','currDATE'));
    }

    public function create_bins_uom_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

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
        $data = request()->all();

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
        $db_entries = DB::table('maintenance_bins_borrowed_equipment_status as a')
            ->join('users as b','b.id','=','a.Encoder_ID')
            ->get();

        return view('maintenance.bins_borrowed_equipment_status',compact('db_entries','currDATE'));
    }

    public function create_bins_bes_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

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
        $data = request()->all();

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
        $db_entries = DB::table('maintenance_bins_item_classification as a')
            ->join('users as b','b.id','=','a.Encoder_ID')
            ->get();

        return view('maintenance.bins_item_classification',compact('db_entries','currDATE'));
    }

    public function create_bins_item_class_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

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
        $data = request()->all();

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
        $db_entries = DB::table('maintenance_bins_item_status as a')
            ->join('users as b','b.id','=','a.Encoder_ID')
            ->get();

        return view('maintenance.bins_item_status',compact('db_entries','currDATE'));
    }

    public function create_bins_item_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

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
        $data = request()->all();

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
        $db_entries = DB::table('maintenance_bins_item_category as a')
            ->join('users as b','b.id','=','a.Encoder_ID')
            ->join('maintenance_bins_item_classification as c','c.Item_Classification_ID','=','a.Item_Classification_ID')
            ->get();

        $item_class_list=DB::table('maintenance_bins_item_classification')->get();

        return view('maintenance.bins_item_category',compact('db_entries','currDATE','item_class_list'));
    }

    public function create_bins_item_category_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

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
        $data = request()->all();

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
        $db_entries = DB::table('bins_inventory_begbal as a')
                        ->join('bins_brgy_inventory as b','b.Inventory_ID','=','a.Inventory_ID')
                        ->join('users as c','c.id','=','a.Encoder_ID')
                        ->select(
                                'a.Inventory_BegBal_ID',
                                'a.Unit_Cost',
                                'a.Quantity',
                                'a.Date_Stamp',
                                'b.Inventory_Name',
                                'b.Stock_No',
                                'c.name',
                                )
                        ->get();

        $inventoryX=DB::table('bins_brgy_inventory')->get();

        return view('bins.begining_balance',compact('db_entries','currDATE','inventoryX'));
    }

    public function create_bins_begbal(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

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
        //$id=1;

        $theEntry=DB::table('bins_inventory_begbal')->where('Inventory_BegBal_ID',$id)->get();

        $theEntry_inventoryX=DB::table('bins_brgy_inventory')->where('Inventory_ID',$theEntry[0]->Inventory_ID)->get();

        return(compact('theEntry','theEntry_inventoryX'));
    }
    public function update_bins_begbal(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bins_inventory_begbal')->where('Inventory_BegBal_ID',$data['Inventory_BegBal_ID2'])->update(
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
        $db_entries = DB::table('bins_item_inspection as a')
                        ->join('bins_received_item as b','b.Received_Item_ID','=','a.Received_Item_ID')
                        ->join('users as c','c.id','=','a.Encoder_ID')
                        ->join('bins_brgy_inventory as d','d.Inventory_ID','=','b.Inventory_ID')
                        ->join('maintenance_bins_item_status as e','e.Item_Status_ID','=','a.Item_Status_ID')
                        ->select(
                                'a.Item_Inspection_ID',
                                'a.Received_Item_ID',
                                'a.Inspection_Date',
                                'a.Markings',
                                'a.Date_Stamp',
                                'c.name',
                                'd.Inventory_Name',
                                'd.Stock_No',
                                'e.Item_Status',
                                )
                        ->get();

        $RC_item_list=DB::table('bins_received_item as a')
            ->join('bins_brgy_inventory as b','b.Inventory_ID','=','a.Inventory_ID')
            ->select(
                'a.Received_Item_ID',
                'b.Inventory_Name',
                'b.Stock_No',
                )
            ->get();
        $item_status_list=DB::table('maintenance_bins_item_status')->get();

        return view('bins.item_inspection',compact('db_entries','currDATE','RC_item_list','item_status_list'));
    }

    public function create_bins_item_inspection(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bins_item_inspection')->insert(
            array(
                'Encoder_ID'         => Auth::user()->id,
                'Date_Stamp'         => Carbon::now(),
                'Received_Item_ID'   => $data['item_rc_ID'],
                'Inspection_Date'    => Carbon::now(),
                'Markings'           => $data['markingsX'],
                // 'Serial_No'          => $data['serialNoX'],
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
        $the_item=DB::table('bins_brgy_inventory')->where('Inventory_ID',$theRC_item[0]->Inventory_ID)->get();
        $theitem_status=DB::table('maintenance_bins_item_status')->where('Item_Status_ID',$theEntry[0]->Item_Status_ID)->get();

        // dd($theEntry,$theRC_item,$theitem_status);

        return(compact('theEntry','theRC_item','theitem_status','the_item'));
    }
    public function update_bins_item_inspection(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bins_item_inspection')->where('Item_Inspection_ID',$data['Item_Inspection_ID'])->update(
            array(
                'Encoder_ID'         => Auth::user()->id,
                'Date_Stamp'         => Carbon::now(),
                'Received_Item_ID'   => $data['item_rc_ID2'],
                'Inspection_Date'    => Carbon::now(),
                'Markings'           => $data['markingsX2'],
                // 'Serial_No'          => $data['serialNoX2'],
                'Item_Status_ID'     => $data['item_status_ID2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Received Item

    public function bins_received_item(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bins_received_item as a')
                        ->join('bins_brgy_inventory as b','b.Inventory_ID','=','a.Inventory_ID')
                        ->join('users as c','c.id','=','a.Encoder_ID')
                        ->join('maintenance_bins_item_status as e','e.Item_Status_ID','=','a.Item_Status_ID')
                        ->select(
                                'a.Received_Item_ID',
                                'a.Donation',
                                'a.Received_Quantity',
                                'a.Date_Received',
                                'a.Date_Stamp',
                                'b.Inventory_Name',
                                'b.Stock_No',
                                'c.name',
                                'e.Item_Status',
                                )
                        ->get();

        $inventory_list=DB::table('bins_brgy_inventory')->get();
        $item_status_list=DB::table('maintenance_bins_item_status')->get();
        $staff_list=DB::table('bips_brgy_officials_and_staff')->get();

        return view('bins.received_item',compact('db_entries','currDATE','inventory_list','item_status_list','staff_list'));
    }

    public function create_bins_received_item(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bins_received_item')->insert(
            array(
                'Encoder_ID'         => Auth::user()->id,
                'Date_Stamp'         => Carbon::now(),
                'Inventory_ID'       => $data['item_ID'],
                'Item_Status_ID'     => $data['item_status_ID'],
                'Donation'           => (int)$data['donationX'],
                'Brgy_Officials_and_Staff_ID' => $data['rc_by'],
                'Received_Quantity'  => $data['received_qty'],
                'Date_Received'      => Carbon::now()
                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bins_received_item(Request $request)
    {
        $id=$_GET['id']; 
        //$id=1; 

        $theEntry=DB::table('bins_received_item')->where('Received_Item_ID',$id)->get();

        $the_item=DB::table('bins_brgy_inventory')->where('Inventory_ID',$theEntry[0]->Inventory_ID)->get();
        $theitem_status=DB::table('maintenance_bins_item_status')->where('Item_Status_ID',$theEntry[0]->Item_Status_ID)->get();
        $thestaff=DB::table('users')->where('id',$theEntry[0]->Brgy_Officials_and_Staff_ID)->get();

        //dd($theEntry,$the_item,$theitem_status);

        return(compact('theEntry','the_item','theitem_status','thestaff'));
    }
    public function update_bins_received_item(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bins_received_item')->where('Received_Item_ID',$data['Received_Item_ID'])->update(
            array(
                'Encoder_ID'         => Auth::user()->id,
                'Date_Stamp'         => Carbon::now(),
                'Inventory_ID'       => $data['item_ID2'],
                'Item_Status_ID'     => $data['item_status_ID2'],
                'Donation'           => (int)$data['donationX2'],
                'Brgy_Officials_and_Staff_ID' => $data['rc_by2'],
                'Received_Quantity'  => $data['received_qty2'],
                'Date_Received'      => Carbon::now()
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Physical Count

    public function bins_physical_count(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bins_physical_count as a')
                    ->join('maintenance_bins_item_category as b','b.Item_Category_ID','=','a.Item_Category_ID')
                    ->join('users as c','c.id','=','a.Encoder_ID')
                    ->join('bins_physical_count_inventory as d','d.Physical_Count_Inventory_ID','=','a.Physical_Count_Inventory_ID')
                    ->join('bins_brgy_inventory as e','e.Inventory_ID','=','d.Inventory_ID')
                    ->select(
                            'a.Physical_Count_ID',
                            'a.Transaction_No',
                            'a.Particulars',
                            'a.Date_Stamp',
                            'b.Item_Category_Name',
                            'c.name',
                            'e.Inventory_Name',
                            'e.Stock_No',
                            )
                    ->get();

        $P_inventory_list=DB::table('bins_physical_count_inventory as a')
            ->join('bins_brgy_inventory as b','b.Inventory_ID','=','a.Inventory_ID')
            ->select(
                'a.Physical_Count_Inventory_ID',
                'a.On_Hand_Per_Count',
                'a.Remarks',
                'b.Inventory_Name',
                'b.Stock_No',
                )
            ->get();
        $item_category_list=DB::table('maintenance_bins_item_category')->get();
        $staff_list=DB::table('bips_brgy_officials_and_staff')->get();

        return view('bins.physical_count',compact('db_entries','currDATE','P_inventory_list','item_category_list','staff_list'));
    }

    public function create_bins_physical_count(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        $TR_no = $randomString;

        DB::table('bins_physical_count')->insert(
            array(
                'Encoder_ID'         => Auth::user()->id,
                'Date_Stamp'         => Carbon::now(),
                'Item_Category_ID'   => $data['item_category_ID'],
                'Physical_Count_Inventory_ID' => $data['P_item_ID'],
                'Transaction_No'   => $TR_no,
                'Particulars'                    => $data['particulars'],
                'Brgy_Officials_and_Staff_ID'    => $data['oic']
                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bins_physical_count(Request $request)
    {
        $id=$_GET['id']; 
        //$id=1; 

        $theEntry=DB::table('bins_physical_count')->where('Physical_Count_ID',$id)->get();

        $theP_inventory=DB::table('bins_physical_count_inventory as a')
                            ->where('Physical_Count_Inventory_ID',$theEntry[0]->Physical_Count_Inventory_ID)
                            ->join('bins_brgy_inventory as e','e.Inventory_ID','=','a.Inventory_ID')
                            ->get();
        $theitem_category=DB::table('maintenance_bins_item_category')->where('Item_Category_ID',$theEntry[0]->Item_Category_ID)->get();
        $thestaff=DB::table('users')->where('id',$theEntry[0]->Brgy_Officials_and_Staff_ID)->get();

        //dd($theEntry,$theP_inventory,$theitem_category,$thestaff);

        return(compact('theEntry','theP_inventory','theitem_category','thestaff'));
    }
    public function update_bins_physical_count(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bins_physical_count')->where('Physical_Count_ID',$data['Physical_Count_ID'])->update(
            array(
                'Encoder_ID'         => Auth::user()->id,
                'Date_Stamp'         => Carbon::now(),
                'Item_Category_ID'   => $data['item_category_ID2'],
                'Physical_Count_Inventory_ID' => $data['P_item_ID2'],
                'Particulars'                    => $data['particulars2'],
                'Brgy_Officials_and_Staff_ID'    => $data['oic2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Inventory Disposal

    public function bins_inv_disposal(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bins_inventory_for_disposal as a')
                        ->join('bins_brgy_inventory as b','b.Inventory_ID','=','a.Inventory_ID')
                        ->join('users as c','c.id','=','a.Encoder_ID')
                        ->join('maintenance_bins_item_status as d','d.Item_Status_ID','=','a.Item_Status_ID')
                        ->select(
                                'a.Disposal_Inventory_ID',
                                'a.Date_Disposed',
                                'a.Quantity_Disposed',
                                'a.Remarks',
                                'a.Date_Stamp',
                                'b.Inventory_Name',
                                'b.Stock_No',
                                'c.name',
                                'd.Item_Status',
                                )
                        ->get();

        $inventory_list=DB::table('bins_brgy_inventory')->get();
        $item_status_list=DB::table('maintenance_bins_item_status')->where('Item_Status', 'like', '%'.'dispos'.'%')->get();
        $staff_list=DB::table('bips_brgy_officials_and_staff')->get();

        return view('bins.inventory_disposal',compact('db_entries','currDATE','inventory_list','item_status_list','staff_list'));
    }

    public function create_bins_inv_disposal(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        $itemLen= count($data['item_ID']);

        for ($i = 0; $i < $itemLen; $i++) {
            DB::table('bins_inventory_for_disposal')->insert(
                array(
                    'Encoder_ID'         => Auth::user()->id,
                    'Date_Stamp'         => Carbon::now(),
                    'Date_Disposed'      => $data['Date_Disposed'],
                    'Inventory_ID'       => $data['item_ID'][$i],
                    'Quantity_Disposed'  => $data['Quantity_Disposed'][$i],
                    'Item_Status_ID'     => $data['item_status_ID'],
                    'Remarks'            => $data['remarks'],
                    'Brgy_Officials_and_Staff_ID' => $data['oic']
                )
            );
        }

        

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bins_inv_disposal(Request $request)
    {
        $id=$_GET['id']; 
        //$id=1; 

        $theEntry=DB::table('bins_inventory_for_disposal')->where('Disposal_Inventory_ID',$id)->get();

        $the_item=DB::table('bins_brgy_inventory')->where('Inventory_ID',$theEntry[0]->Inventory_ID)->get();
        $theitem_status=DB::table('maintenance_bins_item_status')->where('Item_Status_ID',$theEntry[0]->Item_Status_ID)->get();
        $thestaff=DB::table('users')->where('id',$theEntry[0]->Brgy_Officials_and_Staff_ID)->get();

        //dd($theEntry,$the_item,$theitem_status);

        return(compact('theEntry','the_item','theitem_status','thestaff'));
    }
    public function update_bins_inv_disposal(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bins_inventory_for_disposal')->where('Disposal_Inventory_ID',$data['Disposal_ID'])->update(
            array(
                'Encoder_ID'         => Auth::user()->id,
                'Date_Stamp'         => Carbon::now(),
                'Date_Disposed'      => $data['Date_Disposed2'],
                'Inventory_ID'       => $data['item_ID2'],
                'Quantity_Disposed'  => $data['Quantity_Disposed2'],
                'Item_Status_ID'     => $data['item_status_ID2'],
                'Remarks'            => $data['remarks2'],
                'Brgy_Officials_and_Staff_ID' => $data['oic2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Borrow Request

    public function bins_borrow(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bins_equipment_borrowed as a')
                    ->join('bins_brgy_inventory as b','b.Inventory_ID','=','a.Inventory_ID')
                    ->join('users as c','c.id','=','a.Encoder_ID')
                    ->join('maintenance_bins_item_status as d','d.Item_Status_ID','=','a.Borrowed_Equipmnet_Status_ID')
                    ->join('bins_inhabitants_equipment_borrow_request as e','e.Equipment_Request_ID','=','a.Equipment_Request_ID')
                    ->join('bips_brgy_inhabitants_information as f','f.Resident_ID','=','e.Resident_ID')
                    ->select(
                            'a.Borrowed_Equipment_ID',
                            'a.Quantity_Borrowed',
                            'a.Date_Stamp',
                            'b.Inventory_Name',
                            'b.Stock_No',
                            'c.name',
                            'd.Item_Status',
                            'e.Date_Borrowed',
                            'e.Expected_Return_Date',
                            'e.Date_Returned',
                            'f.Last_Name','f.First_Name','f.Middle_Name',
                            )
                    ->get();

        $request_list = DB::table('bins_inhabitants_equipment_borrow_request')->get();

        $inventory_list=DB::table('bins_brgy_inventory')->get();
        $item_status_list=DB::table('maintenance_bins_item_status')->get();
        $resident_list=DB::table('bips_brgy_inhabitants_information')->get();

        return view('bins.borrow_request',compact('db_entries','currDATE','inventory_list','item_status_list','request_list','resident_list'));
    }

    public function create_bins_borrow(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        $itemLen= count($data['item_ID']);

        for ($i = 0; $i < $itemLen; $i++) {
            $new_requestID=DB::table('bins_inhabitants_equipment_borrow_request')->insertGetId(
                array(
                    'Resident_ID'        => $data['Resident_ID'],
                    'Encoder_ID'         => Auth::user()->id,
                    'Date_Stamp'         => Carbon::now(),
                    'Purpose'            => $data['Purpose'],
                    'Remarks'            => $data['Remarks'],
                    'Date_Borrowed'      => $data['Date_Borrowed'],
                    'Expected_Return_Date' => $data['Expected_Return_Date']  
                )
            );
    
            DB::table('bins_equipment_borrowed')->insert(
                array(
                    'Encoder_ID'         => Auth::user()->id,
                    'Date_Stamp'         => Carbon::now(),
                    'Equipment_Request_ID'   => $new_requestID,
                    'Inventory_ID'           => $data['item_ID'][$i],
                    'Quantity_Borrowed'      => $data['Quantity_Borrowed'][$i],
                    'Borrowed_Equipmnet_Status_ID' => $data['item_Status_ID'],
                    
                )
            );
        }

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bins_borrow(Request $request)
    {
        $id=$_GET['id']; 
        //$id=1; 

        $theEntry=DB::table('bins_equipment_borrowed')->where('Borrowed_Equipment_ID',$id)->get();
        $theRequest=DB::table('bins_inhabitants_equipment_borrow_request')->where('Equipment_Request_ID',$theEntry[0]->Equipment_Request_ID)->get();

        $the_item=DB::table('bins_brgy_inventory')->where('Inventory_ID',$theEntry[0]->Inventory_ID)->get();
        $theitem_status=DB::table('maintenance_bins_item_status')->where('Item_Status_ID',$theEntry[0]->Borrowed_Equipmnet_Status_ID)->get();

        $theResident=DB::table('bips_brgy_inhabitants_information')->where('Resident_ID',$theRequest[0]->Resident_ID)->get();

        //dd($theEntry,$the_item,$theRequest,$theitem_status,$theResident);

        return(compact('theEntry','the_item','theitem_status','theRequest','theResident'));
    }
    public function update_bins_borrow(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bins_inhabitants_equipment_borrow_request')->update(
            array(
                'Resident_ID'        => $data['Resident_ID2'],
                'Encoder_ID'         => Auth::user()->id,
                'Date_Stamp'         => Carbon::now(),
                'Purpose'            => $data['Purpose2'],
                'Remarks'            => $data['Remarks2'],
                'Date_Borrowed'      => $data['Date_Borrowed2'],
                'Expected_Return_Date' => $data['Expected_Return_Date2'],  
                'Date_Returned' => $data['Date_Returned2'],
            )
        );

        DB::table('bins_equipment_borrowed')->update(
            array(
                'Encoder_ID'         => Auth::user()->id,
                'Date_Stamp'         => Carbon::now(),
                'Inventory_ID'           => $data['item_ID2'],
                'Quantity_Borrowed'      => $data['Quantity_Borrowed2'],
                'Borrowed_Equipmnet_Status_ID' => $data['item_Status_ID2'],
                
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Supply Issuance

    public function bins_supply_issuance(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bins_received_item')->get();

        $inventory_list=DB::table('bins_brgy_inventory')->get();
        $item_status_list=DB::table('maintenance_bins_item_status')->get();
        $staff_list=DB::table('bips_brgy_officials_and_staff')->get();

        return view('bins.supply_issuance',compact('db_entries','currDATE','inventory_list','item_status_list','staff_list'));
    }

    public function create_bins_supply_issuance(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bins_received_item')->insert(
            array(
                'Encoder_ID'         => Auth::user()->id,
                'Date_Stamp'         => Carbon::now(),
                'Inventory_ID'       => $data['item_ID'],
                'Item_Status_ID'     => $data['item_status_ID'],
                'Donation'           => (int)$data['donationX'],
                'Brgy_Officials_and_Staff_ID' => $data['rc_by'],
                'Received_Quantity'  => $data['received_qty'],
                'Date_Received'      => Carbon::now()
                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bins_supply_issuance(Request $request)
    {
        $id=$_GET['id']; 
        //$id=1; 

        $theEntry=DB::table('bins_received_item')->where('Received_Item_ID',$id)->get();

        $the_item=DB::table('bins_brgy_inventory')->where('Inventory_ID',$theEntry[0]->Inventory_ID)->get();
        $theitem_status=DB::table('maintenance_bins_item_status')->where('Item_Status_ID',$theEntry[0]->Item_Status_ID)->get();

        //dd($theEntry,$the_item,$theitem_status);

        return(compact('theEntry','the_item','theitem_status'));
    }
    public function update_bins_supply_issuance(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('bins_received_item')->where('Received_Item_ID',$data['Received_Item_ID'])->update(
            array(
                'Encoder_ID'         => Auth::user()->id,
                'Date_Stamp'         => Carbon::now(),
                'Inventory_ID'       => $data['item_ID2'],
                'Item_Status_ID'     => $data['item_status_ID2'],
                'Donation'           => (int)$data['donationX2'],
                'Brgy_Officials_and_Staff_ID' => $data['rc_by2'],
                'Received_Quantity'  => $data['received_qty2'],
                'Date_Received'      => Carbon::now()
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Barangay Inventory

    public function bins_inventory(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('bins_brgy_inventory')
            //->join('bfas_card_file','bfas_card_file.Card_File_ID','=','bins_brgy_inventory.Card_File_ID')
            ->join('maintenance_bins_item_category','maintenance_bins_item_category.Item_Category_ID','=','bins_brgy_inventory.Item_Category_ID')
            ->join('maintenance_bins_unit_of_measure','maintenance_bins_unit_of_measure.Unit_of_Measure_ID','=','bins_brgy_inventory.Unit_of_Measure_ID')
            ->join('maintenance_bins_item_status','maintenance_bins_item_status.Item_Status_ID','=','bins_brgy_inventory.Item_Status_ID')
           //->join('bins_item_inspection','bins_item_inspection.Item_Inspection_ID','=','bins_brgy_inventory.Item_Inspection_ID')
            ->join('maintenance_barangay','maintenance_barangay.Barangay_ID','=','bins_brgy_inventory.Barangay_ID')
            ->join('maintenance_city_municipality','maintenance_city_municipality.City_Municipality_ID','=','bins_brgy_inventory.City_Municipality_ID')
            ->join('maintenance_province','maintenance_province.Province_ID','=','bins_brgy_inventory.Province_ID')
            ->join('maintenance_region','maintenance_region.Region_ID','=','bins_brgy_inventory.Region_ID')
            ->get();

        //dd($db_entries);

        $card_file=DB::table('bfas_card_file')->get();

        $item_category_list= DB::table('maintenance_bins_item_category')->get();
        $uom_list = DB::table('maintenance_bins_unit_of_measure')->get();
        $item_status_list=DB::table('maintenance_bins_item_status')->get();
        $item_inspection=DB::table('bins_item_inspection')->get();

        $now = Carbon::now();

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        $Stock_Nox= $now->year.'-'.date('m',$now->month).'-'.$randomString;

        return view('bins.barangay_inventory',compact('db_entries','currDATE','card_file','item_category_list','uom_list','item_status_list','item_inspection','Stock_Nox'));
    }

    public function create_bins_inventory(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        $bgry_ID=Auth::user()->Barangay_ID;

        $theBrgy=DB::table('maintenance_barangay')->where('Barangay_ID',$bgry_ID)->get();
        $theCity=DB::table('maintenance_city_municipality')->where('City_Municipality_ID',Auth::user()->City_Municipality_ID)->get();
        $theProv=DB::table('maintenance_province')->where('Province_ID',Auth::user()->Province_ID)->get();
        $theRegion=DB::table('maintenance_region')->where('Region_ID',Auth::user()->Region_ID)->get();

        DB::table('bins_brgy_inventory')->insert(
            array(
                'Encoder_ID'         => Auth::user()->id,
                'Date_Stamp'         => Carbon::now(),

                'Stock_No'           => $data['Stock_No'],
                'Inventory_Name'     => $data['Inventory_Name'],
                'Card_File_ID'       => $data['Card_File_ID'],

                'Item_Category_ID'      => $data['Item_Category_ID'],
                'Unit_of_Measure_ID' => $data['Unit_of_Measure_ID'],
                'Item_Status_ID'     => $data['Item_Status_ID'],
                'Date_Received'      => $data['Date_Received'],
                'Remarks'            => $data['Remarks'],

                'Barangay_ID'            => $theBrgy[0]->Barangay_ID,
                'City_Municipality_ID'   => $theCity[0]->City_Municipality_ID,
                'Province_ID'            => $theProv[0]->Province_ID,
                'Region_ID'              => $theRegion[0]->Region_ID,
                
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bins_inventory(Request $request)
    {
        $id=$_GET['id']; 
        //$id=2; 

        $theEntry=DB::table('bins_brgy_inventory')
            ->join('maintenance_bins_item_category','maintenance_bins_item_category.Item_Category_ID','=','bins_brgy_inventory.Item_Category_ID')
            ->join('maintenance_bins_unit_of_measure','maintenance_bins_unit_of_measure.Unit_of_Measure_ID','=','bins_brgy_inventory.Unit_of_Measure_ID')
            ->join('maintenance_bins_item_status','maintenance_bins_item_status.Item_Status_ID','=','bins_brgy_inventory.Item_Status_ID')
            ->where('Inventory_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_bins_inventory(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        $bgry_ID=Auth::user()->Barangay_ID;

        $theBrgy=DB::table('maintenance_barangay')->where('Barangay_ID',$bgry_ID)->get();
        $theCity=DB::table('maintenance_city_municipality')->where('City_Municipality_ID',$theBrgy[0]->City_Municipality_ID)->get();
        $theProv=DB::table('maintenance_province')->where('Province_ID',$theCity[0]->Province_ID)->get();
        $theRegion=DB::table('maintenance_region')->where('Region_ID',$theProv[0]->Region_ID)->get();

        DB::table('bins_brgy_inventory')->where('Inventory_ID',$data['IDx'])->update(
            array(
                'Encoder_ID'         => Auth::user()->id,
                'Date_Stamp'         => Carbon::now(),

                'Stock_No'           => $data['Stock_No2'],
                'Inventory_Name'     => $data['Inventory_Name2'],
                'Card_File_ID'       => $data['Card_File_ID2'],

                'Item_Category_ID'      => $data['Item_Category_ID2'],
                'Unit_of_Measure_ID' => $data['Unit_of_Measure_ID2'],
                'Item_Status_ID'     => $data['Item_Status_ID2'],
                'Date_Received'      => $data['Date_Received2'],
                'Remarks'            => $data['Remarks2'],

                'Barangay_ID'            => $theBrgy[0]->Barangay_ID,
                'City_Municipality_ID'   => $theCity[0]->City_Municipality_ID,
                'Province_ID'            => $theProv[0]->Province_ID,
                'Region_ID'              => $theRegion[0]->Region_ID,
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

}