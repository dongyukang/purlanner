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

Route::get('/currentTermName', 'PurdueCourseController@getCurrentTermName');
Route::get('/getCourseNumbers/{subject}', 'PurdueCourseController@getCourseNumbers');
Route::post('/saveCourse', 'PurdueCourseController@saveCourse');
