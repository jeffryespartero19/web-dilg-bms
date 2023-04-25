<?php

use Illuminate\Support\Facades\Route;
use App\Mail\StatusEmailNotif;

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


Auth::routes(['verify' => true]);
//Public
Route::get('/', 'Public_LandingController@index')->name('*');
Route::get('/main', 'Public_LandingController@main')->name('main');
Route::get('/viewAnnouncement', 'Public_LandingController@viewAnnouncement')->name('viewAnnouncement');
Route::get('/registers', 'BRGYLoginController@registers');
Route::post('/create_inhabitants_application_information', 'InhabitantApplicationController@create_inhabitants_information')->name('create_inhabitants_application_information');
Route::post('/create_inhabitants_user', 'InhabitantApplicationController@create_inhabitants_user')->name('create_inhabitants_user');


Route::group(['middleware' => 'auth'], function () {
  //Home
  Route::get('/home', 'HomeController@index')->name('home');

  //NewsFeed Posts
  Route::post('/createPost', 'postsController@createPost')->name('createPost');
  Route::get('/get_thisPost', 'postsController@get_thisPost')->name('get_thisPost');
  Route::post('/updatePost', 'postsController@updatePost')->name('updatePost');

  //Events Announcements 
  Route::post('/createAnnouncement', 'postsController@createAnnouncement')->name('createAnnouncement');
  Route::post('/updateAnnouncement', 'postsController@updateAnnouncement')->name('updateAnnouncement');

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

  //BINS UOM Unit of Measure
  Route::get('/bins_uom_maint', 'BINSController@bins_uom_maint')->name('bins_uom_maint');
  Route::post('/create_bins_uom_maint', 'BINSController@create_bins_uom_maint')->name('create_bins_uom_maint');
  Route::get('/get_bins_uom_maint', 'BINSController@get_bins_uom_maint')->name('get_bins_uom_maint');
  Route::post('/update_bins_uom_maint', 'BINSController@update_bins_uom_maint')->name('update_bins_uom_maint');

  //BINS BES Borrowed Equipment Status
  Route::get('/bins_bes_maint', 'BINSController@bins_bes_maint')->name('bins_bes_maint');
  Route::post('/create_bins_bes_maint', 'BINSController@create_bins_bes_maint')->name('create_bins_bes_maint');
  Route::get('/get_bins_bes_maint', 'BINSController@get_bins_bes_maint')->name('get_bins_bes_maint');
  Route::post('/update_bins_bes_maint', 'BINSController@update_bins_bes_maint')->name('update_bins_bes_maint');

  //BINS Item Classification
  Route::get('/bins_item_class_maint', 'BINSController@bins_item_class_maint')->name('bins_item_class_maint');
  Route::post('/create_bins_item_class_maint', 'BINSController@create_bins_item_class_maint')->name('create_bins_item_class_maint');
  Route::get('/get_bins_item_class_maint', 'BINSController@get_bins_item_class_maint')->name('get_bins_item_class_maint');
  Route::post('/update_bins_item_class_maint', 'BINSController@update_bins_item_class_maint')->name('update_bins_item_class_maint');

  //BINS Item Status
  Route::get('/bins_item_status_maint', 'BINSController@bins_item_status_maint')->name('bins_item_status_maint');
  Route::post('/create_bins_item_status_maint', 'BINSController@create_bins_item_status_maint')->name('create_bins_item_status_maint');
  Route::get('/get_bins_item_status_maint', 'BINSController@get_bins_item_status_maint')->name('get_bins_item_status_maint');
  Route::post('/update_bins_item_status_maint', 'BINSController@update_bins_item_status_maint')->name('update_bins_item_status_maint');

  //BINS Item Category
  Route::get('/bins_item_category_maint', 'BINSController@bins_item_category_maint')->name('bins_item_category_maint');
  Route::post('/create_bins_item_category_maint', 'BINSController@create_bins_item_category_maint')->name('create_bins_item_category_maint');
  Route::get('/get_bins_item_category_maint', 'BINSController@get_bins_item_category_maint')->name('get_bins_item_category_maint');
  Route::post('/update_bins_item_category_maint', 'BINSController@update_bins_item_category_maint')->name('update_bins_item_category_maint');

  //BINS Begining Balance
  Route::get('/bins_begbal', 'BINSController@bins_begbal')->name('bins_begbal');
  Route::post('/create_bins_begbal', 'BINSController@create_bins_begbal')->name('create_bins_begbal');
  Route::get('/get_bins_begbal', 'BINSController@get_bins_begbal')->name('get_bins_begbal');
  Route::post('/update_bins_begbal', 'BINSController@update_bins_begbal')->name('update_bins_begbal');

  //BINS Barangay Inventory
  Route::get('/bins_inventory', 'BINSController@bins_inventory')->name('bins_inventory');
  Route::post('/create_bins_inventory', 'BINSController@create_bins_inventory')->name('create_bins_inventory');
  Route::get('/get_bins_inventory', 'BINSController@get_bins_inventory')->name('get_bins_inventory');
  Route::post('/update_bins_inventory', 'BINSController@update_bins_inventory')->name('update_bins_inventory');

  //BINS Item Inspection
  Route::get('/bins_item_inspection', 'BINSController@bins_item_inspection')->name('bins_item_inspection');
  Route::post('/create_bins_item_inspection', 'BINSController@create_bins_item_inspection')->name('create_bins_item_inspection');
  Route::get('/get_bins_item_inspection', 'BINSController@get_bins_item_inspection')->name('get_bins_item_inspection');
  Route::post('/update_bins_item_inspection', 'BINSController@update_bins_item_inspection')->name('update_bins_item_inspection');

  //BINS Received Item
  Route::get('/bins_received_item', 'BINSController@bins_received_item')->name('bins_received_item');
  Route::post('/create_bins_received_item', 'BINSController@create_bins_received_item')->name('create_bins_received_item');
  Route::get('/get_bins_received_item', 'BINSController@get_bins_received_item')->name('get_bins_received_item');
  Route::post('/update_bins_received_item', 'BINSController@update_bins_received_item')->name('update_bins_received_item');

  //BINS Physical Count
  Route::get('/bins_physical_count', 'BINSController@bins_physical_count')->name('bins_physical_count');
  Route::post('/create_bins_physical_count', 'BINSController@create_bins_physical_count')->name('create_bins_physical_count');
  Route::get('/get_bins_physical_count', 'BINSController@get_bins_physical_count')->name('get_bins_physical_count');
  Route::post('/update_bins_physical_count', 'BINSController@update_bins_physical_count')->name('update_bins_physical_count');

  //BINS Inventory Disposal
  Route::get('/bins_inv_disposal', 'BINSController@bins_inv_disposal')->name('bins_inv_disposal');
  Route::post('/create_bins_inv_disposal', 'BINSController@create_bins_inv_disposal')->name('create_bins_inv_disposal');
  Route::get('/get_bins_inv_disposal', 'BINSController@get_bins_inv_disposal')->name('get_bins_inv_disposal');
  Route::post('/update_bins_inv_disposal', 'BINSController@update_bins_inv_disposal')->name('update_bins_inv_disposal');

  //BINS Borrow Request
  Route::get('/bins_borrow', 'BINSController@bins_borrow')->name('bins_borrow');
  Route::post('/create_bins_borrow', 'BINSController@create_bins_borrow')->name('create_bins_borrow');
  Route::get('/get_bins_borrow', 'BINSController@get_bins_borrow')->name('get_bins_borrow');
  Route::post('/update_bins_borrow', 'BINSController@update_bins_borrow')->name('update_bins_borrow');

  //BINS Supply Issuance
  Route::get('/bins_supply_issuance', 'BINSController@bins_supply_issuance')->name('bins_supply_issuance');
  Route::post('/create_bins_supply_issuance', 'BINSController@create_bins_supply_issuance')->name('create_bins_supply_issuance');
  Route::get('/get_bins_supply_issuance', 'BINSController@get_bins_supply_issuance')->name('get_bins_supply_issuance');
  Route::post('/update_bins_supply_issuance', 'BINSController@update_bins_supply_issuance')->name('update_bins_supply_issuance');

  //Blood Type
  Route::get('/blood_type_maint', 'maintenanceController@blood_type_maint')->name('blood_type_maint');
  Route::post('/create_blood_type_maint', 'maintenanceController@create_blood_type_maint')->name('create_blood_type_maint');
  Route::get('/get_blood_type_maint', 'maintenanceController@get_blood_type_maint')->name('get_blood_type_maint');
  Route::post('/update_blood_type_maint', 'maintenanceController@update_blood_type_maint')->name('update_blood_type_maint');

  //Deceased Profile
  Route::get('/deceased_profile_list', 'bipsController@deceased_profile_list')->name('deceased_profile_list');
  Route::post('/create_deceased_profile', 'bipsController@create_deceased_profile')->name('create_deceased_profile');
  Route::get('/get_deceased_profile', 'bipsController@get_deceased_profile')->name('get_deceased_profile');
  Route::post('/update_deceased_profile', 'bipsController@update_deceased_profile')->name('update_deceased_profile');

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

  //Deceased Type
  Route::get('/deceased_type_maint', 'maintenanceController@deceased_type_maint')->name('deceased_type_maint');
  Route::post('/create_deceased_type_maint', 'maintenanceController@create_deceased_type_maint')->name('create_deceased_type_maint');
  Route::get('/get_deceased_type_maint', 'maintenanceController@get_deceased_type_maint')->name('get_deceased_type_maint');
  Route::post('/update_deceased_type_maint', 'maintenanceController@update_deceased_type_maint')->name('update_deceased_type_maint');

  //BIPS Transaction
  //BIPS Inhabitants
  Route::get('/inhabitants_information_list', 'bipsController@inhabitants_information_list')->name('inhabitants_information_list');
  Route::post('/create_inhabitants_information', 'bipsController@create_inhabitants_information')->name('create_inhabitants_information');
  Route::get('/get_inhabitants_info', 'bipsController@get_inhabitants_info')->name('get_inhabitants_info');
  Route::get('/get_inhabitants_edu_info', 'bipsController@get_inhabitants_edu_info')->name('get_inhabitants_edu_info');
  Route::get('/get_inhabitants_epm_info', 'bipsController@get_inhabitants_epm_info')->name('get_inhabitants_epm_info');

  //BIPS Households
  Route::get('/inhabitants_household_profile', 'bipsController@inhabitants_household_profile')->name('inhabitants_household_profile');
  Route::post('/create_household_information', 'bipsController@create_household_information')->name('create_household_information');
  Route::get('/get_household_info', 'bipsController@get_household_info')->name('get_household_info');
  Route::get('/get_houshold_members', 'bipsController@get_houshold_members')->name('get_houshold_members');
  Route::get('/inhabitants_household_details/{id}', 'bipsController@inhabitants_household_details');
  //BIPS Resident
  Route::get('/inhabitants_resident_profile', 'bipsController@inhabitants_resident_profile')->name('inhabitants_resident_profile');
  Route::post('/create_resident_information', 'bipsController@create_resident_information')->name('create_resident_information');
  Route::get('/get_resident_info', 'bipsController@get_resident_info')->name('get_resident_info');

  //Inhabitants Transfer
  Route::get('/inhabitants_transfer_list', 'bipsController@inhabitants_transfer_list')->name('inhabitants_transfer_list');
  Route::post('/create_inhabitants_transfer', 'bipsController@create_inhabitants_transfer')->name('create_inhabitants_transfer');
  Route::get('/get_inhabitants_transfer', 'bipsController@get_inhabitants_transfer')->name('get_inhabitants_transfer');
  Route::post('/update_inhabitants_transfer', 'bipsController@update_inhabitants_transfer')->name('update_inhabitants_transfer');


  //BIPS Inhabitants Incoming List
  Route::get('/inhabitants_incoming_list', 'bipsController@inhabitants_incoming_list')->name('inhabitants_incoming_list');
  Route::post('/approve_disapprove_inhabitants', 'bipsController@approve_disapprove_inhabitants')->name('approve_disapprove_inhabitants');


  // BORIS TRANSACTIONS
  //BORIS Ordinance & Resolutions
  Route::get('/ordinances_and_resolutions_list', 'borisController@ordinances_and_resolutions_list')->name('ordinances_and_resolutions_list');
  Route::get('/resolutions_list', 'borisController@resolutions_list')->name('resolutions_list');
  Route::post('/create_ordinance_and_resolution', 'borisController@create_ordinance_and_resolution')->name('create_ordinance_and_resolution');
  Route::get('/get_ordinance_and_resolution_info', 'borisController@get_ordinance_and_resolution_info')->name('get_ordinance_and_resolution_info');
  Route::get('/get_ordinance_attachments', 'borisController@get_ordinance_attachments')->name('get_ordinance_attachments');
  Route::get('/delete_ordinance_attachments', 'borisController@delete_ordinance_attachments')->name('delete_ordinance_attachments');
  Route::post('/print_Ordinance', 'borisController@downloadPDF')->name('print_Ordinance');
  Route::post('/view_Ordinance', 'borisController@viewPDF')->name('view_Ordinance');
  Route::get('/get_ordinance_info/{id}', 'borisController@get_ordinance_info');

  //contractor
  Route::get('/contractor_list', 'bpmsController@contractor_list')->name('contractor_list');
  Route::post('/create_contractor', 'bpmsController@create_contractor')->name('create_contractor');
  Route::get('/get_contractor', 'bpmsController@get_contractor')->name('get_contractor');
  Route::post('/update_contractor', 'bpmsController@update_contractor')->name('update_contractor');
  Route::get('/view_Project', 'bpmsController@viewPDF')->name('view_Project');

  //Brgy Projects Monitoring
  Route::get('/brgy_projects_monitoring_list', 'bpmsController@brgy_projects_monitoring_list')->name('brgy_projects_monitoring_list');
  Route::post('/create_brgy_projects_monitoring', 'bpmsController@create_brgy_projects_monitoring')->name('create_brgy_projects_monitoring');
  Route::get('/get_brgy_projects_monitoring', 'bpmsController@get_brgy_projects_monitoring')->name('get_brgy_projects_monitoring');
  Route::post('/update_brgy_projects_monitoring', 'bpmsController@update_brgy_projects_monitoring')->name('update_brgy_projects_monitoring');
  Route::get('/get_milestone', 'bpmsController@get_milestone')->name('get_milestone');
  Route::post('/create_file_attachment', 'bpmsController@create_file_attachment')->name('create_file_attachment');
  Route::get('/get_milestone_attachments', 'bpmsController@get_milestone_attachments')->name('get_milestone_attachments');
  Route::get('/delete_milestone_attachments', 'bpmsController@delete_milestone_attachments')->name('delete_milestone_attachments');
  Route::get('/print_Project', 'bpmsController@downloadPDF')->name('print_Project');
  Route::get('/viewContractorPDF', 'bpmsController@viewContractorPDF')->name('viewContractorPDF');

  //Emergency Evacuation Site
  Route::get('/emergency_evacuation_site_list', 'BDRISALController@emergency_evacuation_site_list')->name('emergency_evacuation_site_list');
  Route::post('/create_emergency_evacuation_site', 'BDRISALController@create_emergency_evacuation_site')->name('create_emergency_evacuation_site');
  Route::get('/get_emergency_evacuation_site', 'BDRISALController@get_emergency_evacuation_site')->name('get_emergency_evacuation_site');
  Route::get('/viewEmergency_Evacuation_SitePDF', 'BDRISALController@viewEmergency_Evacuation_SitePDF')->name('viewEmergency_Evacuation_SitePDF');


  //Allocated Fund Source
  Route::get('/allocated_fund_source_list', 'BDRISALController@allocated_fund_source_list')->name('allocated_fund_source_list');
  Route::post('/create_allocated_fund_source', 'BDRISALController@create_allocated_fund_source')->name('create_allocated_fund_source');
  Route::get('/get_allocated_fund_source', 'BDRISALController@get_allocated_fund_source')->name('get_allocated_fund_source');
  Route::get('/viewAllocated_FundPDF', 'BDRISALController@viewAllocated_FundPDF')->name('viewAllocated_FundPDF');


  //Emergency Equipment
  Route::get('/emergency_equipment_list', 'BDRISALController@emergency_equipment_list')->name('emergency_equipment_list');
  Route::post('/create_emergency_equipment', 'BDRISALController@create_emergency_equipment')->name('create_emergency_equipment');
  Route::get('/get_emergency_equipment', 'BDRISALController@get_emergency_equipment')->name('get_emergency_equipment');
  Route::get('/viewEmergency_EquipmentPDF', 'BDRISALController@viewEmergency_EquipmentPDF')->name('viewEmergency_EquipmentPDF');

  //Emergency Team
  Route::get('/emergency_team_list', 'BDRISALController@emergency_team_list')->name('emergency_team_list');
  Route::post('/create_emergency_team', 'BDRISALController@create_emergency_team')->name('create_emergency_team');
  Route::get('/get_emergency_team', 'BDRISALController@get_emergency_team')->name('get_emergency_team');
  Route::get('/viewEmergency_TeamPDF', 'BDRISALController@viewEmergency_TeamPDF')->name('viewEmergency_TeamPDF');

  //Disaster Type
  Route::get('/disaster_type_list', 'BDRISALController@disaster_type_list')->name('disaster_type_list');
  Route::post('/create_disaster_type', 'BDRISALController@create_disaster_type')->name('create_disaster_type');
  Route::get('/get_disaster_type', 'BDRISALController@get_disaster_type')->name('get_disaster_type');
  Route::get('/viewDisaster_TypePDF', 'BDRISALController@viewDisaster_TypePDF')->name('viewDisaster_TypePDF');

  //Response Information
  Route::get('/response_information_list', 'BDRISALController@response_information_list')->name('response_information_list');
  Route::post('/create_response_information', 'BDRISALController@create_response_information')->name('create_response_information');
  Route::get('/get_response_information', 'BDRISALController@get_response_information')->name('get_response_information');
  Route::get('/get_response_information_attachments', 'BDRISALController@get_response_information_attachments')->name('get_response_information_attachments');
  Route::get('/delete_response_information_attachments', 'BDRISALController@delete_response_information_attachments')->name('delete_response_information_attachments');
  Route::get('/viewResponse_InformationPDF', 'BDRISALController@viewResponse_InformationPDF')->name('viewResponse_InformationPDF');
  //NEW
  Route::get('/response_information_details/{id}', 'BDRISALController@response_information_details');

  //Recovery Information
  Route::get('/recovery_information_list', 'BDRISALController@recovery_information_list')->name('recovery_information_list');
  Route::post('/create_recovery_information', 'BDRISALController@create_recovery_information')->name('create_recovery_information');
  Route::get('/get_recovery_information', 'BDRISALController@get_recovery_information')->name('get_recovery_information');
  Route::get('/get_affected_household', 'BDRISALController@get_affected_household')->name('get_affected_household');
  Route::get('/get_recovery_damage_loss', 'BDRISALController@get_recovery_damage_loss')->name('get_recovery_damage_loss');
  Route::get('/get_recovery_information_attachments', 'BDRISALController@get_recovery_information_attachments')->name('get_recovery_information_attachments');
  Route::get('/delete_recovery_information_attachments', 'BDRISALController@delete_recovery_information_attachments')->name('delete_recovery_information_attachments');
  //NEW
  Route::get('/recovery_information_details/{id}', 'BDRISALController@recovery_information_details');

  //Disaster Related Activities
  Route::get('/disaster_related_activities_list', 'BDRISALController@disaster_related_activities_list')->name('disaster_related_activities_list');
  Route::post('/create_disaster_related_activities', 'BDRISALController@create_disaster_related_activities')->name('create_disaster_related_activities');
  Route::get('/get_disaster_related_activities', 'BDRISALController@get_disaster_related_activities')->name('get_disaster_related_activities');
  Route::get('/get_disaster_related_activities_attachments', 'BDRISALController@get_disaster_related_activities_attachments')->name('get_disaster_related_activities_attachments');
  Route::get('/delete_disaster_related_activities_attachments', 'BDRISALController@delete_disaster_related_activities_attachments')->name('delete_disaster_related_activities_attachments');
  Route::get('/viewDisaster_Related_ActivitiesPDF', 'BDRISALController@viewDisaster_Related_ActivitiesPDF')->name('viewDisaster_Related_ActivitiesPDF');

  //Disaster Supplies
  Route::get('/disaster_supplies_list', 'BDRISALController@disaster_supplies_list')->name('disaster_supplies_list');
  Route::post('/create_disaster_supplies', 'BDRISALController@create_disaster_supplies')->name('create_disaster_supplies');
  Route::get('/get_disaster_supplies', 'BDRISALController@get_disaster_supplies')->name('get_disaster_supplies');
  Route::get('/viewDisaster_SuppliesPDF', 'BDRISALController@viewDisaster_SuppliesPDF')->name('viewDisaster_SuppliesPDF');


  //Case Type
  Route::get('/case_type_maint', 'maintenanceController@case_type_maint')->name('case_type_maint');
  Route::post('/create_case_type_maint', 'maintenanceController@create_case_type_maint')->name('create_case_type_maint');
  Route::get('/get_case_type_maint', 'maintenanceController@get_case_type_maint')->name('get_case_type_maint');
  Route::post('/update_case_type_maint', 'maintenanceController@update_case_type_maint')->name('update_case_type_maint');

  //Case
  Route::get('/case_maint', 'maintenanceController@case_maint')->name('case_maint');
  Route::post('/create_case_maint', 'maintenanceController@create_case_maint')->name('create_case_maint');
  Route::get('/get_case_maint', 'maintenanceController@get_case_maint')->name('get_case_maint');
  Route::post('/update_case_maint', 'maintenanceController@update_case_maint')->name('update_case_maint');

  //Type of Involved Party
  Route::get('/type_of_involved_party_maint', 'maintenanceController@type_of_involved_party_maint')->name('type_of_involved_party_maint');
  Route::post('/create_type_of_involved_party_maint', 'maintenanceController@create_type_of_involved_party_maint')->name('create_type_of_involved_party_maint');
  Route::get('/get_type_of_involved_party_maint', 'maintenanceController@get_type_of_involved_party_maint')->name('get_type_of_involved_party_maint');
  Route::post('/update_type_of_involved_party_maint', 'maintenanceController@update_type_of_involved_party_maint')->name('update_type_of_involved_party_maint');

  //Violation Status
  Route::get('/violation_status_maint', 'maintenanceController@violation_status_maint')->name('violation_status_maint');
  Route::post('/create_violation_status_maint', 'maintenanceController@create_violation_status_maint')->name('create_violation_status_maint');
  Route::get('/get_violation_status_maint', 'maintenanceController@get_violation_status_maint')->name('get_violation_status_maint');
  Route::post('/update_violation_status_maint', 'maintenanceController@update_violation_status_maint')->name('update_violation_status_maint');

  //Summons Status
  Route::get('/summons_status_maint', 'maintenanceController@summons_status_maint')->name('summons_status_maint');
  Route::post('/create_summons_status_maint', 'maintenanceController@create_summons_status_maint')->name('create_summons_status_maint');
  Route::get('/get_summons_status_maint', 'maintenanceController@get_summons_status_maint')->name('get_summons_status_maint');
  Route::post('/update_summons_status_maint', 'maintenanceController@update_summons_status_maint')->name('update_summons_status_maint');

  //Service Rate
  Route::get('/service_rate_maint', 'maintenanceController@service_rate_maint')->name('service_rate_maint');
  Route::post('/create_service_rate_maint', 'maintenanceController@create_service_rate_maint')->name('create_service_rate_maint');
  Route::get('/get_service_rate_maint', 'maintenanceController@get_service_rate_maint')->name('get_service_rate_maint');
  Route::post('/update_service_rate_maint', 'maintenanceController@update_service_rate_maint')->name('update_service_rate_maint');

  //Proceedings Status
  Route::get('/proceedings_status_maint', 'maintenanceController@proceedings_status_maint')->name('proceedings_status_maint');
  Route::post('/create_proceedings_status_maint', 'maintenanceController@create_proceedings_status_maint')->name('create_proceedings_status_maint');
  Route::get('/get_proceedings_status_maint', 'maintenanceController@get_proceedings_status_maint')->name('get_proceedings_status_maint');
  Route::post('/update_proceedings_status_maint', 'maintenanceController@update_proceedings_status_maint')->name('update_proceedings_status_maint');

  //Type of Action
  Route::get('/type_of_action_maint', 'maintenanceController@type_of_action_maint')->name('type_of_action_maint');
  Route::post('/create_type_of_action_maint', 'maintenanceController@create_type_of_action_maint')->name('create_type_of_action_maint');
  Route::get('/get_type_of_action_maint', 'maintenanceController@get_type_of_action_maint')->name('get_type_of_action_maint');
  Route::post('/update_type_of_action_maint', 'maintenanceController@update_type_of_action_maint')->name('update_type_of_action_maint');

  //Type of Penalties
  Route::get('/type_of_penalties_maint', 'maintenanceController@type_of_penalties_maint')->name('type_of_penalties_maint');
  Route::post('/create_type_of_penalties_maint', 'maintenanceController@create_type_of_penalties_maint')->name('create_type_of_penalties_maint');
  Route::get('/get_type_of_penalties_maint', 'maintenanceController@get_type_of_penalties_maint')->name('get_type_of_penalties_maint');
  Route::post('/update_type_of_penalties_maint', 'maintenanceController@update_type_of_penalties_maint')->name('update_type_of_penalties_maint');

  //Blotter Status
  Route::get('/blotter_status_maint', 'maintenanceController@blotter_status_maint')->name('blotter_status_maint');
  Route::post('/create_blotter_status_maint', 'maintenanceController@create_blotter_status_maint')->name('create_blotter_status_maint');
  Route::get('/get_blotter_status_maint', 'maintenanceController@get_blotter_status_maint')->name('get_blotter_status_maint');
  Route::post('/update_blotter_status_maint', 'maintenanceController@update_blotter_status_maint')->name('update_blotter_status_maint');

  //BJISBH Transaction
  //Blotter
  Route::get('/blotter_list', 'BJISBHController@blotter_list')->name('blotter_list');
  Route::get('/blotter_details/{id}', 'BJISBHController@blotter_details');
  Route::post('/create_blotter', 'BJISBHController@create_blotter')->name('create_blotter');
  Route::get('/get_blotter', 'BJISBHController@get_blotter')->name('get_blotter');
  Route::get('/get_case_details', 'BJISBHController@get_case_details')->name('get_case_details');
  Route::get('/delete_blotter_attachments', 'BJISBHController@delete_blotter_attachments')->name('delete_blotter_attachments');
  Route::get('/get_blotter_details', 'BJISBHController@get_blotter_details');

  //Summon
  Route::get('/summon_list', 'BJISBHController@summon_list')->name('summon_list');
  Route::get('/summon_details/{id}', 'BJISBHController@summon_details');
  Route::post('/create_summon', 'BJISBHController@create_summon')->name('create_summon');

  //Proceeding
  Route::get('/proceeding_list', 'BJISBHController@proceeding_list')->name('proceeding_list');
  Route::get('/proceeding_details/{id}', 'BJISBHController@proceeding_details');
  Route::post('/create_proceeding', 'BJISBHController@create_proceeding')->name('create_proceeding');

  //Ordinance Violator
  Route::get('/ordinance_violator_list', 'BJISBHController@ordinance_violator_list')->name('ordinance_violator_list');
  Route::get('/ordinance_violator_details/{id}', 'BJISBHController@ordinance_violator_details');
  Route::post('/create_ordinance_violator', 'BJISBHController@create_ordinance_violator')->name('create_ordinance_violator');

  //Inhabitant Application
  Route::get('/inhabitant_application', 'InhabitantApplicationController@inhabitant_application')->name('inhabitant_application');
  Route::get('/application_list', 'bipsController@application_list')->name('application_list');
  Route::post('/approve_disapprove_application', 'bipsController@approve_disapprove_application')->name('approve_disapprove_application');


  //Business Type
  Route::get('/business_type_list', 'BCPISMTController@business_type_list')->name('business_type_list');
  Route::post('/create_business_type', 'BCPISMTController@create_business_type')->name('create_business_type');
  Route::get('/get_business_type', 'BCPISMTController@get_business_type')->name('get_business_type');
  Route::post('/update_business_type', 'BCPISMTController@update_business_type')->name('update_business_type');

  //Purpose of Document
  Route::get('/purpose_document_list', 'BCPISMTController@purpose_document_list')->name('purpose_document_list');
  Route::post('/create_purpose_document', 'BCPISMTController@create_purpose_document')->name('create_purpose_document');
  Route::get('/get_purpose_document', 'BCPISMTController@get_purpose_document')->name('get_purpose_document');
  Route::post('/update_purpose_document', 'BCPISMTController@update_purpose_document')->name('update_purpose_document');

  //Document Type
  Route::get('/document_type_list', 'BCPISMTController@document_type_list')->name('document_type_list');
  Route::post('/create_document_type', 'BCPISMTController@create_document_type')->name('create_document_type');
  Route::get('/get_document_type', 'BCPISMTController@get_document_type')->name('get_document_type');
  Route::post('/update_document_type', 'BCPISMTController@update_document_type')->name('update_document_type');

  //Brgy Document Information
  Route::get('/brgy_document_information_list', 'BCPISController@brgy_document_information_list')->name('brgy_document_information_list');
  Route::get('/brgy_document_information_details/{id}', 'BCPISController@brgy_document_information_details');
  Route::post('/create_brgy_document_information', 'BCPISController@create_brgy_document_information')->name('create_brgy_document_information');
  Route::get('/viewBrgyDocPDF', 'BCPISController@viewBrgyDocPDF')->name('viewBrgyDocPDF');


  //Barangay Business Information
  Route::get('/barangay_business_list', 'BCPISController@barangay_business_list')->name('barangay_business_list');
  Route::get('/barangay_business_details/{id}', 'BCPISController@barangay_business_details');
  Route::post('/create_barangay_business', 'BCPISController@create_barangay_business')->name('create_barangay_business');

  //Barangay Business Permit
  Route::get('/brgy_business_permit_list', 'BCPISController@brgy_business_permit_list')->name('brgy_business_permit_list');
  Route::get('/brgy_business_permit_details/{id}', 'BCPISController@brgy_business_permit_details');
  Route::post('/create_barangay_business_permit', 'BCPISController@create_barangay_business_permit')->name('create_barangay_business_permit');
  Route::get('/viewBrgyBusinessPDF', 'BCPISController@viewBrgyBusinessPDF')->name('viewBrgyBusinessPDF');

  //Barangay Payment Collected Docu
  Route::get('/brgy_payment_collected_docu_list', 'BCPISController@brgy_payment_collected_docu_list')->name('brgy_payment_collected_docu_list');
  Route::get('/brgy_payment_collected_docu_details/{id}', 'BCPISController@brgy_payment_collected_docu_details');
  Route::post('/create_barangay_payment_collected_docu', 'BCPISController@create_barangay_payment_collected_docu')->name('create_barangay_payment_collected_docu');

  //Barangay Payment Collected Business
  Route::get('/brgy_payment_collected_business_list', 'BCPISController@brgy_payment_collected_business_list')->name('brgy_payment_collected_business_list');
  Route::get('/brgy_payment_collected_business_details/{id}', 'BCPISController@brgy_payment_collected_business_details');
  Route::post('/create_barangay_payment_collected_business', 'BCPISController@create_barangay_payment_collected_business')->name('create_barangay_payment_collected_business');

  //Barangay Document Claim Business
  Route::get('/brgy_document_claim_business_list', 'BCPISController@brgy_document_claim_business_list')->name('brgy_document_claim_business_list');
  Route::get('/brgy_document_claim_business_details/{id}', 'BCPISController@brgy_document_claim_business_details');
  Route::post('/create_barangay_document_claim_business', 'BCPISController@create_barangay_document_claim_business')->name('create_barangay_document_claim_business');

  //Barangay Document Claim Docue
  Route::get('/brgy_document_claim_docu_list', 'BCPISController@brgy_document_claim_docu_list')->name('brgy_document_claim_docu_list');
  Route::get('/brgy_document_claim_docu_details/{id}', 'BCPISController@brgy_document_claim_docu_details');
  Route::post('/create_barangay_document_claim_docu', 'BCPISController@create_barangay_document_claim_docu')->name('create_barangay_document_claim_docu');

  Route::post('/download_Inhabitants', 'bipsController@downloadPDF')->name('download_Inhabitants');
  Route::post('/view_Inhabitants', 'bipsController@viewPDF')->name('view_Inhabitants');
  Route::post('/download_Household', 'bipsController@download_householdPDF')->name('download_Household');
  Route::post('/view_Household', 'bipsController@view_householdPDF')->name('view_Household');

  //BFAS Maintenance
  //Type of Fee
  Route::get('/bfas_type_of_fee_maint', 'BFASController@bfas_type_of_fee_maint')->name('bfas_type_of_fee_maint');
  Route::post('/create_bfas_type_of_fee_maint', 'BFASController@create_bfas_type_of_fee_maint')->name('create_bfas_type_of_fee_maint');
  Route::get('/get_bfas_type_of_fee_maint', 'BFASController@get_bfas_type_of_fee_maint')->name('get_bfas_type_of_fee_maint');
  Route::post('/update_bfas_type_of_fee_maint', 'BFASController@update_bfas_type_of_fee_maint')->name('update_bfas_type_of_fee_maint');

  //Card Type
  Route::get('/bfas_card_type_maint', 'BFASController@bfas_card_type_maint')->name('bfas_card_type_maint');
  Route::post('/create_bfas_card_type_maint', 'BFASController@create_bfas_card_type_maint')->name('create_bfas_card_type_maint');
  Route::get('/get_bfas_card_type_maint', 'BFASController@get_bfas_card_type_maint')->name('get_bfas_card_type_maint');
  Route::post('/update_bfas_card_type_maint', 'BFASController@update_bfas_card_type_maint')->name('update_bfas_card_type_maint');

  //Account Type
  Route::get('/bfas_account_type_maint', 'BFASController@bfas_account_type_maint')->name('bfas_account_type_maint');
  Route::post('/create_bfas_account_type_maint', 'BFASController@create_bfas_account_type_maint')->name('create_bfas_account_type_maint');
  Route::get('/get_bfas_account_type_maint', 'BFASController@get_bfas_account_type_maint')->name('get_bfas_account_type_maint');
  Route::post('/update_bfas_account_type_maint', 'BFASController@update_bfas_account_type_maint')->name('update_bfas_account_type_maint');

  //Fund Type
  Route::get('/bfas_fund_type_maint', 'BFASController@bfas_fund_type_maint')->name('bfas_fund_type_maint');
  Route::post('/create_bfas_fund_type_maint', 'BFASController@create_bfas_fund_type_maint')->name('create_bfas_fund_type_maint');
  Route::get('/get_bfas_fund_type_maint', 'BFASController@get_bfas_fund_type_maint')->name('get_bfas_fund_type_maint');
  Route::post('/update_bfas_fund_type_maint', 'BFASController@update_bfas_fund_type_maint')->name('update_bfas_fund_type_maint');

  //Bank Account
  Route::get('/bfas_bank_account_maint', 'BFASController@bfas_bank_account_maint')->name('bfas_bank_account_maint');
  Route::post('/create_bfas_bank_account_maint', 'BFASController@create_bfas_bank_account_maint')->name('create_bfas_bank_account_maint');
  Route::get('/get_bfas_bank_account_maint', 'BFASController@get_bfas_bank_account_maint')->name('get_bfas_bank_account_maint');
  Route::post('/update_bfas_bank_account_maint', 'BFASController@update_bfas_bank_account_maint')->name('update_bfas_bank_account_maint');

  //Voucher Status
  Route::get('/bfas_voucher_status_maint', 'BFASController@bfas_voucher_status_maint')->name('bfas_voucher_status_maint');
  Route::post('/create_bfas_voucher_status_maint', 'BFASController@create_bfas_voucher_status_maint')->name('create_bfas_voucher_status_maint');
  Route::get('/get_bfas_voucher_status_maint', 'BFASController@get_bfas_voucher_status_maint')->name('get_bfas_voucher_status_maint');
  Route::post('/update_bfas_voucher_status_maint', 'BFASController@update_bfas_voucher_status_maint')->name('update_bfas_voucher_status_maint');

  //Tax Code
  Route::get('/bfas_tax_code_maint', 'BFASController@bfas_tax_code_maint')->name('bfas_tax_code_maint');
  Route::post('/create_bfas_tax_code_maint', 'BFASController@create_bfas_tax_code_maint')->name('create_bfas_tax_code_maint');
  Route::get('/get_bfas_tax_code_maint', 'BFASController@get_bfas_tax_code_maint')->name('get_bfas_tax_code_maint');
  Route::post('/update_bfas_tax_code_maint', 'BFASController@update_bfas_tax_code_maint')->name('update_bfas_tax_code_maint');

  //Tax Type
  Route::get('/bfas_tax_type_maint', 'BFASController@bfas_tax_type_maint')->name('bfas_tax_type_maint');
  Route::post('/create_bfas_tax_type_maint', 'BFASController@create_bfas_tax_type_maint')->name('create_bfas_tax_type_maint');
  Route::get('/get_bfas_tax_type_maint', 'BFASController@get_bfas_tax_type_maint')->name('get_bfas_tax_type_maint');
  Route::post('/update_bfas_tax_type_maint', 'BFASController@update_bfas_tax_type_maint')->name('update_bfas_tax_type_maint');

  //Journal Type
  Route::get('/bfas_journal_type_maint', 'BFASController@bfas_journal_type_maint')->name('bfas_journal_type_maint');
  Route::post('/create_bfas_journal_type_maint', 'BFASController@create_bfas_journal_type_maint')->name('create_bfas_journal_type_maint');
  Route::get('/get_bfas_journal_type_maint', 'BFASController@get_bfas_journal_type_maint')->name('get_bfas_journal_type_maint');
  Route::post('/update_bfas_journal_type_maint', 'BFASController@update_bfas_journal_type_maint')->name('update_bfas_journal_type_maint');

  //Appropriation Type
  Route::get('/bfas_appropriation_type_maint', 'BFASController@bfas_appropriation_type_maint')->name('bfas_appropriation_type_maint');
  Route::post('/create_bfas_appropriation_type_maint', 'BFASController@create_bfas_appropriation_type_maint')->name('create_bfas_appropriation_type_maint');
  Route::get('/get_bfas_appropriation_type_maint', 'BFASController@get_bfas_appropriation_type_maint')->name('get_bfas_appropriation_type_maint');
  Route::post('/update_bfas_appropriation_type_maint', 'BFASController@update_bfas_appropriation_type_maint')->name('update_bfas_appropriation_type_maint');

  //Account Code
  Route::get('/bfas_account_code_maint', 'BFASController@bfas_account_code_maint')->name('bfas_account_code_maint');
  Route::post('/create_bfas_account_code_maint', 'BFASController@create_bfas_account_code_maint')->name('create_bfas_account_code_maint');
  Route::get('/get_bfas_account_code_maint', 'BFASController@get_bfas_account_code_maint')->name('get_bfas_account_code_maint');
  Route::post('/update_bfas_account_code_maint', 'BFASController@update_bfas_account_code_maint')->name('update_bfas_account_code_maint');

  //Expediture Type
  Route::get('/bfas_expenditure_type_maint', 'BFASController@bfas_expenditure_type_maint')->name('bfas_expenditure_type_maint');
  Route::post('/create_bfas_expenditure_type_maint', 'BFASController@create_bfas_expenditure_type_maint')->name('create_bfas_expenditure_type_maint');
  Route::get('/get_bfas_expenditure_type_maint', 'BFASController@get_bfas_expenditure_type_maint')->name('get_bfas_expenditure_type_maint');
  Route::post('/update_bfas_expenditure_type_maint', 'BFASController@update_bfas_expenditure_type_maint')->name('update_bfas_expenditure_type_maint');

  //BFAS Transactions

  //Accounts Information -- Chart of Accounts
  Route::get('/bfas_accounts_information', 'BFASController2@bfas_accounts_information')->name('bfas_accounts_information');
  Route::post('/create_bfas_accounts_information', 'BFASController2@create_bfas_accounts_information')->name('create_bfas_accounts_information');
  Route::get('/get_bfas_accounts_information', 'BFASController2@get_bfas_accounts_information')->name('get_bfas_accounts_information');
  Route::post('/update_bfas_accounts_information', 'BFASController2@update_bfas_accounts_information')->name('update_bfas_accounts_information');

  //JEV Collection
  Route::get('/bfas_jev_collection', 'BFASController2@bfas_jev_collection')->name('bfas_jev_collection');
  Route::post('/create_bfas_jev_collection', 'BFASController2@create_bfas_jev_collection')->name('create_bfas_jev_collection');
  Route::get('/get_bfas_jev_collection', 'BFASController2@get_bfas_jev_collection')->name('get_bfas_jev_collection');
  Route::post('/update_bfas_jev_collection', 'BFASController2@update_bfas_jev_collection')->name('update_bfas_jev_collection');

  //JEV Disbursement
  Route::get('/bfas_jev_disbursement', 'BFASController2@bfas_jev_disbursement')->name('bfas_jev_disbursement');
  Route::post('/create_bfas_jev_disbursement', 'BFASController2@create_bfas_jev_disbursement')->name('create_bfas_jev_disbursement');
  Route::get('/get_bfas_jev_disbursement', 'BFASController2@get_bfas_jev_disbursement')->name('get_bfas_jev_disbursement');
  Route::post('/update_bfas_jev_disbursement', 'BFASController2@update_bfas_jev_disbursement')->name('update_bfas_jev_disbursement');

  //Budget Appropriation
  Route::get('/bfas_budget_appropriation', 'BFASController2@bfas_budget_appropriation')->name('bfas_budget_appropriation');
  Route::post('/create_bfas_budget_appropriation', 'BFASController2@create_bfas_budget_appropriation')->name('create_bfas_budget_appropriation');
  Route::get('/get_bfas_budget_appropriation', 'BFASController2@get_bfas_budget_appropriation')->name('get_bfas_budget_appropriation');
  Route::post('/update_bfas_budget_appropriation', 'BFASController2@update_bfas_budget_appropriation')->name('update_bfas_budget_appropriation');

  //Budget SAAODBA
  Route::get('/bfas_SAAODBA', 'BFASController2@bfas_SAAODBA')->name('bfas_SAAODBA');
  Route::post('/create_bfas_SAAODBA', 'BFASController2@create_bfas_SAAODBA')->name('create_bfas_SAAODBA');
  Route::get('/get_bfas_SAAODBA', 'BFASController2@get_bfas_SAAODBA')->name('get_bfas_SAAODBA');
  Route::post('/update_bfas_SAAODBA', 'BFASController2@update_bfas_SAAODBA')->name('update_bfas_SAAODBA');

  //Obligation Request
  Route::get('/bfas_obligation_request', 'BFASController2@bfas_obligation_request')->name('bfas_obligation_request');
  Route::post('/create_bfas_obligation_request', 'BFASController2@create_bfas_obligation_request')->name('create_bfas_obligation_request');
  Route::get('/get_bfas_obligation_request', 'BFASController2@get_bfas_obligation_request')->name('get_bfas_obligation_request');
  Route::post('/update_bfas_obligation_request', 'BFASController2@update_bfas_obligation_request')->name('update_bfas_obligation_request');

  //Disbursement Voucher
  Route::get('/bfas_disbursement_voucher', 'BFASController2@bfas_disbursement_voucher')->name('bfas_disbursement_voucher');
  Route::post('/create_bfas_disbursement_voucher', 'BFASController2@create_bfas_disbursement_voucher')->name('create_bfas_disbursement_voucher');
  Route::get('/get_bfas_disbursement_voucher', 'BFASController2@get_bfas_disbursement_voucher')->name('get_bfas_disbursement_voucher');
  Route::post('/update_bfas_disbursement_voucher', 'BFASController2@update_bfas_disbursement_voucher')->name('update_bfas_disbursement_voucher');

  //Check Preparation
  Route::get('/bfas_check_preparation', 'BFASController2@bfas_check_preparation')->name('bfas_check_preparation');
  Route::post('/create_bfas_check_preparation', 'BFASController2@create_bfas_check_preparation')->name('create_bfas_check_preparation');
  Route::get('/get_bfas_check_preparation', 'BFASController2@get_bfas_check_preparation')->name('get_bfas_check_preparation');
  Route::post('/update_bfas_check_preparation', 'BFASController2@update_bfas_check_preparation')->name('update_bfas_check_preparation');

  //Check Status
  Route::get('/bfas_check_status', 'BFASController2@bfas_check_status')->name('bfas_check_status');
  Route::post('/create_bfas_check_status', 'BFASController2@create_bfas_check_status')->name('create_bfas_check_status');
  Route::get('/get_bfas_check_status', 'BFASController2@get_bfas_check_status')->name('get_bfas_check_status');
  Route::post('/update_bfas_check_status', 'BFASController2@update_bfas_check_status')->name('update_bfas_check_status');

  //Check Status Released
  Route::get('/bfas_check_status_released', 'BFASController2@bfas_check_status_released')->name('bfas_check_status_released');
  Route::post('/create_bfas_check_status_released', 'BFASController2@create_bfas_check_status_released')->name('create_bfas_check_status_released');
  Route::get('/get_bfas_check_status_released', 'BFASController2@get_bfas_check_status_released')->name('get_bfas_check_status_released');
  Route::post('/update_bfas_check_status_released', 'BFASController2@update_bfas_check_status_released')->name('update_bfas_check_status_released');

  //Payment Collection
  Route::get('/bfas_payment_collection', 'BFASController2@bfas_payment_collection')->name('bfas_payment_collection');
  Route::post('/create_bfas_payment_collection', 'BFASController2@create_bfas_payment_collection')->name('create_bfas_payment_collection');
  Route::get('/get_bfas_payment_collection', 'BFASController2@get_bfas_payment_collection')->name('get_bfas_payment_collection');
  Route::post('/update_bfas_payment_collection', 'BFASController2@update_bfas_payment_collection')->name('update_bfas_payment_collection');

  //Card File 
  Route::get('/bfas_card_file', 'BFASController2@bfas_card_file')->name('bfas_card_file');
  Route::post('/create_bfas_card_file', 'BFASController2@create_bfas_card_file')->name('create_bfas_card_file');
  Route::get('/get_bfas_card_file', 'BFASController2@get_bfas_card_file')->name('get_bfas_card_file');
  Route::post('/update_bfas_card_file', 'BFASController2@update_bfas_card_file')->name('update_bfas_card_file');


  //BIS Transaction
  //BIS CMS
  Route::get('/cms_list', 'BISController@cms_list')->name('cms_list');
  Route::get('/cms_details/{id}', 'BISController@cms_details');
  Route::post('/create_cms', 'BISController@create_cms')->name('create_cms');
  Route::get('/cms_indicator/{id}/{cat_id}', 'BISController@cms_indicator');
  Route::post('/create_cms_title', 'BISController@create_cms_title')->name('create_cms_title');
  Route::post('/create_answer_type', 'BISController@create_answer_type')->name('create_answer_type');
  Route::get('/get_answer_types', 'BISController@get_answer_types');
  Route::get('/get_answer_types_list/{id}', 'BISController@get_answer_types_list');
  //BIS Frequency Maintenance
  Route::get('/frequency_maint', 'maintenanceController@frequency_maint')->name('frequency_maint');
  Route::post('/create_frequency_maint', 'maintenanceController@create_frequency_maint')->name('create_frequency_maint');
  Route::get('/get_frequency_maint', 'maintenanceController@get_frequency_maint')->name('get_frequency_maint');
  Route::post('/update_frequency_maint', 'maintenanceController@update_frequency_maint')->name('update_frequency_maint');

  //BIS Categories Maintenance
  Route::get('/categories_maint', 'maintenanceController@categories_maint')->name('categories_maint');
  Route::post('/create_categories_maint', 'maintenanceController@create_categories_maint')->name('create_categories_maint');
  Route::get('/get_categories_maint', 'maintenanceController@get_categories_maint')->name('get_categories_maint');
  Route::post('/update_categories_maint', 'maintenanceController@update_categories_maint')->name('update_categories_maint');


  //Other Transaction BDRIS
  Route::get('/other_transaction_list', 'BDRISALController@other_transaction_list')->name('other_transaction_list');
  //DISASTER TYPE
  Route::get('/disaster_type_details/{id}', 'BDRISALController@disaster_type_details');
  //EMERGENCY EVACUATION SITE
  Route::get('/emergency_evacuation_site_details/{id}', 'BDRISALController@emergency_evacuation_site_details');
  //ALLOCATED_FUND
  Route::get('/allocated_fund_details/{id}', 'BDRISALController@allocated_fund_details');
  //DISASTER SUPPLIES
  Route::get('/disaster_supplies_details/{id}', 'BDRISALController@disaster_supplies_details');
  //EMERGENCY TEAM
  Route::get('/emergency_team_details/{id}', 'BDRISALController@emergency_team_details');
  //EMERGENCY EQUIPMENT
  Route::get('/emergency_equipment_details/{id}', 'BDRISALController@emergency_equipment_details');


  // Create Indicator Options
  Route::get('/create_indicator_options', 'BISController@create_indicator_options')->name('create_indicator_options');
  Route::get('/get_answer_classification/{id}', 'BISController@get_answer_classification');
  Route::post('/create_indicator_answer', 'BISController@create_indicator_answer')->name('create_indicator_answer');

  Route::get('/get_ordinance/{Region_ID}', 'borisController@get_ordinance');
  Route::get('/get_resolution/{Region_ID}', 'borisController@get_resolution');
  Route::get('/get_inhabitant_list/{Barangay_ID}', 'bipsController@get_inhabitant_list');
  Route::get('/get_household_list/{Barangay_ID}', 'bipsController@get_household_list');
  Route::get('/get_deceased_list/{Barangay_ID}', 'bipsController@get_deceased_list');
  Route::get('/get_transfer_list/{Barangay_ID}', 'bipsController@get_transfer_list');
  Route::get('/get_incoming_list/{Barangay_ID}', 'bipsController@get_incoming_list');
  Route::get('/get_blotter_list/{Barangay_ID}', 'BJISBHController@get_blotter_list');
  Route::get('/get_summon_list/{Barangay_ID}', 'BJISBHController@get_summon_list');
  Route::get('/get_proceeding_list/{Barangay_ID}', 'BJISBHController@get_proceeding_list');
  Route::get('/get_ordinance_violator_list/{Barangay_ID}', 'BJISBHController@get_ordinance_violator_list');

  //Document Request
  Route::get('/brgy_document_information_details_request', 'BCPISController@brgy_document_information_details_request')->name('brgy_document_information_details_request');
  Route::post('/create_brgy_document_information_request', 'BCPISController@create_brgy_document_information_request')->name('create_brgy_document_information_request');

  //DOCUMENT REQUEST PENDING
  Route::get('/document_request_pending_list', 'BCPISController@document_request_pending_list')->name('document_request_pending_list');
  Route::post('/approve_disapprove_document_request_pending', 'BCPISController@approve_disapprove_document_request_pending')->name('approve_disapprove_document_request_pending');
  Route::get('/document_request_details/{id}', 'BCPISController@document_request_details');
  Route::post('/update_document_request_approve_information', 'BCPISController@update_document_request_approve_information')->name('update_document_request_approve_information');
  Route::get('/document_request_approved_details/{id}', 'BCPISController@document_request_approved_details');
  Route::post('/update_document_request_approve_edit_information', 'BCPISController@update_document_request_approve_edit_information')->name('update_document_request_approve_edit_information');
  Route::get('/document_request_ticket_number_details/{id}', 'BCPISController@document_request_ticket_number_details');

  //Tagging
  Route::post('/tag_bfas_budget_appropriation', 'BFASController2@tag_bfas_budget_appropriation')->name('tag_bfas_budget_appropriation');
  Route::post('/tag_bfas_obligation_request', 'BFASController2@tag_bfas_obligation_request')->name('tag_bfas_obligation_request');
  Route::post('/tag_bfas_disbursement_voucher', 'BFASController2@tag_bfas_disbursement_voucher')->name('tag_bfas_disbursement_voucher');

  //Get Account Parent Child
  Route::get('/get_acc_parents', 'BFASController2@get_acc_parents')->name('get_acc_parents');

  //Brgy Official
  Route::get('/brgy_official_list', 'bipsController@brgy_official_list')->name('brgy_official_list');
  Route::post('/create_brgy_official', 'bipsController@create_brgy_official')->name('create_brgy_official');
  Route::get('/get_brgy_official', 'bipsController@get_brgy_official')->name('get_brgy_official');
  Route::post('/update_brgy_official', 'bipsController@update_brgy_official')->name('update_brgy_official');

  //Brgy Position Maintenance
  Route::get('/brgy_position_maint', 'maintenanceController@brgy_position_maint')->name('brgy_position_maint');
  Route::post('/create_brgy_position_maint', 'maintenanceController@create_brgy_position_maint')->name('create_brgy_position_maint');
  Route::get('/get_brgy_position_maint', 'maintenanceController@get_brgy_position_maint')->name('get_brgy_position_maint');
  Route::post('/update_brgy_position_maint', 'maintenanceController@update_brgy_position_maint')->name('update_brgy_position_maint');

  //Get Boris Attester
  Route::get('/get_ordinance_and_resolution_attester', 'borisController@get_ordinance_and_resolution_attester')->name('get_ordinance_and_resolution_attester');
  //Get Boris Previous Related Ordinance
  Route::get('/get_ordinance_and_resolution_pro', 'borisController@get_ordinance_and_resolution_pro')->name('get_ordinance_and_resolution_pro');

  Route::get('/get_businsess_permit_list/{Barangay_ID}', 'BCPISController@get_businsess_permit_list');
  Route::get('/get_brgy_document_information_list/{Barangay_ID}', 'BCPISController@get_brgy_document_information_list');
  Route::get('/get_brgy_business_list/{Barangay_ID}', 'BCPISController@get_brgy_business_list');
  Route::get('/get_contractor_list/{Barangay_ID}', 'BPMSController@get_contractor_list');
  Route::get('/get_brgy_projects_monitoring_list/{Barangay_ID}', 'BPMSController@get_brgy_projects_monitoring_list');
  Route::get('/get_recovery_information_list/{Barangay_ID}', 'BDRISALController@get_recovery_information_list');
  Route::get('/get_response_information_list/{Barangay_ID}', 'BDRISALController@get_response_information_list');
  Route::get('/get_disaster_related_activities_list/{Barangay_ID}', 'BDRISALController@get_disaster_related_activities_list');
  Route::get('/get_emergency_evacuation_site_list/{Barangay_ID}', 'BDRISALController@get_emergency_evacuation_site_list');
  Route::get('/get_allocated_fund_list/{Barangay_ID}', 'BDRISALController@get_allocated_fund_list');
  Route::get('/get_disaster_supplies_list/{Barangay_ID}', 'BDRISALController@get_disaster_supplies_list');
  Route::get('/get_emergency_team_list/{Barangay_ID}', 'BDRISALController@get_emergency_team_list');
  Route::get('/get_emergency_equipment_list/{Barangay_ID}', 'BDRISALController@get_emergency_equipment_list');


  //Brgy Official
  Route::get('/brgy_purok_leader_list', 'bipsController@brgy_purok_leader_list')->name('brgy_purok_leader_list');
  Route::post('/create_brgy_purok_leader', 'bipsController@create_brgy_purok_leader')->name('create_brgy_purok_leader');
  Route::get('/get_brgy_purok_leader', 'bipsController@get_brgy_purok_leader')->name('get_brgy_purok_leader');
  Route::post('/update_brgy_purok_leader', 'bipsController@update_brgy_purok_leader')->name('update_brgy_purok_leader');


  //Justice Rating
  Route::get('/justice_rating_inhabitants', 'JusticeRatingController@justice_rating_inhabitants')->name('justice_rating_inhabitants');
  Route::get('/rating_page/{id}', 'JusticeRatingController@rating_page');
  Route::post('/create_rating', 'JusticeRatingController@create_rating')->name('create_rating');
  Route::get('/justice_rating_staff', 'JusticeRatingController@justice_rating_staff')->name('justice_rating_staff');

  //User
  Route::get('/user_list', 'UserController@user_list')->name('user_list');
  Route::post('/create_user', 'UserController@create_user')->name('create_user');
  Route::post('/update_user', 'UserController@update_user')->name('update_user');
  Route::get('/get_user', 'UserController@get_user')->name('get_user');

  //Update Inhabitants
  Route::post('/update_inhabitants_application_info', 'InhabitantApplicationController@update_inhabitants_application_info')->name('update_inhabitants_application_info');
  //Processing Sched
  Route::get('/processing_sched', 'bipsController@processing_sched')->name('processing_sched');
  Route::post('/update_processing_sched', 'bipsController@update_processing_sched')->name('update_processing_sched');


  Route::get('/update_Inhabitant_Status', 'bipsController@update_Inhabitant_Status')->name('update_Inhabitant_Status');

  Route::get('/update_Inhabitant_Status', 'bipsController@update_Inhabitant_Status')->name('update_Inhabitant_Status');

  //Household View
  Route::get('/inhabitants_household_details_view/{id}', 'bipsController@inhabitants_household_details_view');

  //Blotter Detail View
  Route::get('/blotter_details_view/{id}', 'BJISBHController@blotter_details_view');
  //Summon Details View
  Route::get('/summon_details_view/{id}', 'BJISBHController@summon_details_view');
  //Proceeding Details View
  Route::get('/proceeding_details_view/{id}', 'BJISBHController@proceeding_details_view');
  //Ordinance Violator Details View
  Route::get('/ordinance_violator_details_view/{id}', 'BJISBHController@ordinance_violator_details_view');

  //DISASTER TYPE VIEW
  Route::get('/view_disaster_type_details/{id}', 'BDRISALController@view_disaster_type_details');
  //EMERGENCY EVACUATION SITE VIEW
  Route::get('/view_emergency_evacuation_site_details/{id}', 'BDRISALController@view_emergency_evacuation_site_details');
  //ALLOCATED FUND VIEW
  Route::get('/view_allocated_fund_details/{id}', 'BDRISALController@view_emergency_evacuation_site_details');
  //DISASTER SUPPLIES VIEW
  Route::get('/view_disaster_supplies_details/{id}', 'BDRISALController@view_disaster_supplies_details');
  //EMERGENCY TEAM VIEW
  Route::get('/view_emergency_team_details/{id}', 'BDRISALController@view_emergency_team_details');
  //EMERGENCY EQUIPMENT VIEW
  Route::get('/view_emergency_equipment_details/{id}', 'BDRISALController@view_emergency_equipment_details');
  //RESPONSE INFORMATION VIEW
  Route::get('/view_response_information_details/{id}', 'BDRISALController@view_response_information_details');
  //RECOVERY INFORMATION VIEW
  Route::get('/view_recovery_information_details/{id}', 'BDRISALController@view_recovery_information_details');
  //BRGY BUSINESS PERMIT VIEW
  Route::get('/view_brgy_business_permit_details/{id}', 'BCPISController@view_brgy_business_permit_details');
  //BRGY DOCUMENT INFORMATION VIEW
  Route::get('/view_brgy_document_information_details/{id}', 'BCPISController@view_brgy_document_information_details');
  //BRGY BUSINESS VIEW
  Route::get('/view_barangay_business_details/{id}', 'BCPISController@view_barangay_business_details');

  Route::get('/update_Inhabitant_Status', 'bipsController@update_Inhabitant_Status')->name('update_Inhabitant_Status');

  //Household View
  Route::get('/inhabitants_household_details_view/{id}', 'bipsController@inhabitants_household_details_view');

  //Blotter Detail View
  Route::get('/blotter_details_view/{id}', 'BJISBHController@blotter_details_view');
  //Summon Details View
  Route::get('/summon_details_view/{id}', 'BJISBHController@summon_details_view');
  //Proceeding Details View
  Route::get('/proceeding_details_view/{id}', 'BJISBHController@proceeding_details_view');
  //Ordinance Violator Details View
  Route::get('/ordinance_violator_details_view/{id}', 'BJISBHController@ordinance_violator_details_view');



  //Search Boris Transaction
  Route::get('/search_ordinance', 'borisController@search_ordinance')->name('search_ordinance');
  Route::get('/search_resolution', 'borisController@search_resolution')->name('search_resolution');
  //Search BIPS Transaction
  Route::get('/search_inhabitants', 'bipsController@search_inhabitants')->name('search_inhabitants');

  //Delete Ordinance
  Route::get('/delete_ordinance', 'borisController@delete_ordinance')->name('delete_ordinance');
  //Delete Inhabitant
  Route::get('/delete_inhabitants', 'bipsController@delete_inhabitants')->name('delete_inhabitants');
  //Delete Household
  Route::get('/delete_household', 'bipsController@delete_household')->name('delete_household');
  //Delete Deceased Profile
  Route::get('/delete_deceased_profile', 'bipsController@delete_deceased_profile')->name('delete_deceased_profile');
  //Delete Brgy Official
  Route::get('/delete_brgy_official', 'bipsController@delete_brgy_official')->name('delete_brgy_official');
  //Delete Brgy Purok Leader
  Route::get('/delete_brgy_purok_leader', 'bipsController@delete_brgy_purok_leader')->name('delete_brgy_purok_leader');
  //Delete Blotter
  Route::get('/delete_blotter', 'BJISBHController@delete_blotter')->name('delete_blotter');
  //Delete Summons
  Route::get('/delete_summons', 'BJISBHController@delete_summons')->name('delete_summons');
  //Delete Proceedings
  Route::get('/delete_proceedings', 'BJISBHController@delete_proceedings')->name('delete_proceedings');
  //Delete Ordinance Violator
  Route::get('/delete_ordinance_violator', 'BJISBHController@delete_ordinance_violator')->name('delete_ordinance_violator');

  //Delete Contractor
  Route::get('/delete_contractor', 'BPMSController@delete_contractor')->name('delete_contractor');
  //Delete Business Permit
  Route::get('/delete_businesspermit', 'BCPISController@delete_businesspermit')->name('delete_businesspermit');
  //Delete Brgy Document
  Route::get('/delete_document', 'BCPISController@delete_document')->name('delete_document');
  //Delete Brgy Business
  Route::get('/delete_business', 'BCPISController@delete_business')->name('delete_business');
  //Delete Disaster Type
  Route::get('/delete_disaster', 'BDRISALController@delete_disaster')->name('delete_disaster');
  //Delete Emergency Evacuation
  Route::get('/delete_emereva', 'BDRISALController@delete_emereva')->name('delete_emereva');
  //Delete Allocated Fund
  Route::get('/delete_allocated', 'BDRISALController@delete_allocated')->name('delete_allocated');
  //Delete Disaster Supplies
  Route::get('/delete_disastersupp', 'BDRISALController@delete_disastersupp')->name('delete_disastersupp');
  //Delete Emergency Team
  Route::get('/delete_emerteam', 'BDRISALController@delete_emerteam')->name('delete_emerteam');
  //Delete Emergency Equipment
  Route::get('/delete_emerequip', 'BDRISALController@delete_emerequip')->name('delete_emerequip');
  //Delete Disaster Related Activities
  Route::get('/delete_disasterrelated', 'BDRISALController@delete_disasterrelated')->name('delete_disasterrelated');
  //Delete Response Information
  Route::get('/delete_response', 'BDRISALController@delete_response')->name('delete_response');
  //Delete Recovery Information
  Route::get('/delete_recovery', 'BDRISALController@delete_recovery')->name('delete_recovery');
  //Delete Projects Monitoring
  Route::get('/delete_projects', 'BPMSController@delete_projects')->name('delete_projects');


  //Search BCPCIS Transaction
  Route::get('/search_businesstype', 'BCPISController@search_businesstype')->name('search_businesstype');
  Route::get('/search_business', 'BCPISController@search_business')->name('search_business');
  Route::get('/search_businessresident', 'BCPISController@search_businessresident')->name('search_businessresident');
  Route::get('/search_documenttype', 'BCPISController@search_documenttype')->name('search_documenttype');
  Route::get('/search_documentpurpose', 'BCPISController@search_documentpurpose')->name('search_documentpurpose');
  Route::get('/search_documentresident', 'BCPISController@search_documentresident')->name('search_documentresident');

  //Search,Loda Attachment, and Delete Attachment BDRIS Transaction 
  Route::get('/search_emereva', 'BDRISALController@search_emereva')->name('search_emereva');
  Route::get('/search_allocated', 'BDRISALController@search_allocated')->name('search_allocated');
  Route::get('/search_emerequip', 'BDRISALController@search_emerequip')->name('search_emerequip');
  Route::get('/search_emerteam', 'BDRISALController@search_emerteam')->name('search_emerteam');
  Route::get('/search_disastertype', 'BDRISALController@search_disastertype')->name('search_disastertype');
  Route::get('/search_alertlevel', 'BDRISALController@search_alertlevel')->name('search_alertlevel');
  Route::get('/search_disasterresponse', 'BDRISALController@search_disasterresponse')->name('search_disasterresponse');
  Route::get('/search_household', 'BDRISALController@search_household')->name('search_household');
  Route::get('/search_leveldamage', 'BDRISALController@search_leveldamage')->name('search_leveldamage');
  Route::get('/get_response_attachments', 'BDRISALController@get_response_attachments')->name('get_response_attachments');
  Route::get('/delete_response_attachments', 'BDRISALController@delete_response_attachments')->name('delete_response_attachments');
  Route::get('/get_recovery_attachments', 'BDRISALController@get_recovery_attachments')->name('get_recovery_attachments');
  Route::get('/delete_recovery_attachments', 'BDRISALController@delete_recovery_attachments')->name('delete_recovery_attachments');

  //BPMS TRANSACTION
  Route::get('/brgy_project_monitoring_details/{id}', 'BPMSController@brgy_project_monitoring_details');
  Route::get('/search_contractor', 'BPMSController@search_contractor')->name('search_contractor');
  Route::get('/search_projecttype', 'BPMSController@search_projecttype')->name('search_projecttype');
  Route::get('/search_projectstatus', 'BPMSController@search_projectstatus')->name('search_projectstatus');
  Route::get('/get_project_monitoring_list/{Barangay_ID}', 'BPMSController@get_project_monitoring_list');
  Route::get('/search_accomplishment', 'BPMSController@search_accomplishment')->name('search_accomplishment');

  Route::get('/get_brgybusiness', 'BCPISController@get_brgybusiness')->name('get_brgybusiness');
  Route::get('/get_businesspermit', 'BCPISController@get_businesspermit')->name('get_businesspermit');
  Route::get('/get_brgydocument', 'BCPISController@get_brgydocument')->name('get_brgydocument');
  Route::get('/get_disastertype', 'BDRISALController@get_disastertype')->name('get_disastertype');
  Route::get('/get_emerevacsite', 'BDRISALController@get_emerevacsite')->name('get_emerevacsite');
  Route::get('/get_allofund', 'BDRISALController@get_allofund')->name('get_allofund');
  Route::get('/get_dissupp', 'BDRISALController@get_dissupp')->name('get_dissupp');
  Route::get('/get_emerteam', 'BDRISALController@get_emerteam')->name('get_emerteam');
  Route::get('/get_emerequip', 'BDRISALController@get_emerequip')->name('get_emerequip');
  Route::get('/brgy_project_monitoring_details_viewing/{id}', 'BPMSController@brgy_project_monitoring_details_viewing');
  Route::get('/get_brgyprojects', 'BPMSController@get_brgyprojects')->name('get_brgyprojects');
  Route::get('/get_disaster_related_activities_view', 'BDRISALController@get_disaster_related_activities_view')->name('get_disaster_related_activities_view');
  Route::get('/get_responseinfo', 'BDRISALController@get_responseinfo')->name('get_responseinfo');
  Route::post('/businesspermit_downloadPDF', 'BCPISController@businesspermit_downloadPDF')->name('businesspermit_downloadPDF');
  Route::post('/brgydocument_downloadPDF', 'BCPISController@brgydocument_downloadPDF')->name('brgydocument_downloadPDF');
  Route::post('/brgybusiness_downloadPDF', 'BCPISController@brgybusiness_downloadPDF')->name('brgybusiness_downloadPDF');
  Route::post('/disastertype_downloadPDF', 'BDRISALController@disastertype_downloadPDF')->name('disastertype_downloadPDF');
  Route::post('/emerevac_downloadPDF', 'BDRISALController@emerevac_downloadPDF')->name('emerevac_downloadPDF');
  Route::post('/allofund_downloadPDF', 'BDRISALController@allofund_downloadPDF')->name('allofund_downloadPDF');
  Route::post('/dissupp_downloadPDF', 'BDRISALController@dissupp_downloadPDF')->name('dissupp_downloadPDF');
  Route::post('/emerteam_downloadPDF', 'BDRISALController@emerteam_downloadPDF')->name('emerteam_downloadPDF');
  Route::post('/emerequip_downloadPDF', 'BDRISALController@emerequip_downloadPDF')->name('emerequip_downloadPDF');
  Route::post('/contractor_downloadPDF', 'BPMSController@contractor_downloadPDF')->name('contractor_downloadPDF');
  Route::post('/promon_downloadPDF', 'BPMSController@promon_downloadPDF')->name('promon_downloadPDF');


  Route::get('/search_ordinances', 'borisController@fetch_data');
  Route::get('/search_resolutions', 'borisController@fetch_data_resolution');
  Route::get('/search_inhabitants_list', 'bipsController@fetch_inhabitants_data');
  Route::get('/search_inhabitants_fields', 'bipsController@search_inhabitants_fields');
  Route::get('/search_household_profile_fields', 'bipsController@search_household_profile_fields');
  Route::get('/search_deceased_profile_fields', 'bipsController@search_deceased_profile_fields');
  Route::get('/search_inhabitant_transfer_fields', 'bipsController@search_inhabitant_transfer_fields');
  Route::get('/search_inhabitants_incoming_pending_fields', 'bipsController@search_inhabitants_incoming_pending_fields');
  Route::get('/search_inhabitants_incoming_approved_fields', 'bipsController@search_inhabitants_incoming_approved_fields');
  Route::get('/search_inhabitants_incoming_disapproved_fields', 'bipsController@search_inhabitants_incoming_disapproved_fields');
  Route::get('/search_inhabitants_application_list_fields', 'bipsController@search_inhabitants_application_list_fields');
  Route::get('/search_inhabitants_brgy_official_list_fields', 'bipsController@search_inhabitants_brgy_official_list_fields');
  Route::get('/search_inhabitants_brgy_purok_leaders_list_fields', 'bipsController@search_inhabitants_brgy_purok_leaders_list_fields');

  Route::get('/search_blotter_list_fields', 'BJISBHController@search_blotter_list_fields');
  Route::get('/search_summon_list_fields', 'BJISBHController@search_summon_list_fields');
  Route::get('/search_proceeding_list_fields', 'BJISBHController@search_proceeding_list_fields');
  Route::get('/search_ordinance_violator_list_fields', 'BJISBHController@search_ordinance_violator_list_fields');

  // Get Deceased Profile
  Route::get('/get_deceased_info', 'bipsController@get_deceased_info')->name('get_deceased_info');

  Route::get('/get_brgyprojects_projcount', 'BPMSController@get_brgyprojects_projcount')->name('get_brgyprojects_projcount');

  // Export to Excel
  Route::get('ordinance/export', 'borisController@export')->name('ordinance.export');
  Route::get('inhabitants/export', 'bipsController@inhabitants_export')->name('inhabitants.export');

  Route::get('/get_documenttype', 'BCPISController@get_documenttype')->name('get_documenttype');
  Route::get('/get_purposedocument', 'BCPISController@get_purposedocument')->name('get_purposedocument');
  Route::get('/search_brgybusinesspermit_fields', 'BCPISController@search_brgybusinesspermit_fields');
  Route::get('/search_brgydocument_fields', 'BCPISController@search_brgydocument_fields');
  Route::get('/search_barangaybusiness_fields', 'BCPISController@search_barangaybusiness_fields');
  Route::get('/search_documentrequestpending_fields', 'BCPISController@search_documentrequestpending_fields');
  Route::get('/search_disty_fields', 'BDRISALController@search_disty_fields');
  Route::get('/search_emerevac_fields', 'BDRISALController@search_emerevac_fields');
  Route::get('/search_allofund_fields', 'BDRISALController@search_allofund_fields');
  Route::get('/search_dissupp_fields', 'BDRISALController@search_dissupp_fields');
  Route::get('/search_emerteam_fields', 'BDRISALController@search_emerteam_fields');
  Route::get('/search_emerequip_fields', 'BDRISALController@search_emerequip_fields');
  Route::get('/document_request_list', 'BCPISController@document_request_list')->name('document_request_list');
  Route::get('/search_documentrequest_fields', 'BCPISController@search_documentrequest_fields');
  Route::get('/document_request_edit/{id}', 'BCPISController@document_request_edit');
  Route::post('/create_brgy_document_information_request_update', 'BCPISController@create_brgy_document_information_request_update')->name('create_brgy_document_information_request_update');
  Route::get('/search_documentrequestapproved_fields', 'BCPISController@search_documentrequestapproved_fields');
  Route::get('/search_documentrequestdisapproved_fields', 'BCPISController@search_documentrequestdisapproved_fields');
  Route::get('/search_disaster_related_activities_fields', 'BDRISALController@search_disaster_related_activities_fields');
  Route::get('/search_response_information_fields', 'BDRISALController@search_response_information_fields');
  Route::get('/search_recovery_information_fields', 'BDRISALController@search_recovery_information_fields');
  Route::get('/search_contractor_fields', 'BPMSController@search_contractor_fields');
  Route::get('/search_projects_monitoring_fields', 'BPMSController@search_projects_monitoring_fields');


  Route::get('/inhabitants_information_list_male', 'bipsController@inhabitants_information_list_male')->name('inhabitants_information_list_male');
  Route::get('/inhabitants_information_list_female', 'bipsController@inhabitants_information_list_female')->name('inhabitants_information_list_female');
});



