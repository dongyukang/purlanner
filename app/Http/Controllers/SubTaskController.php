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
        // task, task_id, due_date
        $requestData = [
        'task' => $request->get('subtask'),
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
        return auth()->user()
                     ->tasks()
                     ->find($task_id)
                     ->subtasks()
                     ->whereDate('due_date', '>=', \Carbon\Carbon::today())
                     ->get();
    }

  /**
   * Get subtasks from today.
   *
   * @return array
   */
    public function getSubTasksFromToday()
    {
        return auth()->user()
                     ->subtasks()
                     ->whereDate('due_date', '>=', Carbon::today())
                     ->orderBy('due_date', 'asc')
                     ->get();
    }

    /**
     * Get subtasks from today with actual task name.
     *
     * @return array
     */
    public function getSubTasksFromTodayWithTask()
    {
      // "id": 12,
      // "user_id": 1,
      // "task_id": 2,
      // "completed": 0,
      // "task": "some test",
      // "due_date": "2017-09-13",

      $subtasks = array();

      $subtasksOrdered = $this->getSubTasksFromToday();

      foreach ($subtasksOrdered as $subtask) {
        array_push($subtasks, [
          'id'          => $subtask->id,
          'user_id'     => $subtask->user_id,
          'course'      => $this->findCourse($subtask->task_id),
          'task_title'  => \App\Task::find($subtask->task_id)->title,
          'task'        => $subtask->task,
          'due_date'    => $subtask->due_date
        ]);
      }

      return $subtasks;
    }

    /**
     * Get course info by task_id
     *
     * @param  $task_id
     * @return string
     */
    protected function findCourse($task_id)
    {
      $course_id = auth()->user()->tasks()->find($task_id)->course_id;
      $course_info = auth()->user()->courses()->find($course_id)->subject . ' ' . auth()->user()->courses()->find($course_id)->course_number;

      return $course_info;
    }
}
