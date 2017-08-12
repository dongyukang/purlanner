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
      'active_id' => 0,
      'mytasks' => auth()->user()->tasks()->whereDate('due_date', '>=', Carbon::today())->orderBy('due_date', 'asc')->get()
    ]);
  }

  /**
   * If there is task_id that wants to be activated.
   *
   * @return view
   */
  public function indexActive($task_id)
  {
    return view('subtask.subtask', [
      'active_id' => $task_id,
      'mytasks' => auth()->user()->tasks()->whereDate('due_date', '>=', Carbon::today())->orderBy('due_date', 'asc')->get()
    ]);
  }

  /**
   * Save sub test.
   */
  public function saveSubTask(Request $request)
  {
    //\Carbon\Carbon::parse($request->get('due_date'))->format('Y-m-d');
    // task, task_id, due_date
    $requestData = [
      'task' => $request->get('task'),
      'task_id' => $request->get('task_id'),
      'due_date' => \Carbon\Carbon::parse($request->get('due_date'))->format('Y-m-d')
    ];

    $saved = auth()->user()->subtasks()->create($requestData) != null ? true : false;
  }

  /**
   * Delete subtask.
   */
  public function deleteSubTask($task_id)
  {
    auth()->user()->subtasks()->find($task_id)->delete();
  }

  /**
   * Return user's subtasks.
   *
   * @return array
   */
  public function getSubTasksByTask($task_id)
  {
    return auth()->user()->tasks()->find($task_id)->subtasks()->whereDate('due_date', '>=', \Carbon\Carbon::today())->get();    
  }
}
