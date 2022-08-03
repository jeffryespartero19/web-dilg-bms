<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;


class maintenanceController extends Controller
{
//Barangay Web
    //Announcement Status Maintenance
    public function bweb_ann_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_brgy_web_announcement_status')->paginate(20,['*'], 'db_entries');

        return view('maintenance.barangay_web_announcement_status',compact('db_entries','currDATE'));
    }

    public function create_bweb_ann_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_brgy_web_announcement_status')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Announcement_Status'  => $data['Announcement_StatusX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_bweb_ann_status_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_brgy_web_announcement_status')->where('Announcement_Status_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_bweb_ann_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_brgy_web_announcement_status')->where('Announcement_Status_ID',$data['Announcement_Status_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Announcement_Status'  => $data['Announcement_StatusX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Blood Type
    public function blood_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_blood_type')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bips_blood_type',compact('db_entries','currDATE'));
    }

    public function create_blood_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_blood_type')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Blood_Type'  => $data['Blood_TypeX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_blood_type_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_bips_blood_type')->where('Blood_Type_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_blood_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_blood_type')->where('Blood_Type_ID',$data['Blood_Type_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Blood_Type'  => $data['Blood_TypeX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Deceased Type
    public function deceased_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_deceased_type')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bips_deceased_type',compact('db_entries','currDATE'));
    }

    public function create_deceased_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_deceased_type')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Deceased_Type'  => $data['Deceased_TypeX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_deceased_type_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_bips_deceased_type')->where('Deceased_Type_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_deceased_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_deceased_type')->where('Deceased_Type_ID',$data['Deceased_Type_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Deceased_Type'  => $data['Deceased_TypeX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Civil Status
    public function civil_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_civil_status')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bips_civil_status',compact('db_entries','currDATE'));
    }

    public function create_civil_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_civil_status')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Civil_Status'  => $data['Civil_StatusX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_civil_status_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_bips_civil_status')->where('Civil_Status_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_civil_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_civil_status')->where('Civil_Status_ID',$data['Civil_Status_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Civil_Status'  => $data['Civil_StatusX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Name Prefix
    public function name_prefix_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_name_prefix')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bips_name_prefix',compact('db_entries','currDATE'));
    }

    public function create_name_prefix_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_name_prefix')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Name_Prefix'  => $data['Name_PrefixX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_name_prefix_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_bips_name_prefix')->where('Name_Prefix_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_name_prefix_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_name_prefix')->where('Name_Prefix_ID',$data['Name_Prefix_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Name_Prefix'  => $data['Name_PrefixX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Family Position
    public function family_position_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_family_position')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bips_family_position',compact('db_entries','currDATE'));
    }

    public function create_family_position_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_family_position')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Family_Position'  => $data['Family_PositionX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_family_position_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_bips_family_position')->where('Family_Position_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_family_position_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_family_position')->where('Family_Position_ID',$data['Family_Position_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Family_Position'  => $data['Family_PositionX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Academic Level
    public function academic_level_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_academic_level')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bips_academic_level',compact('db_entries','currDATE'));
    }

    public function create_academic_level_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_academic_level')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Academic_Level'  => $data['Academic_LevelX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_academic_level_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_bips_academic_level')->where('Academic_Level_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_academic_level_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_academic_level')->where('Academic_Level_ID',$data['Academic_Level_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Academic_Level'  => $data['Academic_LevelX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Housing Unit
    public function housing_unit_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_housing_unit')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bips_housing_unit',compact('db_entries','currDATE'));
    }

    public function create_housing_unit_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_housing_unit')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Housing_Unit'  => $data['Housing_UnitX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_housing_unit_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_bips_housing_unit')->where('Housing_Unit_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_housing_unit_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_housing_unit')->where('Housing_Unit_ID',$data['Housing_Unit_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Housing_Unit'  => $data['Housing_UnitX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Religion
    public function religion_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_religion')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bips_religion',compact('db_entries','currDATE'));
    }

    public function create_religion_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_religion')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Religion'  => $data['ReligionX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_religion_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_bips_religion')->where('Religion_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_religion_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_religion')->where('Religion_ID',$data['Religion_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Religion'  => $data['ReligionX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Family Type
    public function family_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_family_type')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bips_family_type',compact('db_entries','currDATE'));
    }

    public function create_family_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_family_type')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Family_Type_Name'  => $data['Family_TypeX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_family_type_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_bips_family_type')->where('Family_Type_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_family_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_family_type')->where('Family_Type_ID',$data['Family_Type_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Family_Type_Name'  => $data['Family_TypeX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Employment Type
    public function employment_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_employment_type')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bips_employment_type',compact('db_entries','currDATE'));
    }

    public function create_employment_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_employment_type')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Employment_Type'  => $data['Employment_TypeX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_employment_type_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_bips_employment_type')->where('Employment_Type_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_employment_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_employment_type')->where('Employment_Type_ID',$data['Employment_Type_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Employment_Type'  => $data['Employment_TypeX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Tenure of Lot
    public function tenure_of_lot_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_tenure_of_lot')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bips_tenure_of_lot',compact('db_entries','currDATE'));
    }

    public function create_tenure_of_lot_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_tenure_of_lot')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Tenure_of_Lot'  => $data['Tenure_of_LotX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_tenure_of_lot_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_bips_tenure_of_lot')->where('Tenure_of_Lot_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_tenure_of_lot_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_tenure_of_lot')->where('Tenure_of_Lot_ID',$data['Tenure_of_Lot_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Tenure_of_Lot'  => $data['Tenure_of_LotX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Name Suffix
    public function name_suffix_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_name_suffix')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bips_name_suffix',compact('db_entries','currDATE'));
    }

    public function create_name_suffix_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_name_suffix')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Name_Suffix'  => $data['Name_SuffixX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_name_suffix_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_bips_name_suffix')->where('Name_Suffix_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_name_suffix_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_name_suffix')->where('Name_Suffix_ID',$data['Name_Suffix_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Name_Suffix'  => $data['Name_SuffixX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Project Type
    public function project_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bpms_project_type')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bpms_project_type',compact('db_entries','currDATE'));
    }

    public function create_project_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bpms_project_type')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Project_Type_Name'  => $data['Project_TypeX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_project_type_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_bpms_project_type')->where('Project_Type_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_project_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bpms_project_type')->where('Project_Type_ID',$data['Project_Type_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Project_Type_Name'  => $data['Project_TypeX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Accomplishment Status
    public function accomplishment_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bpms_accomplishment_status')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bpms_accomplishment_status',compact('db_entries','currDATE'));
    }

    public function create_accomplishment_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bpms_accomplishment_status')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Accomplishment_Status_Name'  => $data['Accomplishment_StatusX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_accomplishment_status_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_bpms_accomplishment_status')->where('Accomplishment_Status_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_accomplishment_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bpms_accomplishment_status')->where('Accomplishment_Status_ID',$data['Accomplishment_Status_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Accomplishment_Status_Name'  => $data['Accomplishment_StatusX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Project Status
    public function project_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bpms_project_status')->paginate(20,['*'], 'db_entries');

        return view('maintenance.bpms_project_status',compact('db_entries','currDATE'));
    }

    public function create_project_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bpms_project_status')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Project_Status_Name'  => $data['Project_StatusX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_project_status_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_bpms_project_status')->where('Project_Status_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_project_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bpms_project_status')->where('Project_Status_ID',$data['Project_Status_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Project_Status_Name'  => $data['Project_StatusX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Type of Ordinance 
    public function type_of_ordinance_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_boris_type_of_ordinance')->paginate(20,['*'], 'db_entries');

        return view('maintenance.boris_type_of_ordinance',compact('db_entries','currDATE'));
    }

    public function create_type_of_ordinance_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_boris_type_of_ordinance')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Type_of_Ordinance'  => $data['Type_of_OrdinanceX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_type_of_ordinance_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_boris_type_of_ordinance')->where('Type_of_Ordinance_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_type_of_ordinance_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_boris_type_of_ordinance')->where('Type_of_Ordinance_ID',$data['Type_of_Ordinance_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Type_of_Ordinance'  => $data['Type_of_OrdinanceX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Ordinance Category
    public function ordinance_category_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_boris_ordinance_category')->paginate(20,['*'], 'db_entries');

        return view('maintenance.boris_ordinance_category',compact('db_entries','currDATE'));
    }

    public function create_ordinance_category_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_boris_ordinance_category')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Ordinance_Category_Name'  => $data['Ordinance_CategoryX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_ordinance_category_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_boris_ordinance_category')->where('Ordinance_Category_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_ordinance_category_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_boris_ordinance_category')->where('Ordinance_Category_ID',$data['Ordinance_Category_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Ordinance_Category_Name'  => $data['Ordinance_CategoryX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Status of Ordinance
    public function status_of_ordinance_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_boris_status_of_ordinance')->paginate(20,['*'], 'db_entries');

        return view('maintenance.boris_status_of_ordinance',compact('db_entries','currDATE'));
    }

    public function create_status_of_ordinance_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_boris_status_of_ordinance')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Status_of_Ordinance_Name'  => $data['Status_of_OrdinanceX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_status_of_ordinance_maint(Request $request)
    {
        $id=$_GET['id'];

        $theEntry=DB::table('maintenance_boris_status_of_ordinance')->where('Status_of_Ordinance_ID',$id)->get();

        return(compact('theEntry'));
    }
    public function update_status_of_ordinance_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_boris_status_of_ordinance')->where('Status_of_Ordinance_ID',$data['Status_of_Ordinance_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Status_of_Ordinance_Name'  => $data['Status_of_OrdinanceX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }
}