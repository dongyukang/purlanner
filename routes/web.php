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
use DongyuKang\PurdueCourse\Facades\Purdue;

Route::get('/', 'HomeController@index');
Route::get('/planner', 'PlannerController@index')->name('planner');
Route::get('/settings', 'PlannerController@showSettings')->name('settings');
Route::get('/home', function () {
  return redirect('/planner');
});

Auth::routes();
