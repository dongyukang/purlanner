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
// use DongyuKang\PurdueCourse\Facades\Purdue;

Auth::routes();

Route::get('/', 'HomeController@index')->name('intro');
Route::get('/task', 'PlannerController@index')->name('planner');
Route::get('/settings', 'PlannerController@showSettings')->name('settings');

Route::get('/task/create', 'TaskController@create')->name('create_task');
Route::post('/task/create', 'TaskController@assignTask');
Route::get('/task/type', 'TaskController@showCustomTypes')->name('custom_type');
Route::get('/task/type/create', 'TaskController@showCreateCustomTypes')->name('create_custom_type');
Route::post('/task/type/create', 'TaskController@saveCustomTypes')->name('save_custom_type');
Route::get('/task/type/{type_id}', 'TaskController@deleteCustomType')->name('delete_custom_type');

Route::get('/home', function () {
  return redirect('/planner');
});
