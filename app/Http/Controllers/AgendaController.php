<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendaController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'redirect_guard']);
  }

  /**
   * Go to main page.
   *
   * @return view
   */
  public function index()
  {
    return view('look-at-the-whole-picture');
  }
}
