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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::group(['middleware' => ['api']],function(){
    Route::get('/users','UserController@Users');
    Route::post('/auth/register','AuthController@register');
    Route::post('/auth/login','AuthController@login');
    Route::get('/profile','UserController@profile')->middleware('auth:api');

    // Using route resource

   Route::post('/post','IndexController@create')->middleware('auth:api');
   Route::get('/post/recent' ,'IndexController@index');

});

