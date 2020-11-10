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

Route::get('/', function () {
    return view('welcome');
});
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});
//Route::post('post-login', 'AuthController@postLogin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('userdashboard', ['uses' => 'DashboardController@userdashboard', 'as' => 'user.dashboard.userdashboard']);

Route::get('admindashboard', ['uses' => 'DashboardController@index', 'as' => 'admin.dashboard.admindashboard']);


//Route::get('dashboard', [ 'as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);
//get profile
Route::get('profile', [ 'as' => 'user.profile', 'uses' => 'ProfileController@index']);
Route::post('profiledetails', 'ProfileController@updateprofiledetails');

Route::get('quartersuser', [ 'as' => 'user.Quarters', 'uses' => 'QuartersController@requestnewquarter']);
Route::post('savenewrequest', ['uses' => 'QuartersController@saveNewRequest']);


Route::get('quartershigher', [ 'as' => 'user.Quarter.higher', 'uses' => 'QuartersController@requesthighercategory']);
Route::post('saveHigherCategoryReq', ['uses' => 'QuartersController@saveHigherCategoryReq']);

Route::get('quartershistory', [ 'as' => 'user.Quarter.history', 'uses' => 'QuartersController@index']);
Route::get('request-history', ['uses' => 'QuartersController@requestHistory']);

Route::get('generate-pdf', ['uses' => 'QuartersController@generate_pdf']);



Route::get('quarters', [ 'as' => 'quarters', 'uses' => 'QuartersController@index']);
Route::get('reports', [ 'as' => 'reports', 'uses' => 'ReportsController@index']);
Route::get('user', [ 'as' => 'user', 'uses' => 'UserController@index']);
Route::post('getUserList', ['uses'=>'UserController@getList', 'as'=>'getUserList']);

Route::get('grasapi', [ 'as' => 'grasapi', 'uses' => 'Auth\LoginController@apiLogin']);


//Route::get('logout', ['uses' => 'Auth\LoginController@Logout', 'as' => 'public.do.logout']);
Route::get('/logout', 'Auth\LoginController@logout');