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
Route::get('/planner', 'PlannerController@index')->name('planner');
Route::get('/sub-task', 'AgendaController@index')->name('sub-task');
Route::get('/settings', 'PlannerController@showSettings')->name('settings');

Route::get('/task', 'TaskController@index')->name('task');
Route::get('/task/filter/{course_id}', 'TaskController@filterTask')->name('filter_task');
Route::get('/task/view/{id}', 'TaskController@showTask');
Route::get('/task/create', 'TaskController@create')->name('create_task');
Route::post('/task/create', 'TaskController@assignTask');
Route::get('/task/delete/{task_id}', 'TaskController@deleteTask'); // delete task
Route::put('/task/edit/{task_id}', 'TaskController@editTask'); // edit task
Route::get('/task/type', 'TaskController@showCustomTypes')->name('custom_type');
Route::get('/task/type/create', 'TaskController@showCreateCustomTypes')->name('create_custom_type');
Route::post('/task/type/create', 'TaskController@saveCustomTypes')->name('save_custom_type');
Route::get('/task/type/{type_id}', 'TaskController@deleteCustomType')->name('delete_custom_type');

Route::post('/sub-task', 'AgendaController@saveSubTask')->name('save_sub_task');

Route::get('/home', function () {
  return redirect('/planner');
});
