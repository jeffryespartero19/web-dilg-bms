<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\File;
use PDF;

class BISController extends Controller
{
    //BIPS TRANSACTIONS

    //Inhabitants Information List
    public function cms_list(Request $request)
    {
        $currDATE = Carbon::now();


        if (Auth::user()->User_Type_ID == 3) {
            $db_entries = DB::table('bis_cms_barangay_profile')
                ->where('Barangay_ID', Auth::user()->Barangay_ID)
                ->paginate(20, ['*'], 'db_entries');

            return view('bis_transactions.cms_list_dilg_user', compact(
                'db_entries',
                'currDATE'
            ));
        } else {
            $db_entries = DB::table('bis_cms_barangay_profile')
                ->paginate(20, ['*'], 'db_entries');

            return view('bis_transactions.cms_list', compact(
                'db_entries',
                'currDATE'
            ));
        }
    }


    //CMS Details
    public function cms_details($id)
    {
        $currDATE = Carbon::now();

        if (Auth::user()->User_Type_ID == 3) {
            if ($id != 0) {
                $Barangay_Profile = DB::table('bis_cms_barangay_profile')
                    ->where('CMS_Barangay_Profile_ID', $id)

                    ->get();
                $categories = DB::table('maintenance_bis_categories')->where('Active', 1)->get();
                $frequency = DB::table('maintenance_bis_frequency')->where('Active', 1)->get();
                $region = DB::table('maintenance_region')->where('Active', 1)->get();
                $province = DB::table('maintenance_province')->get();
                $city_municipality = DB::table('maintenance_city_municipality')->get();
                $barangay = DB::table('maintenance_barangay')->get();
                $bp_categories = DB::table('bis_cms_barangay_profile_categories as a')
                    ->leftjoin('maintenance_bis_categories as b', 'a.Categories_ID', '=', 'b.Categories_ID')
                    ->select('a.Categories_ID', 'b.Categories', 'a.CMS_Barangay_Profile_ID')
                    ->where('a.CMS_Barangay_Profile_ID', $id)
                    ->get();

                $bp_title = DB::table('bis_cms_title')
                    ->select('Categories_ID', 'Title_ID', 'Title')
                    ->where('CMS_Barangay_Profile_ID', $id)
                    ->get();

                $bp_indicator = DB::table('bis_cms_indicator as a')
                    ->leftjoin('bis_cms_title as b', 'a.Title_ID', '=', 'b.Title_ID')
                    ->select('a.Indicator_Description', 'a.Indicator_ID', 'b.Categories_ID', 'b.Title_ID')
                    ->where('b.CMS_Barangay_Profile_ID', $id)
                    ->get();

                $bp_answers = DB::table('bis_cms_indicator_answer as a')
                    ->leftjoin('bis_cms_indicator as b', 'a.Indicator_ID', '=', 'b.Indicator_ID')
                    ->leftjoin('bis_cms_title as c', 'b.Title_ID', '=', 'c.Title_ID')
                    ->select('a.Indicator_ID', 'a.Answer')
                    ->where('c.CMS_Barangay_Profile_ID', $id)
                    ->where('a.Encoder_ID', Auth::user()->id)
                    ->get();

                return view('bis_transactions.cms_details_dilg_user', compact(
                    'currDATE',
                    'frequency',
                    'categories',
                    'region',
                    'province',
                    'city_municipality',
                    'barangay',
                    'Barangay_Profile',
                    'bp_categories',
                    'bp_title',
                    'bp_indicator',
                    'bp_answers'
                ));
            }
        } else {
            if ($id == 0) {
                $Barangay_Profile = collect([
                    (object) [
                        'CMS_Barangay_Profile_ID' => '0',
                        'Title' => '',
                        'Description' => '',
                        'Date_Updated' => '',
                        'Frequency_ID' => '',
                        'Status' => '',
                        'Categories_ID' => '',
                        'Barangay_ID' => '',
                        'City_Municipality_ID' => '',
                        'Province_ID' => '',
                        'Region_ID' => '',
                    ],
                ]);
                $categories = DB::table('maintenance_bis_categories')->where('Active', 1)->get();
                $frequency = DB::table('maintenance_bis_frequency')->where('Active', 1)->get();
                $region = DB::table('maintenance_region')->where('Active', 1)->get();
                $province = DB::table('maintenance_province')->get();
                $city_municipality = DB::table('maintenance_city_municipality')->get();
                $barangay = DB::table('maintenance_barangay')->get();
                $bp_categories = collect([
                    (object) [
                        'Categories_ID' => '0',
                        'Categories' => ''
                    ],
                ]);
                return view('bis_transactions.cms_details', compact(
                    'currDATE',
                    'frequency',
                    'categories',
                    'region',
                    'province',
                    'city_municipality',
                    'barangay',
                    'Barangay_Profile',
                    'bp_categories'
                ));
            } else {
                $Barangay_Profile = DB::table('bis_cms_barangay_profile')->where('CMS_Barangay_Profile_ID', $id)->get();
                $categories = DB::table('maintenance_bis_categories')->where('Active', 1)->get();
                $frequency = DB::table('maintenance_bis_frequency')->where('Active', 1)->get();
                $region = DB::table('maintenance_region')->where('Active', 1)->get();
                $province = DB::table('maintenance_province')->get();
                $city_municipality = DB::table('maintenance_city_municipality')->get();
                $barangay = DB::table('maintenance_barangay')->get();
                $bp_categories = DB::table('bis_cms_barangay_profile_categories as a')
                    ->leftjoin('maintenance_bis_categories as b', 'a.Categories_ID', '=', 'b.Categories_ID')
                    ->select('a.Categories_ID', 'b.Categories', 'a.CMS_Barangay_Profile_ID')
                    ->where('a.CMS_Barangay_Profile_ID', $id)
                    ->get();
                return view('bis_transactions.cms_details', compact(
                    'currDATE',
                    'frequency',
                    'categories',
                    'region',
                    'province',
                    'city_municipality',
                    'barangay',
                    'Barangay_Profile',
                    'bp_categories'
                ));
            }
        }
    }

