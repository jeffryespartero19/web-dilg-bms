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
    Route::get('/bweb_ann_status_maint', 'maintenanceController@bweb_ann_status_maint')->name('bweb_ann_status_maint');
    Route::post('/create_bweb_ann_status_maint', 'maintenanceController@create_bweb_ann_status_maint')->name('create_bweb_ann_status_maint');
    Route::get('/get_bweb_ann_status_maint', 'maintenanceController@get_bweb_ann_status_maint')->name('get_bweb_ann_status_maint');
    Route::post('/update_bweb_ann_status_maint', 'maintenanceController@update_bweb_ann_status_maint')->name('update_bweb_ann_status_maint');

    //BIPS Transaction
    Route::get('/inhabitants_information_list', 'bipsController@inhabitants_information_list')->name('inhabitants_information_list');
    Route::post('/create_inhabitants_information', 'bipsController@create_inhabitants_information')->name('create_inhabitants_information');
    Route::get('/get_inhabitants_info', 'bipsController@get_inhabitants_info')->name('get_inhabitants_info');

    // Global Controller
    Route::get('/get_province/{Region_ID}', 'GlobalController@getProvince');
    Route::get('/get_city/{Province_ID}', 'GlobalController@getCity');
    Route::get('/get_barangay/{City_Municipality_ID}', 'GlobalController@getBarangay');
});
