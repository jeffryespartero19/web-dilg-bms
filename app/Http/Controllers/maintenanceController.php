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
        $db_entries = DB::table('maintenance_brgy_web_announcement_status')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.barangay_web_announcement_status', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_bweb_ann_status_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_brgy_web_announcement_status')->where('Announcement_Status_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_bweb_ann_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_brgy_web_announcement_status')->where('Announcement_Status_ID', $data['Announcement_Status_idX'])->update(
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
        $db_entries = DB::table('maintenance_bips_blood_type')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bips_blood_type', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    public function get_blood_type_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bips_blood_type')->where('Blood_Type_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_blood_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bips_blood_type')->where('Blood_Type_ID', $data['Blood_Type_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Blood_Type'  => $data['Blood_TypeX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }



    //Announcement Type Maintenance
    public function bweb_ann_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_brgy_web_announcement_type')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.barangay_web_announcement_type', compact('db_entries', 'currDATE'));
    }

    public function create_bweb_ann_type_maint(Request $request)

    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_brgy_web_announcement_type')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Announcement_Type_Name'  => $data['Announcement_Type_NameX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    public function get_bweb_ann_type_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_brgy_web_announcement_type')->where('Announcement_Type_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_bweb_ann_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_brgy_web_announcement_type')->where('Announcement_Type_ID', $data['Announcement_Type_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Announcement_Type_Name'  => $data['Announcement_Type_NameX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }


    //Deceased Type
    public function deceased_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_deceased_type')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bips_deceased_type', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_deceased_type_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bips_deceased_type')->where('Deceased_Type_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_deceased_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bips_deceased_type')->where('Deceased_Type_ID', $data['Deceased_Type_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Deceased_Type'  => $data['Deceased_TypeX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }


    //News Status Maintenance
    public function bweb_news_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_brgy_web_news_status')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.barangay_web_news_status', compact('db_entries', 'currDATE'));
    }

    public function create_bweb_news_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('maintenance_brgy_web_news_status')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'News_Status'      => $data['News_StatusX'],
                'Active'           => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    public function get_bweb_news_status_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_brgy_web_news_status')->where('News_Status_ID', $id)->get();

        return (compact('theEntry'));
    }

    public function update_bweb_news_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_brgy_web_news_status')->where('News_Status_ID', $data['News_Status_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'News_Status'      => $data['News_StatusX2'],
                'Active'           => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Civil Status
    public function civil_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_civil_status')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bips_civil_status', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    public function get_civil_status_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bips_civil_status')->where('Civil_Status_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_civil_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bips_civil_status')->where('Civil_Status_ID', $data['Civil_Status_idX'])->update(
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
        $db_entries = DB::table('maintenance_bips_name_prefix')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bips_name_prefix', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_name_prefix_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bips_name_prefix')->where('Name_Prefix_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_name_prefix_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_name_prefix')->where('Name_Prefix_ID', $data['Name_Prefix_idX'])->update(
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
        $db_entries = DB::table('maintenance_bips_family_position')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bips_family_position', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_family_position_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bips_family_position')->where('Family_Position_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_family_position_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_family_position')->where('Family_Position_ID', $data['Family_Position_idX'])->update(
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
        $db_entries = DB::table('maintenance_bips_academic_level')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bips_academic_level', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_academic_level_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bips_academic_level')->where('Academic_Level_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_academic_level_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_academic_level')->where('Academic_Level_ID', $data['Academic_Level_idX'])->update(
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
        $db_entries = DB::table('maintenance_bips_housing_unit')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bips_housing_unit', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_housing_unit_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bips_housing_unit')->where('Housing_Unit_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_housing_unit_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_housing_unit')->where('Housing_Unit_ID', $data['Housing_Unit_idX'])->update(
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
        $db_entries = DB::table('maintenance_bips_religion')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bips_religion', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_religion_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bips_religion')->where('Religion_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_religion_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_religion')->where('Religion_ID', $data['Religion_idX'])->update(
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
        $db_entries = DB::table('maintenance_bips_family_type')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bips_family_type', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_family_type_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bips_family_type')->where('Family_Type_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_family_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_family_type')->where('Family_Type_ID', $data['Family_Type_idX'])->update(
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
        $db_entries = DB::table('maintenance_bips_employment_type')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bips_employment_type', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_employment_type_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bips_employment_type')->where('Employment_Type_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_employment_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_employment_type')->where('Employment_Type_ID', $data['Employment_Type_idX'])->update(
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
        $db_entries = DB::table('maintenance_bips_tenure_of_lot')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bips_tenure_of_lot', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_tenure_of_lot_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bips_tenure_of_lot')->where('Tenure_of_Lot_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_tenure_of_lot_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_tenure_of_lot')->where('Tenure_of_Lot_ID', $data['Tenure_of_Lot_idX'])->update(
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
        $db_entries = DB::table('maintenance_bips_name_suffix')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bips_name_suffix', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_name_suffix_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bips_name_suffix')->where('Name_Suffix_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_name_suffix_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_name_suffix')->where('Name_Suffix_ID', $data['Name_Suffix_idX'])->update(
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
        // $db_entries = DB::table('maintenance_bpms_project_type')->paginate(20, ['*'], 'db_entries');
        $db_entries = DB::table('maintenance_bpms_project_type as a')
        ->select(
            'a.Project_Type_ID',
            'a.Project_Type_Name',
            DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),
            'a.Encoder_ID',
            'a.Date_Stamp',

        )
        ->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bpms_project_type', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_project_type_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bpms_project_type')->where('Project_Type_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_project_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bpms_project_type')->where('Project_Type_ID', $data['Project_Type_idX'])->update(
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
        // $db_entries = DB::table('maintenance_bpms_accomplishment_status')->paginate(20, ['*'], 'db_entries');
        $db_entries = DB::table('maintenance_bpms_accomplishment_status as a')
        ->select(
            'a.Accomplishment_Status_ID',
            'a.Accomplishment_Status_Name',
            DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),
            'a.Encoder_ID',
            'a.Date_Stamp',

        )
        ->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bpms_accomplishment_status', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_accomplishment_status_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bpms_accomplishment_status')->where('Accomplishment_Status_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_accomplishment_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bpms_accomplishment_status')->where('Accomplishment_Status_ID', $data['Accomplishment_Status_idX'])->update(
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
        // $db_entries = DB::table('maintenance_bpms_project_status')->paginate(20, ['*'], 'db_entries');
        $db_entries = DB::table('maintenance_bpms_project_status as a')
        ->select(
            'a.Project_Status_ID',
            'a.Project_Status_Name',
            DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),
            'a.Encoder_ID',
            'a.Date_Stamp',

        )
        ->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bpms_project_status', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_project_status_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bpms_project_status')->where('Project_Status_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_project_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bpms_project_status')->where('Project_Status_ID', $data['Project_Status_idX'])->update(
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
        $db_entries = DB::table('maintenance_boris_type_of_ordinance_or_resolution')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.boris_type_of_ordinance', compact('db_entries', 'currDATE'));
    }

    public function create_type_of_ordinance_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_boris_type_of_ordinance_or_resolution')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Name_of_Type'  => $data['Type_of_OrdinanceX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_type_of_ordinance_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_boris_type_of_ordinance_or_resolution')->where('Type_of_Ordinance_or_Resolution_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_type_of_ordinance_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_boris_type_of_ordinance_or_resolution')->where('Type_of_Ordinance_or_Resolution_ID', $data['Type_of_Ordinance_or_Resolution_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Name_of_Type'  => $data['Type_of_OrdinanceX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Ordinance Category
    public function ordinance_category_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_boris_ordinance_category')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.boris_ordinance_category', compact('db_entries', 'currDATE'));
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

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_ordinance_category_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_boris_ordinance_category')->where('Ordinance_Category_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_ordinance_category_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_boris_ordinance_category')->where('Ordinance_Category_ID', $data['Ordinance_Category_idX'])->update(
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
        $db_entries = DB::table('maintenance_boris_status_of_ordinance_or_resolution')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.boris_status_of_ordinance', compact('db_entries', 'currDATE'));
    }

    public function create_status_of_ordinance_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_boris_status_of_ordinance_or_resolution')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Name_of_Status'  => $data['Status_of_OrdinanceX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_status_of_ordinance_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_boris_status_of_ordinance_or_resolution')->where('Status_of_Ordinance_or_Resolution_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_status_of_ordinance_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        // dd($data);

        DB::table('maintenance_boris_status_of_ordinance_or_resolution')->where('Status_of_Ordinance_or_Resolution_ID', $data['Status_of_Ordinance_or_Resolution_IDX2'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Name_of_Status'  => $data['Status_of_OrdinanceX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Alert Level
    public function alert_level_maint(Request $request)
    {
        $currDATE = Carbon::now();
        // $db_entries = DB::table('maintenance_bdris_alert_level')->paginate(20, ['*'], 'db_entries');
        $db_entries = DB::table('maintenance_bdris_alert_level as a')
        ->select(
            'a.Alert_Level_ID',
            'a.Alert_Level',
            DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),
            'a.Encoder_ID',
            'a.Date_Stamp',

        )
        ->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bdris_alert_level', compact('db_entries', 'currDATE'));
    }

    public function create_alert_level_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bdris_alert_level')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Alert_Level'  => $data['Alert_LevelX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_alert_level_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bdris_alert_level')->where('Alert_Level_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_alert_level_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bdris_alert_level')->where('Alert_Level_ID', $data['Alert_Level_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Alert_Level'  => $data['Alert_LevelX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Level of Damage
    public function level_of_damage_maint(Request $request)
    {
        $currDATE = Carbon::now();
        // $db_entries = DB::table('maintenance_bdris_level_of_damage')->paginate(20, ['*'], 'db_entries');
        $db_entries = DB::table('maintenance_bdris_level_of_damage as a')
        ->select(
            'a.Level_of_Damage_ID',
            'a.Level_of_Damage',
            DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),
            'a.Encoder_ID',
            'a.Date_Stamp',

        )
        ->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bdris_level_of_damage', compact('db_entries', 'currDATE'));
    }

    public function create_level_of_damage_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bdris_level_of_damage')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Level_of_Damage'  => $data['Level_of_DamageX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_level_of_damage_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bdris_level_of_damage')->where('Level_of_Damage_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_level_of_damage_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bdris_level_of_damage')->where('Level_of_Damage_ID', $data['Level_of_Damage_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Level_of_Damage'  => $data['Level_of_DamageX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Casualty Status
    public function casualty_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        // $db_entries = DB::table('maintenance_bdris_casualty_status')->paginate(20, ['*'], 'db_entries');
        $db_entries = DB::table('maintenance_bdris_casualty_status as a')
        ->select(
            'a.Casualty_Status_ID',
            'a.Casualty_Status',
            DB::raw('(CASE WHEN a.Active = false THEN "False" ELSE "True" END) AS Active'),
            'a.Encoder_ID',
            'a.Date_Stamp',

        )
        ->paginate(20, ['*'], 'db_entries');
        return view('maintenance.bdris_casualty_status', compact('db_entries', 'currDATE'));
    }

    public function create_casualty_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bdris_casualty_status')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Casualty_Status'  => $data['Casualty_StatusX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_casualty_status_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bdris_casualty_status')->where('Casualty_Status_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_casualty_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bdris_casualty_status')->where('Casualty_Status_ID', $data['Casualty_Status_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Casualty_Status'  => $data['Casualty_StatusX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }



    //News Type Maintenance
    public function bweb_news_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_brgy_web_news_type')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.barangay_web_news_type', compact('db_entries', 'currDATE'));
    }

    public function create_bweb_news_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_brgy_web_news_type')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'News_Type_Name'  => $data['News_Type_NameX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }


    public function get_bweb_news_type_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_brgy_web_news_type')->where('News_Type_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_bweb_news_type_maint(Request $request)

    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_brgy_web_news_type')->where('News_Type_ID', $data['News_Type_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'News_Type_Name'  => $data['News_Type_NameX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }










    // BJISBH Maintenance
    //Case Type
    public function case_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bjisbh_case_type')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bjisbh_case_type', compact('db_entries', 'currDATE'));
    }

    public function create_case_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_case_type')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Case_Type_Name'  => $data['Case_Type_NameX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    public function get_case_type_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bjisbh_case_type')->where('Case_Type_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_case_type_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_case_type')->where('Case_Type_ID', $data['Case_Type_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Case_Type_Name'  => $data['Case_Type_NameX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Case
    public function case_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bjisbh_case')->paginate(20, ['*'], 'db_entries');
        $case_type = DB::table('maintenance_bjisbh_case_type')->get();

        return view('maintenance.bjisbh_case', compact('db_entries', 'currDATE', 'case_type'));
    }

    public function create_case_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_case')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Case_Name'  => $data['Case_NameX'],
                'Case_Type_ID' => $data['case_type_idX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    public function get_case_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bjisbh_case')->where('Case_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_case_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_case')->where('Case_ID', $data['Case_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Case_Name'  => $data['Case_NameX2'],
                'Case_Type_ID' => $data['case_type_idX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Type of Involved Party
    public function type_of_involved_party_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bjisbh_type_of_involved_party')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bjisbh_type_of_involved_party', compact('db_entries', 'currDATE'));
    }

    public function create_type_of_involved_party_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_type_of_involved_party')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Type_of_Involved_Party'  => $data['Type_of_Involved_PartyX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    public function get_type_of_involved_party_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bjisbh_type_of_involved_party')->where('Type_of_Involved_Party_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_type_of_involved_party_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_type_of_involved_party')->where('Type_of_Involved_Party_ID', $data['Type_of_Involved_Party_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Type_of_Involved_Party'  => $data['Type_of_Involved_PartyX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Violation Status
    public function violation_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bjisbh_violation_status')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bjisbh_violation_status', compact('db_entries', 'currDATE'));
    }

    public function create_violation_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_violation_status')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Violation_Status'  => $data['Violation_StatusX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    public function get_violation_status_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bjisbh_violation_status')->where('Violation_Status_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_violation_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_violation_status')->where('Violation_Status_ID', $data['Violation_Status_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Violation_Status'  => $data['Violation_StatusX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Summons Status
    public function summons_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bjisbh_summons_status')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bjisbh_summons_status', compact('db_entries', 'currDATE'));
    }

    public function create_summons_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_summons_status')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Type_of_Action'  => $data['Type_of_ActionX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    public function get_summons_status_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bjisbh_summons_status')->where('Summons_Status_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_summons_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_summons_status')->where('Summons_Status_ID', $data['Summons_Status_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Type_of_Action'  => $data['Type_of_ActionX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Service Rate
    public function service_rate_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bjisbh_service_rating')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bjisbh_service_rate', compact('db_entries', 'currDATE'));
    }

    public function create_service_rate_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_service_rating')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Service_Rate'  => $data['Service_RateX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    public function get_service_rate_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bjisbh_service_rating')->where('Service_Rate_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_service_rate_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_service_rating')->where('Service_Rate_ID', $data['Service_Rate_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Service_Rate'  => $data['Service_RateX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Proceedings Status
    public function proceedings_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bjisbh_proceedings_status')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bjisbh_proceedings_status', compact('db_entries', 'currDATE'));
    }

    public function create_proceedings_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_proceedings_status')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Type_of_Action'  => $data['Type_of_ActionX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    public function get_proceedings_status_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bjisbh_proceedings_status')->where('Proceedings_Status_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_proceedings_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_proceedings_status')->where('Proceedings_Status_ID', $data['Proceedings_Status_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Type_of_Action'  => $data['Type_of_ActionX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Type of Action
    public function type_of_action_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bjisbh_type_of_action')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bjisbh_type_of_action', compact('db_entries', 'currDATE'));
    }

    public function create_type_of_action_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_type_of_action')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Type_of_Action'  => $data['Type_of_ActionX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    public function get_type_of_action_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bjisbh_type_of_action')->where('Type_of_Action_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_type_of_action_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_type_of_action')->where('Type_of_Action_ID', $data['Type_of_Action_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Type_of_Action'  => $data['Type_of_ActionX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Type of Penalties
    public function type_of_penalties_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bjisbh_types_of_penalties')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bjisbh_type_of_penalties', compact('db_entries', 'currDATE'));
    }

    public function create_type_of_penalties_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_types_of_penalties')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Type_of_Penalties'  => $data['Type_of_PenaltiesX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    public function get_type_of_penalties_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bjisbh_types_of_penalties')->where('Types_of_Penalties_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_type_of_penalties_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_types_of_penalties')->where('Types_of_Penalties_ID', $data['Types_of_Penalties_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Type_of_Penalties'  => $data['Type_of_PenaltiesX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Blotter Status
    public function blotter_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bjisbh_blotter_status')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bjisbh_blotter_status', compact('db_entries', 'currDATE'));
    }

    public function create_blotter_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_blotter_status')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Blotter_Status_Name'  => $data['Blotter_Status_NameX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }

    public function get_blotter_status_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bjisbh_blotter_status')->where('Blotter_Status_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_blotter_status_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();
        DB::table('maintenance_bjisbh_blotter_status')->where('Blotter_Status_ID', $data['Blotter_Status_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Blotter_Status_Name'  => $data['Blotter_Status_NameX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Frequency
    public function frequency_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bis_frequency')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bis_frequency', compact('db_entries', 'currDATE'));
    }

    public function create_frequency_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bis_frequency')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Frequency'  => $data['FrequencyX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_frequency_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bis_frequency')->where('Frequency_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_frequency_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bis_frequency')->where('Frequency_ID', $data['Frequency_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Frequency'  => $data['FrequencyX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Categories
    public function categories_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bis_categories')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bis_categories', compact('db_entries', 'currDATE'));
    }

    public function create_categories_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bis_categories')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Categories'  => $data['CategoriesX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_categories_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bis_categories')->where('Categories_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_categories_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bis_categories')->where('Categories_ID', $data['Categories_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Categories'  => $data['CategoriesX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Brgy Position
    public function brgy_position_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_brgy_position')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bips_brgy_position', compact('db_entries', 'currDATE'));
    }

    public function create_brgy_position_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_brgy_position')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'created_at'       => Carbon::now(),
                'Brgy_Position'  => $data['Brgy_PositionX'],
                'Active'               => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert', 'New Entry Created');
    }
    public function get_brgy_position_maint(Request $request)
    {
        $id = $_GET['id'];

        $theEntry = DB::table('maintenance_bips_brgy_position')->where('Brgy_Position_ID', $id)->get();

        return (compact('theEntry'));
    }
    public function update_brgy_position_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_brgy_position')->where('Brgy_Position_ID', $data['Brgy_Position_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'created_at'       => Carbon::now(),
                'Brgy_Position'  => $data['Brgy_PositionX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    // //Term Status
    public function termstatus_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_bips_term_status')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.bis_termstatus', compact('db_entries', 'currDATE'));
    }

    public function create_termstatus_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('maintenance_bips_term_status')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Term_Status'  => $data['Term_StatusX'],
                'Active'           => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }
    public function get_termstatus_maint(Request $request)
    {
       $id=$_GET['id'];
        //$id=1;

        $theEntry=DB::table('maintenance_bips_term_status')->where('Term_Status_ID',$id)->get();

        return(compact('theEntry'));
    }

    public function update_termstatus_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        DB::table('maintenance_bips_term_status')->where('Term_Status_ID', $data['Term_Status_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Term_Status'  => $data['Term_StatusX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Country

    public function country_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_country')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.psgc_country', compact('db_entries', 'currDATE'));
    }

    public function create_country_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('maintenance_country')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Country'  => $data['CountryX'],
                'Country_Code_No'  => $data['Country_Code_NoX'],
                'Active'           => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }

    public function get_country_maint(Request $request)
    {
       $id=$_GET['id'];
        //$id=1;

        $theEntry=DB::table('maintenance_country')->where('Country_ID',$id)->get();

        return(compact('theEntry'));
    }

    public function update_country_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        // dd($data);

        DB::table('maintenance_country')->where('Country_ID', $data['Country_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Country'  => $data['CountryX2'],
                'Country_Code_No'  => $data['Country_Code_NoX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Region
    public function region_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_region')->paginate(20, ['*'], 'db_entries');

        return view('maintenance.psgc_region', compact('db_entries', 'currDATE'));
    }

    public function create_region_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('maintenance_region')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'PSGC_code'  => $data['PSGC_CodeX'],
                'Region_Name'  => $data['RegionX'],
                'Abbreviation'  => $data['AbbreviationX'],
                'Active'           => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }

    public function get_region_maint(Request $request)
    {
       $id=$_GET['id'];
        //$id=1;

        $theEntry=DB::table('maintenance_region')->where('Region_ID',$id)->get();

        return(compact('theEntry'));
    }

    public function update_region_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        // dd($data);

        DB::table('maintenance_region')->where('Region_ID', $data['Region_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'PSGC_code'  => $data['PSGC_CodeX2'],
                'Region_Name'  => $data['RegionX2'],
                'Abbreviation'  => $data['AbbreviationX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //Province
    public function province_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_province')->paginate(10000, ['*'], 'db_entries');
        $region = DB::table('maintenance_region')->get();
        
       // dd($region);

        return view('maintenance.psgc_province', compact('db_entries', 'currDATE', 'region'));
    }

    public function create_province_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('maintenance_province')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'PSGC_code'  => $data['PSGC_CodeX'],
                'Province_Name'  => $data['ProvinceX'],
                'Region_ID'  => $data['Region_IDX'],
                'Active'           => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }

    public function get_province_maint(Request $request)
    {
       $id=$_GET['id'];
        //$id=1;

        // $theEntry=DB::table('maintenance_province')->where('Province_ID',$id)->get();
        $theEntry = DB::table('maintenance_province')
                ->join('maintenance_region', 'maintenance_region.Region_ID', '=', 'maintenance_province.Region_ID')
                ->where('Province_ID', $id)->get();
        $region2 = DB::table('maintenance_region')->get();
        // dd($theEntry);
        return(compact('theEntry','region2'));
    }

    public function update_province_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        //  dd($data);

        DB::table('maintenance_province')->where('Province_ID', $data['Province_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'PSGC_code'  => $data['PSGC_CodeX2'],
                'Province_Name'  => $data['ProvinceX2'],
                'Region_ID'  => $data['Region_IDX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

    //City 
    public function city_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_city_municipality')->paginate(10000, ['*'], 'db_entries');
        $region = DB::table('maintenance_region')->get();
        $province = DB::table('maintenance_province')->get();
        
       // dd($region);

        return view('maintenance.psgc_city', compact('db_entries', 'currDATE', 'region', 'province'));
    }

    public function create_city_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('maintenance_city_municipality')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Region_ID'  => $data['Region_IDX'],
                'Province_ID'  => $data['Province_IDX'],
                'PSGC_code'  => $data['PSGC_CodeX'],
                'City_Municipality_Name'  => $data['City_MunicipalityX'],
                'Zip_Code'  => $data['Zip_CodeX'],
                'LGU_Type'  => $data['LGU_TypeX'],
                'District'  => $data['DistrictX'],
                'Active'           => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }

    public function get_city_maint(Request $request)
    {
       $id=$_GET['id'];
        //$id=1;

        // $theEntry=DB::table('maintenance_city_municipality')->where('City_Municipality_ID',$id)->get();
        $theEntry = DB::table('maintenance_city_municipality')
                ->join('maintenance_region', 'maintenance_region.Region_ID', '=', 'maintenance_city_municipality.Region_ID')
                ->join('maintenance_province', 'maintenance_province.Province_ID', '=', 'maintenance_city_municipality.Province_ID')
                ->where('City_Municipality_ID', $id)->get();
        $region2 = DB::table('maintenance_region')->get();
        
        // dd($theEntry);
        return(compact('theEntry','region2'));
    }

    public function update_city_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        //  dd($data);

        DB::table('maintenance_city_municipality')->where('City_Municipality_ID', $data['City_Municipality_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Region_ID'  => $data['Region_IDX2'],
                'Province_ID'  => $data['Province_IDX2'],
                'PSGC_code'  => $data['PSGC_CodeX2'],
                'City_Municipality_Name'  => $data['City_MunicipalityX2'],
                'Zip_Code'  => $data['Zip_CodeX2'],
                'LGU_Type'  => $data['LGU_TypeX2'],
                'District'  => $data['DistrictX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }
    

    //Barangay
    public function barangay_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $db_entries = DB::table('maintenance_barangay')
        // ->orderby('Barangay_ID', 'desc')->paginate(20, ['*'], 'db_entries');
        ->paginate(1000, ['*'], 'db_entries');
        $region = DB::table('maintenance_region')->get();
        
       // dd($region);

        return view('maintenance.psgc_barangay', compact('db_entries', 'currDATE', 'region'));
    }

    public function create_barangay_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        DB::table('maintenance_barangay')->insert(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Region_ID'  => $data['Region_IDX'],
                'Province_ID'  => $data['Province_IDX'],
                'City_Municipality_ID'  => $data['City_Municipality_IDX'],
                'Barangay_Name'  => $data['BarangayX'],
                'Active'           => (int)$data['ActiveX']
            )
        );

        return redirect()->back()->with('alert','New Entry Created');
    }

    public function get_barangay_maint(Request $request)
    {
       $id=$_GET['id'];
        //$id=1;

        // $theEntry=DB::table('maintenance_barangay')->where('Barangay_ID',$id)->get();
        $theEntry = DB::table('maintenance_barangay')
                ->join('maintenance_region', 'maintenance_region.Region_ID', '=', 'maintenance_barangay.Region_ID')
                ->join('maintenance_province', 'maintenance_province.Province_ID', '=', 'maintenance_barangay.Province_ID')
                ->join('maintenance_city_municipality', 'maintenance_city_municipality.City_Municipality_ID', '=', 'maintenance_barangay.City_Municipality_ID')
                ->where('Barangay_ID', $id)->get();
        $region2 = DB::table('maintenance_region')->get();
        
        // dd($theEntry);
        return(compact('theEntry','region2'));
    }

    public function update_barangay_maint(Request $request)
    {
        $currDATE = Carbon::now();
        $data = $data = request()->all();

        //  dd($data);

        DB::table('maintenance_barangay')->where('Barangay_ID', $data['Barangay_idX'])->update(
            array(
                'Encoder_ID'       => Auth::user()->id,
                'Date_Stamp'       => Carbon::now(),
                'Region_ID'  => $data['Region_IDX2'],
                'Province_ID'  => $data['Province_IDX2'],
                'City_Municipality_ID'  => $data['City_Municipality_IDX2'],
                'Barangay_Name'  => $data['BarangayX2'],
                'Active'               => (int)$data['ActiveX2']
            )
        );

        return redirect()->back()->with('alert', 'Updated Entry');
    }

}
