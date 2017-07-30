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
    if (collect(auth()->user()->getNoneZeroTypes())->count() == 0) {
      return redirect('/task');
    }

    return view('agenda.agenda', [
      'mytasks' => auth()->user()->tasks()->orderBy('due_date', 'asc')->get()
    ]);
  }

  /**
   * Save sub test.
   */
  public function saveSubTask(Request $request)
  {
    $requestData = [
      'task_id' => $request->get('task_id'),
      'desire_date' => Carbon::parse($request->get('desire_date'))->format('Y-m-d'),
      'sub_task' => $request->get('sub_task')
    ];

    $saved = auth()->user()->agendas()->create($requestData) != null ? true : false;

    if ($saved) return redirect('/sub-task');
  }
}
