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
    return view('home', [
      'name'     => auth()->user()->name,
      'subjects' => Purdue::subjects(),
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
