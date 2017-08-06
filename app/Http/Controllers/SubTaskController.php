<?php

namespace App\Http\Controllers;

use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubTaskController extends Controller
{

  public function __construct()
  {
    date_default_timezone_set("America/New_York");

    $this->middleware(['auth', 'redirect_guard']);
  }

  /**
   * Show agenda page
   *
   * @return view
   */
  public function index()
  {
    return view('subtask.subtask', [
      'mytasks' => auth()->user()->tasks()->whereDate('due_date', '>=', Carbon::today())->orderBy('due_date', 'asc')->paginate(10)
    ]);
  }

  /**
   * Save sub test.
   */
  public function saveSubTask(Request $request)
  {
    $requestData = [
    ];

    $saved = auth()->user()->agendas()->create($requestData) != null ? true : false;

    if ($saved) return redirect('/sub-task');
  }
}
