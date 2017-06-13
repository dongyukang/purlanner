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
    $subjects = array();
    foreach (Purdue::subjects() as $subject) {
      array_push($subjects, $subject['Abbreviation']);
    }

    return view('home', [
      'name'     => auth()->user()->name,
      'subjects' => $subjects,
      'termName' => Purdue::currentTerm()->termName
    ]);
  }

  /**
   * Show settings page
   *
   * @return \Illuminate\Http\Response
   */
  public function showSettings()
  {
    return view('settings');
  }
}
