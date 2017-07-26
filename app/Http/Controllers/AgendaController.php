<?php

namespace App\Http\Controllers;

use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendaController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show agenda page
   *
   * @return view
   */
  public function index()
  {
    if (auth()->user()->tasks()->count() == 0) {
      return redirect('/task');
    }

    return view('agenda.agenda', [
      'mytasks' => auth()->user()->tasks()->orderBy('due_date', 'asc')->get()
    ]);
  }
}
