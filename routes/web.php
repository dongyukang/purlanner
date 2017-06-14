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
Route::get('/planner/settings', 'PlannerController@showSettings')->name('settings');
Route::get('/test', function () {
  dd(Purdue::subjects());
});

Route::post('/submittest', 'PlannerController@submitTest')->name('test');

Route::get('/home', function () {
  return redirect('/planner');
});

Auth::routes();
