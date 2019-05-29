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
Route::post('/user/ajax_register',  'UserController@ajax_register');
Route::post('/user/ajax_login',  'UserController@ajax_login');
Route::post('/user/updatesV2',  'UserController@updatesV2');
Route::post('/user/ajax_cookies',  'UserController@ajax_cookies');
Route::post('/user/updatecookie',  'UserController@updatecookie');
Route::post('/user/checkUserLoggedIn',  'UserController@checkUserLoggedIn');

// Route::middleware('jwt.auth')->group(function(){ 
// });