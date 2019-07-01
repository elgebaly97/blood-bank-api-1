<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function(){
   Route::get('governments', 'Api@governments');
   Route::get('cities', 'Api@cities');
   Route::post('register', 'AuthController@register');
   Route::post('login', 'AuthController@login');
   Route::get('categories', 'Api@categories');
   Route::get('settings', 'Api@settings');
   Route::post('contact', 'Api@contacts');
   Route::post('profile', 'Api@profile');
   Route::post('new-password', 'AuthController@password');
   Route::post('reset-password', 'AuthController@reset');



   Route::group(['middleware' => 'auth:api'], function(){
       Route::get('posts', 'Api@posts');
       Route::get('post', 'Api@post');
       Route::get('favourites', 'Api@favourites');
       Route::get('toggle-favourites', 'Api@toggleFav');
       Route::post('request-donate', 'Api@requestDonate');
       Route::post('register-token', 'AuthController@registerToken');
       Route::post('remove-token', 'AuthController@removeToken');
       Route::post('notifications-settings', 'Api@notificationSettings');
       Route::get('donations-request', 'Api@donationRequests');
       Route::get('notification-list', 'Api@notificationList');





   });

});

