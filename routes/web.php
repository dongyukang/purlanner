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

Route::get('/currentTermName', 'PurdueCourseController@getCurrentTermName');
Route::get('/getCurrentTermSubjects', 'PurdueCourseController@getCurrentTermSubjects');
Route::get('/getCourseNumbers/{subject}', 'PurdueCourseController@getCourseNumbers');
Route::get('/getMyCourses', 'PurdueCourseController@getMyCourses');
Route::post('/saveCourse', 'PurdueCourseController@saveCourse');
Route::post('/removeCourse', 'PurdueCourseController@removeCourse');

Route::get('/', 'HomeController@index')->name('intro');
Route::get('/planner', 'PlannerController@index')->name('planner');
Route::get('/sub-task', 'SubTaskController@index')->name('sub-task');
Route::get('/sub-task/active/{task_id}', 'SubTaskController@indexActive')->name('sub-task-active');
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
Route::get('/task/past_due_archives', 'TaskController@showPastArchives')->name('past_due_archives');
Route::get('/tasksFromToday', 'TaskController@getTasksFromToday');
Route::get('/tasksFromTodayWithCourseNumber', 'TaskController@getTasksFromTodayWithCourseName');

Route::get('/subtasksByTask/{task_id}', 'SubTaskController@getSubTasksByTask');
Route::get('/subtasksFromToday', 'SubTaskController@getSubTasksFromToday');
Route::get('/subtasksFromTodayWithTask', 'SubTaskController@getSubTasksFromTodayWithTask');
Route::post('/sub-task', 'SubTaskController@saveSubTask')->name('save_sub_task');
Route::delete('/sub-task/{task_id}', 'SubTaskController@deleteSubTask');

Route::get('/look-at-the-whole-picture', 'AgendaController@index')->name('whole-picture');

Route::get('/home', function () {
    return redirect('/planner');
});