    // Save CMS Info
    public function create_cms(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();

        if ($data['CMS_Barangay_Profile_ID'] == 0 || $data['CMS_Barangay_Profile_ID'] == null) {
            $CMS_Barangay_Profile_ID = DB::table('bis_cms_barangay_profile')->insertGetId(
                array(
                    'Title' => $data['Title'],
                    'Description' => $data['Description'],
                    'Date_Updated' => $data['Date_Updated'],
                    'Frequency_ID' => $data['Frequency_ID'],
                    'Status' => $data['Status'],
                    'Barangay_ID' => $data['Barangay_ID'],
                    'City_Municipality_ID' => $data['City_Municipality_ID'],
                    'Province_ID' => $data['Province_ID'],
                    'Region_ID' => $data['Region_ID'],
                    'Encoder_ID' => Auth::user()->id,
                    'Date_Stamp' => Carbon::now()
                )
            );

            if (isset($data['Categories_ID'])) {
                $categories = [];

                for ($i = 0; $i < count($data['Categories_ID']); $i++) {
                    if ($data['Categories_ID'][$i] != NULL) {

                        $id = 0 + DB::table('bis_cms_barangay_profile_categories')->max('Barangay_Profile_Categories_ID');
                        $id += 1;

                        $categories = [
                            'CMS_Barangay_Profile_ID' => $CMS_Barangay_Profile_ID,
                            'Categories_ID' => $data['Categories_ID'][$i],
                            'Encoder_ID'       => Auth::user()->id,
                            'Date_Stamp'       => Carbon::now()
                        ];

                        DB::table('bis_cms_barangay_profile_categories')->updateOrInsert(['Barangay_Profile_Categories_ID' => $id], $categories);
                    }
                }
            }

            return redirect()->to('cms_details/' . $CMS_Barangay_Profile_ID)->with('message', 'New Barangay Profile Created');
        } else {
            DB::table('bis_cms_barangay_profile')->where('CMS_Barangay_Profile_ID', $data['CMS_Barangay_Profile_ID'])->update(
                array(
                    'Title' => $data['Title'],
                    'Description' => $data['Description'],
                    'Date_Updated' => $data['Date_Updated'],
                    'Frequency_ID' => $data['Frequency_ID'],
                    'Status' => $data['Status'],
                    'Barangay_ID' => $data['Barangay_ID'],
                    'City_Municipality_ID' => $data['City_Municipality_ID'],
                    'Province_ID' => $data['Province_ID'],
                    'Region_ID' => $data['Region_ID'],
                    'Encoder_ID' => Auth::user()->id,
                    'Date_Stamp' => Carbon::now()
                )
            );

            DB::table('bis_cms_barangay_profile_categories')
                ->where('CMS_Barangay_Profile_ID', $data['CMS_Barangay_Profile_ID'])
                ->delete();

            if (isset($data['Categories_ID'])) {
                $categories = [];

                for ($i = 0; $i < count($data['Categories_ID']); $i++) {
                    if ($data['Categories_ID'][$i] != NULL) {

                        $id = 0 + DB::table('bis_cms_barangay_profile_categories')->max('Barangay_Profile_Categories_ID');
                        $id += 1;

                        $categories = [
                            'CMS_Barangay_Profile_ID' => $data['CMS_Barangay_Profile_ID'],
                            'Categories_ID' => $data['Categories_ID'][$i],
                            'Encoder_ID'       => Auth::user()->id,
                            'Date_Stamp'       => Carbon::now()
                        ];

                        DB::table('bis_cms_barangay_profile_categories')->updateOrInsert(['Barangay_Profile_Categories_ID' => $id], $categories);
                    }
                }
            }

            return redirect()->to('cms_details/' . $data['CMS_Barangay_Profile_ID'])->with('message', 'Barangay Profile Updated');
        }
    }

