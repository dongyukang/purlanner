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
Route::get('/home', function () {
  return redirect('/planner');
});

Auth::routes();

Route::get('/test2', function () {
  $data = Purdue::course('cs 182')
  ->all();
  dd($data);
});


Route::get('/test', function () {
  $title = 'Modern Mechanics-Honors';
  $titles = Purdue::fall(2017)->course('phys 172')->title;
  $courseIds = Purdue::fall(2017)->course('phys 172')->courseId;

  $cnt = 0;

  foreach ($titles as $t) {
    $cnt++;
    if ($t == $title) {
      break;
    }
  }

  $courseId = $courseIds[$cnt];

  dd(Purdue::fall(2017)->course('phys 172')
  ->classesByCourseId($courseId)
  ->sections()
  ->type('Recitation')
  ->getSections());

});
