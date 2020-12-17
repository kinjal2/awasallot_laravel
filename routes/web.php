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
Auth::routes(['verify' => true]);
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

Route::get('generate-pdf/{requestid}/revision_id', [ 'as' => 'generate.pdf', 'uses' => 'QuartersController@generate_pdf']);
Route::get('uploaddocument/:any', ['uses' => 'QuartersController@uploaddocument']);
Route::post('saveuploaddocument', ['uses' => 'QuartersController@saveuploaddocument']);
Route::post('deletedoc', ['uses' => 'QuartersController@deletedoc']);

Route::get('download/:any', [ 'as' => 'download.pdf', 'uses' => 'ReportsController@download']);






Route::get('quarters', [ 'as' => 'quarters', 'uses' => 'QuartersController@index']);
Route::get('quarterlistnormal', [ 'as' => 'quarter.list.normal', 'uses' => 'QuartersController@quarterlistnormal']);
Route::get('quarterlistpriority', [ 'as' => 'quarter.list.priority', 'uses' => 'QuartersController@quarterlistnormal']);
Route::get('quarterlistnew', [ 'as' => 'quarter.list.new', 'uses' => 'QuartersController@quarterNewRequest']);
Route::get('waitinglist', [ 'as' => 'waiting.list', 'uses' => 'ReportsController@waitinglist']);
Route::get('allotmentlist', [ 'as' => 'allotment.list', 'uses' => 'ReportsController@allotmentlist']);
Route::get('vacantlist', [ 'as' => 'vacant.list', 'uses' => 'ReportsController@vacantlist']);
Route::post('waiting-list', [ 'as' => 'waitinglist.data','uses' => 'ReportsController@getWaitingList']);
Route::post('getdocumentdata', [ 'as' => 'getdocumentdata','uses' => 'ReportsController@getdocumentdata']);



Route::post('allotment-list', ['as' => 'allotment-list', 'uses' => 'ReportsController@getAllotmentList']);
Route::post('vacant-list', ['as' => 'vacant-list', 'uses' => 'ReportsController@getVacantList']);

Route::post('normalquarter-list', ['as' => 'normalquarter-list', 'uses' => 'QuartersController@getNormalquarterList']);

Route::post('vacant_quarter', ['as' => 'vacant_quarter', 'uses' => 'ReportsController@vacant_quarter']);
Route::get('quarter-occupancy', ['as' => 'quarter.occupancy', 'uses' => 'ReportsController@quarteroccupancy']);

Route::post('quarteroccupancylist', ['as' => 'quarter.occupancy.list', 'uses' => 'ReportsController@getquarteroccupancy']);

Route::get('editquarter/{id}', ['as' => 'editquarter', 'uses' => 'QuartersController@editquarter']);


Route::get('reports', [ 'as' => 'reports', 'uses' => 'ReportsController@index']);
Route::get('user', [ 'as' => 'user', 'uses' => 'UserController@index']);
Route::get('getUserList', ['uses'=>'UserController@getList', 'as'=>'getUserList']);
//Route::get('users', [ 'as' => 'users', 'uses' => 'UserController@index']); 
 
//quarter type
Route::get('masterquartertype', ['uses' => 'QuarterTypeController@index', 'as' => 'masterquartertype.index']); 
Route::post('getList1','QuarterTypeController@getList');
Route::resource('masterquartertype', 'QuarterTypeController');

//area
Route::get('masterarea', ['uses' => 'AreaController@index', 'as' => 'masterarea.index']); 
Route::post('getList','AreaController@getList');
Route::resource('masterarea', 'AreaController');


Route::get('grasapi', [ 'as' => 'grasapi', 'uses' => 'Auth\LoginController@apiLogin']);


//Route::get('logout', ['uses' => 'Auth\LoginController@Logout', 'as' => 'public.do.logout']);
Route::get('/logout', 'Auth\LoginController@logout');