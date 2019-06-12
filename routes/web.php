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


Route::get('/referal/{id}', function () {
    return view('welcome');
});


Route::get('terms', function () {
   return view('terms');
});

 Route::post('/user/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@registeruser']);


Auth::routes();

Route::group(['middleware' => 'auth'], function() {
Route::get('/home', 'HomeController@index')->name('home');

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
Route::get('/user/fblog/{id}', 'FacebookController@getfacebooklogin');
Route::get('/deletes/log/{id}', 'FacebookController@delete');
Route::get('/user/terms', 'HomeController@terms');

Route::get('/admin/profile', 'HomeController@profile');
Route::post('/admin/profile', 'HomeController@updateuadmin');



});


Route::group(['middleware' => 'auth' ,'namespace' => 'user'], function() {

Route::get('/dashboard', ['as' => 'users.index', 'uses' => 'UsersController@index']);
Route::get('/profile', ['as' => 'users.index', 'uses' => 'UsersController@profile']);
Route::post('/profile', ['as' => 'users.index', 'uses' => 'UsersController@update']);
Route::get('/live', ['as' => 'users.index', 'uses' => 'UsersController@live']);



});