    //CMS Details
    public function cms_indicator($id, $cat_id)
    {
        $currDATE = Carbon::now();

        if (Auth::user()->User_Type_ID == 3) {
            if ($id != 0) {
                $title = DB::table('bis_cms_title')->where('CMS_Barangay_Profile_ID', $id)
                    ->where('Categories_ID', $cat_id)
                    ->get();
                $indicator = DB::table('bis_cms_indicator as a')
                    ->leftjoin('bis_cms_title as b', 'a.Title_ID', '=', 'b.Title_ID')
                    ->leftjoin('bis_cms_answer_types as c', 'a.Answer_Types_ID', '=', 'c.Answer_Type_ID')
                    ->select(
                        'a.Indicator_ID',
                        'a.Title_ID',
                        'a.Answer_Types_ID',
                        'a.Indicator_Description',
                        'a.Min_Answer',
                        'a.Max_Answer',
                        'c.Widget'
                    )
                    ->where('b.CMS_Barangay_Profile_ID', $id)
                    ->get();

                $answer_classification = DB::table('bis_cms_answer_classification as a')
                    ->leftjoin('bis_cms_indicator as b', 'a.Indicator_ID', '=', 'b.Indicator_ID')
                    ->leftjoin('bis_cms_title as c', 'c.Title_ID', '=', 'b.Title_ID')
                    ->select(
                        'a.Indicator_ID',
                        'a.Answer',
                        'a.Answer_Classification_ID'
                    )
                    ->where('c.CMS_Barangay_Profile_ID', $id)
                    ->get();

                $answer_type = DB::table('bis_cms_answer_types')->where('Active', 1)->get();

                return view('bis_transactions.cms_indicator_dilg_user', compact(
                    'title',
                    'id',
                    'answer_type',
                    'indicator',
                    'cat_id',
                    'answer_classification'
                ));
            }
        } else {
            if ($id == 0) {
                $title = collect([
                    (object) [
                        'Title_ID' => 0,
                        'CMS_Barangay_Profile_ID' => '',
                        'Title' => '',
                        'Visible' => '',
                        'Instructions' => '',
                        'Min_Indicator' => '',
                        'Max_Indicator' => ''
                    ],
                ]);
                $indicator = collect([
                    (object) [
                        'Indicator_ID' => '0',
                        'Title_ID' => '0',
                        'Answer_Types_ID' => '',
                        'Indicator_Description' => '',
                        'Min_Answer' => '',
                        'Max_Answer' => '',
                    ],
                ]);

                $answer_classification = collect([
                    (object) [
                        'Indicator_ID' => '0',
                        'Answer' => '',
                        'Answer_Classification_ID' => ''
                    ],
                ]);
                $answer_type = DB::table('bis_cms_answer_types')->where('Active', 1)->get();

                return view('bis_transactions.cms_indicator', compact(
                    'title',
                    'id',
                    'answer_type',
                    'indicator',
                    'cat_id',
                    'answer_classification'
                ));
            } else {
                $title = DB::table('bis_cms_title')->where('CMS_Barangay_Profile_ID', $id)
                    ->where('Categories_ID', $cat_id)
                    ->get();
                $indicator = DB::table('bis_cms_indicator as a')
                    ->leftjoin('bis_cms_title as b', 'a.Title_ID', '=', 'b.Title_ID')
                    ->leftjoin('bis_cms_answer_types as c', 'a.Answer_Types_ID', '=', 'c.Answer_Type_ID')
                    ->select(
                        'a.Indicator_ID',
                        'a.Title_ID',
                        'a.Answer_Types_ID',
                        'a.Indicator_Description',
                        'a.Min_Answer',
                        'a.Max_Answer',
                        'c.Widget'
                    )
                    ->where('b.CMS_Barangay_Profile_ID', $id)
                    ->get();
                $answer_type = DB::table('bis_cms_answer_types')->where('Active', 1)->get();

                return view('bis_transactions.cms_indicator', compact(
                    'title',
                    'id',
                    'answer_type',
                    'indicator',
                    'cat_id'
                ));
            }
        }
    }

