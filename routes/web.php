<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//Public
Route::get('/', 'Public_LandingController@index')->name('*');
Route::get('/viewAnnouncement', 'Public_LandingController@viewAnnouncement')->name('viewAnnouncement');

Route::group(['middleware' => 'auth'], function () {
    //Home
    Route::get('/home', 'HomeController@index')->name('home');

    //NewsFeed Posts
    Route::post('/createPost', 'postsController@createPost')->name('createPost');
    Route::get('/get_thisPost', 'postsController@get_thisPost')->name('get_thisPost');
    Route::post('/updatePost', 'postsController@updatePost')->name('updatePost');

    //Events Announcements 
    Route::post('/createAnnouncement', 'postsController@createAnnouncement')->name('createAnnouncement');

    //Maintenance ETC
        //Announcement Status
        Route::get('/bweb_ann_status_maint', 'maintenanceController@bweb_ann_status_maint')->name('bweb_ann_status_maint');
        Route::post('/create_bweb_ann_status_maint', 'maintenanceController@create_bweb_ann_status_maint')->name('create_bweb_ann_status_maint');
        Route::get('/get_bweb_ann_status_maint', 'maintenanceController@get_bweb_ann_status_maint')->name('get_bweb_ann_status_maint');
        Route::post('/update_bweb_ann_status_maint', 'maintenanceController@update_bweb_ann_status_maint')->name('update_bweb_ann_status_maint');

        //Announcement Type
        Route::get('/bweb_ann_type_maint', 'maintenanceController@bweb_ann_type_maint')->name('bweb_ann_type_maint');
        Route::post('/create_bweb_ann_type_maint', 'maintenanceController@create_bweb_ann_type_maint')->name('create_bweb_ann_type_maint');
        Route::get('/get_bweb_ann_type_maint', 'maintenanceController@get_bweb_ann_type_maint')->name('get_bweb_ann_type_maint');
        Route::post('/update_bweb_ann_type_maint', 'maintenanceController@update_bweb_ann_type_maint')->name('update_bweb_ann_type_maint');

        //News Status
        Route::get('/bweb_news_status_maint', 'maintenanceController@bweb_news_status_maint')->name('bweb_news_status_maint');
        Route::post('/create_bweb_news_status_maint', 'maintenanceController@create_bweb_news_status_maint')->name('create_bweb_news_status_maint');
        Route::get('/get_bweb_news_status_maint', 'maintenanceController@get_bweb_news_status_maint')->name('get_bweb_news_status_maint');
        Route::post('/update_bweb_news_status_maint', 'maintenanceController@update_bweb_news_status_maint')->name('update_bweb_news_status_maint');

        //News Type
        Route::get('/bweb_news_type_maint', 'maintenanceController@bweb_news_type_maint')->name('bweb_news_type_maint');
        Route::post('/create_bweb_news_type_maint', 'maintenanceController@create_bweb_news_type_maint')->name('create_bweb_news_type_maint');
        Route::get('/get_bweb_news_type_maint', 'maintenanceController@get_bweb_news_type_maint')->name('get_bweb_news_type_maint');
        Route::post('/update_bweb_news_type_maint', 'maintenanceController@update_bweb_news_type_maint')->name('update_bweb_news_type_maint');

    //Blood Type
    Route::get('/blood_type_maint', 'maintenanceController@blood_type_maint')->name('blood_type_maint');
    Route::post('/create_blood_type_maint', 'maintenanceController@create_blood_type_maint')->name('create_blood_type_maint');
    Route::get('/get_blood_type_maint', 'maintenanceController@get_blood_type_maint')->name('get_blood_type_maint');
    Route::post('/update_blood_type_maint', 'maintenanceController@update_blood_type_maint')->name('update_blood_type_maint');

    //Deceased Type
    Route::get('/deceased_type_maint', 'maintenanceController@deceased_type_maint')->name('deceased_type_maint');
    Route::post('/create_deceased_type_maint', 'maintenanceController@create_deceased_type_maint')->name('create_deceased_type_maint');
    Route::get('/get_deceased_type_maint', 'maintenanceController@get_deceased_type_maint')->name('get_deceased_type_maint');
    Route::post('/update_deceased_type_maint', 'maintenanceController@update_deceased_type_maint')->name('update_deceased_type_maint');

    //Civil Status
    Route::get('/civil_status_maint', 'maintenanceController@civil_status_maint')->name('civil_status_maint');
    Route::post('/create_civil_status_maint', 'maintenanceController@create_civil_status_maint')->name('create_civil_status_maint');
    Route::get('/get_civil_status_maint', 'maintenanceController@get_civil_status_maint')->name('get_civil_status_maint');
    Route::post('/update_civil_status_maint', 'maintenanceController@update_civil_status_maint')->name('update_civil_status_maint');

    //Name Prefix
    Route::get('/name_prefix_maint', 'maintenanceController@name_prefix_maint')->name('name_prefix_maint');
    Route::post('/create_name_prefix_maint', 'maintenanceController@create_name_prefix_maint')->name('create_name_prefix_maint');
    Route::get('/get_name_prefix_maint', 'maintenanceController@get_name_prefix_maint')->name('get_name_prefix_maint');
    Route::post('/update_name_prefix_maint', 'maintenanceController@update_name_prefix_maint')->name('update_name_prefix_maint');

    //Family Position
    Route::get('/family_position_maint', 'maintenanceController@family_position_maint')->name('family_position_maint');
    Route::post('/create_family_position_maint', 'maintenanceController@create_family_position_maint')->name('create_family_position_maint');
    Route::get('/get_family_position_maint', 'maintenanceController@get_family_position_maint')->name('get_family_position_maint');
    Route::post('/update_family_position_maint', 'maintenanceController@update_family_position_maint')->name('update_family_position_maint');

    //Academic Level
    Route::get('/academic_level_maint', 'maintenanceController@academic_level_maint')->name('academic_level_maint');
    Route::post('/create_academic_level_maint', 'maintenanceController@create_academic_level_maint')->name('create_academic_level_maint');
    Route::get('/get_academic_level_maint', 'maintenanceController@get_academic_level_maint')->name('get_academic_level_maint');
    Route::post('/update_academic_level_maint', 'maintenanceController@update_academic_level_maint')->name('update_academic_level_maint');

    //Housing Unit
    Route::get('/housing_unit_maint', 'maintenanceController@housing_unit_maint')->name('housing_unit_maint');
    Route::post('/create_housing_unit_maint', 'maintenanceController@create_housing_unit_maint')->name('create_housing_unit_maint');
    Route::get('/get_housing_unit_maint', 'maintenanceController@get_housing_unit_maint')->name('get_housing_unit_maint');
    Route::post('/update_housing_unit_maint', 'maintenanceController@update_housing_unit_maint')->name('update_housing_unit_maint');

    //Religion
    Route::get('/religion_maint', 'maintenanceController@religion_maint')->name('religion_maint');
    Route::post('/create_religion_maint', 'maintenanceController@create_religion_maint')->name('create_religion_maint');
    Route::get('/get_religion_maint', 'maintenanceController@get_religion_maint')->name('get_religion_maint');
    Route::post('/update_religion_maint', 'maintenanceController@update_religion_maint')->name('update_religion_maint');

     //Family Type
     Route::get('/family_type_maint', 'maintenanceController@family_type_maint')->name('family_type_maint');
     Route::post('/create_family_type_maint', 'maintenanceController@create_family_type_maint')->name('create_family_type_maint');
     Route::get('/get_family_type_maint', 'maintenanceController@get_family_type_maint')->name('get_family_type_maint');
     Route::post('/update_family_type_maint', 'maintenanceController@update_family_type_maint')->name('update_family_type_maint');

     //Employment Type
     Route::get('/employment_type_maint', 'maintenanceController@employment_type_maint')->name('employment_type_maint');
     Route::post('/create_employment_type_maint', 'maintenanceController@create_employment_type_maint')->name('create_employment_type_maint');
     Route::get('/get_employment_type_maint', 'maintenanceController@get_employment_type_maint')->name('get_employment_type_maint');
     Route::post('/update_employment_type_maint', 'maintenanceController@update_employment_type_maint')->name('update_employment_type_maint');

     //Tenure of Lot
     Route::get('/tenure_of_lot_maint', 'maintenanceController@tenure_of_lot_maint')->name('tenure_of_lot_maint');
     Route::post('/create_tenure_of_lot_maint', 'maintenanceController@create_tenure_of_lot_maint')->name('create_tenure_of_lot_maint');
     Route::get('/get_tenure_of_lot_maint', 'maintenanceController@get_tenure_of_lot_maint')->name('get_tenure_of_lot_maint');
     Route::post('/update_tenure_of_lot_maint', 'maintenanceController@update_tenure_of_lot_maint')->name('update_tenure_of_lot_maint');

     //Name Suffix
     Route::get('/name_suffix_maint', 'maintenanceController@name_suffix_maint')->name('name_suffix_maint');
     Route::post('/create_name_suffix_maint', 'maintenanceController@create_name_suffix_maint')->name('create_name_suffix_maint');
     Route::get('/get_name_suffix_maint', 'maintenanceController@get_name_suffix_maint')->name('get_name_suffix_maint');
     Route::post('/update_name_suffix_maint', 'maintenanceController@update_name_suffix_maint')->name('update_name_suffix_maint');

     //Project Type
     Route::get('/project_type_maint', 'maintenanceController@project_type_maint')->name('project_type_maint');
     Route::post('/create_project_type_maint', 'maintenanceController@create_project_type_maint')->name('create_project_type_maint');
     Route::get('/get_project_type_maint', 'maintenanceController@get_project_type_maint')->name('get_project_type_maint');
     Route::post('/update_project_type_maint', 'maintenanceController@update_project_type_maint')->name('update_project_type_maint');

      //Accomplishment Status
      Route::get('/accomplishment_status_maint', 'maintenanceController@accomplishment_status_maint')->name('accomplishment_status_maint');
      Route::post('/create_accomplishment_status_maint', 'maintenanceController@create_accomplishment_status_maint')->name('create_accomplishment_status_maint');
      Route::get('/get_accomplishment_status_maint', 'maintenanceController@get_accomplishment_status_maint')->name('get_accomplishment_status_maint');
      Route::post('/update_accomplishment_status_maint', 'maintenanceController@update_accomplishment_status_maint')->name('update_accomplishment_status_maint');

      //Project Status
     Route::get('/project_status_maint', 'maintenanceController@project_status_maint')->name('project_status_maint');
     Route::post('/create_project_status_maint', 'maintenanceController@create_project_status_maint')->name('create_project_status_maint');
     Route::get('/get_project_status_maint', 'maintenanceController@get_project_status_maint')->name('get_project_status_maint');
     Route::post('/update_project_status_maint', 'maintenanceController@update_project_status_maint')->name('update_project_status_maint');

       //Type of Ordinance
       Route::get('/type_of_ordinance_maint', 'maintenanceController@type_of_ordinance_maint')->name('type_of_ordinance_maint');
       Route::post('/create_type_of_ordinance_maint', 'maintenanceController@create_type_of_ordinance_maint')->name('create_type_of_ordinance_maint');
       Route::get('/get_type_of_ordinance_maint', 'maintenanceController@get_type_of_ordinance_maint')->name('get_type_of_ordinance_maint');
       Route::post('/update_type_of_ordinance_maint', 'maintenanceController@update_type_of_ordinance_maint')->name('update_type_of_ordinance_maint');
    
    //Ordinance Category
    Route::get('/ordinance_category_maint', 'maintenanceController@ordinance_category_maint')->name('ordinance_category_maint');
    Route::post('/create_ordinance_category_maint', 'maintenanceController@create_ordinance_category_maint')->name('create_ordinance_category_maint');
    Route::get('/get_ordinance_category_maint', 'maintenanceController@get_ordinance_category_maint')->name('get_ordinance_category_maint');
    Route::post('/update_ordinance_category_maint', 'maintenanceController@update_ordinance_category_maint')->name('update_ordinance_category_maint');

    //Status of Ordinance 
    Route::get('/status_of_ordinance_maint', 'maintenanceController@status_of_ordinance_maint')->name('status_of_ordinance_maint');
    Route::post('/create_status_of_ordinance_maint', 'maintenanceController@create_status_of_ordinance_maint')->name('create_status_of_ordinance_maint');
    Route::get('/get_status_of_ordinance_maint', 'maintenanceController@get_status_of_ordinance_maint')->name('get_status_of_ordinance_maint');
    Route::post('/update_status_of_ordinance_maint', 'maintenanceController@update_status_of_ordinance_maint')->name('update_status_of_ordinance_maint');
    
    //Alert Level
    Route::get('/alert_level_maint', 'maintenanceController@alert_level_maint')->name('alert_level_maint');
    Route::post('/create_alert_level_maint', 'maintenanceController@create_alert_level_maint')->name('create_alert_level_maint');
    Route::get('/get_alert_level_maint', 'maintenanceController@get_alert_level_maint')->name('get_alert_level_maint');
    Route::post('/update_alert_level_maint', 'maintenanceController@update_alert_level_maint')->name('update_alert_level_maint');

    //Level of Damage
    Route::get('/level_of_damage_maint', 'maintenanceController@level_of_damage_maint')->name('level_of_damage_maint');
    Route::post('/create_level_of_damage_maint', 'maintenanceController@create_level_of_damage_maint')->name('create_level_of_damage_maint');
    Route::get('/get_level_of_damage_maint', 'maintenanceController@get_level_of_damage_maint')->name('get_level_of_damage_maint');
    Route::post('/update_level_of_damage_maint', 'maintenanceController@update_level_of_damage_maint')->name('update_level_of_damage_maint');

    //Casualty Status
    Route::get('/casualty_status_maint', 'maintenanceController@casualty_status_maint')->name('casualty_status_maint');
    Route::post('/create_casualty_status_maint', 'maintenanceController@create_casualty_status_maint')->name('create_casualty_status_maint');
    Route::get('/get_casualty_status_maint', 'maintenanceController@get_casualty_status_maint')->name('get_casualty_status_maint');
    Route::post('/update_casualty_status_maint', 'maintenanceController@update_casualty_status_maint')->name('update_casualty_status_maint');

    //BIPS Transaction
    Route::get('/inhabitants_information_list', 'bipsController@inhabitants_information_list')->name('inhabitants_information_list');
    Route::post('/create_inhabitants_information', 'bipsController@create_inhabitants_information')->name('create_inhabitants_information');
    Route::get('/get_inhabitants_info', 'bipsController@get_inhabitants_info')->name('get_inhabitants_info');

    // Global Controller
    Route::get('/get_province/{Region_ID}', 'GlobalController@getProvince');
    Route::get('/get_city/{Province_ID}', 'GlobalController@getCity');
    Route::get('/get_barangay/{City_Municipality_ID}', 'GlobalController@getBarangay');

});
