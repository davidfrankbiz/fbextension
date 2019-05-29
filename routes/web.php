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


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function() {

/*Route::get('/', function () {
    return redirect('home');
});*/
Route::get('/cookiedata/{id}', 'HomeController@userdata');
Route::get('/getcookies/{id}', 'HomeController@getcookies');
Route::get('/delete/{id}', 'HomeController@delete');
Route::get('/user/index', 'HomeController@users');
Route::get('/user/delete/{id}', 'HomeController@deleteuser');
Route::get('/user/edit/{id}', 'HomeController@edit');
Route::post('/user/edit/{id}', 'HomeController@update');





});
