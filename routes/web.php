<?php

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

Route::get('/', function () {
    return view('welcome');
});




Route::resource('client', 'ClientController');
Route::resource('post', 'PostController');
Route::resource('order', 'OrderController');
Route::resource('government', 'GovernmentController');
Route::resource('city', 'CityController');
Route::resource('setting', 'SettingController');
Route::resource('clientpost', 'ClientPostController');
Route::resource('bloodtype', 'BloodTypeController');
Route::resource('bloodtypeclient', 'BloodTypeClientController');
Route::resource('contact', 'ContactController');
Route::resource('notification', 'NotificationController');
Route::resource('clientnotification', 'ClientNotificationController');
Route::resource('clientgovernment', 'ClientGovernmentController');
Route::resource('category', 'CategoryController');
