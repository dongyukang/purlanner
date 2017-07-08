<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DongyuKang\PurdueCourse\Facades\Purdue;

class PlannerController extends Controller
{
  /**
   * Constructor
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (auth()->user()->isCurrentCourseEmpty()) {
      return redirect('settings');
    } else {
      return view('home');
    }
  }

  /**
   * Show settings page
   *
   * @return \Illuminate\Http\Response
   */
  public function showSettings()
  {
    $subjects = array();

    foreach (Purdue::subjects() as $subject) {
      array_push($subjects, $subject['Abbreviation']);
    }

    return view('settings', [
      'termName' => Purdue::currentTerm()->termName,
      'subjects' => $subjects
    ]);
  }

  /**
   * Register Course.
   *
   * @return Boolean 
   */
  public function registerCourse()
  {

  }
}
