<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show create task page.
   *
   * @return view
   */
  public function create()
  {
    return view('tasks.create');
  }
}