    // Create CMS Title
    public function create_cms_title(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();
        // dd($data);

        if (isset($data['Title_ID'])) {
            $title = [];

            for ($i = 0; $i < count($data['Title_ID']); $i++) {
                $ID = $data['Title_ID'][$i];
                if ($ID == 0) {

                    if ($data['Title'][$i] != null) {

                        $Title_ID = DB::table('bis_cms_title')->insertGetId(
                            array(
                                'Title' => $data['Title'][$i],
                                'CMS_Barangay_Profile_ID' => $data['CMS_Barangay_Profile_ID'],
                                'Categories_ID' => $data['Categories_ID'],
                                'Visible' => (int)$data['Visible'][$i],
                                'Instructions' => $data['Instructions'][$i],
                                'Min_Indicator' => $data['Min_Indicator'][$i],
                                'Max_Indicator' => $data['Max_Indicator'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            )
                        );

                        if (isset($data['Indicator_ID'])) {
                            $indicator = [];

                            for ($i = 0; $i < count($data['Indicator_ID']); $i++) {
                                if ($data['Indicator_ID'][$i] == 0 && $data['Indicator_ID'][$i] == null) {

                                    if ($data['Indicator_Description'][$i] != null) {
                                        $Indicator_ID = DB::table('bis_cms_indicator')->insertGetId(
                                            array(
                                                'Title_ID' => $Title_ID,
                                                'Active' => 1,
                                                'Answer_Types_ID' => $data['Answer_Types_ID'][$i],
                                                'Indicator_Description' => $data['Indicator_Description'][$i],
                                                'Min_Answer' => $data['Min_Answer'][$i],
                                                'Max_Answer' => $data['Max_Answer'][$i],
                                                'Encoder_ID' => Auth::user()->id,
                                                'Date_Stamp' => Carbon::now()
                                            )
                                        );

                                        // if (isset($data['Answer'])) {
                                        //     $answer = [];

                                        //     for ($ii = 0; $ii < count($data['Answer']); $ii++) {
                                        //         if ($data['Answer'][$ii][$i] != null) {

                                        //             if ($data['Answer'][$ii][$i] != null) {
                                        //                 $answer = [
                                        //                     'Indicator_ID' => $Indicator_ID,
                                        //                     'Answer' => $data['Answer'][$ii][$i]
                                        //                 ];

                                        //                 DB::table('bis_cms_answer_classification')->insert($answer);
                                        //             }
                                        //         }
                                        //     }
                                        // }
                                    }
                                } else {
                                    if ($data['Indicator_Description'][$i] != null) {
                                        $indicator = [
                                            'Title_ID' => $Title_ID,
                                            'Active' => 1,
                                            'Answer_Types_ID' => $data['Answer_Types_ID'][$i],
                                            'Indicator_Description' => $data['Indicator_Description'][$i],
                                            'Min_Answer' => $data['Min_Answer'][$i],
                                            'Max_Answer' => $data['Max_Answer'][$i],
                                            'Encoder_ID' => Auth::user()->id,
                                            'Date_Stamp' => Carbon::now()
                                        ];

                                        DB::table('bis_cms_indicator')->update(['Indicator_ID' => $data['Indicator_ID']], $indicator);

                                        // if (isset($data['Answer'])) {
                                        //     $answer = [];

                                        //     for ($ii = 0; $ii < count($data['Answer']); $ii++) {
                                        //         if ($data['Answer'][$ii][$i] != null) {

                                        //             if ($data['Answer'][$ii][$i] != null) {
                                        //                 $answer = [
                                        //                     'Indicator_ID' => $data['Indicator_ID'],
                                        //                     'Answer' => $data['Answer'][$ii][$i]
                                        //                 ];

                                        //                 DB::table('bis_cms_answer_classification')->insert($answer);
                                        //             }
                                        //         }
                                        //     }
                                        // }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if ($data['Title'][$i] != null) {

                        DB::table('bis_cms_title')->where('Title_ID', $ID)->update(
                            array(
                                'Title' => $data['Title'][$i],
                                'CMS_Barangay_Profile_ID' => $data['CMS_Barangay_Profile_ID'],
                                'Categories_ID' => $data['Categories_ID'],
                                'Visible' => (int)$data['Visible'][$i],
                                'Instructions' => $data['Instructions'][$i],
                                'Min_Indicator' => $data['Min_Indicator'][$i],
                                'Max_Indicator' => $data['Max_Indicator'][$i],
                                'Encoder_ID' => Auth::user()->id,
                                'Date_Stamp' => Carbon::now()
                            )
                        );

                        if (isset($data['Indicator_ID'])) {
                            $indicator = [];

                            for ($i = 0; $i < count($data['Indicator_ID']); $i++) {
                                if ($data['Indicator_ID'][$i] == 0) {

                                    if ($data['Indicator_Description'][$i] != null) {
                                        $indicator = [
                                            'Title_ID' => $ID,
                                            'Active' => 1,
                                            'Answer_Types_ID' => $data['Answer_Types_ID'][$i],
                                            'Indicator_Description' => $data['Indicator_Description'][$i],
                                            'Min_Answer' => $data['Min_Answer'][$i],
                                            'Max_Answer' => $data['Max_Answer'][$i],
                                            'Encoder_ID' => Auth::user()->id,
                                            'Date_Stamp' => Carbon::now()
                                        ];

                                        DB::table('bis_cms_indicator')->insert($indicator);
                                    }
                                } else {
                                    if ($data['Indicator_Description'][$i] != null) {

                                        DB::table('bis_cms_indicator')->where('Indicator_ID', $data['Indicator_ID'][$i])->update(
                                            array(
                                                'Title_ID' => $ID,
                                                'Active' => 1,
                                                'Answer_Types_ID' => $data['Answer_Types_ID'][$i],
                                                'Indicator_Description' => $data['Indicator_Description'][$i],
                                                'Min_Answer' => $data['Min_Answer'][$i],
                                                'Max_Answer' => $data['Max_Answer'][$i],
                                                'Encoder_ID' => Auth::user()->id,
                                                'Date_Stamp' => Carbon::now()
                                            )
                                        );
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return redirect()->to('cms_indicator/' . $data['CMS_Barangay_Profile_ID'] . '/' . $data['Categories_ID'])->with('message', 'Record Saved');
    }

    // Get Answer Type
    public function get_answer_types(Request $request)
    {
        $data = DB::table('bis_cms_answer_types')
            ->where(['Active' => 1])
            ->orderBy('Date_Stamp', 'desc')->first();

        return json_encode($data);
    }

    public function get_answer_types_list($id)
    {
        $data = DB::table('bis_cms_answer_types')
            ->where(['Answer_Type_ID' => $id])
            ->first();

        return json_encode($data);
    }

    // Save CMS Info
    public function create_indicator_options(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();
        // dd($data);

        if (isset($data['Answer'])) {


            $answer = [];
            for ($i = 0; $i < count($data['Answer']); $i++) {

                if ($data['Answer'][$i] != NULL) {
                    if ($data['Answer_Classification_ID'][$i] != null) {

                        DB::table('bis_cms_answer_classification')->where('Answer_Classification_ID', $data['Answer_Classification_ID'][$i])->update(
                            array(
                                'Answer' => $data['Answer'][$i],
                                'Indicator_ID' => $data['modal_Indicator_ID'],
                            )
                        );
                    } else {
                        DB::table('bis_cms_answer_classification')->insert(
                            array(
                                'Answer' => $data['Answer'][$i],
                                'Indicator_ID' => $data['modal_Indicator_ID'],
                            )
                        );
                    }
                }
            }
        }
    }

    public function get_answer_classification($id)
    {
        $data = DB::table('bis_cms_answer_classification')
            ->where(['Indicator_ID' => $id])
            ->get();

        return json_encode($data);
    }

    // Create CMS Answer Type
    public function create_indicator_answer(Request $request)
    {
        $currDATE = Carbon::now();
        $data = request()->all();
        // dd($data);

        if (isset($data['Indicator_ID'])) {

            for ($i = 0; $i < count($data['Indicator_ID']); $i++) {

                if ($data['Indicator_ID'][$i] != NULL) {

                    // dd($data['Indicator_ID']);

                    if (isset($data['Answer'][$data['Indicator_ID'][$i]])) {

                        for ($ii = 0; $ii < count($data['Answer'][$data['Indicator_ID'][$i]]); $ii++) {

                            if ($data['Answer'][$data['Indicator_ID'][$i]][$ii] != NULL) {


                                $datas = DB::table('bis_cms_indicator as a')
                                    ->leftjoin('bis_cms_answer_types as b', 'a.Answer_Types_ID', '=', 'b.Answer_Type_ID')
                                    ->select('b.Widget')
                                    ->where(['Indicator_ID' => $data['Indicator_ID'][$i]])
                                    ->first();

                                if ($datas->Widget == 'RADIO' || $datas->Widget == 'SELECT' || $datas->Widget == 'CHECKBOX') {
                                    DB::table('bis_cms_indicator_answer')->insert(
                                        array(
                                            'Indicator_ID' => $data['Indicator_ID'][$i],
                                            'Answer_Classification_ID' => $data['Answer'][$data['Indicator_ID'][$i]][$ii],
                                            'Encoder_ID' => Auth::user()->id,
                                            'Date_Stamp' => Carbon::now()
                                        )
                                    );
                                } else {
                                    DB::table('bis_cms_indicator_answer')->insert(
                                        array(
                                            'Indicator_ID' => $data['Indicator_ID'][$i],
                                            'Answer' => $data['Answer'][$data['Indicator_ID'][$i]][$ii],
                                            'Answer_Classification_ID' => 0,
                                            'Encoder_ID' => Auth::user()->id,
                                            'Date_Stamp' => Carbon::now()
                                        )
                                    );
                                }
                            }
                        }
                    }
                }
            }
        }

        return redirect()->back()->with('message', 'New Entry Created');
    }
}