// Global Controller
Route::get('/get_province/{Region_ID}', 'GlobalController@getProvince');
Route::get('/get_city/{Province_ID}', 'GlobalController@getCity');
Route::get('/get_barangay/{City_Municipality_ID}', 'GlobalController@getBarangay');
Route::get('/search_barangay/{text}', 'GlobalController@searchBarangay');

//Route::get('/search_barangay', 'GlobalController@searchBarangay');

//For Drop Downs
Route::get('/list_province', 'DropDownsController@list_province')->name('list_province');
Route::get('/list_city', 'DropDownsController@list_city')->name('list_city');
Route::get('/list_brgy', 'DropDownsController@list_brgy')->name('list_brgy');

//For Deletions
Route::post('/del_rec', 'DeleterController@del_rec')->name('del_rec');

Route::get('/search_barangay_main', 'Public_LandingController@search_barangay_main');
Route::get('businesspermit_export', 'BCPISController@businesspermit_export')->name('businesspermit_export');
Route::get('documentinformation_export', 'BCPISController@documentinformation_export')->name('documentinformation_export');
Route::get('brgybusiness_export', 'BCPISController@brgybusiness_export')->name('brgybusiness_export');
Route::get('disty_export', 'BDRISALController@disty_export')->name('disty_export');
Route::get('emerevac_export', 'BDRISALController@emerevac_export')->name('emerevac_export');
Route::get('allofund_export', 'BDRISALController@allofund_export')->name('allofund_export');
Route::get('dissupp_export', 'BDRISALController@dissupp_export')->name('dissupp_export');
Route::get('emerteam_export', 'BDRISALController@emerteam_export')->name('emerteam_export');
Route::get('emerequip_export', 'BDRISALController@emerequip_export')->name('emerequip_export');
Route::get('contractor_export', 'BPMSController@contractor_export')->name('contractor_export');
Route::get('projectmonitoring_export', 'BPMSController@projectmonitoring_export')->name('projectmonitoring_export');
