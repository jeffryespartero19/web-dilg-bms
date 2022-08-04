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

Route::group(['middleware' => 'auth'], function() {
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
        

});



